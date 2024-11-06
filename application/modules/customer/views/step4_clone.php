<?php 

/*$c_where = array('customer_id' => @$customer_id);    
$customer_data_q = $this->customer_model->getSingleRecord('ss_customer_quotation', $c_where);
if (empty($customer_data_q)) {  
     $quotation_id = $this->customer_model->addRecord('ss_customer_quotation',$quotation_data);
}
else{
    $quotation_id=$customer_data_q->quotation_id;
    $qwhere = array('quotation_id' => $quotation_id);
    $this->customer_model->updateRecord('ss_customer_quotation', $quotation_data, $qwhere);
}*/


$qwhere = array('quotation_id' => $quotation_id);
$this->customer_model->updateRecord('ss_customer_quotation', $quotation_data, $qwhere);


 ?>
<style type="text/css">
    .ui-datepicker-inline.ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all {
        width: 100%;
    }

    .radio-border-box .custom-radio .custom-control-input:checked~.custom-control-label::after {
        background-image: url('../images/booking/check.png');
    }

    .grc-fc {
        padding: 8px 97px 8px 20px;
        /* letter-spacing: 4px; */
        width: 100%;
        /*//font-size: 19px;*/
        border-radius: 13px;
        height: 62% !important;
    }

    .haserrors {
        border-color: red;
    }

     input[type="radio"] {
        display: block;
    }
</style>

<?php
//$get_charges = $this->customer_model->getSingleRecord('ss_new_charges_increased',$whereet='');
$total_pickup_charges =($quotation_data->lift_cost + $quotation_data->transport_cost + $quotation_data->labour_cost + $quotation_data->item_packing_charges + $quotation_data->extra_km_charges);  
//$total_pickup_charges *= $get_charges->transport_charge_increased;

if(!empty($quotation_data->transport_multi_factor)){
    $total_pickup_charges=($total_pickup_charges * $quotation_data->transport_multi_factor); 
}  

$token_percent = 10;
$transport_token_amt=($total_pickup_charges * $token_percent)/100;


/***********storage charges*********/

$total_storage_charges = $quotation_data->total_storage_charges; 

if(!empty($quotation_data->storage_multi_factor)){
  $total_storage_charges = ($quotation_data->total_storage_charges * $quotation_data->storage_multi_factor); 
}   
$monthly_gst_amt = ($total_storage_charges * 18)/100;   
$monthly_storage_charges=round(($total_storage_charges + $monthly_gst_amt));

$storage_coupon_amt = 0;
if(!empty($quotation_data->storage_coupen)){
    $storage_coupen_arr = explode('-', $quotation_data->storage_coupen);
    if($storage_coupen_arr[1] =='flat'){
      $storage_coupon_amt = $storage_coupen_arr[2];
    }else{
      $storage_coupon_amt =($storage_coupen_arr[2]/100)*$monthly_storage_charges;
    }
}

$revised_monthly_charges=($monthly_storage_charges - $storage_coupon_amt); 
 
$total_monthly_storage_charges = round($revised_monthly_charges);

$six_month_payable_amount =round(($total_monthly_storage_charges * 6)); 

$yearly_payable_amount =round(($total_monthly_storage_charges * 12));
?>


<input type="hidden" id="set_date" value="">

<input type="hidden" id="yearly_new_price" value="">
<input type="hidden" id="half_year_new_price" value="">
<input type="hidden" id="monthly_new_price" value="">


<input type="hidden" id="date" name="date">
<input type="hidden" id="transport_amount" name="transport_amount">
<input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_id;?>">
<input type="hidden" name="quotation_id" value="<?php echo $quotation_id;?>">
<input type="hidden" name="coupen_code" value="" id="coupen_code">
<input type="hidden" name="referee_id" value="" id="referee_id">
<input type="hidden" name="total_pickup_charges" id="total_pickup_charges" value="<?php echo @$total_pickup_charges;?>">

<input type="hidden" id="post_total_pickup_charges" value="<?php echo @$total_pickup_charges;?>">

<input type="hidden" id="storage_multi_factor" value="<?php echo @$quotation_data->storage_multi_factor;?>">

<input type="hidden" name="transport_token_amt" id="transport_token_amt" value="<?php echo @$transport_token_amt?>">
<input type="hidden" name="old_transpoet_charge" id="old_transpoet_charge" value="<?php echo @$quotation_data->total_pickup_charges_with_gst; ?>">

<input type="hidden" id="selected_home_type" value="<?php echo $quotation_data->hometype;?>">
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>



<?php 

$storage_coupon_val = $percent_coupon;
$coupen_type = 'percent';
$coupen_code='safestorage';
$option_val_off='';
if(!empty($quotation_data->storage_coupen)){

/*as per new condition in dropdown storage charge coupon but while*/

$st_coupon_arr = explode('-', $quotation_data->storage_coupen);

$coupen_code=$st_coupon_arr[0];

$storage_coupon_val = $st_coupon_arr[2];

if($st_coupon_arr[1] =='flat'){

$coupen_type = 'flat';
$option_val='Flat ₹'.$st_coupon_arr[2].' OFF ';
$option_val_off=$st_coupon_arr[2].' OFF +';


}else{

$coupen_type = 'percent';
$option_val=$st_coupon_arr[2].'% OFF';
$option_val_off=$st_coupon_arr[2].'% +';

}
}  
?>


<?php 
 $t_percent_coupon =$trp_percent_coupon;
if(!empty($coupen_list)){

    foreach ($coupen_list as $key => $value) { 
  $coupen_type = '';
  if($value->charge_type==1){ 
    $t_percent_coupon ='';
    $coupen_type = 'flat';
    $option='Flat ₹'.$value->amount.' OFF ';

  }else{
    $t_percent_coupon =$trp_percent_coupon;
    $coupen_type = 'percent';
    $option=$value->amount.'% OFF';

  }
}

}




?>

<input type="hidden" id="storage_myselect" name="storage_myselect" value="<?php echo $t_percent_coupon;?>">
<input type="hidden" id="storage_myselect_new" name="storage_myselect_new" value="<?php echo $coupen_type;?>,<?php echo $storage_coupon_val;?>">





<input type="hidden" id="id_transport_coupon" name="transport_coupon" value="<?php echo $transport_coupon; ?>">

<input type="hidden" id="only_transport_myselect" name="only_transport_myselect" value="">

<input type="hidden" id="post_coupon_value" value="">


