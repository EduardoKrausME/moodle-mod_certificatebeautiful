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

/**
 * Book module upgrade task
 *
 * @param int $oldversion the version we are upgrading from
 *
 * @return bool always true
 * @throws coding_exception
 * @throws dml_exception
 * @throws downgrade_exception
 * @throws moodle_exception
 * @throws upgrade_exception
 */
function xmldb_certificatebeautiful_upgrade($oldversion) {
    global $CFG, $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2024021200) {

        $table = new xmldb_table("certificatebeautiful");
        $field = new xmldb_field("description", XMLDB_TYPE_TEXT, null, null, null, null, null, "name");

        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        $description = get_string('default-description', "certificatebeautiful");
        $DB->execute("UPDATE {certificatebeautiful} SET description = '{$description}'");

        upgrade_mod_savepoint(true, 2024021200, "certificatebeautiful");
    }

    if ($oldversion < 2024021402) {

        $table = new xmldb_table("certificatebeautiful_model");
        $field = new xmldb_field("model_key", XMLDB_TYPE_TEXT, null, null, null, null, null, "name");

        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }
        $DB->delete_records("certificatebeautiful_model");

        require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/local/model/get_template_file.php");
        foreach (certificatebeautiful_list_all_models() as $model) {
            if (!$DB->get_record("certificatebeautiful_model", ["name" => $model["name"]])) {
                $pagesinfo = [
                    [
                        "htmldata" => \mod_certificatebeautiful\local\model\get_template_file::load_template_file($model["key"]),
                        "cssdata" => "",
                    ], [
                        "htmldata" =>
                            \mod_certificatebeautiful\local\model\get_template_file::load_template_file("sumary-secound-page2"),
                        "cssdata" => "",
                    ],
                ];
                $certificatebeautifulmodel = (object)[
                    "name" => $model["name"],
                    "model_key" => $model["key"],
                    "pages_info" => json_encode($pagesinfo),
                    "timecreated" => time(),
                    "timemodified" => time(),
                ];
                $DB->insert_record("certificatebeautiful_model", $certificatebeautifulmodel);
            }
        }

        upgrade_mod_savepoint(true, 2024021402, "certificatebeautiful");
    }

    return true;
}
