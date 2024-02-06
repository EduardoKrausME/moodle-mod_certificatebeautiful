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
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Perform the post-install procedures.
 */
function xmldb_certificatebeautiful_install() {
    global $DB, $CFG;

    require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/model/get_template_file.php");

    $models = [
        [
            "name" => get_string('certificate-appreciation', 'certificatebeautiful'),
            "key" => 'certificate-appreciation',
        ], [
            "name" => get_string('certificate-elegant', 'certificatebeautiful'),
            "key" => 'certificate-elegant',
        ], [
            "name" => get_string('certificate-modern', 'certificatebeautiful'),
            "key" => 'certificate-modern',
        ], [
            "name" => get_string('certificate-simple', 'certificatebeautiful'),
            "key" => 'certificate-simple',
        ], [
            "name" => get_string('certificate-vintage', 'certificatebeautiful'),
            "key" => 'certificate-vintage',
        ], [
            "name" => get_string('certificate-golden', 'certificatebeautiful'),
            "key" => 'certificate-golden',
        ],
    ];

    foreach ($models as $model) {

        $htmldata = \mod_certificatebeautiful\model\get_template_file::load_template($model['key']);

        $pagesinfo = [
            [
                "htmldata" => $htmldata,
                "cssdata" => ""
            ], [
                "htmldata" => \mod_certificatebeautiful\model\get_template_file::load_template("sumary-secound-page"),
                "cssdata" => ""
            ]
        ];

        $certificatebeautifulmodel = (object)[
            "name" => $model['name'],
            "pages_info" => json_encode($pagesinfo, JSON_PRETTY_PRINT),
            "timecreated" => time(),
            "timemodified" => time(),
        ];
        $DB->insert_record('certificatebeautiful_model', $certificatebeautifulmodel);
    }
}
