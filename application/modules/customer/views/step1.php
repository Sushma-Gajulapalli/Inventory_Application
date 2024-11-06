    <link href="https://safestorage.in/back/assets/select2/select2.min.css" rel="stylesheet">

   <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCse5f97FoDXrT5kKoeB1XGCxeCs12-mOE&libraries=places"></script>

<script src="<?php echo base_url(); ?>assets/new_design_css/js/jquery-1.11.1.js"></script>

<!-- <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script> -->
<script src="<?php echo base_url()?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>assets/new_design_css/froentui/js/select-beauty.stable.min.js"></script>

<style> 
#step3 {
  position: relative;
}

.hide_btn_cost{
    display:none !important;
}

#step3 .loader_step3 {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: none;
  background-color: rgba(255, 255, 255, 0.7);
}

#step3 .loader_step3:after {
  content: "";
  display: block;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  border: 5px solid #ccc;
  border-top-color: #555;
  animation: spin 1s infinite linear;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

#step3.loading .loader_step3 {
  display: block;
}



 .list-inline-item:not(:last-child) {
    margin-right: .1rem !important; 
  }

.ui-datepicker-inline.ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all{
   width:100%;
}

.ui-widget-header{
background: #fff !important;
}


.semi-bold{
    font-family: seguisb;
}
.text-orange{
    color: #EF473A !important;
}
.sec-pad{
    padding: 3rem 0rem;
}
.menu-top-pad{
        padding-top: 84px;
}
a, a:hover{
    color: inherit;
    text-decoration: none;
} 
.font-17{
    font-size: 17px;
}
.font-25{
font-size: 25px;
}
.font-13{
  font-size: 13px;
}

.header-btn-hover.nav-item:hover a , .header-btn-hover.nav-item a:hover {
    border-bottom: 0px solid #16517B !important;
}

/* footer  */
footer{
    font-size: .875rem;
    color: #666;
    line-height: 1.714;
}
.footer-title{
     font-family: seguisb;
     color: #06163a;
     font-size: 17px;
     margin-bottom: 20px;
}
.footer-link li{
    color: #333;
    margin-bottom: 5px;
}
.footer-link li:hover{
    opacity: 0.7;
}
.socials li a i {
    background-color: #fff;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 21px;
    color: #0f0a45;
    transition: all 0.2s ease
}
.socials li a i:hover{
    opacity: 0.7;
}
.copyrights{
    font-size: 13px;
letter-spacing: 0px;
color: #FFFFFF;
opacity: 0.5;
padding: 0px 0px 20px;
}
/* step */
/*.multisteps-form__progress-btn i{
  position: absolute;
    color: #fff;
    left: 47.3%;
    top: 1px;
    z-index: 9;
    font-size: 11px;
}
.multisteps-form__progress-btn.completed i{
  display: block;
}*/
.multisteps-form__progress {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(0, 1fr));
}

.multisteps-form__progress-btn {
  transition-property: all;
  transition-duration: 0.15s;
  transition-timing-function: linear;
  transition-delay: 0s;
  position: relative;
  padding-top: 20px;
      color: #909095;
  text-indent: 0px;
  border: none;
  background-color: transparent;
  outline: none !important;
  cursor: pointer;
}
.multisteps-form__progress-btn.completed:before {
    position: absolute;
    top: -3px;
    left: 50%;
    display: block;
    width: 18px;
    height: 18px;
    content: "\f00c";
    font: normal normal normal 14px/1 FontAwesome;
    transform: translateX(-50%);
    transition: all 0.15s linear 0s, transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
    border: 1px solid #F48F71;
    border-radius: 50%;
    background-color: #f8f9ff;
    box-sizing: border-box;
    z-index: 3;
    color: #fff;
    font-size: 11px;
    line-height: 16.5px;
    /* margin-top: 10px; */
}
.multisteps-form__progress-btn:before {
  position: absolute;
  top: -3px;
    left: 50%;
    display: block;
    width: 18px;
    height: 18px;
 content: "";
  transform: translateX(-50%);
  transition: all 0.15s linear 0s, transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
  border: 1px solid #F48F71;
  border-radius: 50%;
 background-color: #f8f9ff;
  box-sizing: border-box;
  z-index: 3;
}
.multisteps-form__progress-btn:after {
  position: absolute;
  top: 5px;
  left: calc(-50% - 13px / 2);
  transition-property: all;
  transition-duration: 0.15s;
  transition-timing-function: linear;
  transition-delay: 0s;
  display: block;
  width: 100%;
  height: 1px;
  content: "";
  background-color: #F48F71;
  z-index: 1;
}
.multisteps-form__progress-btn:first-child:after {
  display: none;
}
.multisteps-form__progress-btn.js-active {
    color: #282725;
}
.multisteps-form__progress-btn.js-active:before {
    background-color: currentColor;
    background-color: #ef473a !important;
}

.multisteps-form__form {
  position: relative;
}
.multisteps-form__input::placeholder, .form-control::placeholder{
    color: #17126D;
    opacity: 0.5;
}

