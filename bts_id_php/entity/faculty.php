<?php


class Faculty
{
    private $id;
    private $name;
    private $establish;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getName()
    {
        return $this->name;
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
    public function getEstablish()
    {
        return $this->establish;
    }

    /**
     * @param mixed $establish
     */
    public function setEstablish($establish)
    {
        $this->establish = $establish;
    }


}