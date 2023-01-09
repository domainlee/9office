<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Home\Model\DateBase;


class StoreController extends AbstractActionController{

	public function indexAction(){
		$this->layout('layout/admin');
		$store = new \Admin\Model\Store();
		$storeMapper = $this->getServiceLocator()->get('Admin\Model\StoreMapper');
        $store->exchangeArray((array)$this->getRequest()->getQuery());
		$fFilter = new \Admin\Form\StoreSearch();
		$fFilter->bind($store);
		$page = (int)$this->getRequest()->getQuery()->page ? : 1;
		$results = $storeMapper->search($store, array($page, 30));
		return new ViewModel(array(
			'fFilter' => $fFilter,
			'results' => $results,
            'url' => $this->getRequest()->getUri()->getQuery()
        ));
	}

    public function addAction()
    {
        $this->layout('layout/admin');
        $sl = $this->getServiceLocator();
        $storeMapper = $sl->get('Admin\Model\StoreMapper');
        $store = new \Admin\Model\Store();
        $store->setStatus(1);
        $form = new \Admin\Form\Store($this->getServiceLocator(), null);
        if($this->getRequest()->isPost()){
            $form->setData($this->getRequest()->getPost()->toArray());
            if($form->isValid($edit = 2)){
                $data = $form->getData();
                $store->exchangeArray($data);
                $storeMapper->save($store);
                $this->redirect()->toUrl('/admin/store');
            }
        }

        return new ViewModel(array(
            'form' => $form,
        ));
    }

	public function editAction()
    {
        $this->layout('layout/admin');
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $sl = $this->getServiceLocator();
        $storeMapper = $sl->get('Admin\Model\StoreMapper');
        $store = new \Admin\Model\Store();
        $store->setId($id);
        if(!$storeMapper->get($store)){
            $this->redirect()->toUrl('/admin/store');
        }

        $data = $store->toFormValues();
        $form = new \Admin\Form\Store($this->getServiceLocator(), null);
        $form->setData($data);

        if($this->getRequest()->isPost()){
            $form->setData($this->getRequest()->getPost()->toArray());
            if($form->isValid()){
                $data = $form->getData();
                $store->exchangeArray($data);
                $storeMapper->save($store);
                $this->redirect()->toUrl('/admin/store');
            }
        }

        return new ViewModel(array(
            'form' => $form,
        ));
	}

    public function domainAction(){
        $this->layout('layout/admin');
        $domain = new \Admin\Model\Domain();
        $domainMapper = $this->getServiceLocator()->get('Admin\Model\DomainMapper');
        $domain->exchangeArray((array)$this->getRequest()->getQuery());
        $fFilter = new \Admin\Form\StoreSearch();
        $fFilter->bind($domain);
        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $results = $domainMapper->search($domain, array($page, 30));
        return new ViewModel(array(
            'fFilter'=>$fFilter,
            'results'=>$results,
            'url' => $this->getRequest()->getUri()->getQuery()
        ));
    }

    public function adddomainAction()
    {
        $this->layout('layout/admin');
        $sl = $this->getServiceLocator();
        $domainMapper = $sl->get('Admin\Model\DomainMapper');
        $domain = new \Admin\Model\Domain();
        $domain->setCreatedDateTime(DateBase::getCurrentDateTime());
        $form = new \Admin\Form\Domain();
        if($this->getRequest()->isPost()){
            $form->setData($this->getRequest()->getPost()->toArray());
            if($form->isValid()){
                $data = $form->getData();
                $domain->exchangeArray($data);
                if(!empty($data['storeId'][0])) {
                    $domain->setStoreId($data['storeId'][0]);
                }
                if(!empty($data['uitemplateId'][0])) {
                    $domain->setUitemplateId($data['uitemplateId'][0]);
                }
                $domainMapper->save($domain);
                $this->redirect()->toUrl('/admin/store/domain');
            }
        }

        return new ViewModel(array(
            'form' => $form,
        ));
    }

