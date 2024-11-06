<style type="text/css">
  .mobile_view{
    visibility: hidden;
  }
  .desktop{
    visibility: visible;
  }


  @media screen and (max-width: 600px) {
  
  .desktop{
  visibility: hidden !important;
}

.mobile_view{
  visibility: visible !important;
}



}
</style>


<div class="modal fade" id="request_popup_room" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered request_popup_room modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body p-0">
          <!-- Contact Details Start -->
        
           
                <div class="modal-header">
                    <h2 class="h2-xl fw-6"> Room Storage Request </h2>
                  <button type="button" class="close" data-dismiss="modal">×</button>
                </div>
             

                <div class="col-md-12 col-12">
                     
                     
                        <form method="post" novalidate="novalidate" class="col rounded-field popup_room_store_form">
                           <p class="popup_popup_room_store_form_message" style="color:green;font-size: 13px"> </p>
                          <div class="form-row mb-4">
                            <label> Select Area (SFT) </label>
                            <select name="rooms" class="form-control" id="getrooms_locations">
                              <option value="">Select Area (SFT)</option>
                              <?php foreach ($room_list as $key => $value) { ?>
                                 <option value="<?php echo $value->id;?>"><?php echo $value->area?></option>    
                               <?php } ?>
                            </select>
                          </div>

                          <input type="hidden" name="package" value="room_storage">

                          <div class="form-row mb-4 room_sections" style="display: none;">
                            <div class="col" id="gets_rooms">
                             
                            </div>
                          </div>

                           <div class="form-row mb-4 area_sections" style="display: none;">
                            <div class="col" id="gets_area">
                                 <label> Select Area (SFT) </label>
                                  <input type="text" name="area" class="form-control" placeholder="Area" id="areas_check_value" readonly>
                            </div>
                          </div>

                           <div class="form-row mb-4 area_sections" style="display: none;">
                            <div class="col" id="gets_area">
                                 <label> Width </label>
                                  <input type="text" name="width" class="form-control" placeholder="Area" id="width_check_value" readonly>
                            </div>
                          </div>


                           <div class="form-row mb-4 area_sections" style="display: none;">
                            <div class="col" id="gets_area">
                                 <label> Length </label>
                                  <input type="text" name="length" class="form-control" placeholder="Area" id="length_check_value" readonly>
                            </div>
                          </div>



                          <div class="form-row mb-4">
                            <div class="col">
                              <input type="text" name="mob_no" class="form-control" placeholder="Mobile Number">
                            </div>
                          </div>
                          <div class="form-row mb-4">
                            <div class="col">
                              <input type="text" name="email" class="form-control" placeholder="Email ID">
                            </div>
                          </div>
                          <div class="form-row mb-4">
                            <div class="col">
                                 <textarea rows="7" placeholder="Message" class="form-control" name="message"></textarea>
                            </div>
                          </div>

                          <div class="g-recaptcha" data-sitekey="<?php echo recaptcha_site_key();?>"></div>
                          <span class="error_msg" style="color:red"></span>
                          <br>

                            <!-- <p class="popup_popup_room_store_form_message" style="color:green;font-size: 13px"> </p> -->
                          <div class="form-row text-center">
                              <button type="submit" class="btn btn-orange ml-auto js-btn-next" style="color:white" id="submit_task_room">Get a Quote <i class="icofont-rounded-right"></i></button>
                          </div>
                      </form>
                    
                </div>
            
            </div>
         
          <!-- Contact Details End -->
        </div>
      </div>
    </div>
    <!-- Request Modal -->



<div class="modal fade" id="request_popup" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered request_popup modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body p-0">
          <!-- Contact Details Start -->
          <section class="pos-rel bg-light-gray">
            <div class="container-fluid p-0">


              <div class="modal-header">
                 <h2 class="h2-xl  fw-6">Request A Quote </h2>
                  <button type="button" class="close" data-dismiss="modal">×</button>

              </div>
              
              <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                  <i class="icofont-close-line"></i>
                </a>
            
              <div class="d-lg-flex justify-content-end no-gutters mb-spacer-md" style="box-shadow: 0px 18px 76px 0px rgba(0, 0, 0, 0.06);">
                <div class="col bg-fixed bg-img-7 request_pag_img">
                    &nbsp;
                </div>


                <div class="col-md-7 col-12">
                    <div class="px-3 m-5">
                        <form method="post" novalidate="novalidate" class="col rounded-field popup_quote_form">
                          <p class="popup_quote_form_message" style="color:green;font-size: 13px"> </p>

                           <div class="form-row mb-4 form-group">
                                 <select name="package" class="custom-select form-control" aria-required="true" aria-invalid="false" style="    padding: 13px;border: 1px solid">
                              <option value="">Select Storage Type  <i class="fa fa-angle-double-up form-control-icon fa-fw"></i></option>
                              <option selected value="business_storage">Business Storage</option>
                              <option value="household_storage">Household Storage</option>
                              <option value="document_storage">Document Storage</option>
                              <!-- <option value="Personal Storage">Personal Storage</option> -->
                            </select>
                           </div>
                          <div class="form-row mb-4">
                            <div class="col">
                              <input type="text" name="mob_no" class="form-control" placeholder="Mobile Number">
                            </div>
                          </div>
                          <div class="form-row mb-4">
                            <div class="col">
                              <input type="text" name="email" class="form-control" placeholder="Email ID">
                            </div>
                          </div>
                          <div class="form-row mb-4">
                            <div class="col">
                                 <textarea rows="7" placeholder="Message" class="form-control" name="message"></textarea>
                            </div>
                          </div>
                          <!-- <div class="form-row mb-4">
                              <div class="col math-eqn" style="text-align: left;padding-top: 15px;padding-left: 20px;">1 + 7 =
                              </div>
                            <div class="col">
                                <input type="text" name="email" class="form-control" >
                            </div>
                          </div> -->
                         <!--  <p>Solve this simple math problem and enter the result. E.g. for 1+7, enter 8.</p> -->
                         <!--  <div class="g-recaptcha" data-sitekey="6Le1VrYZAAAAAFEIn0Tyu3z49cf9YyN0pnv2tixp"></div> -->
                          <span class="error_msg" style="color:red"></span>
                          <br>
                          <div class="form-row text-center">
                              <!--  <a class="btn btn-orange ml-auto js-btn-next" href="javascript:void(0)" onclick="checkinvitems()" title="Next">Next Step -->

                              <button type="submit" class="btn btn-orange ml-auto js-btn-next" style="color:white"  id="submit_task">Get a Quote <i class="icofont-rounded-right"></i></button>
                          </div>
                      </form>
                    </div>
                </div>
              </div>
            </div>
          </section>
          <!-- Contact Details End -->
        </div>
      </div>
    </div>
  </div>


