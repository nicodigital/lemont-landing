<?php 

if (!function_exists('the_loop')) {

  function the_loop($path, $version = 'html')
  {

    $file = $item = "";
    $files  = array();
    $lastName = "";

    if ($handle = opendir($path)) {
      while (false !== ($photo = readdir($handle))) {
        if ($photo != "." && $photo != ".." && $photo != "desktop.ini" && $photo != "thumbs") {
          $files[] = $photo;
        }
      }

      // Función de comparación personalizada
      function compararNumeros($a, $b)
      {
        // Utiliza la función floatval() para asegurarte de que los valores se traten como números decimales
        $numero_a = floatval($a);
        $numero_b = floatval($b);

        if ($numero_a == $numero_b) {
          return 0;
        }

        return ($numero_a < $numero_b) ? -1 : 1;
      }

      // Ordena el array utilizando la función de comparación personalizada
      usort($files, 'compararNumeros');


      foreach ($files as $file) {

        $filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', $file);
        $ext      = pathinfo($path . '/' . $file, PATHINFO_EXTENSION);

        if ($lastName != $filename) {

          if ($version == 'preload') {

            $item .= '<link rel="preload" href="' . $path . '/' . $file . '" as="image" />';
          } else if ($version == 'swiper') {

            $item .= '<div class="swiper-slide">
                            <img src="' . $path . '/' . $filename . '.' . webp_hack('jpg') . '" alt="' . $filename . '" ' . img_size($path . '/' . $filename . '.jpg') . '  loading="lazy" decoding="async" />
                        </div>';
          } else { // gallery

            $item .= '<figure class="gallery-item link-modal" data-modal="gallery" >
                            <img src="' . $path . '/' . $file . '" alt="' . $filename . '" ' . img_size($path . '/' . $filename . '.jpg') . ' loading="lazy" decoding="async" />
                         </figure>';
          }
        } // check last name

        $lastName = $filename;
      }
      closedir($handle);
    }

    echo $item;
  }
}