<?php
/**
 * Obtener los datos de los posts
 * y generar el HTML
 * para mostrarlos en HTMX
 */

  // Configurar encabezados de respuesta
header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

// Habilitar la visualización de errores (solo para depuración, eliminar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['page'])) {

  $htmx_page = intval($_GET['page']);
  $next_page = $htmx_page + 1;

  // get params here
  // $lang = $_GET['lang'];

  /* include functions here */
  // include '../inc/tools/setDate.php';
  // include '../inc/components/plaxBox.php';

  // Consulta a la API de WordPress
  $response = file_get_contents("https://nicowebsite.com/wp-json/wp/v2/posts?per_page=6&page=" . $_GET['page'] . "&_embed");
  // print_r($http_response_header);

  // Obtén el encabezado de la respuesta para verificar cuántas páginas hay
  $headers = $http_response_header;
  foreach ($headers as $header) {
    if (strpos($header, 'X-WP-TotalPages') !== false) {
      preg_match('/X-WP-TotalPages:\s(\d+)/', $header, $matches);
      $totalPages = isset($matches[1]) ? intval($matches[1]) : 1;
    }
  }

  // Si el número de página es mayor que el total de páginas, no cargar más posts
  if ($htmx_page > $totalPages) {
    exit(); // No hacer nada si ya no hay más páginas
  }

  $morePosts = json_decode($response, true);

  // Recorre los posts y genera el HTML
  foreach ($morePosts as $post) {
   
    include '../layout/partials/card-post.php';

  }

  // (solo para infinite scroll) -> Solo mostrar el div con htmx-get si aún quedan páginas por cargar 
  if ($htmx_page < $totalPages) { ?>

    <div hx-get="data/getPosts.php?page=<?php echo $next_page ?>" hx-trigger="revealed" hx-swap="outerHTML" hx-indicator="#loader" ></div> 

  <?php }

} else {

  echo "No se pudo obtener la página.";

}

