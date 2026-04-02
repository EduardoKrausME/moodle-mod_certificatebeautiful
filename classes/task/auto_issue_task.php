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
 * auto_issue_task
 *
 * @package   mod_certificatebeautiful
 * @copyright 2026 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\task;

use core\task\scheduled_task;
use mod_certificatebeautiful\automation;

/**
 * Scheduled task responsible for automatic certificate generation.
 *
 * @package mod_certificatebeautiful
 */
class auto_issue_task extends scheduled_task {

    /**
     * Returns task name.
     *
     * @return string
     * @throws \Exception
     */
    public function get_name(): string {
        return get_string("autogenerate_task_name", "certificatebeautiful");
    }

    /**
     * Executes the scheduled task.
     *
     * @return void
     * @throws \Throwable
     */
    public function execute(): void {
        global $DB;

        mtrace("mod_certificatebeautiful: automatic issue task started");

        $records = $DB->get_records_select(
            "certificatebeautiful",
            "autogenerate = :autogenerate AND autotrigger <> :autotrigger",
            [
                "autogenerate" => 1,
                "autotrigger" => automation::TRIGGER_NONE,
            ],
            "course ASC, id ASC"
        );

        foreach ($records as $certificatebeautiful) {
            $cm = get_coursemodule_from_instance(
                "certificatebeautiful",
                $certificatebeautiful->id,
                $certificatebeautiful->course,
                false,
                MUST_EXIST
            );

            $candidateuserids = automation::get_candidate_user_ids($certificatebeautiful, $cm);

            if (!$candidateuserids) {
                continue;
            }

            mtrace("mod_certificatebeautiful: cmid {$cm->id} candidates " . count($candidateuserids));

            foreach ($candidateuserids as $userid) {
                try {
                    automation::process_user($cm->id, (int)$userid);
                } catch (\Throwable $exception) {
                    mtrace(
                        "mod_certificatebeautiful: error issuing certificate for cmid {$cm->id}, " .
                        "userid {$userid}: {$exception->getMessage()}"
                    );
                }
            }
        }

        mtrace("mod_certificatebeautiful: automatic issue task finished");
    }
}
