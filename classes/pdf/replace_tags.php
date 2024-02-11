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
 * Date: 11/01/2024
 * Time: 11:52
 */

namespace mod_certificatebeautiful\pdf;

use mod_certificatebeautiful\help\certificate;
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

class replace_tags {

    public $html;
    public $course;
    public $user;
    public $certificatebeautiful;

    public function __construct($html, $course, $user, $certificatebeautiful) {
        $this->html = $html;
        $this->course = $course;
        $this->user = $user;
        $this->certificatebeautiful = $certificatebeautiful;
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

        $this->html = $html;
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
     */
    public function out() {

        $this->html = str_replace('-&gt;', "->", $this->html);
        $this->html = str_replace('time()', time(), $this->html);
        $this->html = str_replace('now()', time(), $this->html);

        $this->html = help_base::replace($this->html, "SITE", site::get_data());

        $certificatebeautiful = certificate::get_data($this->certificatebeautiful);
        $this->html = help_base::replace($this->html, "certificate", $certificatebeautiful);
        $this->html = certificate::custom_replace($this->html, $certificatebeautiful);

        $this->html = help_base::replace($this->html, "user_profile", user_profile::get_data($this->user));

        $this->html = help_base::replace($this->html, "course", course::get_data($this->course));

        $this->html = help_base::replace($this->html, "grade", grade::get_data($this->course, $this->user));

        $this->html = help_base::replace($this->html, "course_categories", course_categories::get_data($this->course));

        $this->html = help_base::replace($this->html, "USER", user::get_data($this->user));

        $this->html = help_base::replace($this->html, "teachers", teachers::get_data($this->course));

        $this->html = help_base::replace($this->html, "enrolments", enrolments::get_data($this->course, $this->user));

        $this->html = functions::replace($this->html, $this->user);

        return $this->html;
    }
}
