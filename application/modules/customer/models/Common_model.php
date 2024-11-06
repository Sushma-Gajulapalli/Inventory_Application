<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Common_model extends CI_Model {

  	public function __construct()
    {
        parent::__construct();
         $this->backdb = $this->load->database('back_db', TRUE);
    }

    public function getSingleRecord($table_name,$where){

	    $this->backdb->select('*');
	    $this->backdb->from($table_name);
	    if(!empty($where)){

	    	 $this->backdb->where($where);
	    }
	   
	    $query=$this->backdb->get();
	    $data=$query->row();
	    return $data;    
	}

	public function getRowCount($table_name,$where){

	    $this->backdb->select('*');
	    $this->backdb->from($table_name);
	    $this->backdb->where($where);
	    $query=$this->backdb->get();
	    $data=$query->num_rows();
	    return $data;    
	}

    
	public function addRecord($table_name,$data){

		$query=$this->backdb->insert($table_name, $data);
	    $latest_id = $this->backdb->insert_id();
		return $latest_id;
	}

	public function updateRecord($table,$data,$where){

	    $this->backdb->where($where);
	    $this->backdb->update($table,$data);
		$row = $this->backdb->affected_rows();
	    return $row;
	}

	public function deleteRecord($table, $where){
        $this->backdb->where($where);
        $this->backdb->delete($table);   
    }

    public function getAllRecord($table_name,$where,$order_by=null){

	    $this->backdb->select('*');
	    $this->backdb->from($table_name);
	    if(!empty($where)){

	    	 $this->backdb->where($where);
	    }
	   	if(!empty($order_by)){

	    	 $this->backdb->order_by($order_by);
	    }	
	    
	    $query=$this->backdb->get();
	    $data=$query->result();
	    return $data;    
	}
	
	public function getAllGroupByRecord($table_name,$where,$group_by){

	    $this->backdb->select('*');
	    $this->backdb->from($table_name);
	    if(!empty($where)){

	    	 $this->backdb->where($where);
	    }
	   	if(!empty($group_by)){

	    	 $this->backdb->group_by($group_by);
	    }	
	    $query=$this->backdb->get();
	    $data=$query->result();
	    return $data;    
	}
	
	public function getOrderBySingleRecord($table_name,$where,$order_by=null){

	    $this->backdb->select('*');
	    $this->backdb->from($table_name);
	    if(!empty($where)){

	    	 $this->backdb->where($where);
	    }
	   	if(!empty($order_by)){

	    	 $this->backdb->order_by($order_by);
	    }	
	    $query=$this->backdb->get();
	    return $query->row();
	}	

	public function get_storage_item($where){

		$this->backdb->select('*');
	    $this->backdb->from('ss_storage_item');
	    if(!empty($where)){

	    	 $this->backdb->where($where);
	    }
	   	$this->backdb->order_by('(storage_item_order * -1)',"DESC");
	    $query=$this->backdb->get();
	    $data=$query->result();
	    return $data;    
	}

	public function get_invoice_no($where){

		$this->backdb->select('ss_customer_transaction.invoice_no,ss_customer.customer_id');
	    $this->backdb->from('ss_customer_transaction');
	    $this->backdb->join('ss_customer','ss_customer_transaction.customer_id = ss_customer.customer_id','left');

	    if(!empty($where)){

			$this->backdb->where($where);
	    }

	    $new_where = "invoice_no !=''";
		$this->backdb->where($new_where);

	    $this->backdb->order_by('cust_transaction_id desc');
	    $query=$this->backdb->get();
	    $data=$query->row();

	   	$new_invoice_no =$this->genrate_invoice_no($data->invoice_no,$where['customer_local_city']);
		return $new_invoice_no;
	}

	public function genrate_invoice_no($last_invoice_no=null,$customer_local_city=null,$exists=null){

		$where= array('customer_local_city' => $customer_local_city);

		/*get last integer part from invoce no.*/
	    $input_str = $last_invoice_no;
		preg_match_all('!\d+!', $input_str, $matches);
		$only_digit = end($matches[0]);
		//print_r(strlen($only_digit));die();
		/*count*/
		$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$string = '';

	   for ($i = 0; $i < 2; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
       
        if($exists != null || strlen($only_digit) > 5){
           $result = substr($only_digit, 0, 1);
            
            $next_count = $result.''. date('dHs');
        }else
        {
              $next_count = ($only_digit + 1);
        } 

		//$next_count = ($only_digit + 1);
	   	
	  /* 	 $string .= date('dHs');

        if($exists != null || strlen($only_digit) > 5){
            $result = substr($only_digit, 5);
            
            $next_count = $result.''.$string;
        }else
        {
            $next_count = ($string + 1);
        }*/
	    
	 	 // echo $input_str.'  '.$next_count; die();
		/*next year month*/
	    $y=date('y');
		$m=date('m');
		$cy;
		$ny;
		if($m<4)
		{
		 $cy=$y-1;
		 $ny=$y;
		}
		else
		{
		 $cy=$y;
		 $ny=$y+1;
		}

		$invoice_no ="SS".$cy;	

		/*for auto reset count @financial year start */

		$day    = 01;
        $month  = 04;

		if($day == date('d')  && $month == date('m')){

			$reset_data = array();

			$input_date = date('Y')."-04-01";
			$city_where = array(
				'city' => $where['customer_local_city'],
				'DATE(reset_date)' => $input_date
			);

			$this->backdb->select('reset_date');
		    $this->backdb->from('ss_invoice_reset');
		    $this->backdb->where($city_where);
		    $r_query=$this->backdb->get();
		    $reset_data=$r_query->row();

		    if(empty($reset_data)){

		    	$next_count = 1;

		    	$reset_row = array(
		    		'reset_date' => $input_date,
		    		'city' => $where['customer_local_city']
		    	); 
				$this->backdb->insert('ss_invoice_reset', $reset_row);
		    }
		}

		/*end financial year count reset*/

		if($where['customer_local_city'] =='bangalore'){

	        $invoice_no .="BLRS".sprintf('%05d',@$next_count);

	    }if($where['customer_local_city'] =='hyderabad'){

	        $invoice_no .="HYDS".sprintf('%05d',@$next_count);

	    }if($where['customer_local_city'] =='chennai'){

	        $invoice_no .="CHES".sprintf('%05d',@$next_count);

	    }if($where['customer_local_city'] =='pune'){

	        $invoice_no .="PUNS".sprintf('%05d',@$next_count);

	    }if($where['customer_local_city'] =='mumbai'){

	        $invoice_no .="MBIS".sprintf('%05d',@$next_count);
	    }
	    if($where['customer_local_city']=='delhi'){
	        $invoice_no.="DLIS".sprintf('%05d',@$next_count);
	    }  


	    

	    return $invoice_no;   
	}

public function genrate_invoice_no_request($last_invoice_no=null,$customer_local_city=null,$exists=null){

		$where= array('customer_local_city' => $customer_local_city);

		/*get last integer part from invoce no.*/
	    $input_str = $last_invoice_no;

		preg_match_all('!\d+!', $input_str, $matches);
		$only_digit = end($matches[0]);
		 
		/*count*/
		$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$string = '';

	    for ($i = 0; $i < 2; $i++) {
	        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
	    }
	   
	     
	    	  $next_count = ($only_digit + 1);
	     
		 
	   
	 	 // echo $input_str.'  '.$next_count; die();
		/*next year month*/
	    $y=date('y');
		$m=date('m');
		$cy;
		$ny;
		if($m<4)
		{
		 $cy=$y-1;
		 $ny=$y;
		}
		else
		{
		 $cy=$y;
		 $ny=$y+1;
		}

		$invoice_no ="SS".$cy;	

		/*for auto reset count @financial year start */

		$day    = 01;
        $month  = 04;

		if($day == date('d')  && $month == date('m')){

			$reset_data = array();

			$input_date = date('Y')."-04-01";
			$city_where = array(
				'city' => $where['customer_local_city'],
				'DATE(reset_date)' => $input_date
			);

			$this->db->select('reset_date');
		    $this->db->from('ss_invoice_reset');
		    $this->db->where($city_where);
		    $r_query=$this->db->get();
		    $reset_data=$r_query->row();

		    if(empty($reset_data)){

		    	$next_count = 1;

		    	$reset_row = array(
		    		'reset_date' => $input_date,
		    		'city' => $where['customer_local_city']
		    	); 
				$this->db->insert('ss_invoice_reset', $reset_row);
		    }
		}
		$monthName = date('F', mktime(0, 0, 0, date('m'), 10));
		$monthName = substr($monthName, 0, 3);
		$monthName = strtoupper($monthName);
		/*end financial year count reset*/

		if($where['customer_local_city'] =='bangalore'){

	        $invoice_no .="BLR".$monthName.sprintf('%05d',@$next_count);

	    }if($where['customer_local_city'] =='hyderabad'){

	        $invoice_no .="HYD".$monthName.sprintf('%05d',@$next_count);

	    }if($where['customer_local_city'] =='chennai'){

	        $invoice_no .="CHE".$monthName.sprintf('%05d',@$next_count);

	    }if($where['customer_local_city'] =='pune'){

	        $invoice_no .="PUN".$monthName.sprintf('%05d',@$next_count);

	    }if($where['customer_local_city'] =='mumbai'){

	        $invoice_no .="MBI".$monthName.sprintf('%05d',@$next_count);
	    }  

	    return $invoice_no;   
	}

		public function check_exist_invoice_request($where){

		$this->db->select('*');
	    $this->db->from('ss_invoices_tbl');
	    if(!empty($where)){

			$this->db->where($where);
	    }

	    $query=$this->db->get();
	    $data=$query->result();
        return $data;
	}
	
	public function check_exist_invoice($where){

		$this->backdb->select('invoice_no');
	    $this->backdb->from('ss_customer_transaction');
	    if(!empty($where)){

			$this->backdb->where($where);
	    }

	    $query=$this->backdb->get();
	    return $query->row();
	}

	/*for hometype item*/

	public function get_home_storage_item($where){

        $this->backdb->select('*');
        $this->backdb->from('ss_storage_item');
        if(!empty($where)){

             $this->backdb->where($where);
        }
        $this->backdb->where('status','0');
        $this->backdb->order_by('(storage_item_hometype * -1)',"DESC");
        $query=$this->backdb->get();
        $data=$query->result();
        return $data;
    }

    public function get_escalation_matrix_user($where){

    	$this->backdb->select('ss_crm_user_level.level_slug,ss_user.user_fname,ss_user.user_lname,ss_user.user_lname,ss_user.user_contact1,');
        $this->backdb->from('ss_crm_user_level');
        $this->backdb->join('ss_user','ss_crm_user_level.level_user_id = ss_user.user_id','left');
        $this->backdb->where($where);
        $query=$this->backdb->get();
        return $query->result();	
    }

    public function addTransaction($table_name,$data){

    	$this->backdb->backdb_debug = false;
		$query=$this->backdb->insert($table_name, $data);
		$latest_id = $this->backdb->insert_id();
		return $latest_id;
	}


	
     public function fetch_due_amount($where){
                $this->db->select('SUM(payable_amount) AS total_due');
                $this->db->from('ss_customer_payment');
                if(!empty($where)){
                $this->db->where($where);
                }
                $this->db->where('ss_customer_payment.payment_status','Unpaid'); 
                $query=$this->db->get();
                return $query->result();
           }

}
?>