<?php
  class Model {
    protected static $tableName = "";
    protected static $columns = [];
    protected $values = [];

    function __construct($arr, $sanitize = true) {
      $this->loadFromArray($arr, $sanitize);
    }

    public function loadFromArray($arr, $sanitize = true) {
      if($arr) {
        // $conn = Database::getConnection();
        foreach ($arr as $key => $value) {
          $cleanValue = $value;
          if($sanitize && isset($cleanValue)) {
            $cleanValue = strip_tags(trim($cleanValue));
            // $cleanValue = htmlentities($cleanValue, ENT_NOQUOTES);
            // $cleanValue = mysqli_real_escape_string($conn, $cleanValue);
          }
          $this->$key = $cleanValue;
        }
        // $conn->close();
      }
    }

    public function __get($key) {
      return array_key_exists($key, $this->values)
        ? $this->values[$key]
        : null;
    }

    public function __set($key, $value) {
      $this->values[$key] = $value;
    }

    public function getValues() {
      return $this->values;
    }

    public static function getOne($filters = [], $columns = '*') {
      $class = get_called_class();
      $result = static::getResultSetFromSelect($filters, $columns);
      return $result ? new $class($result->fetch_assoc()) : null;
    }

    public static function get($filters = [], $columns = '*') {
      $objects = [];
      $result = static::getResultSetFromSelect($filters, $columns);
      if($result) {
        $class = get_called_class();
        while($row = $result->fetch_assoc()) {
          array_push($objects, new $class($row));
        }
      }
      return $objects;
    }

    public static function getResultSetFromSelect($filters = [], $columns = '*') {
      $sql = "SELECT {$columns} FROM " .
        static::$tableName .
        self::getFilters($filters);
      $result = Database::getResultFromQuery($sql);
      if($result->num_rows == 0) {
        return null;
      } else {
        return $result;
      }
    }

    public function insert() {
      $sql = "INSERT INTO " . static::$tableName . " ("
        . implode(",", static::$columns) . ") VALUES (";
      foreach (static::$columns as $column) {
        $sql .= static::getFormatedValue($this->$column) . ",";
      }
      $sql = substr($sql, 0, -1) . ");";
      $id = Database::executeSQL($sql);
      $this->id = $id;
    }

    public function update() {
      $sql = "UPDATE " . static::$tableName . " SET ";
      foreach (static::$columns as $column) {
        $sql .= "{$column} = " . static::getFormatedValue($this->$column) . ",";
      }
      $sql = substr($sql, 0, -1) . " WHERE id = {$this->id};";
      Database::executeSQL($sql);
    }

    public function delete() {
      static::deleteById($this->id);
    }

    public static function deleteById($id) {
      $sql = "DELETE FROM " . static::$tableName . " WHERE id = {$id};";
      Database::executeSQL($sql);
    }

    public static function getCount($filters = []) {
      $result = static::getResultSetFromSelect($filters, "COUNT(*) as count");
      return $result->fetch_assoc()['count'];
    } 

    private static function getFilters($filters) {
      $sql = '';
      if(count($filters) > 0) {
        $sql .= ' WHERE ';
        $i = 0;
        foreach ($filters as $column => $value) {
          if($column == 'raw') {
            $sql .= $value;
          } else {
            $sql .= $column . ' = ' . static::getFormatedValue($value);
          }

          if($i < count($filters) - 1) {
            $sql .= ' AND ';
          }
          $i++;
        }
      }
      return $sql;
    }

    private static function getFormatedValue($value) {
      if(is_null($value)) {
        return 'NULL';
      } elseif(is_string($value)) {
        return "'$value'";
      } else {
        return $value;
      }
    }
  }