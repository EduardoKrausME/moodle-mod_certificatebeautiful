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
 * Class get_template_file
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\model;

/**
 * Class get_template_file
 *
 * @package mod_certificatebeautiful\model
 */
class get_template_file {

    /**
     * Function load_template_file
     *
     * @param $model
     *
     * @return bool|mixed|string
     */
    public static function load_template_file($model) {
        global $CFG;

        $htmldata = file_get_contents("{$CFG->dirroot}/mod/certificatebeautiful/_editor/_model/{$model}/index.html");

        $htmldata = str_replace("/mod/certificatebeautiful/_editor/_model/",
            "{$CFG->wwwroot}/mod/certificatebeautiful/_editor/_model/", $htmldata);

        return $htmldata;
    }

}
