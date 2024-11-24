<?php
include 'mobileDetect.php';
//Detect special conditions devices
@$iPod    		= stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
@$iPhone  		= stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
@$iPad    		= stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
@$webOS   		= stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
@$macintosh   	= stripos($_SERVER['HTTP_USER_AGENT'],"macintosh");
@$mac_os       = stripos($_SERVER['HTTP_USER_AGENT'],"Mac OS");

if( $iPod || $iPhone || $iPad || $webOS || $macintosh || $mac_os ){

   $platform = 'ios';

}else{

   if($detect->isMobile()){
    
   		$platform = 'android';

   }else{
   		$platform = 'windows';
   }

}

/* Detect Device */
if ( $detect->isMobile() && !$detect->isTablet() ) {

   $device = 'mobile';
   $isMobile = true;
   $isTablet = false;
   $isDesktop = false;
 
 }else if( $detect->isTablet() ){ // is Tablet
 
   $device = 'tablet';
   $isMobile = false;
   $isTablet = true;
   $isDesktop = false;
 
 }else{ // is Desktop
   $device = 'desktop';
   $isMobile = false;
   $isTablet = false;
   $isDesktop = true;
 
 }


