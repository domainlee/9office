<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;
use Home\Model\DateBase;


class SetupController extends AbstractActionController{

	public function indexAction() {
		$this->layout('layout/admin');
        /*****/
        $sl = $this->getServiceLocator();
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();
        /****/
//        print_r(json_decode($u->getUser()->getDependencies(), true));die;

        $optionMapper = $this->getServiceLocator()->get('Admin\Model\OptionMapper');

        $option = new \Admin\Model\Option();
        $option->setStoreId($storeId);
        $optionMapper->get($option);

        /* Domain */
        $storeService = $sl->get('Store\Service\Store');
        $uiTemplate = $storeService->getUitemplate();

        $domainMapper = $sl->get('Admin\Model\DomainMapper');
        $domain = new \Admin\Model\Domain();
        $domain->setStoreId($storeId);
        $rd = $domainMapper->get($domain);

        $template = new \Admin\Model\Template();
        $template->setId($rd->getUitemplateId());
        $templateMapper = $sl->get('Admin\Model\TemplateMapper');
        $rT = $templateMapper->get($template);
        $dir = $rT->getDirectory();

        $ar[$rT->getId()] = ['label' => $rT->getDirectory(), 'value' => $rT->getId(), 'selected' => true];
        $form = new \Admin\Form\Option($this->getServiceLocator(), null);
//        if(!empty($ar)) {
//            $form->setTemplate($ar);
//        }

        $value = json_decode($option->getData(), true);
        if(!empty($value)) {
            $form->setData($value);
        }
        if(!empty($option->getId())){
            $id = $option->getId();
        }

        $domain = $storeService->getDomain();

        $domainMapper = $this->getServiceLocator()->get('Store\Model\DomainMapper');
        $storeDomain = new \Store\Model\Domain();
        $storeDomain->setName($rd->getName());
        $storeDomain->setStoreId($storeId);

        if($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if($form->isValid()) {

                $data = $form->getData();

                $logo = $this->getRequest()->getPost()['logo'];
                $favicon = $this->getRequest()->getPost()['favicon'];
                $option = new \Admin\Model\Option();
                if(!empty($id)){
                    $option->setId($id);
                }
                if(!empty($logo)) {
                    $data['logo'] = $logo;
                }
                if(!empty($favicon)) {
                    $data['favicon'] = $favicon;
                }
                $option->setStoreId($storeId);

                $option->setData(json_encode($data + $value));

//                if(!empty($domainMapper->get($storeDomain))) {
//                    if(!empty($data['domain'])) {
//                        $storeDomain->setAlias($data['domain']);
//                    }
//                    if(!empty($data['uitemplateId'][0])) {
//                        $storeDomain->setUitemplateId($data['uitemplateId'][0]);
//                    }
//                    $domainMapper->save2($storeDomain);
//                }

                $optionMapper->save($option);
                Header('Location: /admin/setup');
                Exit();
            }
        }

        return new ViewModel(array(
            'form' => $form,
            'value' => $value,
        ));

    }


    public function sourceAction() {
        $this->layout('layout/admin');
        /*****/
        $sl = $this->getServiceLocator();
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();
        /****/
        $optionMapper = $this->getServiceLocator()->get('Admin\Model\OptionMapper');

        $option = new \Admin\Model\Option();
        $option->setStoreId($storeId);
        $optionMapper->get($option);

        /* Domain */
        $storeService = $sl->get('Store\Service\Store');
        $uiTemplate = $storeService->getUitemplate();

        $domainMapper = $sl->get('Admin\Model\DomainMapper');
        $domain = new \Admin\Model\Domain();
        $domain->setStoreId($storeId);
        $rd = $domainMapper->get($domain);

        $template = new \Admin\Model\Template();
        $template->setId($rd->getUitemplateId());
        $templateMapper = $sl->get('Admin\Model\TemplateMapper');
        $rT = $templateMapper->get($template);
        $dir = $rT->getDirectory();
        $ar[$rT->getId()] = ['label' => $rT->getDirectory(), 'value' => $rT->getId(), 'selected' => true];
        $form = new \Admin\Form\OptionSource($this->getServiceLocator(), null);

        $value = json_decode($option->getData(), true);
        if(!empty($value)) {
            $form->setData($value);
        }
        if(!empty($option->getId())){
            $id = $option->getId();
        }

        $domain = $storeService->getDomain();

        $domainMapper = $this->getServiceLocator()->get('Store\Model\DomainMapper');
        $storeDomain = new \Store\Model\Domain();
        $storeDomain->setName($rd->getName());
        $storeDomain->setStoreId($storeId);

        if($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if($form->isValid()) {
                $data = $form->getData();
                $option = new \Admin\Model\Option();
                if(!empty($id)){
                    $option->setId($id);
                }
                $option->setStoreId($storeId);
                $option->setData(json_encode($data + $value));
                $optionMapper->save($option);
                Header('Location: /admin/setup/source');
                Exit();
            }
        }

        return new ViewModel(array(
            'form' => $form,
            'value' => $value,
        ));

    }

