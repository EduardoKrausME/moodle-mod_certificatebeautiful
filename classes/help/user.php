<?php
/**
 * User: Eduardo Kraus
 * Date: 11/01/2024
 * Time: 12:31
 */

namespace mod_certificatebeautiful\help;


class user extends help_base {
    /**
     * @return array
     * @throws \coding_exception
     */
    public static function table_structure() {
        return [
            ['key' => 'id', 'label' => get_string('help_user_id', 'certificatebeautiful')],
            ['key' => 'username', 'label' => get_string('help_user_username', 'certificatebeautiful')],
            ['key' => 'idnumber', 'label' => get_string('help_user_idnumber', 'certificatebeautiful')],
            ['key' => 'firstname', 'label' => get_string('help_user_firstname', 'certificatebeautiful')],
            ['key' => 'lastname', 'label' => get_string('help_user_lastname', 'certificatebeautiful')],
            ['key' => 'middlename', 'label' => get_string('help_user_middlename', 'certificatebeautiful')],
            ['key' => 'alternatename', 'label' => get_string('help_user_alternatename', 'certificatebeautiful')],
            ['key' => 'fullname', 'label' => get_string('help_user_fullname', 'certificatebeautiful')],
            ['key' => 'email', 'label' => get_string('help_user_email', 'certificatebeautiful')],
            ['key' => 'phone1', 'label' => get_string('help_user_phone1', 'certificatebeautiful')],
            ['key' => 'phone2', 'label' => get_string('help_user_phone2', 'certificatebeautiful')],
            ['key' => 'institution', 'label' => get_string('help_user_institution', 'certificatebeautiful')],
            ['key' => 'department', 'label' => get_string('help_user_department', 'certificatebeautiful')],
            ['key' => 'address', 'label' => get_string('help_user_address', 'certificatebeautiful')],
            ['key' => 'city', 'label' => get_string('help_user_city', 'certificatebeautiful')],
            ['key' => 'country', 'label' => get_string('help_user_country', 'certificatebeautiful')],
            ['key' => 'lang', 'label' => get_string('help_user_lang', 'certificatebeautiful')],
            ['key' => 'calendartype', 'label' => get_string('help_user_calendartype', 'certificatebeautiful')],
            ['key' => 'timezone', 'label' => get_string('help_user_timezone', 'certificatebeautiful')],
            ['key' => 'firstaccess', 'label' => get_string('help_user_firstaccess', 'certificatebeautiful')],
            ['key' => 'lastaccess', 'label' => get_string('help_user_lastaccess', 'certificatebeautiful')],
            ['key' => 'lastlogin', 'label' => get_string('help_user_lastlogin', 'certificatebeautiful')],
            ['key' => 'currentlogin', 'label' => get_string('help_user_currentlogin', 'certificatebeautiful')],
            ['key' => 'lastip', 'label' => get_string('help_user_lastip', 'certificatebeautiful')],
            ['key' => 'description', 'label' => get_string('help_user_description', 'certificatebeautiful')],
            ['key' => 'timecreated', 'label' => get_string('help_user_timecreated', 'certificatebeautiful')],
            ['key' => 'timemodified', 'label' => get_string('help_user_timemodified', 'certificatebeautiful')],
        ];
    }

    /**
     * @param $course
     * @return array
     * @throws \coding_exception
     */
    public static function get_data($user) {
        $_user = self::_get_data(self::table_structure(), $user);
        $_user['fullname'] = fullname($user);

        return $_user;
    }
}
