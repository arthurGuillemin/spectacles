<?php

namespace App\Core;

class Router {
    private array $routes = [];

    public function get(string $path, array $handler): void {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, array $handler): void {
        $this->routes['POST'][$path] = $handler;
    }

public function run(): void {
    $method = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $uri = preg_replace('#^/public#', '', $uri);
    if ($uri === '') $uri = '/'; 

    if (isset($this->routes[$method][$uri])) {
        [$controller, $action] = $this->routes[$method][$uri];
        $instance = new $controller();
        call_user_func([$instance, $action]);
    } else {
        http_response_code(404);
        echo "<h1>404 - Faire une page 404 si le temps</h1>";
    }
}

}
