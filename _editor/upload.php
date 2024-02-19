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
 * This code just receives the image and returns it in base64
 *
 * @package     mod_certificatebeautiful
 * @category    backup
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @date        08/01/2024 12:02
 */

$resultArray = [];

foreach ($_FILES['files']['name'] as $key => $name) {
    if ($file['error'] != UPLOAD_ERR_OK) {
        error_log($_FILES['files']['error'][$key]);
        echo JSON_encode(null);
    }
    $content = file_get_contents($_FILES['files']['tmp_name'][$key]);
    $result = [
        'name' => $_FILES['files']['name'][$key],
        'type' => 'image',
        'src' => "data:" . $_FILES['files']['type'][$key] . ";base64," . base64_encode($content),
    ];
    array_push($resultArray, $result);
}

$response = ['data' => $resultArray];
echo json_encode($response);