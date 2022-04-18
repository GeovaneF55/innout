<?php
  //ini_set('display_errors', 0);

  require_once(dirname(__FILE__) . "/src/config/config.php");
  
  $uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
  );

  if($uri === '/' || $uri === "" || $uri === "/index.php") {
    $uri = '/day_records.php';
  }

  require_once(CONTROLLER_PATH . "{$uri}");