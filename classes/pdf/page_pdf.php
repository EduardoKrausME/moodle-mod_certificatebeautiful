<?php
// This file is part of Moodle - http://moodle.org/
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
 * Class page_pdf
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\pdf;

use Exception;
use mod_certificatebeautiful\fonts\font_util;
use mod_certificatebeautiful\vo\certificatebeautiful;
use mod_certificatebeautiful\vo\certificatebeautiful_issue;
use mod_certificatebeautiful\vo\certificatebeautiful_model;
use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Mpdf\MpdfException;
use Mpdf\Output\Destination;
use stdClass;

/**
 * Class page_pdf
 *
 * @package mod_certificatebeautiful\pdf
 */
class page_pdf {

    /**
     * page_pdf constructor.
     */
    public function __construct() {
        global $CFG;

        require_once(__DIR__ . "/vendor/autoload.php");
        require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/fonts/font_util.php");
        require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/pdf/replace_tags.php");
    }

    /**
     * create_pdf
     *
     * @param certificatebeautiful $certificatebeautiful
     * @param certificatebeautiful_issue $certificatebeautifulissue
     * @param certificatebeautiful_model $certificatebeautifulmodel
     * @param stdClass $user
     * @param stdClass $course
     * @return string
     * @throws Exception
     */
    public function create_pdf($certificatebeautiful, $certificatebeautifulissue, $certificatebeautifulmodel, $user, $course) {
        global $COURSE, $CFG;

        $fontlist = font_util::mpdf_list_fonts();

        // 297 mm    X  210 mm
        // 841,89 px X  595,28 px
        $proporcao = .85;
        $mpdf = new Mpdf([
            "mode" => "",
            "format" => [210 * $proporcao, 297 * $proporcao],
            "orientation" => $certificatebeautifulmodel->orientation,
            "tempDir" => "{$CFG->dataroot}/temp/mpdf",
            "margin_left" => 0,
            "margin_right" => 0,
            "margin_top" => 0,
            "margin_bottom" => 0,
            "margin_header" => 0,
            "margin_footer" => 0,
            "fontDir" => array_merge(
                (new ConfigVariables())->getDefaults()["fontDir"],
                $fontlist["path"]
            ),
            "default_font" => "Arial",
            "fontdata" => array_merge(
                (new FontVariables())->getDefaults()["fontdata"],
                $fontlist["fonts"]
            ),
        ]);
        $mpdf->autoPageBreak = false;

        $mpdf->SetAuthor($COURSE->fullname);
        $mpdf->SetCreator(get_string("modulename", "certificatebeautiful") . " - Model: " . $certificatebeautifulmodel->name);
        $mpdf->SetTitle($certificatebeautiful->name);
        $mpdf->SetSubject(get_string("create_at_certificate", "certificatebeautiful", fullname($user)));

        foreach ($certificatebeautifulmodel->pages_info_object as $page) {
            $mpdf->AddPageByArray([]);

            $page->htmldata = str_replace("<section", "<body", $page->htmldata);
            $page->htmldata = str_replace("</section>", "</body>", $page->htmldata);

            $extracss = "
                @page{
                    page-break-inside : avoid
                }
                html,
                body,
                img {
                    margin  : 0;
                    padding : 0;
                }";

            $replacetags = new replace_tags($page, $course, $user, $certificatebeautiful, $certificatebeautifulissue);
            $replacetags->repace_html();
            $replacetags->repace_css();
            $replacetags->repace_signature();
            $page = $replacetags->out_page();

            // Muda o CSS do body para que não interfira na página.
            $this->get_background_page($page, $mpdf);

            if (isset($page->cssdata[10])) {
                $mpdf->WriteHTML("{$page->cssdata}{$extracss}", HTMLParserMode::HEADER_CSS);
                $mpdf->WriteHTML($page->htmldata);
            } else {
                $mpdf->WriteHTML("<style>{$extracss}</style>\n{$page->htmldata}");
            }
        }

        $pdf = $mpdf->Output("name.pdf", Destination::STRING_RETURN);

        return $pdf;
    }

    /**
     * get_background_page
     *
     * @param object $page
     * @param Mpdf $mpdf
     */
    private function get_background_page($page, Mpdf $mpdf) {
        preg_match_all('/\[data-gjs-type="?wrapper"?\].*?}/s', $page->cssdata .  $page->htmldata, $cssroot);

        $blockcss = false;
        if (isset($cssroot[0][3]) && strpos($cssroot[0][3], "background-image")) {
            $blockcss = $cssroot[0][3];
        } else if (isset($cssroot[0][2]) && strpos($cssroot[0][2], "background-image")) {
            $blockcss = $cssroot[0][2];
        } else if (isset($cssroot[0][1]) && strpos($cssroot[0][1], "background-image")) {
            $blockcss = $cssroot[0][1];
        } else if (isset($cssroot[0][0]) && strpos($cssroot[0][0], "background-image")) {
            $blockcss = $cssroot[0][0];
        }

        if ($blockcss) {
            preg_match('/background.*url\((.*?)\)/', $blockcss, $background);
            if (isset($background[1])) {
                $image = $background[1];
                $image = str_replace("'", "", $image);
                $image = str_replace("\"", "", $image);

                // Sets the image as the page's WATERMARK.
                $mpdf->Image(
                    $image,  // Value of $file.
                    0, // Value of $x.
                    0, // Value of $y.
                    0, // Value of $w.
                    0, // Value of $h.
                    "", // Value of $type.
                    "", // Value of $link.
                    true, // Value of $paint.
                    true, // Value of $constrain.
                    true, // Value of $watermark.
                    true, // Value of $shownoimg.
                    true // Value of $allowvector.
                );
            }
        }
    }
}
