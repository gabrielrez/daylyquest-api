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

  public function all($table, $columns = ['*'])
  {
    $columns = implode(', ', $columns);

    $query = 'select ' . $columns . ' from ' . $table;
    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function find($table, $columns = ['*'], $args = [])
  {
    $columns = implode(', ', $columns);
    $query = 'select ' . $columns . ' from ' . $table;

    if (!empty($args)) {
      $conditions = [];
      foreach ($args as $key => $value) {
        $conditions[] = $key . ' = :' . $key;
      }
      $query .= ' where ' . implode(' and ', $conditions);
    }

    $stmt = $this->db->prepare($query);

    if (!empty($args)) {
      foreach ($args as $key => $value) {
        $stmt->bindValue(':' . $key, $value);
      }
    }

    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function insert($table, $values = [])
  {
    $columns = implode(', ', array_keys($values));
    $placeholders = implode(', ', array_map(fn ($key) => ':' . $key, array_keys($values)));

    $query = 'insert into ' . $table . ' (' . $columns . ') values (' . $placeholders . ')';

    $stmt = $this->db->prepare($query);

    foreach ($values as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }

    $stmt->execute();
  }

  public function update($table, $set = [], $args = [])
  {
    $query = 'update ' . $table . ' set ';

    $clauses = [];
    foreach ($set as $column => $value) {
      $clauses[] = $column . ' = :' . $column;
    }
    $setQuery = implode(', ', $clauses);

    $where = [];
    foreach ($args as $key => $value) {
      $where[] = $key . ' = :' . $key;
    }
    $whereQuery = implode(' and ', $where);

    $query .= $setQuery . ' WHERE ' . $whereQuery;

    $stmt = $this->db->prepare($query);

    foreach ($set as $column => $value) {
      $stmt->bindValue(':' . $column, $value);
    }

    foreach ($args as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }

    $stmt->execute();
  }

  public function delete($table, $id)
  {
    $query = 'delete from ' . $table . ' where id = :id';

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    $stmt->execute();
  }
}
