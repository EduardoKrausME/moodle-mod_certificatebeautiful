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

use mod_certificatebeautiful\model\form_create;
use mod_certificatebeautiful\model\form_create_page;

require_once('../../config.php');
require_once("{$CFG->libdir}/tablelib.php");
require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/model/form_create.php");
require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/model/form_create_page.php");

global $PAGE, $USER, $CFG;

$id = required_param('id', PARAM_INT);

$PAGE->requires->css('/mod/certificatebeautiful/style.css');
$PAGE->set_context(context_system::instance());
$PAGE->set_url('/mod/certificatebeautiful/manage-model-list.php', ['id' => $id]);
require_login();

if ($id > 0) {
    /** @var \mod_certificatebeautiful\vo\certificatebeautiful_model $certificatebeautifulmodel */
    $certificatebeautifulmodel = $DB->get_record('certificatebeautiful_model', ['id' => $id], "*", MUST_EXIST);

    $PAGE->set_title($certificatebeautifulmodel->name);
    $PAGE->set_heading(format_string($certificatebeautifulmodel->name));

    $PAGE->navbar->add(get_string('list_model', 'certificatebeautiful'), "manage-model-list.php");
    $PAGE->navbar->add($certificatebeautifulmodel->name, $PAGE->url);
} else {
    $certificatebeautifulmodel = (object)["id" => -1, "name" => "", "pages_info" => "[]"];

    $PAGE->set_title(get_string('new_model', 'certificatebeautiful'));
    $PAGE->set_heading(format_string(get_string('new_model', 'certificatebeautiful')));

    $PAGE->navbar->add(get_string('list_model', 'certificatebeautiful'), "manage-model-list.php");
    $PAGE->navbar->add(get_string('new_model', 'certificatebeautiful'), $PAGE->url);
}

$certificatebeautifulmodel->pages_info_object = json_decode($certificatebeautifulmodel->pages_info);
if (optional_param("add-new", false, PARAM_RAW)) {
    $certificatebeautifulmodel->pages_info_object[] = form_create_page::empty_page();
}
if (count($certificatebeautifulmodel->pages_info_object) == 0) {
    $certificatebeautifulmodel->pages_info_object = [form_create_page::empty_page()];
}

$formcreate = new form_create(null, ["certificatebeautiful_model" => $certificatebeautifulmodel]);
if (!$formcreate->is_cancelled() && $certificatebeautifulmodel = $formcreate->get_data()) {

    if ($id > 0) {
        $data = (object)[
            "id" => $certificatebeautifulmodel->id,
            "name" => $certificatebeautifulmodel->name,
            "timemodified" => time()
        ];
        $DB->update_record("certificatebeautiful_model", $data);
    } else {
        $data = (object)[
            "name" => $certificatebeautifulmodel->name,
            "pages_info" => json_encode([form_create_page::empty_page()], JSON_PRETTY_PRINT),
            "timecreated" => time(),
            "timemodified" => time()
        ];
        $certificatebeautifulmodel->id = $DB->insert_record("certificatebeautiful_model", $data);
    }
    redirect("manage-model.php?id={$certificatebeautifulmodel->id}");
}

echo $OUTPUT->header();
$formcreate->display();
echo $OUTPUT->footer();
