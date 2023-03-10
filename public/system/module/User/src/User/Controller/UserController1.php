<?php

namespace User\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Home\Model\DateBase;


class UserController extends AbstractActionController {

	public function indexAction()
	{
		$this->layout('layout/admin');
		$model = new \User\Model\User();
		$mapper = $this->getServiceLocator()->get('User\Model\UserMapper');
		$model->exchangeArray($this->getRequest()->getQuery());
		$fFilter = new \User\Form\UserSearch();
		$fFilter->bind($model);
		$page = (int)$this->getRequest()->getQuery()->page ? : 1;
		$results = $mapper->search($model,array($page,10));
		
		return new ViewModel(array(
			'fFilter' => $fFilter,
			'results' => $results
		));
		
	}
	/**
	 * show user profile
	 */
	public function profileAction()
	{
		$this->layout('layout/admin');
        if(!$this->user()->hasIdentity()) {
             return $this->redirect()->toRoute('home');
        }
		$sl = $this->getServiceLocator();
		/*@var $userService \User\Service\User */
		$userService = $this->getServiceLocator()->get('User\Service\User');
		$user = $userService->getUser();
		return new ViewModel(array('user' => $user));
	}

	/**
	 * signin
	 */
	public function signinAction()
	{
        $this->layout('layout/layoutLogin');
		$redirect = trim($this->getRequest()->getQuery()->get('redirect'));
		if($this->user()->hasIdentity()) {
			if(!$redirect) {
				return $this->redirect()->toRoute('home');
			}
			return $this->redirect()->toUrl($redirect);
		}
		/* @var $sl \Zend\ServiceManager\ServiceLocatorInterface */
		$sl = $this->getServiceLocator();
	
		/* @var $form \User\Form\Signin */
		$form = $this->getServiceLocator()->get('User\Form\Signin');
		$form->setInputFilter($this->getServiceLocator()->get('User\Form\SigninFilter'));
	
		if($this->getRequest()->isPost()) {
			$data = $this->getRequest()->getPost();
			$form->setData($this->getRequest()->getPost());
			if($form->isValid()) {
				$username = $form->getInputFilter()->getValue('username');
				$password = $form->getInputFilter()->getValue('password');
				/* @var $serviceUser \User\Service\User */
				$serviceUser = $this->getServiceLocator()->get('User\Service\User');
//                echo $_SERVER['HTTP_HOST'];die;

                // @todo show captcha after signing 3 times failed
				if(!$serviceUser->authenticate($username, $password)) {
					$form->showInvalidMessage();
				} else {
                    /* @var $user \User\Model\User */
					$user = $serviceUser->getUser();
					if(!$user->getLocked() && $user->getActive()) {
                        $sl = $this->getServiceLocator();
                        $domainMapper = $sl->get('Admin\Model\DomainMapper');
                        $domain = new \Admin\Model\Domain();
                        $domain->setStoreId($user->getStoreId());
                        $rd = $domainMapper->get($domain);
						if($user->getRole() == 1 || $user->getRole() == 2) {
                            return $this->redirect()->toUrl('http://'.($rd->getName() ? $rd->getName().'/admin':$rd->getAlias().'/admin'));
						} else {
                            return $this->redirect()->toRoute('home');
						}
                    }
					if($user->getLocked()) {
                        $this->user()->signout();
						$form->showInvalidMessage(\User\Form\Signin::ERROR_LOCKED);
					}
					if(!$user->getActive()) {
                        $this->user()->signout();
                        $form->showInvalidMessage(\User\Form\Signin::ERROR_INACTIVE);
					}
				}
			}
		}
		$viewModel = new ViewModel(array(
				'form' => $form
		));
		if($this->params()->fromQuery('layout')=='false')
		{
			$viewModel->setTerminal(true);
		}
		return $viewModel;
	}
    /**
     * signout
     */
	public function signoutAction()
    {
    	$this->user()->signout();
        $url = $this->getRequest()->getQuery('redirect');
        if ($url) $this->redirect()->toRoute($url);
    	else return $this->redirect()->toRoute('home');
    }
    
    
	
