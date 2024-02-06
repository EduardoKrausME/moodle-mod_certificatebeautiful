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
 * Time: 12:25
 */

namespace mod_certificatebeautiful\pdf;

use mod_certificatebeautiful\fonts\font_util;
use mod_certificatebeautiful\vo\certificatebeautiful;
use mod_certificatebeautiful\vo\certificatebeautiful_model;
use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Mpdf\MpdfException;
use Mpdf\Output\Destination;

class page_pdf {

    public function __construct() {
        global $CFG;

        require_once(__DIR__ . '/vendor/autoload.php');
        require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/fonts/font_util.php");
        require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/pdf/replace_tags.php");

        require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/help/help_base.php");
        require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/help/course.php");
        require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/help/course_categories.php");
        require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/help/enrolments.php");
        require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/help/functions.php");
        require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/help/grade.php");
        require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/help/site.php");
        require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/help/teachers.php");
        require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/help/user.php");
        require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/help/user_profile.php");
    }

    /**
     * @param certificatebeautiful $certificatebeautiful
     * @param certificatebeautiful_model $certificatebeautifulmodel
     * @param $user
     * @param $course
     * @return string
     * @throws MpdfException
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public function create_pdf($certificatebeautiful, $certificatebeautifulmodel, $user, $course) {
        global $COURSE, $CFG;

        $fontlist = font_util::mpdf_list_fonts();

        // 297 mm    X  210 mm
        // 841,89 px X  595,28 px
        $proporcao = .79;
        $mpdf = new Mpdf([
            'mode' => '',
            'format' => [210 * $proporcao, 297 * $proporcao],
            'tempDir' => "{$CFG->dataroot}/temp/mpdf",
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_header' => 0,
            'margin_footer' => 0,
            'orientation' => 'L',
            'fontDir' =>
                array_merge(
                    (new ConfigVariables())->getDefaults()['fontDir'],
                    $fontlist["path"]
                ),
            'default_font' => 'Arial',
            'fontdata' =>
                array_merge(
                    (new FontVariables())->getDefaults()['fontdata'],
                    $fontlist["fonts"]
                )
        ]);
        $mpdf->SetProtection(['print', 'print-highres'], '', 'asjdfasjdhfgajdhsfagsdfhasjdfasdgjfhagyruitywuerfdf', 128);
        $mpdf->autoPageBreak = false;

        $mpdf->SetAuthor($COURSE->fullname);
        $mpdf->SetCreator(get_string('modulename', 'certificatebeautiful') . ' - Model: ' . $certificatebeautifulmodel->name);
        $mpdf->SetTitle($certificatebeautiful->name);
        $mpdf->SetSubject(get_string('create_at_certificate', 'certificatebeautiful', fullname($user)));

        $mpdf->exposeVersion = "2.1.0";

        foreach ($certificatebeautifulmodel->pages_info_object as $page) {
            $mpdf->AddPageByArray([]);

            $page->htmldata = str_replace("<section", "<body", $page->htmldata);
            $page->htmldata = str_replace("</section>", "</body>", $page->htmldata);

            preg_match('/id="(.*?)" class="certificate-root"/', $page->htmldata, $ids);
            $extracss = "
                @page{
                    page-break-inside : avoid
                }
                html,
                body,
                img {
                    margin  : 0;
                    padding : 0;
                }
                #{$ids[1]} {
                    height     : 100%;
                    width      : 100%;
                    background : none;
                    margin     : 0;
                    padding    : 0;
                }";

            preg_match_all('/\#' . $ids[1] . '.*?\}/s', $page->htmldata . $page->cssdata, $cssroot);
            preg_match('/background.*url\((.*?)\)/', $cssroot[0][0], $background);
            if (isset($background[1])) {
                $image = $background[1];
                $image = str_replace("'", "", $image);
                $image = str_replace("\"", "", $image);
                // Coloca a imagem como WATERMARK da página.
                $mpdf->Image($image, 0, 0, 0, 0, '', '', true, false, true);
            }

            // Muda o CSS do body (antiga section) para que não interfira na página.
            $newcss = $cssroot[0][0];
            $newcss = str_replace("width", "a--width", $newcss);
            $newcss = str_replace("height", "a--height", $newcss);
            $newcss = str_replace("margin", "a--margin", $newcss);
            $newcss = str_replace("padding", "a--padding", $newcss);
            $newcss = str_replace("position", "a--position", $newcss);
            $newcss = str_replace("background", "a--background", $newcss);

            $page->cssdata = str_replace($cssroot[0][0], $newcss, $page->cssdata);
            $page->htmldata = str_replace($cssroot[0][0], $newcss, $page->htmldata);

            $replacetags = new replace_tags($page->htmldata, $course, $user);
            $page->htmldata = $replacetags->out();

            if (isset($page->cssdata[10])) {

                $mpdf->WriteHTML($page->cssdata . $extracss, HTMLParserMode::HEADER_CSS);
                $mpdf->WriteHTML($page->htmldata, HTMLParserMode::HTML_BODY);
            } else {

                $mpdf->WriteHTML("{$page->htmldata}\n<style>{$extracss}</style>");
            }
        }

        return $mpdf->Output("name.pdf", Destination::STRING_RETURN);
    }
}
