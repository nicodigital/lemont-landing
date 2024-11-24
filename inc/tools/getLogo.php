<?php

if (!function_exists('get_logo')) {
  function get_logo($path, $color = 'white', $class = '')
  {
    ob_start();
    require($path);
    echo ob_get_clean();
  }
}