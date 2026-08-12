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
 * Upgrade code for mod_certificatebeautiful.
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use mod_certificatebeautiful\model\get_template_file;

/**
 * Upgrade task.
 *
 * @param int $oldversion the version we are upgrading from
 * @return bool always true
 * @throws Exception
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

        $description = get_string("default-description", "certificatebeautiful");
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

        require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/model/get_template_file.php");
        foreach (certificatebeautiful_list_all_models() as $model) {
            if (!$DB->get_record("certificatebeautiful_model", ["name" => $model["name"]])) {
                $pagesinfo = [
                    [
                        "htmldata" => get_template_file::load_template_file($model["key"]),
                        "cssdata" => "",
                    ], [
                        "htmldata" =>
                            get_template_file::load_template_file("sumary-secound-page2"),
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

    if ($oldversion < 2025030901) {
        $table = new xmldb_table("certificatebeautiful_model");
        $field = new xmldb_field("orientation", XMLDB_TYPE_CHAR, 1, null, null, null, null, "name");

        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        $DB->execute("UPDATE {certificatebeautiful_model} SET orientation = 'L'");

        upgrade_mod_savepoint(true, 2025030901, "certificatebeautiful");
    }

    if ($oldversion < 2025091100) {
        foreach (certificatebeautiful_list_all_models() as $model) {
            $certificatebeautifulmodel = $DB->get_record("certificatebeautiful_model", ["name" => $model["name"]], "id");
            if ($certificatebeautifulmodel) {
                $certificatebeautifulmodel->orientation = $model["orientation"];
                $certificatebeautifulmodel->model_key = $model["key"];
                $certificatebeautifulmodel->timemodified = time();

                $DB->update_record("certificatebeautiful_model", $certificatebeautifulmodel);
            }
        }

        upgrade_mod_savepoint(true, 2025091100, "certificatebeautiful");
    }

    if ($oldversion < 2026040200) {
        $table = new xmldb_table("certificatebeautiful");

        $fields = [
            new xmldb_field("autogenerate", XMLDB_TYPE_INTEGER, "1", null, null, null, "0", "model"),
            new xmldb_field("autotrigger", XMLDB_TYPE_CHAR, "30", null, null, null, "", "autogenerate"),
            new xmldb_field("triggercmid", XMLDB_TYPE_INTEGER, "10", null, null, null, "0", "autotrigger"),
            new xmldb_field("gradepass", XMLDB_TYPE_CHAR, "32", null, null, null, "", "triggercmid"),
            new xmldb_field("notifyuser", XMLDB_TYPE_INTEGER, "1", null, null, null, "0", "gradepass"),
        ];

        foreach ($fields as $field) {
            if (!$dbman->field_exists($table, $field)) {
                $dbman->add_field($table, $field);
            }
        }

        upgrade_mod_savepoint(true, 2026040200, "certificatebeautiful");
    }

    if ($oldversion < 2026080702) {
        $table = new xmldb_table("certificatebeautiful");
        $field = new xmldb_field("autogenerate");

        if ($dbman->field_exists($table, $field)) {
            // Preserve the previous disabled state before removing the redundant field.
            $sql = "UPDATE {certificatebeautiful}
                       SET autotrigger = '',
                           notifyuser = 0
                     WHERE autogenerate = 0";
            $DB->execute($sql);
            $dbman->drop_field($table, $field);
        }

        $sql = "UPDATE {certificatebeautiful}
                   SET notifyuser = 0
                 WHERE autotrigger = ''";
        $DB->execute($sql);

        $sql = "UPDATE {certificatebeautiful}
                   SET triggercmid = 0
                 WHERE autotrigger <> 'activitycompletion'";
        $DB->execute($sql);

        $sql = "UPDATE {certificatebeautiful}
                   SET gradepass = ''
                 WHERE autotrigger <> 'gradethreshold'";
        $DB->execute($sql);

        upgrade_mod_savepoint(true, 2026080702, "certificatebeautiful");
    }

    if ($oldversion < 2026081200) {
        $table = new xmldb_table("certificatebeautiful_issue");

        // Remove duplicate issues before adding the unique userid/cmid index.
        $duplicatesql = "SELECT MIN(id) AS keepid, userid, cmid
                           FROM {certificatebeautiful_issue}
                       GROUP BY userid, cmid
                         HAVING COUNT(*) > 1";
        $duplicates = $DB->get_records_sql($duplicatesql);

        if ($duplicates) {
            $fs = get_file_storage();

            foreach ($duplicates as $duplicate) {
                $params = [
                    "userid" => $duplicate->userid,
                    "cmid" => $duplicate->cmid,
                    "keepid" => $duplicate->keepid,
                ];
                $extraissues = $DB->get_records_select(
                    "certificatebeautiful_issue",
                    "userid = :userid AND cmid = :cmid AND id <> :keepid",
                    $params
                );

                foreach ($extraissues as $extraissue) {
                    $context = context_module::instance($extraissue->cmid, IGNORE_MISSING);
                    if ($context && !empty($extraissue->code)) {
                        $file = $fs->get_file(
                            $context->id,
                            "mod_certificatebeautiful",
                            "certificate",
                            $extraissue->userid,
                            "/",
                            "{$extraissue->code}.pdf"
                        );
                        if ($file) {
                            $file->delete();
                        }
                    }

                    $DB->delete_records("certificatebeautiful_issue", ["id" => $extraissue->id]);
                }
            }
        }

        // Older install.xml versions declared cmid as a logical FK to the activity instance table.
        $oldkey = new xmldb_key(
            "cmid",
            XMLDB_KEY_FOREIGN,
            ["cmid"],
            "certificatebeautiful",
            ["id"]
        );
        // The previous plugin schema always defined this logical key. Moodle's database_manager
        // does not expose key_exists(), so drop the known old key directly during this one-time upgrade.
        $dbman->drop_key($table, $oldkey);

        $cmkey = new xmldb_key(
            "cmid",
            XMLDB_KEY_FOREIGN,
            ["cmid"],
            "course_modules",
            ["id"]
        );
        $dbman->add_key($table, $cmkey);

        $certificatekey = new xmldb_key(
            "certificatebeautifulid",
            XMLDB_KEY_FOREIGN,
            ["certificatebeautifulid"],
            "certificatebeautiful",
            ["id"]
        );
        $dbman->add_key($table, $certificatekey);

        $usercmindex = new xmldb_index(
            "userid_cmid",
            XMLDB_INDEX_UNIQUE,
            ["userid", "cmid"]
        );
        if (!$dbman->index_exists($table, $usercmindex)) {
            $dbman->add_index($table, $usercmindex);
        }

        $certificateindex = new xmldb_index(
            "certificatebeautifulid",
            XMLDB_INDEX_NOTUNIQUE,
            ["certificatebeautifulid"]
        );
        if (!$dbman->index_exists($table, $certificateindex)) {
            $dbman->add_index($table, $certificateindex);
        }

        upgrade_mod_savepoint(true, 2026081200, "certificatebeautiful");
    }

    return true;
}
