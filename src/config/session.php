<?php
  function requireValidSession($requiresAdmin = false) {
    $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
    if(!isset($user)) {
      header('Location: login.php');
      exit();
    } elseif($requiresAdmin && !$user->is_admin) {
      addErrorMessage('Acesso negado!');
      header('Location: day_records.php');
      exit();
    }
  }