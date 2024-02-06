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

require(__DIR__ . '/../../config.php');
require($CFG->libdir . '/tablelib.php');
require_once(__DIR__ . '/classes/model/form_create.php');
require_once(__DIR__ . '/classes/model/form_create_page.php');

global $PAGE, $USER, $CFG;

$id = required_param('id', PARAM_INT);

$PAGE->requires->css('/mod/certificatebeautiful/style.css');
$PAGE->set_context(context_system::instance());
$PAGE->set_url('/mod/certificatebeautiful/manage-model-list.php', ['id' => $id]);
require_login();

if ($id > 0) {
    /** @var \mod_certificatebeautiful\vo\certificatebeautiful_model $certificatebeautiful_model */
    $certificatebeautiful_model = $DB->get_record('certificatebeautiful_model', ['id' => $id], "*", MUST_EXIST);

    $PAGE->set_title($certificatebeautiful_model->name);
    $PAGE->set_heading(format_string($certificatebeautiful_model->name));

    $PAGE->navbar->add(get_string('list_model', 'certificatebeautiful'), "manage-model-list.php");
    $PAGE->navbar->add($certificatebeautiful_model->name, $PAGE->url);
} else {
    $certificatebeautiful_model = (object)["id" => -1, "name" => "", "pages_info" => "[]"];

    $PAGE->set_title(get_string('new_model', 'certificatebeautiful'));
    $PAGE->set_heading(format_string(get_string('new_model', 'certificatebeautiful')));

    $PAGE->navbar->add(get_string('list_model', 'certificatebeautiful'), "manage-model-list.php");
    $PAGE->navbar->add(get_string('new_model', 'certificatebeautiful'), $PAGE->url);
}

$certificatebeautiful_model->pages_info_object = json_decode($certificatebeautiful_model->pages_info);
if (optional_param("add-new", false, PARAM_RAW)) {
    $certificatebeautiful_model->pages_info_object[] = form_create_page::emptyPage();
}
if (count($certificatebeautiful_model->pages_info_object) == 0) {
    $certificatebeautiful_model->pages_info_object = [form_create_page::emptyPage()];
}

$form_create = new form_create(null, ["certificatebeautiful_model" => $certificatebeautiful_model]);
if ($form_create->is_cancelled()) {
    // redirect("manage-model-list.php");
} else if ($certificatebeautiful_model = $form_create->get_data()) {

    if ($id > 0) {
        $data = (object)[
            "id" => $certificatebeautiful_model->id,
            "name" => $certificatebeautiful_model->name,
            "timemodified" => time()
        ];
        $DB->update_record("certificatebeautiful_model", $data);
    } else {
        $data = (object)[
            "name" => $certificatebeautiful_model->name,
            "pages_info" => json_encode([form_create_page::emptyPage()], JSON_PRETTY_PRINT),
            "timecreated" => time(),
            "timemodified" => time()
        ];
        $certificatebeautiful_model->id = $DB->insert_record("certificatebeautiful_model", $data);
    }
    redirect("manage-model.php?id={$certificatebeautiful_model->id}");
}

echo $OUTPUT->header();
$form_create->display();
echo $OUTPUT->footer();
