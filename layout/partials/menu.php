<div id="menu">

		<a href="<?= $base_url ?>" class="brand xg:hidden" >
			<?= $loader->loadSVG('public/img/logos/logo.svg', 'w-auto h-4' ); ?>
		</a>

	<nav>
		<a href="<?= transPath('', $lang) ?>" class="m-item <?= status($page, "home") ?> togg ">
			<?= $i18n["words"]["home"] ?>
		</a>

		<a href="<?= transPath('about', $lang) ?> " class="m-item <?= status($page, "nosotros") ?> togg ">
			<?= $i18n["words"]["about"] ?>
		</a>

		<a href="<?= transPath('proyectos', $lang) ?> " class="m-item <?= status($page, "proyectos") ?> togg ">
			<?= $i18n["words"]["projects"] ?>
		</a>

		<a href="blog " class="m-item <?= status($page, "blog") ?> togg ">
			Blog
		</a>

		<div class="m-item open-modal" data-modal="test">Modal</div>

		<a href="<?php anchor("#contact-form", "home") ?>" class="m-item <?php anchor_class($page, "home") ?> togg">
			<?= $i18n["words"]["contact"] ?>
		</a>
	</nav>

</div>