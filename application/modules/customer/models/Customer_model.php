<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();

        //load our second backdb and put in $db2
        $this->backdb = $this->load->database('back_db', TRUE);
    }

     // new Code Start Here
    public function getquotRecord($table_name,$id){
        $this->backdb->select('*');
        $this->backdb->from($table_name);
        $this->backdb->where('quotation_id',$id);
        $query=$this->backdb->get();
        $data=$query->result();
        return $data;
    }

      public function getcustRecord($table_name,$id){
        $this->backdb->select('*');
        $this->backdb->from($table_name);
        $this->backdb->where('customer_id',$id);
        $query=$this->backdb->get();
        $data=$query->result();
        return $data;
    }


    public function payment_quotation_list($where=null){

        $this->backdb->select('quotation_id,total_storage_charges,extra_item_storage_charges,item_reduced_charges,extra_item_transport_charges_gst,extra_item_transport_charges,extra_item_stack_charges_gst,extra_item_stack_charges,storage_coupen,storage_multi_factor');
        $this->backdb->from('ss_customer_quotation');
        if(!empty($where)){

            $this->backdb->where($where);
        }
        $query = $this->backdb->get();
        return $query->result();
    }

      public function get_order_data($where=null){

        $this->backdb->select('order_id,order_sub_type,order_status');
        $this->backdb->from('ss_order');
        if(!empty($where)){

            $this->backdb->where($where);
        }

        $this->backdb->order_by('order_id desc');
        $query = $this->backdb->get();
        return $query->row();
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

    
    public function getitem_qRecord($table_name,$c,$q){
        $this->backdb->select('*');
        $this->backdb->from($table_name);
        $this->backdb->where('customer_id',$c);
        $this->backdb->where('quotation_id',$q);
        $query=$this->backdb->get();
        $data=$query->result();
        return $data;
    }

    


    // new Code Start Here
    public function getsettingRecord($table_name){
        $this->backdb->select('*');
        $this->backdb->from($table_name);
        $query=$this->backdb->get();
        $data=$query->result();
        return $data;
    }


    // new Code Start Here
    public function getdayRecord($table_name,$day){
        $this->backdb->select('*');
        $this->backdb->from($table_name);
        $this->backdb->where('day',$day);
        $query=$this->backdb->get();
        $data=$query->result();
        return $data;
    }



    // code End

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
        return $query->num_rows();

    }


    public function addRecord($table_name,$data){

        $query=$this->backdb->insert($table_name, $data);
        $latest_id = $this->backdb->insert_id();
        return $latest_id;
    }

     public function getoneRecord($table_name,$id){

        $this->backdb->select('*');
        $this->backdb->from($table_name);
        $this->backdb->where('storage_item_id',$id);
        $query=$this->backdb->get();
        $data=$query->result();
        return $data;

       
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
       // $this->backdb->from('ss_storage_item');
        $this->backdb->from('ss_refined_storage_item');
        if(!empty($where)){

             $this->backdb->where($where);
        }
        $this->backdb->where('status','0');
        $this->backdb->order_by('(storage_item_hometype * -1)',"DESC");
        $query=$this->backdb->get();
        $data=$query->result();
        return $data;
    }

     public function get_storage_type_list($where=null,$order_by=null){

        $this->backdb->select('*');
        $this->backdb->from('ss_storage_type');
        if(!empty($where)){

            $this->backdb->where($where);
        }
        if(!empty($order_by)){

             $this->backdb->order_by($order_by);
        }
        $query = $this->backdb->get();
        return $query->result();
    }

    public function get_item_list($keyword){


        

        //ss_storage_item

        $sql ="SELECT * FROM ss_refined_storage_item WHERE (storage_item_type like '%".$keyword."%' OR storage_item_name like '%".$keyword."%') AND status='0' ORDER BY storage_item_type LIMIT 0,12";
        $query = $this->backdb->query($sql);
        return $query->result_array();
    }

     /*for get vehicle as per pallet */

    public function getOrderByLimitSingleRecord($table_name,$where,$order_by=null){

        $this->backdb->select('*');
        $this->backdb->from($table_name);
        if(!empty($where)){

             $this->backdb->where($where);
        }
        if(!empty($order_by)){

             $this->backdb->order_by($order_by);
        }
        $this->backdb->limit(1);
        $query=$this->backdb->get();
        return $query->row();
    }


    private function _get_document_quotation_query($where)
    {
        $order = array('document_quotation_id' => 'desc');
        $column_order = array(
            'ss_document_quotations.document_quotation_id',
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null
            );

        $column_search = array();

        $this->backdb->from('ss_document_quotations');
        if(!empty($where)){

            $this->backdb->where($where);
        }

        $i = 0;

        foreach($column_search as $item){

            if($_POST['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->backdb->group_start();
                    $this->backdb->like($item, $_POST['search']['value']);
                }else{
                    $this->backdb->or_like($item, $_POST['search']['value']);
                }

                // last loop
                if(count($column_search) - 1 == $i){
                    // close bracket
                    $this->backdb->group_end();
                }
            }

            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->backdb->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($order))
        {

            $this->backdb->order_by(key($order), $order[key($order)]);
        }
    }

    function get_document_quotation_datatable_list($where = null)
    {
        $this->_get_document_quotation_query($where);

        if(isset($_POST['length']) && $_POST['length'] < 1) {
            $_POST['length']= '10';
        }else
        $_POST['length']= $_POST['length'];

        if(isset($_POST['start']) && $_POST['start'] > 1) {
            $_POST['start']= $_POST['start'];
        }
        $this->backdb->limit($_POST['length'], $_POST['start']);
        $query = $this->backdb->get();
        return $query->result();
    }

    function document_quotation_count_filtered($where = null)
    {
        $this->_get_document_quotation_query($where);
        $query = $this->backdb->get();
        return $query->num_rows();
    }

    public function document_quotation_count_all()
    {
        $this->backdb->from('ss_document_quotations');
        return $this->backdb->count_all_results();
    }

    public function common_qoutation_data($where=null)
    {
        
    }

    /*for get invoice no*/

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

    public function genrate_invoice_no($last_invoice_no=null,$customer_local_city=null){

        $where= array('customer_local_city' => $customer_local_city);

        /*get last integer part from invoce no.*/
        $input_str = $last_invoice_no;
        preg_match_all('!\d+!', $input_str, $matches);
        $only_digit = end($matches[0]);
        /*count*/
        $next_count = ($only_digit + 1);
         $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';


       /* $string .= date('dHs');

        if($exists != null || strlen($only_digit) > 5){
            $result = substr($only_digit, 5);
            
            $next_count = $result.''.$string;
        }else
        {
            $next_count = ($string + 1);
        }*/

         for ($i = 0; $i < 2; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
       
        // if($exists != null || strlen($only_digit) > 5){
        //   $result = substr($only_digit, 0, 1);
            
        //     $next_count = $result.''. date('dHs');
        // }else
        // {
        //       $next_count = ($only_digit + 1);
        // } 
        
        /*echo $input_str.'  '.$next_count; die();*/
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
        if($where['customer_local_city'] =='delhi'){

            $invoice_no .="DEL".$monthName.sprintf('%05d',@$next_count);
        }  
         

        // if($where['customer_local_city'] =='bangalore'){

        //     $invoice_no .="BLRS".sprintf('%05d',@$next_count);

        // }if($where['customer_local_city'] =='hyderabad'){

        //     $invoice_no .="HYDS".sprintf('%05d',@$next_count);

        // }if($where['customer_local_city'] =='chennai'){

        //     $invoice_no .="CHES".sprintf('%05d',@$next_count);

        // }if($where['customer_local_city'] =='pune'){

        //     $invoice_no .="PUNS".sprintf('%05d',@$next_count);
            
        // }if($where['customer_local_city'] =='mumbai'){

        //     $invoice_no .="MBIS".sprintf('%05d',@$next_count);
        // }   

        return $invoice_no;   
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

    /*end invoice no*/

     /*for date restriction*/

    public function get_time_slot_list($where){

        $this->backdb->select('ss_config_timeslot.*,ss_config_timeslot_info.*');
        $this->backdb->from('ss_config_timeslot');
        $this->backdb->join('ss_config_timeslot_info','ss_config_timeslot.slot_id=ss_config_timeslot_info.slot_id','left');
       
        if(!empty($where)){
            $this->backdb->where($where);
        }

        $this->backdb->where('ss_config_timeslot.status','0');
        $query=$this->backdb->get();
        $data=$query->result();
        return $data;    
    }


    public function get_date_time_slot_list($where){

        $this->backdb->select('ss_date_timeslot_info.*');
        $this->backdb->from('ss_date_timeslot_info');
        $this->backdb->join('ss_config_timeslot','ss_config_timeslot.slot_id=ss_date_timeslot_info.slot_id','left');
       
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $query=$this->backdb->get();
        $data=$query->result();
        return $data;    
    }

    public function get_holiday_list($where){

        $this->backdb->select('date');
        $this->backdb->from('ss_date_timeslot');
       
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $query=$this->backdb->get();
        $data=$query->result();
        return $data;    
    }


    public function get_booked_order_count($where){

        $this->backdb->select('ss_order.*');
        $this->backdb->from('ss_order');
        $this->backdb->join('ss_customer','ss_order.customer_id=ss_customer.customer_id','left');
        $this->backdb->where($where);
        $query=$this->backdb->get();
        return $query->result();
    }
    /*end date restriction*/
    
    public function get_escalation_matrix_user($where){

        $this->backdb->select('ss_crm_user_level.level_slug,ss_user.user_fname,ss_user.user_lname,ss_user.user_lname,ss_user.user_contact1,');
        $this->backdb->from('ss_crm_user_level');
        $this->backdb->join('ss_user','ss_crm_user_level.level_user_id = ss_user.user_id','left');
        $this->backdb->where($where);
        $query=$this->backdb->get();
        return $query->result();
    }

    public function get_customer_due($where){

        $this->backdb->select('SUM(payable_amount) as total_amount');
        $this->backdb->from('ss_customer_payment');
        $this->backdb->where($where);
        $this->backdb->where('payment_status','Unpaid');
        $query=$this->backdb->get();
        return $query->row();
    }
}
