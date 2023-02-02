<?php

class User
{

    private $id;
    private $password;
    private $email;
    /**
     * @var mixed|null
     */
    private $name;
    private $surname;
    /**
     * @var mixed|null
     */
    private $type;
    /**
     * @var mixed|null
     */
    private $position;
    /**
     * @var mixed|null
     */
    private $field_id;
    /**
     * @var mixed|null
     */
    private $description;
    /**
     * @var mixed|null
     */
    private $education;
    /**
     * @var mixed|null
     */
    private $about;
    /**
     * @var mixed|null
     */
    private $experience;
    private $registered_at;

    /**
     * @param $id
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
     * @param $registered_at
     */
    public function __construct($id = null, $name = null, $surname = null, $email = null, $password = null, $type = null,
                                $position = null, $field_id = null, $description = null, $education = null, $experience = null, $about = null, $registered_at = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->type = $type;
        $this->position = $position;
        $this->field_id = $field_id;
        $this->description = $description;
        $this->education = $education;
        $this->experience = $experience;
        $this->about = $about;
        $this->registered_at = $registered_at;
    }

    /**
     * @param $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $password
     * @return void
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $surname
     * @return void
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $position
     * @return void
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param $fieldId
     * @return void
     */
    public function setFieldId($fieldId)
    {
        $this->field_id = $fieldId;
    }

    public function getFieldId()
    {
        return $this->field_id;
    }

    /**
     * @param $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $education
     * @return void
     */
    public function setEducation($education)
    {
        $this->education = $education;
    }

    public function getEducation()
    {
        return $this->education;
    }

    /**
     * @param $experience
     * @return void
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;
    }

    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param $about
     * @return void
     */
    public function setAbout($about)
    {
        $this->about = $about;
    }

    public function getAbout()
    {
        return $this->about;
    }

    /**
     * @param $registered_at
     * @return void
     */
    public function setRegisteredDate($registered_at)
    {
        $this->registered_at = $registered_at;
    }

    /**
     * @return mixed|null
     */
    public function getRegisteredDate()
    {
        return $this->registered_at;
    }

    /**
     * @return false|string
     */
    public function toJson()
    {
        return json_encode(array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'type' => $this->getType(),
            'position' => $this->getPosition(),
            'field_id' => $this->getFieldId(),
            'description' => $this->getDescription(),
            'education' => $this->getEducation(),
            'experience' => $this->getExperience(),
            'about' => $this->getAbout(),
            'registered_at' => $this->getRegisteredDate()
        ));
    }

    /**
     * @return array
     */
    public function toAssoc(): array
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'surname' => $this->getSurname(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'type' => $this->getType(),
            'position' => $this->getPosition(),
            'field_id' => $this->getFieldId(),
            'description' => $this->getDescription(),
            'education' => $this->getEducation(),
            'experience' => $this->getExperience(),
            'about' => $this->getAbout(),
            'registered_at' => $this->getRegisteredDate()
        );
    }

}