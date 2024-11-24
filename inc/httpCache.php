<?php

if ( !isset($_GET["cache"]) ) { // Si no existe Remove Cache by GET

  // $cache = ''; // Activar cache
  $cache = '?v=' . time(); // Remove Cache

  if ($cache == '') {
    $time_cache = "604800"; // Cache durante 7 días - 3600 = 1 hora

    // Establece la fecha de última modificación
    $last_modified_time = filemtime(__FILE__);
    $etag = md5_file(__FILE__);

    // Calcula la fecha de expiración (1 hora desde ahora)
    $expires = gmdate("D, d M Y H:i:s", time() + $time_cache) . " GMT";

    header("Last-Modified: " . gmdate("D, d M Y H:i:s", $last_modified_time) . " GMT");
    header("Etag: $etag");
    header("Cache-Control: public, max-age=$time_cache");
    header("Expires: $expires");

    // Comprueba si el contenido ha cambiado
    $if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false;
    $if_none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ? trim($_SERVER['HTTP_IF_NONE_MATCH']) : false;

    if (($if_modified_since && @strtotime($if_modified_since) == $last_modified_time) ||
      ($if_none_match && $if_none_match == $etag)
    ) {
      header("HTTP/1.1 304 Not Modified");
      exit;
    }
  }
} else { // Si existe remove Cache by Get

  // Establece encabezados para prevenir el almacenamiento en caché
  $now = time();
  header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
  header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
  header("Cache-Control: post-check=0, pre-check=0", false);
  header("Pragma: no-cache");
  header("Etag: $now");

  $cache = '?v=' . time(); // Remove Cache


}
