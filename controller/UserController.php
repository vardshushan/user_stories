<?php

require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/FieldModel.php';
require_once __DIR__ . '/../entities/User.php';
require_once __DIR__ . '/../util/Response.php';

class UserController
{
    private UserModel $userModel;
    private FieldModel $fieldModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->fieldModel = new FieldModel();
    }

    /**
     * @return void
     */
    public function getDashboard()
    {
        $user = $this->userModel->getAuthUser();
        $field = $this->fieldModel->getField($user['field_id']);
        include("views/dashboard.php");
    }

    /**
     * @return void
     */
    public function editPersonalData()
    {
        $fields = $this->fieldModel->getFields();
        $user = $this->userModel->getAuthUser();
        include("views/editUser.php");
    }

    /**
     * @return void
     */
    public function getUsersList()
    {
        $fields = $this->fieldModel->getFields();
        $users[] = new User();
        $searchType = $_POST['search_type'] ?? '';
        $searchValue = $_POST['search_value'] ?? '';
        $users = $this->userModel->findAll($searchValue, $searchType);
        include("views/usersList.php");
    }

    /**
     * @param $id
     * @return false|string|void
     */
    public function findById($id)
    {
        $user = $this->userModel->findById($id);
        if ($user->getId()) {
            $field = $this->fieldModel->getField($user->getFieldId());
            $userProfile = $user->toJson();
            include("views/userProfile.php");
        } else {
            return Response::sendWithCode(400, "No results found!");
        }
    }

    /**
     * @param Request $request
     * @param $data
     * @return false|string|void
     */
    public function update(Request $request, $data)
    {
        $errors = $request->validateFields();
        if (empty($errors)) {
            $user = new User();
            $authUser = $this->userModel->getAuthUser();

            $user->setId($authUser['id']);
            isset($_POST['name']) && $user->setName($_POST['name']);
            isset($_POST['surname']) && $user->setSurname($_POST['surname']);
            isset($_POST['description']) && $user->setDescription($_POST['description']);
            isset($_POST['about']) && $user->setAbout($_POST['about']);
            isset($_POST['education']) && $user->setEducation($_POST['education']);
            isset($_POST['password']) && $user->setPassword($data->password);
            isset($_POST['position']) && $user->setPosition($data->position);
            isset($_POST['type']) && $user->setType($data->type);
            isset($_POST['email']) && $user->setEmail($data->email);
            isset($_POST['field_id']) && $user->setFieldId($data->field_id);
            isset($data['experience']) && $user->setExperience($data->experience);

            if ($this->userModel->update($user)) {
                header("Location: /dashboard");

            } else {
                return Response::sendWithCode(500, "Something went wrong!");
            }
        } else {
            return Response::sendWithCode(401, json_encode($errors));
        }
    }

    /**
     * @return false|string
     */
    public function searchUser()
    {
        $fields = $this->fieldModel->getFields();
        $users[] = new User();
        $users = $this->userModel->search($_POST['search_type'], $_POST['search_value']);
        include("views/usersList.php");
        if ($users) {
            return json_encode($users);
        } else {
            return Response::sendWithCode(400, "No results found!");
        }
    }
}