.multisteps-form__panel.js-active {
  height: auto;
  opacity: 1;
  visibility: visible;
}
.multisteps-form__panel[data-animation=scaleOut] {
  transform: scale(1.1);
}
.multisteps-form__panel[data-animation=scaleOut].js-active {
  transition-property: all;
  transition-duration: 0.2s;
  transition-timing-function: linear;
  transition-delay: 0s;
  transform: scale(1);
}
.multisteps-form__panel[data-animation=slideHorz] {
  left: 50px;
}
.multisteps-form__panel[data-animation=slideHorz].js-active {
  transition-property: all;
  transition-duration: 0.25s;
  transition-timing-function: cubic-bezier(0.2, 1.13, 0.38, 1.43);
  transition-delay: 0s;
  left: 0;
}
.multisteps-form__panel[data-animation=slideVert] {
  top: 30px;
}
.multisteps-form__panel[data-animation=slideVert].js-active {
  transition-property: all;
  transition-duration: 0.2s;
  transition-timing-function: linear;
  transition-delay: 0s;
  top: 0;
}
.multisteps-form__panel[data-animation=fadeIn].js-active {
  transition-property: all;
  transition-duration: 0.3s;
  transition-timing-function: linear;
  transition-delay: 0s;
}
.multisteps-form__panel[data-animation=scaleIn] {
  transform: scale(0.9);
}
.multisteps-form__panel[data-animation=scaleIn].js-active {
  transition-property: all;
  transition-duration: 0.2s;
  transition-timing-function: linear;
  transition-delay: 0s;
  transform: scale(1);
}
.multisteps-form__title{
    font: normal normal bold 32px/48px Segoe UI;
    letter-spacing: 0px;
    color: #282725;
    text-transform: uppercase;
    opacity: 1;
    text-align: center;
    margin-bottom: 5px;
}
.multisteps-form__content{
    padding: 1.5rem 0rem 0rem;
}
.multisteps-form__input.form-control:focus, .form-control:focus  {
    background: #FFFFFF 0% 0% no-repeat padding-box;
box-shadow: 0px 0px 6px #17126D54 !important;
border: 2px solid #0F0A45;
border-radius: 6px;
opacity: 1;
}
select.form-control:not([size]):not([multiple]) {
    height: calc(2.25rem + 16px);
}
.multisteps-form__input.form-control {
    display: block;
    width: 100%;
    padding: 11px 20px 12px 43px;
    font-size: 1rem;
    line-height: 1.5;
        color: #0F0A45 !important;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    border: 1px solid var(--unnamed-color-0f0a45);
background: #FFFFFF 0% 0% no-repeat padding-box;
border: 1px solid #0F0A45;
border-radius: 6px;
opacity: 1;
}
textarea{
    resize: none;
}
.form-control.empty{
background: #ABAAC133 0% 0% no-repeat padding-box;
border: 1px solid #ABAAC1;
border-radius: 6px;
}
.form-control:focus {
    color: #495057;
    background-color: #fff;
    border-color: #16517b;
    outline: 0;
    box-shadow: 0 0 0 0rem rgba(0,123,255,.25);
}
.form-control{
      color: #0F0A45 !important;
     display: block;
    width: 100%;
   padding: 8px 17px 9px 17px;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    border: 1px solid var(--unnamed-color-0f0a45);
background: #FFFFFF 0% 0% no-repeat padding-box;
border: 1px solid #0F0A45;
border-radius: 6px;
opacity: 1;
}
.form-control-icon {
    color: #F48F71;
    position: absolute;
    top: 12px;
    left: 13px;
    font-size: 19px;
    z-index: 9
}
.form-group{
    margin-bottom: 30px;
}
.btn-orange-line{
   background: transparent;
border-radius: 6px;
opacity: 1;
padding: 5px 25px 6px; 
border:2px solid #EF473A;
color: #ef473a;
}
.btn-orange-line:hover{
   background: #f5eeee 0% 0% no-repeat padding-box;
   color: #ef473a;
}
.btn-orange{
    background: #EF473A 0% 0% no-repeat padding-box;
border-radius: 6px;
opacity: 1;
color: #fff !important;
padding: 5px 25px 6px;
border:2px solid #EF473A;
}
.btn-orange:hover{
    background: #e43628 0% 0% no-repeat padding-box;
    color: #fff;
}
.btn-orange.focus, .btn-orange:focus, .btn-orange-line.focus, .btn-orange-line:focus {
    outline: 0;
    box-shadow: 0 0 7px 0.2rem rgb(239 71 58 / 9%);
}
.btn-white{
    background: #FFFFFF 0% 0% no-repeat padding-box;
box-shadow: 0px 3px 6px #00000029;
border-radius: 33px;
opacity: 1;
    padding: 7px 20px;
}
.btn-white:hover{
    background-color: #EF473A !important;
    color: #fff !important;
}
.btn-blue{
    border: 1px solid var(--unnamed-color-0f0a45);
background: #FFFFFF 0% 0% no-repeat padding-box;
border: 1px solid #0F0A45;
border-radius: 6px;
opacity: 1;
    padding: 5px 29px 6px;
    font-size: 15px;
    min-width: 138px;
    color: #0F0A45

}
.btn.focus, .btn:focus {
    outline: 0;
    box-shadow: 0 0 0 0rem rgba(0,123,255,.25);
}
.btn-blue:hover{
    background: var(--unnamed-color-0f0a45) 0% 0% no-repeat padding-box;
border: 1px solid var(--unnamed-color-0f0a45);
background: #0F0A45 0% 0% no-repeat padding-box;
box-shadow: 0px 0px 6px #17126D54;
border: 1px solid #0F0A45;
border-radius: 6px;
opacity: 1;
color: #fff;
}
.btn-blue.active{
        padding: 5px 29px 6px;
    font-size: 15px;
    min-width: 138px;

    background: var(--unnamed-color-0f0a45) 0% 0% no-repeat padding-box;
border: 1px solid var(--unnamed-color-0f0a45);
background: #0F0A45 0% 0% no-repeat padding-box;
box-shadow: 0px 0px 6px #17126D54;
border: 1px solid #0F0A45;
border-radius: 6px;
opacity: 1;
color: #fff;
}
.choose-visit-box.active{
background: #FFFFFF 0% 0% no-repeat padding-box;
box-shadow: 0px 0px 6px #17126D54;
border: 2px solid #0F0A45;
}
.choose-visit-box{
    margin-bottom: 30px;
background: #FFFFFF 0% 0% no-repeat padding-box;
border: 1px solid #0F0A45;
border-radius: 6px;
opacity: 1;
height: 150px;
display: flex;
justify-content: center;
align-items: center;
color: #17126D;
cursor: pointer;
transition: all 0.2s ease
}
.choose-visit-box:hover{
    box-shadow: 0px 0px 6px #17126D54;
}
.choose-visit-box img{
    width: 60px;
}
.option-box{
                                            
  background: #FFFFFF 0% 0% no-repeat padding-box;
  border: 1px solid #0F0A45;
  border-radius: 6px;
  opacity: 1;
  padding:13px;
}

@media only screen and (max-width: 600px) {
  .option-box{
                                            
    background: #FFFFFF 0% 0% no-repeat padding-box;
    border: 1px solid #0F0A45;
    border-radius: 6px;
    opacity: 1;
    padding:10px;
  }
}
.ob-title{
    font: normal normal 600 22px/30px seguisb;
letter-spacing: 0px;
color: #17126D;
opacity: 1;
margin-bottom: 30px;
}
.ob-title img{
        width: 32px;
}

.container1 {
    display: block;
    color: #17126D;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 15px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    margin-bottom: 20px;
}

/* Hide the browser's default checkbox */
.container1 input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.container1 .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee0;
    border: 2px solid #0F0A45;
}

/* On mouse-over, add a grey background color */
.container1:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.container1 input:checked ~ .checkmark {
    background-color: #2196f300;
}

