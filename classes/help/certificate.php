<?php
// This file is part of the mod_certificatebeautiful plugin for Moodle - http://moodle.org/
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
 * User: Eduardo Kraus
 * Date: 12/01/2024
 * Time: 18:38
 */

namespace mod_certificatebeautiful\help;

class certificate extends help_base {
    /**
     * @return array
     * @throws \coding_exception
     */
    public static function table_structure() {
        return [
            ['key' => 'name', 'label' => get_string('help_certificate_name', 'certificatebeautiful')],
            ['key' => 'issue_timecreated', 'label' => get_string('help_certificate_issue_timecreated', 'certificatebeautiful')],
            ['key' => 'issue_code', 'label' => get_string('help_certificate_issue_code', 'certificatebeautiful')],
        ];
    }

    /**
     * @param $course
     * @return array
     * @throws \coding_exception
     */
    public static function get_data($course) {
        return self::base_get_data(self::table_structure(), $course);
    }
}
