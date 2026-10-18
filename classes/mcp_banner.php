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
 * Persistent MCP promotion banner.
 *
 * @package mod_certificatebeautiful
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful;

/** Site administrator visibility, dismissal, and template data for the MCP notice. */
final class mcp_banner {
    /** @var string Per-user permanent dismissal flag. */
    public const PREFERENCE_HIDDEN = "mod_certificatebeautiful_mcp_banner_hidden";

    /** Return whether the current user should see the optional integration notice. */
    public static function should_show(): bool {
        return is_siteadmin()
            && get_config("local_mcp", "version") === false
            && !get_user_preferences(self::PREFERENCE_HIDDEN, false);
    }

    /** Process a dismissal before rendering or changing plugin data. */
    public static function dismiss_if_requested(\moodle_url $returnurl): void {
        if (!optional_param("dismiss_mcp_banner", 0, PARAM_BOOL)) {
            return;
        }
        require_login();
        if (!is_siteadmin() || ($_SERVER["REQUEST_METHOD"] ?? "") !== "POST") {
            throw new \moodle_exception("nopermissions", "error");
        }
        require_sesskey();
        set_user_preference(self::PREFERENCE_HIDDEN, "1");
        redirect($returnurl);
    }

    /** Render the accessible Mustache component using a page-scoped POST action. */
    public static function render(\core_renderer $output, \moodle_url $pageurl): string {
        if (!self::should_show()) {
            return "";
        }
        return $output->render_from_template("mod_certificatebeautiful/mcp_banner", [
            "mcp_banner_dismiss_url" => $pageurl->out(false),
            "sesskey" => sesskey(),
        ]);
    }
}
