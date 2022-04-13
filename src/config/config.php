<?php
  date_default_timezone_set('Europe/Lisbon');
  setLocale(LC_ALL, 'pt_BR', 'pt_BR.utf8', 'portuguese');

  // PASTAS
  define('CONFIG_PATH', realpath(dirname(__FILE__)));
  define('MODEL_PATH', realpath(CONFIG_PATH . '/../models'));
  define('VIEW_PATH', realpath(CONFIG_PATH . '/../views'));
  define('TEMPLATE_PATH', realpath(CONFIG_PATH . '/../views/template'));
  define('CONTROLLER_PATH', realpath(CONFIG_PATH . '/../controllers'));
  define('EXCEPTION_PATH', realpath(CONFIG_PATH . '/../exceptions'));

  // ARQUIVOS
  require_once(realpath(CONFIG_PATH . '/database.php'));
  require_once(realpath(CONFIG_PATH . '/loader.php'));
  require_once(realpath(MODEL_PATH . '/Model.php'));
  require_once(realpath(EXCEPTION_PATH . '/AppException.php'));
  require_once(realpath(EXCEPTION_PATH . '/ValidationException.php'));