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
 * Automatically discovered MCP provider.
 *
 * @package mod_certificatebeautiful
 * @copyright 2026 Eduardo Kraus
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\mcp;

use local_mcp\extension\read_provider_interface;
use local_mcp\extension\write_provider_interface;

/**
 * Discovered by local_mcp from classes/mcp/provider.php.
 *
 * Do not register a lib.php callback: that would register each tool twice.
 * The certificate activity works without local_mcp installed.
 */
final class provider implements read_provider_interface, write_provider_interface {

    /**
     * get_read_tools
     *
     * @return array|\local_mcp\read\tool_interface[]
     */
    public function get_read_tools(): array {
        return [
            new list_models(),
            new get_model(),
            new list_activities(),
            new list_issues(),
        ];
    }


    /**
     * get_write_tools
     *
     * @return array|\local_mcp\write\tool_interface[]
     */
    public function get_write_tools(): array {
        return [
            new save_model(),
            new create_activity(),
        ];
    }
}
