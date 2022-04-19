<?php
  Database::executeSQL('DELETE FROM working_hours');
  Database::executeSQL('ALTER TABLE working_hours AUTO_INCREMENT = 1');
  Database::executeSQL('DELETE FROM users WHERE id > 5');
  Database::executeSQL('ALTER TABLE working_hours AUTO_INCREMENT = 1');

  function getDayTemplateByOdds($regularRate, $extraHourRate, $lazyRate) {
    $regularDayTemplate = [
      'time1' => '08:00:00',
      'time2' => '12:00:00',
      'time3' => '13:00:00',
      'time4' => '17:00:00',
      'worked_time' => DAILY_TIME,
    ];
  
    $extraHourDayTemplate = [
      'time1' => '08:00:00',
      'time2' => '12:00:00',
      'time3' => '13:00:00',
      'time4' => '18:00:00',
      'worked_time' => DAILY_TIME + 3600,
    ];
  
    $lazyDayTemplate = [
      'time1' => '08:30:00',
      'time2' => '12:00:00',
      'time3' => '13:00:00',
      'time4' => '17:00:00',
      'worked_time' => DAILY_TIME - 1800,
    ];

    $dontWorkTemplate = [
      'time1' => null,
      'time2' => null,
      'time3' => null,
      'time4' => null,
      'worked_time' => 0,
    ];

    $odds = rand(0, 100);
    if ($odds <= $regularRate) {
      return $regularDayTemplate;
    } else if ($odds <= $regularRate + $extraHourRate) {
      return $extraHourDayTemplate;
    } else if ($odds <= $regularRate + $extraHourRate + $lazyRate) {
      return $lazyDayTemplate;
    } else {
      return $dontWorkTemplate;
    }
  }

  function populateWorkingHours($userId, $initialDate, $regularRate, $extraHourRate, $lazyRate) {
    $currentDate = $initialDate;
    $yesterday = new DateTime();
    $yesterday->modify('-1 day');
    $columns = ['user_id' => $userId, 'work_date' => $currentDate];
    
    while(isBefore($currentDate, $yesterday)) {
      if(!isWeekend($currentDate)) {
        $template = getDayTemplateByOdds($regularRate, $extraHourRate, $lazyRate);
        $columns = array_merge($columns, $template);
        $workingHours = new WorkingHours($columns);
        $workingHours->insert();
      }
      $currentDate = getNextDay($currentDate)->format('Y-m-d');
      $columns['work_date'] = $currentDate;
    }
  }

  populateWorkingHours(1, date('Y-m-1'), 70, 20, 10);
  populateWorkingHours(3, date('Y-m-1'), 20, 75, 5);
  populateWorkingHours(4, date('Y-m-1'), 20, 10, 70);

  echo "Generating data...\n";