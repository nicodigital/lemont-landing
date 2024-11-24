<section class="filter">

    <?php include 'layout/partials/filter.php' ?>

    <div class="filter-items grid md:grid-cols-3 xg:grid-cols-4 gap-1 md:gap-2">

    <?php // LOOP

        foreach ($GLOBALS["cases"] as $item) {

            // debug($item);
            $acf = $item["acf"];
            $types_txt = "";
            $type_count = count($acf["types"]);
            $z = 0;

            $desc     = $acf['descripcion_' . $lang];

            // Obtener types
            foreach($acf["types"] as $type) {

                if( $z < $type_count-1 ){
                  $types_txt.= $type["slug"].",";
                }else{
                  $types_txt.= $type["slug"];
                }
                
              $z++; }

        ?>

            <a href="<?= transPath( 'case/'.$item["slug"] , $lang ) ?>" class="card filter-item anim" data-filter="<?= $types_txt ?>" data-anim="bottom" data-once="true">

            <?php
                $img = new Picture($acf["main_img"]["url"]);
                $img->set('alt', $item["title"]["rendered"]);
                $img->set('width', $acf["main_img"]["width"]);
                $img->set('height', $acf["main_img"]["height"]);
                $img->set('forceWebP', true);
                echo $img->generate();
            ?>
                
                <h3 class="h3">
                    <?= $item["title"]["rendered"]  ?>
                </h3>
                <p>
                    <?= cropTxt($desc, 20) ?>...
                </p>

            </a>

        <?php } ?>

    </div>
</section>