<?php 
/* META TITLE -> Lo ideal es de 65 caracteres */
$page_title = str_replace('-',' ', $page );

if( $page == 'home'){
  $meta_title = $site_name." — ".$claim;
}else{
  $meta_title = ucfirst($page_title)." — ".$site_name;
}

/* Canonical URL */
$canonical_url = str_replace('www.', '', $url);

?>

<title><?= $meta_title ?></title>
<meta name="description" content="<?= $meta_desc ?>">
<link rel="canonical" href="<?= $canonical_url ?>" />
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">
<meta name="keywords" content="<?= $metakeywords ?>">