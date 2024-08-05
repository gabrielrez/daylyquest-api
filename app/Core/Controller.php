<?php

namespace App\Core;

use App\Core\Model;

class Controller
{
  public function model($model): Model
  {
    $modelClass = 'App\\Models\\' . ucfirst($model) . 'Model';
    if (class_exists($modelClass)) {
      return new $modelClass();
    } else {
      throw new \Exception("Model class '$modelClass' not found.");
    }
  }

  protected function getRequestBody()
  {
    $json = file_get_contents("php://input");
    $obj = json_decode($json);
    return $obj;
  }

  protected function response($data, $status = 200)
  {
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
  }
}
