<?php
/**
 * User: Eduardo Kraus
 * Date: 11/01/2024
 * Time: 12:24
 */

namespace mod_certificatebeautiful\help;


class site extends help_base {
    /**
     * @return array
     * @throws \coding_exception
     */
    public static function table_structure() {
        return [
            ['key' => 'fullname', 'label' => get_string('help_site_fullname', 'certificatebeautiful')],
            ['key' => 'shortname', 'label' => get_string('help_site_shortname', 'certificatebeautiful')],
            ['key' => 'summary', 'label' => get_string('help_site_summary', 'certificatebeautiful')],
        ];
    }

    /**
     * @param $course
     * @return array
     * @throws \coding_exception
     */
    public static function get_data() {
        global $SITE;

       return self::_get_data(self::table_structure(), $SITE);
    }
}
