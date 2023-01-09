<?php 
namespace Admin\Controller; 

use Zend\Mvc\Controller\AbstractActionController; 
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;


class AdminController extends AbstractActionController
{ 
    public function indexAction() {
    	$this->layout('layout/admin');
        $serviceUser = $this->getServiceLocator()->get('User\Service\User');
//        print_r($serviceUser->getIdentity());die;

        $model = new \Admin\Model\Article();
        $mapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
        $sl = $this->getServiceLocator();
        $u = $this->getServiceLocator()->get('User\Service\User');
//        $storeId = 23;
        $userName = $u->getUser()->getUserName() ? $u->getUser()->getUserName():$u->getUser()->getEmail();
        $storeId = $u->getStoreId();

        $model->exchangeArray((array)$this->getRequest()->getQuery());
        $options['isAdmin'] = $this->user()->isSuperAdmin();
        $fFilter = new \Admin\Form\ArticleSearch($options);
        $model->setStoreId($storeId);
        $model->setStatus(1);

        $fFilter->bind($model);

        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $results = $mapper->search($model, array($page,6));

        return new ViewModel(array(
            'UserName' => $userName,
            'fFilter' => $fFilter,
            'results' => $results,
            'url' => $this->getRequest()->getUri()->getQuery()
        ));
    }

    public function huongdanAction()
    {
        $this->layout('layout/guide');
        return new ViewModel(array(
            'url' => $this->getRequest()->getUri()->getQuery()
        ));
    }

    public function optionadminAction() {
        $request = $this->getRequest();
        $menu = $request->getPost()['menuleft'];
        if($menu) {
            if($_COOKIE["menuleft"]) {
                setcookie('menuleft', '', time()-31556926, '/');
            } else {
                setcookie('menuleft', 1, time()+31556926, '/');
            }
        }

        return new JsonModel(array(
            'code'=> 1,
            'messenger' => 'Thành công'
        ));
    }
}