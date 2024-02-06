<?php
/**
 * User: Eduardo Kraus
 * Date: 11/01/2024
 * Time: 13:08
 */

namespace mod_certificatebeautiful\help;


class user_profile extends help_base {
    /**
     * @return array
     * @throws \coding_exception
     */
    public static function table_structure() {
        return [
            ['key' => 'NAME', 'label' => get_string('help_user_profile', 'certificatebeautiful')],
        ];
    }

    /**
     * @param $user
     * @return array
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function get_data($user) {
        global $CFG, $DB;

        $user_info_fields = $DB->get_records('user_info_field');
        if ($user_info_fields) {
            $data = [];
            foreach ($user_info_fields as $user_info_field) {
                require_once($CFG->dirroot . '/user/profile/field/' . $user_info_field->datatype . '/field.class.php');
                $newfield = 'profile_field_' . $user_info_field->datatype;

                /** @var \profile_field_base $formfield */
                $formfield = new $newfield($user_info_field->id, $user->id);
                if ($formfield->is_visible() && !$formfield->is_empty()) {
                    if ($user_info_field->datatype == 'checkbox') {
                        $data[$user_info_field->shortname] = $formfield->data == 1 ? get_string('yes') : get_string('no');
                    } else {
                        $data[$user_info_field->shortname] = $formfield->display_data();
                    }
                }
            }
            return $data;
        }

        return [];
    }
}