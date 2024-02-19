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
 * @date        12/01/2024 11:30
 */

namespace mod_certificatebeautiful\report;

use html_writer;
use moodle_url;

defined('MOODLE_INTERNAL') || die();
require_once("{$CFG->libdir}/tablelib.php");

/**
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class certificatebeautiful_view_user extends \table_sql {

    /**
     * @var object
     */
    public $user = 0;

    /**
     * certificatebeautiful_view constructor.
     *
     * @param $uniqueid
     * @param object $user
     *
     * @throws \coding_exception
     */
    public function __construct($uniqueid, $user) {
        parent::__construct($uniqueid);

        $this->user = $user;

        $this->is_downloadable(true);
        $this->show_download_buttons_at([TABLE_P_BOTTOM]);

        $download = optional_param('download', null, PARAM_ALPHA);
        if ($download) {
            raise_memory_limit(MEMORY_EXTRA);
            $filename = get_string('report_filename', 'certificatebeautiful');
            $this->is_downloading($download, $filename, fullname($user));
        }

        $columns = [
            'fullname',
            'email',
            'code',
            'timecreated',
        ];
        $headers = [
            get_string('report_usernome', 'certificatebeautiful'),
            get_string('report_useremail', 'certificatebeautiful'),
            get_string('report_code', 'certificatebeautiful'),
            get_string('report_timecreated', 'certificatebeautiful'),
        ];

        if (!$this->is_downloading()) {
            $columns[] = 'extra';
            $headers[] = '';
        }

        $this->define_columns($columns);
        $this->column_class('extra', 'certificatebeautiful-report-extra-width');
        $this->define_headers($headers);
    }

    /**
     * Fullname is treated as a special columname in tablelib and should always
     * be treated the same as the fullname of a user.
     * @uses $this->useridfield if the userid field is not expected to be id
     * then you need to override $this->useridfield to point at the correct
     * field for the user id.
     *
     * @param object $linha the data from the db containing all fields from the
     *                      users table necessary to construct the full name of the user in
     *                      current language.
     *
     * @return string contents of cell in column 'fullname', for this row.
     *
     * @throws \moodle_exception
     */
    public function col_fullname($linha) {
        global $COURSE;

        $name = fullname($linha);
        if ($this->download) {
            return $name;
        }

        if ($COURSE->id == SITEID) {
            $profileurl = new moodle_url('/user/profile.php', array('id' => $linha->user_id));
        } else {
            $profileurl = new moodle_url('/user/view.php',
                array('id' => $linha->user_id, 'course' => $COURSE->id));
        }
        return html_writer::link($profileurl, $name, ['target' => '_blank']);
    }

    /**
     * @param $linha
     *
     * @return string
     */
    public function col_timecreated($linha) {
        return userdate($linha->timecreated);
    }

    /**
     * @param $linha
     *
     * @return string
     *
     * @throws \moodle_exception
     */
    public function col_extra($linha) {
        global $OUTPUT;

        $urloptions = ['code' => $linha->code, 'action' => 'view'];

        $data = [
            "uniqid" => uniqid(),
            "url-view" => (new moodle_url('/mod/certificatebeautiful/view-pdf.php?', $urloptions))->out(),
            "url-delete" => false,
        ];
        return $OUTPUT->render_from_template('mod_certificatebeautiful/certificatebeautiful_view-extra', $data);
    }

    /**
     * @param int $pagesize
     * @param bool $useinitialsbar
     *
     * @throws \dml_exception
     */
    public function query_db($pagesize, $useinitialsbar = true) {
        global $DB;

        $params = ["userid" => $this->user->id];

        $sqlwhere = $this->get_sql_where();
        $where = $sqlwhere[0] ? "AND {$sqlwhere[0]}" : "";
        $params = array_merge($params, $sqlwhere[1]);

        $order = $this->get_sort_for_table($this->uniqueid);
        if (!$order) {
            $order = "u.firstname";
        }

        $this->sql = "SELECT cbi.id AS issueid, cbi.cmid, cbi.code, cbi.timecreated,
                             u.id AS user_id, u.email, u.firstnamephonetic, u.lastnamephonetic,
                             u.middlename, u.alternatename, u.firstname, u.lastname
                        FROM {certificatebeautiful_issue} cbi
                        JOIN {user}                   u ON u.id = cbi.userid
                        JOIN {certificatebeautiful}        cb ON cb.id = cbi.certificatebeautifulid
                       WHERE cbi.userid = :userid
                             {$where}
                    ORDER BY {$order}";

        if ($pagesize != -1) {
            $countsql = "SELECT COUNT(code) as c
                           FROM {certificatebeautiful_issue}
                          WHERE userid = :userid {$where}";
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