    /**
     * signup
     */
    public function signupAction()
    {
//    	$this->layout('layout/admin');
		if($this->user()->hasIdentity()) {
			return $this->redirect()->toRoute('home');
		}

    	$user = new \User\Model\User();
		$userMapper = $this->getServiceLocator()->get('User\Model\UserMapper');
        $storeId = $this->getServiceLocator()->get('Store\Service\Store')->getStoreId();

        /* @var $form \User\Form\Signup */
		$form = $this->getServiceLocator()->get('User\Form\Signup');
		$form->setInputFilter($this->getServiceLocator()->get('User\Form\SignupFilter'));
    	$form->bind($user);

    	$viewModel = new ViewModel();
        if($this->params()->fromQuery('layout') == 'false')
        {
            $viewModel->setTerminal(true);
        }
    	if($this->getRequest()->isPost()) {
    		$form->setData($this->getRequest()->getPost());
    		if($form->isValid()) {
    			/* @var $serviceUser \User\Service\User */
                $serviceUser = $this->getServiceLocator()->get('User\Service\User');
                $user->setStoreId($storeId);
                $user->setCreatedDateTime(DateBase::getCurrentDateTime());
                $user->setActive(\User\Model\User::STATUS_INACTIVE);
                $user->setRole(\User\Model\User::ROLE_MEMBER);
                $serviceUser->signup($user);
                $viewModel->setVariable('success', true);
            }
            else{
                $viewModel->setVariable('success', false);
            }
        }
    	$viewModel->setVariable('form', $form);
		return $viewModel;
    }

     public function addAction(){
//     	$this->layout('layoutAdmin/layout');
//     	$user = new \User\Model\User();
//     	$mapper = $this->getServiceLocator()->get('User\Model\UserMapper');

     	/* @var $form \User\Form\Signup */
//     	$form = $this->getServiceLocator()->get('User\Form\Signup');
//     	$form->setInputFilter($this->getServiceLocator()->get('User\Form\SignupFilter'));
//         $fFilter = $this->getServiceLocator()->get('Admin\Form\MediaFilter');
//         $form = $this->getServiceLocator()->get('Admin\Form\Media');
//         $form->setInputFilter($fFilter);
//     	$form->bind($user);
     	if($this->getRequest()->isPost()){
//            $form->setData($this->getRequest()->getPost());
            $data = array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray());

            print_r($data);die;

//     		if($form->isValid()){
//     			$serviceUser = $this->getServiceLocator()->get('User\Service\User');
//     			$serviceUser->signup($user);
//     			$this->redirect('/user/signin');
//     		}
     	}
//     	return  new ViewModel(array(
//     		'form' => $form
//     	));
    	
     }
    public function editAction(){
    	$this->layout('layoutAdmin/layout');
    	$id = $this->getEvent()->getRouteMatch()->getParam('id');
    	$mapper = $this->getServiceLocator()->get('User\Model\UserMapper');
    	
    	if(($user = $mapper->get($id)) === null){
    		$this->redirect()->toUrl('/user');
    	}
    	$fFilter = $this->getServiceLocator()->get('User\Form\SignupFilter');
    	$fFilter->setExcludedId($id);
    	$form = $this->getServiceLocator()->get('User\Form\Signup');
    	$form->setInputFilter($fFilter);
    	$form->bind($user);
    	
    	if($this->getRequest()->isPost()){
    		$form->setData($this->getRequest()->getPost());
    		if($form->isValid()){
    			$user->exchangeArray((array) $this->getRequest()->getPost());
    			$mapper = $this->getServiceLocator()->get('User\Model\UserMapper');
    			$mapper->save($user);
    			$this->redirect()->toUrl('/user');
    		}
    	}
    	return new ViewModel(array(
    		'form' => $form
    	));
    	
    }
    
    
    
    public function changelockAction() {
    	$this->layout('layoutAdmin/layout');
    	$id = (int) $this->getEvent()->getRouteMatch()->getParam('id');
    	if (!$id) {
    		return new JsonModel(array(
    				'code' => 0,
    				'messages' => array('Y??u c???u kh??ng h???p l???'),
    		));
    	}
    	$sl = $this->getServiceLocator();
    	$userService = $this->getServiceLocator()->get('User\Service\User');
    
    	$mapper = $this->getServiceLocator()->get('User\Model\UserMapper');
    	if(($user = $mapper->get($id)) === null) {
    		return new JsonModel(array(
    				'code' => 0,
    				'messages' => array('Ta??i khoa??n kh??ng t???n t???i trong h??? th???ng'),
    		));
    	}
    	/* @var $model \User\Model\User */
    	if($user->getLock() == \User\Model\User::STATUS_LOCKED) {
    		$user->setLock(\User\Model\User::STATUS_UNLOCKED);
    	} else {
    		$user->setLock(\User\Model\User::STATUS_LOCKED);
    	}
//     	$serviceUser = $this->getServiceLocator()->get('User\Service\User');
//     	$serviceUser->signup($user);
		$mapper->save($user);
    	$this->redirect()->toUrl('/user');
    }

    public function changeactiveAction(){
    	$this->layout('layoutAdmin/layout');
    	$id = $this->getEvent()->getRouteMatch()->getParam('id');
    	$mapper = $this->getServiceLocator()->get('User\Model\UserMapper');
    	$user = $mapper->get($id);
    	
    	if($user->getActive() == \User\Model\User::STATUS_ACTIVE){
    		$user->setActive(\User\Model\User::STATUS_INACTIVE);
    	}
    	else {
    		$user->setActive(\User\Model\User::STATUS_ACTIVE);
    	}
    	$mapper->save($user);
    	$this->redirect()->toUrl('/user');
    }

