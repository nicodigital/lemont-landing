<?php
header('Content-Type: application/json');

// Correo del administrador
$admin_email = 'nicolook.pro@gmail.com'; // Reemplaza con el correo del administrador

// Función para añadir un suscriptor al CSV
function addSubscriberToCsv($email) {
    $csvFile = dirname(__DIR__) . '/subscribers.csv';
    $newLine = [$email, date('d-m-Y H:i:s')];  // Email y fecha de suscripción
    
    // Comprobar si el archivo existe
    if (!file_exists($csvFile)) {
        // Si no existe, crear el archivo y añadir la cabecera
        $fp = fopen($csvFile, 'w');
        fputcsv($fp, ['Email', 'Fecha de suscripción']);
        fclose($fp);
    }
    
    // Abrir el archivo en modo append
    $fp = fopen($csvFile, 'a');
    
    // Añadir el nuevo suscriptor
    fputcsv($fp, $newLine);
    
    fclose($fp);

    return $csvFile; // Devolver la ruta del archivo CSV
}

// Función para enviar el archivo CSV por correo
function sendCsvByEmail($csvFile, $admin_email) {
    $subject = "LSI - Lista de suscriptores actualizada";
    $message = "Se adjunta el archivo CSV con los suscriptores actualizados.";
    
    // Crear una boundary
    $boundary = md5(uniqid(time()));

    // Cabeceras
    $headers = "From: no-reply@tudominio.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\r\n";

    // Cuerpo del mensaje
    $body = "--" . $boundary . "\r\n";
    $body .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $body .= $message . "\r\n";
    $body .= "--" . $boundary . "\r\n";

    // Leer el archivo CSV
    $csvContent = file_get_contents($csvFile);
    $csvBase64 = chunk_split(base64_encode($csvContent));

    // Adjuntar el archivo CSV
    $body .= "Content-Type: text/csv; name=\"subscribers.csv\"\r\n";
    $body .= "Content-Disposition: attachment; filename=\"subscribers.csv\"\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $body .= $csvBase64 . "\r\n";
    $body .= "--" . $boundary . "--";

    // Enviar el correo
    return mail($admin_email, $subject, $body, $headers);
}

// Función principal para procesar la solicitud
function processSubscription() {
    global $admin_email;

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return json_encode(['message' => 'Método no permitido']);
    }

    $email = $_POST['email'] ?? '';
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return json_encode(['message' => 'Email inválido']);
    }

    $csvFile = dirname(__DIR__) . '/subscribers.csv';

    // Verificar si el email ya existe en el CSV
    $existingEmails = [];
    if (file_exists($csvFile)) {
        $fp = fopen($csvFile, 'r');
        while (($line = fgetcsv($fp)) !== FALSE) {
            $existingEmails[] = $line[0];
        }
        fclose($fp);
    }

    if (in_array($email, $existingEmails)) {
        return json_encode(['message' => 'Este email ya está suscrito']);
    }

    // Añadir al suscriptor al CSV
    $csvFile = addSubscriberToCsv($email);

    // Intentar enviar el CSV por correo al administrador
    if (sendCsvByEmail($csvFile, $admin_email)) {
        return json_encode(['message' => 'Suscrito correctamente']);
    } else {
        return json_encode(['message' => 'Suscripción exitosa']);
    }
}

// Procesar la solicitud y enviar la respuesta
$response = processSubscription();
echo $response;
