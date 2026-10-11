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
 * Read issued certificates through MCP.
 *
 * @package mod_certificatebeautiful
 * @copyright 2026 Eduardo Kraus
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\mcp;

use context;
use context_module;
use local_mcp\read\tool_interface;
use local_mcp\security\authenticated_identity;

/** Read report records with the activity report capability, not ordinary view permission. */
final class list_issues implements tool_interface {
    public function get_name(): string {
        return 'certificatebeautiful_list_issues';
    }

    public function get_title(): string {
        return 'Certificate Beautiful: list issued certificates';
    }

    public function get_description(): string {
        return 'List issued certificate records for a certificate course module, including '
            . 'user ids and verification codes. Requires viewreport permission for that activity.';
    }

    public function get_input_schema(): array {
        return ['type' => 'object', 'properties' => [
            'cmid' => ['type' => 'integer', 'minimum' => 1],
            'offset' => ['type' => 'integer', 'minimum' => 0],
            'limit' => ['type' => 'integer', 'minimum' => 1, 'maximum' => 100],
        ], 'required' => ['cmid'], 'additionalProperties' => false];
    }

    public function get_required_capability(): string {
        return 'mod/certificatebeautiful:viewreport';
    }

    public function resolve_context(array $arguments): context {
        $cm = get_coursemodule_from_id('certificatebeautiful', (int)$arguments['cmid'],
            0, false, MUST_EXIST);
        return context_module::instance((int)$cm->id);
    }

    public function execute(array $arguments, authenticated_identity $identity): array {
        global $DB;

        $cm = get_coursemodule_from_id('certificatebeautiful', (int)$arguments['cmid'],
            0, false, MUST_EXIST);
        $offset = (int)($arguments['offset'] ?? 0);
        $limit = (int)($arguments['limit'] ?? 50);
        $limit = max(1, min(100, $limit));

        $where = 'cmid = :cmid';
        $params = ['cmid' => (int)$cm->id];
        $records = $DB->get_records_select('certificatebeautiful_issue', $where, $params,
            'timecreated DESC, id DESC',
            'id, userid, cmid, code, version, timecreated', $offset, $limit);
        $issues = [];
        foreach ($records as $record) {
            $issues[] = [
                'id' => (int)$record->id,
                'userid' => (int)$record->userid,
                'cmid' => (int)$record->cmid,
                'code' => $record->code,
                'version' => (int)$record->version,
                'timecreated' => (int)$record->timecreated,
            ];
        }
        return [
            'cmid' => (int)$cm->id,
            'total' => $DB->count_records_select('certificatebeautiful_issue', $where, $params),
            'offset' => $offset,
            'limit' => $limit,
            'issues' => $issues,
        ];
    }
}
