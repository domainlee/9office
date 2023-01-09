<?php
namespace Admin\Model;
use Base\Model\Base;
 
class Client extends Base{
 	protected $id;
 	protected $storeId;
 	protected $code;
 	protected $name;
 	protected $phone;
 	protected $email;
 	protected $address;
 	protected $birthday;
 	protected $gender;
 	protected $createdDateTime;
 	protected $extraContent;

    const MALE = 1;
    const FEMALE = 2;

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
    public function getStoreId()
    {
        return $this->storeId;
    }

    /**
     * @param mixed $storeId
     */
    public function setStoreId($storeId)
    {
        $this->storeId = $storeId;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
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
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getCreatedDateTime()
    {
        return $this->createdDateTime;
    }

    /**
     * @param mixed $createdDateTime
     */
    public function setCreatedDateTime($createdDateTime)
    {
        $this->createdDateTime = $createdDateTime;
    }

    /**
     * @return mixed
     */
    public function getExtraContent()
    {
        return $this->extraContent;
    }

    /**
     * @param mixed $extraContent
     */
    public function setExtraContent($extraContent)
    {
        $this->extraContent = $extraContent;
    }


    public function toFormValues()
    {
        $data =  array(
            'storeId' => $this->getStoreId(),
            'code' => $this->getCode(),
            'name' => $this->getName(),
            'phone' => $this->getPhone(),
            'email' => $this->getEmail(),
            'address' => $this->getAddress(),
            'birthday' => $this->getBirthday(),
            'gender' => $this->getGender(),
            'createdDateTime' => $this->getCreatedDateTime(),
            'extraContent' => $this->getExtraContent(),
        );
        return $data;
    }

}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 