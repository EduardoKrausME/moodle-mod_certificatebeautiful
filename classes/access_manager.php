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
 * Access helpers for certificate issues.
 *
 * @package   mod_certificatebeautiful
 * @copyright 2026 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful;

use context_module;
use stdClass;

/**
 * Centralizes authorization rules for issued certificates.
 */
class access_manager {

    /**
     * Checks whether a user can view an issued certificate.
     *
     * Owners need the normal view capability. Other users need report access.
     *
     * @param stdClass $issue Certificate issue record.
     * @param context_module $context Module context.
     * @param int $userid User id.
     * @return bool
     */
    public static function can_view_issue(stdClass $issue, context_module $context, int $userid): bool {
        if ((int)$issue->userid === $userid) {
            return has_capability("mod/certificatebeautiful:view", $context, $userid);
        }

        return has_capability("mod/certificatebeautiful:viewreport", $context, $userid);
    }

    /**
     * Requires permission to view an issued certificate.
     *
     * @param stdClass $issue Certificate issue record.
     * @param context_module $context Module context.
     * @return void
     */
    public static function require_view_issue(stdClass $issue, context_module $context): void {
        global $USER;

        if ((int)$issue->userid === (int)$USER->id) {
            require_capability("mod/certificatebeautiful:view", $context);
            return;
        }

        require_capability("mod/certificatebeautiful:viewreport", $context);
    }

    /**
     * Requires permission to create or delete issues for other users.
     *
     * @param context_module $context Module context.
     * @return void
     */
    public static function require_manage_issues(context_module $context): void {
        require_capability("mod/certificatebeautiful:viewreport", $context);
    }
}
