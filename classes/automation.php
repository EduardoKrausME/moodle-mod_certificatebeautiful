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
 * automation
 *
 * @package   mod_certificatebeautiful
 * @copyright 2026 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful;

use context_module;
use core_user;
use mod_certificatebeautiful\pdf\page_pdf;
use mod_certificatebeautiful\vo\certificatebeautiful;
use mod_certificatebeautiful\vo\certificatebeautiful_model;
use stdClass;

/**
 * Automatic issuance service.
 *
 * @package mod_certificatebeautiful
 */
class automation {

    /** @var string */
    const TRIGGER_NONE = "";

    /** @var string */
    const TRIGGER_COURSE_COMPLETION = "coursecompletion";

    /** @var string */
    const TRIGGER_ACTIVITY_COMPLETION = "activitycompletion";

    /** @var string */
    const TRIGGER_GRADE_THRESHOLD = "gradethreshold";

    /**
     * Returns candidate users for a certificate.
     *
     * @param stdClass $certificatebeautiful
     * @param stdClass $cm
     * @return int[]
     * @throws \dml_exception
     */
    public static function get_candidate_user_ids(stdClass $certificatebeautiful, stdClass $cm): array {
        switch ($certificatebeautiful->autotrigger) {
            case self::TRIGGER_COURSE_COMPLETION:
                return self::get_course_completion_candidates($certificatebeautiful, $cm);

            case self::TRIGGER_ACTIVITY_COMPLETION:
                return self::get_activity_completion_candidates($certificatebeautiful, $cm);

            case self::TRIGGER_GRADE_THRESHOLD:
                return self::get_grade_threshold_candidates($certificatebeautiful, $cm);

            default:
                return [];
        }
    }

    /**
     * Processes one user for one certificate activity.
     *
     * @param int $cmid
     * @param int $userid
     * @return bool
     * @throws \Throwable
     */
    public static function process_user(int $cmid, int $userid): bool {
        global $DB;

        $cm = get_coursemodule_from_id("certificatebeautiful", $cmid, 0, false, MUST_EXIST);
        $course = $DB->get_record("course", ["id" => $cm->course], "*", MUST_EXIST);

        /** @var certificatebeautiful $certificatebeautiful */
        $certificatebeautiful = $DB->get_record("certificatebeautiful", ["id" => $cm->instance], "*", MUST_EXIST);
        $user = core_user::get_user($userid, "*", MUST_EXIST);

        if (!self::user_matches_rule($certificatebeautiful, $user->id)) {
            return false;
        }

        list($issue, $created) = issue::get_or_create($user, $certificatebeautiful, $cm);

        self::ensure_pdf_file($certificatebeautiful, $issue, $user, $course, $cm);

        if ($created && !empty($certificatebeautiful->notifyuser)) {
            self::send_notification($certificatebeautiful, $course, $cm, $user);
        }

        return true;
    }

    /**
     * Checks whether a user matches configured automation rule.
     *
     * @param stdClass $certificatebeautiful
     * @param int $userid
     * @return bool
     * @throws \dml_exception
     */
    public static function user_matches_rule(stdClass $certificatebeautiful, int $userid): bool {
        switch ($certificatebeautiful->autotrigger) {
            case self::TRIGGER_COURSE_COMPLETION:
                return self::is_course_completed($certificatebeautiful->course, $userid);

            case self::TRIGGER_ACTIVITY_COMPLETION:
                return self::is_activity_completed((int)$certificatebeautiful->triggercmid, $userid);

            case self::TRIGGER_GRADE_THRESHOLD:
                return self::matches_grade_threshold($certificatebeautiful->course, $userid, $certificatebeautiful->gradepass);

            default:
                return false;
        }
    }