/* Create the checkmark/indicator (hidden when not checked) */
.container1 .checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container1 input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container1 .checkmark:after {
          left: 5px;
    top: -7.5px;
    /* width: 5px; */
    /* height: 10px; */
    /* border: solid white; */
    /* border-width: 0 3px 3px 0; */
    /* -webkit-transform: rotate(45deg); */
    -ms-transform: rotate(45deg);
    /* transform: rotate(45deg); */
    content: 'x';
    font-size: 20px;
    font-family: Segoe-UI-Bold;
}

/* The container */
.container2 {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
     font-size: 16px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.container2 input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.container2 .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee0;
    border-radius: 50%;
    border: 2px solid #0F0A45;
}
/* On mouse-over, add a grey background color */
.container2:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.container2 input:checked ~ .checkmark {
    background-color: #2196f300;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.container2  .checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container2 input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.container2 .checkmark:after {
    top: 4px;
    left: 3.5px;
    width: 13px;
    height: 13px;
    border-radius: 50%;
    background: white;
    background: #0F0A45 0% 0% no-repeat padding-box;
}
.alert-danger {
    background: #FFFFFF 0% 0% no-repeat padding-box;
    border: 3px solid #E53B1A;
    border-radius: 6px;
    font-size: 16px;
    letter-spacing: 0px;
    color: #E53B1A;
    padding: 23px 22px;
}
.cust-card{
  background: var(--unnamed-color-f8f9ff) 0% 0% no-repeat padding-box;
background: #F8F9FF 0% 0% no-repeat padding-box;
border: 2px solid #517253;
border-radius: 12px;
opacity: 1;
padding-top: 30px;
padding-bottom: 30px;
}
.card-inner-pad{
  padding-left: 30px;
padding-right: 30px;

}
.card-line{
  height: 49px;
background: #517253 0% 0% no-repeat padding-box;
opacity: 1;
margin-top: 30px;
}
.input-group-text{
      display: block;
    width: 100%;
    padding: 8px 17px 9px 17px;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    border: 1px solid var(--unnamed-color-0f0a45);
    background: #FFFFFF 0% 0% no-repeat padding-box;
    border: 1px solid #0F0A45;
    border-radius: 6px;
    opacity: 1;
}
.sp-option{
  margin-bottom: 10px;
  border: 1px solid var(--unnamed-color-0f0a45);
background: #FFFFFF 0% 0% no-repeat padding-box;
border: 1px solid #0F0A45;
border-radius: 6px;
opacity: 1;
padding: 14px 20px;
}
.text-sky-blue{
  color: #16517B;
}
.sp-option.selected{
background: #FFFFFF 0% 0% no-repeat padding-box;
box-shadow: 0px 0px 6px #EF473A54;
border: 2px solid #EF473A;
border-radius: 6px;
cursor: pointer;
}
.sp-option:hover{
background: #FFFFFF 0% 0% no-repeat padding-box;
box-shadow: 0px 0px 6px #EF473A54;
border: 1px solid #EF473A;
border-radius: 6px;
cursor: pointer;
}
.sp-option.actived{
background: var(--unnamed-color-0f0a45) 0% 0% no-repeat padding-box;
border: 1px solid var(--unnamed-color-0f0a45);
background: #0F0A45 0% 0% no-repeat padding-box;
border: 1px solid #0F0A45;
border-radius: 6px;
opacity: 1;
}
.date-box{
  border: 1px solid var(--unnamed-color-0f0a45);
background: #FFFFFF 0% 0% no-repeat padding-box;
border: 1px solid #0F0A45;
border-radius: 6px;
opacity: 1;
padding: 13px;

height: 100%;
}
.calander .form-row>.col, .calander .form-row>[class*=col-] {
    padding-right: 2px;
    padding-left: 2px;
    margin-bottom:4px;
}
.date-box.selected{
border: 3px solid var(--unnamed-color-ef473a);
background: #FFFFFF 0% 0% no-repeat padding-box;
box-shadow: 0px 0px 6px #EF473A54;
border: 3px solid #EF473A;
border-radius: 6px;
opacity: 1;
cursor: pointer;
}
.date-box:hover{
border: 1px solid var(--unnamed-color-ef473a);
background: #FFFFFF 0% 0% no-repeat padding-box;
box-shadow: 0px 0px 6px #EF473A54;
border: 1px solid #EF473A;
border-radius: 6px;
opacity: 1;
cursor: pointer;
}
.date-box.disable{
background: var(--unnamed-color-f8f9ff) 0% 0% no-repeat padding-box;
background: #F8F9FF 0% 0% no-repeat padding-box;
border: 1px solid #909092;
border-radius: 6px;
opacity: 1;
color: #909092;
}
.a-confirm{
  font: normal normal bold 30px/48px Segoe UI;
letter-spacing: 0px;
color: #282725;
text-transform: uppercase;
opacity: 1;
margin-bottom: 20px
}
 .w-30{
  width: 30px;
 }
  .tooltip-inner {
  background-color: #fff;
  color: #000;
  border: 1px solid #062e56;
}

 .tooltip-arrow {
  border-top: 5px solid #062e56;
}
.cp{
  cursor: pointer;
}
.form-control.error, .input-group-text.error{
background: #FFFFFF 0% 0% no-repeat padding-box;
border: 2px solid #E53B1A;
border-radius: 6px;
opacity: 1;
}
.form-control:disabled, .form-control[readonly] {
   background: #ABAAC133 0% 0% no-repeat padding-box;
border: 1px solid #ABAAC1;
border-radius: 6px;
}
.custom-select-wrapper {
     position: relative;
     user-select: none;
     width: 100%;
}
 .custom-select {
     position: relative;
     display: flex;
     flex-direction: column;
     border-width: 0 0px 0 0px;
     border-style: solid;
     border-color: #394a6d;
     height: auto;
    padding: 0px;
}
.custom-select__trigger {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 22px;
    font-size: 20px;
    font-weight: 300;
    color: #3b3b3b;
        height: calc(2.0rem + 11px);
    line-height: 60px;
    background: #ffffff;
    cursor: pointer;
    /* border-width: 2px 0 2px 0; */
    border-style: solid;
    border-color: #394a6d;
    display: block;
    width: 100%;
    padding: 11px 20px 12px 43px;
    font-size: 1rem;
    line-height: 1.1;
    color: #0F0A45 !important;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    border: 1px solid var(--unnamed-color-0f0a45);
    background: #FFFFFF 0% 0% no-repeat padding-box;
    border: 1px solid #0F0A45;
    border-radius: 6px;
    opacity: 1;
}
 .custom-options {
     position: absolute;
     display: block;
     top: 100%;
     left: 0;
     right: 0;
    border: 2px solid #0F0A45;
     border-top: 0;
     background: #fff;
     transition: all 0.5s;
     opacity: 0;
     visibility: hidden;
     pointer-events: none;
     z-index: 10;
     border-bottom-right-radius: 6px;
     border-bottom-left-radius: 6px;
}
 .custom-select.open .custom-options {
     opacity: 1;
     visibility: visible;
     pointer-events: all;
}
.custom-select.open .custom-select__trigger{
      border: 2px solid #0F0A45;
      box-shadow: 0px 0px 6px #17126D54 !important;
       border-bottom-right-radius: 0px;
     border-bottom-left-radius: 0px;

}
.custom-option:hover {
    background-color: #e7e7ed;
}

 .custom-option {
    position: relative;
    display: block;
    padding: 0 20px 0 20px;
    font-size: 15px;
    font-weight: 300;
    color: #3b3b3b;
    line-height: 41px;
    cursor: pointer;
    transition: all 0.5s;
}
}
 .custom-option:hover {
     cursor: pointer;
     background-color: #b2b2b2;
}
 .custom-option.selected {
     color: #ffffff;
     background-color: #305c91;
}
 .custom-select  .arrow {
        position: relative;
    height: 10px;
    width: 9px;
    padding: ab;
    position: absolute;
    right: 15px;
    top: 19px;
}
 .custom-select  .arrow::before,  .custom-select  .arrow::after {
    content: "";
    position: absolute;
    bottom: 0px;
    width: 0.099rem;
    height: 94%;
    transition: all 0.5s;
}
 .custom-select .open .arrow::before {
    left: -3px;
    transform: rotate(45deg);
   
}
 .custom-select .open .arrow::after {
    left: 3px;
    transform: rotate(-45deg);
   
}
  .custom-select   .arrow::before {
     left: -3px;
     transform: rotate(-45deg);
      background-color: #394a6d;
}
  .custom-select   .arrow::after {
     left: 3px;
     transform: rotate(45deg);
      background-color: #394a6d;
}
.iQEUJt > div:not(:first-child) {
    margin-left: 1.2rem;
}
<style>
.jElFDb {
    cursor: pointer;
}
<style>

