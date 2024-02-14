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

$courseid = optional_param('course', 0, PARAM_INT);
$course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url('/mod/certificatebeautiful/reports.php', array('course' => $courseid));
$PAGE->set_title("{$course->shortname}: " . get_string('reports'));
$PAGE->set_heading($course->fullname . ": " . get_string('modulename', 'certificatebeautiful'));

require_course_login($course);
require_capability('mod/certificatebeautiful:viewreport', $context);

echo $OUTPUT->header();

$title = get_string('reports') . ": " . get_string('modulename', 'certificatebeautiful');
echo $OUTPUT->heading($title, 2, 'main', 'certificatebeautifulheading');

$sql = "SELECT cm.*, cb.name
          FROM {course_modules} cm
          JOIN {modules}        md ON md.id = cm.module
          JOIN {certificatebeautiful} cb ON cb.id = cm.instance
         WHERE cb.course = :course
           AND md.name   = 'certificatebeautiful'";
$certificatebeautifuls = $DB->get_records_sql($sql, ["course" => $courseid]);
$reportnode = ["children" => []];
foreach ($certificatebeautifuls as $certificatebeautiful) {
    $reportnode["children"][] = [
        "display" => true,
        "action" => "{$CFG->wwwroot}/mod/certificatebeautiful/report.php?id={$certificatebeautiful->id}",
        "text" => "{$certificatebeautiful->name}",
    ];
}

echo $OUTPUT->render_from_template('core/report_link_page', ['node' => $reportnode]);

echo $OUTPUT->footer();
