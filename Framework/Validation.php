<?php

namespace Framework;

class Validation {
  /**
   * Validate a string
   * 
   * @param string $value
   * @param int $min
   * @param int $max
   * @return bool
   */
  public static function string($value, $min = 1, $max = INF) {
    if (is_string($value)) {
      $value = trim($value);
      $length = strlen($value);
      return $length >= $min && $length <= $max;
    }
    return false;
  }

  /**
   * Validate an email address
   * 
   * @param string $value
   * @return bool
   */
  public static function email($value) {
    if (is_string($value)) {
      $value = trim($value);
      return boolval(filter_var($value, FILTER_VALIDATE_EMAIL));
    }
    return false;
  }

  /**
   * Validate that 2 strings match
   * 
   * @param string $value1
   * @param string $value2
   * @return bool
   */
  public static function match($value1, $value2) {
    if (self::string($value1) && self::string($value2)) {
      $value1 = trim($value1);
      $value2 = trim($value2);
      return $value1 === $value2;
    }
    return false;
  }

  /**
   * Validate the listing fields
   *
   * @return array
   */
  public static function listingFields() {
    $allowedFields = ['title', 'description', 'salary', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits', 'tags'];

    $requiredFields = ['title', 'description', 'salary', 'city', 'state', 'email'];

    $errors = [];

    $listingData = array_intersect_key($_POST, array_flip($allowedFields));

    $listingData = array_map('sanitize', $listingData);

    foreach ($requiredFields as $field) {
      if (empty($listingData[$field]) or !self::string($listingData[$field])) {
        $errors[$field] = ucfirst($field) . ' is required';
      }
    }

    return ['listingData' => $listingData, 'errors' => $errors];
  }

  /**
   * Validate the user fields
   *
   * @return array
   */
  public static function userFields() {
    $allowedFields = ['name', 'email', 'city', 'state', 'password', 'password_confirmation'];

    $errors = [];

    $userData = array_intersect_key($_POST, array_flip($allowedFields));

    $userData = array_map('sanitize', $userData);

    foreach ($userData as $field => $value) {
      switch ($field) {
        case 'name':
          if (empty($value) || !self::string($value, 2, 50)) {
            $errors[$field] = ucfirst($field) . ' must be between 2 and 50 characters';
          }
          break;

        case 'email':
          if (!self::email($value)) {
            $errors[$field] = 'Please enter valid email';
          }
          break;

        case 'city':
          if (!empty($value) && !self::string($value, 2, 50)) {
            $errors[$field] = ucfirst($field) . ' must be between 2 and 50 characters';
          }
          break;

        case 'state':
          if (!empty($value) && !self::string($value, 2, 2)) {
            $errors[$field] = 'State name must be 2 characters long';
          }
          break;

        case 'password':
          if (empty($value) || !self::string($value, 6, 50)) {
            $errors[$field] = ucfirst($field) . ' must be between 6 and 50 characters';
          }
          break;

        case 'password_confirmation':
          if (!($errors['password'] ?? null) && !self::match($userData['password'], $value)) {
            $errors['password'] = 'The password confirmation does not match';
          }
      }
    }

    if (self::string($userData['state'])) {
      $userData['state'] = strtoupper($userData['state']);
    }

    if (isset($userData['password_confirmation'])) {
      unset($userData['password_confirmation']);
    }

    return ['userData' => $userData, 'errors' => $errors];
  }
}