.lkqupg {
    padding: 1rem 0.8rem 0px;
    width: 100%;
    font-size: 1.2rem;
    color: rgb(255, 255, 255);
    font-weight: 600;
}
.kvnZBD {
    padding: 0px 0.8rem 1rem;
    width: 100%;
    font-size: 1.1rem;
    color: rgb(255, 255, 255);
    font-weight: 400;
    white-space: nowrap;
}

  #msform1  .number{
         border: 1px solid #FFA87A;
    border-radius: 2.5px;
    overflow: hidden;
    width: 115px;
        }
        #msform1  .number .minus, #msform1 .number .plus{
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
        #msform1  .number input{
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
 #msform1  .table td,  #msform1  .table th {
       padding: 6px 10px;
    vertical-align: middle;
}
 #msform1  .number.inactive{
 opacity: 0.4;
}

#msform1 .number .minus, #msform1 .number .plus {
    width: 29px;
    height: 24px;
    font-size: 18px;
    line-height: 22px;
}

#msform1 .number input {
    height: 24px;
    width: 46px;
    font-size: 14px;
}

#msform1 .nav {
    border: 1px solid #031A5B;
    border-radius: 50px;
    overflow: hidden;
}

#msform1 .nav-pills .nav-link.active, #msform1.nav-pills .show>.nav-link {
    color: #fff !important;
    background-color: #031A5B;
    /* background-color: #007bff; */
}
#msform1 .nav-pills .nav-link {
    border-radius: 0rem;
    color: #031A5B;
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff;
    background-color: #007bff;
}
#msform1 .nav-pills .nav-link.active, #msform .nav-pills .show>.nav-link {
    color: #fff !important;
    background-color: #031A5B;
    /* background-color: #007bff; */
}

#msform1 .nav-pills .nav-item {
    width: 25%;
    text-align: center;
}

#msform1.nav-pills .nav-link {
    border-radius: 0rem;
    color: #031A5B;
}

#msform1 .nav-pills .nav-link.active, #msform1 .nav-pills .show>.nav-link {
    color: #fff !important;
    background-color: #031A5B;
    /* background-color: #007bff; */
}
#msform1 .nav-pills .nav-link {
    border-radius: 0rem;
    color: #031A5B;
}

.m-truck{
   width: 108px !important;
}

#msform1 .mfb-search {
    background: #ECECEC;
    border-radius: 4px 4px 0px 0px;
    padding: 8px 6px;
    position: relative;
}

#msform1 .mfb-search input {
    border-radius: 50px;
    border-color: transparent;
    box-shadow: none;
    padding-left: 48px;
    margin-bottom: 0px;
}

#msform1 .mfb-search img {
    position: absolute;
    top: 23px;
    left: 19px;
    width: 19px;
}

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


.medium {
    font-family: Archivo-Medium;
}
.new-line{
    letter-spacing: 1px;
    word-spacing: 2px;
}
.choose-visit-box:hover{
    background: #1A5E8E;
    color:white;
    transition: background-position 0.5s ease-out;
}

/*progressbar*/

</style>

    <!-- header -->
     <!-- header -->


    <!-- appointment step-->
  <div class="ap-step" style="background:white">
      <div class="sec-pad">
          <form class="multisteps-form__form" id="msform1">
              <div id="step1">
                <input type="hidden" id="myInput">


               <div class="container">
                  <div class="row d-flex justify-content-center">
                     <div class="col-md-12 col-lg-10">

                         <!-- <h4 class="mt-3 new-line text-danger"> Tell us more about your requirement </h4> -->

                        <!--PEN CONTENT     -->
                        <!-- <div class="content mt-5"> -->
                           <!--content inner-->
                           <!-- <div class="content__inner"> -->
                              <!-- <div class=" overflow-hidden"> -->
                                 <!--multisteps-form-->
                                 <div class="multisteps-form">
                                    
                                       
                                      
                             
                        </div>
                     </div>
                  </div>
               </div>
              </div>

              <div style="text-align: center;" class="row">
                  <div id="invalid_home_type_msg" class="col-md-12">
                      
                  </div>
              </div> 

             
 <div class="row" style="display: none;" id="show_all">
    <div class="container">
                  <div class="row d-flex justify-content-center">

     

             <div class="col-md-12 col-lg-12  order-1 order-lg-2">

                    
                        
                  <div id="step2"></div>
                   <div id="step3"></div>
                         
            </div>

    </div>
