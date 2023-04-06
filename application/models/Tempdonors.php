<?php

/**
 *
 */
class Tempdonors extends MY_Model {

    public $tableName = 'temp_excel_donors';
    public $primaryKey = 'temp_md_id';

    function __construct() {
        parent::__construct();
    }

}
