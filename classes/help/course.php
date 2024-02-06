<?php
/**
 * User: Eduardo Kraus
 * Date: 11/01/2024
 * Time: 12:24
 */

namespace mod_certificatebeautiful\help;


class course extends help_base {
    /**
     * @return array
     * @throws \coding_exception
     */
    public static function table_structure() {
        return [
            ['key' => 'id', 'label' => get_string('help_course_id', 'certificatebeautiful')],
            ['key' => 'category', 'label' => get_string('help_course_category', 'certificatebeautiful')],
            ['key' => 'fullname', 'label' => get_string('help_course_fullname', 'certificatebeautiful')],
            ['key' => 'shortname', 'label' => get_string('help_course_shortname', 'certificatebeautiful')],
            ['key' => 'summary', 'label' => get_string('help_course_summary', 'certificatebeautiful')],
            ['key' => 'startdate', 'label' => get_string('help_course_startdate', 'certificatebeautiful')],
            ['key' => 'enddate', 'label' => get_string('help_course_enddate', 'certificatebeautiful')],
            ['key' => 'lang', 'label' => get_string('help_course_lang', 'certificatebeautiful')],
        ];
    }

    /**
     * @param $course
     * @return array
     * @throws \coding_exception
     */
    public static function get_data($course) {
       return self::_get_data(self::table_structure(), $course);
    }

}
