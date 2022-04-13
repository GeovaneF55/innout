<?php
  $errors = [];

  if($exception) {
    $message = [
      'type' => 'error',
      'message' => $exception->getMessage()
    ];

    if($exception instanceof ValidationException) {
      $errors = $exception->getErrors();
    }
  }

  $alertType = '';

  if ($message['type'] === 'error') {
    $alertType = 'danger';
  } elseif ($message['type'] === 'warning') {
    $alertType = 'warning';
  } elseif ($message['type'] === 'success') {
    $alertType = 'success';
  } else {
    $alertType = 'info';
  }
?>

<?php if($message): ?>
  <div class="alert alert-<?= $alertType ?>">
    <?= $message['message'] ?>
  </div>
<?php endif; ?>