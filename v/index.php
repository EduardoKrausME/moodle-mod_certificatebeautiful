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
 * Validate certificate instance.
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("../../../config.php");
global $PAGE, $USER, $CFG;

$code = optional_param('code', false, PARAM_TEXT);
$context = context_system::instance();

$PAGE->requires->css('/mod/certificatebeautiful/style.css');
$PAGE->set_context($context);
$PAGE->set_url('/mod/certificatebeautiful/v/', ['code' => $code]);
$PAGE->set_title(get_string('validate_certificate_title', 'certificatebeautiful'));
$PAGE->set_heading(format_string(get_string('validate_certificate_title', 'certificatebeautiful')));

echo $OUTPUT->header();


if ($code) {
    $certificatebeautifulissue = $DB->get_record('certificatebeautiful_issue', ["code" => $code]);
    if ($certificatebeautifulissue) {
        $data = [
            'code' => $certificatebeautifulissue->code,
            'urlcode' => "{$CFG->wwwroot}/mod/certificatebeautiful/v/?code={$certificatebeautifulissue->code}",
            'date' => userdate($certificatebeautifulissue->timecreated),
        ];

        $namefields = implode(",", \core_user\fields::get_name_fields());
        if ($user = $DB->get_record('user', ['id' => $certificatebeautifulissue->userid], $namefields)) {
            $data['username'] = fullname($user);
        }

        $cm = get_coursemodule_from_id('certificatebeautiful', $certificatebeautifulissue->cmid);
        if ($cm) {
            $data['name'] = $cm->name;
            $data['course'] = $DB->get_field('course', 'fullname', ['id' => $cm->course]);
        }
    } else {
        $data = [
            'message' => get_string('validate_certificate_notfound', 'certificatebeautiful')
        ];
        $code = false;
    }
    echo $OUTPUT->render_from_template('mod_certificatebeautiful/publicview', $data);
}

if (!$code) {
    $form = new \mod_certificatebeautiful\report\validate_certificate_form(
        "{$CFG->wwwroot}/mod/certificatebeautiful/v/");
    $form->display();
}

echo $OUTPUT->footer();
