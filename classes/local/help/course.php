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
 * Class course
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\local\help;

/**
 * Class course
 *
 * @package mod_certificatebeautiful\local\help
 */
class course extends help_base {

    /**
     * CLASS_NAME value
     */
    const CLASS_NAME = "course";


    /**
     * Function table_structure
     *
     * @return array
     * @throws \coding_exception
     */
    public static function table_structure() {
        return [
            ["key" => "id", "label" => get_string("help_course_id", "certificatebeautiful")],
            ["key" => "category", "label" => get_string("help_course_category", "certificatebeautiful")],
            ["key" => "fullname", "label" => get_string("help_course_fullname", "certificatebeautiful")],
            ["key" => "shortname", "label" => get_string("help_course_shortname", "certificatebeautiful")],
            ["key" => "summary", "label" => get_string("help_course_summary", "certificatebeautiful")],
            ["key" => "startdate", "label" => get_string("help_course_startdate", "certificatebeautiful")],
            ["key" => "enddate", "label" => get_string("help_course_enddate", "certificatebeautiful")],
            ["key" => "lang", "label" => get_string("help_course_lang", "certificatebeautiful")],
        ];
    }

    /**
     * Function get_data
     *
     * @param $course
     *
     * @return array
     * @throws \coding_exception
     */
    public static function get_data($course) {
        return self::base_get_data(self::table_structure(), $course);
    }
}
