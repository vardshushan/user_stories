<?php

require_once __DIR__ . '/Request.php';
require_once __DIR__ . '/Response.php';

class Route
{
    private static array $get_routes = array();
    private static array $post_routes = array();

    /**
     * @param $request_method
     * @param $expression
     * @param $function
     * @param bool $enable_auth
     * @return void
     */
    public static function add($request_method, $expression, $function, bool $enable_auth = true)
    {
        switch ($request_method) {
            case 'GET':
                self::$get_routes[] = array(
                    'expression' => $expression,
                    'function' => $function,
                    'enable_auth' => $enable_auth
                );
                break;
            case 'POST':
                self::$post_routes[] = array(
                    'expression' => $expression,
                    'function' => $function,
                    'enable_auth' => $enable_auth
                );
                break;
            default:
                break;
        }
    }

    /**
     * @return void
     */
    public static function run()
    {
        $request_path_found = false;
        $routes = array();
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($method) {
            case 'GET':
                $routes = self::$get_routes;
                break;
            case 'POST':
                $routes = self::$post_routes;
                break;
            default:
                break;
        }
        foreach ($routes as $route) {
            $requestUri = $_SERVER['REQUEST_URI'];
            $requestUri = (stripos($requestUri, "/") !== 0) ? "/" . $requestUri : $requestUri;
            $regex = str_replace('/', '\/', $route['expression']);

            if (preg_match('/^' . ($regex) . '$/', $requestUri, $matches)) {
                array_shift($matches);
                $request_path_found = true;

                if (
                    $route['enable_auth'] && static::checkAuth()
                    || !$route['enable_auth']
                ) {
                    call_user_func_array($route['function'], array(new Request($matches)));
                }
                break;
            }
        }
        if (
            !$request_path_found
            && static::checkAuth()
        ) {
            echo Response::sendWithCode(404, "resource does not exist");
        }
    }

    /**
     * @return bool
     */
    public static function checkAuth(): bool // check  if there is authenticated user
    {

        if (Constants::JWT["TOKEN_AUTHENTICATION"]) {
            if (Token::authenticate()) {
                return true;
            } else {
                echo Response::sendWithCode(401, "Invalid token. Please login.");
                return false;
            }
        } else {
            return true;
        }
    }
}