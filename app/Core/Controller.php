<?php

namespace App\Core;

use App\Core\Model;

class Controller
{
  public function model($model): Model
  {
    $modelClass = 'App\\Models\\' . ucfirst($model) . 'Model';
    return new $modelClass;
  }

  protected function getRequestBody()
  {
    $json = file_get_contents("php://input");
    $obj = json_decode($json);
    return $obj;
  }
}
