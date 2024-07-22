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
 * Class replace_tags
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\local\pdf;

use mod_certificatebeautiful\local\fonts\font_util;
use mod_certificatebeautiful\local\help\certificate_issue;
use mod_certificatebeautiful\local\help\course;
use mod_certificatebeautiful\local\help\course_categories;
use mod_certificatebeautiful\local\help\enrolments;
use mod_certificatebeautiful\local\help\functions;
use mod_certificatebeautiful\local\help\grade;
use mod_certificatebeautiful\local\help\help_base;
use mod_certificatebeautiful\local\help\site;
use mod_certificatebeautiful\local\help\teachers;
use mod_certificatebeautiful\local\help\user;
use mod_certificatebeautiful\local\help\user_profile;
use mod_certificatebeautiful\local\vo\certificatebeautiful;
use mod_certificatebeautiful\local\vo\certificatebeautiful_issue;

/**
 * Class replace_tags
 *
 * @package mod_certificatebeautiful\local\pdf
 */
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
     *
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
     * set_html
     *
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
     * set_course
     *
     * @param mixed $course
     */
    public function set_course($course): void {
        $this->course = $course;
    }

    /**
     * set_user
     *
     * @param mixed $user
     */
    public function set_user($user): void {
        $this->user = $user;
    }

    /**
     * repace_html
     *
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

    /**
     * Function repace_signature
     *
     * @throws \dml_exception
     */
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

    /**
     * Function repace_css
     */
    public function repace_css() {

        $replacetagsreplacefonts = function ($input) {
            $fonts = font_util::mpdf_list_fonts();

            foreach ($fonts['listfonts'] as $listfont) {
                $fontnameid = $listfont->fontnameid;

                $input[0] = str_replace("{$fontnameid},", "", $input[0]);
            }

            return $input[0];
        };

        $this->page->htmldata = preg_replace_callback('/-description\s?\{(.*?)}/s',
            $replacetagsreplacefonts, $this->page->htmldata);
        $this->page->cssdata = preg_replace_callback('/-description\s?\{(.*?)}/s',
            $replacetagsreplacefonts, $this->page->cssdata);
    }

    /**
     * Function out_page
     *
     * @return \stdClass|string
     */
    public function out_page() {
        return $this->page;
    }
}

