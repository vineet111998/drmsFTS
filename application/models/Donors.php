<?php

/**
 *
 */
class Donors extends MY_Model {

    public $tableName = 'mst_donors';
    public $primaryKey = 'md_id';

    function __construct() {
        parent::__construct();
    }

}