<footer>
    <div class="container">
        <div class="row d-flex align-items-center mb-3 wow fadeInUp" data-wow-duration="1s">
            <div class="col-md-3 col-12">
                <img src="<?php echo base_url(); ?>assets/new_design_css/img/logo.png" class="img-fluid">
            </div>

           


            <?php

              $table_name ="ssf_footer_contact";
              $order_by="ssf_footer_contact.contact_id asc";
              $where = array(
                'status' => '1',
              );
              $contact_data =[];
              $contact_data =  $this->auth_model->getOrderByRow($table_name,$where,$order_by);
               if(!empty($contact_data)){
            ?>
            <div class="col-md-9 col-12">
                <div class="row form-row d-flex justify-content-end">

                   <div class="col-xl-4 col-lg-5 col-sm-6 col-12 text-sm-right text-left mt-sm-0 mt-4">
                        <div class="media d-flex align-items-center text-left">         
                            <div class="media-body">
                                <a class="nav-link hide_btn_cost" href="<?php echo base_url();?>customer/create-quotation"><button class="btn round-btn">Get a free quote</button></a>
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-xl-4 col-lg-5 col-sm-6 col-12 text-sm-right text-left mt-sm-0 mt-4">
                        <div class="media d-flex align-items-center text-left">
                            <img src="<?php echo base_url(); ?>assets/new_design_css/img/s_phone.png" class="img-fluid mr-3">
                            <div class="media-body">
                                <p class="mb-1">Give Us a Call</p>
                                <h5 class="bold m-0"><a href="tel:<?php echo @$contact_data->mobile;?>"><?php echo @$contact_data->mobile;?></a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-sm-6 col-12 text-sm-right text-left mt-sm-0 mt-4">
                        <div class="media d-flex align-items-center text-left">
                            <img src="<?php echo base_url(); ?>assets/new_design_css/img/s_mail.png" class="img-fluid mr-3">
                            <div class="media-body">
                                <p class="mb-1">Send Us a Message</p>
                                <h5 class="bold m-0"><a href="mailto:<?php echo @$contact_data->email;?>"><?php echo @$contact_data->email;?></a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          <?php } ?>
        </div>

        <?php
         $link_head_list=$this->auth_model->getRecords('ssf_footer_link_head',array('status' => '1'));
        $conditions  =[];
        $table_name ="ssf_footer_link_head";
        $conditions['order_by']="ssf_footer_link_head.link_id asc";
        $limit = 2;
        $where = array(
          'status' => '1',
        );
        $link_head_list = $this->auth_model->getRecords($table_name,$where,$conditions,$limit);


        if(!empty($link_head_list)){

          //  foreach ($link_head_list as $key => $link_head) {

        ?>
        <div class="row wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
            <div class="col-12">
                <hr>
            </div>
            <div class="col-lg-4">
                <h3 class="mini-title"><?php echo $link_head_list[0]['heading'];?></h3>
                <p class="pr-xl-3 pr-0">Safe Storage is Bangalore based storage space provider with state of the art security facilities, Catering exclusive storage solutions ranging from Household items storage to Records storage management. Safestorage is the ultimate storage unit to stow all your household, documents & luggages.We offer services In Bangalore, Pune, Chennai, Hyderabad and Mumbai.</p>
            </div>
            <?php
               $where = array(
                 'link_id' => $link_head_list[0]['link_id']
               );
               $conditions['order_by']="ssf_footer_links.footer_link_id asc";
               $table_name ="ssf_footer_links";
               $link_list = $this->auth_model->getRecords($table_name,$where,$conditions);
               //echo"<pre>";print_r($link_list);die();
            ?>

            <div class="col-lg-2 col-sm-6">
                <h3 class="mini-title">Company</h3>
                <ul class="pl-0 mb-0">

                  <li><a href="<?php echo base_url(); ?>services"><p> Services</p></a></li>

                  <?php if(!empty($link_list)){
                    foreach ($link_list as $key => $link) {
                  ?>
                  <li><a href="<?php echo base_url();?><?php echo str_replace('_', '-',$link['link_slug']);?>"><p> <?php echo $link['title'];?></p></a></li>

                     <?php }} ?>
                </ul>
            </div>

            <?php
               $where = array(
                 'link_id' => $link_head_list[1]['link_id']
               );
               $conditions['order_by']="ssf_footer_links.footer_link_id asc";
               $table_name ="ssf_footer_links";
               $link_list_second = $this->auth_model->getRecords($table_name,$where,$conditions);
               //echo"<pre>";print_r($link_list);die();
            ?>
            <div class="col-lg-2 col-sm-6">
                <h3 class="mini-title">Quick Link</h3>
                <ul class="pl-0 mb-0">
                  <?php if(!empty($link_list_second)){
                    foreach ($link_list_second as $key => $link) {
                  ?>
                  <li><a href="<?php echo base_url();?><?php echo str_replace('_', '-',$link['link_slug']);?>"><p> <?php echo $link['title'];?></p></a></li>

                     <?php }} ?>

                    
                </ul>
            </div>

            <!-- <div class="col-lg-2 col-sm-6">
                <h3 class="mini-title">Our Locations</h3>
                <ul class="pl-0 mb-0">
                <li><a href="<?php echo base_url();?>banglore"><p>Bangalore </p></a></li>
                <li><a href="<?php echo base_url();?>mumbai"><p>Mumbai </p></a></li>
                <li><a href="<?php echo base_url();?>pune"><p>Pune </p></a></li>  
                <li><a href="<?php echo base_url();?>hyderabad"><p>Hyderabad </p></a></li> 
                <li><a href="<?php echo base_url();?>chennai"><p>Chennai  </p></a></li> 
                     
                </ul>
            </div>
 -->

            <div class="col-lg-4">
                <h3 class="mini-title">Follow Us</h3>
                <ul class="socials pl-0 mb-0">
                    <li><a target="_blank" href="https://www.facebook.com/safestorage.in"><img src="<?php echo base_url(); ?>assets/new_design_css/img/s_facebook.png" class="img-fluid"></a></li>
                    <li><a target="_blank" href="https://twitter.com/SafeStorage_In"><img src="<?php echo base_url(); ?>assets/new_design_css/img/s_twitter.png" class="img-fluid"></a></li>
                    <li><a target="_blank" href="https://www.linkedin.com/company/safestorage"><img src="<?php echo base_url(); ?>assets/new_design_css/img/s_linkedin.png" class="img-fluid"></a></li>
                    <li><a href="https://www.instagram.com/safestorage.in/"><img src="<?php echo base_url(); ?>assets/new_design_css/img/s_instagram.png" class="img-fluid"></a></li>
                </ul>
            </div>


              <div class="col-12">
                <hr>
            </div>




            
             <div class="col-lg-2 col-sm-6 col-xs-1">
                <h3 class="mini-title"><a href="<?php echo base_url();?>bangalore">Bangalore</a></h3>
                 <ul class="pl-0 mb-0">

                
                  <li><a href="<?php echo base_url();?>bangalore-self-storage"><p>Self Storage</p></a></li>
                  <li><a href="<?php echo base_url();?>bangalore-document-storage"><p>Document Storage</p></a></li>
                  <li><a href="<?php echo base_url();?>bangalore-household-storage"><p>Household Storage</p></a></li>
                  <li><a href="<?php echo base_url();?>bangalore-business-storage"><p>Business Storage</p></a></li>

                  <li><a href="<?php echo base_url();?>bangalore-luggage-storage"><p>Luggage Storage</p></a></li>
                
                
                </ul>
            </div>

            
            <div class="col-lg-2 col-sm-6 col-xs-1">
                <h3 class="mini-title"><a href="<?php echo base_url();?>hyderabad">Hyderabad</a></h3>
                <ul class="pl-0 mb-0">

                  

                  <li><a href="<?php echo base_url();?>hyderabad-self-storage"><p>Self Storage</p></a></li>
                  <li><a href="<?php echo base_url();?>hyderabad-document-storage"><p>Document Storage</p></a></li>
                  <li><a href="<?php echo base_url();?>hyderabad-household-storage"><p>Household Storage</p></a></li>

                  <li><a href="<?php echo base_url();?>hyderabad-business-storage"><p>Business Storage</p></a></li>
                  <li><a href="<?php echo base_url();?>hyderabad-luggage-storage"><p>Luggage Storage</p></a></li>
                
                </ul>
            </div>

            <div class="col-lg-2 col-sm-6 col-xs-1">
                <h3 class="mini-title"><a href="<?php echo base_url();?>chennai">Chennai</a></h3>
                <ul class="pl-0 mb-0">

                

                  <li><a href="<?php echo base_url();?>chennai-self-storage"><p>Self Storage</p></a></li>
                  <li><a href="<?php echo base_url();?>chennai-document-storage"><p>Document Storage</p></a></li>
                  <li><a href="<?php echo base_url();?>chennai-household-storage"><p>Household Storage</p></a></li>

                  <li><a href="<?php echo base_url();?>chennai-business-storage"><p>Business Storage</p></a></li>

                  <li><a href="<?php echo base_url();?>chennai-luggage-storage"><p>Luggage Storage</p></a></li>
                

                
                </ul>
            </div>

            <div class="col-lg-2 col-sm-6 col-xs-1">
                <h3 class="mini-title"><a href="<?php echo base_url();?>pune">Pune</a></h3>
                <ul class="pl-0 mb-0">


                 

                  <li><a href="<?php echo base_url();?>pune-self-storage"><p>Self Storage</p></a></li>
                  <li><a href="<?php echo base_url();?>pune-document-storage"><p>Document Storage</p></a></li>
                  <li><a href="<?php echo base_url();?>pune-household-storage"><p>Household Storage</p></a></li>

                  <li><a href="<?php echo base_url();?>pune-business-storage"><p>Business Storage</p></a></li>

                  <li><a href="<?php echo base_url();?>pune-luggage-storage"><p>Luggage Storage</p></a></li>
                
                </ul>
            </div>

            <div class="col-lg-2 col-sm-6 col-xs-1">
                <h3 class="mini-title"><a href="<?php echo base_url();?>mumbai">Mumbai</a></h3>
                <ul class="pl-0 mb-0">


                 

                  <li><a href="<?php echo base_url();?>mumbai-self-storage"><p>Self Storage</p></a></li>
                  <li><a href="<?php echo base_url();?>mumbai-document-storage"><p>Document Storage</p></a></li>
                  <li><a href="<?php echo base_url();?>mumbai-household-storage"><p>Household Storage</p></a></li>

                  <li><a href="<?php echo base_url();?>mumbai-business-storage"><p>Business Storage</p></a></li>

                  <li><a href="<?php echo base_url();?>mumbai-luggage-storage"><p>Luggage Storage</p></a></li>
                
                </ul>
            </div>

              <div class="col-lg-2 col-sm-6 col-xs-1">
                <h3 class="mini-title"><a href="<?php echo base_url();?>mumbai">Mumbai</a></h3>
                <ul class="pl-0 mb-0">


                 

                  <li><a href="<?php echo base_url();?>mumbai-self-storage"><p>Self Storage</p></a></li>
                  <li><a href="<?php echo base_url();?>mumbai-document-storage"><p>Document Storage</p></a></li>
                  <li><a href="<?php echo base_url();?>mumbai-household-storage"><p>Household Storage</p></a></li>

                  <li><a href="<?php echo base_url();?>mumbai-business-storage"><p>Business Storage</p></a></li>

                  <li><a href="<?php echo base_url();?>mumbai-luggage-storage"><p>Luggage Storage</p></a></li>
                
                </ul>
            </div>

  <div class="col-lg-2 col-sm-6 col-xs-1">
                <h3 class="mini-title"><a href="<?php echo base_url();?>mumbai">Mumbai</a></h3>
                <ul class="pl-0 mb-0">


                 

                  <li><a href="<?php echo base_url();?>mumbai-self-storage"><p>Self Storage</p></a></li>
                  <li><a href="<?php echo base_url();?>mumbai-document-storage"><p>Document Storage</p></a></li>
                  <li><a href="<?php echo base_url();?>mumbai-household-storage"><p>Household Storage</p></a></li>

                  <li><a href="<?php echo base_url();?>mumbai-business-storage"><p>Business Storage</p></a></li>

                  <li><a href="<?php echo base_url();?>mumbai-luggage-storage"><p>Luggage Storage</p></a></li>
                
                </ul>
            </div>


            

            <div class="col-12">
              <?php

                $copyright_data=$this->auth_model->getSingleRecord('ssf_footer_copyright',array('status' => '1'));
              ?>
                <p class="footer-text"> <?php echo @$copyright_data->title;?></p>
            </div>
        </div>
  <?php } //} ?>









    </div>

