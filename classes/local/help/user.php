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
 * @package     mod_certificatebeautiful
 * @category    backup
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @date        11/01/2024 12:31
 */

namespace mod_certificatebeautiful\local\help;

class user extends help_base {

    CONST CLASS_NAME = "user";

    /**
     * @return array
     *
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
     * @param \stdClass $user
     *
     * @return array
     *
     * @throws \coding_exception
     */
    public static function get_data($user) {
        $newuser = self::base_get_data(self::table_structure(), $user);
        $newuser['fullname'] = ucfirst(strtolower(fullname($user)));

        return $newuser;
    }
}
