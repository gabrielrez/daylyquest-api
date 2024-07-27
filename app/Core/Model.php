<?php

class Model
{
  private static $conn;

  public static function getConn($config, $username = 'root', $password = '')
  {
    if (!isset(self::$conn)) {
      $dsn = 'mysql:' . http_build_query($config, '', ';');
      self::$conn = new \PDO($dsn, $username, $password, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]);
    }
    return self::$conn;
  }
}