</footer>


<script src="<?php echo base_url(); ?>assets/new_design_css/js/jquery-3.3.1.slim.min.js" ></script>
<script src="<?php echo base_url(); ?>assets/new_design_css/js/jquery-1.11.1.js"></script>
<script src="<?php echo base_url(); ?>assets/new_design_css/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new_design_css/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new_design_css/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/new_design_css/js/wow.min.js"></script>






  <link href="<?php echo base_url()?>assets/datepicker/datepicker1.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url()?>assets/datepicker/datepicker2.css" rel="stylesheet" type="text/css" />

 <script src="<?php echo base_url()?>assets/datepicker/bootstrap-datepicker.js" type="text/javascript"></script> 


<!--new file-->

   <link href="<?php echo base_url()?>assets/new_design_css/css/jquery-ui.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url()?>assets/new_design_css/css/jquery1-ui.css" rel="stylesheet" type="text/css" /> 


<link href="https://code.jquery.com/ui/1.10.4/themes/cupertino/jquery-ui.css" rel="stylesheet"/>
 <script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js" integrity="sha256-55Jz3pBCF8z9jBO1qQ7cIf0L+neuPTD1u7Ytzrp2dqo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/components/core.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/components/md5.js"></script>

<!--added new datepicker-->
<!-- <script src="<?php echo base_url(); ?>assets/front_new/js/jquery-3.3.1.slim.min.js" ></script>

