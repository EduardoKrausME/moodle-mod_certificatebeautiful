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
 * Optional data validation for certificate data subplugins.
 *
 * @package   mod_certificatebeautiful
 * @copyright 2026 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\datainfo;

use coding_exception;
use mod_certificatebeautiful\plugininfo\certificatebeautifuldatainfo;
use stdClass;

/**
 * Validates data before a certificate PDF is generated.
 *
 * A subplugin participates only if its datainfo class implements
 * public static function validate_data($course, $user): array.
 * Return an empty array when valid, or a list of human-readable error messages.
 * Existing subplugins do not need to implement this optional method.
 *
 * @package mod_certificatebeautiful
 */
class data_validator {
    /**
     * Collect all errors from enabled data subplugins that opt into validation.
     *
     * @param stdClass $course Certificate course.
     * @param stdClass $user Certificate recipient.
     * @return string[] Human-readable errors, prefixed with the plugin's name.
     */
    public static function validate(stdClass $course, stdClass $user): array {
        $errors = [];

        foreach (certificatebeautifuldatainfo::get_enabled_plugins() as $plugin) {
            $class = "\\certificatebeautifuldatainfo_{$plugin}\\datainfo\\{$plugin}";

            if (!class_exists($class) || !method_exists($class, "validate_data")) {
                continue;
            }

            $pluginerrors = $class::validate_data($course, $user);
            if (!is_array($pluginerrors)) {
                throw new coding_exception("{$class}::validate_data() must return an array of error messages.");
            }

            foreach ($pluginerrors as $error) {
                if (!is_string($error) || trim($error) === "") {
                    throw new coding_exception("{$class}::validate_data() must return non-empty strings.");
                }

                $errors[] = get_string("pluginname", "certificatebeautifuldatainfo_{$plugin}") . ": " . $error;
            }
        }

        return $errors;
    }
}
