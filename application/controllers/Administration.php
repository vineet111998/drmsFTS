<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Administration extends Admin_Controller {

  public $columnCount = 21;
  

    public function __construct() {
      parent::__construct();
      $this->checkAdminAccess();
      $this->load->model('donors');
      $this->load->model('donorschools');
      $this->load->model('donorboard');
      $this->load->model('schoolpdf');
      $this->load->model("tempdonors");
      //$this->userID = $this->session->userdata('userID');
    }

    public function donors($param = 'DPS-B') {
      $perPage = 50;
      $paginationOffset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      $arr = explode("-",$param);
      $type = $arr[0];
      $bigSmallCount = ($arr[1] == "B")?">=20":"<20";
      $cond = "SELECT `md_id`, `md_user_name`, `md_fname`, `md_lname`, `md_home_phone`, `md_office_phone`, `md_mobile`, `md_email`, COUNT(mds_school_code) schoolCount FROM `mst_donors`,`mst_donor_schools`
      WHERE `md_id` = `mds_md_id` AND md_mdb_id = '{$this->userID}'
      AND `md_type` = '{$type}'";
      // $query = "md_status = 1 AND md_mdb_id = '{$this->userID}' AND md_type = '{$type}'";
      if($this->input->post('search')){
        $searchQuery = $this->input->post('search');
        // $query = "md_status = 1 AND md_mdb_id = '{$this->userID}' AND md_type = '{$type}' AND (CONCAT(md_fname,' ',md_lname) LIKE '%".strtolower($searchQuery)."%' OR md_email LIKE '%".strtolower($searchQuery)."%' OR md_user_name LIKE '%".strtolower($searchQuery)."%')";
        $cond .= " AND (CONCAT(md_fname,' ',md_lname) LIKE '%".strtolower($searchQuery)."%' OR md_email LIKE '%".strtolower($searchQuery)."%' OR md_user_name LIKE '%".strtolower($searchQuery)."%')";
      }
      $cond .= " GROUP BY `md_id` HAVING schoolCount ".$bigSmallCount;
      $totalCount = count($this->db->query($cond)->result_array());
      // echo $this->db->last_query($cond);exit;
      $cond .= " LIMIT {$paginationOffset}, {$perPage}";
      $donors = $this->db->query($cond)->result_array();
      // echo $this->db->last_query();exit;
      $url = base_url() . "administration/donors/".$param;
      $this->initializePagination($totalCount, $perPage, $url);
      // t($donors,1);
      $this->data['donors'] = $donors;
      $this->data['totalCount'] = $totalCount;
      // $this->data['donors'] = $this->donors->get("md_status = 1 AND md_mdb_id = '{$this->userID}'");
      $this->load->view('donorslist2', $this->data);
    }

    public function editDonor($donorID){
      if($this->input->post()){
        $donor = $this->input->post('DONOR');
        if(empty($donor['md_password'])){
          unset($donor['md_password']);
        }
        $bool = $this->donors->edit($donor,$donorID);
        if($bool){
          $this->session->set_flashdata("success", "Donors has been updated successfully.");
        } else {
          $this->session->set_flashdata("error", "Data kept intact. Please check whether you modified any data or not.");
        }
        redirect('administration/donors');
      }
      $this->data['donor'] = $this->donors->fetch("md_id = '{$donorID}'");
      $this->load->view('editDonor', $this->data);
    }

    public function delDonor($donorID){
      $this->db->trans_start(FALSE);
      $this->donors->delete("md_id = '{$donorID}'");
      $this->donorschools->delete("mds_md_id = '{$donorID}'");
      $this->db->trans_complete();
      if($this->db->trans_status()){
        $this->session->set_flashdata("success", "Donor has been deleted successfully.");
      } else {
        $this->session->set_flashdata("error", "Sorry there was an error. Please try again.");
      }
      redirect('administration/donors');
    }

    public function uploadDonors() {
      if($this->input->post()){
        $donorType = $this->input->post("donorType");
        // $actionType = $this->input->post("actionType");
        $data = $this->uploadExcelFile('userfile');
        // t($data,1);
        if($data["status"]){
          // t($data,1);
          // Upload in temp_upload table
          $arr = array(
            "tu_donorType" => $donorType,
            // "tu_actionType" => $actionType,
            "tu_file" => $data["data"]["file_name"],
            "tu_fullpath" => $data["data"]["full_path"],
            "tu_datetime" => date("Y-m-d H:i:s")
          );
          $this->db->insert("temp_uploads", $arr);
          $insertID = $this->db->insert_id();
          redirect("administration/processExcel/".$insertID."/".$donorType);

        } else {
          $this->session->set_flashdata("error", "Error uploading excel. Please try again.".$data["msg"]);
        }
        redirect("administration/uploadDonors");
      }
      $this->load->view('uploadDonors', $this->data);
    }

    public function processExcel($uploadID, $donorType){
      $this->data["uploadID"] = $uploadID;
      $this->data["donorType"] = $donorType;
      $this->load->view("processLoader",$this->data);
    }

    public function ajaxProcessExcel(){
      $uploadID = $this->input->post("uploadID");
      $donorType = $this->input->post("donorType");
      // $uploadID = 14;
      $res = $this->db->query("SELECT * FROM `temp_uploads` WHERE `tu_id` = '{$uploadID}'")->row_array();
      // if($res["tu_actionType"] == "D"){
      //   $this->db->query("DELETE FROM `mst_donors` WHERE `md_mdb_id` = '{$this->userID}' AND md_type = '{$res["tu_donorType"]}'");
      //   $this->db->query("DELETE FROM `mst_donor_schools` WHERE `mds_mdb_id` = '{$this->userID}' AND mds_donorType = '{$res["tu_donorType"]}'");
      // }
      $excelPath = $res["tu_fullpath"];
      $donorType = $res["tu_donorType"];
      $excelData = $this->readExcelFile($excelPath);
      // t($excelData,1);
      $res = $this->writeExcelDataToDatabase($excelData, $donorType);
      if(!empty($res)){
        $msg = 0;
        $this->session->set_flashdata("error", $msg);
      } else {
        $msg = "Donors have been extracted from excel for preview";
        $this->session->set_flashdata("success", $msg);
      }
      echo $msg;
    }

    private function writeExcelDataToDatabase($data, $donorType) {
      // t($data,1);
      $this->db->query("DELETE FROM temp_excel_donors WHERE md_mdb_id = {$this->userID}");
      $i = 0;
      $donorIDs = array();
      foreach ($data as $value) {
        if($i){
          // Check the total excel column count. Insert only the total data matched with column count.
          if(count($value) == $this->columnCount){
              $this->db->trans_start(FALSE);
              // t($value,1);
                //Insert Donor Data
              $insertArr = array(
                "md_user_name" => (strtoupper($value["A"])=="NA")?"":trim($value["A"]),
                "md_password" => "NA",
                "md_period" => (strtoupper($value["B"])=="NA")?"":trim($value["B"]),
                "md_title" => (strtoupper($value["C"])=="NA")?"":trim($value["C"]),
                "md_fname" => (strtoupper($value["D"])=="NA")?"":trim($value["D"]),
                "md_lname" => (strtoupper($value["E"])=="NA")?"":trim($value["E"]),
                "md_spouse" => (strtoupper($value["F"])=="NA")?"":trim($value["F"]),
                "md_region" => (strtoupper($value["G"])=="NA")?"":trim($value["G"]),
                "md_address" => (strtoupper($value["H"])=="NA")?"":trim($value["H"]),
                "md_city" => (strtoupper($value["I"])=="NA")?"":trim($value["I"]),
                "md_state" => (strtoupper($value["J"])=="NA")?"":trim($value["J"]),
                "md_stateid" => (strtoupper($value["K"])=="NA")?"":trim($value["K"]),
                "md_pin" => (strtoupper($value["L"])=="NA")?"":trim($value["L"]),
                "md_country" => (strtoupper($value["M"])=="NA")?"":trim($value["M"]),
                "md_home_phone" => (strtoupper($value["N"])=="NA")?"":trim($value["N"]),
                "md_office_phone" => (strtoupper($value["O"])=="NA")?"":trim($value["O"]),
                "md_mobile" => (strtoupper($value["P"])=="NA")?"":trim($value["P"]),
                "md_email" => (strtoupper($value["Q"])=="NA")?"":trim($value["Q"]),
                "md_honour" => (strtoupper($value["R"])=="NA")?"":trim($value["R"]),
                "md_memory" => (strtoupper($value["S"])=="NA")?"":trim($value["S"]),
                "md_occation" => (strtoupper($value["T"])=="NA")?"":trim($value["T"]),
                "md_associated_schools" => (strtoupper($value["U"])=="NA")?"":trim($value["U"]),
                "md_mdb_id" => $this->userID,
                "md_type" => $donorType,
                "md_datetime" => date("Y-m-d H:i:s")
              );
              // t($insertArr,1);
              $donorData = $this->tempdonors->add($insertArr);
              // t($donorData,1);
              // echo $this->db->last_query();exit;
              if(empty($donorData)){
                $donorIDs[] = $value["A"];
              }
              $this->db->trans_complete();
              $this->db->trans_status();
          } else {
            // Return Donor IDs if a donor not uploaded through excel
            $donorIDs[] = $value["A"];
          }
        }
        $i++;
      }
      return $donorIDs;
    }

    public function excelData($donorType){
      if($this->input->post()){
        $purge = $this->input->post("purge");
        $append = $this->input->post("append");
        $cancel = $this->input->post("afresh");
        if($purge){
          // Deleting existing donors and associated schools
          $this->delExistingDonor($donorType);
          // Copy from temp table and insert into master table
          $bool = $this->insertDonorsMaster();
        } else if ($append) {
          // Copy from temp table and insert into master table
          $bool = $this->insertDonorsMaster();
        } else {
          $this->db->query("DELETE FROM temp_excel_donors WHERE md_mdb_id = {$this->userID}");
          $this->session->set_flashdata("error","You have cancelled this operation.");
          redirect("administration/uploadDonors");
        }
        $this->db->query("DELETE FROM temp_excel_donors WHERE md_mdb_id = {$this->userID}");
        if($bool){
          $this->session->set_flashdata("success","Donors have been uploaded successfully. Do not forget to clear the email and other logs before you proceed to the any step");
          $page = "administration/uploadDonors";
        } else {
          $this->session->set_flashdata("error","Sorry there was an error. Please try again.");
          $page = "administration/excelData/".$donorType;
        }
        redirect($page);
      }
      $this->data["donors"] = $this->tempdonors->fetch();
      $this->data["donorType"] = $donorType;
      $this->load->view("excelData",$this->data);
    }

    private function insertDonorsMaster(){
      $this->db->trans_start(FALSE);
      $donors = $this->tempdonors->fetch("md_mdb_id = '{$this->userID}'");
      // t($donors,1);
      foreach($donors as $val) {
        unset($val["temp_md_id"]);
        $associatedSchools = $val["md_associated_schools"];
        unset($val["md_associated_schools"]);
        $donor = $this->donors->add($val);
        $this->insertDonorSchools($associatedSchools, $donor, $donor["md_type"]);
      }
      $this->db->trans_complete();
      $bool = $this->db->trans_status();
      // t($schoolsID,1);
      return $bool;
    }

    private function insertDonorSchools($schools, $donorData, $donorType){
      $suppportedSchools = explode(",", $schools);
      for($i=0;$i<count($suppportedSchools);$i++){
        $suppportedSchoolsArr = array(
          "mds_md_id" => $donorData["md_id"],
          "mds_school_code" => $suppportedSchools[$i],
          "mds_donorType" => $donorType,
          "mds_mdb_id" => $this->userID
        );
        $this->donorschools->add($suppportedSchoolsArr);
      }
    }

    private function delExistingDonor($donorType){
      $this->db->query("DELETE FROM `mst_donors` WHERE `md_mdb_id` = '{$this->userID}' AND md_type = '{$donorType}'");
      $this->db->query("DELETE FROM `mst_donor_schools` WHERE `mds_mdb_id` = '{$this->userID}' AND mds_donorType = '{$donorType}'");
    }

    public function fetchSchools($donorID, $donorName) {
      $this->data["res"] = $this->donorschools->get("mds_md_id = '{$donorID}'");
      $this->data["donorName"] = $donorName;
      $this->load->view('schools_modal',$this->data);
    }

    public function states(){
      $sql = "SELECT ess_name, SUBSTR(TRIM(mds_school_code),1,4) AS schoolCode FROM `mst_donor_schools` LEFT JOIN env_school_states ON ess_code = SUBSTR(TRIM(mds_school_code),1,4) GROUP BY schoolCode";
      $this->data["states"] = $this->db->query($sql)->result_array();
      $this->load->view("listStates", $this->data);
    }

    public function donorsState($schoolCode){
      $sql = "SELECT mst_donors.*
      FROM `mst_donor_schools`
      LEFT JOIN mst_donors ON md_id = mds_md_id
      WHERE `mds_school_code` LIKE '".$schoolCode."%'
      AND md_mdb_id = '".$this->userID."' GROUP BY `mds_md_id`";
      $this->data["donors"] = $this->db->query($sql)->result_array();
      $this->data["fromState"] = $schoolCode;
      $this->load->view("donorslist", $this->data);
    }

    private function uploadExcelFile($fileFieldName) {

        $config = array(
          'upload_path' => 'uploads',
          'allowed_types' => 'xlsx|xls|csv'
        );

        $this->load->library('upload', $config);

        $arr = array();

        $_FILES['userfile']['name'] = $_FILES[$fileFieldName]['name'];
        $_FILES['userfile']['type'] = $_FILES[$fileFieldName]['type'];
        $_FILES['userfile']['tmp_name'] = $_FILES[$fileFieldName]['tmp_name'];
        $_FILES['userfile']['error'] = $_FILES[$fileFieldName]['error'];
        $_FILES['userfile']['size'] = $_FILES[$fileFieldName]['size'];

        $this->upload->initialize($config);

        if ($this->upload->do_upload('userfile')) {
            $arr["status"] = 1;
            $arr["data"] = $this->upload->data();;
        } else {
            $arr["status"] = 0;
            $arr["msg"] = $this->upload->display_errors();
            $arr["data"] = array();
        }

        return $arr;
    }

    private function uploadPDFFile($fileName, $path) {
        $config = array(
          'upload_path' => $path,
          'allowed_types' => 'pdf',
          'overwrite' => TRUE,
          'file_name' => $fileName
        );
        $this->load->library('upload', $config);
        $arr = array();
        $this->upload->initialize($config);
        if ($this->upload->do_upload('userfile')) {
            $arr["status"] = 1;
            $arr["data"] = $this->upload->data();
        } else {
            $arr["status"] = 0;
            $arr["msg"] = $this->upload->display_errors();
            $arr["data"] = array();
        }

        return $arr;
    }

    private function uploadFile() {
        $config = array(
          'upload_path' => 'uploads',
          'allowed_types' => '*',
          'max_size' => 10240
        );
        $this->load->library('upload', $config);
        $arr = array();
        $this->upload->initialize($config);
        if ($this->upload->do_upload('userfile')) {
            $arr["status"] = 1;
            $arr["data"] = $this->upload->data();
        } else {
            $arr["status"] = 0;
            $arr["msg"] = $this->upload->display_errors();
            $arr["data"] = array();
        }

        return $arr;
    }

    private function checkAdminAccess(){
      if($this->session->userdata('userType') == 1){
        show_404();
      }
    }

    public function uploadPDF(){
      if($this->input->post()){
        // t($_FILES);
        // p(1);
        $donorID = $this->input->post("donorID");
        $year = $this->input->post("year");
        $donor =  $this->donors->fetch("md_user_name LIKE '{$donorID}'");
        $fileName = "DonorBoard_".$donor["md_type"]."_".$year."_".$donor["md_user_name"].".pdf";
        // $fileName = "001.pdf";
        $path = "uploads/donorboards/".$donor["md_type"];
        $data = $this->uploadPDFFile($fileName,$path);
        if($data["status"]){
          $pdfFileName = $data["data"]["file_name"];
          $schoolPdfArr = array(
            "msp_school_code" => trim($schoolCode),
            "msp_file" => $pdfFileName
          );
          $res = $this->schoolpdf->add($schoolPdfArr);
          if(empty($res)){
            $msg = "Sorry there was an error please try again. ".$data["msg"];
            $this->session->set_flashdata("error", $msg);
          } else {
            $this->session->set_flashdata("success", "PDF has been uploaded.");
          }
        }
        redirect("drm");
      }
      $this->data["donors"] = $this->donors->get("md_mdb_id = '{$this->userID}' AND md_status = 1", "md_id, md_user_name, md_email, CONCAT(md_fname,' ',md_lname) AS name, md_email emailID");
      $this->load->view("uploadPDF",$this->data);
    }

    //========================================================================

    public function map_funding(){
      $fundlist = $this->db->query("SELECT * FROM mst_funding_chapter WHERE mfc_status = 0 GROUP BY mfc_desc")->result_array();
    //   // echo "$fundlist";
    //   // die;
      $this->data["fundlist"] = $fundlist;

      $regionlist = $this->db->query("SELECT * FROM mst_sif_details GROUP BY msd_region_name")->result_array();
      $this->data["regionlist"] = $regionlist;

      $this->load->view("map_funding",$this->data);
    }

    public function deallocate_fund(){
      $fundlist = $this->db->query("SELECT * FROM mst_funding_chapter WHERE mfc_status = 0 GROUP BY mfc_desc")->result_array();

      $this->data["fundlist"] = $fundlist;

      $regionlist = $this->db->query("SELECT * FROM mst_sif_details GROUP BY msd_region_name")->result_array();
      $this->data["regionlist"] = $regionlist;

      $this->load->view("deallocate_fund",$this->data);
    }

    public function donor_allocation(){
      $donoridlist = $this->db->query("SELECT * FROM mst_donor GROUP BY md_macd_id ")->result_array();
      $this->data["donoridlist"] = $donoridlist;

      $fundlist = $this->db->query("SELECT * FROM mst_funding_chapter GROUP BY mfc_desc")->result_array();
      $this->data["fundlist"] = $fundlist;
      $this->load->view("donor_allocation",$this->data);

    }

    public function sif_edit(){
      $regionlist = $this->db->query("SELECT * FROM mst_sif_details GROUP BY msd_region_name")->result_array();
      $this->data["regionlist"] = $regionlist;
      $this->load->view("sif_edit",$this->data);

    }
    public function user_create(){
      $this->load->view("user_create",$this->data);

    }
    public function School_chapter(){
      $fundlist = $this->db->query("SELECT * FROM mst_funding_chapter WHERE mfc_status = 0 GROUP BY mfc_desc")->result_array();
      $this->data["fundlist"] = $fundlist;
      $this->load->view("school_chapter",$this->data);
    }
    public function edit_page($sanchcode=""){
      $sql ="SELECT * FROM mst_sif_details LEFT JOIN mst_funding_chapter ON mfc_id=msd_mfc_id LEFT JOIN mst_donor ON mds_md_id=md_id WHERE msd_sanch_code LIKE '{$sanchcode}' GROUP BY msd_school_name";
      $schoolList=$this->db->query($sql)->result_array();
      $this->data['schoolList']=$schoolList;
      $this->load->view("edit_page",$this->data);
    }

    function edit_values($schoolcode=""){
        // echo $schoolcode;
        // die;
        $sql ="SELECT * FROM mst_sif_details WHERE msd_school_code LIKE '{$schoolcode}' GROUP BY msd_school_name";
        // echo "$sql";
        // die;
        $schoolList=$this->db->query($sql)->result_array();
        // t ($schoolList,1);
        // die;
        $this->data['schoolList']=$schoolList;
        $this->data['schoolcode']=$schoolcode;
        $this->load->view("edit_values",$this->data);
      }




//============================================================================================================================

        function getAnchalByRegionCode($regioncode="",$preparedrpdwn=0){
            $anchalList=array();
            $sql ="SELECT msd_anchal_name,msd_anchal_code FROM mst_sif_details WHERE msd_region_code LIKE '{$regioncode}' GROUP BY msd_anchal_name";
            
            $anchalList=$this->db->query($sql)->result_array();

                if($preparedrpdwn==0){
            }
            else{
              $genaratedDropDown=$this->dropdownAnchal($anchalList);
              echo $genaratedDropDown;
            }
          }

          function dropdownAnchal($anchalList=array()){
            $str="<option value=''>Please select anchal</option>";
            foreach ($anchalList as $anchal) {
              $str.="<option value='".$anchal['msd_anchal_code']."'>".$anchal['msd_anchal_name']."</option>";
            }
            return $str;
          }

          function getSchoolByAnchalCodeDonor($anchalcode="",$fundingchapter="",$preparedrpdwn=0){
          $schoollist=array();
          $sql ="SELECT * FROM mst_sif_details LEFT JOIN mst_funding_chapter ON mfc_id = msd_mfc_id WHERE msd_anchal_code LIKE '{$anchalcode}' AND msd_mfc_id ={$fundingchapter} GROUP BY msd_school_name";
          // echo($sql);
          // die;
          $schoollist=$this->db->query($sql)->result_array();

              if($preparedrpdwn==0){
          }
          else{
            $genaratedDropDown=$this->dropdownSchoolsbyAnchalDonor($schoollist);
            echo $genaratedDropDown;
          }
        }

        function dropdownSchoolsbyAnchalDonor($schoollist=array()){
          foreach ($schoollist as $school) {
            $str="<tr><td>{$school['msd_state']}</td><td>{$school['msd_region_name']}</td><td>{$school['msd_region_code']}</td><td>{$school['msd_anchal_name']}</td><td>{$school['msd_anchal_code']}</td><td>{$school['msd_school_name']}</td><td>{$school['msd_school_code']}</td><td>{$school['mfc_desc']}</td><td><input type='checkbox' class='checkbox' name='' value='{$school['msd_school_code']}'></td></tr>";
          }
          return $str;
        }

//=========================================================================================================

          function getSchoolByAnchalCode($anchalcode="",$preparedrpdwn=0){
          $schoollist=array();
          $sql ="SELECT * FROM mst_sif_details WHERE msd_anchal_code LIKE '{$anchalcode}' AND msd_mfc_id ='' GROUP BY msd_school_name";
          // echo($sql);
          // die;
          $schoollist=$this->db->query($sql)->result_array();

              if($preparedrpdwn==0){
          }
          else{
            $genaratedDropDown=$this->dropdownSchoolsbyAnchal($schoollist);
            echo $genaratedDropDown;
          }
        }

        function dropdownSchoolsbyAnchal($schoollist=array()){
          foreach ($schoollist as $school) {
            $str="<tr><td contenteditable='true'>{$school['msd_state']}</td><td>{$school['msd_region_name']}</td><td>{$school['msd_region_code']}</td><td>{$school['msd_anchal_name']}</td><td>{$school['msd_anchal_code']}</td><td>{$school['msd_school_name']}</td><td>{$school['msd_school_code']}</td><td><input type='checkbox' class='checkbox check' name='' value={$school['msd_school_code']}></td></tr>";
          }
          return $str;
        }

        function getSchoolByAnchalCodedeallocate($anchalcode="",$fundingchapter="",$preparedrpdwn=0){
         $schoollist=array();
          $sql ="SELECT * FROM mst_sif_details WHERE msd_anchal_code LIKE '{$anchalcode}' AND msd_mfc_id ={$fundingchapter} GROUP BY msd_school_name ";
          // echo($sql);
          // die;
          $schoollist=$this->db->query($sql)->result_array();

              if($preparedrpdwn==0){
          }
          else{
            $genaratedDropDown=$this->dropdownSchoolsbyAnchaldeallocate($schoollist);
            echo $genaratedDropDown;
          }
        }

        function dropdownSchoolsbyAnchaldeallocate($schoollist=array()){
          foreach ($schoollist as $school) {
            $str.="<tr><td contenteditable='true'>".$school['msd_state']."</td><td>".$school['msd_region_name']."</td><td>".$school['msd_region_code']."</td><td>".$school['msd_anchal_name']."</td><td>".$school['msd_anchal_code']."</td><td>".$school['msd_school_name']."</td><td>".$school['msd_school_code']."</td><td><input type='checkbox' class='checkbox check' name='' value='".$school['msd_school_code']."'></td></tr>";
          }
          return $str; 
        }

//===================================================================================

        function getAnchalByRegionCodesif($regioncode="",$preparedrpdwn=0){
            $anchalList=array();
            $sql ="SELECT * FROM mst_sif_details WHERE msd_region_code LIKE '{$regioncode}' GROUP BY msd_anchal_name";
            
            $anchalList=$this->db->query($sql)->result_array();

                if($preparedrpdwn==0){
            }
            else{
              $genaratedDropDown=$this->dropdownAnchalsif($anchalList);
              echo $genaratedDropDown;
            }
          }

          function dropdownAnchalsif($anchalList=array()){
            $str="<option value=''>Please select anchal</option>";
            foreach ($anchalList as $anchal) {
              $str.="<option value='".$anchal['msd_anchal_code']."'>".$anchal['msd_anchal_name']."</option>";
            }
            return $str;
          }

          function getSanchByAnchalCodesif($anchalcode="",$preparedrpdwn=0){
          $sanchList=array();
          $sql ="SELECT msd_sanch_name,msd_sanch_code FROM mst_sif_details WHERE msd_anchal_code LIKE '{$anchalcode}' GROUP BY msd_sanch_name";
          
          $sanchList=$this->db->query($sql)->result_array();

              if($preparedrpdwn==0){
          }
          else{
            $genaratedDropDown=$this->dropdownSanchsif($sanchList);
            echo $genaratedDropDown;
          }
        }

        function dropdownSanchsif($sanchList=array()){
          $str="<option value=''>Please select Sanch</option>";
          foreach ($sanchList as $sanch) {
            $str.="<option value='".$sanch['msd_sanch_code']."'>".$sanch['msd_sanch_name']."</option>";
          }
          return $str;
        }

        // function getSchoolBySanchCodesif($sanchcode="",$preparedrpdwn=0){
        //   $schoolList=array();
        //   $sql ="SELECT * FROM mst_sif_details WHERE msd_sanch_code LIKE '{$sanchcode}' GROUP BY msd_school_name";
          
        //   $schoolList=$this->db->query($sql)->result_array();
        //   // print_r($schoolList);
        //   // die;
        //       if($preparedrpdwn==0){
        //   }
        //   else{
        //     $genaratedDropDown=$this->dropdownSchoolsbySanchsif($schoolList);
        //     echo $genaratedDropDown;
        //   }
        // }

        // function dropdownSchoolsbySanchsif($schoolList=array()){
        //   foreach ($schoolList as $school) {
        //      $str.="<tr><td><a Class='test' href='/fts/administration/edit_page?school='".$school['mrsd_school_code']."'value='".$school['mrsd_school_code']."' style='padding:5px; border: 2px solid red; border-radius: 5px; font-size:20px;'><i class='icon-edit'></i></a></td><td>".$school['mrsd_fund']."</td><td>".$school['mrsd_csr']."</td><td>".$school['mrsd_state']."</td><td>".$school['mrsd_region_name']."</td><td>".$school['mrsd_region_code']."</td><td>".$school['mrsd_anchal_name']."</td><td>".$school['mrsd_anchal_code']."</td><td>".$school['mrsd_sankul_name']."</td><td>".$school['mrsd_sankul_code']."</td><td>".$school['mrsd_sanch_name']."</td><td>".$school['mrsd_sanch_code']."</td><td>".$school['mrsd_sanch_opening_date']."</td><td>".$school['mrsd_upsanch_name']."</td><td>".$school['mrsd_upsanch_code']."</td><td>".$school['mrsd_school_code']."</td><td></td><td>".$school['mrsd_donor_id']."</td><td>".$school['mrsd_school_name']."</td><td>".$school['mrsd_Teacher']."</td><td>".$school['mrsd_teacher_sex']."</td><td>".$school['mrsd_Boys']."</td><td>".$school['mrsd_Girls']."</td><td>".$school['mrsd_total']."</td><td>".$school['mrsd_date_of_opening']."</td><td>".$school['mrsd_population']."</td><td>".$school['mrsd_Literacy_Rate_Male']."</td><td>".$school['mrsd_Literacy_Rate_Female']."</td><td>".$school['mrsd_Vidyalaya_Samity_Pramukh']."</td><td>".$school['mrsd_Nearest_Railway_Station']."</td><td>".$school['mrsd_Distance_Of_Vidyalaya_From_Cluster']."</td><td>".$school['mrsd_Distance_Cluster_From_Rly_Station']."</td><td>".$school['mrsd_VCF_Name']."</td><td>".$school['mrsd_VCF_Phone']."</td><td>".$school['mrsd_SCF_Name']."</td><td>".$school['mrsd_SCF_Email']."</td><td>".$school['mrsd_SCF_Phone']."</td><td>".$school['mrsd_Date_Of_Updation']."</td><td>".$school['mrsd_sif_update']."</td></tr>";
        //     //$str.="<tr><td>".$school['mrsd_school_name']."</td><td><a Class='test' href='/fts/administration/edit_page'value='".$school['mrsd_school_code']."' style='padding:5px; border: 2px solid red; border-radius: 5px; font-size:20px;'>".$school['mrsd_school_code']."</a></td></tr>";
        //   }
        //   return $str;
        // }


//////////////////////////CHAMP API////////////////////////////////

        function getSchoolByDonorCodeFromchmp(){
          $donorID=$this->input->get("donorID");
          // echo $donorID; die();
          $schoolList=array();
          $sql ="SELECT * FROM mst_sif_details WHERE msd_donor_id LIKE '{$donorID}'";      
          $schoolList=$this->db->query($sql)->result_array();
          if(count($schoolList)==0){
            echo "No Data Found !";
          }else{
          echo json_encode($schoolList);
          }
          //     if($preparedrpdwn==0){
          // }
          // else{
          //   $genaratedDropDown=$this->dropdownSchoolsbySanchsif($schoolList);
          //   echo $genaratedDropDown;
          // }
        }

//===================================================================================
        function getFundingchapterByDonorID($donorID="",$preparedrpdwn=0){
          $regionList=array();
          $sql="SELECT `mfc_id`, `mfc_desc` FROM `mst_funding_chapter`, map_donor_funding_chapter,mst_donor WHERE md_code='$donorID' AND pdfc_md_id = md_id AND pdfc_mfc_id = `mfc_id` ";
          // $sql ="SELECT * FROM map_donor_funding_chapter WHERE msd_mfc_id ={$fundingchapter} GROUP BY msd_region_name";
          // echo($sql);
          // die;
          $fundList=$this->db->query($sql)->result_array();
          
              if($preparedrpdwn==0){
          }
          else{
            $genaratedDropDown=$this->dropdownfund($fundList);
            echo $genaratedDropDown;
          }
        }

         function dropdownfund($regionList=array()){
          $str="<option value=''>Please select Funding Chaper</option>";
          foreach ($regionList as $region) {
            $str.="<option value='".$region['mfc_id']."'>".$region['mfc_desc']."</option>";
          }
          return $str;
        }

        function getRegionByFundingchapter($fundingchapter="",$preparedrpdwn=0){
          $regionList=array();
          $sql ="SELECT msd_region_code,msd_region_name FROM mst_sif_details WHERE msd_mfc_id ={$fundingchapter} GROUP BY msd_region_name";
          // echo($sql);
          // die;
          $regionList=$this->db->query($sql)->result_array();
          
              if($preparedrpdwn==0){
          }
          else{
            $genaratedDropDown=$this->dropdownRegion($regionList);
            echo $genaratedDropDown;
          }
        }

        function dropdownRegion($regionList=array()){
          $str="<option value=''>Please select region</option>";
          foreach ($regionList as $region) {
            $str.="<option value='".$region['msd_region_code']."'>".$region['msd_region_name']."</option>";
          }
          return $str;
        }

        
        function getSchoolByFundingchapter($fundingchapter="",$preparedrpdwn=0){
          $schoollist=array();
          $sql ="SELECT * FROM mst_sif_details WHERE msd_fund LIKE '{$fundingchapter}' GROUP BY msd_school_name";
          // echo($sql);
          // die;
          $schoollist=$this->db->query($sql)->result_array();

              if($preparedrpdwn==0){
          }
          else{
            $genaratedDropDown=$this->dropdownSchoolsbyFunding($schoollist);
            echo $genaratedDropDown;
          }
        }

        function dropdownSchoolsbyFunding($schoollist=array()){
          foreach ($schoollist as $school) {
            $str.="<tr><td>".$school['msd_state']."</td><td>".$school['msd_region_name']."</td><td>".$school['msd_region_code']."</td><td>".$school['msd_anchal_name']."</td><td>".$school['msd_anchal_code']."</td><td>".$school['msd_school_name']."</td><td>".$school['msd_school_code']."</td><td>".$school['msd_fund']."</td></tr>";
          }
          return $str;
        }

// ================================================================================
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

        function removeFundingChapter(){
          $schoolData=array();
          $fundingChapter=$this->input->post('fundingchapter');
          $schoolData=json_decode($this->input->post('schoolData'));

          foreach ($schoolData as $school) {
         
                $this->db->trans_start();
                $this->db->query("UPDATE mst_sif_details SET msd_mfc_id ='' WHERE msd_school_code LIKE '$school' ");
                if ($this->db->trans_status() === FALSE) {
                
                $this->db->trans_rollback();
                } 
                else {
                    $this->db->trans_commit();
                  }

            }
          }

        function uploadDonorId(){
          $schoolData=array();
          $donorId=$this->input->post('donorId');
          $schoolData=json_decode($this->input->post('schoolData'));
          foreach ($schoolData as $school) {
                $this->db->trans_start();
                $this->db->query("UPDATE mst_sif_details SET msd_md_id ='$donorId' WHERE msd_school_code LIKE '$school' ");
                if ($this->db->trans_status() === FALSE) {
                
                $this->db->trans_rollback();
                } 
                else {
                    $this->db->trans_commit();
                  }

            }
        }

        function uploadSifEditdata(){
          $schoolData=array();
          // $schoolCode=$this->input->post('schoolCode');
          $schoolData=($_POST);
          // echo "$schoolCode";
          // die;
          // print_r($schoolData);
          // die;

                $this->db->trans_start();
               
                $this->db->query($sql)->result_array();
                $this->db->query("UPDATE mst_sif_details SET msd_csr ='{$schoolData['msd_csr']}',msd_Teacher ='{$schoolData['msd_Teacher']}',msd_teacher_sex ='{$schoolData['msd_teacher_sex']}',msd_Boys ='{$schoolData['msd_Boys']}',msd_Girls ='{$schoolData['msd_Girls']}',msd_total ='{$schoolData['msd_total']}',msd_date_of_opening ='{$schoolData['msd_date_of_opening']}',msd_population ='{$schoolData['msd_population']}',msd_Literacy_Rate_Male ='{$schoolData['msd_Literacy_Rate_Male']}',msd_Literacy_Rate_Female ='{$schoolData['msd_Literacy_Rate_Female']}',msd_Vidyalaya_Samity_Pramukh ='{$schoolData['msd_Vidyalaya_Samity_Pramukh']}',msd_Nearest_Railway_Station ='{$schoolData['msd_Nearest_Railway_Station']}',msd_Distance_Of_Vidyalaya_From_Cluster ='{$schoolData['distanceFromCluster']}',msd_Distance_Cluster_From_Rly_Station ='{$schoolData['msd_Distance_Cluster_From_Rly_Station']}',msd_VCF_Name ='{$schoolData['msd_VCF_Name']}',msd_VCF_Phone ='{$schoolData['msd_VCF_Phone']}',msd_SCF_Name ='{$schoolData['msd_SCF_Name']}',msd_SCF_Email ='{$schoolData['msd_SCF_Email']}',msd_SCF_Phone ='{$schoolData['msd_SCF_Phone']}',msd_Date_Of_Updation ='{$schoolData['msd_Date_Of_Updation']}',msd_sif_update ='{$schoolData['msd_sif_update']}' WHERE msd_school_code LIKE '{$schoolData['msd_school_code']}'");
                if ($this->db->trans_status() === FALSE) {
                
                $this->db->trans_rollback();
                } 
                else {
                    $this->db->trans_commit();
                  }

        }

        function uploadUserData(){
          $userdata=array();
          $userdata=($_POST);
              $this->db->trans_start();
                $this->db->query("INSERT INTO mst_donor_board (mbd_id, typeofuser, mbd_username, mbd_pwd, mbd_name, mbd_email, mbd_phone, mbd_ip, mbd_last_login) VALUES ('$userdata[0]', '$userdata[1]', '$userdata[2]', '$userdata[3]', '$userdata[4]', '$userdata[5]', '$userdata[6]', '$userdata[7]', '$userdata[8]') ");
                if ($this->db->trans_status() === FALSE) {
                
                $this->db->trans_rollback();
                } 
                else {
                    $this->db->trans_commit();
                  }

        }
    //========================================================================

    public function compose() {
      if($this->input->post()){
        $donor = base64_decode($this->input->post("donorID"));
        $arr = explode("|",$donor);
        $donorID = $arr[0];
        $to = $arr[1];
        // $to = "talukdar.jit@gmail.com";
        $messageBody = $this->input->post("editor1");
        $subject = $this->input->post("subject");
        // echo $to;exit;
        // t($_FILES,1);
        if(!$_FILES["userfile"]["error"]){
          $uploadData = $this->uploadFile();
          $attachment = base_url("uploads")."/".$uploadData["data"]["file_name"];
          if($uploadData["status"]){
            $res = $this->sendMailNormal($to, $subject, $messageBody, $attachment);
            if($res){
              $this->session->set_flashdata("success","Email has been sent successfully.");
              // $sql = "UPDATE `mst_statistics` SET `mst_total_email`= mst_total_email+".$res.",`mst_last_sent`= '".date("Y-m-d H:i:s")."' WHERE mst_mbd_id = ".$this->userID;
              // $this->db->query($sql);
              $this->updateEmailLog($donorID, $to, $this->userID, 4);
            }
          } else {
            $this->session->set_flashdata("error","Error attaching the file. Please try again.");
          }
        } else {
          $res = $this->sendMailNormal($to, $subject, $messageBody);
          // $res = true;
          if($res){
            $this->session->set_flashdata("success","Email has been sent successfully.");
            // $sql = "UPDATE `mst_statistics` SET `mst_total_email`= mst_total_email+".$res.",`mst_last_sent`= '".date("Y-m-d H:i:s")."' WHERE mst_mbd_id = ".$this->userID;
            // $this->db->query($sql);
            $this->updateEmailLog($donorID, $to, $this->userID,4);
          } else {
            $this->session->set_flashdata("error","Error sending email. Please try again.");
          }
        }
        redirect("administration/compose");
      }
      $this->data["subjects"] = $this->db->query("SELECT `mes_id`, `mes_sub` FROM `mst_email_subjects`")->result_array();
      $this->data["donors"] = $this->donors->get("md_mdb_id = '{$this->userID}' AND md_status = 1", "md_id, md_email, CONCAT(md_fname,' ',md_lname) AS name, md_email emailID");
      $this->load->view("compose_mail",$this->data);
    }

    public function composeAttendance() {
      if($this->input->post()){
        $donor = base64_decode($this->input->post("donorID"));
        $arr = explode("|",$donor);
        $donorID = $arr[0];
        $to = $arr[1];
        // echo $donorID."<br>";
        // echo $to;exit;
        // $to = "talukdar.jit@gmail.com";
        $messageBody = $this->input->post("editor1");
        $subject = $this->input->post("subject");
        // echo $to;exit;
        // t($_FILES,1);
        if(!$_FILES["userfile"]["error"]){
          $uploadData = $this->uploadFile();
          $attachment = base_url("uploads")."/".$uploadData["data"]["file_name"];
          if($uploadData["status"]){
            $res = $this->sendMailNormal($to, $subject, $messageBody, $attachment);
            if($res){
              $this->session->set_flashdata("success","Email has been sent successfully.");
              // $sql = "UPDATE `mst_statistics` SET `mst_total_email`= mst_total_email+".$res.",`mst_last_sent`= '".date("Y-m-d H:i:s")."' WHERE mst_mbd_id = ".$this->userID;
              // $this->db->query($sql);
              $this->updateEmailLog($donorID, $to, $this->userID, 0);
              $this->updateAttendanceReportMailStatus($donorID);
            }
          } else {
            $this->session->set_flashdata("error","Error attaching the file. Please try again.");
          }
        } else {
          $res = $this->sendMailNormal($to, $subject, $messageBody);
          // $res = true;
          if($res){
            $this->session->set_flashdata("success","Email has been sent successfully.");
            // $sql = "UPDATE `mst_statistics` SET `mst_total_email`= mst_total_email+".$res.",`mst_last_sent`= '".date("Y-m-d H:i:s")."' WHERE mst_mbd_id = ".$this->userID;
            // $this->db->query($sql);
            $this->updateEmailLog($donorID, $to, $this->userID,0);
            $this->updateAttendanceReportMailStatus($donorID);
          } else {
            $this->session->set_flashdata("error","Error sending email. Please try again.");
          }
        }
        redirect("administration/compose");
      }
      $this->data["subjects"] = $this->db->query("SELECT `mes_id`, `mes_sub` FROM `mst_email_subjects`")->result_array();
      $this->data["donors"] = $this->donors->get("md_mdb_id = '{$this->userID}' AND md_status = 1", "md_id, md_email, CONCAT(md_fname,' ',md_lname) AS name, md_email emailID");
      $this->load->view("compose_mail_attendance",$this->data);
    }

    public function composeBulk(){
      if($this->input->post()){
        $donorType = $this->input->post("donorType");
        $donors = $this->input->post("donors");
        $messageBody = $this->input->post("editor1");
        $subject = $this->input->post("subject");
        // $resp = $this->donors->fetch("md_status = 1 AND md_mdb_id = '{$this->userID}' AND md_type LIKE '{$donorType}' AND md_email <> ''","CONCAT(`md_fname`,' ', `md_lname`) name, `md_email`, `md_mobile`, `md_home_phone`, `md_office_phone`,`md_id`");
        $sentMail = 0;
        // t($resp,1);
        if(!$_FILES["userfile"]["error"]){
          $uploadData = $this->uploadFile();
          $attachment = base_url("uploads")."/".$uploadData["data"]["file_name"];
        }
        // p(1);
        foreach($donors as $val){
          // echo $val;
          // $resp = $this->donors->fetch("md_email = '{$val}'","CONCAT(`md_fname`,' ', `md_lname`) name, `md_email`, `md_mobile`, `md_home_phone`, `md_office_phone`,`md_id`");
          $resp = $this->db->query("SELECT CONCAT(`md_fname`,' ', `md_lname`) name, `md_email`, `md_mobile`, `md_home_phone`, `md_office_phone`,`md_id`
          FROM mst_donors WHERE md_email = '{$val}'")->row_array();
          // t($resp);
          $find = array('/{name}/', '/{email}/','/{mobile}/','/{home}/','/{office}/');
          $msg = preg_replace($find, $resp, $messageBody);
          $res = $this->sendMailNormal($resp["md_email"], $subject, $msg, $attachment);
          // $res = true;
          // echo $msg;exit;
          if($res){
            $this->session->set_flashdata("success","Email has been sent successfully.");
            // $sql = "UPDATE `mst_statistics` SET `mst_total_email`= mst_total_email+".$res.",`mst_last_sent`= '".date("Y-m-d H:i:s")."' WHERE mst_mbd_id = ".$this->userID;
            // $this->db->query($sql);
            // t($resp,1);
            $this->updateEmailLog($resp["md_id"], $resp["md_email"], $this->userID,3);
            $sentMail = $sentMail+1;
          }
        }
        if($sentMail){
          $this->session->set_flashdata("success","Email has been sent successfully to {$sentMail} number of donors");
        } else {
          $this->session->set_flashdata("success","There was an error sending emails. Please try again.");
        }
        redirect('administration/composeBulk');
      }
      $this->data["subjects"] = $this->db->query("SELECT `mes_id`, `mes_sub` FROM `mst_email_subjects`")->result_array();
      $this->load->view("compose_mail_bulk",$this->data);
    }

    public function composePictures(){
      if($this->input->post()){
        $donorID = $this->input->post("donorID");
        $messageBody = $this->input->post("msgBody");
        $attachments = $this->input->post("attachment");
        $attachment_ids = $this->input->post("attachmentids");
        $subject = $this->input->post("subject");
        $val = $this->donors->fetch("md_id = {$donorID}","CONCAT(`md_fname`,' ', `md_lname`) name, `md_email`, `md_mobile`, `md_home_phone`, `md_office_phone`,`md_id`");
        // p(1);
        $res = $this->sendMail($val["md_email"], $subject, $messageBody, $attachments);
        // $res = true;
        if($res){
          for($i=0;$i<count($attachments);$i++) {
            $query = "UPDATE trn_connectapp_notification SET tcn_isSent = 1 WHERE tcn_id = '".$attachment_ids[$i]."'";
            $this->db->query($query);
          }
          $this->session->set_flashdata("success","Mail sent to the donor. Go to dashboard to check the status");
          $this->updateEmailLog($donorID, $val["md_email"], $this->userID,1);
        } else {
          $this->session->set_flashdata("error","Sorry there was an error. Please try again.");
        }
        redirect("administration/composePictures");
      }
      // $this->data["donors"] = $this->donors->get("md_mdb_id = '{$this->userID}' AND md_status = 1", "md_id, CONCAT(md_fname,' ',md_lname) AS name, md_email emailID");
      // t($this->data["donors"],1);
      $this->data["subjects"] = $this->db->query("SELECT `mes_id`, `mes_sub` FROM `mst_email_subjects`")->result_array();
      $this->load->view('compose_mail_pictures',$this->data);
    }

    public function composeDonorBoard() {
      if($this->input->post()){
        $donorID = $this->input->post("donorID");
        $messageBody = $this->input->post("editor1");
        $subject = $this->input->post("subject");
        $attachment = urldecode($this->input->post("attachment"));
        $donor = $this->donors->fetch("md_id = '{$donorID}'");
        $to = $donor["md_email"];
        // $to = "talukdar.jit@gmail.com";
        $res = $this->sendMailNormal($to, $subject, $messageBody, $attachment);
        // $res = true;
        if($res){
          $this->session->set_flashdata("success","Email has been sent successfully.");
          $this->updateEmailLog($donorID, $to, $this->userID,2);
          $this->updateDonorBoardMailStatus($donorID);
        } else {
          $this->session->set_flashdata("error","Error sending email. Please try again.");
        }
        redirect("drm");
      }
      $this->data["subjects"] = $this->db->query("SELECT `mes_id`, `mes_sub` FROM `mst_email_subjects`")->result_array();
      $this->load->view("compose_mail_Donor_Board",$this->data);
    }

    public function getSchoolImages(){
      $donorID = $this->input->post("donorID");
      $filRes = $this->db->query("SELECT ef_pic_from_date fromDate, ef_pic_to_date toDate FROM env_filter")->row_array();
      $toDate = ($filRes["toDate"])?$filRes["toDate"]:date("Y-m-d");
      $sql = "SELECT tcn_id, tcn_img, tcn_schoolCode, tcn_datetime FROM `mst_donor_schools`
      JOIN trn_connectapp_notification ON TRIM(tcn_schoolCode) = TRIM(mds_school_code)
      JOIN mst_donors ON mds_md_id = md_id WHERE tcn_isSent = 0
      AND md_id = '{$donorID}' AND `tcn_datetime` BETWEEN '{$filRes["fromDate"]}' AND '{$toDate}'";
      // echo $sql;exit;
      $r = $this->db->query($sql);
      $res = $r->result_array();
      $r->free_result();
      $html = "<tr>";
      if(count($res)){
        $j=1;
        for ($i=0;$i<count($res);$i++) {
            $html .= '<td>
            <input type="checkbox" name="attachment[]" value="'.$res[$i]["tcn_img"].'">
            <input type="hidden" name="attachmentids[]" value="'.$res[$i]["tcn_id"].'">
            </td>';
            $html .= '<td><a href="'.CONNECTAPP_URL.'uploads/'.$res[$i]["tcn_img"].'" class="content2"><img src="'.CONNECTAPP_URL.'uploads/'.$res[$i]["tcn_img"].'" style="max-height:100px; max-width:100px;"></a><br><strong>'.$res[$i]["tcn_schoolCode"].'</strong></td>';
          if($j%4 == 0){
            $html .= "</tr>";
            $html .= "<tr>";
          }
          if(count($res) == $j){
            $html .= "</tr>";
          }
          $j++;
        }
      } else {
          $html .= '<td>No school pictures found for this donor</td>';
          $html .= "</tr>";
      }
      $html .= '<script type="text/javascript">jQuery(".content2").colorbox({width: "70%", opacity: 0.35, height: "auto"});</script>';
      echo $html;
    }

    private function fetchAssociatedSchools(){
      $sql = "SELECT mst_donor_schools.mds_school_code FROM mst_donors, mst_donor_schools WHERE md_id = mds_md_id AND md_mdb_id = ".$this->userID." GROUP BY mds_school_code";
      return $this->db->query($sql)->result_array();
    }

    public function listSchoolsReport(){
      $this->data["schools"] = $this->input->post("report");
      $this->data["donorCode"] = $this->input->post("donorName");
      // t($this->data["schools"],1);
      $this->load->view('listschools-report',$this->data);
    }

    # START -- Retrive data from MIS server (Do not Delete)
    /*public function retriveGKVbySchoolWithPeriod(){
      $schoolCode = $this->input->post("schoolcode");
      $data = "schoolcode=".$schoolCode;
      $resp = $this->curlRequest(GKV_BY_SCHOOL_WITH_PERIOD_URL, $data, 0);
      echo $resp;
    }*/
    # END -- Retrive data from MIS server

    # START -- Retrive GKV from local (Temporary Solution because of Server issue)
    //Temporary Solution because of Server issue -- Instructed by Arindam Mitra
    public function retriveGKVbySchoolWithPeriod(){
      $schoolCode = $this->input->post("schoolcode");
      $sql = "SELECT rgc_school_code, rgc_period_code,
      DATE_FORMAT(CONCAT(SUBSTRING(`rgc_period_code`,3,4),'-',SUBSTRING(`rgc_period_code`,1,2),'-01'),'%Y-%m-%d') AS periodDate
      FROM drmtempmis.`rpt_gkv_complete` WHERE rgc_school_code LIKE '{$schoolCode}'
      ORDER BY periodDate DESC LIMIT 6";
      $r = $this->db->query($sql);
      $res = $r->result_array();
      $r->free_result;
      $arr = array();
      foreach($res as $val){
        $arr[] = $this->fetchGKVBySchool($val);
      }

      if(!empty($arr)){
        $resp["code"] = "200";
        $resp["data"] = $arr;
      } else {
        $resp["code"] = "400";
      }
      $resp = json_encode($resp, TRUE);
      echo $resp;
    }
    private function fetchGKVBySchool($data){
      // t($data,1);
      $schoolcode = trim($data["rgc_school_code"]);
      $periode_code = trim($data["rgc_period_code"]);
      // Search from MIS data
      $sql = "SELECT `mgkvd_village_name`, `rsd_District`, `rsd_state`, `mgkvd_sch_day`,
      `mgkvd_present_boys`, `mgkvd_present_girls`, `mgkvd_kishore`, `mgkvd_balak`
      FROM drmtempmis.`mst_gram_karya_vivaran_hd`
      JOIN drmtempmis.`mst_gram_karya_vivaran_dt` ON `mgkvd_mgkvh_id`=`mgkvh_id`
      JOIN drmtempmis.`rpt_sif_details` ON `rsd_school_code`=`mgkvd_village_code`
      WHERE `mgkvd_village_code` LIKE '".$schoolcode."' AND  `mgkvh_period_code` LIKE '".$periode_code."'
      ORDER BY `mst_gram_karya_vivaran_hd`.`mgkvh_id` DESC";
      $getDetails = $this->db->query($sql)->row_array();
      // echo count($getDetails);
      // echo $this->db->last_query(); exit;
      if(count($getDetails) == 0) {
        $sql = "SELECT `mgkvd_village_name`, `rsd_District`, `rsd_state`, `mgkvd_sch_day`,
        `mgkvd_present_boys`, `mgkvd_present_girls`, `mgkvd_kishore`, `mgkvd_balak`
        FROM drmtempmis.`mst_gram_karya_vivaran_hd_svo`
        JOIN drmtempmis.`mst_gram_karya_vivaran_dt_svo` ON `mgkvd_mgkvh_id`=`mgkvh_id`
        JOIN drmtempmis.`rpt_sif_details` ON `rsd_school_code`=`mgkvd_village_code`
        WHERE `mgkvd_village_code` LIKE '".$schoolcode."' AND  `mgkvh_period_code` LIKE '".$periode_code."'
        ORDER BY `mst_gram_karya_vivaran_hd_svo`.`mgkvh_id` DESC";
        // echo $sql;exit;
        $getDetails = $this->db->query($sql)->row_array();
        // echo $this->db->last_query();exit;
      }
      // t($getDetails,1);
      $getDetails["period"] = date("F, Y",strtotime($data["periodDate"]));
      return $getDetails;
    }
    # END -- Retrive GKV from local (Temporary Solution because of Server issue)

    public function pdfReport(){
      // p(1);
      $report = $this->input->post("RPT");
      $donorCode = $this->input->post("donorCode");
      $res = $this->donors->fetch("md_user_name LIKE '{$donorCode}'");
      $this->data["donor"] = $res["md_fname"]." ".$res["md_lname"];
      $this->data["rptData"] = $report;
      $html = $this->load->view('report-pdf',$this->data, true);
      // t($report,1);
      $filename = $donorCode.".pdf";
      $this->load->library('m_pdf');
      $this->m_pdf->pdf->WriteHTML($html);
      $this->m_pdf->pdf->Output($filename, "I");
    }

    public function listSchools($type = 'DPS'){
      $perPage = 10;
      $paginationOffset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      $url = base_url() . "administration/listSchools/".$type;
      $query = "SELECT `mds_id`, `mds_school_code`, 0 AS connectAppImgCount FROM mst_donor_schools
      WHERE `mds_mdb_id` = '{$this->userID}' AND mds_donorType = '{$type}' ";


      // $select = "`mds_id`, `mds_school_code`, (SELECT COUNT(*) FROM trn_connectapp_notification WHERE tcn_schoolCode = mds_school_code) connectAppImgCount";
      $sql = "`mds_mdb_id` = '{$this->userID}' AND mds_donorType = '{$type}' GROUP BY `mds_school_code`";
      if($this->input->post('search')){
        $searchQuery = $this->input->post('search');
        // $sql = "`mds_mdb_id` = '{$this->userID}' AND mds_donorType = '{$type}' AND mds_school_code LIKE '%{$searchQuery}%' GROUP BY `mds_school_code`";
        $query .= "AND mds_school_code LIKE '%{$searchQuery}%' ";
      }
      $query .= "ORDER BY `mds_id` DESC LIMIT {$paginationOffset}, {$perPage}";
      $totalCount = count($this->donorschools->get($sql));
      // echo $this->db->last_query();exit;
      // $donorSchools = $this->donorschools->get($sql, $select, $perPage, $paginationOffset);
      $donorSchools = $this->db->query($query)->result_array();
      // t($donorSchools,1);
      // echo $this->db->last_query();exit;
      $this->initializePagination($totalCount, $perPage, $url);
      $this->data["res"] = $donorSchools;
      $this->data["searchQuery"] = $searchQuery;
      // t($donorSchools,1);
      $this->load->view("listAllSchools", $this->data);
    }

    public function notification($type = 'DPS'){
      $perPage = 10;
      $paginationOffset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      $sql = "SELECT `tcn_schoolCode`, tcn_status, `tcn_img`, CONCAT(md_fname, ' ', md_lname) AS name, md_type FROM `trn_connectapp_notification`, mst_donor_schools, mst_donors WHERE `tcn_schoolCode` = mds_school_code AND mds_md_id = md_id AND md_type = '{$type}' ORDER BY tcn_status ASC";
      $totalCount = count($this->db->query($sql)->result_array());
      $sql .= " LIMIT {$paginationOffset},{$perPage}";
      $res = $this->db->query($sql)->result_array();
      // echo $this->db->last_query();exit;
      $url = base_url() . "administration/notification/".$type;
      $this->initializePagination($totalCount, $perPage, $url);

      $this->data["schools"] = $res;
      // t($res,1);
      $this->load->view("listAllSchools_notification", $this->data);
    }

    public function editDonorSchool($donorID){
      if($this->input->post()){
        $school = $this->input->post('DONOR');
        $this->donorschools->add($school);
      }
      $this->data["donorID"] = $donorID;
      $this->data["schools"] = $this->donorschools->get("mds_md_id = '{$donorID}'");
      $this->load->view('editDonorSchool', $this->data);
    }

    public function delSchool($schoolID, $donorID){
      $this->donorschools->delete("mds_id = '{$schoolID}'");
      redirect("administration/editDonorSchool/".$donorID);
    }

    public function checkDonorType(){
      $donorType = $this->input->post("donorType");
      $donors = $this->donors->get("md_mdb_id = '{$this->userID}' AND md_type = '{$donorType}' AND md_status = 1");
      echo count($donors);
    }

    public function sendDummyEmail(){
      $to = "talukdar.jit@gmail.com";
      $subject = "Ekal DRMS School Pictures";
      $messageBody = "<h1>Hi this is a test message</h1>";
      echo $this->sendMailNormal($to, $subject, $messageBody);
    }

    public function checkFiles(){
      $resp = array();
      $filter = $this->getFilterSettings();
      $donorID = $this->input->post("donorID");
      $donorType = $this->input->post("donorType");
      if($donorType == "DPS"){
        $year = $filter["ef_dps_year"];
      } else {
        $year = $filter["ef_rms_year"];
      }

      $donor = $this->donors->fetch("md_id = '{$donorID}'");
      $fileName = "DonorBoard_".$donorType."_".$year."_".$donor["md_user_name"].".pdf";
      $file = base_url("uploads/donorboards")."/".$donorType."/".$fileName;
      // echo $file;
      if(file_get_contents($file)){
        $resp["status"] = "200";
        $resp["fileName"] = $fileName;
        $resp["filePath"] = urlencode($file);
        $resp["absolutePath"] = "uploads/donorboards/".$donor["md_type"]."/".$fileName;
      }
      echo json_encode($resp);
    }

    ################## TEMPORARY ####################

    public function loadDonors($mailType = 0){
      $donorType = $this->input->post("donorType");
      switch ($mailType) {
        case 0: // Individual Emails
          echo $this->loadIndividualDonors($donorType);
          break;
        case 1: // Attendance Report
          echo $this->loadAttendanceReportDonors($donorType);
          break;
        case 2: // Bulk Email
          echo $this->loadBulkIndividualDonors($donorType);
          break;
        case 3: // School Pictures
          echo $this->loadSchoolPictureDonors($donorType);
          break;
        case 4: // Donor Board
          echo $this->loadDonorBoardDonors($donorType);
          break;
        default:
          echo $this->loadBulkIndividualDonors($donorType);
          break;
      }

    }

    public function loadIndividualDonors($donorType){
      $sql = "SELECT md_id, concat(`md_fname`, ' ', `md_lname`) donorName, `md_email` FROM `mst_donors`
      WHERE `md_type` = '{$donorType}' AND `md_email` <> ''";
      $r = $this->db->query($sql);
      $res = $r->result_array();
      $r->free_result();
      $this->db->close();
      // t($res,1);
      $option = '';
      foreach ($res as $value) {
        $option .= '<option value="'.base64_encode($value["md_id"]."|".$value["md_email"]).'">'.$value["donorName"]." (".$value["md_email"].")".'</option>';
      }
      return $option;
    }

    public function loadAttendanceReportDonors($donorType){
      $sql = "SELECT md_id, concat(`md_fname`, ' ', `md_lname`) donorName, `md_email` FROM `mst_donors`
      WHERE `md_type` = '{$donorType}' AND `md_email` <> '' AND md_flag_attendance = 0";
      $r = $this->db->query($sql);
      $res = $r->result_array();
      $r->free_result();
      $this->db->close();
      // t($res,1);
      $option = '';
      foreach ($res as $value) {
        $option .= '<option value="'.base64_encode($value["md_id"]."|".$value["md_email"]).'">'.$value["donorName"]." (".$value["md_email"].")".'</option>';
      }
      return $option;
    }

    public function loadBulkIndividualDonors($donorType){
      $sql = "SELECT md_id, concat(`md_fname`, ' ', `md_lname`) donorName, `md_email` FROM `mst_donors`
      WHERE `md_type` = '{$donorType}' AND `md_email` <> ''";
      $r = $this->db->query($sql);
      $res = $r->result_array();
      $r->free_result();
      $this->db->close();
      $option = '';
      foreach ($res as $value) {
        $option .= '<option value="'.base64_encode($value["md_email"]).'">'.$value["donorName"]." (".$value["md_email"].")".'</option>';
      }
      return $option;
    }

    public function loadSchoolPictureDonors($donorType){
      $filRes = $this->db->query("SELECT ef_pic_from_date fromDate, ef_pic_to_date toDate FROM env_filter")->row_array();
      $toDate = ($filRes["toDate"])?$filRes["toDate"]:date("Y-m-d");
      $sql = "SELECT md_id, md_email emailID, CONCAT(md_fname, ' ', md_lname) AS name, tcn_schoolCode, tcn_status
      FROM `trn_connectapp_notification`, mst_donor_schools, mst_donors
      WHERE `tcn_schoolCode` = mds_school_code AND mds_md_id = md_id AND tcn_isSent = 0
      AND md_email <> '' AND mds_donorType = '{$donorType}' AND `tcn_datetime` BETWEEN '{$filRes["fromDate"]}' AND '{$toDate}'
      GROUP BY md_id ORDER BY tcn_datetime DESC";
      $r = $this->db->query($sql);
      // echo $this->db->last_query();exit;
      $res = $r->result_array();
      $r->free_result();
      $this->db->close();
      $option = '<option value="">-- SELECT -- </option>';
      foreach ($res as $value) {
        $option .= '<option value="'.$value["md_id"].'">'.$value["name"]." (".$value["emailID"].")".'</option>';
      }
      return $option;
    }

    public function loadDonorBoardDonors($donorType){
      $res = $this->donors->get("md_mdb_id = '{$this->userID}' AND md_status = 1 AND md_flag_donorboard = 0 AND md_type = '{$donorType}' AND md_email <> ''", "md_id, md_email, CONCAT(md_fname,' ',md_lname) AS name, md_email emailID");
      $option = '<option value="">-- SELECT -- </option>';
      foreach ($res as $value) {
        $option .= '<option value="'.$value["md_id"].'">'.$value["name"]." (".$value["md_email"].")".'</option>';
      }
      return $option;
    }

    private function updateDonorBoardMailStatus($donorID) {
      $arr = array(
        "md_flag_donorboard" => 1
      );
      $res = $this->donors->edit($arr, $donorID);
      return $res;
    }

    private function updateAttendanceReportMailStatus($donorID) {
      $arr = array(
        "md_flag_attendance" => 1
      );
      $res = $this->donors->edit($arr, $donorID);
      return $res;
    }

    public function settings() {
      if($this->input->post()){
        // p(1);
        $todo = $this->input->post("todo");
        switch ($todo) {
          case 'datefilter':
            $this->dateFilterUpdate($this->input->post());
            break;
          case 'donorboardpdf':
            $this->donorBoardPDFFilterUpdate($this->input->post());
            break;
          case 'resetReport':
          $this->resetDonorFlag($this->input->post());
          break;
        }
        redirect('administration/settings');
      }
      $this->data["filter"] = $this->getFilterSettings();
      $this->load->view("settings", $this->data);
    }

    private function dateFilterUpdate($data) {
      $fromDate = $data["fromDate"];
      $toDate = $data["toDate"];
      $arr = array(
        "ef_pic_from_date" => $fromDate,
        "ef_pic_to_date" => ($toDate)?$toDate:""
      );
      // t($arr,1);
      $this->db->set($arr, false);
      $this->db->update("env_filter");
      $id = $this->db->affected_rows();
      if($id){
        $this->session->set_flashdata("success", "School Pictures dates filter to attach connectapp photos have been updated successfully");
      } else {
        $this->session->set_flashdata("error", "Sorry! Nothing has been updated. Please try again.");
      }
    }

    private function donorBoardPDFFilterUpdate($data){
      $dpsyear = $data["dpsyear"];
      $rmsyear = $data["rmsyear"];
      $arr = array(
        "ef_dps_year" => $dpsyear,
        "ef_rms_year" => $rmsyear
      );
      // t($arr,1);
      $this->db->set($arr, false);
      $this->db->update("env_filter");
      $id = $this->db->affected_rows();
      if($id){
        $this->session->set_flashdata("success", "Donor Board Year filters for attaching pdf has been updated successfully");
      } else {
        $this->session->set_flashdata("error", "Sorry! Nothing has been updated. Please try again.");
      }
    }

    private function resetDonorFlag($data) {
      $dpsReset = $data["DPSReset"];
      $rmsReset = $data["RMSReset"];
      if($dpsReset) {
        $this->db->set(array("md_flag_attendance" => 0), false);
        $this->db->where("md_type", "DPS");
      } if($rmsReset) {
        $this->db->set(array("md_flag_attendance" => 0), false);
        $this->db->where("md_type", "RMS");
      }
      $this->db->update("mst_donors");
      if($this->db->affected_rows()) {
        $this->session->set_flashdata("success", "Attendance Report donors have been reset successfully");
      } else {
        $this->session->set_flashdata("error", "Sorry! Nothing has been updated. Please try again.");
      }
    }

}
