<?php
  session_start();
  requireValidSession();

  loadModel('WorkingHours');

  $date = (new Datetime())->getTimestamp();
  $today = strftime('%d de %B de %Y', $date);

  $user = $_SESSION['user'];
  $records = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));

  $data = [
    'today' => $today,
    'records' => $records
  ];

  loadTemplateView('day_records', $data);