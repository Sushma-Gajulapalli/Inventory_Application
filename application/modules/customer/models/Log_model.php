<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Log_model extends CI_Model {

  	public function __construct()
    {
        parent::__construct();
        $this->backdb = $this->load->database('back_db', TRUE);
    }


    //get active customer 
    public function InsertLog($data){

        $this->backdb->insert('ss_customer_log',$data);
    }

}
?>