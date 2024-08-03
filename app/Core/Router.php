<?php

namespace App\Core;

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
    $path = preg_replace('/{([^}]+)}/', '(?P<$1>[^/]+)', $path);
    self::$routes[] = compact('method', 'path', 'handler');
  }

  public static function run()
  {
    $method = $_SERVER['REQUEST_METHOD'];
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    foreach (self::$routes as $route) {
      if ($route['method'] === $method && preg_match('#^' . $route['path'] . '$#', $path, $matches)) {
        $handler = $route['handler'];

        if (is_string($handler)) {
          list($controller, $action) = explode('::', $handler);
          $controllerClass = 'App\\Controllers\\' . $controller;

          if (class_exists($controllerClass)) {
            $controllerInstance = new $controllerClass();
            if (method_exists($controllerInstance, $action)) {
              return call_user_func_array([$controllerInstance, $action], array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY));
            } else {
              http_response_code(500);
              echo "Method $action not found in $controllerClass";
            }
          } else {
            http_response_code(500);
            echo "Controller $controllerClass not found";
          }
        } elseif (is_callable($handler)) {
          return call_user_func_array($handler, array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY));
        }
      }
    }

    http_response_code(404);
    echo "404 Not Found";
  }
}