    /**
     * Ensures the PDF file exists and is up to date.
     *
     * @param stdClass $certificatebeautiful
     * @param stdClass $issue
     * @param stdClass $user
     * @param stdClass $course
     * @param stdClass $cm
     * @return void
     * @throws \Throwable
     */
    public static function ensure_pdf_file(
        stdClass $certificatebeautiful,
        stdClass $issue,
        stdClass $user,
        stdClass $course,
        stdClass $cm
    ): void {
        global $DB;

        $context = context_module::instance($cm->id);
        $fs = get_file_storage();

        /** @var certificatebeautiful_model $certificatebeautifulmodel */
        $certificatebeautifulmodel = $DB->get_record(
            "certificatebeautiful_model",
            ["id" => $certificatebeautiful->model],
            "*",
            MUST_EXIST
        );

        $filerecord = (object)[
            "component" => "mod_certificatebeautiful",
            "contextid" => $context->id,
            "userid" => $user->id,
            "filearea" => "certificate",
            "filepath" => "/",
            "itemid" => $user->id,
            "filename" => "{$issue->code}.pdf",
        ];

        $storedfile = $fs->get_file(
            $filerecord->contextid,
            $filerecord->component,
            $filerecord->filearea,
            $filerecord->itemid,
            $filerecord->filepath,
            $filerecord->filename
        );

        $stale = false;

        if ($storedfile && (int)$issue->version !== (int)$certificatebeautiful->timemodified) {
            $storedfile->delete();
            $storedfile = null;
            $stale = true;
        }

        if ($storedfile && $storedfile->get_timecreated() <= $certificatebeautifulmodel->timemodified) {
            $storedfile->delete();
            $storedfile = null;
            $stale = true;
        }

        if ($storedfile && !$stale) {
            return;
        }

        $certificatebeautifulmodel->pages_info_object = json_decode($certificatebeautifulmodel->pages_info);
        $pagepdf = new page_pdf();

        $contentpdf = $pagepdf->create_pdf(
            $certificatebeautiful,
            $issue,
            $certificatebeautifulmodel,
            $user,
            $course
        );

        $fs->create_file_from_string($filerecord, $contentpdf);

        $issue->version = $certificatebeautiful->timemodified;
        $DB->update_record("certificatebeautiful_issue", $issue);
    }

    /**
     * Sends user notification.
     *
     * @param stdClass $certificatebeautiful
     * @param stdClass $course
     * @param stdClass $cm
     * @param stdClass $user
     * @return void
     * @throws \Exception
     */
    private static function send_notification(
        stdClass $certificatebeautiful,
        stdClass $course,
        stdClass $cm,
        stdClass $user
    ): void {
        global $CFG;

        $supportuser = core_user::get_support_user();

        $data = (object)[
            "fullname" => fullname($user),
            "certificatename" => format_string($certificatebeautiful->name),
            "coursename" => format_string($course->fullname),
            "url" => (new \moodle_url("/mod/certificatebeautiful/view.php", ["id" => $cm->id]))->out(false),
        ];

        $subject = get_string("notification_subject", "certificatebeautiful", $data);
        $messagehtml = get_string("notification_body", "certificatebeautiful", $data);
        $messageplain = html_to_text($messagehtml);

        email_to_user($user, $supportuser, $subject, $messageplain, $messagehtml);
    }

    /**
     * Returns users with course completion and without issue yet.
     *
     * @param stdClass $certificatebeautiful
     * @param stdClass $cm
     * @return int[]
     * @throws \dml_exception
     */
    private static function get_course_completion_candidates(stdClass $certificatebeautiful, stdClass $cm): array {
        global $DB;

        $sql = "SELECT cc.userid, cc.userid
                  FROM {course_completions}         cc
             LEFT JOIN {certificatebeautiful_issue} cbi ON cbi.cmid = :cmid AND cbi.userid = cc.userid
                 WHERE cc.course = :courseid
                   AND cc.timecompleted > 0
                   AND cbi.id IS NULL";

        return array_map("intval", array_keys($DB->get_records_sql_menu($sql, [
            "cmid" => $cm->id,
            "courseid" => $certificatebeautiful->course,
        ])));
    }

