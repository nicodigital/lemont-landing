<div id="slider" class="container section">
    <div class="text-center mb-10">
		<h2 class="h1 font-bold">
			Slider
		</h2>
	</div>
    <div class='swiper relative rounded-[3rem] overflow-hidden'>
        <div class='swiper-wrapper'>
            <div class='swiper-slide'>
                <?php 
                $img = new Picture('https://api.idmedia.uy/space/bulk/2023/05/9-Martin-Barrenechea-y-Nicolas-Branca.webp');
                $img->set('alt', 'Slide 1');
                $img->set('class', 'aspect-[16/9]');
                echo $img->generate();
                ?>
            </div>
            <div class='swiper-slide'>
                <?php 
                $img = new Picture('https://api.idmedia.uy/space/bulk/2023/05/Rio-por-mis-venas.webp');
                $img->set('alt', 'Slide 2');
                $img->set('class', 'aspect-[16/9]');
                echo $img->generate();
                ?>
            </div>
        </div>
        <!-- Add Pagination -->
        <div class='swiper-pagination'></div>
        <!-- Add Arrows -->
        <div class='swiper-button-next'></div>
        <div class='swiper-button-prev'></div>
    </div>
</div>