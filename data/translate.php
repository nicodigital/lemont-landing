<?php

if (isset($_GET['t']) && $_GET['t'] != '') {
    if ($_GET['t'] == 'en') {
        $langString = "inglés";
    } elseif ($_GET['t'] == 'pt') {
        $langString = "portugués";
    } else {
        die("Idioma no soportado");
    }

    /* importamos el $i18n original */
    include '../lang/es.php';

    if (!isset($i18n) || empty($i18n)) {
        die("Error: El archivo es.php no contiene la variable \$i18n o está vacía.");
    }

    // Función para traducir el array
    function translateArray($array, $targetLanguage) {
        $apiUrl = 'https://api.groq.com/openai/v1/chat/completions';
        $apiKey = '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';

        $messages = [
            [
                'role' => 'system',
                'content' => 'Eres un experto en HTML y PHP y además traductor inglés, español y portugués'
            ],
            [
                'role' => 'user',
                'content' => "Traduce al $targetLanguage este array PHP. Mantén la estructura exacta del array y devuelve SOLO el array PHP traducido, utilizando corchetes para los arrays internos, sin explicaciones adicionales:\n" . var_export($array, true)
            ]
        ];

        $data = [
            'messages' => $messages,
            'model' => 'llama3-70b-8192'
        ];

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apiKey
        ]);

        $response = curl_exec($ch);
        
        if ($response === false) {
            die('Error en la solicitud cURL: ' . curl_error($ch));
        }
        
        curl_close($ch);

        $result = json_decode($response, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            die('Error al decodificar la respuesta JSON: ' . json_last_error_msg());
        }

        if (!isset($result['choices'][0]['message']['content'])) {
            die('La respuesta de la API no contiene el contenido esperado');
        }

        $translatedContent = $result['choices'][0]['message']['content'];
        
        // Imprimir el contenido traducido para depuración
        // echo "Contenido traducido recibido:\n<pre>" . htmlspecialchars($translatedContent) . "</pre>\n";

        // Convertir el contenido en un array PHP válido
        $translatedArray = null;
        if (preg_match('/array\s*\((.*)\)/s', $translatedContent, $matches)) {
            $arrayContent = $matches[1];
            $arrayContent = preg_replace('/(\w+)\s*=>\s*/m', '"$1" => ', $arrayContent);
            $evalContent = "return array($arrayContent);";
            $translatedArray = eval($evalContent);
        }

        if ($translatedArray === null) {
            die('No se pudo convertir el contenido en un array PHP válido');
        }
        
        return $translatedArray;
    }

    // Función para generar el archivo PHP con la traducción
    function generateTranslationFile($translatedArray, $language) {
        $directory = '../lang/';
        if (!is_dir($directory)) {
            if (!mkdir($directory, 0755, true)) {
                die("Error al crear el directorio $directory");
            }
        }
        
        $filename = $directory . $language . '.php';
        $content = "<?php\n\n\$i18n = " . var_export($translatedArray, true) . ";\n";
        
        if (file_put_contents($filename, $content) === false) {
            die("Error al escribir en el archivo $filename");
        }
        
        echo "Archivo $filename generado con éxito.\n";
    }

    // Uso del script
    $translatedArray = translateArray($i18n, $langString);
    
    if (empty($translatedArray)) {
        die("El array traducido está vacío");
    }
    
    generateTranslationFile($translatedArray, $_GET['t']); 

    // Imprimir el array traducido para confirmación
    echo "Array traducido final:\n";
    echo "<pre>";
    print_r($translatedArray);
    echo "</pre>";
}