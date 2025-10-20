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
 * Class functions
 *
 * @package   certificatebeautifuldatainfo_functions
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace certificatebeautifuldatainfo_functions\datainfo;

use Exception;
use stdClass;

/**
 * Class functions
 *
 * @package certificatebeautifuldatainfo_functions
 */
class functions {

    /**
     * CLASS_NAME value
     */
    const CLASS_NAME = "";

    /**
     * Function table_structure
     *
     * @return array
     * @throws Exception
     */
    public static function table_structure() {
        return [
            [
                "key" => "{{time()}}",
                "drag" => "{{time()}}",
                "label" => get_string("time", "certificatebeautifuldatainfo_functions"),
            ],
            [
                "key" => "{{userdate(xx,yy)}}",
                "drag" => "{{userdate(time(),strftimedate)}}",
                "label" => get_string("userdate", "certificatebeautifuldatainfo_functions"),
            ],
        ];
    }

    /**
     * Function replace
     *
     * @param string $html
     * @param object $user
     * @return null|string|string[]
     * @throws Exception
     */
    public static function replace($html, $user) {
        self::$user = $user;

        $html = str_replace('{{time()}}', time(), $html);

        $pattern = '/\{\{userdate\(\s*(\d+)\s*(?:,\s*([^)}]+?)\s*)?\)\}\}/u';
        $html = preg_replace_callback($pattern, function ($m) {
            $numero = (int)$m[1];
            if (isset($m[2]) && $m[2] !== '') {
                return userdate($numero, $m[2]);
            }
            return userdate($numero);
        }, $html);

        return $html;
    }

    /**
     * Var user
     *
     * @var stdClass
     */
    public static $user;
}
