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
 * Class replace_tags
 *
 * @package   mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\pdf;

use certificatebeautifuldatainfo_certificateissue\datainfo\certificateissue;
use certificatebeautifuldatainfo_course\datainfo\course;
use certificatebeautifuldatainfo_functions\datainfo\functions;
use Exception;
use mod_certificatebeautiful\datainfo\help_base;
use mod_certificatebeautiful\fonts\font_util;
use mod_certificatebeautiful\plugininfo\certificatebeautifuldatainfo;
use mod_certificatebeautiful\vo\certificatebeautiful;
use mod_certificatebeautiful\vo\certificatebeautiful_issue;
use stdClass;

/**
 * Class replace_tags
 *
 * @package mod_certificatebeautiful\pdf
 */
class replace_tags {

    /** @var stdClass */
    public $page;

    /** @var stdClass */
    public $course;

    /** @var stdClass */
    public $user;

    /** @var certificatebeautiful */
    public $certificatebeautiful;

    /** @var certificatebeautiful_issue */
    public $certificatebeautifulissue;

    /**
     * replace_tags constructor.
     *
     * @param stdClass $page
     * @param stdClass $course
     * @param stdClass $user
     * @param certificatebeautiful $certificatebeautiful
     * @param certificatebeautiful_issue $certificatebeautifulissue
     */
    public function __construct(stdClass $page, $course, $user, $certificatebeautiful, $certificatebeautifulissue) {
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
            $data = preg_replace('/\s+/', "", $data);
            return $data;
        }, $html);

        // Remove qualquer HTML nas funções.
        $html = preg_replace_callback('/\{.*?\{.*?}.*?}/', function ($matches) {
            $data = $matches[0];
            $data = strip_tags($data);
            $data = preg_replace('/\s+/', "", $data);
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
     * @throws Exception
     */
    public function repace_html() {
        $this->page->htmldata = str_replace("-&gt;", "->", $this->page->htmldata);

        $this->page->htmldata = str_replace('{\$', '{$', $this->page->htmldata);
        $this->page->htmldata = preg_replace('/\{\s+$/', '{$', $this->page->htmldata);

        $this->page->htmldata = preg_replace('/time\s?\(\s?\)/', time(), $this->page->htmldata);
        $this->page->htmldata = preg_replace('/now\s?\(\s?\)/', time(), $this->page->htmldata);

        preg_match_all('/{#s}(.*?){\/s}/', $this->page->htmldata, $strs);
        foreach ($strs[0] as $key => $str) {
            $this->page->htmldata = str_replace($strs[0][$key],
                get_string($strs[1][$key], "certificatebeautiful"),
                $this->page->htmldata);
        }

        $plugins = certificatebeautifuldatainfo::get_enabled_plugins();

        foreach ($plugins as $plugin) {
            switch ($plugin) {
                case "functions":
                    break;
                case "certificateissue":
                    $certificateissuedata = certificateissue::get_data(
                        $this->certificatebeautiful, $this->certificatebeautifulissue);
                    $this->page->htmldata = help_base::replace(
                        $this->page->htmldata, certificateissue::CLASS_NAME, $certificateissuedata);
                    $this->page->htmldata = certificateissue::custom_replace(
                        $this->page->htmldata, $certificateissuedata);
                    break;
                default:
                    /** @var course $class */
                    $class = "\certificatebeautifuldatainfo_{$plugin}\\datainfo\\{$plugin}";
                    $this->page->htmldata = help_base::replace(
                        $this->page->htmldata, $class::CLASS_NAME, $class::get_data($this->course, $this->user));

                    if (method_exists($class, "process_html")) {
                        $this->page->htmldata = $class::process_html($this->page->htmldata, $this->course, $this->user);
                    }

                    break;
            }
        }

        foreach ($plugins as $plugin) {
            switch ($plugin) {
                case "functions":
                    $this->page->htmldata = functions::replace($this->page->htmldata, $this->user);
                    break;
            }
        }

        $this->page->htmldata = preg_replace('/\{\$\w+->(\w+)\}/', '$1', $this->page->htmldata);
    }

    /**
     * Function repace_signature
     *
     * @throws Exception
     */
    public function repace_signature() {
        global $CFG;

        $config = get_config("certificatebeautiful");
        if ($config->config_signature_enable && strlen($config->config_signature_text) >= 2) {
            $typography = $config->config_signature_typography;
            $color = $config->config_signature_color;

            $text = $config->config_signature_text;
            $text = preg_replace('/[^A-Za-z]/', "", $text);
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

            foreach ($fonts["listfonts"] as $listfont) {
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
     * @return stdClass|string
     */
    public function out_page() {
        return $this->page;
    }
}
