<?php

require_once 'config/db_conn.php';
require_once 'controllers/BusinessController.php';

header('Content-Type: application/json');

$controller = new BusinessController($link);

$method = $_SERVER['REQUEST_METHOD'];
$route  = $_GET['route'] ?? '';

$routes = [
    'GET' => [
        'business-list' => [$controller, 'getList']
    ],
    'POST' => [
        'save-business' => [$controller, 'add_edit'],
        'delete-business' => [$controller, 'delete'],
        'save-rating' => [$controller, 'save_update'],
    ]
];

if (isset($routes[$method][$route])) {
    call_user_func($routes[$method][$route]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Route not found",
        "route" => $route
    ]);
}