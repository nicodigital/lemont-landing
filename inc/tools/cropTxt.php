<?php 

if (!function_exists('cropTxt')) {

  function cropTxt($string, $word_limit)
  {
    $words = explode(' ', $string, ($word_limit + 1));
    if (count($words) > $word_limit)
      array_pop($words);
    return implode(' ', $words);
  }
  
}
