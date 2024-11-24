<?php

if (!function_exists('print_require')) {

  function print_require($file)
  {
    ob_start();
    require($file);
    return ob_get_clean();
  }
  
}