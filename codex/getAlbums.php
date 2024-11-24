<?php

if( isset( $_GET['page'] ) ) {

  $getAlbums   = file_get_contents("https://jsonplaceholder.typicode.com/photos?_page=" . $_GET['page'] . "&_limit=8");
  $moreAlbums   = json_decode($getAlbums, true);

 foreach ( $moreAlbums as $item ) {

    // debug($item);
    $ID = $item["id"];
    $AlbumTitle = $item["title"];
    $AlbumUrl = $item["url"];
    $AlbumImg = $item["thumbnailUrl"];

    ?>

    <a href="<?= $AlbumUrl ?>" class="card anim" data-anim="bottom"  >
        <img src="<?= $AlbumImg ?>" alt='' loading='lazy' decoding='async' />
        ID: <?= $ID ?> 
        <h3 class="h3" >
            <?= $AlbumTitle ?>
        </h3>
    </a>

<?php } ?>

  <div hx-get="codex/getAlbums.php?page=<?= $_GET['page']+1 ?>" hx-trigger="revealed" hx-swap="outerHTML" ></div>

<?php } 
