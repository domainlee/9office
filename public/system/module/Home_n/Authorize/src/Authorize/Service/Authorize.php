<?php
/**
 * @category   	Restaurant library
 * @copyright  	http://restaurant.vn
 * @license    	http://restaurant.vn/license
 */

namespace Authorize\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Exception\InvalidArgumentException;
use User\Service\User;

class Authorize implements ServiceLocatorAwareInterface {

	/**
	 * @var ServiceLocatorInterface
	 */
	protected $serviceLocator;

	/**
	 * @var \Zend\Permissions\Acl\Acl
	 */
	protected $acl;

	/**
	 * @var \User\Service\User
	 */
	protected $userService;

	/**
	 * @return the $serviceLocator
	 */
	public function getServiceLocator() {
		return $this->serviceLocator;
	}

	/**
	 * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
	 */
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator) {
		$this->serviceLocator = $serviceLocator;
		return $this;
	}

	/**
	 * @return \User\Service\User
	 */
	public function getUserService() {
		return $this->userService;
	}

	/**
	 * @param \User\Service\User $userService
	 */
	public function setUserService($userService) {
		$this->userService = $userService;
		return $this;
	}

	/**
	 * @return \Zend\Permissions\Acl\Acl
	 */
	public function getAcl() {
		return $this->acl;
	}

	/**
	 * @param \Zend\Permissions\Acl\Acl $acl
	 */
	public function setAcl($acl) {
		$this->acl = $acl;
		return $this;
	}

	/**
	 * @param string $resource
	 * @param string $privilege
	 */
	public function isAllowed($resource, $privilege = null) {
		try {
			return $this->getAcl()->isAllowed($this->getUserService()->getRoleName(), $resource, $privilege);
		} catch (InvalidArgumentException $e) {
			return false;
		}
	}

    public function loadPrivilege($return = false){
        if(!$this->acl || !$this->acl instanceof \Zend\Permissions\Acl\Acl){
            return null;
        }
        $userService = $this->getServiceLocator()->get('User\Service\User');
        /*@var $userService \User\Service\User */
        if(!$userService->hasIdentity()){
            return null;
        }
        $user = $userService->getUser();
//        print_r();die;
        if(!empty($user->getDependencies())) {
            $dep = json_decode($user->getDependencies(), true);
            foreach($dep as $k => $v) {
                $this->acl->allow('Admin', 'admin:'.$k, $v);
            }
        }

        $dependence = $this->acl->getDependencies();
//        print_r($this->acl);die;
        return $this->acl;
    }
}