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
 * Create or update certificate templates through MCP.
 *
 * @package mod_certificatebeautiful
 * @copyright 2026 Eduardo Kraus
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\mcp;

use context;
use context_system;
use local_mcp\security\authenticated_identity;
use local_mcp\write\tool\base_tool;

/**
 * Edit a certificate model while preserving fields not explicitly changed.
 */
final class save_model extends base_tool {
    /**
     * get_name
     *
     * @return string
     */
    public function get_name(): string {
        return 'certificatebeautiful_save_model';
    }

    /**
     * get_title
     *
     * @return string
     */
    public function get_title(): string {
        return 'Certificate Beautiful: create or update model';
    }

    /**
     * get_description
     *
     * @return string
     */
    public function get_description(): string {
        return 'Create or update a certificate template. id=0 creates a model; id>0 updates '
            . 'only supplied fields. A model has 1 to 3 pages with htmldata and cssdata. '
            . 'For updates, get certificatebeautiful_get_model and pass its state_hash as '
            . 'expected_hash. Confirm the preview before applying rich HTML/CSS.';
    }

    /**
     * get_input_schema
     *
     * @return array
     */
    public function get_input_schema(): array {
        $page = [
            'type' => 'object',
            'properties' => [
                'htmldata' => ['type' => 'string', 'maxLength' => 1048576],
                'cssdata' => ['type' => 'string', 'maxLength' => 1048576],
            ],
            'required' => ['htmldata', 'cssdata'],
            'additionalProperties' => false,
        ];
        return $this->object_schema([
            'id' => ['type' => 'integer', 'minimum' => 0,
                'description' => 'Zero or omitted for a new model; existing id for an update.'],
            'name' => ['type' => 'string', 'minLength' => 1, 'maxLength' => 254],
            'orientation' => ['type' => 'string', 'enum' => ['L', 'P'],
                'description' => 'New models only; orientation of an existing model is immutable.'],
            'pages' => ['type' => 'array', 'minItems' => 1, 'maxItems' => 3, 'items' => $page],
            'expected_hash' => ['type' => 'string',
                'description' => 'Required for updates; state_hash from certificatebeautiful_get_model.'],
        ]);
    }

    /**
     * get_required_capability
     *
     * @return string
     */
    public function get_required_capability(): string {
        return 'mod/certificatebeautiful:managemodels';
    }

    /**
     * resolve_context
     *
     * @param array $arguments
     * @return context
     * @throws \dml_exception
     */
    public function resolve_context(array $arguments): context {
        return context_system::instance();
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
     * preview
     *
     * @param array $arguments
     * @param authenticated_identity $identity
     * @return array
     * @throws \invalid_parameter_exception
     */
    public function preview(array $arguments, authenticated_identity $identity): array {
        $prepared = model_service::prepare($arguments);
        $model = $prepared['record'];
        return [
            'action' => $prepared['is_new'] ? 'create' : 'update',
            'modelid' => $model->id ?? null,
            'name' => $model->name,
            'orientation' => $model->orientation,
            'page_count' => $prepared['page_count'],
            'html_css_bytes' => strlen($model->pages_info),
            'requires_confirmation' => true,
        ];
    }

    /**
     * execute
     *
     * @param array $arguments
     * @param authenticated_identity $identity
     * @return array
     */
    public function execute(array $arguments, authenticated_identity $identity): array {
        return ['success' => true, 'model' => model_service::save($arguments)];
    }
}