<style type="text/css">
    .submit_btn_class {
        width: 100% !important;
        background: #ef5921 !important;
        color: #fff !important;
        border: 1px solid #EF473A !important;
    }

    .title h2.ft-2rem {
        font-size: 2rem;
    }

    .cq-box {
        background: #FFFFFF;
        border: 1px solid #F05200;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.15);
        border-radius: 15px;
        transition: all 0.2s ease-in-out;
        margin-bottom: 30px;
        padding: 30px 30px 16px;
    }

    .cq-box:hover {
        background-color: #f3f9fbb3;
        cursor: pointer;
    }

    .w-110 {
        width: 110px;
    }

    .w-130 {
        width: 131px;
        /* margin-bottom: 17px; */
        margin-top: 21px;
    }

    .w-163 {
        width: 163px;
    }

    #SummaryModal .modal-header {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: flex-start;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: center;
        padding: 1rem;
        border-bottom: 0px solid #e9ecef;
        border-top-left-radius: 0.3rem;
        border-top-right-radius: 0.3rem;
        background: #031A5B;
        box-shadow: 0px 4px 8px rgb(0 0 0 / 8%);
        border-radius: 20px 20px 0px 0px;
        text-align: center;
        color: #fff;
    }

    #SummaryModal .close {
        position: absolute;
        float: right;
        top: 24px;
        right: 21px;
        font-size: 1rem;
        width: 47px;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-shadow: 0 1px 0 #fff;
        opacity: 1;
    }

    #SummaryModal .modal-content {
        border-radius: 20px;
    }

    .sm-content {
        border-bottom: 1px solid #D3D3D3;
        padding: 30px 18px;
    }

    .smb-curcle {
        width: 28px;
        height: 28px;
        background: #FFFFFF;
        border: 2px solid #F05200;
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #F05200;
        font-size: 20px;
    }

    .text-orange {
        color: #f05200;
    }

    #SummaryModal p {
        color: #2C2C2C;
        font-size: 19px;
    }

    .container-check {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .container-check input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
        display: none;
    }

    /* Create a custom checkbox */
    .container-check .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
        background: #FFFFFF;
        border: 0.5px solid #565656;
        box-shadow: 0px 4px 5px rgb(0 0 0 / 8%);
        border-radius: 2.5px;
    }

    /* On mouse-over, add a grey background color */
    .container-check:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container-check input:checked~.checkmark {
        background-color: #f05200;
        border-color: #F05200;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .container-check .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container-check input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container-check .checkmark:after {
        left: 9px;
        top: 4px;
        width: 6px;
        height: 12px;
        border: solid white;
        border-width: 0px 2px 2px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .sm-bottom {
        padding: 30px 18px;
    }

    .o-btn-outline {
        border-color: #f05200;
        background-color: transparent;
        color: #f05200 !important;
        border: 2px solid #f05200;
        color: #ced0d2;
        border-radius: 10px;
        padding: 7px 30px 8px;
        text-transform: uppercase;
        font-size: 15px;
    }

    .o-btn {
        border-color: #f05200;
        background-color: #f05200;
        color: #fff !important;
        border: 2px solid #f05200;
        color: #ced0d2;
        border-radius: 10px;
        padding: 7px 30px 8px;
        text-transform: uppercase;
        font-size: 15px;
    }

    @media only screen and (max-width: 590px) {

        #SummaryModal .h4,
        #SummaryModal h4 {
            font-size: 1.4rem;
        }

        #SummaryModal p {
            font-size: 16px;
        }

        .sm-content,
        .sm-bottom {
            padding: 15px 18px;
        }



    }

    #msform {
        text-align: center;
        position: relative;
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0px;
        box-sizing: border-box;

        /*stacking fieldsets above each other*/
        position: relative;
    }

    /*Hide all except first fieldset*/
    #msform fieldset:not(:first-of-type) {
        display: none;
    }

    /*inputs*/
    #msform input,
    #msform textarea,
    #msform select {
        padding: 8px 15px;
        border: 1px solid #ccc;
        border-radius: 0px;
        margin-bottom: 10px;
        width: 100%;
        box-sizing: border-box;
        /* font-family: montserrat; */
        color: #2C3E50;
        font-size: 17px;
        background: #FFFFFF;
        border: 0.15px solid #56565659;
        box-shadow: 0px 4px 5px rgb(0 0 0 / 8%);
        border-radius: 2.5px;
        color: #565656;
    }

    #msform input:focus,
    #msform textarea:focus,
    #msform select:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;

        border: 1px solid #f15b0e30;
        outline-width: 0;
        transition: All 0.5s ease-in;
        -webkit-transition: All 0.5s ease-in;
        -moz-transition: All 0.5s ease-in;
        -o-transition: All 0.5s ease-in;
    }

    /*buttons*/
    #msform .action-button {
        min-width: 124px;
        background: #ee0979;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 25px;
        cursor: pointer;
        padding: 10px 5px;
        border-color: #f05200;
        background-color: #f05200;
        color: #fff !important;
        border: 2px solid #f05200;
        color: #ced0d2;
        border-radius: 10px;
        padding: 7px 30px 8px;
        text-transform: inherit;
        font-size: 15px;
        width: auto;
        margin-top: 10px;
        float: right;
    }


    #msform .action-button-previous {
        width: 100px;
        */ background: #C5C5F1;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 25px;
        cursor: pointer;
        padding: 10px 5px;
        border-color: #f05200;
        background-color: transparent;
        color: #f05200 !important;
        border: 2px solid #f05200;
        color: #ced0d2;
        border-radius: 10px;
        padding: 7px 30px 8px;
        text-transform: uppercase;
        font-size: 15px;
        /* margin: 10px 5px; */
        width: auto;
        margin-top: 10px;
        float: left;

    }


    /*headings*/
    .fs-title {
        font-size: 24px;
        /* text-transform: uppercase; */
        color: #2C3E50;
        margin-bottom: 15px;
        text-align: left;
    }

    .fs-subtitle {
        font-weight: normal;
        font-size: 13px;
        color: #666;
        margin-bottom: 20px;
    }

    /*progressbar*/
    #progressbar {
        margin-bottom: 15px;
        overflow: hidden;
        /*CSS counters to number the steps*/
        counter-reset: step;
    }

    #progressbar li {
        list-style-type: none;
        color: white;
        text-transform: uppercase;
        font-size: 9px;
        width: 33.33%;
        float: left;
        position: relative;
        letter-spacing: 1px;
    }

    #progressbar li:before {
        content: counter(step);
        counter-increment: step;
        width: 24px;
        height: 24px;
        line-height: 26px;
        display: block;
        font-size: 12px;
        color: #333;
        background: white;
        border-radius: 25px;
        margin: 0 auto 10px auto;
        z-index: 1;
        position: relative;
        background: #FFFFFF;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #C5C5C5;
        border: 1px solid #959595;
        position: relative;
        z-index: 22;
    }

    /*progressbar connectors*/
    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: #959595;
        position: absolute;
        left: -50%;
        top: 9px;
        z-index: 0;
    }

    #progressbar li:first-child:after {
        /*connector not needed before the first step*/
        content: none;
    }

    /*marking active/completed steps green*/
    /*The number of the step and the connector before it = green*/
    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #F05200;
        color: white;
        border: 1px solid #F05200;
    }


    /* Not relevant to this form */
    .dme_link {
        margin-top: 30px;
        text-align: center;
    }

    .dme_link a {
        background: #FFF;
        font-weight: bold;
        color: #ee0979;
        border: 0 none;
        border-radius: 25px;
        cursor: pointer;
        padding: 5px 25px;
        font-size: 12px;
    }

    .dme_link a:hover,
    .dme_link a:focus {
        background: #C5C5F1;
        text-decoration: none;
    }

    .sd-box-cust {
        border: 1px solid #565656;
        border-radius: 10px;
        overflow: hidden;
    }

    .text-blue {
        color: #031A5B;
    }

    .sdb-pad {
        padding: 15px 20px;
    }

    .sd-box-cust .sdb-pad {
        border-bottom: 1px solid #DBDBDB;
    }

    .sd-box-cust .sdb-pad:last-child {
        border-bottom: 1px solid #DBDBDB;
        background: #ECECEC;
    }

    .round-btn-outline {
        cursor: pointer;
        padding: 10px 5px;
        border-color: #031A5B;
        background-color: transparent;
        color: #031A5B !important;
        border: 2px solid #031A5B;
        color: #ced0d2;
        border-radius: 10px;
        padding: 7px 15px 8px;
        text-transform: uppercase;
        font-size: 15px;
        /* margin: 10px 5px; */
        width: auto;
        margin-top: 10px;
        float: left;
    }

    #msform .nav {
        border: 1px solid #031A5B;
        border-radius: 50px;
        overflow: hidden;
    }

    #msform .nav-pills .nav-link {
        border-radius: 0rem;
        color: #031A5B;
    }

    #msform .nav-pills .nav-item {
        width: 25%;
        text-align: center;
    }

    #msform .nav-pills .nav-link.active,
    #msform .nav-pills .show>.nav-link {
        color: #fff !important;
        background-color: #031A5B;
        /* background-color: #007bff; */
    }

    #msform .mf-box-1 {
        background: #FFFFFF;
        border: 1px solid #959595;
        box-shadow: 0px 4px 5px rgba(0, 0, 0, 0.08);
        border-radius: 5px;
        overflow: hidden;
    }

    #msform .mfb-search {
        background: #ECECEC;
        border-radius: 4px 4px 0px 0px;
        padding: 8px 6px;
        position: relative;
    }

    #msform .mfb-search img {
        position: absolute;
        top: 16px;
        left: 19px;
        width: 19px;
    }

    #msform .mfb-search input {
        border-radius: 50px;
        border-color: transparent;
        box-shadow: none;
        padding-left: 48px;
        margin-bottom: 0px;
    }

    #msform .table thead th {
        vertical-align: bottom;
        border-bottom: 0px solid #dee2e6;
        background-color: #ececec;
        border-bottom-width: 0px;
        text-align: center;
        font-family: Archivo-Bold;
        font-weight: normal;
    }

    #msform .table-bordered td,
    #msform .table-bordered th {
        border: 1px solid #cfd4d9;
    }

    .mt-minus-12 {
        margin-top: -12px;
    }

    #msform .number {
        border: 1px solid #FFA87A;
        border-radius: 2.5px;
        overflow: hidden;
        width: 115px;
    }

    #msform .number .minus,
    #msform .number .plus {
        width: 29px;
        height: 29px;
        background: #f2f2f2;
        /* padding: 0px 5px 0px 5px; */
        border: 0px solid #ddd;
        display: inline-block;
        vertical-align: middle;
        text-align: center;
        background-color: #F05200;
        color: #fff;
        font-size: 24px;
        line-height: 25px;
        cursor: pointer;
    }

    #msform .number input {
        height: 29px;
        width: 46px;
        text-align: center;
        font-size: 18px;
        border: 0px solid #ddd;
        border-radius: 4px;
        display: inline-block;
        vertical-align: middle;
        margin-bottom: 0px;
        box-shadow: 0px !important;
        padding: 0px;
    }

    #msform .table td,
    #msform .table th {
        padding: 6px 10px;
        vertical-align: middle;
    }

    #msform .number.inactive {
        opacity: 0.4;
    }

    @media only screen and (max-width: 768px) {

        .step-form-custo-font p,
        #msform .action-button,
        #msform input,
        #msform textarea,
        #msform select,
        .step-form-custo-font label,
        #msform .action-button-previous,
        #msform .table thead th,
        #msform .table td,
        #msform .table th,
        .round-btn-outline {
            font-size: 14px;
        }

        .container-check {
            padding-left: 30px;
        }

        .container-check .checkmark {
            height: 21px;
            width: 21px;
        }

        .container-check .checkmark:after {
            left: 8px;
            top: 3px;
            width: 5px;
            height: 11px;
        }

        #msform .nav-link {
            padding: 6px 17px;
            font-size: 14px;
        }

        .m-truck {
            width: 100px;
        }

        #pills-tabContent h4 {

            font-size: 17px;

        }

        #msform .number .minus,
        #msform .number .plus {
            width: 24px;
            height: 24px;
            font-size: 18px;
            line-height: 22px;
        }

        #msform .number {
            width: 104px;
        }

        #msform .number input {
            height: 24px;
            width: 46px;
            font-size: 14px;
        }

        .fs-title {
            font-size: 18px;
            margin-bottom: 7px;
        }

        .sdb-pad {
            padding: 9px 13px;
            font-size: 14px;
        }
    }

    #SummaryModal p {
        font-size: 16px !important;
    }

    @media only screen and (max-width: 590px) {
        #SummaryModal p {
            font-size: 12px !important;
        }
    }

    .m-truck {
        width: 100px !important;
    }

    .pc-left-box {
        border-right: 1px solid #D9D9D9;
        padding: 10px 30px 10px 0px;
    }

    .pc-left-box input[type=radio] {
        accent-color: #FF0000;
        transform: scale(1.8);
        cursor: pointer;
        margin-top: 6px;
        height: 13px;
    }

    .r-box {

        border: 1px solid #031A5B;
        border-radius: 10px;
        padding: 9px 20px;
        min-width: 44%;
        margin-bottom: 18px;

    }

    .r-b-data {
        color: #031A5B;
        font-size: 18px;
        margin-left: 18px;
    }

    .r-b-data span {
        font-size: 12px;
    }

    .r-t-box {
        display: flex;
        justify-content: space-between;
    }

    .r-box-show1.active,
    .r-box-show2.active {
        background-color: #031A5B;
    }

    .r-box-show1.active .r-b-data,
    .r-box-show2.active .r-b-data {
        color: #fff !important;
    }

    .r-box-show1.active input[type=radio],
    .r-box-show2.active input[type=radio] {
        accent-color: #fff;
    }

    .text-red {
        color: red;
    }

    .ch-gap {

        height: 93px;

    }

    .original-cost {
        color: #D3D3D3;
    }

    .sd-text {
        color: #505050;
    }

    .sd-text input[type=radio] {
        accent-color: #031A5B;
        transform: scale(1.3);
        cursor: pointer;
    }

    .rc-fc {

        padding: 8px 97px 8px 20px;
        letter-spacing: 4px;
        width: 276px;
        font-size: 19px;

    }

    .ap-btn {
        cursor: pointer;
        position: absolute;
        right: 15px;
        top: 13px;
        color: #F05200;
    }

    .m-ft-20 {
        font-size: 20px;
        color: #505050;
    }

    .td-m p {
        color: #777777 !important;
    }

    .bg-orange {
        background-color: #F05200 !important;
        color: #fff;
    }

    @media only screen and (max-width: 992px) {
        .pc-left-box {
            border-right: 0px solid #D9D9D9;
            padding: 10px 10px 10px 0px;
        }

        .ch-gap {
            height: 0px;
        }
    }

    @media only screen and (max-width: 768px) {
        .r-t-box {
            display: block;

        }

        .r-box {
            width: 280px;
        }

        .m-d-flex {
            display: flex;
            justify-content: space-between;
        }

        .m-ft-20 {
            font-size: 15px;
        }

        .m-sd-box-m {
            margin-left: -44px;
        }
    }

    input[type="radio"] {
        display: block !important;
    }
