<?php
  session_start();
  requireValidSession();

  $activeUsersCount = User::getActiveUsersCount();
  $absentUsers = WorkingHours::getAbsentUsers();
  $yearAndMonth = (new DateTime())->format('Y-m');
  $seconds = WorkingHours::getWorkedTimeInMonth($yearAndMonth);
  $hoursInMonth = explode(":", getTimeStringFromSeconds($seconds))[0];

  $date = [
    'activeUsersCount' => $activeUsersCount,
    'absentUsers' => $absentUsers,
    'hoursInMonth' => $hoursInMonth
  ];

  loadTemplateView('manager_report', $date);