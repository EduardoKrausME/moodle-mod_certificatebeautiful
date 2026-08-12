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
 * User certificate report.
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use mod_certificatebeautiful\report\certificatebeautiful_view_user;

require_once('../../config.php');
require_once("{$CFG->libdir}/tablelib.php");

require_login();

$userid = optional_param("user", $USER->id, PARAM_INT);

// This page is primarily the current user's certificate history. Only site administrators
// may request another user's global history; module-level report permissions are enforced
// again when an individual certificate PDF is opened.
if ((int)$userid !== (int)$USER->id && !is_siteadmin()) {
    $userid = $USER->id;
}

$user = $DB->get_record("user", ["id" => $userid], '*', MUST_EXIST);
$context = context_user::instance($user->id);

$PAGE->set_context($context);
$PAGE->set_url('/mod/certificatebeautiful/reports-my.php', ["user" => $userid]);
$PAGE->set_title(fullname($user) . " " . get_string("reports"));
$PAGE->set_heading(get_string("from_certificates", "certificatebeautiful", fullname($user)));
$PAGE->add_body_class("certificatebeautiful-pages");

echo $OUTPUT->header();

require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/report/certificatebeautiful_view_user.php");
$table = new certificatebeautiful_view_user("certificatebeautiful_view_user", $user);
$table->define_baseurl("{$CFG->wwwroot}/mod/certificatebeautiful/reports-my.php?user={$user->id}");
$table->out(40, true);

echo $OUTPUT->footer();
