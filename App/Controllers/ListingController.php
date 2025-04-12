<?php

namespace App\Controllers;

class ListingController extends Controller {
  public function index() {
    $listings = $this->db->query('SELECT id, title, description, salary, tags, city, state FROM listings')->fetchAll();

    loadView('listings/index', ['listings' => $listings]);
  }

  public function create() {
    loadView('/listings/create');
  }

  public function show() {
    $id = $_GET['id'] ?? null;
    $listing = null;

    if (!$id || !($listing = $this->db->query('SELECT * FROM listings WHERE id=?', [$id])->fetch())) {
      http_error();
    }

    loadView('listings/show', ['listing' => $listing]);
  }
}
