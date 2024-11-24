<?php

/*////////////////////////// CHANGE MODE //////////////////////////*/
function getCurrentMode() {
  return $_GET['mode'] ?? 'php'; // 'php' es el valor por defecto si no hay parámetro
}

/*///////////////////////////////// GET URI ////////////////////////////////////*/

/**
 * Obtiene los segmentos de la URL y devuelve información basada en ellos.
 *
 * @param string $single El término que se compara con el penúltimo segmento de la URL.
 * @param string $lang El idioma por defecto del sitio.
 * @return array Un array que contiene dos elementos:
 *               - El primero es el último segmento de la URL o 'home' si estamos en la raíz del sitio.
 *               - El segundo es el parámetro $single si el penúltimo segmento coincide con él, de lo contrario es una cadena vacía.
 */
function get_uri($lang = 'es', $single = '') {
  $uri = $_SERVER['REQUEST_URI'];

  // Eliminar cualquier cosa después de un '?'
  $uri = strtok($uri, '?');

  // Obtener los segmentos de la URL
  $parts = explode('/', rtrim($uri, '/'));

  // Verificar si el primer segmento es "data"
  if ( isset($parts[1]) && $parts[1] === 'data' ) {
      // Devolver la URL completa o manejarla según sea necesario
      return [$uri, ''];
  }

  // Obtener el penúltimo segmento
  $before_last = isset($parts[count($parts) - 2]) ? $parts[count($parts) - 2] : '';
  
  // Obtener el último segmento
  $last = end($parts);

  // Verificar si estamos en la raíz del sitio
  if ($last == "" || $last == $lang || $last == $GLOBALS['site_slug']) {
      return ['home', ''];
  } else {
      // Comprobar si el término anterior al último es igual al parámetro $single
      if ($before_last === $single) {
          return [$last, $single];
      } else {
          return [$last, ''];
      }
  }
}

// Ejemplos de uso:
// $uri = get_uri($lang); <-- Así devuelve [ 'ultimo termino', vacio ]
// $uri = get_uri('film', $lang); <-- Así devuelve [ 'ultimo termino', 'film' ]

/*/////////////////////////////// GET LANG /////////////////////////////////*/

/**
 * Obtiene el código de idioma de una URL dada.
 *
 * @param string $url La URL de la cual se desea obtener el código de idioma.
 * @return string El código de idioma de la URL, o 'es' si no se encuentra ningún código de idioma en la URL.
 */
function get_lang($url, $langs = ['es', 'en', 'pt']) {
  $partesUrl = parse_url($url);
  $path = $partesUrl['path'];

  // Crear un patrón que coincida solo con los idiomas permitidos
  $patron_idioma = '/\/(' . implode('|', $langs) . ')\//';

  // Obtener el código de idioma de la URL
  if (preg_match($patron_idioma, $path, $matches)) {
      return $matches[1];
  }

  // Si no se encuentra un idioma válido, devolver el idioma por defecto
  return 'es';
}

/*//////////////////////////////// GET SLUG ////////////////////////////////*/
/**
 * Obtiene el slug de una URL dada.
 *
 * @param string $url La URL de la cual se desea obtener el slug.
 * @return string|null El slug de la URL, o null si el último segmento es un código de idioma.
 */
function get_slug($url)
{

  $partesUrl = parse_url($url);
  $path = $partesUrl['path'];

  // Obtener los segmentos de la ruta de la URL
  $segmentos = explode('/', $path);
  $page_slug  = end($segmentos);
  $bfe_slug       = isset( $segmentos[count($segmentos) - 2]) ? $segmentos[count($segmentos) - 2] : '';

  // Verificar si el último elemento es un código de idioma
  $pattern = '/^[a-z]{2}$/';

  if (preg_match($pattern, $page_slug)) {
    return null;
  } else {
    return $page_slug;
  }
}

/*//////////////////////// REMOVE LANG CODE FROM PATH ///////////////////////*/

function removeLangCode($url) {
  // Extraer el path de la URL
  $partesUrl = parse_url($url);
  $path = $partesUrl['path'];

  // Definir el patrón para buscar el código de idioma en el path
  $patronIdioma = '/\/([a-z]{2})\//';

  // Eliminar el código de idioma del path si está presente
  $path_sin_idioma = preg_replace($patronIdioma, '/', $path);

  // Reconstruir la URL con el path modificado
  $url_sin_idioma = str_replace($path, $path_sin_idioma, $url);

  return $url_sin_idioma;

}

/*/////////////////////////// TRANSLATE PATH ////////////////////////////////*/
/**
 * Transforma una ruta dada agregando un prefijo de idioma si es diferente de 'es' (español).
 *
 * @param string $path La ruta original que se desea transformar.
 * @param string $lang El código de idioma que se utilizará como prefijo en la ruta transformada.
 * @return string La ruta transformada con el prefijo de idioma si es diferente de 'es', de lo contrario, devuelve la ruta original.
 */
function transPath( $slug, $lang ){ 
  
  // Si el código de idioma no es 'es', agrega el prefijo de idioma a la ruta
  if ($lang != 'es') {

    $transPath = $lang . '/' . $slug;

    // Si el código de idioma es 'es', devuelve la ruta original sin modificaciones

  } else { // ESPAÑOL

    $transPath = $slug;

  }

  return $transPath;

}

/*/////////////////////////// SWITCH PATH ////////////////////////////////*/
// Esta función fue explicitamente hecho para el switcher de idiomas

function switchPath($lang) {

  $slug_path = $GLOBALS["site_slug"] . "/";
  $request_path = str_replace($slug_path, '', $_SERVER['REQUEST_URI']);

  // Eliminar cualquier código de idioma existente en la ruta
  $path_no_lang_code = removeLangCode($request_path);

  // Si el idioma es español, devolvemos la ruta original sin prefijo de idioma
  if ($lang == 'es') {

      if ($_SERVER['REQUEST_URI'] != "/") { // en caso de subdirectorio
          $switchPath = $GLOBALS["base_url"] . ltrim($path_no_lang_code, $path_no_lang_code[0]);
      } else { // en caso de ROOT
          $switchPath = str_replace($slug_path, '', $path_no_lang_code);
      }

  } else {

      // Si el idioma no es español, agregamos el prefijo de idioma a la ruta
      if ($_SERVER['REQUEST_URI'] != "/") { // en caso de subdirectorio
          $switchPath = $GLOBALS["base_url"] . $lang . $path_no_lang_code;
      } else { // en caso de ROOT
          $switchPath = $GLOBALS["base_url"] . $lang .  $path_no_lang_code;
      }

  }

  return $switchPath;
  
}