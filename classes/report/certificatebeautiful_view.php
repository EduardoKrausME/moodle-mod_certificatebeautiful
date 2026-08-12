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
 * Certificate report table.
 *
 * @package mod_certificatebeautiful
 * @copyright 2025 Eduardo Kraus https://eduardokraus.com/
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\report;

use context_module;
use Exception;
use html_writer;
use mod_certificatebeautiful\vo\certificatebeautiful;
use moodle_url;
use table_sql;

defined('MOODLE_INTERNAL') || die;
require_once("{$CFG->libdir}/tablelib.php");
require_once("{$CFG->libdir}/gradelib.php");

/**
 * Certificate report table.
 */
class certificatebeautiful_view extends table_sql {

    /** @var int */
    public $cmid = 0;

    /** @var certificatebeautiful */
    public $certificatebeautiful;

    /** @var \grade_item|false Course grade item used only for formatting. */
    protected $coursegradeitem = false;

    /** @var bool Whether the current user may create/delete issued certificates. */
    protected $canmanageissues = false;

    /**
     * Constructor.
     *
     * @param string $uniqueid
     * @param int $cmid
     * @param certificatebeautiful $certificatebeautiful
     * @throws Exception
     */
    public function __construct($uniqueid, $cmid, $certificatebeautiful) {
        parent::__construct($uniqueid);
        $this->cmid = $cmid;
        $this->certificatebeautiful = $certificatebeautiful;
        $this->coursegradeitem = \grade_item::fetch_course_item($certificatebeautiful->course);
        $this->canmanageissues = has_capability(
            "mod/certificatebeautiful:viewreport",
            context_module::instance($this->cmid)
        );

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
            "finalgrade",
            "timecreated",
        ];
        $headers = [
            get_string("report_usernome", "certificatebeautiful"),
            get_string("report_useremail", "certificatebeautiful"),
            get_string("report_code", "certificatebeautiful"),
            get_string("report_finalgrade", "certificatebeautiful"),
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
     * Formats the user fullname.
     *
     * @param object $row
     * @return string
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
            $profileurl = new moodle_url("/user/view.php", [
                "id" => $row->userid,
                "course" => $COURSE->id,
            ]);
        }
        return html_writer::link($profileurl, $name, ["target" => "_blank"]);
    }

    /**
     * Returns the certificate validation code already loaded by the main query.
     *
     * @param object $row
     * @return string
     */
    public function col_code($row) {
        return !empty($row->code) ? $row->code : "--";
    }

    /**
     * Returns the current final course grade already loaded by the main query.
     *
     * @param object $row
     * @return string
     */
    public function col_finalgrade($row) {
        if ($row->finalgrade === null || !$this->coursegradeitem) {
            return "--";
        }

        return grade_format_gradevalue($row->finalgrade, $this->coursegradeitem, true);
    }

    /**
     * Formats issue creation time.
     *
     * @param object $row
     * @return string
     */
    public function col_timecreated($row) {
        return !empty($row->timecreated) ? userdate($row->timecreated) : "--";
    }

    /**
     * Renders actions without additional per-row database queries.
     *
     * @param object $row
     * @return string
     */
    public function col_extra($row) {
        global $OUTPUT;

        if (!empty($row->issueid)) {
            $paramsvalidate = ["code" => $row->code];
            $paramsview = ["code" => $row->code, "action" => "view"];
            $data = [
                "download" => true,
                "uniqid" => uniqid(),
                "url-validate" => (new moodle_url("/mod/certificatebeautiful/v/", $paramsvalidate))->out(),
                "url-view" => (new moodle_url("/mod/certificatebeautiful/view-pdf.php", $paramsview))->out(),
            ];

            if ($this->canmanageissues) {
                $data["url-delete"] = new moodle_url("/mod/certificatebeautiful/view.php", [
                    "id" => $this->cmid,
                    "issueid" => $row->issueid,
                    "action" => "delete",
                    "sesskey" => sesskey(),
                ]);
            }
        } else {
            $data = [
                "create" => true,
                "url-create" => new moodle_url("/mod/certificatebeautiful/view-pdf.php", [
                    "userid" => $row->userid,
                    "action" => "createadmin",
                    "cmid" => $this->cmid,
                    "sesskey" => sesskey(),
                ]),
            ];
        }

        return $OUTPUT->render_from_template("mod_certificatebeautiful/certificatebeautiful_view-extra", $data);
    }

    /**
     * Loads report data.
     *
     * The issue and grade data are joined in the main query so rendering a page does not
     * execute extra database/gradebook queries for each student.
     *
     * @param int $pagesize
     * @param bool $useinitialsbar
     * @return void
     */
    public function query_db($pagesize, $useinitialsbar = true) {
        global $DB;

        $params = [
            "cmid" => $this->cmid,
            "courseid" => $this->certificatebeautiful->course,
            "gradeitemid" => $this->coursegradeitem ? $this->coursegradeitem->id : 0,
        ];

        $sqlwhere = $this->get_sql_where();
        $where = $sqlwhere[0] ? "AND {$sqlwhere[0]}" : "";
        $params = array_merge($params, $sqlwhere[1]);

        $order = $this->get_sort_for_table($this->uniqueid);
        if (!$order) {
            $order = "u.firstname";
        }

        $this->sql = "SELECT DISTINCT
                             u.id AS userid,
                             u.email,
                             u.firstname,
                             u.lastname,
                             u.firstnamephonetic,
                             u.lastnamephonetic,
                             u.middlename,
                             u.alternatename,
                             cbi.id AS issueid,
                             cbi.code,
                             cbi.timecreated,
                             gg.finalgrade
                        FROM {course}                     c
                        JOIN {enrol}                      e   ON c.id = e.courseid
                        JOIN {user_enrolments}            ue  ON e.id = ue.enrolid
                        JOIN {user}                       u   ON u.id = ue.userid
                   LEFT JOIN {certificatebeautiful_issue} cbi ON cbi.userid = u.id AND cbi.cmid = :cmid
                   LEFT JOIN {grade_grades}               gg  ON gg.userid = u.id AND gg.itemid = :gradeitemid
                       WHERE u.deleted   = 0
                         AND u.suspended = 0
                         AND ue.status   = 0
                         AND e.status    = 0
                         AND c.id        = :courseid
                             {$where}
                    ORDER BY {$order}";

        if ($pagesize != -1) {
            $countsql = "SELECT COUNT(DISTINCT u.id)
                           FROM {course}           c
                           JOIN {enrol}            e  ON c.id = e.courseid
                           JOIN {user_enrolments} ue ON e.id = ue.enrolid
                           JOIN {user}             u  ON u.id = ue.userid
                          WHERE u.deleted   = 0
                            AND u.suspended = 0
                            AND ue.status   = 0
                            AND e.status    = 0
                            AND c.id        = :courseid
                                {$where}";
            $countparams = $params;
            unset($countparams["cmid"], $countparams["gradeitemid"]);
            $total = $DB->get_field_sql($countsql, $countparams);
            $this->pagesize($pagesize, $total);
        } else {
            $this->pageable(false);
        }

        if ($useinitialsbar && !$this->is_downloading()) {
            $this->initialbars(true);
        }

        $this->rawdata = $DB->get_recordset_sql(
            $this->sql,
            $params,
            $this->get_page_start(),
            $this->get_page_size()
        );
    }
}
