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
 * Install script for mod_certificatebeautiful.
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Perform the post-install procedures.
 *
 * @throws coding_exception
 * @throws dml_exception
 */
function xmldb_certificatebeautiful_install() {
    global $DB;

    foreach (certificatebeautiful_list_all_models() as $model) {
        $pagesinfo = [
            [
                "htmldata" => \mod_certificatebeautiful\model\get_template_file::load_template_file($model["key"]),
                "cssdata" => "",
            ], [
                "htmldata" => \mod_certificatebeautiful\model\get_template_file::load_template_file("sumary-secound-page2"),
                "cssdata" => "",
            ],
        ];

        $certificatebeautifulmodel = (object)[
            "name" => $model["name"],
            "pages_info" => json_encode($pagesinfo, JSON_PRETTY_PRINT),
            "timecreated" => time(),
            "timemodified" => time(),
        ];
        $DB->insert_record("certificatebeautiful_model", $certificatebeautifulmodel);
    }
}
