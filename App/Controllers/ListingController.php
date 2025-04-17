<?php

namespace App\Controllers;

use Framework\Validation;

class ListingController extends Controller {

  /**
   * Load listings page
   *
   * @return void
   */
  public function index() {
    $listings = $this->db->query('SELECT id, title, description, salary, tags, city, state FROM listings')->fetchAll();

    loadView('listings/index', ['listings' => $listings]);
  }

  /**
   * Create a new listing
   *
   * @return void
   */
  public function create() {
    loadView('/listings/create');
  }

  /**
   * Store listing data
   *
   * @return void
   */
  public function store() {
    $allowedFields = ['title', 'description', 'salary', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits', 'tags'];

    $requiredFields = ['title', 'description', 'salary', 'city', 'state', 'email'];

    $errors = [];

    $newListingData = array_intersect_key($_POST, array_flip($allowedFields));

    $newListingData = array_map('sanitize', $newListingData);

    $newListingData['user_id'] = rand(1, 5);

    foreach ($requiredFields as $field) {
      if (empty($newListingData[$field]) or !Validation::string($newListingData[$field])) {
        $errors[$field] = ucfirst($field) . ' is required';
      }
    }

    // If there are errors, reload view with errors
    if (!empty($errors)) {
      loadView('/listings/create', ['errors' => $errors, 'data' => $newListingData]);
    } else {
      // Filter input data array to delete empty fields
      $newListingData = array_filter($newListingData);

      // Create array of field names to insert into DB
      $qFields = array_keys($newListingData);

      // Create the SQL statement
      $qVals = ':' . implode(', :', $qFields);
      $qFields = implode(', ', $qFields);
      $sql = "INSERT INTO listings ({$qFields}) VALUES ({$qVals})";

      // Execute the SQL statement
      $this->db->query($sql, $newListingData);
      redirect('/listings');
    }
  }

  /**
   * Show listing details
   *
   * @return void
   */
  public function show($params) {
    extract($params);

    if (!($listing = $this->db->query('SELECT * FROM listings WHERE id=?', [$id])->fetch())) {
      ErrorController::notFound('Listing Not Found');
      exit;
    }

    loadView('listings/show', ['listing' => $listing]);
  }
}
