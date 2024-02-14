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
 * User: Eduardo Kraus
 * Date: 12/01/2024
 * Time: 18:38
 */

namespace mod_certificatebeautiful\help;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use mod_certificatebeautiful\vo\certificatebeautiful;
use mod_certificatebeautiful\vo\certificatebeautiful_issue;

class certificate_issue extends help_base {

    CONST CLASS_NAME = "certificate";

    /**
     * @return array
     *
     * @throws \coding_exception
     */
    public static function table_structure() {
        return [
            ['key' => 'name', 'label' => get_string('help_certificate_issue_name', 'certificatebeautiful')],
            ['key' => 'description', 'label' => get_string('help_certificate_issue_description', 'certificatebeautiful')],
            ['key' => 'timecreated', 'label' => get_string('help_certificate_issue_timecreated', 'certificatebeautiful')],
            ['key' => 'code', 'label' => get_string('help_certificate_issue_code', 'certificatebeautiful')],
            ['key' => 'url', 'label' => get_string('help_certificate_issue_url', 'certificatebeautiful')],
        ];
    }

    /**
     * @param certificatebeautiful $certificatebeautiful
     * @param certificatebeautiful_issue $certificatebeautifulissue
     *
     * @return array
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function get_data($certificatebeautiful, $certificatebeautifulissue) {
        global $CFG, $DB;

        require_once(__DIR__ . "/vendor/autoload.php");

        $certificatebeautiful->description = trim($certificatebeautiful->description);
        $certificatebeautiful->description = str_replace("\n", "<br>", $certificatebeautiful->description);

        $certificatebeautiful->url = "{$CFG->wwwroot}/mod/certificatebeautiful/v/?code={$certificatebeautifulissue->code}";

        return self::base_get_data(self::table_structure(), $certificatebeautiful);
    }

    /**
     * @param string $html
     * @param array $certificatebeautifulissue
     *
     * @return mixed
     */
    public static function custom_replace($html, $certificatebeautifulissue) {

        if (strpos($html, "img/qr-code.svg")) {
            $options = new QROptions([
                'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                'scale' => 20,
                'addQuietzone' => false
            ]);
            $qrcode = (new QRCode($options))->render($certificatebeautifulissue['url']);
            $html = str_replace("img/qr-code.svg", $qrcode, $html);
        }

        return $html;
    }
}
