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
 * Class teachers
 *
 * @package   certificatebeautifuldatainfo_teachers
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace certificatebeautifuldatainfo_teachers\datainfo;

use context_course;
use mod_certificatebeautiful\datainfo\help_base;

/**
 * Class teachers
 *
 * @package certificatebeautifuldatainfo_teachers
 */
class teachers extends help_base {

    /**
     * CLASS_NAME value
     */
    const CLASS_NAME = "teachers";


    /**
     * Function table_structure
     *
     * @return array
     * @throws \coding_exception
     */
    public static function table_structure() {
        return [
            ["key" => "teacher1", "label" => get_string("teacher1", "certificatebeautifuldatainfo_teachers")],
            ["key" => "teacher2", "label" => get_string("teacher2", "certificatebeautifuldatainfo_teachers")],
            ["key" => "teacherall", "label" => get_string("teacherall", "certificatebeautifuldatainfo_teachers")],
        ];
    }

    /**
     * Function get_data
     *
     * @param $course
     * @param $user
     *
     * @return array
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function get_data($course, $user) {
        $teachers = self::get_teachers($course);

        $data = [
            "teacher1" => "",
            "teacher2" => "",
            "teacherall" => "",
        ];

        if (isset($teachers[0])) {
            $data["teacher1"] = $teachers[0];
            $data["teacher2"] = $teachers[0];
            if (isset($teachers[1])) {
                $data["teacher2"] = "{$teachers[0]}<br>{$teachers[1]}";
            }

            $data["teacherall"] = implode("<br>", $teachers);
        }

        return $data;
    }

    /**
     * Function get_teachers
     *
     * @param $course
     *
     * @return array
     * @throws \coding_exception
     * @throws \dml_exception
     */
    private static function get_teachers($course) {
        global $CFG, $DB;

        $context = context_course::instance($course->id);
        if (!empty($CFG->coursecontact)) {
            $roleids = explode(',', $CFG->coursecontact);
        } else {
            list($roleids, $trash) = get_roles_with_cap_in_context($context, 'course:manage');
        }

        $teachers = [];
        foreach ($roleids as $roleid) {
            $roleid = (int)$roleid;
            $role = $DB->get_record("role", ["id" => $roleid]);
            $users = get_role_users($roleid, $context, true);
            if ($users) {
                foreach ($users as $teacher) {
                    $teachers[$teacher->id] = role_get_name($role, $context) . ': ' . fullname($teacher);
                }
            }
        }
        return $teachers;
    }
}
