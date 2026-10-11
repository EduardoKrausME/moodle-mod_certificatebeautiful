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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/**
 * Read certificate activities in a Moodle course.
 *
 * @package mod_certificatebeautiful
 * @copyright 2026 Eduardo Kraus
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\mcp;

use context;
use context_course;
use context_module;
use local_mcp\read\tool_interface;
use local_mcp\security\authenticated_identity;
use moodle_url;

/** List activities in a course, including their automation configuration. */
final class list_activities implements tool_interface {
    public function get_name(): string {
        return 'certificatebeautiful_list_activities';
    }

    public function get_title(): string {
        return 'Certificate Beautiful: list course activities';
    }

    public function get_description(): string {
        return 'List certificate activities in a course with template, trigger and link. '
            . 'Only activities whose reports the connected user may view are included.';
    }

    public function get_input_schema(): array {
        return ['type' => 'object',
            'properties' => ['courseid' => ['type' => 'integer', 'minimum' => 1]],
            'required' => ['courseid'], 'additionalProperties' => false];
    }

    public function get_required_capability(): string {
        return 'moodle/course:manageactivities';
    }

    public function resolve_context(array $arguments): context {
        return context_course::instance((int)$arguments['courseid'], MUST_EXIST);
    }

    public function execute(array $arguments, authenticated_identity $identity): array {
        global $DB;

        $courseid = (int)$arguments['courseid'];
        $sql = 'SELECT cm.id, a.id AS instanceid, a.name, a.model, a.autotrigger, '
            . 'a.triggercmid, a.gradepass, a.notifyuser, a.timemodified '
            . 'FROM {course_modules} cm '
            . 'JOIN {modules} m ON m.id = cm.module AND m.name = :modname '
            . 'JOIN {certificatebeautiful} a ON a.id = cm.instance '
            . 'WHERE cm.course = :courseid AND cm.deletioninprogress = 0 ORDER BY cm.id';
        $cms = $DB->get_records_sql($sql, ['modname' => 'certificatebeautiful', 'courseid' => $courseid]);
        $activities = [];
        foreach ($cms as $cm) {
            if (!has_capability('mod/certificatebeautiful:viewreport',
                    context_module::instance((int)$cm->id), $identity->userid)) {
                continue;
            }
            $activities[] = [
                'cmid' => (int)$cm->id,
                'instanceid' => (int)$cm->instanceid,
                'name' => $cm->name,
                'modelid' => (int)$cm->model,
                'autotrigger' => $cm->autotrigger,
                'triggercmid' => (int)$cm->triggercmid,
                'gradepass' => $cm->gradepass,
                'notifyuser' => (bool)$cm->notifyuser,
                'timemodified' => (int)$cm->timemodified,
                'url' => (new moodle_url('/mod/certificatebeautiful/view.php',
                    ['id' => $cm->id]))->out(false),
            ];
        }
        return ['courseid' => $courseid, 'activities' => $activities, 'count' => count($activities)];
    }
}
