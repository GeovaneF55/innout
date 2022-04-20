<?php
  session_start();
  requireValidSession(true);
  $exception = null;
  $userData = [];

  if(count($_POST) === 0 && isset($_GET['update'])) {
    $user = User::getOne(['id' => $_GET['update']]);
    $userData = $user->getValues();
    $userData['password'] = null;
  } elseif(count($_POST) > 0) {
    try {
      $saveUser = new User($_POST);
      if($saveUser->id) {
        $saveUser->update();
        addSuccessMessage("Usuário alterado com sucesso!");
      } else {
        $saveUser->insert();
        addSuccessMessage("Usuário cadastrado com sucesso!");
      }
      header('Location: users.php');
      exit();
      $_POST = [];
    } catch(Exception $e) {
      $exception = $e;
    } finally {
      $userData = $_POST;
    }
  }

  $data = $userData + [
    'exception' => $exception
  ];

  loadTemplateView('save_user', $data);