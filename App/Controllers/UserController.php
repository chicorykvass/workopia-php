<?php

namespace App\Controllers;

use Framework\Validation;

class UserController extends Controller {

  /**
   * Show login page
   *
   * @return void
   */
  public function login() {
    loadView('users/login');
  }

  /**
   * Show register page
   *
   * @return void
   */
  public function create() {
    loadView('users/create');
  }

  /**
   * Store user in DB
   * 
   * @return void
   */
  public function store() {
    // Validate the input data
    extract(Validation::userFields());

    // If there are errors, reload view with errors
    if (!empty($errors)) {
      loadView('/users/create', ['errors' => $errors, 'data' => $userData]);
      exit;
    } else {
      // Filter input data array to delete empty fields
      $userData = array_filter($userData);

      // Encrypt password
      $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);

      // Check if user with this email is already registered
      $userExists = $this->db->query('SELECT id FROM users WHERE email=?', [$userData['email']])->fetch();
      if ($userExists) {
        $errors['user'] = 'User with this email address is already registered';
        loadView('/users/create', ['errors' => $errors, 'data' => $userData]);
        exit;
      }

      // Create array of field names to insert into DB
      $qFields = array_keys($userData);

      // Create the SQL statement
      $qVals = ':' . implode(', :', $qFields);
      $qFields = implode(', ', $qFields);
      $sql = "INSERT INTO users ({$qFields}) VALUES ({$qVals})";

      // Execute the SQL statement
      $this->db->query($sql, $userData);
      redirect('/');
    }
  }
}
