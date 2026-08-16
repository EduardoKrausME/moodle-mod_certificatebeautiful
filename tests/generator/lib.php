<?php

/**
 * Certificate Beautiful module data generator.
 *
 * @package   mod_certificatebeautiful
 * @category  test
 * @copyright 2026 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Certificate Beautiful module data generator class.
 */
class mod_certificatebeautiful_generator extends testing_module_generator {

    /**
     * Creates a certificate beautiful instance.
     *
     * @param stdClass|array|null $record
     * @param array|null $options
     * @return stdClass
     */
    public function create_instance($record = null, ?array $options = null) {
        $record = (object)(array)$record;

        $record->description ??= '';
        $record->autotrigger ??= '';
        $record->triggercmid ??= 0;
        $record->gradepass ??= '';
        $record->notifyuser ??= 0;

        return parent::create_instance($record, $options);
    }
}
