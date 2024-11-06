<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Cron_model extends CI_Model {

  	public function __construct()
    {
        parent::__construct();
        $this->backdb = $this->load->database('back_db', TRUE);
    }


    //get active customer
    public function get_active_customer($where){

		$this->backdb->select('ss_customer.customer_id,payment_type,payment_plan,is_zoho_customer,next_bill_date,ss_free_month_duration.offer_end_date,offer_start_date,ss_customer.six_month_discount,ss_customer.yearly_discount');
	    $this->backdb->from('ss_customer');
        $this->backdb->join('ss_free_month_duration','ss_customer.customer_id =ss_free_month_duration.customer_id','left');
	    if(!empty($where)){
			$this->backdb->where($where);
	    }

        $condition = "(ss_customer.status='0' AND ss_customer.is_active_reminder='0') AND is_customer='1'";

        $this->backdb->where($condition);
        /*$this->backdb->where('ss_customer.is_active_reminder','0');
	    $this->backdb->where('is_customer','1');   */
	   	$query=$this->backdb->get();
	    return $query->result();

    }


    public function get_active_customer_15_days($where){

		$this->backdb->select('ss_customer.customer_id,payment_type,payment_plan,is_zoho_customer,next_bill_date,ss_free_month_duration.offer_end_date,offer_start_date,ss_customer.six_month_discount,ss_customer.yearly_discount');
	    $this->backdb->from('ss_customer');
        $this->backdb->join('ss_free_month_duration','ss_customer.customer_id =ss_free_month_duration.customer_id','left');
	    if(!empty($where)){
			$this->backdb->where($where);
	    }

        $condition = "(ss_customer.status='0' AND ss_customer.is_active_reminder='0') AND is_customer='1'";

        $this->backdb->where($condition);
        /*$this->backdb->where('ss_customer.is_active_reminder','0');
	    $this->backdb->where('is_customer','1');   */
	   	$query=$this->backdb->get();
	      return $query->row();

    }



    public function get_active_quotation($where){
//print_r($where);die();
        $this->backdb->select('ss_order.quotation_id,ss_order.order_schedule_date,ss_order.order_type,ss_customer_quotation.total_storage_charges,ss_customer_quotation.extra_item_storage_charges,ss_customer_quotation.extra_item_transport_charges,ss_customer_quotation.extra_item_stack_charges,ss_customer_quotation.item_reduced_charges,ss_customer_quotation.extra_item_transport_charges_gst, ss_customer_quotation.extra_item_stack_charges_gst,ss_customer_quotation.storage_coupen,ss_customer_quotation.storage_multi_factor');
        $this->backdb->from('ss_order');
        $this->backdb->join('ss_customer_quotation','ss_order.quotation_id =ss_customer_quotation.quotation_id','left');
        if(!empty($where)){

            $this->backdb->where($where);
        }
        $this->backdb->where('ss_order.order_status','completed');
        $this->backdb->where('ss_order.order_type','pickup');
        $this->backdb->where('ss_customer_quotation.is_available','no');
        $this->backdb->where('ss_customer_quotation.is_full_retrieved','0');
        /*$this->backdb->order_by('ss_customer_quotation.quotation_id','ASC'); */
        $this->backdb->order_by('ss_order.order_id','DESC');
        // $this->backdb->last_query(); die();
        $query=$this->backdb->get();

        return $query->result();

    }

    public function get_total_bill_count($where)
    {
        $this->backdb->select('payment_id');
        $this->backdb->from('ss_customer_payment');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $query=$this->backdb->get();
        return $query->num_rows();
    }

    public function get_last_bill($where){

        $this->backdb->select('*');
        $this->backdb->from('ss_customer_payment');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $this->backdb->order_by('payment_id','desc');
        $this->backdb->limit(1);
        $query=$this->backdb->get();
        return $query->row();

    }

    public function get_single_record($table,$where,$order_by=null){

        $this->backdb->select('*');
        $this->backdb->from($table);
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

    public function check_offer($where,$order_by=null){

        $this->backdb->select('*');
        $this->backdb->from('ss_customer_payment_offer');
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

    /*
    **
    for send payment reminder
    **
    */

    public function send_payment_reminder($where){

        $this->backdb->select('ss_customer_payment.customer_id,ss_customer.customer_initial,ss_customer.customer_name,ss_customer.customer_email,ss_customer.customer_unique_id,SUM(payable_amount) AS total_due,ss_user.user_id');
        $this->backdb->from('ss_customer_payment');
        $this->backdb->join('ss_customer','ss_customer_payment.customer_id =ss_customer.customer_id','left');
        $this->backdb->join('ss_user','ss_customer_payment.customer_id =ss_user.customer_id','left');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $this->backdb->where('ss_customer_payment.payment_status','Unpaid');
        $this->backdb->where('ss_customer.is_active_reminder','0');
        $this->backdb->where('ss_customer.is_zoho_customer','0');
        $this->backdb->group_by('ss_customer_payment.customer_id');
        $query=$this->backdb->get();
        return $query->result();
    }

     /*for check order is completed for payment reminder*/

    public function get_completed_order_row($where){

        $this->backdb->select('ss_order.order_id');
        $this->backdb->from('ss_order');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $this->backdb->where('ss_order.order_type','pickup');
        $this->backdb->where('ss_order.order_status','completed');
        $query=$this->backdb->get();
        return $query->row();
    }
    /*end*/

    public function reminder_billing_date($where){

        $this->backdb->select('ss_customer_payment.billing_date');
        $this->backdb->from('ss_customer_payment');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $this->backdb->order_by('payment_id','desc');
        $query=$this->backdb->get();
        return $query->row();
    }

    /*for get active customer with welcome status*/
      public function get_active_welcome_customer($where){

        $this->backdb->select('ss_order.*');
        $this->backdb->from('ss_order');
        $this->backdb->join('ss_customer','ss_order.customer_id =ss_customer.customer_id','left');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $this->backdb->where('ss_customer.is_customer','1');
        $this->backdb->where('ss_order.order_status','welcome');
        $query=$this->backdb->get();
        return $query->result();

    }


    /*vendor weekly payment*/

    public function get_vendor_order_list($where){

        $this->backdb->select('ss_order.order_id,ss_order.vt_id,ss_order.ss_commission_percent,ss_order.order_type,ss_order.transport_charges,ss_order.customer_id,ss_order.order_status,ss_order.order_schedule_date,ss_customer_quotation.total_pickup_charges_with_gst,ss_customer_quotation.total_pickup_charges,ss_customer_quotation.extra_item_transport_charges,ss_customer_quotation.transport_token_amt');
        $this->backdb->from('ss_order');
        $this->backdb->join('ss_customer_quotation','ss_customer_quotation.quotation_id=ss_order.quotation_id','left');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $this->backdb->where('ss_order.order_sub_type','vendor_transport');
        $where = "ss_order.order_status In('completed','stacking')";
        $this->backdb->where($where);
        $this->backdb->order_by('ss_order.order_schedule_date ASC');
        $query=$this->backdb->get();
        return $query->result();
    }

    /*get vendor payment last date*/

    public function get_vendor_payment_bill($where){

        $sql ="SELECT max(end_date) as end_date FROM ss_vendor_invoices ORDER BY invoice_id DESC";
        $query= $this->backdb->query($sql);
        return $query->row();
    }


    /*check any request for full retrieval order*/

    public function get_retrieval_row($where){

        $this->backdb->select('ss_order.order_id');
        $this->backdb->from('ss_order');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $this->backdb->where('ss_order.order_type','full_retrieval');
        $this->backdb->order_by('order_id DESC');
        $query=$this->backdb->get();
        return $query->row();
    }

    /*get date timeslot list*/

    public function get_date_timslot($where){

        $this->backdb->select('*');
        $this->backdb->from('ss_date_timeslot');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $query=$this->backdb->get();
        return $query->result();
    }

    /*for testing purpose*/

    public function get_invoice_no_customers($where){

        $this->backdb->select('ss_customer_transaction.cust_transaction_id,ss_customer_transaction.customer_id,ss_customer.customer_local_city,transaction_created_at');
        $this->backdb->from('ss_customer_transaction');
        $this->backdb->join('ss_customer','ss_customer_transaction.customer_id = ss_customer.customer_id','left');

        if(!empty($where)){

            $this->backdb->where($where);
        }
        $this->backdb->order_by('cust_transaction_id ASC');
        $query=$this->backdb->get();
        return $query->result();
    }

     public function get_invoice_no_customers_order_by($where){

        $this->backdb->select('ss_customer_transaction.cust_transaction_id,ss_customer_transaction.customer_id,ss_customer.customer_local_city');
        $this->backdb->from('ss_customer_transaction');
        $this->backdb->join('ss_customer','ss_customer_transaction.customer_id = ss_customer.customer_id','left');

        if(!empty($where)){

            $this->backdb->where($where);
        }
        $this->backdb->order_by('cust_transaction_id desc');
        $query=$this->backdb->get();
        return $query->row();
    }

    public function get_invoice_no_per_entry($where){

        $this->backdb->select('COUNT(cust_transaction_id) as total_count');
        $this->backdb->from('ss_customer_transaction');
        $this->backdb->join('ss_customer','ss_customer_transaction.customer_id = ss_customer.customer_id','left');

        if(!empty($where)){

            $this->backdb->where($where);
        }
        $this->backdb->order_by('cust_transaction_id ASC');
        $query=$this->backdb->get();
        $data=$query->row();
        return $data;
    }



    /*
    *******************for send subscription link********************
    */

    public function get_customer_for_subscription($where){

        $this->backdb->select('count(ss_customer_payment.payment_id) as total_count,ss_customer_payment.customer_id');
        $this->backdb->from('ss_customer_payment');

        $where_cond = "ss_customer_payment.customer_id NOT IN (select customer_id from ss_cashfree_subscription)";

        $this->backdb->where($where_cond,null,FALSE);

        if(!empty($where)){

            $this->backdb->where($where);
        }

        $this->backdb->group_by('customer_id');
        $this->backdb->order_by('payment_id', 'desc');
        $query= $this->backdb->get();
        return $query->result();
    }

    public function get_customer_payment_row($where){

        $this->backdb->select('total_amount,billing_date');
        if(!empty($where)){

            $this->backdb->where($where);
        }
        $this->backdb->order_by('payment_id', 'desc');
        $query= $this->backdb->get('ss_customer_payment');
        return $query->row();
    }

    public function get_customer_row($where){

        $this->backdb->select('customer_id,customer_unique_id,customer_name,customer_email,customer_contact1');
        $this->backdb->from('ss_customer');
        if(!empty($where)){
            $this->backdb->where($where);
        }

        $condition = "(ss_customer.status='0' AND ss_customer.is_active_reminder='0') AND is_customer='1'";

        $this->backdb->where($condition);

        $query=$this->backdb->get();
        return $query->row();
    }

    public function is_exist_subscription($where){
        $this->backdb->select('csf_sub_id');
        if(!empty($where)){

            $this->backdb->where($where);
        }
        $query= $this->backdb->get('ss_cashfree_subscription');
        return $query->row();
    }

    /*for get total_subscription count for chunk*/
    public function cf_subscription_count($where){

        $this->backdb->select('csf_sub_id');
        if(!empty($where)){

            $this->backdb->where($where);
        }
        $query= $this->backdb->get('ss_cashfree_subscription');
        return $query->num_rows();
    }
    /*for get chunk subscription customer */
    public function cf_subscription_list_limit($where,$start,$limit){

        $this->backdb->select('customer_id,subReferenceId,payment_type,subscriptionId');
        $this->backdb->from('ss_cashfree_subscription');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $this->backdb->order_by('csf_sub_id ASC');
        $this->backdb->limit($limit, $start);
        $query=$this->backdb->get();
        return $query->result_array();
    }

     /*for correct invoice no*/

    public function get_customers_per_city($where){

        $this->backdb->select('transaction_order_id,ss_customer_transaction.invoice_no,ss_customer_transaction.customer_id,ss_customer_transaction.cust_transaction_id');
        $this->backdb->from('ss_customer_transaction');
        $this->backdb->join('ss_customer','ss_customer_transaction.customer_id = ss_customer.customer_id','left');

        if(!empty($where)){

            $this->backdb->where($where);
        }
        $this->backdb->order_by('cust_transaction_id ASC');
        $query=$this->backdb->get();
        $data=$query->result();
        return $data;
    }


    public function get_last_row($where){

        $this->backdb->select('invoice_no');
        $this->backdb->from('ss_customer_transaction');
        $this->backdb->join('ss_customer','ss_customer_transaction.customer_id = ss_customer.customer_id','left');

        if(!empty($where)){

            $this->backdb->where($where);
        }
        $this->backdb->order_by('cust_transaction_id ASC');
        $query=$this->backdb->get();
        $data=$query->row();
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

        /*get last integer part from invoce no.*/
        $input_str = $data->invoice_no;
        preg_match_all('!\d+!', $input_str, $matches);
        $only_digit = end($matches[0]);
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


         /*$string .= date('dHs');

        if($exists != null || strlen($only_digit) > 5){
            $result = substr($only_digit, 5);
            
            $next_count = $result.''.$string;
        }else
        {
            $next_count = ($string + 1);
        }*/

        
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

        if($where['customer_local_city'] =='bangalore'){

            $invoice_no .="BLRS".sprintf('%05d',@$next_count);

        }if($where['customer_local_city'] =='hyderabad'){

            $invoice_no .="HYDS".sprintf('%05d',@$next_count);

        }if($where['customer_local_city'] =='chennai'){

            $invoice_no .="CHES".sprintf('%05d',@$next_count);

        }if($where['customer_local_city'] =='pune'){

            $invoice_no .="PUNS".sprintf('%05d',@$next_count);
        }

        return $invoice_no;
    }

    /*paytm cronjob fun*/

    public function get_failed_transaction($where){

        $this->backdb->select('ORDERID');
        $this->backdb->from('ss_failed_transaction_log');

        if(!empty($where)){

            $this->backdb->where($where);
        }
        $query=$this->backdb->get();
        return $query->row();
    }


    public function get_payment_req_list($where){

        $this->backdb->select('ss_payment_request.*,ss_customer.customer_unique_id');
        $this->backdb->from('ss_payment_request');
        $this->backdb->join('ss_customer','ss_payment_request.customer_id = ss_customer.customer_id','left');
        if(!empty($where)){

            $this->backdb->where($where);
        }
        $this->backdb->order_by('ss_payment_request.request_id asc');
        $query=$this->backdb->get();
        return $query->result();
    }

    public function check_transaction($where){

        $this->backdb->select('transaction_order_id');
        $this->backdb->from('ss_customer_transaction');

        if(!empty($where)){

            $this->backdb->where($where);
        }
        $query=$this->backdb->get();
        return $query->row();
    }


    /*end paytm cronjob*/

    public function  test_booked_orders(){

        $SQL="SELECT ss_customer.customer_email,total_pickup_charges as pickup_charges,transport_cost,labour_cost,item_packing_charges,extra_km_charges,lift_cost,total_storage_charges_with_gst,transport_coupon,storage_coupen,transport_type FROM `ss_order` LEFT JOIN ss_customer_quotation ON ss_order.quotation_id = ss_customer_quotation.quotation_id LEFT JOIN ss_customer ON ss_order.customer_id = ss_customer.customer_id WHERE (DATE(ss_order.order_created_at) >= '2021-06-23' AND DATE(ss_order.order_created_at) <= '2021-06-23')  AND  DATE(ss_customer_quotation.created_at) ='2021-06-23'";

        $query = $this->backdb->query($SQL);
        return $query->result();
    }


    /*for only one time fix_transaction_with_pickup_order_id */

    public function fix_transaction_with_pickup_order_id($where)
    {
        $this->backdb->select('order_id,customer_id,order_status');
        $this->backdb->from('ss_order');

        if(!empty($where)){

            $this->backdb->where($where);
        }

        $str = "order_status ='pending' AND order_type='pickup'";

        $this->backdb->where($str);

        $query=$this->backdb->get();
        return $query->result();
    }

    public function get_single_transaction_for_pickup_order($where)
    {
        $this->backdb->select('cust_transaction_id,transaction_type');
        $this->backdb->from('ss_customer_transaction');

        if(!empty($where)){

            $this->backdb->where($where);
        }

        $query=$this->backdb->get();
        return $query->row();
    }

    public function set_old_cust_referral_code($where)
    {
        $this->backdb->select('customer_id');
        $this->backdb->from('ss_customer');

        if(!empty($where)){

            $this->backdb->where($where);
        }

        $query=$this->backdb->get();
        return $query->result();
    }
    /*end*/

    public function remove_test_customers_list($where)
    {
        $this->backdb->select('customer_id,customer_unique_id,customer_email');
        $this->backdb->from('ss_customer');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $query=$this->backdb->get();
        return $query->result();
    }

    public function one_time_mark_failed($where)
    {

        $this->backdb->select('customer_id,ORDERID');
        $this->backdb->from('ss_failed_transaction_log');

        if(!empty($where)){

            $this->backdb->where($where);
        }
        $query=$this->backdb->get();
        return $query->result();
    }


    /*for get retrieved customer data*/
    public function get_month_wise_customer($where){

        $this->backdb->select('customer_id');
        $this->backdb->from('ss_order');

        if(!empty($where)){

            $this->backdb->where($where);
        }

        $this->backdb->where('ss_order.order_status','completed');
        $this->backdb->where('ss_order.order_type','pickup');
        $this->backdb->order_by('order_id ASC');
        $query=$this->backdb->get();
        return $query->result();
    }

    public function get_customer_order_data($where){

        $this->backdb->select('order_id');
        $this->backdb->from('ss_order');

        if(!empty($where)){

            $this->backdb->where($where);
        }

        $this->backdb->where('ss_order.order_status','completed');
        $this->backdb->where('ss_order.order_type','full_retrieval');
        $query=$this->backdb->get();
        return $query->row();
    }

    public function get_retrieved_customers(){

        $mysql = "SELECT customer_id FROM `ss_order` WHERE (DATE(`ss_order`.`order_schedule_date`) >= '2020-08-01' AND DATE(`ss_order`.`order_schedule_date`) <=  '2020-12-30') AND order_status='completed' AND order_type='full_retrieval'";

        $query = $this->backdb->query($mysql);
        return $query->result();
    }

    /*end*/

    public function get_paid_customer_not_recoreded(){

        $mysql = "SELECT customer_id FROM `ss_customer_payment` WHERE (DATE(`ss_customer_payment`.`bill_genrated_date`) >= '2021-07-15' AND DATE(`ss_customer_payment`.`bill_genrated_date`) <=  '2021-07-20') AND payment_status='Unpaid' AND charges_type='transport_charges'";

        $query = $this->backdb->query($mysql);
        return $query->result();
    }

    public function get_customer_wallet_data($where){

        $this->backdb->select('customer_id,wallet_amount');
        $this->backdb->from('ss_customer_wallet');

        if(!empty($where)){

            $this->backdb->where($where);
        }

        $query=$this->backdb->get();
        return $query->row();
    }

    /*for google link review cron*/

    public function send_google_review_link_cron($where){

        $this->backdb->select('customer_id,customer_email,customer_local_city');
        $this->backdb->from('ss_customer');
        if(!empty($where)){
            $this->backdb->where($where);
        }

        $condition = "(ss_customer.status='0' AND ss_customer.is_active_reminder='0') AND is_customer='1' AND is_sent_google_review_link ='0' AND is_zoho_customer='0'";

        $this->backdb->where($condition);

        $this->backdb->limit(70);

        $this->backdb->order_by('ss_customer.customer_id asc');

        $query=$this->backdb->get();
        return $query->result();
    }

    public function refer_and_earn_cron($where){

        $this->backdb->select('customer_id,customer_email,customer_local_city,referral_id');
        $this->backdb->from('ss_customer');
        if(!empty($where)){
            $this->backdb->where($where);
        }

        $condition = "(ss_customer.status='0' AND ss_customer.is_active_reminder='0') AND is_customer='1' AND is_refer_earn_sent ='0' AND is_zoho_customer='0'";

        $this->backdb->where($condition);

        $this->backdb->limit(70);

        $this->backdb->order_by('ss_customer.customer_id asc');

        $query=$this->backdb->get();
        return $query->result();
    }

    /*for find stacking images*/

    public function find_lost_stacking_customer($where)
    {
        $this->backdb->select('ss_inv_damaged_other_images.image_id,ss_inv_damaged_other_images.customer_id,ss_inv_damaged_other_images.damaged_image,ss_customer.customer_unique_id,ss_customer.customer_name,ss_customer.customer_email');
        $this->backdb->from('ss_inv_damaged_other_images');
         $this->backdb->join('ss_customer','ss_inv_damaged_other_images.customer_id =ss_customer.customer_id','left');
        if(!empty($where)){

            $this->backdb->where($where);
        }

        $condition = "(ss_customer.status='0' AND ss_customer.is_active_reminder='0') AND is_customer='1'";

        $this->backdb->where($condition);

        $this->backdb->where('ss_inv_damaged_other_images.document_type','damaged_images');
        $this->backdb->order_by('ss_inv_damaged_other_images.image_id asc');
        $this->backdb->group_by('ss_inv_damaged_other_images.customer_id');
        /*$this->backdb->limit(9000);*/
        $query=$this->backdb->get();
        return $query->result();
    }

    /*for zoho customer*/
    public function send_zoho_cust_acc_info_cron($where){

        $this->backdb->select('ss_customer.customer_id,ss_customer.customer_unique_id,ss_user.user_email,ss_user.user_password');
        $this->backdb->from('ss_user');
        $this->backdb->join('ss_customer','ss_user.customer_id =ss_customer.customer_id','left');
        if(!empty($where)){
            $this->backdb->where($where);
        }

        $condition="(ss_customer.is_zoho_customer='1') AND (ss_customer.is_sent_credentials='0')";

        $this->backdb->where($condition);

        $this->backdb->limit(80);

        $this->backdb->order_by('ss_user.user_id desc');

        $query=$this->backdb->get();
        return $query->result();
    }

      /*for set invoice_id to active customer*/

    public function get_invoice_customer_list($where){

        $this->backdb->select('customer_id');
        $this->backdb->from('ss_customer');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $condition = "(ss_customer.status='0' AND ss_customer.is_active_reminder='0') AND is_customer='1' AND customer_id > 54754";

        $this->backdb->where($condition);
        $query=$this->backdb->get();
        return $query->result();

    }

     /*for get sum of vendor panelty*/

    public function get_vendor_penalty_sum($where){

        $this->backdb->select('SUM(vendor_penalty_amt) as total_penalty_amount');
        $this->backdb->from('ss_vendor_penalty');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $this->backdb->where('ss_vendor_penalty.is_used','0');
        $this->backdb->where('ss_vendor_penalty.penalty_type !=','deduction');
        $query=$this->backdb->get();
        return $query->row();
    }

    public function get_vendor_deduction_sum($where){

        $this->backdb->select('SUM(vendor_penalty_amt) as total_deduction_amount');
        $this->backdb->from('ss_vendor_penalty');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $this->backdb->where('ss_vendor_penalty.is_used','0');
        $this->backdb->where('ss_vendor_penalty.penalty_type','deduction');
        $query=$this->backdb->get();
        return $query->row();
    }

    public function get_vendor_penalty_list($where){

        $this->backdb->select('vendor_penalty_id');
        $this->backdb->from('ss_vendor_penalty');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $this->backdb->where('ss_vendor_penalty.is_used','0');
        $query=$this->backdb->get();
        return $query->result();
    }

    public function get_customer($where){

        $this->backdb->select('customer_id');
        $this->backdb->from('ss_customer');
        if(!empty($where)){
            $this->backdb->where($where);
        }

        $query=$this->backdb->get();
        return $query->row();
    }

    public function get_part_ret_orders($where){

        $this->backdb->select('customer_id,order_id,order_created_at');
        $this->backdb->from('ss_order');
        if(!empty($where)){
            $this->backdb->where($where);
        }

        $query=$this->backdb->get();
        return $query->result();
    }

    public function payment_reminder_customer($where)
    {
        $this->backdb->select_max('ss_customer_payment_offer.payment_offer_id');
        $this->backdb->select('ss_customer_payment_offer.offer_end_date,ss_customer.customer_email');
        $this->backdb->from('ss_customer_payment_offer');
        $this->backdb->join('ss_customer','ss_customer_payment_offer.customer_id=ss_customer.customer_id','left');
        $this->backdb->order_by('ss_customer_payment_offer.payment_offer_id desc');
        $this->backdb->group_by('ss_customer_payment_offer.customer_id');

        if(!empty($where)){
            $this->backdb->where($where);
        }
        $condition = "(ss_customer.status='0' AND ss_customer.is_active_reminder='0') AND is_customer='1'";

        $this->backdb->where($condition);
        $query=$this->backdb->get();
        return $query->result();
    }

    /*for reset pass cron*/

    public  function get_user_list($where)
    {

        $this->backdb->select('user_id,user_email');
        $this->backdb->from('ss_user');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $query=$this->backdb->get();
        return $query->result();
    }
    public function get_vendor_packing_charges_sum($where){

        $this->backdb->select('SUM(vendor_charges) as total_packing_charges');
        $this->backdb->from('ss_vendor_material_order');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $this->backdb->where('ss_vendor_material_order.is_used','0');
        $this->backdb->where('ss_vendor_material_order.status','completed');
        $query=$this->backdb->get();
        return $query->row();
    }

    public function get_vendor_packing_charges_list($where){

        $this->backdb->select('mo_id');
        $this->backdb->from('ss_vendor_material_order');
        if(!empty($where)){
            $this->backdb->where($where);
        }
        $this->backdb->where('ss_vendor_material_order.is_used','0');
        $this->backdb->where('ss_vendor_material_order.status','completed');
        $query=$this->backdb->get();
        return $query->result();
    }
    /*for vendor payment cron*/
    public function get_vendor_config($where)
    {
        $this->backdb->select('ss_vendor_percent_config.service_percent,ss_vendor_percent_config.incentive_percent');
        $this->backdb->from('ss_vendor_transport');
        $this->backdb->join('ss_vendor_percent_config','ss_vendor_transport.vt_city=ss_vendor_percent_config.city','left');

        if(!empty($where)){
            $this->backdb->where($where);
        }

        $query=$this->backdb->get();
        return $query->row();
    }

    public function get_customer_offer_data($where){

        $this->backdb->select('six_month_discount,yearly_discount');
        $this->backdb->from('ss_customer');

        if(!empty($where)){
            $this->backdb->where($where);
        }

        $query=$this->backdb->get();
        return $query->row();
    }




    public function get_active_monthly_customer($where){
        $this->backdb->distinct('ss_customer.customer_id');
        $this->backdb->select('ss_customer.customer_id,ss_customer.storage_type,ss_customer.customer_contact1,ss_order.order_id,ss_order.order_schedule_date');
        $this->backdb->from('ss_customer');
        $this->backdb->join('ss_order','ss_customer.customer_id =ss_order.customer_id','left');
        if(!empty($where)){
            $this->backdb->where($where);
        }

        $condition = "(ss_customer.is_active_reminder='0') AND is_customer='1'";

        $this->backdb->where($condition);
       
        $query=$this->backdb->get();
        return $query->result();

    }

     
      public function get_invoice_numbers($where){

        
          $this->backdb->select('invoice_no,COUNT(*) AS Occurrence');
        $this->backdb->from('ss_customer_transaction');
      
        if(!empty($where)){

            $this->backdb->where($where);
        }
       //  $this->backdb->limit(10);
         $this->backdb->group_by('invoice_no');
          $this->backdb->HAVING ('COUNT(*)>1');
        $query=$this->backdb->get();
        return $query->result();


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
      //  $this->backdb->limit(10);
        $query=$this->backdb->get();
        $data=$query->result();
        return $data;    
    }
    
      public function get_invoices_customer_list($keyword){

       $sql ="SELECT * FROM ss_customer_transaction WHERE invoice_no like '%".$keyword."%'";

        $query = $this->backdb->query($sql);
        return $query->result_array();
    }

    public function get_long_invoices_customer_list(){

       $sql ="SELECT cust_transaction_id,customer_id,invoice_no FROM ss_customer_transaction WHERE invoice_no like '%SS22%' AND LENGTH(invoice_no) >=15 LIMIT 10";

        $query = $this->backdb->query($sql);
        return $query->result_array();
    }

}
?>
