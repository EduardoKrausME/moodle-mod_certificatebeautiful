<?php
/**
 * User: Eduardo Kraus
 * Date: 12/01/2024
 * Time: 18:38
 */

namespace mod_certificatebeautiful\help;


class certificate extends help_base {
    /**
     * @return array
     * @throws \coding_exception
     */
    public static function table_structure() {
        return [
            ['key' => 'name', 'label' => get_string('help_certificate_name', 'certificatebeautiful')],
            ['key' => 'issue_timecreated', 'label' => get_string('help_certificate_issue_timecreated', 'certificatebeautiful')],
            ['key' => 'issue_code', 'label' => get_string('help_certificate_issue_code', 'certificatebeautiful')],
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