<!DOCTYPE html>
<html lang="<?= $lang ?>" data-platform="<?= $platform ?>">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name='viewport' content='initial-scale=1, viewport-fit=cover'>
  <?php include 'inc/seoMetas.php'; ?>
  <base href="<?= $base_url ?>" target="_self">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@500&display=swap" rel="stylesheet">
  <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
  <meta name="view-transition" content="same-origin" />
  <?php 
  include 'inc/preload.php'; 
  include 'inc/fontFace.php'; 
  include 'inc/css.php'; 
  include 'inc/js.php';
  include 'inc/openGraph.php';
  include 'inc/richsnippets.php';
  include 'inc/trackCodes.php';
  include 'inc/favicon.php';
  include 'inc/otherMetas.php';
  ?>
</head>

<body id="top" class="<?= $page ?> toggler once" data-scroll="top" data-page="<?= $page ?>" data-barba="wrapper">
<header></header>
