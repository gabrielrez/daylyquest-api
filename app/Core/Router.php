<?php

class Router
{
  private static $routes = [];

  public static function get($path, $handler)
  {
    self::addRoute('GET', $path, $handler);
  }

  public static function post($path, $handler)
  {
    self::addRoute('POST', $path, $handler);
  }

  public static function put($path, $handler)
  {
    self::addRoute('PUT', $path, $handler);
  }

  public static function delete($path, $handler)
  {
    self::addRoute('DELETE', $path, $handler);
  }

  private static function addRoute($method, $path, $handler)
  {
    self::$routes[] = compact('method', 'path', 'handler');
  }

  public static function run()
  {
    $method = $_SERVER['REQUEST_METHOD'];
    $path = $_SERVER['REQUEST_URI'];

    foreach (self::$routes as $route) {
      if ($route['method'] === $method && $route['path'] === $path) {
        $handler = $route['handler'];

        if (is_string($handler)) {
          list($controller, $action) = explode('@', $handler);
          $controllerClass = 'App\\Controllers\\' . $controller;

          if (class_exists($controllerClass)) {
            $controllerInstance = new $controllerClass();
            if (method_exists($controllerInstance, $action)) {
              return $controllerInstance->$action();
            } else {
              http_response_code(500);
              echo "Method $action not found in $controllerClass";
            }
          } else {
            http_response_code(500);
            echo "Controller $controllerClass not found";
          }
        } elseif (is_callable($handler)) {
          return call_user_func($handler);
        }
      }
    }

    http_response_code(404);
    echo "404 Not Found";
  }
}
