<footer class="container py-4">
	<row class="mb-4 xg:mb-10">
		<div class="col-1-7 xg:col-1-7 mb-10 xg:mb-0 flex xg:items-center">
			<?= $GLOBALS['loader']->loadSVG('img/logos/logo.svg', 'w-14 text-ivory', null, true ) ?>
		</div>
		<div class="xg:col-7-13 flex flex-col xg:flex-row xg:justify-between xg:items-center gap-3 xg:gap-2">

			<?= $GLOBALS['loader']->loadSVG('img/logos/planet.svg', 'w-33% xg:w-14', null, true ) ?>

			<?= $GLOBALS['loader']->loadSVG('img/logos/gomez-platero.svg', 'w-40% xg:w-17', null, true ) ?>

			<?= $GLOBALS['loader']->loadSVG('img/logos/sac.svg', 'w-60% xg:w-[25rem]', null, true ) ?>

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

<?php include 'layout/modals/politicas.php' ?>

</body>
</html>