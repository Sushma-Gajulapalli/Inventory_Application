

    <!-- header -->
     <!-- header -->


    <!-- appointment step-->
   <!-- appointment step-->
    <div class="menu-top-pad ap-step">
        <div class="sec-pad">
      
        <div class="container ">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10">

                        <!--PEN CONTENT     -->
                        <div class="content">
                          <!--content inner-->
                          <div class="content__inner">
                            <div class=" overflow-hidden">
                              <!--multisteps-form-->
                              <div class="multisteps-form">
                                 <!--progress bar-->
                                <!-- <div class="row">
                                  <div class="col-12 col-lg-12 ml-auto mr-auto mb-4 p-0">
                                    <div class="multisteps-form__progress">
                                      <button class="multisteps-form__progress-btn js-active completed" type="button" title="Get started">Storage Type</button>
                                      <button class="multisteps-form__progress-btn  js-active" type="button" title="Type of visit">Select Inventory</button>
                                     <button class="multisteps-form__progress-btn" type="button" title="Details">Details</button>
                                      <button class="multisteps-form__progress-btn" type="button" title="Book appointment"> Pay        </button>
                                 
                                    </div>
                                  </div>
                                </div> -->
                                <!--form panels-->

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

      
                               
                                    <form class="multisteps-form__form">

                                      <input type="hidden" value="<?php echo $storage_type; ?>" name="storage_type">
                                      <!--single form panel-->
                                          <div class="multisteps-form__panel shadow pt-4   js-active" data-animation="scaleIn">
                                           
                                            <br>
                                            <div class="row">
                                              <div class="col-md-6 mb-3">
                                                <div class="media d-flex align-items-center ">
                                                  <img src="<?php echo base_url()?>assets/new_design_css/froentui/img/select-visit/house1.png" class="img-fluid mr-3 w-30" alt="icon">
                                                  <div class="media-body">
                                                     <div class="font-17 semi-bold mb-2">Household Storage</div>
                                                  </div>
                                                </div>
                                               
                                              </div>
                                               <div class="col-md-6 mb-4 text-left text-md-right">
                                                <a href="#" class="text-orange">Back to main menu<i class="fa fa-angle-left ml-2"></i></a>
                                              </div>

                                              <div class="col-md-4 col-lg-3 col-6">
                                                <div class="choose-visit-box active" >
                                                    <div class="row m-0">
                                                      <div class="col-12 text-center">
                                                        <div class="font-17 semi-bold"><img src="<?php echo base_url()?>assets/new_design_css/froentui/img/sofa_2_seater.png"></div>
                                                      </div>
                                                      <div class="col-12 text-center semi-bold">
                                                        Cot
                                                      </div>
                                                      <div class="col-12 text-center" >
                                                        <select name="work-condition" id="work-condition" class="form-control">
                                                          <option value="1">Single cot with mattress</option>
                                                          <option value="2">Single cot without mattress</option>
                                                          <option value="3">Double cot with mattress</option>
                                                          <option value="4">Double cot</option>
                                                          
                                                        </select>
                                                      </div>
                                                    </div>
                                                </div>
                                              </div>

                                              <div class="col-md-4 col-lg-3 col-6">
                                                <div class="choose-visit-box">
                                                    <div class="row m-0">
                                                      <div class="col-12 text-center">
                                                        Option
                                                      </div>
                                                    </div>
                                                </div>
                                              </div>

                                              <div class="col-md-4 col-lg-3 col-6">
                                                <div class="choose-visit-box">
                                                    <div class="row m-0">
                                                      <div class="col-12 text-center">
                                                        Option
                                                      </div>
                                                    </div>
                                                </div>
                                              </div>

                                              <div class="col-md-4 col-lg-3 col-6">
                                                <div class="choose-visit-box">
                                                    <div class="row m-0">
                                                      <div class="col-12 text-center">
                                                        Option
                                                      </div>
                                                    </div>
                                                </div>
                                              </div>

                                              <div class="col-md-4 col-lg-3 col-6">
                                                <div class="choose-visit-box">
                                                    <div class="row m-0">
                                                      <div class="col-12 text-center">
                                                        Option
                                                      </div>
                                                    </div>
                                                </div>
                                              </div>

                                              <div class="col-md-4 col-lg-3 col-6">
                                                <div class="choose-visit-box">
                                                    <div class="row m-0">
                                                      <div class="col-12 text-center">
                                                        Option
                                                      </div>
                                                    </div>
                                                </div>
                                              </div>

                                            </div>
                                             <div class="row">
                                                <div class="col-6">
                                                    <div class="button-row d-flex mt-4">
                                                          <a href="javascript:void(0)" onclick="step1()" class="btn btn-orange-line js-btn-next semi-bold"  title="back"><i class="fa fa-angle-left mr-4"></i>Back</a>
                                                      </div>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="button-row d-flex mt-4">
                                                        <a class="btn btn-orange ml-auto js-btn-next"  href="javascript:void(0)"onclick="step3()" title="Next">Next Step <i class="fa fa-angle-right ml-2"></i></a>
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
                                    </div>
                                </div>
    
      </div>
    </div>


<script>
  // Function to close the popup container
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