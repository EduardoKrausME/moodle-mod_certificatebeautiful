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
 * Define the complete structure for backup, with file and id annotations.
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * THe class defines the complete structure for backup, with file and id annotations.
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_certificatebeautiful_activity_structure_step extends backup_activity_structure_step {

    /**
     * Defines the structure of the resulting xml file.
     *
     * @return backup_nested_element The structure wrapped by the common 'activity' element.
     * @throws base_element_struct_exception
     * @throws base_step_exception
     * @throws dml_exception
     */
    protected function define_structure() {
        // Course certificate.
        $fields = ["name", "description", "timecreated", "timemodified", "intro", "introformat", "model", "template", "expires"];
        $certificatebeautiful = new backup_nested_element("certificatebeautiful", ["id"], $fields);

        // Issues.
        $issues = new backup_nested_element("issues");
        $issue = new backup_nested_element("issue", ["id"],
            ["userid", "templateid", "code", "emailed", "timecreated", "expires", "data", "component", "courseid"]);

        // Build the tree.
        $certificatebeautiful->add_child($issues);
        $issues->add_child($issue);

        // Define the source tables for the elements.
        $certificatebeautiful->set_source_table("certificatebeautiful", ["id" => backup::VAR_ACTIVITYID]);

        // Define id annotations.
        $issue->annotate_ids("user", "userid");

        // Define file annotations.
        $certificatebeautiful->annotate_files("mod_certificatebeautiful", "intro", null); // This file area hasn't itemid.
        if ($this->get_setting_value("userinfo")) {
            $issue->annotate_files("tool_certificate", "issues", "id", context_system::instance()->id);
        }

        return $this->prepare_activity_structure($certificatebeautiful);
    }
}
