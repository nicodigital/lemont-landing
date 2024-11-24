<?php 
$uri = $_SERVER['REQUEST_URI'];
$uri_parts = explode('/', $uri);
$uri_parts = array_values($uri_parts);
$slug = $uri_parts[1];
debug($slug);