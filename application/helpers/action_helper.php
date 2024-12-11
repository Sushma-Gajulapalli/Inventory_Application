<?php
	
	/***************** For url parameter encode start ***********************/
		
	if (!function_exists('enc_param'))
	{
	    function enc_param($id='')
		{
			$secretHash = "qwertyuiopasdfghjklzxcvbnmqwert1";
			$encrypted_string=openssl_encrypt($id,"AES-128-ECB",$secretHash);
			return $encrypted_string;
		}   
	}

	
	/***************** For url parameter encode start ***********************/
		
	if (!function_exists('dec_param'))
	{
	    function dec_param($id='')
		{		
			$secretHash = "qwertyuiopasdfghjklzxcvbnmqwert1";
			$decrypted_string=openssl_decrypt($id,"AES-128-ECB",$secretHash);
			return $decrypted_string;
	    }   
	}
	

	/*for capthac site key*/
	if (!function_exists('recaptcha_site_key'))
	{
	 	function recaptcha_site_key(){
			$site_key ="6Le1VrYZAAAAAFEIn0Tyu3z49cf9YyN0pnv2tixp";
			return $site_key;
		}
	}
?>