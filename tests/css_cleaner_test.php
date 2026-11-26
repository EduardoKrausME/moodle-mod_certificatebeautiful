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

namespace mod_certificatebeautiful;

use mod_certificatebeautiful\local\css_cleaner;

/**
 * Regression tests shared with the editor's JavaScript implementation.
 *
 * @package    mod_certificatebeautiful
 * @copyright  2026 Eduardo Kraus https://eduardokraus.com/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers \mod_certificatebeautiful\local\css_cleaner
 */
final class css_cleaner_test extends \basic_testcase {
    /**
     * Verify the same CSS fixtures used by JavaScript.
     */
    public function test_shared_fixtures(): void {
        $cases = json_decode(file_get_contents(__DIR__ . "/fixtures/css_cleaner.json"), true, 512, JSON_THROW_ON_ERROR);
        foreach ($cases as [$name, $input, $expected]) {
            $this->assertSame($expected, css_cleaner::clean($input), $name);
            $this->assertSame($expected, css_cleaner::clean($expected), $name . " (idempotence)");
        }
    }

    /**
     * Large editor images must not exhaust the PCRE stack or lose the wrapper.
     */
    public function test_large_background(): void {
        $data = str_repeat("A", 1048576);
        $wrapper = "[data-gjs-type=wrapper]{background-image:url(data:image/png;base64," . $data . ")}";
        $css = 'body{background:url("data:image/png;base64,' . $data . '")}' . $wrapper;
        $this->assertSame($wrapper, css_cleaner::clean($css));
    }

    /**
     * Excessive nesting must leave the entire input intact.
     */
    public function test_depth_limit(): void {
        $css = str_repeat("@media print{", 34) . "body{x:1}" . str_repeat("}", 34);
        $this->assertSame($css, css_cleaner::clean($css));
    }
}
