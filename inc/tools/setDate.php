<?php 
function setDate($fechaOriginal) {
  $fecha = new DateTime($fechaOriginal);
  return $fecha->format('d m Y');
}