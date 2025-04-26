<?php

namespace App\Controllers;

use Framework\Validation;
use Framework\Session;

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
      // Check if user with this email is already registered
      $userExists = $this->db->query('SELECT id FROM users WHERE email=?', [$userData['email']])->fetch();
      if ($userExists) {
        $errors['user'] = 'User with this email address is already registered';
        loadView('/users/create', ['errors' => $errors, 'data' => $userData]);
        exit;
      }

      // Filter input data array to delete empty fields
      $userData = array_filter($userData);

      // Encrypt password
      $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);

      // Create array of field names to insert into DB
      $qFields = array_keys($userData);

      // Create the SQL statement
      $qVals = ':' . implode(', :', $qFields);
      $qFields = implode(', ', $qFields);
      $sql = "INSERT INTO users ({$qFields}) VALUES ({$qVals})";

      // Execute the SQL statement
      $this->db->query($sql, $userData);

      // Set session keys
      unset($userData['password']);
      $userData['id'] = $this->db->conn->lastInsertId();
      Session::set('user', $userData);

      redirect('/');
    }
  }

  /**
   * Log a user out and kill session
   * 
   * @return void
   */
  public function logout() {
    Session::clearAll();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);

    redirect('/');
  }

  /**
   * Log a user in
   * 
   * @return void
   */
  public function authenticate() {
    // Validate the input data
    extract(Validation::loginFields());

    // If there are errors, reload view with errors
    if (!empty($errors)) {
      loadView('/users/login', ['errors' => $errors, 'data' => $loginData]);
      exit;
    } else {
      // Check if this email is not registered
      $user = $this->db->query('SELECT * FROM users WHERE email=?', [$loginData['email']])->fetch(\PDO::FETCH_ASSOC);

      if (!$user) {
        $errors['user'] = 'This email address is not registered on the server';
        loadView('/users/login', ['errors' => $errors, 'data' => $loginData]);
        exit;
      } else if (!password_verify($loginData['password'], $user['password'])) {
        $errors['user'] = 'The password is incorrect';
        loadView('/users/login', ['errors' => $errors, 'data' => $loginData]);
        exit;
      } else {
        unset($user['password']);
        Session::set('user', $user);
      }
    }

    redirect('/');
  }
}
