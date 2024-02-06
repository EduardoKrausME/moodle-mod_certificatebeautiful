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
 * Library of interface functions and constants.
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Checks if certificate activity supports a specific feature.
 *
 * @uses FEATURE_GROUPS
 * @uses FEATURE_GROUPINGS
 * @uses FEATURE_MOD_INTRO
 * @uses FEATURE_SHOW_DESCRIPTION
 * @uses FEATURE_COMPLETION_TRACKS_VIEWS
 * @uses FEATURE_COMPLETION_HAS_RULES
 * @uses FEATURE_MODEDIT_DEFAULT_COMPLETION
 * @uses FEATURE_BACKUP_MOODLE2
 * @param string $feature FEATURE_xx constant for requested feature
 * @return mixed True if module supports feature, false if not, null if doesn't know
 */
function certificatebeautiful_supports(string $feature) {
    switch ($feature) {
        case FEATURE_GROUPS:
            return true;
        case FEATURE_GROUPINGS:
            return true;
        case FEATURE_MOD_INTRO:
            return true;
        case FEATURE_SHOW_DESCRIPTION:
            return true;
        case FEATURE_COMPLETION_TRACKS_VIEWS:
            return true;
        case FEATURE_MODEDIT_DEFAULT_COMPLETION:
            return true;
        case FEATURE_BACKUP_MOODLE2:
            return true;
        case FEATURE_MOD_PURPOSE:
            return MOD_PURPOSE_ASSESSMENT;
        default:
            return null;
    }
}

/**
 * Saves a new instance of the mod_certificatebeautiful into the database.
 *
 * Given an object containing all the necessary data, (defined by the form
 * in mod_form.php) this function will create a new instance and return the id
 * number of the instance.
 *
 * @param stdClass $data An object from the form.
 * @param mod_certificatebeautiful_mod_form $mform The form.
 * @return int The id of the newly inserted record.
 * @throws dml_exception
 */
function certificatebeautiful_add_instance(stdClass $data, mod_certificatebeautiful_mod_form $mform = null): int {
    global $DB;

    $data->timecreated = time();
    $cmid = $data->coursemodule;

    $data->id = $DB->insert_record('certificatebeautiful', $data);

    // We need to use context now, so we need to make sure all needed info is already in db.
    $DB->set_field('course_modules', 'instance', $data->id, ['id' => $cmid]);

    return $data->id;
}

/**
 * Updates an instance of the mod_certificatebeautiful in the database.
 *
 * Given an object containing all the necessary data (defined in mod_form.php),
 * this function will update an existing instance with new data.
 *
 * @param stdClass $data An object from the form in mod_form.php.
 * @param mod_certificatebeautiful_mod_form $mform The form.
 * @return bool True if successful, false otherwise.
 * @throws dml_exception
 */
function certificatebeautiful_update_instance(stdClass $data, mod_certificatebeautiful_mod_form $mform = null): bool {
    global $DB;

    $data->timemodified = time();
    $data->id = $data->instance;

    return $DB->update_record('certificatebeautiful', $data);
}

/**
 * Removes an instance of the mod_certificatebeautiful from the database.
 *
 * @param int $id Id of the module instance.
 * @return bool True if successful, false on failure.
 * @throws coding_exception
 * @throws dml_exception
 */
function certificatebeautiful_delete_instance(int $id): bool {
    global $DB;

    if (!$DB->record_exists('certificatebeautiful', ['id' => $id])) {
        return false;
    }

    if (!$cm = get_coursemodule_from_instance('certificatebeautiful', $id)) {
        return false;
    }
    $DB->delete_records('certificatebeautiful', ['id' => $id]);

    return true;
}

/**
 * Return a list of page types
 *
 * @param string $pagetype current page type
 * @param stdClass $parentcontext Block's parent context
 * @param stdClass $currentcontext Current context of block
 * @return array array of page types and it's names
 * @throws coding_exception
 */
