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
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @date        11/01/2024 13:08
 */

namespace mod_certificatebeautiful\local\help;

class user_profile extends help_base {

    CONST CLASS_NAME = "userprofile";

    /**
     * @return array
     *
     * @throws \dml_exception
     */
    public static function table_structure() {
        global $DB;

        $itens = [];

        $userinfofields = $DB->get_records('user_info_field');
        if ($userinfofields) {
            foreach ($userinfofields as $userinfofield) {
                $itens[] = [
                    ['key' => $userinfofield->shortname, 'label' => $userinfofield->name]
                ];
            }
        }

        return $itens;
    }

    /**
     * @param $user
     *
     * @return array
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function get_data($user) {
        global $CFG, $DB;

        $userinfofields = $DB->get_records('user_info_field');
        if ($userinfofields) {
            $data = [];
            foreach ($userinfofields as $userinfofield) {
                require_once("{$CFG->dirroot}/user/profile/field/{$userinfofield->datatype}/field.class.php" );
                $newfield = 'profile_field_' . $userinfofield->datatype;

                /** @var \profile_field_base $formfield */
                $formfield = new $newfield($userinfofield->id, $user->id);
                if ($formfield->is_visible() && !$formfield->is_empty()) {
                    if ($userinfofield->datatype == 'checkbox') {
                        $data[$userinfofield->shortname] = $formfield->data == 1 ? get_string('yes') : get_string('no');
                    } else {
                        $data[$userinfofield->shortname] = $formfield->display_data();
                    }
                }
            }
            return $data;
        }

        return [];
    }
}
