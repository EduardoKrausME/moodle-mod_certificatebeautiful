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
 * Font util
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\local\fonts;

defined('MOODLE_INTERNAL') || die;
require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/local/fonts/font_attributes.php");

/**
 * Class font_util
 *
 * @package mod_certificatebeautiful\local\fonts
 */
class font_util {

    /**
     * mpdf_list_fonts function
     *
     * @return array
     *
     * @throws \Exception
     */
    public static function mpdf_list_fonts() {
        global $CFG;

        $fonts = ["fonts" => [], "path" => [], "css" => "", "options" => "", "listfonts" => []];
        $fontsitens = [];
        $fontfiles = glob("{$CFG->dirroot}/mod/certificatebeautiful/_editor/fonts/*/*.ttf");

        foreach ($fontfiles as $fontfile) {
            $path = pathinfo($fontfile);

            $ttfinfo = new font_attributes($fontfile);

            $fontnameid = $ttfinfo->get_font_name_id();
            $fontfamilyid = $ttfinfo->get_font_family_id();
            $fontname = $ttfinfo->get_font_name();
            $fontfamily = $ttfinfo->get_font_family();

            $fonts["fonts"][$fontnameid]['R'] = $path['basename'];
            $fonts["fonts"][$fontnameid]['I'] = $path['basename'];
            $fonts["fonts"][$fontnameid]['B'] = $path['basename'];
            $fonts["fonts"][$fontnameid]['BI'] = $path['basename'];

            $fonts["path"][$path['dirname']] = $path['dirname'];

            $fonturl = str_replace($CFG->dirroot, $CFG->wwwroot, $fontfile);
            $fonts["css"] .= "
                @font-face {
                    font-family : {$fontnameid};
                    src         : local(\"{$fontfamily}\"), url({$fonturl}) format('truetype');
                }";

            if (strpos($fontfile, '_signature-') === false) {
                if ($fontname == $fontfamily) {
                    $value = "{$fontnameid}, '{$fontfamily}'";
                } else {
                    $value = "{$fontnameid}, '{$fontfamily}', '{$fontname}'";
                }
                $fontsitens[$fontname] = "
                    {
                        id    : '{$fontnameid}, \'{$fontfamily}\'',
                        label : '{$fontname}',
                        value : \"{$value}\"
                    },";
            }

            $fonts["listfonts"][$fontnameid] = (object)[
                "fontnameid" => $fontnameid,
                "fontname" => $fontname,
                "fontfamily" => $fontfamily,
            ];
        }

        $fonts["path"] = array_keys($fonts["path"]);

        ksort($fontsitens);
        $fonts["options"] = implode("\n", $fontsitens);

        return $fonts;
    }
}
