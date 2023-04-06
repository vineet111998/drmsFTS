<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller {

    public function __construct() {
      header('Access-Control-Allow-Origin: *');
      header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
      parent::__construct();
      $this->load->model('donors');
      $this->load->model('donorschools');
      $this->load->model('donorboard');
    }

    public function fetchDonorEmails(){
      $_POST = json_decode(file_get_contents('php://input'), true);
      $resp = array();
      $schoolCode = $this->input->post("schoolCode");
      $sql = "SELECT md_email FROM `mst_donor_schools` mds JOIN mst_donors ON mds_md_id = md_id WHERE `mds_school_code` LIKE '%".$schoolCode."%'";
      $res = $this->db->query($sql)->result_array();
      if(count($res) > 0){
        $arr = array();
        foreach($res as $v){
          $arr[] = $v["md_email"];
        }
        $emails = implode(",",$arr);
        $resp["code"] = "200";
        $resp["emails"] = $emails;
      } else {
        $resp["code"] = "400";
      }
      echo json_encode($resp);
    }

    public function insertNotification(){
      $resp = array();
      $_POST = json_decode(file_get_contents('php://input'), true);
      $img = $this->input->post("img");
      $schoolCode = $this->input->post("schoolCode");
      $inserArr = array(
        "tcn_img" => $img,
        "tcn_schoolCode" => $schoolCode
      );
      $this->db->insert('trn_connectapp_notification',$inserArr);
      $insertID = $this->db->insert_id();
      if($insertID){
        $resp["code"] = "200";
      } else {
        $resp["code"] = "400";
      }
      echo json_encode($resp);
    }

    public function userLogin() {
      $_POST = json_decode(file_get_contents('php://input'), true);
      $username = $this->input->post("username");
      $pwd = $this->input->post("pwd");
      $donorBoard = $this->donorboard->fetch("mbd_username = '{$username}'");
      $resp = array();
      if(count($donorBoard)) {
        if($donorBoard['mbd_pwd'] == md5($pwd)) {
          $r["adminID"] = $donorBoard['mbd_id'];
          $r["userType"] = 0;
          $r["adminName"] = $donorBoard['mbd_name'];
          $r["adminEmail"] = $donorBoard['mbd_email'];
          $resp["data"] = $r;
          $resp["status"] = "200";
        } else {
          $resp["status"] = "401";
        }
      } else {
        $resp["status"] = "404";
      }
      echo json_encode($resp);
      // exit;
    }
}
