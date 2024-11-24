<?php 

if (!function_exists('logGen')) {

  function logGen($data)
  {
    file_put_contents('log_gen.txt', $data . PHP_EOL, FILE_APPEND | LOCK_EX);
  }

}