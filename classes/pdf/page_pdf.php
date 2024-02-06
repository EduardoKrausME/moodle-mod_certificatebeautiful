<?php
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
     * @param certificatebeautiful_model $certificatebeautiful_model
     * @param $user
     * @param $course
     * @return string
     * @throws MpdfException
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public function create_pdf($certificatebeautiful, $certificatebeautiful_model, $user, $course) {
        global $COURSE, $CFG;

        $fontList = font_util::mpdf_list_fonts();

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
                    $fontList["path"]
                ),
            'default_font' => 'Arial',
            'fontdata' =>
                array_merge(
                    (new FontVariables())->getDefaults()['fontdata'],
                    $fontList["fonts"]
                )
        ]);
        $mpdf->SetProtection(['print', 'print-highres'], '', 'asjdfasjdhfgajdhsfagsdfhasjdfasdgjfhagyruitywuerfdf', 128);
        $mpdf->autoPageBreak = false;

        $mpdf->SetAuthor($COURSE->fullname);
        $mpdf->SetCreator(get_string('modulename', 'certificatebeautiful') . ' - Model: ' . $certificatebeautiful_model->name);
        $mpdf->SetTitle($certificatebeautiful->name);
        $mpdf->SetSubject(get_string('create_at_certificate', 'certificatebeautiful', fullname($user)));

        $mpdf->exposeVersion = "2.1.0";
        // $mpdf->set

        foreach ($certificatebeautiful_model->pages_info_object as $page) {
            $mpdf->AddPageByArray([]);

            // $page->htmldata = file_get_contents("{$CFG->dirroot}/mod/certificatebeautiful/_editor/_model/certificate-elegant/index.html");

            $page->htmldata = str_replace("<section", "<body", $page->htmldata);
            $page->htmldata = str_replace("</section>", "</body>", $page->htmldata);

            preg_match('/id="(.*?)" class="certificate-root"/', $page->htmldata, $ids);
            $extraCss = "
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

            preg_match_all('/\#' . $ids[1] . '.*?\}/s', $page->htmldata . $page->cssdata, $cssRoot);
            preg_match('/background.*url\((.*?)\)/', $cssRoot[0][0], $background);
            if (isset($background[1])) {
                $image = $background[1];
                $image = str_replace("'", "", $image);
                $image = str_replace("\"", "", $image);
                // Coloca a imagem como WATERMARK da página
                $mpdf->Image($image, 0, 0, 0, 0, '', '', true, false, true);
            }

            // Muda o CSS do body (antiga section) para que não interfira na página
            $newCss = $cssRoot[0][0];
            $newCss = str_replace("width", "a--width", $newCss);
            $newCss = str_replace("height", "a--height", $newCss);
            $newCss = str_replace("margin", "a--margin", $newCss);
            $newCss = str_replace("padding", "a--padding", $newCss);
            $newCss = str_replace("position", "a--position", $newCss);
            $newCss = str_replace("background", "a--background", $newCss);

            $page->cssdata = str_replace($cssRoot[0][0], $newCss, $page->cssdata);
            $page->htmldata = str_replace($cssRoot[0][0], $newCss, $page->htmldata);

            $replacetags = new replace_tags($page->htmldata, $course, $user);
            $page->htmldata = $replacetags->out();

            if (isset($page->cssdata[10])) {

                $mpdf->WriteHTML($page->cssdata . $extraCss, HTMLParserMode::HEADER_CSS);
                $mpdf->WriteHTML($page->htmldata, HTMLParserMode::HTML_BODY);
            } else {

                $mpdf->WriteHTML("{$page->htmldata}\n<style>{$extraCss}</style>");

            }
        }

        return $mpdf->Output("name.pdf", Destination::STRING_RETURN);
    }
}