    public function robotAction() {
        $this->layout('layout/admin');
        /*****/
        $sl = $this->getServiceLocator();
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();
        /****/
        $optionMapper = $this->getServiceLocator()->get('Admin\Model\OptionMapper');

        $option = new \Admin\Model\Option();
        $option->setStoreId($storeId);
        $optionMapper->get($option);

        /* Domain */
        $storeService = $sl->get('Store\Service\Store');
        $uiTemplate = $storeService->getUitemplate();

        $domainMapper = $sl->get('Admin\Model\DomainMapper');
        $domain = new \Admin\Model\Domain();
        $domain->setStoreId($storeId);
        $rd = $domainMapper->get($domain);

        $template = new \Admin\Model\Template();
        $template->setId($rd->getUitemplateId());
        $templateMapper = $sl->get('Admin\Model\TemplateMapper');
        $rT = $templateMapper->get($template);
        $dir = $rT->getDirectory();
        $ar[$rT->getId()] = ['label' => $rT->getDirectory(), 'value' => $rT->getId(), 'selected' => true];
        $form = new \Admin\Form\OptionRobots($this->getServiceLocator(), null);

        $value = json_decode($option->getData(), true);
        if(!empty($value)) {
            $form->setData($value);
        }
        if(!empty($option->getId())){
            $id = $option->getId();
        }

        $domain = $storeService->getDomain();

        $domainMapper = $this->getServiceLocator()->get('Store\Model\DomainMapper');
        $storeDomain = new \Store\Model\Domain();
        $storeDomain->setName($rd->getName());
        $storeDomain->setStoreId($storeId);

        $fileRobot = UPLOAD_PATH .'/media/'.$storeId.'/robots.txt';
        $fileXML = UPLOAD_PATH .'/media/'.$storeId.'/sitemap.xml';

        $fr = $_SERVER['HTTP_HOST'].'/uploads/media/'.$storeId.'/robots.txt';
        $fx = $_SERVER['HTTP_HOST'].'/uploads/media/'.$storeId.'/sitemap.xml';

        if($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if($form->isValid()) {
                $data = $form->getData();
                $option = new \Admin\Model\Option();
                if(!empty($id)){
                    $option->setId($id);
                }
                $option->setStoreId($storeId);

                $currentRobot= $data['robots']."\n";
                file_put_contents($fileRobot, $currentRobot);

                $currentXML = $data['xml']."\n";
                file_put_contents($fileXML, $currentXML);

                $option->setData(json_encode($data + $value));
                $optionMapper->save($option);
                Header('Location: /admin/setup/robot');
                Exit();
            }
        }

        return new ViewModel(array(
            'robot' => $fr,
            'xml' => $fx,
            'form' => $form,
            'value' => $value,
        ));

    }

    public function popupAction() {
        $this->layout('layout/admin');
        /*****/
        $sl = $this->getServiceLocator();
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();
        /****/
        $optionMapper = $this->getServiceLocator()->get('Admin\Model\OptionMapper');

        $option = new \Admin\Model\Option();
        $option->setStoreId($storeId);
        $optionMapper->get($option);

        /* Domain */
        $storeService = $sl->get('Store\Service\Store');
        $uiTemplate = $storeService->getUitemplate();

        $domainMapper = $sl->get('Admin\Model\DomainMapper');
        $domain = new \Admin\Model\Domain();
        $domain->setStoreId($storeId);
        $rd = $domainMapper->get($domain);

        $template = new \Admin\Model\Template();
        $template->setId($rd->getUitemplateId());
        $templateMapper = $sl->get('Admin\Model\TemplateMapper');
        $rT = $templateMapper->get($template);
        $dir = $rT->getDirectory();
        $ar[$rT->getId()] = ['label' => $rT->getDirectory(), 'value' => $rT->getId(), 'selected' => true];
        $form = new \Admin\Form\OptionPopup($this->getServiceLocator(), null);

        $value = json_decode($option->getData(), true);
        if(!empty($value)) {
            $form->setData($value);
        }
        if(!empty($option->getId())){
            $id = $option->getId();
        }

        $domain = $storeService->getDomain();
        $domainMapper = $this->getServiceLocator()->get('Store\Model\DomainMapper');

        $storeDomain = new \Store\Model\Domain();
        $storeDomain->setName($rd->getName());
        $storeDomain->setStoreId($storeId);

        if($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if($form->isValid()) {
                $data = $form->getData();
                $logo = $this->getRequest()->getPost()['popup_image'];
                $option = new \Admin\Model\Option();
                if(!empty($id)){
                    $option->setId($id);
                }
                if(!empty($logo)) {
                    $data['popup_image'] = $logo;
                }
                $option->setStoreId($storeId);
                $option->setData(json_encode($data + $value));
                $optionMapper->save($option);
                Header('Location: /admin/setup/popup');
                Exit();
            }
        }

        return new ViewModel(array(
            'form' => $form,
            'value' => $value,
        ));

    }

