<?php

namespace App\Controllers;

class HomeController extends Controller {
  /**
   * Load main page
   *
   * @return void
   */
  public function index() {
    $listings = $this->db->query('SELECT * FROM listings ORDER BY created_at DESC LIMIT 6')->fetchAll();

    loadView('home', ['listings' => $listings]);
  }
}
