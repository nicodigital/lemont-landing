<?php 
function wapplink($detect, $phone)
{

  if ($detect) {
    $whapp_link = 'https://wa.me/' . $phone;
  } else {
    $whapp_link = 'https://web.whatsapp.com/send?phone=' . $phone;
  }

  echo $whapp_link;
  
}
