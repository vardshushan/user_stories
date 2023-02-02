<?php


class Response
{
    /**
     * @param string $message
     * @return false|string
     */
    public static function send(string $message = "")
    {
        http_response_code(200);
        return json_encode(array(
            'message' => $message
        ));
    }

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
