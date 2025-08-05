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
 * Class issue
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful;

use Exception;
use mod_certificatebeautiful\vo\certificatebeautiful;
use mod_certificatebeautiful\vo\certificatebeautiful_issue;

/**
 * Class issue
 *
 * @package mod_certificatebeautiful
 */
class issue {

    /** @var string */
    const ISSUE_HIDDEN = "hidden";
    /** @var string */
    const ISSUE_ADMINS_ONLY = "admins_only";
    /** @var string */
    const ISSUE_NAME_VISIBLE = "name_visible";
    /** @var string */
    const ISSUE_EMAIL_ANONIMIZED = "email_anonimized";

    /**
     * Function get
     *
     * @param object $user
     * @param certificatebeautiful $certificatebeautiful
     * @param object $cm
     * @return certificatebeautiful_issue|object
     * @throws Exception
     */
    public static function get($user, $certificatebeautiful, $cm) {
        global $DB;

        /** @var certificatebeautiful_issue $issue */
        $issue = $DB->get_record("certificatebeautiful_issue", ["userid" => $user->id, "cmid" => $cm->id]);
        if (!$issue) {
            $issue = (object)[
                "userid" => $user->id,
                "cmid" => $cm->id,
                "certificatebeautifulid" => $certificatebeautiful->id,
                "code" => substr(strtoupper(md5("{$cm->id}-{$user->id}-{$certificatebeautiful->id}")), 0, 10),
                "version" => $certificatebeautiful->timemodified,
                "timecreated" => time(),
                "timemodified" => time(),
            ];
            $issue->id = $DB->insert_record("certificatebeautiful_issue", $issue);
        }

        return $issue;
    }
}
