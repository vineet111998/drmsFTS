<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class fundingChapter extends Admin_Controller {

public function mapFunding(){
      $fundlist = $this->db->query("SELECT * FROM mst_funding_chapter WHERE mfc_status = 0 GROUP BY mfc_desc")->result_array();
      $this->data["fundlist"] = $fundlist;

      $regionlist = $this->db->query("SELECT * FROM mst_sif_details GROUP BY msd_region_name")->result_array();
      $this->data["regionlist"] = $regionlist;

      $this->load->view("map_funding",$this->data);
    }

    public function mapFundingSchool()
    {
    	$fundingchapter=$this->input->post('fundingchapter');
    	$anchal=$this->input->post('anchal');

    	$getFundingChapter=$this->db->query("SELECT * FROM mst_funding_chapter where mfc_id='{$fundingchapter}'")->result_array();
    	
    	$getSchoolDetails=$this->getSchoolByAnchalCodeORFundingChapter($anchal);
    	// print_r($getSchoolDetails);
    	// die;
    	$this->data['fundingchapter']=$getFundingChapter;
    	$this->data['schoolDetails']=$getSchoolDetails;

    $this->load->view("mapFundingSchool",$this->data);
    }

    function uploadFundingChapter(){
          $schoolData=array();
          $fundingChapter=$this->input->post('fundingchapter');
          $schoolData=json_decode($this->input->post('schoolData'));
// print_r($_POST);
//     	die;
          foreach ($schoolData as $school) {
         
                $this->db->trans_start();
                $this->db->query("UPDATE mst_sif_details SET msd_mfc_id ='$fundingChapter' WHERE msd_school_code LIKE '$school' ");
                if ($this->db->trans_status() === FALSE) {
                
                $this->db->trans_rollback();
                } 
                else {
                    $this->db->trans_commit();
                  }

            }
          }

          function confirmFundingChapterMapping(){
          	print_r(base64_decode(urldecode($_GET['sc'])));
          	die;
          }
}
?>