<?php

namespace App\Core;

class Model
{
  private static $conn;
  protected $config;
  protected $db;

  public function __construct()
  {
    $this->config = require '../../public/config.php';
    $this->db = $this->getConn($this->config);
  }

  public static function getConn($config, $username = 'root', $password = '')
  {
    if (!isset(self::$conn)) {
      $dsn = 'mysql:' . http_build_query($config, '', ';');
      self::$conn = new \PDO($dsn, $username, $password);
      self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    return self::$conn;
  }
}
