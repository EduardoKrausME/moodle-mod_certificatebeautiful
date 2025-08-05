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
 * Class site
 *
 * @package   certificatebeautifuldatainfo_site
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace certificatebeautifuldatainfo_site\datainfo;

use Exception;
use mod_certificatebeautiful\datainfo\help_base;

/**
 * Class site
 *
 * @package certificatebeautifuldatainfo_site
 */
class site extends help_base {

    /**
     * CLASS_NAME value
     */
    const CLASS_NAME = "site";

    /**
     * Function table_structure
     *
     * @return array
     * @throws Exception
     */
    public static function table_structure() {
        return [
            ["key" => "fullname", "label" => get_string("fullname", "certificatebeautifuldatainfo_site")],
            ["key" => "shortname", "label" => get_string("shortname", "certificatebeautifuldatainfo_site")],
            ["key" => "summary", "label" => get_string("summary", "certificatebeautifuldatainfo_site")],
        ];
    }

    /**
     * Function get_data
     *
     * @param $course
     * @param $user
     * @return array
     * @throws Exception
     */
    public static function get_data($course, $user) {
        global $SITE;

        return self::base_get_data(self::table_structure(), $SITE);
    }
}
