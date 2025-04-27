<?php

namespace App\Controllers;

class ErrorController {
  /**
   * Basic error
   *
   * @param int $status
   * @param string $message
   * @return void
   */
  private static function error($status, $message = 'Something Went Wrong') {
    loadView('error', ['status' => $status, 'message' => $message]);
  }

  /**
   * 404 Not Found error
   *
   * @param string $message
   * @return void
   */
  public static function notFound($message = 'Resource Not Found') {
    self::error(404, $message);
  }

  /**
   * 403 Unauthorized Access error
   *
   * @param string $message
   * @return void
   */
  public static function unauthorizedAccess($message = 'You Ae Not Authorized To View This Resource') {
    self::error(403, $message);
  }
}
