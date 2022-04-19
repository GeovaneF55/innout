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

  function sumIntervals($interval1, $interval2) {
    $date = new DateTime("00:00:00");
    $date->add($interval1);
    $date->add($interval2);
    return (new DateTime("00:00:00"))->diff($date);
  }

  function subIntervals($interval1, $interval2) {
    $date = new DateTime("00:00:00");
    $date->add($interval1);
    $date->sub($interval2);
    return (new DateTime("00:00:00"))->diff($date);
  }

  function getDateFromInterval($interval) {
    return new DateTimeImmutable($interval->format('%H:%i:%s'));
  }

  function getDateFromString($string) {
    return DateTimeImmutable::createFromFormat('H:i:s', $string);
  }