<script src="<?php echo base_url(); ?>assets/front_new/js/jquery-1.11.1.js"></script>  -->

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.min.js"></script>  -->

<!--End added new datepicker-->

<!--End new file-->
  <script src="<?php echo base_url(); ?>assets/js/bootstrap-dropdownhover.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/fontawesome-all.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/twitter/jquery.tweet.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jflickrfeed.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.waypoints.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.easing.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.counterup.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.easypiechart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.appear.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/wow.min.js"></script>

  <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/additional-methods.js"></script>

  <script src="<?php echo base_url();  ?>assets/js/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>

<script type="text/javascript">
$(function() {


  var nowDate = new Date();
  var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);

    $(".popup_datepicker").datepicker({
      autoclose:true,
      format:'dd/mm/yyyy',
      startDate: today,
      todayHighlight: true
    });




});

$(".contact_form").validate({

  errorClass: 'errors',
  ignore:[],
  rules: {
    'name':{
      required:true,
    },
    'last_name':{
      required:true,
    },

    'mob_no':{
      required:true,
      maxlength:15,
      minlength:1,
      digits:true
    },
    'email':{
      required:true,
      email: true,
    },
    'storage_type':{

      required:true,

    },
    'call_time':{

      required:true,

    }
  },
  submitHandler: function(){

    $(".contact_btn_form").prop("disabled",true);
    var form = $('.contact_form')[0];
    var formData = new FormData(form);

    $.ajax({
      url: '<?php echo base_url();?>frontend/frontend/add_contact_form',
      type: 'POST',
      data: formData,
      datType: 'json',
      processData: false,
      contentType: false,
      success: function(response)
      {
        $(".contact_btn_form").prop("disabled",false);

        if(response == "error")
        {
          $(".error_msg").show();
          $(".error_msg").html("Please select CAPTCHA!");

          setTimeout(function(){ $(".error_msg").html(" "); }, 2000);
        }
        else if(response == "mail_error")
        {
          $(".error_msg").show();
          $(".error_msg").html("There is some issue for mail send.");

          setTimeout(function(){ $(".error_msg").html(" "); }, 2000);
        }
        else
        {
           $('.contact_form')[0].reset();
            $('.contact_form_message').html('Your request has been sent successfully.Our Team contact you soon.');
            setTimeout(function(){
                //$("#request_popup").modal("hide");
                $('.contact_form_message').html('');
               },

              3000);



        /*  $('.contact_form')[0].reset();
          $(".error_msg").html("<p style='color:green;'>Your request has been sent successfully.Our Team contact you soon.</p>");

          setTimeout(function(){ $(".error_msg").html(" "); }, 2000);*/
          // swal({
          //   title: '',
          //   text: 'Your request has been sent successfully.Our Team contact you soon.',
          //   type: 'success',
          //   timer: 4000,
          // });



        }


      }
    });
  },

});



