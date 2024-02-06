<?php
/**
 * User: Eduardo Kraus
 * Date: 11/01/2024
 * Time: 13:00
 */

namespace mod_certificatebeautiful\help;


use context_course;

class teachers extends help_base {
    /**
     * @return array
     * @throws \coding_exception
     */
    public static function table_structure() {
        return [
            ['key' => 'teacher1', 'label' => get_string('help_teachers_teacher1', 'certificatebeautiful')],
            ['key' => 'teacher2', 'label' => get_string('help_teachers_teacher2', 'certificatebeautiful')],
            ['key' => 'teacherall', 'label' => get_string('help_teachers_teacherall', 'certificatebeautiful')],
        ];
    }

    /**
     * @param $course
     * @return array
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function get_data($course) {
        $teachers = self::get_teachers($course);

        $data = [
            'teacher1' => '',
            'teacher2' => '',
            'teacherall' => '',
        ];

        if (isset($teachers[0])) {
            $data['teacher1'] = $teachers[0];
            $data['teacher2'] = $teachers[0];
            if (isset($teachers[1])) {
                $data['teacher2'] = "{$teachers[0]}<br>{$teachers[1]}";
            }

            $data['teacherall'] = implode("<br>", $teachers);
        }

        return $data;
    }

    /**
     * @param $course
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
            $role = $DB->get_record('role', ['id' => $roleid]);
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