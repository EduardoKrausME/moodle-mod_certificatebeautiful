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
 * manage-model-editpage file
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use core\output\notification;
use mod_certificatebeautiful\datainfo\help_base;
use mod_certificatebeautiful\form\changue_cert_info;
use mod_certificatebeautiful\model\get_template_file;
use mod_certificatebeautiful\vo\certificatebeautiful_model;

require_once("../../config.php");
require_once("{$CFG->libdir}/tablelib.php");
require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/model/get_template_file.php");
require_once("{$CFG->dirroot}/mod/certificatebeautiful/lib.php");

global $PAGE, $USER, $CFG;

$id = required_param("id", PARAM_INT);
$page = required_param("page", PARAM_INT);
$action = optional_param("action", "", PARAM_TEXT);

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url("/mod/certificatebeautiful/manage-model-list.php", ["id" => $id, "page" => $page, "action" => $action]);
$PAGE->add_body_class("certificatebeautiful-pages");

require_login();
require_capability("mod/certificatebeautiful:addinstance", $context);

/** @var certificatebeautiful_model $certificatebeautifulmodel */
$certificatebeautifulmodel = $DB->get_record("certificatebeautiful_model", ["id" => $id], "*", MUST_EXIST);
$certificatebeautifulmodel->pages_info_object = json_decode($certificatebeautifulmodel->pages_info);

$title = get_string("model_page_name", "certificatebeautiful", $page + 1);
$PAGE->set_title("{$certificatebeautifulmodel->name} - {$title}");
$PAGE->set_heading("{$certificatebeautifulmodel->name} - {$title}");

$PAGE->navbar->add(get_string("list_model", "certificatebeautiful"), "manage-model-list.php");
if (!$id) {
    $PAGE->navbar->add(get_string("new_model", "certificatebeautiful"), "manage-model.php?id={$certificatebeautifulmodel->id}");
}

$certificatebeautifulmodel->pages_info_object = json_decode($certificatebeautifulmodel->pages_info, true);

$cssdata = optional_param("cssdata", false, PARAM_RAW);
$htmldata = optional_param("htmldata", false, PARAM_RAW);
if ($cssdata && $htmldata && sesskey() == optional_param("sesskey", false, PARAM_RAW)) {

    $cssdata = preg_replace('/\*(\s+)?\{.*?\}|body(\s+)?\{.*?\}/', "", $cssdata);
    $htmldata = preg_replace('/<body>(.*)<\/body>/', "$1", $htmldata);

    $certificatebeautifulmodel->pages_info_object[$page] = [
        "htmldata" => $htmldata,
        "cssdata" => $cssdata,
    ];

    $model = (object)[
        "id" => $certificatebeautifulmodel->id,
        "pages_info" => json_encode($certificatebeautifulmodel->pages_info_object, JSON_PRETTY_PRINT),
        "timemodified" => time(),
    ];
    $DB->update_record("certificatebeautiful_model", $model);
    redirect("manage-model.php?id={$id}");
}