//     public function ajaxsignupAction() {
//     	if($this->getRequest()->isPost()) {
//     		$translator = $this->getServiceLocator()->get('translator');
//     		$user = new \User\Model\User();
//     		/* @var $userMapper \User\Model\UserMapper */
//     		$userMapper = $this->getServiceLocator()->get('User\Model\UserMapper');
//             /* @var $serviceUser \User\Service\User */
//     		$serviceUser = $this->getServiceLocator()->get('User\Service\User');
// 			$data = $this->getRequest()->getPost();
// 			$user->exchangeArray((array)$data);
// 			if(!isset($data['rePassword']) || $data['password'] != $data['rePassword']){
// 				$error = array('rePassword' => $translator->translate('G?? l???i m???t kh???u kh??ng ch??nh x??c'));
// 				return new JsonModel(array('code' => 0, 'message' => $error));
// 			}
// 			if(count($error = $serviceUser->validateSignupInfo($user))) {
// 				return new JsonModel(array('code' => 0, 'message' => $error));
// 			}

// 			$serviceUser->signup($user);
// 			$message= $translator->translate('Ch??c m???ng b???n ????ng k?? t??i kho???n th??nh c??ng, vui l??ng ki???m tra l???i email ????ng k?? ????? l???y link k??ch ho???t t??i kho???n!');
// 			return new JsonModel(array('code' => 1, 'message' => $message));

// 			$response = $this->getResponse();
// 			$response->setContent("Some content");
// 			return $response;

//     	}

//     }

//     public function ajaxsigninAction() {
//     	if($this->getRequest()->isPost()) {
//     		$translator = $this->getServiceLocator()->get('translator');
//     		$user = new \User\Model\User();
//     		/* @var $userMapper \User\Model\UserMapper */
//     		$userMapper = $this->getServiceLocator()->get('User\Model\UserMapper');
//             /* @var $serviceUser \User\Service\User */
//     		$serviceUser = $this->getServiceLocator()->get('User\Service\User');
//     		$data = $this->getRequest()->getPost();
//     		$user->exchangeArray((array)$data);
//     		if(count($error = $serviceUser->validateSigninInfo($user))) {
//     			return new JsonModel(array('code' => 0, 'message' => $error));
//     		}
//             return new JsonModel(array('code' => 1, 'user' => $serviceUser->getUser()->toStd()));
//     	}
//     }

//     /**
//      *
//      */
//     public function getactivecodeAction()
//     {
// 		/*@var $userMapper \User\Model\UserMapper() */
// 		$userMapper = $this->getServiceLocator()->get('User\Model\UserMapper');
// 		/*@var $userService \User\Service\User() */
// 		$userService = $this->getServiceLocator()->get('User\Service\User');
// 		/*@var $form \User\Form\GetActiveCodeForm() */
// 		$form = $this->getServiceLocator()->get('User\Form\GetActiveCode');
// 		$form->setInputFilter($this->getServiceLocator()->get('User\Form\GetActiveCodeFilter'));
// 		$message = '';

// 		if($this->getRequest()->isPost()) {
// 			$form->setData($this->getRequest()->getPost());
// 			if($form->isValid()) {
// 				$validator = new \Zend\Validator\EmailAddress();
// 				$user = new \User\Model\User();
// 				$translator = $this->getServiceLocator()->get('translator');
// 				if($validator->isValid($this->getRequest()->getPost('inputStr')) && $this->getRequest()->getPost('captcha')) {
// 					$user->setEmail($this->getRequest()->getPost('inputStr'));
// 				} else {
// 					$user->setUsername($this->getRequest()->getPost('inputStr'));
// 				}
// 				$us = $userMapper->get(null, $user->getUsername(), $user->getEmail());
// 				if(!$us) {
// 					$message ='<p class="error">'.$translator->translate('?????a ch??? email ho???c t??n ????ng nh???p kh??ng ch??nh x??c').'</p>';
// 				} else if ($us->getActive()!=null) {
// 					$message='<p class="error">'.$translator->translate('T??i kho???n c???a b???n ???? ???????c k??ch ho???t').'</p>';
// 				} else {
// 					$userService->sendActiveLink($user);
// 					$message = '<p>'.$translator->translate('X??c nh???n g???i l???i link k??ch ho???t t??i kho???n th??nh c??ng, vui l??ng ki???m tra l???i ?????a ch??? email c???a b???n ????? nh???n link k??ch ho???t t??i kho???n').'</p>';
// 				}
// 			}
// 		}

