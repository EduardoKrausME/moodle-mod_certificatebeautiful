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
 * Lang en file
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
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
$string['certificatebeautiful:delete'] = 'Delete certificate instance';
$string['certificatebeautiful:view'] = 'Allow the user to view the Beautiful certificate';
$string['certificatebeautiful:viewreport'] = 'View Beautiful certificate reports';
$string['certpresented'] = 'This certificate is proudly presented to';
$string['certsignature'] = 'Director';
$string['certtitle'] = 'Certificate';
$string['config_data_protect'] = 'Personal Data Protection';
$string['config_data_protect_admins_only'] = 'Visible only to administrators';
$string['config_data_protect_desc'] = 'Check to anonymize personal data in the certificate validator';
$string['config_data_protect_email_anonimized'] = 'Name visible and email anonymized';
$string['config_data_protect_hidden'] = 'Hidden for everyone';
$string['config_data_protect_name_visible'] = 'Name visible only';
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
$string['default-description'] = 'This certificate, in recognition of the successful completion of the course <b>{\$COURSE->fullname}</b> with distinction, consolidating a comprehensive set of knowledge and essential skills to excel in dynamic environments.';
$string['delete-page'] = 'Delete Page';
$string['download_my_certificate'] = 'Download my certificate';
$string['edit_page'] = 'Edit certificate page';
$string['edit_page_instruction'] = '<p>The certificate is created using <a target="_blank" href="https://github.com/GrapesJS/grapesjs">GrapesJS</a> as the editor. The editor is configured in <a target="_blank" href="https://github.com/GrapesJS/grapesjs/issues/1936">dragMode:\'absolute\'</a>, allowing you to drag and drop components within the editor. After editing, click on "<strong>Test PDF</strong>" to preview the result, and when finished, use the "<strong>Save Certificate Page</strong>" button to save the generated certificate.</p><p>Due to limitations of <a target="_blank" href="https://mpdf.github.io/">mPDF</a>, only elements at the root of the certificate support absolute positioning. Therefore, other components within the root DIV are restricted from movement to prevent inconsistencies in the final PDF. mPDF only supports absolute positioning for <code>&lt;div&gt;</code> elements, so when using Custom Code to insert new components, always start with <code>&lt;div&gt;</code>.</p><p>After the editor, you will find keys that can be added to the certificate for customization. Regarding the QRCode, note that the <code>qr-code.svg</code> image is replaced by the QRCode generated by the plugin. Therefore, if you edit the image, the functionality may be compromised. As for the system-generated signature, it will replace the <code>signature.png</code> image in the project. If you choose a custom image for the certificate, the plugin will not make the modification automatically.</p>';
$string['edit_signature_certificate'] = 'Customize your certificate signature here';
$string['edit_this_page'] = 'Edit this certificate page';
$string['from_certificates'] = 'Certificates from student {$a}';
$string['help_base_title'] = 'Available keys to replace in the certificate:';
$string['list_model'] = 'List of models';
$string['manage_models'] = 'Manage certificate models';
$string['model_name'] = 'Model name';
$string['model_name_missing'] = 'Model name is required';
$string['model_orientation'] = 'Orientation';
$string['model_orientation_l'] = 'Landscape';
$string['model_orientation_p'] = 'Portrait';
$string['model_page_name'] = 'Page: {$a}';
$string['modulename'] = 'Beautiful certificate';
$string['modulenameplural'] = 'Beautiful certificates';
$string['my_certificates'] = 'My certificates';
$string['new_model'] = 'New Model';
$string['only_format'] = 'Bringing only {$a} format';
$string['pages_certificate'] = 'Certificate pages';
$string['pluginadministration'] = 'Course certificate administration';
$string['pluginname'] = 'Beautiful certificate';
$string['preview_certificate'] = 'Certificate preview';
$string['privacy:metadata:certificatebeautiful_issue'] = 'Information about the certificates issued to users.';
$string['privacy:metadata:certificatebeautiful_issue:userid'] = 'Stores the ID of the user who received the certificate.';
$string['report'] = 'View generated certificates';
$string['report_code'] = 'Certificate code';
$string['report_confirm_delete_certificate'] = 'Are you sure you want to delete this certificate?';
$string['report_create_certificate'] = 'Create certificate';
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
$string['select_background_image_info2'] = '<div class="alert alert-warning">
<p>Please upload a new image to replace the certificate background.</p>
<p>The certificate is in <strong>{$a->orientation}</strong> format, and the image must have dimensions of <strong>{$a->size} pixels</strong>, corresponding to <strong>{$a->sizecm} cm</strong>. Make sure to maintain these proportions to avoid distortion or pixelation.</p>
</div>';
$string['select_background_preview'] = 'Change the certificate background image';
$string['select_model'] = 'See this model';
$string['select_model_preview'] = 'Select a pre-existing template to update the design of this page';
$string['select_the_model'] = 'Select the model';
$string['subplugintype_certificatebeautifuldatainfo'] = 'Subplugin of Certificate Beautiful';
$string['subplugintype_certificatebeautifuldatainfo_plural'] = 'Data subplugin of Certificate Beautiful';
$string['subtititle'] = 'Of completion';
$string['sumary'] = 'Summary';
$string['sumary-secound-page'] = 'Summary Certificate';
$string['sumary-secound-page2'] = 'List of course sections and modules';
$string['using_this_page'] = 'Use this template';
$string['validate_certificate_code'] = 'Authenticity code';
$string['validate_certificate_course'] = 'Certificate course';
$string['validate_certificate_date'] = 'Issued on the date of';
$string['validate_certificate_name'] = 'Certificate name';
$string['validate_certificate_notfound'] = 'Authenticity code not found!';
$string['validate_certificate_submit'] = 'Validate code';
$string['validate_certificate_title'] = 'Verify certificate authenticity';
$string['validate_certificate_user'] = 'Issued to';
$string['validate_certificate_validate'] = 'Validate';
$string['view_my_certificate'] = 'View my certificate in a new tab';
