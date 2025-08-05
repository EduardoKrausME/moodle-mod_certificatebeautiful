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
 * Class coursecategories
 *
 * @package   certificatebeautifuldatainfo_coursecategories
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace certificatebeautifuldatainfo_coursecategories\datainfo;

use Exception;
use mod_certificatebeautiful\datainfo\help_base;

/**
 * Class coursecategories
 *
 * @package certificatebeautifuldatainfo_coursecategories
 */
class coursecategories extends help_base {

    /**
     * CLASS_NAME value
     */
    const CLASS_NAME = "categories";

    /**
     * Function table_structure
     *
     * @return array
     * @throws Exception
     */
    public static function table_structure() {
        return [
            ["key" => "id", "label" => get_string("id", "certificatebeautifuldatainfo_coursecategories")],
            ["key" => "name", "label" => get_string("name", "certificatebeautifuldatainfo_coursecategories")],
            ["key" => "idnumber", "label" => get_string("idnumber", "certificatebeautifuldatainfo_coursecategories")],
            ["key" => "description", "label" => get_string("description", "certificatebeautifuldatainfo_coursecategories")],
            ["key" => "timemodified", "label" => get_string("timemodified", "certificatebeautifuldatainfo_coursecategories")],
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

        $coursecategories = $DB->get_record("course_categories", ["id" => $course->category]);

        return self::base_get_data(self::table_structure(), $coursecategories);
    }
}
