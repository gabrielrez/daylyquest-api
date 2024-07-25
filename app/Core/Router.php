<?php

class Router
{
  private $controller;
  private $method;
  private $controllerMethod;
  private $params = [];

  function __construct()
  {
    $url = $this->parseURL();

    if (file_exists("../Controllers/" . ucfirst($url[1]) . ".php")) {
      $this->controller = $url[1];
      unset($url[1]);
    } elseif (empty($url[1])) {
      echo "Hi, this is the DaylyQuest API!";
      exit;
    } else {
      http_response_code(404);
      echo json_encode(["erro" => "Resource not found"]);
    }

    require_once "../Controllers/" . ucfirst($this->controller) . ".php";

    $this->controller = new $this->controller;
    $this->method = $_SERVER["REQUEST_METHOD"];

    switch ($this->method) {
      case "GET":
        if (isset($url[2])) {
          $this->controllerMethod = "find";
          $this->params = [$url[2]];
        } else {
          $this->controllerMethod = "index";
        }
        break;
      case "POST":
        $this->controllerMethod = "store";
        break;
      case "PUT":
        $this->controllerMethod = "update";
        if (isset($url[2]) && is_numeric($url[2])) {
          $this->params = [$url[2]];
        } else {
          http_response_code(400);
          echo json_encode(["erro" => "You need to provide an id"]);
          exit;
        }
        break;
      case "DELETE":
        $this->controllerMethod = "delete";
        if (isset($url[2]) && is_numeric($url[2])) {
          $this->params = [$url[2]];
        } else {
          http_response_code(400);
          echo json_encode(["erro" => "You need to provide an id"]);
          exit;
        }
        break;
      default:
        echo "Unsupported method";
        exit;
        break;
    }
    call_user_func_array([$this->controller, $this->controllerMethod], $this->params);
  }

  private function parseURL()
  {
    return explode("/", $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
  }
}
