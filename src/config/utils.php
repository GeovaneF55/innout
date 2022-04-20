<?php
  function addSuccessMessage($message) {
    $_SESSION['message'] = [
      'type' => 'success',
      'message' => $message
    ];
  }

  function addErrorMessage($message) {
    $_SESSION['message'] = [
      'type' => 'error',
      'message' => $message
    ];
  }

  function addWarningMessage($message) {
    $_SESSION['message'] = [
      'type' => 'warning',
      'message' => $message
    ];
  }

  function addInfoMessage($message) {
    $_SESSION['message'] = [
      'type' => 'info',
      'message' => $message
    ];
  }