function certificatebeautiful_page_type_list($pagetype, $parentcontext, $currentcontext): array {
    $modulepagetype = [
        'mod-certificatebeautiful-*' => get_string('page-mod-certificatebeautiful-x', 'mod_certificatebeautiful'),
    ];
    return $modulepagetype;
}

/**
 * Callback for tool_certificate - the fields available for the certificates
 * @throws coding_exception
 */
function mod_certificatebeautiful_tool_certificate_fields() {
    global $CFG;

    if (!class_exists('tool_certificate\customfield\issue_handler')) {
        return;
    }

    $handler = tool_certificate\customfield\issue_handler::create();
    $gradestring = get_string('gradenoun');

    // TODO: the only currently supported field types are text/textarea (numeric will fallback to text).
    $handler->ensure_field_exists('courseid', 'numeric',
        get_string('courseinternalid', 'certificatebeautiful'), false, 1);
    $handler->ensure_field_exists('courseshortname', 'text', get_string('shortnamecourse'),
        true, get_string('previewcourseshortname', 'certificatebeautiful'));
    $handler->ensure_field_exists('coursefullname', 'text', get_string('fullnamecourse'),
        true, get_string('previewcoursefullname', 'certificatebeautiful'));
    $handler->ensure_field_exists('courseurl', 'text',
        get_string('courseurl', 'certificatebeautiful'),
        true, $CFG->wwwroot . '/course/view.php?id=1');
    $handler->ensure_field_exists(
        'coursecompletiondate',
        'text',
        get_string('course') . ': ' . get_string('coursecompletiondate', 'certificatebeautiful'),
        true,
        get_string('coursecompletiondate', 'certificatebeautiful')
    );
    $handler->ensure_field_exists(
        'coursegrade',
        'text',
        get_string('course') . ': ' . $gradestring,
        true,
        $gradestring
    );

    // Get the course custom fields (note the only supported field types are text/textarea).
    $coursehandler = \core_course\customfield\course_handler::create();
    foreach ($coursehandler->get_fields() as $field) {
        $handler->ensure_field_exists(
            'coursecustomfield_' . $field->get('shortname'),
            $field->get('type'),
            get_string('course') . ': ' . $field->get_formatted_name(),
            true,
            $field->get_formatted_name()
        );
    }
}

/**
 * This function is used by the reset_course_userdata function in moodlelib.
 *
 * @param stdClass $data the data submitted from the reset course.
 * @return array status array
 * @throws coding_exception
 * @throws dml_exception
 */
function certificatebeautiful_reset_userdata($data) {
    global $DB;

    $status = [];
    $key = 'archive_certificates';

    if (!empty($data->$key)) {
        // Archive all issued certificates in this course (but only for the templates that are currently configured in
        // instances of mod_certificatebeautiful in this course).
        $certificates = get_coursemodules_in_course('certificatebeautiful', $data->courseid, 'm.template');
        foreach ($certificates as $certificate) {
            $DB->execute('UPDATE {certificatebeautiful_issue} SET archived = 1
                             WHERE courseid = ? AND templateid = ? AND component = ? AND archived = 0',
                [$data->courseid, $certificate->template, 'certificatebeautiful']);
        }

        $status[] = [
            'component' => get_string('modulenameplural', 'certificatebeautiful'),
            'item' => get_string('certificatesarchived', 'certificatebeautiful'),
            'error' => false,
        ];

    }

    return $status;
}

/**
 * The elements to add the course reset form.
 *
 * @param MoodleQuickForm $mform
 * @throws coding_exception
 */
function certificatebeautiful_reset_course_form_definition($mform) {
    $mform->addElement('header', 'certificatebeautifulheader', get_string('modulenameplural', 'certificatebeautiful'));
    $mform->addElement('checkbox', 'archive_certificates', get_string('archivecertificates', 'certificatebeautiful'));
    $mform->addHelpButton('archive_certificates', 'archivecertificates', 'mod_certificatebeautiful');
}

/**
 * Course reset form defaults
 *
 * @param stdClass $course
 * @return array
 */
