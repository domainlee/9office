<?php
namespace Admin\Model;

use Base\Model\Base;

class Template extends Base{
	
	protected $id;
	protected $name;
	protected $directory;

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
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @param mixed $directory
     */
    public function setDirectory($directory)
    {
        $this->directory = $directory;
    }

    public function toFormValues()
    {
        $data =  array(
            'name' => $this->getName(),
            'directory' => $this->getDirectory(),
        );

        return $data;
    }


}