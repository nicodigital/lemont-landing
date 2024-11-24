<?php
if (!checkFileType('clipChars')) {
  function checkFileType($filename)
  {
    // Listado de extensiones de imagen y video
    $imageExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $videoExtensions = ['mp4', 'mov', 'avi', 'mkv', 'webm', 'flv', 'wmv', 'm4v'];

    // Extraer la extensión del archivo
    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // Verificar si es una imagen
    if (in_array($extension, $imageExtensions)) {
      return 'image';
    }

    // Verificar si es un video
    if (in_array($extension, $videoExtensions)) {
      return 'video';
    }

    // No es ni imagen ni video
    return false;
  }
}

// Ejemplos de uso
// echo checkFileType('example.jpg'); // Retorna 'image'
// echo checkFileType('example.mp4'); // Retorna 'video'
// echo checkFileType('example.txt'); // Retorna false