<?php

/*//////////////////////////// GET DATA /////////////////////////////*/
// Función para obtener datos desde una URL (API)
function get_data($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return json_decode($data, true);
}

/*///////////////////////// GET POST TYPE ////////////////////////////*/
// Función para obtener datos desde un POST TYPE
function get_postype( $slug, $api_url ) {

    $endpoint = $api_url . "/" . $slug;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Devuelve el resultado como cadena
    curl_setopt($ch, CURLOPT_URL, $endpoint); // URL a la que se hace la petición
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        curl_close($ch);
        return null;
    }
    curl_close($ch);
    return json_decode($response, true);

}

/*//////////////////////////// GET POST /////////////////////////////*/
// Función para obtener un post específico desde la API

function get_post( $slug, $api_url ) {
    $post_url = $api_url . '/pages?slug=' . $slug;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $post_url );
    $data = curl_exec($ch);
    curl_close($ch);
    return json_decode($data, true);
}