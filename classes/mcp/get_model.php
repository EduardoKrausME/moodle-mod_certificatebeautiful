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
 * Read one certificate template through MCP.
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

/**
 * Read model HTML and CSS for round-trip editing.
 */
final class get_model implements tool_interface {
    /**
     * get_name
     *
     * @return string
     */
    public function get_name(): string {
        return 'certificatebeautiful_get_model';
    }

    /**
     * get_title
     *
     * @return string
     */
    public function get_title(): string {
        return 'Certificate Beautiful: get model';
    }

    /**
     * get_description
     *
     * @return string
     */
    public function get_description(): string {
        return 'Read a certificate template with its pages containing htmldata and cssdata. '
            . 'Pass state_hash as expected_hash to certificatebeautiful_save_model when updating.';
    }

    /**
     * get_input_schema
     *
     * @return array
     */
    public function get_input_schema(): array {
        return ['type' => 'object',
            'properties' => ['id' => ['type' => 'integer', 'minimum' => 1]],
            'required' => ['id'], 'additionalProperties' => false];
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
     * execute
     *
     * @param array $arguments
     * @param authenticated_identity $identity
     * @return array
     */
    public function execute(array $arguments, authenticated_identity $identity): array {
        return model_service::snapshot((int)$arguments['id']);
    }
}
