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
 * Create a certificate activity via the standard Moodle module API.
 *
 * @package mod_certificatebeautiful
 * @copyright 2026 Eduardo Kraus
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\mcp;

use context;
use context_course;
use invalid_parameter_exception;
use local_mcp\exception\api_exception;
use local_mcp\security\authenticated_identity;
use local_mcp\write\tool\base_tool;
use mod_certificatebeautiful\automation;
use moodle_url;

/**
 * Create a configured certificate activity, without inserting raw course_module rows.
 */
final class create_activity extends base_tool {
    /**
     * get_name
     *
     * @return string
     */
    public function get_name(): string {
        return 'certificatebeautiful_create_activity';
    }

    /**
     * get_title
     *
     * @return string
     */
    public function get_title(): string {
        return 'Certificate Beautiful: create course activity';
    }

    /**
     * get_description
     *
     * @return string
     */
    public function get_description(): string {
        return 'Add a certificate activity to a Moodle course section using an existing '
            . 'certificate model. Supports manual, course completion, activity completion '
            . 'or course grade threshold issuance; requires confirmation.';
    }

    /**
     * get_input_schema
     *
     * @return array
     */
    public function get_input_schema(): array {
        return $this->object_schema([
            'courseid' => ['type' => 'integer', 'minimum' => 1],
            'sectionnum' => ['type' => 'integer', 'minimum' => 0],
            'name' => ['type' => 'string', 'minLength' => 1, 'maxLength' => 255],
            'description' => ['type' => 'string', 'minLength' => 1],
            'intro' => ['type' => 'string'],
            'modelid' => ['type' => 'integer', 'minimum' => 1],
            'autotrigger' => ['type' => 'string',
                'enum' => ['', 'coursecompletion', 'activitycompletion', 'gradethreshold']],
            'triggercmid' => ['type' => 'integer', 'minimum' => 1],
            'gradepass' => ['type' => 'number'],
            'notifyuser' => ['type' => 'boolean'],
        ], ['courseid', 'sectionnum', 'name', 'description', 'modelid']);
    }

    /**
     * get_required_capability
     *
     * @return string
     */
    public function get_required_capability(): string {
        return 'moodle/course:manageactivities';
    }

    /**
     * resolve_context
     *
     * @param array $arguments
     * @return context
     */
    public function resolve_context(array $arguments): context {
        return context_course::instance((int)$arguments['courseid'], MUST_EXIST);
    }

    /**
     * supports_dry_run
     *
     * @return bool
     */
    public function supports_dry_run(): bool {
        return true;
    }

    /**
     * validated
     *
     * @param array $arguments
     * @param authenticated_identity $identity
     * @return array
     * @throws \coding_exception
     * @throws \dml_exception
     * @throws api_exception
     * @throws invalid_parameter_exception
     */
    private function validated(array $arguments, authenticated_identity $identity): array {
        global $DB;

        $courseid = (int)$arguments['courseid'];
        $context = context_course::instance($courseid, MUST_EXIST);
        if (!has_capability('mod/certificatebeautiful:addinstance', $context, $identity->userid)) {
            throw new api_exception('permission_denied', 403);
        }
        $modelid = (int)$arguments['modelid'];
        $DB->get_record('certificatebeautiful_model', ['id' => $modelid], 'id', MUST_EXIST);

        $name = clean_param(trim((string)$arguments['name']), PARAM_TEXT);
        $description = clean_param(trim((string)$arguments['description']), PARAM_TEXT);
        if ($name === '' || core_text_strlen($name) > 255 || $description === '') {
            throw new invalid_parameter_exception('An activity name (max 255) and description are required.');
        }

        $trigger = $arguments['autotrigger'] ?? automation::TRIGGER_NONE;
        if (!in_array($trigger, [
            automation::TRIGGER_NONE, automation::TRIGGER_COURSE_COMPLETION,
            automation::TRIGGER_ACTIVITY_COMPLETION, automation::TRIGGER_GRADE_THRESHOLD,
        ], true)) {
            throw new invalid_parameter_exception('Unknown auto issuance trigger.');
        }

        $triggercmid = 0;
        $gradepass = '';
        if ($trigger === automation::TRIGGER_ACTIVITY_COMPLETION) {
            $triggercmid = (int)($arguments['triggercmid'] ?? 0);
            if (!$triggercmid) {
                throw new invalid_parameter_exception('triggercmid is required for activity completion.');
            }
            get_coursemodule_from_id('', $triggercmid, $courseid, false, MUST_EXIST);
        }
        if ($trigger === automation::TRIGGER_GRADE_THRESHOLD) {
            if (!isset($arguments['gradepass']) || !is_numeric($arguments['gradepass'])) {
                throw new invalid_parameter_exception('Numeric gradepass is required for a grade threshold.');
            }
            $gradepass = (string)$arguments['gradepass'];
        }
        return [
            'courseid' => $courseid,
            'sectionnum' => (int)$arguments['sectionnum'],
            'name' => $name,
            'description' => $description,
            'intro' => (string)($arguments['intro'] ?? ''),
            'model' => $modelid,
            'autotrigger' => $trigger,
            'triggercmid' => $triggercmid,
            'gradepass' => $gradepass,
            'notifyuser' => $trigger !== automation::TRIGGER_NONE && !empty($arguments['notifyuser']) ? 1 : 0,
        ];
    }

    /**
     * preview
     *
     * @param array $arguments
     * @param authenticated_identity $identity
     * @return array|true[]
     * @throws \coding_exception
     * @throws \dml_exception
     * @throws api_exception
     * @throws invalid_parameter_exception
     */
    public function preview(array $arguments, authenticated_identity $identity): array {
        return $this->validated($arguments, $identity) + ['requires_confirmation' => true];
    }

    /**
     * execute
     *
     * @param array $arguments
     * @param authenticated_identity $identity
     * @return array
     * @throws \coding_exception
     * @throws \core\exception\moodle_exception
     * @throws \dml_exception
     * @throws \moodle_exception
     * @throws api_exception
     * @throws invalid_parameter_exception
     */
    public function execute(array $arguments, authenticated_identity $identity): array {
        global $CFG;

        $data = $this->validated($arguments, $identity);
        require_once($CFG->dirroot . '/course/modlib.php');
        $course = get_course($data['courseid']);
        [$module, $context, $section, $cm, $info] = prepare_new_moduleinfo_data(
            $course, 'certificatebeautiful', $data['sectionnum']);
        $info->name = $data['name'];
        $info->description = $data['description'];
        $info->intro = clean_text($data['intro'], FORMAT_HTML);
        $info->introformat = FORMAT_HTML;
        $info->model = $data['model'];
        $info->autotrigger = $data['autotrigger'];
        $info->triggercmid = $data['triggercmid'];
        $info->gradepass = $data['gradepass'];
        $info->notifyuser = $data['notifyuser'];

        $created = add_moduleinfo($info, $course);
        return [
            'cmid' => (int)$created->coursemodule,
            'instanceid' => (int)$created->instance,
            'courseid' => (int)$course->id,
            'url' => (new moodle_url('/mod/certificatebeautiful/view.php',
                ['id' => $created->coursemodule]))->out(false),
        ];
    }
}
