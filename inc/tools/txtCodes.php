<?php
/**
 * Reemplaza los caracteres especiales
 */
if (!function_exists('txtCodes')) {

  function txtCodes($string)
  {

    $txt_codes = array(
      "&#8211;" => "–",
      "&#8217;" => "'",
      "&#8216;" => "'",
      "&#8230;" => "…",
      "&#38;"   => "&",
    );

    return strtr($string, $txt_codes);
  }
}