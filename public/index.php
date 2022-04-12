<?php
  require_once(dirname(__FILE__, 2) . "/src/config/config.php");
  // require_once(VIEW_PATH . "/Login.php");

  require_once(MODEL_PATH . "/Login.php");

  $login = new Login([
    'email' => 'admin@cod3r.com.br',
    'password' => 'ab'
  ]);

  try {
    $login->checkLogin();
    echo "Login OK";
  } catch (Exception $e) {
    echo "Login inválido";
  }