<?php
/**
 * User: Eduardo Kraus
 * Date: 09/01/2024
 * Time: 16:27
 */

namespace mod_certificatebeautiful\model;


class get_template_file {

    public static function load_template($model) {
        global $CFG;

        $htmldata = file_get_contents("{$CFG->dirroot}/mod/certificatebeautiful/_editor/_model/{$model}/index.html");

        preg_match_all('/{#s}(.*?){\/s}/', $htmldata, $strs);
        foreach ($strs[0] as $key => $str) {
            $htmldata = str_replace($strs[0][$key], get_string($strs[1][$key], 'certificatebeautiful'), $htmldata);
        }

        $htmldata = str_replace("/mod/certificatebeautiful/_editor/_model/", "{$CFG->wwwroot}/mod/certificatebeautiful/_editor/_model/", $htmldata);


        return $htmldata;
    }

}