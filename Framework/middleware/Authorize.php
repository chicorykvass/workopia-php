<?php

namespace Framework\Middleware;

use Framework\Session;

class Authorize {
  /**
   * Check if user is authenticated
   * 
   * @return bool
   */
  public static function isAuthenticated() {
    return Session::has('user');
  }

  /**
   * Handle the user's requests
   * 
   * @param string $role
   * @return bool
   */
  public static function handle($role) {
    if ($role === 'guest' && self::isAuthenticated()) {
      return redirect('/');
    } elseif ($role === 'auth' && !self::isAuthenticated()) {
      return redirect('/auth/login');
    }
  }
}
