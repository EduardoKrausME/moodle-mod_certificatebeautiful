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
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use mod_certificatebeautiful\model\form_create;
use mod_certificatebeautiful\model\form_create_page;

require(__DIR__ . '/../../config.php');
require($CFG->libdir . '/tablelib.php');

global $PAGE, $USER, $CFG;

$id = required_param('id', PARAM_INT);

/** @var \mod_certificatebeautiful\vo\certificatebeautiful_model $certificatebeautifulmodel */
$certificatebeautifulmodel = $DB->get_record('certificatebeautiful_model', ['id' => $id], "*", MUST_EXIST);

$certificatebeautifulmodel->pages_info_object = json_decode($certificatebeautifulmodel->pages_info);

require_once(__DIR__ . "/classes/pdf/page_pdf.php");
$pagepdf = new \mod_certificatebeautiful\pdf\page_pdf();
$pagepdf->create_pdf($certificatebeautifulmodel, $USER, $SITE);
