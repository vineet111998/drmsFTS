<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
use \DrewM\MailChimp\MailChimp;
use \DrewM\MailChimp\Batch;

/**
 *
 */
class Mail_chimp {
  private $mc;
  private $bt;
  public $apiKey = '24e8eb48823ac96a282ed3f3c81df966-us19';

  public function __construct() {
    $this->mc = new MailChimp($this->apiKey);
  }

  public function getLists() {
    // return "hello";
    $res = $this->mc->get('lists');
    return $res;
  }

  public function createList($listName) {
    $result = $this->mc->post("lists", array (
      'name' => $listName,
      'contact' => array (
        'company' => 'Ekal DRMS',
        'address1' => 'Delhi',
        'address2' => '',
        'city' => 'Delhi',
        'state' => 'Delhi',
        'zip' => '30308',
        'country' => 'IN',
        'phone' => '',
      ),
      'permission_reminder' => 'You are receiving this email because you have been subscribed as Ekal Donor',
      'campaign_defaults' => array (
        'from_name' => 'Ekal DRMS',
        'from_email' => 'no-reply@ekaldrms.org',
        'subject' => 'Seasonal Greetings',
        'language' => 'en',
      ),
      'email_type_option' => true,
    ));
    // echo "<pre>";
    // print_r($result);
    if($this->mc->success()) {
      return $result["id"];
    } else {
      return 0;
    }
  }

  public function subscribe($list_id, $email, $fname, $lname) {
    $result = $this->mc->post("lists/$list_id/members", array (
      'email_address' => $email,
      'status' => 'subscribed',
      'merge_fields' => array('FNAME'=> $fname, 'LNAME'=> $lname)
    ));
    if($this->mc->success()) {
      return $result["id"];
    } else {
      return 0;
    }
  }

  public function deleteList($list_id) {
    $result = $this->mc->delete("lists/".$list_id);
    return $result;
  }

  public function subscribeBatchReady($list_id, $operationSeq, $email, $fname, $lname) {
    $bt = $this->mc->new_batch();
    $this->bt->post("op".$operationSeq, "lists/$list_id/members", array (
      'email_address' => $email,
      'status' => 'subscribed',
      'merge_fields' => array('FNAME'=> $fname, 'LNAME'=> $lname)
    ));
  }
  public function subscribeBatch() {
    
  }

}
