<?php

namespace App\Controllers;

class HomeController extends Controller {
  public function index() {
    $listings = $this->db->query('SELECT id, title, description, salary, tags, city, state FROM listings LIMIT 6')->fetchAll();

    loadView('home', ['listings' => $listings]);
  }
}