switch ($action) {
    case "changemodel":
        $PAGE->navbar->add(get_string("edit_page", "certificatebeautiful"));
        $PAGE->navbar->add(get_string("select_model", "certificatebeautiful"));

        echo $OUTPUT->header();

        $models = certificatebeautiful_list_all_models();

        if ($certificatebeautifulmodel->orientation == "L") {
            $orientation = get_string("model_orientation_l", "certificatebeautiful");
        } else {
            $orientation = get_string("model_orientation_p", "certificatebeautiful");
        }
        $message = get_string("only_format", "certificatebeautiful", $orientation);
        echo $PAGE->get_renderer("core")->render(new notification($message, notification::NOTIFY_WARNING));

        $data = ["pages" => [], "class-root" => "d-flex flex-wrap certificate-flex-gap"];
        foreach ($models as $model) {

            if ($model["orientation"] != $certificatebeautifulmodel->orientation) {
                continue;
            }

            $unique = uniqid();

            $htmldata = file_get_contents(__DIR__ . "/_editor/_model/{$model["key"]}/index.html");
            $htmldata = str_replace("[data-gjs-type=wrapper]", ".body-{$unique}", $htmldata);
            $htmldata = "<div class='body-{$unique}'>{$htmldata}</div>";

            $data["pages"][] = [
                "title" => $model["name"],
                "pagina" => $htmldata,
                "addpage_title" => get_string("using_this_page", "certificatebeautiful"),
                "addpage_href" => "manage-model-editpage.php?id={$id}&page={$page}&model={$model["key"]}&action=changue",
                "zoom" => true,
            ];
        }
        echo $OUTPUT->render_from_template("mod_certificatebeautiful/list-certificate", $data);

        echo $OUTPUT->footer();
        break;

    case "changue":
        $model = required_param("model", PARAM_TEXT);
        $page = required_param("page", PARAM_INT);

        $htmldata = get_template_file::load_template_file($model);

        $certificatebeautifulmodel->pages_info_object[$page] = [
            "htmldata" => $htmldata,
            "cssdata" => "",
        ];

        $model = (object)[
            "id" => $certificatebeautifulmodel->id,
            "pages_info" => json_encode($certificatebeautifulmodel->pages_info_object, JSON_PRETTY_PRINT),
            "timemodified" => time(),
        ];
        $DB->update_record("certificatebeautiful_model", $model);
        redirect("manage-model-editpage.php?id={$id}&page={$page}");
        break;

    case "changeupload":
        $PAGE->navbar->add(get_string("edit_page", "certificatebeautiful"));
        $PAGE->navbar->add(get_string("select_model", "certificatebeautiful"));

        echo $OUTPUT->header();

        $model = $DB->get_record("certificatebeautiful_model", ["id" => $id]);
        $model->pages_info_object = json_decode($model->pages_info);

        $info = new changue_cert_info(null, [
            "id" => $id,
            "page" => $page,
            "action" => $action,
            "orientation" => $certificatebeautifulmodel->orientation,
        ]);

        if ($info->is_cancelled()) {
            redirect("manage-model-editpage.php?id={$id}&page={$page}");
        } else if ($data = $info->get_data()) {

            $fs = get_file_storage();
            $contextuser = context_user::instance($USER->id);
            $files = $fs->get_area_files($contextuser->id, "user", "draft", $data->background, "filesize DESC");
            /** @var stored_file $file */
            $file = reset($files);
            if ($file) {
                $filecontents = $file->get_content();
                $base64 = base64_encode($filecontents);
                $dataurl = "data:{$file->get_mimetype()};base64,{$base64}";

                $model->pages_info_object[$page]->cssdata .= "\n[data-gjs-type=wrapper]{background-image:url({$dataurl})}";

                $model->pages_info = json_encode($model->pages_info_object, JSON_PRETTY_PRINT);
                $model->timemodified = time();
                $DB->update_record("certificatebeautiful_model", $model);

                redirect("manage-model-editpage.php?id={$id}&page={$page}");
            }
        }

        $info->display();

        echo $OUTPUT->footer();
        break;

    default:
        $PAGE->navbar->add(get_string("edit_page", "certificatebeautiful"));
        echo $OUTPUT->header();

        $data = [
            "url-changemodel" => "?id={$id}&page={$page}&action=changemodel",
            "url-changeupload" => "?id={$id}&page={$page}&action=changeupload",
            "url-setting" => "{$CFG->wwwroot}/admin/settings.php?section=modsettingcertificatebeautiful",
            "iframe-url" => "{$CFG->wwwroot}/mod/certificatebeautiful/_editor/index.php?id={$id}&page={$page}",
            "form_components" => help_base::get_form_components(),
        ];
        echo $OUTPUT->render_from_template("mod_certificatebeautiful/editpage", $data);

        echo $OUTPUT->footer();
}
