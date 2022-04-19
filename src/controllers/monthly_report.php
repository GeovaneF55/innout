<?php
  session_start();
  requireValidSession();

  $currentDate = new DateTime();

  $user = $_SESSION['user'];
  $selectedUser = $user->id;
  $users = [];
  if($user->is_admin) {
    $users = User::get();
    $selectedUser = isset($_POST['user']) ? $_POST['user'] : $user->id;
  }

  $selectedPeriod = isset($_POST['period']) ? $_POST['period'] : $currentDate->format('Y-m');
  $periods = [];
  for ($yearDiff = 0; $yearDiff <= 2; $yearDiff++) {
    $year = date('Y') - $yearDiff;
    for($month = 12; $month >= 1; $month--) {
      $date = new DateTime("{$year}-{$month}-01");
      $periods[$date->format('Y-m')] = strftime('%B de %Y', $date->getTimestamp());
    }
  }

  $registries = WorkingHours::getMonthlyReport($selectedUser, $selectedPeriod);

  $report = [];
  $workday = 0;
  $sumOfWorkedTime = 0;
  $lastDay = getLastDayOfMonth($selectedPeriod)->format('d');

  for($day = 1; $day <= $lastDay; $day++) {
    $date = $selectedPeriod . '-' . sprintf('%02d', $day);
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
    'selectedPeriod' => $selectedPeriod,
    'selectedUser' => $selectedUser,
    'periods' => $periods,
    'users' => $users,
  ];

  loadTemplateView('monthly_report', $date);