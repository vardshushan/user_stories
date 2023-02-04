<?php

class Response
{
    /**
     * @param $code
     * @param string $message
     * @return false|string
     */
    public static function sendWithCode($code, string $message = "")
    {
        http_response_code($code);
        return json_encode(array(
            'message' => $message
        ));
    }
}