</style>

<div class="bg-white">
    <div class="sec-pad hero-sec step-form-custo-font ">

        <div class="container">

               <div class="button-row d-flex mt-4">
                  <b><span style="color: green;font-size: 16px;">
Your quotation has been successfully created. Kindly review your email inbox or spam folder for further details.</span></b>
               </div>

          


            <!--   <div class="col-12 mb-4">
               <div class="text-left">
                  <a href="javascript:void(0)" onclick="step3()" class="btn btn-orange-line js-btn-next semi-bold back4" title="back"><i class="fa fa-angle-left mr-4"></i>Back</a>
               </div>   
            </div> -->


            <div class="row d-flex justify-content-center  mt-4">
                <div class="col-lg-6">
                    <?php 
                       $slug_array=[];
                       foreach ($storage_item_qty as $key => $value2) {
                            array_push($slug_array,$key);
                      }

                 ?>

                    <div class="pc-left-box">
                        <h2 class="fs-title bold text-blue">Transport Charges</h2>
                        <div class="r-t-box">
                            <div class="d-inline-flex me-3 r-box r-box-show1 active" onclick="show1();">
                                <input type="radio" name="pickup_type" class="me-3 select_transport" value="pickup" checked="" id="firstchecked" />
                                <div class="r-b-data bold">Inventory Transport <br><span> </span></div>
                            </div>


                            <div class="d-inline-flex  me-3 r-box r-box-show2" onclick="show2();"><input type="radio" class="me-3 select_transport" name="pickup_type" value="warehouse_arrival" id="secondchecked" />
                                <div class="r-b-data bold">Own Transport <br><span> </span></div>
                            </div>

                        </div>
                        <div id="div1">
                 
                            <p><small>*These charges are including Packing + Labour + Vehicle.</small></p>
                            <div class="sd-box-cust" style="margin-top:9%">
                                <div class="d-flex justify-content-between sdb-pad">
                                    <div>Amount Quoted</div>
                                    <div class="text-blue">USD $<?php echo number_format(@$total_pickup_charges * 0.012, 2); ?></div>
                                    </div>
                                <div class="d-flex justify-content-between sdb-pad">
                                    <div id="trp_percent_msg"> </div>
                                    <div class="text-red">-USD $ <span id="discount_amt"> </span></div>
                                </div>
                                <div class="d-flex justify-content-between sdb-pad">
                                    <div>Total Amount Payable</div>
                                    <div class="text-blue">USD $ <span id="transport_charges_show"> </span></div>
                                </div>

                                <div class="d-flex justify-content-between sdb-pad align-items-center">
                                    <div>Pay Token Amount (Advance) </div>
                                    <div class="text-blue">(USD $<span id="transport_token_show"><?php echo $quotation_data->transport_token_amt; ;?></span>)</div>
                                </div>
                            </div>
                        </div>
                        <div id="div2" class="d-none">
                            <p><small>*All items must be packed with storage standards(3 layer),otherwise packing consumables and packers charges applicable. Refer to Ratecard for packing charges and packing helper charges would be shared at the warehouse.</small></p>
                            <div class="sd-box-cust" style="margin-top:9%">
                                <!--  <div class="d-flex justify-content-between sdb-pad">
                                    <div>Amount Quoted</div>
                                    <div class="text-blue">₹ 500/-</div>
                                </div> -->
                                <div class="d-flex justify-content-between sdb-pad">
                                    <div>Total Amount Payable</div>
                                    <div class="text-blue">USD $ 6</div>
                                </div>

                                <div class="d-flex justify-content-between sdb-pad align-items-center">
                                    <div>Pay Token Amount (Advance)</div>
                                    <div class="text-blue">USD $ 6</div>
                                </div>
                            </div>
                            <p class="mt-4"><small>*Token advance will be adjusted in Monthly Storage charges.</small></p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="pc-right-box">
                         <h2 class="fs-title bold text-blue mt-4 mt-lg-0"> Select moving date</h2>

                        <!-- -->
                        <div style="height:87px">

                            <input type="date" name="movingdate" class="grc-fc" id="pickup_new_dates"  placeholder="Select Moving Date">

                            <span style="color: red" id="date_err"></span>
                            <h6 style="color: #0398fc; font-weight: bold; font-size: 1em;" class="pt-2">
    🚨 Hurry Up! Only <span style="color: #0398fc;">2 Slots Left</span>! ⏳
