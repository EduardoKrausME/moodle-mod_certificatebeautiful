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
 * Tests for optional local_mcp integration.
 *
 * @package mod_certificatebeautiful
 * @copyright 2026 Eduardo Kraus
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful;

use advanced_testcase;
use mod_certificatebeautiful\mcp\model_service;
use mod_certificatebeautiful\mcp\provider;

/**
 * MCP provider registration and certificate template round-trip tests.
 */
final class mcp_test extends advanced_testcase {
    /**
     * test_provider_discovery_and_tool_contracts
     *
     * @covers \mod_certificatebeautiful\mcp\provider
     * @return void
     */
    public function test_provider_discovery_and_tool_contracts(): void {
        if (!class_exists(\local_mcp\extension\read_provider_interface::class)) {
            $this->markTestSkipped('local_mcp is not installed.');
        }
        $provider = new provider();
        $read = $provider->get_read_tools();
        $write = $provider->get_write_tools();

        $this->assertCount(4, $read);
        $this->assertCount(2, $write);
        foreach (array_merge($read, $write) as $tool) {
            $this->assertNotEmpty($tool->get_name());
            $this->assertSame('object', $tool->get_input_schema()['type']);
        }
    }

    /**
     * test_template_round_trip_and_stale_revision
     *
     * @covers \mod_certificatebeautiful\mcp\model_service
     * @return void
     */
    public function test_template_round_trip_and_stale_revision(): void {
        if (!class_exists(\local_mcp\extension\read_provider_interface::class)) {
            $this->markTestSkipped('local_mcp is not installed.');
        }
        $this->resetAfterTest();
        $this->setAdminUser();

        $new = model_service::save([
            'name' => 'MCP test certificate',
            'orientation' => 'L',
            'pages' => [['htmldata' => '<div>Certificate</div>', 'cssdata' => '.a{color:red;}']],
        ]);
        $this->assertSame('MCP test certificate', $new['name']);
        $this->assertCount(1, $new['pages']);

        $updated = model_service::save([
            'id' => $new['id'],
            'expected_hash' => $new['state_hash'],
            'name' => 'Updated MCP certificate',
        ]);
        $this->assertSame('Updated MCP certificate', $updated['name']);
        $this->assertSame($new['pages'], $updated['pages']);

        $this->expectException(\invalid_parameter_exception::class);
        model_service::save([
            'id' => $new['id'],
            'expected_hash' => $new['state_hash'],
            'name' => 'Stale update',
        ]);
    }
}
