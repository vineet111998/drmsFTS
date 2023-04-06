<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Donor extends Admin_Controller {


public function donorAllocation()
{
	$donoridlist = $this->db->query("SELECT * FROM mst_donor ")->result_array();
      $this->data["donoridlist"] = $donoridlist;
      $this->load->view("donor_allocation",$this->data);
}
}
?>