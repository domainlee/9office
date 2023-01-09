<?php

namespace Admin\Controller;

use Admin\Model\User;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Home\Model\DateBase;


class UserController extends AbstractActionController{

	public function indexAction() {
		$this->layout('layout/admin');

        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $userMapper = $this->getServiceLocator()->get('Admin\Model\UserMapper');
        $user = new \Admin\Model\User();

        if(!$this->user()->isSuperAdmin()){
            $user->setStoreId($storeId);
        }

        $user->setParentStore($storeId);

        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $results = $userMapper->search($user, array($page,20));

        return new ViewModel(array(
            'results' => $results,
            'url' => $this->getRequest()->getUri()->getQuery()
        ));
    }

	public function addAction()
    {
        $this->layout('layout/admin');
        $u = $this->getServiceLocator()->get('User\Service\User');
        $authorize = $this->getServiceLocator()->get('Authorize\Service\Authorize');
        $storeId = $u->getStoreId();
        $userMapper = $this->getServiceLocator()->get('Admin\Model\UserMapper');
        $user = new \Admin\Model\User();
        $user->setStoreId($storeId);
        $user->setRole(User::ROLE_ADMIN);
        $user->setCreatedDateTime(DateBase::getCurrentDateTime());
        $user->setActive(User::STATUS_ACTIVE);
        $listDependencies = $authorize->getAcl()->getDependencies();

        $form = new \Admin\Form\User($this->getServiceLocator(), null);

        if($this->getRequest()->isPost()){
            $form->setData($this->getRequest()->getPost());
            if($form->isValid($edit = 2)) {
                $data = $form->getData();
                $dep = $this->getRequest()->getPost();
                $user->exchangeArray($data);
                if(!empty($data['storeId'][0]) && $this->user()->isSuperAdmin()) {
                    $user->setStoreId($data['storeId'][0]);
                }
                if(!$this->user()->isSuperAdmin()) {
                    $user->setStoreId($storeId);
                }
                $user->setSalt(substr(md5(rand(2000, 5000) . time() . rand(2000, 5000)), 0, 20));
                $user->setPassword(md5($user->getSalt() . $user->getPassword()));
                if(!empty($dep)) {
                    $de = [];
                    foreach($dep as $k => $v) {
                        $kE = explode('_',$k);
                        if($kE[0] == 'tai-khoan') {
                            $de['user'][$kE[1]] = $kE[1];
                        }
                        if($kE[0] == 'trang') {
                            $de['page'][$kE[1]] = $kE[1];
                        }
                        if($kE[0] == 'cai-dat') {
                            $de['setup'][$kE[1]] = $kE[1];
                        }
                        if($kE[0] == 'hinh-anh') {
                            $de['media'][$kE[1]] = $kE[1];
                        }
                        if($kE[0] == 'bai-viet') {
                            $de['article'][$kE[1]] = $kE[1];
                        }
                        if($kE[0] == 'san-pham') {
                            $de['product'][$kE[1]] = $kE[1];
                        }
                        if($kE[0] == 'question') {
                            $de['question'][$kE[1]] = $kE[1];
                        }
                    }
                    $user->setDependencies(json_encode($de));
                }
                $userMapper->save($user);
                $this->redirect()->toUrl('/admin/user');

            }
        }
        return new ViewModel(array(
            'form' => $form,
            'dependencies' => $listDependencies,
            'supperAdmin' => $this->user()->isSuperAdmin(),
        ));

    }

	public function editAction()
    {
        $this->layout('layout/admin');
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $u = $this->getServiceLocator()->get('User\Service\User');
        $authorize = $this->getServiceLocator()->get('Authorize\Service\Authorize');
        $storeId = $u->getStoreId();
        $userMapper = $this->getServiceLocator()->get('Admin\Model\UserMapper');

        $user = new \Admin\Model\User();
        if(!$this->user()->isSuperAdmin()){
            $user->setStoreId($storeId);
            $user->setParentStore($storeId);
        }
        $user->setId((int)$id);
        if(empty($userMapper->get($user))){
            $this->redirect()->toUrl('/admin/user');
        }
        $listDependencies = $authorize->getAcl()->getDependencies();
        $form = new \Admin\Form\ForgotPassword($this->getServiceLocator(), null);
        $data = $user->toFormValues();
        $vDep = json_decode($data['dependencies'], true);

        if($this->getRequest()->isPost()){
            $form->setData($this->getRequest()->getPost());
            if($form->isValid($id)) {
                $data = $form->getData()+$data;
                $dep = $this->getRequest()->getPost();
                $user->exchangeArray($data);
                $user->setCreatedDateTime(DateBase::getCurrentDateTime());

                if(!empty($data['passwordNew'])) {
                    $user->setSalt(substr(md5(rand(2000, 5000) . time() . rand(2000, 5000)), 0, 20));
                    $user->setPassword(md5($user->getSalt() . $data['passwordNew']));
                }
                if(!empty($dep)) {
                    $de = [];
                    foreach($dep as $k => $v) {
                        $kE = explode('_',$k);
                        if($kE[0] == 'tai-khoan') {
                            $de['user'][$kE[1]] = $kE[1];
                        }
                        if($kE[0] == 'trang') {
                            $de['page'][$kE[1]] = $kE[1];
                        }
                        if($kE[0] == 'cai-dat') {
                            $de['setup'][$kE[1]] = $kE[1];
                        }
                        if($kE[0] == 'hinh-anh') {
                            $de['media'][$kE[1]] = $kE[1];
                        }
                        if($kE[0] == 'bai-viet') {
                            $de['article'][$kE[1]] = $kE[1];
                        }
                        if($kE[0] == 'san-pham') {
                            $de['product'][$kE[1]] = $kE[1];
                        }
                    }
                    $user->setDependencies(json_encode($de));
                }
                $userMapper->save($user);
                $this->redirect()->toUrl('/admin/user');

            }
        }
        return new ViewModel(array(
            'form' => $form,
            'dependencies' => $listDependencies,
            'vDep' => $vDep,
            'data' => $data,
        ));

	}

