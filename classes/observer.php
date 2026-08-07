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
 * Event observer.
 *
 * @package   mod_certificatebeautiful
 * @copyright 2026 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful;

use core\event\course_completed;
use core_user;

/**
 * Event observer.
 *
 * @package mod_certificatebeautiful
 */
class observer {

    /**
     * Issues certificates enabled for automatic course-completion issuance.
     *
     * @param course_completed $event
     * @return void
     */
    public static function course_completed(course_completed $event): void {
        global $DB;

        $courseid = (int)$event->courseid;
        $userid = (int)$event->relateduserid;

        if (!$courseid || !$userid) {
            return;
        }

        $course = $DB->get_record("course", ["id" => $courseid], "*", MUST_EXIST);
        $user = core_user::get_user($userid, "*", MUST_EXIST);

        $certificates = $DB->get_records("certificatebeautiful", [
            "course" => $courseid,
            "autoissueoncompletion" => 1,
        ]);

        foreach ($certificates as $certificatebeautiful) {
            $cm = get_coursemodule_from_instance(
                "certificatebeautiful",
                $certificatebeautiful->id,
                $courseid,
                false,
                IGNORE_MISSING
            );

            if (!$cm) {
                continue;
            }

            try {
                [$issue] = issue::get_or_create($user, $certificatebeautiful, $cm);
                automation::ensure_pdf_file($certificatebeautiful, $issue, $user, $course, $cm);
            } catch (\Throwable $exception) {
                debugging(
                    "mod_certificatebeautiful: error issuing certificate after course completion. " .
                    "cmid={$cm->id}, userid={$userid}: {$exception->getMessage()}",
                    DEBUG_DEVELOPER
                );
            }
        }
    }
}
