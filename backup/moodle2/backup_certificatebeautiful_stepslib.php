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
 * Backup structure for mod_certificatebeautiful.
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Defines the complete structure for one Beautiful Certificate activity.
 */
class backup_certificatebeautiful_activity_structure_step extends backup_activity_structure_step {

    /**
     * Defines the structure of the resulting XML file.
     *
     * @return backup_nested_element
     */
    protected function define_structure() {
        $certificatebeautiful = new backup_nested_element(
            "certificatebeautiful",
            ["id"],
            [
                "name",
                "description",
                "intro",
                "introformat",
                "model",
                "autotrigger",
                "triggercmid",
                "gradepass",
                "notifyuser",
                "timecreated",
                "timemodified",
            ]
        );

        // The selected model is global data, so include a self-contained copy in the activity backup.
        $model = new backup_nested_element(
            "certificate_model",
            ["id"],
            [
                "name",
                "orientation",
                "model_key",
                "pages_info",
                "timecreated",
                "timemodified",
            ]
        );

        $issues = new backup_nested_element("issues");
        $issue = new backup_nested_element(
            "issue",
            ["id"],
            [
                "userid",
                "code",
                "version",
                "timecreated",
            ]
        );

        $certificatebeautiful->add_child($model);
        $certificatebeautiful->add_child($issues);
        $issues->add_child($issue);

        $certificatebeautiful->set_source_table("certificatebeautiful", ["id" => backup::VAR_ACTIVITYID]);

        $model->set_source_sql(
            "SELECT m.*
               FROM {certificatebeautiful_model} m
               JOIN {certificatebeautiful} cb ON cb.model = m.id
              WHERE cb.id = ?",
            [backup::VAR_ACTIVITYID]
        );

        if ($this->get_setting_value("userinfo")) {
            $issue->set_source_table(
                "certificatebeautiful_issue",
                ["certificatebeautifulid" => backup::VAR_ACTIVITYID]
            );
        }

        $certificatebeautiful->annotate_ids("course_module", "triggercmid");
        $issue->annotate_ids("user", "userid");

        // Generated PDFs are cache/derived data. They are regenerated after restore.
        $certificatebeautiful->annotate_files("mod_certificatebeautiful", "intro", null);

        return $this->prepare_activity_structure($certificatebeautiful);
    }
}
