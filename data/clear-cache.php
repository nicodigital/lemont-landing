<?php
/**
 * Elimina los archivos de cache de la aplicación.
 */

header("Access-Control-Allow-Origin: https://avpfarma.com.uy");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if (isset($_POST['cache']) && $_POST['cache'] === "false" ) {

  // Esto se registra en el archivo de logs del servidor
  // error_log("Cache clearing triggered."); 

  /**
   * Elimina todos los archivos dentro de un directorio específico.
   *
   * @param string $directory La ruta del directorio donde se eliminarán los archivos.
   * @return void
   */
  function delete_files_in_directory($directory)
  {
    // Asegurarse de que la ruta del directorio termine con una barra '/'
    $directory = rtrim($directory, '/') . '/';

    // Verificar si el directorio existe
    if (!is_dir($directory)) {
      return;
    }

    // Obtener todos los archivos en el directorio
    $files = glob($directory . '*');

    // Eliminar cada archivo encontrado
    foreach ($files as $file) {
      if (is_file($file)) {
        unlink($file); // Elimina el archivo
      }
    }
  }

  // Uso de la función para eliminar archivos en "data/json"
  delete_files_in_directory('json');

  echo "Cache eliminado.";

}else{ // Si da error

  error_log("Cache clearing not triggered. POST data: " . print_r($_POST, true));
  echo "No se ha podido eliminar el cache.";

}