</h6>





                        </div>

                         <h2 class="fs-title bold text-blue mt-4 mt-lg-0 pt-2">Storage Charges</h2>
                       <div class="sd-box-cust mt-4">
                            <div class="d-flex  sdb-pad sd-text">
                                <input type="radio" name="tab1" id="" class="me-3" value="month"   checked=""  />
                                <?php
$inr_to_usd_rate = 0.012; // Set your exchange rate

// Check if $monthly_storage_charges is numeric; if not, default to 0
$monthly_storage_charges_numeric = is_numeric(@$monthly_storage_charges) ? @$monthly_storage_charges : 0;
$monthly_storage_charges_usd = $monthly_storage_charges_numeric * $inr_to_usd_rate;

// Check if $option_val is numeric; if not, default to 0
$option_val_numeric = is_numeric(@$option_val) ? @$option_val : 0;
$option_val_usd = $option_val_numeric * $inr_to_usd_rate;
?>

<div class="ml-3">
    <s class="original-cost" id="monthly_old">₹ <?php echo number_format($monthly_storage_charges_numeric, 2).'/- '; ?></s>
    USD $<?php echo number_format($monthly_storage_charges_usd, 2); ?> 
    Monthly <span class="text-orange"> (<?php echo @$option_val;?>Inclusive 18% GST)</span>
</div>
                            </div>

                            <?php
$inr_to_usd_rate = 0.012; // Set your exchange rate

// Convert six-month payable amount
$six_month_payable_amount_numeric = is_numeric(@$six_month_payable_amount) ? @$six_month_payable_amount : 0;
$six_month_payable_amount_usd = $six_month_payable_amount_numeric * $inr_to_usd_rate;

// Convert yearly payable amount
$yearly_payable_amount_numeric = is_numeric(@$yearly_payable_amount) ? @$yearly_payable_amount : 0;
$yearly_payable_amount_usd = $yearly_payable_amount_numeric * $inr_to_usd_rate;

// Convert option value off if it's also a monetary value
$option_val_off_numeric = is_numeric(@$option_val_off) ? @$option_val_off : 0;
$option_val_off_usd = $option_val_off_numeric * $inr_to_usd_rate;
?>

<div class="d-flex sdb-pad sd-text">
    <input type="radio" name="tab1" id="" class="me-3" value="month6" />
    <div class="ml-3">
        <s class="original-cost" id="half_year_old">₹ <?php echo number_format($six_month_payable_amount_numeric, 2).'/- '; ?></s> 
        USD $<?php echo number_format($six_month_payable_amount_usd, 2); ?> 
        6 Months 
        <span class="text-orange">(<?php echo $option_val_off; ?> 10% Discount)</span>
    </div>
</div>

<div class="d-flex sdb-pad sd-text">
    <input type="radio" name="tab1" id="" class="me-3" value="month12" />
    <div class="ml-3">
        <s class="original-cost" id="yearly_old">₹ <?php echo number_format($yearly_payable_amount_numeric, 2).'/- '; ?></s> 
        USD $<?php echo number_format($yearly_payable_amount_usd, 2); ?> 
        12 Months  
        <span class="text-orange">(<?php echo $option_val_off; ?> 20% Discount)</span>
    </div>
</div>

                            
                            <div class="d-flex justify-content-between sdb-pad align-items-center pt-1 pb-2">
                                <div>* Cancel before 48 hours to avail full refunds.</div>
                                <!-- <div><button class="btn round-btn-outline medium mt-1" data-toggle="modal" data-target="#SummaryModal" onclick="clicksummery()">View Summary</button></div> -->
                            </div>
                        </div>
                    </div>


                </div>


            <div class="col-12 text-center mt-4">

                

                <div class="text-center mt-4">
                    <?php
                          $url_parts = parse_url(current_url());
                          $terms_url_link = str_replace('www.', '', $url_parts['host']); ?>
                    <input required="" type="checkbox" id="is_terms_condition" name="is_terms_condition" value="1" checked> I agree with <a target="_blank" style="color: #007bff;">terms & conditions</a> of Inventory
                </div>

                <div class="m-d-flex mt-4">
                    <button name="previous" onclick="step3()" class="previous action-button-previous btn o-btn-outline ml-0 ml-md-3 mr-3"><img src="https://safestorage.in/assets/new_design_css/img/arrow-sd.svg" class="img-fluid mr-3" alt="icon"> Previous</button>
                    <button name="submit" onclick="redirectToPaymentPage(event)" class="action-button btn o-btn ml-3 mr-0 mr-md-3">
    Submit
</button>
                    </div>

                

            </div>




                <!--  <div class="col-12 mt-4 mt-md-5 justify-content-center">
                
                    <h2 class="fs-title bold text-blue mt-4 mt-lg-0">Book Slot</h2>
                    
               
                <div id="pickup_new_dates" autofocus></div>
            </div> -->
                <div class="col-12  mt-4 mt-md-5">
                    <p class="mb-1">Referral/Coupon Code</p>
                    <div class="position-relative d-inline-block mb-2">
                        <input type="text" class="rc-fc" name="" value="" placeholder="2eb56fce" id="referall_id">
                        <div class="ap-btn bold" onclick="checkreferral()">APPLY</div>
                    </div>



                    <p><small class="error_refer" style="color: red;font-size: 16px;"> </small></p>


                   <p> <small style="color: green;font-size: 16px;" id="referaal_msg" class="referaal_msg"> </small> </p>

                   <p> <small style="color: green;font-size: 16px;" id="referaal_msg_text" class="referaal_msg_text"> </small> </p>




                    <p><small class="text-primary"><a onclick='window.open("<?php echo base_url();?>refer-and-earn");return false;'><i>Click here to know how referral code work?</i></a></small></p>
                </div>



            </div>

        </div>
    </div>

</div>

<!-- <div class="ap-step" style="background:white">
<div class="sec-pad">
  
  <div class="container">
     <div class="row d-flex justify-content-center">
        <div class="col-md-12 col-lg-10">
         
           <div class="content">
             
              <div class="content__inner">
                 <div class=" overflow-hidden">
                

                   
                     <form class="multisteps-form__form" method="post">
                       
                        <div class="multisteps-form__panel shadow pt-4   js-active" data-animation="scaleIn">
                           <div class="option-box">
                              <div class="row">
                                  <div class="col-md-3"></div>
                                  <div class="col-md-6">
                                      <div class="row">
                                        <div style="text-align: center;" class="col-md-12">
                                          <label><h4><strong class="info">Make Storage Payment</strong></h4></label>
                                        </div>
                                      </div>  
                                      <div class="row">
                                        <div class="col-md-12">
                                          <input type="text" class="form-control" placeholder="Enter your Email or Mobile no" id="email_mobile_field" name="">
                                        </div>
                                      </div>  
                                      <div class="row">
                                        <div style="text-align: center;" class="col-md-12">
                                          <span class="error_refer"></span>
                                          <br/>
                                        </div>
                                      </div>  
                                      <div class="row">
                                        <div class="col-md-12">
                                          <button type="submit" id="accept_input_btn" class="btn btn-info submit_btn_class">Submit</button>
                                        </div>
                                      </div>  
                                  </div>
                                  <div class="col-md-3"></div>
                                </div>    
                              </div>
                          </div>
                        </form>  
                             
                    </div>
                 </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div> -->


<div class="modal" id="myModaldate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Book Slot </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive-sm">
                    <div class="multisteps-form__panel shadow pt-4 js-active" data-animation="scaleIn">
                        <div class="option-box">
                            <div class="row">
                                <div class="col-md-12">
                                    <span style="color: red" id="date_err"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row" style="margin-bottom: 2px">
                                        <div class="col-md-12 col-lg-12">
                                            <!--   <div id="pickup_new_dates" autofocus></div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr />
                                </div>
                            </div>
                            <div class="row">
                                <div style="font-size: 16px;text-align: center;" class="col-md-12">
                                    <?php
                          $url_parts = parse_url(current_url());
                          $terms_url_link = str_replace('www.', '', $url_parts['host']); ?>
                                    <input required="" type="checkbox" id="is_terms_condition" name="is_terms_condition" value="1"> I agree with <a target="_blank" style="color: #007bff;" href="https://drive.google.com/file/d/1xl6i99KSUiPfE5P-09P0hfKmqWFRbgff/view?usp=sharing">terms & conditions</a> of Inventory
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="text-align: center;background: #fbf1a0;">
                                    Cancel before 24 hours to avail full refunds.
                                </div>
                            </div>

                            <div class="row">
                                <div style="text-align: center;" class="col-md-12">
                                    <span style="color: red;" id="agreement_err"></span>
                                </div>
                            </div>
                            <div style="margin-top: 7px;" class="row">
                                <div class="col-md-12 col-lg-12 text-center">

                                    <button type="submit" class="btn btn-orange ml-auto js-btn-next popup_submit_btn" onclick="submit()" style="color: white;">Submit</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SummaryModal -->
