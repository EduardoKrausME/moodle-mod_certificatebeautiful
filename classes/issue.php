<?php
/**
 * User: Eduardo Kraus
 * Date: 12/01/2024
 * Time: 11:02
 */

namespace mod_certificatebeautiful;

use mod_certificatebeautiful\vo\certificatebeautiful;
use mod_certificatebeautiful\vo\certificatebeautiful_issue;

class issue {
    /**
     * @param $user
     * @param certificatebeautiful $certificatebeautiful
     * @param $cm
     * @param $course
     *
     * @return certificatebeautiful_issue
     *
     * @throws \dml_exception
     */
    public static function get($user, $certificatebeautiful, $cm) {
        global $DB;

        $certificatebeautiful_issue = $DB->get_record('certificatebeautiful_issue', ["userid" => $user->id, "cmid" => $cm->id]);
        if (!$certificatebeautiful_issue) {
            $certificatebeautiful_issue = (object)[
                "userid" => $user->id,
                "cmid" => $cm->id,
                "certificatebeautifulid" => $certificatebeautiful->id,
                "code" => substr(strtoupper("c" . uniqid()), 0, 10),
                "version" => $certificatebeautiful->timemodified,
                "timecreated" => time()
            ];
            $certificatebeautiful_issue->id = $DB->insert_record('certificatebeautiful_issue', $certificatebeautiful_issue);
        }

        return $certificatebeautiful_issue;
    }
}