</div>
</div>


   

              <input type="hidden" id="storage_type" name="storage_type">
              <input type="hidden" id="hometype" name="hometype" value="1rk">
              <input type="hidden" id="selected_home_type_id" value="">
        
          </form>
          <div id="step4"></div>
      </div>
   </div>
 
   <div class="modal" id="bhk_modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Warning</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
               <div class="table-responsive-sm">
                <form method="post"> 
                     
                    <div class="row">
                      <div class="col-md-1"></div>
                      <div class="col-md-11">
                        <label>Your item quantity is larger than selected home type,So home type has been upgraded to <span style="color:red">4bhk</span> <span class="text-danger">*</span></label>
                        </div>
                    </div> 
                 </form>           
               </div>          
          </div>
          </div>
        </div>
      </div>



  <script>

    
    var beauty = new SelectBeauty({
      el: '#work-condition',
      placeholder: 'Select type of cot',
      length: 0,
      max: 50,
      selected: [7,11,17,1]
    });
  </script>  

  <script>
      window.onload = function() {
        var is_price_show = <?php echo $is_price_show;?>;
        var step1 = document.getElementById('step1');
        //if (is_price_show === 1) {
          fun_lead_info();
       // }
      };
    </script>

<?php $this->session->unset_userdata('is_price_show');?>

<script type="">
   
$(document).ready(function(){
    history.pushState(null, '', '<?php echo base_url();?>customer/create-quotation');  
  for(const dropdown of document.querySelectorAll(".custom-select-wrapper")){

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

});

var step1_number=0;
var step2_number=0;
var step3_number=0;
var step4_number=0;

function fun_lead_info(storage_type=null){

  step1_number=0;
  $('.hide_btn_cost').hide();
  $("#fun_lead_info").show();
  $("#step1").show();
  $("#step2").show();
  $("#step2").html();
  step2('household_storage');
  $("#step3").html();
  $("#step4").html(); 
  $('#show_all').show();
}

function step1(){
    $('.hide_btn_cost').show();
     $("#fun_lead_info").hide();
    $("#step1").show();
    $("#step2").hide();
    $("#step2").html();
    $("#step3").html();
    $("#step4").html();
    $('#show_all').hide();
      document.getElementById('step1').scrollIntoView();
            $('html, body').animate({
            scrollTop: $('html, body').offset().top,
    }, 1000); 
       step2_number=0;
       step3_number=0;
       step4_number=0;

      $('.item_selected_list').each(function(i, obj) {
             console.log(obj);
             console.log(i);
             
      });
}

 function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}

function step2(storage_type) {
  let customer_name = $('#customer_name').val();
  let customer_email = $('#customer_email').val();
  let customer_contact1 = $('#customer_contact1').val();
  let $error = 0;

  $("#fun_lead_info").hide();
  $(".loader").show();
 // $(".container").css('opacity', 0.2);
  $("#storage_type").val(storage_type);
  //history.pushState(null, '', '<?php echo base_url();?>customer/create-quotation/step2');

  $.ajax({
    url: '<?php echo base_url();?>customer/step3',
    type: 'POST',
    data: {
      'storage_type': $("#storage_type").val(),
      'customer_name': customer_name,
      'customer_email': customer_email,
      'customer_contact1': customer_contact1
    },
    success: function(response) {
      document.getElementById('step2').scrollIntoView();
      $('html, body').animate({
        scrollTop: $('html, body').offset().top,
      }, 1000);

    $('.image_loader').show();
    $('.image_loader').css('margin-top', '10%');

   
      $("#fun_lead_info").hide();
      $("#step2").show();
      $("#step1").hide();
      $("#step3").hide();

      if (step2_number == 1) {
        $("#step2").show();
      } else {
        $("#step2").html(response);
      }

      step2_number = 1;
      step1_number = 1;

      $(".loader").hide();
    //  $(".container").css('opacity', 1);

     
      
     

      
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error("Error:", textStatus, errorThrown);
      $(".loader").hide();

      //alert("There was an error loading the data. Please try again later.");
    }
  })
}


function step3(is_callback=null) {
  $('#show_all').show();
  $('#myModaldate').modal('hide');
  history.pushState(null, '', '<?php echo base_url();?>customer/create-quotation/step3');

  let form = $('#msform1')[0];
  let formData = new FormData(form);
  formData.append('customer_email', $('customer_email').val());

  let count = 0;
  $('.item_selected_list').each(function(i, obj) {
    count++;
  });

  //if (count != 0) {
    $(".minimumitem").hide();
    $(".loader").show();
   // $(".container").css('opacity', 0.2);

    $.ajax({
      url: '<?php echo base_url();?>customer/get_selected_storage_item_k',
      type: 'POST',
      data: formData,
      datType: 'json',
      processData: false,
      contentType: false,
      success: function(response) {
        document.getElementById('step3').scrollIntoView();
        $('html, body').animate({
          scrollTop: $('html, body').offset().top,
        }, 1000);
        $('.image_loader').css('margin-top', '5%');    
        $(".loader").hide();
       // $(".container").css('opacity', 1);

        if (response == 'max_quantity') {
          $('#mobileModel').modal('show');
        } else if (response == 'invalid_hometype') {
          let homesize = $("#selected_home_type_id").val();
          let new_homesize = '';

          if (homesize == '') {
            new_homesize = '1rk';
          } else if (homesize == '1rk') {
            new_homesize = '1bhk';
          } else if (homesize == '1bhk') {
            new_homesize = '2bhk';
          } else if (homesize == '2bhk') {
            new_homesize = '3bhk';
          }

          $('.selecthome').removeClass('active');
          $('.' + new_homesize).addClass('active');

          $("#hometype").val(new_homesize);
          $("#selected_home_type_id").val(new_homesize);

          $("html, body").animate({
            scrollTop: 0
          }, 600);

          setTimeout(function() {
            $("#invalid_home_type_msg").html('');
          }, 4000);
        } else {
          $("#step4").hide();
          $("#step3").show();
          $("#step2").hide();

          if (step3_number == 1) {
            $("#step3").show();
          } else {
            $("#step3").html(response);
          }

          step3_number = 1;

          if (is_callback != null) {
            var transport = 1;
            $("#transport1").prop('checked', true);
            $('#transport_type').val(1);

            if (transport == '1') {
              $('.show_on_transport_select').css('display', 'none');
              $('.on_floor_select').css('display', 'none');
            } else {
              $('.show_on_transport_select').css('display', 'block');
            }
          }
        }

        // Wait for the first AJAX request to finish before executing the second AJAX request
      $(".make_empty").promise().done(function() {
        $.ajax({
          url: '<?php echo base_url();?>customer/get_selected_storage_item_hometype',
          type: 'POST',
          data: {
            'storage_type': $("#storage_type").val(),
            'homesize': $("#hometype").val()
          },
          success: function(response) {
          //  $(".container").css('opacity', 1);
            $(".loader").hide();
            $('.make_empty').html(response);
           
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.error("Error:", textStatus, errorThrown);
             $(".loader").hide();

            //alert("There was an error loading the data. Please try again later.");
          }
        })
      });

      }
    });
  // } else {
  //   $(".minimumitem").show();
  // }
}


