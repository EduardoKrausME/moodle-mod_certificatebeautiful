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
 * Course report list for certificatebeautiful.
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once("{$CFG->libdir}/tablelib.php");

$courseid = optional_param("course", 0, PARAM_INT);
$course = $DB->get_record("course", ["id" => $courseid], '*', MUST_EXIST);

$context = context_course::instance($course->id);
$PAGE->set_context($context);
$PAGE->set_url('/mod/certificatebeautiful/reports.php', ["course" => $courseid]);
$PAGE->set_title("{$course->shortname}: " . get_string("reports"));
$PAGE->set_heading("{$course->fullname}: " . get_string("modulename", "certificatebeautiful"));
$PAGE->add_body_class("certificatebeautiful-pages");

require_course_login($course);

echo $OUTPUT->header();

$title = get_string("reports") . ": " . get_string("modulename", "certificatebeautiful");
echo $OUTPUT->heading($title, 2, "main", "certificatebeautifulheading");

$sql = "SELECT cm.*, cb.name
          FROM {course_modules}       cm
          JOIN {modules}              md ON md.id = cm.module
          JOIN {certificatebeautiful} cb ON cb.id = cm.instance
         WHERE cb.course = :course
           AND md.name   = 'certificatebeautiful'";
$certificatebeautifuls = $DB->get_records_sql($sql, ["course" => $courseid]);

$reportnode = ["children" => []];
foreach ($certificatebeautifuls as $certificatebeautiful) {
    $modulecontext = context_module::instance($certificatebeautiful->id);
    if (!has_capability("mod/certificatebeautiful:viewreport", $modulecontext)) {
        continue;
    }

    $reportnode["children"][] = [
        "display" => true,
        "action" => "{$CFG->wwwroot}/mod/certificatebeautiful/report.php?id={$certificatebeautiful->id}",
        "text" => format_string($certificatebeautiful->name),
    ];
}

if ($reportnode["children"]) {
    echo $OUTPUT->render_from_template('core/report_link_page', ["node" => $reportnode]);
} else {
    echo $OUTPUT->notification(get_string("nothingtodisplay"), "info");
}

echo $OUTPUT->footer();
