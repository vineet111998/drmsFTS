<?php

/**
 * Core Controllers
 */
class MY_Controller extends CI_Controller {

    public $data = array();
    public $paginationOffset = "";

    public function __construct() {
        parent::__construct();
        $this->setINI();
        $this->assignPaths();
    }

    private function setINI() {
        ini_set('memory_limit', "2048M");
        ini_set('upload_max_filesize', '50M');
    }

    private function assignPaths() {
        $base_url = base_url();
        $this->data['base_url'] = $base_url;
        $this->data['asstesPath'] = $base_url . "assets/assets/";
        $this->data['cssPath'] = $base_url . "assets/css/";
        $this->data['jsPath'] = $base_url . "assets/js/";
        $this->data['imgPath'] = $base_url . "assets/img/";
        $this->data['dashboardJS'] = $this->load->view('jsincludes/dashboardjs', $this->data, TRUE);
        $this->data['tablesJS'] = $this->load->view('jsincludes/tablesjs', $this->data, TRUE);
        $this->data['forminputJS'] = $this->load->view('jsincludes/forminputJS', $this->data, TRUE);
        $this->data['forminputWizardJS'] = $this->load->view('jsincludes/forminputWizardJS', $this->data, TRUE);
        $this->data['lightboxJS'] = $this->load->view('jsincludes/lightboxJS', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('footer', $this->data, TRUE);
    }

    protected function convertNumberToWords($number) {
        if (($number < 0) || ($number > 999999999)) {
            throw new Exception("Number is out of range");
        }

        $Gn = floor($number / 1000000);  /* Millions (giga) */
        $number -= $Gn * 1000000;
        $kn = floor($number / 1000);     /* Thousands (kilo) */
        $number -= $kn * 1000;
        $Hn = floor($number / 100);      /* Hundreds (hecto) */
        $number -= $Hn * 100;
        $Dn = floor($number / 10);       /* Tens (deca) */
        $n = $number % 10;               /* Ones */

        $res = "";

        if ($Gn) {
            $res .= $this->convertNumberToWords($Gn) . " Million";
        }

        if ($kn) {
            $res .= (empty($res) ? "" : " ") .
                    $this->convertNumberToWords($kn) . " Thousand";
        }

        if ($Hn) {
            $res .= (empty($res) ? "" : " ") .
                    $this->convertNumberToWords($Hn) . " Hundred";
        }

        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six",
            "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen",
            "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen",
            "Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty",
            "Seventy", "Eigthy", "Ninety");

        if ($Dn || $n) {
            if (!empty($res)) {
                $res .= " and ";
            }

            if ($Dn < 2) {
                $res .= $ones[$Dn * 10 + $n];
            } else {
                $res .= $tens[$Dn];

                if ($n) {
                    $res .= "-" . $ones[$n];
                }
            }
        }

        if (empty($res)) {
            $res = "zero";
        }

        return $res;
    }

    protected function saveBase64ImageToFile($rawImageData, $path, $jpgImageName, $rotateAngle = 0) {
        $imageData = base64_decode($rawImageData);
        $source = imagecreatefromstring($imageData);
        $rotate = imagerotate($source, $rotateAngle, 0); // if want to rotate the image
        $imageName = $path . $jpgImageName;
        imagejpeg($rotate, $imageName, 100);
        imagedestroy($source);
    }

    protected function base64_to_jpeg($base64_string, $output_file) {
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' );
        fwrite( $ifp, base64_decode( $base64_string ) );

        // clean up the file resource
        fclose( $ifp );

        return $output_file;
    }

    protected function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
        // Calculate the distance in degrees
        $degrees = rad2deg(acos((sin(deg2rad($point1_lat)) * sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat)) * cos(deg2rad($point2_lat)) * cos(deg2rad($point1_long - $point2_long)))));

        // Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
        switch ($unit) {
            case 'km':
                $distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
                break;
            case 'mi':
                $distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
                break;
            case 'nmi':
                $distance = $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
        }
        return round($distance, $decimals);
    }

    protected function curlRequest($url, $jsonString, $isJson = 1){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if($isJson){
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        }
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return ($response)?$response:curl_error($ch);
    }

    protected function readExcelFile($file){
      $this->load->library('excel');
      $objPHPExcel = PHPExcel_IOFactory::load($file);
      $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
      // t($cell_collection,1);
      foreach ($cell_collection as $cell) {
        $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
        // echo $column."<br>";
        $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
        $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getCalculatedValue();
        $arr_data[$row][$column] = $data_value;
      }
      // t($arr_data,1);
      return $arr_data;
    }

    protected function initializePagination($totalRows, $perPage, $baseURL) {
      $this->load->library('pagination');
      $config['base_url'] = $baseURL; //base_url() . "dashboardctrl/keywordlist";
      $config['total_rows'] = $totalRows;
      $config['per_page'] = $perPage;
      $config['full_tag_open'] = '<div class="pagination"><ul>';
      $config['full_tag_close'] = '</ul></div>';
      $config['first_link'] = 'First';
      $config['first_tag_open'] = '<li>';
      $config['first_tag_close'] = '</li>';
      $config['last_link'] = 'Last';
      $config['last_tag_open'] = '<li>';
      $config['last_tag_close'] = '</li>';
      $config['next_link'] = 'Next &rarr; ';
      $config['next_tag_open'] = '<li>';
      $config['next_tag_close'] = '</li>';
      $config['prev_link'] = '&larr; Prev';
      $config['prev_tag_open'] = '<li>';
      $config['prev_tag_close'] = '</li>';
      $config['cur_tag_open'] = '<li class="active"><a>';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $this->pagination->initialize($config);
    }

}

