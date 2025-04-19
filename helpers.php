<?php

/**
 * Get the base path
 * 
 * @param string $path
 * @return string
 */
function basePath($path = '') {
  return __DIR__ . "/$path";
}

/**
 * Load a view
 * 
 * @param string $name
 * @return void
 */
function loadView($name, $data = []) {
  $viewPath = basePath("App/views/{$name}.view.php");
  if (file_exists($viewPath)) {
    extract($data);
    require $viewPath;
  } else {
    echo "View '$name' not found<br />";
  }
}

/**
 * Load a partial
 * 
 * @param string $name
 * @return void
 */
function loadPartial($name, $data = []) {
  $partialPath = basePath("App/views/partials/{$name}.php");
  if (file_exists($partialPath)) {
    extract($data);
    require $partialPath;
  } else {
    echo "Partial '$name' not found<br />";
  }
}

/**
 * Inspect value(s)
 * 
 * @param mixed $value
 * @return void
 */
function inspect($value) {
  echo '<pre>';
  var_dump($value);
  echo '</pre>';
}

/**
 * Inspect value(s) and die
 * 
 * @param mixed $value
 * @return void
 */
function inspectAndDie($value) {
  inspect($value);
  die;
}

/**
 * Sanitize data
 *
 * @param string $dirty
 * @return string
 */
function sanitize($dirty) {
  return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}

/**
 * Truncate text to desired length
 *
 * @param string $text
 * @param integer $chars
 * @return string
 */
function truncate($text, $chars = 100) {
  if (strlen($text) > $chars) {
    $text = $text . ' ';
    $text = substr($text, 0, $chars);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text . '...';
  }
  return $text;
}

/**
 * Redirect to URL
 *
 * @param string $url
 * @return void
 */
function redirect($url) {
  header("Location: {$url}");
}
