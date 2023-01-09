<?php
namespace Admin\Model;
use Base\Model\Base;
 
class User extends Base{
 	protected $id;
 	protected $storeId;
 	protected $username;
 	protected $email;
 	protected $role;
 	protected $salt;
 	protected $password;
 	protected $fullName;
 	protected $gender;
 	protected $birthday;
 	protected $mobile;
 	protected $address;
 	protected $active;
 	protected $activeKey;
 	protected $lock;
 	protected $createdDateTime;
 	protected $dependencies;
    protected $storeName;
    protected $parentStore;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const ROLE_SUPERADMIN 				= 1;
    const ROLE_ADMIN 					= 2;
    const ROLE_MEMBER 					= 3;

    /**
     * @return mixed
     */
    public function getParentStore()
    {
        return $this->parentStore;
    }

    /**
     * @param mixed $parentStore
     */
    public function setParentStore($parentStore)
    {
        $this->parentStore = $parentStore;
    }

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
    public function getStoreName()
    {
        return $this->storeName;
    }

    /**
     * @param mixed $storeName
     */
    public function setStoreName($storeName)
    {
        $this->storeName = $storeName;
    }


    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
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
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param mixed $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
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
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param mixed $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
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
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getActiveKey()
    {
        return $this->activeKey;
    }

    /**
     * @param mixed $activeKey
     */
    public function setActiveKey($activeKey)
    {
        $this->activeKey = $activeKey;
    }

    /**
     * @return mixed
     */
    public function getLock()
    {
        return $this->lock;
    }

    /**
     * @param mixed $lock
     */
    public function setLock($lock)
    {
        $this->lock = $lock;
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
    public function getDependencies()
    {
        return $this->dependencies;
    }

    /**
     * @param mixed $dependencies
     */
    public function setDependencies($dependencies)
    {
        $this->dependencies = $dependencies;
    }

    public function toFormValues()
    {
        $data =  array(
            'storeId' => $this->getStoreId(),
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'role' => $this->getRole(),
            'salt' => $this->getSalt(),
            'password' => $this->getPassword(),
            'fullName' => $this->getFullName(),
            'gender' => $this->getGender(),
            'birthday' => $this->getBirthday(),
            'mobile' => $this->getMobile(),
            'address' => $this->getAddress(),
            'active' => $this->getActive(),
            'activeKey' => $this->getActiveKey(),
            'lock' => $this->getLock(),
            'createdDateTime' => $this->getCreatedDateTime(),
            'dependencies' => $this->getDependencies(),
            'parentStore' => $this->getParentStore(),
        );
        return $data;
    }

}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 