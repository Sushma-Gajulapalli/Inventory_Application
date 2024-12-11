<!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCse5f97FoDXrT5kKoeB1XGCxeCs12-mOE&libraries=places"></script> -->
<style type="text/css">
  .form-group {
    margin-bottom: 12px !important;
}

span.select2.select2-container.select2-container--default.select2-container--below{
            width: 100% !important;
        }

.spinner {
  display: inline-block;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  border: 2px solid #aaa;
  border-top-color: #555;
  animation: spin 0.6s linear infinite;
}
.fa-check{
    color: green;
    font-size: 20px;
}
#otpImage {
  max-width: 60%; 
  height: auto; 
}
.big-button {
    font-size: 24px; 
    padding: 10px 20px;
}


.radio-container {
        display: inline-block;
       /* margin: 10px;*/
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        background-color: #f9f9f9;
        cursor: pointer;
    }

    input[type="radio"] {
        display: none;
    }

    input[type="radio"] + label {
        font-size: 16px;
        cursor: pointer;
    }

    input[type="radio"] + label:before {
        content: "";
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-right: 10px;
        border: 2px solid #f05200;
        border-radius: 50%;
    }
    .smaller-font {
    font-size: 14px; /* Adjust the font size as needed */
}

/*check heree for progress*/
        .progress-bar-container {
            position: relative;
            width: 100%;
            height: 20px; /* Adjust the height of the progress bar */
            background-color: #f0f0f0; /* Background color of the progress bar */
            border-radius: 10px; /* Adjust the border radius to make it rounded */
            overflow: hidden; /* Ensure the ball stays within the container */
            cursor: pointer; /* Show pointer cursor when hovering over the progress bar */
        }

        .progress-bar {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #007bff; /* Color of the progress bar */
            transition: width 0.3s ease; /* Smooth transition for width change */
        }

        .duration-values {
            display: flex;
            justify-content: space-between;
            margin-top: 10px; /* Adjust the spacing between the progress bar and duration values */
        }

        .duration-value {
            flex-grow: 1;
            text-align: center;
            font-size: 14px; /* Adjust the font size of the duration values */
            cursor: pointer; /* Show pointer cursor when hovering over the duration values */
        }

        .duration-value.active {
            font-weight: bold; /* Highlight the active duration value */
        }
    input[type="radio"]:checked + label:before {
        background-color: #f05200;
    }
     .radio-container:hover {
        transform: scale(1.09);

    }
    
    .radio-container input[type="radio"] {
        display: none;
    }
    
   /* .radio-container label {
        margin-left: 10px;
        font-size: 16px;
    }*/
    /*.radio-container {
        cursor: pointer;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 10px;
    }*/

    .radio-container.selected {
        background-color: #1a5e8d;
        color: white;
        box-shadow: 1px 1px 2px 2px #ccc;
    }

    /*.radio-content {
        text-align: center; 
    }*/
    
   /* .radio-container img {
        width: 30px; 
        height: 30px; 
    }
*/

    /*.radio-container label img {
        display: block; 
        margin: 0 auto; 
    }*/
     .radio-container input[type="radio"] {
        transform: scale(0.8); /* Adjust the scale factor as needed */
    }
      /* .radio-container {
        display: flex;
        align-items: center;
    }*/

    .radio-container input[type="radio"] {
        margin-right: 10px; /* Adjust spacing between radio button and image */
    }

    /*.radio-container label img {
        width: 30px; 
        height: 30px; 
    }*/
    #business-form{
        margin: 10px;
    }
    .col {
    flex: 1;
    max-width: 50%; /* Each column takes up half of the row */
   /* padding: 0 15px;*/ /* Adjust padding to your preference */
}
#storag_type{
    height: 53%;
}

/*.radio-container {
  
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    height: 80% !important; 
}*/
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



  .progress-container {
        position: relative;
        height: 20px;
        background-color: #f0f0f0;
        border-radius: 10px;
        overflow: hidden;
        margin-top: 10px;
        pointer-events: none;
    }
 /* Style for dots */
.dot {
    width: 10px;
    height: 10px;
    background-color: #000;
    border-radius: 50%;
    margin: 0 10px; /* Adjust margin as needed */
    display: inline-block;
}

/* Style for progress bar container */
.progress-bar-container {
    position: relative;
}

/* Style for dots container */
.dots-container {
    position: absolute;
    top: -25px; /* Adjust vertical position above the progress bar */
    left: 0;
}


    .progress-bar {
        position: absolute;
        top: 0;
        left: 0;
        width: 0%;
        height: 100%;
        background-color: #007bff;
        border-radius: 10px;
    }

    .ball {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        background-color: #007bff;
        border-radius: 50%;
        cursor: pointer;
        z-index: 2;
    }

    .duration-values {
        margin-top: 10px;
    }

    .duration-value {
        display: inline-block;
        margin-right: 20px;
        color: #333;
        font-weight: bold;
        opacity: 0.5;
        transition: opacity 0.3s;
        cursor: pointer;
    }

    .duration-value.active {
        opacity: 1;
    }

    .duration-value.active[data-duration="less-than-1-month"] {
        pointer-events: none;
    }
  @media only screen and (max-width:700px) {
         .radio-container label {
        margin: 0px;
        font-size: 13px;
    }
    #storag_type{
        height: 68%;
    }
}


