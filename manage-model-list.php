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
 * manage-model-list file
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use mod_certificatebeautiful\model\table_list;
use mod_certificatebeautiful\models;

require_once("../../config.php");
require_once("{$CFG->libdir}/tablelib.php");
require_once(__DIR__ . "/lib.php");

global $PAGE, $USER, $CFG;

$context = context_system::instance();
$PAGE->add_body_class("certificatebeautiful-pages");
$PAGE->set_context($context);
$PAGE->set_url("/mod/certificatebeautiful/manage-model-list.php");
$PAGE->set_title(get_string("list_model", "certificatebeautiful"));

require_login();
require_capability("mod/certificatebeautiful:addinstance", $context);

$PAGE->set_heading(format_string(get_string("list_model", "certificatebeautiful")));

$PAGE->navbar->add(get_string("list_model", "certificatebeautiful"), $PAGE->url);

echo $OUTPUT->header();

echo $OUTPUT->render_from_template("mod_certificatebeautiful/heading-addnew", [
    "url" => "manage-model.php?id=-1",
    "text" => get_string("add_new_model", "certificatebeautiful"),
]);

$models = $DB->get_records("certificatebeautiful_model");
models::order($models);
$data = ["pages" => [], "class-root" => "d-flex flex-wrap certificate-flex-gap"];
foreach ($models as $model) {
    $pagesinfo = json_decode($model->pages_info, true);

    $htmldata = "{$pagesinfo[0]["htmldata"]}<style>{$pagesinfo[0]["cssdata"]}</style>";
    $htmldata = str_replace("[data-gjs-type=wrapper]", ".body-{$model->id}", $htmldata);
    $htmldata = "<div class='body-{$model->id}'>{$htmldata}</div>";

    $data["pages"][] = [
        "title" => $model->name,
        "pagina" => $htmldata,
        "addpage_title" => get_string("select_model", "certificatebeautiful"),
        "addpage_href" => "manage-model.php?id={$model->id}",
        "zoom" => true,
    ];
}
echo $OUTPUT->render_from_template("mod_certificatebeautiful/list-certificate", $data);

echo $OUTPUT->footer();
