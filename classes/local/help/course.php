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
            ["key" => "sections", "label" => get_string("help_course_sections", "certificatebeautiful")],
            ["key" => "sections_modules", "label" => get_string("help_course_sections_modules", "certificatebeautiful")],
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
     * @throws \dml_exception
     */
    public static function get_data($course) {
        $data = self::base_get_data(self::table_structure(), $course);

        $data["sections"] = self::sections($course);
        $data["sections_modules"] = self::sections_modules($course);

        return $data;
    }

    /**
     * Function sections
     *
     * @param $course
     *
     * @return string
     * @throws \coding_exception
     * @throws \dml_exception
     */
    private static function sections($course) {
        global $DB;

        $sections = $DB->get_records("course_sections", ["course" => $course->id], "section ASC");

        $return = "";
        foreach ($sections as $section) {
            if (isset($section->name[2])) {
                $return .= "<h3>{$section->name}</h3>";
            } else if ($section->section == 0) {
                if (get_string_manager()->string_exists("section0name", "format_{$course->format}")) {
                    $section->name = get_string("section0name", "format_{$course->format}");
                } else {
                    $section->name = get_string("section0name", "format_topics");
                }
                $return .= "<h3>{$section->name}</h3>";

            }
        }

        return $return;
    }

    /**
     * Function sections_modules
     *
     * @param $course
     *
     * @return string
     * @throws \coding_exception
     * @throws \dml_exception
     */
    private static function sections_modules($course) {
        global $DB;

        $sections = $DB->get_records("course_sections", ["course" => $course->id], "section ASC");

        $return = "";
        foreach ($sections as $section) {

            if (!isset($section->name[1])) {
                if ($section->section == 0) {
                    if (get_string_manager()->string_exists("section0name", "format_{$course->format}")) {
                        $section->name = get_string("section0name", "format_{$course->format}");
                    } else {
                        $section->name = get_string("section0name", "format_topics");
                    }
                } else {
                    if (get_string_manager()->string_exists("sectionname", "format_{$course->format}")) {
                        $section->name = get_string("sectionname", "format_{$course->format}") . " {$section->section}";
                    } else {
                        $section->name = get_string("sectionname", "format_topics") . " {$section->section}";
                    }
                }
            }

            if (isset($section->sequence[1])) {

                $sql = "
                    SELECT cm.*, m.name AS modulename
                      FROM {course_modules} cm
                      JOIN {modules}         m ON m.id = cm.module
                     WHERE cm.id     IN ({$section->sequence})
                       AND m.name    != 'label'
                       AND cm.visible = 1";
                if ($DB->get_dbfamily() == 'mysql') {
                    $sql .= "
                  ORDER BY FIELD(cm.id, {$section->sequence})";
                }
                $modules = $DB->get_records_sql($sql);

                $returnsections = "";
                foreach ($modules as $module) {
                    try {
                        $instance = $DB->get_record($module->modulename, ["id" => $module->instance], "name");
                        if ($instance) {
                            $returnsections .= "<li>{$instance->name}</li>";
                        }
                    } catch (\dml_exception $e) { // phpcs:disable
                    }
                }

                $return .= "<h3>{$section->name}</h3><ul>{$returnsections}</ul>";
            }
        }

        return $return;
    }
}