@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

</style>
<script type="text/javascript">
  for (const dropdown of document.querySelectorAll(".custom-select-wrapper")) {
    dropdown.addEventListener('click', function () {
        this.querySelector('.custom-select').classList.toggle('open');
    })
}

for (const option of document.querySelectorAll(".custom-option")) {
    option.addEventListener('click', function () {
        if (!this.classList.contains('selected')) {

          console.log(this.classList);
          if(this.parentNode.querySelector('.custom-option.selected')){
              this.parentNode.querySelector('.custom-option.selected').classList.remove('selected');
          }
            //this.parentNode.querySelector('.custom-option.selected').classList.remove('selected');
            this.classList.add('selected');
            this.closest('.custom-select').querySelector('.custom-select__trigger span').textContent = this.textContent;
        }

        if(this.classList.contains('customer_local_city')) {
            $("#customer_local_city").val($(this).attr('data-value'));

            $(".loader").show();
            $(".container").css('opacity', 0.2);

             $.ajax({
                url: '<?php echo base_url();?>customer/get_city_areas',
                type: 'POST',
                data: {'city_id':$(this).attr('data-id')},
                success: function(response) {
                         var areas = JSON.parse(response);
                            var options = '<option value="">Select area</option>'; // Default option
                            if (areas.length > 0) {
                              $.each(areas, function(index, area) {
                                 options += '<option value="' + area.area_slug + '">' + area.area_name +' '+area.pincode + '</option>';
                               });
                            }
                            $('.custom-options_area_list').html(options);
                            $(".loader").hide();
                            $(".container").css('opacity', 1);


                        /*var options = '';
                        if (areas.length > 0) {
                        $.each(areas, function(index, area) {
                        options += '<span class="custom-option customer_local_area" data-value="' + area.area_slug + '">' + area.area_name + '</span>';
                        });
                        }
                        $('.custom-options_area_list').html(options);*/


                }
             });
        }

        if(this.classList.contains('customer_local_area')) {
            $("#customer_local_area").val($(this).attr('data-value'));
        }


        if(this.classList.contains('pickup_lift')) {
            $("#pickup_lift").val($(this).attr('data-value'));
        }
        if(this.classList.contains('pickup_floor')) {
            $("#pickup_floor").val($(this).attr('data-value'));
        }
    })
}

window.addEventListener('click', function (e) {
    for (const select of document.querySelectorAll('.custom-select')) {
        if (!select.contains(e.target)) {
            select.classList.remove('open');
        }
    }
});

function selectOption(index) {
  var optionOnIdx = document.querySelector('.custom-option:nth-child('+index+')');
  var optionSelected = document.querySelector('.custom-option.selected');
  if (optionOnIdx !== optionSelected) {
    optionSelected.parentNode.querySelector('.custom-option.selected').classList.remove('selected');
            optionOnIdx.classList.add('selected');
            optionOnIdx.closest('.custom-select').querySelector('.custom-select__trigger span').textContent = optionOnIdx.textContent;
        }
}

document.querySelector('button').addEventListener("click", function(){
  selectOption(2);
});
</script>
<style>
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
<div class="loader" style="display:none"></div>

 
     <!-- header -->

     <!-- header -->
    <!-- appointment step-->
   <!-- appointment step-->
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

      
      
  <div class="container ">
      <div class="row d-flex justify-content-center">
          <div class="col-md-12 col-lg-12">

                  <!--PEN CONTENT     -->
               
           
 <div class="content">
    <div class="row">
        <div class="col radio-container selected" data-radio="household">
                    <img src="<?php echo base_url()?>assets/new_design_css/froentui/img/select-visit/house1.png"  alt="icon" style="width:  17%;">
                    <span class="radio-content" style=" font-size: 14px;
                          font-weight: 700;">Household / Personal Storage</span>
        </div>
    </div>
</div> 




