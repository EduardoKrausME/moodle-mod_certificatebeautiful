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
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @date        10/02/2024 02:22
 */

namespace mod_certificatebeautiful\local\report;

defined('MOODLE_INTERNAL') || die();
require_once("{$CFG->libdir}/formslib.php");

class validate_certificate_form extends \moodleform {

    /**
     * validate_certificate_form constructor.
     *
     * @param null $action
     * @param null $customdata
     * @param string $method
     * @param string $target
     * @param null $attributes
     * @param bool $editable
     * @param null $ajaxformdata
     */
    public function __construct($action = null, $customdata = null, $method = 'post', $target = '',
                                $attributes = null, $editable = true, $ajaxformdata = null) {
        parent::__construct($action, $customdata, 'post', '', ['class' => 'bg-light m-3 p-3']);
    }

    /**
     * @throws \coding_exception
     */
    public function definition() {
        $this->_form->addElement('text', 'code', get_string('validate_certificate_code', 'certificatebeautiful'));
        $this->_form->addRule('code', null, 'required', null, 'client');
        $this->_form->setType('code', PARAM_TEXT);

        $this->_form->addElement('submit', 'verify', get_string('validate_certificate_submit', 'certificatebeautiful'));
    }
}
