<?php

require_once 'vendor/autoload.php';

use Detection\MobileDetect;

$detect = new MobileDetect;

// Verificar si el dispositivo es móvil (incluyendo tablets)
// if ($detect->isMobile()) {
//     echo "¡Estás usando un dispositivo móvil!";
// } elseif ($detect->isTablet()) {
//     echo "¡Estás usando una tablet!";
// } else {
//     echo "¡Estás usando un dispositivo de escritorio!";
// }

// Detectar sistemas operativos específicos
// if ($detect->isiOS()) {
//     echo "Estás usando un dispositivo iOS.";
// } elseif ($detect->isAndroidOS()) {
//     echo "Estás usando un dispositivo Android.";
// }

// Detectar navegadores específicos
// if ($detect->isChrome()) {
//     echo "Estás usando Chrome.";
// } elseif ($detect->isSafari()) {
//     echo "Estás usando Safari.";
// }