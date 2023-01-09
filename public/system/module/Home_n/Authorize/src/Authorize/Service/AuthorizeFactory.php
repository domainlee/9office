<?php
/**
 * @author 		Mienlv
 * @category   	DWEB library
 * @copyright  	http://dweb.vn
 * @license    	http://dweb.vn/license
 */
namespace Authorize\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthorizeFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $sl
     * @return \Authorize\Service\Authorize
     */
    public function createService(ServiceLocatorInterface $sl)
    {
        $service = new Authorize();
        $service->setServiceLocator($sl);
        // nếu user bị khóa, clearIdentity luôn
        $userService = $sl->get('User\Service\User');
//        if($userService->hasIdentity() && $userService->getUser()->getLocked()){
        if($userService->hasIdentity() && $userService->getUser()->getLocked()){
            $userService->signout();
        }
        $acl = $sl->get('Authorize\Permission\Acl');
        $service->setAcl($acl);
        $service->setUserService($sl->get('User\Service\User'));
        $service->loadPrivilege();
        return $service;
    }
}