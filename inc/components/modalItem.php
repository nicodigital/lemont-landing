<?php
/*////////////////////////// MODAL ITEM /////////////////////////////*/
/**
 * Summary of modalItem
 * @param mixed $modal
 * @param mixed $type
 * @param mixed $show
 * @param mixed $content
 * @return void
 */

function modalItem( $modal, $type = '', $show = 'off', $content = '' ) {

  // Elimina el contenido en blanco al inicio y final del contenido
  $content = trim($content); 

    echo "<dialog class='modal' data-modal='$modal' data-type='$type' data-show='$show'>
      <div class='close close-modal'></div>
      <div class='modal-box'>$content</div>
    </dialog>";

 }