    /**
     * Returns users with activity completion and without issue yet.
     *
     * @param stdClass $certificatebeautiful
     * @param stdClass $cm
     * @return int[]
     * @throws \dml_exception
     */
    private static function get_activity_completion_candidates(stdClass $certificatebeautiful, stdClass $cm): array {
        global $DB;

        if (empty($certificatebeautiful->triggercmid)) {
            return [];
        }

        $sql = "SELECT cmc.userid, cmc.userid
                  FROM {course_modules_completion}  cmc
             LEFT JOIN {certificatebeautiful_issue} cbi ON cbi.cmid = :cmid AND cbi.userid = cmc.userid
                 WHERE cmc.coursemoduleid = :triggercmid
                   AND cmc.completionstate > 0
                   AND cbi.id IS NULL";

        return array_map("intval", array_keys($DB->get_records_sql_menu($sql, [
            "cmid" => $cm->id,
            "triggercmid" => $certificatebeautiful->triggercmid,
        ])));
    }

    /**
     * Returns enrolled users without issue and then filters them by course final grade.
     *
     * @param stdClass $certificatebeautiful
     * @param stdClass $cm
     * @return int[]
     * @throws \Throwable
     */
    private static function get_grade_threshold_candidates(stdClass $certificatebeautiful, stdClass $cm): array {
        global $DB;

        $sql = "SELECT DISTINCT u.id, u.id
                  FROM {enrol}                      e
                  JOIN {user_enrolments}            ue  ON ue.enrolid = e.id
                  JOIN {user}                       u   ON u.id = ue.userid
             LEFT JOIN {certificatebeautiful_issue} cbi ON cbi.cmid = :cmid AND cbi.userid = u.id
                 WHERE e.courseid  = :courseid
                   AND e.status    = 0
                   AND ue.status   = 0
                   AND u.deleted   = 0
                   AND u.suspended = 0
                   AND cbi.id      IS NULL";

        $userids = array_map("intval", array_keys($DB->get_records_sql_menu($sql, [
            "cmid" => $cm->id,
            "courseid" => $certificatebeautiful->course,
        ])));

        $filtered = [];
        foreach ($userids as $userid) {
            if (self::matches_grade_threshold($certificatebeautiful->course, $userid, $certificatebeautiful->gradepass)) {
                $filtered[] = $userid;
            }
        }

        return $filtered;
    }

    /**
     * Checks course completion.
     *
     * @param int $courseid
     * @param int $userid
     * @return bool
     * @throws \dml_exception
     */
    private static function is_course_completed(int $courseid, int $userid): bool {
        global $DB;

        return $DB->record_exists_select(
            "course_completions",
            "course = :courseid AND userid = :userid AND timecompleted IS NOT NULL AND timecompleted > 0",
            [
                "courseid" => $courseid,
                "userid" => $userid,
            ]
        );
    }

    /**
     * Checks activity completion.
     *
     * @param int $triggercmid
     * @param int $userid
     * @return bool
     * @throws \dml_exception
     */
    private static function is_activity_completed(int $triggercmid, int $userid): bool {
        global $DB;

        if (!$triggercmid) {
            return false;
        }

        return $DB->record_exists_select(
            "course_modules_completion",
            "coursemoduleid = :coursemoduleid AND userid = :userid AND completionstate > 0",
            [
                "coursemoduleid" => $triggercmid,
                "userid" => $userid,
            ]
        );
    }

    /**
     * Checks final course grade.
     *
     * @param int $courseid
     * @param int $userid
     * @param string $gradepass
     * @return bool
     * @throws \Throwable
     */
    private static function matches_grade_threshold(int $courseid, int $userid, string $gradepass): bool {
        global $CFG;

        if ($gradepass === "") {
            return false;
        }

        require_once("{$CFG->libdir}/gradelib.php");
        require_once("{$CFG->rootdir}/mod/certificatebeautiful/gradequerylib.php");

        $grade = grade_get_course_grade($userid, $courseid);
        if (!$grade || $grade->grade === null) {
            return false;
        }

        return (float)$grade->grade >= (float)$gradepass;
    }
}
