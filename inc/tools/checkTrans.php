<?php 
function checkTrans($txt, $i18n) {

  $txt_val = slugify($txt);

  if (isset($i18n['types'][$txt_val])) {
      return $i18n['types'][$txt_val];
  } else {
      return $txt;
  }
  
}