function step4(){
    var customer_local_city = $('#customer_local_city').val();
    $('#show_all').hide();
    history.pushState(null, '', '<?php echo base_url();?>customer/create-quotation/step4/'+customer_local_city);    
    // $("#msform1").validate();
     var form = $('#msform1')[0];
      $('customer_email').val()

      console.log($('#customer_email').val());
      var formData = new FormData(form);
        formData.append('customer_email', $('#customer_email').val());
        formData.append('customer_emai', $('#customer_email').val());

        $(".loader").show();
       // $(".container").css('opacity',0.2);
        $("#first_next").html("Processing..");
        $("#first_next").attr('disabled', true);
        $.ajax({
          url: '<?php echo base_url();?>customer/step4clone',
          type: 'POST',
          data: formData,
          datType: 'json',
          processData: false,
          contentType: false, 
          success: function(response) 
          {
              
               $(".loader").hide();
              // $(".container").css('opacity',1);
               step4_number=1;   
               $("#first_next").attr('disabled', false);
               $("#first_next").html("Next Step");
              
               $("#fun_lead_info").hide();
              $("#step3").hide();
              $("#step4").show();
              $("#step4").html(response);
                setTimeout(function(){ 
                  discount_percent_change();
                }, 2000);
              document.getElementById('step4').scrollIntoView();
                $('html, body').animate({
                scrollTop: $('html, body').offset().top,
                }, 1000);
                 
          }
        })

}

      $(document).ready(function() {
           $('.hometypes').on('change', function() {
               nextstep();
           });
       }); 

 
    function  opennew(storage){
      if(storage=='document_storage'){
         window.location.assign("<?php echo base_url()?>create-document-quotation")
      }

       if(storage=='move'){
         window.location.assign("<?php echo base_url()?>packers_movers_details")
      }
    }


     

       function check_autohometype(){

         var form = $('#msform1')[0];
          var formData = new FormData(form);

          var count=0;
          $('.item_selected_list').each(function(i, obj) {
              count++;
         });
          if(count!=0){
           
            $.ajax({
              url: '<?php echo base_url();?>customer/check_autohometype',
              type: 'POST',
               data: formData,
              datType: 'json',
              processData: false,
              contentType: false, 
              success: function(response) 
              {


                console.log(response);

                  
                $(".loader").hide();
              //  $(".container").css('opacity',1);

                if(response=='max_quantity'){  
                  //$('#mobileModel').modal('show');
 
                }else if(response =='invalid_hometype'){
                    $("#invalid_home_type_msg").html('<span style="background-color:#f79292;border: 1px solid black; padding: 10px;color:#fff"><b>Your item quantity is larger than selected home type,So home type has been upgraded. </b></span>');
                    setTimeout(function(){ $("#invalid_home_type_msg").html(''); }, 6000);
                }
                else if(response=='4bhk'){
                  //$('#bhk_modal').modal('show');
                   $("#hometype").val(response); 
                }
                else {
                  var count=0;
                  $('.item_selected_list').each(function(i, obj) {
                  count++;
                  });
                 

                   $(".minimumitem").hide();
                   let new_homesize =response;
                    $('.selecthome').removeClass('active');
                    $('.' + new_homesize).addClass('active'); 
                    $("#hometype").val(new_homesize);
                    $("#selected_home_type_id").val(new_homesize);

                  if(count!=0){ 
                    $(".checkinvitems").hide();
                  }else{
                     $(".checkinvitems").show();
                      $('.selecthome').removeClass('active');
                  }


                   // $("html, body").animate({ scrollTop: 0 }, 600);
                    
                }
                     
              }

            })
          }
          else{
              $(".minimumitem").show();
          }  

           //city_select();  
      }

    $(document).on("click","#raise_storage_request_btn",function(e) {  

      e.preventDefault();

      var mobile_no = $("#mobile_no").val();

        if(mobile_no ==''){

           $("#contact_err").html("Please fill * filed.");
          
          setTimeout(function(){ 
            $("#contact_err").html("");
           }, 3000);

          return false;
        }

          $.ajax({

              url: '<?php echo base_url()?>customer/send_max_item_request',
              type:'POST',
              data:{'mobile_no':mobile_no,},
              success: function (response)
              {
                  $("#contact_err").html("<span style='color:green'>Request has been sent successfully.</span>");
                  setTimeout(function(){ 
                    location.reload();
                  }, 3000);
              }

          }); 
    });

  $('select.selectClass').change(function(){
      var selectedCountry = $(this).children("option:selected").val();
      alert("You have selected the country - " + selectedCountry);
  })



 function checkreferral(newtrnasport_amount){

    var customer_id = $("#customer_id").val();

     $.ajax({

        url: '<?php echo base_url()?>customer/check_referal_code',
        type:'POST',
        data:{'referral_id':$("#referall_id").val(),'customer_id':customer_id},
        success: function (response)
        {
          if(response=='success'){ 

          /*  $(".referaal_msg").show();*/
            $("#referaal_msg").html("Referral code Applied succefully");
           

           /* var referal_data = 'yes';
            do_transport_coupon_referel_calcualtion(referal_data);*/

            setTimeout(function(){ 
              $("#referaal_msg").html('');
              $('#myModal_referall').modal('hide');
            }, 3000);

          }else{

             $("#referall_id").val('');

            $(".error_refer").show();
            $(".error_refer").html("Referral is incorrect");
            setTimeout(function(){ 
              $(".error_refer").hide();
            }, 3000);
            
          }        
       }
    }); 
 }


