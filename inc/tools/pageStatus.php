<?php

if (!function_exists('status')) {

  function status($fileName,  $target, $echo = true)
  {

    $active = 'active';

    if ($fileName == $target) {

      if ($echo == true) {
        echo $active;
      } else {
        return $active;
      }
    }
  }
}