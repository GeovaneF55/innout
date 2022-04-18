<?php
  function getDateAsTime($date) {
    return is_string($date) ? new Datetime($date) : $date;
  }

  function isWeekend($date) {
    $date = getDateAsTime($date);
    return $date->format('N') >= 6;
  }

  function isBefore($date1, $date2) {
    $date1 = getDateAsTime($date1);
    $date2 = getDateAsTime($date2);
    return $date1 <= $date2;
  }

  function getNextDay($date) {
    $date = getDateAsTime($date);
    return $date->modify('+1 day');
  }