<!-- radio end -->
<div id="household-form" class="form-container">

                    <div class="content__inner">
                      <div class=" overflow-hidden">
                        <!--multisteps-form-->
                        <div class="multisteps-form">

                        
                         
                        <!--single form panel-->
                            <div class="multisteps-form__panel shadow pt-4   js-active" data-animation="scaleIn">
                              
     

                               <div class="row">
                                      <div class="col-md-6 col-lg-6 form-group">
                                        <label>Name <span class="text-orange">*</span></label>
                                        <input type="text" name="customer_name" id="customer_name" placeholder="Enter full name" value="" class="form-control" required >
                                        <span style="color: red;" id="customer_name_err_msg"></span>
                                      </div>


                                      <div class="col-md-6 col-lg-6 form-group">
                                                  <label>Phone number <span class="text-orange">*</span></label>
                                               <i class="fas fa-check" id="fa-check" style="display: none;"></i>
                                                  <input type="text" name="customer_contact1" id="customer_contact1" class="form-control" placeholder="Please enter 10 digit number"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" required>
                                                  <span style="color: red;" id="contact_err_msg"></span>
                                     </div>
                
                                      <div class="col-md-6 col-lg-6 form-group">
                                      <label>Email address <span class="text-orange">*</span></label>
                                      <input type="email" name="customer_email" id="customer_email" placeholder="Enter email address" value="" class="form-control" required>
                                      <span style="color: red;" id="email_err_msg"></span>
                                      </div>


                                      <div class="col-md-6 col-lg-6 form-group">
                                        <label>Select your city <span class="text-orange">*</span></label>
                                        <div class="custom-select-wrapper position-relative">
                                        <i class="  fa fa-building form-control-icon fa-fw"></i>
                                        <div class="custom-select">
                                        <div class="custom-select__trigger"><span class="select_city_name">Select your city</span>
                                        <div class="arrow"></div>
                                        </div>
                                        <div class="custom-options">
                                        <?php
                                          if(!empty($city_list)){

                                              foreach ($city_list as $key => $city) {
                                          ?>
                                            <span class="custom-option customer_local_city" data-value="<?php echo $city->city_slug;?>" data-id="<?php echo $city->city_id;?>"><?php echo $city->city_name;?></span>
                                          <?php        
                                              }
                                          }
                                        ?>
                                        </div>
                                        </div>
                                        <span style="color: #ff3547;" id="customer_local_cityerror"></span>
                                        </div>

                                        <input type="hidden" name="pickup_floor" id="pickup_floor" required>
                                        <input type="hidden" name="customer_local_city" id="customer_local_city" required>
                                        <input type="hidden" name="pickup_lift" id="pickup_lift" required>
                                        <input type="hidden" id="from_location_city" name="from_location_city" required>
                                        <input type="hidden" id="pickup_lat" name="pickup_lat">
                                        <input type="hidden" id="pickup_lang" name="pickup_lang">
                                        <input type="hidden" id="pickup_pincode" name="pickup_pincode">
                                        <input type="hidden" id="customer_local_area" name="customer_local_area">



                                        
                                        

                                        
                                        <input type="hidden" id="transport_type" name="transport_type">

                                      </div>


                                    </div>
                                   
                                 
                                    <div class="row">
                                              
                                      <div style="display: none;" class="col-md-6 col-lg-6 form-group">
                                        <div style="margin-top: 25px;">     
                                          <input type="radio" value="0" id="transport" name="warehouse_arrival" checked>
                                          <label for="" class="transport">SafeStorage Transport</label>
                                          &nbsp;&nbsp;
                                         
                                          <input type="radio" value="1" id="transport1" name="warehouse_arrival">
                                          <label for="" class="transport1">Self Transport</label>
                                        </div>
                                      </div>

                                    </div>

                                
                                        <div class="row">

                                      


                                       <div class="col-md-12 col-lg-12 form-group show_on_transport_select">
                                        <label>Select your Area  <span class="text-orange">*</span>   <span style="font-size:12px;cursor: pointer;color:red">If not found your area select "Other"</span>  


                                            <select class="custom-options_area_list form-control choosen" name="customer_area" id="customer_area"> 
                                                <option value="" >Select Area </option>
                                            </select>

                                            <span style="color: #ff3547;" id="customer_areaerror"></span>
                                            
                                          

                                        </div>



                                </div>

                                            <div class="row">

                                              <div class="col-md-12 col-lg-6 form-group show_on_transport_select">
                                               
                                                <label>Select floor no. <span class="text-orange">*</span></label>
                                                  <div class="custom-select-wrapper position-relative">
                                                    <i class="  fa fa-sort form-control-icon fa-fw"></i>

                                                    <div class="custom-select">
                                                      <div class="custom-select__trigger"><span>Floor no.</span>
                                                        <div class="arrow"></div>
                                                      </div>
                                                      <div class="custom-options" style="max-height: 150px;overflow-y: scroll;">
                                                                                <?php
                                                          if(!empty($floor_list)){

                                                              foreach ($floor_list as $key => $floor) { ?>
                                                              <span class="custom-option pickup_floor" data-value="<?php echo $floor->floor_slug;?>"><?php echo $floor->floor_name;?></span>
                                                               <?php  
                                                              }
                                                          }
                                                         ?> 
                                                      </div>
                                                        <span style="color: #ff3547;" id="pickup_floorerror"></span>

                                                    </div>
                                                  </div>
                                                       
                                              </div>

                                              <div class="col-md-12 col-lg-6 form-group on_floor_select" style="display:none;">
                                               
                                                <label>Service Lift? </label>
                                                  <div class="custom-select-wrapper position-relative">
                                                    <i class="fa fa-angle-double-up form-control-icon fa-fw"></i>
                                                  
                                                    <div class="custom-select">
                                                      <div class="custom-select__trigger"><span>Select option</span>
                                                        <div class="arrow"></div>
                                                      </div>
                                                      <div class="custom-options">
                                                        <span class="custom-option pickup_lift" data-value="yes">Available</span>
                                                        <span class="custom-option pickup_lift" data-value="no">Not available</span>
                                                      
                                                       
                                                      </div>
                                                        <span style="color: #ff3547;" id="pickup_lifterror"></span>

                                                    </div>
                                                  </div>
                                              </div>
