<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Drm extends Admin_Controller {

  private $perPage = 100;

    public function __construct() {
      parent::__construct();
      $this->load->helper('download');
      $this->load->model('donors');
      $this->load->model('donorschools');
      $this->load->model('schoolpdf');
      $this->load->model('donorboard');
    }

    public function index() {
      if(!$this->isAdmin){
        redirect("drm/listSchools");
      }
      $this->dpsdashboard();
      $this->rmsdashboard();
      // print_r($this->session);
      // die;
      $this->load->view('dashboard', $this->data);
      // $this->template->userTemplate($this->data);
    }

    private function dpsdashboard(){
      $bDonors = $this->db->query("SELECT `md_id`, md_period, COUNT(mds_school_code) schoolCount FROM `mst_donors`,`mst_donor_schools` WHERE `md_id` = `mds_md_id` AND md_mdb_id = '{$this->userID}' AND `md_type` = 'DPS' GROUP BY `md_id` HAVING schoolCount >= 20")->result_array();
      $sDonors = $this->db->query("SELECT `md_id`, COUNT(mds_school_code) schoolCount FROM `mst_donors`,`mst_donor_schools` WHERE `md_id` = `mds_md_id` AND md_mdb_id = '{$this->userID}' AND `md_type` = 'DPS' GROUP BY `md_id` HAVING schoolCount < 20")->result_array();
      $this->data["totalDonorsDPSBig"] = count($bDonors);
      $this->data["totalDonorsDPS"] = count($sDonors);
      $this->data["sessionDPS"] = $bDonors[0]["md_period"];
      $this->data["totalSchoolsDPS"] = count($this->donorschools->fetch("mds_mdb_id = '{$this->userID}' AND mds_donorType = 'DPS'"));
      
      $sql="SELECT COUNT(*) mst_total_email FROM `email_log_donors` WHERE `tel_userID` = '".$this->userID."' AND md_type = 'DPS'";
      // print_r($sql);
      // die;
      $this->data["stat"] = $this->db->query("SELECT COUNT(*) mst_total_email FROM `email_log_donors` WHERE `tel_userID` = '".$this->userID."' AND md_type = 'DPS'")->row_array();

      $this->data["notif"] = $this->db->query("SELECT COUNT(*) countNotif
      FROM `trn_connectapp_notification`
      JOIN mst_donor_schools ON `tcn_schoolCode` = mds_school_code
      JOIN mst_donors ON mds_md_id = md_id
      WHERE mds_mdb_id = {$this->userID} AND `tcn_status` = 0 AND md_type = 'DPS'")->row_array();

    }

    private function rmsdashboard(){
      $resDPSBig = $this->db->query("SELECT `md_id`, md_period, COUNT(mds_school_code) schoolCount FROM `mst_donors`,`mst_donor_schools` WHERE `md_id` = `mds_md_id` AND md_mdb_id = '{$this->userID}' AND `md_type` = 'RMS' GROUP BY `md_id` HAVING schoolCount >= 20");
      $resDPSSmall = $this->db->query("SELECT `md_id`, COUNT(mds_school_code) schoolCount FROM `mst_donors`,`mst_donor_schools` WHERE `md_id` = `mds_md_id` AND md_mdb_id = '{$this->userID}' AND `md_type` = 'RMS' GROUP BY `md_id` HAVING schoolCount < 20");
      $bDonors = $resDPSBig->result_array();
      $sDonors = $resDPSSmall->result_array();
      $resDPSBig->free_result();
      $resDPSSmall->free_result();
      $this->data["totalDonorsRMSBig"] = count($bDonors);
      $this->data["totalDonorsRMS"] = count($sDonors);
      $this->data["sessionRMS"] = $bDonors[0]["md_period"];
      $this->data["totalSchoolsRMS"] = count($this->donorschools->fetch("mds_mdb_id = '{$this->userID}' AND mds_donorType = 'RMS'"));
      $this->data["statRMS"] = $this->db->query("SELECT COUNT(*) mst_total_email FROM `email_log_donors` WHERE `tel_userID` = '".$this->userID."' AND md_type = 'RMS'")->row_array();
      $this->data["notifRMS"] = $this->db->query("SELECT COUNT(*) countNotif
      FROM `trn_connectapp_notification`
      JOIN mst_donor_schools ON `tcn_schoolCode` = mds_school_code
      JOIN mst_donors ON mds_md_id = md_id
      WHERE mds_mdb_id = {$this->userID} AND `tcn_status` = 0 AND md_type = 'RMS'")->row_array();
      // $this->data["schoolInfo"] = $this->getSchoolInfo();
    }

    public function listSchools($userID = null, $fromState = null){
      if($this->input->post()){
        // p(1);
        $report = $this->input->post("DATA");
        $donorCode = $this->input->post("donorID");
        $noData = false;
        if($this->input->post("noData")){
          $noData = true;
          $filename = $donorCode."-No-Data-Available.pdf";
        } else {
          $filename = $donorCode.".pdf";
        }
        $this->data["noData"] = $noData;
        $this->data["donor"] = $this->input->post("donor");
        // $donorCode = time();
        $this->data["rptData"] = $report;
        $html = $this->load->view('report-pdf-list',$this->data, true);
        // $this->load->view('report-pdf-list',$this->data);
        // t($report,1);

        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($filename, "I");
      }
      if(!$userID){
        $userID = $this->userID;
        $segment = $this->uri->segment(3);
        $url = base_url() . "drm/listSchools";
      } else {
        $this->data["fromState"] = $fromState;
        $segment = $this->uri->segment(5);
        $url = base_url() . "drm/listSchools/".$userID."/".$fromState;
      }
      // $url = base_url() . "drm/listSchools";
      $total = $this->db->query("SELECT COUNT(*) AS `numrows` FROM `mst_donor_schools` WHERE mds_md_id = '{$userID}'")->row_array();
      $totalCount = $total["numrows"];
      $offset= ($segment)?$segment:0;
      $associatedSchools = $this->donorschools->get("mds_md_id = '{$userID}'","*",$this->perPage,$offset);
      // echo $this->db->last_query();
      // t($associatedSchools,1);
      $this->initializePagination($totalCount, $this->perPage, $url);
      $donor = $this->donors->fetch("md_id = '{$userID}'");
      $this->data["donor"] = $donor["md_fname"]." ".$donor["md_lname"];
      $this->data["donorID"] = $donor["md_user_name"];
      $this->data["donorType"] = $donor["md_type"];
      $this->data['associatedSchools'] = $associatedSchools;
      $this->load->view('listschools', $this->data);
    }

    public function showPeriods($schoolCode){
      $url = PERIOD_CODES_URL;
      $data = "schoolcode=".$schoolCode;
      $res = $this->curlRequest($url, $data, 0);
      $result = json_decode($res,TRUE);
      $this->data["res"] = ($result["code"] == "200")?$result["data"]:array();
      $this->load->view("periods_modal",$this->data);
    }

    private function getSchoolInfo(){
      $data = "";
      $res = $this->curlRequest(SCHOOL_DASHBOARD_URL, $data, 0);
      return json_decode($res,true);
    }

    public function changePassword(){
      $this->load->library('user_agent');
      if($this->input->post()){
        $password = $this->input->post("pwd");
        $arr = array(
          "mbd_pwd" => md5($password)
        );
        $bool = $this->donorboard->edit($arr, $this->userID);
        redirect("drm");
      }
      $this->load->view("changePwd_modal", $this->data);
    }

    # Functions for Ajax calls
    public function retriveConsolidatedGKV(){

      $schoolCode = $this->input->post("schoolcode");
      # START -- Ajax call from Ekal MIS server (Temporarily Muted)
      // $url = SCHOOL_DETAILS_URL; //Function -- getSchoolDetails()
      // $data = "schoolcode=".$schoolCode;
      // $resp = $this->curlRequest($url, $data, 0);
      # END -- Ajax call from Ekal MIS server (Temporarily Muted)

      # START -- Ajax call from local database for temporary solution
      $sql = "SELECT `rsd_id`, `rsd_state`, `rsd_school_code`, `rsd_District`, `rsd_Village`, `rsd_Teacher`
      FROM drmtempmis.`rpt_sif_details` WHERE rsd_school_code = '".$schoolCode."'";
      $r= $this->db->query($sql);
      $res = $r->row_array();
      $r->free_result();
      $this->db->close();
      $arr = array();
      if(count($res) > 0) {
        $arr["status"] = 1;
        $arr["details"] = $res;
      } else {
        $arr["status"] = 0;
      }
      $resp = json_encode($arr, TRUE);
      # END -- Ajax call from local database for temporary solution

      echo $resp;
    }

    public function retriveGKVbySchool(){
      $schoolCode = $this->input->post("schoolcode");
      $periodCode = $this->input->post("periodcode");
      $data = "schoolcode=".$schoolCode."&periodcode=".$periodCode;
      $res = $this->curlRequest(GKV_BY_SCHOOL_URL, $data, 0);
      echo $res;
    }

    public function showSchool($schoolCode){
      $this->data["schoolInfo"] = $this->fetchSchoolImages($schoolCode);
      $this->load->view("showschoolsimg",$this->data);
    }

    public function countSchoolData(){
      $schoolCode = trim($this->input->post("schoolcode"));
      $res = $this->fetchSchoolImages($schoolCode);
      $resp["imgs"] = $res["total"];

      $r = $this->schoolpdf->fetch("msp_school_code LIKE '{$schoolCode}'",'*',1);
      $resp["pdf"] = (count($r))?base_url()."uploads/".$r["msp_file"]:0;
      // $resp["pdf"] = $this->db->last_query();

      echo json_encode($resp);
    }

    public function downloadPdf($schoolCode){
      $schoolCode = trim($schoolCode);
      $r = $this->schoolpdf->fetch("msp_school_code LIKE '{$schoolCode}'",'*',1);
      $path = base_url()."uploads/".$r["msp_file"];
      $data = file_get_contents($path);
      force_download($r["msp_file"], $data);
    }

    private function fetchSchoolImages($schoolCode){
      $data = "schoolcode=".$schoolCode;
      $res = $this->curlRequest(SCHOOL_IMAGES_URL, $data, 0);
      $result = json_decode($res,TRUE);
      return $result;
    }

    public function emailLogs($clearLog = 0, $type = 'DPS'){
      if($clearLog){
        $this->db->query("DELETE FROM `temp_email_log` WHERE `tel_userID` = '{$this->userID}'");
      }
      $r = $this->db->query("SELECT tel_userID, md_user_name, donorname, tel_email, tel_timestamp, tel_mailType
        FROM `email_log_donors`
        WHERE `tel_userID` = '{$this->userID}' AND md_type='{$type}' ORDER BY tel_timestamp DESC");
        // echo $this->db->last_query();exit;
      $this->data["logs"] = $r->result_array();
      $r->free_result();
      $this->data["mailType"] = array("School Attendance Report","Ekal School Pictures","Donor Boards","Bulk Email","Individual Email");
      $this->data["type"] = $type;
      // t($this->data["logs"],1);
      $this->load->view("emaillogs", $this->data);
    }

    public function exportLog($type='DPS'){
      $this->load->library('excel');
      $query = "SELECT md_user_name, donorname, tel_email, tel_mailType, tel_timestamp FROM `email_log_donors` WHERE `tel_userID` = '{$this->userID}' AND md_type = '{$type}' ORDER BY tel_timestamp DESC";
      $res = $this->db->query($query)->result_array();
      $data['record']= $res;

      $objphpexcel = new PHPExcel();
      $objphpexcel->getProperties()->setCreator("");
      $objphpexcel->getProperties()->setLastModifiedBy("");
      $objphpexcel->getProperties()->setTitle("Email Logs");
      $objphpexcel->getProperties()->setSubject("");
      $objphpexcel->getProperties()->setDescription("");
      $objphpexcel->setActiveSheetIndex(0);
      $objphpexcel->getActiveSheet()->setCellValue('A1','Donor ID');
      $objphpexcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
      $objphpexcel->getActiveSheet()->setCellValue('B1','Donor Name');
      $objphpexcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
      $objphpexcel->getActiveSheet()->setCellValue('C1','Email ID');
      $objphpexcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
      $objphpexcel->getActiveSheet()->setCellValue('D1','Mail Type');
      $objphpexcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
      $objphpexcel->getActiveSheet()->setCellValue('E1','Sent Date');
      $objphpexcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
      $objphpexcel->getActiveSheet()->setCellValue('F1','Sent Time');
      $objphpexcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
      $objphpexcel->getActiveSheet()->getStyle("A1:F1")->getFont()->setBold(true);

      $row = 2;
      $mailType = array("School Attendance Report","Ekal School Pictures","Donor Boards","Bulk Email","Individual Email");
      foreach ($data['record'] as $key => $value) {
        $objphpexcel->getActiveSheet()->setCellValue('A'.$row,$value['md_user_name']);
        $objphpexcel->getActiveSheet()->setCellValue('B'.$row,$value['donorname']);
        $objphpexcel->getActiveSheet()->setCellValue('C'.$row,$value['tel_email']);
        $objphpexcel->getActiveSheet()->setCellValue('D'.$row,$mailType[$value['tel_mailType']]);
        $objphpexcel->getActiveSheet()->setCellValue('E'.$row,date("F d, Y", strtotime($value['tel_timestamp'])));
        $objphpexcel->getActiveSheet()->setCellValue('F'.$row,date("h:i A", strtotime($value['tel_timestamp'])));
        $row++;
      }
      $filename = "emailLog-".date("d-m-Y").".xlsx";
      $objphpexcel->getActiveSheet()->setTitle("Email Logs");
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$filename.'"');
      header('Cache-Control: max-age=0');
      $Writer = PHPExcel_IOFactory::createWriter($objphpexcel,'Excel2007');
      $Writer->save('php://output');
      exit;
    }

    public function mailsubject($id){
      if ($this->input->post()) {
        $sub = $this->input->post('subject');
        $arr = array(
          "mes_sub" => $sub
        );
        $this->db->set($arr, false);
        $this->db->insert("mst_email_subjects");
        $id = $this->db->insert_id();
        if($id) {
          $this->session->set_flashdata("success","Subject has been created successfully");
        } else {
          $this->session->set_flashdata("error","Sorry there is an error. Please try again.");
        }
        redirect("drm/mailsubject");
      }
      if($id) {
        $res = $this->db->delete("mst_email_subjects", "mes_id = '{$id}'");
        if($res) {
          $this->session->set_flashdata("success","Subject has been deleted successfully");
        } else {
          $this->session->set_flashdata("error","Sorry there is an error. Please try again.");
        }
        redirect("drm/mailsubject");
      }
      $q = $this->db->query("SELECT `mes_id`, `mes_sub` FROM `mst_email_subjects`");
      $this->data["subjects"] = $q->result_array();
      $q->free_result();
      $this->load->view('mailsubject', $this->data);
    }
}
