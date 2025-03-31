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
 * Class user
 *
 * @package   certificatebeautifuldatainfo_user
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace certificatebeautifuldatainfo_user\datainfo;

use mod_certificatebeautiful\datainfo\help_base;

/**
 * Class user
 *
 * @package certificatebeautifuldatainfo_user
 */
class user extends help_base {

    /**
     * CLASS_NAME value
     */
    const CLASS_NAME = "user";


    /**
     * Function table_structure
     *
     * @return array
     * @throws \coding_exception
     */
    public static function table_structure() {
        return [
            ["key" => "id", "label" => get_string("id", "certificatebeautifuldatainfo_user")],
            ["key" => "username", "label" => get_string("username", "certificatebeautifuldatainfo_user")],
            ["key" => "idnumber", "label" => get_string("idnumber", "certificatebeautifuldatainfo_user")],
            ["key" => "firstname", "label" => get_string("firstname", "certificatebeautifuldatainfo_user")],
            ["key" => "lastname", "label" => get_string("lastname", "certificatebeautifuldatainfo_user")],
            ["key" => "middlename", "label" => get_string("middlename", "certificatebeautifuldatainfo_user")],
            ["key" => "alternatename", "label" => get_string("alternatename", "certificatebeautifuldatainfo_user")],
            ["key" => "fullname", "label" => get_string("fullname", "certificatebeautifuldatainfo_user")],
            ["key" => "email", "label" => get_string("email", "certificatebeautifuldatainfo_user")],
            ["key" => "phone1", "label" => get_string("phone1", "certificatebeautifuldatainfo_user")],
            ["key" => "phone2", "label" => get_string("phone2", "certificatebeautifuldatainfo_user")],
            ["key" => "institution", "label" => get_string("institution", "certificatebeautifuldatainfo_user")],
            ["key" => "department", "label" => get_string("department", "certificatebeautifuldatainfo_user")],
            ["key" => "address", "label" => get_string("address", "certificatebeautifuldatainfo_user")],
            ["key" => "city", "label" => get_string("city", "certificatebeautifuldatainfo_user")],
            ["key" => "country", "label" => get_string("country", "certificatebeautifuldatainfo_user")],
            ["key" => "lang", "label" => get_string("lang", "certificatebeautifuldatainfo_user")],
            ["key" => "calendartype", "label" => get_string("calendartype", "certificatebeautifuldatainfo_user")],
            ["key" => "timezone", "label" => get_string("timezone", "certificatebeautifuldatainfo_user")],
            ["key" => "firstaccess", "label" => get_string("firstaccess", "certificatebeautifuldatainfo_user")],
            ["key" => "lastaccess", "label" => get_string("lastaccess", "certificatebeautifuldatainfo_user")],
            ["key" => "lastlogin", "label" => get_string("lastlogin", "certificatebeautifuldatainfo_user")],
            ["key" => "currentlogin", "label" => get_string("currentlogin", "certificatebeautifuldatainfo_user")],
            ["key" => "lastip", "label" => get_string("lastip", "certificatebeautifuldatainfo_user")],
            ["key" => "description", "label" => get_string("description", "certificatebeautifuldatainfo_user")],
            ["key" => "timecreated", "label" => get_string("timecreated", "certificatebeautifuldatainfo_user")],
            ["key" => "timemodified", "label" => get_string("timemodified", "certificatebeautifuldatainfo_user")],
        ];
    }

    /**
     * Function get_data
     *
     * @param $course
     * @param $user
     *
     * @return array
     * @throws \coding_exception
     */
    public static function get_data($course, $user) {
        $newuser = self::base_get_data(self::table_structure(), $user);
        $newuser["fullname"] = fullname($user);

        return $newuser;
    }
}
