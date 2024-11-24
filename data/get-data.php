<?php

/*//////////////////////////// GET DATA /////////////////////////////*/
// Función para obtener datos desde una URL (API)
function get_data( $url, $cache = true) {

    $slug = basename(parse_url($url, PHP_URL_PATH));
    $data_dir = __DIR__ . '/json';
    $file_path = $data_dir . '/' . $slug . '.json';

    // Crear el directorio "data" si no existe
    if (!file_exists($data_dir)) {
        if (!mkdir($data_dir, 0777, true)) {
            die("Error al crear el directorio 'data'. Verifica los permisos.");
        }
    }

    // Si el archivo existe y la caché está activada, leer el archivo
    if ($cache && file_exists($file_path)) {
        return json_decode(file_get_contents($file_path), true);
    }

    // Realizar la petición
    $data = file_get_contents($url);

    if ($data === FALSE) {
        die("Error al obtener datos de la URL: $url");
    }

    // Decodificar la respuesta
    $decoded_data = json_decode($data, true);

    // Guardar la respuesta en un archivo Json si la caché está activada
    if ($cache) {
        if (file_put_contents($file_path, json_encode($decoded_data, JSON_PRETTY_PRINT)) === FALSE) {
            die("Error al escribir el archivo JSON en $file_path. Verifica los permisos.");
        }
    } else if (file_exists($file_path)) {
        // Eliminar el archivo si la caché está desactivada
        unlink($file_path);
    }

    return $decoded_data;
}

/*///////////////////////// GET POST TYPE ////////////////////////////*/
// Función para obtener datos desde un POST TYPE
function get_postype($slug, $api_url, $cache = true, $per_page = 100 ) {

    $data_dir = __DIR__ . '/json';
    $file_path = $data_dir . '/' . $slug . '.json';

    // Crear el directorio "data" si no existe
    if (!file_exists($data_dir)) {
        if (!mkdir($data_dir, 0777, true)) {
            die("Error al crear el directorio 'data'. Verifica los permisos.");
        }
    }

    // Si el archivo existe y la caché está activada, leer el archivo
    if ($cache && file_exists($file_path)) {
        echo "<!-- Read Data from Cache -->";
        return json_decode(file_get_contents($file_path), true);
    }

    // Realizar la petición
    echo "<!-- Read Data from API -->";
    $endpoint = $api_url . "/" . $slug . '?per_page=' . $per_page . '&page=1&_embed';
    $response = file_get_contents($endpoint);

    if ($response === FALSE) {
        die("Error al obtener datos de la URL: $endpoint");
    }

    // Decodificar la respuesta
    $data = json_decode($response, true);

    // Guardar la respuesta en un archivo Json si la caché está activada
    if ($cache) {
        if (file_put_contents($file_path, json_encode($data, JSON_PRETTY_PRINT)) === FALSE) {
            die("Error al escribir el archivo JSON en $file_path. Verifica los permisos.");
        }
    } else if (file_exists($file_path)) {
        // Eliminar el archivo si la caché está desactivada
        unlink($file_path);
    }

    return $data;
}

/*//////////////////////////// GET POST /////////////////////////////*/
// Función para obtener un post específico desde la API
function get_post($slug, $api_url, $postype = "pages", $cache = true) {
    
    $data_dir = __DIR__ . '/json';
    $file_path = $data_dir . '/' . $slug . '.json';
    $post_url = $api_url . '/' . $postype . '?slug=' . $slug.'&_embed';

    if( $postype == "" ){
        $postype = "pages";
    }

    // Crear el directorio "data" si no existe
    if (!file_exists($data_dir)) {
        if (!mkdir($data_dir, 0777, true)) {
            die("Error al crear el directorio 'data'. Verifica los permisos.");
        }
    }

    // Si el archivo existe y la caché está activada, leer el archivo
    if ($cache && file_exists($file_path)) {
        return json_decode(file_get_contents($file_path), true);
    }

    // Realizar la petición
    $data = file_get_contents($post_url);

    if ($data === FALSE) {
        die("Error al obtener datos de la URL: $post_url");
    }

    // Decodificar la respuesta
    $decoded_data = json_decode($data, true);

    // Guardar la respuesta en un archivo Json si la caché está activada
    if ($cache) {
        if (file_put_contents($file_path, json_encode($decoded_data, JSON_PRETTY_PRINT)) === FALSE) {
            die("Error al escribir el archivo JSON en $file_path. Verifica los permisos.");
        }
    } else if (file_exists($file_path)) {
        // Eliminar el archivo si la caché está desactivada
        unlink($file_path);
    }

    return $decoded_data;
}


