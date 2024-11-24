<?php 
$data = "";
$theme = "dark";

include 'data/get-data.php';

/* Define Content data Endpoints */
$api_domain = "https://www.alohaus.uy/gestor";
$api_url        = $api_domain . "/wp-json/wp/v2";
$options_url    = $api_domain . "/wp-json/acf/v3/options/options";

/* Define Posts data Endpoints */
$posts_base_url  = "https://nicowebsite.com//wp-json/wp/v2";
$posts_url  = $posts_base_url."/posts?per_page=6&page=1&_embed";

// Detectar si queremos borrar el cache
if( isset($_GET['cache']) && !empty($_GET['cache']) ){
    // La variable no puede llamar a cache, porque ya existe una.
    $cached = false;
}else{
    $cached = true;
}


$get_options = get_data( $options_url, $cached );
$options = $get_options["acf"];

$cases = get_postype( "cases", $api_url, $cached );

/* Get Page Content */
if( $page == 'home' || $page == 'en' ){
    $slug = 'home-'.$lang; // home_es || home_en
    $content = get_post( $slug, $api_url, "pages", $cached );
    $page_type = $content[0]["type"];
    $theme = "light";
    // debug($content);
}

if( $page == 'proyectos' ){
    $slug = 'proyectos-'.$lang; // home_es || home_en
    $content = get_post( $slug, $api_url, "page", $cached );
    $page_type = $content[0]["type"];
}

if( $page != 'home' && $page != 'proyectos' ){ // Case -> Cambiamos el type para saber que tipo de página es.
    $page_type = $cases[0]["type"];
}

if( $page == 'blog' ){
    $posts = get_data($posts_url);
}

// Ahora $data contiene los datos ya sea desde el caché o desde la API
if ( isset($content) ) {
    $data = $content[0]["acf"];
} 

