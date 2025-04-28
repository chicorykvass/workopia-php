<?php

namespace App\Controllers;

class HomeController extends Controller {
  /**
   * Load main page
   *
   * @return void
   */
  public function index() {
    $listings = $this->db->query('SELECT id, title, description, salary, tags, city, state FROM listings ORDER BY id DESC LIMIT 6')->fetchAll();

    loadView('home', ['listings' => $listings]);
  }
}