<input type="hidden" id="storage_duration" name="storage_duration">
<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-12 form-group">
            <label>How many months are you looking to store?<span class="text-orange">*</span></label>
            <div class="progress-bar-container">
                <div class="dots-container">
                    <div class="dot"></div> <!-- Dot for < 1 month -->
                    <div class="dot"></div> <!-- Dot for 1 to 3 months -->
                    <div class="dot"></div> <!-- Dot for 3 to 6 months -->
                    <div class="dot"></div> <!-- Dot for 6 to 12 months -->
                    <div class="dot"></div> <!-- Dot for > 12 months -->
                </div>
                <div class="progress-bar" style="width: 20%;"></div>
            </div>
            <div class="duration-values">
                <span class="duration-value active" data-duration="less-than-1-month" onclick="updateduration('less-than-1-month')">< 1 month</span>
                <span class="duration-value" data-duration="1-to-3-months" onclick="updateduration('1-to-3-months')">1 to 3 months</span>
                <span class="duration-value" data-duration="3-to-6-months" onclick="updateduration('3-to-6-months')">3 to 6 months</span>
                <span class="duration-value" data-duration="6-to-12-months" onclick="updateduration('6-to-12-month')">6 to 12 months</span>
    <span class="duration-value" data-duration="more-than-12-months" onclick="updateduration('more-than-12-months')"> > 12 months</span>
            </div>
        </div>
    </div>
</div>
                      
                                              
                                            </div>
                                        </div>
                                            
                                          </div>
                                        <div class="row">
                                        <div class="col-md-12 text-center">
                                            <a class="btn btn-orange ml-auto js-btn-next btn_save_quation next3" href="javascript:void(0)"  title="Next" id="first_next">Next Step <i class="fa fa-angle-right ml-2"></i></a>
                                          </div>
                                        </div>                              
                                      
                                      </div>
                                    </div>
                              </div>
                            </div>
                      </div>
                  </div>
              </div>
      
      </div>
    </div>








 
 <script src="https://safestorage.in/back/assets/select2/select2.min.js"></script>

  <script>
    var beauty = new SelectBeauty({
      el: '#work-condition',
      placeholder: 'Select type of cot',
      length: 0,
      max: 50,
      selected: [7,11,17,1]
    });
  </script> 
   
  <script type="">
$(document).ready(function(){

  <?php if($hometype=='4bhk') { ?>

    $('#bhk_modal').modal('show');
  <?php } ?>
 // $("#msform1").validate();
    var nowDate = new Date();
    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);

    // $("#storage_date").datepicker({ 
    //     autoclose:true,
    //     format:'dd/mm/yyyy',
    //     startDate: today,
    //     todayHighlight: true 
    // });
  })



$('.transport').on('click', function(event){
  $("#transport").prop('checked', true);
     transport = $("#transport").val();
   $('#transport_type').val(transport);
    if(transport=='1')
   {
      /*$('.show_on_transport_select').css('display','block');*/

      $('.show_on_transport_select').css('display','none');
      $('.on_floor_select').css('display','none');
   }
   else
   {  

      $('.show_on_transport_select').css('display','block');
      /*$('.show_on_transport_select').css('display','none');
      $('.on_floor_select').css('display','none');*/
   }
});
$('.transport1').on('click', function(event){
  $("#transport1").prop('checked', true);
   transport = $("#transport1").val();
   $('#transport_type').val(transport);
    if(transport=='1')
   {
      /*$('.show_on_transport_select').css('display','block');*/

      $('.show_on_transport_select').css('display','none');
      $('.on_floor_select').css('display','none');
   }
   else
   {  

      $('.show_on_transport_select').css('display','block');
      /*$('.show_on_transport_select').css('display','none');
      $('.on_floor_select').css('display','none');*/
   }
});
/*$(document).on('click','#transport','#transport1',function(event){  */

 $('#transport,#transport1').on('click', function(event){

   transport = $(this).val();
   if(transport=='1')
   {
      /*$('.show_on_transport_select').css('display','block');*/

      $('.show_on_transport_select').css('display','none');
      $('.on_floor_select').css('display','none');
   }
   else
   {  

      $('.show_on_transport_select').css('display','block');
      /*$('.show_on_transport_select').css('display','none');
      $('.on_floor_select').css('display','none');*/
   }

   $('#transport_type').val(transport);

});


$(document).on('click','.pickup_floor',function(event){  
    event.preventDefault(); 

    var floor = $(this).attr("data-value");



   if(floor=='basement' || floor=='ground')
   {
      $('.on_floor_select').css('display','none');
   }
   else
   {
      $('.on_floor_select').css('display','');
   }

});

  let error_new = 0;
