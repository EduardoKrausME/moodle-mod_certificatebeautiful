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
 * Class certificatebeautiful_view
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\local\report;

use html_writer;
use mod_certificatebeautiful\local\vo\certificatebeautiful;
use moodle_url;

defined('MOODLE_INTERNAL') || die;
require_once("{$CFG->libdir}/tablelib.php");

/**
 * Class certificatebeautiful_view
 *
 * @package mod_certificatebeautiful\local\report
 */
class certificatebeautiful_view extends \table_sql {

    /**
     * @var int
     */
    public $cmid = 0;

    /**
     * certificatebeautiful_view constructor.
     *
     * @param $uniqueid
     * @param $cmid
     * @param certificatebeautiful $certificatebeautiful
     *
     * @throws \coding_exception
     */
    public function __construct($uniqueid, $cmid, $certificatebeautiful) {
        parent::__construct($uniqueid);

        $this->cmid = $cmid;

        $this->is_downloadable(true);
        $this->show_download_buttons_at([TABLE_P_BOTTOM]);

        $download = optional_param("download", null, PARAM_ALPHA);
        if ($download) {
            raise_memory_limit(MEMORY_EXTRA);
            $filename = get_string("report_filename", "certificatebeautiful");
            $this->is_downloading($download, $filename, $certificatebeautiful->name);
        }

        $columns = [
            "fullname",
            "email",
            "code",
            "timecreated",
        ];
        $headers = [
            get_string("report_usernome", "certificatebeautiful"),
            get_string("report_useremail", "certificatebeautiful"),
            get_string("report_code", "certificatebeautiful"),
            get_string("report_timecreated", "certificatebeautiful"),
        ];

        if (!$this->is_downloading()) {
            $columns[] = "extra";
            $headers[] = "";
        }

        $this->define_columns($columns);
        $this->column_class("extra", "certificatebeautiful-report-extra-width");
        $this->define_headers($headers);
    }

    /**
     * Fullname is treated as a special columname in tablelib and should always
     * be treated the same as the fullname of a user.
     *
     * @uses $this->useridfield if the userid field is not expected to be id
     * then you need to override $this->useridfield to point at the correct
     * field for the user id.
     *
     * @param object $row   the data from the db containing all fields from the
     *                      users table necessary to construct the full name of the user in
     *                      current language.
     *
     * @return string contents of cell in column 'fullname', for this row.
     *
     * @throws \moodle_exception
     */
    public function col_fullname($row) {
        global $COURSE;

        $name = fullname($row);
        if ($this->download) {
            return $name;
        }

        if ($COURSE->id == SITEID) {
            $profileurl = new moodle_url("/user/profile.php", ["id" => $row->userid]);
        } else {
            $profileurl = new moodle_url("/user/view.php",
                ["id" => $row->userid, "course" => $COURSE->id]);
        }
        return html_writer::link($profileurl, $name, ["target" => "_blank"]);
    }

    /**
     * Function col_code
     *
     * @param $row
     *
     * @return mixed
     * @throws \dml_exception
     */
    public function col_code(&$row) {
        global $DB;

        $row->code = $DB->get_field("certificatebeautiful_issue", "code", ["userid" => $row->userid, "cmid" => $this->cmid]);
        if ($row->code) {
            return $row->code;
        } else {
            return "--";
        }
    }

    /**
     * col_timecreated
     *
     * @param $row
     *
     * @return string
     * @throws \dml_exception
     */
    public function col_timecreated(&$row) {
        global $DB;

        $row->timecreated = $DB->get_field("certificatebeautiful_issue", "timecreated",
            ["userid" => $row->userid, "cmid" => $this->cmid]);
        if ($row->timecreated) {
            return userdate($row->timecreated);
        } else {
            return "--";
        }
    }

    /**
     * col_extra
     *
     * @param $row
     *
     * @return string
     *
     * @throws \moodle_exception
     */
    public function col_extra($row) {
        global $DB, $OUTPUT;

        $issueid = $DB->get_field("certificatebeautiful_issue", "timecreated",
            ["userid" => $row->userid, "cmid" => $this->cmid]);

        if ($row->timecreated) {
            $paramsvalidate = ["code" => $row->code];
            $paramsview = ["code" => $row->code, "action" => "view"];
            $data = [
                "download" => true,
                "uniqid" => uniqid(),
                "url-validate" => (new moodle_url("/mod/certificatebeautiful/v/", $paramsvalidate))->out(),
                "url-view" => (new moodle_url("/mod/certificatebeautiful/view-pdf.php", $paramsview))->out(),
            ];

            if (has_capability("mod/certificatebeautiful:addinstance", \context_system::instance())) {
                $paramsdelete = [
                    "id" => $this->cmid,
                    "issueid" => $issueid,
                    "action" => "delete",
                    "sesskey" => sesskey(),
                ];
                $data["url-delete"] = (new moodle_url("/mod/certificatebeautiful/report.php", $paramsdelete))->out();
            }
        } else {
            $paramscreate = [
                "userid" => $row->userid,
                "action" => "createadmin",
                "cmid" => $this->cmid,
                "code" => "createadmin",
            ];
            $data = [
                "create" => true,
                "url-create" => (new moodle_url("/mod/certificatebeautiful/view-pdf.php", $paramscreate))->out(),
            ];
        }
        return $OUTPUT->render_from_template("mod_certificatebeautiful/certificatebeautiful_view-extra", $data);
    }

    /**
     * query_db
     *
     * @param int $pagesize
     * @param bool $useinitialsbar
     *
     * @throws \dml_exception
     */
    public function query_db($pagesize, $useinitialsbar = true) {
        global $DB;

        $params = ["cmid" => $this->cmid];

        $sqlwhere = $this->get_sql_where();
        $where = $sqlwhere[0] ? "AND {$sqlwhere[0]}" : "";
        $params = array_merge($params, $sqlwhere[1]);

        $order = $this->get_sort_for_table($this->uniqueid);
        if (!$order) {
            $order = "u.firstname";
        }

        $this->sql = "SELECT DISTINCT u.id AS userid, u.email, u.firstnamephonetic, u.lastnamephonetic,
                             u.middlename, u.alternatename, u.firstname, u.lastname
                        FROM {course}           c
                        JOIN {enrol}            e ON e.courseid = c.id
                        JOIN {user_enrolments} ue ON ue.enrolid = e.id
                        JOIN {user}             u ON ue.userid  = u.id
                             {$where}
                    ORDER BY {$order}";

        if ($pagesize != -1) {
            $countsql = "SELECT COUNT(cbi.code) as c
                           FROM {certificatebeautiful_issue} cbi
                           JOIN {user}                         u ON u.id = cbi.userid
                          WHERE cbi.cmid = :cmid {$where}";
            $total = $DB->get_field_sql($countsql, $params);
            $this->pagesize($pagesize, $total);
        } else {
            $this->pageable(false);
        }

        if ($useinitialsbar && !$this->is_downloading()) {
            $this->initialbars(true);
        }

        $this->rawdata = $DB->get_recordset_sql($this->sql, $params, $this->get_page_start(), $this->get_page_size());
    }
}
