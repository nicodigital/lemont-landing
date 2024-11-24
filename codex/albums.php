<section>

    <div class="text-center mb-5">
        <h2 class="h1 font-bold">
            Albums
        </h2>
    </div>

    <div class="grid md:grid-cols-3 xg:grid-cols-4 gap-1 md:gap-2">

    <?php $albums = get_data( "https://jsonplaceholder.typicode.com/photos?_page=1&_limit=8" );

    foreach ( $albums as $item ) {

            // debug($item);
            $ID = $item["id"];
            $AlbumTitle = $item["title"];
            $AlbumUrl = $item["url"];
            $AlbumImg = $item["thumbnailUrl"];

            ?>

            <a href="<?= $AlbumUrl ?>" class="card anim" data-anim="bottom" >
                <img src="<?= $AlbumImg ?>" alt='' loading='lazy' decoding='async' />
                ID: <?= $ID ?>
                <h3 class="h3" >
                    <?= $AlbumTitle ?>
                </h3>
            </a>

        <?php } ?>

        <div hx-get="codex/getAlbums.php?page=2" hx-trigger="revealed" hx-swap="outerHTML"  ></div>

    </div>

</section>