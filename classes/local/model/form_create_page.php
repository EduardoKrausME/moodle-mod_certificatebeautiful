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
 * Class form_create_page
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\local\model;

use mod_certificatebeautiful\local\vo\certificatebeautiful_model;

/**
 * Class form_create_page
 *
 * @package mod_certificatebeautiful\local\model
 */
class form_create_page {

    /**
     * Function empty_page
     *
     * @param certificatebeautiful_model $model
     *
     * @return object
     * @throws \coding_exception
     */
    public static function empty_page($model) {
        global $CFG;

        $pageempty = get_string("certificatebeautiful-page_empty", "certificatebeautiful");
        if ($model->orientation == "L") {
            return (object)[
                "htmldata" => "<div>{$pageempty}</div>",
                "cssdata" => "
                    [data-gjs-type=wrapper] {
                        background-image: url({$CFG->wwwroot}/mod/certificatebeautiful/_editor/img/vazio.jpg);
                        position: relative;
                        height: 673px;
                        width: 955px;
                        background-repeat: no-repeat;
                        background-position: center;
                        background-size: cover;
                    }",
            ];
        } else {
            return (object)[
                "htmldata" => "<div>{$pageempty}</div>",
                "cssdata" => "
                    [data-gjs-type=wrapper] {
                        background-image: url({$CFG->wwwroot}/mod/certificatebeautiful/_editor/img/vazio-p.jpg);
                        position: relative;
                        height: 955px;
                        width: 673px;
                        background-repeat: no-repeat;
                        background-position: center;
                        background-size: cover;
                    }",
            ];
        }
    }
}