$(".feedback_form").validate({

  errorClass: 'errors',
  ignore:[],
  rules: {
    'name':{
      required:true,
    },
    'last_name':{
      required:true,
    },


    'mob_no':{
      required:true,
      maxlength:15,
      minlength:1,
      digits:true
    },
    'email':{
      required:true,
      email: true,
    },
    'message':{
      noSpace: true,
      required:true,
      noHTMLtags:true,
    },
    'subject':{
      required:true,
    },
     'captcha':{
      required:true,
    },
  },
  submitHandler: function(){

    $(".feedback_btn_form").prop("disabled",true);
    var form = $('.feedback_form')[0];
    var formData = new FormData(form);

    $.ajax({
      url: '<?php echo base_url();?>frontend/frontend/add_feedback_form',
      type: 'POST',
      data: formData,
      datType: 'json',
      processData: false,
      contentType: false,
      success: function(response)
      {
        $(".feedback_btn_form").prop("disabled",false);

        if(response == "error")
        {
          $(".error_msg").show();
          $(".error_msg").html("Please select CAPTCHA!");

          setTimeout(function(){ $(".error_msg").html(" "); }, 2000);
        }
        else if(response == "mail_error")
        {
          $(".error_msg").show();
          $(".error_msg").html("There is some issue for mail send.");

          setTimeout(function(){ $(".error_msg").html(" "); }, 2000);
        }
        else
        {
          $(".error_msg").html("<p style='color:green;'>Thank you for your feedback!</p>");

          setTimeout(function(){ $(".error_msg").html(" "); }, 2000);
          $('.feedback_form')[0].reset();
          // swal({
          //   title: '',
          //   text: 'Thank you for your feedback!',
          //   type: 'success',
          //   timer: 4000,
          // });

        //  $("#add_space_popup").modal("hide");

        }


      }
    });
  },

});

$(".popup_add_space_form").validate({

  errorClass: 'errors',
  ignore:[],
  rules: {
    'name':{
      required:true,
    },
    'last_name':{
      required:true,
    },
     'space':{
      required:true,
    },
     'city':{
      required:true,
    },
      'area':{
      required:true,
    },
    'mob_no':{
      required:true,
      maxlength:15,
      minlength:1,
      digits:true
    },
    'email':{
      required:true,
      email: true,
    },
    'message':{
      noSpace: true,
      required:true,
      noHTMLtags:true,
    }
  },
  submitHandler: function(){

    $(".popup_btn_add_space").prop("disabled",true);
    var form = $('.popup_add_space_form')[0];
    var formData = new FormData(form);

    $.ajax({
      url: '<?php echo base_url();?>frontend/frontend/add_space_request',
      type: 'POST',
      data: formData,
      datType: 'json',
      processData: false,
      contentType: false,
      success: function(response)
      {
        $(".popup_btn_add_space").prop("disabled",false);

        if(response == "error")
        {
          $(".space_error_msg").show();
          $(".space_error_msg").html("Please select CAPTCHA!");

          setTimeout(function(){ $(".error_msg").html(" "); }, 2000);
        }
        else if(response == "mail_error")
        {
          $(".space_error_msg").show();
          $(".space_error_msg").html("There is some issue for mail send.");

          setTimeout(function(){ $(".error_msg").html(" "); }, 2000);
        }
        else
        {


                    // swal({ 
                    // title: "", 
                    // type: "success", 
                    // text:  'Your request has been sent successfully.Our Team contact you soon.',
                    // timer: 1000
                    // });


          //   swal({
          //   title: 'Success',
          //   text: 'Your request has been sent successfully.Our Team contact you soon.',
          //   type: 'success',
          //   timer: 4000,
          // });


          $(".space_error_msg").html("<p style='color:green'>Your request has been sent successfully.Our Team contact you soon.</p>");

          setTimeout(function(){ $(".space_error_msg").html(" "); }, 2000);

           $('.popup_add_space_form')[0].reset();
          

          //$("#add_space_popup").modal("hide");

        }


      }
    });
  },

});



