<?php

require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/FieldModel.php';
require_once __DIR__ . '/../entities/User.php';
require_once __DIR__ . '/../util/Response.php';
require_once __DIR__ . '/../util/Token.php';

class AuthController
{
    private UserModel $user_model;
    private FieldModel $field_model;

    public function __construct()
    {
        $this->user_model = new UserModel();
        $this->field_model = new FieldModel();
    }

    /**
     * @param Request $request
     * @return false|string|void
     */
    public function register(Request $request)
    {
        $errors = $request->validateFields();
        if (empty($errors)) {
            $user = $this->user_model->findByEmailAndPassword($_POST['email'], $_POST['password']);
            if ($user->getId()) {
                return Response::sendWithCode(401, "Email already exists!");
            }
            $this->user_model->registerUser($_POST['name'], $_POST['surname'],
                $_POST['email'], $_POST['password'], $_POST['type'], $_POST['position'],
                $_POST['field_id'], $_POST['description'], $_POST['education'], $_POST['experience'], $_POST['about']);
            header("Location: /login");
            exit();
        } else {
              return  Response::sendWithCode(401, json_encode($errors));
        }

    }

    /**
     * @return void
     */
    public function loginPage()
    {
        include('views/login.php');
    }

    /**
     * @return void
     */
    public function registerPage()
    {
        $fields = $this->field_model->getFields();
        include('views/register.php');
    }

    /**
     * @return false|string
     */
    public function login()
    {
        $user = $this->user_model->findByEmailAndPassword($_POST['email'], $_POST['password']);
        if ($user->getId()) {
            $token = Token::getJWTForUser($user->getEmail(), $user->getId());
            header("Location: /dashboard");
            setcookie('Authorization', 'Bearer ' . $token, time() + (Constants::JWT["TIME_TO_LIVE"] * 30), "/");
            return json_encode(array(
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'token' => $token
            ));
        }
        return Response::sendWithCode(401, "Invalid username or password!!");
    }
}