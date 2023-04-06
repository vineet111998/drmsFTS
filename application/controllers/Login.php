<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->model('donors');
      $this->load->model('donorboard');
    }

    public function index() {
      if ($this->input->post()){
          $username = $this->input->post("username");
          $pwd = $this->input->post("pwd");
          $donorBoard = $this->donorboard->fetch("mbd_username = '{$username}'");
          
          
          
          if(!empty($donorBoard)){
            if($donorBoard['mbd_pwd'] == md5($pwd)){
                // t($donorBoard,1);
              $this->session->set_userdata('userID',$donorBoard['mbd_id']);
              $this->session->set_userdata('userType',0);
              $this->session->set_userdata("adminName",$donorBoard['mbd_name']);
              $this->session->set_userdata("userEmail",$donorBoard['mbd_email']);
              $this->session->set_userdata("typeofuser",$donorBoard['mbd_type']);
              $this->db->query("UPDATE `trn_connectapp_notification` SET `tcn_status` = 1 WHERE `tcn_datetime` < DATE_SUB(NOW(), INTERVAL 3 DAY)");
              redirect("drm");
            } else {
              $this->session->set_flashdata("error","Please check your credential");
              redirect("login");
            }
          } else {
            $donors = $this->donors->fetch("md_user_name = '{$username}'");
            if($donors['md_password'] == md5($pwd)){
              $this->session->set_userdata('userID',$donors['md_id']);
              $this->session->set_userdata('userType',$donors['md_status']);
              $this->session->set_userdata("adminName",$donors['md_fname']);
              $this->session->set_userdata("userEmail",$donors['md_email']);
              if($donors['md_status']){
                redirect("drm/listSchools");
              } else {
                redirect("drm");
              }
            } else {
              $this->session->set_flashdata("error","Please check your credential");
              redirect("login");
            }
          }
      }
      $this->load->view('login', $this->data);
    }

    // public function index() {
    //   if ($this->input->post()){
    //       $username = $this->input->post("username");
    //       $pwd = $this->input->post("pwd");
    //       $user = $this->donors->fetch("md_user_name = '{$username}'");
    //       if($user['md_password'] == md5($pwd)){
    //         // echo $user['md_password'];exit;
    //         $this->session->set_userdata('userID',$user['md_id']);
    //         $this->session->set_userdata('userType',$user['md_status']);
    //         $this->session->set_userdata("adminName",$user['md_fname']);
    //         $this->session->set_userdata("userEmail",$user['md_email']);
    //         if($user['md_status']){
    //           redirect("drm/listSchools");
    //         } else {
    //           redirect("drm");
    //         }
    //       } else {
    //         $this->session->set_flashdata("error","Please check your credential");
    //         redirect("login");
    //       }
    //   }
    //   $this->load->view('login', $this->data);
    // }

    public function forgotPassSubmit(){}

    public function logout(){
        $this->session->sess_destroy();
        redirect("login");
    }


    public function userCreate()
    {
      
    }
}
