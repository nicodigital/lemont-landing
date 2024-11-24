<?php 
if (!function_exists('clipChars')) {
  function clipChars($string, $length) {
    if (strlen($string) <= $length) {
        return $string;
    }
    
    $truncated = substr($string, 0, $length);
    return $truncated . '...';
  }

}