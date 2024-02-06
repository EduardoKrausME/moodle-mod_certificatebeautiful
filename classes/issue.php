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
 * Time: 11:02
 */

namespace mod_certificatebeautiful;

use mod_certificatebeautiful\vo\certificatebeautiful;
use mod_certificatebeautiful\vo\certificatebeautiful_issue;

class issue {
    /**
     * @param $user
     * @param certificatebeautiful $certificatebeautiful
     * @param $cm
     * @param $course
     *
     * @return certificatebeautiful_issue
     *
     * @throws \dml_exception
     */
    public static function get($user, $certificatebeautiful, $cm) {
        global $DB;

        $certificatebeautifulissue = $DB->get_record('certificatebeautiful_issue', ["userid" => $user->id, "cmid" => $cm->id]);
        if (!$certificatebeautifulissue) {
            $certificatebeautifulissue = (object)[
                "userid" => $user->id,
                "cmid" => $cm->id,
                "certificatebeautifulid" => $certificatebeautiful->id,
                "code" => substr(strtoupper("c" . uniqid()), 0, 10),
                "version" => $certificatebeautiful->timemodified,
                "timecreated" => time()
            ];
            $certificatebeautifulissue->id = $DB->insert_record('certificatebeautiful_issue', $certificatebeautifulissue);
        }

        return $certificatebeautifulissue;
    }
}
