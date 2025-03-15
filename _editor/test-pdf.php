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
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("../../../config.php");
require_once("{$CFG->libdir}/tablelib.php");
require_once("{$CFG->dirroot}/mod/certificatebeautiful/lib.php");

ob_start();

global $PAGE, $USER, $CFG;

$PAGE->set_context(context_system::instance());

require_login();
$context = context_system::instance();
require_capability("mod/certificatebeautiful:addinstance", $context);

$id = optional_param("id", false, PARAM_INT);
$htmldata = optional_param("htmldata", false, PARAM_RAW);
$cssdata = optional_param("cssdata", false, PARAM_RAW);

if ($temp = optional_param("temp", false, PARAM_TEXT)) {
    $temp = preg_replace('/[^0-9a-z]/', "", $temp);
    $tempdir = make_temp_directory("certificatebeautiful");
    $file = "{$tempdir}/{$temp}.pdf";
    echo file_get_contents($file);
    @unlink($file);
    die;
}

if ($id) {
    /** @var \mod_certificatebeautiful\vo\certificatebeautiful_model $model */
    $model = $DB->get_record("certificatebeautiful_model", ["id" => $id], "*", MUST_EXIST);
}

if ($htmldata && $cssdata) {
    require_sesskey();
    $model->pages_info_object = [
        (object)[
            "htmldata" => $htmldata,
            "cssdata" => $cssdata
        ]
    ];
} else {
    if ($id === false) {
        foreach (certificatebeautiful_list_all_models() as $key => $model) {
            echo "<p><a href='?id={$key}'>{$model["key"]}</a></p>";
        }

        echo "<h4><a href='?id=-2'>Abrir todos os certificados</a></p>";

        die();
    } else if ($id == -2) {
        $model->pages_info_object = [];
        foreach (certificatebeautiful_list_all_models() as $key => $model) {
            $model->pages_info_object[] = (object)[
                "htmldata" => \mod_certificatebeautiful\model\get_template_file::load_template_file($model["key"]),
                "cssdata" => ""
            ];
        }
    } else {
        if ($id == -1) {
            $model->name = "sumary-secound-page";
            $model->pages_info_object = [
                (object)[
                    "htmldata" => \mod_certificatebeautiful\model\get_template_file::load_template_file("sumary-secound-page"),
                    "cssdata" => ""
                ]
            ];
        } else {
            $models = certificatebeautiful_list_all_models();
            $model = $models[$id];

            $model->name = $model["key"];
            $model->pages_info_object = [
                (object)[
                    "htmldata" => \mod_certificatebeautiful\model\get_template_file::load_template_file($model["key"]),
                    "cssdata" => ""
                ],
                (object)[
                    "htmldata" => \mod_certificatebeautiful\model\get_template_file::load_template_file("sumary-secound-page"),
                    "cssdata" => ""
                ]
            ];
        }
    }
}

/** @var \mod_certificatebeautiful\vo\certificatebeautiful $certificatebeautiful */
$certificatebeautiful = (object)[
    "name" => "teste",
    "description" => get_string("default-description", "certificatebeautiful")
];

/** @var \mod_certificatebeautiful\vo\certificatebeautiful_issue $certificatebeautifulissie */
$certificatebeautifulissie = (object)[
    "name" => "teste",
    "code" => "CODE-EX",
    "timecreated" => time(),
];

$order = "";
if ($DB->get_dbfamily() == "mysql") {
    $order = "ORDER BY RAND()";
} else if ($DB->get_dbfamily() === "postgres") {
    $order = "ORDER BY RANDOM()";
}

$user = $DB->get_record_sql("SELECT   * FROM {user}   WHERE id >= 2 {$order} LIMIT 1");
$course = $DB->get_record_sql("SELECT * FROM {course} WHERE id > 1  {$order} LIMIT 1");

$pagepdf = new \mod_certificatebeautiful\pdf\page_pdf();
$pdf = $pagepdf->create_pdf($certificatebeautiful, $certificatebeautifulissie, $model, $user, $course);

$tempfilename = uniqid();
$tempdir = make_temp_directory("certificatebeautiful");
file_put_contents("{$tempdir}/{$tempfilename}.pdf", $pdf);

////echo "<a href=\"{$CFG->wwwroot}/mod/certificatebeautiful/_editor/test-pdf.php?temp={$tempfilename}\" target=aaaa>aaaa</a>";
$urlgetpdf = urlencode("{$CFG->wwwroot}/mod/certificatebeautiful/_editor/test-pdf.php?temp={$tempfilename}");
header("Location: {$CFG->wwwroot}/mod/certificatebeautiful/_pdfjs-2.8.335-legacy/web/viewer.html?file={$urlgetpdf}");