class Admin_Controller extends MY_Controller {

  public $userID = 0;
  public $isAdmin = 0;

    public function __construct() {
        parent::__construct();
        $this->checkLoginStatus();
        $this->assignSubPages();
        $this->userID = $this->session->userdata('userID');
        $this->isAdmin = ($this->session->userdata('userType'))?0:1;
    }

    private function assignSubPages() {
        // include all header and footer and sidebar
        $this->data['header'] = $this->load->view('header', $this->data, TRUE);
        $this->data['footer'] = $this->load->view('footer', $this->data, TRUE);
        $this->data['sidebar'] = $this->load->view('sidebar', $this->data, TRUE);
        $this->data['dashboardJS'] = $this->load->view('jsincludes/dashboardjs', $this->data, TRUE);
        $this->data['tablesJS'] = $this->load->view('jsincludes/tablesjs', $this->data, TRUE);
        $this->data['forminputJS'] = $this->load->view('jsincludes/forminputJS', $this->data, TRUE);
        $this->data['forminputWizardJS'] = $this->load->view('jsincludes/forminputWizardJS', $this->data, TRUE);
        $this->data['lightboxJS'] = $this->load->view('jsincludes/lightboxJS', $this->data, TRUE);
    }

    public function checkLoginStatus() {
        $bool = $this->session->userdata("userID");
        if(!$bool){
            if($this->router->fetch_class()=='administration' && $this->router->fetch_method()=='getSchoolByDonorCodeFromchmp')
            {

            }
            else
                redirect("login");
        }
        // if(!$bool){
        //     redirect("login");
        // }
    }

    public function sendMail($to, $sub, $body, $attachments){
      $this->load->library('email');
      $config['protocol'] = 'sendmail';
      $config['mailpath'] = '/usr/sbin/sendmail';
      //$config['charset'] = 'iso-8859-1';
      $config['mailtype'] = 'html';
      $config['wordwrap'] = TRUE;
      $this->email->initialize($config);
      // $headers = 'From: YourLogoName info@domain.com' . "\r\n" ;
      // $headers .='Reply-To: '. $to . "\r\n" ;
      // $headers .='X-Mailer: PHP/' . phpversion();
      // $headers .= "MIME-Version: 1.0\r\n";
      // $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
      $this->email->from('no-reply@ekaldrms.org', 'Ekal DRMS');
      $this->email->to($to);
      $this->email->subject($sub);
      $this->email->message($body);
      $this->email->set_header('Header1', 'X-Mailer: PHP/' . phpversion());
      $this->email->set_header('Header2', "MIME-Version: 1.0\r\n");
      $this->email->set_header('Header3', "Content-type: text/html; charset=iso-8859-1\r\n");
      $connectappURL = CONNECTAPP_URL."uploads/";
      if(!empty($attachments)){
        for($i=0;$i<count($attachments);$i++){
          $attachmentFile = $connectappURL.$attachments[$i];
          $this->email->attach($attachmentFile);
          // $arr = array(
          //   "tcn_status" => 1
          // );
          // $this->db->where("tcn_img LIKE '{$attachments[$i]}'");
          // $this->db->update($arr);
        }
      }
      if($this->email->send()){
        return 1;
      } else {
        return 0;
      }
      // echo $this->email->print_debugger();
    }

    public function sendMailNormal($to, $sub, $body, $attachment = null){
      $this->load->library('email');
      $config['protocol'] = 'sendmail';
      $config['mailpath'] = '/usr/sbin/sendmail';
      //$config['charset'] = 'iso-8859-1';
      $config['mailtype'] = 'html';
      $config['wordwrap'] = TRUE;
      $this->email->initialize($config);

      $this->email->from('no-reply@ekaldrms.org', 'Ekal DRMS');
      $this->email->to($to);
      $this->email->subject($sub);
      $this->email->message($body);
      if($attachment){
        $this->email->attach($attachment);
      }
      // if(count($attachments) > 1){
      //   for($i=0;$i<count($attachments);$i++){
      //     $attachmentFile = $attachments[$i];
      //     $this->email->attach($attachmentFile);
      //   }
      // } else {
      //   $this->email->attach($attachments);
      // }
      if($this->email->send()){
        return 1;
      } else {
        return 0;
      }
    }

    public function updateEmailLog($donorID, $emailID, $userID, $mailType){
      $arr = array(
        "tel_email" => $emailID,
        "tel_donorID" => $donorID,
        "tel_timestamp" => date('Y-m-d H:i:s'),
        "tel_mailType" => $mailType,
        "tel_userID" => $userID
      );
      // t($arr,1);
      $this->db->set($arr, false);
      $this->db->insert("temp_email_log");
      return $this->db->insert_id();
    }

    public function getFilterSettings(){
      $r = $this->db->query("SELECT * FROM `env_filter`");
      $res = $r->row_array();
      $r->free_result();
      $this->db->close();
      return $res;
    }


    public function getSchoolByAnchalCodeWithNoFundingChapter($anchalcode){
        $sql ="SELECT * FROM mst_sif_details WHERE msd_anchal_code LIKE '{$anchalcode}' AND msd_mfc_id ='' ORDER BY msd_anchal_code";
        $schoollist=$this->db->query($sql)->result_array();
        return $schoollist;
    }
}