let is_fill=0;
$(document).on('click','#customer_name,.customer_local_city,#pickup_address,.pickup_floor,.pickup_lift',function(event){  

//$("#customer_name",".customer_local_city","#pickup_address",".pickup_floor").change(function() {


  error_new=0;



    var pick_upfloor = $("#pickup_floor").val();


    console.log(pick_upfloor);

    if (pick_upfloor == 'basement' || pick_upfloor == 'ground') {

    } else {


      var lift = $("#pickup_lift").val();
       console.log(lift);
      if (lift == '') {
         console.log(lift);
        error_new = 1;
      } else {
         
         

        $('#pickup_lifterror').html('');
      }
       
        console.log(error_new);

    }



  let customer_name = $('#customer_name').val();
  if ($('#customer_name').val() == '') {
    error_new = 1;
  } else {

  }

  var pickup_lat = $("#pickup_lat").val();
    var pickup_lang = $("#pickup_lang").val();
    if (pickup_lat != '' && pickup_lang != '') {} else {
      error_new == 1;
      return false;
    }



  var transport_type = $('#transport_type').val();
  if (transport_type == 0 || transport_type == '') {
    var pickupAddress = $('#pickup_address').val().trim();
if (pickupAddress == '') {
    showError("Please select a pickup address.");
    error_new = 1;
} 
else {
      clearError();
    }
    if ($('#pickup_floor').val() == '') {
      error_new = 1;
    } else {
    }



    
  }

  var pincode = getPincodeFromAddress(pickupAddress);






  console.log(error_new)

  if (error_new == 1) {
    return false;
  }


   $('.show_details').show();

   is_fill=1;

  
})


$(document).on('click','.btn_save_quation',function(event){  
    event.preventDefault(); 
   //$("#msform1").validate();



    var $error=0;


     let customer_name = $('#customer_name').val();


      if($('#customer_name').val()==''){
        $('#customer_name').addClass('error');
        $error=1;

        $('#customer_name_err_msg').html('<p style="background-color:#e56868;color: #fff;padding: 3px;">Please enter name.</p>');
              setTimeout(function(){
        $('#customer_name_err_msg').html('');
        },3000);

      }
      else{
          $('#customer_name').removeClass('error');
      }

  
    if($('#customer_local_city').val()==''){

       $('#customer_local_cityerror').html('<p style="background-color:#e56868;color: #fff;padding: 3px;">Please select city</p>');
              setTimeout(function(){
        $('#customer_local_cityerror').html('');
        },3000);


      // $('#customer_local_cityerror').html('please select city');
       $error=1;     
    }
    else{
        $('#customer_local_city').removeClass('error');
    }


    if($('#customer_area').val()==''){

       $('#customer_areaerror').html('<p style="background-color:#e56868;color: #fff;padding: 3px;">Please select Area</p>');
              setTimeout(function(){
        $('#customer_areaerror').html('');
        },3000);


      // $('#customer_areaerror').html('please select city');
       $error=1;     
    }
    else{
        $('#customer_area').removeClass('error');
    }


    

  


    var transport_type=$('#transport_type').val();

    if(transport_type==0 || transport_type==''){

      if($('#pickup_address').val()==''){

        $('#pickup_address').addClass('error');
        $error=1;  
      }
      else{
          $('#pickup_address').removeClass('error');
      }

    if($('#pickup_floor').val()==''){
      $('#pickup_floorerror').html('please select floor');
       $error=1; 
    }
    else{
        $('#pickup_floorerror').html('');
    }

    var pick_upfloor=$("#pickup_floor").val();


    console.log(pick_upfloor);

     if(pick_upfloor=='basement' || pick_upfloor=='ground')
   {
       //$('#pickup_lifterror').html('');
     // $('.on_floor_select').css('display','none');
   }
   else
   {

        var lift= $("#pickup_lift").val();

        //alert(lift);
        if(lift==''){


       $('#pickup_lifterror').html('<p style="background-color:#e56868;color: #fff;padding: 3px;">Please select lift</p>');
              setTimeout(function(){
        $('#pickup_lifterror').html('');
        },3000);


         // $('#pickup_lifterror').html('please select lift');
           $error=1; 
        }else{
          $('#pickup_lifterror').html('');
        }
   }

    var customer_local_city = $("#customer_local_city").val();
    let option_city=customer_local_city.charAt(0).toUpperCase() + customer_local_city.slice(1);

  
    var from_location_city = $("#from_location_city").val();



    if($("#from_location_city").val() =='Bengaluru'){
        from_location_city = 'Bangalore';
    }

    /*console.log(customer_local_city);
    console.log(from_location_city);

    if(from_location_city != option_city){
        $("#address_err_msg").html('location must be from '+customer_local_city+" city.");
        window.scrollTo(0, 0); 
        setTimeout(function(){ $("#address_err_msg").html(''); }, 3000);
        return false;
    }*/


    /*var pickup_lat  = $("#pickup_lat").val();
    var pickup_lang = $("#pickup_lang").val();
    if(pickup_lat !='' && pickup_lang !=''){}else{
      $('#address_err_msg').html('<p style="background-color:#e56868;color: #fff;padding: 3px;">Please enter valid google location.</p>');
              setTimeout(function(){
        $('#address_err_msg').html('');
        },3000);
        window.scrollTo(0, 0); 
      
        $error==1;
        return false;
    } */  
  }

    if($error==1){
      return false;
    }
    else{
     
     if(is_fill==1){
      let customer_email = $('#customer_email').val();
  let customer_contact1 = $('#customer_contact1').val();
  var $error = 0;


   if($('#customer_contact1').val()==''){
        $('#customer_contact1').addClass('error');
              $('#contact_err_msg').html('<p style="background-color:#e56868;color: #fff;padding: 3px;">Please enter contact.</p>');
        setTimeout(function(){
            $('#contact_err_msg').html('');
            
        },3000);
         $error=1;
           return false;
      }
      else{
          $('#customer_contact1').removeClass('error');
      }

        if($('#customer_contact1').val().length != 10){  
          $('#contact_err_msg').html('<p style="background-color:#e56868;color: #fff;padding: 3px;">Please enter 10 digit only.</p>');
          setTimeout(function(){
              $('#contact_err_msg').html('');
              
          },3000);
           $error=1;
            return false;
        }



  if ($('#customer_email').val() == '') {
    $('#customer_email').html('<p style="background-color:#e56868;color: #fff;padding: 3px;">Please enter valid email.</p>');
    setTimeout(function() {
      $('#customer_email').html('');
    }, 3000);
    $error = 1;
  } else {
    $('#customer_email').removeClass('error');
  }
  if (IsEmail($('#customer_email').val()) == false) {
    $error = 1;
    $('#customer_email').addClass('error');
    $('#email_err_msg').html('<p style="background-color:#e56868;color: #fff;padding: 3px;">Please enter valid email.</p>');
    setTimeout(function() {
      $('#email_err_msg').html('');

    }, 3000);
    return false;
  }



     
     }
    }



if(is_fill==0){
    error_main=0;
  $('.show_details').show();
    if($('#customer_contact1').val()==''){
      $('#customer_contact1').addClass('error');
      $('#contact_err_msg').html('<p style="background-color:#e56868;color: #fff;padding: 3px;">Please enter contact.</p>');
      setTimeout(function(){
      $('#contact_err_msg').html('');

      },3000);
      error_main=1;
      return false;
    }
    else{
      $('#customer_contact1').removeClass('error');
    }

  if($('#customer_contact1').val().length != 10){  
    $('#contact_err_msg').html('<p style="background-color:#e56868;color: #fff;padding: 3px;">Please enter 10 digit only.</p>');
    setTimeout(function(){
    $('#contact_err_msg').html('');

    },3000);
     error_main=1;
     return false;
  }



  if ($('#customer_email').val() == '') {
    $('#customer_email').html('<p style="background-color:#e56868;color: #fff;padding: 3px;">Please enter valid email.</p>');
    setTimeout(function() {
    $('#customer_email').html('');
    }, 3000);
    error_main = 1;
  } else {
     $('#customer_email').removeClass('error');
  }


  if (IsEmail($('#customer_email').val()) == false) {
    error_main= 1;
    $('#customer_email').addClass('error');
    $('#email_err_msg').html('<p style="background-color:#e56868;color: #fff;padding: 3px;">Please enter valid email.</p>');
    setTimeout(function() {
    $('#email_err_msg').html('');

    }, 3000);
    return false;
  }

  if(error_main==0){
      is_fill=1;
  }

}

step3();

});



      











