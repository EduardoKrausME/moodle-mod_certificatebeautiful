<?php
// This file is part of the mod_certificatebeautiful plugin for Moodle - http://moodle.org/
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
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\local\help;

/**
 * Class enrolments
 *
 * @package mod_certificatebeautiful\local\help
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
     * @throws \coding_exception
     */
    public static function table_structure() {
        return [
            [
                "key" => "timestart",
                "label" => get_string("help_enrolments_timestart", "certificatebeautiful"),
            ],
        ];
    }

    /**
     * Function get_data
     *
     * @param $course
     * @param $user
     *
     * @return array
     * @throws \dml_exception
     */
    public static function get_data($course, $user) {
        global $DB;

        $sql = "SELECT ue.timestart
                  FROM {user_enrolments} ue
                  JOIN {enrol}            e ON e.id = ue.enrolid
                 WHERE e.status   = 0
                   AND ue.userid  = :userid
                   AND e.courseid = :courseid
                 LIMIT 1";
        $params = ["userid" => $user->id, "courseid" => $course->id];

        return [
            "timestart" => $DB->get_field_sql($sql, $params),
        ];
    }
}
