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
 * index file
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo kraus (http://eduardokraus.com)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use mod_certificatebeautiful\event\course_module_instance_list_viewed;

require_once(dirname(dirname(dirname(__FILE__))) . "/config.php");
require_once(dirname(__FILE__) . "/lib.php");

$id = required_param("id", PARAM_INT); // Course.

$course = $DB->get_record("course", ["id" => $id], "*", MUST_EXIST);

require_course_login($course);

$params = [
    "context" => context_course::instance($course->id),
];
$event = course_module_instance_list_viewed::create($params);
$event->add_record_snapshot("course", $course);
$event->trigger();

$strname = get_string("modulenameplural", "mod_certificatebeautiful");
$PAGE->set_url("/mod/certificatebeautiful/index.php", ["id" => $id]);
$PAGE->navbar->add($strname);
$PAGE->set_title("$course->shortname: $strname");
$PAGE->set_heading($course->fullname);
$PAGE->set_pagelayout("incourse");

echo $OUTPUT->header();
$usesections = course_format_uses_sections($course->format);

if ($usesections) {
    $sortorder = "cw.section ASC";
} else {
    $sortorder = "m.timemodified DESC";
}

if (!$certificatebeautifuls = get_all_instances_in_course("certificatebeautiful", $course)) {
    notice(get_string("thereareno", "moodle", get_string("modulenameplural", "mod_certificatebeautiful")));
    exit;
}

$table = new html_table();

$table->head = [get_string("sectionname", "format_" . $course->format), get_string("name")];
$table->align = ["center", "left", "left"];

$showreport = false;
if (has_capability("mod/certificatebeautiful:viewreport", context_system::instance())) {
    $table->head[] = get_string("report", "mod_certificatebeautiful");
    $table->align[] = "left";
    $showreport = true;
}

foreach ($certificatebeautifuls as $certificatebeautiful) {
    $tt = "&nbsp;";
    if ($certificatebeautiful->section) {
        $tt = get_section_name($course, $certificatebeautiful->section);
    }

    $data = [
        $tt,
        html_writer::link("view.php?id=" . $certificatebeautiful->coursemodule, format_string($certificatebeautiful->name)),
    ];

    if ($showreport) {
        $data[] = html_writer::link("report.php?id={$certificatebeautiful->coursemodule}",
            get_string("report_title", "mod_certificatebeautiful"));
    }

    $table->data[] = $data;
}

echo html_writer::table($table);
echo $OUTPUT->footer();
