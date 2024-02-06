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
 * User: Eduardo Kraus
 * Date: 11/01/2024
 * Time: 12:39
 */

namespace mod_certificatebeautiful\help;

use grade_grade;
use grade_item;

class grade extends help_base {
    /**
     * @return array
     * @throws \coding_exception
     */
    public static function table_structure() {
        return [
            ['key' => 'finalgrade', 'label' => get_string('help_grade_finalgrade', 'certificatebeautiful')],
            ['key' => 'table', 'label' => get_string('help_grade_table', 'certificatebeautiful')],
        ];
    }

    /**
     * @param $course
     * @param $user
     * @return array
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function get_data($course, $user) {
        return [
            // 'finalgrade' => self::get_grade($course, $user),
            // 'table' => self::get_table_grade($course, $user),
        ];
    }

    /**
     * @param $course
     * @param $user
     * @return string
     */
    private static function get_grade($course, $user) {
        $courseitem = grade_item::fetch_course_item($course->id);
        if ($courseitem) {
            $grade = new grade_grade(array('itemid' => $courseitem->id, 'userid' => $user->id));
            $courseitem->gradetype = GRADE_TYPE_VALUE;
            $decimals = $courseitem->get_decimals();

            // If no decimals is set get the default decimals.
            if (empty($decimals)) {
                $decimals = 2;
            }

            return grade_format_gradevalue($grade->finalgrade, $courseitem, true, null, $decimals);
        }

        return "";
    }

    /**
     * @param $course
     * @param $userid
     * @return string
     * @throws \coding_exception
     * @throws \dml_exception
     */
    private static function get_table_grade($course, $user) {

        $items = grade_item::fetch_all(['courseid' => $course->id]);
        if (empty($items)) {
            return '';
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

        $retval = '';
        foreach ($items as $id => $item) {
            // Do not include grades for course itens.
            if ($item->itemtype != 'mod') {
                continue;
            }
            $cm = get_coursemodule_from_instance($item->itemmodule, $item->iteminstance);
            $usergrade = self::get_mod_grade($cm, $course, $user);
            $retval = $item->itemname . ": $usergrade<br>" . $retval;
        }
        return $retval;
    }

    /**
     * @param $cm
     * @param $course
     * @param $user
     * @return string
     * @throws \dml_exception
     */
    private static function get_mod_grade($cm, $course, $user) {
        global $DB;

        $module = $DB->get_record('modules', ['id' => $cm->module]);
        $gradeitem = grade_get_grades($course->id, 'mod', $module->name, $cm->instance, $user->id);
        if ($gradeitem) {
            $item = new grade_item();
            $itemproperties = reset($gradeitem->items);
            foreach ($itemproperties as $key => $value) {
                $item->$key = $value;
            }
            $grade = $item->grades[$user->id]->grade;
            $item->gradetype = GRADE_TYPE_VALUE;
            $item->courseid = $course->id;

            return grade_format_gradevalue($grade, $item, true, null, $decimals = 2);
        }

        return "";
    }
}
