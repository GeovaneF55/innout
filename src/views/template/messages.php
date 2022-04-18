<?php
  $errors = [];
  $alertType = 'info';

  if($exception) {
    $message = [
      'type' => 'error',
      'message' => $exception->getMessage()
    ];

    if($exception instanceof ValidationException) {
      $errors = $exception->getErrors();
    }
  }

  $hasMessage = isset($message);
  
  if($hasMessage) {
    if ($message['type'] === 'error') {
      $alertType = 'danger';
    } elseif ($message['type'] === 'warning') {
      $alertType = 'warning';
    } elseif ($message['type'] === 'success') {
      $alertType = 'success';
    }
  }
?>

<?php if($hasMessage): ?>
  <div class="alert alert-<?= $alertType ?>">
    <?= $message['message'] ?>
  </div>
<?php endif; ?>