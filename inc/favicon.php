<!-- favicon -->
<?php
if( isset($_COOKIE['darkmodeOS']) && $_COOKIE['darkmodeOS'] == 'on' ){
	$favicon_version = 'dark';
}else{
	$favicon_version = 'normal';
}
?>
<link rel="apple-touch-icon" sizes="57x57" href="<?= ASSETS ?>img/favicon/<?=$favicon_version?>/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?= ASSETS ?>img/favicon/<?=$favicon_version?>/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?= ASSETS ?>img/favicon/<?=$favicon_version?>/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?= ASSETS ?>img/favicon/<?=$favicon_version?>/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?= ASSETS ?>img/favicon/<?=$favicon_version?>/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?= ASSETS ?>img/favicon/<?=$favicon_version?>/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?= ASSETS ?>img/favicon/<?=$favicon_version?>/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?= ASSETS ?>img/favicon/<?=$favicon_version?>/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?= ASSETS ?>img/favicon/<?=$favicon_version?>/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?= ASSETS ?>img/favicon/<?=$favicon_version?>/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?= ASSETS ?>img/favicon/<?=$favicon_version?>/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?= ASSETS ?>img/favicon/<?=$favicon_version?>/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?= ASSETS ?>img/favicon/<?=$favicon_version?>/favicon-16x16.png">
<link rel="icon" href="<?= ASSETS ?>img/favicon/<?=$favicon_version?>/favicon.ico">
<link rel="manifest" href="manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?= ASSETS ?>img/favicon/<?=$favicon_version?>/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">