<div class="modal fade" id="SummaryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Summary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="https://safestorage.in/assets/front_new/img/create-quotation/close.svg" class="img-fluid">
                </button>
            </div>
            <div class="modal-body p-0">
               <div id="downloadsummary"> 
                <div class="sm-content">
                    <div class="media">
                        <div class="smb-curcle">1</div>
                        <div class="media-body ml-3">
                            <h4 class="bold text-orange">Transportation Details</h4>
                            <div class="row td-m">
                                <div class="col-md-6 col-6">
                                    <div class="bold m-ft-20">Name</div>
                                    <p><small><?php echo @$customer_data->customer_name; ?></small></p>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="bold m-ft-20">Pickup Address</div>
                                    <p><small><?php echo @$customer_data->pickup_address; ?></small></p>
                                </div>

                                <div class="col-md-6 col-6">
                                    <div class="bold m-ft-20">Mobile Number</div>
                                    <p><small><a href="tel:+91 <?php echo @$customer_data->customer_contact1; ?>">+91 <?php echo @$customer_data->customer_contact1; ?></a></small></p>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="bold m-ft-20">House Type</div>
                                    <p><small style="text-transform:uppercase;"><?php echo @$hometype; ?></small></p>
                                </div>

                                <div class="col-md-6 col-6">
                                    <div class="bold m-ft-20">Floor No</div>
                                    <p><small><?php echo @$customer_data->pickup_floor; ?></small></p>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="bold m-ft-20">Service Lift</div>
                                    <p><small style="text-transform:uppercase;"> <?php echo @$customer_data->pickup_lift; ?> </small></p>
                                </div>


                                <div class="col-md-6 col-6">
                                    <div class="bold m-ft-20">Email Address</div>
                                    <p><small><a href="mailto:<?php echo @$customer_data->customer_email;?>"><?php echo @$customer_data->customer_email;?></a></small></p>
                                </div>
                                <div class="col-md-6 col-6">
                                    <div class="bold m-ft-20">City</div>
                                    <p><small><?php echo @$customer_data->customer_local_city; ?></small></p>
                                </div>


                                <div class="col-md-6 col-12">
                                    <div class="bold m-ft-20">Slot Booking Date</div>
                                    <p><small> <span id="booking_date"></span></small></p>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="sm-content">
                    <div class="media">
                        <div class="smb-curcle">2</div>
                        <div class="media-body ml-3">
                            <h4 class="bold text-orange">Charges Details</h4>
                            <div class="row d-flex justify-content-center">
                                <div class="col-12 col-md-12 col-lg-10">
                                    <div class="sd-box-cust mt-4 m-sd-box-m">
                                        <div class="d-flex justify-content-between sdb-pad">
                                            <div>Transport Charges</div>
                                            <div class="text-blue">₹ <span class="transport_tokn_amt_new"> 1000.00 /- </span> </div>
                                        </div>
                                        <div class="d-flex justify-content-between sdb-pad">
                                            <div>Storage Charges <span class="for_month"> </span></div>
                                            <div class="text-blue">₹ <span class="for_charges"> </span></div>
                                        </div>
                                        <div class="d-flex justify-content-between sdb-pad">
                                            <div>Total Charges</div>
                                            <div class="text-blue">₹ <span class="total_charges_all"> </span></div>
                                        </div>
                                        <div class="d-flex justify-content-between sdb-pad">
                                            <div>Advance Token Payable</div>
                                            <div class="text-blue">₹ <span class="transport_tokn_amt"> 1000.00 /- </span></div>
                                        </div>

                                        <div class="d-flex justify-content-between bg-orange sdb-pad align-items-center">
                                            <div>Total Remaining Amount</div>
                                            <div class="">₹ <span class="remaining_amount"> </span>/-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
              </div>


                <div class="sm-bottom">

                    <div class="f-btn-cust text-center text-md-right ">
                        <button style="" class="btn o-btn-outline mr-3 medium mb-2 mb-md-0" onclick="downloadsummary()">Download Summary</button>
                        <button style="" class="btn o-btn medium" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- SummaryModal -->
<div class="modal fade" id="autodebitmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Auto Debit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="https://safestorage.in/assets/front_new/img/create-quotation/close.svg" class="img-fluid">
                </button>
            </div>
            <div class="modal-body p-0">

<div class="card-body">

        <div class="card-title"><h2><b style="color:#021a47"> Inventory (Auto Pay)</b> </h2></div>
        <p> <b>Note:</b>  Payment may take up to 24 hours to reflect,your money is safe with us. </p>
        <p> <strong> I Authorise to Auto-debit my rental amount every months via selected payment mode</strong></p>

         <p><strong>Auto Debit Benifits</strong></p>

    <ul style="list-style-type: none; padding: 0; margin: 0; text-align: left;">
        <li> <b style="color:green">✓ </b> Avoid late fees on your monthly rental</li>
        <li><b style="color:green"> ✓</b> Stop stressing about missing your rental payment</li>
        <li><b style="color:green">✓</b> Enjoy hassle-free payments</li>
        <li><b style="color:green">✓</b> Choose Auto Debit for a seamless payment experience</li>
        <li><b style="color:green">✓</b> Payment options: Credit card, Debit card, UPI</li>
    </ul>


       <!--  <div class=""><img src="<?php echo base_url();?>assets/payment/razorpay-image.png" width="90%"></div> --> 
       <input type="hidden" id="set-time" value="5"/>
       <div class="card-title"><div id='tiles' class="color-full"></div></div> 

       
    </div>







                <div class="sm-bottom">

                    <div class="f-btn-cust text-center text-md-right ">
                        <button style="" class="btn o-btn-outline mr-3 medium mb-2 mb-md-0" onclick="downloadsummary()">Pay with Phone Pay</button>
                        <button style="" class="btn o-btn medium" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<input type="hidden" id="trp_paid_amt">



<form action="<?php echo base_url();?>customer/due_payment_details" id="post_form" method="post">
    <input type="hidden" id="post_parameter" name="url_id">
</form>

<script type="text/javascript">
    function Disable_Dates(date) {

    var date_arr =[];
    <?php
        if(!empty($disabled_date_arr)){

            foreach ($disabled_date_arr as $key => $dates) {
        ?>
            date_arr.push("<?php echo $dates = date('d/m/Y',strtotime($dates));?>");
        <?php            

            }
        }
 
    ?>
    
    var string = jQuery.datepicker.formatDate('dd/mm/yy', date);
    return [date_arr.indexOf(string) == -1];
}

    function Arrival_Disabled_Dates_arr(date) {

    var date_arr =[];
    <?php
        if(!empty($arrival_disabled_date_arr)){

            foreach ($arrival_disabled_date_arr as $key => $dates) {
        ?>
            date_arr.push("<?php echo $dates = date('d/m/Y',strtotime($dates));?>");
        <?php            

            }
        }
 
    ?>
    
    var string = jQuery.datepicker.formatDate('dd/mm/yy', date);
    return [date_arr.indexOf(string) == -1];
}

    $(document).ready(function() {


        $('#pickup_new_dates').on('keydown', function(e) {
            if (e.key === '/' || e.key === 'Backspace' || e.key === 'Tab') {
                return true;
            }
            if (e.key.length === 1 && !/^\d$/.test(e.key)) {
                e.preventDefault();
                return false;
            }
        });



        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
        var tomorrow = new Date();
        tomorrow.setDate(new Date().getDate() + 1);
        //   $("#pickup_new_dates").datepicker({ 
        //        minDate: 0,
        //        startDate: tomorrow,
        //         format:'dd/mm/yyyy',
        //         beforeShowDay: Disable_Dates,
        //        autoclose: true,
        //   });
        // })



        $('#pickup_new_dates').datepicker({
            showButtonPanel: false,
            dateFormat: 'dd/mm/yy',
            minDate: tomorrow,
            startDate: tomorrow,
            beforeShowDay: Disable_Dates,
            autoclose: true,

        });
    })


    $(document).on("click", "#accept_input_btn", function(e) {

        e.preventDefault();

        var email_mobile_field = $("#email_mobile_field").val();

        if (email_mobile_field == '') {

            $(".error_refer").html("<span style='color:red;font-size: 16px;'>Please enter email or phone number</span>");
            setTimeout(function() {
                $(".error_refer").html("");
            }, 3000);

        } else {

            $.ajax({

                url: '<?php echo base_url()?>customer/check_customer_data',
                type: 'POST',
                data: {
                    'email_mobile_field': email_mobile_field
                },
                success: function(response) {
                    var json_obj = jQuery.parseJSON(response);

                    if (json_obj.status == 'success') {

                        /* $('#myModaldate').modal('show');
                         $('#popover_id').val(json_obj.id);*/

                        $("#post_parameter").val(json_obj.id);

                        setTimeout(function() {
                            $("#post_form").submit();
                        }, 1000);

                        /*if(json_obj.is_email_notification !=''){

                          $("#otp_error").html("<span style='color:green;font-size: 16px;'>OTP has been sent to email</span>");
                        }else{

                          $("#otp_error").html(`<span style='color:green;font-size: 16px;'>OTP has been sent to mobile *********${json_obj.mobile_no}`);
                        }*/

                    } else {

                        $(".error_refer").html("<span style='color:red;font-size: 16px;'>Customer data not found</span>");
                        setTimeout(function() {
                            $(".error_refer").html("");
                        }, 3000);

                    }
                }

            });
        }
    });

    $(document).on("click", "#verify_otp_btn", function(e) {

        e.preventDefault();

        let popover_id = $("#popover_id").val();
        let user_otp = $("#user_otp").val();

        if (user_otp == '') {

            $("#otp_error").html("<span style='color:red;font-size:16px;'>Please enter otp</span>");
            setTimeout(function() {
                $("#otp_error").html("");
            }, 3000);

            return false;

        } else {

            $.ajax({

                url: '<?php echo base_url()?>customer/verify_otp_data',
                type: 'POST',
                data: {
                    'user_otp': user_otp,
                    'popover_id': popover_id
                },
                success: function(response) {
                    let json_obj = jQuery.parseJSON(response);

                    if (json_obj.status == 'success') {

                        $("#otp_error").html("<span style='color:green;font-size: 16px;'>Verification done sucessfully</span>");

                        $("#post_parameter").val(json_obj.id);

                        setTimeout(function() {

                            $("#post_form").submit();

                        }, 1000);

                    } else {

                        $("#otp_error").html("<span style='color:red;font-size: 16px;'>Oops! something went wrong,check otp</span>");
                        setTimeout(function() {
                            $("#otp_error").html("");
                        }, 3000);

                    }
                }

            });
        }
    });
