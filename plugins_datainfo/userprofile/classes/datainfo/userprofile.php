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
 * Class userprofile
 *
 * @package   certificatebeautifuldatainfo_userprofile
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace certificatebeautifuldatainfo_userprofile\datainfo;

use mod_certificatebeautiful\datainfo\help_base;

/**
 * Class userprofile
 *
 * @package certificatebeautifuldatainfo_userprofile
 */
class userprofile extends help_base {

    /**
     * CLASS_NAME value
     */
    const CLASS_NAME = "userprofile";

    /**
     * Function table_structure
     *
     * @return array
     * @throws \dml_exception
     */
    public static function table_structure() {
        global $DB;

        $itens = [];

        $userinfofields = $DB->get_records("user_info_field");
        if ($userinfofields) {
            foreach ($userinfofields as $userinfofield) {
                switch ($userinfofield->datatype) {
                    case "text":
                    case "textarea":
                    case "checkbox":
                    case "menu":
                    case "datetime":
                    case "url":
                    case "database":
                        $itens[] = [
                            "key" => $userinfofield->shortname,
                            "label" => $userinfofield->name,
                        ];
                }
            }
        }

        return $itens;
    }

    /**
     * Function get_data
     *
     * @param $course
     * @param $user
     *
     * @return array
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function get_data($course, $user) {
        global $CFG, $DB;

        $userinfofields = $DB->get_records("user_info_field");
        if ($userinfofields) {
            $data = [];
            foreach ($userinfofields as $userinfofield) {
                require_once("{$CFG->dirroot}/user/profile/field/{$userinfofield->datatype}/field.class.php");
                $newfield = "profile_field_" . $userinfofield->datatype;

                /** @var \profile_field_base $formfield */
                $formfield = new $newfield($userinfofield->id, $user->id);
                if ($formfield->is_visible() && !$formfield->is_empty()) {

                    $displaydata = "";
                    switch ($userinfofield->datatype) {
                        case "checkbox":
                            $displaydata = $formfield->data == 1 ? get_string("yes") : get_string("no");
                            break;
                        case "database":
                            $displaydata = $formfield->display_data();
                            $displaydata = preg_replace('/style=".*?"/', "", $displaydata);
                            break;
                        case "text":
                        case "textarea":
                        case "menu":
                        case "datetime":
                        case "url":
                            $displaydata = $formfield->display_data();
                            break;
                    }

                    $data[$userinfofield->shortname] = $displaydata;
                }
            }
            return $data;
        }

        return [];
    }
}
