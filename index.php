<?php

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json, text/html; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,PATCH,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once __DIR__ . '/util/Route.php';
require_once __DIR__ . '/controller/AuthController.php';
require_once __DIR__ . '/controller/UserController.php';


Route::add('GET', '/', function () {
    include('views/login.php');
}, false);

Route::add('GET', '/login', function () {
    include('views/login.php');
}, false);

Route::add('GET', '/register', function () {
    echo (new AuthController())->registerPage();
}, false);

Route::add('POST', '/api/auth/register', function (Request $request) {
    echo (new AuthController())->register($request);
}, false);

Route::add('POST', '/api/auth/login', function () {
    echo (new AuthController())->login();
}, false);

Route::add('GET', '/dashboard', function () {
    echo (new UserController())->getDashboard();
});
Route::add('GET', '/api/edit-personal-data', function () {
    echo (new UserController())->editPersonalData();
});
Route::add('GET', '/api/get-users-list', function () {
    echo (new UserController())->getUsersList();
});
Route::add('POST', '/api/get-users-list', function () {
    echo (new UserController())->getUsersList();
});

Route::add('GET', '/api/user/([0-9]*)', function (Request $request) {
    echo (new UserController())->findById($request->params[0]);
});

Route::add('POST', '/api/user/update', function (Request $request) {
    echo (new UserController())->update($request, $request->params[0]);
});

Route::add('POST', '/api/users/search', function () {
    echo (new UserController())->searchUser();
});

Route::run();




