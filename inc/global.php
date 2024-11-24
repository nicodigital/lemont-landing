<?php

// reCaptcha Key
if(!isset( $recaptcha_key ) ){
  $recaptcha_key = "123";
}

/* Define mode site */
// Obtén el modo actual
$mode = getCurrentMode();
// Define la constante MODE basada en el parámetro GET
define('MODE', $mode);

// Constantes globales
// Verificar y definir constantes base
if (!defined('BASE_URL')) {
  define('BASE_URL', $base_url);
}

// Constantes de rutas del sistema
if (!defined('INC')) {
  define('INC', __DIR__);
}

if (!defined('TOOLS')) {
  define('TOOLS', INC . DIRECTORY_SEPARATOR . 'tools');
}

if (!defined('COMPONENTS')) {
  define('COMPONENTS', INC . DIRECTORY_SEPARATOR . 'components');
}

if (!defined('ASSETS')) {

  if ( MODE == 'html' ) {
    define('ASSETS', "");
  }else{
    define('ASSETS', "public/");
  }

}


// Constantes de directorios relativos
if (!defined('LAYOUT')) {
  define('LAYOUT', 'layout/');
}

if (!defined('CODEX')) {
  define('CODEX', 'codex/');
}

$loader = new SVGLoader();


/* Info */

$address 	= 'Rua Josefina Dal Negro, nº 150, Iná - CEP: 83065-230 - São José dos Pinhais/PR';
$phone 		= '41 3382-3038 / Fax: 41 3382-3406';

$facebook 	= "";
$instagram 	= "";
$linkedin 	= "";