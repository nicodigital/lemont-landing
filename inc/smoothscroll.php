<?php

/* MODE */
// $smoothscroll_mode = 'normal';
$smooth_mode = 'inline';

$smoothscroll = 'js/smoothscroll.min.js';

if( $smooth_mode == 'inline' ){

  if ( file_exists( $smoothscroll )) {

      $smoothContent = file_get_contents( $smoothscroll );

      // Luego, crea una etiqueta <style> con el contenido smoothscroll en línea
      $smoothInline = "<script>\n{$smoothContent}\n</script>";

  } else {

      $smoothInline = ''; // En caso de que el archivo no exista

  }

}

/*/////////////////////// PRINT //////////////////////////*/

 if( $smooth_mode == 'inline' ){

      if( !$detect->isMobile() ){
        echo $smoothInline;
      }

     }else{

      if( !$detect->isMobile() ){ ?>

        <script src="js/smoothscroll.min.js" defer ></script>

      <?php }

}