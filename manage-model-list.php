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
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use mod_certificatebeautiful\model\table_list;

require(__DIR__ . '/../../config.php');
require($CFG->libdir . '/tablelib.php');

global $PAGE, $USER, $CFG;

$PAGE->requires->css('/mod/certificatebeautiful/style.css');
$PAGE->set_context(context_system::instance());
$PAGE->set_url('/mod/certificatebeautiful/manage-model-list.php');
$PAGE->set_title(get_string('list_model', 'certificatebeautiful'));

require_login();

$PAGE->set_heading(format_string(get_string('list_model', 'certificatebeautiful')));

$PAGE->navbar->add(get_string('list_model', 'certificatebeautiful'), $PAGE->url);

echo $OUTPUT->header();

echo $OUTPUT->render_from_template('mod_certificatebeautiful/heading-addnew', [
    "url" => "manage-model.php?id=-1",
    "text" => get_string('add_new_model', 'certificatebeautiful')
]);

require_once(__DIR__ . '/classes/model/table_list.php');
$table = new table_list('certificatebeautiful_model');
$table->define_baseurl("/mod/certificatebeautiful/manage-model-list.php");
$table->out(40, true);

echo $OUTPUT->footer();
