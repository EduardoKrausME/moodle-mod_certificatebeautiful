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
 * Book module upgrade code
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Book module upgrade task
 *
 * @param int $oldversion the version we are upgrading from
 * @return bool always true
 */
function xmldb_certificatebeautiful_upgrade($oldversion) {
    global $CFG, $DB;

    if ($oldversion < 2024020700) {

        $DB->delete_records('certificatebeautiful_model');
        require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/model/get_template_file.php");

        foreach (certificatebeautiful_list_all_models() as $model) {

            $pagesinfo = [
                [
                    "htmldata" => \mod_certificatebeautiful\model\get_template_file::load_template($model['key']),
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

        upgrade_mod_savepoint(true, 2024020700, 'certificatebeautiful');
    }


    return true;
}
