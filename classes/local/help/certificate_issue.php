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
 * Class certificate_issue
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\local\help;

use mod_certificatebeautiful\local\help\util\qrcode;

/**
 * Class certificate_issue
 *
 * @package mod_certificatebeautiful\local\help
 */
class certificate_issue extends help_base {

    /**
     * CLASS_NAME value
     */
    const CLASS_NAME = "certificate";

    /**
     * Function table_structure
     *
     * @return array
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
     * Function get_data
     *
     * @param $certificatebeautiful
     * @param $certificatebeautifulissue
     *
     * @return array
     * @throws \coding_exception
     */
    public static function get_data($certificatebeautiful, $certificatebeautifulissue) {
        global $CFG;

        $certificatebeautiful->description = trim($certificatebeautiful->description);
        $certificatebeautiful->description = str_replace("\n", "<br>", $certificatebeautiful->description);

        $certificatebeautiful->url = "{$CFG->wwwroot}/mod/certificatebeautiful/v/?code={$certificatebeautifulissue->code}";

        return self::base_get_data(self::table_structure(), $certificatebeautiful);
    }

    /**
     * Function custom_replace
     *
     * @param $html
     * @param $certificatebeautifulissue
     *
     * @return mixed
     */
    public static function custom_replace($html, $certificatebeautifulissue) {
        if (strpos($html, "img/qr-code.svg")) {

            $pngfile = make_temp_directory('certificatebeautiful') . "/" . uniqid() . ".png";

            $options = [
                'wq' => 0,
                'w' => 500,
                'h' => 500,
                'p' => 0,
            ];
            $generator = new qrcode($certificatebeautifulissue['url'], $options);
            $image = $generator->render_image();
            imagepng($image, $pngfile);

            $base64 = 'data:image/png;base64,' . base64_encode(file_get_contents($pngfile));
            $html = preg_match_all('/(["|\']).*?img\/qr-code.svg["|\']/', "\$1{$base64}\$1", $html);
        }

        return $html;
    }
}
