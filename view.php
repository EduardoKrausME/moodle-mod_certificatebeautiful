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
 * Prints an instance of mod_certificatebeautiful.
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/issue.php");

global $PAGE, $USER, $CFG;

$id = required_param('id', PARAM_INT);

$cm = get_coursemodule_from_id('certificatebeautiful', $id, 0, false, MUST_EXIST);
$course = $DB->get_record('course', array('id' => $cm->course), '*', MUST_EXIST);

/** @var \mod_certificatebeautiful\vo\certificatebeautiful $certificatebeautiful */
$certificatebeautiful = $DB->get_record('certificatebeautiful', array('id' => $cm->instance), '*', MUST_EXIST);

$context = context_module::instance($cm->id);

$PAGE->requires->css('/mod/certificatebeautiful/style.css');
$PAGE->set_context($context);
$PAGE->set_url('/mod/certificatebeautiful/view.php', ['id' => $id]);
$PAGE->set_title($course->shortname . ': ' . $PAGE->activityrecord->name);
$PAGE->set_heading(format_string($course->fullname));

require_course_login($course, true, $cm);
require_capability('mod/certificatebeautiful:view', $context);

$event = \mod_certificatebeautiful\event\course_module_viewed::create(array(
    'objectid' => $PAGE->cm->instance,
    'context' => $PAGE->context,
));
$event->add_record_snapshot('course', $PAGE->course);
$event->add_record_snapshot($PAGE->cm->modname, $certificatebeautiful);
$event->trigger();

// Update 'viewed' state if required by completion system.
$completion = new completion_info($course);
$completion->set_module_viewed($cm);

echo $OUTPUT->header();

if (has_capability('mod/certificatebeautiful:addinstance', $context)) {

    $title = get_string('report_filename', 'certificatebeautiful');
    echo $OUTPUT->heading($title, 2, 'main', 'certificatebeautifulheading');

    $table = new \mod_certificatebeautiful\report\certificatebeautiful_view(
        "certificatebeautiful_report", $cm->id, $certificatebeautiful);
    $table->define_baseurl("{$CFG->wwwroot}/mod/certificatebeautiful/report.php?id={$cm->id}");
    $table->out(40, true);

} else {

    $certificatebeautifulissue = \mod_certificatebeautiful\issue::get($USER, $certificatebeautiful, $cm);
    $viewerurl = "{$CFG->wwwroot}/mod/certificatebeautiful/_pdfjs-2.8.335-legacy/web/viewer.html";
    $urlbase = "{$CFG->wwwroot}/mod/certificatebeautiful/view-pdf.php?issueid={$certificatebeautifulissue->id}";
    $data = [
        'issueid' => $certificatebeautifulissue->id,
        'pdf-viewer-url' => "{$viewerurl}?file=" . urlencode("{$urlbase}&action=view"),
        'pdf-url_base' => $urlbase,
    ];
    echo $OUTPUT->render_from_template('mod_certificatebeautiful/view', $data);
}

echo $OUTPUT->footer();