</script>



<script type="text/javascript">
    $(document).ready(function() {




        do_transport_coupon_referel_calcualtion();

        $("#pickup_new_dates").on("change", function() {
            var selected = $(this).val();
            $("#set_date").val(selected);
        });
    });



    jQuery(".select_transport").change(function() {

        console.log(this.value);
        if (this.value == 'pickup') {

            // $("#transport_token_amt").val(1000);

            


        } else if (this.value == 'warehouse_arrival') {
           
        }

        $(".radio-border-box").removeClass("radio-active");
        if ($(this).is(':checked')) {
            $(this).closest(".radio-border-box").addClass("radio-active");
        } else
            $(this).closest(".radio-border-box").removeClass("radio-active");
    });


    jQuery(".me-3").change(function() {



        var yearly_new_price = $("#yearly_new_price").val();
        var half_year_new_price = $("#half_year_new_price").val();
        var monthly_new_price = $("#monthly_new_price").val();

        if (this.value == 'month') {
            $(".for_month").html('(For Month)');
            $('.for_charges').html(monthly_new_price + "/-");
        } else if (this.value == 'month6') {
            $(".for_month").html('(For 6 Month)');
            $('.for_charges').html(half_year_new_price + "/-");

        } else if (this.value == 'month12') {
            $(".for_month").html('(For Year)');
            $('.for_charges').html(yearly_new_price + "/");

        }


    });


    $(document).on('change', '#storage_myselect_new', function(e) {

        e.preventDefault();

        // do_transport_coupon_referel_calcualtion();

    });


    function do_transport_coupon_referel_calcualtion(referal_data = null) {

        var is_trp_percent = $("#storage_myselect").val();

        $("#only_transport_myselect").val(is_trp_percent);

        var storage_coupon_str = $("#storage_myselect_new").val();
        var only_transport_myselect = is_trp_percent;

        console.log(is_trp_percent);
        console.log(storage_coupon_str);

        var coupen = '<?php echo $coupen_code;?>';

        var msg_coupon_type = '';
        var msg_coupon_amt = 0;

        var newtrnasport_amount = 0;
        var total_pickup_charges = $("#post_total_pickup_charges").val();

        var referal_amount = 0;
        var coupen_amount = 0;

        if (storage_coupon_str != '') {

            var numbersArray = storage_coupon_str.split(',');

            var type = numbersArray[0];
            var amount = numbersArray[1];

            msg_coupon_type = numbersArray[0];
            msg_coupon_amt = numbersArray[1];

            if (type == 'flat') {

                coupen_amount = amount;

            } else {

                if (only_transport_myselect != '' && only_transport_myselect != null) {

                    amount = only_transport_myselect;
                }
                coupen_amount = (parseFloat(amount) / parseFloat(100)) * (parseFloat(total_pickup_charges));
            }

        }




        if (only_transport_myselect != '' && only_transport_myselect != null) {
            $("#trp_percent_msg").html(`&nbsp;(${only_transport_myselect}% discount)`);
        } else {
            $("#trp_percent_msg").html('');
        }

        if (coupen_amount > 1) {

            $("#transport_charges_old").css('text-decoration', 'line-through');
            $('#transport_charges_show').show();
        }

        if (referal_amount > 1) {

            $("#transport_charges_old").css('text-decoration', 'line-through');
            $('#transport_charges_show').show();
        }

        newtrnasport_amount = parseFloat(total_pickup_charges) - (parseFloat(coupen_amount) + parseFloat(referal_amount));

        var discount_amount = (parseFloat(coupen_amount) + parseFloat(referal_amount));

        var tokennew = (0.10 * newtrnasport_amount);

        var selected_home_type = $("#selected_home_type").val();
        tokennew=1000;
        // if (selected_home_type == '1rk') {
        //     tokennew = 1000;
        // } else if (selected_home_type == '1bhk') {
        //     tokennew = 1000;
        // } else if (selected_home_type == '2bhk') {
        //     tokennew = 2000;
        // } else if (selected_home_type == '3bhk') {
        //     tokennew = 3000;
        // } else {
        //     tokennew = 3000;
        // }

        /*red coloured text*/

        /*$("#datevalue").val(tokennew);*/
      // Exchange rate for INR to USD
const inrToUsdRate = 0.012;

// Converting and displaying amounts in USD
$('#transport_tokn_amt').html((tokennew * inrToUsdRate).toFixed(2));
$("#transport_token_amt").val((tokennew * inrToUsdRate).toFixed(2));
$('#transport_charges_show').html((newtrnasport_amount * inrToUsdRate).toFixed(2));
$('#discount_amt').html((discount_amount * inrToUsdRate).toFixed(2));
$('#transport_token_show').html((tokennew * inrToUsdRate).toFixed(2));
$('#trp_paid_amt').val((tokennew * inrToUsdRate).toFixed(2));
$('#total_pickup_charges').val((newtrnasport_amount * inrToUsdRate).toFixed(2));

        var msg_coupon_text = '0%';
        if (msg_coupon_type == 'flat') {
            msg_coupon_text = 'Flat ' + msg_coupon_amt + " OFF";
        } else {
            msg_coupon_text = msg_coupon_amt + "% OFF";
        }
        $("#coupon_applied_msg").html(msg_coupon_text + " coupon has been applied.");
        /*for storage*/

        var monthly_storage_charges = '<?php echo $quotation_data->total_storage_charges;?>';

        let storage_multi_factor = 1;
        if ($("#storage_multi_factor").val() != '') {
            storage_multi_factor = $("#storage_multi_factor").val();
        }
        var storage_charges_without_gst = parseFloat(monthly_storage_charges) * parseFloat(storage_multi_factor);

        var gst_amt = parseFloat(storage_charges_without_gst) * parseFloat(0.18);

        //var gst_amt = 0;

        var unformated_amt = parseFloat(storage_charges_without_gst) + parseFloat(gst_amt);

        var storage_charges_inc_gst = Math.round(parseFloat(unformated_amt).toFixed(2));

        if (storage_coupon_str != '') {

            var numbersArray = storage_coupon_str.split(',');

            var type = numbersArray[0];
            var amount = numbersArray[1];

            if (type == 'flat') {

                storage_coupon_amount = amount;

            } else {

                storage_coupon_amount = (parseFloat(amount) / parseFloat(100)) * (parseFloat(storage_charges_inc_gst));
            }

            var monthly_discounted_amt = Math.round(parseFloat(storage_charges_inc_gst) - parseFloat(storage_coupon_amount));

            /*storage_charges_inc_gst= parseFloat(storage_charges_without_gst) + parseFloat(storage_charges_inc_gst);*/

            $("#monthly_old").css('text-decoration', 'line-through');
            $("#monthly_new").html(monthly_discounted_amt + '/-');

            $("#monthly_new_price").val(monthly_discounted_amt);

            $(".for_month").html('(For Month)');
            $('.for_charges').html(monthly_discounted_amt);




            $("#half_year_old").html(Math.round(parseFloat(monthly_discounted_amt) * parseFloat(6)) + '/-');
            var month6 = monthly_discounted_amt - ((10 / 100) * monthly_discounted_amt);
            var six_month_amt = (month6 * 6).toFixed(2);

            $("#half_year_old").css('text-decoration', 'line-through');
            $("#half_year_new").html(Math.round(six_month_amt) + '/-');

            $("#half_year_new_price").val(Math.round(six_month_amt));


            //  $("#half_year_new_summary").html(Math.round(six_month_amt)+'/-');




            $("#yearly_old").html(Math.round(parseFloat(monthly_discounted_amt) * parseFloat(12)) + '/-');
            var month12 = monthly_discounted_amt - ((20 / 100) * monthly_discounted_amt);
            var yearly_amt = (month12 * 12).toFixed(2);
            $("#yearly_old").css('text-decoration', 'line-through');
            $("#yearly_new").html(Math.round(yearly_amt) + '/-');

            $("#yearly_new_price").val(Math.round(yearly_amt));


            var input_coupon_code = coupen + '-' + type + '-' + amount;
            $("#post_coupon_value").val(input_coupon_code);

        }


        tokennew = tokennew.toFixed(2);

        var transport = '<?php echo $quotation_data->transport_type;?>';
        if (transport == 'warehouse_arrival') {
            tokennew = 500;
        }

        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
        var tomorrow = new Date();
        tomorrow.setDate(new Date().getDate() + 1);

        /* $("#pickup_new_dates").datepicker("destroy");
    $('#pickup_new_dates').datepicker({
          minDate: 0,
       startDate: tomorrow,

          format:'dd/mm/yyyy',
        autoclose: true,
    });
*/
        return true;
    }


    function book_slot_fun() {

        var pickup_type = $('input[name="pickup_type"]:checked').val();

        if (pickup_type == undefined || pickup_type == '') {

            $("#select_trp_err").html('Please select Transport..!');
            setTimeout(function() {
                $("#select_trp_err").html('');
            }, 2000);
            return false;
        } else {

            if (pickup_type == 'pickup') {

                $("#pickup_new_dates").datepicker("destroy");
                $('#pickup_new_dates').datepicker({
                    showButtonPanel: false,
                    minDate: 0,
                    beforeShowDay: Disable_Dates,
                });
            } else {

                $("#pickup_new_dates").datepicker("destroy");
                $('#pickup_new_dates').datepicker({
                    showButtonPanel: false,
                    minDate: 0,
                    beforeShowDay: Arrival_Disabled_Dates_arr,
                });
            }

            $('#myModaldate').modal('show');
        }
    }

    function checkreferral() {

        var customer_id = $("#customer_id").val();

        var referall_id=$("#referall_id").val();


        if(referall_id==''){
                $(".error_refer").show();
                $(".error_refer").html("Please enter correct Referral code.");
                setTimeout(function() {
                $(".error_refer").hide();
                }, 10000);
            return;
        }

        $.ajax({

            url: '<?php echo base_url()?>customer/check_referal_code',
            type: 'POST',
            data: {
                'referral_id': $("#referall_id").val(),
                'customer_id': customer_id
            },
            success: function(response) {
                if (response == 'success') {

                    $(".referaal_msg").show();
                    $(".referaal_msg_text").show();


                    
                    $("#referaal_msg").html("Referral Coupen Applied succefully");
                    $("#referaal_msg_text").html("The referral amount will be credited to your storage wallet after you make your first storage payment.");
                    

                      setTimeout(function() {
                        $(".referaal_msg").hide();
                    }, 10000);


                   /*
                    setTimeout(function() {
                        $('#myModal_referall').modal('hide');
                        $(".referaal_msg").hide();
                    }, 3000);*/

                } else {

                    $("#referall_id").val('');

                    $(".error_refer").show();
                    $(".error_refer").html("Referral is incorrect");
                    setTimeout(function() {
                        $(".error_refer").hide();
                    }, 10000);

                }
            }

        });
    }

    function submit() {

        var set_date = $("#set_date").val();

        if (set_date != null && set_date != undefined && set_date != '') {


        } else {

            $('#pickup_new_dates').focus();

            $('#pickup_new_dates').addClass('haserrors');
            $("#date_err").html('* Please select pickup date');
            setTimeout(function() {
                $("#date_err").html('');
            }, 5000);
            return false;
        }

        if ($('#is_terms_condition').is(":checked")) {

            history.pushState(null, '', '<?php echo base_url();?>customer/create-quotation');
            var pickup_type = $('input[name="pickup_type"]:checked').val();
            var transport = '<?php echo $quotation_data->transport_type;?>';

            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?php echo base_url();?>customer/savedata';
            const hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';
            hiddenField.name = 'date';
            hiddenField.value = set_date;
            form.appendChild(hiddenField);

            const hiddenField1 = document.createElement('input');
            hiddenField1.type = 'hidden';
            hiddenField1.name = 'customer_id';
            hiddenField1.value = '<?php echo $customer_id;?>';
            form.appendChild(hiddenField1);

            const hiddenfield2 = document.createElement('input');
            hiddenfield2.type = 'hidden';
            hiddenfield2.name = 'quotation_id';
            hiddenfield2.value = '<?php echo $quotation_id;?>';
            form.appendChild(hiddenfield2);

            const hiddenfield3 = document.createElement('input');
            hiddenfield3.type = 'hidden';
            hiddenfield3.name = 'transport_amount';
            hiddenfield3.value = $("#total_pickup_charges").val();
            form.appendChild(hiddenfield3);

            const hiddenfield4 = document.createElement('input');
            hiddenfield4.type = 'hidden';
            hiddenfield4.name = 'restriction_movement_good';
            hiddenfield4.value = '';
            form.appendChild(hiddenfield4);

            const hiddenfield5 = document.createElement('input');
            hiddenfield5.type = 'hidden';
            hiddenfield5.name = 'total_pickup_charges';
            hiddenfield5.value = $("#total_pickup_charges").val();
            form.appendChild(hiddenfield5);


            const hiddenfield6 = document.createElement('input');
            hiddenfield6.type = 'hidden';
            hiddenfield6.name = 'transport_token_amt';
            hiddenfield6.value = $("#transport_token_amt").val();
            form.appendChild(hiddenfield6);


            const hiddenfield7 = document.createElement('input');
            hiddenfield7.type = 'hidden';
            hiddenfield7.name = 'coupen_code';
            hiddenfield7.value = $("#post_coupon_value").val(); /*$("#coupen_code").val();*/
            form.appendChild(hiddenfield7);


            const hiddenfield8 = document.createElement('input');
            hiddenfield8.type = 'hidden';
            hiddenfield8.name = 'old_transpoet_charge';
            hiddenfield8.value = $("#old_transpoet_charge").val();
            form.appendChild(hiddenfield8);


            const hiddenfield9 = document.createElement('input');
            hiddenfield9.type = 'hidden';
            hiddenfield9.name = 'referee_id';
            hiddenfield9.value = $("#referall_id").val();
            form.appendChild(hiddenfield9);

            const hiddenfield10 = document.createElement('input');
            hiddenfield10.type = 'hidden';
            hiddenfield10.name = 'transport_type';
            hiddenfield10.value = pickup_type; /*transport;*/
            form.appendChild(hiddenfield10);


            var checkedValue = $('input[name=tab1]:checked').val();

            var autopay = 0;

             if ($('#auto-pay-checkbox').is(":checked")) {
                autopay = 1;
             }

            var month_selcted = 1;

            if (checkedValue == 'month') {
                month_selcted = 1;
            } else if (checkedValue == 'month6') {
                month_selcted = 6;
            } else if (checkedValue == 'month12') {
                month_selcted = 12;
            }



            const hiddenfield11 = document.createElement('input');
            hiddenfield11.type = 'hidden';
            hiddenfield11.name = 'storage_month';
            hiddenfield11.value = month_selcted; /*transport;*/
            form.appendChild(hiddenfield11);


            const hiddenfieldautopay = document.createElement('input');
            hiddenfieldautopay.type = 'hidden';
            hiddenfieldautopay.name = 'autopay';
            hiddenfieldautopay.value = autopay; /*transport;*/
            form.appendChild(hiddenfieldautopay);


            



            if (pickup_type == 'warehouse_arrival') {

                const hiddenfield13 = document.createElement('input');
                hiddenfield13.type = 'hidden';
                hiddenfield13.name = 'warehouse_arrival_token_amt';
                hiddenfield13.value = 500;
                form.appendChild(hiddenfield13);
            }

            const hiddenfield12 = document.createElement('input');
            hiddenfield12.type = 'hidden';
            hiddenfield12.name = 'transport_coupon';
            if ($("#only_transport_myselect").val() != '' && $("#only_transport_myselect").val() != null) {
                hiddenfield12.value = $("#id_transport_coupon").val();
            } else {
                hiddenfield12.value = $("#post_coupon_value").val();
            }

         
        var monthsamount=$("#monthly_new_price").val();
        const hiddenfieldamonthamount = document.createElement('input');
        hiddenfieldamonthamount.type = 'hidden';
        hiddenfieldamonthamount.name = 'month';
        hiddenfieldamonthamount.value = monthsamount; /*transport;*/
        form.appendChild(hiddenfieldamonthamount);


        var sixmonthamount=$("#half_year_new_price").val();
        const hiddenfieldsixmonth = document.createElement('input');
        hiddenfieldsixmonth.type = 'hidden';
        hiddenfieldsixmonth.name = 'six';
        hiddenfieldsixmonth.value = sixmonthamount; /*transport;*/
        form.appendChild(hiddenfieldsixmonth);


        var yearmonthamount=$("#yearly_new_price").val();
        const hiddenfieldyear = document.createElement('input');
        hiddenfieldyear.type = 'hidden';
        hiddenfieldyear.name = 'year';
        hiddenfieldyear.value = yearmonthamount; /*transport;*/
        form.appendChild(hiddenfieldyear);

            form.appendChild(hiddenfield12);


            console.log(form);

            document.body.appendChild(form);
            form.submit();

        } else {

            $("#agreement_err").html("Please check and agree with terms & consitions.");

            setTimeout(function() {
                $("#agreement_err").html("");
            }, 3000);

        }

    }


    function clicksummery() {

        var checkedValue = $('input[name=tab1]:checked').val();

        var yearly_new_price = $("#yearly_new_price").val();
        var half_year_new_price = $("#half_year_new_price").val();
        var monthly_new_price = $("#monthly_new_price").val();

        var traspor_amt = $('#total_pickup_charges').val();
        var pickup_type = $('input[name="pickup_type"]:checked').val();


        if (pickup_type == 'warehouse_arrival') {
            traspor_amt = 0;
        }

        $(".transport_tokn_amt_new").html(parseFloat(traspor_amt) + "/-");



        console.log(checkedValue);

        if (checkedValue == 'month') {
            $(".for_month").html('(For Month)');
            var storeg_amount = monthly_new_price;
        } else if (checkedValue == 'month6') {
            $(".for_month").html('(For 6 Month)');
            var storeg_amount = half_year_new_price;


        } else if (checkedValue == 'month12') {
            $(".for_month").html('(For Year)');
            var storeg_amount = yearly_new_price;
        }


        console.log(traspor_amt);
        console.log(storeg_amount);



        var main_total_amount = parseFloat(traspor_amt) + parseFloat(storeg_amount);
        $(".total_charges_all").html(parseFloat(main_total_amount) + "/-");


        var transport_tokn_amt = $("#transport_token_amt").val();


        // var transport_tokn_amt=$("#transport_token_amt").val();


        var selected_home_type = $("#selected_home_type").val();
         transport_tokn_amt = 1000;
        // if (selected_home_type == '1rk') {
        //     transport_tokn_amt = 1000;
        // } else if (selected_home_type == '1bhk') {
        //     tokennew = 1000;
        // } else if (selected_home_type == '2bhk') {
        //     transport_tokn_amt = 2000;
        // } else if (selected_home_type == '3bhk') {
        //     transport_tokn_amt = 3000;
        // } else {
        //     transport_tokn_amt = 3000;
        // }

        /*red coloured text*/




        if (pickup_type == 'warehouse_arrival') {
            transport_tokn_amt = 500;

        }


        if (pickup_type == 'warehouse_arrival') {
            transport_tokn_amt = 500;
        }


        $(".transport_tokn_amt").html(parseFloat(transport_tokn_amt));
        $("#transport_tokn_amt").val(transport_tokn_amt.toFixed(2));



        var remain_total_amount = main_total_amount - transport_tokn_amt;
        $(".remaining_amount").html(parseFloat(remain_total_amount));

        var date_selected = $("#set_date").val();
        if (date_selected != undefined && date_selected != '') {
            $("#booking_date").html(date_selected);
        }




    }



       $.ajax({
        type: "POST",
        url: '<?php echo base_url()?>customer/send_details_emails',
         data:{'quotation_id':<?php echo $quotation_id;?>,'customer_id':<?php echo $customer_id;?>,'storage_item_slug':"<?php echo implode("**",$storage_item_slug);?>",'storage_item_qty':"<?php echo implode("**",$storage_item_qty);?>","hometype":"<?php echo $hometype;?>","slug_array":"<?php echo implode("**",$slug_array);?>","customer_contact1":"<?php echo @$customer_data->customer_contact1; ?>"},
         success: function(data){
            
        }
    }); 
