<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Issue tests.
 *
 * @package   mod_certificatebeautiful
 * @copyright 2026 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful;

use advanced_testcase;

/**
 * Tests certificate issue consistency.
 *
 * @covers \mod_certificatebeautiful\issue
 */
final class issue_test extends advanced_testcase {

    /**
     * Repeated calls return the same issue instead of creating duplicates.
     */
    public function test_get_or_create_is_idempotent(): void {
        global $DB;

        $this->resetAfterTest();

        [$course, $user, $activity, $cm] = $this->create_activity_and_user();

        [$first, $firstcreated] = issue::get_or_create($user, $activity, $cm);
        [$second, $secondcreated] = issue::get_or_create($user, $activity, $cm);

        $this->assertTrue($firstcreated);
        $this->assertFalse($secondcreated);
        $this->assertEquals($first->id, $second->id);
        $this->assertEquals(1, $DB->count_records("certificatebeautiful_issue", [
            "userid" => $user->id,
            "cmid" => $cm->id,
        ]));
    }

    /**
     * Visiting the certificate creates an issue when automatic issuance is disabled.
     */
    public function test_view_issues_certificate_without_automatic_trigger(): void {
        global $DB;

        $this->resetAfterTest();

        [$course, $user, $activity, $cm] = $this->create_activity_and_user();

        $first = issue::get_for_view($user, $activity, $cm);
        $second = issue::get_for_view($user, $activity, $cm);

        $this->assertNotFalse($first);
        $this->assertEquals($first->id, $second->id);
        $this->assertEquals(1, $DB->count_records("certificatebeautiful_issue", [
            "userid" => $user->id,
            "cmid" => $cm->id,
        ]));
    }

    /**
     * A student may request a certificate even without meeting the automatic rule.
     */
    public function test_view_issues_certificate_when_automatic_condition_is_unmet(): void {
        global $DB;

        $this->resetAfterTest();

        [$course, $user, $activity, $cm] = $this->create_activity_and_user();

        $activity->autotrigger = automation::TRIGGER_COURSE_COMPLETION;
        $DB->set_field("certificatebeautiful", "autotrigger", $activity->autotrigger, ["id" => $activity->id]);

        $this->assertFalse(automation::process_user($cm->id, $user->id));

        $issue = issue::get_for_view($user, $activity, $cm);
        $this->assertNotFalse($issue);
        $this->assertEquals(1, $DB->count_records("certificatebeautiful_issue", [
            "userid" => $user->id,
            "cmid" => $cm->id,
        ]));
    }

    /**
     * Access without an active enrolment never creates a certificate.
     */
    public function test_view_does_not_issue_certificate_for_unenrolled_user(): void {
        global $DB;

        $this->resetAfterTest();

        [$course, $user, $activity, $cm] = $this->create_activity_and_user();
        $outsider = $this->getDataGenerator()->create_user();

        $this->assertFalse(issue::get_for_view($outsider, $activity, $cm));
        $this->assertFalse($DB->record_exists("certificatebeautiful_issue", [
            "userid" => $outsider->id,
            "cmid" => $cm->id,
        ]));
    }

    /**
     * Previously issued certificates remain stable if the owner is no longer enrolled.
     */
    public function test_view_reuses_previously_issued_certificate(): void {
        global $DB;

        $this->resetAfterTest();

        [$course, $user, $activity, $cm] = $this->create_activity_and_user();
        $first = issue::get_for_view($user, $activity, $cm);

        $enrolments = $DB->get_records_sql(
            "SELECT ue.id FROM {user_enrolments} ue
               JOIN {enrol} e ON e.id = ue.enrolid
              WHERE e.courseid = :courseid AND ue.userid = :userid",
            ["courseid" => $course->id, "userid" => $user->id]
        );
        foreach ($enrolments as $enrolment) {
            $DB->set_field("user_enrolments", "status", 1, ["id" => $enrolment->id]);
        }

        $second = issue::get_for_view($user, $activity, $cm);
        $this->assertEquals($first->id, $second->id);
        $this->assertEquals(1, $DB->count_records("certificatebeautiful_issue", [
            "userid" => $user->id,
            "cmid" => $cm->id,
        ]));
    }

    /**
     * Updating the issue version targets the issue id, not the activity instance id.
     */
    public function test_update_version_targets_issue_id(): void {
        global $DB;

        $this->resetAfterTest();

        [$course, $user, $activity, $cm] = $this->create_activity_and_user();
        [$first] = issue::get_or_create($user, $activity, $cm);

        $otheruser = $this->getDataGenerator()->create_user();
        $this->getDataGenerator()->enrol_user($otheruser->id, $course->id, "student");
        [$second] = issue::get_or_create($otheruser, $activity, $cm);

        $DB->set_field("certificatebeautiful_issue", "version", 111, ["id" => $first->id]);
        $DB->set_field("certificatebeautiful_issue", "version", 222, ["id" => $second->id]);

        issue::update_version((int)$first->id, 999);

        $this->assertEquals(999, $DB->get_field("certificatebeautiful_issue", "version", ["id" => $first->id]));
        $this->assertEquals(222, $DB->get_field("certificatebeautiful_issue", "version", ["id" => $second->id]));
    }

    /**
     * The database contains the unique userid/cmid index used as concurrency protection.
     */
    public function test_userid_cmid_unique_index_exists(): void {
        global $DB;

        $this->resetAfterTest();

        $table = new \xmldb_table("certificatebeautiful_issue");
        $index = new \xmldb_index("userid_cmid", XMLDB_INDEX_UNIQUE, ["userid", "cmid"]);

        $this->assertTrue($DB->get_manager()->index_exists($table, $index));

        $certificateindex = new \xmldb_index(
            "certificatebeautifulid",
            XMLDB_INDEX_NOTUNIQUE,
            ["certificatebeautifulid"]
        );
        $this->assertTrue($DB->get_manager()->index_exists($table, $certificateindex));
    }

    /**
     * Creates a test activity and enrolled student.
     *
     * @return array
     */
    private function create_activity_and_user(): array {
        global $DB;

        $generator = $this->getDataGenerator();
        $course = $generator->create_course();
        $user = $generator->create_user();
        $generator->enrol_user($user->id, $course->id, "student");

        $modelid = (int)$DB->get_field_sql("SELECT MIN(id) FROM {certificatebeautiful_model}");
        if (!$modelid) {
            $modelid = $DB->insert_record("certificatebeautiful_model", (object)[
                "name" => "Test model",
                "orientation" => "L",
                "model_key" => "test-model",
                "pages_info" => "[]",
                "timecreated" => time(),
                "timemodified" => time(),
            ]);
        }

        $activity = $generator->create_module("certificatebeautiful", [
            "course" => $course->id,
            "name" => "Issue certificate",
            "description" => "Test certificate",
            "model" => $modelid,
            "autotrigger" => "",
            "triggercmid" => 0,
            "gradepass" => "",
            "notifyuser" => 0,
        ]);
        $cm = get_coursemodule_from_instance("certificatebeautiful", $activity->id, $course->id, false, MUST_EXIST);

        return [$course, $user, $activity, $cm];
    }
}
