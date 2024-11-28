<section class="hero">
  <h1>
    Puerto del Buceo <br>
    Montevideo
  </h1>
  <?php
  $img = new Picture('img/back.png');
  $img->set('alt', 'LE MONT - Planet Partners | Gomez Platero | Arthur Casas');
  $img->set('class', 'rellax xg:w-[27%] mx-auto opacity-[.15]');
  $img->set('data-rellax-desktop-speed', '-2');
  $img->set('data-rellax-speed', '-1');
  $img->set('fetchpriority', 'high');
  echo $img->generate();
  ?>

  <div class="absolute top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%] w-90% xg:w-33% z-50">
    <?= $GLOBALS['loader']->loadSVG('img/logos/logo.svg', 'w-85% mx-auto h-auto', null, true) ?>
    <div class="partners flex justify-between text-small xg:text-body text-ivory translate-y-[6rem] xg:translate-y-[6rem] font-light">
      <h2>Planet Partners</h2>
      <h2>Gomez Platero</h2>
      <h2>Arthur Casas</h2>
    </div>
  </div>

  <h2>
    Sofisticación natural
  </h2>
</section>