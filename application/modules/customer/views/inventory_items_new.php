              <style>
                .popup-container {
    position: fixed;
    top: 70%;
    left: 20px; /* Adjust the left position as needed */
    transform: translateY(-50%);
    z-index: 9999;
    background-color: #ffedd5;
    border-radius: 50px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    padding: 20px;
    display: none; /* Initially hidden */
}

.popup-content {
    display: flex;
    align-items: center;
}

.fire-icon {
    font-size: 24px;
    margin-right: 10px;
}

.message {
    flex-grow: 1;
}

.close-icon {
    cursor: pointer;
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 14px;
}

/* Red color for fire icon */
.fire-icon {
    color: red;
}


             .loader{
                    position: fixed;
                    left: 0px;
                    top: 0px;
                    width: 100%;
                    height: 100%;
                    background: url('<?php echo base_url();?>assets/new_design_css/images/loader.gif')50% 50% no-repeat rgb(249,249,249);
                  }


              .list-name-field {
                padding: 0 10px;
              }
              </style>

              <style type="text/css">
              #cssTable th,td 
              {
                  padding: 5px;
              }
              .frmSearch {padding:10px 0;border-radius:4px;}
              #country-list{z-index: 999;float:left;list-style:none;margin-top:-3px;padding:0;position: absolute;}
              #country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
              #country-list li:hover{background:#ece3d2;cursor: pointer;}
              #search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}


              #list_item_table td span:hover {
                  cursor: pointer;
                  color: #ef5921;
              }

              .custompad918.active {
                  background: #f05200;
                  color: #fff;
              }

              .custompad918 {
                  color: #777;
                  background: #e8e8e8;
              }



              button.custompad918 {
                  color: #777;
                  background: #e8e8e8;
              }
              button.backward, button.custompad918, button.forward, button.submit {
                  border: none;
                  color: #fff;
                  text-decoration: none;
                  transition: background .5s ease;
                  -moz-transition: background .5s ease;
                  -webkit-transition: background .5s ease;
                  -o-transition: background .5s ease;
                  display: inline-block;
                  cursor: pointer;
                  outline: none;
                  text-align: center;
                  background: #031a5b;
                  position: relative;
                  font-size: 14px;
                  font-size: 0.875rem;
                  font-weight: 600;
                  line-height: 1;
                  padding: 12px 0px;
              }
              .style_class{

                  color: #fff;padding: 8px;background-color: #021a47 !important;
              }

              .data-room{
                border: 1px solid #031a5b;
                margin-top: 1px;
              }
              .pointer {cursor: pointer;}
              .modal-header{background: #031a5b;color:#fff;}
              .close{color:#fff;text-shadow: none;opacity: 1;}
              .close:focus, .close:hover {
                  color: #d3ddf7;}
              .fs14{font-size: 14px;}
              .helpSubmitBtn{padding: 2px 5px 2px 5px;
                  border-radius: 0;}
              .btn-orange:hover{background: #db5c2c !important; border-color:#db5c2c !important;}



              </style>

              <style>
                p{
                  font-size: 17px !important;
                }
              </style>


              <div class="loader" style="display:none"></div>
                <div class="container">
                          <div class="row d-flex justify-content-center">
                              <div class="col-md-12 col-lg-12">
             



<div style="margin-top: 18px;" class="row">
    <div id="invalid_home_type_msg" class="col-md-12">
        
    </div>
</div>    

<div id="popup-container" class="popup-container">
    <div class="close-icon" id="close-icon">x</div>
    <div class="popup-content">
        <div class="fire-icon">🔥</div>
        <div class="message">15 people booked today</div>
    </div>
</div>


<?php 

$customer_names = ['Harsha vardhan','Niranjan','Sai','Kushal','Anush','Arun','Rakesh','Arshith','Madhu','Siddhu','Sid'];
$random_key = array_rand($customer_names);
$random_name = $customer_names[$random_key];

?>

<div id="popup-container-2" class="popup-container">
    <div class="close-icon" id="close-icon-2">x</div>
    <div class="popup-content">
        <div class="fire-icon">🎉</div>
        <div class="message"><?php echo $random_name; ?> have just booked the slot! 🚀</div>
    </div>
</div>

<div class="row checkinvitems" style="display:none;color:red">
    <div class="col-12">
        <div class="button-row d-flex mt-4">
               Please Select Home Type or Inventory Items
          </div>
    </div>
</div>

<div class="row minimumitem" style="display:none;color:red">
    <div class="col-12">
        <div class="button-row d-flex mt-4">
               Please Select Inventory Items
          </div>
    </div>
</div>






<div class="row mt-4 mb-4">
    
     <div class="col-lg-8 col-md-8 col-sm-8">
      <div class="button-row d-flex ">
          <p class="header-title" style="font-size: 19px;">Select Home Type
             
        </p>
      </div>
   </div> 

   
    <div class="col-lg-4 col-md-4 col-sm-4 text-right" style="margin-left:0px;">
        <div class="button-row d-flex">
             <a style="border-bottom: 1px solid #031A5B;color:#db5c2c" href="javascript:void(0)" data-toggle="modal" data-target="#whyus" href="javascript:void(0)" title="Why Inventory?">Why Inventory?</a>
             <div style="color: red;font-size: 16px;" id="goods_error_div"></div>
          </div>
    </div>
</div>


 <!-- end col -->


<div id="sendotp" class="modal fade" role="dialog">
    <center>
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div style="border: none;" class="modal-header">
               Enter Details
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>


            <div class="modal-body">
               <div class="table-responsive-sm">
                <form name="mobform" id="mobform">
                  <p class=""><input class="form-control" placeholder="Enter mobile no. " type="text" name="customer_mobile_no" id="customer_mobile_no_otp" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">&nbsp;

                    <input style="display: none" class="form-control en_otp" placeholder="Enter OTP" type="text"  id="en_otp">
                    &nbsp;&nbsp;

                     <p class="mobile_error_otp"></p>
                     <p class="mobile_success_otp"></p>


                     
                         
                    <button type="button" class="btn btn-orange send_otp  form-control" name="send_otp">Submit</button></p>
                 
                 
                </form>
              </div> 
            </div> 
          </div>

        </div>
    </center>
      </div>






             
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link active 1rk  medium  selecthome_1rk select_home selecthome"   data-id="1rk" onclick="selecthome('1rk')" >1RK</a>
                        </li>
                        <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link 1bhk  selecthome_1bhk select_home selecthome"  data-id="1bhk"  onclick="selecthome('1bhk')">1BHK</a>
                        </li>
                        <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link  2bhk selecthome_2bhk select_home selecthome" data-id="2bhk"  onclick="selecthome('2bhk')">2BHK</a>
                        </li>
                        <li class="nav-item">
                        <a href="javascript:void(0)" class="nav-link 3bhk  selecthome_3bhk select_home selecthome " data-id="3bhk"   onclick="selecthome('3bhk')">3BHK</a>
                        </li>
                        </ul> 



                        <div class="make_empty">


                        </div> 
                   
              <div class="row">
                 <div class="col-4 text-left">
                      <div class="button-row  mt-4">

                           <a href="javascript:void(0)" onclick="step2()" class="btn btn-orange-line js-btn-next semi-bold back3"  title="back"><i class="fa fa-angle-left mr-4"></i>Back</a>
                          
                       
                        </div>
                  </div>

                  <div class="col-3 text-left">
                      <div class="button-row  mt-4">

                         

                          <a class="btn btn-primary ml-auto js-btn-next"  data-toggle="modal" data-target="#OtpModal" href="javascript:void(0)" title="Next">Need help&nbsp;<i class="far fa-question-circle"></i></a>
                        </div>
                  </div>

                  <div class="col-5 text-right" style="margin-left:0px;">
                      <div class="button-row  mt-4">
                           <a style="padding: 5px 6px 6px;" class="btn btn-orange ml-auto js-btn-next next2"  href="javascript:void(0)" onclick="step4()"  title="Next">Next Step <i class="fa fa-angle-right ml-2"></i></a>
                        </div>
                  </div>
              </div>


                       

                      
<script type="text/javascript">


// $('.hometypes').on('change', function() {
//       $('.hometypes').not(this).attr('checked', false);    
//         nextstep();

// });

function isNumberKey(evt, obj) {

      var charCode = (evt.which) ? evt.which : event.keyCode
      var value = obj.value;
      var dotcontains = value.indexOf(".") != -1;
      if (dotcontains)
          if (charCode == 46) return false;
      if (charCode == 46) return true;
      if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
      return true;
}


var tableBody = $("table.item_list_tbl tbody"); 

var index_auto =500;

var selected_item_arr =[]; /*global array*/



$("#search-box").keyup(function(){

  //alert('ok');

    $.ajax({
        type: "POST",
        url: '<?php echo base_url()?>customer/get_items',
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            //$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
            $("#suggesstion-box").show();
            $("#suggesstion-box").html(data);
            $("#search-box").css("background","#FFF");
        }
    });
});


function select_item_name(storage_item_id,item_slug) {

    console.log(selected_item_arr);
    console.log(item_slug);
    
    if(jQuery.inArray(item_slug, selected_item_arr) !== -1){
        var old_val =  $("#set_item_qty_"+item_slug).val();  
        var new_val = parseInt(old_val) + parseInt(1);
        $("#set_item_qty_"+item_slug).val(new_val); 
         check_autohometype();

    }else{

        $(".item_click_btn").css('pointer-events','none');

        $.ajax({
          url: '<?php echo base_url()?>customer/get_item_data',
          type: 'POST',
          data: {'storage_item_id':storage_item_id},
          success: function (response)
          {
            var obj = JSON.parse(response);
            $("#search-box").val(obj.storage_item_name);

               $(".item_click_btn").css('pointer-events','auto');
            
                 var markup =`<tr id="remove_item_id_${index_auto}" class="checkitems">
                    <td>${obj.storage_item_name}
                    <input type="hidden" class="item_selected_list" name="storage_item_slug[]" value="${obj.storage_item_slug}">
                    </td>
                   
                    <td>
                                           <div class="number">
                                                    <span class="minus" data-id=${index_auto}>-</span><input style="width:55px" class="form-control item_qty_valid" value="1" type="text" onkeypress="return isNumberKey(event,this)" id="set_item_qty_${item_slug}" name="storage_item_qty[${obj.storage_item_slug}]"><span class="plus">+</span>
                                                    </div>
                                                    </td>
                    
                </tr>`; 




            $(".list_data").prepend(markup);

            $('#remove_item_id_'+index_auto).attr('item_id_value',item_slug);

            $("#search-box").val('');

            selected_item_arr.push(item_slug);

            $(".minimumitem").hide();

            index_auto++;

            check_autohometype();

          }

        });
    }

    

    $("#suggesstion-box").hide();
}

function remove_item_fun(inc){
    var item_id = $(`#remove_item_id_${inc}`).attr('item_id_value');
    var item_index = selected_item_arr.indexOf(item_id);
    if (item_index !== -1) selected_item_arr.splice(item_index, 1);
    $(`#remove_item_id_${inc}`).remove();

      var count=0;
      $('.item_selected_list').each(function(i, obj) {
      count++;
      });

    if(count!=0){ 
   // $(".checkinvitems").hide();
    }else{
   // $(".checkinvitems").show();
    $('.selecthome').removeClass('active');
    }           
    check_autohometype();
   // city_select();
} 

 function selecthome(homesize) {
        $('.make_empty').html();
       $('.select_home').removeClass('active');
       $('.' + homesize).addClass('active');
       $("#selected_home_type_id").val(homesize);
       $('.selecthome').removeClass('active');
       nextstep(homesize);
  }

 
 function nextstep(homesize){  
            $(".loader").show();
            $(".container").css('opacity',0.2);
           $("#hometype").val(homesize);
            $.ajax({
            url: '<?php echo base_url();?>customer/get_selected_storage_item_hometype',
            type: 'POST',
            data: {'storage_type':$("#storage_type").val(),'homesize':homesize}, 
            success: function(response) 
            {
                  $(".selecthome").removeClass('active');
                  $(".selecthome_"+homesize).addClass('active');

                  $("#step3").show();
                  $("#step1").hide();  
                  $("#step2").hide();  
                 // $("#step2").html(response); 
                    $('.make_empty').html(response);
                  $(".loader").hide();
                  $(".container").css('opacity',1);   
            }
         })      
 }
</script>

<script type="text/javascript">
  /*$(document).on('click','.add_mobile',function(){*/

    $(document).ready(function(){

        $(".add_mobile").click(function(){
            var customer_mobile_no = $("#customer_mobile_no").val();
            console.log(customer_mobile_no.length);
            if(customer_mobile_no==''||  customer_mobile_no.length!=10)
            {
              $(".mobile_error").html('<p class="text-danger">Please enter correct mobile number</p>');
              setTimeout(function(){ 
              $(".mobile_error").html('');        
              }, 2000);
            }
            else
            {

              $.ajax({
                  type: "POST",
                  url: '<?php echo base_url()?>customer/add_customer_phone_no',
                  data:{customer_mobile_no:customer_mobile_no},
                  success: function(data){
                    $(".mobile_success").html('<p class="text-success">Thank you!You will get call very soon...</p>');
                    setTimeout(function(){ 
                      $(".mobile_success").html(''); 
                      $("#customer_mobile_no").val(''); 
                    }, 3000);
                  }
              });

            }
        });


        $(".send_otp").click(function(){
            var customer_mobile_no = $("#customer_mobile_no_otp").val();
            var en_otp = $("#en_otp").val();


            
            console.log(customer_mobile_no.length);
            if(customer_mobile_no==''||  customer_mobile_no.length!=10)
            {
              $("#customer_mobile_no_otp").addClass('error');
              setTimeout(function(){ 
             ("#customer_mobile_no_otp").removeClass('error');      
              }, 2000);
            }
            else
            {

              $.ajax({
                  type: "POST",
                  url: '<?php echo base_url()?>customer/send_otp_customer_phone_no',
                  data:{customer_mobile_no:customer_mobile_no,en_otp:en_otp},
                  success: function(data){
                    if(data=="success"){
                        $('.en_otp').show();
                        $(".mobile_success_otp").html('<p class="text-success">Please check  mobile number for otp</p>');
                        setTimeout(function(){ 
                        $(".mobile_success_otp").html(''); 
                        //$("#customer_mobile_no").val(''); 
                        }, 5000);
                    }

                    if(data=="fail"){
                        $(".mobile_error_otp").html('<p class="text-danger">Please enter correct mobile number and otp</p>');
                        setTimeout(function(){ 
                        $(".mobile_error_otp").html('');        
                        }, 2000);  
                    }

                    if(data=='authorization'){
                        $('#sendotp').modal('hide');
                        step3(); 
                    }
                  }
              });

            }
        });





  });



 function checkinvitems(){

      var new_homesize=$("#hometype").val();

        var count=0;
        $('.item_selected_list').each(function(i, obj) {
              count++;
        });

        console.log(count);
       // console.log($("#selected_home_type_id").val());

       
        if(count!=0){
            $("#hometype").val(new_homesize);
            $("#selected_home_type_id").val(new_homesize);
            step3();
        }else{
           $(".checkinvitems").show();
        }


   
 }

 var form = document.getElementById("msform1");

// Add a submit event listener to the form
form.addEventListener("submit", function(event) {

    event.preventDefault();
  // Code to be executed when the form is submitted
     console.log('submit');
    console.log(step1_number);
    if(step1_number==0){
        step2('household_storage');
    }
   

    
});

function openmodel(){
    $('#sendotp').modal({
        backdrop: 'static',
        keyboard: false
    })
}



function closePopup(popupId) {
        $(popupId).fadeOut();
    }

    $(document).ready(function() {
        // Show the first popup container initially
        $('#popup-container').fadeIn();

        // Automatically close the first popup after 5 seconds and show the second popup
        setTimeout(function() {
            $('#popup-container').fadeOut(function() {
                $('#popup-container-2').fadeIn();

                // Automatically close the second popup after 5 seconds
                setTimeout(function() {
                    closePopup('#popup-container-2');
                }, 5000);
            });
        }, 5000);

        // Close the first popup container when clicking on the close icon
        $('#close-icon').click(function() {
            $('#popup-container').fadeOut(function() {
                $('#popup-container-2').fadeIn();

                // Automatically close the second popup after 5 seconds
                setTimeout(function() {
                    closePopup('#popup-container-2');
                }, 5000);
            });
        });

        // Close the second popup container when clicking on its close icon
        $('#close-icon-2').click(function() {
            closePopup('#popup-container-2');
        });
    });

</script>
               
          