/* function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}*/


$('#pickup_address').on('keyup', function() {

     var searchvalue=$('#pickup_address').val();
      $.ajax({
                url: 'https://safestorage.in/customer/google_api_call',
                type: 'POST',
                data: {'from_call':'test','value':searchvalue},
                success: function(response) {
                }
        });

 })


$("#pickup_address").focus(function(){
    var from_location = document.getElementById('pickup_address');
    var options = {componentRestrictions: {country: 'in'}};
    var autocomplete = new google.maps.places.Autocomplete(from_location,options);


     $.ajax({
                url: 'https://safestorage.in/customer/google_api_call',
                type: 'POST',
                data: {'from_call':'test','value':'back'},
                success: function(response) {
                }
        });



    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        clearError();
        var place = autocomplete.getPlace();
        let lat = place.geometry.location.lat();
        let long = place.geometry.location.lng();
        var pincode = '';

        // Extract pincode from address components
        place.address_components.forEach(function(component) {
            if (component.types.includes('postal_code')) {
                pincode = component.long_name;
            }
        });
        document.getElementById('pickup_lat').value = lat;
        document.getElementById('pickup_lang').value = long;


         $.ajax({
                url: 'https://safestorage.in/customer/google_api_call',
                type: 'POST',
                data: {'from_call':'test','value':from_location},
                success: function(response) {
                }
        });

         
        ///document.getElementById('pickup_pincode').value = pincode; // Set pincode directly here

        //console.log(pincode);

       // getLocationDetails(lat,long,'from_location_city');

        // You can use pincode variable here for further processing if needed
    });
});



/*$("#pickup_address").focus(function(){


        var from_location = document.getElementById('pickup_address');
        // new google.maps.places.Autocomplete(from_location);
         var options = {componentRestrictions: {country: 'in'}};
        var autocomplete = new google.maps.places.Autocomplete(from_location,options);
        // console.log("_"+autocomplete);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
          clearError();
            var place = autocomplete.getPlace();
           let =long = lat =''; 

     
        document.getElementById('pickup_lat').value = lat = place.geometry.location.lat();
        document.getElementById('pickup_lang').value = long = place.geometry.location.lng();

        //getLocationDetails(lat,long,'from_location_city');


        });

});*/