$(document).ready(function() {
    // Form validation
    $(".popup_add_space_form_save").validate({
        errorClass: 'errors',
        ignore: [],
        rules: {
            'city_name': {  // Corrected field name
                required: true
            },
            'bhk_name': {  // Corrected field name
                required: true
            },
            'mob_no': {
                required: true,
                maxlength: 15,
                minlength: 10,  // Changed to 10 to match the backend validation
                digits: true
            },
            'email': {
                required: true,
                email: true
            }
        },
        submitHandler: function(form) {
            $(".popup_btn_add_space").prop("disabled", true);
            var formData = new FormData(form);

            $.ajax({
                url: '<?php echo base_url();?>frontend/add_rent_saver_data', // Corrected URL
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    $(".popup_btn_add_space").prop("disabled", false);
                    if (response.status === "error") {
                        $(".space_error_msg").show().html(response.message);
                    } else if (response.status === "mail_error") {
                        $(".space_error_msg").show().html("There is some issue for mail send.");
                    } else {
                        $(".space_error_msg").html("<p style='color:green'>Your request has been sent successfully. Our team will contact you soon.</p>");
                        setTimeout(function() {
                            $(".space_error_msg").html(" ");
                        }, 2000);
                        $('.popup_add_space_form_save')[0].reset();
                    }
                }
            });
        }
    });

    // Show email and phone fields when city and BHK type are selected
    function toggleFields() {
        var citySelect = $('#city_name').val();
        var bhkSelect = $('#bhk_name').val();
        if (citySelect && bhkSelect) {
            $('#email').show();
            $('#mob_no').show();
            $('#submit-btn').prop("disabled", false);
        } else {
            $('#email').hide();
            $('#mob_no').hide();
            $('#submit-btn').prop("disabled", true);
        }
    }

    $('#city_name, #bhk_name').on('change', toggleFields);
});



    $( document ).ready(function() {
        new WOW().init();
    });

    $(window).scroll(function() {
        if ($(this).scrollTop() >100) {
          $('#header').addClass('fixed-top');
        } else {
          $('#header').removeClass('fixed-top');
        }
      });

    $('#client_carousel').owlCarousel({
      loop: true,
      margin: 10,
      nav: false,
      autoplay: true,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 3
        },
        1000: {
          items: 5
        }
      }
    })

    $('#testimonial_carousel').owlCarousel({
      loop: true,
      margin: 10,
      nav: false,
      autoplay: true,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 2
        },
        991: {
          items: 1
        },
        1200: {
          items: 2
        }
      }
    })

    // hero animation

    // $(window).scroll(function() {
    //     if ($(this).scrollTop() >1) {
    //        let image = document.getElementById("hero-img-sofa");
    //        let image1 = document.getElementById("hero-img-tv");
    //        let image2 = document.getElementById("hero-img-bad");
    //        let image3 = document.getElementById("hero-img-camera");
    //        let image4 = document.getElementById("hero-img-lamp");
    //        let image5 = document.getElementById("hero-img-car");
    //        let image6 = document.getElementById("hero-img-files");
    // image.style.transform = "rotate(10deg) translate(20px, 30px)";
    // image1.style.transform = "rotate(-10deg) translate(-10px, 10px)";
    // image2.style.transform = "perspective(500px) translate3d(-50px, 10px, 3px)";
    // image3.style.transform = "perspective(500px) translate3d(-20px, 0px, 3px)";
    // image4.style.transform = "perspective(500px) translate3d(-50px, 10px, 3px)";
    // image5.style.transform = "perspective(500px) translate3d(-20px, 0px, 3px)";
    // image6.style.transform = "perspective(500px) translate3d(20px, 0px, 3px)";
    //     } else {
    //      let image = document.getElementById("hero-img-sofa");
    //        let image1 = document.getElementById("hero-img-tv");
    //        let image2 = document.getElementById("hero-img-bad");
    //        let image3 = document.getElementById("hero-img-camera");
    //        let image4 = document.getElementById("hero-img-lamp");
    //        let image5 = document.getElementById("hero-img-car");
    //        let image6 = document.getElementById("hero-img-files");
    // image.style.transform = "rotate(0deg) translate(0px, 0px)";
    //  image1.style.transform = "rotate(0deg) translate(0px, 0px)";
    //   image2.style.transform = "perspective(500px) translate3d(0px, 0px, 0px)";
    //    image3.style.transform = "perspective(500px) translate3d(0px, 0px, 0px)";
    //     image4.style.transform = "perspective(500px) translate3d(0px, 0px, 0px)";
    //     image5.style.transform = "perspective(500px) translate3d(0px, 0px, 0px)";
    //      image6.style.transform = "perspective(500px) translate3d(0px, 0px, 0px)";
    //     }
    //   });









 $(".quote_form").validate({

    errorClass: 'errors',
    ignore:[],
    rules: {
      'package':{
        required:true,
      },
      'mob_no':{
        required:true,
        maxlength:15,
        minlength:1,
        digits:true
      },
      'email':{
        required:true,
        email: true,
      },
      'message':{
        noSpace: true,
        required:true,
        noHTMLtags:true,
      }
    },
    submitHandler: function(){

      $(".btn_quote").prop("disabled",true);
      var form = $('.quote_form')[0];
      var formData = new FormData(form);

      $.ajax({

        url: '<?php echo base_url();?>frontend/frontend/submit_request_quote',
        type: 'POST',
        data: formData,
        datType: 'json',
        processData: false,
        contentType: false,
        success: function(response)
        {
          $(".btn_quote").prop("disabled",false);

          if(response == "error")
          {
            $(".error_msg").show();
            $(".error_msg").html("Please select CAPTCHA!");

            setTimeout(function(){ $(".error_msg").html(" "); }, 2000);
          }
          else if(response == "mail_error")
          {
            $(".error_msg").show();
            $(".error_msg").html("There is some issue for mail send.");

            setTimeout(function(){ $(".error_msg").html(" "); }, 2000);
          }
          else
          {

            $('.quote_form')[0].reset();
             swal({
              title: '',
              text: 'Your request has been sent successfully.Our Team contact you soon.',
              type: 'success',
              timer: 4000,
            });


            //setTimeout(function(){ location.reload(); }, 3000);
          }


        }
      });
    },

  });

  $(".popup_quote_form").validate({

    errorClass: 'errors',
    ignore:[],
    rules: {
      'package':{
        required:true,
      },
      'mob_no':{
        required:true,
        maxlength:15,
        minlength:1,
        digits:true
      },
      'email':{
        required:true,
        email: true,
      },
      'message':{
        noSpace: true,
        required:true,
        noHTMLtags:true,
      }
    },
    submitHandler: function(){

      /*For home and other pages chnage url of form submission*/
      /*var pathname = window.location.pathname;

      var patharray = pathname.split('/');

      var count = patharray.length;

      var url="";
      if(count == 4)
      {
        url = 'frontend/submit_request_quote/';
      }
      else
      {
        url = '../frontend/submit_request_quote/';
      }*/


       $('#submit_task').html('<i class="fa fa-spinner fa-spin" style="color:#fff;"></i>&nbsp;&nbsp;Processing..');
      $('#submit_task').prop('disabled', true);

      $(".popup_btn_quote").prop("disabled",true);
      var form = $('.popup_quote_form')[0];
      var formData = new FormData(form);

      $.ajax({
        url: '<?php echo base_url(); ?>frontend/frontend/submit_request_quote',
        type: 'POST',
        data: formData,
        datType: 'json',
        processData: false,
        contentType: false,
        success: function(response)
        {
          $(".popup_btn_quote").prop("disabled",false);

            $('#submit_task').html('Get a Quote ');
          $('#submit_task').prop('disabled', false);

          

          if(response == "error")
          {
            $(".error_msg").show();
            $(".error_msg").html("Please select CAPTCHA!");

            setTimeout(function(){ $(".error_msg").html(" "); }, 2000);
          }
          else if(response == "mail_error")
          {
            $(".error_msg").show();
            $(".error_msg").html("There is some issue for mail send.");

            setTimeout(function(){ $(".error_msg").html(" "); }, 2000);
          }
          else
          {

            $('.popup_quote_form')[0].reset();
            $('.popup_quote_form_message').html('Your request has been sent successfully.Our Team contact you soon.');
            setTimeout(function(){
                $("#request_popup").modal("hide");
                $('.popup_quote_form_message').html('');
               },

              2000);

           /* swal({
              title: '',
              text: 'Your request has been sent successfully.Our Team contact you soon.',
              type: 'success',
              timer: 4000,
            });*/

           // $("#request_popup").modal("hide");

            //setTimeout(function(){ location.reload(); }, 3000);
          }


        }
      });
    },

  });



  $(".popup_add_space_form").validate({

    errorClass: 'errors',
    ignore:[],
    rules: {
      'name':{
        required:true,
      },
       'space':{
        required:true,
      },
       'city':{
        required:true,
      },
        'area':{
        required:true,
      },
      'mob_no':{
        required:true,
        maxlength:15,
        minlength:1,
        digits:true
      },
      'email':{
        required:true,
        email: true,
      },
      'message':{
        noSpace: true,
        required:true,
        noHTMLtags:true,
      }
    },
    submitHandler: function(){

      $(".popup_btn_add_space").prop("disabled",true);
      var form = $('.popup_add_space_form')[0];
      var formData = new FormData(form);

      $.ajax({
        url:'<?php echo base_url();?>frontend/frontend/add_space_request',
        type: 'POST',
        data: formData,
        datType: 'json',
        processData: false,
        contentType: false,
        success: function(response)
        {
          $(".popup_btn_add_space").prop("disabled",false);

          if(response == "error")
          {
            $(".error_msg").show();
            $(".error_msg").html("Please select CAPTCHA!");

            setTimeout(function(){ $(".error_msg").html(" "); }, 2000);
          }
          else if(response == "mail_error")
          {
            $(".error_msg").show();
            $(".error_msg").html("There is some issue for mail send.");

            setTimeout(function(){ $(".error_msg").html(" "); }, 2000);
          }
          else
          {

            $('.popup_add_space_form')[0].reset();
            swal({
              title: '',
              text: 'Your request has been sent successfully.Our Team contact you soon.',
              type: 'success',
              timer: 4000,
            });

            $("#add_space_popup").modal("hide");

          }


        }
      });
    },

  });



