<section class="hero">
  <h1>
    Puerto del Buceo <br>
    Montevideo
  </h1>
  <?php
  $img = new Picture('img/logos/logo.jpg');
  $img->set('alt', 'LE MONT - Planet Partners | Gomez Platero | Arthur Casas');
  $img->set('fetchpriority', 'high');
  echo $img->generate();
  ?>
  <h2>
    Sofisticación <br>
    natural
  </h2>
</section>