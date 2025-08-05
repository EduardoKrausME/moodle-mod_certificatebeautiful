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
 * Class grade
 *
 * @package   certificatebeautifuldatainfo_grade
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace certificatebeautifuldatainfo_grade\datainfo;

use Exception;
use grade_item;
use mod_certificatebeautiful\datainfo\help_base;

/**
 * Class grade
 *
 * @package certificatebeautifuldatainfo_grade
 */
class grade extends help_base {

    /**
     * CLASS_NAME value
     */
    const CLASS_NAME = "grade";

    /**
     * Function table_structure
     *
     * @return array
     * @throws Exception
     */
    public static function table_structure() {
        return [
            ["key" => "finalgrade", "label" => get_string("finalgrade", "certificatebeautifuldatainfo_grade")],
            ["key" => "table", "label" => get_string("table", "certificatebeautifuldatainfo_grade")],
        ];
    }

    /**
     * Function get_data
     *
     * @param $course
     * @param $user
     * @return array
     * @throws Exception
     */
    public static function get_data($course, $user) {
        return [
            "finalgrade" => self::get_grade($course, $user),
            "table" => self::get_table_grade($course, $user),
        ];
    }

    /**
     * Function get_grade
     *
     * @param $course
     * @param $user
     * @return string
     */
    private static function get_grade($course, $user) {
        global $CFG;

        require_once("{$CFG->dirroot}/grade/querylib.php");
        require_once("{$CFG->dirroot}/lib/gradelib.php");

        $resultkrb = grade_get_course_grades($course->id, $user->id);
        if (isset($resultkrb->grades[$user->id])) {
            $grd = $resultkrb->grades[$user->id];
            return $grd->str_grade;
        }

        return "";
    }

    /**
     * Function get_table_grade
     *
     * @param $course
     * @param $user
     * @return string
     * @throws Exception
     */
    private static function get_table_grade($course, $user) {

        $items = grade_item::fetch_all(["courseid" => $course->id]);
        if (empty($items)) {
            return "";
        }

        // Sorting grade itens by sortorder.
        usort($items, function ($a, $b) {
            $asortorder = $a->sortorder;
            $bsortorder = $b->sortorder;
            if ($asortorder == $bsortorder) {
                return 0;
            }
            return ($asortorder < $bsortorder) ? -1 : 1;
        });

        $retval = "<table>";
        foreach ($items as $id => $item) {
            // Do not include grades for course itens.
            if ($item->itemtype != "mod") {
                continue;
            }
            $cm = get_coursemodule_from_instance($item->itemmodule, $item->iteminstance);
            $usergrade = self::get_mod_grade($cm, $course, $user);

            $retval .= "
                    <tr>
                        <th style=\"text-align: right;\">{$item->itemname}:</th>
                        <td>{$usergrade}</td>
                    </tr>";
        }
        $retval .= "</table>";
        return $retval;
    }

    /**
     * Function get_mod_grade
     *
     * @param $cm
     * @param $course
     * @param $user
     * @return string
     * @throws Exception
     */
    private static function get_mod_grade($cm, $course, $user) {
        global $DB;

        $module = $DB->get_record("modules", ["id" => $cm->module]);
        $gradeitem = grade_get_grades($course->id, "mod", $module->name, $cm->instance, $user->id);
        if ($gradeitem) {
            $item = new grade_item();
            $itemproperties = reset($gradeitem->items);
            foreach ($itemproperties as $key => $value) {
                @$item->$key = $value;
            }
            $grade = $item->grades[$user->id]->grade;
            $item->gradetype = GRADE_TYPE_VALUE;
            $item->courseid = $course->id;

            return grade_format_gradevalue($grade, $item, true, null, $decimals = 2);
        }

        return "";
    }
}
