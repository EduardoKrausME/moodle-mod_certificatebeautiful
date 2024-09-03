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
 * mod_form file
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once("{$CFG->dirroot}/course/moodleform_mod.php");

use mod_certificatebeautiful\local\help\help_base;
use mod_certificatebeautiful\local\models;

/**
 * Class mod_certificatebeautiful_mod_form
 */
class mod_certificatebeautiful_mod_form extends moodleform_mod {

    /**
     * Defines forms elements
     * @throws coding_exception
     * @throws moodle_exception
     */
    public function definition(): void {
        global $CFG;

        $mform = $this->_form;
        $mform->addElement('header', 'general', get_string('general', 'form'));

        $mform->addElement('text', 'name', get_string('name'), ['size' => '64']);
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }

        $this->standard_intro_elements();

        $mform->addElement('textarea', 'description', get_string('certificate_description', 'certificatebeautiful'));
        $mform->addRule('description', null, 'required', null, 'client');
        $mform->setDefault('description', get_string('default-description', 'certificatebeautiful'));
        $mform->addHelpButton('description', 'certificate_description', 'certificatebeautiful');

        $mform->addElement('static', 'manage_models', '', help_base::get_form_components());

        $mform->addElement('select', 'model', get_string('select_the_model', 'certificatebeautiful'), models::list_all());

        $text = get_string('manage_models', 'certificatebeautiful');
        $link = "<a class='btn btn-success' href='{$CFG->wwwroot}/mod/certificatebeautiful/manage-model-list.php'
                    target='_blank'>{$text}</a>";
        $mform->addElement('static', 'manage_models', '', $link);

        // Add standard elements.
        $this->standard_coursemodule_elements();

        // Add standard buttons.
        $this->add_action_buttons();
    }

    /**
     * Enforce validation rules here
     *
     * @param array $data array of ("fieldname"=>value) of submitted data
     * @param array $files array of uploaded files "element_name"=>tmp_file_path
     * @return array
     **/
    public function validation($data, $files) {
        $errors = parent::validation($data, $files);

        return $errors;
    }
}
