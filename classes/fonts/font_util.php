<?php
/**
 * User: Eduardo Kraus
 * Date: 10/01/2024
 * Time: 17:58
 */

namespace mod_certificatebeautiful\fonts;

require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/fonts/font_attributes.php");

class font_util {

    /**
     * @return array
     * @throws \Exception
     */
    public static function mpdf_list_fonts() {
        global $CFG;

        $fonts = ["fonts" => [], "path" => [], "css" => "", "js" => ""];
        $fontFiles = glob("{$CFG->dirroot}/mod/certificatebeautiful/_editor/_model/*/fonts/*/static/*.ttf");

        foreach ($fontFiles as $fontFile) {
            $path = pathinfo($fontFile);


            $ttfinfo = new font_attributes($fontFile);

            $fonts["fonts"][$ttfinfo->getFontNameId()]['R'] = $path['basename'];
            $fonts["fonts"][$ttfinfo->getFontNameId()]['I'] = $path['basename'];
            $fonts["fonts"][$ttfinfo->getFontNameId()]['B'] = $path['basename'];
            $fonts["fonts"][$ttfinfo->getFontNameId()]['BI'] = $path['basename'];

            if ($ttfinfo->getFontSubFamily() == 'Regular') {
                $fonts["fonts"][$ttfinfo->getFontFamilyId()]['R'] = $path['basename'];
            } else if ($ttfinfo->getFontSubFamily() == 'Bold Italic') {
                $fonts["fonts"][$ttfinfo->getFontFamilyId()]['BI'] = $path['basename'];
            } else if ($ttfinfo->getFontSubFamily() == 'Italic') {
                $fonts["fonts"][$ttfinfo->getFontFamilyId()]['I'] = $path['basename'];
            } else if ($ttfinfo->getFontSubFamily() == 'Bold') {
                $fonts["fonts"][$ttfinfo->getFontFamilyId()]['B'] = $path['basename'];
            }

            $fonts["path"][$path['dirname']] = $path['dirname'];


            $fontUrl = str_replace($CFG->dirroot, $CFG->wwwroot, $fontFile);
            $fonts["css"] .= "
                @font-face {
                    font-family : '{$ttfinfo->getFontName()}';
                    src         : url({$fontUrl}) format('ttf');
                }";

            $fonts["js"] .= "
                                {id : '{$ttfinfo->getFontNameId()}', label : '{$ttfinfo->getFontName()}', value : \"'{$ttfinfo->getFontNameId()}', '{$ttfinfo->getFontFamilyId()}', '{$ttfinfo->getFontName()}', '{$ttfinfo->getFontFamily()}', 'Arial'\"},";
        }

        $fonts["path"] = array_keys($fonts["path"]);

        //echo '<pre>';
        //print_r($fonts['fonts']);
        //echo '</pre>';die();


        return $fonts;
    }
}