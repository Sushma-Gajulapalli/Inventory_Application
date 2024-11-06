<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends MX_Controller {
    

    function __construct() {
        header("Access-Control-Allow-Origin: *");
        $this->load->model('auth/auth_model');
        $this->load->model('customer/customer_model');
        $this->load->model('customer/common_model');
        $this->load->library('pagination');
        $this->backdb = $this->load->database('back_db', TRUE);
        
        parent::__construct();
    }
   
    public function pickup_booking() {
        $quotation_id = $_GET['id'];
        $code = $_GET['code'];
        if (!empty($quotation_id) && !empty($code)) {
            $q_where = array('quotation_id' => @$quotation_id, 'payment_security_code' => $code,);
            $quotation_data = $this->customer_model->getSingleRecord('ss_customer_quotation', $q_where);
            if (!empty($quotation_data) && $quotation_data->is_valid_link != 1) {
                $data = [];
                $customer_id = $quotation_data->customer_id;
                $data['offer_string'] = $this->header_offer();
                $data['meta_file'] = 'customer_storage_estimate';
                $data["storage_type_list"] = $this->customer_model->get_storage_type_list(array('status' => '0'), 'storage_type_id asc');
                $c_where = array('customer_id' => $customer_id);
                $customer_data = $this->customer_model->getSingleRecord('ss_customer', $c_where);
               /* $list = $this->customer_model->getitem_qRecord('ss_customer_quotation_item', $customer_id, $quotation_id);
                $data = [];
                foreach ($list as $key => $value) {
                    $data['storage_item_qty'][$value->item_slug] = $value->item_count;
                }*/
                //$data['storage_item_qty'][$value->item_slug] = $value->item_count;
                $data['total_transport_charges'] = $quotation_data->total_pickup_charges_with_gst;
                $data['total_storage_charges'] = $quotation_data->total_storage_charges_with_gst;
                $data['stack_barcode_charges'] = $quotation_data->total_stack_charges_with_gst;
                $data['transport_type'] = $quotation_data->transport_type;
                $data['hometype'] = $quotation_data->hometype;
                $data['token'] = $quotation_data->transport_token_amt;
                $end = strtotime(date("Y-m-01"));
                $start = $month = strtotime("+1 month", $end);
                $dates = [];
                /*while ($end < $month) {
                    $main = date("m/d/Y", $end);;
                    $today_date = date('Y-m-d', $end);
                    $day = date('l', strtotime($today_date));
                    $end = strtotime("+1 day", $end);
                    $hometype = $this->customer_model->getdayRecord('daywisecharges', $day);
                    $tranposrt = $data['total_transport_charges'];
                    if ($quotation_data->transport_type == 'warehouse_arrival') {
                        $dates[$main] = 500;
                    } else {
                        $dates[$main] = $data['token'];
                    }
                }*/
                $hometype = $this->customer_model->getsettingRecord('movesetting');
                $data['tokenadvance'] = $hometype[0]->token_per;
                $data['datesprice'] = $dates;
                $data['customer_data'] = $customer_data;
                $data['customer_id'] = $customer_id;
                $data['quotation_id'] = $quotation_id;
                $data['quotation_data'] = $quotation_data;
                $order_by = "coupen_id asc";
                $where = array('status' => '0', 'is_show_to_front' => 'on',);
                $data['coupen_list'] = $this->customer_model->getAllRecord('ss_coupen', $where, $order_by);
                // $hometype = $_POST['hometype'];
                $b_where = array('home_type' => $data['hometype']);
                $bhk_data = $this->customer_model->getSingleRecord('hometypeprice', $b_where);
                $data['percent_coupon'] = @$bhk_data->percent_coupon;
                /*new condition*/
                $transport_coupon = "safestorage-percent-" . @$bhk_data->trp_percent_coupon;
                $tr_coupon_arr = explode('-', $quotation_data->transport_coupon);
                if (is_numeric($tr_coupon_arr[2])) {
                    $trp_percent_coupon = $tr_coupon_arr[2];
                } else {
                    $trp_percent_coupon = @$bhk_data->trp_percent_coupon;
                }
                $data['trp_percent_coupon'] = $trp_percent_coupon; //$bhk_data->trp_percent_coupon;
                $data['transport_coupon'] = $transport_coupon;
                /*for booking restriction*/
                $customer_city = $customer_data->customer_local_city;
                $disabled_date_arr=[];
                $arrival_disabled_date_arr=[];

                //Slot New logic
            $today_date = date('Y-m-d'); // Get today's date
            $h_where = array(
            "ss_date_timeslot.city =" => $customer_city,
            "DATE(ss_date_timeslot.date) >=" => $today_date,
            "pickup"=>1
            );
            $holiday_date_list = $this->customer_model->get_holiday_list($h_where);
            if (!empty($holiday_date_list)) {
                foreach ($holiday_date_list as $key => $holiday_date) {
                    $disabled_date_arr[] = $holiday_date->date;
                }
            }
             $Arrival_Disabled_Dates_arr = array();
            $today_date = date('Y-m-d'); // Get today's date
            $h_where = array(
            "ss_date_timeslot.city =" => $customer_city,
            "DATE(ss_date_timeslot.date) >=" => $today_date,
            "warehouse"=>1
            );
            $holiday_date_list = $this->customer_model->get_holiday_list($h_where);
            if (!empty($holiday_date_list)) {
                foreach ($holiday_date_list as $key => $holiday_date) {
                    $Arrival_Disabled_Dates_arr[] = $holiday_date->date;
                }
            }


           
            $data['arrival_disabled_date_arr'] = $Arrival_Disabled_Dates_arr;

        


            //End 
               
                //$disabled_date_arr = $this->pickup_avilable_timeslot($quotation_data->total_storage_charges, $customer_city);
                $data['disabled_date_arr'] = $disabled_date_arr;
               // $arrival_disabled_date_arr = $this->arrival_avilable_timeslot($customer_city);
                $data['arrival_disabled_date_arr'] = $arrival_disabled_date_arr;
                /*end*/


                //echo "<pre>";print_r($data);
                $this->load->view('frontend/new/new_header', $data);
                //$this->load->view('customer/booking_new', $data);
                 $this->load->view('customer/new_payment_page', $data);
                $this->load->view('frontend/new/new_footer');
            } else {
                $this->session->set_flashdata('transaction_err_msg', "Link is not active");
                redirect('customer/transaction_cancel');
                die();
            }
        } else {
            $this->session->set_flashdata('transaction_err_msg', "oops something went wrong !");
            redirect('customer/transaction_cancel');
            die();
        }
    }


   

    public function index() {
        $data = [];
        $data['offer_string'] = $this->header_offer();
        $data['meta_file'] = 'customer_storage_estimate';
        $data["storage_type_list"] = $this->customer_model->get_storage_type_list(array('status' => '0'), 'storage_type_id asc');
        $where = array();
        $order_by = "coupen_id asc";
        $where = array('status' => '0', 'is_show_to_front' => 'on',);
        $data['coupen_list'] = $this->customer_model->getAllRecord('ss_coupen', $where, $order_by);

        $is_price_show = $this->session->userdata('is_price_show');
        if(empty($is_price_show )){
             $data['is_price_show']=0; 
         }else{
              $data['is_price_show']=$is_price_show;
         }
        $data['room_list'] =[]; 
        $this->load->view('frontend/new/new_header_createquote', $data);
        //$this->load->view('customer/step1',$data);
        $this->load->view('customer/step1', $data);
        $this->load->view('frontend/new/new_footer_createquote',$data);
        //$this->load->view('frontend/new/new_footer_createquote');

    }

   
    public function create_quotation() {
        $data = [];
        $data['offer_string'] = $this->header_offer();
        $data['meta_file'] = 'customer_storage_estimate';
        $data["storage_type_list"] = $this->customer_model->get_storage_type_list(array('status' => '0'), 'storage_type_id asc');
        $where = array();
        $order_by = "coupen_id asc";
        $where = array('status' => '0', 'is_show_to_front' => 'on',);
        $data['coupen_list'] = $this->customer_model->getAllRecord('ss_coupen', $where, $order_by);

        $is_price_show = $this->session->userdata('is_price_show');
        if(empty($is_price_show )){
             $data['is_price_show']=0; 
         }else{
              $data['is_price_show']=$is_price_show;
         }
        $data['room_list'] =[]; 
        $this->load->view('frontend/new/new_header_createquote', $data);
        //$this->load->view('customer/step1',$data);
        $this->load->view('customer/step1', $data);
        $this->load->view('frontend/new/new_footer_createquote',$data);
        //$this->load->view('frontend/new/new_footer_createquote');

    }
    public function thank_you() {
        $data = [];
        $this->load->view('frontend/new/new_header', $data);
        $this->load->view('customer/thank_you', $data);
        $this->load->view('frontend/new/new_footer');
    }
    public function cancel() {
        $data = [];
        $this->load->view('frontend/new/new_header', $data);
        $this->load->view('customer/cancel_transcation', $data);
        $this->load->view('frontend/new/new_footer');
    }
    
    public function step2() {
        $data['storage_type'] = $_POST['storage_type'];
        /* $data =[];
        $data['offer_string'] = $this->header_offer();
        $data['meta_file'] = 'customer_storage_estimate';
        $data["storage_type_list"] = $this->customer_model->get_storage_type_list(array('status' => '0'),'storage_type_id asc');
        $where = array();
        $data["floor_list"] =$this->customer_model->getAllRecord('ss_floor',array('status' => '0'));
        $data["city_list"] =$this->customer_model->getAllRecord('ss_city',array('status' => '0'));
        $this->load->view('template/frontend_header',$data);*/
        $this->load->view('customer/ajax_step_three', $data);
        // $this->load->view('template/frontend_footer');
        
    }

    public function new_dummy_payment_page() {
       // $data['storage_type'] = $_POST['storage_type'];
        /* $data =[];
        $data['offer_string'] = $this->header_offer();
        $data['meta_file'] = 'customer_storage_estimate';
        $data["storage_type_list"] = $this->customer_model->get_storage_type_list(array('status' => '0'),'storage_type_id asc');
        $where = array();
        $data["floor_list"] =$this->customer_model->getAllRecord('ss_floor',array('status' => '0'));
        $data["city_list"] =$this->customer_model->getAllRecord('ss_city',array('status' => '0'));
        $this->load->view('template/frontend_header',$data);*/
        $this->load->view('customer/new_dummy_payment_page');
        // $this->load->view('template/frontend_footer');
        
    }


    public function step3() {
        if (!empty($_POST['storage_item_slug'])) {
             $ss_quotation_leads_data = array();
            $ss_quotation_leads_data = $this->common_model->getSingleRecord('ss_quotation_leads',array('email' => @$_POST['customer_email']));
            if(!empty($ss_quotation_leads_data))
            {
            $this->customer_model->updateRecord('ss_quotation_leads',array('step_visitied' =>'3'),array('email' => @$_POST['customer_email']));
          
            }

          
            $data = array();
            $order_by = "storage_item_name asc";
            $where = '';
            $storage_item = $this->customer_model->getAllRecord('ss_storage_item', $where, $order_by);
            $quotation_item_list = array();
            $total_storage_charges = 0;
            $storage_item_charges = 0;
            $hometype = $_POST['hometype'];
            $item_arr = [];
            if (!empty($storage_item)) {
                foreach ($storage_item as $key => $item) {
                    if (in_array($item->storage_item_slug, $_POST['storage_item_slug'])) {
                        $item_qty = @$_POST['storage_item_qty'][@$item->storage_item_slug];
                        $storage_item_charges+= ($item->storage_item_charges * $item_qty);
                        $item_arr[$item->storage_item_slug][] = $item->storage_item_charges . "--" . $item_qty . ">" . ($item->storage_item_charges * $item_qty);
                    }
                }
            }
             $total_storage_charges = number_format((float)$storage_item_charges, 2, '.', '');
           
            /*echo "total_storage_charges : ".$total_storage_charges;
            
            echo "<pre>";print_r($item_arr);*/
            $is_correct_vehicle = true;
            $is_large_amount = false;
            if ($hometype == '1rk') {
                if ($total_storage_charges <= 1800) {
                    $is_correct_vehicle = true;
                } else {
                    $is_correct_vehicle = false;
                }
            } elseif ($hometype == '1bhk') {
                if ($total_storage_charges > 1800 && $total_storage_charges <= 3000) {
                    $is_correct_vehicle = true;
                } else {
                    $is_correct_vehicle = false;
                }
            } elseif ($hometype == '2bhk') {
                if ($total_storage_charges > 3000 && $total_storage_charges <= 5000) {
                    $is_correct_vehicle = true;
                } else {
                    $is_correct_vehicle = false;
                }
            } elseif ($hometype == '3bhk') {
                if ($total_storage_charges > 5000 && $total_storage_charges <= 7000) {
                    $is_correct_vehicle = true;
                } else {
                    $is_correct_vehicle = false;
                    $is_large_amount = true;
                }
                if ($total_storage_charges > 7000 && $total_storage_charges <= 10000) {
                    $is_correct_vehicle = true;
                    $hometype = "4bhk";
                }
                if ($total_storage_charges > 10000) {
                    $is_correct_vehicle = false;
                    $is_large_amount = true;
                }
            }
            if ($total_storage_charges > 10000) {
                $is_correct_vehicle = false;
                $is_large_amount = true;
            }
            /*echo $total_storage_charges;die;*/
            if ($is_correct_vehicle == false && $is_large_amount == true) {
                echo "max_quantity";
                die();
            }
            if ($is_correct_vehicle == false) {
                echo "invalid_hometype";
                die();
            }
        }
        $data_array = [];
        $data = array();
        $data["hometype"] = @$hometype;
        $data["total_storage_charges"] = @$total_storage_charges;
        $data["floor_list"] = $this->customer_model->getAllRecord('ss_floor', array('status' => '0'));
        $data["city_list"] = $this->customer_model->getAllRecord('ss_city', array('status' => '0'));
        $this->load->view('customer/step3', $data);
        die;
    }
  
    public function step4() {
        $data = $_POST;
        $this->load->view('customer/step4', $data);
    }
    
    //loading time decreases fnctionality

    public function step4clone() {
       // echo "<pre>";print_r($_POST);
        if (!empty($_POST['storage_item_slug'])) {
            $ss_quotation_leads_data = array();
            $ss_quotation_leads_data = $this->common_model->getSingleRecord('ss_quotation_leads',array('email' => $_POST['customer_email']));
            if(!empty($ss_quotation_leads_data))
            {
            $this->customer_model->deleteRecord('ss_quotation_leads',array('email' => $_POST['customer_email']));
          
            }
            
            $data = array();
            $order_by = "storage_item_name asc";
            $where = '';
            $storage_item = $this->customer_model->getAllRecord('ss_refined_storage_item', $where, $order_by);
            $quotation_item_list = array();
            $std_pallet_point = 20;
            $std_pallet_charges = 1000;
            $total_storage_charges = 0;
            $input_pallet = 0;
            $item_point = 0;
            $storage_packing_charges = 0;
            $storage_item_charges = 0;
            $vehicle_price = 0.00;
            if (!empty($storage_item)) {
                foreach ($storage_item as $key => $item) {
                    if (in_array($item->storage_item_slug, $_POST['storage_item_slug'])) {
                        $quotation_item_list[] = $item;
                        $item_qty = @$_POST['storage_item_qty'][@$item->storage_item_slug];
                        $item_point+= ($item->storage_item_point * $item_qty);
                        $storage_packing_charges+= ($item->storage_packing_charges * $item_qty);
                      // New charges for new quotations
                        $storage_item_charges+= ($item->storage_item_charges_change * $item_qty);
                        
                        
                    }
                }
            }
            $input_pallet = number_format(($item_point / $std_pallet_point), 1, '.', '');
            $total_storage_charges = number_format((float)$storage_item_charges, 2, '.', '');
           

            $data['storage_item_qty'] = @$_POST['storage_item_qty'];
            $data['quotation_item_list'] = $quotation_item_list;
             $data['storage_item_slug'] =  $_POST['storage_item_slug'];


          
            $data['input_pallet'] = $input_pallet;


            $data['total_storage_charges'] = $total_storage_charges;


            /****************transport charges start*******************/
            $hometype = $_POST['hometype'];
            $city = $_POST['customer_local_city'];

            $b_where = array('home_type' => $hometype);
            $bhk_dat = $this->customer_model->getSingleRecord('hometypeprice', $b_where);
            $bhk_data = $this->customer_model->getSingleRecord('hometypeprice', $b_where);



           
            $data['percent_coupon'] = $bhk_dat->percent_coupon;
            //print_r($bhk_data->percent_coupon);
            $this->input_months = @$_POST['storage_month'];
            $this->total_item_point = $item_point;
            $this->safe_lat = '';
            $this->safe_long = '';
            $this->unit = 'k';
            $this->total_transport_charges = 0;
            $this->total_input_dist = 0;
            $d_where = array();
            $customer_local_city = trim($_POST['customer_local_city']??'');
            $d_where = array('city_slug' => $customer_local_city);
            if (!empty($d_where)) {
                $distance_data = $this->customer_model->getSingleRecord('ss_city', $d_where);
                if (!empty($distance_data->city_lat) && !empty($distance_data->city_lng)) {
                    $this->safe_lat = $distance_data->city_lat;
                    $this->safe_long = $distance_data->city_lng;
                }
            }

            
           /* if (!empty(@$_POST['pickup_lat']) && !empty(@$_POST['pickup_lang'])) {
                $cust_to_safe_distance = $this->get_distance($_POST['pickup_lat'], $_POST['pickup_lang'], $this->safe_lat, $this->safe_long, $this->unit);
                $total_distance = (@$cust_to_safe_distance * 2);
                $this->total_input_dist = round(@$total_distance);
            }*/


             if(!empty(@$_POST['customer_area'])) {
                $s_where = array('area_slug'=>$_POST['customer_area']);
                $area_details = $this->customer_model->getSingleRecord('ss_area',$s_where);
                if(!empty($area_details->distance)){
                    $this->total_input_dist = round(@$area_details->distance);
                }
               

             }



            //echo "total_input_dist ".$this->total_input_dist;
            /*lift cost start*/
            /*echo $input_pallet ;die();*/
            $this->total_lift_cost = 0.00;
            $pickup_floor = @$_POST['pickup_floor'];
            $pickup_lift = @$_POST['pickup_lift'];
            if ($input_pallet > 0.0) {
                $this->total_lift_cost = $this->calculate_total_lift_cost($pickup_floor, $pickup_lift, $input_pallet);
            }
            /*end lift cost*/
            /*labor cost start*/
            $this->total_labor_cost = 0.00;
            if ($input_pallet > 0.0) {
                $this->total_labor_cost = $this->calculate_labor_cost($input_pallet);
            }
            /*end labor cost*/
            /*transport cost start*/
            $this->total_transport_cost = 0.00;
            if ($input_pallet > 0.0) {
                $transport_cost = $this->get_calculated_transport_info($input_pallet, $this->total_input_dist);
                $this->total_transport_cost = number_format($transport_cost, 2, '.', '');
            }

           // echo "total_transport_cost ".$transport_cost;


            /*transport cost end*/
            /*additional pallet charges*/
            $this->additional_pallet_cost = 0;
            $additional_cost = 0;
            $additional_cost = ($input_pallet * 1000);
            $this->additional_pallet_cost = $storage_packing_charges;
            /*end additional pallet charges*/
            /*stacking and barcode charges*/
            $this->stacking_barcode_charges = 0.00;
            if ($input_pallet > 0.0) {
                $this->stacking_barcode_charges = 500; /*$this->calculate_stacking_barcode_cost($input_pallet);*/
            }
            /*end stacking*/
            /*$this->total_transport_charges = ($this->additional_pallet_cost + $this->total_transport_cost + $this->total_labor_cost + $this->total_lift_cost);*/
            $extra_distance_charges = 0;
            if ($this->total_input_dist > 70) {
                $extra_distance_charges = 500;
                $distance = $this->total_input_dist;
                /*echo "distance ".$distance;die();*/
                if ($distance > 100) {
                    $distance_count = abs($distance - 100);
                    for ($i = 0;$i < $distance_count;$i++) {
                        $extra_distance_charges+= 50;
                    }
                }
            }


            // Transport Increase charges dynamically from table
               // $get_charges = $this->customer_model->getSingleRecord('ss_new_charges_increased',$whereet='');


               // $get_charges = $this->common_model->getAllRecord('ss_new_charges_increased',array('id' => '1'));
                $this->total_transport_charges = (@$bhk_data->vehicle_charges + $storage_packing_charges + $this->total_lift_cost + $this->total_labor_cost + $extra_distance_charges);
                //$this->total_transport_charges *= $get_charges->transport_charge_increased;

                //$data['total_storage_charges'] = $total_storage_charges*$get_charges->storage_charge_increased;

               // $total_storage_charges = $total_storage_charges*$get_charges->storage_charge_increased;


            //End

            $this->total_transport_cost = @$bhk_data->vehicle_charges;
            /* if(@$_POST['warehouse_arrival']){
                
                $this->total_transport_charges = 0.00;
                $this->total_transport_cost = 0.00;
                $this->total_labor_cost = 0.00;
                $this->total_lift_cost = 0.00;
                $this->additional_pallet_cost = 0.00;
            }*/
            $data['input_distance'] = $this->total_input_dist;
            $data['total_transport_cost'] = $this->total_transport_cost;
            $data['total_labor_cost'] = $this->total_labor_cost;
            $data['total_lift_cost'] = $this->total_lift_cost;
            $data['additional_pallet_cost'] = $this->additional_pallet_cost;
            $data['total_transport_charges'] = round($this->total_transport_charges);
            $data['stacking_barcode_charges'] = $this->stacking_barcode_charges;
            $data["tax_list"] = $this->customer_model->getAllRecord('ss_tax', array('status' => '0'));
            $_POST['total_distance'] = $this->total_input_dist;
            $_POST['transport_cost'] = $this->total_transport_cost;
            $_POST['labour_cost'] = $this->total_labor_cost;
            $_POST['lift_cost'] = $this->total_lift_cost;
            $_POST['additional_pallet_cost'] = $this->additional_pallet_cost;
            $_POST['extra_km_charges'] = $extra_distance_charges;
            $_POST['pickup_charges'] = $this->total_transport_charges;
            $_POST['stack_barcode_charges'] = $this->stacking_barcode_charges;
            $_POST['total_pallet'] = $input_pallet;
            $_POST['storage_charges'] = $total_storage_charges;
            $_POST['vehicle_type'] = $bhk_data->vehicle_slug;
           $_POST['storage_coupen'] = "safestorage-percent-" . $bhk_dat->percent_coupon;
            /*new condition*/
            $transport_coupon = "safestorage-percent-" . $bhk_dat->trp_percent_coupon;
            $_POST['transport_coupon'] = $transport_coupon;
            $data['trp_percent_coupon'] = $bhk_dat->trp_percent_coupon;
            $data['transport_coupon'] = $transport_coupon;
            /*check quotation count */
            $exist_customer_id = '';
            $e_where = array('customer_email' => trim($_POST['customer_email']??''));
            $m_where = array('customer_contact1' => trim($_POST['customer_contact1']??''));
            $cust_email_exist = $this->customer_model->getSingleRecord('ss_customer', $e_where);
            $cust_contact_exist = $this->customer_model->getSingleRecord('ss_customer', $m_where);
            if (!empty($cust_email_exist) || !empty($cust_contact_exist)) {
                if (!empty($cust_contact_exist)) {
                    $exist_customer_id = $cust_contact_exist->customer_id;
                }
                if (!empty($cust_email_exist)) {
                    $exist_customer_id = $cust_email_exist->customer_id;
                }
            }


          //  $response_data = $this->add_customer_step_form_new($_POST);
         // New Code code


            $exist_customer_id = '';
            $customer_data = array();
            $e_where = array('customer_email' => trim($_POST['customer_email']??''));
            $m_where = array('customer_contact1' => trim($_POST['customer_contact1']??''));
            $cust_email_exist = $this->customer_model->getSingleRecord('ss_customer', $e_where);
            $cust_contact_exist = $this->customer_model->getSingleRecord('ss_customer', $m_where);
            if (!empty($cust_email_exist) || !empty($cust_contact_exist)) {
                if (!empty($cust_contact_exist)) {
                    $exist_customer_id = $cust_contact_exist->customer_id;
                    $customer_data = $cust_contact_exist;
                }
                if (!empty($cust_email_exist)) {
                    $exist_customer_id = $cust_email_exist->customer_id;
                    $customer_data = $cust_email_exist;
                }
            }
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0;$i < 10;$i++) {
                $randomString.= $characters[rand(0, $charactersLength - 1) ];
            }
            if (empty($exist_customer_id)) {
                    //$data_customer['pincode'] = $pincode;
                $data_customer = array('customer_initial' => trim(@$_POST['customer_initial']??''), 'customer_name' => htmlspecialchars(trim($_POST['customer_name']??'')), 'customer_email' => htmlspecialchars(trim($_POST['customer_email']??'')), 'customer_contact1' => htmlspecialchars(trim($_POST['customer_contact1']??'')), 'customer_local_city' => htmlspecialchars(trim($_POST['customer_local_city']??'')), 'referral_code' => $randomString, 'pickup_address' => htmlspecialchars(trim(@$_POST['pickup_address']??'')), 'pickup_lat' => htmlspecialchars(trim($_POST['pickup_lat']??'')), 'pickup_lang' => htmlspecialchars(trim($_POST['pickup_lang']??'')), 'pickup_floor' => htmlspecialchars(trim(@$_POST['pickup_floor']??'')), 'pickup_lift' => htmlspecialchars(trim(@$_POST['pickup_lift']??'')), 'storage_date' => $this->set_date_format(@$_POST['storage_date']), 'storage_month' => @$_POST['storage_month'], 'warehouse_arrival' => @$_POST['warehouse_arrival'], 'referral_id' => $randomString, 'payment_type' => 'monthly', 'customer_created_at' => date('Y-m-d H:i:s'), 'six_month_discount' => '10', 'yearly_discount' => '20','is_cashfree_customer'=>1,'pincode'=>@$_POST['pickup_pincode']);

                //'referral_code' => htmlspecialchars(trim(@$_POST['referral_code']??'')),


                //print_r($data_customer);


                  

                    /*auto assign relationship manager to customer*/
                    $order_by = 'customer_id desc';
                    $last_customer_data = $this->customer_model->getOrderBySingleRecord('ss_customer', array(), $order_by);

                 // print_r($last_customer_data);

                    if (!empty($last_customer_data->relationship_manager_id)) {
                         $r_m_id = @$last_customer_data->relationship_manager_id;

                       
                        $r_manager_data = array();
                        $order_by = 'user_id asc';
                       // $r_where = "role_id ='5' AND (user_id !='" . $r_m_id . "') AND status='0'"; //array('role_id' => 5);
                       // $data_users_list = $this->customer_model->getAllRecord('ss_user', $r_where, $order_by);
                        //$r_manager_data = @$data_users_list[0];

                        $order_by = 'user_id asc';
                        $r_where = "role_id ='5' AND status='0' AND (user_id > '" . $r_m_id . "')";
                        $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);

                       

                      //  $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                        if (!empty($r_manager_data)) {
                            $data_customer['relationship_manager_id'] = @$r_manager_data->user_id;
                        } else {
                            $r_manager_data = array();
                            $order_by = 'user_id asc';
                            $r_where = array('role_id' => '5', 'status' => '0');
                            $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                            $data_customer['relationship_manager_id'] = @$r_manager_data->user_id;
                        }
                    } else {
                        $order_by = 'user_id asc';
                        $r_where = array('role_id' => '5', 'status' => '0');
                        $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                        $data_customer['relationship_manager_id'] = @$r_manager_data->user_id;
                    }
                    /*end auto assign*/

                    /*$pickupAddress = $_POST['pickup_address'] ?? '';
                    $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($pickupAddress) . '&key=AIzaSyCse5f97FoDXrT5kKoeB1XGCxeCs12-mOE');
                    $geocode = json_decode($geocode);
                    $pincode = null;
                    
                    if ($geocode && isset($geocode->results) && !empty($geocode->results)) {
                        $addressComponents = $geocode->results[0]->address_components;
                        foreach ($addressComponents as $component) {
                            if (in_array('postal_code', $component->types)) {
                                $pincode = $component->long_name;
                                break;
                            }
                        }
                    }*/
                    
                    // Add the retrieved pincode to the customer data array
                   // $data_customer['pincode'] = $pincode;
                    


               
                $customer_id = $this->customer_model->addRecord('ss_customer', $data_customer);
                /*update leads*/
                $lead1_e_where = array('customer_email' => trim($_POST['customer_email']??''));
                $lead1_m_where = array('customer_mobile_no' => trim($_POST['customer_contact1']??''));
                $l_data = array('is_converted_to_quot' => '1');
                $this->customer_model->updateRecord('ss_leads', $l_data, $lead1_e_where);
                $this->customer_model->updateRecord('ss_leads', $l_data, $lead1_m_where);
                /* if(!empty($lead_id)){
                 }*/
                $storage_type = 'household_storage';
                $city = substr(ucfirst($_POST['customer_local_city']), 0, 1);
                $storage_type_slug = substr(ucfirst($storage_type), 0, 1);
                //$part_num = 'P1';
                $customer_unique_id = $city . $storage_type_slug . sprintf("%03d", $customer_id);
                $where = array('customer_id' => $customer_id);
                $row_data = array('customer_unique_id' => $customer_unique_id);
                $this->customer_model->updateRecord('ss_customer', $row_data, $where);
            } else {
                $customer_id = $exist_customer_id;
                /*auto assign relationship manager to customer*/
                $data_customer = array();
                if (!empty($customer_data->relationship_manager_id)) {
                } else {
                    $order_by = 'customer_id desc';
                    $last_customer_data = $this->customer_model->getOrderBySingleRecord('ss_customer', array(), $order_by);
                    if (!empty($last_customer_data->relationship_manager_id)) {
                        $r_m_id = $last_customer_data->relationship_manager_id;
                        $r_manager_data = array();
                        $order_by = 'user_id asc';
                        $r_where = "role_id ='5' AND (user_id !='" . $r_m_id . "') AND status='0'"; //array('role_id' => 5);

                        // $data_users_list = $this->customer_model->getAllRecord('ss_user', $r_where, $order_by);
                        // $r_manager_data = @$data_users_list[0];

                         $order_by = 'user_id asc';
                        $r_where = "role_id ='5' AND status='0' AND (user_id > '" . $r_m_id . "')";
                        $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);


                        //$r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                        if (!empty($r_manager_data)) {
                            $data_customer['relationship_manager_id'] = @$r_manager_data->user_id;
                        } else {
                            $r_manager_data = array();
                            $order_by = 'user_id asc';
                            $r_where = array('role_id' => '5', 'status' => '0');
                            $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                            $data_customer['relationship_manager_id'] = @$r_manager_data->user_id;
                        }
                    } else {
                        $order_by = 'user_id asc';
                        $r_where = array('role_id' => '5', 'status' => '0');
                        $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                        $data_customer['relationship_manager_id'] = @$r_manager_data->user_id;
                    }
                    if (!empty($data_customer['relationship_manager_id'])) {
                        $where = array('customer_id' => $customer_id);
                        //follow_up
                        $data_customer['follow_up']='';
                        $this->customer_model->updateRecord('ss_customer', $data_customer, $where);
                    }
                }
                /*end*/
            }

            //echo $data_customer['relationship_manager_id'];
            /*set storage type*/
            $s_where = array('customer_id' => $customer_id);
            $customer_storage_type_row = $this->customer_model->getSingleRecord('ss_customer_storage_type', $s_where);
            $storage_type = 'household_storage';
            if (!empty($customer_storage_type_row)) {
                $row = array('storage_slug' => 'household_storage');
                $this->customer_model->updateRecord('ss_customer_storage_type', $row, $s_where);
            } else {
                $storage_data = array('customer_id' => $customer_id, 'storage_slug' => $storage_type,);
                $this->customer_model->addRecord('ss_customer_storage_type', $storage_data);
            }
            /*end storage type*/
            //for store quoatation itme
           


            $payment_security_code = rand(100, 1000);
            $pay_code_data = array('payment_security_code' => $payment_security_code);
            $pay_code_where = array('customer_id' => $customer_id);
            $this->customer_model->updateRecord('ss_customer',$pay_code_data, $pay_code_where);
            $transport_type = 'safestorage_transport';
            if (!empty($_POST['warehouse_arrival'])) {
                $transport_type = 'warehouse_arrival';
            }
           
           $storage_duration = $_POST['storage_duration'];


            $quot_data = array('customer_id' => $customer_id,'storage_duration' => $storage_duration, 'pickup_charges' => $_POST['pickup_charges'], 'pickup_tax' => @$_POST['pickup_tax'], 'storage_charges' => $_POST['storage_charges'], 'storage_tax' => @$_POST['storage_tax'], 'stack_barcode_charges' => $_POST['stack_barcode_charges'], 'stack_barcode_tax' => @$_POST['stack_barcode_tax'], 'total_pallet' => $_POST['total_pallet'], 'total_distance' => $_POST['total_distance'], 'lift_cost' => $_POST['lift_cost'], 'transport_cost' => $_POST['transport_cost'], 'labour_cost' => $_POST['labour_cost'], 'item_packing_charges' => $_POST['additional_pallet_cost'], 'extra_km_charges' => $_POST['extra_km_charges'],
            /* 'location' =>htmlspecialchars(trim(@$_POST['pickup_address'])),*/
            'lat' => htmlspecialchars(trim($_POST['pickup_lat']??'')), 'lang' => htmlspecialchars(trim($_POST['pickup_lang']??'')),
            /*'floor' =>htmlspecialchars(trim(@$_POST['pickup_floor'])),
             'lift' =>htmlspecialchars(trim(@$_POST['pickup_lift'])),*/
            'hometype' => htmlspecialchars(trim(@$_POST['hometype']??'')), 'payment_security_code' => $payment_security_code, 'is_new_quotation' => '1', 'transport_type' => $transport_type, 'vehicle_type' => @$_POST['vehicle_type'], 'transport_coupon' => @$_POST['transport_coupon'], 'storage_coupen' => @$_POST['storage_coupen'], 'created_at' => date('Y-m-d H:i:s'));
            if ($transport_type == 'warehouse_arrival') {
                $location = '';
                $floor = '';
                $lift = '';
            } else {
                $location = htmlspecialchars(trim(@$_POST['pickup_address']??''));
                $floor = htmlspecialchars(trim(@$_POST['pickup_floor']??''));
                $lift = htmlspecialchars(trim(@$_POST['pickup_lift']??''));
            }
            $quot_data['location'] = $location;
            $quot_data['floor'] = $floor;
            $quot_data['lift'] = $lift;
            if (!empty($_POST['total_storage_charges'])) {
                $quot_data['total_storage_charges'] = $_POST['total_storage_charges'];
            } else {
                $quot_data['total_storage_charges'] = $_POST['storage_charges'];
            }
            if (!empty($_POST['total_pickup_charges'])) {
                $quot_data['total_pickup_charges'] = $_POST['total_pickup_charges'];
            } else {
                $quot_data['total_pickup_charges'] = $_POST['pickup_charges'];
            }
            if (!empty($_POST['total_stack_barcode_charges'])) {
                $quot_data['total_stack_barcode_charges'] = $_POST['total_stack_barcode_charges'];
            } else {
                $quot_data['total_stack_barcode_charges'] = $_POST['stack_barcode_charges'];
            }
            $pickup_charges = $quot_data['pickup_charges'];
            $pickup_gst = 0;
            $pickup_gst_temp = ($pickup_gst * $pickup_charges) / 100;
            $pickup_gst_amt = number_format($pickup_gst_temp, 2, '.', '');
            $total_pickup_charges_with_gst = number_format(($pickup_gst_amt + $pickup_charges), 2, '.', '');
            $quot_data['pickup_gst'] = $pickup_gst;
            $quot_data['total_pickup_charges_with_gst'] = $total_pickup_charges_with_gst;
            /**/
            $stack_barcode_charges = $quot_data['total_stack_barcode_charges'];
            $stack_barcode_gst = 18;
            $stacking_gst_temp = ($stack_barcode_gst * $stack_barcode_charges) / 100;
            $stacking_gst_amt = number_format($stacking_gst_temp, 2, '.', '');
            $total_stack_charges_with_gst = number_format(($stack_barcode_charges + $stacking_gst_amt), 2, '.', '');
            $quot_data['stack_barcode_gst'] = $stack_barcode_gst;
            $quot_data['total_stack_charges_with_gst'] = $total_stack_charges_with_gst;
            /**/
            $total_storage_charges = $quot_data['total_storage_charges'];
            $storage_gst = 18;
            $storage_gst_temp = ($storage_gst * $total_storage_charges) / 100;
            $storage_gst_amt = number_format($storage_gst_temp, 2, '.', '');
            $total_storage_charges_with_gst = number_format(($storage_gst_amt + $total_storage_charges), 2, '.', '');
            $quot_data['storage_gst'] = $storage_gst;
            $quot_data['total_storage_charges_with_gst'] = $total_storage_charges_with_gst;
            /*means actual trnsport charges not stacking and barcoding*/
            $home_type = '';
            $token_amt = 1000;
            // if ($_POST['hometype'] == '1rk') {
            //     $token_amt = 1000;
            // } else if ($_POST['hometype'] == '1bhk') {
            //     $token_amt = 1000;
            // } else if ($_POST['hometype'] == '2bhk') {
            //     $token_amt = 2000;
            // } else if ($_POST['hometype'] == '3bhk') {
            //     $token_amt = 3000;
            // } else {
            //     $token_amt = 3000;
            // }
            if (!empty($_POST['transport_coupon'])) {
                $transport_coupen_arr = explode('-', $_POST['transport_coupon']);
                if ($transport_coupen_arr[1] == 'flat') {
                    $transport_coupon_amt = $transport_coupen_arr[2];
                } else {
                    $transport_coupon_amt = ((int)$transport_coupen_arr[2] / 100) * (int)$quot_data['pickup_charges'];
                }
                $unformated_pickup_charges = ($quot_data['pickup_charges'] - $transport_coupon_amt);
                $pickup_charges = number_format((float)$unformated_pickup_charges, 2, '.', '');
                $transport_token_amt = $token_amt;
                /*number_format((float)($pickup_charges*10)/100, 2, '.', '');*/
                $trp_due_charges = ($pickup_charges - $transport_token_amt);
                $transport_due_charges = number_format((float)$trp_due_charges, 2, '.', '');
            } else {
                $pickup_charges = $quot_data['pickup_charges'];
                $transport_token_amt = $token_amt;
                /*number_format((float)($pickup_charges*10)/100, 2, '.', '');*/
                $trp_due_charges = ($pickup_charges - $transport_token_amt);
                $transport_due_charges = number_format((float)$trp_due_charges, 2, '.', '');
            }
            $quot_data['pickup_charges'] = $pickup_charges;
            $quot_data['total_pickup_charges'] = $pickup_charges;
            $quot_data['total_pickup_charges_with_gst'] = $pickup_charges;
            $quot_data['transport_due_charges'] = $transport_due_charges;
            $quot_data['transport_token_amt'] = $transport_token_amt;
            $quot_data['is_new_charges'] = 1;

            $transport_type = 'safestorage_transport';
            if (!empty($_POST['warehouse_arrival']) && $_POST['warehouse_arrival']!='') {
                $transport_type = 'warehouse_arrival';
            }
            $quot_data['transport_type'] = $transport_type;
            /*for make multi factor as per city*/
            $storage_multi_factor = $this->storage_charges_multifactor($_POST['customer_local_city']);
            $transport_multi_factor = $this->transport_charges_multifactor($_POST['customer_local_city']);
            $quot_data['storage_multi_factor'] = $storage_multi_factor;
            $quot_data['transport_multi_factor'] = $transport_multi_factor;
            //$quotation_id = $this->customer_model->addRecord('ss_customer_quotation', $quot_data);



            //print_r($quot_data);

            //$quotation_id=''; 
            $quotation_id=''; 
            $quotation_id = $this->session->userdata('quotation_id');
            $customer_id_session = $this->session->userdata('customer_id');

           // print_r($quotation_id); ;


             if($customer_id_session!=$customer_id){
                 $quotation_id='';
            }



            if(empty($quotation_id))
            {
                $quotation_id = $this->customer_model->addRecord('ss_customer_quotation', $quot_data);
                $this->session->set_userdata('quotation_id', $quotation_id);
                $this->session->set_userdata('customer_id', $customer_id);
            }
           

            //End new code
            $response_data=[];
            $response_data['customer_id']=@$customer_id;
            $response_data['quotation_id']=@$quotation_id;



            $data['customer_id'] = @$customer_id;
            $data['quotation_id'] = @$quotation_id;
            $c_where = array('customer_id' => @$response_data['customer_id']);
            
            //$customer_data = $this->customer_model->getSingleRecord('ss_customer', $c_where);

           // $customer_data =$data;
            

            $quotation_data=$quot_data;

            $quotation_data = json_decode(json_encode($quotation_data));

             $customer_data = json_decode(json_encode($data_customer));

             if(empty($customer_data)){
               $customer_data = json_decode(json_encode($_POST));
             }


           // $data['datesprice'] = $dates;
            $data['customer_data'] = $customer_data;
            $data['warehouse_arrival'] = @$_POST['warehouse_arrival'];
            $data['hometype'] = @$_POST['hometype'];
            $data['quotation_data'] = @$quotation_data;
            $data['where_quotation_data'] = @$quot_data;
            $order_by = "coupen_id asc";
            $where = array('status' => '0', 'is_show_to_front' => 'on',);
            $data['coupen_list'] = $this->customer_model->getAllRecord('ss_coupen', $where, $order_by);
            /*for booking restriction*/
            $customer_city = @$_POST['customer_local_city'];
            $disabled_date_arr = array();
           // $disabled_date_arr = $this->pickup_avilable_timeslot($quotation_data->total_storage_charges, $customer_city);

            $today_date = date('Y-m-d'); // Get today's date
            $h_where = array(
            "ss_date_timeslot.city =" => $customer_city,
            "DATE(ss_date_timeslot.date) >=" => $today_date,
            "pickup"=>1
            );
            $holiday_date_list = $this->customer_model->get_holiday_list($h_where);
            if (!empty($holiday_date_list)) {
                foreach ($holiday_date_list as $key => $holiday_date) {
                    $disabled_date_arr[] = $holiday_date->date;
                }
            }
             $Arrival_Disabled_Dates_arr = array();
            $today_date = date('Y-m-d'); // Get today's date
            $h_where = array(
            "ss_date_timeslot.city =" => $customer_city,
            "DATE(ss_date_timeslot.date) >=" => $today_date,
            "warehouse"=>1
            );
            $holiday_date_list = $this->customer_model->get_holiday_list($h_where);
            if (!empty($holiday_date_list)) {
                foreach ($holiday_date_list as $key => $holiday_date) {
                    $Arrival_Disabled_Dates_arr[] = $holiday_date->date;
                }
            }


           //     print_r($disabled_date_arr);
           // print_r($customer_city);


           // print_r($disabled_date_arr);



            /*if(!empty($_POST['warehouse_arrival'])){*/
           
            // $Arrival_Disabled_Dates_arr = $this->arrival_avilable_timeslot($customer_city);
            /*}*/
            $data['disabled_date_arr'] = $disabled_date_arr;
            $data['arrival_disabled_date_arr'] = $Arrival_Disabled_Dates_arr;
            /*end*/
            $this->load->view('customer/step4_clone', $data);
            die;
        } else {
            $data["items_error"] = 'Please Select Inventory Items';
            $data["floor_list"] = $this->customer_model->getAllRecord('ss_floor', array('status' => '0'));
            $data["city_list"] = $this->customer_model->getAllRecord('ss_city', array('status' => '0'));
            $this->load->view('customer/step3', $data);
        }
    }

   public function send_details_emails(){

            $data=[];
            $response_data=$_POST;
             //echo"<pre>";print_r($_POST);
            $_POST['storage_item_slug']=explode("**",$_POST['storage_item_slug']);
            $_POST['storage_item_qty']=explode("**",$_POST['storage_item_qty']);
            $_POST['slug_array']=explode("**",$_POST['slug_array']);



           $_POST['storage_item_qty']=array_combine($_POST['slug_array'],$_POST['storage_item_qty']);


            $q_where = array('quotation_id' => @$response_data['quotation_id']);
            $quotation_data = $this->customer_model->getSingleRecord('ss_customer_quotation', $q_where);




            $c_where = array('customer_id' => @$response_data['customer_id']);
            $customer_data = $this->customer_model->getSingleRecord('ss_customer', $c_where);


            $b_where = array('home_type'=>$_POST['hometype']);
            $bhk_data = $this->customer_model->getSingleRecord('hometypeprice', $b_where);
            
            $new_where = array('home_type' => $_POST['hometype'],'city'=>$customer_data->customer_local_city);
            $bhk_dat = $this->customer_model->getSingleRecord('ss_new_transport_coupon', $new_where);
            $data['percent_coupon'] = $bhk_dat->percent_coupon;

             $storage_coupen = "safestorage-percent-" . $bhk_dat->percent_coupon;
              $transport_coupon = "safestorage-percent-" . $bhk_dat->trp_percent_coupon;
             $quotation_data->transport_token_amt=1000;
             
               //$tranposrt_price = $quotation_data->transport_token_amt;
               $tranposrt_price = 1000;

                if (!empty($customer_data->warehouse_arrival)) {
                    $tranposrt_price = 500;
                }

            /*maintain quotation price history & item*/
            $q_price_data = array('customer_id' => @$response_data['customer_id'], 'quotation_id' => @$response_data['quotation_id'], 'pickup_charges_with_gst' => $quotation_data->total_pickup_charges_with_gst, 'storage_charges_with_gst' => $quotation_data->total_storage_charges_with_gst, 'transport_due_charges' => $quotation_data->transport_due_charges, 'transport_token_amt' => $quotation_data->transport_token_amt,);
            $this->customer_model->addRecord('ss_quotation_old_price', $q_price_data);
            $current_item_list = $this->customer_model->getAllRecord('ss_customer_quotation_item', array('quotation_id' => @$response_data['quotation_id']));
            if (!empty($current_item_list)) {
                foreach ($current_item_list as $key => $item_list) {
                    $q_item_data = array('customer_id' => @$response_data['customer_id'], 'quotation_id' => @$response_data['quotation_id'], 'item_name' => $item_list->item_name, 'item_count' => $item_list->item_count,);
                    $this->customer_model->addRecord('ss_quotation_old_item', $q_item_data);
                }
            }
            /*end log*/


            $where = '';
            $order_by = "storage_item_name asc";
            $storage_item = $this->customer_model->getAllRecord('ss_refined_storage_item', $where, $order_by);
            $quotation_item_list = array();
            if (!empty($storage_item)) {
                foreach ($storage_item as $key => $item) {
                    $quotation_item_list[$item->storage_item_slug] = $item;
                }
            }


            $customer_id=$response_data['customer_id'];
            $quotation_id=$response_data['quotation_id'];
            if (!empty($_POST['storage_item_slug']) && !empty($quotation_item_list)) {

                foreach ($_POST['storage_item_slug'] as $item_slug) {

                    if (!empty(@$quotation_item_list[$item_slug])) {
                        $item = $quotation_item_list[$item_slug];
                        $item_count = @$_POST['storage_item_qty'][$item_slug];
                        $data1 = array('quotation_id' => $quotation_id, 'customer_id' => $customer_id, 'item_name' => $item->storage_item_name, 'item_slug' => $item_slug, 'item_count' => $item_count, 'storage_type_slug' => @$item->storage_type_slug,);
                        $this->customer_model->addRecord('ss_customer_quotation_item', $data1);
                    }
                }
            }

            $where = '';
            $order_by = "storage_item_name asc";
            //$storage_item = $this->customer_model->getAllRecord('ss_storage_item', $where, $order_by);
            $quotation_item_list = array();
            $std_pallet_point = 20;
            $std_pallet_charges = 1000;
            $total_storage_charges = 0;
            $input_pallet = 0;
            $item_point = 0;
            $storage_packing_charges = 0;
            $storage_item_charges = 0;
            $vehicle_price = 0.00;
            if (!empty($storage_item)) {
                foreach ($storage_item as $key => $item) {
                    if (in_array($item->storage_item_slug, $_POST['storage_item_slug'])) {
                        $quotation_item_list[] = $item;
                        $item_qty = @$_POST['storage_item_qty'][@$item->storage_item_slug];
                        $item_point+= ($item->storage_item_point * $item_qty);
                        $storage_packing_charges+= ($item->storage_packing_charges * $item_qty);
                        $storage_item_charges+= ($item->storage_item_charges_change * $item_qty);
                    }
                }
            }
            $input_pallet = number_format(($item_point / $std_pallet_point), 1, '.', '');
            $total_storage_charges = number_format((float)$storage_item_charges, 2, '.', '');
            $data['storage_item_qty'] = @$_POST['storage_item_qty'];
            $data['quotation_item_list'] = $quotation_item_list;
          
            $summery = [];
            foreach ($quotation_item_list as $key => $value) {
             

                if($value->storage_sub_type==''){
                        $summery[$value->storage_item_name] = 0;
                    }else{
                        $summery[$value->storage_sub_type] = 0;
                    }

            }
            $storage_item_qty_arr = $_POST['storage_item_qty'];
            foreach ($quotation_item_list as $key => $value) {
                if (!empty($storage_item_qty_arr[$value->storage_item_slug])) {
                    $qty = $storage_item_qty_arr[$value->storage_item_slug];

                    if($value->storage_sub_type==''){
                        $summery[$value->storage_item_name]+= $qty;
                    }else{
                        $summery[$value->storage_sub_type]+= $qty;
                    }
                }
            }



            /*get relationship manager*/
            $rm_where = array('user_id' => $customer_data->relationship_manager_id);
            $rm_data = $this->customer_model->getSingleRecord('ss_user', $rm_where);




             /*Send email to CRM USER */
                $this->load->library('email');
                $config['protocol'] = 'sendmail';
                $config['mailpath'] = '/usr/sbin/sendmail';
                $config['charset'] = 'utf-8';
                $config['wordwrap'] = TRUE;
                $config['mailtype'] = 'html';
               $welcome_note = "Hey " . @$rm_data->user_fname . " " . @$rm_data->user_lname;
            $welcome_note .= "A new lead or quotation has been created under your name. Please log into your dashboard to check. Customer Name  " . $customer_data->customer_name . " Customer Mobile " . $customer_data->customer_contact1;


            $this->email->from('info@safestorage.in');
            $this->email->to('laravel7777@gmail.com'); 
            $this->email->subject('New Enquiry - Safe Storage');
            $this->email->message($welcome_note);

                $this->email->send();
            /*Send email to CRM USER */
            
            
            $emaildata = [];
            $emaildata['summery'] = $summery;
            $emaildata['data'] = $data;
            $emaildata['customer_data'] = $customer_data;
            $emaildata['quotation_data'] = $quotation_data;

            $emaildata['transport_coupon'] = $transport_coupon;
            $emaildata['storage_coupen'] = $storage_coupen;

            $emaildata['rm_data'] = $rm_data;
            $emaildata['home_type'] = $_POST['hometype'];

            //$emaildata['inventory_list'] = $inventory_list_new;
            $c1_where = array('home_type' => $_POST['hometype']);
            $homevehicleType = $this->customer_model->getSingleRecord('hometypeprice', $c1_where);
            $emaildata['vehicle_type'] = @$homevehicleType->vehicle_type;
            $emaildata['warehouse_arrival'] = @$customer_data->warehouse_arrival;
            $matrix_user_list = array();
            if (!empty($rm_data)) {
                $user_where = array('ss_crm_user_level.user_id' => @$customer_data->relationship_manager_id);
                $matrix_user_list = $this->customer_model->get_escalation_matrix_user($user_where);
            }

             $emaildata['matrix_user_list'] = $matrix_user_list;


           // print_r($emaildata);die;

          //  $mail_body = $this->load->view('customer/customer_q_email', $emaildata, true);
            $mail_body = $this->load->view('customer/before_payment_quote', $emaildata, true);

            $welcome = '';
            ob_start();
            $date = date('Y-m-d H:i:s');
            $subject = $customer_data->customer_initial . " " . $customer_data->customer_name . ' | Quotation from SafeStorage | ' . "QT" . sprintf('%03d', $quotation_data->quotation_id);
            $welcome.= $mail_body;
            $welcome.= "<br/>";
            $welcome.= "<b>Thanks & Best Regards</b><br/>";
            $welcome.= "<span style='color:#05307f;'>SAFE STORAGE™ -<span> <span style='color:#ef5921;'>We Store Anything You Care!</span><br/>";
            $welcome.= "8088 84 84 84<br/>";
          /*  $welcome.= "Registered Address: #130/1, Hanumantha Gowda Compound,<br/>";
            $welcome.= "Immadihalli Rd, Whitefield, Bengaluru, Karnataka 560066<br/>";*/
            $welcome.= "info@safestorage.in | www.safestorage.in<br/><br/>";
            $this->load->library('email');
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->from('quote@safestorage.in');
           // $this->email->to($customer_data->customer_email);
           // $this->email->to('kushal143rachamadugu@gmail.com');
            $this->email->to('laravel7777@gmail.com');


           // $this->email->cc('safestorage.in@gmail.com');
            $this->email->subject($subject);
            $this->email->message($welcome);
            $this->email->send();


           


                 $customer_data->customer_contact1=$_POST['customer_contact1'];
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://media.smsgupshup.com/GatewayAPI/rest?method=OPT_IN&format=json&userid=2000221560&password=qjDf22jR&phone_number='.$rm_data->user_contact1. '&v=1.1&auth_scheme=plain&channel=WHATSAPP',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                ));

                $response = curl_exec($curl);
                curl_close($curl);


                $message_tocrm ="Hey+".$rm_data->user_fname."%0A%0AYou+have+received+new+quotation+please+find+details+below%0A%0ACustomer+Name+%3A-+".$customer_data->customer_name ."%0AMobile+%3A-+".$customer_data->customer_contact1."&isTemplate=true&header=New+Quotation+Received+%21";

                $header = "New+Quotation+Received+%21";

                 $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://media.smsgupshup.com/GatewayAPI/rest',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'method=SENDMESSAGE&userid=2000221560&password=qjDf22jR&msg=' .$message_tocrm . '&msg_type=TEXT&format=json&v=1.1&auth_scheme=plain&send_to=' .$rm_data->user_contact1. '&isTemplate=true&header=' . $header,
                CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
                ));

                $response1 = curl_exec($curl);
                curl_close($curl);

          //End


                $mob_no = $customer_data->customer_contact1;
                $cust_mob = '91'.@$_POST['customer_contact1'];
               
                $mobile = $cust_mob;
                $cust_name=$customer_data->customer_name;
                $manager=@$rm_data->user_contact1 . " (" . @$rm_data->user_fname . ' ' . @$rm_data->user_lname . ")";
                $token=$tranposrt_price;
                $quotation_id = $quotation_data->quotation_id;
                $security_code = $quotation_data->payment_security_code;


                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://media.smsgupshup.com/GatewayAPI/rest?method=OPT_IN&format=json&userid=2000221560&password=qjDf22jR&phone_number=' . $mobile . '&v=1.1&auth_scheme=plain&channel=WHATSAPP',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                ));

                $response = curl_exec($curl);
                curl_close($curl);


            $message="Dear+".$cust_name."%0A%0AGreetings+From+SafeStorage%0A%0AWe+have+shared+the+Quotation+in+email+for+your+review.+Pay+token+advance+of+".$token."+to+book+your+pickup+slot%21%0A%0AOur+relationship+manager+-+".$manager."+will+be+assisting+for+any+queries";
            $header = "Quotation+From+SafeStorage";
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://media.smsgupshup.com/GatewayAPI/rest',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => 'method=SENDMESSAGE&userid=2000221560&password=qjDf22jR&msg=' .$message . '&msg_type=TEXT&format=json&v=1.1&auth_scheme=plain&send_to=' . $mobile . '&isTemplate=true&header=' . $header.'&buttonUrlParam=customer%2Fpickup_booking%3Fid%3D'.$quotation_id.'%26code%3D'.$security_code,
              CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
            ));

            $response1 = curl_exec($curl);
            curl_close($curl);


                if(!empty($rm_data)){
              
                 $sms_msg ="Hi ". $customer_data->customer_name.", We have received your request, Our representative ".@$rm_data->user_contact1." (".@$rm_data->user_fname.' '.@$rm_data->user_lname."), will get in touch with you at the earliest. whatsapp  link - https://wa.me/".$rm_data->user_contact1." Thank you!";

                $curl = curl_init();

                  curl_setopt_array($curl, array(
                  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=nHxbTYe1vJR8rsPclWyCF4DEa3B0QKAUONqziu5mk6p9VfghIwTk0DMX1tHh8OYKg3wL4xQfURJ9SdGj&route=q&message=".urlencode($sms_msg)."&language=english&numbers=".urlencode($mob_no),
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_SSL_VERIFYHOST => 0,
                  CURLOPT_SSL_VERIFYPEER => 0,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "GET",
                  CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache"
                  ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);
                /* echo $response;die();*/
                curl_close($curl);
            }

            echo "success";
            die;

    }


    

   
    public function paytm_token_response() {

       


        header("Pragma: no-cache");
        header("Cache-Control: no-cache");
        header("Expires: 0");
        // following files need to be included
        require_once (APPPATH . "/third_party/paytm/lib/config_paytm.php");
        require_once (APPPATH . "/third_party/paytm/lib/encdec_paytm.php");
        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";
        $paramList = $_POST;
        $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
        //Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
        $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
        if ($isValidChecksum == "TRUE") {
            /* echo "<pre>";print_r($_POST);die();*/
            if (@$_POST["STATUS"] == "TXN_SUCCESS") {
                $session_quotation_id = trim($_GET['id']??'');
                $session_pickup_type = $_GET['pickup_type'];
                $where = array('quotation_id' => $session_quotation_id);
                $quotation_data = $this->customer_model->getSingleRecord('ss_customer_quotation', $where);
                $session_cust_id = trim($_GET['customer_id']??'');
                /*check unique trnsaction*/
                $exist_trns_data = array();
                $bank_transaction_id = $_POST['TXNID'];
                $tr_where = array('transaction_id' => $bank_transaction_id);
                $exist_trns_data = $this->customer_model->getSingleRecord('ss_customer_transaction', $tr_where);
                if (!empty($exist_trns_data)) {
                    $this->session->set_flashdata('transaction_err_msg', "Transaction Id already exist.Team will contact you soon");
                    redirect('customer/transaction_cancel');
                    die();
                } else {
                    $where = array('customer_id' => $session_cust_id);
                    $customer_data = $this->customer_model->getSingleRecord('ss_customer', $where);
                    /*for create new unique customer id for differentiate active customer*/
                    $customer_id_where = array('customer_id' => $session_cust_id);
                    $customer_id_data = $this->customer_model->getSingleRecord('ss_customer_auto_id', $customer_id_where);
                    $order_by = "auto_id DESC";
                    if (!empty($customer_id_data)) {
                        $customer_unique_id = $customer_data->customer_unique_id;
                    } else {
                        $customer_id_row = $this->customer_model->getOrderBySingleRecord('ss_customer_auto_id', array(), $order_by);
                        if (!empty($customer_id_row->customer_inc_id)) {
                            $customer_inc_id = ($customer_id_row->customer_inc_id + 1);
                        } else {
                            /*if id is empty then start first entry*/
                            $customer_inc_id = $customer_id_row->start_customer_id;
                        }
                        $auto_data = array('customer_inc_id' => $customer_inc_id, 'customer_id' => $session_cust_id,);
                        $this->customer_model->addRecord('ss_customer_auto_id', $auto_data);
                        /*create unique customer id*/
                        $order_by = "storage_type_id ASC";
                        $customer_storage = $this->customer_model->getOrderBySingleRecord('ss_customer_storage_type', $customer_id_where, $order_by);
                        $city = substr(ucfirst($customer_data->customer_local_city), 0, 1);
                        $storage_type_slug = substr(ucfirst($customer_storage->storage_slug), 0, 1);
                        $customer_unique_id = $city . $storage_type_slug . sprintf("%03d", $customer_inc_id);
                        $data = array('customer_unique_id' => $customer_unique_id,);
                        $where = array('customer_id' => $session_cust_id);
                        $this->customer_model->updateRecord('ss_customer', $data, $where);
                    }
                    /*end new id genration*/
                    $cdata = array('is_customer' => '1', 'payment_type' => 'monthly',);
                    /*auto assign relationship manager to customer*/
                    $inv_user_where = "invoice_user_id IS NOT NULL";
                    $order_by = 'customer_id desc';
                    $last_customer_data = $this->customer_model->getOrderBySingleRecord('ss_customer', $inv_user_where, $order_by);
                    if (!empty($last_customer_data->invoice_user_id)) {
                        $invoice_user_id = $last_customer_data->invoice_user_id;
                        $invoice_user_data = array();
                        $order_by = 'user_id asc';
                        $r_where = "role_id ='8' AND (user_id > '" . $invoice_user_id . "') AND status='0'";
                        $invoice_user_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                        if (!empty($invoice_user_data)) {
                            $cdata['invoice_user_id'] = @$invoice_user_data->user_id;
                        } else {
                            $invoice_user_data = array();
                            $order_by = 'user_id asc';
                            $r_where = array('role_id' => '8', 'status' => '0');
                            $invoice_user_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                            $cdata['invoice_user_id'] = @$invoice_user_data->user_id;
                        }
                    } else {
                        $order_by = 'user_id desc';
                        $r_where = array('role_id' => '8', 'status' => '0');
                        $invoice_user_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                        $cdata['invoice_user_id'] = @$invoice_user_data->user_id;
                    }
                    $order_by = 'user_id desc';
                    $r_where = array('role_id' => '8', 'status' => '0');
                    $invoice_user_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                    $cdata['invoice_user_id'] = @$invoice_user_data->user_id;
                    /*end auto assign*/
                    $cdata['status'] = '0';
                    $where = array('customer_id' => $session_cust_id);
                    $this->customer_model->updateRecord('ss_customer', $cdata, $where);
                    /*for add user info */
                    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                    $password = substr(str_shuffle($chars), 0, 8);
                    $user_data = array('user_password' => base64_encode(trim($password??'')), 'user_type' => 'customer', 'user_email' => $customer_data->customer_email, 'customer_id' => $session_cust_id, 'role_id' => '6', 'user_fname' => $customer_data->customer_name, 'user_lname' => '', 'user_contact1' => $customer_data->customer_contact1, 'user_contact2' => $customer_data->customer_contact2, 'user_address' => $customer_data->permanent_address,);
                    $user_row = $this->customer_model->getSingleRecord('ss_user', $where);
                    if (empty(@$user_row->customer_id)) {
                        $this->customer_model->addRecord('ss_user', $user_data);
                    }
                    /*add transaction info*/
                    $transaction_type = '';
                    $msg = '';
                    if ($session_pickup_type == "pickup") {
                        $msg = 'SafeStorage Transport (Advance Token) charges paid through paytm';
                        $transaction_type = 'safestorage_transport';
                    } else if ($session_pickup_type == "vendor_transport") {
                        $msg = 'Vendor Transport charges paid through paytm';
                        $transaction_type = 'vendor_transport';
                    } else {
                        $msg = 'Warehouse arrival (Advance Token) charges paid through paytm';
                        $transaction_type = 'stacking_barcoding';
                    }
                    /*add referral code amount into wallet*/
                    if ($transaction_type == 'stacking_barcoding') {
                        $w_where = array('customer_id' => $session_cust_id,);
                        $wallet_data = $this->customer_model->getSingleRecord('ss_customer_wallet', $w_where);
                        if (!empty($wallet_data)) {
                            $new_amt = $wallet_data->wallet_amount + 500;
                            $w_data = array('wallet_amount' => $new_amt,);

                            $w_data['old_amount'] = $wallet_data->wallet_amount;
                            $w_data['updated_at'] = date('Y-m-d H:i:s');

                            $this->customer_model->updateRecord('ss_customer_wallet', $w_data, $w_where);
                        } else {
                            $w_data = array('wallet_amount' => 500, 'customer_id' => $session_cust_id,);
                            $this->customer_model->addRecord('ss_customer_wallet', $w_data);
                        }
                        /*log*/
                        $message = "Wallet has been credited with 500 for warehouse arrival";
                        $insert = array('message' => $message, 'customer_id' => $session_cust_id, 'created_at' => date('Y-m-d H:i:s'), 'log_type' => 'receivable_bill',);
                        $this->customer_model->addRecord('ss_customer_log', $insert);
                    }
                    /*end wallet section*/
                    $city = $customer_data->customer_local_city;
                    $where = array('customer_local_city' => $city);
                    $invoice_no = $this->customer_model->get_invoice_no($where);
                    /*check exist invoice no*/
                    $invoice_where = array('invoice_no' => $invoice_no);
                    $is_exist_invoice = $this->customer_model->check_exist_invoice($invoice_where);
                    if (!empty($is_exist_invoice)) {
                        $new_invoice_no = $this->customer_model->genrate_invoice_no($is_exist_invoice->invoice_no, $city);
                        $invoice_no = $new_invoice_no;
                    }
                    /*end invoice checking*/
                    $substitute_tax = 0;
                    if ($transaction_type == 'stacking_barcoding') {
                        $substitute_tax = 18;
                    }
                    $transaction_record = array('customer_id' => $session_cust_id, 'paid_amount' => @$_POST['TXNAMOUNT'], 'transaction_id' => @$_POST['TXNID'], 'transaction_order_id' => @$_POST['ORDERID'], 'transaction_created_at' => date('Y-m-d H:i:s'), 'transaction_note' => $msg, 'payment_type' => "online", 'transaction_type' => $transaction_type, 'invoice_no' => $invoice_no, 'substitute_tax' => $substitute_tax,);
                   // $cust_transaction_id = $this->customer_model->addRecord('ss_customer_transaction', $transaction_record);
                    if (!$cust_transaction_id = $this->common_model->addTransaction('ss_customer_transaction', $transaction_record)) {
                         $transaction_record = array('customer_id' => $session_cust_id, 'paid_amount' => @$_POST['TXNAMOUNT'], 'transaction_id' => @$_POST['TXNID'], 'transaction_order_id' => @$_POST['ORDERID'], 'transaction_created_at' => date('Y-m-d H:i:s'), 'transaction_note' => $msg, 'payment_type' => "online", 'transaction_type' => $transaction_type, 'invoice_no' => $invoice_no.'D', 'substitute_tax' => $substitute_tax,);
                    $cust_transaction_id = $this->customer_model->addRecord('ss_customer_transaction', $transaction_record); 
                    }
                    /*get coupon data if coupen is available*/
                    $coupon_where = array('quotation_id' => $session_quotation_id,);
                    $cp_order_by = "transport_coupon_id desc";
                    $quot_coupon_data = $this->customer_model->getOrderBySingleRecord('ss_quotation_transport_coupon', $coupon_where, $cp_order_by);
                    // disable confirm and pay link

                    //for transport coupon new added by kiran
                     $cp_new_order_by = "";
                    $quot_coupon_data_new = $this->customer_model->getOrderBySingleRecord('ss_customer_quotation',$coupon_where, $cp_new_order_by);


                    $qt_where = array('quotation_id' => $session_quotation_id,);
                    $qt_data = array('is_valid_link' => '1', 'is_available' => 'no');
                    if (!empty($quot_coupon_data)) {
                        $unformated_pickup_charges = ($quot_coupon_data->transport_token_amt + $quot_coupon_data->transport_due_charges);
                        $pickup_charges = number_format($unformated_pickup_charges, 2, '.', '');
                        $qt_data['pickup_charges'] = $pickup_charges;
                        $qt_data['total_pickup_charges'] = $pickup_charges;
                        $qt_data['total_pickup_charges_with_gst'] = $pickup_charges;
                        $qt_data['transport_token_amt'] = $quot_coupon_data->transport_token_amt;
                        $qt_data['transport_due_charges'] = $quot_coupon_data->transport_due_charges;
                        $qt_data['transport_coupon'] = @$quot_coupon_data_new->transport_coupon;
                        $qt_data['storage_coupen'] = $quot_coupon_data->coupon_code;
                    }
                    $this->customer_model->updateRecord('ss_customer_quotation', $qt_data, $qt_where);
                    /*get manger id*/
                    $where = array('user_city' => $customer_data->customer_local_city, 'role_id' => '2', //manager
                    );
                    $manager_data = $this->customer_model->getSingleRecord('ss_user', $where);
                    $commission_data = $this->customer_model->getOrderBySingleRecord('ss_transport_commission', array('status' => '0'), 'commission_id desc');
                    $vt_id = null;
                    if ($session_pickup_type == "vendor_transport") {
                        $vt_id = $quotation_data->vendor_transport_id;
                    }
                    $order_data = array('customer_id' => $session_cust_id, 'manager_id' => @$manager_data->user_id, 'quotation_id' => $session_quotation_id, 'order_timeslot' => @$customer_data->pickup_timeslot, 'order_schedule_date' => $customer_data->pickup_date, 'order_address' => $customer_data->pickup_address, 'order_type' => 'pickup', 'order_sub_type' => @$session_pickup_type, 'is_confirmed' => 'Yes', 'order_status' => 'pending', 'order_created_at' => date('Y-m-d H:i:s'), 'vt_id' => $vt_id, 'ss_commission_percent' => @$commission_data->commission_percent,);
                    $order_id = $this->customer_model->addRecord('ss_order', $order_data);
                    /*update transaction with  order id */
                    $tr_data = array('pickup_order_id' => $order_id,);
                    $tr_where = array('cust_transaction_id' => $cust_transaction_id,);
                    $this->customer_model->updateRecord('ss_customer_transaction', $tr_data, $tr_where);
                    /*end*/
                    /*manager notification*/
                    if (!empty($manager_data)) {
                        $email_id = $manager_data->user_email;
                        $welcome = "Dear Sir,<br/><br/>";
                        $welcome.= "New <b>pickup</b> work order has been created with following Details.<br/><br>";
                        $welcome.= "Customer Name : " . $customer_data->customer_initial . " " . $customer_data->customer_name . "<br/>";
                        $welcome.= "Pickup Address : " . $customer_data->pickup_address . "<br/>";
                        $welcome.= "Pickup Date : " . date('d/m/Y', strtotime($customer_data->pickup_date)) . "<br/>";
                        /*$welcome  .="Pickup Timeslot : ".$customer_data->pickup_timeslot."<br/><br/>";*/
                        $welcome.= "For further details login to your account.<br/><br/>";
                        $welcome.= "Thanks & Best Regards<br/>";
                        $welcome.= "<span style='color:#05307f;'>SAFE STORAGE™ -<span> <span style='color:#ef5921;'>We Store Anything You Care!</span><br/>";
                      $welcome.= "  8088 84 84 84<br/>";
        
                        $welcome.= "info@safestorage.in | www.safestorage.in<br/><br/>";$this->load->library('email');
                        $config['protocol'] = 'sendmail';
                        $config['mailpath'] = '/usr/sbin/sendmail';
                        $config['charset'] = 'utf-8';
                        $config['wordwrap'] = TRUE;
                        $config['mailtype'] = 'html';
                        $this->email->initialize($config);
                        $this->email->from('safestorage.in@gmail.com');
                        $this->email->to($email_id);
                        $this->email->subject("New Work Order", "Safestorage");
                        $this->email->message($welcome);
                        $this->email->send();
                    }
                    /*for customer notification of account and payment*/
                    $city_list = $this->customer_model->getAllRecord('ss_city', array('status' => '0'));
                    $u_where = array('customer_id' => $session_cust_id);
                    $user_row = $this->customer_model->getSingleRecord('ss_user', $u_where);
                    $email_id = $customer_data->customer_email;
                    $emaildata = array();
                    $emaildata['password'] = base64_decode(@$user_row->user_password);
                    $emaildata['customer_data'] = @$customer_data;
                    $emaildata['quotation_data'] = @$quotation_data;
                    $emaildata['city_list'] = @$city_list;
                    /*get relationship manager*/
                    $rm_where = array('user_id' => @$customer_data->relationship_manager_id);
                    $rm_data = $this->customer_model->getSingleRecord('ss_user', $rm_where);
                    $emaildata['rm_data'] = @$rm_data;
                    $matrix_user_list = array();
                    if (!empty($rm_data)) {
                        $user_where = array('ss_crm_user_level.user_id' => @$customer_data->relationship_manager_id);
                        $matrix_user_list = $this->customer_model->get_escalation_matrix_user($user_where);
                    }
                    $emaildata['matrix_user_list'] = $matrix_user_list;
                    /*end r m*/
                    $mail_body = $this->load->view('customer/customer_confirm_email', $emaildata, true);
                    $welcome = '';
                    ob_start();
                    $date = date('Y-m-d H:i:s');
                    $subject = "Pickup confirmation";
                    $welcome.= $mail_body;
                    $welcome.= "<br/>";
                    $this->load->library('email');
                    $config['protocol'] = 'sendmail';
                    $config['mailpath'] = '/usr/sbin/sendmail';
                    $config['charset'] = 'utf-8';
                    $config['wordwrap'] = TRUE;
                    $config['mailtype'] = 'html';
                    $this->email->initialize($config);
                    $this->email->from('service@safestorage.in');
                    $this->email->to($email_id);
                    $this->email->cc('safestorage.in@gmail.com');
                    $this->email->subject($subject);
                    $this->email->message($welcome);
                    $this->email->send();

$tomorrow_date = date('Y-m-d', strtotime('+1 day'));
$where = array('customer_id' => $session_cust_id);
$get_order_data = $this->customer_model->getSingleRecord('ss_order', $where);
$cust_ordertype_date = $get_order_data->order_schedule_date;




if($tomorrow_date == $cust_ordertype_date){
              

$mobile = 7411894740;


$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://media.smsgupshup.com/GatewayAPI/rest?method=OPT_IN&format=json&userid=2000221560&password=qjDf22jR&phone_number=' . $mobile . '&v=1.1&auth_scheme=plain&channel=WHATSAPP',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
curl_close($curl);

                  $where = array('customer_id' => $session_cust_id);
            $get_customer_data = $this->customer_model->getSingleRecord('ss_customer', $where);

                        $cust_name = $get_customer_data->customer_name; 
                        $cust_second=$get_customer_data->customer_contact1;
                        $cust_id = $get_customer_data->customer_unique_id;
                        $cust_orderdate = date('d/m/Y', strtotime($get_customer_data->pickup_date));

                        // $get_data = $this->common_model->getSingleRecord('ss_order',$where);



            $where = array('customer_id' => $session_cust_id);
            $get_order_data = $this->customer_model->getSingleRecord('ss_order', $where);
            $cust_ordertype = $get_order_data->order_sub_type;




                    $message_to_transport ="Hey+Gangadhar%0A%0AYou+have+received+new+work+order+%0A%0ACustomer+Name++-+" .$cust_name . "%0ACustomer+Mobile+-" .$cust_second. "%0ASchedule+Date++-" .$cust_orderdate. "%0ACustomer+ID+-" . $cust_id. "%0AOrder+Type-" . $cust_ordertype;

                $header = "New+work+order+received";

                 $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://media.smsgupshup.com/GatewayAPI/rest',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'method=SENDMESSAGE&userid=2000221560&password=qjDf22jR&msg=' .$message_to_transport . '&send_to=' .$mobile. '&v=1.1&format=json&msg_type=TEXT&isTemplate=true&header=' . $header,
                CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
                ));

                $response1 = curl_exec($curl);
                curl_close($curl);
            }else{
                echo "Pickup Date is not tomorrow";
            }




                    $this->session->set_flashdata('transaction_success_msg', 'Your booking is confirmed');
                    redirect('customer/transaction_success');
                    /*for genrate barcode*/
                    //$this->send_invoice($cust_transaction_id);
                    /*$this->genrate_barcode($session_quotation_id,$order_id);*/
                

                //Whatsapp integration

                    





                } /*end not empty transaction checking*/

            } else {
                //$session_cust_id = trim($_GET['customer_id']);
                $session_quotation_id = trim($_GET['id']??'');
                $q_where = array('quotation_id' => @$session_quotation_id);
                $quot_data = $this->customer_model->getSingleRecord('ss_customer_quotation', $q_where);
                $this->session->set_flashdata('transaction_err_msg', $_POST["RESPMSG"]);
                redirect('customer/transaction_cancel_pay/' . $session_quotation_id . '/' . $quot_data->payment_security_code);
            }
        } else {
            /*$this->session->set_flashdata('transaction_err_msg',"");
             redirect('auth/transaction_cancel');*/
        }
    }


    public function transaction_success() {
        /* $data = array();
        $this->load->view('frontend/new/new_header',$data);
        $this->load->view('payment_response',$data);   
        $this->load->view('frontend/new/new_footer'); */
        $data = [];
        $this->load->view('frontend/new/new_header', $data);
        $this->load->view('customer/thank_you', $data);
        $this->load->view('frontend/new/new_footer');
    }
    public function transaction_cancel_pay($qut = null, $code = null) {
        /* $data = array();
        $this->load->view('frontend/new/new_header',$data);
        $this->load->view('payment_response',$data);   
        $this->load->view('frontend/new/new_footer');*/
        $data = [];
        $data['quotation_id'] = $qut;
        $data['security_code'] = $code;
        $this->load->view('frontend/new/new_header', $data);
        $this->load->view('customer/cancel_transcation', $data);
        $this->load->view('frontend/new/new_footer');
    }
    public function transaction_cancel() {
        /* $data = array();
        $this->load->view('frontend/new/new_header',$data);
        $this->load->view('payment_response',$data);   
        $this->load->view('frontend/new/new_footer');*/
        $data = [];
        //$data['quotation_id']=$qut;
        // $data['security_code']=$code;
        $this->load->view('frontend/new/new_header', $data);
        $this->load->view('customer/cancel_transcation_new', $data);
        $this->load->view('frontend/new/new_footer');
    }
    public function genrate_barcode($quotation_id = null, $order_id = null) {
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
        if ($quotation_id) {
            //
            $where = array('quotation_id' => $quotation_id,);
            $quotation_data = $this->customer_model->getSingleRecord('ss_customer_quotation', $where);
            if (!empty($quotation_data)) {
                //
                $where = array('customer_id' => $quotation_data->customer_id,);
                $customer_data = $this->customer_model->getSingleRecord('ss_customer', $where);
                if (!empty($quotation_data)) {
                    $where = array('quotation_id' => $quotation_id, 'customer_id' => $customer_data->customer_id,);
                    $item_list = $this->customer_model->getAllRecord('ss_customer_quotation_item', $where);
                    $storage_item_list = $this->customer_model->getAllRecord('ss_storage_item', array());
                    $storage_item_arr = [];
                    foreach ($storage_item_list as $key => $storage_item) {
                        $storage_item_arr[$storage_item->storage_item_slug] = $storage_item;
                    }
                    //
                    $customer_unique_id = str_replace("P1", "", $customer_data->customer_unique_id);
                    if (!empty($item_list)) {
                        $inc = 0;
                        $inv_last_where = array('customer_id' => $customer_data->customer_id);
                        $inv_last_order = "inventory_id DESC";
                        $inventory_last_item = $this->customer_model->getOrderBySingleRecord('ss_order_inventory', $inv_last_where, $inv_last_order);
                        $inc = @$inventory_last_item->goods_auto_part + 1;
                        $barcode_data = [];
                        foreach ($item_list as $key => $item) {
                            if (!empty($storage_item_arr[$item->item_slug])) {
                                $storage_item_data = $storage_item_arr[$item->item_slug];
                                if ($item->item_count > 1) {
                                    $index_count = 1;
                                    for ($index = 0;$index < $item->item_count;$index++) {
                                        $random_no = rand(10000, 99999);
                                        $code = $customer_unique_id . 'P' . $inc;
                                        $barcode_data = array('customer_id' => $customer_data->customer_id, 'order_id' => $order_id, 'quotation_id' => $quotation_id, 'barcode' => $code, 'barcode_image' => '', 'goods_name' => $item->item_name . '_' . $index_count, 'goods_type' => $storage_item_data->storage_item_type, 'goods_slug' => $item->item_slug, 'goods_quantity' => 1, 'goods_qty_slug' => $item->item_slug . $random_no, 'goods_point' => $storage_item_data->storage_item_point, 'goods_auto_part' => $inc, 'vehicle_price' => $storage_item_data->storage_item_unit_price,);
                                        $this->customer_model->addRecord('ss_order_inventory', $barcode_data);
                                        $index_count++;
                                        $inc++;
                                    }
                                } else {
                                    $random_no = rand(10000, 99999);
                                    $code = $customer_unique_id . 'P' . $inc;
                                    $barcode_data = array('customer_id' => $customer_data->customer_id, 'order_id' => $order_id, 'quotation_id' => $quotation_id, 'barcode' => $code, 'barcode_image' => '', 'goods_name' => $item->item_name, 'goods_type' => $storage_item_data->storage_item_type, 'goods_slug' => $item->item_slug, 'goods_quantity' => $item->item_count, 'goods_qty_slug' => $item->item_slug . $random_no, 'goods_point' => $storage_item_data->storage_item_point, 'goods_auto_part' => $inc, 'vehicle_price' => $storage_item_data->storage_item_unit_price,);
                                    $this->customer_model->addRecord('ss_order_inventory', $barcode_data);
                                    $inc++;
                                }
                            }
                            /*$image_code = Zend_Barcode::draw('code128', 'image', array('text' => $code), array());
                             imagejpeg($image_code, "./upload/barcode/$code.jpg", 150);*/
                        }
                    }
                    /*genrate code and image*/
                }
            }
        }
    }
    public function header_offer() /****Marquee showing offer in header ***/ {
        $offer = array();
        $table_name = "tbl_offer";
        $where = array('status' => '1');
        $order_by = array('order_by' => 'offerId DESC');
        $offer_info = $this->auth_model->getRecords($table_name, $where, $order_by);
        return $offer_info;
    }
   
    public function get_selected_storage_item() {
        $data = [];
        if (!empty($_POST['storage_type'])) {
            $string = "'" . implode("','", $_POST['storage_type']) . "'";
            //die;
            // $string =  "'" .$_POST['storage_type']. "'";;
            $where = "storage_type_slug IN ($string)";
            $data["storage_type_list"] = $this->customer_model->get_storage_type_list($where);
        }
        $where = '';
        $storage_item = $this->customer_model->get_storage_item($where);
        /*echo "<pre>";print_r($storage_item);die();*/
        $quotation_item_list = array();
        if (!empty($storage_item)) {
            foreach ($storage_item as $key => $item) {
                $quotation_item_list[$item->storage_type_slug][] = $item;
            }
        }
        $data['quotation_item_list'] = $quotation_item_list;
        /******************************************************/
        /*while edit quotation following parameter is passed*/
        $data['customer_quotation_item'] = [];
        if (!empty($_POST['quotation_id'])) {
            $quotation_id = $_POST['quotation_id'];
            $where = array('quotation_id' => $quotation_id);
            $customer_quotation_item = $this->customer_model->getAllRecord('ss_customer_quotation_item', $where);
            $data['customer_quotation_item'] = $customer_quotation_item;
            $exist_item_count = count($customer_quotation_item);
            $data['exist_item_count'] = $exist_item_count;
            /*echo "<pre>";print_r($customer_quotation_item);die();*/
        }
        /*echo "<pre>";print_r($data['quotation_item_list']);die();*/
        $this->load->view('ajax_item_section', $data);
    }



    public function get_selected_storage_item_k() {
        $id = '';
        $lead_relationship_manager_id = '';
        $exist_lead = array();
        $e_where = array('customer_email' => trim($_POST['customer_email']??''));
        $m_where = array('customer_mobile_no' => trim($_POST['customer_contact1']??''));
        $cust_email_exist = $this->customer_model->getSingleRecord('ss_leads', $e_where);
        $cust_contact_exist = $this->customer_model->getSingleRecord('ss_leads', $m_where);
        if (!empty($cust_email_exist) || !empty($cust_contact_exist)) {
            if (!empty($cust_contact_exist) &&  @$_POST['customer_contact1']!='') {
                $id = $cust_contact_exist->id;
                $lead_relationship_manager_id = $cust_contact_exist->relationship_manager_id;
                $exist_lead = $cust_contact_exist;
            }
            if (!empty($cust_email_exist) &&  @$_POST['customer_email']!='') {
                $id = $cust_email_exist->id;
                $lead_relationship_manager_id = $cust_email_exist->relationship_manager_id;
                $exist_lead = $cust_email_exist;
            }
        }
        
         $e_quotation_leads_where = array('email' => trim($_POST['customer_email']??''));
        $m_quotation_leads_where = array('mobile_no' => trim($_POST['customer_contact1']??''));
         $cust_quotation_leads_email_exist = $this->customer_model->getSingleRecord('ss_quotation_leads', $e_quotation_leads_where);
        $cust_quotation_leads_contact_exist = $this->customer_model->getSingleRecord('ss_quotation_leads', $m_quotation_leads_where);

        if (empty($cust_quotation_leads_email_exist) && empty($cust_quotation_leads_contact_exist)) {
            
             $insert_data = array('name' => htmlspecialchars(trim($_POST['customer_name']??'')), 'email' => htmlspecialchars(trim($_POST['customer_email']??'')), 'mobile_no' => htmlspecialchars(trim($_POST['customer_contact1']??'')), 'storage_type' => 'household_storage', 'status' => '0', 'created_at' => date('Y-m-d H:i:s'),'step_visitied' => '2');
             $this->customer_model->addRecord('ss_quotation_leads', $insert_data);
        }

        
        /*check in customer table*/
        $customer_id = '';
        $c_relationship_manager_id = '';
        $c_e_where = array('customer_email' => trim($_POST['customer_email']??''));
        $c_m_where = array('customer_contact1' => trim($_POST['customer_contact1']??''));

        $email_exist='';
        $contact_exist='';

        if(isset($_POST['customer_email']) && @$_POST['customer_email']!=''){
              $email_exist = $this->customer_model->getSingleRecord('ss_customer', $c_e_where);
        }

        if(isset($_POST['customer_contact1']) && $_POST['customer_contact1']!=''){
              $contact_exist = $this->customer_model->getSingleRecord('ss_customer', $c_m_where);
        }

        // $email_exist = $this->customer_model->getSingleRecord('ss_customer', $c_e_where);
        // $contact_exist = $this->customer_model->getSingleRecord('ss_customer', $c_m_where);
        if (!empty($email_exist) || !empty($contact_exist)) {
            if (!empty($contact_exist)) {
                $customer_id = $contact_exist->customer_id;
                $c_relationship_manager_id = $contact_exist->relationship_manager_id;
            }
            if (!empty($email_exist)) {
                $customer_id = $email_exist->customer_id;
                $c_relationship_manager_id = $email_exist->relationship_manager_id;
            }
        }
        $l_data = array('customer_name' => htmlspecialchars(trim($_POST['customer_name']??'')), 'customer_email' => htmlspecialchars(trim($_POST['customer_email']??'')), 'customer_mobile_no' => htmlspecialchars(trim($_POST['customer_contact1']??'')), 'storage_type' => 'household_storage', 'status' => '0', 'date' => date('Y-m-d H:i:s'));
        /*auto assign relationship manager to customer*/
        $order_by = 'id desc';
        $last_customer_data = $this->customer_model->getOrderBySingleRecord('ss_leads', array(), $order_by);
        if (!empty($last_customer_data->relationship_manager_id)) {
            $r_m_id = $last_customer_data->relationship_manager_id;
            $r_manager_data = array();
            $order_by = 'user_id asc';
            //$r_where = "role_id ='5' AND (user_id > '" . $r_m_id . "')";
            $r_where = "role_id ='5' AND status='0' AND (user_id > '" . @$r_m_id . "')";
            $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
            if (!empty($r_manager_data)) {
                $l_data['relationship_manager_id'] = @$r_manager_data->user_id;
            } else {
                $r_manager_data = array();
                $order_by = 'user_id asc';
                $r_where = array('role_id' => 5, 'status' => '0');
                $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                $l_data['relationship_manager_id'] = @$r_manager_data->user_id;
            }
        } else {
            $order_by = 'user_id asc';
            $r_where = array('role_id' => '5', 'status' => '0');
            $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
            $l_data['relationship_manager_id'] = @$r_manager_data->user_id;
        }
        if (!empty($lead_relationship_manager_id)) {
            $l_data['relationship_manager_id'] = $lead_relationship_manager_id;
        }
        if (!empty($exist_lead) && $exist_lead->is_converted_to_quot == '1') {
            $l_data['is_converted_to_quot'] = '1';
        }
        /*check in customer table*/
        if (!empty($c_relationship_manager_id)) {
            $l_data['relationship_manager_id'] = $c_relationship_manager_id;
        }
        if (!empty($customer_id)) {
            $l_data['is_converted_to_quot'] = '1';
        }



        if(isset($_POST['customer_contact1']) && $_POST['customer_contact1']!='' && empty($cust_contact_exist)){
            $this->customer_model->addRecord('ss_leads', $l_data);
            $row = array('relationship_manager_id' =>$l_data['relationship_manager_id']);
            $where = array('email' => trim($_POST['customer_email']??''));
            $this->customer_model->updateRecord('ss_quotation_leads', $row, $where);
        }


        // $this->customer_model->addRecord('ss_leads', $l_data);


        // $row = array('relationship_manager_id' =>$l_data['relationship_manager_id']);
        // $where = array('email' => trim($_POST['customer_email']??''));
        // $this->customer_model->updateRecord('ss_quotation_leads', $row, $where);
        // $pickupAddress = $_POST['pickup_address'] ?? '';
        // $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($pickupAddress) . '&key=YOUR_API_KEY');
        // $geocode = json_decode($geocode);
        
        // $pincode = null;
        // if ($geocode && isset($geocode->results) && !empty($geocode->results)) {
        //     $addressComponents = $geocode->results[0]->address_components;
        //     foreach ($addressComponents as $component) {
        //         if (in_array('postal_code', $component->types)) {
        //             $pincode = $component->long_name;
        //             break;
        //         }
        //     }
        // }


        
        $data = [];
        $data['hometype'] = [];
        if (!empty($_POST['storage_type'])) {
            $string = "'" . $_POST['storage_type'] . "'";;
            $where = "storage_type_slug IN ($string)";
            $data["storage_type_list"] = $this->customer_model->get_storage_type_list($where);
        }
        $where = '';
        $storage_item = $this->customer_model->get_storage_item($where);
        $quotation_item_list = array();
        if (!empty($storage_item)) {
            foreach ($storage_item as $key => $item) {
                $quotation_item_list[$item->storage_type_slug][] = $item;
            }
        }
        $selected_items = array();
        $data['quotation_item_list'] = $quotation_item_list;
        $data['selected_items'] = $selected_items;
        /******************************************************/
        /*while edit quotation following parameter is passed*/
        $data['customer_quotation_item'] = [];
        if (!empty($_POST['quotation_id'])) {
            $quotation_id = $_POST['quotation_id'];
            $where = array('quotation_id' => $quotation_id);
            $customer_quotation_item = $this->customer_model->getAllRecord('ss_customer_quotation_item', $where);
            $data['customer_quotation_item'] = $customer_quotation_item;
            $exist_item_count = count($customer_quotation_item);
            $data['exist_item_count'] = $exist_item_count;
        }
        $where = array('status' => 1);
        $hometype = $this->customer_model->getAllRecord('hometypeprice', $where);
        // $hometype=$this->customer_model->getsettingRecord('hometypeprice');
        /* $hometype=array(
           0 => array('home_type' => '1rk','vehicle_type'=>'6.5ft Eicher'),
           1 => array('home_type' => '1bhk','vehicle_type'=>'8ft Sup. Ace'),
           2 => array('home_type' => '2bhk','vehicle_type'=>'14ft Canter'),
           3 => array('home_type' => '3bhk','vehicle_type'=>'19ft Canter'),
        );*/
        $data['hometypelist'] = $hometype;
        // echo "<pre>"; print_r($data);
        // die;
        $this->load->view('inventory_items_new', $data);
        die;
    }
    public function get_selected_storage_item_hometype() {
        $data = [];
        
        $_POST['storage_type']='1rk';
        if (!empty($_POST['storage_type'])) {
            $string = "'" . $_POST['storage_type'] . "'";;
            $where = "storage_type_slug IN ($string)";
            $data["storage_type_list"] = $this->customer_model->get_storage_type_list($where);
        }
        $where = '';
        $storage_item = $this->customer_model->get_storage_item($where);
       // echo "<pre>";print_r($storage_item);die();
        $quotation_item_list = array();
        if (!empty($storage_item)) {
            foreach ($storage_item as $key => $item) {
                $quotation_item_list[$item->storage_type_slug][] = $item;
            }
        }
        $selected_items = array();
        if (!empty($storage_item)) {
        $i = 0;
        foreach ($storage_item as $key => $item) {
            if ($item->storage_item_hometype != null) {
                $a = json_decode($item->storage_item_hometype);
                if ($a !== null && count($a) > 0) {
                    foreach ($a as $key => $value) {
                        if (trim($value->hometype ?? '') == $_POST['homesize']) {
                            array_push($selected_items, [
                                'storage_item_id' => $item->storage_item_id,
                                'storage_item_slug' => $item->storage_item_slug,
                                'item_count' => $value->quantity,
                                'item_slug' => $item->storage_item_slug,
                                'item_name' => $item->storage_item_name
                            ]);
                        }
                    }
                }
            }
        }
    }

        $data['quotation_item_list'] = $quotation_item_list;
        $data['selected_items'] = $selected_items;
        $data['customer_quotation_item'] = $selected_items;
        $where = array('status' => 1);
        $hometype = $this->customer_model->getAllRecord('hometypeprice', $where);
        $data['hometype'] = $_POST['homesize'];
        $data['hometypelist'] = $hometype;
        $this->load->view('ajax_inventory', $data);
        die;
    }
    public function get_data_for_step3() {
        if (!empty($_POST['storage_item_slug'])) {
            $data = array();
            $order_by = "storage_item_name asc";
            $where = '';
            $storage_item = $this->customer_model->getAllRecord('ss_storage_item', $where, $order_by);
            $quotation_item_list = array();
            //
            $std_pallet_point = 16;
            $std_pallet_charges = 1000;
            //
            $total_storage_charges = 0;
            //
            $input_pallet = 0;
            $item_point = 0;
            $vehicle_price = 0.00;
            if (!empty($storage_item)) {
                foreach ($storage_item as $key => $item) {
                    if (in_array($item->storage_item_slug, $_POST['storage_item_slug'])) {
                        $quotation_item_list[] = $item;
                        $item_qty = @$_POST['storage_item_qty'][@$item->storage_item_slug];
                        if ($item->storage_type_slug == 'automobile_storage') {
                            /*if vehicle type*/
                            $vehicle_price+= ($item->storage_item_unit_price * $item_qty);
                        } else {
                            $item_point+= ($item->storage_item_point * $item_qty);
                        }
                    }
                }
            }
            $input_pallet = number_format(($item_point / $std_pallet_point), 1, '.', '');
            $storage_charges = ($input_pallet * $std_pallet_charges);
            $total_storage_charges = number_format((float)$storage_charges, 2, '.', '');
            /*for check vehicle*/
            $total_storage_charges = number_format((float)($storage_charges + $vehicle_price), 2, '.', '');
            /*end vehile*/
            $data['quotation_item_list'] = $quotation_item_list;
            $data['input_pallet'] = $input_pallet;
            $data['total_storage_charges'] = $total_storage_charges;
            /****************transport charges start*******************/
            $this->input_months = $_POST['storage_month'];
            $this->total_item_point = $item_point;
            $this->safe_lat = '';
            $this->safe_long = '';
            $this->unit = 'k';
            $this->total_transport_charges = 0;
            $this->total_input_dist = 0;
            $d_where = array();
            /*check city and as per city calculate distance i/p */
            $customer_local_city = trim($_POST['customer_local_city']??'');
            $d_where = array('city_slug' => $customer_local_city);
            if (!empty($d_where)) {
                $distance_data = $this->customer_model->getSingleRecord('ss_city', $d_where);
                if (!empty($distance_data->city_lat) && !empty($distance_data->city_lng)) {
                    $this->safe_lat = $distance_data->city_lat;
                    $this->safe_long = $distance_data->city_lng;
                }
            }
            if (!empty(@$_POST['pickup_lat']) && !empty(@$_POST['pickup_lang'])) {
                $cust_to_safe_distance = $this->get_distance($_POST['pickup_lat'], $_POST['pickup_lang'], $this->safe_lat, $this->safe_long, $this->unit);
                $total_distance = (@$cust_to_safe_distance * 2);
                $this->total_input_dist = round(@$total_distance);
            }
            /*lift cost start*/
            /*echo $input_pallet ;die();*/
            $this->total_lift_cost = 0.00;
            $pickup_floor = @$_POST['pickup_floor'];
            $pickup_lift = @$_POST['pickup_lift'];
            if ($input_pallet > 0.0) {
                $this->total_lift_cost = $this->calculate_total_lift_cost($pickup_floor, $pickup_lift, $input_pallet);
            }
            /*end lift cost*/
            /*labor cost start*/
            $this->total_labor_cost = 0.00;
            if ($input_pallet > 0.0) {
                $this->total_labor_cost = $this->calculate_labor_cost($input_pallet);
            }
            /*end labor cost*/
            /*transport cost start*/
            $this->total_transport_cost = 0.00;
            if ($input_pallet > 0.0) {
                $transport_cost = $this->get_calculated_transport_info($input_pallet, $this->total_input_dist);
                $this->total_transport_cost = number_format($transport_cost, 2, '.', '');
            }
            /*transport cost end*/
            /*additional pallet charges*/
            $this->additional_pallet_cost = 0;
            $additional_cost = 0;
            $additional_cost = ($input_pallet * 1000);
            $this->additional_pallet_cost = $additional_cost;
            /*end additional pallet charges*/
            /*stacking and barcode charges*/
            $this->stacking_barcode_charges = 0.00;
            if ($input_pallet > 0.0) {
                $this->stacking_barcode_charges = $this->calculate_stacking_barcode_cost($input_pallet);
            }
            /*end stacking*/
            $this->total_transport_charges = ($this->additional_pallet_cost + $this->total_transport_cost + $this->total_labor_cost + $this->total_lift_cost);
            if (!empty($_POST['warehouse_arrival'])) {
                $this->total_transport_charges = 0.00;
                $this->total_transport_cost = 0.00;
                $this->total_labor_cost = 0.00;
                $this->total_lift_cost = 0.00;
                $this->additional_pallet_cost = 0.00;
            }
            /****************transport charges end*******************/
            // echo "input_pallet :".$input_pallet."<br/>";
            // echo "input_distance :".$this->total_input_dist."<br/>";
            // echo "total_transport_cost :".$this->total_transport_cost."<br/>";
            // echo "total_labor_cost :".$this->total_labor_cost."<br/>";
            // echo "total_lift_cost:".$this->total_lift_cost."<br/>";
            // echo "additionall_pallet_cost:".$this->additional_pallet_cost."<br/>";
            // echo "Total transport:".round($this->total_transport_charges)."<br/>";die();
            $data['input_distance'] = $this->total_input_dist;
            $data['total_transport_cost'] = $this->total_transport_cost;
            $data['total_labor_cost'] = $this->total_labor_cost;
            $data['total_lift_cost'] = $this->total_lift_cost;
            $data['additional_pallet_cost'] = $this->additional_pallet_cost;
            $data['total_transport_charges'] = round($this->total_transport_charges);
            $data['stacking_barcode_charges'] = $this->stacking_barcode_charges;
            $data["tax_list"] = $this->customer_model->getAllRecord('ss_tax', array('status' => '0'));
            $_POST['total_distance'] = $this->total_input_dist;
            $_POST['transport_cost'] = $this->total_transport_cost;
            $_POST['labour_cost'] = $this->total_labor_cost;
            $_POST['lift_cost'] = $this->total_lift_cost;
            $_POST['additional_pallet_cost'] = $this->additional_pallet_cost;
            $_POST['pickup_charges'] = $this->total_transport_charges;
            $_POST['stack_barcode_charges'] = $this->stacking_barcode_charges;
            $_POST['total_pallet'] = $input_pallet;
            $_POST['storage_charges'] = $total_storage_charges;
            /*check quotation count */
            $exist_customer_id = '';
            $e_where = array('customer_email' => trim($_POST['customer_email']??''));
            $m_where = array('customer_contact1' => trim($_POST['contact']??''));
            $cust_email_exist = $this->customer_model->getSingleRecord('ss_customer', $e_where);
            $cust_contact_exist = $this->customer_model->getSingleRecord('ss_customer', $m_where);
            if (!empty($cust_email_exist) || !empty($cust_contact_exist)) {
                if (!empty($cust_contact_exist)) {
                    $exist_customer_id = $cust_contact_exist->customer_id;
                }
                if (!empty($cust_email_exist)) {
                    $exist_customer_id = $cust_email_exist->customer_id;
                }
            }
            $entry_count = 0;
            if (!empty($exist_customer_id)) {
                $where = array('customer_id' => $exist_customer_id);
                $entry_count = $this->customer_model->getRowCount('ss_customer_quotation', $where);
            }
            /*  if($entry_count > 2){
                echo "limit_reach";
            }else{*/
            $response_data = $this->add_customer_step_form($_POST);
            /*for get quotation data*/
            $q_where = array('quotation_id' => @$response_data['quotation_id']);
            $quot_data = $this->customer_model->getSingleRecord('ss_customer_quotation', $q_where);
            $link = '#';
            if (!empty($quot_data)) {
                $link = base_url() . 'back/auth/customer_schedule?id=' . base64_encode(@$response_data['quotation_id']) . '&code=' . @$quot_data->payment_security_code;
            }
            $data['quotation_pickup_link'] = $link;
            $this->load->view('ajax_step_three', $data);
            // }
            
        }
    }
   public function calculate_total_lift_cost($pickup_floor = null, $pickup_lift = null, $input_pallet = null) {
        $this->total_lift_cost = 0.00;
      
        if ((@$pickup_floor == 'ground' || @$pickup_floor == 'basement')) {
            $this->total_lift_cost = 0;
            return $this->total_lift_cost;
            die;
        }


        if ((@$pickup_floor != 'ground' || @$pickup_floor != 'basement') && (@$pickup_lift == 'no' || @$pickup_lift == 'partially available')) {
            if (@$pickup_floor == "greater_10") {
                $this->total_lift_cost = 2000;
                
            } else {
                if (@$pickup_floor >= 2 && @$pickup_floor < 4) {
                    $this->total_lift_cost = $input_pallet * 250;
                   
                }
                if (@$pickup_floor == 4 || @$pickup_floor == 5) {
                    $this->total_lift_cost = 1500;
                   

                }
                if (@$pickup_floor < 2) {
                    $this->total_lift_cost = 0;
                   

                }
                if (@$pickup_floor > 5) {
                    $this->total_lift_cost = 2000;
                  

                }
            }
        }
        return $this->total_lift_cost;
    }
    public function calculate_stacking_barcode_cost($input_pallet = null) {
        $stacking_barcode_charges = 0.00;
        $stacking_barcode_cost = 0;
        $temp_stacking_amt = (250 * $input_pallet);
        if ($temp_stacking_amt < 500) {
            $stacking_barcode_cost = 500;
        } else {
            $stacking_barcode_cost = (250 * $input_pallet);
        }
        $stacking_barcode_charges = number_format($stacking_barcode_cost, 2, '.', '');
        return $stacking_barcode_charges;
    }
    public function calculate_labor_cost($input_pallet = null) {
        $this->total_labor_cost = 0.00;
        if ($input_pallet < 3) {
            $this->total_labor_cost = 2000;
        }
        if ($input_pallet >= 3) {
            $this->total_labor_cost = ($input_pallet * 800);
        }
        /*  if($input_pallet ==1){
        
            $this->total_labor_cost = 1800;
        }*/
        return $this->total_labor_cost;
    }
    public function get_calculated_transport_info($input_pallet = null, $input_distance = null) {
        $distance_price = 0;
        if (!empty($input_pallet) && !empty($input_distance)) {
            /* $table_name   ='ss_vehicle_info';
            $pallet_where =array('std_pallet >=' => $input_pallet);//  'std_pallet >='.$input_pallet;
            $order_by     = 'vehicle_id ASC';
            
            $vehicle_data =$this->customer_model->getOrderBySingleRecord($table_name,$pallet_where,$order_by);*/
            $format_pallet = floatval($input_pallet);
            $table_name = 'ss_vehicle_info';
            $pallet_where = " (`min_std_pallet` < " . $format_pallet . " and `std_pallet` >= " . $format_pallet . ") AND status='0' ";
            $order_by = 'vehicle_id DESC';
            $vehicle_data = $this->customer_model->getOrderByLimitSingleRecord($table_name, $pallet_where, $order_by);
            /*echo "<pre>";print_r($vehicle_data);die();*/
            if (!empty($vehicle_data)) {
                $table_name = 'ss_vehicle_dist_price';
                $pallet_where = 'vehicle_id =' . $vehicle_data->vehicle_id;
                $order_by = 'distance_id ASC';
                $vehicle_km_info = $this->customer_model->getAllRecord($table_name, $pallet_where);
                /*take initial distance 0km-5km */
                $distance_price+= $vehicle_data->std_vehicle_price;
                $initial_distance = $vehicle_data->std_distance;
                if ($input_distance <= $initial_distance) {
                    return $distance_price;
                }
                if ($initial_distance < $input_distance) {
                    if (!empty($vehicle_km_info)) {
                        $input_km_distnace_arr = [];
                        foreach ($vehicle_km_info as $info) {
                            if ($info->condition_slug == "less") {
                                $input_km_distnace_arr[$info->distance_id] = $info->std_distance;
                            }
                        }
                        foreach ($vehicle_km_info as $key => $row) {
                            if (($row->std_distance <= $input_distance) && $row->condition_slug == 'less') {
                                $temp_distance = ($row->std_distance - $initial_distance);
                                $distance_price+= ($temp_distance * $row->km_price);
                                $initial_distance = $row->std_distance;
                            } else if (($row->std_distance >= $input_distance) && $row->condition_slug == 'less') {
                                $distance_price+= ($input_distance - $initial_distance) * $row->km_price;
                                return $distance_price;
                                break;
                            }
                            if (($row->condition_slug == 'greater') && ($input_distance > $row->std_distance)) {
                                $distance_price+= ($input_distance - $initial_distance) * $row->km_price;
                                return $distance_price;
                                break;
                            }
                        }
                    }
                }
                /*echo "vehicle_data <pre>";print_r($vehicle_data);
                 echo "vehicle_km_info <pre>";print_r($vehicle_km_info);*/
            }
        }
        return $distance_price;
    }
    public function get_distance($lat1 = null, $lon1 = null, $lat2 = null, $lon2 = null, $unit = null) {
        if (!empty($lat1) && !empty($lon1) && !empty($lat2) && !empty($lon2)) {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);
            return ($miles * 1.609344);
            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        } else {
            return 0;
        }
    }
    /*for supervisor pickup order*/
    public function get_items() {
        // print_r($_POST);die();
        $info = '';
        if (!empty($_POST["keyword"])) {
            $item_list = $this->customer_model->get_item_list(trim($_POST["keyword"]??''));
            if (!empty($item_list)) {
                $info.= '<ul id="country-list">';
                foreach ($item_list as $item) {
                    $item_slug = "'" . $item["storage_item_slug"] . "'";
                    $storage_item_id = $item["storage_item_id"];
                    $info.= '<li onclick="select_item_name(' . $storage_item_id . ',' . $item_slug . ')">' . $item["storage_item_name"] . '</li>';
                }
                $info.= '</ul>';
            }
        }
        echo $info;
    }
    public function get_item_data() {


        //ss_storage_item
        //ss_refined_storage_item


        if (!empty($_POST["storage_item_id"])) {
            $where = array('storage_item_id' => $_POST["storage_item_id"]);
            $quotation_item = $this->customer_model->getSingleRecord('ss_refined_storage_item', $where);
            echo json_encode($quotation_item);
            die;
        }
    }
    public function set_date_format($input_date = null) {
        if ($input_date == null) {
            return false;
        }
        $date = str_replace('/', '-', $input_date);
        return date('Y-m-d', strtotime($date));
    }
    public function add_customer_step_form($data = array()) {
        $_POST = $data;
        /*echo "<pre>";print_r($_POST);die();*/
        /*for group quotations*/
        $exist_customer_id = '';
        $e_where = array('customer_email' => trim($_POST['customer_email']??''));
        $m_where = array('customer_contact1' => trim($_POST['contact']??''));
        $cust_email_exist = $this->customer_model->getSingleRecord('ss_customer', $e_where);
        $cust_contact_exist = $this->customer_model->getSingleRecord('ss_customer', $m_where);
        if (!empty($cust_email_exist) || !empty($cust_contact_exist)) {
            if (!empty($cust_contact_exist)) {
                $exist_customer_id = $cust_contact_exist->customer_id;
            }
            if (!empty($cust_email_exist)) {
                $exist_customer_id = $cust_email_exist->customer_id;
            }
        }
        if (empty($exist_customer_id)) {
            $data = array('customer_initial' => trim($_POST['customer_initial']??''), 'customer_name' => htmlspecialchars(trim($_POST['customer_name']??'')), 'customer_email' => htmlspecialchars(trim($_POST['customer_email']??'')), 'customer_contact1' => htmlspecialchars(trim($_POST['contact']??'')), 'customer_local_city' => htmlspecialchars(trim($_POST['customer_local_city']??'')), 'referral_code' => htmlspecialchars(trim($_POST['referral_code']??'')), 'pickup_address' => htmlspecialchars(trim(@$_POST['pickup_address']??'')), 'pickup_lat' => htmlspecialchars(trim($_POST['pickup_lat']??'')), 'pickup_lang' => htmlspecialchars(trim($_POST['pickup_lang']??'')), 'pickup_floor' => htmlspecialchars(trim(@$_POST['pickup_floor']??'')), 'pickup_lift' => htmlspecialchars(trim(@$_POST['pickup_lift']??'')), 'storage_date' => $this->set_date_format($_POST['storage_date']), 'storage_month' => @$_POST['storage_month'], 'warehouse_arrival' => @$_POST['warehouse_arrival'],
            /*'customer_created_by' => $this->user_id*/
            );
            //file upload start
            if (!empty($_FILES['customer_profile']['name'])) {
                $this->load->library('upload');
                $params = $this->uploadConfig();
                $params["config_upload"]['file_name'] = uniqid() . "_" . $_FILES["customer_profile"]["name"];
                $this->upload->initialize($params["config_upload"]);
                if (!$this->upload->do_upload("customer_profile")) {
                    //echo $error = $this->upload->display_errors();die();
                    
                } else {
                    $succesUpload = $this->upload->data();
                    $data["customer_profile"] = $succesUpload['file_name'];
                }
            }
            //
            if (!empty($_FILES['proof_id_image']['name'])) {
                $this->load->library('upload');
                $params = $this->uploadDoc();
                $params["config_upload"]['file_name'] = uniqid() . "_" . $_FILES["proof_id_image"]["name"];
                $this->upload->initialize($params["config_upload"]);
                if (!$this->upload->do_upload("proof_id_image")) {
                    // echo $error = $this->upload->display_errors();die();
                    
                } else {
                    $succesUpload = $this->upload->data();
                    $data["proof_id_image"] = $succesUpload['file_name'];
                }
            }
            //scanned_agreement
            if (!empty($_FILES['scanned_agreement']['name'])) {
                $this->load->library('upload');
                $params = $this->uploadDoc();
                $params["config_upload"]['file_name'] = uniqid() . "_" . $_FILES["scanned_agreement"]["name"];
                $this->upload->initialize($params["config_upload"]);
                if (!$this->upload->do_upload("scanned_agreement")) {
                    //echo $error = $this->upload->display_errors();die();
                    
                } else {
                    $succesUpload = $this->upload->data();
                    $data["scanned_agreement"] = $succesUpload['file_name'];
                }
            }
            $customer_id = $this->customer_model->addRecord('ss_customer', $data);
            $city = substr(ucfirst($_POST['customer_local_city']), 0, 1);
            $storage_type_slug = substr(ucfirst($_POST['storage_type'][0]), 0, 1);
            //$part_num = 'P1';
            $customer_unique_id = $city . $storage_type_slug . sprintf("%03d", $customer_id);
            $where = array('customer_id' => $customer_id);
            $row_data = array('customer_unique_id' => $customer_unique_id);
            $this->customer_model->updateRecord('ss_customer', $row_data, $where);
            //for add $storage_type = @$_POST['storage_type'];
            $storage_type = @$_POST['storage_type'];
            for ($inc = 0;$inc < count(@$_POST['storage_type']);$inc++) {
                $storage_data = array('customer_id' => $customer_id, 'storage_slug' => $storage_type[$inc],);
                $this->customer_model->addRecord('ss_customer_storage_type', $storage_data);
            }
        } else {
            /*$response =[];
            $response['old_customer_id']='';
            $response['status'] ="exist";
            echo json_encode($response);die();*/
            $customer_id = $exist_customer_id;
        }
        //for store quoatation itme
        $order_by = "storage_item_name asc";
        $where = '';
        $storage_item = $this->customer_model->getAllRecord('ss_storage_item', $where, $order_by);
        $quotation_item_list = array();
        if (!empty($storage_item)) {
            foreach ($storage_item as $key => $item) {
                $quotation_item_list[$item->storage_item_slug] = $item;
            }
        }
        $quot_data = array(
        /*'total_amount' => $_POST['total_amount'],
         'discount_amount' => $_POST['discount_amount'],*/
        'customer_id' => $customer_id, 'pickup_charges' => $_POST['pickup_charges'], 'pickup_tax' => @$_POST['pickup_tax'],
        //'total_pickup_charges' => $_POST['total_pickup_charges'],
        'storage_charges' => $_POST['storage_charges'], 'storage_tax' => @$_POST['storage_tax'],
        //'total_storage_charges' => $_POST['total_storage_charges'],
        'stack_barcode_charges' => $_POST['stack_barcode_charges'],'duration' =>'during', 'stack_barcode_tax' => @$_POST['stack_barcode_tax'],
        //
        'total_pallet' => $_POST['total_pallet'], 'total_distance' => $_POST['total_distance'], 'lift_cost' => $_POST['lift_cost'], 'transport_cost' => $_POST['transport_cost'], 'labour_cost' => $_POST['labour_cost'],
        /*'created_by' => $this->user_id,*/
        'location' => htmlspecialchars(trim(@$_POST['pickup_address']??'')), 'lat' => htmlspecialchars(trim($_POST['pickup_lat']??'')), 'lang' => htmlspecialchars(trim($_POST['pickup_lang']??'')), 'floor' => htmlspecialchars(trim(@$_POST['pickup_floor']??'')), 'lift' => htmlspecialchars(trim(@$_POST['pickup_lift']??'')), 'created_at' => date('Y-m-d H:i:s'));
        if (!empty($_POST['total_storage_charges'])) {
            $quot_data['total_storage_charges'] = $_POST['total_storage_charges'];
        } else {
            $quot_data['total_storage_charges'] = $_POST['storage_charges'];
        }
        if (!empty($_POST['total_pickup_charges'])) {
            $quot_data['total_pickup_charges'] = $_POST['total_pickup_charges'];
        } else {
            $quot_data['total_pickup_charges'] = $_POST['pickup_charges'];
        }
        if (!empty($_POST['total_stack_barcode_charges'])) {
            $quot_data['total_stack_barcode_charges'] = $_POST['total_stack_barcode_charges'];
        } else {
            $quot_data['total_stack_barcode_charges'] = $_POST['stack_barcode_charges'];
        }
         $quot_data['is_new_charges'] = 1;
        $quotation_id = $this->customer_model->addRecord('ss_customer_quotation', $quot_data);
        if (!empty($_POST['storage_item_slug']) && !empty($quotation_item_list)) {
            foreach ($_POST['storage_item_slug'] as $item_slug) {
                if (!empty(@$quotation_item_list[$item_slug])) {
                    $item = $quotation_item_list[$item_slug];
                    $item_count = @$_POST['storage_item_qty'][$item_slug];
                    $data = array('quotation_id' => $quotation_id, 'customer_id' => $customer_id, 'item_name' => $item->storage_item_name, 'item_slug' => $item_slug, 'item_count' => $item_count, 'storage_type_slug' => @$item->storage_type_slug,);
                    $this->customer_model->addRecord('ss_customer_quotation_item', $data);
                }
            }
        }
        /*send quoataton mail */
        $item_data = [];
        $item_data['customer_data'] = $customer_data = $this->customer_model->getSingleRecord('ss_customer', array('customer_id' => $customer_id));
        /* echo "<pre>";print_r($item_data['customer_data']);die();*/
        $payment_security_code = rand(100, 1000);
        $row = array('payment_security_code' => $payment_security_code);
        $where = array('customer_id' => $customer_id);
        $this->customer_model->updateRecord('ss_customer', $row, $where);
        /*update code*/
        $quot_where = array('customer_id' => $customer_id, 'quotation_id' => $quotation_id);
        $item_list = $this->customer_model->getAllRecord('ss_customer_quotation_item', $quot_where);
        $item_list_array = [];
        foreach ($item_list as $key => $item) {
            $item_list_array[$item->storage_type_slug][$item->item_slug] = $item;
        }
        $item_data['item_list'] = $item_list_array;
        $item_data["storage_type_list"] = $this->storage_type_per_slug();
        $quotation_data = $this->customer_model->getSingleRecord('ss_customer_quotation', array('quotation_id' => $quotation_id));
        $item_data['quotation_data'] = $quotation_data;
        $item_data['input_pallet'] = $quotation_data->total_pallet;
        $item_data['quotation_id'] = $quotation_id;
        $item_data['quoataton_amount'] = $quotation_data->total_storage_charges;
        $item_data['pickup_charges'] = $quotation_data->total_pickup_charges;
        $item_data['stack_barcode_charges'] = $quotation_data->total_stack_barcode_charges;
        $welcome = '';
        ob_start();
        $html = $this->load->view('customer/customer_quotation_mail_template', $item_data, true);
        $mail_body = $this->load->view('customer/quotation_mail_body', $item_data, true);
        $date = date('Y-m-d H:i:s');
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->debug = true;
        $this->m_pdf->pdf->SetDisplayMode('fullwidth');
        $this->m_pdf->pdf->showImageErrors = true;
        $this->m_pdf->pdf->WriteHTML($html);
        $content = $this->m_pdf->pdf->Output('', 'S');
        $filename = "QT" . sprintf('%03d', $quotation_id) . "_safestorage_" . time() . ".pdf";
        $static_attachment = './upload/safestorage/SafeStorage_Introdeck.pdf';
        $attach_file_arr = array($content, $static_attachment);
        $subject = $customer_data->customer_initial . " " . $customer_data->customer_name . ' | Quotation from SafeStorage';
        $welcome.= $mail_body;
        $welcome.= "<br/>";
        $welcome.= "<b>Thanks & Best Regards</b><br/>";
        $welcome.= "<span style='color:#05307f;'>SAFE STORAGE™ -<span> <span style='color:#ef5921;'>We Store Anything You Care!</span><br/>";
        $welcome.= "8088 84 84 84<br/>";
        
        $welcome.= "info@safestorage.in | www.safestorage.in<br/><br/>";
        $this->load->library('email');
        $config = array();
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('quote@safestorage.in');
        $this->email->to($customer_data->customer_email);
        $this->email->cc('safestorage.in@gmail.com');
        $this->email->subject($subject);
        $this->email->message($welcome);
        $this->email->attach($content, 'attachment', $filename, 'application/pdf');
        /*$this->email->attach($static_attachment);*/
        $this->email->send();
        /*whatapp api*/
        /*send text message*/
        $temp_file_name = '';
        $json_arr = json_encode(array('phone' => "91" . $customer_data->customer_contact1, 'body' => 'Greetings from SafeStorage!
            Please find the quotation and kindly revert us on mail at the earliest to book slot.'));
        $this->send_whatsapp_message($json_arr, $temp_file_name);
        /*save_file_name*/
        $temp_file_name = "QT" . sprintf('%03d', $quotation_id) . "_safestorage_" . time() . ".pdf";
        $this->m_pdf->pdf->Output('./upload/quotation/' . $temp_file_name, 'F');
        $file_path = base_url() . "upload/quotation/" . $temp_file_name;
        $filename = $temp_file_name;
        $chatId = "91" . $customer_data->customer_contact1 . "@c.us";
        $json_arr = json_encode(array('chatId' => $chatId, //"918624070867@c.us",
        'body' => $file_path, //FULL PATH and file name
        'filename' => $filename));
        $this->send_whatsapp_message($json_arr, $temp_file_name);
        /*end api*/
        $response = [];
        $response['quotation_id'] = $quotation_id;
        $response['old_customer_id'] = '';
        $response['status'] = "success";
        if ($exist_customer_id) {
            $response['old_customer_id'] = $exist_customer_id;
        }
        return $response;
        /*echo json_encode($response);*/
    }
    public function add_customer_step_form_new($data = array()) {
        //echo"<pre>";print_r($_POST);die();
        $_POST = $data;
        /*for group quotations*/
        $exist_customer_id = '';
        $customer_data = array();
        $e_where = array('customer_email' => trim($_POST['customer_email']??''));
        $m_where = array('customer_contact1' => trim($_POST['customer_contact1']??''));
        $cust_email_exist = $this->customer_model->getSingleRecord('ss_customer', $e_where);
        $cust_contact_exist = $this->customer_model->getSingleRecord('ss_customer', $m_where);
        if (!empty($cust_email_exist) || !empty($cust_contact_exist)) {
            if (!empty($cust_contact_exist)) {
                $exist_customer_id = $cust_contact_exist->customer_id;
                $customer_data = $cust_contact_exist;
            }
            if (!empty($cust_email_exist)) {
                $exist_customer_id = $cust_email_exist->customer_id;
                $customer_data = $cust_email_exist;
            }
        }
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0;$i < 10;$i++) {
            $randomString.= $characters[rand(0, $charactersLength - 1) ];
        }
        if (empty($exist_customer_id)) {
            $data = array('customer_initial' => trim(@$_POST['customer_initial']??''), 'customer_name' => htmlspecialchars(trim($_POST['customer_name']??'')), 'customer_email' => htmlspecialchars(trim($_POST['customer_email']??'')), 'customer_contact1' => htmlspecialchars(trim($_POST['customer_contact1']??'')), 'customer_local_city' => htmlspecialchars(trim($_POST['customer_local_city']??'')), 'referral_code' => htmlspecialchars(trim(@$_POST['referral_code']??'')), 'pickup_address' => htmlspecialchars(trim(@$_POST['pickup_address']??'')), 'pickup_lat' => htmlspecialchars(trim($_POST['pickup_lat']??'')), 'pickup_lang' => htmlspecialchars(trim($_POST['pickup_lang']??'')), 'pickup_floor' => htmlspecialchars(trim(@$_POST['pickup_floor']??'')), 'pickup_lift' => htmlspecialchars(trim(@$_POST['pickup_lift']??'')), 'storage_date' => $this->set_date_format(@$_POST['storage_date']), 'storage_month' => @$_POST['storage_month'], 'warehouse_arrival' => @$_POST['warehouse_arrival'], 'referral_id' => $randomString, 'payment_type' => 'monthly', 'customer_created_at' => date('Y-m-d H:i:s'), 'six_month_discount' => '10', 'yearly_discount' => '20',);
            //file upload start
            if (!empty($_FILES['customer_profile']['name'])) {
                $this->load->library('upload');
                $params = $this->uploadConfig();
                $params["config_upload"]['file_name'] = uniqid() . "_" . $_FILES["customer_profile"]["name"];
                $this->upload->initialize($params["config_upload"]);
                if (!$this->upload->do_upload("customer_profile")) {
                    //echo $error = $this->upload->display_errors();die();
                    
                } else {
                    $succesUpload = $this->upload->data();
                    $data["customer_profile"] = $succesUpload['file_name'];
                }
            }
            //
            if (!empty($_FILES['proof_id_image']['name'])) {
                $this->load->library('upload');
                $params = $this->uploadDoc();
                $params["config_upload"]['file_name'] = uniqid() . "_" . $_FILES["proof_id_image"]["name"];
                $this->upload->initialize($params["config_upload"]);
                if (!$this->upload->do_upload("proof_id_image")) {
                    // echo $error = $this->upload->display_errors();die();
                    
                } else {
                    $succesUpload = $this->upload->data();
                    $data["proof_id_image"] = $succesUpload['file_name'];
                }
            }
            //scanned_agreement
            if (!empty($_FILES['scanned_agreement']['name'])) {
                $this->load->library('upload');
                $params = $this->uploadDoc();
                $params["config_upload"]['file_name'] = uniqid() . "_" . $_FILES["scanned_agreement"]["name"];
                $this->upload->initialize($params["config_upload"]);
                if (!$this->upload->do_upload("scanned_agreement")) {
                    //echo $error = $this->upload->display_errors();die();
                    
                } else {
                    $succesUpload = $this->upload->data();
                    $data["scanned_agreement"] = $succesUpload['file_name'];
                }
            }
            /*check this customer is under Lead table*/
            $lead_relationship_manager_id = '';
            $lead_id = '';
            $lead_e_where = array('customer_email' => trim($_POST['customer_email']??''));
            $lead_m_where = array('customer_mobile_no' => trim($_POST['customer_contact1']??''));
            $lead_email_exist = $this->customer_model->getSingleRecord('ss_leads', $lead_e_where);
            $lead_contact_exist = $this->customer_model->getSingleRecord('ss_leads', $lead_m_where);
            if (!empty($lead_email_exist) || !empty($lead_contact_exist)) {
                if (!empty($lead_contact_exist)) {
                    $lead_relationship_manager_id = $lead_contact_exist->relationship_manager_id;
                    $lead_id = $lead_contact_exist->id;
                }
                if (!empty($lead_email_exist)) {
                    $lead_relationship_manager_id = $lead_email_exist->relationship_manager_id;
                    $lead_id = $lead_email_exist->id;
                }
            }
            /*end checking*/
            if (!empty($lead_relationship_manager_id)) {
                $data['relationship_manager_id'] = @$lead_relationship_manager_id;
            } else {
                /*auto assign relationship manager to customer*/
                $order_by = 'customer_id desc';
                $last_customer_data = $this->customer_model->getOrderBySingleRecord('ss_customer', array(), $order_by);
                if (!empty($last_customer_data->relationship_manager_id)) {
                    $r_m_id = $last_customer_data->relationship_manager_id;
                    $r_manager_data = array();
                    $order_by = 'user_id asc';
                    $r_where = "role_id ='5' AND (user_id > '" . $r_m_id . "') AND status='0'"; //array('role_id' => 5);
                    $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                    if (!empty($r_manager_data)) {
                        $data['relationship_manager_id'] = @$r_manager_data->user_id;
                    } else {
                        $r_manager_data = array();
                        $order_by = 'user_id asc';
                        $r_where = array('role_id' => '5', 'status' => '0');
                        $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                        $data['relationship_manager_id'] = @$r_manager_data->user_id;
                    }
                } else {
                    $order_by = 'user_id asc';
                    $r_where = array('role_id' => '5', 'status' => '0');
                    $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                    $data['relationship_manager_id'] = @$r_manager_data->user_id;
                }
                /*end auto assign*/
            }
            $customer_id = $this->customer_model->addRecord('ss_customer', $data);
            /*update leads*/
            $lead1_e_where = array('customer_email' => trim($_POST['customer_email']??''));
            $lead1_m_where = array('customer_mobile_no' => trim($_POST['customer_contact1']??''));
            $l_data = array('is_converted_to_quot' => '1');
            $this->customer_model->updateRecord('ss_leads', $l_data, $lead1_e_where);
            $this->customer_model->updateRecord('ss_leads', $l_data, $lead1_m_where);
            /* if(!empty($lead_id)){
             }*/
            $storage_type = 'household_storage';
            $city = substr(ucfirst($_POST['customer_local_city']), 0, 1);
            $storage_type_slug = substr(ucfirst($storage_type), 0, 1);
            //$part_num = 'P1';
            $customer_unique_id = $city . $storage_type_slug . sprintf("%03d", $customer_id);
            $where = array('customer_id' => $customer_id);
            $row_data = array('customer_unique_id' => $customer_unique_id);
            $this->customer_model->updateRecord('ss_customer', $row_data, $where);
        } else {
            $customer_id = $exist_customer_id;
            /*auto assign relationship manager to customer*/
            $data = array();
            if (!empty($customer_data->relationship_manager_id)) {
            } else {
                $order_by = 'customer_id desc';
                $last_customer_data = $this->customer_model->getOrderBySingleRecord('ss_customer', array(), $order_by);
                if (!empty($last_customer_data->relationship_manager_id)) {
                    $r_m_id = $last_customer_data->relationship_manager_id;
                    $r_manager_data = array();
                    $order_by = 'user_id asc';
                    $r_where = "role_id ='5' AND (user_id > '" . $r_m_id . "') AND status='0'"; //array('role_id' => 5);
                    $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                    if (!empty($r_manager_data)) {
                        $data['relationship_manager_id'] = @$r_manager_data->user_id;
                    } else {
                        $r_manager_data = array();
                        $order_by = 'user_id asc';
                        $r_where = array('role_id' => '5', 'status' => '0');
                        $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                        $data['relationship_manager_id'] = @$r_manager_data->user_id;
                    }
                } else {
                    $order_by = 'user_id asc';
                    $r_where = array('role_id' => '5', 'status' => '0');
                    $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                    $data['relationship_manager_id'] = @$r_manager_data->user_id;
                }
                if (!empty($data['relationship_manager_id'])) {
                    $where = array('customer_id' => $customer_id);
                    $this->customer_model->updateRecord('ss_customer', $data, $where);
                }
            }
            /*end*/
        }
        /*set storage type*/
        $s_where = array('customer_id' => $customer_id);
        $customer_storage_type_row = $this->customer_model->getSingleRecord('ss_customer_storage_type', $s_where);
        $storage_type = 'household_storage';
        if (!empty($customer_storage_type_row)) {
            $row = array('storage_slug' => 'household_storage');
            $this->customer_model->updateRecord('ss_customer_storage_type', $row, $s_where);
        } else {
            $storage_data = array('customer_id' => $customer_id, 'storage_slug' => $storage_type,);
            $this->customer_model->addRecord('ss_customer_storage_type', $storage_data);
        }
        /*end storage type*/
        //for store quoatation itme
        $order_by = "storage_item_name asc";
        $where = '';
        $storage_item = $this->customer_model->getAllRecord('ss_storage_item', $where, $order_by);
        $quotation_item_list = array();
        if (!empty($storage_item)) {
            foreach ($storage_item as $key => $item) {
                $quotation_item_list[$item->storage_item_slug] = $item;
            }
        }
        $payment_security_code = rand(100, 1000);
        $transport_type = 'safestorage_transport';
        if (!empty($_POST['warehouse_arrival'])) {
            $transport_type = 'warehouse_arrival';
        }
        $quot_data = array('customer_id' => $customer_id, 'pickup_charges' => $_POST['pickup_charges'], 'pickup_tax' => @$_POST['pickup_tax'], 'storage_charges' => $_POST['storage_charges'], 'storage_tax' => @$_POST['storage_tax'], 'stack_barcode_charges' => $_POST['stack_barcode_charges'], 'stack_barcode_tax' => @$_POST['stack_barcode_tax'], 'total_pallet' => $_POST['total_pallet'], 'total_distance' => $_POST['total_distance'], 'lift_cost' => $_POST['lift_cost'], 'transport_cost' => $_POST['transport_cost'], 'labour_cost' => $_POST['labour_cost'], 'item_packing_charges' => $_POST['additional_pallet_cost'], 'extra_km_charges' => $_POST['extra_km_charges'],
        /* 'location' =>htmlspecialchars(trim(@$_POST['pickup_address'])),*/
        'lat' => htmlspecialchars(trim($_POST['pickup_lat']??'')), 'lang' => htmlspecialchars(trim($_POST['pickup_lang']??'')),
        /*'floor' =>htmlspecialchars(trim(@$_POST['pickup_floor'])),
         'lift' =>htmlspecialchars(trim(@$_POST['pickup_lift'])),*/
        'hometype' => htmlspecialchars(trim(@$_POST['hometype']??'')), 'payment_security_code' => $payment_security_code, 'is_new_quotation' => '1', 'transport_type' => $transport_type, 'vehicle_type' => @$_POST['vehicle_type'], 'transport_coupon' => @$_POST['transport_coupon'], 'storage_coupen' => @$_POST['storage_coupen'], 'created_at' => date('Y-m-d H:i:s'));
        if ($transport_type == 'warehouse_arrival') {
            $location = '';
            $floor = '';
            $lift = '';
        } else {
            $location = htmlspecialchars(trim(@$_POST['pickup_address']??''));
            $floor = htmlspecialchars(trim(@$_POST['pickup_floor']??''));
            $lift = htmlspecialchars(trim(@$_POST['pickup_lift']??''));
        }
        $quot_data['location'] = $location;
        $quot_data['floor'] = $floor;
        $quot_data['lift'] = $lift;
        if (!empty($_POST['total_storage_charges'])) {
            $quot_data['total_storage_charges'] = $_POST['total_storage_charges'];
        } else {
            $quot_data['total_storage_charges'] = $_POST['storage_charges'];
        }
        if (!empty($_POST['total_pickup_charges'])) {
            $quot_data['total_pickup_charges'] = $_POST['total_pickup_charges'];
        } else {
            $quot_data['total_pickup_charges'] = $_POST['pickup_charges'];
        }
        if (!empty($_POST['total_stack_barcode_charges'])) {
            $quot_data['total_stack_barcode_charges'] = $_POST['total_stack_barcode_charges'];
        } else {
            $quot_data['total_stack_barcode_charges'] = $_POST['stack_barcode_charges'];
        }
        $pickup_charges = $quot_data['pickup_charges'];
        $pickup_gst = 0;
        $pickup_gst_temp = ($pickup_gst * $pickup_charges) / 100;
        $pickup_gst_amt = number_format($pickup_gst_temp, 2, '.', '');
        $total_pickup_charges_with_gst = number_format(($pickup_gst_amt + $pickup_charges), 2, '.', '');
        $quot_data['pickup_gst'] = $pickup_gst;
        $quot_data['total_pickup_charges_with_gst'] = $total_pickup_charges_with_gst;
        /**/
        $stack_barcode_charges = $quot_data['total_stack_barcode_charges'];
        $stack_barcode_gst = 18;
        $stacking_gst_temp = ($stack_barcode_gst * $stack_barcode_charges) / 100;
        $stacking_gst_amt = number_format($stacking_gst_temp, 2, '.', '');
        $total_stack_charges_with_gst = number_format(($stack_barcode_charges + $stacking_gst_amt), 2, '.', '');
        $quot_data['stack_barcode_gst'] = $stack_barcode_gst;
        $quot_data['total_stack_charges_with_gst'] = $total_stack_charges_with_gst;
        /**/
        $total_storage_charges = $quot_data['total_storage_charges'];
        $storage_gst = 18;
        $storage_gst_temp = ($storage_gst * $total_storage_charges) / 100;
        $storage_gst_amt = number_format($storage_gst_temp, 2, '.', '');
        $total_storage_charges_with_gst = number_format(($storage_gst_amt + $total_storage_charges), 2, '.', '');
        $quot_data['storage_gst'] = $storage_gst;
        $quot_data['total_storage_charges_with_gst'] = $total_storage_charges_with_gst;
        /*means actual trnsport charges not stacking and barcoding*/
        $home_type = '';
        $token_amt = 0;
        if ($_POST['hometype'] == '1rk') {
            $token_amt = 1000;
        } else if ($_POST['hometype'] == '1bhk') {
            $token_amt = 1000;
        } else if ($_POST['hometype'] == '2bhk') {
            $token_amt = 2000;
        } else if ($_POST['hometype'] == '3bhk') {
            $token_amt = 3000;
        } else {
            $token_amt = 3000;
        }
        if (!empty($_POST['transport_coupon'])) {
            $transport_coupen_arr = explode('-', $_POST['transport_coupon']);
            if ($transport_coupen_arr[1] == 'flat') {
                $transport_coupon_amt = $transport_coupen_arr[2];
            } else {
                $transport_coupon_amt = ($transport_coupen_arr[2] / 100) * $quot_data['pickup_charges'];
            }
            $unformated_pickup_charges = ($quot_data['pickup_charges'] - $transport_coupon_amt);
            $pickup_charges = number_format((float)$unformated_pickup_charges, 2, '.', '');
            $transport_token_amt = $token_amt;
            /*number_format((float)($pickup_charges*10)/100, 2, '.', '');*/
            $trp_due_charges = ($pickup_charges - $transport_token_amt);
            $transport_due_charges = number_format((float)$trp_due_charges, 2, '.', '');
        } else {
            $pickup_charges = $quot_data['pickup_charges'];
            $transport_token_amt = $token_amt;
            /*number_format((float)($pickup_charges*10)/100, 2, '.', '');*/
            $trp_due_charges = ($pickup_charges - $transport_token_amt);
            $transport_due_charges = number_format((float)$trp_due_charges, 2, '.', '');
        }
        $quot_data['pickup_charges'] = $pickup_charges;
        $quot_data['total_pickup_charges'] = $pickup_charges;
        $quot_data['total_pickup_charges_with_gst'] = $pickup_charges;
        $quot_data['transport_due_charges'] = $transport_due_charges;
        $quot_data['transport_token_amt'] = $transport_token_amt;
        $transport_type = 'safestorage_transport';
        if (!empty($_POST['warehouse_arrival'])) {
            $transport_type = 'warehouse_arrival';
        }
        $quot_data['transport_type'] = $transport_type;
        /*for make multi factor as per city*/
        $storage_multi_factor = $this->storage_charges_multifactor($_POST['customer_local_city']);
        $transport_multi_factor = $this->transport_charges_multifactor($_POST['customer_local_city']);
        $quot_data['storage_multi_factor'] = $storage_multi_factor;
        $quot_data['transport_multi_factor'] = $transport_multi_factor;
         $quot_data['is_new_charges'] = 1;
        $quotation_id = $this->customer_model->addRecord('ss_customer_quotation', $quot_data);
        if (!empty($_POST['storage_item_slug']) && !empty($quotation_item_list)) {
            foreach ($_POST['storage_item_slug'] as $item_slug) {
                if (!empty(@$quotation_item_list[$item_slug])) {
                    $item = $quotation_item_list[$item_slug];
                    $item_count = @$_POST['storage_item_qty'][$item_slug];
                    $data = array('quotation_id' => $quotation_id, 'customer_id' => $customer_id, 'item_name' => $item->storage_item_name, 'item_slug' => $item_slug, 'item_count' => $item_count, 'storage_type_slug' => @$item->storage_type_slug,);
                    $this->customer_model->addRecord('ss_customer_quotation_item', $data);
                }
            }
        }
        $payment_security_code = rand(100, 1000);
        $row = array('payment_security_code' => $payment_security_code, 'pickup_floor' => htmlspecialchars(trim(@$_POST['pickup_floor']??'')), 'pickup_lift' => htmlspecialchars(trim(@$_POST['pickup_lift']??'')));
        $where = array('customer_id' => $customer_id);
        $this->customer_model->updateRecord('ss_customer', $row, $where);
        /*update code*/
        /*
        $quot_where =array('customer_id'=>$customer_id,'quotation_id' => $quotation_id);
        $item_list = $this->customer_model->getAllRecord('ss_customer_quotation_item',$quot_where);
        $item_list_array =[];
        foreach ($item_list as $key => $item) {
        
            $item_list_array[$item->storage_type_slug][$item->item_slug] = $item;
        }
        $item_data['item_list'] =$item_list_array;
        $item_data["storage_type_list"] = $this->storage_type_per_slug();
        
        $quotation_data =$this->customer_model->getSingleRecord('ss_customer_quotation',array('quotation_id'=>$quotation_id));
        $item_data['quotation_data'] = $quotation_data;
        $item_data['input_pallet'] = $quotation_data->total_pallet;
        $item_data['quotation_id'] = $quotation_id;
        $item_data['quoataton_amount'] = $quotation_data->total_storage_charges;
        $item_data['pickup_charges'] = $quotation_data->total_pickup_charges;
        $item_data['stack_barcode_charges'] = $quotation_data->total_stack_barcode_charges;*/
        /*end api*/
        $response = array();
        $response['quotation_id'] = $quotation_id;
        $response['customer_id'] = $customer_id;
        return $response;
    }
    public function storage_type_per_slug() {
        $storage_type_arr = [];
        $storage_type_list = $this->customer_model->get_storage_type_list();
        if (!empty($storage_type_list)) {
            foreach ($storage_type_list as $key => $item) {
                $storage_type_arr[$item->storage_type_slug] = $item->storage_type_name;
            }
        }
        return $storage_type_arr;
    }
    public function send_whatsapp_message($json_arr = null, $temp_file_name = null) {
        $apiURL = 'https://eu127.chat-api.com/instance147050/';
        $token = 'r5y7w80mkfuwyz0z';
        $url = '';
        if (!empty($temp_file_name)) {
            $url = $apiURL . 'sendFile?token=' . $token;
        } else {
            $url = $apiURL . 'message?token=' . $token;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_arr);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json', 'Content-length:' . strlen($json_arr)));
        $curl_response = curl_exec($ch);
        curl_close($ch);
        /*unlink temp file*/
        if (!empty($temp_file_name)) {
            $path_to_file = './upload/quotation/' . $temp_file_name;
            if (file_exists($path_to_file)) {
                unlink($path_to_file);
            }
        }
    }
    public function add_customer_document_quatation() {
        $cust_email_exist = [];
        $cust_contact_exist = [];
        $exist_customer_id = '';
        $date = date('Y-m-d H:i:s');
        if (!empty(@$_POST['customer_email'])) {
            $e_where = array('customer_email' => trim($_POST['customer_email']??''));
            $cust_email_exist = $this->customer_model->getSingleRecord('ss_customer', $e_where);
        }
        if (!empty(@$_POST['customer_contact1'])) {
            $m_where = array('customer_contact1' => trim($_POST['customer_contact1']??''));
            $cust_contact_exist = $this->customer_model->getSingleRecord('ss_customer', $m_where);
        }
        if (!empty($cust_contact_exist)) {
            $exist_customer_id = $cust_contact_exist->customer_id;
        }
        if (!empty($cust_email_exist)) {
            $exist_customer_id = $cust_email_exist->customer_id;
        }
        if ($exist_customer_id) {
            $data = array('customer_initial' => trim($_POST['customer_initial']??''), 'customer_name' => htmlspecialchars(trim($_POST['customer_name']??'')), 'customer_email' => htmlspecialchars(trim($_POST['customer_email']??'')), 'customer_contact1' => htmlspecialchars(trim($_POST['customer_contact1']??'')), 'customer_company' => htmlspecialchars(trim($_POST['customer_company']??'')), 'no_of_boxes' => htmlspecialchars(trim($_POST['no_box']??'')), 'storage_type' => 'document_storage', 'customer_local_city' => htmlspecialchars(trim($_POST['customer_local_city']??'')), 'pickup_address' => htmlspecialchars(trim(@$_POST['pickup_address']??'')), 'pickup_lat' => htmlspecialchars(trim($_POST['pickup_lat']??'')), 'pickup_lang' => htmlspecialchars(trim($_POST['pickup_lang']??'')), 'storage_date' => $_POST['storage_date'],
            //'customer_created_by' => $this->user_id
            );
            $where = array('customer_id' => $exist_customer_id);
            $this->customer_model->updateRecord('ss_customer', $data, $where);
            $customer_data = $this->customer_model->getSingleRecord('ss_customer', array('customer_id' => $exist_customer_id));
            if (!empty($customer_data->quotation_count)) {
                $update_quotation_count = $customer_data->quotation_count + 1;
            } else {
                $update_quotation_count = 1;
            }
            if ($update_quotation_count <= 3) {
                $item_data['qoutation_add_data'] = $qoutation_add_data = array('customer_id' => $exist_customer_id, 'no_of_boxes' => htmlspecialchars(trim($_POST['no_box']??'')), 'price_per_box' => '15', 'price_per_cuft' => '8.6', 'cu_ft' => '1.75', 'box_size' => '18" X 14" X 12"', 'created_at' => $date);
                $quotation_id = $this->customer_model->addRecord('ss_document_quotations', $qoutation_add_data);
                $quotation_number = "QT" . sprintf('%03d', $quotation_id);
                $this->customer_model->updateRecord('ss_document_quotations', array('quotation_number' => $quotation_number), array('document_quotation_id' => $quotation_id));
            }
            $row_data = array('quotation_count' => $update_quotation_count);
            $this->customer_model->updateRecord('ss_customer', $row_data, $where);
            $new_data = array('customer_id' => $exist_customer_id, 'storage_slug' => 'document_storage',);
            $this->customer_model->addRecord('ss_customer_storage_type', $new_data);
        } else {
            $data = array('customer_initial' => trim($_POST['customer_initial']??''), 'customer_name' => htmlspecialchars(trim($_POST['customer_name']??'')), 'customer_email' => htmlspecialchars(trim($_POST['customer_email']??'')), 'customer_contact1' => htmlspecialchars(trim($_POST['customer_contact1']??'')), 'customer_company' => htmlspecialchars(trim($_POST['customer_company']??'')), 'no_of_boxes' => htmlspecialchars(trim($_POST['no_box']??'')), 'storage_type' => 'document_storage', 'customer_local_city' => htmlspecialchars(trim($_POST['customer_local_city']??'')), 'pickup_address' => htmlspecialchars(trim(@$_POST['pickup_address']??'')), 'pickup_lat' => htmlspecialchars(trim($_POST['pickup_lat']??'')), 'pickup_lang' => htmlspecialchars(trim($_POST['pickup_lang']??'')), 'storage_date' => $_POST['storage_date'], 'quotation_count' => '1', 'is_customer' => '2',
            //'customer_created_by' => $this->user_id
            );
            /*check this customer is under Lead table*/
            $lead_relationship_manager_id = '';
            $lead_e_where = array('customer_email' => trim($_POST['customer_email']??''));
            $lead_m_where = array('customer_mobile_no' => trim($_POST['customer_contact1']??''));
            $lead_email_exist = $this->customer_model->getSingleRecord('ss_leads', $lead_e_where);
            $lead_contact_exist = $this->customer_model->getSingleRecord('ss_leads', $lead_m_where);
            if (!empty($lead_email_exist) || !empty($lead_contact_exist)) {
                if (!empty($lead_contact_exist)) {
                    $lead_relationship_manager_id = $lead_contact_exist->relationship_manager_id;
                }
                if (!empty($lead_email_exist)) {
                    $lead_relationship_manager_id = $lead_email_exist->relationship_manager_id;
                }
            }
            /*end checking*/
            if (!empty($lead_relationship_manager_id)) {
                $data['relationship_manager_id'] = @$lead_relationship_manager_id;
            } else {
                /*auto assign relationship manager to customer*/
                $order_by = 'customer_id desc';
                $last_customer_data = $this->customer_model->getOrderBySingleRecord('ss_customer', array(), $order_by);
                if (!empty($last_customer_data->relationship_manager_id)) {
                    $r_m_id = $last_customer_data->relationship_manager_id;
                    $r_manager_data = array();
                    $order_by = 'user_id asc';
                    $r_where = "role_id ='5' AND (user_id > '" . $r_m_id . "') AND status='0'"; //array('role_id' => 5);
                    $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                    if (!empty($r_manager_data)) {
                        $data['relationship_manager_id'] = @$r_manager_data->user_id;
                    } else {
                        $r_manager_data = array();
                        $order_by = 'user_id asc';
                        $r_where = array('role_id' => '5', 'status' => '0');
                        $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                        $data['relationship_manager_id'] = @$r_manager_data->user_id;
                    }
                } else {
                    $order_by = 'user_id asc';
                    $r_where = array('role_id' => '5', 'status' => '0');
                    $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                    $data['relationship_manager_id'] = @$r_manager_data->user_id;
                }
                /*end auto assign*/
            }
            $data['relationship_manager_id'] = '14848';
            $customer_id = $this->customer_model->addRecord('ss_customer', $data);
            $exist_customer_id = $customer_id;
            $city = substr(ucfirst($_POST['customer_local_city']), 0, 1);
            $storage_type_slug = "HD";
            //$part_num = 'P1';
            $customer_unique_id = $city . $storage_type_slug . sprintf("%03d", $customer_id);
            $where = array('customer_id' => $customer_id);
            $row_data = array('customer_unique_id' => $customer_unique_id);
            $this->customer_model->updateRecord('ss_customer', $row_data, $where);
            $exist_customer_id = $customer_id;
            $new_data = array('customer_id' => $exist_customer_id, 'storage_slug' => 'document_storage',);
            $this->customer_model->addRecord('ss_customer_storage_type', $new_data);
            $item_data['qoutation_add_data'] = $qoutation_add_data = array('customer_id' => $customer_id, 'no_of_boxes' => htmlspecialchars(trim($_POST['no_box']??'')), 'price_per_box' => '15', 'price_per_cuft' => '8.6', 'cu_ft' => '1.75', 'box_size' => '18" X 14" X 12"', 'created_at' => $date);
            $quotation_id = $this->customer_model->addRecord('ss_document_quotations', $qoutation_add_data);
            $quotation_number = "QT" . sprintf('%03d', $quotation_id);
            $this->customer_model->updateRecord('ss_document_quotations', array('quotation_number' => $quotation_number), array('document_quotation_id' => $quotation_id));
        }
        $item_data['customer_data'] = $customer_data = $this->customer_model->getSingleRecord('ss_customer', array('customer_id' => $exist_customer_id));
        $mail_body = $this->load->view('customer/document_quotation_mail_body', $item_data, true);
        $welcome = '';
        $response = [];
        // $response['old_customer_id'] = '';
        $response['status'] = "success";
        // if ($exist_customer_id) {
        //     $response['old_customer_id'] = $exist_customer_id;
        // }
        echo json_encode($response);
        die;
        ob_start();
        $date = date('Y-m-d H:i:s');
        // $static_attachment = './upload/safestorage/SafeStorage_Introdeck.pdf';
        //
        //$attach_file_arr = array($content,$content_1);
        $subject = $customer_data->customer_initial . " " . $customer_data->customer_name . ' | Quotation from SafeStorage';
        $welcome.= $mail_body;
        $welcome.= "<br/>";
        $welcome.= "<b>Thanks & Best Regards</b><br/>";
        $welcome.= "<span style='color:#05307f;'>SAFE STORAGE™ -<span> <span style='color:#ef5921;'>We Store Anything You Care!</span><br/>";
        $welcome.= "8088 84 84 84<br/>";
      
        $welcome.= "info@safestorage.in | www.safestorage.in<br/><br/>";
        /* $welcome  .="Thanks & Best Regards<br/>";
        $welcome  .="SafeStorage Team<br/>";
            $welcome  .="<span style='color:#05307f;'>SAFE STORAGE™ -<span> <span style='color:#ef5921;'>We Store Anything You Care!</span><br/>";
            $welcome  .="Land Line : 080-41121686 | 8088 84 84 84 | Mobile : 9606987656<br/>";
          $welcome  .="info@safestorage.in | safestorage.in@gmail.com | www.safestorage.in<br/><br/>"; */
        $this->load->library('email');
        $config = array();
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('quote@safestorage.in');
        $this->email->to($customer_data->customer_email);
        $this->email->cc('safestorage.in@gmail.com');
        $this->email->subject($subject);
        $this->email->message($welcome);
        // foreach ($attach_file_arr as $key => $filename) {
        //
        //  $this->email->attach($filename);
        // }
        $html = $this->load->view('customer/docuemt_qutation_pdf', $item_data, true);
        $this->load->library('m_pdf');
        $m_pdf = new mPDF();
        $m_pdf->debug = true;
        $m_pdf->SetDisplayMode('fullwidth');
        $m_pdf->showImageErrors = true;
        $m_pdf->WriteHTML($html);
        $content = $m_pdf->Output('', 'S');
        $filename = "QT" . sprintf('%03d', $quotation_id) . "_safestorage_" . time() . ".pdf";
        unset($mpdf); // this is the magic
        unset($html); // this is the magic
        $this->email->attach($content, 'attachment', $filename, 'application/pdf');
        $html = $this->load->view('customer/document_agrement_pdf.php', $item_data, true);
        $this->load->library('m_pdf');
        $m_pdf = new mPDF();
        $m_pdf->debug = true;
        $m_pdf->SetDisplayMode('fullwidth');
        $m_pdf->showImageErrors = true;
        // $this->m_pdf->pdf->WriteHTML($html);
        // $content = $this->m_pdf->pdf->Output('', 'S');
        // $filename = "QT".sprintf('%03d',$quotation_id)."_safestorage_".time().".pdf";
        $m_pdf->WriteHTML($html);
        $content_1 = $m_pdf->Output('', 'S');
        $agreementfilename = "QT" . sprintf('%03d', $quotation_id) . "_safestorage_agreement_" . time() . ".pdf";
        $this->email->attach($content_1, 'attachment', $agreementfilename, 'application/pdf');
        //$this->email->attach($static_attachment);
        $this->email->send();
        /*whatapp api*/
        /*send text message*/
        $temp_file_name = '';
        $json_arr = json_encode(array('phone' => "91" . $customer_data->customer_contact1, 'body' => 'Greetings from SafeStorage!
                    Please find the quotation and kindly revert us on mail at the earliest to book slot.'));
        $this->send_whatsapp_message($json_arr, $temp_file_name);
        /*save_file_name*/
        $temp_file_name = "QT" . sprintf('%03d', $quotation_id) . "_safestorage_" . time() . ".pdf";
        $this->m_pdf->pdf->Output('./upload/quotation/' . $temp_file_name, 'F');
        $file_path = base_url() . "upload/quotation/" . $temp_file_name;
        $filename = $temp_file_name;
        $chatId = "91" . $customer_data->customer_contact1 . "@c.us";
        $json_arr = json_encode(array('chatId' => $chatId, //"918624070867@c.us",
        'body' => $file_path, //FULL PATH and file name
        'filename' => $filename));
        $this->send_whatsapp_message($json_arr, $temp_file_name);
        /*end api*/
        $response = [];
        // $response['old_customer_id'] = '';
        $response['status'] = "success";
        // if ($exist_customer_id) {
        //     $response['old_customer_id'] = $exist_customer_id;
        // }
        echo json_encode($response);
    }
    public function document_customer() {
        $data = array();
        if (permissionChecker('lead_customer')) {
            $where = array();
            $data["user_list"] = $this->user_model->getAllUser($where);
            $data["customer_type"] = 'document_customer';
            $data["view_content"] = "customer/document_customer_list";
        } else {
            $data["view_content"] = "user/access_restrict";
        }
        echo modules::run('template/index', $data);
    }
    public function get_document_customer_list() {
        $where = "";
        $where.= 'ss_customer.is_customer ="2"';
        // echo $where;die();
        if (!empty($_POST['status'])) {
            $status = $_POST['status'];
            if (!empty($where)) {
                $where.= " AND ";
            }
            $where.= 'ss_customer.status ="' . $status . '"';
        }
        if (!empty($_POST['customer_local_city'])) {
            $customer_local_city = $_POST['customer_local_city'];
            if (!empty($where)) {
                $where.= " AND ";
            }
            $where.= 'ss_customer.customer_local_city ="' . $customer_local_city . '"';
        }
        if (!empty($_POST['user_id'])) {
            if (!empty($where)) {
                $where.= " AND ";
            }
            $user_id = $_POST['user_id'];
            $where.= '(ss_customer.customer_created_by ="' . $user_id . '")';
        }
        if (!empty($_POST['search_date'])) {
            $date_array = explode('-', $_POST['search_date']);
            $start_date = date('Y-m-d', strtotime($date_array[0]));
            $end_date = date('Y-m-d', strtotime($date_array[1]));
            if (!empty($where)) {
                $where.= " AND ";
            }
            $where.= "(date(`ss_customer`.`customer_created_at`) >= '" . $start_date . "' AND date(`ss_customer`.`customer_created_at`) <=  '" . $end_date . "')";
        }
        if (!empty($_POST['follow_up'])) {
            $follow_up = $_POST['follow_up'];
            if (!empty($where)) {
                $where.= " AND ";
            }
            $where.= 'ss_customer.follow_up ="' . $follow_up . '"';
        }
        $list = $this->customer_model->get_datatable_list($where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $item->customer_unique_id;
            $row[] = $item->customer_name;
            $row[] = $item->customer_email;
            $row[] = $item->customer_contact1;
            $row[] = ucfirst($item->customer_local_city);
            $row[] = $item->pickup_address;
            $row[] = date('d/m/Y', strtotime($item->customer_created_at));
            /*followup*/
            $select_follow_up = '';
            $select_follow_up.= '<select name="follow_up" id="follow_up" class="follow_up">';
            $select_follow_up.= '<option value="">Select</option>';
            if (@$item->follow_up == "called") {
                $select_follow_up.= '<option value="called_' . $item->customer_id . '"selected>Called</option>';
            } else {
                $select_follow_up.= '<option value="called_' . $item->customer_id . '" >Called</option>';
            }
            if (@$item->follow_up == "no-answer") {
                $select_follow_up.= '<option value="no-answer_' . $item->customer_id . '"selected>No answer</option>';
            } else {
                $select_follow_up.= '<option value="no-answer_' . $item->customer_id . '" >No answer</option>';
            }
            if (@$item->follow_up == "call-later") {
                $select_follow_up.= '<option value="call-later_' . $item->customer_id . '"selected>Call later</option>';
            } else {
                $select_follow_up.= '<option value="call-later_' . $item->customer_id . '" >Call later</option>';
            }
            if (@$item->follow_up == "sent-message") {
                $select_follow_up.= '<option value="sent-message_' . $item->customer_id . '"selected>Sent message</option>';
            } else {
                $select_follow_up.= '<option value="sent-message_' . $item->customer_id . '" >Sent message</option>';
            }
            if (@$item->follow_up == "closed") {
                $select_follow_up.= '<option value="closed_' . $item->customer_id . '"selected>Closed</option>';
            } else {
                $select_follow_up.= '<option value="closed_' . $item->customer_id . '" >Closed</option>';
            }
            $row[] = $select_follow_up;
            /*followup date*/
            $follow_up_date = '';
            if (!empty($item->follow_up_date)) {
                $follow_up_date = date('d/m/Y', strtotime($item->follow_up_date));
                $follow_up_date.= '<span data-customer_id=' . $item->customer_id . ' class="btn btn-info btn-sm open_popup_modal"><i class="ion ion-md-add"></i></span>';
            } else {
                $follow_up_date = '<span data-customer_id=' . $item->customer_id . ' class="btn btn-info btn-sm open_popup_modal"><i class="ion ion-md-add"></i></span>';
            }
            $row[] = $follow_up_date;
            /*Note */
            $follow_up_note = '';
            if (!empty($item->follow_up_note)) {
                $follow_up_note = $item->follow_up_note;
                $follow_up_note.= '<span data-customer_id=' . $item->customer_id . ' class="btn btn-info btn-sm open_popup_modal"><i class="ion ion-md-add"></i></span>';
            } else {
                $follow_up_note = '<span data-customer_id=' . $item->customer_id . ' class="btn btn-info btn-sm open_popup_modal"><i class="ion ion-md-add"></i></span>';
            }
            $row[] = $follow_up_note;
            $info = '';
            $info.= '<a href="' . base_url() . 'customer/document_customer_details/' . $item->customer_id . '" title="View" class="btn btn-class"><span class="fa fa-eye fa-2x"></span></a>';
            $row[] = $info;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->customer_model->count_all(), "recordsFiltered" => $this->customer_model->count_filtered($where), "data" => $data,);
        echo json_encode($output);
    }
    public function document_customer_details($customer_id = null) {
        if ($this->role_id == '6') {
            $where = array('user_id' => $this->user_id);
            $user_data = $this->customer_model->getSingleRecord('ss_user', $where);
            $customer_id = $user_data->customer_id;
        }
        if ($customer_id) {
            $data = array();
            /*if(permissionChecker('customer_list')) {*/
            $data["customer_info"] = $this->customer_model->getSingleRecord('ss_customer', array('customer_id' => $customer_id));
            if (!empty($data["customer_info"])) {
                $data["storage_type_list"] = $this->storage_model->get_storage_type_list(array());
                $data["warehouse_list"] = $this->customer_model->getAllRecord('ss_warehouse', array('status' => '0'));
                $cust_storage_list = $this->customer_model->getAllRecord('ss_customer_storage_type', array('customer_id' => $customer_id));
                $storage_list_array = [];
                if (!empty($cust_storage_list)) {
                    foreach ($cust_storage_list as $key => $item) {
                        $storage_list_array[] = $item->storage_slug;
                    }
                }
                $data["storage_list_array"] = $storage_list_array;
                //echo"<pre>";print_r($storage_list_array);die();
                //for orser section
                $data["order_type_list"] = $this->customer_model->getAllRecord('ss_order_type', array('status' => '0'));
                $data["time_slot_list"] = $this->customer_model->getAllRecord('ss_timeslot', array('status' => '0'));
                $s_where = array('role_id' => '4', //supervisor
                'status' => '0', 'user_city' => $data["customer_info"]->customer_local_city,);
                $data["supervisor_list"] = $this->user_model->getAllUser($s_where);
                $m_where = array('role_id' => '2', //manger
                'status' => '0', 'user_city' => $data["customer_info"]->customer_local_city,);
                $data["manager_list"] = $this->user_model->getAllUser($m_where);
                //list customer order list
                $order_where = array('ss_order.customer_id' => $customer_id,);
                $data["order_list"] = $this->customer_model->get_order_list($order_where);
                $data["order_status_slug"] = $this->order_status_list();
                $data["storage_type_list"] = $this->storage_type_per_slug();
                $data["floor_list"] = $this->customer_model->getAllRecord('ss_floor', array('status' => '0'));
                $data["city_list"] = $this->customer_model->getAllRecord('ss_city', array('status' => '0'));
                /*echo "<pre>";print_r($data["storage_type_list"]);die();*/
                $data["view_content"] = "customer/document_customer_details";
            } else {
                redirect('./customer/document_customer_list');
            }
            /*}else{
            
            $data["view_content"] = "user/access_restrict";
            }*/
            echo modules::run('template/index', $data);
        } else {
            redirect('./customer/document_customer_list');
        }
    }
    public function get_document_customer_quotation_list() {
        $where = array('customer_id' => $_POST['customer_id']);
        $list = $this->customer_model->get_document_quotation_datatable_list($where);
        $data = array();
        $no = $_POST['start'];
        //echo"<pre>";print_r($list);die();
        foreach ($list as $item) {
            $no++;
            $row = array();
            // $row[] = "QT" . sprintf('%03d', $item->quotation_id);
            $row[] = $item->quotation_number;
            $row[] = $item->no_of_boxes;
            $row[] = $item->price_per_box;
            $row[] = $item->price_per_cuft;
            $row[] = $item->cu_ft;
            $row[] = $item->box_size;
            $row[] = date('d/m/Y', strtotime($item->created_at));
            $info = '';
            if ($this->role_id == 1) {
                $info.= '<a style="font-size: 18px;padding: 5px;"  id="' . $item->document_quotation_id . '" class="edit_quotation_btn" title="edit quotation" class="btn btn-class"><i class="icon-pencil" aria-hidden="true"></i></a>';
                $info.= '<span onclick="delete_quotation_record(' . $item->document_quotation_id . ')" title="Delete Order" class="btn btn-class"><span class="fas fa-trash-alt fa-2x"></span></span>';
            }
            $row[] = $info;
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->customer_model->document_quotation_count_all(), "recordsFiltered" => $this->customer_model->document_quotation_count_filtered($where), "data" => $data,);
        echo json_encode($output);
    }
    public function edit_document_quotation() {
        if (!empty($_POST)) {
            $result = $this->customer_model->getSingleRecord('ss_document_quotations', array('document_quotation_id' => $_POST['document_quotation_id']));
            echo json_encode($result);
        }
    }
    public function update_document_quotation_record() {
        if (!empty($_POST)) {
            $date = date('Y-m-d H:i:s');
            $qoutation_add_data = array('no_of_boxes' => htmlspecialchars(trim($_POST['no_box']??'')), 'price_per_box' => htmlspecialchars(trim($_POST['price_per_box']??'')), 'price_per_cuft' => htmlspecialchars(trim($_POST['price_per_cuft']??'')), 'cu_ft' => htmlspecialchars(trim($_POST['cu_ft']??'')), 'box_size' => htmlspecialchars(trim($_POST['box_size']??'')), 'created_at' => $date);
            $this->customer_model->updateRecord('ss_document_quotations', $qoutation_add_data, array('document_quotation_id' => $_POST['document_quotation_id']));
            echo json_encode('success');
        }
    }
    public function add_document_quotation_record() {
        $date = date('Y-m-d H:i:s');
        $item_data['qoutation_add_data'] = $qoutation_add_data = array('customer_id' => $_POST['customer_id'], 'no_of_boxes' => htmlspecialchars(trim($_POST['no_box']??'')), 'price_per_box' => htmlspecialchars(trim($_POST['price_per_box']??'')), 'price_per_cuft' => htmlspecialchars(trim($_POST['price_per_cuft']??'')), 'cu_ft' => htmlspecialchars(trim($_POST['cu_ft']??'')), 'box_size' => htmlspecialchars(trim($_POST['box_size']??'')), 'created_at' => $date);
        $exist_customer_id = $customer_id = $_POST['customer_id'];
        $quotation_id = $this->customer_model->addRecord('ss_document_quotations', $qoutation_add_data);
        $quotation_number = "QT" . sprintf('%03d', $quotation_id);
        $this->customer_model->updateRecord('ss_document_quotations', array('quotation_number' => $quotation_number), array('document_quotation_id' => $quotation_id));
        $item_data['customer_data'] = $customer_data = $this->customer_model->getSingleRecord('ss_customer', array('customer_id' => $customer_id));
        $mail_body = $this->load->view('customer/document_quotation_mail_body', $item_data, true);
        $welcome = '';
        ob_start();
        $date = date('Y-m-d H:i:s');
        // $static_attachment = './upload/safestorage/SafeStorage_Introdeck.pdf';
        //
        //$attach_file_arr = array($content,$content_1);
        $subject = $customer_data->customer_initial . " " . $customer_data->customer_name . ' | Quotation from SafeStorage';
        $welcome.= $mail_body;
        $welcome.= "<br/>";
        $welcome.= "<b>Thanks & Best Regards</b><br/>";
        $welcome.= "<span style='color:#05307f;'>SAFE STORAGE™ -<span> <span style='color:#ef5921;'>We Store Anything You Care!</span><br/>";
        $welcome.= "8088 84 84 84<br/>";
       
        $welcome.= "info@safestorage.in | www.safestorage.in<br/><br/>";
        /* $welcome  .="Thanks & Best Regards<br/>";
        $welcome  .="SafeStorage Team<br/>";
          $welcome  .="<span style='color:#05307f;'>SAFE STORAGE™ -<span> <span style='color:#ef5921;'>We Store Anything You Care!</span><br/>";
          $welcome  .="Land Line : 080-41121686 | 8088 84 84 84 | Mobile : 9606987656<br/>";
          $welcome  .="info@safestorage.in | safestorage.in@gmail.com | www.safestorage.in<br/><br/>"; */
        $this->load->library('email');
        $config = array();
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('quote@safestorage.in');
        $this->email->to($customer_data->customer_email);
        $this->email->cc('safestorage.in@gmail.com');
        $this->email->subject($subject);
        $this->email->message($welcome);
        // foreach ($attach_file_arr as $key => $filename) {
        //
        //  $this->email->attach($filename);
        // }
        $html = $this->load->view('customer/docuemt_qutation_pdf', $item_data, true);
        $this->load->library('m_pdf');
        $m_pdf = new mPDF();
        $m_pdf->debug = true;
        $m_pdf->SetDisplayMode('fullwidth');
        $m_pdf->showImageErrors = true;
        $m_pdf->WriteHTML($html);
        $content = $m_pdf->Output('', 'S');
        $filename = "QT" . sprintf('%03d', $quotation_id) . "_safestorage_" . time() . ".pdf";
        unset($mpdf); // this is the magic
        unset($html); // this is the magic
        $this->email->attach($content, 'attachment', $filename, 'application/pdf');
        $html = $this->load->view('customer/document_agrement_pdf.php', $item_data, true);
        $this->load->library('m_pdf');
        $m_pdf = new mPDF();
        $m_pdf->debug = true;
        $m_pdf->SetDisplayMode('fullwidth');
        $m_pdf->showImageErrors = true;
        // $this->m_pdf->pdf->WriteHTML($html);
        // $content = $this->m_pdf->pdf->Output('', 'S');
        // $filename = "QT".sprintf('%03d',$quotation_id)."_safestorage_".time().".pdf";
        $m_pdf->WriteHTML($html);
        $content_1 = $m_pdf->Output('', 'S');
        $agreementfilename = "QT" . sprintf('%03d', $quotation_id) . "_safestorage_agreement_" . time() . ".pdf";
        $this->email->attach($content_1, 'attachment', $agreementfilename, 'application/pdf');
        //$this->email->attach($static_attachment);
        $this->email->send();
        /*whatapp api*/
        /*send text message*/
        $temp_file_name = '';
        $json_arr = json_encode(array('phone' => "91" . $customer_data->customer_contact1, 'body' => 'Greetings from SafeStorage!
          Please find the quotation and kindly revert us on mail at the earliest to book slot.'));
        $this->send_whatsapp_message($json_arr, $temp_file_name);
        /*save_file_name*/
        $temp_file_name = "QT" . sprintf('%03d', $quotation_id) . "_safestorage_" . time() . ".pdf";
        $this->m_pdf->pdf->Output('./upload/quotation/' . $temp_file_name, 'F');
        $file_path = base_url() . "upload/quotation/" . $temp_file_name;
        $filename = $temp_file_name;
        $chatId = "91" . $customer_data->customer_contact1 . "@c.us";
        $json_arr = json_encode(array('chatId' => $chatId, //"918624070867@c.us",
        'body' => $file_path, //FULL PATH and file name
        'filename' => $filename));
        $this->send_whatsapp_message($json_arr, $temp_file_name);
        /*end api*/
        $response = [];
        $response['old_customer_id'] = '';
        $response['status'] = "success";
        if ($exist_customer_id) {
            $response['old_customer_id'] = $exist_customer_id;
        }
        echo json_encode($response);
    }
    /*for delete quotation*/
    public function delete_document_quotation_data() {
        if (!empty($_POST['quotation_id'])) {
            $quotation_id = $_POST['quotation_id'];
            $where = array('document_quotation_id' => $quotation_id,);
            $this->customer_model->deleteRecord('ss_document_quotations', $where);
            echo "success";
        }
    }
    public function allow_document_data() {
        //print_r($_POST);
        if (!empty($_POST['customer_id'])) {
            $customer_id = $_POST['customer_id'];
            $data = array('quotation_count' => '0');
            $where = array('customer_id' => $customer_id,);
            $this->customer_model->updateRecord('ss_customer', $data, $where);
            echo "success";
        }
    }
    public function add_customer_phone_no() {
        $customer_mobile_no = $_POST['customer_mobile_no'];
        $table_name = 'ss_leads';
        $data = array('customer_mobile_no' => $customer_mobile_no, 'status' => '0', 'storage_type' => 'household_storage',);
        /*auto assign relationship manager to customer*/
        $order_by = 'id desc';
        $last_customer_data = $this->customer_model->getOrderBySingleRecord('ss_leads', array(), $order_by);
        $customer_id = '';
        $c_relationship_manager_id = '';
        $cl_where = array('customer_mobile_no' => trim($_POST['customer_mobile_no']??''));
        $cl_exist = $this->customer_model->getSingleRecord('ss_leads', $cl_where);
        $c_m_where = array('customer_contact1' => trim($_POST['customer_mobile_no']??''));
        $contact_exist = $this->customer_model->getSingleRecord('ss_customer', $c_m_where);
        if (!empty($contact_exist)) {
            $customer_id = $contact_exist->customer_id;
            $c_relationship_manager_id = $contact_exist->relationship_manager_id;
        }
        if (!empty($cl_exist)) {
            $c_relationship_manager_id = $cl_exist->relationship_manager_id;
        }
        if (!empty($last_customer_data->relationship_manager_id)) {
            $r_m_id = $last_customer_data->relationship_manager_id;
            $r_manager_data = array();
            $order_by = 'user_id asc';
            $r_where = "role_id ='5' AND (user_id > '" . $r_m_id . "')";
            $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
            if (!empty($r_manager_data)) {
                $data['relationship_manager_id'] = @$r_manager_data->user_id;
            } else {
                $r_manager_data = array();
                $order_by = 'user_id asc';
                $r_where = array('role_id' => '5','status' => '0');
                $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
                $data['relationship_manager_id'] = @$r_manager_data->user_id;
            }
        } else {
            $order_by = 'user_id asc';
            $r_where = array('role_id' => '5','status' => '0');
            $r_manager_data = $this->customer_model->getOrderBySingleRecord('ss_user', $r_where, $order_by);
            $data['relationship_manager_id'] = @$r_manager_data->user_id;
        }
        /*check in customer table*/
        if (!empty($c_relationship_manager_id)) {
            $data['relationship_manager_id'] = $c_relationship_manager_id;
        }
        if (!empty($customer_id)) {
            $data['is_converted_to_quot'] = '1';
        }
        /*end auto assign*/
        $this->customer_model->addRecord($table_name, $data);
        echo "success";
    }


    public function check_autohometype() {

        //ss_storage_item
        if (!empty($_POST['storage_item_slug'])) {
            $data = array();
            $order_by = "storage_item_name asc";
            $where = '';
            $storage_item = $this->customer_model->getAllRecord('ss_refined_storage_item', $where, $order_by);
            $quotation_item_list = array();
            $total_storage_charges = 0;
            $storage_item_charges = 0;
            $hometype = $_POST['hometype'];
            if (!empty($storage_item)) {
                foreach ($storage_item as $key => $item) {
                    if (in_array($item->storage_item_slug, $_POST['storage_item_slug'])) {
                        $item_qty = @$_POST['storage_item_qty'][@$item->storage_item_slug];
                        $storage_item_charges+= ($item->storage_item_charges_change * $item_qty);
                    }
                }
            }
            // echo $storage_item_charges;die;
            $total_storage_charges = number_format((float)$storage_item_charges, 2, '.', '');
            $ishometype = 'invalid_hometype';
            if ($total_storage_charges <= 0) {
                $ishometype = '1rk';
            }
            if ($total_storage_charges <= 1500) {
                $ishometype = '1rk';
            }
            if ($total_storage_charges > 1500 && $total_storage_charges <= 3000) {
                $ishometype = '1bhk';
            }
            if ($total_storage_charges > 3000 && $total_storage_charges <= 5000) {
                $ishometype = '2bhk';
            }
            if ($total_storage_charges > 5000 && $total_storage_charges <= 7000) {
                $ishometype = '3bhk';
            }
            if ($total_storage_charges > 7000 && $total_storage_charges <= 10000) {
                $ishometype = '4bhk';
            }
            if ($total_storage_charges > 10000) {
                $ishometype = 'max_quantity';
            }
        }
        echo $ishometype;
        die;
    }


    public function referral_view() {
        $data = array();
        $data['meta_file'] = '';
        $this->load->view('frontend/new/new_header', $data);
        $this->load->view('customer/referral_view', $data);
        $this->load->view('frontend/new/new_footer');
    }
   
    public function custom_encrypt($input_string = null) {
        // Store cipher method
        $ciphering = "BF-CBC";
        // Use OpenSSl encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        // Use random_bytes() function which gives
        // randomly 16 digit values
        $encryption_iv = random_bytes($iv_length);
        // Alternatively, we can use any 16 digit
        // characters or numeric for iv
        $encryption_key = openssl_digest(php_uname(), 'MD5', TRUE);
        // Encryption of string process starts
        $encryption = openssl_encrypt($input_string, $ciphering, $encryption_key, $options, $encryption_iv);
        return $encryption;
    }
    public function custom_decrypt($input_string = null) {
        // Store cipher method
        $ciphering = "BF-CBC";
        // Use OpenSSl encryption method
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options = 0;
        // Use random_bytes() function which gives
        // randomly 16 digit values
        $encryption_iv = random_bytes($iv_length);
        // Store the decryption key
        $decryption_key = openssl_digest(php_uname(), 'MD5', TRUE);
        // Descrypt the string
        $decryption = openssl_decrypt($input_string, $ciphering, $decryption_key, $options, $encryption_iv);
        return $decryption;
    }
    public function check_customer_data() {
        $data = array();
        if (!empty($_POST['email_mobile_field'])) {
            $email_mobile_field = htmlspecialchars(trim($_POST['email_mobile_field']??''));
            $exist_customer_id = '';
            $is_email_notification = '';
            $e_where = array('customer_email' => $email_mobile_field,'is_customer' => '1');
            $m_where = array('customer_contact1' => $email_mobile_field,'is_customer' => '1');
            $customer_data = array();
            $cust_email_exist = $this->customer_model->getSingleRecord('ss_customer', $e_where);
            $cust_contact_exist = $this->customer_model->getSingleRecord('ss_customer', $m_where);
            if (!empty($cust_email_exist) || !empty($cust_contact_exist)) {
                if (!empty($cust_contact_exist)) {
                    $customer_data = $cust_contact_exist;
                }
                if (!empty($cust_email_exist)) {
                    $is_email_notification = 'Yes';
                    $customer_data = $cust_email_exist;
                }
            }
            if (!empty($customer_data)) {
                $customer_id = $customer_data->customer_id;
                $customer_email = $customer_data->customer_email;
                $customer_contact = $customer_data->customer_contact1;
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0;$i < 2;$i++) {
                    $randomString.= $characters[rand(0, $charactersLength - 1) ];
                }
                $randomString.= mt_rand(1000, 9999);
                $c_where = array('customer_id =' => $customer_id,);
                $customer_data = array('onetime_payment_code' => $randomString);
                $this->customer_model->updateRecord('ss_customer', $customer_data, $c_where);
                if (!empty($is_email_notification)) {
                    /*for email otp*/
                    /*$email_id = $customer_email;
                    
                    $this->load->library('email');
                    
                    $config['protocol'] = 'sendmail';
                    
                    $config['mailpath'] = '/usr/sbin/sendmail';
                    
                    $config['charset'] = 'iso-8859-1';
                    
                    $config['wordwrap'] = TRUE;
                    
                    $config['mailtype'] = 'html'; 
                    
                    $this->email->initialize($config);
                    
                    $welcome  ="Dear customer,<br/><br/>";
                    
                    $welcome .="Your safestorage payment OTP : ".$randomString."<br/><br/>";
                    
                    $welcome.= "<b>Thanks & Best Regards</b><br/>";
                    $welcome.= "<span style='color:#05307f;'>SAFE STORAGE™ -<span> <span style='color:#ef5921;'>We Store Anything You Care!</span><br/>";
                    $welcome.= "8088 84 84 84<br/>";
                    $welcome.= "Registered Address: #130/1, Hanumantha Gowda Compound,<br/>";
                    $welcome.= "Immadihalli Rd, Whitefield, Bengaluru, Karnataka 560066<br/>";
                    $welcome.= "info@safestorage.in | www.safestorage.in<br/><br/>";
                    
                    $this->email->from('safestorage.in@gmail.com', 'Safestorage');
                    
                    $this->email->to($email_id);
                    
                    $this->email->subject('Safestorage OTP');
                    
                    $this->email->message($welcome);
                    
                    $this->email->send();*/
                } else {
                    /*for mobile otp*/
                    /* $msg    = "SafeStorage : ".$randomString." is your payment OTP";
                    $mob_no = $customer_contact;
                    
                    $curl = curl_init();
                    
                      curl_setopt_array($curl, array(
                      CURLOPT_URL => "https://www.fast2sms.com/dev/bulk?authorization=nHxbTYe1vJR8rsPclWyCF4DEa3B0QKAUONqziu5mk6p9VfghIwTk0DMX1tHh8OYKg3wL4xQfURJ9SdGj&sender_id=FSTSMS&message=".urlencode($msg)."&language=english&route=t&numbers=".urlencode($mob_no),
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => "",
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 30,
                      CURLOPT_SSL_VERIFYHOST => 0,
                      CURLOPT_SSL_VERIFYPEER => 0,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => "GET",
                      CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache"
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    $opt_output ='';
                    if ($err) {
                        $opt_output = '';
                    } else {
                        $opt_output = $randomString;
                    }*/
                }
                $customer_enc_id = $this->encryption->encrypt($customer_id);
                $mobile_no = substr($customer_contact, -4);
                $data['id'] = $customer_enc_id;
                $data['is_email_notification'] = $is_email_notification;
                $data['mobile_no'] = $mobile_no;
                $data['status'] = 'success';
            } else {
                $data['status'] = 'error';
            }
            echo json_encode($data);
            die();
        }
    }
    public function verify_otp_data() {
        $response_code = array();
        if (!empty($_POST['user_otp']) && !empty($_POST['popover_id'])) {
            $customer_id = $this->encryption->decrypt($_POST['popover_id']);
            $onetime_payment_code = trim($_POST['user_otp']??'');
            $where = array('customer_id' => $customer_id, 'onetime_payment_code' => $onetime_payment_code,);
            $customer_data = $this->customer_model->getSingleRecord('ss_customer', $where);
            if (!empty($customer_data)) {
                $response_code['status'] = 'success';
                $response_code['id'] = $this->encryption->encrypt($customer_data->customer_id);
                echo json_encode($response_code);
                die();
            } else {
                $response_code['status'] = 'error';
                echo json_encode($response_code);
                die();
            }
        } else {
            $response_code['status'] = 'error';
            echo json_encode($response_code);
            die();
        }
    }


   


    public function retrieval_payment() { 
        $retrieval_session_data = $this->session->userdata("retrieval_session");
        $total_amount = $retrieval_session_data['final_payable_amt'];
        $customer_id = $retrieval_session_data['customer_id'];
        $where = array('customer_id' => $customer_id,);
        $customer_data = $this->common_model->getSingleRecord('ss_customer', $where);

        print_r($retrieval_session_data); die;
        $city = $customer_data->customer_local_city;
        $where = array('customer_local_city' => $city);
        $invoice_no = $this->common_model->get_invoice_no($where);
        $invoice_split_array = [];
        $invoice_split_array = str_split($invoice_no, 4);
        $invoice_year = $invoice_split_array[0];
        $invoice_split_array = str_split($invoice_split_array[1], 3);
        $invoice_city = $invoice_split_array[0];
        $invoice_split_array = str_split($invoice_no, 7);
        $count = count($invoice_split_array);
        $invoice_digits = preg_replace('/[^0-9]/', '', $invoice_split_array[1]);
        $invoice_month = preg_replace('/[^a-zA-Z]/', '', $invoice_split_array[1]);
        if ($count > 2) {
            $invoice_digits = $invoice_digits . $invoice_split_array[2];
        } else {
            $invoice_digits = $invoice_digits;
        }
        $invoice_where_req = array('invoice_year' => $invoice_year, 'invoice_city' => $invoice_city, 'invoice_month' => $invoice_month, 'invoice_digits >=' => $invoice_digits);
        //
        /*check exist invoice no*/
        $invoice_where = array('invoice_no' => $invoice_no);
        $is_exist_invoice = $this->common_model->check_exist_invoice($invoice_where);
        $is_exist_invoice_request = $this->common_model->check_exist_invoice_request($invoice_where_req);
        //echo "<pre>";print_r($is_exist_invoice_request);die();
        if (!empty($is_exist_invoice)) {
            $exists = '1';
            $new_invoice_no = $this->common_model->genrate_invoice_no($is_exist_invoice->invoice_no, $city, $exists);
            $invoice_no = $new_invoice_no;
        }
        if (!empty($is_exist_invoice_request)) {
            $exists = '1';
            $current_invoice_no = $is_exist_invoice_request[count($is_exist_invoice_request) - 1]->invoice_no;
            $new_invoice_no = $this->common_model->genrate_invoice_no_request($current_invoice_no, $city, $exists);
            $invoice_no = $new_invoice_no;
            // echo "<pre>";print_r($current_invoice_no);die();
            
        }
        $invoice_split_array = [];
        $invoice_split_array = str_split($invoice_no, 4);
        $invoice_year = $invoice_split_array[0];
        $invoice_split_array = str_split($invoice_split_array[1], 3);
        $invoice_city = $invoice_split_array[0];
        $invoice_split_array = str_split($invoice_no, 7);
        $count = count($invoice_split_array);
        $invoice_digits = preg_replace('/[^0-9]/', '', $invoice_split_array[1]);
        $invoice_month = preg_replace('/[^a-zA-Z]/', '', $invoice_split_array[1]);
        if ($count > 2) {
            $invoice_digits = $invoice_digits . $invoice_split_array[2];
        } else {
            $invoice_digits = $invoice_digits;
        }
        header("Pragma: no-cache");
        header("Cache-Control: no-cache");
        header("Expires: 0");
        // following files need to be included
        require_once (APPPATH . "/third_party/paytm/lib/config_paytm.php");
        require_once (APPPATH . "/third_party/paytm/lib/encdec_paytm.php");
        $checkSum = "";
        $paramList = array();
        $ORDER_ID = "ORDS" . rand(10000, 99999999); //$_POST["ORDER_ID"];
        $CUST_ID = "CUST" . str_pad(@$customer_id, 3, '0', STR_PAD_LEFT); //$_POST["CUST_ID"];
        $INDUSTRY_TYPE_ID = 'Retail105'; //$_POST["INDUSTRY_TYPE_ID"];
        $CHANNEL_ID = 'WEB'; //$_POST["CHANNEL_ID"];
        $TXN_AMOUNT = $total_amount; //$_POST["TXN_AMOUNT"];
        //echo "TXN_AMOUNT ".$TXN_AMOUNT;die();
        /*add data to request retrieval table to check response on not recorded */
        $payment_request = array('customer_id' => $customer_id, 'ORDERID' => $ORDER_ID, 'TXNAMOUNT' => $TXN_AMOUNT, 'payment_type' => 'retrieval_charges', 'created_at' => date('Y-m-d H:i:s'), 'invoice_no' => $invoice_no, 'invoice_year' => $invoice_year, 'invoice_city' => $invoice_city, 'invoice_month' => $invoice_month, 'invoice_digits' => $invoice_digits);
        $payment_request_id = $this->common_model->addRecord('ss_retrieval_payment_request', $payment_request);
        $payment_req_data_inv = array('invoice_no' => $invoice_no, 'invoice_year' => $invoice_year, 'invoice_city' => $invoice_city, 'invoice_month' => $invoice_month, 'invoice_digits' => $invoice_digits);
        $this->common_model->addRecord('ss_invoices_tbl', $payment_req_data_inv);
        // Create an array having all required parameters for creating checksum.
        $paramList["MID"] = PAYTM_MERCHANT_MID;
        $paramList["ORDER_ID"] = $ORDER_ID;
        $paramList["CUST_ID"] = $CUST_ID;
        $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
        $paramList["CHANNEL_ID"] = $CHANNEL_ID;
        $paramList["TXN_AMOUNT"] = 1;
        $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
        $paramList["CALLBACK_URL"] = base_url() . "auth/retrieval_payment_response?id=" . $customer_id;
        //Here checksum string will return by getChecksumFromArray() function.
        $checkSum = getChecksumFromArray($paramList, PAYTM_MERCHANT_KEY);
        echo "<html>
                <head>
                <title>Merchant Check Out Page</title>
                </head>
                <body>
                    <center><h1>Please do not refresh this page...</h1></center>
                        <form method='post' action='" . PAYTM_TXN_URL . "' name='f1'>
                <table border='1'>
                 <tbody>";
        foreach ($paramList as $name => $value) {
            echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
        }
        echo "<input type='hidden' name='CHECKSUMHASH' value='" . $checkSum . "'>
                 </tbody>
                </table>
                <script type='text/javascript'>
                 document.f1.submit();
                </script>
                </form>
                </body>
            </html>";
    }


    


   


    public function pay_partial_amount_charges() {
        // echo "<pre>";print_r($_POST);die();
        if (!empty($_POST['te_customer_id']) && !empty($_POST['TXN_AMOUNT'])) {
            $customer_id = trim($_POST['te_customer_id']??'');
            $where = array('customer_id' => $customer_id,);
            $customer_data = $this->common_model->getSingleRecord('ss_customer', $where);
            /*payment request*/
            // $payment_req_data = array('customer_id' => $customer_id, 'ORDERID' => $_POST['ORDER_ID'], 'TXNAMOUNT' => $_POST['TXN_AMOUNT'], 'payment_type' => $_POST['storage_payment_type'], 'created_at' => date('Y-m-d H:i:s'),);
            // $this->common_model->addRecord('ss_payment_request', $payment_req_data);
            $city = $customer_data->customer_local_city;
            $where = array('customer_local_city' => $city);
            $invoice_no = $this->common_model->get_invoice_no($where);
            $invoice_split_array = [];
            $invoice_split_array = str_split($invoice_no, 4);
            $invoice_year = $invoice_split_array[0];
            $invoice_split_array = str_split($invoice_split_array[1], 3);
            $invoice_city = $invoice_split_array[0];
            $invoice_split_array = str_split($invoice_no, 7);
            $count = count($invoice_split_array);
            $invoice_digits = preg_replace('/[^0-9]/', '', $invoice_split_array[1]);
            $invoice_month = preg_replace('/[^a-zA-Z]/', '', $invoice_split_array[1]);
            if ($count > 2) {
                $invoice_digits = $invoice_digits . $invoice_split_array[2];
            } else {
                $invoice_digits = $invoice_digits;
            }
            $invoice_where_req = array('invoice_year' => $invoice_year, 'invoice_city' => $invoice_city, 'invoice_month' => $invoice_month, 'invoice_digits >=' => $invoice_digits);
            //
            /*check exist invoice no*/
            $invoice_where = array('invoice_no' => $invoice_no);
            $is_exist_invoice = $this->common_model->check_exist_invoice($invoice_where);
            $is_exist_invoice_request = $this->common_model->check_exist_invoice_request($invoice_where_req);
            //echo "<pre>";print_r($is_exist_invoice_request);die();
            if (!empty($is_exist_invoice)) {
                $exists = '1';
                $new_invoice_no = $this->common_model->genrate_invoice_no($is_exist_invoice->invoice_no, $city, $exists);
                $invoice_no = $new_invoice_no;
            }
            if (!empty($is_exist_invoice_request)) {
                $exists = '1';
                $current_invoice_no = $is_exist_invoice_request[count($is_exist_invoice_request) - 1]->invoice_no;
                $new_invoice_no = $this->common_model->genrate_invoice_no_request($current_invoice_no, $city, $exists);
                $invoice_no = $new_invoice_no;
            }
            $invoice_split_array = [];
            $invoice_split_array = str_split($invoice_no, 4);
            $invoice_year = $invoice_split_array[0];
            $invoice_split_array = str_split($invoice_split_array[1], 3);
            $invoice_city = $invoice_split_array[0];
            $invoice_split_array = str_split($invoice_no, 7);
            $count = count($invoice_split_array);
            $invoice_digits = preg_replace('/[^0-9]/', '', $invoice_split_array[1]);
            $invoice_month = preg_replace('/[^a-zA-Z]/', '', $invoice_split_array[1]);
            if ($count > 2) {
                $invoice_digits = $invoice_digits . $invoice_split_array[2];
            } else {
                $invoice_digits = $invoice_digits;
            }
            $payment_req_data = array('customer_id' => $customer_id, 'ORDERID' => $_POST['ORDER_ID'], 'TXNAMOUNT' => $_POST['TXN_AMOUNT'], 'payment_type' => $_POST['storage_payment_type'], 'created_at' => date('Y-m-d H:i:s'), 'invoice_no' => $invoice_no, 'invoice_year' => $invoice_year, 'invoice_city' => $invoice_city, 'invoice_month' => $invoice_month, 'invoice_digits' => $invoice_digits);
            $this->common_model->addRecord('ss_payment_request', $payment_req_data);
            $payment_req_data_inv = array('invoice_no' => $invoice_no, 'invoice_year' => $invoice_year, 'invoice_city' => $invoice_city, 'invoice_month' => $invoice_month, 'invoice_digits' => $invoice_digits);
            $this->common_model->addRecord('ss_invoices_tbl', $payment_req_data_inv);
            /*end payment request*/
            /*check is there combined charges or not*/
            $p_where = array('customer_id' => $customer_id, 'charges_type' => 'transport_charges', 'payment_status' => 'Unpaid',);
            $transport_row = $this->common_model->getSingleRecord('ss_customer_payment', $p_where);
            if (empty($transport_row)) {
                $p_where = array('customer_id' => $customer_id, 'tax' => '0', 'payment_status' => 'Unpaid',);
                $transport_row = $this->common_model->getSingleRecord('ss_customer_payment', $p_where);
                //
                
            }
            // echo "<pre>";print_r($transport_row);die();
            /*check due is more than 1 then its combined*/
            $d_where = array('customer_id' => $customer_id, 'payment_status' => 'Unpaid',);
            $due_payment_count = $this->common_model->getRowCount('ss_customer_payment', $d_where);
            /*maintain refernce for transport & storage charges if they are combined*/
            if (!empty($transport_row) && $due_payment_count > 1) {
                $total_storage_amt = ($_POST['TXN_AMOUNT'] - $transport_row->payable_amount);
                $transport_type = 'safestorage_transport';
                if ($transport_row->tax > 0) {
                    $transport_type = 'warehouse_arrival';
                }
                $pre_transaction_data = array('customer_id' => $customer_id, 'ORDERID' => $_POST['ORDER_ID'], 'transport_total_amt' => $transport_row->payable_amount, 'transport_note' => "Transport Due amount", 'total_storage_amt' => $total_storage_amt, 'storage_note' => "Storage charges", 'created_at' => date('Y-m-d H:i:s'), 'transport_type' => $transport_type,);
                $this->common_model->addRecord('ss_pre_transaction_data', $pre_transaction_data);
            }
            /*end checking combined charges*/
            $encoded_customer_id = $customer_id;
            $storage_payment_type = @$_POST['storage_payment_type'];
            $minus_wallet_amt = @$_POST['minus_wallet_amt'];
            header("Pragma: no-cache");
            header("Cache-Control: no-cache");
            header("Expires: 0");

            $ORDER_ID = "ORDS" . date('mdYHis').$customer_id;
            $_POST['ORDER_ID']= $ORDER_ID;



            $ORDER_ID = $_POST["ORDER_ID"];
            $CUST_ID = "CUST" . str_pad(@$customer_id, 3, '0', STR_PAD_LEFT); //$_POST["CUST_ID"];
            $TXN_AMOUNT = ceil($_POST['TXN_AMOUNT']); //$_POST["TXN_AMOUNT"];
            

            // New Js checkout code//
                require_once (APPPATH . "/third_party/paytm/paytmchecksum/pay.php");
                require_once (APPPATH . "/third_party/paytm/lib/config_paytm.php");
                require_once (APPPATH . "/third_party/paytm/lib/encdec_paytm.php");

                 $MID=PAYTM_MERCHANT_MID;
                 
               // $TXN_AMOUNT = $TXN_AMOUNT; //$_POST["TXN_AMOUNT"];
                $paytmParams["body"]  = array(
                            "requestType"   => "Payment",
                            "mid"           => PAYTM_MERCHANT_MID,
                            "websiteName"   => PAYTM_MERCHANT_WEBSITE,
                            "orderId"       => $ORDER_ID ,
                            "callbackUrl"   => base_url() . "customer/pay_partial_due_payment?id=" . $encoded_customer_id . "&storage_payment_type=" . $storage_payment_type . "&minus_wallet_amt=" . $minus_wallet_amt,
                            "txnAmount"     => array(
                                "value"     => $TXN_AMOUNT,
                                "currency"  => "INR",
                            ),
                            "userInfo"      => array(
                                "custId"    =>  $CUST_ID,
                            ),
                        );

                    $s_log_transaction_record = array('customer_id' => @$customer_id, 'ORDERID' => @$ORDER_ID, 'TXNAMOUNT' => @$TXN_AMOUNT, 'date' => date('Y-m-d H:i:s'),'from_payment'=>'links_partial','request'=>json_encode(@$paytmParams));
                    $this->common_model->addRecord('ss_payment_track', @$s_log_transaction_record);



                    $checksum = PaytmChecksum::generateSignature(json_encode(@$paytmParams["body"], JSON_UNESCAPED_SLASHES), PAYTM_MERCHANT_KEY);
                    $paytmParams["head"] = array(
                    "signature"    => $checksum
                    );




                   // print_r($paytmParams);
                    $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);
                    $url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction?mid=".$MID."&orderId=".$ORDER_ID;
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json")); 
                    $response = curl_exec($ch);
                    $response=json_decode($response ,true);

                    if($response['body']['resultInfo']['resultStatus']=="F"){

                        $this->session->set_flashdata('transaction_err_msg',$response['body']['resultInfo']['resultMsg']);
                        redirect('customer/transaction_error_response');
                        die;
                   }
                    $data['orderId']=$ORDER_ID;
                    $data['txnToken']=$response['body']['txnToken'];
                    $data['amount']=$TXN_AMOUNT;


                    $this->load->view('frontend/new/new_header', $data);
                    $this->load->view('customer/payment_js', $data);
                    $this->load->view('frontend/new/new_footer');

            die;

            // following files need to be included
            require_once (APPPATH . "/third_party/paytm/lib/config_paytm.php");
            require_once (APPPATH . "/third_party/paytm/lib/encdec_paytm.php");
            $checkSum = "";
            $paramList = array();
            $ORDER_ID = $_POST["ORDER_ID"];
            $CUST_ID = "CUST" . str_pad(@$customer_id, 3, '0', STR_PAD_LEFT); //$_POST["CUST_ID"];
            $INDUSTRY_TYPE_ID = 'Retail105'; //$_POST["INDUSTRY_TYPE_ID"];
            $CHANNEL_ID = 'WEB'; //$_POST["CHANNEL_ID"];
            $TXN_AMOUNT = $_POST['TXN_AMOUNT']; //$_POST["TXN_AMOUNT"];
            //echo "TXN_AMOUNT ".$TXN_AMOUNT;die();
            // Create an array having all required parameters for creating checksum.
            $paramList["MID"] = PAYTM_MERCHANT_MID;
            $paramList["ORDER_ID"] = $ORDER_ID;
            $paramList["CUST_ID"] = $CUST_ID;
            $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
            $paramList["CHANNEL_ID"] = $CHANNEL_ID;
            $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
            $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
            $paramList["CALLBACK_URL"] = base_url() . "customer/pay_partial_due_payment?id=" . $encoded_customer_id . "&storage_payment_type=" . $storage_payment_type . "&minus_wallet_amt=" . $minus_wallet_amt;
            /*
            $paramList["MSISDN"] = $MSISDN; //Mobile number of customer
            $paramList["EMAIL"] = $EMAIL; //Email ID of customer
            $paramList["VERIFIED_BY"] = "EMAIL"; //
            $paramList["IS_USER_VERIFIED"] = "YES"; //
            
            */
            //echo"<pre>";print_r($paramList);die();
            //Here checksum string will return by getChecksumFromArray() function.
            $checkSum = getChecksumFromArray($paramList, PAYTM_MERCHANT_KEY);
            echo "<html>
              <head>
              <title>Merchant Check Out Page</title>
              </head>
              <body>
                  <center><h1>Please do not refresh this page...</h1></center>
                      <form method='post' action='" . PAYTM_TXN_URL . "' name='f1'>
              <table border='1'>
               <tbody>";
            foreach ($paramList as $name => $value) {
                echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
            }
            echo "<input type='hidden' name='CHECKSUMHASH' value='" . $checkSum . "'>
               </tbody>
              </table>
              <script type='text/javascript'>
               document.f1.submit();
              </script>
              </form>
              </body>
            </html>";
        } else {
            $data = array('error' => '1');
            $this->session->set_flashdata('transaction_err_msg', 'Oops something went wrong');
            $this->load->view('customer/payment_response', $data);
        }
    }
    public function pay_partial_due_payment() {

        try {

            $tr_data = array('is_active' =>1,'response'=>json_encode(@$_POST));
            $tr_where = array('ORDERID' =>@$_POST['ORDERID'],);
            $this->common_model->updateRecord('ss_payment_track', $tr_data, $tr_where);
        } catch (Exception $e) {
        // Handle the exception
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        /*echo "<pre>";print_r($_GET);die();*/
        //echo "<pre>";print_r($_POST);die();
        header("Pragma: no-cache");
        header("Cache-Control: no-cache");
        header("Expires: 0");
        // following files need to be included
        require_once (APPPATH . "/third_party/paytm/lib/config_paytm.php");
        require_once (APPPATH . "/third_party/paytm/lib/encdec_paytm.php");
        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";
        $paramList = $_POST;
        $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
        //Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
        $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
        $customer_id = trim($_GET['id']??'');
        $due_arr = [];
        $charges_type_arr = array();
        if ($isValidChecksum == "TRUE") {
            if (@$_POST["STATUS"] == "TXN_SUCCESS") {
                /*mark status of payment request */
                $payment_req_where = "ORDERID ='" . $_POST['ORDERID'] . "' AND STATUS IS NULL";
                $payment_req_row = $this->common_model->getSingleRecord('ss_payment_request', $payment_req_where);
                $invoice_no = @$payment_req_row->invoice_no??'';
                if (!empty($payment_req_row)) {
                    $payment_req_data = array();
                    $payment_req_data['STATUS'] = 'TXN_SUCCESS';
                    $payment_req_where = array('ORDERID' => @$_POST['ORDERID'],);
                    $this->common_model->updateRecord('ss_payment_request', $payment_req_data, $payment_req_where);
                }
                /*mark status of payment request end*/
                $s_log_transaction_record = array('customer_id' => $customer_id, 'ORDERID' => @$_POST['ORDERID'], 'TXNAMOUNT' => @$_POST['TXNAMOUNT'], 'TXNDATE' => date('Y-m-d H:i:s'), 'transaction_type' => 'storage_charges','reponse'=>json_encode(@$_POST));
                $this->common_model->addRecord('ss_transaction_success_track', $s_log_transaction_record);
                /*echo "<pre>";print_r($_POST);die();*/
                /*check unique trnsaction*/
                $exist_trns_data = array();
                $bank_transaction_id = @$_POST['TXNID'];
                $tr_where = array('transaction_id' => $bank_transaction_id);
                $exist_trns_data = $this->common_model->getSingleRecord('ss_customer_transaction', $tr_where);
                /*$customer_id = base64_decode($_GET['id']);*/
                if (!empty($exist_trns_data)) {
                    $this->session->set_flashdata('transaction_err_msg', "Transaction Id already exist.Team will contact you soon");
                    redirect('customer/transaction_cancel');
                    die();
                } else {
                    $storage_payment_type = $_GET['storage_payment_type'];
                    $minus_wallet_amt = $_GET['minus_wallet_amt'];
                    $paid_amount = $_POST['TXNAMOUNT'];
                    $order_where = array('customer_id' => $customer_id, 'order_type' => 'pickup', 'order_status !=' => 'cancelled',);
                    $order_order_by = 'order_id ASC';
                    $order_data = $this->common_model->getOrderBySingleRecord('ss_order', $order_where, $order_order_by);
                    $p_where = array('customer_id' => $customer_id);
                    $p_order_by = "payment_id desc";
                    $payment_data = $this->common_model->getOrderBySingleRecord('ss_customer_payment', $p_where, $p_order_by);
                    $p_where = array('customer_id' => $customer_id, 'payment_status' => 'Unpaid');
                    $due_payment_list = $this->common_model->getAllRecord('ss_customer_payment', $p_where);
                    // echo"<pre>";print_r($due_payment_list);die();
                    /*new condition*/
                    $group_by = 'billing_date';
                    $pd_where = array('customer_id' => $customer_id, 'payment_status' => 'Unpaid');
                    $date_due_payment_list = $this->common_model->getAllGroupByRecord('ss_customer_payment', $pd_where, $group_by);
                    /*end new condition*/
                    $where = array('customer_id' => $customer_id,);
                    $customer_data = $this->common_model->getSingleRecord('ss_customer', $where);
                    $old_payment_msg = '';
                    $new_pd_where = 'customer_id ="' . $customer_id . '" AND payment_status ="Unpaid" AND charges_type IS NULL';
                    $new_due_payment_list = $this->common_model->getAllRecord('ss_customer_payment', $new_pd_where);
                    $new_pd_where = 'customer_id ="' . $customer_id . '" AND payment_status ="Unpaid" AND charges_type = "transport_charges"';
                    $transportation_due_payment_list = $this->common_model->getAllRecord('ss_customer_payment', $new_pd_where);
                   /* if (count($new_due_payment_list) >= 2) {
                        $old_form_date = '';
                        $due_arr = [];
                        foreach ($date_due_payment_list as $key => $payment) {
                            if ($key == 0) {
                                $old_form_date = date('d/m/Y', strtotime($payment->billing_date));
                            } else {
                                $due_arr[] = date('d/m/Y', strtotime($payment->billing_date));
                            }
                        }
                        if (!empty($old_form_date)) {
                            $old_payment_msg.= ' + Due payments for bills ' . implode(', ', $due_arr);
                        }
                    }*/
                    if (!empty($payment_data) && @$payment_data->charges_type != 'transport_charges') {
                        $offer_start_date = $this->validate_next_date($customer_id, $payment_data->billing_date);
                    } else {
                        $offer_start_date = $order_data->order_schedule_date;
                        if (@$customer_data->is_zoho_customer == '1') {
                            $offer_start_date = date('Y-m-d', strtotime($customer_data->next_bill_date));
                        }
                    }
                    



                    $message = '';
                    $transaction_type = 'storage_charges';
                    $substitute_tax = 18;
                    $message = 'Due payment ' . $paid_amount . ' made for ';
                    /*only due*/
                    if (!empty($date_due_payment_list)) {
                        /*$due_arr = [];
                        $charges_type_arr = array();
                        foreach ($date_due_payment_list as $key => $payment) {
                            $charges_type_arr[] = $payment->charges_type;
                            $due_arr[] = date('d/m/Y', strtotime($payment->billing_date));
                        }*/
                        if (count($date_due_payment_list) > 1) {
                            if (in_array('transport_charges', $charges_type_arr)) {
                                $message.= 'transport & monthly bills ' . implode(', ', $due_arr);
                            } else {
                                $message.= ' monthly bills ' . implode(', ', $due_arr);
                            }
                        } else {
                            if (in_array('transport_charges', $charges_type_arr)) {
                                $message.= 'transport bills ' . implode(', ', $due_arr);
                                $transaction_type = 'safestorage_transport';
                                $substitute_tax = 0;
                                if (!empty($date_due_payment_list[0]->tax > 0)) {
                                    $transaction_type = 'stacking_barcoding';
                                    $substitute_tax = 18;
                                }
                            } else {
                                $message.= 'monthly bills ' . implode(', ', $due_arr);
                            }
                        }
                    }
                    /*end */
                    $city = $customer_data->customer_local_city;
                    $invoice_split_array = [];
                    $invoice_split_array = str_split($invoice_no??'', 4);
                    $invoice_year = $invoice_split_array[0];
                    $invoice_split_array = str_split($invoice_split_array[1]??'', 3);
                    $invoice_city = $invoice_split_array[0];
                    $invoice_split_array = str_split($invoice_no??'', 7);
                    $count = count($invoice_split_array);
                    $invoice_digits = preg_replace('/[^0-9]/', '', $invoice_split_array[1]);
                    $invoice_month = preg_replace('/[^a-zA-Z]/', '', $invoice_split_array[1]);
                    if ($count > 2) {
                        $invoice_digits = $invoice_digits . $invoice_split_array[2];
                    } else {
                        $invoice_digits = $invoice_digits;
                    }
                    $invoice_where_req = array('invoice_year' => $invoice_year, 'invoice_city' => $invoice_city, 'invoice_month' => $invoice_month, 'invoice_digits >=' => $invoice_digits);
                    //
                    /*check exist invoice no*/
                    $invoice_where = array('invoice_no' => $invoice_no);
                    $is_exist_invoice = $this->common_model->check_exist_invoice($invoice_where);
                    $is_exist_invoice_request = $this->common_model->check_exist_invoice_request($invoice_where_req);
                    if (!empty($is_exist_invoice)) {
                        $exists = '1';
                        $new_invoice_no = $this->common_model->genrate_invoice_no($is_exist_invoice->invoice_no, $city, $exists);
                        $invoice_no = $new_invoice_no;
                    }
                    /*end invoice checking*/


                    $comb_where = array('customer_id' => $customer_id, 'ORDERID' => @$ORDER_ID,);
                    $combined_charges = $this->common_model->getSingleRecord('ss_pre_transaction_data', $comb_where);
                    $transaction_record = array('customer_id' => $customer_id, 'paid_amount' => @$_POST['TXNAMOUNT'], 'transaction_id' => @$_POST['TXNID'], 'transaction_order_id' => @$_POST['ORDERID'], 'transaction_created_at' => date('Y-m-d H:i:s'), 'transaction_note' => $message, 'payment_type' => "online", 'transaction_type' => $transaction_type, 'invoice_no' => $invoice_no, 'transaction_payment_date' => date('Y-m-d H:i:s'), 'substitute_tax' => 18,);
                    $cust_transaction_id = $this->common_model->addTransaction('ss_customer_transaction', $transaction_record);
                    if ($cust_transaction_id) {
                        //$this->send_invoice($cust_transaction_id);
                        /*activity log*/


                        $w_where = array('customer_id' => $customer_id,);
                        $wallet_data = $this->common_model->getSingleRecord('ss_customer_wallet', $w_where);
                   

                        if (count($due_payment_list) >= 1) {
                            $amt_paid = @$_POST['TXNAMOUNT'];
                            $update_due_payment_data = array();
                            $update_due_payment_where = array();
                            if ($due_payment_list[0]->payable_amount <= $amt_paid) {
                                foreach ($due_payment_list as $due_payment_key => $due_payments) {
                                    if ($due_payments->payable_amount > $amt_paid) { // $remaing_amt = $due_payments->payable_amount - $amt_paid;
                                        if (!empty($wallet_data)) {
                                            $new_amt = $wallet_data->wallet_amount + $amt_paid;
                                            $w_data = array('wallet_amount' => $new_amt,);
                                            $w_data['old_amount'] = $wallet_data->wallet_amount;
                                            $w_data['updated_at'] = date('Y-m-d H:i:s');

                                            $this->common_model->updateRecord('ss_customer_wallet', $w_data, $w_where);
                                        } else {
                                            $w_data = array('wallet_amount' => $amt_paid, 'customer_id' => $customer_id,);
                                            $this->common_model->addRecord('ss_customer_wallet', $w_data);
                                        }
                                        // $update_due_payment_data = array(
                                        //     'payable_amount' => $remaing_amt,
                                        //     'payment_status' => 'Unpaid'
                                        // );
                                        // $update_due_payment_where = array(
                                        //    'payment_id' => $due_payments->payment_id
                                        // );
                                        // $this->common_model->updateRecord('ss_customer_payment', $update_due_payment_data, $update_due_payment_where);
                                        
                                    } else {
                                        if ($amt_paid >= $due_payments->payable_amount) {
                                            $remaing_amt = $amt_paid - $due_payments->payable_amount;
                                            $update_due_payment_data = array('payment_status' => 'Paid');
                                            $update_due_payment_where = array('payment_id' => $due_payments->payment_id);
                                            $this->common_model->updateRecord('ss_customer_payment', $update_due_payment_data, $update_due_payment_where);
                                            $amt_paid = $remaing_amt;
                                              $charges_type_arr[] = $due_payments->charges_type;
                                            $due_arr[] = date('d/m/Y', strtotime($due_payments->billing_date));
                                        } else {
                                            $remaing_amt = $due_payments->payable_amount - $amt_paid;
                                            // $update_due_payment_data = array(
                                            //     'payable_amount' => $remaing_amt,
                                            //     'payment_status' => 'Unpaid'
                                            // );
                                            // $update_due_payment_where = array(
                                            //    'payment_id' => $due_payments->payment_id
                                            // );
                                            // $this->common_model->updateRecord('ss_customer_payment', $update_due_payment_data, $update_due_payment_where);
                                            if (!empty($wallet_data)) {
                                                $new_amt = $wallet_data->wallet_amount + $amt_paid;
                                                $w_data = array('wallet_amount' => $new_amt,);
                                               
                                                $w_data['old_amount'] = $wallet_data->wallet_amount;
                                                $w_data['updated_at'] = date('Y-m-d H:i:s');

                                                $this->common_model->updateRecord('ss_customer_wallet', $w_data, $w_where);
                                            } else {
                                                $w_data = array('wallet_amount' => $amt_paid, 'customer_id' => $customer_id,);
                                                $this->common_model->addRecord('ss_customer_wallet', $w_data);
                                            }
                                        }
                                    }
                                }
                                // die();
                                
                            } else {
                                $remaing_amt = $due_payment_list[0]->payable_amount - $amt_paid;
                                //             $update_due_payment_data = array(
                                //                'payable_amount' => $remaing_amt,
                                //                 'payment_status' => 'Unpaid'
                                //             );
                                //             $update_due_payment_where = array(
                                //                'payment_id' => $due_payment_list[0]->payment_id
                                //             );
                                //             $this->common_model->updateRecord('ss_customer_payment', $update_due_payment_data, $update_due_payment_where);
                                if (!empty($wallet_data)) {
                                    $new_amt = $wallet_data->wallet_amount + $amt_paid;
                                    $w_data = array('wallet_amount' => $new_amt,);
                                    $w_data['old_amount'] = $wallet_data->wallet_amount;
                                    $w_data['updated_at'] = date('Y-m-d H:i:s');

                                    $this->common_model->updateRecord('ss_customer_wallet', $w_data, $w_where);
                                } else {
                                    $w_data = array('wallet_amount' => $amt_paid, 'customer_id' => $customer_id,);
                                    $this->common_model->addRecord('ss_customer_wallet', $w_data);
                                }
                            }
                        }


                        $message = 'Wallet credited with ' . $paid_amount;
                        $insert = array('message' => $message, 'customer_id' => $customer_id, 'created_at' => date('Y-m-d H:i:s'), 'log_type' => 'receivable_bill',);
                        $this->log_model->InsertLog($insert);
                        /*end wallet entry*/
                        /*pay billing staart */
                        // $this->pay_billing_data($customer_id, $storage_payment_type, $paid_amount);
                        /*pay billing end */
                        $this->session->set_userdata('tr_customer_id', $customer_id);
                        $this->session->set_flashdata('transaction_success_msg', 'Your transaction has been completed sucessfully.');
                        redirect('customer/transaction_success_response');
                    } else {
                        $msg = "Duplicate txn orderID found,so system ignored retrieval transaction with details";
                        $msg.= "TxnOrderId " . @$_POST['ORDERID'];
                        $msg.= " Amount " . @$_POST['TXNAMOUNT'];
                        $insert = array('user_id' => $this->user_id, 'message' => $msg, 'customer_id' => @$customer_id, 'created_at' => date('Y-m-d H:i:s'), 'log_type' => 'duplicate_transaction');
                        // $this->log_model->InsertLog($insert);
                        $msg = "Oop's something went wrong our team will get back to you.";
                        $this->session->set_userdata('transaction_err_msg', $msg);
                        redirect('customer/transaction_cancel');
                    }
                } /*end transaction not empty*/
            } else {
                $log_transaction_record = array('customer_id' => $customer_id, 'ORDERID' => @$_POST['ORDERID'], 'TXNDATE' => date('Y-m-d H:i:s'), 'STATUS' => @$_POST['STATUS'], 'RESPCODE' => @$_POST['RESPCODE'], 'RESPMSG' => @$_POST['RESPMSG'], 'TXNID' => @$_POST['TXNID'], 'transaction_type' => 'storage_charges', 'storage_payment_type' => $_GET['storage_payment_type'],);
                $this->common_model->addRecord('ss_failed_transaction_log', $log_transaction_record);
                $this->session->set_flashdata('transaction_err_msg', $_POST["RESPMSG"]);
                redirect('customer/transaction_cancel');
            }
        } else {
            $log_transaction_record = array('customer_id' => $customer_id, 'ORDERID' => @$_POST['ORDERID'], 'TXNDATE' => date('Y-m-d H:i:s'), 'STATUS' => @$_POST['STATUS'], 'RESPCODE' => @$_POST['RESPCODE'], 'RESPMSG' => @$_POST['RESPMSG'], 'TXNID' => @$_POST['TXNID'], 'transaction_type' => 'storage_charges', 'storage_payment_type' => $_GET['storage_payment_type'],);
            $this->common_model->addRecord('ss_failed_transaction_log', $log_transaction_record);
        }
    }
    public function pay_due_charges1() {
        /*payment gateway*/
        if (!empty($_POST['customer_id'])) {
            $customer_id = trim($_POST['customer_id']);
            $where = array('customer_id' => $customer_id);
            $due_data = $this->customer_model->get_customer_due($where);
            header("Pragma: no-cache");
            header("Cache-Control: no-cache");
            header("Expires: 0");
            // following files need to be included
            require_once (APPPATH . "/third_party/paytm/lib/config_paytm.php");
            require_once (APPPATH . "/third_party/paytm/lib/encdec_paytm.php");
            $checkSum = "";
            $paramList = array();
            $ORDER_ID = "ORDS" . date('mdYHis').$customer_id;//$_POST["ORDER_ID"];
            $CUST_ID = "CUST" . str_pad(@$customer_id, 3, '0', STR_PAD_LEFT); //$_POST["CUST_ID"];
            $INDUSTRY_TYPE_ID = 'Retail105'; //$_POST["INDUSTRY_TYPE_ID"];
            $CHANNEL_ID = 'WEB'; //$_POST["CHANNEL_ID"];
            $TXN_AMOUNT = @$due_data->total_amount; //$_POST["TXN_AMOUNT"];
            // Create an array having all required parameters for creating checksum.
            $paramList["MID"] = PAYTM_MERCHANT_MID;
            $paramList["ORDER_ID"] = $ORDER_ID;
            $paramList["CUST_ID"] = $CUST_ID;
            $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
            $paramList["CHANNEL_ID"] = $CHANNEL_ID;
            $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
            $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
            $paramList["CALLBACK_URL"] = base_url() . "customer/paytm_pay_due_response?customer_id=" . $customer_id;
            $checkSum = getChecksumFromArray($paramList, PAYTM_MERCHANT_KEY);
            echo "<html>
                    <head>
                    <title>Merchant Check Out Page</title>
                    </head>
                    <body>
                        <center><h1>Please do not refresh this page...</h1></center>
                            <form method='post' action='" . PAYTM_TXN_URL . "' name='f1'>
                    <table border='1'>
                     <tbody>";
            foreach ($paramList as $name => $value) {
                echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
            }
            echo "<input type='hidden' name='CHECKSUMHASH' value='" . $checkSum . "'>

                     </tbody>
                    </table>
                    <script type='text/javascript'>
                     document.f1.submit();
                    </script>
                    </form>
                    </body>
                </html>";
        }
    }
    public function pay_due_charges_old() {
        if (!empty($_POST['customer_id'])) {
            $customer_id = trim($_POST['customer_id']??'');
            $where = array('customer_id' => $customer_id,);
            $customer_data = $this->common_model->getSingleRecord('ss_customer', $where);
            $where = array('customer_id' => $customer_id,);
            $customer_wallet = $this->common_model->getSingleRecord('ss_customer_wallet', $where);
            /*payment request*/
            // $payment_req_data = array('customer_id' => $customer_id, 'ORDERID' => $_POST['ORDER_ID'], 'TXNAMOUNT' => $_POST['TXN_AMOUNT'], 'payment_type' => $_POST['storage_payment_type'], 'created_at' => date('Y-m-d H:i:s'),);
            // $this->common_model->addRecord('ss_payment_request', $payment_req_data);
            $city = $customer_data->customer_local_city;
            $where = array('customer_local_city' => $city);
            $invoice_no = $this->common_model->get_invoice_no($where);
            $invoice_split_array = [];
            $invoice_split_array = str_split($invoice_no, 4);
            $invoice_year = $invoice_split_array[0];
            $invoice_split_array = str_split($invoice_split_array[1], 3);
            $invoice_city = $invoice_split_array[0];
            $invoice_split_array = str_split($invoice_no, 7);
            $count = count($invoice_split_array);
            $invoice_digits = preg_replace('/[^0-9]/', '', $invoice_split_array[1]);
            $invoice_month = preg_replace('/[^a-zA-Z]/', '', $invoice_split_array[1]);
            if ($count > 2) {
                $invoice_digits = $invoice_digits . $invoice_split_array[2];
            } else {
                $invoice_digits = $invoice_digits;
            }
            $invoice_where_req = array('invoice_year' => $invoice_year, 'invoice_city' => $invoice_city, 'invoice_month' => $invoice_month, 'invoice_digits >=' => $invoice_digits);
            //
            /*check exist invoice no*/
            $invoice_where = array('invoice_no' => $invoice_no);
            $is_exist_invoice = $this->common_model->check_exist_invoice($invoice_where);
            $is_exist_invoice_request = $this->common_model->check_exist_invoice_request($invoice_where_req);
            //echo "<pre>";print_r($is_exist_invoice_request);die();
            if (!empty($is_exist_invoice)) {
                $exists = '1';
                $new_invoice_no = $this->common_model->genrate_invoice_no($is_exist_invoice->invoice_no, $city, $exists);
                $invoice_no = $new_invoice_no;
            }
            if (!empty($is_exist_invoice_request)) {
                $exists = '1';
                $current_invoice_no = $is_exist_invoice_request[count($is_exist_invoice_request) - 1]->invoice_no;
                $new_invoice_no = $this->common_model->genrate_invoice_no_request($current_invoice_no, $city, $exists);
                $invoice_no = $new_invoice_no;
            }
            $invoice_split_array = [];
            $invoice_split_array = str_split($invoice_no, 4);
            $invoice_year = $invoice_split_array[0];
            $invoice_split_array = str_split($invoice_split_array[1], 3);
            $invoice_city = $invoice_split_array[0];
            $invoice_split_array = str_split($invoice_no, 7);
            $count = count($invoice_split_array);
            $invoice_digits = preg_replace('/[^0-9]/', '', $invoice_split_array[1]);
            $invoice_month = preg_replace('/[^a-zA-Z]/', '', $invoice_split_array[1]);
            if ($count > 2) {
                $invoice_digits = $invoice_digits . $invoice_split_array[2];
            } else {
                $invoice_digits = $invoice_digits;
            }
            $payment_req_data = array('customer_id' => $customer_id, 'ORDERID' => $_POST['ORDER_ID'], 'TXNAMOUNT' => $_POST['TXN_AMOUNT'], 'payment_type' => "only_due", 'created_at' => date('Y-m-d H:i:s'), 'invoice_no' => $invoice_no, 'invoice_year' => $invoice_year, 'invoice_city' => $invoice_city, 'invoice_month' => $invoice_month, 'invoice_digits' => $invoice_digits);
            $this->common_model->addRecord('ss_payment_request', $payment_req_data);
            $payment_req_data_inv = array('invoice_no' => $invoice_no, 'invoice_year' => $invoice_year, 'invoice_city' => $invoice_city, 'invoice_month' => $invoice_month, 'invoice_digits' => $invoice_digits);
            $this->common_model->addRecord('ss_invoices_tbl', $payment_req_data_inv);
            /*end payment request*/
            /*check is there combined charges or not*/
            $p_where = array('customer_id' => $customer_id, 'charges_type' => 'transport_charges', 'payment_status' => 'Unpaid',);
            $transport_row = $this->common_model->getSingleRecord('ss_customer_payment', $p_where);
            if (empty($transport_row)) {
                $p_where = array('customer_id' => $customer_id, 'tax' => '0', 'payment_status' => 'Unpaid',);
                $transport_row = $this->common_model->getSingleRecord('ss_customer_payment', $p_where);
                //
                
            }
            //echo "<pre>";print_r($transport_row);die();
            /*check due is more than 1 then its combined*/
            $d_where = array('customer_id' => $customer_id, 'payment_status' => 'Unpaid',);
            $due_payment_count = $this->common_model->getRowCount('ss_customer_payment', $d_where);
            //echo "<pre>";print_r($due_payment_count);die();
            /*maintain refernce for transport & storage charges if they are combined*/
            if (!empty($transport_row) && $due_payment_count > 1) {
                $total_storage_amt = ($_POST['TXN_AMOUNT'] - $transport_row->payable_amount);
                $transport_type = 'safestorage_transport';
                if ($transport_row->tax > 0) {
                    $transport_type = 'warehouse_arrival';
                }
                $pre_transaction_data = array('customer_id' => $customer_id, 'ORDERID' => $_POST['ORDER_ID'], 'transport_total_amt' => $transport_row->payable_amount, 'transport_note' => "Transport Due amount", 'total_storage_amt' => $total_storage_amt, 'storage_note' => "Storage charges", 'created_at' => date('Y-m-d H:i:s'), 'transport_type' => $transport_type,);
                $this->common_model->addRecord('ss_pre_transaction_data', $pre_transaction_data);
            }
            /*end checking combined charges*/
            $encoded_customer_id = $customer_id;
            $storage_payment_type = "only_due";
            $minus_wallet_amt = @$customer_wallet->wallet_amount;
            header("Pragma: no-cache");
            header("Cache-Control: no-cache");
            header("Expires: 0");
            // following files need to be included
            require_once (APPPATH . "/third_party/paytm/lib/config_paytm.php");
            require_once (APPPATH . "/third_party/paytm/lib/encdec_paytm.php");
            $checkSum = "";
            $paramList = array();
            $ORDER_ID = $_POST["ORDER_ID"];
            $CUST_ID = "CUST" . str_pad(@$customer_id, 3, '0', STR_PAD_LEFT); //$_POST["CUST_ID"];
            $INDUSTRY_TYPE_ID = 'Retail105'; //$_POST["INDUSTRY_TYPE_ID"];
            $CHANNEL_ID = 'WEB'; //$_POST["CHANNEL_ID"];
            $TXN_AMOUNT = $_POST['TXN_AMOUNT']; //$_POST["TXN_AMOUNT"];
            //echo "TXN_AMOUNT ".$TXN_AMOUNT;die();
            // Create an array having all required parameters for creating checksum.
            $paramList["MID"] = PAYTM_MERCHANT_MID;
            $paramList["ORDER_ID"] = $ORDER_ID;
            $paramList["CUST_ID"] = $CUST_ID;
            $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
            $paramList["CHANNEL_ID"] = $CHANNEL_ID;
            $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
            $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
            $paramList["CALLBACK_URL"] = base_url() . "customer/paytm_pay_due_response?id=" . $encoded_customer_id . "&storage_payment_type=" . $storage_payment_type . "&minus_wallet_amt=" . $minus_wallet_amt;
            /*
            $paramList["MSISDN"] = $MSISDN; //Mobile number of customer
            $paramList["EMAIL"] = $EMAIL; //Email ID of customer
            $paramList["VERIFIED_BY"] = "EMAIL"; //
            $paramList["IS_USER_VERIFIED"] = "YES"; //
            
            */
            //Here checksum string will return by getChecksumFromArray() function.
            $checkSum = getChecksumFromArray($paramList, PAYTM_MERCHANT_KEY);
            echo "<html>
              <head>
              <title>Merchant Check Out Page</title>
              </head>
              <body>
                  <center><h1>Please do not refresh this page...</h1></center>
                      <form method='post' action='" . PAYTM_TXN_URL . "' name='f1'>
              <table border='1'>
               <tbody>";
            foreach ($paramList as $name => $value) {
                echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
            }
            echo "<input type='hidden' name='CHECKSUMHASH' value='" . $checkSum . "'>
               </tbody>
              </table>
              <script type='text/javascript'>
               document.f1.submit();
              </script>
              </form>
              </body>
            </html>";
        } else {
            $data = array('error' => '1');
            $this->session->set_flashdata('transaction_err_msg', 'Oops something went wrong');
            $this->load->view('customer/payment_response', $data);
        }
    }

   


   


    public function pay_due_payment() { 
        /*echo "<pre>";print_r($_GET);die();*/
        //echo "<pre>";print_r($_POST);die();

        try {

            $tr_data = array('is_active' =>1,'response'=>json_encode(@$_POST));
            $tr_where = array('ORDERID' =>@$_POST['ORDERID'],);
            $this->common_model->updateRecord('ss_payment_track', $tr_data, $tr_where);
        } catch (Exception $e) {
        // Handle the exception
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        }


        header("Pragma: no-cache");
        header("Cache-Control: no-cache");
        header("Expires: 0");
        // following files need to be included
        require_once (APPPATH . "/third_party/paytm/lib/config_paytm.php");
        require_once (APPPATH . "/third_party/paytm/lib/encdec_paytm.php");
        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";
        $paramList = $_POST;
        $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
        //Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
        $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
        $customer_id = trim($_GET['id']);
        if ($isValidChecksum == "TRUE") {
            if (@$_POST["STATUS"] == "TXN_SUCCESS") {
                /*mark status of payment request */
                $payment_req_where = "ORDERID ='" . $_POST['ORDERID'] . "' AND STATUS IS NULL";
                $payment_req_row = $this->common_model->getSingleRecord('ss_payment_request', $payment_req_where);
                 $invoice_no = $payment_req_row->invoice_no;
                if (!empty($payment_req_row)) {
                    $payment_req_data = array();
                    $payment_req_data['STATUS'] = 'TXN_SUCCESS';
                    $payment_req_where = array('ORDERID' => @$_POST['ORDERID'],);
                    $this->common_model->updateRecord('ss_payment_request', $payment_req_data, $payment_req_where);
                }
                /*mark status of payment request end*/
                $s_log_transaction_record = array('customer_id' => $customer_id, 'ORDERID' => @$_POST['ORDERID'], 'TXNAMOUNT' => @$_POST['TXNAMOUNT'], 'TXNDATE' => date('Y-m-d H:i:s'), 'transaction_type' => 'storage_charges','from_payment'=>'links','reponse'=>json_encode(@$_POST));
                $this->common_model->addRecord('ss_transaction_success_track', $s_log_transaction_record);
                /*echo "<pre>";print_r($_POST);die();*/
                /*check unique trnsaction*/
                $exist_trns_data = array();
                $bank_transaction_id = @$_POST['TXNID'];
                $tr_where = array('transaction_id' => $bank_transaction_id);
                $exist_trns_data = $this->common_model->getSingleRecord('ss_customer_transaction', $tr_where);
                /*$customer_id = base64_decode($_GET['id']);*/
                if (!empty($exist_trns_data)) {
                    $this->session->set_flashdata('transaction_err_msg', "Transaction Id already exist.Team will contact you soon");
                    redirect('customer/transaction_cancel');
                    die();
                } else {

                    $storage_payment_type = $_GET['storage_payment_type'];
                    $minus_wallet_amt = $_GET['minus_wallet_amt'];
                    $paid_amount = $_POST['TXNAMOUNT'];
                    $order_where = array('customer_id' => $customer_id, 'order_type' => 'pickup', 'order_status !=' => 'cancelled',);
                    $order_order_by = 'order_id ASC';
                    $order_data = $this->common_model->getOrderBySingleRecord('ss_order', $order_where, $order_order_by);
                    $p_where = array('customer_id' => $customer_id);
                    $p_order_by = "payment_id desc";
                    $payment_data = $this->common_model->getOrderBySingleRecord('ss_customer_payment', $p_where, $p_order_by);
                    $p_where = array('customer_id' => $customer_id, 'payment_status' => 'Unpaid');
                    $due_payment_list = $this->common_model->getAllRecord('ss_customer_payment', $p_where);
                    /*new condition*/
                    $group_by = 'billing_date';
                    $pd_where = array('customer_id' => $customer_id, 'payment_status' => 'Unpaid');
                    $date_due_payment_list = $this->common_model->getAllGroupByRecord('ss_customer_payment', $pd_where, $group_by);
                    /*end new condition*/
                    $where = array('customer_id' => $customer_id,);
                    $customer_data = $this->common_model->getSingleRecord('ss_customer', $where);
                    $old_payment_msg = '';
                    $new_pd_where = 'customer_id ="' . $customer_id . '" AND payment_status ="Unpaid" AND charges_type IS NULL';
                    $new_due_payment_list = $this->common_model->getAllRecord('ss_customer_payment', $new_pd_where);
                    $new_pd_where = 'customer_id ="' . $customer_id . '" AND payment_status ="Unpaid" AND charges_type = "transport_charges"';
                    $transportation_due_payment_list = $this->common_model->getAllRecord('ss_customer_payment', $new_pd_where);
                    if (count($new_due_payment_list) >= 2) {
                        $old_form_date = '';
                        $due_arr = [];
                        foreach ($date_due_payment_list as $key => $payment) {
                            if ($key == 0) {
                                $old_form_date = date('d/m/Y', strtotime($payment->billing_date));
                            } else {
                                $due_arr[] = date('d/m/Y', strtotime($payment->billing_date));
                            }
                        }
                        if (!empty($old_form_date)) {
                            $old_payment_msg.= ' + Due payments for bills ' . implode(', ', $due_arr);
                        }
                    }
                    if (!empty($payment_data) && @$payment_data->charges_type != 'transport_charges') {
                        $offer_start_date = $this->validate_next_date($customer_id, $payment_data->billing_date);
                    } else {
                        $offer_start_date = $order_data->order_schedule_date;

                        if(@$customer_data->is_zoho_customer =='1'){

                            $offer_start_date = date('Y-m-d',strtotime($customer_data->next_bill_date));
                        }
                    }
                    $message = '';
                    $transaction_type = 'storage_charges';
                    $substitute_tax = 18;
                    if ($storage_payment_type == 'six_month_payable') {
                        /*if there is only one due payment*/
                        if (count($new_due_payment_list) == 1) {
                            /*$offer_start_date= date('Y-m-d',strtotime($payment_data->billing_date));*/
                            if (!empty($payment_data)) {
                                if ($payment_data->payment_status == 'Unpaid' && $payment_data->charges_type == 'transport_charges') {

                                    $offer_start_date = $order_data->order_schedule_date;

                                    if(@$customer_data->is_zoho_customer =='1'){

                                        $offer_start_date = date('Y-m-d',strtotime($customer_data->next_bill_date));
                                    }

                                } else if ($payment_data->payment_status == 'Unpaid' && $payment_data->charges_type != 'transport_charges') {
                                    $offer_start_date = date('Y-m-d', strtotime($payment_data->billing_date));
                                } else {
                                    $current_date_time = strtotime($payment_data->billing_date);
                                    $offer_start_date = date("Y-m-d", strtotime("+1 month", $current_date_time));
                                }
                            } else {
                                $offer_start_date = $order_data->order_schedule_date;
                                if(@$customer_data->is_zoho_customer =='1'){

                                    $offer_start_date=date('Y-m-d',strtotime($customer_data->next_bill_date));
                                }
                            }
                        }
                        /*end only one unpaid bill*/
                        $offer_msg_start = $offer_start_date;
                        $msg_start = $this->validate_next_6_12_month($customer_id, $offer_start_date, '6');
                        $offer_msg_end = $this->minus_one_day($msg_start);
                        /*$end_date = $this->validate_next_6_12_month($customer_id,$offer_start_date,'6');
                         $offer_end_date = $this->minus_one_day($end_date);*/
                        $message = 'Payment ' . $paid_amount . ' made for 6 months('.$customer_data->six_month_discount.'% discount) storage charges from ' . date('d/m/Y', strtotime($offer_msg_start)) . ' to ' . date('d/m/Y', strtotime($offer_msg_end)) . $old_payment_msg;
                    } else if ($storage_payment_type == 'yearly_payable_amount') {
                        if (count($new_due_payment_list) == 1) {
                            //$offer_start_date=date('Y-m-d',strtotime($payment_data->billing_date));
                            if (!empty($payment_data)) {
                                if ($payment_data->payment_status == 'Unpaid' && $payment_data->charges_type == 'transport_charges') {
                                    $offer_start_date = $order_data->order_schedule_date;
                                } else if ($payment_data->payment_status == 'Unpaid' && $payment_data->charges_type != 'transport_charges') {
                                    $offer_start_date = date('Y-m-d', strtotime($payment_data->billing_date));
                                } else {
                                    $current_date_time = strtotime($payment_data->billing_date);
                                    $offer_start_date = date("Y-m-d", strtotime("+1 month", $current_date_time));
                                }
                            } else {
                                $offer_start_date = $order_data->order_schedule_date;
                            }
                        }
                        $offer_msg_start = $offer_start_date;
                        $msg_start = $this->validate_next_6_12_month($customer_id, $offer_start_date, '12');
                        $offer_msg_end = $this->minus_one_day($msg_start);
                        $message = 'Payment ' . $paid_amount . ' made for 12 months('.$customer_data->yearly_discount.'% discount) storage charges from ' . date('d/m/Y', strtotime($offer_msg_start)) . ' to ' . date('d/m/Y', strtotime($offer_msg_end)) . $old_payment_msg;
                    } else if ($storage_payment_type == 'monthly_payable') {
                        if (!empty($payment_data)) {
                            if ($payment_data->payment_status == 'Unpaid' && $payment_data->charges_type == 'transport_charges') {
                                $offer_start_date = $order_data->order_schedule_date;
                            } else if ($payment_data->payment_status == 'Unpaid' && $payment_data->charges_type != 'transport_charges') {
                                $offer_start_date = date('Y-m-d', strtotime($payment_data->billing_date));
                            } else {
                                $current_date_time = strtotime($payment_data->billing_date);
                                $offer_start_date = date("Y-m-d", strtotime("+1 month", $current_date_time));
                            }
                        } else {
                            $offer_start_date = $order_data->order_schedule_date;
                        }
                        $end_date = $this->validate_next_date($customer_id, $offer_start_date);
                        $offer_end_date = $this->minus_one_day($end_date);
                        $message = 'Payment ' . $paid_amount . ' made for monthly storage charges from ' . date('d/m/Y', strtotime($offer_start_date)) . ' to ' . date('d/m/Y', strtotime($offer_end_date)) . $old_payment_msg;;
                    } else {
                        $message = 'Due payment ' . $paid_amount . ' made for ';
                        /*only due*/
                        if (!empty($date_due_payment_list)) {
                            $due_arr = [];
                            $charges_type_arr = array();
                            foreach ($date_due_payment_list as $key => $payment) {
                                $charges_type_arr[] = $payment->charges_type;
                                $due_arr[] = date('d/m/Y', strtotime($payment->billing_date));
                            }
                            if (count($date_due_payment_list) > 1) {
                                if (in_array('transport_charges', $charges_type_arr)) {
                                    $message.= 'transport & monthly bills ' . implode(', ', $due_arr);
                                } else {
                                    $message.= ' monthly bills ' . implode(', ', $due_arr);
                                }
                            } else {
                                if (in_array('transport_charges', $charges_type_arr)) {
                                    $message.= 'transport bills ' . implode(', ', $due_arr);
                                    $transaction_type = 'safestorage_transport';
                                    $substitute_tax = 0;
                                    if (!empty($date_due_payment_list[0]->tax > 0)) {
                                        $transaction_type = 'stacking_barcoding';
                                        $substitute_tax = 18;
                                    }
                                } else {
                                    $message.= 'monthly bills ' . implode(', ', $due_arr);
                                }
                            }
                        }
                    }
                    /*if there is no due payment*/
                    if ($storage_payment_type != 'six_month_payable' && $storage_payment_type != 'yearly_payable_amount') {
                        if (count($due_payment_list) < 1) {
                            $message = "Wallet has been credited with " . @$_POST['TXNAMOUNT'] . " for storage charges.";
                        }
                    }
                    /*end */
                   $city = $customer_data->customer_local_city;
                    
                    // 
                            /*check exist invoice no*/
                    $invoice_where = array('invoice_no' => $invoice_no);
                     $is_exist_invoice = $this->common_model->check_exist_invoice($invoice_where);
                 
                    
                    if (!empty($is_exist_invoice)) {
                        $exists = '1';
                    $new_invoice_no = $this->common_model->genrate_invoice_no($is_exist_invoice->invoice_no, $city, $exists);
                    $invoice_no = $new_invoice_no;
                          }
                   
                    /*end invoice checking*/
                    $comb_where = array('customer_id' => $customer_id, 'ORDERID' => @$ORDER_ID,);
                    $combined_charges = $this->common_model->getSingleRecord('ss_pre_transaction_data', $comb_where);
                         if (!empty($combined_charges) || (!empty($transportation_due_payment_list) && !empty($new_due_payment_list)))
            {

                 // echo "<pre> 33";print_r($combined_charges);die();


                 
                 $transaction_record = array('customer_id' => $customer_id, 'paid_amount' =>$transportation_due_payment_list[0]->payable_amount, 'transaction_id' => @$_POST['TXNID'].'T', 'transaction_order_id' => @$_POST['ORDERID'].'T', 'transaction_created_at' => date('Y-m-d H:i:s'), 'transaction_note' => $transportation_due_payment_list[0]->offer_note, 'payment_type' => "online", 'transaction_type' => 'safestorage_transport', 'invoice_no' => $invoice_no.'T', 'transaction_payment_date' => date('Y-m-d H:i:s'), 'substitute_tax' => 0,);
                   

                 $cust_transaction_id=$this->common_model->addTransaction('ss_customer_transaction', $transaction_record);

                 if ($storage_payment_type == 'six_month_payable' || $storage_payment_type == 'yearly_payable_amount') {
                        $storage_amt = $paid_amount - $transportation_due_payment_list[0]->payable_amount;
                      $tstorage_record = array('customer_id' => $customer_id, 'paid_amount' =>$storage_amt, 'transaction_id' => @$_POST['TXNID'], 'transaction_order_id' => @$_POST['ORDERID'], 'transaction_created_at' => date('Y-m-d H:i:s'), 'transaction_note' => $message, 'payment_type' => "online", 'transaction_type' => $transaction_type, 'invoice_no' => $invoice_no.'S', 'transaction_payment_date' => date('Y-m-d H:i:s'), 'substitute_tax' => 18);
  
                 }else{
                     $storage_amt = $paid_amount - $transportation_due_payment_list[0]->payable_amount;
                    $tstorage_record = array('customer_id' => $customer_id, 'paid_amount' =>$storage_amt, 'transaction_id' => @$_POST['TXNID'], 'transaction_order_id' => @$_POST['ORDERID'], 'transaction_created_at' => date('Y-m-d H:i:s'), 'transaction_note' => $message, 'payment_type' => "online", 'transaction_type' => $transaction_type, 'invoice_no' => $invoice_no.'S', 'transaction_payment_date' => date('Y-m-d H:i:s'), 'substitute_tax' => 18);

                 }
 
                 
                     $cust_transaction_id=$this->common_model->addTransaction('ss_customer_transaction', $tstorage_record);
                 
                


                 

            }else
            {

                 

                    
                        $transaction_record = array('customer_id' => $customer_id, 'paid_amount' => @$_POST['TXNAMOUNT'], 'transaction_id' => @$_POST['TXNID'], ' transaction_order_id' => @$_POST['ORDERID'], 'transaction_created_at' =>date('Y-m-d H:i:s'), 'transaction_note' => $message, 'payment_type' => "online", 'transaction_type' => $transaction_type, 'invoice_no' => $invoice_no, 'transaction_payment_date' => date('Y-m-d H:i:s'), 'substitute_tax' => 18,);
                   

                        $cust_transaction_id=$this->common_model->addTransaction('ss_customer_transaction', $transaction_record);

 
                   

                   
            }



            $this->check_referral_amount(@$customer_id); 



            


                    if($cust_transaction_id){
                        
                        $paid_amount  = $_POST['TXNAMOUNT'];
                         $storage_payment_type = $_GET['storage_payment_type'];
                         $customer_id = trim($_GET['id']);
                        /*start wallet entry*/
                        $where = array('customer_id' => $customer_id,);
                        $walletData = $this->common_model->getSingleRecord('ss_customer_wallet', $where);
                        $wallet_amount = 0;
                        if (!empty($walletData)) {
                            /*if wallet is minus in fronttend then need to sync proper amount*/
                            if ($minus_wallet_amt > 0.00) {
                                /*sync amount */
                                $wallet_amount = ($paid_amount + $minus_wallet_amt);
                                $data = array();
                                $data['wallet_amount'] = $wallet_amount;

                                $data['updated_at'] = date('Y-m-d H:i:s');
                                $this->common_model->updateRecord('ss_customer_wallet', $data, $where);
                            } else {
                                $data = array();
                                $wallet_amount = ($walletData->wallet_amount + $paid_amount);
                                $data['wallet_amount'] = $wallet_amount;
                                $data['updated_at'] = date('Y-m-d H:i:s');
                                $data['old_amount'] = $walletData->wallet_amount;

                                $this->common_model->updateRecord('ss_customer_wallet', $data, $where);
                            }
                        } else {
                            $data = array();
                            $data['wallet_amount'] = $paid_amount;
                            $data['customer_id'] = $customer_id;
                            $this->common_model->addRecord('ss_customer_wallet', $data);
                        }
                        /*activity log*/
                        $message = 'Wallet credited with ' . $paid_amount;
                        $insert = array('message' => $message, 'customer_id' => $customer_id, 'created_at' => date('Y-m-d H:i:s'), 'log_type' => 'receivable_bill',);
                        $this->log_model->InsertLog($insert);
                        /*end wallet entry*/
                        /*pay billing staart */
                        $this->pay_billing_data($customer_id, $storage_payment_type, $paid_amount);
                        /*pay billing end */
                         //$this->send_invoice($cust_transaction_id);
                        $invoice_url = base_url().'back/auth/send_invoice/'.$cust_transaction_id;
                        
                        $curl = curl_init($invoice_url);
   
                            /* Data */
                            $data = [
                                'cust_transaction_id'=>$cust_transaction_id, 
                               
                            ];
                       
                            /* Set JSON data to POST */
                            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                                
                            /* Define content type */
                            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                                'Content-Type:application/json',
                                
                            ));
                                
                            /* Return json */
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                
                            /* make request */
                            curl_exec($curl);
                                 
                            /* close curl */
                            curl_close($curl);

                        $this->session->set_userdata('tr_customer_id', $customer_id);
                        $this->session->set_flashdata('transaction_success_msg', 'Your transaction has been completed sucessfully.');
                    redirect('customer/transaction_success_response');    
                    }else{

                        $msg ="Duplicate txn orderID found,so system ignored retrieval transaction with details";
                        $msg .="TxnOrderId ".@$_POST['ORDERID'];
                        $msg .=" Amount ".@$_POST['TXNAMOUNT'];

                        $insert = array(
                            'user_id' => $this->user_id, 
                            'message' => $msg, 
                            'customer_id' => @$customer_id, 
                            'created_at' => date('Y-m-d H:i:s'), 
                            'log_type' => 'duplicate_transaction'
                        );
                       // $this->log_model->InsertLog($insert);

                        $msg ="Oop's something went wrong our team will get back to you.";    
                        $this->session->set_userdata('transaction_err_msg',$msg);
                      redirect('customer/transaction_cancel');
                    }

                } /*end transaction not empty*/
                
            } else {
                $log_transaction_record = array('customer_id' => $customer_id, 'ORDERID' => @$_POST['ORDERID'], 'TXNDATE' => date('Y-m-d H:i:s'), 'STATUS' => @$_POST['STATUS'], 'RESPCODE' => @$_POST['RESPCODE'], 'RESPMSG' => @$_POST['RESPMSG'], 'TXNID' => @$_POST['TXNID'], 'transaction_type' => 'storage_charges', 'storage_payment_type' => $_GET['storage_payment_type'],);
                $this->common_model->addRecord('ss_failed_transaction_log', $log_transaction_record);
                $this->session->set_flashdata('transaction_err_msg', $_POST["RESPMSG"]);
              redirect('customer/transaction_cancel');
            }
        } else {
            $log_transaction_record = array('customer_id' => $customer_id, 'ORDERID' => @$_POST['ORDERID'], 'TXNDATE' => date('Y-m-d H:i:s'), 'STATUS' => @$_POST['STATUS'], 'RESPCODE' => @$_POST['RESPCODE'], 'RESPMSG' => @$_POST['RESPMSG'], 'TXNID' => @$_POST['TXNID'], 'transaction_type' => 'storage_charges', 'storage_payment_type' => $_GET['storage_payment_type'],);
            $this->common_model->addRecord('ss_failed_transaction_log', $log_transaction_record);
        }
    }



    public function check_referral_amount($customer_id){
        /*for check referral code exist and add amount to referee customer*/

                if(!empty($customer_data->referee_id)){

                    $r_where = array(
                        'referral_id' => $customer_data->referee_id,
                    );
                    $referee_customer_data=$this->common_model->getSingleRecord('ss_customer',$r_where);


                    $r_where_check = array(
                        'referee_id' => $customer_data->referee_id,
                    );

                    $tbl_offer ='ss_customer';
                    $total_count=$this->common_model->getRowCount($tbl_offer,$r_where_check);
                    $r_where_new='';
                    $movesetting_amount=$this->common_model->getSingleRecord('movesetting',$r_where_new);
                    $amount_need_to_credit=$movesetting_amount->refer_amount;
                    $max_refer=$movesetting_amount->max_refer;
                    if(!empty($referee_customer_data)){

                        if(!empty($customer_data->is_added_referral_amt) && $total_count <=  $max_refer){

                        }else{

                            /*echo "<pre>";print_r($referee_customer_data);die();*/

                            $w_where = array(
                                'customer_id' => $_POST['customer_id'],
                            );
                            $wallet_data =$this->common_model->getSingleRecord('ss_customer_wallet',$w_where);

                            if(!empty($wallet_data)){

                                $new_amt = $wallet_data->wallet_amount + $amount_need_to_credit;
                                $w_data = array(
                                    'wallet_amount' =>$new_amt,
                                );

                                $w_data['old_amount'] = $wallet_data->wallet_amount;
                                $w_data['updated_at'] = date('Y-m-d H:i:s');


                                $this->common_model->updateRecord('ss_customer_wallet',$w_data,$w_where);

                                // Maintain logs for wallet amount
                                $this->wallet_logs(@$_POST['customer_id'],@$wallet_data->wallet_amount,@$new_amt);


                            }else{

                                 $w_data = array(
                                    'wallet_amount' => $amount_need_to_credit,
                                    'customer_id' =>$_POST['customer_id'],
                                );
                                $this->common_model->addRecord('ss_customer_wallet',$w_data);

                            }

                            /*log*/

                            $message ="Your wallet has been credited with ".$amount_need_to_credit."rs as a referral code bonus from customer : ".$referee_customer_data->customer_email;

                            $insert = array(
                                'message' =>$message,
                                'customer_id' =>$_POST['customer_id'],
                                'created_at' => date('Y-m-d H:i:s'),
                                'log_type' => 'receivable_bill',
                            );

                            $this->common_model->addRecord('ss_customer_log',$insert);

                            /*******for refree customer*******/

                            $w_where = array(
                                'customer_id' => $referee_customer_data->customer_id,
                            );
                            $wallet_data =$this->common_model->getSingleRecord('ss_customer_wallet',$w_where);

                            if(!empty($wallet_data)){

                                $new_amt = $wallet_data->wallet_amount + $amount_need_to_credit;
                                $w_data = array(
                                    'wallet_amount' =>$new_amt,
                                );
                                $w_data['old_amount'] = $wallet_data->wallet_amount;
                                $w_data['updated_at'] = date('Y-m-d H:i:s');
                                $this->common_model->updateRecord('ss_customer_wallet',$w_data,$w_where);
                               
                                // Maintain logs for wallet amount
                                $this->wallet_logs(@$referee_customer_data->customer_id,@$wallet_data->wallet_amount,@$new_amt);

                            }else{

                                 $w_data = array(
                                    'wallet_amount' => $amount_need_to_credit,
                                    'customer_id' =>$referee_customer_data->customer_id,
                                );
                                $this->common_model->addRecord('ss_customer_wallet',$w_data);

                            }

                            /*log*/

                            $message ="Your wallet has been credited with ".$amount_need_to_credit."rs as a referral code bonus from customer : ".$customer_data->customer_email;

                            $insert = array(
                                'message' =>$message,
                                'customer_id' =>$referee_customer_data->customer_id,
                                'created_at' => date('Y-m-d H:i:s'),
                                'log_type' => 'receivable_bill',
                            );

                            $this->common_model->addRecord('ss_customer_log',$insert);

                            /*update customer referral code status*/
                            $w_where = array(
                                'customer_id' => $_POST['customer_id'],
                            );
                            $rcode_data = array(
                                'is_added_referral_amt' =>'yes',
                            );
                            $this->common_model->updateRecord('ss_customer',$rcode_data,$w_where);
                        }
                    }
                }

            //End referral
    }



     public function wallet_logs($customer_id,$new_wallet_amt,$wallet_amount){
            /*for update logs wallet amount*/
            $data = array();
            $data['wallet_amount'] = $new_wallet_amt;
            $data['customer_id'] = $customer_id;
            $data['old_amount'] = $wallet_amount;
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['diff_amount'] = $wallet_amount-$new_wallet_amt;
            $data['descriptions'] = '';
            $data['user_id']=$this->user_id;
            $this->common_model->addRecord('ss_customer_wallet_log',$data);
    }



    public function paytm_pay_due_response1() {
        header("Pragma: no-cache");
        header("Cache-Control: no-cache");
        header("Expires: 0");
        // following files need to be included
        require_once (APPPATH . "/third_party/paytm/lib/config_paytm.php");
        require_once (APPPATH . "/third_party/paytm/lib/encdec_paytm.php");
        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";
        $paramList = $_POST;
        $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
        $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum);
        if ($isValidChecksum == "TRUE") {
            if (@$_POST["STATUS"] == "TXN_SUCCESS") {
                $customer_id = trim($_GET['customer_id']);
                $exist_trns_data = array();
                $bank_transaction_id = $_POST['TXNID'];
                $tr_where = array('transaction_id' => $bank_transaction_id);
                $exist_trns_data = $this->customer_model->getSingleRecord('ss_customer_transaction', $tr_where);
                if (!empty($exist_trns_data)) {
                    $this->session->set_flashdata('transaction_err_msg', "Transaction Id already exist.Team will contact you soon");
                    redirect('customer/transaction_cancel');
                    die();
                } else {
                    $where = array('customer_id' => $customer_id);
                    $customer_data = $this->customer_model->getSingleRecord('ss_customer', $where);
                    /*transaction*/
                    $city = $customer_data->customer_local_city;
                    $where = array('customer_local_city' => $city);
                    $invoice_no = $this->customer_model->get_invoice_no($where);
                    /*check exist invoice no*/
                    $invoice_where = array('invoice_no' => $invoice_no);
                    $is_exist_invoice = $this->customer_model->check_exist_invoice($invoice_where);
                    if (!empty($is_exist_invoice)) {
                        $new_invoice_no = $this->customer_model->genrate_invoice_no($is_exist_invoice->invoice_no, $city);
                        $invoice_no = $new_invoice_no;
                    }
                    /*end invoice checking*/
                    $substitute_tax = 18;
                    $transaction_type = 'storage_charges';
                    $msg = "Monthly due stoage charges paid";
                    $transaction_record = array('customer_id' => $customer_id, 'paid_amount' => @$_POST['TXNAMOUNT'], 'transaction_id' => @$_POST['TXNID'], 'transaction_order_id' => @$_POST['ORDERID'], 'transaction_created_at' => date('Y-m-d H:i:s'), 'transaction_note' => $msg, 'payment_type' => "online", 'transaction_type' => $transaction_type, 'invoice_no' => $invoice_no, 'substitute_tax' => $substitute_tax,);
                    $cust_transaction_id = $this->customer_model->addRecord('ss_customer_transaction', $transaction_record);
                    /*wallet add*/
                    $paid_amt = @$_POST['TXNAMOUNT'];
                    $w_where = array('customer_id' => $customer_id,);
                    $wallet_data = $this->customer_model->getSingleRecord('ss_customer_wallet', $w_where);
                    if (!empty($wallet_data)) {
                        $new_amt = $wallet_data->wallet_amount + $paid_amt;
                        $w_data = array('wallet_amount' => $new_amt,);

                        $w_data['updated_at'] = date('Y-m-d H:i:s');
                        $w_data['old_amount'] = $wallet_data->wallet_amount;

                        $this->customer_model->updateRecord('ss_customer_wallet', $w_data, $w_where);
                    } else {
                        $w_data = array('wallet_amount' => $paid_amt, 'customer_id' => $customer_id,);
                        $this->customer_model->addRecord('ss_customer_wallet', $w_data);
                    }
                    $message = "Wallet has been credited with " . @$_POST['TXNAMOUNT'] . " for storage charges";
                    $insert = array('message' => $message, 'customer_id' => $customer_id, 'created_at' => date('Y-m-d H:i:s'), 'log_type' => 'receivable_bill',);
                    $this->customer_model->addRecord('ss_customer_log', $insert);
                    /*for due payment*/
                    $p_where = array('customer_id' => $customer_id, 'payment_status' => 'Unpaid');
                    $due_payment_list = $this->customer_model->getAllRecord('ss_customer_payment', $p_where);
                    foreach ($due_payment_list as $key => $due_payment) {
                        $billing_date = date('d/m/Y', strtotime($due_payment->billing_date));
                        $where = array('customer_id' => $customer_id,);
                        $walletData = $this->customer_model->getSingleRecord('ss_customer_wallet', $where);
                        $wallet_amount = @$walletData->wallet_amount;
                        $monthly_amount = $due_payment->payable_amount;
                        if ($monthly_amount <= $wallet_amount) {
                            $new_wallet_amt = ($wallet_amount - $monthly_amount);
                            $wallet_debit_amt = $monthly_amount;
                            /*paid status*/
                            $p_table = 'ss_customer_payment';
                            $payable_data = array('payment_status' => 'Paid');
                            $p_where = array('payment_id' => $due_payment->payment_id);
                            $this->customer_model->updateRecord($p_table, $payable_data, $p_where);
                            /*for update deducted amount*/
                            $data = array();
                            $data['wallet_amount'] = $new_wallet_amt;
                            $data['updated_at'] = date('Y-m-d H:i:s');
                            $data['old_amount'] = @$wallet_amount;


                            $this->customer_model->updateRecord('ss_customer_wallet', $data, $where);
                            /*log note*/
                            $message = 'Wallet debited with ' . $due_payment->payable_amount . ' for bill ' . date('d/m/Y', strtotime($due_payment->billing_date));
                            $insert = array('message' => $message, 'customer_id' => $customer_id, 'created_at' => date('Y-m-d H:i:s'), 'log_type' => 'receivable_bill',);
                            $this->customer_model->addRecord('ss_customer_log', $insert);
                        }
                    }
                    $this->session->set_flashdata('transaction_success_msg', 'Your transaction has been completed sucessfully.');
                    redirect('customer/transaction_success_response');
                }
            }
        }
    }
    public function paytm_pay_due_response() {
        /*echo "<pre>";print_r($_GET);die();*/
        header("Pragma: no-cache");
        header("Cache-Control: no-cache");
        header("Expires: 0");
        // following files need to be included
        require_once (APPPATH . "/third_party/paytm/lib/config_paytm.php");
        require_once (APPPATH . "/third_party/paytm/lib/encdec_paytm.php");
        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";
        $paramList = $_POST;
        $invoice_no= '';
        $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
        //Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
        $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.
        $customer_id = trim($_GET['id']??'');
        if ($isValidChecksum == "TRUE") {
            $payment_req_where = array('ORDERID' => @$_POST['ORDERID'],);
                    
                    $invoice_data = $this->common_model->getSingleRecord('ss_payment_request',$payment_req_where);
                   // echo"<pre>";print_r($invoice_data);die();
                    $invoice_no = $invoice_data->invoice_no;
            if (@$_POST["STATUS"] == "TXN_SUCCESS") {
                /*mark status of payment request */
                if (!empty($payment_req_row)) {
                    $payment_req_data = array();
                    $payment_req_data['STATUS'] = 'TXN_SUCCESS';
                    $payment_req_where = array('ORDERID' => @$_POST['ORDERID'],);
                    $this->common_model->updateRecord('ss_payment_request', $payment_req_data, $payment_req_where);
                    $invoice_data = $this->common_model->getSingleRecord('ss_payment_request',$payment_req_where);
                    echo"<pre>";print_r($invoice_data);die();
                    $invoice_no = $invoice_data->invoice_no;
                }
                /*mark status of payment request end*/
                $s_log_transaction_record = array('customer_id' => $customer_id, 'ORDERID' => @$_POST['ORDERID'], 'TXNAMOUNT' => @$_POST['TXNAMOUNT'], 'TXNDATE' => date('Y-m-d H:i:s'), 'transaction_type' => 'storage_charges',);
                $this->common_model->addRecord('ss_transaction_success_track', $s_log_transaction_record);
                /*echo "<pre>";print_r($_POST);die();*/
                /*check unique trnsaction*/
                $exist_trns_data = array();
                $bank_transaction_id = @$_POST['TXNID'];
                $tr_where = array('transaction_id' => $bank_transaction_id);
                $exist_trns_data = $this->common_model->getSingleRecord('ss_customer_transaction', $tr_where);
                /*$customer_id = base64_decode($_GET['id']);*/
                if (!empty($exist_trns_data)) {
                    $this->session->set_flashdata('transaction_err_msg', "Transaction Id already exist.Team will contact you soon");
                    redirect('customer/transaction_cancel');
                    die();
                } else {
                    // echo "<pre>";print_r($_POST);die();
                    $storage_payment_type = $_GET['storage_payment_type'];
                    $minus_wallet_amt = $_GET['minus_wallet_amt'];
                    $paid_amount = $_POST['TXNAMOUNT'];
                    $order_where = array('customer_id' => $customer_id, 'order_type' => 'pickup', 'order_status !=' => 'cancelled',);
                    $order_order_by = 'order_id ASC';
                    $order_data = $this->common_model->getOrderBySingleRecord('ss_order', $order_where, $order_order_by);
                    $p_where = array('customer_id' => $customer_id);
                    $p_order_by = "payment_id desc";
                    $payment_data = $this->common_model->getOrderBySingleRecord('ss_customer_payment', $p_where, $p_order_by);
                    $p_where = array('customer_id' => $customer_id, 'payment_status' => 'Unpaid');
                    $due_payment_list = $this->common_model->getAllRecord('ss_customer_payment', $p_where);
                    /*new condition*/
                    $group_by = 'billing_date';
                    $pd_where = array('customer_id' => $customer_id, 'payment_status' => 'Unpaid');
                    $date_due_payment_list = $this->common_model->getAllGroupByRecord('ss_customer_payment', $pd_where, $group_by);
                    /*end new condition*/
                    $where = array('customer_id' => $customer_id,);
                    $customer_data = $this->common_model->getSingleRecord('ss_customer', $where);
                    $old_payment_msg = '';
                    $new_pd_where = 'customer_id ="' . $customer_id . '" AND payment_status ="Unpaid" AND charges_type IS NULL';
                    $new_due_payment_list = $this->common_model->getAllRecord('ss_customer_payment', $new_pd_where);
                    $new_pd_where = 'customer_id ="' . $customer_id . '" AND payment_status ="Unpaid" AND charges_type = "transport_charges"';
                    $transportation_due_payment_list = $this->common_model->getAllRecord('ss_customer_payment', $new_pd_where);
                    if (count($new_due_payment_list) >= 2) {
                        $old_form_date = '';
                        $due_arr = [];
                        foreach ($date_due_payment_list as $key => $payment) {
                            if ($key == 0) {
                                $old_form_date = date('d/m/Y', strtotime($payment->billing_date));
                            } else {
                                $due_arr[] = date('d/m/Y', strtotime($payment->billing_date));
                            }
                        }
                        if (!empty($old_form_date)) {
                            $old_payment_msg.= ' + Due payments for bills ' . implode(', ', $due_arr);
                        }
                    }
                    if (!empty($payment_data) && @$payment_data->charges_type != 'transport_charges') {
                        $offer_start_date = $this->validate_next_date($customer_id, $payment_data->billing_date);
                    } else {
                        $offer_start_date = $order_data->order_schedule_date;
                        if (@$customer_data->is_zoho_customer == '1') {
                            $offer_start_date = date('Y-m-d', strtotime($customer_data->next_bill_date));
                        }
                    }
                    $message = '';
                    $transaction_type = 'storage_charges';
                    $substitute_tax = 18;
                    if ($storage_payment_type == 'six_month_payable') {
                        /*if there is only one due payment*/
                        if (count($new_due_payment_list) == 1) {
                            /*$offer_start_date= date('Y-m-d',strtotime($payment_data->billing_date));*/
                            if (!empty($payment_data)) {
                                if ($payment_data->payment_status == 'Unpaid' && $payment_data->charges_type == 'transport_charges') {
                                    $offer_start_date = $order_data->order_schedule_date;
                                    if (@$customer_data->is_zoho_customer == '1') {
                                        $offer_start_date = date('Y-m-d', strtotime($customer_data->next_bill_date));
                                    }
                                } else if ($payment_data->payment_status == 'Unpaid' && $payment_data->charges_type != 'transport_charges') {
                                    $offer_start_date = date('Y-m-d', strtotime($payment_data->billing_date));
                                } else {
                                    $current_date_time = strtotime($payment_data->billing_date);
                                    $offer_start_date = date("Y-m-d", strtotime("+1 month", $current_date_time));
                                }
                            } else {
                                $offer_start_date = $order_data->order_schedule_date;
                                if (@$customer_data->is_zoho_customer == '1') {
                                    $offer_start_date = date('Y-m-d', strtotime($customer_data->next_bill_date));
                                }
                            }
                        }
                        /*end only one unpaid bill*/
                        $offer_msg_start = $offer_start_date;
                        $msg_start = $this->validate_next_6_12_month($customer_id, $offer_start_date, '6');
                        $offer_msg_end = $this->minus_one_day($msg_start);
                        /*$end_date = $this->validate_next_6_12_month($customer_id,$offer_start_date,'6');
                         $offer_end_date = $this->minus_one_day($end_date);*/
                        $message = 'Payment ' . $paid_amount . ' made for 6 months(' . $customer_data->six_month_discount . '% discount) storage charges from ' . date('d/m/Y', strtotime($offer_msg_start)) . ' to ' . date('d/m/Y', strtotime($offer_msg_end)) . $old_payment_msg;
                    } else if ($storage_payment_type == 'yearly_payable_amount') {
                        if (count($new_due_payment_list) == 1) {
                            //$offer_start_date=date('Y-m-d',strtotime($payment_data->billing_date));
                            if (!empty($payment_data)) {
                                if ($payment_data->payment_status == 'Unpaid' && $payment_data->charges_type == 'transport_charges') {
                                    $offer_start_date = $order_data->order_schedule_date;
                                } else if ($payment_data->payment_status == 'Unpaid' && $payment_data->charges_type != 'transport_charges') {
                                    $offer_start_date = date('Y-m-d', strtotime($payment_data->billing_date));
                                } else {
                                    $current_date_time = strtotime($payment_data->billing_date);
                                    $offer_start_date = date("Y-m-d", strtotime("+1 month", $current_date_time));
                                }
                            } else {
                                $offer_start_date = $order_data->order_schedule_date;
                            }
                        }
                        $offer_msg_start = $offer_start_date;
                        $msg_start = $this->validate_next_6_12_month($customer_id, $offer_start_date, '12');
                        $offer_msg_end = $this->minus_one_day($msg_start);
                        $message = 'Payment ' . $paid_amount . ' made for 12 months(' . $customer_data->yearly_discount . '% discount) storage charges from ' . date('d/m/Y', strtotime($offer_msg_start)) . ' to ' . date('d/m/Y', strtotime($offer_msg_end)) . $old_payment_msg;
                    } else if ($storage_payment_type == 'monthly_payable') {
                        if (!empty($payment_data)) {
                            if ($payment_data->payment_status == 'Unpaid' && $payment_data->charges_type == 'transport_charges') {
                                $offer_start_date = $order_data->order_schedule_date;
                            } else if ($payment_data->payment_status == 'Unpaid' && $payment_data->charges_type != 'transport_charges') {
                                $offer_start_date = date('Y-m-d', strtotime($payment_data->billing_date));
                            } else {
                                $current_date_time = strtotime($payment_data->billing_date);
                                $offer_start_date = date("Y-m-d", strtotime("+1 month", $current_date_time));
                            }
                        } else {
                            $offer_start_date = $order_data->order_schedule_date;
                        }
                        $end_date = $this->validate_next_date($customer_id, $offer_start_date);
                        $offer_end_date = $this->minus_one_day($end_date);
                        $message = 'Payment ' . $paid_amount . ' made for monthly storage charges from ' . date('d/m/Y', strtotime($offer_start_date)) . ' to ' . date('d/m/Y', strtotime($offer_end_date)) . $old_payment_msg;;
                    } else {
                        $message = 'Due payment ' . $paid_amount . ' made for ';
                        /*only due*/
                        if (!empty($date_due_payment_list)) {
                            $due_arr = [];
                            $charges_type_arr = array();
                            foreach ($date_due_payment_list as $key => $payment) {
                                $charges_type_arr[] = $payment->charges_type;
                                $due_arr[] = date('d/m/Y', strtotime($payment->billing_date));
                            }
                            if (count($date_due_payment_list) > 1) {
                                if (in_array('transport_charges', $charges_type_arr)) {
                                    $message.= 'transport & monthly bills ' . implode(', ', $due_arr);
                                } else {
                                    $message.= ' monthly bills ' . implode(', ', $due_arr);
                                }
                            } else {
                                if (in_array('transport_charges', $charges_type_arr)) {
                                    $message.= 'transport bills ' . implode(', ', $due_arr);
                                    $transaction_type = 'safestorage_transport';
                                    $substitute_tax = 0;
                                    if (!empty($date_due_payment_list[0]->tax > 0)) {
                                        $transaction_type = 'stacking_barcoding';
                                        $substitute_tax = 18;
                                    }
                                } else {
                                    $message.= 'monthly bills ' . implode(', ', $due_arr);
                                }
                            }
                        }
                    }
                    /*if there is no due payment*/
                    if ($storage_payment_type != 'six_month_payable' && $storage_payment_type != 'yearly_payable_amount') {
                        if (count($due_payment_list) < 1) {
                            $message = "Wallet has been credited with " . @$_POST['TXNAMOUNT'] . " for storage charges.";
                        }
                    }
                    /*end */
                    $city = $customer_data->customer_local_city;
                    $invoice_split_array = [];
                    $invoice_split_array = str_split($invoice_no, 4);
                   // echo"<pre>";print_r($invoice_split_array);die();
                    $invoice_year = $invoice_split_array[0];
                    $invoice_split_array = str_split($invoice_split_array[1], 3);
                    $invoice_city = $invoice_split_array[0];
                    $invoice_split_array = str_split($invoice_no, 7);
                    $count = count($invoice_split_array);
                    $invoice_digits = preg_replace('/[^0-9]/', '', $invoice_split_array[1]);
                    $invoice_month = preg_replace('/[^a-zA-Z]/', '', $invoice_split_array[1]);
                    if ($count > 2) {
                        $invoice_digits = $invoice_digits . $invoice_split_array[2];
                    } else {
                        $invoice_digits = $invoice_digits;
                    }
                    $invoice_where_req = array('invoice_year' => $invoice_year, 'invoice_city' => $invoice_city, 'invoice_month' => $invoice_month, 'invoice_digits >=' => $invoice_digits);
                    //
                    /*check exist invoice no*/
                    $invoice_where = array('invoice_no' => $invoice_no);
                    $is_exist_invoice = $this->common_model->check_exist_invoice($invoice_where);
                    $is_exist_invoice_request = $this->common_model->check_exist_invoice_request($invoice_where_req);
                    if (!empty($is_exist_invoice)) {
                        $exists = '1';
                        $new_invoice_no = $this->common_model->genrate_invoice_no($is_exist_invoice->invoice_no, $city, $exists);
                        $invoice_no = $new_invoice_no;
                    }
                    /*end invoice checking*/
                    $comb_where = array('customer_id' => $customer_id, 'ORDERID' => @$ORDER_ID,);
                    $combined_charges = $this->common_model->getSingleRecord('ss_pre_transaction_data', $comb_where);
                    if (!empty($combined_charges) || (!empty($transportation_due_payment_list) && !empty($new_due_payment_list))) {
                        $transaction_record = array('customer_id' => $customer_id, 'paid_amount' => $transportation_due_payment_list[0]->payable_amount, 'transaction_id' => @$_POST['TXNID'] . 'T', 'transaction_order_id' => @$_POST['ORDERID'] . 'T', 'transaction_created_at' => date('Y-m-d H:i:s'), 'transaction_note' => $transportation_due_payment_list[0]->offer_note, 'payment_type' => "online", 'transaction_type' => 'safestorage_transport', 'invoice_no' => $invoice_no . 'T', 'transaction_payment_date' => date('Y-m-d H:i:s'), 'substitute_tax' => 0,);
                        if (!$cust_transaction_id = $this->common_model->addTransaction('ss_customer_transaction', $transaction_record)) {
                            $city = $customer_data->customer_local_city;
                            $where = array('customer_local_city' => $city);
                            $invoice_no = $this->common_model->get_invoice_no($where);
                            $invoice_split_array = [];
                            $invoice_split_array = str_split($invoice_no, 4);
                            $invoice_year = $invoice_split_array[0];
                            $invoice_split_array = str_split($invoice_split_array[1], 3);
                            $invoice_city = $invoice_split_array[0];
                            $invoice_split_array = str_split($invoice_no, 7);
                            $count = count($invoice_split_array);
                            $invoice_digits = preg_replace('/[^0-9]/', '', $invoice_split_array[1]);
                            $invoice_month = preg_replace('/[^a-zA-Z]/', '', $invoice_split_array[1]);
                            if ($count > 2) {
                                $invoice_digits = $invoice_digits . $invoice_split_array[2];
                            } else {
                                $invoice_digits = $invoice_digits;
                            }
                            $invoice_where_req = array('invoice_year' => $invoice_year, 'invoice_city' => $invoice_city, 'invoice_month' => $invoice_month, 'invoice_digits >=' => $invoice_digits);
                            //
                            /*check exist invoice no*/
                            $invoice_where = array('invoice_no' => $invoice_no);
                            $is_exist_invoice = $this->common_model->check_exist_invoice($invoice_where);
                            $is_exist_invoice_request = $this->common_model->check_exist_invoice_request($invoice_where_req);
                            //echo "<pre>";print_r($is_exist_invoice_request);die();
                            if (!empty($is_exist_invoice)) {
                                $exists = '1';
                                $new_invoice_no = $this->common_model->genrate_invoice_no($is_exist_invoice->invoice_no, $city, $exists);
                                $invoice_no = $new_invoice_no;
                            }
                            if (!empty($is_exist_invoice_request)) {
                                $exists = '1';
                                $current_invoice_no = $is_exist_invoice_request[count($is_exist_invoice_request) - 1]->invoice_no;
                                $new_invoice_no = $this->common_model->genrate_invoice_no_request($current_invoice_no, $city, $exists);
                                $invoice_no = $new_invoice_no;
                            }
                            $invoice_split_array = [];
                            $invoice_split_array = str_split($invoice_no, 4);
                            $invoice_year = $invoice_split_array[0];
                            $invoice_split_array = str_split($invoice_split_array[1], 3);
                            $invoice_city = $invoice_split_array[0];
                            $invoice_split_array = str_split($invoice_no, 7);
                            $count = count($invoice_split_array);
                            $invoice_digits = preg_replace('/[^0-9]/', '', $invoice_split_array[1]);
                            $invoice_month = preg_replace('/[^a-zA-Z]/', '', $invoice_split_array[1]);
                            if ($count > 2) {
                                $invoice_digits = $invoice_digits . $invoice_split_array[2];
                            } else {
                                $invoice_digits = $invoice_digits;
                            }
                            $payment_req_data_inv = array('invoice_no' => $invoice_no, 'invoice_year' => $invoice_year, 'invoice_city' => $invoice_city, 'invoice_month' => $invoice_month, 'invoice_digits' => $invoice_digits);
                            $this->common_model->addRecord('ss_invoices_tbl', $payment_req_data_inv);
                            $transaction_record = array('customer_id' => $customer_id, 'paid_amount' => $transportation_due_payment_list[0]->payable_amount, 'transaction_id' => @$_POST['TXNID'] . 'T', 'transaction_order_id' => @$_POST['ORDERID'] . 'T', 'transaction_created_at' => date('Y-m-d H:i:s'), 'transaction_note' => $transportation_due_payment_list[0]->offer_note, 'payment_type' => "online", 'transaction_type' => 'safestorage_transport', 'invoice_no' => $invoice_no . 'T', 'transaction_payment_date' => date('Y-m-d H:i:s'), 'substitute_tax' => 0,);
                            $cust_transaction_id = $this->common_model->addTransaction('ss_customer_transaction', $transaction_record);
                        }
                        $tstorage_record = array('customer_id' => $customer_id, 'paid_amount' => $new_due_payment_list[0]->payable_amount, 'transaction_id' => @$_POST['TXNID'], 'transaction_order_id' => @$_POST['ORDERID'], 'transaction_created_at' => date('Y-m-d H:i:s'), 'transaction_note' => $message, 'payment_type' => "offline", 'transaction_type' => $transaction_type, 'invoice_no' => $invoice_no . 'S', 'transaction_payment_date' => date('Y-m-d H:i:s'), 'substitute_tax' => 18,);
                        $cust_transaction_id = $this->common_model->addTransaction('ss_customer_transaction', $tstorage_record);
                    } else {
                        $transaction_record = array('customer_id' => $customer_id, 'paid_amount' => @$_POST['TXNAMOUNT'], 'transaction_id' => @$_POST['TXNID'], 'transaction_order_id' => @$_POST['ORDERID'], 'transaction_created_at' => date('Y-m-d H:i:s'), 'transaction_note' => $message, 'payment_type' => "offline", 'transaction_type' => $transaction_type, 'invoice_no' => $invoice_no, 'transaction_payment_date' => date('Y-m-d H:i:s'), 'substitute_tax' => 0,);
                        if (!$cust_transaction_id = $this->common_model->addTransaction('ss_customer_transaction', $transaction_record)) {
                            $where = array('customer_local_city' => $city);
                            $invoice_no = $this->common_model->get_invoice_no($where);
                            $invoice_split_array = [];
                            $invoice_split_array = str_split($invoice_no, 4);
                            $invoice_year = $invoice_split_array[0];
                            $invoice_split_array = str_split($invoice_split_array[1], 3);
                            $invoice_city = $invoice_split_array[0];
                            $invoice_split_array = str_split($invoice_no, 7);
                            $count = count($invoice_split_array);
                            $invoice_digits = preg_replace('/[^0-9]/', '', $invoice_split_array[1]);
                            $invoice_month = preg_replace('/[^a-zA-Z]/', '', $invoice_split_array[1]);
                            if ($count > 2) {
                                $invoice_digits = $invoice_digits . $invoice_split_array[2];
                            } else {
                                $invoice_digits = $invoice_digits;
                            }
                            $invoice_where_req = array('invoice_year' => $invoice_year, 'invoice_city' => $invoice_city, 'invoice_month' => $invoice_month, 'invoice_digits >=' => $invoice_digits);
                            //
                            /*check exist invoice no*/
                            $invoice_where = array('invoice_no' => $invoice_no);
                            $is_exist_invoice = $this->common_model->check_exist_invoice($invoice_where);
                            $is_exist_invoice_request = $this->common_model->check_exist_invoice_request($invoice_where_req);
                            //echo "<pre>";print_r($is_exist_invoice_request);die();
                            if (!empty($is_exist_invoice)) {
                                $exists = '1';
                                $new_invoice_no = $this->common_model->genrate_invoice_no($is_exist_invoice->invoice_no, $city, $exists);
                                $invoice_no = $new_invoice_no;
                            }
                            if (!empty($is_exist_invoice_request)) {
                                $exists = '1';
                                $current_invoice_no = $is_exist_invoice_request[count($is_exist_invoice_request) - 1]->invoice_no;
                                $new_invoice_no = $this->common_model->genrate_invoice_no_request($current_invoice_no, $city, $exists);
                                $invoice_no = $new_invoice_no;
                            }
                            $invoice_split_array = [];
                            $invoice_split_array = str_split($invoice_no, 4);
                            $invoice_year = $invoice_split_array[0];
                            $invoice_split_array = str_split($invoice_split_array[1], 3);
                            $invoice_city = $invoice_split_array[0];
                            $invoice_split_array = str_split($invoice_no, 7);
                            $count = count($invoice_split_array);
                            $invoice_digits = preg_replace('/[^0-9]/', '', $invoice_split_array[1]);
                            $invoice_month = preg_replace('/[^a-zA-Z]/', '', $invoice_split_array[1]);
                            if ($count > 2) {
                                $invoice_digits = $invoice_digits . $invoice_split_array[2];
                            } else {
                                $invoice_digits = $invoice_digits;
                            }
                            $payment_req_data_inv = array('invoice_no' => $invoice_no, 'invoice_year' => $invoice_year, 'invoice_city' => $invoice_city, 'invoice_month' => $invoice_month, 'invoice_digits' => $invoice_digits);
                            $this->common_model->addRecord('ss_invoices_tbl', $payment_req_data_inv);
                            $transaction_record = array('customer_id' => $customer_id, 'paid_amount' => @$_POST['TXNAMOUNT'], 'transaction_id' => @$_POST['TXNID'], 'transaction_order_id' => @$_POST['ORDERID'], 'transaction_created_at' => date('Y-m-d H:i:s'), 'transaction_note' => $message, 'payment_type' => "offline", 'transaction_type' => $transaction_type, 'invoice_no' => $invoice_no, 'transaction_payment_date' => date('Y-m-d H:i:s'), 'substitute_tax' => 0,);
                            $cust_transaction_id = $this->common_model->addTransaction('ss_customer_transaction', $transaction_record);
                        }
                    }
                    if ($cust_transaction_id) {
                        //$this->send_invoice($cust_transaction_id);
                        /*start wallet entry*/
                        $where = array('customer_id' => $customer_id,);
                        $walletData = $this->common_model->getSingleRecord('ss_customer_wallet', $where);
                        $wallet_amount = 0;
                        if (!empty($walletData)) {
                            /*if wallet is minus in fronttend then need to sync proper amount*/
                            if ($minus_wallet_amt > 0.00) {
                                /*sync amount */
                                $wallet_amount = ($paid_amount + $minus_wallet_amt);
                                $data = array();
                                $data['wallet_amount'] = $wallet_amount;
                                $data['updated_at'] = date('Y-m-d H:i:s');
                                

                                $this->common_model->updateRecord('ss_customer_wallet', $data, $where);
                            } else {
                                $data = array();
                                $wallet_amount = ($walletData->wallet_amount + $paid_amount);
                                $data['wallet_amount'] = $wallet_amount;

                                $data['old_amount'] = $walletData->wallet_amount;
                                $data['updated_at'] = date('Y-m-d H:i:s');

                                
                                $this->common_model->updateRecord('ss_customer_wallet', $data, $where);
                            }
                        } else {
                            $data = array();
                            $data['wallet_amount'] = $paid_amount;
                            $data['customer_id'] = $customer_id;
                            $this->common_model->addRecord('ss_customer_wallet', $data);
                        }
                        /*activity log*/
                        $message = 'Wallet credited with ' . $paid_amount;
                        $insert = array('message' => $message, 'customer_id' => $customer_id, 'created_at' => date('Y-m-d H:i:s'), 'log_type' => 'receivable_bill',);
                        // $this->log_model->InsertLog($insert);
                        /*end wallet entry*/
                        /*pay billing staart */
                        $this->pay_billing_data($customer_id, $storage_payment_type, $paid_amount);
                        /*pay billing end */
                        $this->session->set_userdata('tr_customer_id', $customer_id);
                        $this->session->set_flashdata('transaction_success_msg', 'Your transaction has been completed sucessfully.');
                        redirect('customer/transaction_success_response');
                    } else {
                        $msg = "Duplicate txn orderID found,so system ignored retrieval transaction with details";
                        $msg.= "TxnOrderId " . @$_POST['ORDERID'];
                        $msg.= " Amount " . @$_POST['TXNAMOUNT'];
                        $insert = array('user_id' => $this->user_id, 'message' => $msg, 'customer_id' => @$customer_id, 'created_at' => date('Y-m-d H:i:s'), 'log_type' => 'duplicate_transaction');
                        // $this->log_model->InsertLog($insert);
                        $msg = "Oop's something went wrong our team will get back to you.";
                        $this->session->set_userdata('transaction_err_msg', $msg);
                        redirect('customer/transaction_cancel');
                    }
                } /*end transaction not empty*/
            } else {
                $log_transaction_record = array('customer_id' => $customer_id, 'ORDERID' => @$_POST['ORDERID'], 'TXNDATE' => date('Y-m-d H:i:s'), 'STATUS' => @$_POST['STATUS'], 'RESPCODE' => @$_POST['RESPCODE'], 'RESPMSG' => @$_POST['RESPMSG'], 'TXNID' => @$_POST['TXNID'], 'transaction_type' => 'storage_charges', 'storage_payment_type' => $_GET['storage_payment_type'],);
                $this->common_model->addRecord('ss_failed_transaction_log', $log_transaction_record);
                $this->session->set_flashdata('transaction_err_msg', $_POST["RESPMSG"]);
                redirect('customer/transaction_cancel');
            }
        } else {
            $log_transaction_record = array('customer_id' => $customer_id, 'ORDERID' => @$_POST['ORDERID'], 'TXNDATE' => date('Y-m-d H:i:s'), 'STATUS' => @$_POST['STATUS'], 'RESPCODE' => @$_POST['RESPCODE'], 'RESPMSG' => @$_POST['RESPMSG'], 'TXNID' => @$_POST['TXNID'], 'transaction_type' => 'storage_charges', 'storage_payment_type' => $_GET['storage_payment_type'],);
            $this->common_model->addRecord('ss_failed_transaction_log', $log_transaction_record);
        }
    }
  
    public function transaction_error_response() {
        $data = [];
        $this->load->view('frontend/new/new_header', $data);
        $this->load->view('customer/transaction_err_message', $data);
        $this->load->view('frontend/new/new_footer');
    }
    public function transaction_success_response() {
        $data = [];
        $this->load->view('frontend/new/new_header', $data);
        $this->load->view('customer/transaction_success_message', $data);
        $this->load->view('frontend/new/new_footer');
    }





    public function storage_charges_multifactor($city = null) {
        $where = array('city' => $city,);
        $multi_factor = $this->customer_model->getSingleRecord('ss_price_config', $where);
        $multi_factor_percent = 1;
        if (!empty($multi_factor)) {
            $multi_factor_percent = $multi_factor->storage_multi_factor;
        }
        return $multi_factor_percent;
    }
    public function transport_charges_multifactor($city = null) {
        $where = array('city' => $city,);
        $multi_factor = $this->customer_model->getSingleRecord('ss_price_config', $where);
        $multi_factor_percent = 1;
        if (!empty($multi_factor)) {
            $multi_factor_percent = $multi_factor->transport_multi_factor;
        }
        return $multi_factor_percent;
    }
    public function validate_next_date($customer_id = null, $last_billing_date = null, $months = null) {
        /*$where = array('customer_id' => $customer_id);*/
        $where = 'customer_id ="' . $customer_id . '" AND charges_type IS NULL';
        $bill_order_by = "payment_id ASC";
        $first_bill_data = $this->cron_model->get_single_record('ss_customer_payment', $where, $bill_order_by);
        $bill_day = '';
        if (!empty($first_bill_data)) {
            $bill_day = date('d', strtotime($first_bill_data->billing_date));
        } else {
            $order_where = array('customer_id' => $customer_id, 'order_type' => 'pickup', 'order_status !=' => 'cancelled',);
            $order_order_by = 'order_id ASC';
            $order_data = $this->common_model->getOrderBySingleRecord('ss_order', $order_where, $order_order_by);
            $bill_day = date('d', strtotime($order_data->order_schedule_date));
            $c_where = array('customer_id' => $customer_id);
            $customer_data = $this->auth_model->get_customer_date($c_where);
            if (@$customer_data->is_zoho_customer == '1') {
                $bill_day = date('d', strtotime($customer_data->next_bill_date));
            }
        }
        $month_year = date('Y-m', strtotime($last_billing_date));
        $inc_month_year = date('Y-m', strtotime('+1 month', strtotime($month_year)));
        

        if ($months == '6') {
            /*by default its taking 7 month so we adjusted here by making minus one month so it will count 6 month*/
            $inc_month_year = date('Y-m', strtotime('+5 month', strtotime($month_year)));
        } else if ($months == '12') {
            /*by default its taking 13 month so we adjusted here by making minus one month so it will count 12 month*/
            $inc_month_year = date('Y-m', strtotime('+11 month', strtotime($month_year)));
        }
        $unformated_date = $inc_month_year . '-' . $bill_day;
        $formated_date = $this->DateFoundInMonth($unformated_date);
        $bill_date = date('Y-m-d', strtotime($formated_date));
        return $bill_date;
    }
   

          /*send invoice*/
    public function send_invoice($cust_transaction_id=null) {
        /*issue is that its messup with trnsaction slip..*/
     /*   if (!empty($_POST)) {*/
            //$cust_transaction_id = $_POST['cust_transaction_id'];
            $where = array('cust_transaction_id' => $cust_transaction_id,);
            $table = 'ss_customer_transaction';
            $transaction_data = $this->common_model->getSingleRecord($table, $where);

            $tds_table ='ss_tds_payment'; 
            $tds_data = $this->common_model->getSingleRecord($tds_table,$where);

            /**/
            $customer_id = $transaction_data->customer_id;

            $c_where = array('customer_id' => $customer_id);
            $customer_data = $this->common_model->getSingleRecord('ss_customer', $c_where);
           /* if($customer_data->is_business_cust==1){
                   echo "success"; die;
            }

            if($customer_data->gstin_no!='' && $customer_data->gstin_no!='NA'  && $customer_data->gstin_no!=Null){
                   echo "success"; die;
            }*/

            $email_id = $customer_data->customer_email;
            $order_where = array('customer_id' => $customer_id, 'order_type' => 'pickup', 'order_status !=' => 'cancelled',);
            $order_by = 'order_id ASC';
            $order_data = $this->common_model->getOrderBySingleRecord('ss_order', $order_where, $order_by);
            $item_data = array();
            $item_data['transaction_data'] = $transaction_data;
            $item_data['customer_data'] = $customer_data;
            $item_data['cust_transaction_id'] = $cust_transaction_id;
            $item_data['order_data'] = $order_data;
            $item_data['tds_data'] = $tds_data;
            
            $item_data['text_in_word'] = $this->convertToIndianCurrency($transaction_data->paid_amount);
            $c_city = $customer_data->customer_local_city;
            $c_gstin_no = $customer_data->gstin_no;
            $item_data['is_igst_no'] = $this->is_igst_customer($c_city, $c_gstin_no);
            $welcome = "Dear " . $customer_data->customer_name . "<br/><br/>";
            $welcome.= "Greetings from <b>SAFE STORAGE</b> - We store anything you care!:<br/><br/>";
            $welcome.= "Please find the invoice attachment.<br/><br/>";
            $welcome.= "Thanks & Best Regards<br/>";
            $welcome.= "<span style='color:#05307f;'>SAFE STORAGE™ -<span> <span style='color:#ef5921;'>We Store Anything You Care!</span><br/>";
           $welcome.=  "8088 84 84 84 <br/>";
            $welcome.= "<a href='www.safestorage.in'>www.safestorage.in</a><br/>";
            $this->load->library('m_pdf');
            ob_start();
            $html_content = $this->load->view('customer/invoice_pdf', $item_data, true);
            $this->m_pdf->pdf->debug = true;
            $this->m_pdf->pdf->SetDisplayMode('fullwidth');
            $this->m_pdf->pdf->showImageErrors = true;
            $this->m_pdf->pdf->WriteHTML($html_content);
            $content = $this->m_pdf->pdf->Output('', 'S');
            $filename = "ss_invoice_" . time() . ".pdf";
            ob_clean();
            $this->load->library('email');
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->from('service@safestorage.in');
             $this->email->to($email_id);
             //$this->email->to('kushal143rachamadugu@gmail.com');
            //$this->email->cc('safestorage.in@gmail.com');
            $this->email->subject("Invoice", "SafeStorage");
            $this->email->message($welcome);
            $this->email->attach($content, 'attachment', $filename, 'application/pdf');
             $this->email->send();
        //}
        return true;
    }

  public function convertToIndianCurrency($number= null) {
        $no = round($number);
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine', 10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen', 19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty', 40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty', 70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_length) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i+= $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
            } else {
                $str[] = null;
            }
        }
        $Rupees = implode(' ', array_reverse($str));
        $paise = ($decimal) ? "And Paise " . ($words[$decimal - $decimal % 10]) . " " . ($words[$decimal % 10]) : '';
        return ($Rupees ? $Rupees : '') . $paise . " Only";
    }
    /*igst invoicing*/
    public function is_igst_customer($clity_slug = null, $customer_igst_no = null) {
        $return_value = false;
        if (!empty($customer_igst_no)) {
            if (strlen($customer_igst_no) == 15) {
                $customer_gst_code = substr($customer_igst_no, 0, 2);
                $where = array('city_slug' => $clity_slug);
                $city_data = $this->common_model->getSingleRecord('ss_city', $where);
                if (!empty($city_data)) {
                    if ($city_data->gst_code != $customer_gst_code) {
                        $return_value = true;
                    }
                }
            }
        }
        return $return_value;
    }

    
  
     

    public function minus_one_day($input_date= null) {
        return $date = date('Y-m-d', (strtotime('-1 day', strtotime($input_date))));
    }

  
    

    



            

   


     public function savedata() {



        //print_r($_POST); die;


       
        if (!empty($_POST['customer_id'])) {
            $customer_id = $_POST['customer_id'];


            
            $where = array('customer_id' => $customer_id,);
            $customer_data = $this->common_model->getSingleRecord('ss_customer', $where);

            $quotation_id = $_POST['quotation_id'];
            if (!empty($_POST['date'])) {
                $date_arr = explode('/', $_POST['date']);

                $current_day = date('d'); // returns the current day (e.g. "27")
                $current_month = date('m'); // returns the current month (e.g. "02")


                if(isset($date_arr[0])){
                    $m=$date_arr[0];  
                    if(strlen($m)>2){
                       $date_arr[0]=$current_day;  
                    } 
                    if($m > 31){
                        $date_arr[0]=$current_day; 
                    }
                }else{
                   $date_arr[0]=$current_day; 
                }

                if(isset($date_arr[1])){
                    $m=$date_arr[1];
                    if(strlen($m)>2){
                        $date_arr[1]=$current_month; 
                    } 
                    if($m > 12){
                         $date_arr[1]=$current_month;  
                    }
                }else{
                    $date_arr[1]=$current_month;  
                }

                if(isset($date_arr[0]) && isset($date_arr[1])  && isset($date_arr[2]) ){
                    $transport_pickup_date = $date_arr[2] . '-' . $date_arr[1] . '-' . $date_arr[0];
                }else{
                   $transport_pickup_date = date('Y-m-d'); 
                }


                //$transport_pickup_date = @$date_arr[2] . '-' . @$date_arr[1] . '-' . @$date_arr[0];
                /*if(is_numeric(@$date_arr[2]) && is_numeric(@$date_arr[0]) && is_numeric(@$date_arr[1])){
                      $transport_pickup_date = $date_arr[2] . '-' . $date_arr[0] . '-' . $date_arr[1];
                }else{
                     $transport_pickup_date = date('Y-m-d');
                }*/
            } else {
                $transport_pickup_date = date('Y-m-d');
            }

            
            /*echo "transport_pickup_date : ".$transport_pickup_date;die();*/
            if (!empty($_POST['coupen_code'])) {
                $transport_due_charges = $_POST['total_pickup_charges'] - $_POST['transport_token_amt'];
                $coupon_data = array('customer_id' => $_POST['customer_id'], 'quotation_id' => $_POST['quotation_id'], 'pickup_charges' => $_POST['total_pickup_charges'], 'transport_token_amt' => $_POST['transport_token_amt'], 'transport_due_charges' => $transport_due_charges, 'old_transport_charge' => @$_POST['old_transpoet_charge'], 'coupon_code' => @$_POST['coupen_code'], 'transport_coupon' => @$_POST['transport_coupon'],);
                $this->customer_model->addRecord('ss_quotation_transport_coupon', $coupon_data);
            }
            $cdata = array('restriction_movement_good' => $_POST['restriction_movement_good'], 'pickup_date' => $transport_pickup_date,);
            $cwhere = array('customer_id' => $_POST['customer_id'],);
            $this->customer_model->updateRecord('ss_customer', $cdata, $cwhere);
            /*update qt data*/
            $pickup_type = $_POST['transport_type'];
            $q_transport_type = 'warehouse_arrival';
            if ($pickup_type == 'pickup') {
                $q_transport_type = 'safestorage_transport';
            }
            $qdata = array('transport_type' => $q_transport_type,);
            $qwhere = array('quotation_id' => $_POST['quotation_id'],);
            $this->customer_model->updateRecord('ss_customer_quotation', $qdata, $qwhere);
            $TXN_AMOUNT = 0;
            if ($_POST['transport_type'] == 'warehouse_arrival') {
                $TXN_AMOUNT = $_POST['warehouse_arrival_token_amt']; //$quotation_data->transport_token_amt;
                
            } else {
                $TXN_AMOUNT = $_POST['transport_token_amt']; //$quotation_data->transport_token_amt;
                
            }


          redirect('customer/transaction_success_response');

    
        
        }
    }


    
    



      

    public function get_city_areas(){
            $city_id = $_POST['city_id'];
            $this->db->select('area_name, area_slug, pincode');
            $this->db->from('ss_area');
            $this->db->where('city_id', $city_id);
            $query = $this->db->get();
            $areas=$query->result();

            $data = [];
            if (!empty($areas)) {
                foreach ($areas as $area) {
                    if($area->pincode==Null){
                        $pin='';
                    }else{
                        $pin=$area->pincode; 
                    }
                    $data[] = [
                        'area_name' => $area->area_name,
                        'area_slug' => $area->area_slug,
                        'pincode'=> @$pin,
                    ];
                }
            }

              $data[] = [
                        'area_name' => "Other",
                        'area_slug' => "other",
                        'pincode'=> "",
                    ];
            echo json_encode($data);die;
      }



  




}


