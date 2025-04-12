<?php

require basePath('config/db.php');

$listings = $db->query('SELECT id, title, description, salary, tags, city, state FROM listings LIMIT 6')->fetchAll();

loadView('home', ['listings' => $listings]);
