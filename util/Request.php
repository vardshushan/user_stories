<?php

class Request
{
    public array $params;
    public string $contentType;

    /**
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->params = $params;
        $this->contentType = !empty($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : 'application/json';
    }

    /**
     * @return array
     */
    public function validateFields(): array
    {
        $uppercase = preg_match('@[A-Z]@', $_POST['password']);
        $lowercase = preg_match('@[a-z]@', $_POST['password']);
        $number = preg_match('@[0-9]@', $_POST['password']);
        $specialChars = preg_match('@[^\w]@', $_POST['password']);
        $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
        $errors = [];
        if ($_POST['name'] == '' || $_POST['surname'] == '' || $_POST['position'] == '' ||
            $_POST['description'] == '' || $_POST['email'] == '' ||
            $_POST['education'] == '' || $_POST['experience'] == '' || $_POST['about'] == '') { //fields are required
            $errors[] = 'All fields are required!! ';
        }
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST['password']) < 8) { //password validation
            $errors[] = 'Password should be at least 8 characters in length and should include one upperCase letter, one number, one special character.';
        }
        if (strlen($_POST['description']) > 250 || strlen($_POST['about']) > 250) { // description and about validation
            $errors[] = 'Description and About fields should be shorter than 250 character. ';
        }
        if (!preg_match($regex, $_POST['email'])) { // email validation.
            $errors[] = 'Email should be valid!.';
        }
        return $errors;
    }
}