</script>


<script type="">

    function show1(){


     var nowDate = new Date();
    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
        let tomorrow = new Date();
        tomorrow.setDate(new Date().getDate() + 1);

        $("#pickup_new_dates").datepicker("destroy");
        $('#pickup_new_dates').datepicker({
        dateFormat: 'dd/mm/yy',
        minDate: tomorrow,
        startDate: tomorrow,
        showButtonPanel: false,
        minDate: tomorrow,
        beforeShowDay: Disable_Dates,
        });

    $("#firstchecked").prop("checked", true);
    $("#secondchecked").prop("checked", false);



  $('#div1').addClass('d-block');
  $('#div1').removeClass('d-none');
  $('#div2').addClass('d-none');
  $('#div2').removeClass('d-block');
  $('.r-box-show1').addClass('active');
  $('.r-box-show2').removeClass('active');


        var selected_home_type = $("#selected_home_type").val();
         tokennew = 1000;
        // if (selected_home_type == '1rk') {
        // tokennew = 1000;
        // } else if (selected_home_type == '1bhk') {
        // tokennew = 1000;
        // } else if (selected_home_type == '2bhk') {
        // tokennew = 2000;
        // } else if (selected_home_type == '3bhk') {
        // tokennew = 3000;
        // } else {
        // tokennew = 3000;
        // }

        $(".transport_tokn_amt").html(tokennew.toFixed(2)); 
        $("#transport_token_amt").val(tokennew.toFixed(2));
        var total_pickup_charges = $("#post_total_pickup_charges").val();
        $('#total_pickup_charges').val(total_pickup_charges);

        console.log(total_pickup_charges);


}


