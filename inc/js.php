 <!--js-->
<?php

$js =  ASSETS . 'js/scripts.js';
$js_url = $js.$cache;

/* JS MODE */
$js_mode = 'normal';
// $js_mode = 'inline';

if( $js_mode == 'inline' ){

  if ( file_exists( $js )) {

      $jsContent = file_get_contents( $js );

      // Luego, crea una etiqueta <style> con el contenido CSS en línea
      $jsInline = "<script  type='module' >\n{$jsContent}\n</script>";

  } else {

      $jsInline = ''; // En caso de que el archivo no exista

  }

}

/*/////////////////////// PRINT //////////////////////////*/

if( $js_mode == 'inline' ){

      echo $jsInline;

     }else{ ?>

       <script src="<?=$js_url?>" defer ></script>

<?php }