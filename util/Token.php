<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;

class Token
{
    /**
     * @param $email
     * @param $id
     * @return string
     */
    public static function getJWTForUser($email, $id): string
    {
        $issued_at_time = time();
        $time_to_live = Constants::JWT["TIME_TO_LIVE"];
        $token_expiration = $issued_at_time + $time_to_live;
        $payload = [
            'email' => $email,
            'id' => $id,
            'iat' => $issued_at_time,
            'exp' => $token_expiration,
        ];

        return JWT::encode($payload, Constants::JWT["SECRET_KEY"]);
    }

    /**
     * @return bool
     */
    public static function authenticate(): bool
    {
        $headers = static::getAuthorization();
        if (!is_null($headers)) {

            $token = static::getBearerToken($headers);
            if (!is_null($token)) {
                return static::validateJWTFromUser($token);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @return string|null
     */
    public static function getAuthorization(): ?string
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } else if (isset($_COOKIE['Authorization'])) { //Nginx or fast CGI
            $headers = trim($_COOKIE['Authorization']);
        } else if (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }

        return $headers;
    }

    /**
     * @param $headers
     * @return string|null
     */
    public static function getBearerToken($headers): ?string
    {
        // access token from  header
        if (!empty($headers) && preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
        return null;
    }

    /**
     * @param $encoded_token
     * @return bool
     */
    public static function validateJWTFromUser($encoded_token): bool
    {
        $decoded_token = JWT::decode($encoded_token, Constants::JWT["SECRET_KEY"], ['HS256']);
        $is_token_expired = ($decoded_token->exp - time()) < 0;

        return !$is_token_expired;
    }
}