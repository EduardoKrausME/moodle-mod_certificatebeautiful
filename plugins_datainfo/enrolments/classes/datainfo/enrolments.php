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
 * Class enrolments
 *
 * @package   certificatebeautifuldatainfo_enrolments
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace certificatebeautifuldatainfo_enrolments\datainfo;

use Exception;
use mod_certificatebeautiful\datainfo\help_base;

/**
 * Class enrolments
 *
 * @package certificatebeautifuldatainfo_enrolments
 */
class enrolments extends help_base {

    /**
     * CLASS_NAME value
     */
    const CLASS_NAME = "enrolments";

    /**
     * Function table_structure
     *
     * @return array
     * @throws Exception
     */
    public static function table_structure() {
        return [
            [
                "key" => "timecreated",
                "label" => get_string("timecreated", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "timecreateddate",
                "label" => get_string("timecreateddate", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "timecreateddatetime",
                "label" => get_string("timecreateddatetime", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "timestart",
                "label" => get_string("timestart", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "timestartdate",
                "label" => get_string("timestartdate", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "timestartdatetime",
                "label" => get_string("timestartdatetime", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "timeend",
                "label" => get_string("timeend", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "timeenddate",
                "label" => get_string("timeenddate", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "timeenddatetime",
                "label" => get_string("timeenddatetime", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "completiontimeenrolled",
                "label" => get_string("completiontimeenrolled", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "completiontimeenrolleddate",
                "label" => get_string("completiontimeenrolleddate", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "completiontimeenrolleddatetime",
                "label" => get_string("completiontimeenrolleddatetime", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "completiontimestarted",
                "label" => get_string("completiontimestarted", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "completiontimestarteddate",
                "label" => get_string("completiontimestarteddate", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "completiontimestarteddatetime",
                "label" => get_string("completiontimestarteddatetime", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "timecompleted",
                "label" => get_string("timecompleted", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "timecompleteddate",
                "label" => get_string("timecompleteddate", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "timecompleteddatetime",
                "label" => get_string("timecompleteddatetime", "certificatebeautifuldatainfo_enrolments"),
            ],
            [
                "key" => "completionstatus",
                "label" => get_string("completionstatus", "certificatebeautifuldatainfo_enrolments"),
            ],
        ];
    }

    /**
     * Function get_data
     *
     * @param object $course
     * @param object $user
     * @return array
     * @throws Exception
     */
    public static function get_data($course, $user) {
        global $DB;

        $sql = "SELECT ue.timecreated, ue.timestart, ue.timeend
                  FROM {user_enrolments} ue
                  JOIN {enrol}            e ON e.id = ue.enrolid
                 WHERE e.status   = 0
                   AND ue.userid  = :userid
                   AND e.courseid = :courseid
              ORDER BY ue.timecreated ASC, ue.id ASC";
        $params = ["userid" => $user->id, "courseid" => $course->id];

        $enrolment = $DB->get_record_sql($sql, $params, IGNORE_MULTIPLE);
        $completion = $DB->get_record(
            "course_completions",
            ["userid" => $user->id, "course" => $course->id],
            "timeenrolled, timestarted, timecompleted"
        );

        $timecreated = $enrolment->timecreated ?? 0;
        $timestart = $enrolment->timestart ?? 0;
        $timeend = $enrolment->timeend ?? 0;
        $completiontimeenrolled = $completion->timeenrolled ?? 0;
        $completiontimestarted = $completion->timestarted ?? 0;
        $timecompleted = $completion->timecompleted ?? 0;

        return [
            "timecreated" => $timecreated,
            "timecreateddate" => self::format_date($timecreated),
            "timecreateddatetime" => self::format_datetime($timecreated),
            "timestart" => $timestart,
            "timestartdate" => self::format_date($timestart),
            "timestartdatetime" => self::format_datetime($timestart),
            "timeend" => $timeend,
            "timeenddate" => self::format_date($timeend),
            "timeenddatetime" => self::format_datetime($timeend),
            "completiontimeenrolled" => $completiontimeenrolled,
            "completiontimeenrolleddate" => self::format_date($completiontimeenrolled),
            "completiontimeenrolleddatetime" => self::format_datetime($completiontimeenrolled),
            "completiontimestarted" => $completiontimestarted,
            "completiontimestarteddate" => self::format_date($completiontimestarted),
            "completiontimestarteddatetime" => self::format_datetime($completiontimestarted),
            "timecompleted" => $timecompleted,
            "timecompleteddate" => self::format_date($timecompleted),
            "timecompleteddatetime" => self::format_datetime($timecompleted),
            "completionstatus" => $timecompleted ? get_string("yes") : get_string("no"),
        ];
    }

    /**
     * Format a timestamp as date.
     *
     * @param int|null $timestamp
     * @return string
     * @throws Exception
     */
    protected static function format_date(?int $timestamp): string {
        if (empty($timestamp)) {
            return "";
        }

        return userdate($timestamp, get_string("strftimedate", "langconfig"));
    }

    /**
     * Format a timestamp as date and time.
     *
     * @param int|null $timestamp
     * @return string
     * @throws Exception
     */
    protected static function format_datetime(?int $timestamp): string {
        if (empty($timestamp)) {
            return "";
        }

        return userdate($timestamp, get_string("strftimedatetime", "langconfig"));
    }
}