$("#pickup_address").blur(function() {
    var address = $(this).val();
    if (address.trim() !== "" || address.trim() == "") {
        showError("Please select a location from the autocomplete suggestions.");
    }
});


function getLocationDetails(latitude,longitude,field_name){
    var geocoder;
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(latitude, longitude);

    geocoder.geocode(
        {'latLng': latlng}, 
        function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {

                var index = 0;//results.length-1;

                var country = results[index].formatted_address;

                /*$(`#${field_name}_country`).val(country);*/
                
                if (results[0]) {
                    var add= results[0].formatted_address ;

                    var value=add.split(",");

                    IsplaceChange = true;
                   
                    count=value.length;
                    country=value[count-1];
                    state=value[count-2];
                    city=value[count-3];
                    

                    console.log(results);
                    $(`#${field_name}`).val($.trim(city));

                      console.log($(`#${field_name}`).val());

                    /*for zipcode*/

                    let postal='';

                    let result=results[0].address_components;

                    for(var i=0;i<result.length;++i){

                         if(result[i].types[0]=="postal_code"){

                            postal = result[i].long_name;
                             console.log(postal);
                            break;
                         }
                    }
 
                    console.log(postal);

                document.getElementById('pickup_pincode').value = postal;

                $("#pickup_pincode").val(postal);


                    //$(`#${field_name}_zipcode`).val(postal);

                }
                else  {
                   // x.innerHTML = "address not found";
                }
            }
            else {
                //x.innerHTML = "Geocoder failed due to: " + status;
            }
        }
    );
}


function getPincodeFromAddress(address) {
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'address': address }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                var addressComponents = results[0].address_components;
                for (var i = 0; i < addressComponents.length; i++) {
                    var types = addressComponents[i].types;
                    if (types.indexOf('postal_code') !== -1) {
                        return addressComponents[i].long_name;
                    }
                }
            }
        }
        return null; // Return null if pincode is not found or geocoding fails
    });
}





function isAddressSelectedFromDropdown(address) {
    // This function checks if the entered address is selected from the autocomplete dropdown
    var place = autocomplete.getPlace();
    return place && place.formatted_address == address;
}

function showError(message) {
    var errorElement = $('#error-message');
    errorElement.html(message);
    errorElement.show(); // Show the error message
}

function clearError() {
    var errorElement = $('#error-message');
    errorElement.html(""); // Clear the error message
    errorElement.hide(); // Hide the error message
}



 </script>
    </body>
        <script type="">
             // navbar scroll
            $(window).scroll(function() {    
                var scroll = $(window).scrollTop();

                 //>=, not <=
                if (scroll >= 50) {
                    //clearHeader, not clearheader - caps H
                    $(".navbar").addClass("bg-navbar");
                }
                else{
                    $(".navbar").removeClass("bg-navbar");
                }
            }); //missing );

            // navbar mobile
            $(function() {
              $('#ChangeToggle').click(function() {
                $('#navbar-hamburger').toggleClass('show');
                $('#navbar-close').toggleClass('show');  
              });
            });



        </script>


<script>
$(document).ready(function() { 
    $("#customer_contact1 ").on("keyup", function() {
       // var mobileNumber = $(this).val();

      let customer_name = $('#customer_name').val();
      let customer_email = $('#customer_email').val();
      let customer_contact1 = $('#customer_contact1').val();
      let duration = $('.duration-value.active').data('duration');

        // Check if the entered mobile number has reached 10 digits
        if (customer_contact1.length === 10) {
            // AJAX call
            $.ajax({
                url: '<?php echo base_url();?>customer/get_selected_storage_item_k',
                type: 'POST',
                data: {'customer_name':customer_name,'customer_email':customer_email,'customer_contact1':customer_contact1},
                success: function(response) {
                    // Handle the response from the PHP file
                   // alert(response);
                }
            });
        }
    });
});



