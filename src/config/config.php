<?php
  date_default_timezone_set('Europe/Lisbon');
  setLocale(LC_ALL, 'pt_BR', 'pt_BR.utf8', 'portuguese');

  // PASTAS
  define('MODEL_PATH', realpath(dirname(__FILE__) . '/../models'));
  define('VIEW_PATH', realpath(dirname(__FILE__) . '/../views'));

  // ARQUIVOS
  require_once(realpath(dirname(__FILE__) . '/database.php'));
  require_once(realpath(MODEL_PATH . '/Model.php'));