    public function otherAction() {
        $this->layout('layout/admin');
        /*****/
        $sl = $this->getServiceLocator();
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();
        /****/

        $optionMapper = $this->getServiceLocator()->get('Admin\Model\OptionMapper');

        $option = new \Admin\Model\Option();
        $option->setStoreId($storeId);
        $optionMapper->get($option);

        /* Domain */
        $storeService = $sl->get('Store\Service\Store');
        $uiTemplate = $storeService->getUitemplate();

        $domainMapper = $sl->get('Admin\Model\DomainMapper');
        $domain = new \Admin\Model\Domain();
        $domain->setStoreId($storeId);
        $rd = $domainMapper->get($domain);

        $template = new \Admin\Model\Template();
        $template->setId($rd->getUitemplateId());
        $templateMapper = $sl->get('Admin\Model\TemplateMapper');
        $rT = $templateMapper->get($template);
        $dir = $rT->getDirectory();

        $ar[$rT->getId()] = ['label' => $rT->getDirectory(), 'value' => $rT->getId(), 'selected' => true];
        $form = new \Admin\Form\OptionOther($this->getServiceLocator(), null);
        if(!empty($ar)) {
            $form->setTemplate($ar);
        }

        $value = json_decode($option->getData(), true);
        if(!empty($value)) {
            $form->setData($value);
        }
        if(!empty($option->getId())){
            $id = $option->getId();
        }

        $domain = $storeService->getDomain();

        $domainMapper = $this->getServiceLocator()->get('Store\Model\DomainMapper');
        $storeDomain = new \Store\Model\Domain();
        $storeDomain->setName($rd->getName());
        $storeDomain->setStoreId($storeId);

        if($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if($form->isValid()) {

                $data = $form->getData();

                $logo = $this->getRequest()->getPost()['logo'];
                $favicon = $this->getRequest()->getPost()['favicon'];
                $option = new \Admin\Model\Option();
                if(!empty($id)){
                    $option->setId($id);
                }
                if(!empty($logo)) {
                    $data['logo'] = $logo;
                }
                if(!empty($favicon)) {
                    $data['favicon'] = $favicon;
                }
                $option->setStoreId($storeId);
                $option->setData(json_encode($data + $value));

                if(!empty($domainMapper->get($storeDomain))) {
                    if(!empty($data['domain'])) {
                        $storeDomain->setAlias($data['domain']);
                    }
                    if(!empty($data['uitemplateId'][0])) {
                        $storeDomain->setUitemplateId($data['uitemplateId'][0]);
                    }

                    $domainMapper->save2($storeDomain);
                }

                $optionMapper->save($option);
                Header('Location: /admin/setup/other');
                Exit();
            }
        }
//        print_r(json_decode($u->getUser()->getDependencies(), true));die;
        return new ViewModel(array(
            'form' => $form,
            'value' => $value,
            'token' => base64_encode('13e8qc981v'.$u->getUser()->getPassword().date('hi')),
        ));

    }

    public function menuAction()
    {
        $this->layout('layout/admin');

        /*****/
        $sl = $this->getServiceLocator();
        $storeService = $sl->get('Store\Service\Store');
        $uiTemplate = $storeService->getUitemplate();
        $dir = $uiTemplate->getDirectory();
        $sto = $storeService->getStoreId();
        $idTemplate = $uiTemplate->getId();
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();
        /****/

        $domainMapper = $sl->get('Admin\Model\DomainMapper');
        $domain = new \Admin\Model\Domain();
        $domain->setStoreId($storeId);
        $rd = $domainMapper->get($domain);

        $template = new \Admin\Model\Template();
        $template->setId($rd->getUitemplateId());
        $templateMapper = $sl->get('Admin\Model\TemplateMapper');
        $rT = $templateMapper->get($template);
        $dir = $rT->getDirectory();

        if (!file_exists('public/tp/'.$dir.'/menu.php')) {
            echo 'File public/tp/'.$dir.'/menu.php khong ton tai';exit();
        }
        $key = include('public/tp/'.$dir.'/menu.php');
        $menuMapper = $this->getServiceLocator()->get('Admin\Model\MenuMapper');
        if(!empty($key)) {
            $id = [];
            foreach($key as $k) {
                $menu = new \Admin\Model\Menu();
                $menu->setStoreId($storeId);
                $menu->setName($k['name']);
                $menu->setNameKey($k['nameKey']);
                $r = $menuMapper->get($menu);
                $menuMapper->save($menu);
                $id[] = $menu->getId();
            }
            if(!empty($id)){
                $menu1 = new \Admin\Model\Menu();
                $menu1->setStoreId($storeId);
                $fetchAll = $menuMapper->fetchAll($menu1);
                if(!empty($fetchAll)) {
                    foreach($fetchAll as $m) {
                        if(!in_array($m->getId(), $id)){
                            $menuMapper->delete($m);
                        }
                    }
                }
            }
        }

        $menu = new \Admin\Model\Menu();
        $menu->setStoreId($storeId);
        $keyMenu = $menuMapper->fetchAll($menu);

        $articleCategoryMapper = $this->getServiceLocator()->get('Admin\Model\ArticlecMapper');
        $articleCategory = new \Admin\Model\Articlec();
        $articleCategory->setStoreId($storeId);
        $rA = $articleCategoryMapper->fetchAll($articleCategory);

        $productCategoryMapper = $this->getServiceLocator()->get('Admin\Model\ProductcMapper');
        $productCategory = new \Admin\Model\Productc();
        $productCategory->setStoreId($storeId);
        $rP = $productCategoryMapper->fetchAll($productCategory);

        $pageMapper = $this->getServiceLocator()->get('Admin\Model\PageMapper');
        $page = new \Admin\Model\Page();
        $page->setStoreId($storeId);
        $rPa = $pageMapper->fetchAll2($page);

        if($this->getRequest()->isPost()){
            $data = $this->getRequest()->getPost('data');
            $dataKey = $this->getRequest()->getPost('dataKey');
            $menu = new \Admin\Model\Menu();
            $menu->setNameKey($dataKey);
            $menu->setStoreId($storeId);
            $menuMapper->get($menu);
            if(!empty($menu)) {
                if(!empty($data)) {
                    $menu->setMenu(json_encode($data));
                }
                $menuMapper->save($menu);
            }
        }

        return new ViewModel(array(
            'code' => 1,
            'product' => $rP,
            'article' => $rA,
            'keyMenu' => $keyMenu,
            'page' => $rPa,
        ));
    }

