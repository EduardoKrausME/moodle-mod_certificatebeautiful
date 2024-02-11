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
 * Date: 10/02/2024
 * Time: 02:22
 */

namespace mod_certificatebeautiful\report;

require_once($CFG->libdir . '/formslib.php');

class validate_certificate_form extends \moodleform {

    public function __construct($action = null, $customdata = null, $method = 'post', $target = '',
                                $attributes = null, $editable = true, $ajaxformdata = null) {
        parent::__construct($action, $customdata, 'post', '', ['class' => 'bg-light m-3 p-3']);
    }

    public function definition() {
        $this->_form->addElement('text', 'code', get_string('validate_certificate_code', 'certificatebeautiful'));
        $this->_form->addRule('code', null, 'required', null, 'client');
        $this->_form->setType('code', PARAM_TEXT);

        $this->_form->addElement('submit', 'verify', get_string('validate_certificate_submit', 'certificatebeautiful'));
    }
}