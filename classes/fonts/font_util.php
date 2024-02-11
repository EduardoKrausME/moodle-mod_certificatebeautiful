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
 * Date: 10/01/2024
 * Time: 17:58
 */

namespace mod_certificatebeautiful\fonts;

defined('MOODLE_INTERNAL') || die();
require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/fonts/font_attributes.php");

class font_util {

    /**
     * @return array
     *
     * @throws \Exception
     */
    public static function mpdf_list_fonts() {
        global $CFG;

        $fonts = ["fonts" => [], "path" => [], "css" => "", "js" => ""];
        $fontsitens = [];
        $fontfiles = glob("{$CFG->dirroot}/mod/certificatebeautiful/_editor/_model/*/fonts/*/static/*.ttf");

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

            if ($ttfinfo->get_font_sub_family() == 'Regular') {
                $fonts["fonts"][$fontfamilyid]['R'] = $path['basename'];
            } else if ($ttfinfo->get_font_sub_family() == 'Bold Italic') {
                $fonts["fonts"][$fontfamilyid]['BI'] = $path['basename'];
            } else if ($ttfinfo->get_font_sub_family() == 'Italic') {
                $fonts["fonts"][$fontfamilyid]['I'] = $path['basename'];
            } else if ($ttfinfo->get_font_sub_family() == 'Bold') {
                $fonts["fonts"][$fontfamilyid]['B'] = $path['basename'];
            }

            $fonts["path"][$path['dirname']] = $path['dirname'];

            $fonturl = str_replace($CFG->dirroot, $CFG->wwwroot, $fontfile);
            $fonts["css"] .= "
                @font-face {
                    font-family : '{$fontname}';
                    src         : url({$fonturl}) format('ttf');
                }";

            if ($fontname == $fontfamily) {
                $value = "'{$fontnameid}', '{$fontfamilyid}', '{$fontname}'";
            } else {
                $value = "'{$fontnameid}', '{$fontfamilyid}', '{$fontname}', '{$fontfamily}'";
            }
            $fontsitens[$fontname] = "
                    {
                        id : '{$fontnameid}',
                        label : '{$fontname}',
                        value : \"{$value}\"},";
        }

        $fonts["path"] = array_keys($fonts["path"]);

        ksort($fontsitens);
        $fonts["options"] = implode("\n", $fontsitens);

        return $fonts;
    }
}
