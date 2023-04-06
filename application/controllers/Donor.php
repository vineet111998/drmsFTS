<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Donor extends Admin_Controller {


public function donorAllocation()
{
	$donoridlist = $this->db->query("SELECT * FROM mst_donor ")->result_array();
      $this->data["donoridlist"] = $donoridlist;
      $this->load->view("donor_allocation",$this->data);
}

public function mapDonorSchool()
{
    $donorId=$this->input->post('donorId');
    $fund=$this->input->post('fund');
    $anchal=$this->input->post('anchal');
    $region=$this->input->post('region');
    $getDonor=$this->db->query("SELECT * FROM mst_donor where md_code='{$donorId}'")->result_array();
    $getSchoolDetails=$this->getSchoolByAnchalCodeORDonor($anchal,$fund);
    $this->data['getDonor']=$getDonor;
    $this->data['schoolDetails']=$getSchoolDetails;
   $this->load->view("mapDonorSchool",$this->data);
}
}
?>