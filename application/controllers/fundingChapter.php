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

    public function mapFundingSchool($fundingchapter='', $anchal='', $region='')
    {
    	$fundingchapter=$this->input->post('fundingchapter');
    	$anchal=$this->input->post('anchal');
      $region=$this->input->post('region');



    	$getFundingChapter=$this->db->query("SELECT * FROM mst_funding_chapter where mfc_id='{$fundingchapter}'")->result_array();
    	
    	$getSchoolDetails=$this->getSchoolByAnchalCodeWithNoFundingChapter($anchal);
    	// print_r($getSchoolDetails);
    	// die;
    	$this->data['fundingchapter']=$getFundingChapter;
    	$this->data['schoolDetails']=$getSchoolDetails;
      $this->data['anchal']=$anchal;
      $this->data['region']=$region;


    $this->load->view("mapFundingSchool",$this->data);
    }

    function uploadFundingChapter(){
          $schoolData=array();
          $fundingChapter=$this->input->post('fundingchapter');
          $schoolData=json_decode($this->input->post('schoolData'));

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
          	print_r($_POST);
          	die;
          }

          // public function updatesSchoolFundings(){
          //   $schoolData=$this->input->post('schoolData');
          //   $fundingChapter=$this->input->post('fundingchapter');
          //     foreach ($schoolData as $school) {
         
          //       $this->db->trans_start();
          //       $this->db->query("UPDATE mst_sif_details SET msd_mfc_id ='$fundingChapter' WHERE msd_school_code LIKE '$school' ");
          //       if ($this->db->trans_status() === FALSE) {
                
          //       $this->db->trans_rollback();
          //       } 
          //       else {
          //           $this->db->trans_commit();
          //         }

          //   }
          // }
}
?>