    public function editdomainAction()
    {
        $this->layout('layout/admin');
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $sl = $this->getServiceLocator();
        $domainMapper = $sl->get('Admin\Model\DomainMapper');
        $domain = new \Admin\Model\Domain();
        $domain->setId($id);
        if(!$domainMapper->get($domain)){
            $this->redirect()->toUrl('/admin/store/domain');
        }

        $st = [];
        if($domain->getStoreId()) {
            $storeMapper = $sl->get('Admin\Model\StoreMapper');
            $store = new \Admin\Model\Store();
            $store->setId($domain->getStoreId());
            if(!empty($storeMapper->get($store))) {
                $st[$store->getId()] = ['label' => $store->getName(), 'value' => $store->getId(), 'selected' => true];
            }
        }

        $ar = [];
        if($domain->getUitemplateId()) {
            $templateMapper = $sl->get('Admin\Model\TemplateMapper');
            $template = new \Admin\Model\Template();
            $template->setId($domain->getUitemplateId());
                if(!empty($templateMapper->get($template))) {
                    $ar[$template->getId()] = ['label' => $template->getDirectory(), 'value' => $template->getId(), 'selected' => true];
                }
        }
        $data = $domain->toFormValues();
        $form = new \Admin\Form\Domain();
        $form->setStore($st);
        $form->setTemplate($ar);
        $form->setData($data);

        $templateId = $data['uitemplateId'];

        if($this->getRequest()->isPost()){
            $form->setData($this->getRequest()->getPost()->toArray());
            if($form->isValid()){
                $data = $form->getData();
                $domain->exchangeArray($data);
                if(!empty($data['storeId'][0])) {
                    $domain->setStoreId($data['storeId'][0]);
                }
                if(!empty($data['uitemplateId'][0])) {
                    $domain->setUitemplateId($data['uitemplateId'][0]);
                    if($templateId != $data['uitemplateId'][0]) {
                        $domain->setOptionPage(null);
                    }
                }
                $domainMapper->save($domain);
                $this->redirect()->toUrl('/admin/store/domain');
            }
        }

        return new ViewModel(array(
            'form' => $form,
        ));
    }

    public function templateAction(){
        $this->layout('layout/admin');
        $template = new \Admin\Model\Template();
        $templateMapper = $this->getServiceLocator()->get('Admin\Model\TemplateMapper');
        $template->exchangeArray((array)$this->getRequest()->getQuery());
        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $results = $templateMapper->search($template, array($page, 30));
        return new ViewModel(array(
            'results' => $results,
            'url' => $this->getRequest()->getUri()->getQuery()
        ));
    }

    public function addtemplateAction(){
        $this->layout('layout/admin');
        $sl = $this->getServiceLocator();

        $template = new \Admin\Model\Template();
        $templateMapper = $sl->get('Admin\Model\TemplateMapper');

        $form = new \Admin\Form\Template($this->getServiceLocator(), null);
        if($this->getRequest()->isPost()){
            $form->setData($this->getRequest()->getPost()->toArray());
            if($form->isValid($edit = 2)){
                $data = $form->getData();
                $template->exchangeArray($data);
                $template->setName($template->getDirectory());
                $templateMapper->save($template);
                $this->redirect()->toUrl('/admin/store/template');
            }
        }

        return new ViewModel(array(
            'form' => $form,
        ));
    }

    public function edittemplateAction(){
        $this->layout('layout/admin');
        $sl = $this->getServiceLocator();
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $templateMapper = $sl->get('Admin\Model\TemplateMapper');
        $template = new \Admin\Model\Template();
        $template->setId($id);
        if(!$templateMapper->get($template)){
            $this->redirect()->toUrl('/admin/store/template');
        }
        $form = new \Admin\Form\Template($this->getServiceLocator(), null);
        $data = $template->toFormValues();
        $form->setData($data);

        if($this->getRequest()->isPost()){
            $form->setData($this->getRequest()->getPost()->toArray());
            if($form->isValid()){
                $data = $form->getData();
                $template->exchangeArray($data);
                $template->setName($template->getDirectory());
                $templateMapper->save($template);
                $this->redirect()->toUrl('/admin/store/template');
            }
        }

        return new ViewModel(array(
            'form' => $form,
        ));
    }



    public function deleteAction()
    {
        function deleteDir($dir) {
            if (is_dir($dir)) {
                $objects = scandir($dir);
                foreach ($objects as $object) {
                    if ($object != "." && $object != "..") {
                        if (filetype($dir."/".$object) == "dir")
                            deleteDir($dir."/".$object);
                        else unlink   ($dir."/".$object);
                    }
                }
                reset($objects);
                rmdir($dir);
            }
        }

        $id = $this->getRequest()->getPost()['id'];
        if(!is_numeric($id)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy sản phẩm này'
            ));
        }
        $sl = $this->getServiceLocator();
        $domainMapper = $sl->get('Admin\Model\DomainMapper');
        $domain = new \Admin\Model\Domain();
        $domain->setId($id);
        if(!$domainMapper->get($domain)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy doanh nghiệp này'
            ));
        }
        $domainMapper->deleteStore($domain->getStoreId());
        deleteDir(UPLOAD_PATH . '/media/'.$domain->getStoreId());
        return new JsonModel(array(
            'code'=> 1,
            'messenger' => 'Đã xoá'
        ));
    }



}




















