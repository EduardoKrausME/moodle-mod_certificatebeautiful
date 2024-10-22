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
 * Class help_base
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\local\help;

/**
 * Class help_base
 *
 * @package mod_certificatebeautiful\local\help
 */
class help_base {

    /**
     * Function help_text
     *
     * @param array $fields
     *
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
     * Function base_get_data
     *
     * @param array $fields
     * @param \stdClass $data
     *
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
     * Function replace
     *
     * @param string $html
     * @param string $classname
     * @param array $fields
     *
     * @return mixed
     */
    public static function replace($html, $classname, $fields) {
        foreach ($fields as $key => $field) {
            $html = str_ireplace(
                "{\${$classname}->{$key}}",
                $field,
                $html);
        }

        return $html;
    }

    /**
     * Function get_editor_components
     *
     * @return string
     * @throws \coding_exception
     */
    public static function get_editor_components() {

        $classnames = [
            "course",
            "user_profile",
            "teachers",
            "certificate_issue",
            "site",
            "functions",
            "course_categories",
            "enrolments",
            "user",
            "grade",
        ];

        $components = [];
        foreach ($classnames as $classname) {

            /** @var course $class */
            $class = "\mod_certificatebeautiful\local\help\\" . $classname;
            $classsnameup = strtoupper($class::CLASS_NAME);
            $classstitle = get_string("help_{$classname}__name", 'certificatebeautiful');

            foreach ($class::table_structure() as $structure) {
                $label = strip_tags($structure['label']);
                $label = str_replace("'", "\\'", $label);

                if (strpos($structure['key'], "}")) {
                    $key = $structure['key'];
                } else {
                    $key = "{\${$classsnameup}->{$structure['key']}}";
                }

                $components[] = "
                    editor.BlockManager.add('{$classname}_{$structure['key']}', {
                        label    : '{$label}',
                        content  : {
                            components : `<div data-gjs-type=\"text\"
                                               draggable=\"false\"
                                               data-gjs-copyable=\"false\"
                                               data-gjs-draggable=\"false\"
                                               data-gjs-editable=\"false\">{\${$classsnameup}->{$structure['key']}}</div>`,
                            droppable  : ['section'],
                        },
                        media    : '{$key}',
                        category : \"{$classstitle}\",
                    });";
            }
        }

        return implode("\n", $components);
    }

    /**
     * Function get_form_components
     *
     * @return mixed
     * @throws \coding_exception
     */
    public static function get_form_components() {
        global $OUTPUT;

        $classnames = [
            "course",
            "user_profile",
            "teachers",
            "certificate_issue",
            "site",
            "functions",
            "course_categories",
            "enrolments",
            "user",
            "grade",
        ];

        $data = ['itens' => []];
        foreach ($classnames as $classname) {

            /** @var course $class */
            $class = "\mod_certificatebeautiful\local\help\\" . $classname;
            $classsnameup = strtoupper($class::CLASS_NAME);

            $structuresitens = [];
            foreach ($class::table_structure() as $structure) {
                if (isset($structure['label'])) {
                    $label = $structure['label'];

                    if (strpos($structure['key'], "}")) {
                        $key = $structure['key'];
                    } else {
                        $key = "{\${$classsnameup}->{$structure['key']}}";
                    }

                    $structuresitens[] = [
                        'label' => $label,
                        'key' => $key,
                    ];
                }
            }

            if ($structuresitens) {
                $data['itens'][] = [
                    'classstitle' => get_string("help_{$classname}__name", 'certificatebeautiful'),
                    'structuresitens' => $structuresitens,
                ];
            }
        }

        return $OUTPUT->render_from_template('mod_certificatebeautiful/form_components', $data);
    }
}
