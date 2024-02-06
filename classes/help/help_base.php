<?php
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
    protected static function _get_data($fields, $data) {
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
            $html = str_replace(
                "{\${$class}->{$key}}",
                $field,
                $html);
        }


        return $html;
    }
}