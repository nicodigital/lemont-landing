<?php

function fixUrl($url, $echo = true)
{
  // Utiliza filter_var con FILTER_SANITIZE_URL para sanear la URL
  $urlSaneada = filter_var($url, FILTER_SANITIZE_URL);

  // Retorna la URL saneada
  if ($echo == false) {
    return $urlSaneada;
  } else {
    echo $urlSaneada;
  }
}