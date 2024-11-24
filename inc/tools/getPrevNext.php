<?php 
function getPrevNext( $cases, $current_slug ) {

  $previous_slug = false;
  $next_slug = false;

  // Recorremos el array para encontrar el slug actual y determinar los slugs anterior y siguiente.
  foreach ($cases as $index => $case) {
      if ($case['slug'] === $current_slug) {
          // Verificar si existe un post anterior.
          if (isset($cases[$index - 1])) {
              $previous_slug = $cases[$index - 1]['slug'];
          }

          // Verificar si existe un post siguiente.
          if (isset($cases[$index + 1])) {
              $next_slug = $cases[$index + 1]['slug'];
          }

          // Una vez encontrado el slug actual, podemos salir del loop.
          break;
      }
  }

  // Retornar un array con los slugs anteriores y siguientes, o false si no existen.
  return [
      'prev' => $previous_slug,
      'next' => $next_slug
  ];
  
}

// Ejemplo de uso:
// $cases = [
//   ['slug' => 'case-1'],
//   ['slug' => 'case-2'],
//   ['slug' => 'case-3'],
//   // Otros elementos...
// ];

// $current_slug = 'case-2';
// $result = get_prev_next($cases, $current_slug);

// print_r($result);
// Devolverá algo como:
// Array
// (
//     [previous] => case-1
//     [next] => case-3
// )