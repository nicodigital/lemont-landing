<?php

/*////////////////////////// ACCORDION ITEM /////////////////////////////*/
/**
 * Genera un elemento de acordeón.
 *
 * @param string  $title   El título del acordeón.
 * @param string  $txt     El contenido del acordeón.
 * @param bool    $expand  Determina si el acordeón se muestra expandido por defecto.
 * @param bool    $plus    Indica si se debe mostrar un icono de "plus".
 * @param string  $class   Clases adicionales para el contenedor del acordeón.
 */

if (!function_exists('accItem')) {
  function accItem( $title = '', $txt = '', $expand = false, $plus = true, $class = '')
  {
    $plusClass = "";
    $areaExpand = ( $expand == true ) ? "true" : false;
    $copyStatus = ( $expand == true  ) ? "accordion-copy--open" : "";

    $plusClass = $plusHtml = "";

    ( $plus != false ) ? $plusClass = "plus" : "";
    // ( $plus != false ) ? $plusHtml = "<div><span class='material-symbols-outlined'>arrow_downward</span> <span class='material-symbols-outlined'>arrow_upward</span> </div>" : "";
    
     ?>

    <div class="accordion-item <?= $plusClass." ".$class ?>" >
        <h2 class="accordion-heading">
          <button class="accordion-trigger" aria-expanded="<?=$areaExpand?>" >
            <?=$title?>
          </button>
        </h2>
        <div class="accordion-copy <?=$copyStatus?>">
          <?=$txt?>
        </div>
    </div>

<?php } }