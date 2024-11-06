<link href="<?php echo base_url();?>assets/css/booking-css.css" rel="stylesheet">
<style>
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{    border: 1px solid #031a5b !important;}

.ui-datepicker td a:after{color: #ef5921 !important;}

.ui-datepicker-inline.ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all{
   width:100%;
}
.loader{
   position: fixed;
   left: 0px;
   top: 0px;
   width: 100%;
   height: 100%;
   background: url('<?php echo base_url();?>assets/new_design_css/loader.gif') 
   50% 50% no-repeat rgb(249,249,249);
}

.radio-border-box .custom-radio .custom-control-input:checked~.custom-control-label::after 
{background-image: url('../images/booking/check.png');
}
</style>
<?php      
 $pickup_charges = ($quotation_data->lift_cost + $quotation_data->transport_cost + $quotation_data->labour_cost + $quotation_data->item_packing_charges + $quotation_data->extra_km_charges);

if(!empty($quotation_data->transport_multi_factor)){

 $pickup_charges_temp = ($pickup_charges * $quotation_data->transport_multi_factor); 

  $pickup_charges = number_format($pickup_charges_temp, 2, '.', '');
}  

/*********for storage***************/    
$monthly_storage_charges = $quotation_data->total_storage_charges;

if(!empty($quotation_data->storage_multi_factor)){
$monthly_storage_charges = ($quotation_data->total_storage_charges * $quotation_data->storage_multi_factor); 
}   

$monthly_gst_amt = ($monthly_storage_charges * 18)/100; 
$monthly_sum = round(($monthly_storage_charges + $monthly_gst_amt));

$storage_coupon_amt = 0;
if(!empty($quotation_data->storage_coupen)){
   $storage_coupen_arr = explode('-', $quotation_data->storage_coupen);
   if($storage_coupen_arr[1] =='flat'){
   $storage_coupon_amt = $storage_coupen_arr[2];
   }else{
   $storage_coupon_amt =($storage_coupen_arr[2]/100)*$monthly_sum;
   }
}

$revised_monthly_charges=($monthly_sum - $storage_coupon_amt); 

$total_monthly_storage_charges = round($revised_monthly_charges);

$six_month_payable_amount =round(($total_monthly_storage_charges * 6)); 

$yearly_payable_amount =round(($total_monthly_storage_charges * 12));
?>   

<input type="hidden" id="monthly_storage_charges_id" value="<?php echo @$quotation_data->total_storage_charges;?>">  
<input type="hidden" id="storage_multi_factor" value="<?php echo @$quotation_data->storage_multi_factor;?>">  
<input type="hidden" id="transport_multi_factor" value="<?php echo @$quotation_data->transport_multi_factor;?>">  

<div class="sec-pad bg-white">
    <div class="container">
         <div class="row">   
            <div class="col-sm-12 col-md-12">
               <div class="loader" style="display:none"></div> 
            </div>
         </div>   
         
         <div class="row">   
            <div class="col-sm-12 col-md-12">
               <div class="button-row d-flex mt-4">
                  <b><span style="color: green;font-size: 16px;">Quotation has been created successfully,Please check your email.</span></b>
               </div>
            </div>
         </div> 

        <div style="margin-top: 5px;" class="row">
            <div class="col-12 mb-4">
               <div class="text-left">
                  <a href="javascript:void(0)" onclick="step3()" class="btn btn-orange-line js-btn-next semi-bold back4" title="back"><i class="fa fa-angle-left mr-4"></i>Back</a>
               </div>   
            </div>
            <div class="col-12 mb-4">
                <div class="d-block d-lg-flex align-items-start">
                     <div class="grey-info-tag mb-lg-0 mb-3">
                        <img src="<?php echo base_url();?>images/booking/exclamation-circle.svg" class="img-fluid mr-2 mt-1">
                        <p>Zero cancellation charges!!! Book now, If your plans are changed, cancel anytime before 24 hours to avail full refunds.</p>
                    </div>
                     <div class="text-right">
                     <?php if(empty($warehouse_arrival)) {
                           $token = $quotation_data->transport_token_amt; 
                        }else{
                           $token =500;
                        }
                     ?>
                     <button onclick="book_slot_fun()" class="btn round-btn mb-2" type="button">BOOK SLOT <span class="fa fa-arrow-right ml-2"></span></button>
                     <p class="orange-text bold">Pay Token Advance <span class="transport_tokn_amt"><?php echo $token;?></span></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 custome-padding-right">
                <p class="bold">Transport charges <span style="color: red;font-size:17px;margin-left:5px;margin-bottom: " id="select_trp_err"></span></p>
                <div class="row form-row">
                    <div class="col-6 radio-border-box-margin">
                        <div class="radio-border-box radio-active">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="customRadio1" name="pickup_type" value="pickup" checked="">
                                <label class="custom-control-label" for="customRadio1"></label>
                            </div>
                            <p class="bold">SafeStorage Transport</p>
                            <p>Token Advance(₹<span id="transport_token_show"><?php echo $quotation_data->transport_token_amt; ;?></span>)</p>
                        </div>
                    </div>
                    <div class="col-6 radio-border-box-margin">
                        <div class="radio-border-box">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" id="customRadio2" name="pickup_type" value="warehouse_arrival">
                                <label class="custom-control-label" for="customRadio2"></label>
                            </div>
                            <p class="bold">Self Transport</p> 
                            <p>Token Advance(₹500)</p>
                        </div>
                    </div>
                </div>
                <p><span class="bold orange-text">₹ <span id="transport_charges_old" class="line-through"><?php echo @$pickup_charges.'/-';?></span> <span id="transport_charges_show" style="display: none"></span> </span> &nbsp; Estimated Transport charges <span id="trp_percent_msg"></span></p>

                <?php 

                $storage_coupon_val = $percent_coupon;
                $coupen_type = 'percent';
                $coupen_code='safestorage';

                if(!empty($quotation_data->storage_coupen)){

                  /*as per new condition in dropdown storage charge coupon but while*/

                  $st_coupon_arr = explode('-', $quotation_data->storage_coupen);

                  $coupen_code=$st_coupon_arr[0];

                  $storage_coupon_val = $st_coupon_arr[2];

                  if($st_coupon_arr[1] =='flat'){

                    $coupen_type = 'flat';
                    $option_val='Flat ₹'.$st_coupon_arr[2].' OFF ';

                  }else{

                    $coupen_type = 'percent';
                    $option_val=$st_coupon_arr[2].'% OFF';
                  }
                }  
                ?>

                <div class="form-group offer-input">
                    <label class="bold">Select Coupon</label>
                    <select id="storage_myselect" class="form-control">
                    <option data-transport_percent="<?php echo $trp_percent_coupon;?>" value="<?php echo $coupen_type;?>,<?php echo $storage_coupon_val;?>"><?php echo @$option_val;?></option>

                    <?php 
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

                    ?>
                    <option data-transport_percent="<?php echo $t_percent_coupon;?>" value="<?php echo $coupen_type;?>,<?php echo $value->amount;?>"><?php echo $option?></option>
                    <?php  }  
                    ?>
                    </select>

                  <input type="hidden" id="coupen_code_id" value="<?php echo $coupen_code;?>">  

                  <input type="hidden" id="selected_home_type" value="<?php echo $quotation_data->hometype;?>">

                  <input type="hidden" id="id_transport_coupon" name="transport_coupon" value="<?php echo $transport_coupon; ?>">

                  <input type="hidden" id="only_transport_myselect" name="only_transport_myselect" value="">

                  <input type="hidden" id="post_coupon_value" value="">

                  <input type="hidden" id="disabled_date_arr" value='<?php echo json_encode($disabled_date_arr);?>'>
                  <input type="hidden" id="arrival_disabled_dates_arr" value='<?php echo json_encode($arrival_disabled_dates_arr);?>'>
                  <input type="hidden" id="trp_paid_amt" value="<?php echo $token;?>">

                  <span><img src="<?php echo base_url();?>images/booking/bxs-offer.svg" class="img-fluid offer-icon"></span>
                </div>
                <?php if(!empty($customer_data->referee_id)){ ?>
                    <input type="hidden" name="referall_id" class='form-control' id="referall_id" value="<?php echo $customer_data->referee_id;?>">    
                <?php }else{ ?>
                    
                    <div class="input-group mb-2">
                        <label class="bold">Referred Code</label>
                        <input type="text" name="referall_id" id="referall_id" class="form-control" placeholder="Did you referred by any friend ?">
                        <div class="input-group-append">
                            <button onclick="checkreferral()" class="btn round-btn" type="button">Apply</button>
                        </div>
                    </div>
                    <span class="error_refer" style="color:red"></span>
                    <span id="referaal_msg" style="color:green"></span>

                <?php } ?>   
                <p><a onclick='window.open("<?php echo base_url();?>refer-and-earn");return false;' class="primary-link">Click here to know how referral code work?</a></p>
                <hr class="mb-4 mt-4">
                <div class="row form-row">
                    <div class="col-sm-6">
                        <div class="info-div">
                            <p class="bold">Fullname</p>
                            <p><?php echo @$customer_data->customer_name; ?></p>
                        </div>
                        <div class="info-div">
                            <p class="bold">Mobile number</p>
                            <p><a href="tel:+91 <?php echo @$customer_data->customer_contact1; ?>">+91 <?php echo @$customer_data->customer_contact1; ?></a></p>
                        </div>
                        <div class="info-div">
                            <p class="bold">Email Address</p>
                            <p><a href="mailto:<?php echo @$customer_data->customer_email;?>"><?php echo @$customer_data->customer_email;?></a></p>
                        </div>
                        <div class="info-div">
                            <p class="bold">City</p>
                            <p><?php echo @$customer_data->customer_local_city; ?></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="info-div">
                            <p class="bold">Pickup Address</p>
                            <p><?php echo @$customer_data->pickup_address; ?></p>
                        </div>
                        <div class="info-div">
                            <p class="bold">House Type / Floor</p>
                            <p><?php echo @$hometype; ?> / <?php echo @$customer_data->pickup_floor; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 custome-padding-left custome-border-left">
                <p class="bold">Storage charges</p>
                <div class="row form-row d-flex justify-content-center">
                    <div class="col-sm-4 col-6">
                        <div class="booking-box">
                            <span class="orange-text line-through">₹ <span id="monthly_old"><?php echo @$monthly_sum.'/- ';?></span></span>
                            <h3>₹ <span id="monthly_new"></span></h3>
                            <hr>
                            <p>Monthly Storage charges <br><small>(Include 18% GST)</small></p>
                        </div>
                    </div>
                    <div class="col-sm-4 col-6">
                        <div class="booking-box">
                            <span class="orange-text line-through">₹ <span id="half_year_old"><?php echo @$six_month_payable_amount.'/- '; ?></span></span>
                            <h3>₹ <span id="half_year_new"></span></h3>
                            <hr>
                            <p>6 Monthly Storage charges <br><small>(10% Discount)</small></p>
                        </div>
                    </div>
                    <div class="col-sm-4 col-6">
                        <div class="booking-box">

                            <span class="orange-text line-through">₹ <span id="yearly_old"><?php echo @$yearly_payable_amount.'/- ';?></span></span>
                            <h3>₹ <span id="yearly_new"></span></h3>
                            <hr>
                            <p>12 Monthly Storage charges <br><small>(20% Discount)</small></p>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <img src="<?php echo base_url();?>images/booking/services.png" class="img-fluid mb-5 mt-3">
                </div>
            </div>
            <div class="col-12 text-right">
                <button onclick="book_slot_fun()" class="btn round-btn mb-2" type="button">BOOK SLOT <span class="fa fa-arrow-right ml-2"></span></button>
                <p class="orange-text bold">Pay Token Advance <span class="transport_tokn_amt"><?php echo $token;?></span></p>
            </div>
            <div class="col-12">
                <div class="d-flex align-items-start mt-2">
                    <img src="<?php echo base_url();?>images/booking/exclamation-circle.png" class="img-fluid mr-2 mt-1">
                    <p>All items must be packed with storage standards(3 layer),otherwise packing consumables and packers charges applicable. Refer to Ratecard for packing charges and packing helper charges would be shared at the warehouse.</p>
                </div>
            </div>
        </div>
    </div>
</div>

     
<div class="modal" id="mybookModaldate">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Book Slot</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <div class="table-responsive-sm">
               <form class="multisteps-form__form" action="<?php echo base_url();?>customer/savedata" method="post">
                  <div class="multisteps-form__panel shadow pt-4   js-active" data-animation="scaleIn">
                     <div class="">
                      <div class="row">
                           <div class="col-md-12">
                             <span  style="color: red" id="date_err"></span>
                           </div>
                       </div>    
                        <div class="row">
                           <div class="col-md-12">
                              <div class="row" style="margin-bottom: 2px">
                                 <div class="col-12">
                                    <div id="DatePicker" autofocus></div>
                                    <input type="hidden" id="set_date" value="">
                                    <input type="hidden"  id="date" name="date">
                                    <input type="hidden" name="customer_id" id="customer_id" value="<?php echo  $customer_id;?>">
                                    <input type="hidden" name="quotation_id"  id="quotation_id" value="<?php echo  $quotation_id;?>">
                                    <input type="hidden" id="transport_amount" name="transport_amount">
                                    <input type="hidden" name="total_pickup_charges" id="total_pickup_charges" value="<?php echo @$pickup_charges;?>">
                                    <input type="hidden" id="post_total_pickup_charges" value="<?php echo @$pickup_charges;?>">

                                    <input type="hidden" name="coupen_code" id="coupen_code">
                                    <input type="hidden" name="transport_token_amt" id="transport_token_amt" value="<?php echo @$quotation_data->transport_token_amt;?>">
                                    <input type="hidden" name="old_transpoet_charge" id="old_transpoet_charge" value="<?php echo @$pickup_charges;?>">
                   
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <hr/>
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
                           <div  class="col-md-12" style="text-align: center;background: #fbf1a0;"> 
                               Cancel before 24 hours to avail full refunds.
                           </div>
                        </div>

                        <div class="row">
                           <div style="text-align: center;" class="col-md-12">
                              <span style="color: red;" id="agreement_err"></span>
                           </div>
                        </div>
                        <div class="row">
                       
                        <div style="margin-top: 7px;" class="col-sm-12 text-center">
                             
                           <button type="button" class="btn btn-orange ml-auto js-btn-next popup_submit_btn" onclick="submitforms()" style="color: white;">Submit</button>
                             
                        </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>


<script type="text/javascript">
   $(document).ready(function(){
     var pickup_address ='<?php echo @$customer_data->pickup_address;?>';
   
     var pickup_floor = '<?php echo @$customer_data->pickup_floor;?>';
   
     if(pickup_address!='')
     {
       
       $(".w_data").css('display','block');
   
       if(pickup_floor=='basement' || pickup_floor=='ground')
       {
         $(".w_data1").css('display','none');
       }
   
       else
       {
         $(".w_data1").css('display','block');
       }
    
     } 


   }); 
   jQuery(".custom-control-input").change(function() {


       console.log(this.value);

       if(this.value == 'pickup') {

         $(".transport_tokn_amt").html($("#trp_paid_amt").val());
       }
       else if (this.value == 'warehouse_arrival') {
         $(".transport_tokn_amt").html('500.00');
       } 

     $(".radio-border-box").removeClass("radio-active");

     if ($(this).is(':checked')){
       $(this).closest(".radio-border-box").addClass("radio-active");
     }
     else
       $(this).closest(".radio-border-box").removeClass("radio-active");
   });

</script>

