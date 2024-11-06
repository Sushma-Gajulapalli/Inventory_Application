<link href="<?php echo base_url()?>assets/datepicker/datepicker.css" rel="stylesheet" type="text/css" />
<style type="text/css">
  .bg-est{
       background: rgb(140 200 255 / 50%);
  }
  .bg-token{
    background: rgb(255 203 186 / 50%);;
  }
</style>
<!--New CSS-->
<style> 

.orange-clr{
color:#e8582a;
}

.selected{
  pointer-events: none;
}

 .list-inline-item:not(:last-child) {
          margin-right: .1rem !important; 
        }
}

.ui-datepicker td a:after
{
content: "";
display: block;
text-align: left;
color: #b7eb81;
font-size: 12px;
font-weight: bold;
}
.ui-datepicker .ui-widget .ui-widget-content .ui-helper-clearfix .ui-corner-all{
position: absolute; top: 127px; left: 929.328px; z-index: 1000; display: none !important;

}
#ui-datepicker-div{
display: block !important;
position: absolute !important;
top: 138.181px !important;
width: 447px
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


textarea{
    resize: none;
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
color: #fff;
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
padding: 30px;
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
</style>

<!--End neww-->
<style> 
   .list-inline-item:not(:last-child) {
   margin-right: .1rem !important; 
   }
   .ui-datepicker td a:after
   {
   content: "";
   display: block;
   text-align: left;
   color: #b7eb81;
   font-size: 12px;
   font-weight: bold;
   }
   .ui-datepicker .ui-widget .ui-widget-content .ui-helper-clearfix .ui-corner-all{
   position: absolute; top: 127px; left: 929.328px; z-index: 1000; display: none !important;
   }
   #ui-datepicker-div{
   display: block !important;
   position: absolute !important;
   top: 138.181px !important;
   width: 447px
   }
   .ui-widget-header{
   background: #fff !important;
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
   .list-name-field {
   padding: 0 10px;
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
   color: #fff;
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
   .referral_modal{
   height: 38px;margin-left: 18px;;
   }
   .zerocancal{
   color: white;
   background: #17a2b8;
   border-radius: 5px;padding: 0 10px;
   }
</style>
<style>
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
</style>
<div class="loader" style="display:none"></div>
<!-- appointment step-->
<div class="ap-step" style="background:white">
   <div class="sec-pad">
     
      <script src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
      <script src="<?php echo base_url()?>assets/js/jquery.validate.min.js"></script>

      <link href="https://code.jquery.com/ui/1.10.4/themes/cupertino/jquery-ui.css" rel="stylesheet"/>
      <script src="https://code.jquery.com/ui/1.12.0-rc.2/jquery-ui.min.js" integrity="sha256-55Jz3pBCF8z9jBO1qQ7cIf0L+neuPTD1u7Ytzrp2dqo=" crossorigin="anonymous"></script>

      <style type="text/css">
         .summary{
         display: block;
         line-height: 26px;
         border-radius: 50%;
         width: 30px;
         height: 30px;
         position: absolute;
         left: 0px;
         top: 0px;
         text-align: center;
         border: 2px solid rgb(221, 221, 221)
         } 
         .label_info
         {
         margin-left: 18px;
         margin-top: 3px;
         color: rgb(6, 134, 216)
         }
         .info{
         margin-left: 18px;
         }

         .option-box{background:#f3f9fb;}



.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{    border: 1px solid #031a5b !important;}

.ui-datepicker td a:after{color: #ef5921 !important;}

.ui-datepicker-inline.ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all

{width:100%;}




      </style>
      <div class="container">
         <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10">
               <!--PEN CONTENT     -->
               <div class="content">
                  <!--content inner-->
                  <div class="content__inner">
                     <div class=" overflow-hidden">
                        <!--multisteps-form-->
                        <div class="multisteps-form">
                           <div class="modal" id="myModal">
                              <div class="modal-dialog">
                                 <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                       <h4 class="modal-title">List of items</h4>
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                       <div class="table-responsive-sm" style="margin-top: -47px;">
                                          <table border="1" width="100%" class="item_list_tbl cssTable" style="margin-top:50px;">
                                             <thead>
                                                <tr>
                                                   <th class="style_class"><b>List of items</b></th>
                                                   <th class="style_class" style="text-align: center;"><b>Qty</b></th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                                <?php
                                                   $index_auto = 1;    
                                                       foreach ($storage_item_qty as $key => $item) {
                                                   ?>
                                                <tr>
                                                   <td style="width:40%;"><?php echo $key;?>
                                                   </td>
                                                   <td style="width:20%;"><?php echo $item;?></td>
                                                </tr>
                                                <?php   
                                                   $index_auto++; 
                                                   }
                                                   
                                                   ?>
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <style>
                           .ui-widget-content {
                           border: 1px solid #ffffff  !important;;
                           background: #ffffff url() 50% top repeat-x !important;
                           color: #362b36  !important;;
                           }
                           .ui-widget-content {
                           border: 1px solid #ffffff  !important;;
                           background: #ffffff url() 50% top repeat-x  !important;;
                           color: #362b36  !important;;
                           }
                           .ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
                           border: 1px solid #aed0ea;
                           /* background: #d7ebf9 url(images/ui-bg_glass_80_d7ebf9_1x400.png) 50% 50% repeat-x; */
                           font-weight: bold;
                           color: #040e24;
                           }
                           .ui-datepicker td a:after {
                           content: "";
                           display: block;
                           text-align: left;
                           color: #040e24;
                           font-size: 9px;
                           /* font-weight: bold; */
                           font-style: italic;
                           }
                           #ui-datepicker-div{
                           display: none !important;
                           }
                        </style>
 
                        <div class="modal" id="myModal_referall">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <!-- Modal Header -->
                                 <div class="modal-header">
                                    <h4 class="modal-title">Referral Code</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 </div>
                                 <!-- Modal body -->
                                 <div class="modal-body">
                                    <div class="table-responsive-sm">
                                       <div class="row">
                                          <div class="col-md-12 form-group">
                                             <div class="button-row d-flex mt-4">
                                              <?php if(!empty($customer_data->referee_id)){ ?>

                                              <input type="hidden" name="referall_id" class='form-control' id="referall_id" value="<?php echo $customer_data->referee_id;?>">

                                              <?php  }else{ ?>

                                                <input type="text" name="referall_id" class='form-control' id="referall_id" placeholder="Enter Referral Code">
                                              <?php } ?>  

                                             </div>
                                             <span class="error_refer" style="color:red"></span>
                                              <span id="referaal_msg" style="color:green"></span>
                                          </div>
                                       </div>
                                       <div class="row">
                                          <div class="col-md-12 col-lg-6">
                                             <div class="button-row d-flex mt-4">
                                             </div>
                                          </div>
                                          <div class="col-md-12 col-lg-6 text-right">
                                             <div class="button-row d-flex">
                                                <button type="submit" class="btn btn-orange ml-auto js-btn-next" style="color: white;" onclick="checkreferral()">
                                                Submit
                                                </button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                    <?php
                        
                      $total_pickup_charges =($quotation_data->lift_cost + $quotation_data->transport_cost + $quotation_data->labour_cost + $quotation_data->item_packing_charges + $quotation_data->extra_km_charges);  

                      $token_percent = 10;
                      $transport_token_amt=($total_pickup_charges * $token_percent)/100;
                    ?>  

                        <div class="modal" id="myModaldate">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h4 class="modal-title">Book Slot </h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 </div>
                                 <div class="modal-body">
                                    <div class="table-responsive-sm">
                                       <div class="multisteps-form__panel shadow pt-4   js-active" data-animation="scaleIn">
                                          <div class="option-box">
                                            <div class="row">
                                                <div class="col-md-12">
                                                  <span  style="color: red" id="date_err"></span>
                                                </div>
                                            </div>    
                                             <div class="row">
                                                <div class="col-md-12">
                                                   <div class="row" style="margin-bottom: 2px">
                                                      <div class="col-md-12 col-lg-12">
                                                         <!--    <input type="text" id="txtdate" name="date" class="form-control" placeholder="Select Date"> -->
                                                         <div id="DatePicker" autofocus></div>

                                                         <input type="hidden" id="set_date" value="">

                                                         <input type="hidden"  id="date" name="date">
                                                         <input type="hidden"  id="transport_amount" name="transport_amount">
                                                         <input type="hidden" id="customer_id" name="customer_id"  value="<?php echo  $customer_id;?>">
                                                         <input type="hidden" name="quotation_id"  value="<?php echo  $quotation_id;?>">
                                                         <input type="hidden" name="coupen_code"  value="" id="coupen_code">
                                                         <input type="hidden" name="referee_id"  value="" id="referee_id">
                                                         <input type="hidden" name="total_pickup_charges" id="total_pickup_charges" value="<?php echo @$total_pickup_charges;?>">

                                                         <input type="hidden" id="post_total_pickup_charges" value="<?php echo @$total_pickup_charges;?>">


                                                         <input type="hidden" name="transport_token_amt" id="transport_token_amt" value="<?php echo @$transport_token_amt?>">
                                                         <input type="hidden" name="old_transpoet_charge" id="old_transpoet_charge" value="<?php echo @$quotation_data->total_pickup_charges_with_gst; ?>">

                                                         <input type="hidden" id="selected_home_type" value="<?php echo $quotation_data->hometype;?>"> 
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
                                               <!--  <div class="col-md-12 col-lg-6">
                                                   <div class="button-row d-flex mt-4">
                                                   </div>
                                                </div> -->
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
                     </div>
                      <?php 
                           foreach ($datesprice as $key => $value) {
                         $datevalue=$value;
                        } ?>
                     <input type="hidden" id="datevalue" name="" value="<?php echo $datevalue; ?>">




                     
                     <script type="text/javascript">
                        var dates = {}
                      
                          <?php 
                           foreach ($datesprice as $key => $value) { ?>
                        dates[new Date('<?php echo $key;?>')]='₹ '+$("#datevalue").val();
                        <?php } ?>
                        
                        
                        $('#DatePicker').datepicker({
                          showButtonPanel: false,
                          minDate: 0,
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
                        },*/
                          
                          
                          
                        });
                        function updateDatePickerCells(a,b) {
                        
                          var num = parseInt(a);
                        
                          setTimeout(function () {
                        
                              $('.ui-datepicker td > *').each(function (idx, elem) {
                        
                                 // if((idx+1)==num){
                                      value=b;   
                                 /* }else{
                                       value=0;   
                                  }*/
                          
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
                        }
                     </script>
                     <form class="multisteps-form__form" action="<?php echo base_url();?>customer/savedata" method="post">
                        <!--single form panel-->
                        <div class="multisteps-form__panel shadow pt-4   js-active" data-animation="scaleIn">
                           <div class="option-box">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="row">
                                       <div class="col-6">
                                          <div class="button-row d-flex mt-4">
                                            
                                          </div>
                                       </div>
                                       <div class="col-6">
                                          <div class="button-row d-flex mt-4">
                                             <button type="button" class="btn btn-orange ml-auto js-btn-next" data-toggle="modal" data-target="#myModaldate">
                                             Book Slot
                                             </button>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-12 col-lg-12 zerocancal mt-4">Zero cancellation charges!!! Book now, If your plans are changed, cancel anytime before 24 hours to avail full refunds.
                                       </div>
                                    </div>
                                    <div class="row" style="margin-bottom: 2px">
                                       <div class="col-md-6 col-lg-6 form-group">
                                       </div>
                                       <div class="col-md-6 col-lg-6 text-right form-group">
                                          <div class="button-row">
                                             <?php if($transport_type !='warehouse_arrival') { ?> 
                                             <b> <a class="text text-orange ml-auto js-btn-next"  href="<?php echo @$quotation_pickup_link;?>" title="Next" style="color:#e8582a">Pay Token Advance &nbsp;₹&nbsp;<span id="transport_tokn_amt"><?php echo $token; ?></span></a></b>
                                             <?php }else{ ?>
                                             <b> <a class="text text-orange ml-auto js-btn-next"  href="javascript:void(0)" title="Next" style="color:#e8582a">Pay Token Advance &nbsp;₹&nbsp;<?php echo '500'; ?></a></b>
                                             <?php } ?>
                                          </div>
                                       </div>
                                    </div>
                      <?php

                    $monthly_gst_amt = ($quotation_data->total_storage_charges * 18)/100;   

                    $monthly_storage_charges = round(($quotation_data->total_storage_charges + $monthly_gst_amt));  
                    

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
                  <div class="row">
                     <div class="col-md-8 col-lg-8 col-sm-12">
                        <div class="button-row d-flex  media listing wow fadeIn fs14">
                          <i class="far fa-arrow-alt-circle-right orange-clr"></i>&nbsp;Monthly Storage charges (Incl 18% GST):-&nbsp;&nbsp; <strong>₹&nbsp;<span id="monthly_old"><?php echo @$monthly_storage_charges.'/- ';?></span> <span id="monthly_new"></span></strong>
                        </div>
                        <div class="button-row d-flex  media listing wow fadeIn fs14">
                          <i class="far fa-arrow-alt-circle-right orange-clr"></i>&nbsp;6 Months Storage Charges (10% discount):-&nbsp;&nbsp;<strong>₹&nbsp;<span id="half_year_old"><?php echo @$six_month_payable_amount.'/- '; ?></span><span id="half_year_new"></span></strong>
                        </div>
                        <div class="button-row d-flex media listing wow fadeIn fs14">
                              <i class="far fa-arrow-alt-circle-right orange-clr"></i>&nbsp;12 Months Storage Charges (20% discount):-&nbsp;&nbsp;<strong>₹&nbsp;<span id="yearly_old"><?php echo @$yearly_payable_amount.'/- '; ?></span><span id="yearly_new"></span></strong>
                           </div>

                           <?php if($transport_type=='safestorage_transport') { ?>  
                              <div class="button-row d-flex media listing wow fadeIn fs14 bg-est">
                              <i class="far fa-arrow-alt-circle-right orange-clr"></i> &nbsp;Estimated Transport charges <span id="trp_percent_msg"></span>:- &nbsp;₹&nbsp;<span id="transport_charges_old"><strong> <?php echo @$total_pickup_charges.'/-' ?></strong></span><span id="transport_charges_show" style="display: none"><b></b></span>
                              </div>
                              <div class="button-row d-flex media listing wow fadeIn fs14 bg-token">
                             <i class="far fa-arrow-alt-circle-right orange-clr"></i> &nbsp;Pay Token Advance:-&nbsp;&nbsp;₹&nbsp;<span id="transport_token_show"><strong><?php echo $transport_token_amt;?></strong></span>
                              </div>

                           <?php } else { ?>
                              <div class="button-row d-flex media listing wow fadeIn fs14">
                             Standard token advance 500 <br/>(will be adjusted on monthly storage charges)
                              </div>
                           <?php }  ?>

                          
                        </div>


                     <div class="col-md-4 col-lg-4 col-sm-12" style="vertical-align: middle;margin: auto;">
                      <img src="https://safestorage.in/test_new_design/assets/new_design_css/img/services/services2_4.png" class="img-fluid wow fadeInLeft" style="visibility: visible; animation-name: fadeInLeft;">
                       
                     </div>
                  </div>
                 <div class="row">
                    
                    <div class="col-md-6 col-lg-6">
                    <?php 

                      $storage_coupon_val = $percent_coupon;

                      $amount_coupen=($percent_coupon/100)*$total_pickup_charges;
                      $coupen_type = 'percent';
                      $coupen_code='safestorage';

                      $post_coupon_value = "safestorage-percent-".$percent_coupon;

                      $option_val = $amount_coupen.'% OFF';

                      if(!empty($quotation_data->storage_coupen)){

                        /*as per new condition in dropdown storage charge coupon but while*/

                       $transport_coupon_arr = explode('-', $quotation_data->storage_coupen);

                          $coupen_code=$transport_coupon_arr[0];

                          $storage_coupon_val = $transport_coupon_arr[2];

                          if($transport_coupon_arr[1] =='flat'){

                            $coupen_type = 'flat';
                            $amount_coupen=$transport_coupon_arr[2];
                            $option_val='Flat ₹'.$transport_coupon_arr[2].' OFF ';
                            $post_coupon_value=$coupen_code."-".$coupen_type."-".$transport_coupon_arr[2];

                          }else{

                            $coupen_type = 'percent';
                            $amount_coupen=($transport_coupon_arr[2]/100)*$total_pickup_charges;
                            $option_val=$transport_coupon_arr[2].'% OFF';
                            $post_coupon_value=$coupen_code."-".$coupen_type."-".$transport_coupon_arr[2];
                          }
                      }  
                    ?>

                      <input type="hidden" id="myselect" name="myselect" value="<?php echo $total_pickup_charges;?>,<?php echo $amount_coupen;?>,<?php echo $coupen_code;?>,<?php echo $coupen_type;?>">

                      <input type="hidden" id="storage_myselect" name="storage_myselect" value="<?php echo $coupen_type;?>,<?php echo $storage_coupon_val;?>">

                      <input type="hidden" id="post_coupon_value" value="<?php echo $post_coupon_value;?>">

                      <input type="hidden" id="only_transport_myselect" name="only_transport_myselect" value="<?php echo $trp_percent_coupon;?>">

                      <input type="hidden" id="id_transport_coupon" name="transport_coupon" value="<?php echo $transport_coupon; ?>">

                          <strong><label>Select coupon</label></strong>
                            <div class="custom-select-wrapper position-relative">
                                  <i class="fa fa-gift form-control-icon fa-fw"></i>
                                  <div class="custom-select">
                                    <div class="custom-select__trigger">
                                      <span><?php echo @$option_val;?></span>
                                      <div class="arrow"></div>
                                    </div>
                                  <div class="custom-options">
                                    
                                    <span data-transport_percent="<?php echo $trp_percent_coupon;?>" data-storage_coupon="percent,<?php echo $percent_coupon;?>" class="custom-option pickup_lift custom-option_c selected"  data-value="<?php echo $total_pickup_charges; ?>,<?php echo $amount_coupen; ?>,<?php echo $coupen_code;?>"> <?php echo @$percent_coupon.'%' ?> </span>


                                      <?php foreach ($coupen_list as $key => $value) { 
                                      $coupen_type = '';
                                      if($value->charge_type==1){ 
                                      $amount_coupen=$value->amount;
                                      $coupen_type = 'flat';
                                      } else{
                                      $amount_coupen=($value->amount/100)*$total_pickup_charges;
                                      $coupen_type = 'percent';
                                      } ?> 
                                      <?php  if($value->charge_type==1){ 
                                      $option='Flat ₹'.$value->amount.' OFF ';
                                      ?>
                                      <span data-transport_percent="" data-storage_coupon="<?php echo $coupen_type;?>,<?php echo $value->amount;?>" class="custom-option pickup_lift" data-value="<?php echo $total_pickup_charges; ?>,<?php echo $amount_coupen; ?>,<?php echo $value->coupen_code;?>,<?php echo $coupen_type;?>"> <?php echo $option?></span>
                                      <?php
                                      $amount_coupen=$value->amount;
                                      } else{
                                      $option=$value->amount.'% OFF';
                                      $amount_coupen=($value->amount/100)*$total_pickup_charges;

                                      ?> 
                                      <span data-transport_percent="" data-storage_coupon="<?php echo $coupen_type;?>,<?php echo $value->amount;?>" class="custom-option pickup_lift" data-value="<?php echo  $total_pickup_charges; ?>,<?php echo $amount_coupen; ?>,<?php echo $value->coupen_code;?>,<?php echo $coupen_type;?>"> <?php echo $option?></span>
                                      <?php } }?> 
                                  </div>
                                  </div>
                                </div> 
                            </div>
                        </div>    

                      <div style="margin-top: 10px;" class="row">
                        <div class="col-md-8 col-lg-8 col-sm-12">
                            <div class="button-row d-flex media listing wow fadeIn fs14">
                              <i class="far fa-arrow-alt-circle-right orange-clr"></i>&nbsp;
                              <span id="coupon_applied_msg"><?php echo $option_val;?> coupon has been applied.</span>
                            </div>
                        </div>
                      </div>
                        
                        
                        <?php
                          if(!empty($customer_data->referee_id)){}else{
                        ?>
                        <div class="row">  
                          <div class="col-md-12">
                            <br/>
                          </div>
                        </div>   
                        <div class="row">  
                            <div class="col-md-12 col-lg-12 form-group">
                              <label>Did you referred by any friend ? Click below button to enter referral code <span class="text-orange">*</span></label>
                              <br/>
                                <button style="margin-bottom: 6px;" type="button" class="btn btn-info btn-md " data-toggle="modal" data-target="#myModal_referall" style="">
                                Enter Referral Code
                                </button>
                                <br/>
                                 <a style="color: #007bff;cursor: pointer;" onclick='window.open("<?php echo base_url();?>refer-and-earn");return false;'>Click here to know how referral code work?</a>
                            </div>
                           </div>  
                          <?php } ?>  

                                 
                                    <hr>
                                    <div class="row">
                                       <div class="col-md-6 col-lg-6 col-sm-12 form-group">
                                          <div class="button-row d-flex">
                                             <strong class="info">Name:-</strong>&nbsp;&nbsp;<?php echo @$customer_data->customer_name; ?>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-6 col-sm-12 form-group">
                                          <div class="button-row d-flex">
                                             <strong class="info">Phone No:-</strong>&nbsp;&nbsp;<?php echo @$customer_data->customer_contact1; ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-6 col-lg-6 col-sm-12 form-group">
                                          <div class="button-row d-flex">
                                             <strong class="info">Email:-</strong>&nbsp;&nbsp;<?php echo @$customer_data->customer_email; ?>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-6 col-sm-12 form-group">
                                          <div class="button-row d-flex">
                                             <strong class="info">City:-</strong>&nbsp;&nbsp;<?php echo @$customer_data->customer_local_city; ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-6 col-lg-6 col-sm-12 w_data form-group">
                                          <div class="button-row d-flex">
                                             <strong class="info">Pickup Add :-</strong>&nbsp;&nbsp;<?php echo @$customer_data->pickup_address; ?>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-6 col-sm-12 w_data form-group">
                                          <div class="button-row d-flex">
                                             <strong class="info">Floor No:-</strong>&nbsp;&nbsp;<?php echo @$customer_data->pickup_floor; ?>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-md-6 col-lg-6 col-sm-12 w_data1 form-group" style="display: none;">
                                          <div class="button-row d-flex">
                                             <strong class="info">Lift available:-</strong>&nbsp;&nbsp;<?php echo @$customer_data->pickup_lift; ?>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-lg-6 col-sm-12 form-group">
                                          <div class="button-row d-flex">
                                             <strong class="info">Home Type:-</strong>&nbsp;&nbsp;<span style="text-transform: uppercase;"><?php echo @$hometype; ?></span>
                                          </div>
                                        
                                       </div>
                                    </div>

                                      <div class="row">
                                       <div class="col-md-6 col-lg-6 col-sm-12 w_data1 form-group">
                                           <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" style="margin-left: 18px;">
                                          Show inventory Items
                                          </button>
                                        
                                       </div>
                                       
                                    </div>

                                    <input type="hidden" name = "pickup_address" value="<?php echo @$customer_data->pickup_address;?>" id="pickup_address">
                                    <input type="hidden" name = "pickup_floor" value="<?php echo @$customer_data->pickup_floor;?>" id="pickup_floor">

                                     <div class="row" style="margin-top: 20px;">
                                 <?php if($transport_type =='warehouse_arrival') { ?>
                                 <hr>
                                 <p><b> Note:<b> All items must be packed with storage standards(3 layer),otherwise packing consumables and packers charges applicable.
                                    Refer to Ratecard for packing charges and packing helper charges would be shared at the warehouse.
                                 </p>
                                 <?php } ?>
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
      <script src="<?php echo base_url()?>assets/froentui/js/select-beauty.stable.min.js"></script>

      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCse5f97FoDXrT5kKoeB1XGCxeCs12-mOE&libraries=places"></script>
<script type="text/javascript">


   function submit(){

    var set_date = $("#set_date").val();

    if(set_date !=null && set_date !=undefined && set_date !=''){


    }else{

      $("#date_err").html('Please  select date');

      setTimeout(function(){ $("#date_err").html(''); }, 2000);
   
      return false;
    }
  
     if($('#is_terms_condition').is(":checked")){
          
          var transport = '<?php echo $quotation_data->transport_type;?>';
         
          const form = document.createElement('form');
         form.method = 'POST';
         form.action = '<?php echo base_url();?>customer/savedata';
         const hiddenField = document.createElement('input');
         hiddenField.type = 'hidden';
         hiddenField.name = 'date';
         hiddenField.value =set_date;
         form.appendChild(hiddenField);
         
         const hiddenField1 = document.createElement('input');
         hiddenField1.type = 'hidden';
         hiddenField1.name = 'customer_id';
         hiddenField1.value = '<?php echo  $customer_id;?>';
         form.appendChild(hiddenField1);
         
         const hiddenfield2 = document.createElement('input');
         hiddenfield2.type = 'hidden';
         hiddenfield2.name = 'quotation_id';
         hiddenfield2.value = '<?php echo  $quotation_id;?>';
         form.appendChild(hiddenfield2);
         
         const hiddenfield3 = document.createElement('input');
         hiddenfield3.type = 'hidden';
         hiddenfield3.name = 'transport_amount';
         hiddenfield3.value = $("#total_pickup_charges").val();
         form.appendChild(hiddenfield3);
         
         //dates[new Date($("#DatePicker").val())]
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
         hiddenfield7.value =$("#post_coupon_value").val(); /*$("#coupen_code").val();*/
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
          hiddenfield10.value = transport;
          form.appendChild(hiddenfield10);

          if(transport =='warehouse_arrival'){

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
             hiddenfield12.value = $("#post_coupon_value").val();
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
         
           /*console.log(dates[new Date($("#DatePicker").val())]);*/
         
         
         }
      </script>
      <script type="text/javascript">
         $(document).ready(function(){
         
           var pickup_address = $("#pickup_address").val();
         
           var pickup_floor = $("#pickup_floor").val();
         
           if(pickup_address!='')
           {
             
             $(".w_data").css('display','');
         
             if(pickup_floor=='basement' || pickup_floor=='ground')
             {
               $(".w_data1").css('display','none');
             }
         
             else
             {
               $(".w_data1").css('display','');
             }
         
            
           }


           
         });
      </script>
      <script language="javascript">
 $(document).ready(function () {
 
    
     do_transport_coupon_referel_calcualtion();


      $("#DatePicker").on("change",function(){
        var selected = $(this).val();

        $("#set_date").val(selected);
    });
 });
  

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

         
 function do_transport_coupon_referel_calcualtion(referal_data=null){

      var storage_coupon_str = $("#storage_myselect").val();  

      var only_transport_myselect = $("#only_transport_myselect").val();

      /*coupen code section */
      var numbersString=$('#myselect').val();
      var numbersArray = numbersString.split(',');
      var coupen=numbersArray[2];

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
     
      if(referal_amount > 1){
     
        $("#transport_charges_old").css('text-decoration','line-through');
        $('#transport_charges_show').show();
      }
     
      newtrnasport_amount = parseFloat(total_pickup_charges)- (parseFloat(coupen_amount) + parseFloat(referal_amount));

      var tokennew=(0.10*newtrnasport_amount);

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

      $("#datevalue").val(tokennew);
      $('#transport_tokn_amt').html(tokennew.toFixed(2));
     
      /*form value*/
      $("#transport_token_amt").val(tokennew.toFixed(2));
      $('#transport_charges_show').html(newtrnasport_amount.toFixed(2));
      $('#transport_token_show').html(tokennew.toFixed(2));

      $('#total_pickup_charges').val(newtrnasport_amount.toFixed(2));


      var msg_coupon_text ='0%'; 
      if(msg_coupon_type =='flat'){
        msg_coupon_text ='Flat '+msg_coupon_amt+" OFF";
      }else{
        msg_coupon_text =msg_coupon_amt+"% OFF";
      }
      $("#coupon_applied_msg").html(msg_coupon_text+" coupon has been applied.");
      /*for storage*/

      var monthly_storage_charges ='<?php echo $quotation_data->total_storage_charges;?>';
      var storage_charges_without_gst = monthly_storage_charges;

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

          /*storage_charges_inc_gst= parseFloat(storage_charges_without_gst) + parseFloat(storage_charges_inc_gst);*/
          
          $("#monthly_old").css('text-decoration','line-through');
          $("#monthly_new").html(monthly_discounted_amt+'/-');


          $("#half_year_old").html(Math.round(parseFloat(monthly_discounted_amt) * parseFloat(6))+'/-');

          var month6=monthly_discounted_amt-((10/100)*monthly_discounted_amt);
          var six_month_amt =(month6*6).toFixed(2);

          $("#half_year_old").css('text-decoration','line-through');
          $("#half_year_new").html(Math.round(six_month_amt)+'/-');


          $("#yearly_old").html(Math.round(parseFloat(monthly_discounted_amt) * parseFloat(12))+'/-');
          var month12=monthly_discounted_amt-((20/100)*monthly_discounted_amt);
          var yearly_amt =(month12*12).toFixed(2);
          $("#yearly_old").css('text-decoration','line-through');
          $("#yearly_new").html(Math.round(yearly_amt)+'/-');

          var input_coupon_code =coupen+'-'+type+'-'+amount;
          $("#post_coupon_value").val(input_coupon_code);

      }


        tokennew=tokennew.toFixed(2); 

      var transport = '<?php echo $quotation_data->transport_type;?>';
      if(transport =='warehouse_arrival'){

        tokennew = 500;
        
      }  


      $("#DatePicker").datepicker("destroy");
      $('#DatePicker').datepicker({
      showButtonPanel: false,
      minDate: 0,
      beforeShowDay: Disable_Dates,
      });
      function updateDatePickerCells(a,b) { 
      var num = parseInt(a); 
      setTimeout(function () {
          $('.ui-datepicker td > *').each(function (idx, elem) {  
              value='₹ '+tokennew+" ' ";   

             
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
      }
    
    return true;
 }
         
               
         function checkreferral(){

          var customer_id = $("#customer_id").val();
               
               $.ajax({
               
                 url: '<?php echo base_url()?>customer/check_referal_code',
                 type:'POST',
                 data:{'referral_id':$("#referall_id").val(),'customer_id':customer_id},
                 success: function (response)
                 {
                     if(response=='success'){ 
                        
                           $(".referaal_msg").show();
                           $("#referaal_msg").html("Referral Coupen Applied succefully");
                          
                          /* var referal_data = 'yes';
                           do_transport_coupon_referel_calcualtion(referal_data);*/
         
                           setTimeout(function(){ 
                             $('#myModal_referall').modal('hide');
                             $(".referaal_msg").hide();
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
               
               
            
      </script>
   </div>
</div>
</div>
<scgript src="<?php echo base_url()?>assets/froentui/js/select-beauty.stable.min.js">
</script>
<script type="text/javascript">
   
  // navbar mobile
  $(function() {
    $('#ChangeToggle').click(function() {
      $('#navbar-hamburger').toggleClass('show');
      $('#navbar-close').toggleClass('show');  
    });
  });
            //tooltip
   $(document).ready(function(){
      $('[data-toggle="popover"]').popover();
      
    });
// select dropdown
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


        $('#myselect').val($(this).attr('data-value'));
        $("#storage_myselect").val($(this).attr('data-storage_coupon'));
        $("#only_transport_myselect").val($(this).attr('data-transport_percent'));

        var referal_data = '';
        do_transport_coupon_referel_calcualtion(referal_data);
     
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
</script>