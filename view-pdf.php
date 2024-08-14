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
 * view PDF file
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use mod_certificatebeautiful\local\model\form_create;
use mod_certificatebeautiful\local\model\form_create_page;

require_once('../../config.php');
require_once("{$CFG->libdir}/tablelib.php");

ob_start();

global $PAGE, $USER, $CFG;

$code = required_param('code', PARAM_TEXT);
$action = required_param('action', PARAM_TEXT);

/** @var \mod_certificatebeautiful\local\vo\certificatebeautiful_issue $certificatebeautifulissue */
$certificatebeautifulissue = $DB->get_record('certificatebeautiful_issue', ['code' => $code], '*', MUST_EXIST);

$cm = get_coursemodule_from_id('certificatebeautiful', $certificatebeautifulissue->cmid, 0, false, MUST_EXIST);
$course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);

/** @var \mod_certificatebeautiful\local\vo\certificatebeautiful $certificatebeautiful */
$certificatebeautiful = $DB->get_record('certificatebeautiful', ['id' => $cm->instance], '*', MUST_EXIST);

/** @var \mod_certificatebeautiful\local\vo\certificatebeautiful_model $certificatebeautifulmodel */
$certificatebeautifulmodel = $DB->get_record('certificatebeautiful_model', ['id' => $certificatebeautiful->model], "*", MUST_EXIST);
$certificatebeautifulmodel->pages_info_object = json_decode($certificatebeautifulmodel->pages_info);

$context = context_module::instance($cm->id);

require_course_login($cm->course);
require_capability('mod/certificatebeautiful:view', $context);

$username = fullname($USER);
$name = "{$certificatebeautiful->name} - {$username}.pdf";

switch ($action) {
    case 'view':
        header('Content-Type: application/pdf');
        header('Content-disposition: inline; filename="' . $name . '"');
        header('Cache-Control: public, must-revalidate, max-age=0');
        header('Pragma: public');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        break;
    case 'download':
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $name . '"');
        header('Cache-Control: public, must-revalidate, max-age=0');
        header('Pragma: public');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');

        header('Content-Description: File Transfer');
        header('Content-Transfer-Encoding: binary');
        break;

    default:
        die("OPS.....");
}

$fs = get_file_storage();
$filerecord = (object)[
    "component" => 'mod_certificatebeautiful',
    "contextid" => $context->id,
    "userid" => $USER->id,
    "filearea" => "certificate",
    "filepath" => '/',
    "itemid" => $USER->id,
    "filename" => "{$certificatebeautifulissue->code}.pdf",
];

$storedfile = $fs->get_file(
    $filerecord->contextid, $filerecord->component,
    $filerecord->filearea, $filerecord->itemid,
    $filerecord->filepath, $filerecord->filename);
if ($storedfile) {
    $content = $storedfile->get_content();

    header('Content-Length: ' . strlen($content));
    echo $content;
} else {
    require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/local/pdf/page_pdf.php");
    $pagepdf = new \mod_certificatebeautiful\local\pdf\page_pdf();
    $contentpdf = $pagepdf->create_pdf($certificatebeautiful, $certificatebeautifulissue, $certificatebeautifulmodel, $USER, $course);

    $fs->create_file_from_string($filerecord, $contentpdf);
    header('Content-Length: ' . strlen($contentpdf));
    echo $contentpdf;
}

die();
