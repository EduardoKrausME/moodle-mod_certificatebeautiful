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
 * @date        09/01/2024 12:15
 */

namespace mod_certificatebeautiful\local\model;

defined('MOODLE_INTERNAL') || die();
require_once("{$CFG->libdir}/formslib.php");

class form_create_page extends \moodleform {

    /**
     * @return object
     *
     * @throws \coding_exception
     */
    public static function empty_page() {

        return (object)[
            "htmldata" => '<div>' . get_string('certificatebeautiful-page_empty', 'certificatebeautiful') . '</div>',
            "cssdata" => "
                [data-gjs-type=wrapper] {
                    background-image: url(/mod/certificatebeautiful/_editor/img/vazio.jpg);
                    position: relative;
                    height: 673px;
                    width: 955px;
                    background-repeat: no-repeat;
                    background-position: center;
                    background-size: cover;
                }"
        ];
    }

    /**
     * Form definition. Abstract method - always override!
     */
    protected function definition() {
    }
}
