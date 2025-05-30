<?php

namespace App\Controllers;

use Framework\Validation;
use Framework\Session;
use Framework\Authorization;

class ListingController extends Controller {
  /**
   * Check if id is in DB
   *
   * @param int $id
   * @return void
   */
  private function check($id) {
    if (!$id || !($listing = $this->db->query('SELECT * FROM listings WHERE id=?', [$id])->fetch())) {
      ErrorController::notFound('Listing Not Found');
      exit;
    }
    return $listing;
  }

  /**
   * Load listings page
   *
   * @return void
   */
  public function index() {
    $listings = $this->db->query('SELECT * FROM listings ORDER BY created_at DESC')->fetchAll();

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
    // Validate the input data
    extract(Validation::listingFields());

    $listingData['user_id'] = Session::get('user')['id'];

    // If there are errors, reload view with errors
    if (!empty($errors)) {
      loadView('/listings/create', ['errors' => $errors, 'data' => $listingData]);
      exit;
    } else {
      // Filter input data array to delete empty fields
      $listingData = array_filter($listingData);

      // Create array of field names to insert into DB
      $qFields = array_keys($listingData);

      // Create the SQL statement
      $qVals = ':' . implode(', :', $qFields);
      $qFields = implode(', ', $qFields);
      $sql = "INSERT INTO listings ({$qFields}) VALUES ({$qVals})";

      // Execute the SQL statement
      $this->db->query($sql, $listingData);

      Session::setFlashMessage('success_message', 'Listing created successively');

      redirect('/listings');
    }
  }

  /**
   * Search the listings
   * 
   * @param array $params
   * @return void
   */
  public function search() {
    $keywords = sanitize(trim($_GET['keywords'] ?? null));
    $location = sanitize(trim($_GET['location'] ?? null));

    $query = null;
    $params = $listings = [];
    $kwQuery = "title LIKE :keywords OR tags LIKE :keywords OR description LIKE :keywords OR company LIKE :keywords";
    $locQuery = "city LIKE :location OR state LIKE :location";

    if ($keywords && $location) {
      $query = "SELECT * FROM listings WHERE ({$kwQuery}) AND ({$locQuery})";
    } elseif ($keywords) {
      $query = "SELECT * FROM listings WHERE {$kwQuery}";
    } elseif ($location) {
      $query = "SELECT * FROM listings WHERE {$locQuery}";
    }

    if ($keywords) {
      $params['keywords'] = "%{$keywords}%";
    }
    if ($location) {
      $params['location'] = "%{$location}%";
    }

    if ($query) {
      $listings = $this->db->query($query, $params)->fetchAll();
    }

    loadView('listings/search-results', ['listings' => $listings]);
  }

  /**
   * Show listing details
   *
   * @param array $params
   * @return void
   */
  public function show($params) {
    // Check if id is in DB
    $listing = $this->check($params['id']);

    loadView('listings/show', ['listing' => $listing]);
  }

  /**
   * Delete a listing
   *
   * @param array $params
   * @return void
   */
  public function destroy($params) {
    $id = $params['id'];

    // Check if id is in DB
    $listing = $this->check($id);

    if (!Authorization::isOwner($listing->user_id)) {
      Session::setFlashMessage('error_message', 'You are not authorized to delete this listing');
      redirect("/listings/{$id}");
    }

    $this->db->query('DELETE FROM listings WHERE id=?', [$id]);

    // Set flash message
    Session::setFlashMessage('success_message', 'Listing deleted successfully');

    redirect('/listings');
  }

  /**
   * Show the listing edit form
   *
   * @param array $params
   * @return void
   */
  public function edit($params) {
    // Check if id is in DB
    $listing = $this->check($params['id']);

    if (!Authorization::isOwner($listing->user_id)) {
      Session::setFlashMessage('error_message', 'You are not authorized to edit this listing');
      redirect("/listings/{$params['id']}");
    }

    loadView('listings/edit', ['listing' => (array) $listing]);
  }

  /**
   * Update listing
   * 
   * @param array $params
   * @return void
   */
  public function update($params) {
    $id = $params['id'];

    // Check if id is in DB
    $oldListingData = (array) $this->check($id);

    if (!Authorization::isOwner($oldListingData['user_id'])) {
      Session::setFlashMessage('error_message', 'You are not authorized to edit this listing');
      redirect("/listings/{$params['id']}");
    }

    // Validate the input data
    extract(Validation::listingFields());

    // Add id to listing data array
    $listingData['id'] = $id;

    if (!empty($errors)) {
      loadView("/listings/edit", ['errors' => $errors, 'listing' => $listingData]);
    } else {
      // Filter input data array to delete empty fields
      $listingData = array_filter($listingData);

      // Create SET directives
      $qSet = $qVal = [];
      foreach ($listingData as $field => $value) {
        if ($oldListingData[$field] != $value) {
          $qSet[] = "{$field}=:{$field}";
          $qVal[$field] = $value;
        }
      }
      $qSet = implode(', ', $qSet);
      $qVal['id'] = $id;

      // Create the SQL statement
      $sql = "UPDATE listings SET {$qSet} WHERE id=:id";

      // Execute the SQL statement
      $this->db->query($sql, $qVal);

      Session::setFlashMessage('success_message', 'Listing updated successfully');

      redirect("/listings/{$id}");
    }
  }
}