    public function changeAction()
    {
        $id = $this->getRequest()->getPost('id');

        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $mapper = $this->getServiceLocator()->get('Admin\Model\UserMapper');
        $user = new \Admin\Model\User();
        $user->setId($id);
        if(!$this->user()->isSuperAdmin()){
            $user->setStoreId($storeId);
        }

        if(!$mapper->get($user)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy tài khoản này'
            ));
        }

        if($user->getActive() == \Admin\Model\User::STATUS_ACTIVE){
            $user->setActive(\Admin\Model\User::STATUS_INACTIVE);
        }else{
            $user->setActive(\Admin\Model\User::STATUS_ACTIVE);
        }
        $mapper->save($user);

        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Đã thay đổi',
            'status' => $user->getActive()
        ));
    }

    public function deleteAction(){
        $id = $this->getRequest()->getPost()['id'];
        if(!is_numeric($id)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy tài khoản này'
            ));
        }

        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $mapper = $this->getServiceLocator()->get('Admin\Model\UserMapper');
        $user = new \Admin\Model\User();
        $user->setId($id);
        if(!$this->user()->isSuperAdmin()){
            $user->setStoreId($storeId);
        }
        $user->setParentStore($storeId);

        if(!$mapper->get($user)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy tài khoản này'
            ));
        }

        $mapper->delete($user);

        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Đã xóa'
        ));
    }

    public function domainAction() {
        $this->layout('layout/admin');
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $domain = new \Admin\Model\Domain();

        $domain->setStoreId($storeId);
        $domain->setParentStoreId($storeId);

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
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();

        $form = new \Admin\Form\Website($sl, null);

        if($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            if($form->isValid($edit = 2)){
                $data = $form->getData();

                /**** New storeId ****/
                $newStoreId = '';
                $store = new \Admin\Model\Store();
                $store->setName($data['store']);
                $storeMapper = $sl->get('Admin\Model\StoreMapper');
                $r = $storeMapper->get($store);
                if(!empty($r)) {
                    $newStoreId = $store->getId();
                } else {
                    $store = new \Admin\Model\Store();
                    $store->setName($data['store']);
                    $store->setStatus(1);
                    $storeMapper->save($store);
                    $newStoreId = $store->getId();
                }

                $template = new \Admin\Model\Template();
                $template->setId((int)$data['uitemplateId'][0]);
                $templateMapper = $sl->get('Admin\Model\TemplateMapper');
                $rTemplate = $templateMapper->get($template);
                if(!empty($rTemplate)) {
                    $data['storeClone'] = strtolower($template->getDirectory());
                } else {
                    $this->redirect()->toUrl('/admin/user/domain');
                }

                /**** Clone storeId ****/
                $store = new \Admin\Model\Store();
                $store->setName($data['storeClone']);
                $r = $storeMapper->get($store);
                if(!$r) {
                    $this->redirect()->toUrl('/admin/user/domain');
                }
                $cloneStoreId = $store->getId();

                /**** Category Article ****/
                $articleCategoryMapper = $sl->get('Admin\Model\ArticlecMapper');
                $articleCategory = new \Admin\Model\Articlec();
                $articleCategory->setStoreId($cloneStoreId);
                $ac = $articleCategoryMapper->fetchAll($articleCategory);
                if(!empty($ac)) {
                    foreach($ac as $k => $c) {
                        $c->setId(null);
                        $c->setStoreId($newStoreId);
                        $articleCategoryMapper->save($c);
                    }
                }

                /**** Update ParentId Category Article ***/
                $articleCategory = new \Admin\Model\Articlec();
                $articleCategory->setStoreId($newStoreId);
                $ac = $articleCategoryMapper->fetchAll($articleCategory);
                if(!empty($ac)) {
                    foreach($ac as $k => $c) {
                        if($c->getParentId()){
                            $articleCategory = new \Admin\Model\Articlec();
                            $articleCategory->setId($c->getParentId());
                            $r = $articleCategoryMapper->get($articleCategory);
                            if(!empty($r)) {
                                $articleCategory1 = new \Admin\Model\Articlec();
                                $articleCategory1->setStoreId($newStoreId);
                                $articleCategory1->setName($articleCategory->getName());
                                $r = $articleCategoryMapper->get($articleCategory1);
                                if(!empty($r)) {
                                    $c->setParentId($articleCategory1->getId());
                                }
                            }
                        }
                        $articleCategoryMapper->save($c);
                    }
                }

                /**** Article ****/
                $articleMapper = $sl->get('Admin\Model\ArticleMapper');
                $article = new \Admin\Model\Article();
                $article->setStoreId($cloneStoreId);
                $a = $articleMapper->fetchAll($article);
                if(!empty($a)) {
                    foreach($a as $k => $c) {
                        $articleCategory = new \Admin\Model\Articlec();
                        $articleCategory->setId($c->getCategoryId());
                        $r = $articleCategoryMapper->get($articleCategory);
                        if(!empty($r)) {
                            $articleCategory1 = new \Admin\Model\Articlec();
                            $articleCategory1->setName($articleCategory->getName());
                            $articleCategory1->setStoreId($newStoreId);
                            $r = $articleCategoryMapper->get($articleCategory1);
                            if(!empty($r)) {
                                $c->setCategoryId($articleCategory1->getId());
                            }
                        }
                        $c->setId(null);
                        $c->setStoreId($newStoreId);
                        $articleMapper->save($c);
                    }
                }

                /**** Banner ****/
                $bannerMapper = $sl->get('Admin\Model\BannerMapper');
                $banner = new \Admin\Model\Banner();
                $banner->setStoreId($cloneStoreId);
                $b = $bannerMapper->fetchAll($banner);
                if(!empty($b)) {
                    foreach($b as $k => $o) {
                        $o->setId(null);
                        $o->setStoreId($newStoreId);
                        $o->setLink(null);
                        if($o->getImage()){
                            $i = json_decode($o->getImage(), true);
                            if(!empty($i)) {
                                $rj = [];
                                foreach($i as $k => $image) {
                                    $r = explode('/', $image);
                                    $r[3] = $newStoreId;
                                    $rj[$k] = implode('/', $r);
                                }
                                $o->setImage(json_encode($rj));
                            }
                        }
                        $bannerMapper->save($o);
                    }
                }

                /**** Brand ****/
                $brandMapper = $sl->get('Admin\Model\BrandMapper');
                $brand = new \Admin\Model\Brand();
                $brand->setStoreId($cloneStoreId);
                $b = $brandMapper->fetchAll($brand);
                if(!empty($b)) {
                    foreach($b as $k => $o) {
                        $o->setId(null);
                        $o->setStoreId($newStoreId);
                        $brandMapper->save($o);
                    }
                }
                /**** Media ****/
                $mediaMapper = $sl->get('Admin\Model\MediaMapper');
                $media = new \Admin\Model\Media();
                $media->setStoreId($cloneStoreId);
                $m = $mediaMapper->fetchAll($media);
                if(!empty($m)) {
                    foreach($m as $k => $b) {
                        $b->setId(null);
                        $b->setStoreId($newStoreId);
                        $mediaMapper->save($b);
                    }
                }

                /**** Option ****/
                $optionMapper = $sl->get('Admin\Model\OptionMapper');
                $option = new \Admin\Model\Menu();
                $option->setStoreId($cloneStoreId);
                $o = $optionMapper->fetchAll($option);
                if(!empty($o)) {
                    foreach($o as $k => $b) {
                        $b->setId(null);
                        $b->setStoreId($newStoreId);
                        if(!empty($b->getData())) {
                            $a = json_decode($b->getData(), true);
                            $a['domain'] = null;
                            $a['google'] = null;
                            $a['facebook'] = null;
                            $a['youtube'] = null;
                            $a['twitter'] = null;
                            $a['GoogleAnalyticsId'] = null;
                            $l = explode('/', $a['logo']);
                            $l[3] = $newStoreId;
                            $a['logo'] = implode('/', $l);
                            $f = explode('/', $a['favicon']);
                            $f[3] = $newStoreId;
                            $a['favicon'] = implode('/', $f);
                            $b->setData(json_encode($a));
                        }
                        $optionMapper->save($b);
                    }
                }

                /**** Page ****/
                $pageMapper = $sl->get('Admin\Model\PageMapper');
                $page = new \Admin\Model\Page();
                $page->setStoreId($cloneStoreId);
                $p = $pageMapper->fetchAll($page);
                if(!empty($p)) {
                    foreach($p as $k => $v) {
                        $v->setId(null);
                        $v->setStoreId($newStoreId);
                        $pageMapper->save($v);
                    }
                }

                /**** Category Product ****/
                $productCategoryMapper = $sl->get('Admin\Model\ProductcMapper');
                $productCategory = new \Admin\Model\Productc();
                $productCategory->setStoreId($cloneStoreId);
                $ac = $productCategoryMapper->fetchAll($productCategory);
                if(!empty($ac)) {
                    foreach($ac as $k => $c) {
                        $c->setId(null);
                        $c->setStoreId($newStoreId);

                        if($c->getImage()){
                            $i = json_decode($c->getImage(), true);
                            if(!empty($i)) {
                                $rj = [];
                                foreach($i as $k => $image) {
                                    $r = explode('/', $image);
                                    $r[3] = $newStoreId;
                                    $rj[$k] = implode('/', $r);
                                }
                                $c->setImage(json_encode($rj));
                            }
                        }
                        $productCategoryMapper->save($c);
                    }
                }

                /**** Update ParentId Category Product ***/
                $productCategory = new \Admin\Model\Productc();
                $productCategory->setStoreId($newStoreId);
                $pc = $productCategoryMapper->fetchAll($productCategory);
                if(!empty($pc)) {
                    foreach($pc as $k => $c) {
                        if($c->getParentId()){
                            $productCategory2 = new \Admin\Model\Productc();
                            $productCategory2->setId($c->getParentId());
                            $r = $productCategoryMapper->get($productCategory2);
                            if(!empty($r)) {
                                $productCategory1 = new \Admin\Model\Productc();
                                $productCategory1->setStoreId($newStoreId);
                                $productCategory1->setName($productCategory2->getName());
                                $r = $productCategoryMapper->get($productCategory1);
                                if(!empty($r)) {
                                    $c->setParentId($productCategory1->getId());
                                }
                            }
                        }
                        $productCategoryMapper->save($c);
                    }
                }

                /**** Product ****/
                $productMapper = $sl->get('Admin\Model\ProductMapper');
                $product = new \Admin\Model\Product();
                $product->setStoreId($cloneStoreId);
                $a = $productMapper->fetchAll($product);
                if(!empty($a)) {
                    foreach($a as $k => $c) {
                        if($c->getCategoryId()) {
                            $productCategory = new \Admin\Model\Productc();
                            $productCategory->setId($c->getCategoryId());
                            $r = $productCategoryMapper->get($productCategory);
                            if(!empty($r)) {
                                $productCategory1 = new \Admin\Model\Productc();
                                $productCategory1->setName($productCategory->getName());
                                $productCategory1->setStoreId($newStoreId);
                                $r = $productCategoryMapper->get($productCategory1);
                                if(!empty($r)) {
                                    $c->setCategoryId($productCategory1->getId());
                                }
                            }
                        }
                        if($c->getBrandId()) {
                            $brand = new \Admin\Model\Brand();
                            $brand->setId($c->getBrandId());
                            $r = $brandMapper->get($brand);
                            if(!empty($r)) {
                                $brand1 = new \Admin\Model\Brand();
                                $brand1->setName($brand->getName());
                                $brand1->setStoreId($newStoreId);
                                $r = $brandMapper->get($brand1);
                                if(!empty($r)) {
                                    $c->setBrandId($brand1->getId());
                                }
                            }
                        }
                        if($c->getImage()){
                            $i = json_decode($c->getImage(), true);
                            if(!empty($i)) {
                                $rj = [];
                                foreach($i as $k => $image) {
                                    $r = explode('/', $image);
                                    $r[3] = $newStoreId;
                                    $rj[$k] = implode('/', $r);
                                }
                                $c->setImage(json_encode($rj));
                            }
                        }
                        $c->setId(null);
                        $c->setStoreId($newStoreId);
                        $c->setProductRelated(null);
                        $c->setArticleRelated(null);
                        $productMapper->save($c);
                    }
                }
                /**** Media Item ****/
                $mediaItemMapper = $sl->get('Admin\Model\MediaItemMapper');
                $mediaItem = new \Admin\Model\MediaItem();
                $mediaItem->setStoreId($cloneStoreId);
                $mi = $mediaItemMapper->fetchAll($mediaItem);
                if(!empty($mi)) {
                    foreach($mi as $k => $b) {

                        if($b->getFileItem()) {
                            $media = new \Admin\Model\Media();
                            $media->setId($b->getFileItem());
                            $rm = $mediaMapper->get($media);
                            if(!empty($rm)) {
                                $media1 = new \Admin\Model\Media();
                                $media1->setFileName($media->getFileName());
                                $media1->setStoreId($newStoreId);
                                $rm1 = $mediaMapper->get($media1);
                                if(!empty($rm1)) {
                                    $b->setFileItem($media1->getId());
                                }
                            }
                        }
                        if(!empty($b->getItemId())) {
                            if($b->getType() == 3) {
                                $productc = new \Admin\Model\Productc();
                                $productc->setId($b->getItemId());
                                $pcr = $productCategoryMapper->get($productc);
                                if(!empty($pcr)) {
                                    $productc1 = new \Admin\Model\Productc();
                                    $productc1->setName($productc->getName());
                                    $productc1->setStoreId($newStoreId);
                                    $pcr1 = $productCategoryMapper->get($productc1);
                                    if(!empty($pcr1)) {
                                        $b->setItemId($productc1->getId());
                                    }
                                }
                            }
                            if($b->getType() == 2) {
                                $product = new \Admin\Model\Product();
                                $product->setId($b->getItemId());
                                $pr = $productMapper->get($product);
                                if(!empty($pr)) {
                                    $product1 = new \Admin\Model\Product();
                                    $product1->setTitle($product->getTitle());
                                    $product1->setStoreId($newStoreId);
                                    $pr1 = $productMapper->get($product1);
                                    if(!empty($pr1)) {
                                        $b->setItemId($product1->getId());
                                    }
                                }
                            }
                            if($b->getType() == 1) {
                                $article = new \Admin\Model\Article();
                                $article->setId($b->getItemId());
                                $ar = $articleMapper->get($article);
                                if(!empty($ar)) {
                                    $article1 = new \Admin\Model\Article();
                                    $article1->setTitle($article->getTitle());
                                    $article1->setStoreId($newStoreId);
                                    $ar1 = $articleMapper->get($article1);
                                    if(!empty($ar1)) {
                                        $b->setItemId($article1->getId());
                                    }
                                }
                            }
                            if($b->getType() == 4) {
                                $banner = new \Admin\Model\Banner();
                                $banner->setId($b->getItemId());
                                $br = $bannerMapper->get($banner);
                                if(!empty($br)) {
                                    $banner1 = new \Admin\Model\Banner();
                                    $banner1->setName($banner->getName());
                                    $banner1->setStoreId($newStoreId);
                                    $br1 = $bannerMapper->get($banner1);
                                    if(!empty($br1)) {
                                        $b->setItemId($banner1->getId());
                                    }
                                }
                            }
                            if($b->getType() == 5) {
                                $brand = new \Admin\Model\Brand();
                                $brand->setId($b->getItemId());
                                $bar = $brandMapper->get($brand);
                                if(!empty($bar)) {
                                    $brand1 = new \Admin\Model\Brand();
                                    $brand1->setName($brand->getName());
                                    $brand1->setStoreId($newStoreId);
                                    $bar1 = $brandMapper->get($brand1);
                                    if(!empty($bar1)) {
                                        $b->setItemId($brand1->getId());
                                    }
                                }
                            }
                        }
                        $b->setStoreId($newStoreId);
                        $mediaItemMapper->save($b);
                    }
                }

                function categoryProduct($url, $storeId, $sl) {

                    $productCategoryMapper = $sl->get('Admin\Model\ProductcMapper');
                    preg_match_all('/\-pc(\d+)/', $url, $pc_preg);
                    if(!empty($pc_preg[1][0])) {
                        $productCategory = new \Admin\Model\Productc();
                        $productCategory->setId($pc_preg[1][0]);
                        $r = $productCategoryMapper->get($productCategory);
                        if(!empty($r)) {
                            $productCategory1 = new \Admin\Model\Productc();
                            $productCategory1->setName($productCategory->getName());
                            $productCategory1->setStoreId($storeId);
                            $r = $productCategoryMapper->get($productCategory1);
                            if(!empty($r)) {
                                return $productCategory1->getViewLink();
                            }
                        }
                    }

                    $pageMapper = $sl->get('Admin\Model\PageMapper');
                    preg_match_all('/\-pa(\d+)/', $url, $pa_preg);
                    if(!empty($pa_preg[1][0])) {
                        $page = new \Admin\Model\Page();
                        $page->setId($pa_preg[1][0]);
                        $pa = $pageMapper->get($page);
                        if(!empty($pa)) {
                            $page1 = new \Admin\Model\Page();
                            $page1->setName($page->getName());
                            $page1->setStoreId($storeId);
                            $pa1 = $pageMapper->get($page1);
                            if(!empty($pa1)) {
                                return $page1->getViewLink();
                            }
                        }
                    }

                    $articleCategoryMapper = $sl->get('Admin\Model\ArticlecMapper');
                    preg_match_all('/\-nc(\d+)/', $url, $nc_preg);
                    if(!empty($nc_preg[1][0])){
                        $articleCategory = new \Admin\Model\Articlec();
                        $articleCategory->setId($nc_preg[1][0]);
                        $r = $articleCategoryMapper->get($articleCategory);
                        if(!empty($r)) {
                            $articleCategory1 = new \Admin\Model\Articlec();
                            $articleCategory1->setName($articleCategory->getName());
                            $articleCategory1->setStoreId($storeId);
                            $r = $articleCategoryMapper->get($articleCategory1);
                            if(!empty($r)) {
                                return $articleCategory1->getViewLink();
                            }
                        }
                    }

                    return false;
                }

                /**** Menu ****/
                $menuMapper = $sl->get('Admin\Model\MenuMapper');
                $menu = new \Admin\Model\Menu();
                $menu->setStoreId($cloneStoreId);
                $m = $menuMapper->fetchAll($menu);
                if(!empty($m)) {
                    foreach($m as $k => $b) {
                        if(!empty($b->getMenu())) {
                            $dataMenu = json_decode($b->getMenu(), true);
                            if(!empty($dataMenu)){
                                $mr = [];
                                foreach($dataMenu as $m) {
                                    if(categoryProduct($m['url'], $newStoreId, $sl)) {
                                        $m['url'] = categoryProduct($m['url'], $newStoreId, $sl);
                                    }
                                    /**************************/
                                    if(!empty($m['children'])){
                                        $mr1 = [];
                                        foreach($m['children'] as $mm) {
                                            if(categoryProduct($mm['url'], $newStoreId, $sl)) {
                                                $mm['url'] = categoryProduct($mm['url'], $newStoreId, $sl);
                                            }
                                            /**************************/
                                            if(!empty($mm['children'])){
                                                $mr2 = [];
                                                foreach($mm['children'] as $mmm) {
                                                    if(categoryProduct($mmm['url'], $newStoreId, $sl)) {
                                                        $mmm['url'] = categoryProduct($mmm['url'], $newStoreId, $sl);
                                                    }
                                                    /**************************/
                                                    if(!empty($mmm['children'])){
                                                        $mr3 = [];
                                                        foreach($mmm['children'] as $mmmm) {
                                                            if(categoryProduct($mmmm['url'], $newStoreId, $sl)) {
                                                                $mmmm['url'] = categoryProduct($mmmm['url'], $newStoreId, $sl);
                                                            }
                                                            /**************************/
                                                            if(!empty($mmmm['children'])){
                                                                $mr4 = [];
                                                                foreach($mmmm['children'] as $mmmmm) {
                                                                    if(categoryProduct($mmmmm['url'], $newStoreId, $sl)) {
                                                                        $mmmmm['url'] = categoryProduct($mmmmm['url'], $newStoreId, $sl);
                                                                    }
                                                                    $mr4[] = $mmmmm;
                                                                }
                                                                $mmmm['children'] = $mr4;
                                                            }
                                                            /**************************/
                                                            $mr3[] = $mmmm;
                                                        }
                                                        $mmm['children'] = $mr3;
                                                    }
                                                    /**************************/
                                                    $mr2[] = $mmm;
                                                }
                                                $mm['children'] = $mr2;
                                            }
                                            /**************************/
                                            $mr1[] = $mm;
                                        }
                                        $m['children'] = $mr1;
                                    }
                                    /**************************/
                                    $mr[] = $m;
                                }
                                $b->setMenu(json_encode($mr));
                            }
                        }
                        $b->setId(null);
                        $b->setStoreId($newStoreId);
                        $menuMapper->save($b);
                    }
                }

                /**** Attr ****/
                $attrMapper = $sl->get('Admin\Model\AttrMapper');
                $attr = new \Admin\Model\Attr();
                $attr->setStoreId($cloneStoreId);
                $a = $attrMapper->fetchAll($attr);
                if(!empty($a)) {
                    foreach ($a as $k => $c) {
                        $c->setId(null);
                        $c->setStoreId($newStoreId);
                        $attrMapper->save($c);
                    }
                }

                /**** Attr ****/
                $attrListMapper = $sl->get('Admin\Model\AttrListMapper');
                $attrList = new \Admin\Model\AttrList();
                $attrList->setStoreId($cloneStoreId);
                $a = $attrListMapper->fetchAll($attrList);
                if(!empty($a)) {
                    foreach ($a as $k => $c) {
                        if($c->getProductAttrId()) {
                            $attr = new \Admin\Model\Attr();
                            $attr->setId($c->getProductAttrId());
                            $r = $attrMapper->get($attr);
                            if(!empty($r)) {
                                $attr1 = new \Admin\Model\Attr();
                                $attr1->setName($attr->getName());
                                $attr1->setStoreId($newStoreId);
                                $at = $attrMapper->get($attr1);
                                if(!empty($at)) {
                                    $c->setProductAttrId($attr1->getId());
                                }
                            }
                        }
                        if($c->getProductId()) {
                            $product = new \Admin\Model\Product();
                            $product->setId($c->getProductId());
                            $rp = $productMapper->get($product);
                            if(!empty($rp)) {
                                $product1 = new \Admin\Model\Product();
                                $product1->setStoreId($newStoreId);
                                $product1->setTitle($product->getTitle());
                                $p = $productMapper->get($product1);
                                if(!empty($p)) {
                                    $c->setProductId($product1->getId());
                                }
                            }
                        }
                        $c->setStoreId($newStoreId);
                        $attrListMapper->save($c);
                    }
                }
                $uitemplateMapper = $sl->get('Uitemplate\Model\UitemplateMapper');
                $domainMapper = $sl->get('Store\Model\DomainMapper');
                $uitemplate = new \Uitemplate\Model\Uitemplate();
                $uitemplate->setDirectory($data['storeClone']);
                $r = $uitemplateMapper->getId($uitemplate);

                if(!empty($r)) {
                    $domain = new \Store\Model\Domain();
                    $domain->setUitemplate($uitemplate->getId());
                    $d = $domainMapper->get($domain);
                    if(!empty($d)) {
                        $domain->setId(null);
                        $domain->setParentStoreId($storeId);
                        $domain->setStoreId($newStoreId);
                        $domain->setAlias(null);
                        $host = explode('.',$_SERVER["SERVER_NAME"]);
                        if(count($host) == 3) {
                            $domain->setName($data['store'].'.'.$host[1].'.'.$host[2]);
                        } else {
                            $domain->setName($data['store'].'.'.$_SERVER["SERVER_NAME"]);
                        }
                        $domain->setCreatedDateTime(DateBase::getCurrentDateTime());
                        $optionPage = json_decode($domain->getOptionPage(), true);
                        if(!empty($optionPage)) {
                            $rop = [];
                            foreach($optionPage as $k => $o) {
                                if(is_array($o)){
                                    if(!empty($o)) {
                                        $c = [];
                                        foreach($o as $i => $b) {
                                            /*** Image ***/
                                            if(!empty($b['image'])){
                                                $im = json_decode($b['image'], true);
                                                if(!empty($im)) {
                                                    $rj = [];
                                                    foreach($im as $ki => $image) {
                                                        $r = explode('/', $image);
                                                        $r[3] = $newStoreId;
                                                        $rj[$ki] = implode('/', $r);
                                                    }
                                                    $b['image'] = json_encode($rj);
                                                }
                                            }
                                            /*** Category Product ***/
                                            preg_match_all('/\-pc(\d+)/', $b['url'], $pc_preg);
                                            if(!empty($pc_preg[1][0])) {
                                                $productCategory = new \Admin\Model\Productc();
                                                $productCategory->setId($pc_preg[1][0]);
                                                $r = $productCategoryMapper->get($productCategory);
                                                if(!empty($r)) {
                                                    $productCategory1 = new \Admin\Model\Productc();
                                                    $productCategory1->setName($productCategory->getName());
                                                    $productCategory1->setStoreId($newStoreId);
                                                    $r = $productCategoryMapper->get($productCategory1);
                                                    if(!empty($r)) {
                                                        $b['id'] = $productCategory1->getId();
                                                        $b['url'] = $productCategory1->getViewLink();
                                                    }
                                                }
                                            }
                                            /*** Product ***/
                                            preg_match_all('/\-p(\d+)/', $b['url'], $p_preg);
                                            if(!empty($p_preg[1][0])) {
                                                $product = new \Admin\Model\Product();
                                                $product->setId($p_preg[1][0]);
                                                $r = $productMapper->get($product);
                                                if(!empty($r)) {
                                                    $product1 = new \Admin\Model\Product();
                                                    $product1->setTitle($product->getTitle());
                                                    $product1->setStoreId($newStoreId);
                                                    $r = $productMapper->get($product1);
                                                    if(!empty($r)) {
                                                        $b['id'] = $product1->getId();
                                                        $b['url'] = $product1->getViewLink();
                                                    }
                                                }
                                            }
                                            /*** Article ***/
                                            preg_match_all('/\-n(\d+)/', $b['url'], $a_preg);
                                            if(!empty($a_preg[1][0])) {
                                                $article = new \Admin\Model\Article();
                                                $article->setId($a_preg[1][0]);
                                                $ra = $articleMapper->get($article);
                                                if(!empty($ra)) {
                                                    $article3 = new \Admin\Model\Article();
                                                    $article3->setTitle($article->getTitle());
                                                    $article3->setStoreId($newStoreId);
                                                    $ra1 = $articleMapper->get($article3);
                                                    if(!empty($ra1)) {
                                                        $b['id'] = $article3->getId();
                                                        $b['url'] = $article3->getViewLink();
                                                    }
                                                }
                                            }
                                            /*** Page ***/
                                            $pageMapper = $sl->get('Admin\Model\PageMapper');
                                            preg_match_all('/\-pa(\d+)/', $b['url'], $pa_preg);
                                            if(!empty($pa_preg[1][0])) {
                                                $page = new \Admin\Model\Page();
                                                $page->setId($pa_preg[1][0]);
                                                $pa = $pageMapper->get($page);
                                                if(!empty($pa)) {
                                                    $page1 = new \Admin\Model\Page();
                                                    $page1->setName($page->getName());
                                                    $page1->setStoreId($newStoreId);
                                                    $pa1 = $pageMapper->get($page1);
                                                    if(!empty($pa1)) {
                                                        $b['id'] = $page1->getId();
                                                        $b['url'] = $page1->getViewLink();
                                                    }
                                                }
                                            }

                                            $c[$i] = $b;
                                        }
                                        $rop[$k] = $c;
                                    }
                                } else {
                                    $rop[$k] = $o;
                                }
                            }
                            $domain->setOptionPage(json_encode($rop));
                        }
                        $domainMapper->save($domain);
                    }
                }

                /**** Created User ****/
                $userMapper = $this->getServiceLocator()->get('Admin\Model\UserMapper');
                $user = new \Admin\Model\User();
                $user->setStoreId($newStoreId);
                $user->setParentStore($storeId);
                $user->setUsername($data['store']);
                $user->setEmail(!empty($data['email']) ? $data['email'] : null);
                $user->setMobile(!empty($data['phone']) ? $data['phone'] : null);
                $user->setRole(\Admin\Model\User::ROLE_ADMIN);
                $user->setCreatedDateTime(DateBase::getCurrentDateTime());
                $user->setActive(\Admin\Model\User::STATUS_ACTIVE);
                $user->setSalt(substr(md5(rand(2000, 5000) . time() . rand(2000, 5000)), 0, 20));
                $user->setPassword(md5($user->getSalt() . $data['password']));

                $authorize = $this->getServiceLocator()->get('Authorize\Service\Authorize');
                $listDependencies = $authorize->getAcl()->getDependencies();

                if(!empty($listDependencies)) {
                    $d = [];
                    foreach($listDependencies as $k => $v) {
                        if($k == 'Tài khoản') {
                            if(!empty($v)) {
                                $b = [];
                                foreach($v as $c) {
                                    $b[$c] = $c;
                                }
                                $d['user'] = $b;
                            }
                        }
                        if($k == 'Trang') {
                            if(!empty($v)) {
                                $b = [];
                                foreach($v as $c) {
                                    $b[$c] = $c;
                                }
                                $d['page'] = $b;
                            }
                        }
                        if($k == 'Cài đặt') {
                            if(!empty($v)) {
                                $b = [];
                                foreach($v as $c) {
                                    $b[$c] = $c;
                                }
                                $d['setup'] = $b;
                            }
                        }
                        if($k == 'Hình Ảnh') {
                            if(!empty($v)) {
                                $b = [];
                                foreach($v as $c) {
                                    $b[$c] = $c;
                                }
                                $d['media'] = $b;
                            }
                        }
                        if($k == 'Bài viết') {
                            if(!empty($v)) {
                                $b = [];
                                foreach($v as $c) {
                                    $b[$c] = $c;
                                }
                                $d['article'] = $b;
                            }
                        }
                        if($k == 'Sản phẩm') {
                            if(!empty($v)) {
                                $b = [];
                                foreach($v as $c) {
                                    $b[$c] = $c;
                                }
                                $d['product'] = $b;
                            }
                        }
                    }

                    $user->setDependencies(json_encode($d));
                }
                $userMapper->save($user);

                function recurse_copy($src,$dst) {
                    $dir = opendir($src);
                    $oldmask = umask(0);
                    mkdir($dst, 0777, true);
                    umask($oldmask);

                    while(false !== ( $file = readdir($dir)) ) {
                        if (( $file != '.' ) && ( $file != '..' )) {
                            if ( is_dir($src . '/' . $file) ) {
                                recurse_copy($src . '/' . $file,$dst . '/' . $file);
                            }
                            else {
                                copy($src . '/' . $file,$dst . '/' . $file);
                                chmod($dst . '/' . $file, fileperms($src . '/' . $file));
                            }
                        }
                    }
                    closedir($dir);
                }
                recurse_copy(UPLOAD_PATH . '/media/'.$cloneStoreId, UPLOAD_PATH . '/media/'.$newStoreId);

                $this->redirect()->toUrl('/admin/user/domain');
            }
        }

        return new ViewModel(array(
            'form' => $form,
        ));

    }

    public function deletedomainAction()
    {
        function deleteDir($path) {
            return is_file($path) ?
                @unlink($path) :
                array_map(__FUNCTION__, glob($path.'/*')) == @rmdir($path);
        }
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $id = $this->getRequest()->getPost()['id'];
        if(!is_numeric($id)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy website này'
            ));
        }
        $sl = $this->getServiceLocator();
        $domainMapper = $sl->get('Admin\Model\DomainMapper');
        $domain = new \Admin\Model\Domain();
        $domain->setId($id);
        $domain->setStoreId($storeId);
        $domain->setParentStoreId($storeId);

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

    public function contactAction()
    {
        $this->layout('layout/admin');
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $viewModel = new ViewModel();

        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();
        $contactMapper = $this->getServiceLocator()->get('Admin\Model\ContactMapper');
        $contact = new \Admin\Model\User();

        if($id) {
            $contact = new \Admin\Model\Contact();
            $contact->setStoreId($storeId);
            $contact->setId($id);
            $r = $contactMapper->get($contact);
            $viewModel->setTemplate('admin/user/contactview');
            $viewModel->setVariable('view', $r);
        }

//        if(!$this->user()->isSuperAdmin()){
            $contact->setStoreId($storeId);
//        }


        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $results = $contactMapper->search($contact, array($page,20));

        $viewModel->setVariable('results', $results);
        $viewModel->setVariable('url', $this->getRequest()->getUri()->getQuery());

        return $viewModel;

    }

    public function clientAction()
    {
        $this->layout('layout/admin');
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $viewModel = new ViewModel();
        $request = $this->getRequest();
        $data = $request->getPost('insert');
        $name = $request->getPost('name');
	
        $clientMapper = $this->getServiceLocator()->get('Admin\Model\ClientMapper');

        if(!empty($data)) {
            $client = new \Admin\Model\Client();
            $client->setStoreId($storeId);
            $client->exchangeArray($data);
            if($clientMapper->get($client)) {
                return new JsonModel(array(
                    'status' => 0,
                    'messenger' => 'Khách hàng đã tồn tại.',
                ));
            }
            $client->setCreatedDateTime(DateBase::getCurrentDateTime());
            if(!empty($data['birthday'])) {
                $client->setBirthday(DateBase::toFormat($data['birthday'], 'Y-m-d', 'm/d/Y'));
            }
            if(!empty($data['gender'])) {
                if($data['gender'] == 'male') {
                    $client->setGender(\Admin\Model\Client::MALE);
                } elseif ($data['gender'] == 'female') {
                    $client->setGender(\Admin\Model\Client::FEMALE);
                }
            }
            $r = $clientMapper->save($client);
            return new JsonModel(array(
                'status' => 1,
                'messenger' => 'Đã thêm thành công',
                'clientId' => $r->getId(),
                'clientFullName' => $r->getName() ? $r->getName().' - '.$r->getPhone():$r->getPhone(),
                'clientName' => $r->getName() ? $r->getName():'---',
                'clientPhone' => $r->getPhone() ? $r->getPhone():'---',
            ));
        }

        if ($request->getPost('template')) {
            $viewModel->setTemplate($request->getPost('template'));
            $viewModel->setTerminal($request->getPost('terminal', false));
        }
        if(!empty($name)) {
            $client = new \Admin\Model\Client();
            $client->setOptions('keySearch', true);
            $client->setName($name);
            $client->setStoreId($storeId);
            $clientResult = $clientMapper->search($client, [1,20]);
            $viewModel->setVariable('client', $clientResult->getData());
        }
        return $viewModel;
    }


}




















