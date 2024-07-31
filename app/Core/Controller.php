<?php

namespace App\Core;

class Controller
{
  public function model($model)
  {
    require_once '../Models/' . ucfirst($model) . 'Model.php';
    return new $model;
  }

  protected function getRequestBody()
  {
    $json = file_get_contents("php://input");
    $obj = json_decode($json);
    return $obj;
  }
}