function certificatebeautiful_reset_course_form_defaults($course) {
    return [
        'archive_certificates' => 1,
    ];
}

/**
 * Callback from modinfo allowing to add attributes to individual student link
 *
 * @param cm_info $coursemodule the cm_info object for the Appointment instance
 * @throws moodle_exception
 */
function mod_certificatebeautiful_cm_info_dynamic(cm_info $coursemodule) {
    // In case when user can only download their own certificate and do nothing else -
    // take them directly to their certificate (open in a new window).
    $fullurl = new moodle_url("/mod/certificatebeautiful/view.php",
        ['id' => $coursemodule->id, 'download' => 1]);
    $onclick = "window.open('$fullurl'); return false;";
    $coursemodule->set_on_click($onclick);
}


/**
 * @param settings_navigation $settings
 * @param navigation_node $certificatebeautifulnode
 *
 * @return void
 * @throws \coding_exception
 * @throws moodle_exception
 */
function certificatebeautiful_extend_settings_navigation($settings, $certificatebeautifulnode) {
    global $PAGE;

    // We want to add these new nodes after the Edit settings node, and before the
    // Locally assigned roles node. Of course, both of those are controlled by capabilities.
    $keys = $certificatebeautifulnode->get_children_key_list();
    $beforekey = null;
    $i = array_search('modedit', $keys);
    if ($i === false && array_key_exists(0, $keys)) {
        $beforekey = $keys[0];
    } else if (array_key_exists($i + 1, $keys)) {
        $beforekey = $keys[$i + 1];
    }

    if (has_capability('moodle/course:manageactivities', $PAGE->cm->context)) {
        $node = navigation_node::create(get_string('report', 'certificatebeautiful'),
            new moodle_url('/mod/certificatebeautiful/report.php', array('id' => $PAGE->cm->id)),
            navigation_node::TYPE_SETTING, null, 'mod_certificatebeautiful_report',
            new pix_icon('i/report', ''));
        $certificatebeautifulnode->add_node($node, $beforekey);
    }
}

/**
 * @param \navigation_node $navigation
 * @param stdClass $course
 * @param \context $context
 *
 * @throws coding_exception
 * @throws moodle_exception
 */
function certificatebeautiful_extend_navigation_course($navigation, $course, $context) {
    if (has_capability('mod/certificatebeautiful:addinstance', $context)) {
        $certificatenode1 = $navigation->add(get_string('course_certificates', 'certificatebeautiful'),
            null, navigation_node::TYPE_CONTAINER, null, 'course_certificates');
        $url = new moodle_url('/mod/certificatebeautiful/reports.php', ['course' => $course->id]);
        $certificatenode1->add(get_string('course_certificates', 'certificatebeautiful'), $url, navigation_node::TYPE_SETTING,
            null, null, new pix_icon('i/report', ''));

        $certificatenode2 = $navigation->add(get_string('manage_models', 'certificatebeautiful'),
            null, navigation_node::TYPE_CONTAINER, null, 'manage_models');
        $url = new moodle_url('/mod/certificatebeautiful/manage-model-list.php');
        $certificatenode2->add(get_string('manage_models', 'certificatebeautiful'), $url, navigation_node::TYPE_SETTING,
            null, null, new pix_icon('i/report', ''));
    }
}

/**
 * @param \core_user\output\myprofile\tree $tree Tree object
 * @param stdClass $user user object
 * @param bool $iscurrentuser
 * @param stdClass $course Course object
 * @return void
 * @throws coding_exception
 * @throws moodle_exception
 */
function certificatebeautiful_myprofile_navigation(core_user\output\myprofile\tree $tree, $user, $iscurrentuser, $course) {
    if (isguestuser($user)) {
        return;
    }

    $url = new moodle_url('/mod/certificatebeautiful/reports-my.php', ['user' => $user->id]);
    $node = new core_user\output\myprofile\node('miscellaneous', 'certificatebeautiful', get_string('my_certificates', 'certificatebeautiful'), null, $url);
    $tree->add_node($node);
}