function discount_percent_change(){
  //alert();
  var referal_data = '';
  do_transport_coupon_referel_calcualtion(referal_data);
}

function get_pickup_type(pickup_type=null) {

  if (pickup_type == 'pickup') {
    $("#transport_tokn_amt").html($("#trp_paid_amt").val());
  }
  else if (pickup_type == 'warehouse_arrival') {
    $("#transport_tokn_amt").html('500.00');
  }
}


function book_slot_fun() {

    var pickup_type = $('input[name="pickup_type"]:checked').val();

    if(pickup_type == undefined || pickup_type ==''){

      $("#select_trp_err").html('Please select Transport..!<br/>'); 
      setTimeout(function(){ $("#select_trp_err").html(''); },2000);
      return false;
    }else{

      if(pickup_type =='pickup'){

         var date_arr =[];
         var date_arr = JSON.parse($("#disabled_date_arr").val());

         $("#DatePicker").datepicker("destroy");
         $('#DatePicker').datepicker({
            showButtonPanel: false,
            minDate: 0,
            onSelect: function() {
              var selected = $(this).val();
            $("#set_date").val(selected);
            },
            beforeShowDay: function(date){
              var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
              return [ date_arr.indexOf(string) == -1 ]
            },
         });   


      }else{

         var date_arr =[];
         var date_arr = JSON.parse($("#arrival_disabled_dates_arr").val());

         $("#DatePicker").datepicker("destroy");
         $('#DatePicker').datepicker({
            showButtonPanel: false,
            minDate: 0,
            onSelect: function() {
              var selected = $(this).val();
            $("#set_date").val(selected);
            },
            beforeShowDay: function(date){
              var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
              return [ date_arr.indexOf(string) == -1 ]
            },
         });   
      }
        
      $('#mybookModaldate').modal('show');
    }
} 

$(document).on('change', '#storage_myselect', function() {

    do_transport_coupon_referel_calcualtion();
});


function do_transport_coupon_referel_calcualtion(referal_data=null){


    console.log('called');



    var is_trp_percent=$("#storage_myselect option:selected").attr("data-transport_percent");

    $("#only_transport_myselect").val(is_trp_percent);

    var storage_coupon_str = $("#storage_myselect").val();  
    var only_transport_myselect = is_trp_percent;

    var coupen=$('#coupen_code_id').val();


    var msg_coupon_type='';
    var msg_coupon_amt=0;

    var newtrnasport_amount = 0;

    var total_pickup_charges = $("#post_total_pickup_charges").val();

    var referal_amount = 0;
    var coupen_amount  = 0;

    if(storage_coupon_str !=''){

        var numbersArray = storage_coupon_str.split(',');
  
        var type=numbersArray[0];
        var amount=numbersArray[1];

        msg_coupon_type = numbersArray[0];
        msg_coupon_amt = numbersArray[1];

        if(type =='flat'){

          coupen_amount =amount;
          
        }else{

          if(only_transport_myselect !='' && only_transport_myselect !=null){

            amount = only_transport_myselect;
          }
          coupen_amount=(parseFloat(amount)/parseFloat(100))*(parseFloat(total_pickup_charges));
        }
    }    

    if(only_transport_myselect !='' && only_transport_myselect !=null){
        $("#trp_percent_msg").html(`&nbsp;(${only_transport_myselect}% discount)`);
      }else{
        $("#trp_percent_msg").html('');
      }

    if(coupen_amount > 1){
      $("#transport_charges_old").css('text-decoration','line-through');
      $('#transport_charges_show').show();
    }

    newtrnasport_amount = parseFloat(total_pickup_charges)- (parseFloat(coupen_amount) + parseFloat(referal_amount));

    var tokennew=(0.10*newtrnasport_amount);

    /*new condition*/
    var selected_home_type = $("#selected_home_type").val();

    if(selected_home_type =='1rk'){
      tokennew = 1000;
    }else if(selected_home_type =='1bhk'){
      tokennew = 1000;
    }else if(selected_home_type =='2bhk'){
      tokennew = 2000;
    }else if(selected_home_type =='3bhk'){
      tokennew = 3000;  
    }else{
      tokennew = 3000;  
    }


     /*red coloured text*/
    $('#transport_tokn_amt').html(tokennew.toFixed(2));

    /*set form values*/
    $("#transport_token_amt").val(tokennew.toFixed(2));
    $('#transport_charges_show').html(newtrnasport_amount.toFixed(2)+'/-');
    $('#transport_token_show').html(tokennew.toFixed(2)+'/-');
    $('#trp_paid_amt').val(tokennew.toFixed(2));
    $("#total_pickup_charges").val(newtrnasport_amount.toFixed(2));


    var msg_coupon_text ='0%'; 
    if(msg_coupon_type =='flat'){
      msg_coupon_text ='Flat '+msg_coupon_amt+" OFF";
    }else{
      msg_coupon_text =msg_coupon_amt+"% OFF";
    }
    $("#coupon_applied_msg").html(msg_coupon_text+" coupon has been applied.");

    /*storage coupon*/
      var monthly_storage_charges =$("#monthly_storage_charges_id").val();   

      let storage_multi_factor = 1;
      if($("#storage_multi_factor").val() !=''){
        storage_multi_factor = $("#storage_multi_factor").val();
      }
      var storage_charges_without_gst = parseFloat(monthly_storage_charges) * parseFloat(storage_multi_factor);

      var gst_amt = parseFloat(storage_charges_without_gst) * parseFloat(0.18);

      var unformated_amt=parseFloat(storage_charges_without_gst) + parseFloat(gst_amt);

      var storage_charges_inc_gst = Math.round(parseFloat(unformated_amt).toFixed(2));

      if(storage_coupon_str !=''){

          var numbersArray = storage_coupon_str.split(',');
    
          var type=numbersArray[0];
          var amount=numbersArray[1];

          if(type =='flat'){

            storage_coupon_amount =amount;
            
          }else{

            storage_coupon_amount=(parseFloat(amount)/parseFloat(100))*(parseFloat(storage_charges_inc_gst));
          }

          var monthly_discounted_amt = Math.round(parseFloat(storage_charges_inc_gst)-parseFloat(storage_coupon_amount));

          
          $("#monthly_old").css('text-decoration','line-through');
          $("#monthly_new").html(monthly_discounted_amt+'/-');

          $("#half_year_old").html(Math.round(parseFloat(monthly_discounted_amt) * parseFloat(6))+'/-');
          var month6=monthly_discounted_amt-((10/100)*monthly_discounted_amt);
          var six_month_amt =(month6*6).toFixed(2);
          $("#half_year_old").css('text-decoration','line-through');
          $("#half_year_new").html(Math.round(six_month_amt)+'/-');


          $("#yearly_old").html(Math.round(parseFloat(monthly_discounted_amt) * parseFloat(12))+'/-');
          var month12=monthly_discounted_amt-((20/100)*monthly_discounted_amt);
          var yearly_amt =(month12*12).toFixed(2);;
          $("#yearly_old").css('text-decoration','line-through');
          $("#yearly_new").html(Math.round(yearly_amt)+'/-');

          var input_coupon_code =coupen+'-'+type+'-'+amount;
          $("#coupen_code").val(input_coupon_code);
    }

    tokennew=tokennew.toFixed(2);

    var transport_type =  $('input[name="warehouse_arrival"]:checked').val();

   if(transport_type ==1){ /*warehouse arriaval*/

      tokennew = 500;
    }

    /*get disabled array*/

    var date_arr =[];

    var date_arr = JSON.parse($("#disabled_date_arr").val());

    /*end*/

    $("#DatePicker").datepicker("destroy");
    $('#DatePicker').datepicker({
    showButtonPanel: false,
    minDate: 0,

      onSelect: function() {
        var selected = $(this).val();
      $("#set_date").val(selected);
    },
     beforeShowDay: function(date){
        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
        return [ date_arr.indexOf(string) == -1 ]
    },
     /* beforeShowDay: function(date) {
            var hlText = dates[date]; 
            var date2 = new Date(date);
            var tglAja = date2.getDate();
              if (hlText) {
                   updateDatePickerCells(tglAja,hlText);
                  return [true, "", hlText];
              }
              else {
                  return [true, '', ''];
              }
        },   */
      });
    /*  function updateDatePickerCells(a,b) { 
      var num = parseInt(a); 
      setTimeout(function () {
          $('.ui-datepicker td > *').each(function (idx, elem) {   
              value='₹ '+tokennew;   

             
              console.log("test");

              var className = 'datepicker-content-' + CryptoJS.MD5(value).toString();
              if(value == 0)
                  addCSSRule('.ui-datepicker td a.' + className + ':after {content: "\\a0";}'); //&nbsp;
              else
                  addCSSRule('.ui-datepicker td a.' + className + ':after {content: "' + value + '";}');
              $(this).addClass(className);
          });
      }, 0);
      }
      var dynamicCSSRules = [];
      function addCSSRule(rule) {
        if ($.inArray(rule, dynamicCSSRules) == -1) {
            $('head').append('<style>' + rule + '</style>');
            dynamicCSSRules.push(rule);
        }
      }*/
  return true;
}



