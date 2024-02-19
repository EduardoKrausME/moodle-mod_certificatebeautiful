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
 * @package     mod_certificatebeautiful
 * @category    backup
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @Date        11/01/2024 11:52
 */

namespace mod_certificatebeautiful\pdf;

use mod_certificatebeautiful\fonts\font_util;
use mod_certificatebeautiful\help\certificate_issue;
use mod_certificatebeautiful\help\course;
use mod_certificatebeautiful\help\course_categories;
use mod_certificatebeautiful\help\enrolments;
use mod_certificatebeautiful\help\functions;
use mod_certificatebeautiful\help\grade;
use mod_certificatebeautiful\help\help_base;
use mod_certificatebeautiful\help\site;
use mod_certificatebeautiful\help\teachers;
use mod_certificatebeautiful\help\user;
use mod_certificatebeautiful\help\user_profile;
use mod_certificatebeautiful\vo\certificatebeautiful;
use mod_certificatebeautiful\vo\certificatebeautiful_issue;

class replace_tags {

    /** @var \stdClass */
    public $page;

    /** @var \stdClass */
    public $course;

    /** @var \stdClass */
    public $user;

    /** @var certificatebeautiful */
    public $certificatebeautiful;

    /** @var certificatebeautiful_issue */
    public $certificatebeautifulissue;

    /**
     * replace_tags constructor.
     * @param string $page
     * @param int $course
     * @param \stdClass $user
     * @param certificatebeautiful $certificatebeautiful
     * @param certificatebeautiful_issue $certificatebeautifulissue
     */
    public function __construct(\stdClass $page, $course, $user, $certificatebeautiful, $certificatebeautifulissue) {
        $this->page = $page;
        $this->course = $course;
        $this->user = $user;
        $this->certificatebeautiful = $certificatebeautiful;
        $this->certificatebeautifulissue = $certificatebeautifulissue;
    }

    /**
     * @param mixed $html
     */
    public function set_html($html) {

        // Remove qualquer HTML nas variáveis.
        $html = preg_replace_callback('/\{.*?\$.*?}/', function ($matches) {
            $data = $matches[0];
            $data = strip_tags($data);
            $data = preg_replace('/\s+/', '', $data);
            return $data;
        }, $html);

        // Remove qualquer HTML nas funções.
        $html = preg_replace_callback('/\{.*?\{.*?}.*?}/', function ($matches) {
            $data = $matches[0];
            $data = strip_tags($data);
            $data = preg_replace('/\s+/', '', $data);
            return $data;
        }, $html);

        $this->page->htmldata = $html;
    }

    /**
     * @param mixed $course
     */
    public function set_course($course): void {
        $this->course = $course;
    }

    /**
     * @param mixed $user
     */
    public function set_user($user): void {
        $this->user = $user;
    }

    /**
     * @throws \coding_exception
     * @throws \dml_exception
     * @throws \moodle_exception
     */
    public function repace_html() {

        $this->page->htmldata = str_replace('-&gt;', "->", $this->page->htmldata);
        $this->page->htmldata = str_replace('time()', time(), $this->page->htmldata);
        $this->page->htmldata = str_replace('now()', time(), $this->page->htmldata);

        preg_match_all('/{#s}(.*?){\/s}/', $this->page->htmldata, $strs);
        foreach ($strs[0] as $key => $str) {
            $this->page->htmldata = str_replace($strs[0][$key],
                get_string($strs[1][$key], 'certificatebeautiful'),
                $this->page->htmldata);
        }

        $this->page->htmldata = help_base::replace($this->page->htmldata, "SITE", site::get_data());

        $data = certificate_issue::get_data($this->certificatebeautiful, $this->certificatebeautifulissue);
        $this->page->htmldata = help_base::replace($this->page->htmldata, certificate_issue::CLASS_NAME, $data);
        $this->page->htmldata = certificate_issue::custom_replace($this->page->htmldata, $data);

        $data = user_profile::get_data($this->user);
        $this->page->htmldata = help_base::replace($this->page->htmldata, user_profile::CLASS_NAME, $data);

        $data = course::get_data($this->course);
        $this->page->htmldata = help_base::replace($this->page->htmldata, course::CLASS_NAME, $data);

        $data = grade::get_data($this->course, $this->user);
        $this->page->htmldata = help_base::replace($this->page->htmldata, grade::CLASS_NAME, $data);

        $data = course_categories::get_data($this->course);
        $this->page->htmldata = help_base::replace($this->page->htmldata, course_categories::CLASS_NAME, $data);

        $data = user::get_data($this->user);
        $this->page->htmldata = help_base::replace($this->page->htmldata, user::CLASS_NAME, $data);

        $data = teachers::get_data($this->course);
        $this->page->htmldata = help_base::replace($this->page->htmldata, teachers::CLASS_NAME, $data);

        $data = enrolments::get_data($this->course, $this->user);
        $this->page->htmldata = help_base::replace($this->page->htmldata, enrolments::CLASS_NAME, $data);

        $this->page->htmldata = functions::replace($this->page->htmldata, $this->user);
    }

    public function repace_signature() {
        global $CFG;

        $config = get_config('certificatebeautiful');
        if ($config->config_signature_enable && strlen($config->config_signature_text) >= 2) {
            $typography = $config->config_signature_typography;
            $color = $config->config_signature_color;

            $text = $config->config_signature_text;
            $text = preg_replace('/[^A-Za-z]/', '', $text);
            $text = substr($text, 0, 10);
            $text = ucfirst(strtolower($text));


            $file = "{$CFG->dirroot}/mod/certificatebeautiful/_editor/fonts/_signature-{$typography}/_signatre-{$typography}.svg";
            if (file_exists($file)) {
                $svg = file_get_contents($file);
                $svg = str_replace("#324A55", $color, $svg);
                $svg = str_replace(">Kraus<", ">{$text}<", $svg);

                $svgdata = 'src="data:image/svg+xml;base64,' . base64_encode($svg) . '"';

                $this->page->htmldata = preg_replace('/src=".*?\/assets\/signature.png"/', $svgdata, $this->page->htmldata);
            }
        }
    }

    public function repace_css() {

        $replace_tags_replace_fonts = function ($input) {
            $fonts = font_util::mpdf_list_fonts();

            foreach ($fonts['listfonts'] as $listfont) {
                $fontnameid = $listfont->fontnameid;
                //  $fontfamily = $listfont->fontfamily;

                $input[0] = str_replace("{$fontnameid},", "", $input[0]);
            }

            return $input[0];
        };

        $this->page->htmldata = preg_replace_callback('/-description\s?\{(.*?)}/s', $replace_tags_replace_fonts, $this->page->htmldata);
        $this->page->cssdata = preg_replace_callback('/-description\s?\{(.*?)}/s', $replace_tags_replace_fonts, $this->page->cssdata);

        // die($this->page->cssdata);
    }

    public function out_page() {
        return $this->page;
    }
}

