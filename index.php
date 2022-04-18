<?php
  //ini_set('display_errors', 0);

  require_once(dirname(__FILE__) . "/src/config/config.php");
  
  $uri = urldecode($_SERVER['REQUEST_URI']);

  //die($uri);

  if($uri === '/' || $uri === "" || $uri === "/index.php") {
    $uri = '/login.php';
  }

  require_once(CONTROLLER_PATH . "{$uri}");