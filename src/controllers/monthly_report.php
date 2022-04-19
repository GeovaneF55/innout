<?php
  session_start();
  requireValidSession();

  $currentDate = new DateTime();

  $user = $_SESSION['user'];
  $registries = WorkingHours::getMonthlyReport($user->id, new Datetime());

  $report = [];
  $workday = 0;
  $sumOfWorkedTime = 0;
  $lastDay = getLastDayOfMonth($currentDate)->format('d');

  for($day = 1; $day <= $lastDay; $day++) {
    $date = $currentDate->format('Y-m-' . sprintf('%02d', $day));
    $registry = isset($registries[$date]) ? $registries[$date] : null;
    if(isPastWorkday($date)) {
      $workday++;
    }

    if(!is_null($registry)) {
      $sumOfWorkedTime += $registry->worked_time;
      array_push($report, $registry);
    } else {
      array_push($report, new WorkingHours([
        'work_date' => $date,
        'worked_time' => 0,
      ]));
    }
  }

  $expectedTime = $workday * DAILY_TIME;
  $balance = getTimeStringFromSeconds(abs($sumOfWorkedTime - $expectedTime));
  $sign = $sumOfWorkedTime >= $expectedTime ? '+' : '-';

  $date = [
    'report' => $report,
    'sumOfWorkedTime' => getTimeStringFromSeconds($sumOfWorkedTime),
    'balance' => "{$sign}{$balance}",
  ];

  loadTemplateView('monthly_report', $date);