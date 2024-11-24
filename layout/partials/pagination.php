 <!-- Get Post for Pagination -->
<?php
$response = file_get_contents($GLOBALS["posts_url"]);

// Obtén el encabezado de la respuesta para verificar cuántas páginas hay
$headers = $http_response_header;

foreach ($headers as $header) {
  if (strpos($header, 'X-WP-TotalPages') !== false) {
    preg_match('/X-WP-TotalPages:\s(\d+)/', $header, $matches);
    $totalPages = isset($matches[1]) ? intval($matches[1]) : 1;
  }
}

?>

<!-- Links de paginación -->
<?php if ($totalPages > 1) { ?>
  <div class="flex justify-center py-4">
    <div class="flex gap-2">
      <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
        <div class="cursor-pointer underline" hx-get="data/getPosts.php?page=<?= $i ?>" hx-target="#content" hx-swap="innerHTML">
          <?= $i ?>
        </div>
      <?php } ?>
    </div>
  </div>
<?php } ?>