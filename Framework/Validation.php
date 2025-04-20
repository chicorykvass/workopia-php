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

  public static function fields() {
    $allowedFields = ['title', 'description', 'salary', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits', 'tags'];

    $requiredFields = ['title', 'description', 'salary', 'city', 'state', 'email'];

    $errors = [];

    $listingData = array_intersect_key($_POST, array_flip($allowedFields));

    $listingData = array_map('sanitize', $listingData);

    $listingData['user_id'] = rand(1, 5);

    foreach ($requiredFields as $field) {
      if (empty($listingData[$field]) or !Validation::string($listingData[$field])) {
        $errors[$field] = ucfirst($field) . ' is required';
      }
    }

    return ['listingData' => $listingData, 'errors' => $errors];
  }
}
