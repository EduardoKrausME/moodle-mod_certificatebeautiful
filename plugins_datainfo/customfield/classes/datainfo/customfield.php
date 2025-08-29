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
 * Class course
 *
 * @package   certificatebeautifuldatainfo_customfield
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace certificatebeautifuldatainfo_customfield\datainfo;

use Exception;
use mod_certificatebeautiful\datainfo\help_base;

/**
 * Class course
 *
 * @package certificatebeautifuldatainfo_customfield
 */
class customfield extends help_base {

    /**
     * CLASS_NAME value
     */
    const CLASS_NAME = "customfield";

    /**
     * Function table_structure
     *
     * @return array
     * @throws Exception
     */
    public static function table_structure() {
        global $DB;
        $sql = "
            SELECT cc.name AS cc_name, cf.shortname, cf.name, cf.type
              FROM {customfield_category}  cc
              JOIN {customfield_field}     cf ON cc.id = cf.categoryid
             WHERE cf.type IN('text','number','textarea','date')
          ORDER BY cc.sortorder ASC, cf.sortorder ASC";
        $customfields = $DB->get_records_sql($sql);

        $return = [];
        foreach ($customfields as $customfield) {
            $type = get_string("pluginname", "customfield_{$customfield->type}");
            $return[] = [
                "key" => $customfield->shortname,
                "label" => "{$type} => {$customfield->cc_name} / {$customfield->name}",
            ];
        }
        return $return;
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

        $sql = "
            SELECT cf.shortname, cd.value, cf.type
              FROM {customfield_data}  cd
              JOIN {customfield_field} cf ON cf.id = cd.fieldid
             WHERE instanceid = :courseid";
        $customfielddatas = $DB->get_records_sql($sql, ["courseid" => $course->id]);

        $datas = [];
        foreach ($customfielddatas as $customfielddata) {
            if ($customfielddata->type == "date") {
                $lang = get_string("strftimedate", "langconfig");
                $datas[$customfielddata->shortname] = userdate($customfielddata->value, $lang);
            } else {
                $datas[$customfielddata->shortname] = $customfielddata->value;
            }
        }
        $data = self::base_get_data(self::table_structure(), $datas);
        return $data;
    }

    /**
     * Function sections
     *
     * @param object $course
     * @return string
     * @throws Exception
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
     * @param object $course
     * @return string
     * @throws Exception
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
                if ($DB->get_dbfamily() == "mysql") {
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
                    } catch (Exception $e) { // phpcs:disable
                    }
                }

                $return .= "<h3>{$section->name}</h3><ul>{$returnsections}</ul>";
            }
        }

        return $return;
    }
}
