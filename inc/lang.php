<?php 

/* GET LANG  */
 $lang = get_lang( $url );

if( $lang == "en" ){
  setlocale(LC_ALL, "en_EN", "US");
  $lang_code = 'en_EN';
}else{
 setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
 $lang_code = 'es_ES';
}

include 'lang/' . $lang . '.php';