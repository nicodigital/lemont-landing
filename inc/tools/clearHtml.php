<?php 
function clearHtml($texto, $echo = true)
{
  // Utiliza la función strip_tags para eliminar las etiquetas HTML
  $textoSinTags = strip_tags($texto);

  // Retorna el texto sin etiquetas
  if ($echo == false) {
    return $textoSinTags;
  } else {
    echo $textoSinTags;
  }
}