function submitforms(){
   
    var set_date = $("#set_date").val();

    if(set_date !=null && set_date !=undefined && set_date !=''){


    }else{

      $("#date_err").html('Please  select date');

      setTimeout(function(){ $("#date_err").html(''); }, 2000);
   
      return false;
    }

   /* var transport_type =  $('input[name="warehouse_arrival"]:checked').val();

    var transport='safestorage_transport';

    if(transport_type ==1){
        
      var transport='warehouse_arrival';
    }*/
    var pickup_type = $('input[name="pickup_type"]:checked').val();
  
    if($('#is_terms_condition').is(":checked")){
   
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = '<?php echo base_url();?>customer/savedata';
      const hiddenField = document.createElement('input');
      hiddenField.type = 'hidden';
      hiddenField.name = 'date';
      hiddenField.value = $("#set_date").val();
      form.appendChild(hiddenField);

      const hiddenField1 = document.createElement('input');
      hiddenField1.type = 'hidden';
      hiddenField1.name = 'customer_id';
      hiddenField1.value = $("#customer_id").val();
      form.appendChild(hiddenField1);

      const hiddenfield2 = document.createElement('input');
      hiddenfield2.type = 'hidden';
      hiddenfield2.name = 'quotation_id';
      hiddenfield2.value = $("#quotation_id").val();
      form.appendChild(hiddenfield2);

      const hiddenfield3 = document.createElement('input');
      hiddenfield3.type = 'hidden';
      hiddenfield3.name = 'transport_amount';
      hiddenfield3.value = $("#transport_token_amt").val();
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
      hiddenfield7.value = $("#coupen_code").val();
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

      if(pickup_type =='warehouse_arrival'){

        const hiddenfield11 = document.createElement('input');
        hiddenfield11.type = 'hidden';
        hiddenfield11.name = 'warehouse_arrival_token_amt';
        hiddenfield11.value = 500;
        form.appendChild(hiddenfield11);
      }

      const hiddenfield12 = document.createElement('input');
      hiddenfield12.type = 'hidden';
      hiddenfield12.name = 'transport_coupon';
      if($("#only_transport_myselect").val() !='' && $("#only_transport_myselect").val() !=null){
         hiddenfield12.value = $("#id_transport_coupon").val();
      }else{
         hiddenfield12.value = $("#coupen_code").val();
      }

      form.appendChild(hiddenfield12);

      document.body.appendChild(form);
      form.submit();
    }else{

        $("#agreement_err").html("Please check and agree with terms & consitions.");
                
        setTimeout(function(){ 
          $("#agreement_err").html("");
         }, 3000);
    }
}


// Get the form element by its id
var form = document.getElementById("msform1");
form.addEventListener("submit", function(event) {
    event.preventDefault();
    /* console.log('submit');
    console.log(step1_number);
    if(step1_number==0){
        step2('household_storage');
    }  */
});

document.addEventListener('keyup', function(event) {
  if (event.key === 'Enter') {
    // Handle the enter key press event here
    console.log('Enter key pressed');
    console.log(step1_number);
    console.log(step2_number);
    console.log(step3_number);
    console.log(step4_number);

    if(step2_number==1){
        step3();
    }

     if(step3_number==1){
       $('.btn_save_quation').trigger('click');
    }
    
  }
});

$(document).ready(function() {
           

            $(document).on("click",".minus",function() {
            //$('.minus').click(function () {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                if(count==0){
                    remove_item_fun($(this).attr('data-id'));
                }
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                check_autohometype();
                return false;
            });
           $(document).on("click",".plus",function() {
                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                check_autohometype();
                return false;
            });

      


        });


 $(document).on("keyup","#search-box",function() {
  // $("#search-box").keyup(function(){

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




</script>
 

