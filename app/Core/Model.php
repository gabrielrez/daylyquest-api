<?php

class Model
{

  private static $conexao;

  public static function getConn($config, $username = 'root', $password = '')
  {
    $dsn = 'mysql:' . http_build_query($config, '', ';');
    if (!isset(self::$conexao)) {
      self::$conexao = new \PDO($dsn, $username, $password, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
      ]);
    }

    return self::$conexao;
  }
}