var url=window.location.href.replace('<?php echo base_url(); ?>',"");

//console.log(url);
if(url==''){
  $(".home").addClass('active');
}
else if(url=='about-us'){
  $(".about").addClass('active');
}
else if(url=='pricing'){
  $(".pricing").addClass('active');
}
else if(url=='list_warehouse'){
  $(".list_warehouse").addClass('active');
}
else if(url=='contact-us'){
  $(".contact-us").addClass('active');
}
else if(url=='about-personal-storage'){
  $(".service").addClass('active');
}
else if(url=='about-personal-storage' || url=='household-storage' || url=='automobile-storage' || url=='box-storage' || url=='business-storage' || url=='document-storage'){
  $(".service").addClass('active');
}


$(".popup_product_form").validate({

  errorClass: 'errors',
  ignore:[],
  rules: {
    'name':{
      required:true,
    },
    
    'mob_no':{
      required:true,
      maxlength:15,
      minlength:1,
      digits:true
    },
    'email':{
      required:true,
      email: true,
    },
    'products':{

      required:true,

    },
    
  },
  submitHandler: function(){

    $(".popup_product_form_btn").prop("disabled",true);
    var form = $('.popup_product_form')[0];
    var formData = new FormData(form);

    $.ajax({
      url: '<?php echo base_url();?>frontend/frontend/add_product_form',
      type: 'POST',
      data: formData,
      datType: 'json',
      processData: false,
      contentType: false,
      success: function(response)
      {
        $(".popup_product_form_btn").prop("disabled",false);

        if(response == "error")
        {
          $(".error_msg").show();
          $(".error_msg").html("Oops! Something went wrong");

          setTimeout(function(){ $(".error_msg").html(" "); }, 2000);
        }
        
        else
        {
           $('.popup_product_form')[0].reset();
            $('.popup_product_form_message').html('Your request has been sent successfully.Our Team contact you soon.');
            setTimeout(function(){
                $("#product_popup").modal("hide");
                $('.popup_product_form_message').html('');
               },

              3000);


 

        }


      }
    });
  },

});