/* function show3(){
  $('#div1').addClass('d-block');
  $('#div1').removeClass('d-none');
  $('#div2').addClass('d-none');
  $('#div2').removeClass('d-block');
  $('.r-box-show1').addClass('active');
  $('.r-box-show2').removeClass('active');
}*/
function show2(){
 var nowDate = new Date();
    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
        let tomorrow = new Date();
        tomorrow.setDate(new Date().getDate() + 1);

        $("#pickup_new_dates").datepicker("destroy");
        $('#pickup_new_dates').datepicker({
        dateFormat: 'dd/mm/yy',
        minDate: tomorrow,
        startDate: tomorrow,
        showButtonPanel: false,
        minDate: tomorrow,
        beforeShowDay: Arrival_Disabled_Dates_arr,
        });

      $("#firstchecked").prop("checked", false);
    $("#secondchecked").prop("checked", true);


  $('#div2').addClass('d-block');
  $('#div2').removeClass('d-none');
  $('#div1').addClass('d-none');
  $('#div1').removeClass('d-block');
   $('.r-box-show1').removeClass('active');
  $('.r-box-show2').addClass('active');

    $(".transport_tokn_amt").html('500/-');
    $("#transport_token_amt").val(500);
    $('#total_pickup_charges').val(0);
}

function downloadsummary(){
    const element = document.getElementById("downloadsummary");
        html2pdf(element, {
        margin:       1,
        filename:     'summary.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { dpi: 192, letterRendering: true },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    });
}


function redirectToPaymentPage(event) {
        // Prevent the default button behavior (if it's in a form)
        event.preventDefault();
        // Redirect to the new payment page
        window.location.href = 'http://localhost/SafeFront/customer/new_dummy_payment_page';
    }
</script>

</div>
</div>
</div>