<?php 
namespace Admin\Controller; 

use Zend\Mvc\Controller\AbstractActionController; 
use Zend\View\Model\ViewModel;
use Home\Model\DateBase;


class QuestionController extends AbstractActionController
{ 
    public function indexAction() {
    	$this->layout('layout/admin');
        $sl = $this->getServiceLocator();
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();
        $questionMapper = $sl->get('Admin\Model\QuestionMapper');

        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        $questionView = new \Admin\Model\Question();
        if(!$this->user()->isSuperAdmin()) {
            if((int)$id){
                $questionView->setStoreId($storeId);
            }
        }
        $questionView->setId((int)$id);

        $viewModel = new ViewModel();
        $r = $questionMapper->get($questionView);

        if(!empty($r)) {
            $viewModel->setTemplate('admin/question/view');
        }

        $question = new \Admin\Model\Question();
        $question->setStoreId($storeId);
        $question->setStatus(\Admin\Model\Question::STATUS_NEW);
        $question->setCreatedById($u->getId());
        $question->setCreatedDateTime(DateBase::getCurrentDateTime());
        $question->setUpdateDateTime(DateBase::getCurrentDateTime());

        $form = new \Admin\Form\Question();
        if($this->getRequest()->isPost()) {
            $form->setData(array_merge_recursive($this->getRequest()->getPost()->toArray(),$this->getRequest()->getFiles()->toArray()));
            if($form->isValid()){
                $data = $form->getData();
                $question->exchangeArray($data);
                $questionMapper->save($question);
                $this->redirect()->toUrl('/admin/question');
            }
        }
        $question->exchangeArray((array)$this->getRequest()->getQuery());
        $options['isAdmin'] = $this->user()->isSuperAdmin();

        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $results = $questionMapper->search($question, array($page, 20));

        $viewModel->setVariables(array(
            'form' => $form,
            'results' => $results,
            'view' => $r,
        ));

        return $viewModel;
    }

    public function viewAction() {

        $this->layout('layout/admin');
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $sl = $this->getServiceLocator();
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();
        $questionMapper = $sl->get('Admin\Model\QuestionMapper');

        $question = new \Admin\Model\Question();
        if(!$this->user()->isSuperAdmin()) {
            $question->setStoreId($storeId);
        }
        $question->setId((int)$id);

        $viewModel = new ViewModel();

        $r = $questionMapper->get($question);
        if(empty($r)) {
            $viewModel->setTemplate('error/404');
        }

        $questionSearch = new \Admin\Model\Question();
        if(!$this->user()->isSuperAdmin()) {
            $questionSearch->setStoreId($storeId);
        }
        $questionSearch->exchangeArray((array)$this->getRequest()->getQuery());

        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $results = $questionMapper->search($questionSearch, array($page, 15));

        $viewModel->setVariables(array(
            'results' => $results,
            'view' => $r,
        ));
        return $viewModel;

    }

    public function taskAction() {
        $this->layout('layout/admin');
        $sl = $this->getServiceLocator();
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();
        $questionMapper = $sl->get('Admin\Model\QuestionMapper');

        $viewModel = new ViewModel();

        $questionSearch = new \Admin\Model\Question();
        if(!$this->user()->isSuperAdmin()) {
            $questionSearch->setAssignId($u->getId());
        }
        $questionSearch->exchangeArray((array)$this->getRequest()->getQuery());

        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $results = $questionMapper->search($questionSearch, array($page, 20));

        $viewModel->setVariables(array(
            'results' => $results,
        ));
        return $viewModel;
    }


}