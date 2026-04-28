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
 * phpcs:disable moodle.Files.MoodleInternal.MoodleInternalGlobalState
 *
 * Functions used to retrieve grades objects
 *
 * @package   mod_certificatebeautiful
 * @copyright 2026 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (file_exists("{$CFG->libdir}/grade/querylib.php")) {
    require_once("{$CFG->libdir}/grade/querylib.php");
} else if (file_exists("{$CFG->dirroot}/grade/querylib.php")) {
    require_once("{$CFG->dirroot}/grade/querylib.php");
} else {
    if (!function_exists("grade_get_course_grade")) {
        /**
         * Returns the aggregated or calculated course grade for a single user for one or more courses
         *
         * @param int $userid The ID of the single user
         * @param int|array $courseidorids Optional ID of course or array of IDs, empty means all of the user's courses
         * @return mixed grade info or grades array including item info, false if error
         * @throws coding_exception
         * @throws moodle_exception
         */
        function grade_get_course_grade($userid, $courseidorids = null) {
            if (!is_array($courseidorids)) {
                if (empty($courseidorids)) {
                    if (!$courses = enrol_get_users_courses($userid)) {
                        return false;
                    }
                    $courseids = array_keys($courses);
                    return grade_get_course_grade($userid, $courseids);
                }
                if (!is_numeric($courseidorids)) {
                    return false;
                }
                if (!$grades = grade_get_course_grade($userid, [$courseidorids])) {
                    return false;
                } else {
                    // Only one grade - not array.
                    $grade = reset($grades);
                    return $grade;
                }
            }

            $courseitems = [];
            foreach ($courseidorids as $courseid) {
                $gradeitem = grade_item::fetch_course_item($courseid);
                $courseitems[$gradeitem->courseid] = $gradeitem;
            }

            $grades = [];
            foreach ($courseitems as $gradeitem) {
                if ($gradeitem->needsupdate) {
                    grade_regrade_final_grades($courseid);
                }

                $item = new stdClass();
                $item->scaleid = $gradeitem->scaleid;
                $item->name = $gradeitem->get_name();
                $item->grademin = $gradeitem->grademin;
                $item->grademax = $gradeitem->grademax;
                $item->gradepass = $gradeitem->gradepass;
                $item->locked = $gradeitem->is_locked();
                $item->hidden = $gradeitem->is_hidden();

                switch ($gradeitem->gradetype) {
                    case GRADE_TYPE_NONE:
                        break;

                    case GRADE_TYPE_VALUE:
                        $item->scaleid = 0;
                        break;

                    case GRADE_TYPE_TEXT:
                        $item->scaleid = 0;
                        $item->grademin = 0;
                        $item->grademax = 0;
                        $item->gradepass = 0;
                        break;
                }
                $gradegrade = new grade_grade(['userid' => $userid, 'itemid' => $gradeitem->id]);
                $gradegrade->grade_item =& $gradeitem;

                $grade = new stdClass();
                $grade->grade = $gradegrade->finalgrade;
                $grade->locked = $gradegrade->is_locked();
                $grade->hidden = $gradegrade->is_hidden();
                $grade->overridden = $gradegrade->overridden;
                $grade->feedback = $gradegrade->feedback;
                $grade->feedbackformat = $gradegrade->feedbackformat;
                $grade->usermodified = $gradegrade->usermodified;
                $grade->dategraded = $gradegrade->get_dategraded();
                $grade->item = $item;

                // Create text representation of grade.
                if ($gradeitem->needsupdate) {
                    $grade->grade = false;
                    $grade->str_grade = get_string('error');
                    $grade->str_long_grade = $grade->str_grade;

                } else if (is_null($grade->grade)) {
                    $grade->str_grade = '-';
                    $grade->str_long_grade = $grade->str_grade;

                } else {
                    $grade->str_grade = grade_format_gradevalue($grade->grade, $gradeitem);
                    if ($gradeitem->gradetype == GRADE_TYPE_SCALE || $gradeitem->get_displaytype() != GRADE_DISPLAY_TYPE_REAL) {
                        $grade->str_long_grade = $grade->str_grade;
                    } else {
                        $a = new stdClass();
                        $a->grade = $grade->str_grade;
                        $a->max = grade_format_gradevalue($gradeitem->grademax, $gradeitem);
                        $grade->str_long_grade = get_string('gradelong', 'grades', $a);
                    }
                }

                // Create html representation of feedback.
                if (is_null($grade->feedback)) {
                    $grade->str_feedback = '';
                } else {
                    $grade->str_feedback = format_text($grade->feedback, $grade->feedbackformat);
                }

                $grades[$gradeitem->courseid] = $grade;
            }

            return $grades;
        }
    }

    if (!function_exists("grade_get_course_grades")) {
        /**
         * Returns the aggregated or calculated course grade(s) for a single course for one or more users
         *
         * @param int $courseid The ID of course
         * @param null $useridorids Optional ID of the graded user or array of user IDs; if userid not used,
         *                          returns only information about grade_item
         * @return stdClass Returns an object containing information about course grade item. scaleid, name, grade
         *         and locked status etc and user course grades: $item->grades[$userid] => $usercoursegrade
         * @throws coding_exception
         * @throws moodle_exception
         */
        function grade_get_course_grades($courseid, $useridorids = null) {

            $gradeitem = grade_item::fetch_course_item($courseid);

            if ($gradeitem->needsupdate) {
                grade_regrade_final_grades($courseid);
            }

            $item = new stdClass();
            $item->scaleid = $gradeitem->scaleid;
            $item->name = $gradeitem->get_name();
            $item->grademin = $gradeitem->grademin;
            $item->grademax = $gradeitem->grademax;
            $item->gradepass = $gradeitem->gradepass;
            $item->locked = $gradeitem->is_locked();
            $item->hidden = $gradeitem->is_hidden();
            $item->grades = [];

            switch ($gradeitem->gradetype) {
                case GRADE_TYPE_NONE:
                    break;

                case GRADE_TYPE_VALUE:
                    $item->scaleid = 0;
                    break;

                case GRADE_TYPE_TEXT:
                    $item->scaleid = 0;
                    $item->grademin = 0;
                    $item->grademax = 0;
                    $item->gradepass = 0;
                    break;
            }

            if (empty($useridorids)) {
                $userids = [];

            } else if (is_array($useridorids)) {
                $userids = $useridorids;

            } else {
                $userids = [$useridorids];
            }

            if ($userids) {
                $gradegrades = grade_grade::fetch_users_grades($gradeitem, $userids);
                foreach ($userids as $userid) {
                    $gradegrades[$userid]->grade_item =& $gradeitem;

                    $grade = new stdClass();
                    $grade->grade = $gradegrades[$userid]->finalgrade;
                    $grade->locked = $gradegrades[$userid]->is_locked();
                    $grade->hidden = $gradegrades[$userid]->is_hidden();
                    $grade->overridden = $gradegrades[$userid]->overridden;
                    $grade->feedback = $gradegrades[$userid]->feedback;
                    $grade->feedbackformat = $gradegrades[$userid]->feedbackformat;
                    $grade->usermodified = $gradegrades[$userid]->usermodified;
                    $grade->dategraded = $gradegrades[$userid]->get_dategraded();
                    $grade->datesubmitted = $gradegrades[$userid]->get_datesubmitted();

                    // Create text representation of grade.
                    if ($gradeitem->needsupdate) {
                        $grade->grade = false;
                        $grade->str_grade = get_string('error');
                        $grade->str_long_grade = $grade->str_grade;

                    } else if (is_null($grade->grade)) {
                        $grade->str_grade = '-';
                        $grade->str_long_grade = $grade->str_grade;

                    } else {
                        $grade->str_grade = grade_format_gradevalue($grade->grade, $gradeitem);
                        if ($gradeitem->gradetype == GRADE_TYPE_SCALE || $gradeitem->get_displaytype() != GRADE_DISPLAY_TYPE_REAL) {
                            $grade->str_long_grade = $grade->str_grade;
                        } else {
                            $a = new stdClass();
                            $a->grade = $grade->str_grade;
                            $a->max = grade_format_gradevalue($gradeitem->grademax, $gradeitem);
                            $grade->str_long_grade = get_string('gradelong', 'grades', $a);
                        }
                    }

                    // Create html representation of feedback.
                    if (is_null($grade->feedback)) {
                        $grade->str_feedback = '';
                    } else {
                        $grade->str_feedback = format_text($grade->feedback, $grade->feedbackformat);
                    }

                    $item->grades[$userid] = $grade;
                }
            }

            return $item;
        }
    }
}
