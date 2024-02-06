<?php
/**
 * User: Eduardo Kraus
 * Date: 09/01/2024
 * Time: 12:15
 */

namespace mod_certificatebeautiful\model;

require_once($CFG->dirroot . '/lib/formslib.php');

class form_create_page extends \moodleform {

    public static function emptyPage() {

        return (object)[
            "htmldata" => '<section id="topo" class="certificate-root"><div>' . get_string('certificate_page_empty', 'certificatebeautiful') . '</div></section>',
            "cssdata" => ""
        ];
    }

    /**
     * Form definition. Abstract method - always override!
     */
    protected function definition() {
        //
    }
}