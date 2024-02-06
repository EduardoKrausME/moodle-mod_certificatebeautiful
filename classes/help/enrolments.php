<?php
/**
 * User: Eduardo Kraus
 * Date: 11/01/2024
 * Time: 13:04
 */

namespace mod_certificatebeautiful\help;


class enrolments extends help_base {
    /**
     * @return array
     * @throws \coding_exception
     */
    public static function table_structure() {
        return [
            ['key' => 'timestart', 'label' => get_string('help_enrolments_timestart', 'certificatebeautiful')],
        ];
    }

    /**
     * @param $user
     * @param $course
     * @return array
     * @throws \dml_exception
     */
    public static function get_data($course, $user) {
        global $DB;

        $sql = "SELECT ue.timestart
                  FROM {user_enrolments} ue
                  JOIN {enrol}            e ON e.id = ue.enrolid
                 WHERE e.status   = 0 
                   AND ue.userid  = :userid
                   AND e.courseid = :courseid";
        $params = ['userid' => $user->id, 'courseid' => $course->id];

        return [
            'timestart' => $DB->get_field_sql($sql, $params)
        ];
    }
}