<?php
  session_start();
  requireValidSession();
  $exception = null;

  if(count($_POST) > 0) {
    try {
      $newUser = new User($_POST);
      $newUser->insert();
      addSuccessMessage("Usuário cadastrado com sucesso!");
      header('Location: users.php');
      exit();
      $_POST = [];
    } catch(Exception $e) {
      $exception = $e;
    }
  }

  $data = $_POST + [
    'exception' => $exception
  ];

  loadTemplateView('save_user', $data);