<?php
  class WorkingHours extends Model {
    protected static $tableName = 'working_hours';
    protected static $columns = [
      'id',
      'user_id',
      'work_date',
      'time1',
      'time2',
      'time3',
      'time4',
      'worked_time',
    ];

    public static function loadFromUserAndDate($userId, $workDate) {
      $filters = [
        'user_id' => $userId,
        'work_date' => $workDate,
      ];
      $registry = self::getOne($filters);
      if(!$registry) {
        $registry = new self([
          'user_id' => $userId,
          'work_date' => $workDate,
          'worked_time' => 0
        ]);
      }
      return $registry;
    }
  }