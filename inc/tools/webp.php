<?php

if (!function_exists('webp')) {

  function webp($ext, $echo = true)
  {

    if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false) {
      $ext = 'webp';
    }

    if ($echo == false) {
      return $ext;
    } else {
      echo $ext;
    }
  }
  
}
