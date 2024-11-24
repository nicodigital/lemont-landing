<?php 
function toWebp($imgurl, $echo = true)
{

  if ($imgurl) {
    // Obtener la información de la ruta del archivo
    $imgInfo = pathinfo($imgurl);

    // Cambiar la extensión
    if ((strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false) && ($imgInfo['extension'] != "gif"  && $imgInfo['extension'] != "svg")) {

      $webp = $imgInfo['dirname'] . '/' . $imgInfo['filename'] . '.webp';
    } else {

      $webp = $imgInfo['dirname'] . '/' . $imgInfo['filename'] . '.' . $imgInfo['extension'];
    }

    if ($echo == false) {
      return $webp;
    } else {
      echo $webp;
    }
  }
}