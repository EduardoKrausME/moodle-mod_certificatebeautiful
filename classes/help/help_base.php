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
 * Time: 13:49
 */

namespace mod_certificatebeautiful\help;

class help_base {

    /**
     * @param $fields
     * @return string
     */
    public static function help_text($fields) {

        $help = "<ul>";
        foreach ($fields as $field) {
            $help .= "<li><strong>{$field['key']}</strong>: {$field['label']}</li>";
        }

        $help .= "</ul>";

        return $help;
    }

    /**
     * @param $fields
     * @param $data
     * @return array
     */
    protected static function base_get_data($fields, $data) {
        $data = json_decode(json_encode($data), true);

        $returndata = [];
        foreach ($fields as $field) {
            if (isset($data[$field['key']])) {
                $returndata[$field['key']] = $data[$field['key']];
            } else {
                $returndata[$field['key']] = "";
            }
        }

        return $returndata;
    }

    /**
     * @param string $html
     * @param string $key
     * @param array $fields
     * @return string
     */
    public static function replace($html, $class, $fields) {
        foreach ($fields as $key => $field) {
            $html = str_ireplace(
                "{\${$class}->{$key}}",
                $field,
                $html);
        }

        return $html;
    }

    /**
     * @throws \coding_exception
     */
    public static function get_editor_components() {

        $helps = [
            course::class,
            user_profile::class,
            teachers::class,
            certificate::class,
            site::class,
            functions::class,
            course_categories::class,
            enrolments::class,
            user::class,
            grade::class
        ];

        $components = [];
        /** @var course $help */
        foreach ($helps as $help) {

            $classsname = str_replace('mod_certificatebeautiful\help\\', "", $help);
            $classsnameup = strtoupper($classsname);
            $classstitle = get_string("help_{$classsname}__name", 'certificatebeautiful');

            foreach ($help::table_structure() as $table_structure) {
                $label = $table_structure['label'];
                $label = str_replace("'", "\\'", $label);

                $components[] = "
                    editor.BlockManager.add('{$classsname}_{$table_structure['key']}', {
                        label    : '{$label}',
                        content  : {
                            components : `<div data-gjs-type=\"text\" 
                                               draggable=\"false\"
                                               data-gjs-copyable=\"false\"
                                               data-gjs-draggable=\"false\"
                                               data-gjs-editable=\"false\">{\${$classsnameup}->{$table_structure['key']}}</div>`,
                            droppable  : ['section'],
                        },
                        media    : '{\${$classsnameup}->{$table_structure['key']}}',
                        category : \"{$classstitle}\",
                    });";
            }
        }

        return implode("\n", $components);
    }
}
