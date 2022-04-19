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

    public function getNextTime() {
      if(!$this->time1) return 'time1';
      if(!$this->time2) return 'time2';
      if(!$this->time3) return 'time3';
      if(!$this->time4) return 'time4';
      return null;
    }

    public function innout($time) {
      $timeColumn = $this->getNextTime();
      if(is_null($timeColumn)) {
        throw new AppException('Você já fez os 4 batimentos do dia!');
      }
      $this->$timeColumn = $time;
      if($this->id) {
        $this->update();
      } else {
        $this->insert();
      }
    }
  }