// new code for radio
  $(document).ready(function() {
    // Hide the business form initially
    $('#business-form').hide();

    // Listen for clicks on radio containers
    $('.radio-container').click(function() {
        // Remove 'selected' class from all radio containers
        $('.radio-container').removeClass('selected');
        // Add 'selected' class to the clicked radio container
        $(this).addClass('selected');
        // Show the corresponding form based on the data-radio attribute
        var radioId = $(this).data('radio');
        $('.form-container').hide(); // Hide all form containers
        $('#' + radioId + '-form').show(); // Show the selected form container
    });

    // Show/hide boxes container based on storage type selection
    $('#storageType').change(function() {
        if ($(this).val() === 'document') {
            $('#boxesContainer').show();
        } else {
            $('#boxesContainer').hide();
        }
    });

    // Function to validate form fields
    function validateForm() {
        // Reset error messages
        $(".error-msg").text("");

        var name = $("#customer_name_business").val().trim();
        var mobile = $("#customer_mobile_business").val().trim();
        var email = $("#customer_email_business").val().trim();
        var storageType = $("#storageType").val();
        var isValid = true;

        // Validate name
        if (name === "") {
            $("#customer_name_err").text("Name is required");
            isValid = false;
        }
        $("#customer_name_business").on("input", function() {
    // Hide the error message when the user starts typing
    $("#customer_name_err").text("");
});

        // Validate phone number
        if (mobile === "") {
            $("#contact_err").text("Phone number is required");
            isValid = false;
        } else if (!isValidMobileNumber(mobile)) {
            $("#contact_err").text("Please enter a valid 10-digit number");
            isValid = false;
        }
        $("#customer_mobile_business").on("input", function() {
    // Hide the error message when the user starts typing
    $("#contact_err").text("");
});

        // Validate email
        if (email === "") {
            $("#email_err").text("Email address is required");
            isValid = false;
        } else if (!isValidEmail(email)) {
            $("#email_err").text("Please enter a valid email address");
            isValid = false;
        }
        $("#customer_email_business").on("input", function() {
    // Hide the error message when the user starts typing
    $("#email_err").text("");
});

        // Validate storage type
        if (storageType === "") {
            $("#storage_err").text("Please choose a storage type");
            isValid = false;
        }

        // If "Document Storage" is selected, validate number of boxes
        if (storageType === "document") {
            var boxes = $("#boxes_business").val().trim();
            if (boxes === "") {
                $("#boxes_err").text("Please enter the number of boxes");
                isValid = false;
            }
        }

        return isValid;
    }
$("#boxes_business").on("input", function() {
    // Hide the error message when the user starts typing
    $("#boxes_err").text("");
});
    // Function to validate mobile number
    function isValidMobileNumber(number) {
        var regex = /^[0-9]{10}$/;
        return regex.test(number);
    }

    // Function to validate email address
    function isValidEmail(email) {
        var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    // Validate form on submit
    $(document).on('click', '.btn_save_business', function(event) {
        event.preventDefault();

        // Call validateForm function to check form validity
        if (validateForm()) {
            var formData = $(this).closest('form').serialize();
            console.log("Form Data: " + formData);

            // Example AJAX request
            // Replace this with your actual AJAX request
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url();?>customer/insert_new_data_front',
                data: formData,
                success: function(response) {
                    console.log(response);
                    // Clear all input fields
                    $('input, select').val('');
                    // Show success message
                    $('.submitted').text('Your request has been submitted successfully').addClass('text-success');
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error occurred while submitting data.');
                }
            });
        }
    });

    // Log input data to console as the user types
   

});







    // OTP modal new code






// progress bar new code

$(function() {
    var minPercentage = 20; // Minimum percentage for "Less than 1 month"
    var progressBar = $(".progress-bar");

    // Click event for the progress bar
    $(".progress-bar-container").click(function(event) {
        var clickedPosition = event.pageX - $(this).offset().left;
        updateProgressBar(clickedPosition);
        updateDurationValue(clickedPosition);
    });

    // Click event for each duration value
    $(".duration-value").click(function() {
        var index = $(this).index();
        var progressBarWidth = $(".progress-bar-container").width();
        var percentage = (index * (100 / ($(".duration-value").length - 1)));
        updateProgressBar((percentage / 100) * progressBarWidth);
    });

    // Function to update the progress bar based on position
    function updateProgressBar(barPosition) {
        var progressBarWidth = $(".progress-bar-container").width();
        var percentage = (barPosition / progressBarWidth) * 100;

        // Ensure the progress bar doesn't go below "Less than 1 month"
        if (percentage < minPercentage) {
            percentage = minPercentage;
            progressBar.css("width", minPercentage + "%");
        } else {
            progressBar.css("width", percentage + "%");
        }

        highlightSelectedDuration(percentage);
    }

    // Function to update the duration value based on the position of the progress bar
    function updateDurationValue(barPosition) {
        var progressBarWidth = $(".progress-bar-container").width();
        var percentage = (barPosition / progressBarWidth) * 100;
        var selectedValueIndex = Math.round((percentage / 100) * ($(".duration-value").length - 1));
        updateduration($(".duration-value").eq(selectedValueIndex).data('duration'));
    }

    // Highlight the clicked duration value and remove active class from others
    function highlightSelectedDuration(percentage) {
        var selectedValueIndex = Math.round((percentage / 100) * ($(".duration-value").length - 1));
    
        $(".duration-value").removeClass("active");
        $(".dot").removeClass("active");

        $(".duration-value").eq(selectedValueIndex).addClass("active");
        $(".dot").eq(selectedValueIndex).addClass("active");
    }

    // Loop through each duration value and add dots
    $('.duration-value').each(function() {
        var dot = $('<div class="dot"></div>');
        $('.dots-container').append(dot);
    });

    // Click event for the save button
    $(document).on('click', '.btn_save_quation', function(event) {
        event.preventDefault();
        var selectedDuration = $('.duration-value.active').data('duration');

        if (selectedDuration === '') {
            $('.duration-value.active').addClass('error');
            return false;
        } else {
            console.log("Selected Duration:", selectedDuration);
            // Further actions or AJAX requests can be added here
        }
    });
});

function updateduration(text){
    console.log(text);
    $("#storage_duration").val(text);
}

// Function to close the popup container
function closePopup(popupId) {
        $(popupId).fadeOut();
    }

    $(document).ready(function() {


         $(".choosen").select2();
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


    </body>
</html>