    public function skinAction() {
        $templateSkin = $this->getRequest()->getPost()['template'];
//        echo $templateSkin;die;
        $sl = $this->getServiceLocator();

        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();
        
        $template = new \Admin\Model\Template();
        $template->setDirectory($templateSkin);
        $templateMapper = $sl->get('Admin\Model\TemplateMapper');
        $rT = $templateMapper->get($template);
        if(!$rT) {
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy giao diện này'
            ));
        }

        $host = $_SERVER['HTTP_HOST'];

        $domain = new \Admin\Model\Domain();
        $domain->setStoreId($storeId);
        $domainMapper = $sl->get('Admin\Model\DomainMapper');
        $rD = $domainMapper->get($domain);
        if($rD){
            $domain->setOptionPage('');
            $domain->setHomePage('');
            $domain->setUitemplateId($rT->getId());
            $domainMapper->save($domain);
        }
        $host = $_SERVER['HTTP_HOST'];
        $ha = explode('.', $host);

        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Thay đổi giao diện thành công',
            'redirect' => 'http://'.$ha[1] == 'home' || $ha[0] == 'home' ? 'home.com':'dweb.vn'.'/admin/setup/template',
        ));
    }

    public function templateAction() {
        $this->layout('layout/admin');
        $sl = $this->getServiceLocator();
        $storeService = $sl->get('Store\Service\Store');
        $uiTemplate = $storeService->getUitemplate();
        $dir = $uiTemplate->getDirectory();
        $sto = $storeService->getStoreId();
        $idTemplate = $uiTemplate->getId();
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();

        $domainMapper = $sl->get('Admin\Model\DomainMapper');
        $domain = new \Admin\Model\Domain();
        $domain->setStoreId($storeId);
        $rd = $domainMapper->get($domain);

        $template = new \Admin\Model\Template();
        $template->setId($rd->getUitemplateId());
        $templateMapper = $sl->get('Admin\Model\TemplateMapper');
        $rT = $templateMapper->get($template);
        $dir = $rT->getDirectory();

        $productMapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');
        $domainMapper = $this->getServiceLocator()->get('Store\Model\DomainMapper');

        $storeDomain = new \Store\Model\Domain();
        $storeDomain->setUitemplate($rd->getUitemplateId());
        $storeDomain->setStoreId($storeId);

        $domainMapper->get($storeDomain);
        $value = json_decode($storeDomain->getHomePage(), true);

        if($this->getRequest()->getPost()['update']) {
            if(!empty($value)) {
                $options = [];
//                print_r($value);die;
                foreach($value as $k => $d) {
                    $type = explode(' ', $k);
                    if ($type[2] == 'banner') {
                        $bv = [];
                        if(is_array($d)) {
                            foreach ($d[$type[0]] as $p) {
                                $bannerMapper = $this->getServiceLocator()->get('Admin\Model\BannerMapper');
                                $bannerR = new \Admin\Model\Banner();
                                $bannerR->setId((int)$p['id']);
                                $r = $bannerMapper->get($bannerR);
                                if (!empty($r)) {
                                    $bv[(int)$p['id'].'_banner'] = ['id' => $r->getId(), 'url' => $r->getLink(), 'title' => $r->getName(), 'image' => $r->getImage(), 'description' => $r->getDescription()];
                                }
                            }
                        }
                        $options[$k] = array (
                            'limit' => $d['limit'],
                            'label' => $d['label'] ? $d['label']:'Hình ảnh',
                            $type[0] => $bv
                        );
                    } elseif ($type[2] == 'multifield') {
                        if(is_array($d)) {
                            foreach ($d as $kk => $vv) {
                                $type2 = explode(' ', $kk);

                                if($type2[1] == 'product') {
                                    $pv = [];
                                    foreach($vv[$type2[0]] as $p) {
                                        $product = new \Admin\Model\Product();
                                        $product->setId((int)$p['id']);
                                        $r = $productMapper->get($product);
                                        if(!empty($r)) {
                                            $pv[(int)$p['id'].'_product'] = ['id' => $r->getId(), 'url' => $r->getViewLink(), 'title' => $r->getTitle(), 'price' => $r->getPrice(), 'priceOld' => $r->getPriceOld(), 'image' => $r->getImage(), 'intro' => $r->getIntro(), 'extraContent' => $r->getExtraContent()];
                                        }
                                    }
                                    $pv1[$type[1]][$kk] = array(
                                        'label' => $vv['label'] ? $vv['label']:'Sản phẩm',
                                        'limit' => $vv['limit'],
                                        $type2[0] => $pv,
                                    );
                                } elseif($type2[1] == 'article') {
                                    $at = [];
                                    foreach($vv[$type2[0]] as $p) {
                                        $articleMapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
                                        $articleR = new \Admin\Model\Article();
                                        $articleR->setId((int)$p['id']);
                                        $r = $articleMapper->get($articleR);
                                        if (!empty($r)) {
                                            $at[(int)$p['id'].'_article'] = ['id' => $r->getId(), 'url' => $r->getViewLink(), 'title' => $r->getTitle(), 'intro' => $r->getDescription(), 'image'=> $r->getImage(), 'category' => $r->getCateName(), 'date' => $r->getCreatedDateTime(), 'extraContent' => $r->getExtraContent() ];
                                        }
                                    }
                                    $at1[$type[1]][$kk] = array(
                                        'label' => $vv['label'] ? $vv['label']:'Tin tức',
                                        'limit' => $vv['limit'],
                                        $type2[0] => $at,
                                    );
                                } elseif($type2[1] == 'productcategory') {
                                    $pc = [];
                                    foreach($vv[$type2[0]] as $p) {
                                        $productcMapper = $this->getServiceLocator()->get('Admin\Model\ProductcMapper');
                                        $categoryR = new \Admin\Model\Productc();
                                        $categoryR->setId((int)$p['id']);
                                        $r = $productcMapper->get($categoryR);
                                        if (!empty($r)) {
                                            $categoryP = new \Admin\Model\Productc();
                                            $categoryP->setParentId($r->getId());
                                            $rP = $productcMapper->fetchAll($categoryP);
                                            $child = [];
                                            if(!empty($rP)) {
                                                foreach($rP as $pa) {
                                                    $child[] = ['id' => $pa->getId(), 'url' => $pa->getViewLink(), 'title' => $pa->getName(), 'image' => $pa->getImage()];
                                                }
                                            }
                                            $pc[(int)$p['id'].'_categoryproduct'] = ['id' => $r->getId(), 'url' => $r->getViewLink(), 'title' => $r->getName(), 'image' => $r->getImage(), 'child' => $child];
                                        }
                                    }
                                    $pc1[$type[1]][$kk] = array(
                                        'label' => $vv['label'] ? $vv['label']:'Danh mục sản phẩm',
                                        'limit' => $vv['limit'],
                                        $type2[0] => $pc,
                                    );
                                } elseif($type2[1] == 'articlecategory') {
                                    $ac = [];
                                    foreach($vv[$type2[0]] as $p) {
                                        $articlecMapper = $this->getServiceLocator()->get('Admin\Model\ArticlecMapper');
                                        $articleC = new \Admin\Model\Articlec();
                                        $articleC->setId((int)$p['id']);
                                        $acR = $articlecMapper->get($articleC);
                                        if (!empty($acR)) {
                                            $articleCs = new \Admin\Model\Articlec();
                                            $articleCs->setParentId($acR->getId());
                                            $aCs = $articlecMapper->fetchAll2($articleCs);
                                            $child = [];
                                            if(!empty($aCs)) {
                                                foreach($aCs as $pa) {
                                                    $child[] = ['id' => $pa->getId(), 'url' => $pa->getViewLink(), 'title' => $pa->getName(),];
                                                }
                                            }
                                            $ac[(int)$p['id'].'_categoryarticle'] = ['id' => $acR->getId(), 'url' => $acR->getViewLink(), 'title' => $acR->getName(), 'child' => $child];
                                        }
                                    }
                                    $ac1[$type[1]][$kk] = array(
                                        'label' => $vv['label'] ? $vv['label']:'Danh mục tin tức',
                                        'limit' => $vv['limit'],
                                        $type2[0] => $ac,
                                    );
                                } elseif($type2[1] == 'page') {
                                    $pa = [];
                                    foreach($vv[$type2[0]] as $p) {
                                        $pageMapper = $this->getServiceLocator()->get('Admin\Model\PageMapper');
                                        $pageR = new \Admin\Model\Page();
                                        $pageR->setId((int)$p['id']);
                                        $pr = $pageMapper->get($pageR);
                                        if (!empty($pr)) {
                                            $pa[(int)$p['id'].'_page'] = ['id' => $pr->getId(), 'url' => $pr->getViewLink(), 'title' => $pr->getName(), 'image' => $pr->getImage(), 'description' => $pr->getDescription()];
                                        }
                                    }
                                    $pa1[$type[1]][$kk] = array(
                                        'label' => $vv['label'] ? $vv['label']:'Trang',
                                        'limit' => $vv['limit'],
                                        $type2[0] => $pa,
                                    );
                                } elseif($type2[1] == 'banner') {
                                    $ban = [];
                                    foreach($vv[$type2[0]] as $p) {
                                        $bannerMapper = $this->getServiceLocator()->get('Admin\Model\BannerMapper');
                                        $bannerR = new \Admin\Model\Banner();
                                        $bannerR->setId((int)$p['id']);
                                        $r = $bannerMapper->get($bannerR);
                                        if (!empty($r)) {
                                            $ban[(int)$p['id'].'_banner'] = ['id' => $r->getId(), 'url' => $r->getLink(), 'title' => $r->getName(), 'image' => $r->getImage(), 'description' => $r->getDescription()];
                                        }
                                    }
                                    $ban1[$type[1]][$kk] = array(
                                        'label' => $vv['label'] ? $vv['label']:'Hình ảnh',
                                        'limit' => $vv['limit'],
                                        $type2[0] => $ban,
                                    );
                                } else {
                                    $cc[$type[1]][$kk] = $vv;
                                }

                                $multi = array_merge( $cc[$type[1]] ? $cc[$type[1]]:[], $ban1[$type[1]] ? $ban1[$type[1]]:[],$pv1[$type[1]] ? $pv1[$type[1]]:[], $at1[$type[1]] ? $at1[$type[1]]:[], $pc1[$type[1]] ? $pc1[$type[1]]:[], $ac1[$type[1]] ? $ac1[$type[1]]:[], $pa1[$type[1]] ? $pa1[$type[1]]:[]);
                                $options[$k] = $multi;
                            }
                        }
                    }
                }
            }
            $storeDomain->setHomePage(json_encode($options));
            $domainMapper->save($storeDomain);
            return new JsonModel(array(
                'code'=> 1,
                'messenger' => 'Đã update home page'
            ));
        }

        if (!file_exists('public/tp/'.$dir.'/template.php')) {
            $viewModel = new ViewModel();
            $viewModel->setTemplate('error/404');
            return $viewModel;
        } elseif (!file_exists('public/tp/'.$dir.'/home.php')) {
//            $viewModel = new ViewModel();
//            $viewModel->setTemplate('error/404');
//            return $viewModel;
            $this->redirect()->toUrl('/admin/page/homepage');

        } else {
            if($this->getRequest()->isPost()) {
                $data = $this->getRequest()->getPost()->toArray();
                $options = [];
                foreach($data as $k => $d) {
                    $type = explode('_', $k);
                    $type2 = explode('--', $type[1]);
                    $type3 = explode('--', $type[4]);
                    if ($type[0] == 'banner' || $type2[1] == 'data') {
                        $bv = [];
                        $dataFormat = [];
                        foreach ($d as $p) {
                            if(is_numeric($p)) {
                                $bannerMapper = $this->getServiceLocator()->get('Admin\Model\BannerMapper');
                                $bannerR = new \Admin\Model\Banner();
                                $bannerR->setId((int)$p);
                                $r = $bannerMapper->get($bannerR);
                                if (!empty($r)) {
                                    $bv[(int)$p.'_banner'] = ['id' => $r->getId(), 'url' => $r->getLink(), 'title' => $r->getName(), 'image' => $r->getImage(), 'description' => $r->getDescription()];
                                }
                            } else {
                                $dataFormat = explode(',',$p);
                            }
                        }
                        $options[$type2[0].' '.$type[1].' banner'] = array (
                                                        'limit' => $dataFormat[1],
                                                        'label' => $dataFormat[0] ? $dataFormat[0]:'Hình ảnh',
                                                        $type2[0] => $bv
                                                    );
                    } elseif ($type[0] == 'multifield') {
                        if($type[2] == 'selectmulti') {
                            $v = [];
                            if($type[3] == 'product') {
                                $pv = [];
                                $dataFormat = [];
                                foreach($d as $p) {
                                    if(is_numeric($p)) {
                                        $product = new \Admin\Model\Product();
                                        $product->setId((int)$p);
                                        $r = $productMapper->get($product);
                                        if(!empty($r)) {
                                            $pv[(int)$p.'_product'] = ['id' => $r->getId(), 'url' => $r->getViewLink(), 'title' => $r->getTitle(), 'price' => $r->getPrice(), 'priceOld' => $r->getPriceOld(), 'image' => $r->getImage(), 'intro' => $r->getIntro(), 'extraContent' => $r->getExtraContent()];
                                        }
                                    } else {
                                        $dataFormat = explode(',',$p);
                                    }
                                }

                                $v[$type[1]] = $pv;
                                $pv1[$type[4]][$type[1].' '.$type[3]] = array(
                                    'label' => $dataFormat[0] ? $dataFormat[0]:'Sản phẩm',
                                    'limit' => $dataFormat[1],
                                    $type[1] => $pv,
                                );
                            } elseif ($type[3] == 'article') {
                                $nv = [];
                                $dataFormat = [];
                                foreach ($d as $p) {
                                    if(is_numeric($p)) {
                                        $articleMapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
                                        $articleR = new \Admin\Model\Article();
                                        $articleR->setId((int)$p);
                                        $r = $articleMapper->get($articleR);
                                        if (!empty($r)) {
                                            $nv[(int)$p.'_article'] = ['id' => $r->getId(), 'url' => $r->getViewLink(), 'title' => $r->getTitle(), 'intro' => $r->getDescription(), 'image'=> $r->getImage(), 'category' => $r->getCateName(), 'date' => $r->getCreatedDateTime(), 'extraContent' => $r->getExtraContent() ];
                                        }
                                    } else {
                                        $dataFormat = explode(',',$p);
                                    }
                                }
                                $v[$type[1]] = $nv;
                                $nv1[$type[4]][$type[1].' '.$type[3]] = array(
                                    'label' => $dataFormat[0] ? $dataFormat[0]:'Bài viết',
                                    'limit' => $dataFormat[1],
                                    $type[1] => $nv,
                                );
                            } elseif ($type[3] == 'productcategory') {
                                $cv = [];
                                $dataFormat = [];
                                foreach ($d as $p) {
                                    if(is_numeric($p)) {
                                        $productcMapper = $this->getServiceLocator()->get('Admin\Model\ProductcMapper');
                                        $categoryR = new \Admin\Model\Productc();
                                        $categoryR->setId((int)$p);
                                        $r = $productcMapper->get($categoryR);
                                        if (!empty($r)) {
                                            $categoryP = new \Admin\Model\Productc();
                                            $categoryP->setParentId($r->getId());
                                            $rP = $productcMapper->fetchAll($categoryP);
                                            $child = [];
                                            if(!empty($rP)) {
                                                foreach($rP as $pa) {
                                                    $child[] = ['id' => $pa->getId(), 'url' => $pa->getViewLink(), 'title' => $pa->getName(), 'image' => $pa->getImage()];
                                                }
                                            }
                                            $cv[(int)$p.'_categoryproduct'] = ['id' => $r->getId(), 'url' => $r->getViewLink(), 'title' => $r->getName(), 'image' => $r->getImage(), 'child' => $child];
                                        }
                                    } else {
                                        $dataFormat = explode(',',$p);
                                    }
                                }
                                $v[$type[1]] = $cv;
                                $cv1[$type[4]][$type[1].' '.$type[3]] = array(
                                    'label' => $dataFormat[0] ? $dataFormat[0]:'Danh mục sản phẩm',
                                    'limit' => $dataFormat[1],
                                    $type[1] => $cv,
                                );
                            } elseif ($type[3] == 'articlecategory') {
                                $acs = [];
                                $dataFormat = [];
                                foreach ($d as $p) {
                                    if(is_numeric($p)) {
                                        $articlecMapper = $this->getServiceLocator()->get('Admin\Model\ArticlecMapper');
                                        $articleC = new \Admin\Model\Articlec();
                                        $articleC->setId((int)$p);
                                        $acR = $articlecMapper->get($articleC);
                                        if (!empty($acR)) {
                                            $articleCs = new \Admin\Model\Articlec();
                                            $articleCs->setParentId($acR->getId());
                                            $aCs = $articlecMapper->fetchAll2($articleCs);
                                            $child = [];
                                            if(!empty($aCs)) {
                                                foreach($aCs as $pa) {
                                                    $child[] = ['id' => $pa->getId(), 'url' => $pa->getViewLink(), 'title' => $pa->getName(),];
                                                }
                                            }
                                            $acs[(int)$p.'_categoryarticle'] = ['id' => $acR->getId(), 'url' => $acR->getViewLink(), 'title' => $acR->getName(), 'child' => $child];
                                        }
                                    } else {
                                        $dataFormat = explode(',',$p);
                                    }
                                }
                                $v[$type[1]] = $acs;
                                $acs1[$type[4]][$type[1].' '.$type[3]] = array(
                                    'label' => $dataFormat[0] ? $dataFormat[0]:'Danh mục bài viết',
                                    'limit' => $dataFormat[1],
                                    $type[1] => $acs,
                                );

                            } elseif ($type[3] == 'page') {
                                $pa = [];
                                $dataFormat = [];
                                foreach ($d as $p) {
                                    if(is_numeric($p)) {
                                        $pageMapper = $this->getServiceLocator()->get('Admin\Model\PageMapper');
                                        $pageR = new \Admin\Model\Page();
                                        $pageR->setId((int)$p);
                                        $pr = $pageMapper->get($pageR);
                                        if (!empty($pr)) {
                                            $pa[(int)$p.'_page'] = ['id' => $pr->getId(), 'url' => $pr->getViewLink(), 'title' => $pr->getName(), 'image' => $pr->getImage(), 'description' => $pr->getDescription()];
                                        }
                                    } else {
                                        $dataFormat = explode(',',$p);
                                    }

                                }
                                $v[$type[1]] = $pa;
                                $pa1[$type[4]][$type[1].' '.$type[3]] = array(
                                    'label' => $dataFormat[0] ? $dataFormat[0]:'Trang',
                                    'limit' => $dataFormat[1],
                                    $type[1] => $pa,
                                );
                            } elseif ($type[3] == 'banner') {
                                $ban = [];
                                $dataFormat = [];
                                foreach ($d as $p) {
                                    if(is_numeric($p)) {
                                        $bannerMapper = $this->getServiceLocator()->get('Admin\Model\BannerMapper');
                                        $bannerR = new \Admin\Model\Banner();
                                        $bannerR->setId((int)$p);
                                        $r = $bannerMapper->get($bannerR);
                                        if (!empty($r)) {
                                            $ban[(int)$p.'_banner'] = ['id' => $r->getId(), 'url' => $r->getLink(), 'title' => $r->getName(), 'image' => $r->getImage(), 'description' => $r->getDescription()];
                                        }
                                    } else {
                                        $dataFormat = explode(',',$p);
                                    }
                                }
                                $v[$type[1]] = $ban;
                                $ban1[$type[4]][$type[1].' '.$type[3]] = array(
                                    'label' => $dataFormat[0] ? $dataFormat[0]:'Hình ảnh',
                                    'limit' => $dataFormat[1],
                                    $type[1] => $ban,
                                );
                            }
                        } elseif ($type[3] == 'field') {
                            $vL = $d[0];
                            $vF = $type[2] == 'checkbox' ? $d[1] == 'on' ? 1:0:$d[1];
                            if($type[2] == 'file') {
                                $fileF = explode(',', $d[0]);
                                $vL = $fileF[0];
                                $vF = $fileF[1] ? $fileF[1]:null;
                            }
                            $field[$type[4]][$type[1].' '.$type[2]] = array (
                                'label' => $vL,
                                'value' => $vF ? trim($vF):null,
                            );
                        } elseif ($type[3] == 'label'){
                            $label[$type[4]]['label'] = $d[0];
                        }

                        $multi = array_merge( $label[$type[4]] ? $label[$type[4]]:[], $field[$type[4]] ? $field[$type[4]]:[],$ban1[$type[4]] ? $ban1[$type[4]]:[], $pv1[$type[4]] ? $pv1[$type[4]]:[], $nv1[$type[4]] ? $nv1[$type[4]]:[], $cv1[$type[4]] ? $cv1[$type[4]]:[],$acs1[$type[4]] ? $acs1[$type[4]]:[], $pa1[$type[4]] ? $pa1[$type[4]]:[]);
                        $options[$type3[0].' '.$type[4].' multifield'] = $multi;

                    }
//                    }
                }
//                print_r($options);die;
//                if(!empty($value)){
//                    $storeDomain->setOptionPage(json_encode($options+$value));
//                } else {
                    $storeDomain->setHomePage(json_encode($options));
//                }
                $domainMapper->save($storeDomain);
                Header('Location: /admin/setup/template');
                Exit();
            }

            $field = include('public/tp/'.$dir.'/template.php');
            $fieldJson = include('public/tp/'.$dir.'/home.php');

            return new ViewModel(array(
                'field' => $field,
                'fieldJson' => json_encode($fieldJson),
                'value' => $value,
            ));
        }
    }

    public function pageAction() {
	    $request = $this->getRequest();
        $dataPost = $request->getPost()->toArray();

        $sl = $this->getServiceLocator();
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();

        $optionMapper = $sl->get('Admin\Model\OptionMapper');

        $option = new \Admin\Model\Option();
        $option->setStoreId($storeId);
        $a = $optionMapper->get($option);

        foreach ($dataPost as $k => $v) {
            $dataPost[$k] = ($v == 'on' ? 1:$v);
        }

        $singleArticle = [];
        if($dataPost['singleArticle']) {
            $singleArticle = [
                'displayAppendixArticle' => '',
                'shareArticle' => '',
                'ratingArticle' => '',
                'commentFacebookArticle' => '',
                'commentArticle' => '',
                'statusCommentArticle' => '',
                'displayTagArticle' => '',
                'displayRelationArticle' => '',
            ];
            foreach ($dataPost as $k => $v) {
                $singleArticle[$k] = $v;
            }
        }

        $singleProduct = [];
        if($dataPost['singleProduct']) {
            $singleProduct = [
                'displayAppendixProduct' => '',
                'shareProduct' => '',
                'ratingProduct' => '',
                'commentFacebookProduct' => '',
                'commentProduct' => '',
                'statusCommentProduct' => '',
                'displayTagProduct' => '',
                'displayRelationProduct' => '',
            ];
            foreach ($dataPost as $k => $v) {
                $singleProduct[$k] = $v;
            }
        }

        $dataOld = json_decode($a->getData(), true);

        $data = array_merge($dataOld, $dataPost, $singleArticle, $singleProduct);

        unset($data['singleArticle']);
        unset($data['pageArticle']);
        unset($data['singleProduct']);
        unset($data['pageProduct']);

        $option->setData(json_encode($data));
        $optionMapper->save($option);

        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Đã cập nhật'
        ));
    }

    public function commentAction()
    {
        $this->layout('layout/admin');
        $comment = new \Admin\Model\Comment();
        $sl = $this->getServiceLocator();
        $mapper = $sl->get('Admin\Model\CommentMapper');
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();

        $comment->exchangeArray((array)$this->getRequest()->getQuery());
        $options['isAdmin'] = $this->user()->isSuperAdmin();
        $fFilter = new \Admin\Form\ArticleSearch($options);
        $comment->setStoreId($storeId);

        $fFilter->bind($comment);
        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $results = $mapper->search($comment, array($page,30));

        return new ViewModel(array(
//            'fFilter' => $fFilter,
            'results' => $results,
            'url' => $this->getRequest()->getUri()->getQuery(),
        ));
    }

    public function changecommentAction()
    {
        $id = $this->getRequest()->getPost('id');
        $sl = $this->getServiceLocator();
        $mapper = $sl->get('Admin\Model\CommentMapper');
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();

        $comment = new \Admin\Model\Comment();
        $comment->setId($id);
        $comment->setStoreId($storeId);

        if(!$mapper->get($comment)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy chủ đề này'
            ));
        }

        if($comment->getStatus() == \Admin\Model\Comment::STATUS_ENABLE){
            $comment->setStatus(\Admin\Model\Comment::STATUS_DISABLE);
        }else{
            $comment->setStatus(\Admin\Model\Comment::STATUS_ENABLE);
        }
        $mapper->save($comment);

        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Đã thay đổi',
            'status' => $comment->getStatus()
        ));
    }

    public function deleteccommentAction(){

        $id = $this->getRequest()->getPost()['id'];
        if(!is_numeric($id)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy bài viết này'
            ));
        }
        $mapper = $this->getServiceLocator()->get('Admin\Model\CommentMapper');
        $comment = new \Admin\Model\Comment();
        $comment->setId($id);
        if(!$mapper->get($comment)){
            return new JsonModel(array(
                'code' => 0,
                'messenger' => 'Chúng tôi không tìm thấy bài viết này'
            ));
        }

        $mapper->delete($comment);

        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Đã xóa'
        ));
    }


}




















