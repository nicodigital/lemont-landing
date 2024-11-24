<?php
// debug($post);
/* Evaluacion para HTMX load post */
if (isset($_GET["page"])) {
  include '../inc/components/picture.php';
}

$title = $post["title"]["rendered"];
$slug = $post["slug"];
$img = $post["_embedded"]['wp:featuredmedia'][0]["source_url"];

?>

<a href="post/<?= $slug ?>" class="card-post anim" data-anim="bottom">
  <h2 class="text-h3 p-2 xg:w-75%">
    <?= $title ?>
  </h2>
  <?php
  $img = new Picture($img);
  $img->set('alt', $title);
  $img->set('fetchpriority', 'high');
  // $img->set('forceWebP', true);
  echo $img->generate();
  ?>
</a>