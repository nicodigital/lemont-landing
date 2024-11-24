<?php

if (!function_exists('anchor')) {
  function inAllArray($needle, $haystack)
  {

    foreach ($haystack as $item) {
      // Si el elemento actual es un array, realizar una búsqueda recursiva
      if (is_array($item)) {
        if (in_all_array($needle, $item)) {
          return true;
        }
      } else {
        // Si el elemento actual no es un array, verificar si es igual al valor buscado
        if ($item === $needle) {
          return true;
        }
      }
    }
    return false;
  }
}

// Ejemplo de uso:
// $cases = [
//     ['apple', 'banana', 'orange'],
//     ['car', 'bike', 'bus'],
//     ['php', 'javascript', 'python'],
// ];

// $case = 'bike';

// if (in_all_array($case, $cases)) {
//     echo "El valor '$case' existe en el array.";
// } else {
//     echo "El valor '$case' no se encuentra en el array.";
// }