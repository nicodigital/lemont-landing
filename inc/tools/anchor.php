<?php 

if (!function_exists('anchor')) {

  function anchor($hash, $target, $echo = true)
  {

    if ($target == 'home' && $GLOBALS['page'] == 'home') {
      $anchor = $hash;
    } else {
      $anchor = BASE_URL . $target . $hash;
    }

    if ($echo == true) {
      echo $anchor;
    } else {
      return $anchor;
    }
  }
}

if (!function_exists('anchor_class')) {

  function anchor_class($fileName,  $target, $echo = true)
  {

    $anchor = 'anchor';

    if ($fileName == $target) {

      if ($echo == true) {
        echo $anchor;
      } else {
        return $anchor;
      }
    }
  }
}
