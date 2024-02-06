<?php
/**
 * User: Eduardo Kraus
 * Date: 09/01/2024
 * Time: 10:15
 */

namespace mod_certificatebeautiful\vo;


class certificatebeautiful_model extends \stdClass {
    public $id;
    public $name;
    public $pages_info;
    public $timecreated;
    public $timemodified;

    /** @var array */
    public $pages_info_object;
}