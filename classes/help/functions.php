<?php
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
        // {{userdate(now)}}

        functions::$user = $user;

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
                // return '<pre>' . print_r($matches, 1) . '</pre>';
                // return '<pre>' . print_r($functions, 1) . '</pre>';
                switch ($matches['function']) {
                    case 'userdate':
                        if (isset($functions['p3'])) {
                            return userdate($functions['p1'], get_string($functions['p2'], 'langconfig'), $functions['p3']);
                        } else if (isset($functions['p2'])) {
                            return userdate($functions['p1'], get_string($functions['p2'], 'langconfig'), functions::$user->timezone);
                        } else if (isset($functions['p1'])) {
                            return userdate($functions['p1'], get_string('strftimedaydate', 'langconfig'), functions::$user->timezone);
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