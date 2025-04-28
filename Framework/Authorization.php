<?php

namespace Framework;

use Framework\Session;

class Authorization {
  /**
   * Check if current logged in user owns the resource
   * 
   * @param int $resourceId
   * @return bool
   */
  public static function isOwner($resourceId) {
    return $resourceId == (Session::get('user')['id'] ?? null);
  }
}
