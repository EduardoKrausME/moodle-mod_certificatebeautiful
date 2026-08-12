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
 * Restore structure for mod_certificatebeautiful.
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Restores one Beautiful Certificate activity.
 */
class restore_certificatebeautiful_activity_structure_step extends restore_activity_structure_step {

    /** @var int New certificatebeautiful instance id. */
    protected $newinstanceid = 0;

    /** @var int Original model id stored in the backup. */
    protected $oldmodelid = 0;

    /** @var int Original course-module id used as the automatic-completion trigger. */
    protected $oldtriggercmid = 0;

    /**
     * Defines the structure to be restored.
     *
     * @return restore_path_element[]
     */
    protected function define_structure(): array {
        $paths = [];
        $paths[] = new restore_path_element("certificatebeautiful", "/activity/certificatebeautiful");
        $paths[] = new restore_path_element(
            "certificate_model",
            "/activity/certificatebeautiful/certificate_model"
        );

        if ($this->get_setting_value("userinfo")) {
            $paths[] = new restore_path_element(
                "certificatebeautiful_issue",
                "/activity/certificatebeautiful/issues/issue"
            );
        }

        return $this->prepare_activity_structure($paths);
    }

    /**
     * Restores the activity record.
     *
     * @param array $data Parsed element data.
     * @return void
     */
    protected function process_certificatebeautiful(array $data): void {
        global $DB;

        $data = (object)$data;
        $data->course = $this->get_courseid();
        $this->oldmodelid = (int)$data->model;
        $this->oldtriggercmid = !empty($data->triggercmid) ? (int)$data->triggercmid : 0;

        // Course-module mappings for an activity referenced by triggercmid may not exist yet
        // while this activity is being processed. Resolve it in after_restore(), when the
        // complete restore plan has finished creating activity mappings.
        $data->triggercmid = 0;

        // Same-site restores can safely reuse the existing global model. For cross-site
        // restores use an existing model temporarily until certificate_model is processed.
        if (!($this->task->is_samesite() && $DB->record_exists("certificatebeautiful_model", ["id" => $this->oldmodelid]))) {
            $data->model = (int)$DB->get_field_sql("SELECT MIN(id) FROM {certificatebeautiful_model}");

            if (!$data->model) {
                $data->model = $DB->insert_record("certificatebeautiful_model", (object)[
                    "name" => "Restored certificate model",
                    "orientation" => "L",
                    "model_key" => "",
                    "pages_info" => "[]",
                    "timecreated" => time(),
                    "timemodified" => time(),
                ]);
            }
        }

        $this->newinstanceid = $DB->insert_record("certificatebeautiful", $data);
        $this->apply_activity_instance($this->newinstanceid);
    }

    /**
     * Restores the selected global certificate model and links it to the new activity.
     *
     * @param array $data Parsed model data.
     * @return void
     */
    protected function process_certificate_model(array $data): void {
        global $DB;

        $data = (object)$data;
        $oldid = (int)$data->id;

        $mappedmodelid = (int)$this->get_mappingid("certificatebeautiful_model", $oldid, 0);
        if ($mappedmodelid && $DB->record_exists("certificatebeautiful_model", ["id" => $mappedmodelid])) {
            $newmodelid = $mappedmodelid;
        } else if ($this->task->is_samesite() && $DB->record_exists("certificatebeautiful_model", ["id" => $oldid])) {
            $newmodelid = $oldid;
        } else {
            unset($data->id);
            $newmodelid = $DB->insert_record("certificatebeautiful_model", $data);
        }

        $this->set_mapping("certificatebeautiful_model", $oldid, $newmodelid);
        $DB->set_field("certificatebeautiful", "model", $newmodelid, ["id" => $this->newinstanceid]);
    }

    /**
     * Restores one issued certificate.
     *
     * @param array $data Parsed issue data.
     * @return void
     */
    protected function process_certificatebeautiful_issue(array $data): void {
        global $DB;

        $data = (object)$data;
        $oldid = (int)$data->id;
        $data->userid = (int)$this->get_mappingid("user", $data->userid);

        if (!$data->userid) {
            return;
        }

        $cm = get_coursemodule_from_instance(
            "certificatebeautiful",
            $this->newinstanceid,
            $this->get_courseid(),
            false,
            MUST_EXIST
        );

        if ($DB->record_exists("certificatebeautiful_issue", [
            "userid" => $data->userid,
            "cmid" => $cm->id,
        ])) {
            return;
        }

        unset($data->id);
        $data->cmid = $cm->id;
        $data->certificatebeautifulid = $this->newinstanceid;

        // Validation codes are site-wide unique. Keep the original when possible and
        // create a replacement only when a restored backup collides with an existing issue.
        if (empty($data->code) || $DB->record_exists("certificatebeautiful_issue", ["code" => $data->code])) {
            do {
                $data->code = strtoupper(bin2hex(random_bytes(8)));
            } while ($DB->record_exists("certificatebeautiful_issue", ["code" => $data->code]));
        }

        $data->version = $DB->get_field(
            "certificatebeautiful",
            "timemodified",
            ["id" => $this->newinstanceid]
        );

        $newitemid = $DB->insert_record("certificatebeautiful_issue", $data);
        $this->set_mapping("certificatebeautiful_issue", $oldid, $newitemid);
    }

    /**
     * Resolves cross-activity mappings after the complete restore plan has run.
     *
     * @return void
     */
    public function after_restore(): void {
        global $DB;

        if (!$this->newinstanceid || !$this->oldtriggercmid) {
            return;
        }

        $newtriggercmid = (int)$this->get_mappingid("course_module", $this->oldtriggercmid, 0);
        $DB->set_field(
            "certificatebeautiful",
            "triggercmid",
            $newtriggercmid,
            ["id" => $this->newinstanceid]
        );
    }

    /**
     * Restores related files.
     *
     * Generated certificate PDFs are intentionally not restored because they are derived
     * from the activity/model/user data and may contain URLs from the source site.
     *
     * @return void
     */
    protected function after_execute(): void {
        $this->add_related_files("mod_certificatebeautiful", "intro", null);
    }
}
