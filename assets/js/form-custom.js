  var banner_table;

  var storage_type_table,feature_Table,home_About_Us_Table,clients_Table,customer_Thought_Table;
  var email_template_table;
  var manage_posts_table;
  var household_banner_table,household_Facility_Table,householdPropertyTable;
  var business_Banner_Table,business_Facility_Table,business_Property_Table,pricing_Automobile_Table;
  var document_banner_table,document_property_table,document_Facility_Table,pricing_Table,pricing_Banner_Table,pricing_box_storage;
  var offerimg ='';
  var offerval = '';
  $(document).ready(function(){

   
      $(".add_banner").click(function(){
        $("#bannerForm").validate().resetForm();
        $(".banner_img").html(" ");
        $("#banner_id").attr("value",'');
      });

      $(".add_template").click(function(){
        $("#add_template_form").validate().resetForm();
        $("#add_template_form")[0].reset();
        CKEDITOR.instances['Editor'].setData();
        $("#template_id").attr("value",'');
      });


      /*Function to add Storage type-Swati*/

      $(".add_storage_type").click(function(){
        $("#storageTypeForm").validate().resetForm();
        $("#storageTypeForm")[0].reset();
        CKEDITOR.instances['Editor'].setData();
        $("#storage_type_id").attr("value",'');
      });

      /*End here*/


       /*Function to add Feature -Swati*/

      $(".add_feature").click(function(){
        $("#featureForm").validate().resetForm();
        $("#featureForm")[0].reset();
        CKEDITOR.instances['Editor'].setData();
        $("#feature_id").attr("value",'');
      });

      /*End here*/

       /*Function to add household facility -Swati*/

      $(".add_household_storage_facility").click(function(){
        $("#householdFacilityForm").validate().resetForm();
        $("#householdFacilityForm")[0].reset();
        $("#hs_facility_id").attr("value",'');
      });

      /*End here*/


       /*Function to add pricing automobile -Swati*/

      $(".add_pricing_automobile").click(function(){
        $("#pricingAutomobileForm").validate().resetForm();
        $("#pricingAutomobileForm")[0].reset();
        $("#automobile_id").attr("value",'');
      });

      /*End here*/

        /*Function for clients logo*/

        $(".add_client").click(function(){
        $("#clientForm").validate().resetForm();
        $(".client_img").html(" ");
        $("#client_id").attr("value",'');
      });


       /*Function to add home about us -Swati*/

      $(".add_about_us").click(function(){
        $("#aboutUsForm").validate().resetForm();
        $("#aboutUsForm")[0].reset();
        CKEDITOR.instances['Editor'].setData();
        $("#about_us_id").attr("value",'');
      });

      /*End here*/


      /*Function to add household banner -Swati*/

      $(".add_household_storage_banner").click(function(){
        $("#householdBannerForm").validate().resetForm();
        $("#householdBannerForm")[0].reset();
        CKEDITOR.instances['first_section_description'].setData();

        CKEDITOR.instances['second_section_description'].setData();

        $("#hs_banner_id").attr("value",'');
      });

      /*End here*/

      /*Function to add customer thought -Swati*/

      $(".add_customer_thought").click(function(){
        $("#customerThoughtForm").validate().resetForm();
        $("#customerThoughtForm")[0].reset();
        CKEDITOR.instances['Editor'].setData();
        $("#customer_says_id").attr("value",'');
      });

      /*End here*/


      /*Function to add household property -Swati*/

      $(".household_storage_property").click(function(){
        $("#householdPropertyForm").validate().resetForm();
        $("#householdPropertyForm")[0].reset();
       
        $("#hs_property_id").attr("value",'');
      });

      /*End here*/

      /*Function to add Business Storage banner*/

       $(".add_business_storage_banner").click(function(){
        $("#businessBannerForm").validate().resetForm();
        $("#businessBannerForm")[0].reset();
        CKEDITOR.instances['first_section_description'].setData();

        CKEDITOR.instances['second_section_description'].setData();

        $("#banner_id").attr("value",'');

        $("#bannerImg").html('');
        $("#subsectionImg").html('');
      });



      /*End here*/ 



       /*Function to add business facility -Swati*/

      $(".add_business_storage_facility").click(function(){
        $("#businessFacilityForm").validate().resetForm();
        $("#businessFacilityForm")[0].reset();
        $("#facility_id").attr("value",'');
      });

      /*End here*/


      /*Function to add pricing banner -Swati*/

      $(".add_pricing_banner").click(function(){
        $("#pricingBannerForm").validate().resetForm();
        $("#pricingBannerForm")[0].reset();
        $("#banner_id").attr("value",'');
      });

      /*End here*/


       /*Function to add business property -Swati*/

      $(".business_storage_property").click(function(){
        $("#businessPropertyForm").validate().resetForm();
        $("#businessPropertyForm")[0].reset();
        $("#property_id").attr("value",'');
        CKEDITOR.instances['Editor'].setData('');
      });

      /*End here*/




       /*Function to add Document Storage banner*/

       $(".add_document_storage_banner").click(function(){
        $("#documentBannerForm").validate().resetForm();
        $("#documentBannerForm")[0].reset();
        CKEDITOR.instances['sub_section_description'].setData();

      
        $("#banner_id").attr("value",'');
      });

       /*End here*/


       /*Function to add document property -Swati*/

      $(".document_storage_property").click(function(){
        $("#documentPropertyForm").validate().resetForm();
        $("#documentPropertyForm")[0].reset();
        $("#property_id").attr("value",'');
      });

      /*End here*/


       /*Function to add document facility -Swati*/

      $(".add_document_storage_facility").click(function(){
        $("#documentFacilityForm").validate().resetForm();
        $("#documentFacilityForm")[0].reset();
        $("#facility_id").attr("value",'');
      });

      /*End here*/


       /*Function to add pricing box storage -Swati*/

      $(".add_pricing_box_storage").click(function(){
        $("#pricingBoxStorageForm").validate().resetForm();
        $("#pricingBoxStorageForm")[0].reset();
        $("#storage_id").attr("value",'');
      });

      /*End here*/


      /*Function to add pricing -Swati*/

      $(".add_pricing_item").click(function(){
        $("#pricingForm").validate().resetForm();
        $("#pricingForm")[0].reset();
        $("#pricing_id").attr("value",'');
      });

      /*End here*/






      $(".add_posts").click(function(){
        $("#add_post_form").validate().resetForm();
        $("#add_post_form")[0].reset();
        CKEDITOR.instances['Editor'].setData();
        $("#post_id").attr("value",'');
        $("#postImg").html('');
      });

      $(".add_offer").click(function(){
       // console.log("custom_offer_type 22 Text");
     //  alert();
        $("#add_offer_form").validate().resetForm();
        $("#add_offer_form")[0].reset();
        $("#offer_id").attr("value",'');
        //$(".custom_offer_type").attr("value",'Text');
               // $(".custom_offer_type").val("Text");
        offerimg = '';
        offerval = '';
     // $("input[type='radio']").trigger('click');
        $(":radio[name='offer_type'][value='Text']").attr('checked', 'checked').trigger('click');
       //  $("input[type='radio']").trigger('click');
      });

      $(".resetofferform").click(function(){
       // console.log("custom_offer_type 22 Text");
        $("#add_offer_form").validate().resetForm();
        $("#add_offer_form")[0].reset();
       // $(this).prop('checked', false);
        //$('input[name=offer_type]').attr('checked',false);
        $("[name='offer_type'][value='Text']").removeAttr('checked', 'checked');
        $("[name='offer_type'][value='Image']").removeAttr('checked', 'checked');
        offerimg = '';
        offerval = '';
      });
      

      /*start datatable*/
      banner_table = $('#bannerTable').DataTable({ 
   
          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../banner_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });



  /*start datatable for pricing automobile*/
        pricing_Automobile_Table = $('#pricingAutomobileTable').DataTable({ 
     
            "processing": true, 
            "serverSide": true, 
            "order": [], 
     
            "ajax": {
                "url": "../pricing_automobile_datatable/",
                "type": "POST",
                "data": function (data) {
                 
                }
          },
      });



      /*start datatable for household banner-Swati*/
      household_banner_table = $('#householdBannerTable').DataTable({ 
   

          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../household_banner_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });

      /*End Here*/



       /*start datatable for pricing banner-Swati*/
      pricing_Banner_Table = $('#pricingBannerTable').DataTable({ 
   

          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../banner_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });

      /*End Here*/


       /*start datatable for household property-Swati*/
      householdPropertyTable = $('#household_property_Table').DataTable({ 
   

          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../household_property_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });

      /*End Here*/



      /*start datatable for household facility-Swati*/
      household_Facility_Table = $('#householdFacilityTable').DataTable({ 
   

          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../household_facility_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });

      /*End Here*/



       /*start datatable for pricing box storage-Swati*/
      pricing_box_storage = $('#pricingBoxStorageTable').DataTable({ 
   

          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../pricing_storage_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });

      /*End Here*/


      /*start datatable for pricing-Swati*/
      pricing_Table = $('#pricingTable').DataTable({ 
   

          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../pricing_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });

      /*End Here*/



      /*start datatable for document facility-Swati*/
      document_Facility_Table = $('#documentFacilityTable').DataTable({ 
   

          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../document_facility_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });

      /*End Here*/






      /*start datatable for Storage type -Swati*/
      storage_type_table = $('#storageTypeTable').DataTable({ 
   

          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../storage_type_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });

      /*End Here*/


      /*start datatable for Customer Says -Swati*/
      customer_Thought_Table = $('#customerThoughtTable').DataTable({ 
   

          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../customer_thought_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });

      /*End Here*/


      /*Datatable for feature we provided*/

       feature_Table = $('#featureTable').DataTable({ 
   

          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../feature_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });
      /*End here*/



       /*Datatable for clients*/

       clients_Table = $('#clientsTable').DataTable({ 
   

          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../client_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });
      /*End here*/


       /*Datatable for home about us*/

       home_About_Us_Table = $('#homeAboutUsTable').DataTable({ 
   

          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../about_us_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });
      /*End here*/


       /*start datatable for business storage banner-Swati*/
      business_Banner_Table = $('#BusinessBannerTable').DataTable({ 
   

          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../banner_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });

      /*End Here*/




      /*start datatable for business facility-Swati*/
      business_Facility_Table = $('#businessFacilityTable').DataTable({ 
   

          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../facility_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });

      /*End Here*/


       /*start datatable for business property-Swati*/
      business_Property_Table = $('#businesspropertyTable').DataTable({ 
   

          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../property_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });

      /*End Here*/



      /*start datatable for document banner-Swati*/
      document_banner_table = $('#documentBannerTable').DataTable({ 
   

          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../document_banner_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });

      /*End Here*/


       /*start datatable for document property-Swati*/
      document_property_table = $('#documentpropertyTable').DataTable({ 
   

          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "../document_property_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });

      /*End Here*/





      /*start datatable*/
      email_template_table = $('#emailTemplateTable').DataTable({ 
   
          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "email_template_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });

      /*start datatable*/
      manage_posts_table = $('#managePostsTable').DataTable({ 
   
          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "manage_posts_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });

      /*start datatable*/
      offer_table = $('#offerTable').DataTable({ 
   
          "processing": true, 
          "serverSide": true, 
          "order": [], 
   
          "ajax": {
              "url": "offer_datatable/",
              "type": "POST",
              "data": function (data) {
               
              }
          },
      });

      /**************************************/
      /****** Add and Update email template */
      /**************************************/ 

      $("#add_template_form").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          template_title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },  
          Editor:{
            /*required:true,*/
            required: function(textarea) {
          CKEDITOR.instances[textarea.id].updateElement(); // update textarea
          var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
          return editorcontent.length === 0;
        }
          },
          
        },
        messages: {
   
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".template_btn_submit").prop("disabled",true);
          var form = $('#add_template_form')[0];
          var formData = new FormData(form);

          $.ajax({
              url: 'submit_email_template',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {

                  $(".template_btn_submit").prop("disabled",false);
                  email_template_table.ajax.reload(); 

                  $("#myModal").modal('hide');
                  $('#add_template_form')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      }); 

  /**************************************/
      /****** Add and Update manage post */
      /**************************************/ 

      $("#add_post_form").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          post_title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },  
          Editor:{
           /* required:true,*/
            required: function(textarea) {
              CKEDITOR.instances[textarea.id].updateElement(); // update textarea
              var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
              return editorcontent.length === 0;
            }
          },
          
          post_images:{
            //required:true,
            extension: "gif|jpg|png|jpng|jpeg",
          },
          
        },
        messages: {
              post_images:{
            //required:true,
            extension: "Only PNG , JPEG , JPG, JPEG, GIF File Allowed",
          },
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".post_btn_submit").prop("disabled",true);
          var form = $('#add_post_form')[0];
          var formData = new FormData(form);
          formData.append('Editor',CKEDITOR.instances['Editor'].getData());
          $.ajax({
              url: 'submit_manage_posts',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {

                  $(".post_btn_submit").prop("disabled",false);
                  manage_posts_table.ajax.reload(); 

                  $("#myModal").modal('hide');
                  $('#add_post_form')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });


      
      /****** Add and update storage type *****/
      

      $("#storageTypeForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          storage_type_title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },  
          Editor:{
           /* required:true,*/
            required: function(textarea) {
              CKEDITOR.instances[textarea.id].updateElement(); // update textarea
              var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
              return editorcontent.length === 0;
            }
          },
          
          storage_type_image:{
            //required:true,
            extension: "gif|jpg|png|jpng|jpeg",
          },
          
        },
        messages: {
              storage_type_image:{
            //required:true,
            extension: "Only PNG , JPEG , JPG, JPEG, GIF File Allowed",
          },
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".storage_type_btn_submit").prop("disabled",true);
          var form = $('#storageTypeForm')[0];
          var formData = new FormData(form);
          formData.append('Editor',CKEDITOR.instances['Editor'].getData());
          $.ajax({
              url: '../submit_storage_type',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                  console.log(response);

                  $(".storage_type_btn_submit").prop("disabled",false);
                  //storageTypeTable.ajax.reload();
                  location.reload(); 

                  $("#myModal").modal('hide');
                  $('#storageTypeForm')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });

      /*End here add and update storage type*/



         /****** Add and update household property *****/
      

      $("#householdPropertyForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },  
          Editor:{
           /* required:true,*/
            required: function(textarea) {
              CKEDITOR.instances[textarea.id].updateElement(); // update textarea
              var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
              return editorcontent.length === 0;
            }
          },
          
         
        },
        messages: {
              
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".household_property_btn_submit").prop("disabled",true);
          var form = $('#householdPropertyForm')[0];
          var formData = new FormData(form);
          formData.append('Editor',CKEDITOR.instances['Editor'].getData());
          $.ajax({
              url: '../submit_household_property',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                  console.log(response);

                  $(".household_property_btn_submit").prop("disabled",false);
                  //storageTypeTable.ajax.reload();
                  location.reload(); 

                  $("#myModal").modal('hide');
                  $('#householdPropertyForm')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });

      /*End here add and update household property*/






       /****** Add and update household facility *****/
      

      $("#householdFacilityForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },  
         
          
        },
        messages: {
           
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".household_facility_btn_submit").prop("disabled",true);
          var form = $('#householdFacilityForm')[0];
          var formData = new FormData(form);
         
          $.ajax({
              url: '../submit_household_facility',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                  console.log(response);

                  $(".household_facility_btn_submit").prop("disabled",false);
                  //storageTypeTable.ajax.reload();
                  location.reload(); 

                  $("#myModal").modal('hide');
                  $('#householdFacilityForm')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });

      /*End here add and update household facility*/


      /****** Add and update customer says *****/
      

      $("#customerThoughtForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          customer_name:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          }, 

           customer_designation:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },

           customer_address:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },


          Editor:{
           /* required:true,*/
            required: function(textarea) {
              CKEDITOR.instances[textarea.id].updateElement(); // update textarea
              var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
              return editorcontent.length === 0;
            }
          },
          
          customer_image:{
            //required:true,
            extension: "gif|jpg|png|jpng|jpeg",
          },
          
        },
        messages: {
              customer_image:{
            //required:true,
            extension: "Only PNG , JPEG , JPG, JPEG, GIF File Allowed",
          },
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".customer_says_btn_submit").prop("disabled",true);
          var form = $('#customerThoughtForm')[0];
          var formData = new FormData(form);
          formData.append('Editor',CKEDITOR.instances['Editor'].getData());
          $.ajax({
              url: '../submit_customer_thought',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                  console.log(response);

                  $(".customer_says_btn_submit").prop("disabled",false);
                  //storageTypeTable.ajax.reload();
                  location.reload(); 

                  $("#myModal").modal('hide');
                  $('#customerThoughtForm')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });

      /*End here add and update customer says*/


      /****** Add and update home about us *****/
      

      $("#aboutUsForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {

          about_us_title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },  
           
          Editor:{
           /* required:true,*/
            required: function(textarea) {
              CKEDITOR.instances[textarea.id].updateElement(); // update textarea
              var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
              return editorcontent.length === 0;
            }
          },
          
          about_us_image:{
            //required:true,
            extension: "gif|jpg|png|jpng|jpeg",
          },
          
        },
        messages: {
              about_us_image:{
            //required:true,
            extension: "Only PNG , JPEG , JPG, JPEG, GIF File Allowed",
          },
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".about_us_btn_submit").prop("disabled",true);
          var form = $('#aboutUsForm')[0];
          var formData = new FormData(form);
          formData.append('Editor',CKEDITOR.instances['Editor'].getData());
          $.ajax({
              url: '../submit_about_us',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                  console.log(response);

                  $(".about_us_btn_submit").prop("disabled",false);
                  //storageTypeTable.ajax.reload();
                  location.reload(); 

                  $("#myModal").modal('hide');
                  $('#aboutUsForm')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });

      /*End here add and update storage type*/


      /*Function to add and update clients logo*/


        $("#clientForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          client_img:{ 
            required:true,
            extension: "jpg|jpeg|png|JPG|JPEG|PNG",
          },  
          
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          
              $(".img_error").html(" ");

              $("#client_btn_submit").prop("disabled",true);
              var form = $('#clientForm')[0];
              var formData = new FormData(form);

              $.ajax({
                  url: '../submit_client',
                  type: 'POST',
                  data: formData,
                  datType: 'json',
                  processData: false,
                  contentType: false, 
                  success: function(response) 
                  {
                    $("#client_btn_submit").prop("disabled",false);
                    //banner_table.ajax.reload(); 
                    location.reload();

                    $("#myModal").modal('hide');
                    $('#clientForm')[0].reset();

                    response = jQuery.trim(response);
                    if(response == 'update')
                    {
                        swal({
                          title: '',
                          text: 'Data Updated Successfully',
                          type: 'success',
                          timer: 1000,
                        });
                    }
                    else
                    {
                        swal({
                          title: '',
                          text: 'Data Added Successfully',
                          type: 'success',
                          timer: 1000,
                        });
                    }
                  } 
              });
          
          
        },   

      }); 


      /*End here*/

      /****** Add and update feature *****/
      

      $("#featureForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          feature_title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },  
          Editor:{
           /* required:true,*/
            required: function(textarea) {
              CKEDITOR.instances[textarea.id].updateElement(); // update textarea
              var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
              return editorcontent.length === 0;
            }
          },
          
          feature_image:{
            //required:true,
            extension: "gif|jpg|png|jpng|jpeg",
          },
          
        },
        messages: {
              feature_image:{
            //required:true,
            extension: "Only PNG , JPEG , JPG, JPEG, GIF File Allowed",
          },
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".feature_btn_submit").prop("disabled",true);
          var form = $('#featureForm')[0];
          var formData = new FormData(form);
          formData.append('Editor',CKEDITOR.instances['Editor'].getData());
          $.ajax({
              url: '../submit_feature',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                  console.log(response);

                  $(".feature_btn_submit").prop("disabled",false);
                  //storageTypeTable.ajax.reload();
                  location.reload(); 

                  $("#myModal").modal('hide');
                  $('#featureForm')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });

      /*End here add and update feature*/


       /****** Add and update household banner *****/
      

      $("#householdBannerForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          }, 

          tag_line:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },

          second_section_title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          }, 

          first_section_description:{
           /* required:true,*/
            required: function(textarea) {
              CKEDITOR.instances[textarea.id].updateElement(); // update textarea
              var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
              return editorcontent.length === 0;
            }
          },

           second_section_description:{
           /* required:true,*/
            required: function(textarea) {
              CKEDITOR.instances[textarea.id].updateElement(); // update textarea
              var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
              return editorcontent.length === 0;
            }
          },
          
          banner_image:{
            //required:true,
            extension: "gif|jpg|png|jpng|jpeg",
          },

          subsection_image:{
            //required:true,
            extension: "gif|jpg|png|jpng|jpeg",
          },
          
        },
        messages: {
              banner_image:{
            //required:true,
            extension: "Only PNG , JPEG , JPG, JPEG, GIF File Allowed",
          },

          subsection_image:{
            //required:true,
            extension: "Only PNG , JPEG , JPG, JPEG, GIF File Allowed",
          },

        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".household_banner_btn_submit").prop("disabled",true);
          var form = $('#householdBannerForm')[0];
          var formData = new FormData(form);
          formData.append('first_section_description',CKEDITOR.instances['first_section_description'].getData());
          formData.append('second_section_description',CKEDITOR.instances['second_section_description'].getData());
          $.ajax({
              url: '../submit_household_banner',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                  console.log(response);

                  $(".household_banner_btn_submit").prop("disabled",false);
                  //storageTypeTable.ajax.reload();
                  location.reload(); 

                  $("#myModal").modal('hide');
                  $('#householdBannerForm')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });

      /*End here add and update household banner*/






       /****** Add and update business storage banner *****/
      

      $("#businessBannerForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          }, 

          tag_line:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },

          second_section_title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          }, 

          first_section_description:{
           /* required:true,*/
            required: function(textarea) {
              CKEDITOR.instances[textarea.id].updateElement(); // update textarea
              var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
              return editorcontent.length === 0;
            }
          },

           second_section_description:{
           /* required:true,*/
            required: function(textarea) {
              CKEDITOR.instances[textarea.id].updateElement(); // update textarea
              var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
              return editorcontent.length === 0;
            }
          },
          
          banner_image:{
            //required:true,
            extension: "gif|jpg|png|jpng|jpeg",
          },

          subsection_image:{
            //required:true,
            extension: "gif|jpg|png|jpng|jpeg",
          },
          
        },
        messages: {
              banner_image:{
            //required:true,
            extension: "Only PNG , JPEG , JPG, JPEG, GIF File Allowed",
          },

          subsection_image:{
            //required:true,
            extension: "Only PNG , JPEG , JPG, JPEG, GIF File Allowed",
          },

        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".business_banner_btn_submit").prop("disabled",true);
          var form = $('#businessBannerForm')[0];
          var formData = new FormData(form);
          formData.append('first_section_description',CKEDITOR.instances['first_section_description'].getData());
          formData.append('second_section_description',CKEDITOR.instances['second_section_description'].getData());
          $.ajax({
              url: '../submit_banner',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                  console.log(response);

                  $(".business_banner_btn_submit").prop("disabled",false);
                  //storageTypeTable.ajax.reload();
                  location.reload(); 

                  $("#myModal").modal('hide');
                  $('#businessBannerForm')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });

      /*End here add and update business storage banner*/





       /****** Add and update pricing banner *****/
      

      $("#pricingBannerForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          }, 

          tag_line:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },

         
          
          
          banner_image:{
            //required:true,
            extension: "gif|jpg|png|jpng|jpeg",
          },

         
          
        },
        messages: {
              banner_image:{
            //required:true,
            extension: "Only PNG , JPEG , JPG, JPEG, GIF File Allowed",
          },

          subsection_image:{
            //required:true,
            extension: "Only PNG , JPEG , JPG, JPEG, GIF File Allowed",
          },

        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".banner_btn_submit").prop("disabled",true);
          var form = $('#pricingBannerForm')[0];
          var formData = new FormData(form);
          
          $.ajax({
              url: '../submit_banner',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                  console.log(response);

                  $(".banner_btn_submit").prop("disabled",false);
                  //storageTypeTable.ajax.reload();
                  location.reload(); 

                  $("#myModal").modal('hide');
                  $('#pricingBannerForm')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });

      /*End here add and update pricing banner*/




        /****** Add and update business facility *****/
      

      $("#businessFacilityForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },  
         
          
        },
        messages: {
           
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".business_facility_btn_submit").prop("disabled",true);
          var form = $('#businessFacilityForm')[0];
          var formData = new FormData(form);
         
          $.ajax({
              url: '../submit_facility',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                  console.log(response);

                  $(".business_facility_btn_submit").prop("disabled",false);
                  //storageTypeTable.ajax.reload();
                  location.reload(); 

                  $("#myModal").modal('hide');
                  $('#businessFacilityForm')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });

      /*End here add and update business facility*/



         /****** Add and update business property *****/
      

      $("#businessPropertyForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },  
          Editor:{
           /* required:true,*/
            required: function(textarea) {
              CKEDITOR.instances[textarea.id].updateElement(); // update textarea
              var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
              return editorcontent.length === 0;
            }
          },
          
         
        },
        messages: {
              
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".business_property_btn_submit").prop("disabled",true);
          var form = $('#businessPropertyForm')[0];
          var formData = new FormData(form);
          formData.append('Editor',CKEDITOR.instances['Editor'].getData());
          $.ajax({
              url: '../submit_property',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                  console.log(response);

                  $(".business_property_btn_submit").prop("disabled",false);
                  //storageTypeTable.ajax.reload();
                  location.reload(); 

                  $("#myModal").modal('hide');
                  $('#businessPropertyForm')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });

      /*End here add and update business property*/








       /****** Add and update document storage banner *****/
      

      $("#documentBannerForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          }, 

          tag_line:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },

          sub_section_title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          }, 

          sub_section_description:{
           /* required:true,*/
            required: function(textarea) {
              CKEDITOR.instances[textarea.id].updateElement(); // update textarea
              var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
              return editorcontent.length === 0;
            }
          },

          
          banner_image:{
            //required:true,
            extension: "gif|jpg|png|jpng|jpeg",
          },

          subsection_image:{
            //required:true,
            extension: "gif|jpg|png|jpng|jpeg",
          },
          
        },
        messages: {
              banner_image:{
            //required:true,
            extension: "Only PNG , JPEG , JPG, JPEG, GIF File Allowed",
          },

          subsection_image:{
            //required:true,
            extension: "Only PNG , JPEG , JPG, JPEG, GIF File Allowed",
          },

        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".document_banner_btn_submit").prop("disabled",true);
          var form = $('#documentBannerForm')[0];
          var formData = new FormData(form);
          formData.append('sub_section_description',CKEDITOR.instances['sub_section_description'].getData());
         
          $.ajax({
              url: '../submit_document_banner',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                  console.log(response);

                  $(".document_banner_btn_submit").prop("disabled",false);
                  //storageTypeTable.ajax.reload();
                  location.reload(); 

                  $("#myModal").modal('hide');
                  $('#documentBannerForm')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });

      /*End here add and update document storage banner*/




        /****** Add and update document facility *****/
      

      $("#documentFacilityForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          }, 

          "facility_name[]":{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },


         
        },
        messages: {
             

          
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".document_facility_btn_submit").prop("disabled",true);
          var form = $('#documentFacilityForm')[0];
          var formData = new FormData(form);
          
         
          $.ajax({
              url: '../submit_document_facility',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                  console.log(response);

                  $(".document_facility_btn_submit").prop("disabled",false);
                  //storageTypeTable.ajax.reload();
                  location.reload(); 

                  $("#myModal").modal('hide');
                  $('#documentFacilityForm')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });

      /*End here add and update document facility*/




         /****** Add and update pricing box storage *****/
      

      $("#pricingBoxStorageForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          }, 

          "sub_title_name[]":{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },


         
        },
        messages: {
             

          
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".pricing_box_storage_btn_submit").prop("disabled",true);
          var form = $('#pricingBoxStorageForm')[0];
          var formData = new FormData(form);
          
         
          $.ajax({
              url: '../submit_pricing_bs',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                  console.log(response);

                  $(".pricing_box_storage_btn_submit").prop("disabled",false);
                  //storageTypeTable.ajax.reload();
                  location.reload(); 

                  $("#myModal").modal('hide');
                  $('#pricingBoxStorageForm')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });

      /*End here add and update pricing box storage*/



       /****** Add and update pricing automobile storage *****/
      

      $("#pricingAutomobileForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          }, 

          "sub_title_name[]":{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },


         
        },
        messages: {
             

          
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".pricing_automobile_btn_submit").prop("disabled",true);
          var form = $('#pricingAutomobileForm')[0];
          var formData = new FormData(form);
          
         
          $.ajax({
              url: '../submit_pricing_automobile',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                  console.log(response);

                  $(".pricing_automobile_btn_submit").prop("disabled",false);
                  //storageTypeTable.ajax.reload();
                  location.reload(); 

                  $("#myModal").modal('hide');
                  $('#pricingAutomobileForm')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });

      /*End here add and update pricing automobile storage*/






        /****** Add and update Pricing *****/
      

      $("#pricingForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          }, 

          "item_name[]":{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },


         
        },
        messages: {
             

          
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".pricing_btn_submit").prop("disabled",true);
          var form = $('#pricingForm')[0];
          var formData = new FormData(form);
          
         
          $.ajax({
              url: '../submit_pricing',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                  console.log(response);

                  $(".pricing_btn_submit").prop("disabled",false);
                  //storageTypeTable.ajax.reload();
                  location.reload(); 

                  $("#myModal").modal('hide');
                  $('#pricingForm')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });

      /*End here add and update document storage banner*/





        /****** Add and update document property *****/
      

      $("#documentPropertyForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          title:{ 
            noSpace: true,
            required:true,
            noHTMLtags:true,
          },  
          Editor:{
           /* required:true,*/
            required: function(textarea) {
              CKEDITOR.instances[textarea.id].updateElement(); // update textarea
              var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
              return editorcontent.length === 0;
            }
          },
          
         
        },
        messages: {
              
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $(".document_property_btn_submit").prop("disabled",true);
          var form = $('#documentPropertyForm')[0];
          var formData = new FormData(form);
          formData.append('Editor',CKEDITOR.instances['Editor'].getData());
          $.ajax({
              url: '../submit_document_property',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                  console.log(response);

                  $(".document_property_btn_submit").prop("disabled",false);
                  //storageTypeTable.ajax.reload();
                  location.reload(); 

                  $("#myModal").modal('hide');
                  $('#documentPropertyForm')[0].reset();

                  response = jQuery.trim(response);
                  if(response == 'update')
                  {
                      swal({
                        title: '',
                        text: 'Data Updated Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
                  else
                  {
                      swal({
                        title: '',
                        text: 'Data Added Successfully',
                        type: 'success',
                        timer: 1000,
                      });
                  }
              } 
          });
        },   

      });

      /*End here add and update document property*/




      /**************************************/
      /****** Add and Update Offer */
      /**************************************/ 

      $("#add_offer_form").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          offer_type:{ 
            required:true,
          },
          offer:{ 
            noSpace: true,
            required:true,
          },          
        },
        messages: {
            offer_type : {
            required : "This field is required",
        },
            offer : {
            required : "This field is required",
        },
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          $("#offer_btn_submit").prop("disabled",true);
          var form = $('#add_offer_form')[0];
          var formData = new FormData(form);

          $.ajax({
              url: 'submit_offer',
              type: 'POST',
              data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {
                $("#offer_btn_submit").prop("disabled",false);
                offer_table.ajax.reload(); 

                $("#myModal").modal('hide');
                $('#add_offer_form')[0].reset();

                response = jQuery.trim(response);
                if(response == 'update')
                {
                    swal({
                      title: '',
                      text: 'Data Updated Successfully',
                      type: 'success',
                      timer: 1000,
                    });
                }
                else
                {
                    swal({
                      title: '',
                      text: 'Data Added Successfully',
                      type: 'success',
                      timer: 1000,
                    });
                }
              } 
          });
        },   

      }); 

    $("input[type='radio']").click(function(){
      //alert($(this).val());
        var  add_offer_input = $('#add_offer_input').val();
        if(add_offer_input == '1')
        {
          offerval = '';
          offerimg='';
        }
      if($(this).val()=="Text")
      {
          $("#offer_text").show();
          $("#offer_image").hide();

           $("#show_section").html('<label for="" class="radio-inline" id="offer_text"><input type="text" name="offer" id="offer" class="form-control read_only_name" value="'+offerval+'" /> </label>');
      }
      else
      {
        $("#offer_image").show();
        $("#offer_text").hide(); 
           $("#show_section").html(' <label for="" class="radio-inline" id="offer_image">    <input type="file" name="offer" id="offer_image" class="form-control read_only_image" /><div id="offerImage">'+offerimg+'</div> </label>');
       $("#offerImage").show();
      }
    });

   $(document).ready(function(){ 
    
      $('#offer_type').trigger('change');
   });

      /**************************************/
      /****** Add and Update Banner */
      /**************************************/ 

      var _URL = window.URL || window.webkitURL;

      $("#bannerForm").validate({

        errorClass: 'errors',
        ignore:[],
        rules: {
          banner_img:{ 
            required:true,
            extension: "jpg|jpeg|png|JPG|JPEG|PNG",
          },  
          
        },
        errorPlacement: function(error, element) {
          if (element.attr("type") == "checkbox") {
              error.insertAfter(element.parent());
          } else {
              error.insertAfter(element);
          }
        },
        submitHandler: function(){

          // var file = $("#banner_img")[0].files[0];

          // img = new Image();
          // var imgwidth = 0;
          // var imgheight = 0;
          // var maxwidth = 3366;
          // var maxheight = 1246;

          // img.src = _URL.createObjectURL(file);

          // img.onload = function() {

          //   imgwidth = this.width;
          //   imgheight = this.height;
          
            //if(imgwidth == maxwidth && imgheight == maxheight){

              
              $(".img_error").html(" ");

              $("#banner_btn_submit").prop("disabled",true);
              var form = $('#bannerForm')[0];
              var formData = new FormData(form);

              $.ajax({
                  url: '../submit_banner',
                  type: 'POST',
                  data: formData,
                  datType: 'json',
                  processData: false,
                  contentType: false, 
                  success: function(response) 
                  {
                    $("#banner_btn_submit").prop("disabled",false);
                    banner_table.ajax.reload(); 

                    $("#myModal").modal('hide');
                    $('#bannerForm')[0].reset();

                    response = jQuery.trim(response);
                    if(response == 'update')
                    {
                        swal({
                          title: '',
                          text: 'Data Updated Successfully',
                          type: 'success',
                          timer: 1000,
                        });
                    }
                    else
                    {
                        swal({
                          title: '',
                          text: 'Data Added Successfully',
                          type: 'success',
                          timer: 1000,
                        });
                    }
                  } 
              });
            // }
            // else
            // {
            //   $(".img_error").html("Image size must be "+maxwidth+"X"+maxheight);
              
            // }
           //}

          
        },   

      }); 

      

      // $('#banner_img').change(function () {
        
      //   var file = $(this)[0].files[0];

      //   img = new Image();
      //   var imgwidth = 0;
      //   var imgheight = 0;
      //   var maxwidth = 640;
      //   var maxheight = 640;

      //   img.src = _URL.createObjectURL(file);
      //   img.onload = function() {
      //     imgwidth = this.width;
      //     imgheight = this.height;
       
      //     $("#width").text(imgwidth);
      //     $("#height").text(imgheight);
      //     if(imgwidth <= maxwidth && imgheight <= maxheight){
      //     }
      //     else
      //     {
      //       //$("#response").text("Image size must be "+maxwidth+"X"+maxheight);
      //       alert("Image size must be "+maxwidth+"X"+maxheight)
      //     }
      //   };
      //   img.onerror = function() {
       
      //    $("#response").text("not a valid file: " + file.type);
      //   }

      // });

      //*****************************************
      //************ Reset Pass Form *******
      //*****************************************

      $("#resetPassForm").submit(function(event){
        event.preventDefault();

        $('#resetPassForm').validate();

        if($("#resetPassForm").valid())
        {
          var form = $('#resetPassForm')[0];
          var data = new FormData(form);
          
          $.ajax({
            url: '../resetPassUser/',
            type: 'POST',
            data: data,
            processData: false,
            contentType: false, 
            success: function(response) {

              $('#resetPassForm')[0].reset();

              $("#sucess_msg").html("Your Password reset Successfully.");

              setTimeout(function(){
                location.replace("../dashboard/");
              },2000);
            }
          }); 

        }
      });

      $("#resetPassForm").validate({
          rules: {          
          userPassword : {
                    minlength : 5,
                    required : true
                },
                userConfirmPass : {
                  required : true,
                    minlength : 5,
                    equalTo :"#userPassword"
                },
            },
        // Specify validation error messages
        messages: {
          userPassword:{
              minlength : "Password length should be more than 5",
              required:"Please enter password"
          },
          userConfirmPass: {
            required :"Please enter confirm password",
            minlength : "Password length should be more than 5",
            equalTo : "Password not match"
          }
        }
      });




  });

  /**************************************/
  /****** Edit, Copy and delete Email Template */
  /**************************************/ 

  function edit_email_template(template_id)
  {
    $.ajax({
      type: "POST",
      url: "get_template_info/",
      datatype:'JSON',
      data:{'template_id':template_id},  
      success: function(data) {
        data_obj = JSON.parse(data);

        info = data_obj.template_info;

        $("#template_id").val(info.emailTemplateId);
        $("#template_title").val(info.title);
        //$("#Editor").val(info.template);

        CKEDITOR.instances['Editor'].setData(info.template);

        $("#myModal").modal('show');
      }
    });
  }

  function email_template_enabledisable(template_id,status){

    if(status == "1"){

        var small_text="Do You Want To Deactivate This Email Template!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Email Template Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Email Template!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Email Template Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: 'emailtemplateUpdateStatus/',
          type: 'POST',
          data:{template_id:template_id,status:status},          
          success: function(response) {

            $("#status_Action_"+template_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  function copy_email_template(template_id)
  {
    $.ajax({
      type: "POST",
      url: "get_template_info/",
      datatype:'JSON',
      data:{'template_id':template_id},  
      success: function(data) {

        $(".copy_btn").addClass("js-textareacopybtn");
        data_obj = JSON.parse(data);

        info = data_obj.template_info;

        $(".js-copytextarea").text(info.template);

        CKEDITOR.instances[ "js-copytextarea" ];

        //CKEDITOR.instances['js-copytextarea'].setData(info.template);

        $("#templateModal").modal("show");



       /* var copyTextarea = document.querySelector('.js-copytextarea');
  
        copyTextarea.select();*/
         
      }
    });
  }


/**************************************/
  /****** Edit, Copy and delete Manage Posts */
  /**************************************/ 

  function edit_posts_template(post_id)
  {
    $.ajax({
      type: "POST",
      url: "get_posts_info/",
      datatype:'JSON',
      data:{'post_id':post_id},  
      success: function(data) {
        data_obj = JSON.parse(data);

        info = data_obj.template_info;
        var imgString='';
        if(info.post_images!='')
        {
            var imgString="<img  src='../upload/home/post_images/"+info.post_images+"' style='height:50px; width:50px'/>";
        }
        else
        {
          var imgString='';
        }
        $("#post_id").val(info.post_id);
        $("#post_title").val(info.title);
        //$("#post_category").val(info.post_category);
        $("#postImg").html(imgString);
        //$("#Editor").val(info.template);

        CKEDITOR.instances['Editor'].setData(info.description);

        $("#myModal").modal('show');
      }
    });
  }

  /* Function to edit storage_type*/

  function edit_storage_type(storage_type_id)
  {
    //alert(storage_type_id);
    $.ajax({
      type: "POST",
      url: "../get_storage_type_info/",
      datatype:'JSON',
      data:{'storage_type_id':storage_type_id},  
      success: function(data) {
        data_obj = JSON.parse(data);

        info = data_obj.storage_type_info;
        var imgString='';
        if(info.storage_image!='')
        {
            var imgString="<img  src='../../upload/home/storage_type_images/"+info.storage_image+"' style='height:50px; width:50px'/>";
        }
        else
        {
          var imgString='';
        }
        $("#storage_type_id").val(info.storage_type_id);
        $("#storage_type_title").val(info.storage_type);
       
        $("#storagetypeImg").html(imgString);
        

        CKEDITOR.instances['Editor'].setData(info.storage_description);

        $("#myModal").modal('show');
      }
    });
  }

/*End here*/



/* Function to edit household property*/

  function edit_household_property(hs_property_id)
  {
    //alert(storage_type_id);
    $.ajax({
      type: "POST",
      url: "../get_household_property_info/",
      datatype:'JSON',
      data:{'hs_property_id':hs_property_id},  
      success: function(data) {
        data_obj = JSON.parse(data);

        info = data_obj.property_info;
        
        $("#hs_property_id").val(info.hs_property_id);
        $("#title").val(info.hs_property_title);
       
       

        CKEDITOR.instances['Editor'].setData(info.hs_property_description );

        $("#myModal").modal('show');
      }
    });
  }

/*End here*/



/* Function to edit home about us*/

  function edit_about_us(about_us_id)
  {
    //alert(storage_type_id);
    $.ajax({
      type: "POST",
      url: "../get_about_us_info/",
      datatype:'JSON',
      data:{'about_us_id':about_us_id},  
      success: function(data) {

        console.log(data);

        data_obj = JSON.parse(data);

        info = data_obj.about_us_info;
        var imgString='';
        if(info.about_us_image!='')
        {
            var imgString="<img  src='../../upload/home/home_about_us/"+info.about_us_image+"' style='height:50px; width:50px'/>";
        }
        else
        {
          var imgString='';
        }
        $("#about_us_id").val(info.about_us_id);

        $("#about_us_title").val(info.about_us_title);
       
       
        $("#aboutUsImg").html(imgString);
        

        CKEDITOR.instances['Editor'].setData(info.about_us_description);

        $("#myModal").modal('show');
      }
    });
  }

/*End here*/



/* Function to edit household facility*/

  function edit_household_facility(hs_facility_id)
  {
    //alert(storage_type_id);
    $.ajax({
      type: "POST",
      url: "../get_household_facility_info/",
      datatype:'JSON',
      data:{'hs_facility_id':hs_facility_id},  
      success: function(data) {

        console.log(data);

        data_obj = JSON.parse(data);

        info = data_obj.facility_info;
       
        $("#hs_facility_id").val(info.hs_facility_id);

        $("#title").val(info.hs_facility_name);
        $("#myModal").modal('show');
      }
    });
  }

/*End here*/




/* Function to edit customer says*/

  function edit_customer_says(customer_say_id)
  {
    //alert(storage_type_id);
    $.ajax({
      type: "POST",
      url: "../get_customer_says_info/",
      datatype:'JSON',
      data:{'customer_say_id':customer_say_id},  
      success: function(data) {

        console.log(data);

        data_obj = JSON.parse(data);

        info = data_obj.customer_says_info;
        var imgString='';
        if(info.customer_image!='')
        {
            var imgString="<img  src='../../upload/home/customer_photo/"+info.customer_image+"' style='height:50px; width:50px'/>";
        }
        else
        {
          var imgString='';
        }
        $("#customer_says_id").val(info.customer_say_id);

        $("#customer_name").val(info.customer_name);

        $("#customer_designation").val(info.customer_designation);

        $("#customer_address").val(info.customer_address);

        
       
       
        $("#customerImg").html(imgString);
        

        CKEDITOR.instances['Editor'].setData(info.customer_thought);

        $("#myModal").modal('show');
      }
    });
  }

/*End here*/


/* Function to edit feature*/

  function edit_feature(feature_id)
  {
    //alert(storage_type_id);
    $.ajax({
      type: "POST",
      url: "../get_feature_info/",
      datatype:'JSON',
      data:{'feature_id':feature_id},  
      success: function(data) {

        console.log(data);
        data_obj = JSON.parse(data);

        info = data_obj.feature_info;
        var imgString='';
        if(info.feature_image!='')
        {
            var imgString="<img  src='../../upload/home/features_images/"+info.feature_image+"' style='height:50px; width:50px'/>";
        }
        else
        {
          var imgString='';
        }
        $("#feature_id").val(info.feature_id);
        $("#feature_title").val(info.feature_name);
       
        $("#storagetypeImg").html(imgString);
        

        CKEDITOR.instances['Editor'].setData(info.feature_description);

        $("#myModal").modal('show');
      }
    });
  }

/*End here*/




/* Function to edit household banner*/

  function edit_household_banner(hs_banner_id)
  {
    //alert(storage_type_id);
    $.ajax({
      type: "POST",
      url: "../get_household_banner_info/",
      datatype:'JSON',
      data:{'hs_banner_id':hs_banner_id},  
      success: function(data) {

        console.log(data);
        data_obj = JSON.parse(data);

        info = data_obj.banner_info;
        var imgString='';
        var subimgString='';
        if(info.hs_banner_image!='')
        {
          var imgString="<img  src='../../upload/household_storage/household_storage_banner/"+info.hs_banner_image+"' style='height:50px; width:50px'/>";
        }
        else
        {
          var imgString='';
        }

        if(info.hs_banner_sub_image!='')
        {
          var subimgString="<img  src='../../upload/household_storage/household_storage_subimage/"+info.hs_banner_sub_image+"' style='height:50px; width:50px'/>";
        }
        else
        {
          var subimgString='';
        }


        $("#hs_banner_id").val(info.hs_banner_id);
        $("#title").val(info.hs_banner_title);
        $("#tag_line").val(info.hs_banner_tagline);
        $("#second_section_title").val(info.hs_second_section_title);
       
        $("#bannerImg").html(imgString);
        $("#subsectionImg").html(subimgString);
        

        CKEDITOR.instances['first_section_description'].setData(info.hs_first_section_description);

        CKEDITOR.instances['second_section_description'].setData(info.hs_second_section_descripton);

        $("#myModal").modal('show');
      }
    });
  }

/*End here*/




/* Function to edit document banner*/

  function edit_document_banner(banner_id)
  {
    //alert(storage_type_id);
    $.ajax({
      type: "POST",
      url: "../get_document_banner_info/",
      datatype:'JSON',
      data:{'banner_id':banner_id},  
      success: function(data) {

        console.log(data);
        data_obj = JSON.parse(data);

        info = data_obj.banner_info;
        var imgString='';
        var subimgString='';
        if(info.banner_image!='')
        {
          var imgString="<img  src='../../upload/document_storage/banner_image/"+info.banner_image+"' style='height:50px; width:50px'/>";
        }
        else
        {
          var imgString='';
        }

        if(info.sub_image!='')
        {
          var subimgString="<img  src='../../upload/document_storage/sub_image/"+info.sub_image+"' style='height:50px; width:50px'/>";
        }
        else
        {
          var subimgString='';
        }


        $("#banner_id").val(info.banner_id);
        $("#title").val(info.banner_title);
        $("#tag_line").val(info.banner_tagline);
        $("#sub_section_title").val(info.first_section_title);
       
        $("#bannerImg").html(imgString);
        $("#subsectionImg").html(subimgString);
        

        CKEDITOR.instances['sub_section_description'].setData(info.first_section_description);

      

        $("#myModal").modal('show');
      }
    });
  }

/*End here*/



/* Function to edit business banner*/

  function edit_business_banner(banner_id)
  {
    //alert(storage_type_id);
    $.ajax({
      type: "POST",
      url: "../get_banner_info/",
      datatype:'JSON',
      data:{'banner_id':banner_id},  
      success: function(data) {

        console.log(data);
        data_obj = JSON.parse(data);

        info = data_obj.banner_info;
        var imgString='';
        var subimgString='';
        if(info.banner_image!='')
        {
          var imgString="<img  src='../../upload/business_storage/banner_image/"+info.banner_image+"' style='height:50px; width:50px'/>";
        }
        else
        {
          var imgString='';
        }

        if(info.sub_image!='')
        {
          var subimgString="<img  src='../../upload/business_storage/sub_image/"+info.sub_image+"' style='height:50px; width:50px'/>";
        }
        else
        {
          var subimgString='';
        }


        $("#banner_id").val(info.banner_id);
        $("#title").val(info.banner_title);
        $("#tag_line").val(info.banner_tagline);
        $("#second_section_title").val(info.second_section_title);
       
        $("#bannerImg").html(imgString);
        $("#subsectionImg").html(subimgString);
        

        CKEDITOR.instances['first_section_description'].setData(info.first_section_description);

        CKEDITOR.instances['second_section_description'].setData(info.second_section_description);

        $("#myModal").modal('show');
      }
    });
  }

/*End here*/




/* Function to edit pricing banner*/

  function edit_pricing_banner(banner_id)
  {
    //alert(storage_type_id);
    $.ajax({
      type: "POST",
      url: "../get_banner_info/",
      datatype:'JSON',
      data:{'banner_id':banner_id},  
      success: function(data) {

        console.log(data);
        data_obj = JSON.parse(data);

        info = data_obj.banner_info;
        var imgString='';
       
        if(info.banner_image!='')
        {
          var imgString="<img  src='../../upload/pricing/banner_image/"+info.banner_image+"' style='height:50px; width:50px'/>";
        }
        else
        {
          var imgString='';
        }
        $("#banner_id").val(info.banner_id);
        $("#title").val(info.banner_title);
        $("#tag_line").val(info.banner_tagline);
        $("#bannerImg").html(imgString);
        $("#myModal").modal('show');
      }
    });
  }

/*End here*/




/*Function to enable and disable business facility*/

  function business_property_enabledisable(property_id,status){

    if(status == "1"){

        var small_text="Do You Want To Deactivate This Property!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Property Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Property!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Property Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../businessPropertyUpdateStatus/',
          type: 'POST',
          data:{property_id:property_id,status:status},          
          success: function(response) {

            $("#status_Action_"+property_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /*End here*/



  /*Function to enable and disable document facility*/

  function document_property_enabledisable(property_id,status){

    if(status == "1"){

        var small_text="Do You Want To Deactivate This Property!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Property Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Property!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Property Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../documentPropertyUpdateStatus/',
          type: 'POST',
          data:{property_id:property_id,status:status},          
          success: function(response) {

            $("#status_Action_"+property_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /*End here*/



/* Function to edit business facility*/

  function edit_business_facility(facility_id)
  {
    //alert(storage_type_id);
    $.ajax({
      type: "POST",
      url: "../get_facility_info/",
      datatype:'JSON',
      data:{'facility_id':facility_id},  
      success: function(data) {

        console.log(data);

        data_obj = JSON.parse(data);

        info = data_obj.facility_info;
       
        $("#facility_id").val(info.facility_id);

        $("#title").val(info.facility_name);
        $("#myModal").modal('show');
      }
    });
  }

/*End here*/

/* Function to edit document facility*/

  function edit_document_facility(facility_id)
  {
    //alert(storage_type_id);
    $.ajax({
      type: "POST",
      url: "../get_document_facility_info/",
      datatype:'JSON',
      data:{'facility_id':facility_id},  
      success: function(data) {

        console.log(data);

        data_obj = JSON.parse(data);

        info = data_obj.facility_info;
       
        $("#facility_id").val(info.facility_id);

        $("#title").val(info.facility_title);

        var sub_facility = data_obj.sub_facility_info;

        for (var i = 0; i < sub_facility.length; i++) 
        {

           if(i==0)
           {
              $("#facility_name_1").val(sub_facility[i].sub_title);
           }
           else
           {

                 $("#append_div").append(`<div id="remove_${i}" class="row">
                  <div class="col-md-10">
                    <input type="text" value="${sub_facility[i].sub_title}" name="facility_name[]" class="form-control">
                  </div>
                  <div class="col-md-2">
                    <span class="btn btn-danger remove_append" id="${i}">Remove</span>
                  </div>
                </div> <br/><br>`);
            }
           
         }

        $("#myModal").modal('show');
      }
    });
  }

/*End here*/



/* Function to edit edit_pricing_storage*/

  function edit_pricing_storage(storage_id)
  {
    //alert(storage_type_id);
    $.ajax({
      type: "POST",
      url: "../get_pricing_storage_info/",
      datatype:'JSON',
      data:{'storage_id':storage_id},  
      success: function(data) {

        console.log(data);

        data_obj = JSON.parse(data);

        info = data_obj.pricing_info;
       
        $("#storage_id").val(info.storage_id);

        $("#title").val(info.storage_title);

        var sub_facility = data_obj.sub_pricing_info;

        for (var i = 0; i < sub_facility.length; i++) 
        {

           if(i==0)
           {
              $("#sub_title_name_1").val(sub_facility[i].sub_title);
           }
           else
           {

                 $("#append_div").append(`<div id="remove_${i}" class="row">
                  <div class="col-md-10">
                    <input type="text" value="${sub_facility[i].sub_title}" name="sub_title_name[]" class="form-control">
                  </div>
                  <div class="col-md-2">
                    <span class="btn btn-danger remove_append" id="${i}">Remove</span>
                  </div>
                </div> <br/><br>`);
            }
           
         }

        $("#myModal").modal('show');
      }
    });
  }

/*End here*/


/* Function to edit pricing automobile*/

  function edit_pricing_automobile(automobile_id)
  {
    //alert(storage_type_id);
    $.ajax({
      type: "POST",
      url: "../get_pricing_automobile_info/",
      datatype:'JSON',
      data:{'automobile_id':automobile_id},  
      success: function(data) {

        console.log(data);

        data_obj = JSON.parse(data);

        info = data_obj.pricing_automobile_info;
       
        $("#automobile_id").val(info.automobile_id);

        $("#title").val(info.automobile_title);

        var sub_facility = data_obj.sub_pricing_automobile_info;

        for (var i = 0; i < sub_facility.length; i++) 
        {

           if(i==0)
           {
              $("#sub_title_name_1").val(sub_facility[i].sub_title);
           }
           else
           {

                 $("#append_div").append(`<div id="remove_${i}" class="row">
                  <div class="col-md-10">
                    <input type="text" value="${sub_facility[i].sub_title}" name="sub_title_name[]" class="form-control">
                  </div>
                  <div class="col-md-2">
                    <span class="btn btn-danger remove_append" id="${i}">Remove</span>
                  </div>
                </div> <br/><br>`);
            }
           
         }

        $("#myModal").modal('show');
      }
    });
  }

/*End here*/




/* Function to edit pricing*/

  function edit_pricing(pricing_id)
  {
    //alert(storage_type_id);
    $.ajax({
      type: "POST",
      url: "../get_pricing_info/",
      datatype:'JSON',
      data:{'pricing_id':pricing_id},  
      success: function(data) {

        console.log(data);

        data_obj = JSON.parse(data);

        info = data_obj.pricing_info;
       
        $("#pricing_id").val(info.pricing_id);
        $("#title").val(info.pricing_title);

        var item = data_obj.item_info;

        for (var i = 0; i < item.length; i++) 
        {

           if(i==0)
           {
              $("#item_name_1").val(item[i].item_name);
           }
           else
           {

                 $("#append_div").append(`<div id="remove_${i}" class="row">
                  <div class="col-md-10">
                    <input type="text" value="${item[i].item_name}" name="item_name[]" class="form-control">
                  </div>
                  <div class="col-md-2">
                    <span class="btn btn-danger remove_append" id="${i}">Remove</span>
                  </div>
                </div> <br/><br>`);
            }
           
         }

        $("#myModal").modal('show');
      }
    });
  }

/*End here*/


/* Function to edit business property*/

  function edit_business_property(property_id)
  {
    //alert(storage_type_id);
    $.ajax({
      type: "POST",
      url: "../get_property_info/",
      datatype:'JSON',
      data:{'property_id':property_id},  
      success: function(data) {
        data_obj = JSON.parse(data);

        info = data_obj.property_info;
        
        $("#property_id").val(info.property_id);
        $("#title").val(info.property_title);
       
       

        CKEDITOR.instances['Editor'].setData(info.property_description );

        $("#myModal").modal('show');
      }
    });
  }

/*End here*/


/* Function to edit document property*/

  function edit_document_property(property_id)
  {
    //alert(storage_type_id);
    $.ajax({
      type: "POST",
      url: "../get_document_property_info/",
      datatype:'JSON',
      data:{'property_id':property_id},  
      success: function(data) {
        data_obj = JSON.parse(data);

        info = data_obj.property_info;
        
        $("#property_id").val(info.property_id);
        $("#title").val(info.property_title);
       
       

        CKEDITOR.instances['Editor'].setData(info.property_description );

        $("#myModal").modal('show');
      }
    });
  }

/*End here*/




 /*Function to enable and disable business facility*/

function business_facility_enabledisable(facility_id,status){

    if(status == "1"){

        var small_text="Do You Want To Deactivate This Facility!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Facility Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Facility!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Facility Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../businessFacilityUpdateStatus/',
          type: 'POST',
          data:{facility_id:facility_id,status:status},          
          success: function(response) {

            $("#status_Action_"+facility_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /*End here*/


/*Function to enable and disable document facility*/

function document_facility_enabledisable(facility_id,status)
{
  
    if(status == "1"){

        var small_text="Do You Want To Deactivate This Facility!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Facility Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Facility!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Facility Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../documentFacilityUpdateStatus/',
          type: 'POST',
          data:{facility_id:facility_id,status:status},          
          success: function(response) {

            $("#status_Action_"+facility_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /*End here*/




/*Function to enable and disable pricing box storage*/

function pricing_storage_enabledisable(storage_id,status)
{
  
    if(status == "1"){

        var small_text="Do You Want To Deactivate This Storage data!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Storage data Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Storage data!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Storage data Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../pricingBoxStorageUpdateStatus/',
          type: 'POST',
          data:{storage_id:storage_id,status:status},          
          success: function(response) {

            $("#status_Action_"+storage_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /*End here*/



  /*Function to enable and disable pricing automobile*/

function pricing_automobile_enabledisable(automobile_id,status)
{
  
    if(status == "1"){

        var small_text="Do You Want To Deactivate This Automobile Data!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Automobile Data Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Automobile Data!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Automobile Data Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../pricingAutomobileUpdateStatus/',
          type: 'POST',
          data:{automobile_id:automobile_id,status:status},          
          success: function(response) {

            $("#status_Action_"+automobile_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /*End here*/



/*Function to enable and disable pricing*/

function pricing_enabledisable(pricing_id,status)
{
  
    if(status == "1"){

        var small_text="Do You Want To Deactivate This Pricing!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Pricing Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Pricing!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Pricing Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../pricingUpdateStatus/',
          type: 'POST',
          data:{pricing_id:pricing_id,status:status},          
          success: function(response) {

            $("#status_Action_"+pricing_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /*End here*/





/*Function to enable and disable household banner*/

function business_banner_enabledisable(banner_id,status){

    if(status == "1"){

        var small_text="Do You Want To Deactivate This Banner!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Banner Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Banner!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Banner Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../businessBannerUpdateStatus/',
          type: 'POST',
          data:{banner_id:banner_id,status:status},          
          success: function(response) {

            $("#status_Action_"+banner_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /*End here*/



  /*Function to enable and disable pricing banner*/

function pricing_banner_enabledisable(banner_id,status){

    if(status == "1"){

        var small_text="Do You Want To Deactivate This Banner!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Banner Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Banner!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Banner Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../pricingBannerUpdateStatus/',
          type: 'POST',
          data:{banner_id:banner_id,status:status},          
          success: function(response) {

            $("#status_Action_"+banner_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /*End here*/



  /*Function to enable and disable household banner*/

function document_banner_enabledisable(banner_id,status){

    if(status == "1"){

        var small_text="Do You Want To Deactivate This Banner!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Banner Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Banner!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Banner Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../documentBannerUpdateStatus/',
          type: 'POST',
          data:{banner_id:banner_id,status:status},          
          success: function(response) {

            $("#status_Action_"+banner_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /*End here*/





/*Function to enable and disable household banner*/

function household_banner_enabledisable(hs_banner_id,status){

    if(status == "1"){

        var small_text="Do You Want To Deactivate This Banner!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Banner Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Banner!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Banner Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../householdBannerUpdateStatus/',
          type: 'POST',
          data:{hs_banner_id:hs_banner_id,status:status},          
          success: function(response) {

            $("#status_Action_"+hs_banner_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /*End here*/



  /*Function to enable and disable household facility*/

  function household_property_enabledisable(hs_property_id,status){

    if(status == "1"){

        var small_text="Do You Want To Deactivate This Property!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Property Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Property!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Property Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../householdPropertyUpdateStatus/',
          type: 'POST',
          data:{hs_property_id:hs_property_id,status:status},          
          success: function(response) {

            $("#status_Action_"+hs_property_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /*End here*/





  /*Function to enable and disable household facility*/

function household_facility_enabledisable(hs_facility_id,status){

    if(status == "1"){

        var small_text="Do You Want To Deactivate This Facility!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Facility Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Facility!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Facility Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../householdFacilityUpdateStatus/',
          type: 'POST',
          data:{hs_facility_id:hs_facility_id,status:status},          
          success: function(response) {

            $("#status_Action_"+hs_facility_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /*End here*/



/*Function to enable and disable storage type*/

function storage_type_enabledisable(storage_type_id,status){

    if(status == "1"){

        var small_text="Do You Want To Deactivate This Storage Type!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Storage Type Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Storage Type!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Storage Type Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../storageTypeUpdateStatus/',
          type: 'POST',
          data:{storage_type_id:storage_type_id,status:status},          
          success: function(response) {

            $("#status_Action_"+storage_type_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /*End here*/


  /*Function to enable and disable customer says*/

function customer_says_enabledisable(customer_say_id,status){

    if(status == "1"){

        var small_text="Do You Want To Deactivate This Customer Thought!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Customer Thought Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Customer Thought!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Customer Thought Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../customerSaysUpdateStatus/',
          type: 'POST',
          data:{customer_say_id:customer_say_id,status:status},          
          success: function(response) {

            $("#status_Action_"+customer_say_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /*End here*/


  /*Function to enable and disable feature*/

function feature_enabledisable(feature_id,status){

    if(status == "1"){

        var small_text="Do You Want To Deactivate This Feature!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Feature Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Feature!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Feature Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../featureUpdateStatus/',
          type: 'POST',
          data:{feature_id:feature_id,status:status},          
          success: function(response) {

            $("#status_Action_"+feature_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /*End here*/


  /*Function to enable and disable home about us*/

function about_us_enabledisable(about_us_id,status){

    if(status == "1"){

        var small_text="Do You Want To Deactivate This About Us Information!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='About Us Information Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This About Us Information!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='About Us Information Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../aboutUsUpdateStatus/',
          type: 'POST',
          data:{about_us_id:about_us_id,status:status},          
          success: function(response) {

            $("#status_Action_"+about_us_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /*End here*/


  function manage_posts_enabledisable(post_id,status){

    if(status == "1"){

        var small_text="Do You Want To Deactivate This Post!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Manage Post Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Post!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Manag Post Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: 'managePostUpdateStatus/',
          type: 'POST',
          data:{post_id:post_id,status:status},          
          success: function(response) {

            $("#status_Action_"+post_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  function copy_manage_posts(post_id)
  {
    $.ajax({
      type: "POST",
      url: "get_posts_info/",
      datatype:'JSON',
      data:{'post_id':post_id},  
      success: function(data) {

        $(".copy_btn").addClass("js-textareacopybtn");
        data_obj = JSON.parse(data);

        info = data_obj.template_info;

        $(".js-copytextarea").text(info.description);

        CKEDITOR.instances[ "js-copytextarea" ];

        //CKEDITOR.instances['js-copytextarea'].setData(info.template);

        $("#templateModal").modal("show");



       /* var copyTextarea = document.querySelector('.js-copytextarea');
  
        copyTextarea.select();*/
         
      }
    });
  }




  /**************************************/
  /****** Edit and delete Offer */
  /**************************************/ 

  function edit_offer(offer_id)
  {
    

    $.ajax({
      type: "POST",
      url: "get_offer_info/",
      datatype:'JSON',
      data:{'offer_id':offer_id},  
      success: function(data) {
         $("#myModal").modal('show');

        data_obj = JSON.parse(data);
       
        info = data_obj.offer_info;
        var imgString="<img src='../upload/home/offer_image/"+info.offerName+"' style='height:50px; width:50px'/>";
        $("#offer_id").val(info.offerId);
        $("#offer_name").val(info.offerName);

        $('input:radio[name=sex]').attr('checked',false);

        if(info.offerType == 'Text')
        {

          
          
          var value = info.offerType;
          $("input[name=offer_type][value="+value+"]").attr('checked', 'checked');

           //$('input:radio[name=sex]').attr('checked',false);

          $("#show_section").html('<label for="" class="radio-inline" id="offer_text"><input type="text" name="offer" id="offer" value="'+offerval+'" class="form-control read_only_name" /> </label>');
          $("#offer").val(info.offerName);
          var nameval = info.offerName;
          offerval = nameval;
            $('#add_offer_input').val('0');
           $("input[name=offer_type][value="+value+"]").trigger('click');
          //console.log(offerval);
        }
        else
        {

          
          var value = info.offerType;
          $("input[name=offer_type][value="+value+"]").attr('checked', 'checked');
          $("#show_section").html(' <label for="" class="radio-inline" id="offer_image"><input type="file" name="offer" id="offer_image" class="form-control read_only_image" /><div id="offerImage">'+imgString+'</div> </label>');
          $('#add_offer_input').val('0');
          offerimg = imgString;
          $("input[name=offer_type][value="+value+"]").trigger('click');

        }
       
      }
    });
  }

  function offer_enabledisable(offer_id,status)
  {

    if(status == "1"){

        var small_text="Do You Want To Deactivate This Offer!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Offer Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Offer!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Offer Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: 'offerUpdateStatus/',
          type: 'POST',
          data:{offer_id:offer_id,status:status},          
          success: function(response) {

            $("#status_Action_"+offer_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }

  /**************************************/
  /****** Edit and delete Banner */
  /**************************************/ 
  function edit_banner(banner_id)
  {
    $.ajax({
      type: "POST",
      url: "../get_banner_info/",
      datatype:'JSON',
      data:{'banner_id':banner_id},  
      success: function(data) {
        data_obj = JSON.parse(data);

        info = data_obj.banner_info;

        $("#banner_id").val(info.bannerId);
        $(".banner_img").html("<img src='../../upload/home/banner_images/"+info.banner_img+"' height='50%' width='50%'>");
        
        $("#myModal").modal('show'); 
      }
    });
  }


  /*Function to edit client*/
   function edit_client(client_id)
    {
      $.ajax({
        type: "POST",
        url: "../get_client_info/",
        datatype:'JSON',
        data:{'client_id':client_id},  
        success: function(data) {
          data_obj = JSON.parse(data);

          info = data_obj.clients_info;

          $("#client_id").val(info.client_id);
          $(".client_img").html("<img src='../../upload/home/clients/"+info.client_logo+"' height='30%' width='30%'>");
          
          $("#myModal").modal('show'); 
        }
      });
    }


  /*End here*/


  /*Function to enable disable client_enabledisable*/
    function client_enabledisable(client_id,status){

    if(status == "1"){

        var small_text="Do You Want To Deactivate This Client!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Client Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Client!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Client Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../clientUpdateStatus/',
          type: 'POST',
          data:{client_id:client_id,status:status},          
          success: function(response) {

            $("#status_Action_"+client_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }


  /*End here*/

    function banner_enabledisable(banner_id,status){

    if(status == "1"){

        var small_text="Do You Want To Deactivate This Banner!";

        var btnTxt='Yes, Deactivate it!';

        var alertmsg='Banner Deactivated Successfully';

      }else{

        var small_text="Do You Want To Activate This Banner!";

        var btnTxt='Yes, Activate it!';

        var alertmsg='Banner Activated Successfully';

    }  

    swal({

        title: "Are you sure?",

        text: small_text,

        type: "warning",

        showCancelButton: true,

        confirmButtonClass: "btn-danger",

        confirmButtonText: btnTxt,

        closeOnConfirm: true

      },

      function(){

        $.ajax({
          url: '../bannerUpdateStatus/',
          type: 'POST',
          data:{banner_id:banner_id,status:status},          
          success: function(response) {

            $("#status_Action_"+banner_id).html(response);

            swal({
              title: alertmsg, 
              type: "success",
              timer: 1000
            });
          }
                    
        });
    });
  }
  