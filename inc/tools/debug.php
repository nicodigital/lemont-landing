<?php

if (!function_exists('debug')) {

  function debug($arr, $die = false)
  {
    echo "<pre class='debug lenis lenis-scrolling lenis-smooth'>";
    $out = print_r($arr, true);
    echo htmlentities($out);
    echo "</pre>";

    if ($die) {
      die();
    }
  }
}