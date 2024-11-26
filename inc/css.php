<!--css-->
<?php

/* CSS MODE */
// $css_mode = 'normal';
$css_mode = 'inline';

$css = ASSETS . 'style.css';
$style_url = $css.$cache;

if( $css_mode == 'inline' ){

  if ( file_exists( $css )) {

      $cssContent = file_get_contents( $css );

      // Luego, crea una etiqueta <style> con el contenido CSS en línea
      $cssInline = "<style>\n{$cssContent}\n</style>";

  } else {

      $cssInline = ''; // En caso de que el archivo no exista

  }

}

/*/////////////////////// PRINT //////////////////////////*/

 if( $css_mode == 'inline' ){

      echo $cssInline;

     }else{ ?>

      <link href="<?php echo $style_url?>" rel="stylesheet">

<?php }