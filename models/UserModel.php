<?php

use Firebase\JWT\JWT;

require_once __DIR__ . "/../util/Database.php";
require_once __DIR__ . "/../entities/User.php";


class UserModel
{

    private ?mysqli $dbConn;

    public function __construct()
    {
        $this->dbConn = Database::getConnection();
    }

    /**
     * @param $name
     * @param $surname
     * @param $email
     * @param $password
     * @param $type
     * @param $position
     * @param $field_id
     * @param $description
     * @param $education
     * @param $experience
     * @param $about
     * @return bool|mysqli_result
     */
    public function registerUser($name, $surname, $email, $password, $type, $position, $field_id, $description, $education, $experience, $about)
    {
        $insertSql = "INSERT INTO Users (name, surname, 
                   position, type,
                   description, field_id,
                   education, email,
                   password, experience,about)
VALUES ('" . $name . "','" . $surname . "','" . $position . "','" . $type . "',
'" . $description . "','" . $field_id . "','" . $education . "','" . $email . "',
'" . password_hash($password, PASSWORD_DEFAULT) . "','" . $experience . "','" . $about . "')";
        return $this->dbConn->query($insertSql);
    }

    public function update($user): bool
    {
        $updateSql = "UPDATE `Users` SET";
        if ($user->getName()) {
            $updateSql .= "`name`='" . $user->getName() . "'";
        }
        if ($user->getSurname()) {
            $updateSql .= ",`surname`='" . $user->getSurname() . "'";
        }
        if ($user->getPosition()) {
            $updateSql .= ",  `position`='" . $user->getPosition() . "'";
        }
        if ($user->getType()) {
            $updateSql .= ", `type`='" . $user->getType() . "'";
        }
        if ($user->getDescription()) {
            $updateSql .= " ,`description`='" . $user->getDescription() . "'";
        }
        if ($user->getFieldId()) {
            $updateSql .= ", `field_id`='" . $user->getFieldId() . "'";
        }
        if ($user->getEducation()) {
            $updateSql .= ", `education`='" . $user->getEducation() . "'";
        }
        if ($user->getEmail()) {
            $updateSql .= ", `email`='" . $user->getEmail() . "'";
        }
        if ($user->getExperience()) {
            $updateSql .= " ,`experience`='" . $user->getExperience() . "'";
        }
        if ($user->getAbout()) {
            $updateSql .= " ,`about`='" . $user->getAbout() . "'";
        }
        if ($user->getPassword()) {
            $updateSql .= ",`password`='" . password_hash($user->getPassword(), PASSWORD_DEFAULT) . "'";
        }
        $updateSql .= " WHERE `id`=" . $user->getId();

        if ($this->dbConn->query($updateSql) === true) {
            return true;
        }
        echo "Error: " . $updateSql . "<br>" . $this->dbConn->error;
        return false;
    }

    /**
     * @param $search
     * @param $type
     * @return array|User
     */
    public function findAll($search, $type)
    {
        $arr = ['name', 'surname', 'type', 'registered_at'];
        $selectSql = "SELECT * from Users";

        if (in_array($type, $arr)) {
            if ($type == 'name') {
                $selectSql .= " WHERE name LIKE '%" . $search . "%';";
            } elseif ($type == 'surname') {
                $selectSql .= " WHERE surname LIKE '%" . $search . "%';";
            } elseif ($type == 'type') {
                $selectSql .= " WHERE type LIKE '%" . $search . "%';";
            } elseif ($type == 'registered_at') {
                $selectSql .= " WHERE registered_at LIKE '%" . $search . "%';";
            }
        }
        $result = $this->dbConn->query($selectSql);

        if ($result->num_rows > 0) {
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = (new User($row["id"], $row["name"], $row["surname"], $row["email"], $row["password"], $row["type"],
                    $row["position"], $row["field_id"], $row["description"], $row["education"], $row["experience"], $row["about"], $row["registered_at"]))
                    ->toAssoc();
            }
            return $users;
        }
        return new User();
    }

    /**
     * @param $id
     * @return User
     */
    public function findById($id): User
    {
        $selectSql = "SELECT Users.*,Fields.id as field_id, Fields.name as field_name FROM `Users` 
        INNER JOIN Fields ON Fields.id = Users.field_id
        WHERE `Users`.`id` = '" . $id . "'";
        $result = $this->dbConn->query($selectSql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return (new User($row["id"], $row["name"], $row["surname"], $row["email"], $row["password"], $row["type"],
                $row["position"], $row["field_id"], $row["description"], $row["education"], $row["experience"], $row["about"], $row["registered_at"]));
        }
        return new User();
    }

    /**
     * @param $email
     * @param $password
     * @return User
     */
    public function findByEmailAndPassword($email, $password): User
    {
        $selectSql = "SELECT * FROM `Users` WHERE  `email`='" . $email . "'";
        $result = $this->dbConn->query($selectSql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                return (new User($row["id"], $row["name"], $row["surname"], $row["email"], $row["password"], $row["type"],
                    $row["position"], $row["field_id"], $row["description"], $row["education"], $row["experience"], $row["about"]));
            }
            return new User();
        }
        return new User();
    }

    /**
     * @return array|User
     */
    public function getAuthUser()
    {
        $token = JWT::decode(str_replace('Bearer ', '', $_COOKIE['Authorization']), Constants::JWT['SECRET_KEY'], array_keys(JWT::$supported_algs));

        $selectSql = "SELECT Users.*, Fields.id as field_id, Fields.name as field_name  FROM Users 
                      INNER JOIN Fields ON Fields.id = Users.field_id
                      where `Users`.`id` = '" . $token->id . "'";
        $result = $this->dbConn->query($selectSql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return (new User($row["id"], $row["name"], $row["surname"], $row["email"], $row["password"], $row["type"],
                $row["position"], $row["field_id"], $row["description"], $row["education"], $row["experience"], $row["about"], $row["registered_at"]))
                ->toAssoc();
        }
        return new User();
    }
}