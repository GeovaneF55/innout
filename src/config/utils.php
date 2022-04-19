<?php
  function addSuccessMessage($message) {
    return [
      'type' => 'success',
      'message' => $message
    ];
  }

  function addErrorMessage($message) {
    return [
      'type' => 'error',
      'message' => $message
    ];
  }

  function addWarningMessage($message) {
    return [
      'type' => 'warning',
      'message' => $message
    ];
  }

  function addInfoMessage($message) {
    return [
      'type' => 'info',
      'message' => $message
    ];
  }