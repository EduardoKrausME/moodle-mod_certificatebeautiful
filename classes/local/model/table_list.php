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
 * Class table_list
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\local\model;

use table_sql;

/**
 * Class table_list
 *
 * @package mod_certificatebeautiful\local\model
 */
class table_list extends table_sql {

    /**
     * table_list constructor.
     *
     * @param $uniqueid
     */
    public function __construct($uniqueid) {
        parent::__construct($uniqueid);
        $this->set_sql('id, name', "{certificatebeautiful_model}", '1=1');
    }

    /**
     * col_name function
     *
     * @param \stdClass $data
     * @return string
     */
    public function col_name($data) {
        return "<a href='manage-model.php?id={$data->id}'>{$data->name}</a>";
    }
}
