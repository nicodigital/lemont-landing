<?php

if (!function_exists('smooth')) {

  function smooth($target, $echo = true)
  {

    $class = '';

    if ($target == 'home' && $GLOBALS['curr_page'] == 'home') {
      $class = 'smooth';

      if ($GLOBALS['detect']->isMobile()) {
        $class .= ' togg';
      }
    }

    if ($echo == true) {
      echo $class;
    } else {
      return $class;
    }
  }
}