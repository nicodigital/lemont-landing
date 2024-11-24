<?php 
function img_orient($url, $getclass = '', $webp = false, $alt = '', $lazy = true, $async = true)
{

  // Obtener el ancho y alto de la imagen
  list($ancho, $alto) = getimagesize($url);

  // Evaluar WebP
  if ($webp) {

    // Obtener Extensión
    $layout_url = pathinfo($url);
    $extension = $layout_url['extension'];

    if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== false) {
      $ext = 'webp';
    } else {
      $ext = $extension;
    }

    $img_path = $layout_url['dirname'] . '/' . $layout_url['filename'] . '.' . $ext;
  } else {

    $img_path = $url;
  }

  // Determinar si la imagen es vertical u horizontal
  $class = ($ancho > $alto) ? 'horizontal' : 'vertical';
  $class .= ' ' . $getclass;

  if ($lazy) {
    $lazy_attr = 'loading="lazy"';
  } else {
    $lazy_attr = '';
  }

  if ($async) {
    $async_attr = 'decoding="async"';
  } else {
    $async_attr = '';
  }

  // HTML con la imagen y la clase CSS
  echo "<img src='$img_path' alt='$alt' class='$class' width='$ancho' height='$alto' $lazy_attr  $async_attr />";

}
