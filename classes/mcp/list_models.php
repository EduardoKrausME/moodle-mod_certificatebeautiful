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
 * List certificate model templates through MCP.
 *
 * @package mod_certificatebeautiful
 * @copyright 2026 Eduardo Kraus
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\mcp;

use context;
use context_system;
use local_mcp\read\tool_interface;
use local_mcp\security\authenticated_identity;

/** Enumerate templates without returning potentially large HTML/CSS bodies. */
final class list_models implements tool_interface {
    public function get_name(): string {
        return 'certificatebeautiful_list_models';
    }

    public function get_title(): string {
        return 'Certificate Beautiful: list models';
    }

    public function get_description(): string {
        return 'List certificate templates and their ids, names, orientation and page counts. '
            . 'Use certificatebeautiful_get_model to read HTML/CSS and a state_hash before editing.';
    }

    public function get_input_schema(): array {
        return ['type' => 'object', 'properties' => (object)[], 'additionalProperties' => false];
    }

    public function get_required_capability(): string {
        return 'mod/certificatebeautiful:managemodels';
    }

    public function resolve_context(array $arguments): context {
        return context_system::instance();
    }

    public function execute(array $arguments, authenticated_identity $identity): array {
        global $DB;

        $result = [];
        foreach ($DB->get_records('certificatebeautiful_model', null, 'name ASC',
                'id, name, model_key, orientation, pages_info, timemodified') as $model) {
            $pages = json_decode($model->pages_info ?? '[]', true);
            $result[] = [
                'id' => (int)$model->id,
                'name' => $model->name,
                'orientation' => $model->orientation,
                'model_key' => $model->model_key,
                'pages' => is_array($pages) ? count($pages) : 0,
                'timemodified' => (int)$model->timemodified,
            ];
        }
        return ['models' => $result, 'count' => count($result)];
    }
}
