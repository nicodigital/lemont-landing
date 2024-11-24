<?php
if (!function_exists('sanity')) {

  function sanity($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

}