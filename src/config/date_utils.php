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

  function getFirstDayOfMonth($date) {
    $timestamp = getDateAsTime($date)->getTimestamp();
    return new Datetime(date('Y-m-1', $timestamp));
  }

  function getLastDayOfMonth($date) {
    $timestamp = getDateAsTime($date)->getTimestamp();
    return new Datetime(date('Y-m-t', $timestamp));
  }

  function getSecondsFromDateInterval($interval) {
    $d1 = new DateTimeImmutable();
    $d2 = $d1->add($interval);

    return $d2->getTimestamp() - $d1->getTimestamp();
  }

  function isPastWorkday($date) {
    return !isWeekend($date) && isBefore($date, new DateTime());
  }

  function getTimeStringFromSeconds($seconds) {
    $h = intdiv($seconds, 3600);
    $m = intdiv(($seconds % 3600), 60);
    $s = $seconds - ($h* 3600) - ($m * 60);
    return sprintf('%02d:%02d:%02d', $h, $m, $s);
  }

  function formatDateWithLocale($date, $pattern) {
    $time = getDateAsTime($date)->getTimestamp();
    return strftime($pattern, $time);
  }