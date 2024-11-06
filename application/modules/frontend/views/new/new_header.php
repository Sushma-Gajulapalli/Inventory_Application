<html lang=en>
<head>
<meta charset=utf-8>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php if(!empty($meta_file)){
        if($meta_file =='blog_detail_meta'){
        $blog_data =array();
        if(!empty(@$blog_title)){
          $blog_data['blog_title'] = $blog_title;
          $this->load->view('frontend/meta/'.$meta_file,$blog_data);
        }
      }else{
      $this->load->view('frontend/meta/'.$meta_file);
      }
    }
  ?>
<link href="<?php echo base_url(); ?>assets/new_design_css/img/favicon.png" rel="shortcut icon" />

<link href="<?php echo base_url(); ?>assets/new_design_css/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/new_design_css/css/owl.carousel.min.css" rel="stylesheet">


<link href="<?php echo base_url(); ?>assets/new_design_css/css/custome.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/new_design_css/css/custome1.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>assets/new_design_css/css/responsive.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/new_design_css/css/responsive1.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>assets/new_design_css/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/new_design_css/css/font-awesome1.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>assets/new_design_css/css/animate.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/new_design_css/css/animate1.min.css" rel="stylesheet">

<link href="https://safestorage.in/test_back/assets/sweet_alert/sweetalert.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MPRNS8P');</script>

</head>
<style>
.zsiq_theme1 .zsiq_user {
    background-color: #ef5921 !important;
}
@media (min-width: 992px){
    .navbar-expand-lg .navbar-nav .nav-link {
        padding-right: 1.0rem !important;
         padding-left: 1.0rem !important;
    }
    .content-mobile {display: none;}
}


@media screen and (max-width: 768px) {
    .content-mobile {display: block;}
}

.content-mobile{
    background-color: #0c2134;
    border: 2px solid #0c2134;
    color: #ced0d2;
    border-radius: 50px;
    /* padding: 10px 30px; */
    text-transform: uppercase;
    font-size: 10px;
}

.content-mobile:hover{
    background-color: transparent;
    color: #0c2134;
}
.navbar{
    color: inherit;
    font-family:inherit;
}


</style>
<script type="text/javascript">
var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq ||
{mode: "async", widgetcode:"29e74c31e539ef9cb8e8b4bbcce5e8a356f5448beae95ed0e84211489d48c045e88ee93283abfc152598f75bdbae91fe2278d4b91084e7d60f234a41d4c097e5", values:{},ready:function(){}};
var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;
s.src="https://salesiq.zoho.in/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);d.write("<div id='zsiqwidget'></div>");

</script>
<!--End of Tawk.to Script-->


<body>
    
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WCF527P"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MPRNS8P"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="header" id="header">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="<?php echo base_url();?>">
                <img src="<?php echo base_url(); ?>assets/new_design_css/img/logo.png" alt="Best Self Storage Facility Providers" title="Best Self Storage Facility Providers" class="img-fluid logo">
            </a>

              <a class="nav-link content-mobile btn hide_btn_cost" href="<?php echo base_url();?>customer/create-quotation">Get a free quote</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto mr-0">
                    <li class="nav-item">
                        <a class="nav-link home" href="<?php echo base_url();?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link about" href="<?php echo base_url(); ?>about-us">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle service" href="#" data-toggle="dropdown">Services</a>
                        <ul class="dropdown-menu fade-up">
                          <li><a class="dropdown-item " href="<?php echo base_url();?>about-personal-storage">About Personal Storage</a></li>
                          <li><a class="dropdown-item " href="<?php echo base_url(); ?>household-storage">Household Storage</a></li>
                          <li><a class="dropdown-item " href="<?php echo base_url(); ?>automobile-storage">Automobile Storage</a></li>
                          <li><a class="dropdown-item " href="<?php echo base_url(); ?>box-storage">Box Storage</a></li>
                          <li><a class="dropdown-item " href="<?php echo base_url(); ?>business-storage">Business Storage</a></li>
                          <li><a class="dropdown-item " href="<?php echo base_url(); ?>document-storage">Document Storage</a></li>
                          <li><a class="dropdown-item " href="<?php echo base_url(); ?>packers_movers_details">Packers and Movers</a></li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pricing" href="<?php echo base_url(); ?>pricing">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link rent_saver" href="<?php echo base_url(); ?>rent_saver">Rent Saver</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link contact-us" href="<?php echo base_url(); ?>contact-us">Contact Us</a>
                    </li>

                     <li class="nav-item">
                       <!--  <a class="nav-link contact-us" href="<?php echo base_url(); ?>contact-us">Sign In</a> -->
                        <a class="nav-link contact-us" href="<?php echo base_url(); ?>back/auth">Sign In</a>
                        

                        
                    </li>


                    <li class="nav-item">
                        <a class="nav-link  hide_btn_cost" href="<?php echo base_url();?>customer/create-quotation"><button class="btn round-btn">Get a free quote</button></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div> 
</div>


<style>
    .request_popup .bg-img-7{background-image:url(<?php echo base_url(); ?>assets/images/bg_8.jpg);}
    .errors{color:red;}
    h2.h2-xl {
     font-size: 1.5rem;
      color: #ef5921;
    }
    .btn-orange {
    background: #ef5921 !important;
}
</style>
