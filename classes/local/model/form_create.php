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
 * @date        09/01/2024 09:55
 */

namespace mod_certificatebeautiful\local\model;

use core\output\notification;
use mod_certificatebeautiful\local\vo\certificatebeautiful_model;

defined('MOODLE_INTERNAL') || die();
require_once("{$CFG->libdir}/formslib.php");

class form_create extends \moodleform {

    /**
     * Form definition. Abstract method - always override!
     *
     * @throws \coding_exception
     */
    protected function definition() {
        global $OUTPUT, $PAGE;

        $mform = $this->_form;
        /** @var certificatebeautiful_model $certificatebeautifulmodel */
        $certificatebeautifulmodel = $this->_customdata['certificatebeautiful_model'];

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('text', 'name', get_string('model_name', 'certificatebeautiful'), 'maxlength="254" size="50"');
        $mform->addRule('name', get_string('model_name_missing', 'certificatebeautiful'), 'required', null, 'client');
        $mform->setType('name', PARAM_TEXT);

        if ($certificatebeautifulmodel->id > 0) {
            $pageid = 1;
            $data = ["pages" => []];
            $pagesinfo = $certificatebeautifulmodel->pages_info_object;
            foreach ($pagesinfo as $key => $page) {
                if (!isset($page->htmldata)) {
                    $page->htmldata = form_create_page::empty_page();
                }
                if (!isset($page->cssdata)) {
                    $page->cssdata = "";
                }

                $htmldata = "{$page->htmldata}<style>{$page->cssdata}</style>";
                $htmldata = str_replace("[data-gjs-type=wrapper]", ".body-{$key}", $htmldata);
                $htmldata = "<div class='body-{$key}'>{$htmldata}</div>";

                $data["pages"][] = [
                    "title" => get_string('model_page_name', 'certificatebeautiful', $pageid++),
                    "pagina" => $htmldata,
                    "addpage_title" => get_string('edit_this_page', 'certificatebeautiful'),
                    "addpage_href" => "manage-model-editpage.php?id={$certificatebeautifulmodel->id}&page={$key}"
                ];
            }

            $data["add-new-page"] = count($data["pages"]) < 3;
            $data["add-new-page-link"] = "manage-model-editpage.php?id={$certificatebeautifulmodel->id}&action=select&page=" .
                count($data["pages"]);

            $mform->addElement("html", $OUTPUT->render_from_template('mod_certificatebeautiful/formgroup_create-page', $data));

            $this->add_action_buttons(true, get_string('save_model', 'certificatebeautiful'));
        } else {
            $message = get_string('create_after_model', 'certificatebeautiful');
            $mform->addElement("html",
                $PAGE->get_renderer('core')->render(new notification($message, notification::NOTIFY_WARNING)));

            $this->add_action_buttons(true, get_string('create_model', 'certificatebeautiful'));
        }

        $this->set_data($certificatebeautifulmodel);
    }
}
