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
 * Class certificatebeautiful_model
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_certificatebeautiful\local\vo;

/**
 * Class certificatebeautiful_model
 *
 * @package mod_certificatebeautiful\local\vo
 */
class certificatebeautiful_model extends \stdClass {

    /** @var int */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $orientation;

    /**
     * phpcs:disable
     * @var string
     */
    public $pages_info;

    /**
     * phpcs:disable
     * @var string
     */
    public $model_key;

    /** @var int */
    public $timecreated;

    /** @var int */
    public $timemodified;

    /** @var array */
    public $pagesinfoobject;
}
