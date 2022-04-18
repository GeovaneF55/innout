<?php

class Database {
  public static function getConnection() {
    $envPath = realpath(dirname(__FILE__) . "/../env.ini");
    $env = parse_ini_file($envPath);

    $conn = new mysqli(
      $env['host'] . ($env['port'] ? ":" . $env['port'] : ""),
      $env['username'],
      $env['password'],
      $env['database']
    );

    if($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
  }

  public static function getResultFromQuery($query) {
    $conn = self::getConnection();
    $result = $conn->query($query);
    $conn->close();

    return $result;
  }

  public static function executeSQL($query) {
    $conn = self::getConnection();

    if(!mysqli_query($conn, $query)) {
      throw new Exception(mysqli_error($conn));
    }
    $id = $conn->insert_id;
    $conn->close();

    return $id;
  }
}