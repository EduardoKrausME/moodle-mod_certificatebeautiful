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
 * Automation tests.
 *
 * @package   mod_certificatebeautiful
 * @copyright 2026 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful;

use advanced_testcase;

/**
 * Tests certificate emission rules.
 *
 * @covers \mod_certificatebeautiful\automation
 */
final class automation_test extends advanced_testcase {

    /**
     * On-access emission is allowed only for actively enrolled students.
     */
    public function test_on_view_requires_active_course_enrolment(): void {
        $this->resetAfterTest();

        $generator = $this->getDataGenerator();
        $course = $generator->create_course();
        $student = $generator->create_user();
        $outsider = $generator->create_user();
        $generator->enrol_user($student->id, $course->id, "student");

        $certificate = (object)[
            "course" => $course->id,
            "autotrigger" => automation::TRIGGER_ON_VIEW,
        ];

        $this->assertTrue(automation::user_matches_rule($certificate, $student->id));
        $this->assertFalse(automation::user_matches_rule($certificate, $outsider->id));
    }

    /**
     * A disabled trigger must never issue certificates on access.
     */
    public function test_none_does_not_match_on_access(): void {
        $this->resetAfterTest();

        $generator = $this->getDataGenerator();
        $course = $generator->create_course();
        $student = $generator->create_user();
        $generator->enrol_user($student->id, $course->id, "student");

        $certificate = (object)[
            "course" => $course->id,
            "autotrigger" => automation::TRIGGER_NONE,
        ];
        $this->assertFalse(automation::user_matches_rule($certificate, $student->id));
    }

    /**
     * On-access issuance is initiated by the activity page, not the background task.
     */
    public function test_on_view_has_no_background_candidates(): void {
        $certificate = (object)["autotrigger" => automation::TRIGGER_ON_VIEW];
        $cm = (object)["id" => 1];

        $this->assertSame([], automation::get_candidate_user_ids($certificate, $cm));
    }
}
