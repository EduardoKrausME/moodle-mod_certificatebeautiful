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
 * Setting file
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use mod_certificatebeautiful\issue;
use mod_certificatebeautiful\plugininfo\certificatebeautifuldatainfo;

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {

    $options = [
        "Aerotis" => "Aerotis",
        "Allison" => "Allison",
        "Autography" => "Autography",
        "Creata" => "Creata",
        "Tomatoes" => "Tomatoes",
        "Wishloved" => "Wishloved",
    ];

    $imagens = "";
    foreach ($options as $option) {
        $imagens .= "
            <div>
                <h6 style='text-align:center;margin-bottom: 0;'>{$option}</h6>
                <img src='{$CFG->wwwroot}/mod/certificatebeautiful/_editor/fonts/_signature-{$option}/_signatre-{$option}.png'>
            </div>";
    }

    $settings->add(new admin_setting_heading("certificatebeautiful_method_heading",
        get_string("config_signature_heading", "certificatebeautiful"),
        get_string("config_signature_heading_desc", "certificatebeautiful",
            count($options)) . "<div class='d-flex'>{$imagens}</div>"));

    $setting = new admin_setting_configcheckbox('certificatebeautiful/config_signature_enable',
        get_string("config_signature_enable", "certificatebeautiful"),
        get_string("config_signature_enable_desc", "certificatebeautiful"),
        1);
    $settings->add($setting);

    $setting = new admin_setting_configselect('certificatebeautiful/config_signature_typography',
        get_string("config_signature_typography", "certificatebeautiful"),
        get_string("config_signature_typography_desc", "certificatebeautiful"),
        "Aerotis", $options);
    $settings->add($setting);

    $defaultsetting = substr($USER->lastname, 0, 10);
    $setting = new admin_setting_configtext_with_maxlength('certificatebeautiful/config_signature_text',
        get_string("config_signature_text", "certificatebeautiful"),
        get_string("config_signature_text_desc", "certificatebeautiful"),
        $defaultsetting, PARAM_TEXT, null, 10);
    $settings->add($setting);

    $setting = new admin_setting_configcolourpicker('certificatebeautiful/config_signature_color',
        get_string("config_signature_color", "certificatebeautiful"),
        get_string("config_signature_color_desc", "certificatebeautiful"),
        "#324a55");
    $settings->add($setting);

    $options = [
        issue::ISSUE_HIDDEN => get_string("config_data_protect_hidden", "certificatebeautiful"),
        issue::ISSUE_ADMINS_ONLY => get_string("config_data_protect_admins_only", "certificatebeautiful"),
        issue::ISSUE_NAME_VISIBLE => get_string("config_data_protect_name_visible", "certificatebeautiful"),
        issue::ISSUE_EMAIL_ANONIMIZED => get_string("config_data_protect_email_anonimized", "certificatebeautiful"),
    ];
    $setting = new admin_setting_configselect('certificatebeautiful/data_protect',
        get_string("config_data_protect", "certificatebeautiful"),
        get_string("config_data_protect_desc", "certificatebeautiful"),
        issue::ISSUE_EMAIL_ANONIMIZED, $options);
    $settings->add($setting);

    $plugins = certificatebeautifuldatainfo::get_enabled_plugins();

    foreach ($plugins as $plugin) {
        if (file_exists(__DIR__ . "/plugins_datainfo/{$plugin}/settings.php")) {
            $settings->add(new admin_setting_heading("{$plugin}_heading",
                get_string("pluginname", "certificatebeautifuldatainfo_icsf"), ""));

            require_once(__DIR__ . "/plugins_datainfo/{$plugin}/settings.php");
        }
    }
}
