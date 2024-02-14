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

require_once('../../config.php');
require_once("{$CFG->libdir}/tablelib.php");
require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/model/get_template_file.php");

global $PAGE, $USER, $CFG;

$id = required_param('id', PARAM_INT);
$page = required_param('page', PARAM_INT);
$action = optional_param('action', '', PARAM_TEXT);

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url('/mod/certificatebeautiful/manage-model-list.php', ['id' => $id]);

require_login();
require_capability('mod/certificatebeautiful:addinstance', $context);

/** @var \mod_certificatebeautiful\vo\certificatebeautiful_model $certificatebeautifulmodel */
$certificatebeautifulmodel = $DB->get_record('certificatebeautiful_model', ['id' => $id], "*", MUST_EXIST);
$certificatebeautifulmodel->pages_info_object = json_decode($certificatebeautifulmodel->pages_info);

$title = get_string('model_page_name', 'certificatebeautiful', $page + 1);
$PAGE->set_title("{$certificatebeautifulmodel->name} - {$title}");
$PAGE->set_heading("{$certificatebeautifulmodel->name} - {$title}");

$PAGE->navbar->add(get_string('list_model', 'certificatebeautiful'), "manage-model-list.php");
$PAGE->navbar->add(get_string('new_model', 'certificatebeautiful'), "manage-model.php?id={$certificatebeautifulmodel->id}");

$certificatebeautifulmodel->pages_info_object = json_decode($certificatebeautifulmodel->pages_info);

if (sesskey() == optional_param('sesskey', false, PARAM_RAW)) {

    $cssdata = required_param("cssdata", PARAM_RAW);
    $cssdata = preg_replace('/\*(\s+)?\{.*?\}|body(\s+)?\{.*?\}/', '', $cssdata);

    $htmldata = required_param("htmldata", PARAM_RAW);
    $htmldata = preg_replace('/<body>(.*)<\/body>/', '$1', $htmldata);

    $certificatebeautifulmodel->pages_info_object[$page] = [
        "htmldata" => $htmldata,
        "cssdata" => $cssdata,
    ];

    $data = (object)[
        "id" => $certificatebeautifulmodel->id,
        "pages_info" => json_encode($certificatebeautifulmodel->pages_info_object, JSON_PRETTY_PRINT),
        "timemodified" => time()
    ];
    $DB->update_record("certificatebeautiful_model", $data);
    redirect("manage-model.php?id={$id}");
}

switch ($action) {
    case 'changemodel':
        $PAGE->navbar->add(get_string('edit_page', 'certificatebeautiful'));
        $PAGE->navbar->add(get_string('select_model', 'certificatebeautiful'));

        echo $OUTPUT->header();

        $data = ["pages" => [], "class-root" => "d-flex flex-wrap certificate-flex-gap"];

        $modelfiles = glob("{$CFG->dirroot}/mod/certificatebeautiful/_editor/_model/*/index.html");
        foreach ($modelfiles as $modelfile) {

            $model = pathinfo(pathinfo($modelfile, PATHINFO_DIRNAME), PATHINFO_BASENAME);
            $htmldata = \mod_certificatebeautiful\model\get_template_file::load_template_file($model);

            $htmldata = str_replace("[data-gjs-type=wrapper]", ".body-{$model}", $htmldata);
            $htmldata = "<div class='body-{$model}'>{$htmldata}</div>";

            $data["pages"][] = [
                "title" => get_string($model, 'certificatebeautiful'),
                "pagina" => $htmldata,
                "addpage_title" => get_string('using_this_page', 'certificatebeautiful'),
                "addpage_href" => "?id={$id}&page={$page}&action=changue&model={$model}"
            ];
        }
        echo $OUTPUT->render_from_template('mod_certificatebeautiful/list-pages', $data);

        echo $OUTPUT->footer();
        break;

    case 'changue':
        $model = optional_param('model', '', PARAM_TEXT);

        $htmldata = \mod_certificatebeautiful\model\get_template_file::load_template_file($model);

        $certificatebeautifulmodel->pages_info_object[$page] = [
            "htmldata" => $htmldata,
            "cssdata" => "",
        ];

        $data = (object)[
            "id" => $certificatebeautifulmodel->id,
            "pages_info" => json_encode($certificatebeautifulmodel->pages_info_object, JSON_PRETTY_PRINT),
            "timemodified" => time()
        ];
        $DB->update_record("certificatebeautiful_model", $data);
        redirect("manage-model-editpage.php?id={$id}&page={$page}");
        break;

    default:
        $PAGE->navbar->add(get_string('edit_page', 'certificatebeautiful'));
        echo $OUTPUT->header();

        $data = [
            "url-changemodel" => "?id={$id}&page={$page}&action=changemodel",
            "url-setting" => "{$CFG->wwwroot}/admin/settings.php?section=modsettingcertificatebeautiful",
            "iframe-url" => "{$CFG->wwwroot}/mod/certificatebeautiful/_editor/index.php?id={$id}&page={$page}",
            "form_components"=>\mod_certificatebeautiful\help\help_base::get_form_components()
        ];
        echo $OUTPUT->render_from_template('mod_certificatebeautiful/editpage', $data);

        echo $OUTPUT->footer();
}

