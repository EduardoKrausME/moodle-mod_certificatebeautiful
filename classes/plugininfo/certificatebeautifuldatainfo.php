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
 * Plugin info
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\plugininfo;

use coding_exception;
use cache_exception;
use core\plugininfo\base, core_plugin_manager;
use dml_exception;

/**
 * The mod_certificatebeautiful course module viewed event class.
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class certificatebeautifuldatainfo extends base
{

    /**
     * Function get_enabled_plugins
     *
     * @return array|null
     *
     * @throws coding_exception
     * @throws dml_exception
     */
    public static function get_enabled_plugins() {
        global $DB;

        $plugins = core_plugin_manager::instance()->get_installed_plugins("certificatebeautifuldatainfo");

        if (!$plugins) {
            return [];
        }
        $installed = [];
        foreach ($plugins as $plugin => $version) {
            $installed[] = "certificatebeautifuldatainfo_{$plugin}";
        }

        list($installed, $params) = $DB->get_in_or_equal($installed, SQL_PARAMS_NAMED);
        $disabled = $DB->get_records_select("config_plugins", "plugin {$installed} AND name = 'disabled'", $params, "plugin ASC");
        foreach ($disabled as $conf) {
            if (empty($conf->value)) {
                continue;
            }
            list($type, $name) = explode("_", $conf->plugin, 2);
            unset($plugins[$name]);
        }

        $enabled = [];
        foreach ($plugins as $plugin => $version) {
            $enabled[$plugin] = $plugin;
        }

        return $enabled;
    }

    /**
     * Function enable_plugin
     *
     * @param string $pluginname
     * @param int $enabled
     *
     * @return bool
     * @throws dml_exception
     */
    public static function enable_plugin(string $pluginname, int $enabled): bool
    {
        $haschanged = false;

        $plugin = "certificatebeautifuldatainfo_{$pluginname}";
        $oldvalue = get_config($plugin, "disabled");
        $disabled = !$enabled;

        // Only set value if there is no config setting or if the value is different from the previous one.
        if ($oldvalue === false || ((bool)$oldvalue != $disabled)) {
            set_config("disabled", $disabled, $plugin);
            $haschanged = true;

            add_to_config_log("disabled", $oldvalue, $disabled, $plugin);
            \core_plugin_manager::reset_caches();
        }

        return $haschanged;
    }

    /**
     * Function is_uninstall_allowed
     *
     * @return bool
     */
    public function is_uninstall_allowed()
    {
        return true;
    }

    /**
     * Function get_settings_section_name
     *
     * @return null|string
     */
    public function get_settings_section_name()
    {
        return "{$this->type}_{$this->name}";
    }

    /**
     * Function load_settings
     *
     * @param \part_of_admin_tree $adminroot
     * @param string $parentnodename
     * @param bool $hassiteconfig
     */
    public function load_settings(\part_of_admin_tree $adminroot, $parentnodename, $hassiteconfig)
    {

        if (!$this->is_installed_and_upgraded()) {
            return;
        }

        if (!$hassiteconfig || !file_exists($this->full_path("settings.php"))) {
            return;
        }

        $section = $this->get_settings_section_name();

        $settings = new \admin_settingpage($section, $this->displayname, "moodle/site:config", $this->is_enabled() === false);

        if ($adminroot->fulltree) {
            include($this->full_path("settings.php"));
        }

        $adminroot->add("{$this->type}plugins", $settings);
    }

    /**
     * Function uninstall
     *
     * @param \progress_trace $progress
     *
     * @return bool
     */
    public function uninstall(\progress_trace $progress)
    {
        return true;
    }
}
