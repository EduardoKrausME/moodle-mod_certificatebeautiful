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
 * Class course_categories
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\local\help;

/**
 * Class course_categories
 *
 * @package mod_certificatebeautiful\local\help
 */
class course_categories extends help_base {

    /**
     * CLASS_NAME value
     */
    const CLASS_NAME = "categories";


    /**
     * Function table_structure
     *
     * @return array
     * @throws \coding_exception
     */
    public static function table_structure() {
        return [
            ['key' => 'id', 'label' => get_string('help_course_categories_id', 'certificatebeautiful')],
            ['key' => 'name', 'label' => get_string('help_course_categories_name', 'certificatebeautiful')],
            ['key' => 'idnumber', 'label' => get_string('help_course_categories_idnumber', 'certificatebeautiful')],
            ['key' => 'description', 'label' => get_string('help_course_categories_description', 'certificatebeautiful')],
            ['key' => 'timemodified', 'label' => get_string('help_course_categories_timemodified', 'certificatebeautiful')],
        ];
    }

    /**
     * Function get_data
     *
     * @param $course
     *
     * @return array
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function get_data($course) {
        global $DB;

        $coursecategories = $DB->get_record('course_categories', ['id' => $course->category]);

        return self::base_get_data(self::table_structure(), $coursecategories);
    }
}
