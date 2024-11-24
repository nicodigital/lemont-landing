<footer class="container py-4">
	<row class="mb-4 xg:mb-10">
		<div class="col-1-7 xg:col-1-7">
			<?php
				$img = new Picture('img/logos/logo-foot.jpg');
				$img->set('alt', 'LE MONT');
				$img->set('class', 'w-14');
				echo $img->generate();
			?>
		</div>
		<div class="xg:col-7-13 flex flex-col xg:flex-row xg:justify-between">
			<?php
				$img = new Picture('img/logos/Planet-partners.jpg');
				$img->set('alt', 'Planet Partners');
				$img->set('class', 'w-14');
				echo $img->generate();
			?>

		<?php
				$img = new Picture('img/logos/Arthur-Casas.jpg');
				$img->set('alt', 'Arthur Casas');
				$img->set('class', 'w-15 w-[25rem]');
				echo $img->generate();
			?>

		<?php
				$img = new Picture('img/logos/Gomez-Platero.jpg');
				$img->set('alt', 'Gomez Platero');
				$img->set('class', 'w-14');
				echo $img->generate();
			?>
		</div>
	</row>

	<row>
		<div class="xg:col-1-7">
			<p>
				Design by Gomez Platero + Studio Arthur Casas. Developed by Planet Partners.
			</p>
		</div>
	</row>

</footer>

</body>
</html>