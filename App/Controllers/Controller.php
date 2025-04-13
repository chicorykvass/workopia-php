<?php

namespace App\Controllers;

use Framework\Database;

class Controller {
  protected $db, $params;

  public function __construct() {
    $config = require basePath('config/db.php');
    $this->db = new Database($config);
  }
}
