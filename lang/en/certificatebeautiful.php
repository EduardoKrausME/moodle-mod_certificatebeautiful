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
 * Lang en file
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$string['add_new_model'] = 'Add new model';
$string['add_new_page'] = 'Add a new page to the certificate';
$string['best'] = 'Best';
$string['certdate'] = 'Date';
$string['certificate-appreciation'] = 'Certificate of Appreciation';
$string['certificate-details'] = 'Certificate Details';
$string['certificate-elegant'] = 'Elegant Certificate';
$string['certificate-flat-modern'] = 'Modern Flat Certificate';
$string['certificate-golden'] = 'Golden Certificate';
$string['certificate-gradient-golden-luxury'] = 'Golden Luxury Gradient Certificate';
$string['certificate-kids-animals'] = 'For kids with animals';
$string['certificate-kids-child-medical'] = 'Child-like medical certificate';
$string['certificate-kids-gradient-modern'] = 'Gradient modern certificate template';
$string['certificate-kids-hand-drawn'] = 'Hand drawn preschool certificate';
$string['certificate-kids-pastel'] = 'Cute pastel education certificate';
$string['certificate-modern'] = 'Modern Certificate';
$string['certificate-modern-2'] = 'Modern Certificate 2';
$string['certificate-simple'] = 'Simple Certificate';
$string['certificate-vintage'] = 'Vintage Certificate';
$string['certificate_description'] = 'Describe the certificate';
$string['certificate_description_help'] = 'Certificate description text. It can contain simple HTML such as &lt;b&gt;, &lt;i&gt;, &lt;u&gt; and color styles, but be cautious as the <a href="https://mpdf.github.io/" target="_blank">PDF converter has limitations</a>.';
$string['certificatebeautiful-page_empty'] = 'Empty';
$string['certificatebeautiful:addinstance'] = 'Add instance';
$string['certificatebeautiful:view'] = 'Allow the user to view the Beautiful certificate';
$string['certificatebeautiful:viewreport'] = 'View Beautiful certificate reports';
$string['certpresented'] = 'This certificate is proudly presented to';
$string['certsignature'] = 'Director';
$string['certtitle'] = 'Certificate';
$string['config_signature_color'] = 'Signature line color';
$string['config_signature_color_desc'] = 'Select the color of the writing line for the signature.';
$string['config_signature_enable'] = 'Enable dynamic signature';
$string['config_signature_enable_desc'] = 'When checked, Beautiful Certificate will create a customized signature based on the chosen handwriting, specified text, and color.';
$string['config_signature_heading'] = 'Signature Settings';
$string['config_signature_heading_desc'] = 'At this point, you must decide whether you want to create a custom signature from the {$a} pre-loaded caligraphies. Your options include:';
$string['config_signature_text'] = 'Signature Text';
$string['config_signature_text_desc'] = 'To enable the automatic generation of signatures by the Beautiful Certificate, it is necessary to provide a sequence of up to 10 characters. Ensure that the sequence does not contain spaces, numbers, or accents. It\'s worth noting that a sequence composed of 5 to 7 characters will result in a visually pleasing signature.';
$string['config_signature_typography'] = 'Signature Text Style';
$string['config_signature_typography_desc'] = 'By default, the Beautiful Certificate will generate a signature using the following text and employ this calligraphy to personalize the content.';
$string['course'] = 'Course';
$string['course_certificates'] = 'Course certificates';
$string['create_after_model'] = 'First save the model before adding pages to the certificate';
$string['create_at_certificate'] = 'Certificate for {$a}';
$string['create_model'] = 'Create model';
$string['default-description'] = 'This certificate certifies that the student <b>{$USER->fullname}</b> has successfully completed the <b>{$course->fullname}</b> with distinction, consolidating a comprehensive set of knowledge and skills essential for excelling in dynamic environments.';
$string['delete-page'] = 'Delete Page';
$string['download_my_certificate'] = 'Download my certificate';
$string['edit_page'] = 'Edit certificate page';
$string['edit_page_instruction'] = '<p>The certificate is created using <a target="_blank" href="https://github.com/GrapesJS/grapesjs">GrapesJS</a> as the editor. The editor is configured in <a target="_blank" href="https://github.com/GrapesJS/grapesjs/issues/1936">dragMode:\'absolute\'</a>, allowing you to drag and drop components within the editor. After editing, click on "<strong>Test PDF</strong>" to preview the result, and when finished, use the "<strong>Save Certificate Page</strong>" button to save the generated certificate.</p><p>Due to limitations of <a target="_blank" href="https://mpdf.github.io/">mPDF</a>, only elements at the root of the certificate support absolute positioning. Therefore, other components within the root DIV are restricted from movement to prevent inconsistencies in the final PDF. mPDF only supports absolute positioning for <code>&lt;div&gt;</code> elements, so when using Custom Code to insert new components, always start with <code>&lt;div&gt;</code>.</p><p>After the editor, you will find keys that can be added to the certificate for customization. Regarding the QRCode, note that the <code>qr-code.svg</code> image is replaced by the QRCode generated by the plugin. Therefore, if you edit the image, the functionality may be compromised. As for the system-generated signature, it will replace the <code>signature.png</code> image in the project. If you choose a custom image for the certificate, the plugin will not make the modification automatically.</p>';
$string['edit_signature_certificate'] = 'Customize your certificate signature here';
$string['edit_this_page'] = 'Edit this certificate page';
$string['from_certificates'] = 'Certificates from student {$a}';
$string['help_base_title'] = 'Available keys to replace in the certificate:';
$string['help_certificate_issue__name'] = 'Certificate data';
$string['help_certificate_issue_code'] = 'Unique code of the certificate.';
$string['help_certificate_issue_description'] = 'Certificate description';
$string['help_certificate_issue_name'] = 'Certificate name';
$string['help_certificate_issue_timecreated'] = 'Certificate creation date.';
$string['help_certificate_issue_url'] = 'Certificate validation URL';
$string['help_course__name'] = 'Data of the course for which the certificate is being generated';
$string['help_course_categories__name'] = 'Data of the course category for which the certificate is being generated';
$string['help_course_categories_description'] = 'Description of the course category.';
$string['help_course_categories_id'] = 'Unique identifier of the course category.';
$string['help_course_categories_idnumber'] = 'Unique identification number of the course category.';
$string['help_course_categories_name'] = 'Name of the course category.';
$string['help_course_categories_timemodified'] = 'Timestamp of the last modification to the course category.';
$string['help_course_category'] = 'The identifier of the category to which the course belongs.';
$string['help_course_enddate'] = 'The end date of the course.';
$string['help_course_fullname'] = 'The full name of the course.';
$string['help_course_id'] = 'A unique identifier for each course.';
$string['help_course_lang'] = 'The language of the course.';
$string['help_course_shortname'] = 'A short name or unique code for the course.';
$string['help_course_startdate'] = 'The start date of the course.';
$string['help_course_summary'] = 'A brief summary or description of the course.';
$string['help_enrolments__name'] = 'Data of the student\'s enrollment in the course';
$string['help_enrolments_timestart'] = 'Date of the user\'s enrollment';
$string['help_functions__name'] = 'Execute functions of the following Moodle and PHP native functions';
$string['help_functions_date'] = 'PHP <a href="https://php.net/date" target="_blank">date()</a> function';
$string['help_functions_time'] = 'PHP <a href="https://php.net/time" target="_blank">time()</a> function';
$string['help_functions_userdate'] = 'Moodle <a href="https://moodledev.io/docs/apis/subsystems/time" target="_blank">userdate()</a> function';
$string['help_grade__name'] = 'Student\'s grade in the course';
$string['help_grade_finalgrade'] = 'Student\'s final grade';
$string['help_grade_table'] = 'Table with the student\'s grades';
$string['help_site__name'] = 'Data of the Moodle instance for which the certificate is being generated';
$string['help_site_fullname'] = 'The full name of Moodle.';
$string['help_site_shortname'] = 'A short name for Moodle.';
$string['help_site_summary'] = 'A brief summary or description of Moodle.';
$string['help_teachers__name'] = 'Teachers of the course';
$string['help_teachers_teacher1'] = 'Only the first teacher';
$string['help_teachers_teacher2'] = 'Only the first two teachers';
$string['help_teachers_teacherall'] = 'All teachers';
$string['help_user__name'] = 'User data';
$string['help_user_address'] = 'User\'s address.';
$string['help_user_alternatename'] = 'User\'s alternative name.';
$string['help_user_calendartype'] = 'User\'s preferred calendar type.';
$string['help_user_city'] = 'User\'s city.';
$string['help_user_country'] = 'User\'s country code.';
$string['help_user_currentlogin'] = 'Timestamp of the user\'s current login.';
$string['help_user_department'] = 'User\'s department.';
$string['help_user_description'] = 'User\'s description.';
$string['help_user_email'] = 'User\'s email address.';
$string['help_user_firstaccess'] = 'Timestamp of the user\'s first access.';
$string['help_user_firstname'] = 'User\'s first name.';
$string['help_user_fullname'] = 'User\'s full name, generated by the fullname() function.';
$string['help_user_id'] = 'Unique identifier for each user.';
$string['help_user_idnumber'] = 'User\'s identification number.';
$string['help_user_institution'] = 'User\'s institution.';
$string['help_user_lang'] = 'User\'s preferred language.';
$string['help_user_lastaccess'] = 'Timestamp of the user\'s last access.';
$string['help_user_lastip'] = 'IP address of the user\'s last access.';
$string['help_user_lastlogin'] = 'Timestamp of the user\'s last login.';
$string['help_user_lastname'] = 'User\'s last name.';
$string['help_user_middlename'] = 'User\'s middle name.';
$string['help_user_phone1'] = 'User\'s primary phone number.';
$string['help_user_phone2'] = 'User\'s secondary phone number.';
$string['help_user_profile__name'] = 'User profile data';
$string['help_user_timecreated'] = 'Timestamp of the user account creation.';
$string['help_user_timemodified'] = 'Timestamp of the last modification to the user account.';
$string['help_user_timezone'] = 'User\'s preferred timezone.';
$string['help_user_username'] = 'User\'s username.';
$string['list_model'] = 'List of models';
$string['manage_models'] = 'Manage certificate models';
$string['model_name'] = 'Model name';
$string['model_name_missing'] = 'Model name is required';
$string['model_page_name'] = 'Page: {$a}';
$string['modulename'] = 'Beautiful certificate';
$string['modulenameplural'] = 'Beautiful certificates';
$string['my_certificates'] = 'My certificates';
$string['new_model'] = 'New Model';
$string['pages_certificate'] = 'Certificate pages';
$string['pluginadministration'] = 'Course certificate administration';
$string['pluginname'] = 'Beautiful certificate';
$string['preview_certificate'] = 'Certificate preview';
$string['privacy:metadata:certificatebeautiful_issue'] = 'Information about the certificates issued to users.';
$string['privacy:metadata:certificatebeautiful_issue:userid'] = 'Stores the ID of the user who received the certificate.';
$string['report'] = 'View generated certificates';
$string['report_code'] = 'Certificate code';
$string['report_confirm_delete_certificate'] = 'Are you sure you want to delete this certificate?';
$string['report_delete_certificate'] = 'Delete';
$string['report_deleted_certificate'] = 'Certificate deleted successfully!';
$string['report_filename'] = 'Certificates generated by students';
$string['report_timecreated'] = 'Created at';
$string['report_title'] = 'Report';
$string['report_useremail'] = 'Student email';
$string['report_usernome'] = 'Student name';
$string['report_view_certificate'] = 'View';
$string['save_model'] = 'Save model';
$string['select_a_model'] = 'Select a model';
$string['select_background_image'] = 'Select the new background image for the certificate';
$string['select_background_image_info'] = 'Please replace the certificate background with the image below. The original image has dimensions of 1684×1190 pixels, which corresponds to 21x29.7 centimeters, equivalent to the size of an A4 page.<br>Ensure that the image is adjusted in the final certificate while maintaining these proportions to avoid distortion or pixelation.';
$string['select_background_preview'] = 'Change the certificate background image';
$string['select_model'] = 'See this model';
$string['select_model_preview'] = 'Select a pre-existing template to update the design of this page';
$string['select_the_model'] = 'Select the model';
$string['subtititle'] = 'Of completion';
$string['sumary'] = 'Summary';
$string['sumary-secound-page'] = 'Summary Certificate';
$string['using_this_page'] = 'Use this template';
$string['validate_certificate_code'] = 'Authenticity code';
$string['validate_certificate_course'] = 'Certificate course';
$string['validate_certificate_date'] = 'Issued on the date of';
$string['validate_certificate_name'] = 'Certificate name';
$string['validate_certificate_notfound'] = 'Authenticity code not found!';
$string['validate_certificate_submit'] = 'Validate code';
$string['validate_certificate_title'] = 'Verify certificate authenticity';
$string['validate_certificate_user'] = 'Issued to';
$string['view_my_certificate'] = 'View my certificate in a new tab';
