<?php

namespace ZENben\Bundle\YammerBundle\Model;

class Group
{

    protected $id;
    protected $name;
    protected $fullName;
    protected $description;

    /**
     * @param $id
     * @param $name
     * @param $fullName
     * @param $description
     */
    function __construct($id, $name, $fullName, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->fullName = $fullName;
        $this->description = $description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }




}