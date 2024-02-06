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
 * User: Eduardo Kraus
 * Date: 11/01/2024
 * Time: 15:48
 */

namespace mod_certificatebeautiful\help;

class functions {
    /**
     * @return array
     * @throws \coding_exception
     */
    public static function table_structure() {
        return [
            ['key' => 'date', 'label' => get_string('help_functions_date', 'certificatebeautiful')],
            ['key' => 'userdate', 'label' => get_string('help_functions_userdate', 'certificatebeautiful')],
            ['key' => 'time', 'label' => get_string('help_functions_time', 'certificatebeautiful')],
        ];
    }

    /**
     * @param string $html
     * @return string
     */
    public static function replace($html, $user) {

        self::$user = $user;

        $html = preg_replace_callback('/{{(?<function>userdate|date)\((?<parameters>.*?)}}/',
            function ($matches) {

                if (strpos($matches['parameters'], ",")) {
                    preg_match('/(?<p1>.*?[,\)])(?<p2>.*?[,\)])?(?<p3>.*?[,\)])?/', $matches['parameters'], $functions);
                    foreach ($functions as $key => $function) {
                        $function = str_replace(',', '', $function);
                        $function = str_replace(')', '', $function);
                        $functions[$key] = trim($function);
                    }
                } else {
                    $functions = ['p1' => $matches['parameters']];
                }
                switch ($matches['function']) {
                    case 'userdate':
                        if (isset($functions['p3'])) {
                            return userdate($functions['p1'], get_string($functions['p2'], 'langconfig'), $functions['p3']);
                        } else if (isset($functions['p2'])) {
                            return userdate($functions['p1'], get_string($functions['p2'], 'langconfig'), self::$user->timezone);
                        } else if (isset($functions['p1'])) {
                            return userdate($functions['p1'], get_string('strftimedaydate', 'langconfig'), self::$user->timezone);
                        }
                        break;
                    case 'date':
                        if (isset($functions['p2'])) {
                            return date($functions['p1'], $functions['p2']);
                        } else if (isset($functions['p1'])) {
                            return date($functions['p1']);
                        }
                        break;
                }

            }, $html);

        return $html;
    }

    public static $user;
}