</script>
<style>
.float_wp_left {
    position: fixed;
       width: 55px;
    height: 55px;
    bottom: 13px;

    left: 20px;
    background-color: #25d366;
    color: #ffffff;
    border-radius: 50px;
    text-align: center;
    font-size: 30px;
    box-shadow: 2px 2px 3px #999;
    z-index: 9999;
    margin-right: 80px;
}
</style>
<a target="_blank" href="https://api.whatsapp.com/send?phone=918088848484&amp;text=Hello" class="float_wp_left">
  <i class="fa fa-comments" aria-hidden="true" style="margin-top:14px"></i>
</a>



<!--for room storage-->
<script type="text/javascript">
    $(".popup_room_store_form").validate({

    errorClass: 'errors',
    ignore:[],
    rules: {
      // 'locations':{
      //   required:true,
      // },
    'rooms':{
        required:true,
      },
    // 'area':{
    //     required:true,
    //   },
      'mob_no':{
        required:true,
        maxlength:15,
        minlength:1,
        digits:true
      },
      'email':{
        required:true,
        email: true,
      },
      'message':{
        noSpace: true,
        required:true,
        noHTMLtags:true,
      }
    },
    submitHandler: function(){
      $(".popup_btn_rooms_store").prop("disabled",true);
      var form = $('.popup_room_store_form')[0];
      var formData = new FormData(form);

       $('#submit_task_room').html('<i class="fa fa-spinner fa-spin" style="color:#fff;"></i>&nbsp;&nbsp;Processing..');
      $('#submit_task_room').prop('disabled', true);

      $.ajax({
        url: '<?php echo base_url();?>frontend/submit_request_quote',
        type: 'POST',
        data: formData,
        datType: 'json',
        processData: false,
        contentType: false,
        success: function(response)
        {
            $('#submit_task_room').html('Get a Quote ');
            $('#submit_task_room').prop('disabled', false);


          $(".popup_btn_rooms_store").prop("disabled",false);

          if(response == "error")
          {
            $(".error_msg").show();
            $(".error_msg").html("Please select CAPTCHA!");

            setTimeout(function(){ $(".error_msg").html(" "); }, 2000);
          }
          else if(response == "mail_error")
          {
            $(".error_msg").show();
            $(".error_msg").html("There is some issue for mail send.");

            setTimeout(function(){ $(".error_msg").html(" "); }, 2000);
          }
          else
          {


            
                    swal({ 
                    title: "", 
                    type: "success", 
                    text:  'Your request has been sent successfully.Our Team contact you soon.',
                    timer: 1000
                    });



                // swal({
                // title: 'Success !',
                // text: 'Your request has been sent successfully.Our Team contact you soon.',
                // type: 'success'
                // });



            
                $('html, body').animate({
                scrollTop: $('html, body').offset().top,
                }, 1000);


            $('.popup_room_store_form')[0].reset();
             $('.popup_popup_room_store_form_message').html('Your request has been sent successfully.Our Team contact you soon.');
            setTimeout(function(){
                $("#request_popup_room").modal("hide");
                $('.popup_product_form_message').html('');
               },
              3000);

           // $("#request_popup_room").modal("hide");

            //setTimeout(function(){ location.reload(); }, 3000);
          }


        }
      });
    },

  });

// $(document).ready(function() {
//   $('#getrooms_locations').change(function() {
//     var location = $(this).val();
//     $.ajax({
//       url: '<?php echo base_url();?>customer/getrooms_locations',
//       type: 'post',
//       data: {location: location},
//       success: function(response) {
//         $('.room_sections').show();
//         $('#gets_rooms').html(response);
//       }
//     });
//   });
// });

// $(document).on('change', '#get_rooms_details', function() {
//     var location = $('#get_rooms_details').val();
//     console.log(location);

//     $.ajax({
//       url: '<?php echo base_url();?>customer/get_rooms_details',
//       type: 'post',
//       data: {room: location},
//       success: function(response) {
//          data = JSON.parse(response);
//         $('.area_sections').show();
//         $('#areas_check_value').val(data.area);
//         $('#length_check_value').val(data.length);
//         $('#width_check_value').val(data.width);
//       }
//     });
// });



</script>
</body>
</html>
