<?php

class Field
{

    private $id;

    /**
     * @var mixed|null
     */
    private $name;


    public function __construct($id = null, $name = null)
    {
        $this->id = $id;
        $this->name = $name;
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
     * @return array
     */
    public function toAssoc(): array
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
        );
    }
}