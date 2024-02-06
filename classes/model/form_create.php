<?php
/**
 * User: Eduardo Kraus
 * Date: 09/01/2024
 * Time: 09:55
 */

namespace mod_certificatebeautiful\model;

use core\output\notification;
use mod_certificatebeautiful\vo\certificatebeautiful_model;

require_once($CFG->dirroot . '/lib/formslib.php');

class form_create extends \moodleform {

    /**
     * Form definition. Abstract method - always override!
     */
    protected function definition() {
        global $OUTPUT, $PAGE;

        $mform = $this->_form;
        /** @var certificatebeautiful_model $certificatebeautiful_model */
        $certificatebeautiful_model = $this->_customdata['certificatebeautiful_model'];

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('text', 'name', get_string('model_name', 'certificatebeautiful'), 'maxlength="254" size="50"');
        // $mform->addHelpButton('name', 'namecourse');
        $mform->addRule('name', get_string('model_name_missing', 'certificatebeautiful'), 'required', null, 'client');
        $mform->setType('name', PARAM_TEXT);

        if ($certificatebeautiful_model->id > 0) {
            $pageid = 1;
            $data = ["pages" => []];
            $pages_info = $certificatebeautiful_model->pages_info_object;
            foreach ($pages_info as $key => $page) {
                if (!isset($page->htmldata)) {
                    $page->htmldata = form_create_page::emptyPage();
                }
                if (!isset($page->cssdata)) {
                    $page->cssdata = "";
                }
                $data["pages"][] = [
                    "title" => get_string('model_page_name', 'certificatebeautiful', $pageid++),
                    "pagina" => "{$page->htmldata}<style>{$page->cssdata}</style>",
                    "addpage_href" => "manage-model-editpage.php?id={$certificatebeautiful_model->id}&page={$key}"
                ];
            }

            $data["add-new-page"] = count($data["pages"]) < 3;
            $data["add-new-page-link"] = "manage-model-editpage.php?id={$certificatebeautiful_model->id}&action=select&page=" . count($data["pages"]);

            $mform->addElement("html", $OUTPUT->render_from_template('mod_certificatebeautiful/formgroup_create-page', $data));


            $this->add_action_buttons(true, get_string('save_model', 'certificatebeautiful'));
        } else {
            $message = get_string('create_after_model', 'certificatebeautiful');
            $mform->addElement("html", $PAGE->get_renderer('core')->render(new notification($message, notification::NOTIFY_WARNING)));


            $this->add_action_buttons(true, get_string('create_model', 'certificatebeautiful'));
        }

        $this->set_data($certificatebeautiful_model);
    }
}