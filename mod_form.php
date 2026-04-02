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
 * mod_form file
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once("{$CFG->dirroot}/course/moodleform_mod.php");

use mod_certificatebeautiful\automation;
use mod_certificatebeautiful\datainfo\help_base;
use mod_certificatebeautiful\models;

/**
 * Class mod_certificatebeautiful_mod_form
 */
class mod_certificatebeautiful_mod_form extends moodleform_mod {

    /**
     * Defines forms elements
     * @throws Exception
     */
    public function definition(): void {
        global $CFG;

        $mform = $this->_form;
        $mform->addElement("header", "general", get_string("general", "form"));

        $mform->addElement("text", "name", get_string("name"), ["size" => "64"]);
        $mform->addRule("name", null, "required", null, "client");
        $mform->addRule("name", get_string("maximumchars", "", 255), "maxlength", 255, "client");
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType("name", PARAM_TEXT);
        } else {
            $mform->setType("name", PARAM_CLEANHTML);
        }

        $this->standard_intro_elements();

        $mform->addElement("textarea", "description", get_string("certificate_description", "certificatebeautiful"));
        $mform->addRule("description", null, "required", null, "client");
        $mform->setDefault("description", get_string('default-description', "certificatebeautiful"));
        $mform->addHelpButton("description", "certificate_description", "certificatebeautiful");

        $mform->addElement("static", "manage_models", "", help_base::get_form_components());

        $mform->addElement("select", "model", get_string("select_the_model", "certificatebeautiful"), models::list_all());

        $text = get_string("manage_models", "certificatebeautiful");
        $link = "<a class='btn btn-success' href='{$CFG->wwwroot}/mod/certificatebeautiful/manage-model-list.php'
                    target='_blank'>{$text}</a>";
        $mform->addElement("static", "manage_models", "", $link);

        $mform->addElement("header", "automationheader", get_string("automationheader", "certificatebeautiful"));

        $mform->addElement("advcheckbox", "autogenerate", get_string("autogenerate", "certificatebeautiful"));
        $mform->addHelpButton("autogenerate", "autogenerate", "certificatebeautiful");

        $autotriggeroptions = [
            automation::TRIGGER_NONE => get_string("none"),
            automation::TRIGGER_COURSE_COMPLETION => get_string("autotrigger_coursecompletion", "certificatebeautiful"),
            automation::TRIGGER_ACTIVITY_COMPLETION => get_string("autotrigger_activitycompletion", "certificatebeautiful"),
            automation::TRIGGER_GRADE_THRESHOLD => get_string("autotrigger_gradethreshold", "certificatebeautiful"),
        ];
        $mform->addElement("select", "autotrigger", get_string("autotrigger", "certificatebeautiful"), $autotriggeroptions);
        $mform->hideIf("autotrigger", "autogenerate", "notchecked");

        $activityoptions = [0 => get_string("choose")];
        $currentcmid = $this->current->coursemodule ?? 0;
        if (!empty($this->_course->id)) {
            $modinfo = get_fast_modinfo($this->_course);
            foreach ($modinfo->get_cms() as $coursemodule) {
                if ($coursemodule->deletioninprogress) {
                    continue;
                }
                if ((int)$coursemodule->id === (int)$currentcmid) {
                    continue;
                }

                $label = format_string($coursemodule->name) . " ({$coursemodule->modname})";
                $activityoptions[$coursemodule->id] = $label;
            }
        }
        $mform->addElement("select", "triggercmid", get_string("autotrigger_activity", "certificatebeautiful"), $activityoptions);
        $mform->hideIf("triggercmid", "autotrigger", "neq", automation::TRIGGER_ACTIVITY_COMPLETION);

        $mform->addElement("text", "gradepass", get_string("gradepass", "certificatebeautiful"));
        $mform->setType("gradepass", PARAM_RAW_TRIMMED);
        $mform->hideIf("gradepass", "autotrigger", "neq", automation::TRIGGER_GRADE_THRESHOLD);

        $mform->addElement("advcheckbox", "notifyuser", get_string("notifyuser", "certificatebeautiful"));
        $mform->hideIf("notifyuser", "autogenerate", "notchecked");

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

        if (!empty($data["autogenerate"])) {
            if (empty($data["autotrigger"])) {
                $errors["autotrigger"] = get_string("autotrigger_required", "certificatebeautiful");
            }

            if ($data["autotrigger"] === automation::TRIGGER_ACTIVITY_COMPLETION && empty($data["triggercmid"])) {
                $errors["triggercmid"] = get_string("triggercmid_required", "certificatebeautiful");
            }

            if ($data["autotrigger"] === automation::TRIGGER_GRADE_THRESHOLD) {
                if ($data["gradepass"] === "" || !is_numeric($data["gradepass"])) {
                    $errors["gradepass"] = get_string("gradepass_required", "certificatebeautiful");
                }
            }
        }

        return $errors;
    }
}