// 		$viewModel = new ViewModel(array(
// 			'form' => $form,
// 			'message' => $message
// 		));
// 		return $viewModel;
//     }
//     /**
//      * active user
//      */
     public function activeAction()
     {
     	$message = '';
     	$userName = $this->getRequest()->getQuery()->get('u');
     	$activeKey = $this->getRequest()->getQuery()->get('c');
     	if(!$userName || !$activeKey) {
     		$this->redirect()->toUrl('/');
     	}
     	/* @var $userMapper \User\Model\UserMapper */
     	$userMapper = $this->getServiceLocator()->get('User\Model\UserMapper');
     	$user = new \User\Model\User();
     	$translator = $this->getServiceLocator()->get('translator');
     	$user->setActiveKey($activeKey);
     	$user->setUsername($userName);
     	if($userMapper->activeUser($user)) {
     		$message = $translator->translate('Ch??c m???ng b???n ???? k??ch ho???t t??i kho???n th??nh c??ng');
     	}
     	else {
     		$message = $translator->translate('T??i kho???n kh??ng t???n t???i');
     	}

     	return new ViewModel(array('message'=>$message));
     }

    public function changepasswordAction()
    {
        $sl = $this->getServiceLocator();
        /* @var $form \User\Form\ChangePassword */
        $userService = $sl->get('User\Service\User');
        /* @var $userService \User\Service\User */
        $user = $userService->getUser();
        $form = $sl->get('User\Form\ChangePassword');
        $translator = $sl->get('translator');
        /*@var $inputFilter \User\Form\ChangePasswordFilter */
        $inputFilter = $sl->get('User\Form\ChangePasswordFilter');

        $form->setInputFilter($inputFilter);
        $message = '';
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                $postData = (array)$this->getRequest()->getPost();
                $us = new \User\Model\User();
                $us->setId($user->getId());
                $us->setPassword($postData['oldpassword']);
                if (!$userService->validateChangeInfo($us)) {
                    $message = '<p class="error">' . $translator->translate('M???t kh???u c?? nh???p kh??ng ch??nh x??c') . '</p>';
                } else {
                    $us->setId($user->getId());
                    $us->setPassword($postData['newpassword']);
                    $userService->updateUser($us);
                    $message = $translator->translate('?????i m???t kh???u t??i kho???n th??nh c??ng');
                }
            }
        }
        return new ViewModel(array(
            'form'    => $form,
            'message' => $message
        ));
    }
//     /**
//      * get password
//      */
//     public function getpasswordAction()
//     {
    
//     	$sl = $this->getServiceLocator();
//     	$translator = $this->getServiceLocator()->get('translator');
//     	$user = new \User\Model\User();
//     	/*@var $userMapper \User\Model\UserMapper() */
//     	$userMapper = $this->getServiceLocator()->get('User\Model\UserMapper');
//     	/*@var $userService \User\Service\User() */
//     	$userService = $this->getServiceLocator()->get('User\Service\User');
//     	/*@var $form \User\Form\GetActiveCodeForm() */
//     	$form = $this->getServiceLocator()->get('User\Form\GetActiveCode');
//     	$form->setInputFilter($this->getServiceLocator()->get('User\Form\GetActiveCodeFilter'));
//     	$message = '';
    
//     	if($this->getRequest()->isPost()) {
//     		$form->setData($this->getRequest()->getPost());
//     		if($form->isValid()) {
//     			$validator = new \Zend\Validator\EmailAddress();
//     			if($validator->isValid($this->getRequest()->getPost('inputStr'))){
//     				$user->setEmail($this->getRequest()->getPost('inputStr'));
//     			}
//     			else{
//     				$user->setUsername($this->getRequest()->getPost('inputStr'));
//     			}
//     			$us = $userMapper->get(null, $user->getUsername(), $user->getEmail());
//     			if(!$us) {
//     				$message ='<p class="error">'.$translator->translate('?????a ch??? email ho???c t??n ????ng nh???p kh??ng ch??nh x??c').'</p>';
//     			} elseif(!$us->getActive()){
//     				$message='<p class="error">'.$translator->translate('T??i kho???n c???a b???n ??ang b??? t???m kh??a').'</p>';
//     			}
//     			else{
//     				$userService->resetPassword($user);
//     				$message = '<p>'.$translator->translate('M???t kh???u t??i kho???n c???a b???n ???? ???????c reset, vui l??ng ki???m tra l???i email ????? l???y m???t kh???u m???i').'</p>';
//     			}
//     		}
//     	}
//     	$viewModel = new ViewModel(array(
//     			'form' => $form,
//     			'message' => $message
//     	));
//     	return $viewModel;
    
//     }

}