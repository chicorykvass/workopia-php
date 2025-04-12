<?php

require basePath('config/db.php');

$listings = $db->query('SELECT id, title, description, salary, tags, city, state FROM listings')->fetchAll();

loadView('listings/index', ['listings' => $listings]);
