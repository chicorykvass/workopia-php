<?php

require basePath('config/db.php');

$id = $_GET['id'] ?? null;
$listing = null;

if (!$id || !($listing = $db->query('SELECT * FROM listings WHERE id=?', [$id])->fetch())) {
  http_error();
}

loadView('listings/show', ['listing' => $listing]);
