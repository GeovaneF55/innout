<?php
  session_start();
  requireValidSession();

  $date = (new Datetime())->getTimestamp();
  $today = strftime('%d de %B de %Y', $date);

  $data = [
    'today' => $today
  ];

  loadTemplateView('day_records', $data);