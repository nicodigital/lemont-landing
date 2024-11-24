<?php
/*//////////////////////////// ROUTING ////////////////////////////*/
/*
Debes configurar las siguientes variables para que todo funcione correctamente
$base_url -> Es la url absoluta del sitio
$root_folder -> Es la carpeta donde se encuentra el proyecto
*/

$protocol     = 'https';
$root_url     = $protocol . "://$_SERVER[HTTP_HOST]";
$domain       = $root_url;

if ($_SERVER['SERVER_NAME'] == "localhost") { // <-- LOCALHOST

  // $base_url     = $protocol . "://$_SERVER[HTTP_HOST]" . '/' . $site_slug . '/'; // <-- Tiene que tener slash al final
  $base_url     = $protocol . "://$_SERVER[HTTP_HOST]" . '/' . $site_slug . '/'; // <-- Tiene que tener slash al final

} else if ($_SERVER['SERVER_NAME'] == $site_slug . ".test") { //<-- .TEST

  $base_url     = $protocol . "://" . $site_slug . ".test/";
  
} else if ($_SERVER['SERVER_NAME'] == "nicolook.com" || $_SERVER['SERVER_NAME'] == "testing.idmedia.uy") { //<-- TESTING

  $base_url     = 'https://' . "$_SERVER[HTTP_HOST]" . '/' . $site_slug . '/'; // <-- Tiene que tener slash al final

} else {

  $base_url     = $domain . '/'; // <-- Tiene que tener slash al final

}

$port           = $_SERVER['SERVER_PORT'];
$url            = strtok("https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", '?');
$uri            = $_SERVER['REQUEST_URI'];
$current_folder = dirname($_SERVER['PHP_SELF']);
$current_page   = $root_url . $current_folder;
$current_url    = $_SERVER['REQUEST_URI'];
$url_array      = explode('/', $url);

$page           = end($url_array);
$slug           = get_slug($url);
$bfe_slug       = isset($url_array[count($url_array) - 2]) ? $url_array[count($url_array) - 2] : '';

/*///////////////////////// FORCE PAGE NAME ////////////////////////*/

if ($page == '' || $page == 'index.php' || $page == 'index') {
  $page = 'home';
}