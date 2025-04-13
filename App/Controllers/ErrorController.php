<?php

namespace App\Controllers;

class ErrorController {

  /**
   * 404 Not Found error
   *
   * @return void
   */
  public static function notFound($message = 'Resource Not Found') {
    loadView('error', ['status' => 404, 'message' => $message]);
  }

  /**
   * 403 Unauthorized Access error
   *
   * @return void
   */
  public static function unauthorizedAccess($message = 'You Ae Not Authorized To View This Resource') {
    loadView('error', ['status' => 403, 'message' => $message]);
  }
}
