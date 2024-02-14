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
 * Report for certificatebeautiful.
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once("{$CFG->libdir}/tablelib.php");
require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/report/certificatebeautiful_view.php");

$id = optional_param('id', 0, PARAM_INT);

$cm = get_coursemodule_from_id('certificatebeautiful', $id, 0, false, MUST_EXIST);
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);
$certificatebeautiful = $DB->get_record('certificatebeautiful', array('id' => $cm->instance), '*', MUST_EXIST);

$context = context_module::instance($cm->id);

require_course_login($course, true, $cm);
require_capability('mod/certificatebeautiful:viewreport', $context);

if (optional_param('action', false, PARAM_TEXT) == 'delete') {
    require_sesskey();
    $issueid = required_param('issueid', PARAM_INT);

    /** @var \mod_certificatebeautiful\vo\certificatebeautiful_issue $certificatebeautifulissue */
    $certificatebeautifulissue = $DB->get_record('certificatebeautiful_issue', ['id' => $issueid]);

    $DB->delete_records('certificatebeautiful_issue', ['id' => $issueid]);

    $fs = get_file_storage();
    $filerecord = (object)[
        "component" => 'mod_certificatebeautiful',
        "contextid" => $context->id,
        "filearea" => "certificate",
        "filepath" => '/',
        "itemid" => $certificatebeautifulissue->userid,
        "filename" => "{$certificatebeautifulissue->code}.pdf",
    ];

    $storedfile = $fs->get_file(
        $filerecord->contextid, $filerecord->component,
        $filerecord->filearea, $filerecord->itemid,
        $filerecord->filepath, $filerecord->filename);

    redirect(new moodle_url("/mod/certificatebeautiful/report.php", ["id" => $id]),
        get_string('report_deleted_certificate', 'certificatebeautiful'));
}

$table = new \mod_certificatebeautiful\report\certificatebeautiful_view(
    "certificatebeautiful_report", $cm->id, $certificatebeautiful);

if (!$table->is_downloading()) {
    $PAGE->set_context($context);
    $PAGE->set_url('/mod/certificatebeautiful/report.php', array('id' => $cm->id));
    $PAGE->set_title("{$course->shortname}: {$certificatebeautiful->name}");
    $PAGE->set_heading($course->fullname);
    echo $OUTPUT->header();

    $title = get_string('report_filename', 'certificatebeautiful');
    echo $OUTPUT->heading($title, 2, 'main', 'certificatebeautifulheading');
}

$table->define_baseurl("{$CFG->wwwroot}/mod/certificatebeautiful/report.php?id={$cm->id}");
$table->out(40, true);

if (!$table->is_downloading()) {
    echo $OUTPUT->footer();
}
