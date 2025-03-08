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
 * Class changue_cert_info
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\form;

use moodleform;

defined('MOODLE_INTERNAL') || die;

global $CFG;
require_once($CFG->dirroot . '/lib/formslib.php');
require_once($CFG->dirroot . '/user/lib.php');

/**
 * Class changue_cert_info
 *
 * @package mod_certificatebeautiful\form
 */
class changue_cert_info extends moodleform {

    /**
     * Define the form.
     */
    public function definition() {
        $mform = $this->_form;
        $editoroptions = null;
        $filemanageroptions = null;

        $mform->addElement("hidden", "id", null);
        $mform->setType("id", PARAM_ALPHANUM);
        $mform->setConstant("id", $this->_customdata["id"]);

        $mform->addElement("hidden", "page", null);
        $mform->setType("page", PARAM_ALPHANUM);
        $mform->setConstant("page", $this->_customdata["page"]);

        $mform->addElement("hidden", "action", null);
        $mform->setType("action", PARAM_ALPHANUM);
        $mform->setConstant("action", $this->_customdata["action"]);

        $mform->addElement("header", "general", get_string("general", "form"));

        $html = '<div class="alert alert-warning">' .
            get_string("select_background_image_info", "mod_certificatebeautiful") . '</div>';
        $mform->addElement("html", $html);

        $options = [
            "maxfiles" => 1,
            "subdirs" => 0,
            "accepted_types" => ['.jpg', '.png'],
        ];
        $mform->addElement("filemanager", "background", get_string("select_background_image", "mod_certificatebeautiful"),
            null, $options);

        $buttonarray = [];
        $buttonarray[] = &$mform->createElement("submit", "saveandreturn", get_string("savechangesandreturn"),
            ["class" => 'form-submit']);
        $buttonarray[] = &$mform->createElement("cancel");

        $mform->addGroup($buttonarray, "buttonar", "", [' '], false);
        $mform->closeHeaderBefore("buttonar");

        $this->set_data([]);
    }
}
