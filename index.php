<?php include 'init.php';

if ($bfe_slug != 'data') {

	if ($bfe_slug == 'case') { // SINGLE

		$uri = get_uri($lang, 'case');
		// $uri[1] <-- Aqui esta el nombre del archivo del single correspondiente

		$content = new Template('pages/' . $uri[1] . '.php', [
			'base_url' => $base_url,
			'i18n' => $i18n,
			'case' => $uri[0],
			'data' => $data,
		]);
		
	} else if ( $bfe_slug == 'post' ){ // CASO POST

		$uri = get_uri($lang, 'post');

		$content = new Template('pages/' . $uri[1] . '.php', [
			'base_url' => $base_url,
			'i18n' => $i18n,
			'post' => $uri[0],
			'data' => $data,
		]);

	} else { // CASO NORMAL

		$uri = get_uri($lang);

		$content = new Template('pages/' . $uri[0] . '.php', [
			'base_url' => $base_url,
			'i18n' => $i18n,
			'data' => $data
		]);
	}

}

include 'layout/layout.php';
