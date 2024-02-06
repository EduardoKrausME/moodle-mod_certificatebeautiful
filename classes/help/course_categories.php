<?php
/**
 * User: Eduardo Kraus
 * Date: 11/01/2024
 * Time: 12:31
 */

namespace mod_certificatebeautiful\help;


class course_categories extends help_base {
    /**
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
     * @param $course
     * @return array
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function get_data($course) {
        global $DB;

        $course_categories = $DB->get_record('course_categories', ['id' => $course->category]);

        return self::_get_data(self::table_structure(), $course_categories);
    }
}
