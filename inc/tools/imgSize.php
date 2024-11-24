<?php 

if (!function_exists('img_size')) {

  function img_size($path, $echo = true)
  {

    list($width, $height, $type, $attr) = getimagesize($path);

    if ($echo == false) {
      return $attr;
    } else {
      echo $attr;
    }
  }
  
}
