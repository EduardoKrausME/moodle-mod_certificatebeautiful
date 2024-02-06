<?php
/**
 * User: Eduardo Kraus
 * Date: 07/01/2024
 * Time: 23:23
 */

namespace mod_certificatebeautiful\model;

use table_sql;

class table_list extends table_sql {

    public function __construct($uniqueid) {
        parent::__construct($uniqueid);
        $this->set_sql('id, name', "{certificatebeautiful_model}", '1=1');
    }

    public function col_name($data) {
        return "<a href='manage-model.php?id={$data->id}'>{$data->name}</a>";
    }
}