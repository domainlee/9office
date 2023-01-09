<?php
namespace Admin\Controller;
use Admin\Model\Media;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Home\Form\FormBase;
use Home\Model\DateBase;
use Home\Filter\HTMLPurifier;


class PageController extends AbstractActionController{

	public function indexAction()
    {
		$this->layout('layout/admin');
		$page = new \Admin\Model\Page();

		$pageMapper = $this->getServiceLocator()->get('Admin\Model\PageMapper');
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $page->exchangeArray((array)$this->getRequest()->getQuery());
        $options['isAdmin'] = $this->user()->isSuperAdmin();
        $fFilter = new \Admin\Form\PageSearch($options);

        $page->setStoreId($storeId);

        $fFilter->bind($page);
		$paginator = (int)$this->getRequest()->getQuery()->page ? : 1;
		$results = $pageMapper->search($page, array($paginator,10));
		
		return new ViewModel(array(
			'fFilter' => $fFilter,
			'results' => $results
		));
	}

	public function addAction()
    {
		$this->layout('layout/admin');
        $sl = $this->getServiceLocator();
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();
        $page = new \Admin\Model\Page();
        $page->setStoreId($storeId);
        $page->setStatus(\Admin\Model\Page::STATUS_ACTIVE);
        $page->setCreatedById($u->getId());

        $storeService = $sl->get('Store\Service\Store');
        $uiTemplate = $storeService->getUitemplate();
        $dir = $uiTemplate->getDirectory();

        function dirToArray($dir) {
            if(is_dir($dir)){
            $result = array();
            $cdir = scandir($dir);
            foreach ($cdir as $key => $value) {
                if (!in_array($value,array(".",".."))) {
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                        $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
                    } else {
                        $result[] = $value;
                    }
                }
            }
            return $result;
            }
        }

        function av($dir, $f, $k) {
            $source = file_get_contents( 'public/tp/'.$dir.'/view/home/page/'.$f );
            $tokens = token_get_all( $source );
            $comment = array(
                T_COMMENT,      // All comments since PHP5
            );
            $kk = [];
            foreach( $tokens as $token ) {
                if( !in_array($token[0], $comment) )
                    continue;
                $txt = $token[1];
                if($k) {
                    preg_match('/start(.+)end/', $txt, $keyName);
                    if(!empty($keyName)) {
                        $kk[trim($keyName[1])] = trim($keyName[1]);
                    }
                } else {
                    preg_match('/Page Template/', $txt, $matches);
                    if(!empty($matches)) {
                        preg_match('/:(.+) */', $txt, $matche);
                        return $matche[1];
                    }
                }
            }
            return $kk;
        }
        $file  = dirToArray('public/tp/'.$dir.'/view/home/page');
        $ac = [];
        if(is_dir('public/tp/'.$dir.'/view/home/page')) {
            foreach($file as $f) {
                $ff = av($dir, $f, false);
                if($ff) {
                    $ac[$f] = $ff;
                } else {
                    $ac[$f] = $f;
                }
            }
            $keyName = '';
            $templateCurrent = 'index.phtml';
            $kc = av($dir, $templateCurrent, true);
            if($kc) {
                $keyName = $kc;
            }
            $postTemplate = $this->getRequest()->getPost()['template'];
            if($postTemplate) {
                $keyName = '';
                $templateCurrent = 'public/tp/'.$dir.'/view/home/page/'.$postTemplate ? $postTemplate:'index.phtml';
                $kc = av($dir, $templateCurrent, true);
                if($kc) {
                    $keyName = $kc;
                }
                $viewModel = new ViewModel();
                $viewModel->setTemplate('/admin/page/module');
                $viewModel->setTerminal($this->getRequest()->getPost('terminal', false));

                $viewModel->setVariables([
                    'keyName' => $keyName,
                ]);
                return $viewModel;
            }
        }

        $pageMapper = $this->getServiceLocator()->get('Admin\Model\PageMapper');
		$form = new \Admin\Form\Page();
		if($this->getRequest()->isPost()) {
			$form->setData(array_merge_recursive($this->getRequest()->getPost()->toArray(),$this->getRequest()->getFiles()->toArray()));
			if($form->isValid()){
                $data = $form->getData();
                /***** Image *****/
                $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaMapper');
                $mediaItemMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');

                if(isset($data['images']) && $data['images'] != '') {
                    $imgJson = [];
                    $imagesArray = explode(',', $data['images']);
                    foreach($imagesArray as $i) {
                        $media = new \Admin\Model\Media();
                        $media->setId($i);
                        $rm = $mediaMapper->get($media);
                        if($rm) {
                            $imgJson[$i] = $rm->getPictureUri();
                        }
                    }
                    $page->setImage(json_encode($imgJson));
                }

                $page->exchangeArray($data);
                $page->setCreatedDateTime(DateBase::getCurrentDateTime());

                if(!empty($data['url'])) {
                    $productMapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');
                    $articleMapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');

                    $url = \Base\Model\Resource::slugify($data['url']);

                    $pageUrl = new \Admin\Model\Page();
                    $pageUrl->setUrl($url);
                    $pageUrl->setStoreId($storeId);
                    $pagerModelUrl = $pageMapper->get($pageUrl);

                    $pmodelUrl = new \Admin\Model\Product();
                    $pmodelUrl->setStoreId($storeId);
                    $pmodelUrl->setUrl($url);
                    $prModelUrl = $productMapper->get($pmodelUrl);

                    $modelUrl = new \Admin\Model\Article();
                    $modelUrl->setStoreId($storeId);
                    $modelUrl->setUrl($url);
                    $rModelUrl = $articleMapper->get($modelUrl);

                    if($pagerModelUrl || $rModelUrl || $prModelUrl) {
                        $url1 = substr($url, 0, -2);
                        $url2 = substr($url, -2);
                        if(is_numeric($url2)) {
                            $url = $url1 . sprintf("%02d", $url2 + 1);
                        } else {
                            $url = $url.'-01';
                        }
                        $page->setUrl($url);
                    } else {
                        $page->setUrl($url);
                    }
                }

                $content = $this->getRequest()->getPost()->toArray();
                if(!empty($content)) {
                    $extraContent = [];
                    foreach($content as $k => $v) {
                        $field = explode('_', $k);
                        if($field[0] == 'field') {
                            $extraContent[$field[1]] = $v;
                        }
                    }
                    if(!empty($extraContent)) {
                        $page->setExtraContent(json_encode($extraContent));
                    }
                }

                $pageMapper->save($page);

                $mediaItem1 = new \Admin\Model\MediaItem();
                $mediaItem1->setItemId($page->getId());
                $mediaItem1->setType(\Admin\Model\MediaItem::FILE_PAGE);
                $mediaItemMapper->deleteType($mediaItem1);

                if(isset($data['images']) && $data['images'] != '') {
                    $imagesArray = explode(',', $data['images']);
                    $c = 1;
                    foreach($imagesArray as $i){
                        if($i){
                            $mediaItem = new \Admin\Model\MediaItem();
                            $mediaItem->setType(\Admin\Model\MediaItem::FILE_PAGE);
                            $mediaItem->setItemId($page->getId());
                            $mediaItem->setFileItem($i);
                            $mediaItem->setSort($c++);
                            $mediaItem->setStoreId($storeId);
                            $mediaItemMapper->save($mediaItem);
                        }
                    }
                }
                $this->redirect()->toUrl('/admin/page');
			}
		}
		return new ViewModel(array(
            'form' => $form,
            'typePage' => $ac,
            'keyName' => $keyName,
		));
	}

	public function editAction()
    {
        $this->layout('layout/admin');
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $sl = $this->getServiceLocator();
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();

        $pageMapper = $this->getServiceLocator()->get('Admin\Model\PageMapper');
        $page = new \Admin\Model\Page();
        $page->setId($id);
        $page->setStoreId($storeId);

        if(!$pageMapper->get($page)){
            $this->redirect()->toUrl('/admin/page');
        }

        $storeService = $sl->get('Store\Service\Store');
        $uiTemplate = $storeService->getUitemplate();
        $dir = $uiTemplate->getDirectory();

        function dirToArray($dir) {
            $result = array();
            $cdir = scandir($dir);
            if(!empty($cdir)) {
                foreach ($cdir as $key => $value) {
                    if (!in_array($value,array(".",".."))) {
                        if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                            $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
                        } else {
                            $result[] = $value;
                        }
                    }
                }
            }
            return $result;
        }

        function av($dir, $f, $k) {
            $source = file_get_contents( 'public/tp/'.$dir.'/view/home/page/'.$f );
            $tokens = token_get_all( $source );
            $comment = array(
                T_COMMENT,      // All comments since PHP5
            );
            $kk = [];
            foreach( $tokens as $token ) {
                if( !in_array($token[0], $comment) )
                    continue;
                $txt = $token[1];
                if($k) {
                    preg_match('/start(.+)end/', $txt, $keyName);
                    if(!empty($keyName)) {
                        $kk[trim($keyName[1])] = trim($keyName[1]);
                    }
                } else {
                    preg_match('/Page Template/', $txt, $matches);
                    if(!empty($matches)) {
                        preg_match('/:(.+) */', $txt, $matche);
                        return $matche[1];
                    }
                }
            }
            return $kk;
        }

        $file  = dirToArray('public/tp/'.$dir.'/view/home/page');
        $ac = [];

//        if(is_dir('public/tp/'.$dir.'/view/home/page')) {
        foreach($file as $f) {
            $ff = av($dir, $f, false);
            if($ff) {
                $ac[$f] = $ff;
            } else {
                $ac[$f] = $f;
            }
        }
        $keyName = '';
        $layout = $page->getPageTemplate() ? 'public/tp/'.$dir.'/view/home/page/'.$page->getPageTemplate():'public/tp/'.$dir.'/view/home/page/index.phtml';
        $templateCurrent = '';
        if(file_exists($layout)) {
            $templateCurrent = $page->getPageTemplate();
        } else {
            $templateCurrent = 'index.phtml';
        }
        $kc = av($dir, $templateCurrent, true);
        if($kc) {
            $keyName = $kc;
        }
//        }

        $postTemplate = $this->getRequest()->getPost()['template'];
        if($postTemplate) {
            $idp = $this->getRequest()->getPost()['id'];
            $page = new \Admin\Model\Page();
            $page->setId($idp);
            $page->setStoreId($storeId);
            $pageMapper->get($page);

            $keyName = '';
            $templateCurrent = 'public/tp/'.$dir.'/view/home/page/'.$postTemplate ? $postTemplate:'index.phtml';
            $kc = av($dir, $templateCurrent, true);
            if($kc) {
                $keyName = $kc;
            }
            $viewModel = new ViewModel();
            $viewModel->setTemplate('/admin/page/module');
            $viewModel->setTerminal($this->getRequest()->getPost('terminal', false));
            $viewModel->setVariables([
                'keyName' => $keyName,
                'page' => $page,
            ]);
            return $viewModel;
        }

        $form = new \Admin\Form\Page();
        $data = $page->toFormValues();

        $mediaItem = new \Admin\Model\MediaItem();
        $mediaItem->setItemId($page->getId());
        $mediaItem->setType(\Admin\Model\MediaItem::FILE_PAGE);

        $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
        $m = $mediaMapper->fetchAll($mediaItem);
        $fI = [];
        if(isset($m)) {
            foreach($m as $i) {
                $fI[] = $i->getFileItem();
            }
        }
        $data['images'] = implode(',', $fI);
        $form->setData($data);
        if($this->getRequest()->isPost()){
            $form->setData($this->getRequest()->getPost()->toArray());
            if($form->isValid()){
                $data = $form->getData();
                /***** Image *****/
                $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaMapper');
                $mediaItemMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');

                if(isset($data['images']) && $data['images'] != ''){
                    $imgJson = [];
                    $imagesArray = explode(',', $data['images']);
                    foreach($imagesArray as $i){
                        $media = new \Admin\Model\Media();
                        $media->setId($i);
                        $rm = $mediaMapper->get($media);
                        if($rm) {
                            $imgJson[$i] = $rm->getPictureUri();
                        }
                    }
                    $page->setImage(json_encode($imgJson));
                } else {
                    $page->setImage(null);
                }

                $content = $this->getRequest()->getPost()->toArray();
                if(!empty($content)) {
                    $extraContent = [];
                    foreach($content as $k => $v) {
                        $field = explode('_', $k);
                        if($field[0] == 'field') {
                            $extraContent[$field[1]] = $v;
                        }
                    }
                    if(!empty($extraContent)) {
                        $page->setExtraContent(json_encode($extraContent));
                    }
                }


                $page->exchangeArray($data);
                $page->setCreatedDateTime(DateBase::getCurrentDateTime());

                if(!empty($data['url'])) {
                    $productMapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');
                    $articleMapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');

                    $url = \Base\Model\Resource::slugify($data['url']);

                    $pageUrl = new \Admin\Model\Page();
                    $pageUrl->setUrl($url);
                    $pageUrl->setStoreId($storeId);
                    $pagerModelUrl = $pageMapper->get($pageUrl);

                    $pmodelUrl = new \Admin\Model\Product();
                    $pmodelUrl->setStoreId($storeId);
                    $pmodelUrl->setUrl($url);
                    $prModelUrl = $productMapper->get($pmodelUrl);

                    $modelUrl = new \Admin\Model\Article();
                    $modelUrl->setStoreId($storeId);
                    $modelUrl->setUrl($url);
                    $rModelUrl = $articleMapper->get($modelUrl);

                    if($pagerModelUrl && $pageUrl->getId() != $id || $rModelUrl || $prModelUrl) {
                        $url1 = substr($url, 0, -2);
                        $url2 = substr($url, -2);
                        if(is_numeric($url2)) {
                            $url = $url1 . sprintf("%02d", $url2 + 1);
                        } else {
                            $url = $url.'-01';
                        }
                        $page->setUrl($url);
                    } else {
                        $page->setUrl($url);
                    }
                }
                $pageMapper->save($page);

                $mediaItem1 = new \Admin\Model\MediaItem();
                $mediaItem1->setItemId($page->getId());
                $mediaItem1->setType(\Admin\Model\MediaItem::FILE_PAGE);
                $mediaItemMapper->deleteType($mediaItem1);

                if(isset($data['images']) && $data['images'] != ''){
                    $imagesArray = explode(',', $data['images']);
                    $c = 1;
                    foreach($imagesArray as $i){
                        if($i){
                            $mediaItem = new \Admin\Model\MediaItem();
                            $mediaItem->setType(\Admin\Model\MediaItem::FILE_PAGE);
                            $mediaItem->setItemId($page->getId());
                            $mediaItem->setFileItem($i);
                            $mediaItem->setSort($c++);
                            $mediaItem->setStoreId($storeId);
                            $mediaItemMapper->save($mediaItem);
                        }
                    }
                }

                $this->redirect()->toUrl('/admin/page');
            }
        }
        return new ViewModel(array(
            'form' => $form,
            'itemId' => $id,
            'typePage' => $ac,
            'page' => $page,
            'keyName' => $keyName,
        ));
	}


	public function changeAction(){

        $id = $this->getRequest()->getPost()['id'];
		$mapper = $this->getServiceLocator()->get('Admin\Model\PageMapper');
        $page = new \Admin\Model\Page();
        $page->setId($id);

        if(!$mapper->get($page)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy bài viết này'
            ));
        }
		
		if(($page->getStatus()) == \Admin\Model\Page::STATUS_ACTIVE){
            $page->setStatus(\Admin\Model\Page::STATUS_INACTIVE);
		}
		else{
            $page->setStatus(\Admin\Model\Page::STATUS_ACTIVE);
		}
		$mapper->save($page);
        return new JsonModel(array(
            'code'=> 1,
            'messenger' => 'Đã thay đổi',
            'status' => $page->getStatus()
        ));
	}

	public function deleteAction(){

        $id = $this->getRequest()->getPost()['id'];
        if(!is_numeric($id)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy bài viết này'
            ));
        }

        $mapper = $this->getServiceLocator()->get('Admin\Model\PageMapper');
        $page = new \Admin\Model\Page();
        $page->setId($id);

        if(!$mapper->get($page)){
            return new JsonModel(array(
                'code' => 0,
                'messenger' => 'Chúng tôi không tìm thấy bài viết này'
            ));
        }

        $mapper->delete($page);

        return new JsonModel(array(
			'code' => 1,
            'messenger' => 'Đã xóa'
		));
	}

    public function findType($url) {
        preg_match_all('/\-p(\d+)/', $url, $p_preg);
        if($p_preg[1][0]) {
            return ['type' => 'product', 'id' => $p_preg[1][0]];
        }
        preg_match_all('/\-p(\n+)/', $url, $n_preg);
        if($n_preg[1][0]) {
            return ['type' => 'article', 'id' => $n_preg[1][0]];
        }
        preg_match_all('/\-pa(\d+)/', $url, $p_preg);
        if($p_preg[1][0]) {
            return ['type' => 'page', 'id' => $p_preg[1][0]];
        }
        preg_match_all('/\-p(\d+)/', $url, $p_preg);
        if($p_preg[1][0]) {
            return ['type' => 'product', 'id' => $p_preg[1][0]];
        }
        preg_match_all('/\-p(\d+)/', $url, $p_preg);
        if($p_preg[1][0]) {
            return ['type' => 'product', 'id' => $p_preg[1][0]];
        }
        return false;
    }

	public function homepageAction()
    {
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
        $value = json_decode($storeDomain->getOptionPage(), true);

        if($this->getRequest()->getPost()['update']) {
            if(!empty($value)) {
                $optionHomepage = [];
                foreach($value as $k => $v) {
                    if(is_array($v)) {
                        if(!empty($v)) {
                            $pv = [];
                            foreach($v as $i => $o) {

                                $type = explode('_', $i);
                                if($type[1] == 'product') {
                                    $product = new \Admin\Model\Product();
                                    $product->setId((int)$o['id']);
                                    $r = $productMapper->get($product);
                                    if(!empty($r)) {
                                        $pv[(int)$o['id'].'_product'] = ['id' => $r->getId(), 'url' => $r->getViewLink(), 'title' => $r->getTitle(), 'price' => $r->getPrice(), 'priceOld' => $r->getPriceOld(), 'image' => $r->getImage(), 'intro' => $r->getIntro(), 'extraContent' => $r->getExtraContent()];
                                    }
                                }elseif ($type[1] == 'article') {
                                    $articleMapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
                                    $articleR = new \Admin\Model\Article();
                                    $articleR->setId((int)$o['id']);
                                    $r = $articleMapper->get($articleR);
                                    if (!empty($r)) {
                                        $pv[(int)$o['id'].'_article'] = ['id' => $r->getId(), 'url' => $r->getViewLink(), 'title' => $r->getTitle(), 'intro' => $r->getDescription(), 'image'=> $r->getImage(), 'category' => $r->getCateName(), 'date' => $r->getCreatedDateTime(), 'extraContent' => $r->getExtraContent()];
                                    }
                                }elseif ($type[1] == 'page') {
                                    $pageMapper = $this->getServiceLocator()->get('Admin\Model\PageMapper');
                                    $pageR = new \Admin\Model\Page();
                                    $pageR->setId((int)$o['id']);
                                    $pr = $pageMapper->get($pageR);
                                    if (!empty($pr)) {
                                        $pv[(int)$o['id'].'_page'] = ['id' => $pr->getId(), 'url' => $pr->getViewLink(), 'title' => $pr->getName(), 'image' => $pr->getImage(), 'description' => $pr->getDescription()];
                                    }
                                }elseif ($type[1] == 'banner') {
                                    $bannerMapper = $this->getServiceLocator()->get('Admin\Model\BannerMapper');
                                    $bannerR = new \Admin\Model\Banner();
                                    $bannerR->setId((int)$o['id']);
                                    $r = $bannerMapper->get($bannerR);
                                    if (!empty($r)) {
                                        $pv[(int)$o['id'].'_banner'] = ['id' => $r->getId(), 'url' => $r->getLink(), 'title' => $r->getName(), 'image' => $r->getImage(), 'description' => $r->getDescription()];
                                    }
                                }elseif ($type[1] == 'categoryproduct') {
                                    $productcMapper = $this->getServiceLocator()->get('Admin\Model\ProductcMapper');
                                    $categoryR = new \Admin\Model\Productc();
                                    $categoryR->setId((int)$o['id']);
                                    $categoryR->setStoreId($storeId);
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
                                        $pv[(int)$o['id'].'_categoryproduct'] = ['id' => $r->getId(), 'url' => $r->getViewLink(), 'title' => $r->getName(), 'image' => $r->getImage(), 'child' => $child];
                                    }
                                }elseif ($type[1] == 'categoryarticle') {
                                    $articlecMapper = $this->getServiceLocator()->get('Admin\Model\ArticlecMapper');
                                    $articleC = new \Admin\Model\Articlec();
                                    $articleC->setId((int)$o['id']);
                                    $articleC->setStoreId($storeId);
                                    $r = $articlecMapper->get($articleC);
                                    if (!empty($r)) {
                                        $articleCc = new \Admin\Model\Articlec();
                                        $articleCc->setParentId($r->getId());
                                        $rPs = $articlecMapper->fetchAll2($articleCc);
                                        $child = [];
                                        if(!empty($rPs)) {
                                            foreach($rPs as $pa) {
                                                $child[] = ['id' => $pa->getId(), 'url' => $pa->getViewLink(), 'title' => $pa->getName()];
                                            }
                                        }
                                        $pv[(int)$o['id'].'_categoryarticle'] = ['id' => $r->getId(), 'url' => $r->getViewLink(), 'title' => $r->getName(), 'child' => $child];
                                    }
                                }
                            }
                            $optionHomepage[$k] = $pv;
                        }
                    } else {
                        $optionHomepage[$k] = $v;
                    }
                }

            }
            $storeDomain->setOptionPage(json_encode($optionHomepage));
            $domainMapper->save($storeDomain);
            return new JsonModel(array(
                'code'=> 1,
                'messenger' => 'Đã update'
            ));
        }

        if (!file_exists('public/tp/'.$dir.'/template.php')) {
            echo 'File public/tp/'.$dir.'/template.php khong ton tai';exit();
        } else {
            if($this->getRequest()->isPost()) {
                $data = $this->getRequest()->getPost()->toArray();
                $options = [];
                foreach($data as $k => $d) {

                    $type = explode('_', $k);
//                    if(!empty($d)){
                        if($type[0] == 'product') {
                            $pv = [];
                            foreach($d as $p) {
                                $product = new \Admin\Model\Product();
                                $product->setId((int)$p);
                                $r = $productMapper->get($product);
                                if(!empty($r)) {
                                    $pv[(int)$p.'_product'] = ['id' => $r->getId(), 'url' => $r->getViewLink(), 'title' => $r->getTitle(), 'price' => $r->getPrice(), 'priceOld' => $r->getPriceOld(), 'image' => $r->getImage(), 'intro' => $r->getIntro(), 'extraContent' => $r->getExtraContent()];
                                }
                            }
                            $options[$type[1]] = $pv;
                        } elseif ($type[0] == 'article') {
                            $nv = [];
                            foreach ($d as $p) {
                                $articleMapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
                                $articleR = new \Admin\Model\Article();
                                $articleR->setId((int)$p);
                                $r = $articleMapper->get($articleR);
                                if (!empty($r)) {
                                    $nv[(int)$p.'_article'] = ['id' => $r->getId(), 'url' => $r->getViewLink(), 'title' => $r->getTitle(), 'intro' => $r->getDescription(), 'image'=> $r->getImage(), 'category' => $r->getCateName(), 'date' => $r->getCreatedDateTime(), 'extraContent' => $r->getExtraContent() ];
                                }
                            }
                            $options[$type[1]] = $nv;
                        }elseif ($type[0] == 'page') {
                            $pa = [];
                            foreach ($d as $p) {
                                $pageMapper = $this->getServiceLocator()->get('Admin\Model\PageMapper');
                                $pageR = new \Admin\Model\Page();
                                $pageR->setId((int)$p);
                                $pr = $pageMapper->get($pageR);
                                if (!empty($pr)) {
                                    $pa[(int)$p.'_page'] = ['id' => $pr->getId(), 'url' => $pr->getViewLink(), 'title' => $pr->getName(), 'image' => $pr->getImage(), 'description' => $pr->getDescription()];
                                }
                            }
                            $options[$type[1]] = $pa;
                        }elseif ($type[0] == 'banner') {
                            $bv = [];
                            foreach ($d as $p) {
                                $bannerMapper = $this->getServiceLocator()->get('Admin\Model\BannerMapper');
                                $bannerR = new \Admin\Model\Banner();
                                $bannerR->setId((int)$p);
                                $r = $bannerMapper->get($bannerR);
                                if (!empty($r)) {
                                    $bv[(int)$p.'_banner'] = ['id' => $r->getId(), 'url' => $r->getLink(), 'title' => $r->getName(), 'image' => $r->getImage(), 'description' => $r->getDescription()];
                                }
                            }
                            $options[$type[1]] = $bv;
                        }elseif ($type[0] == 'categoryproduct') {
                            $cv = [];
                            foreach ($d as $p) {
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
                            }
                            $options[$type[1]] = $cv;
                        } elseif ($type[0] == 'categoryarticle') {
                            $acs = [];
                            foreach ($d as $p) {
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
                            }
                            $options[$type[1]] = $acs;
                        } elseif ($type[0] == 'text') {
                            $options[$type[1]] = $d;
                        } elseif ($type[0] == 'textarea') {
                            $options[$type[1]] = $d;
                        } elseif ($type[0] == 'view') {
                            $options[$k] = $d;
                        }

//                    }
                }
                if(!empty($value)){
                    $storeDomain->setOptionPage(json_encode($options+$value));
                } else {
                    $storeDomain->setOptionPage(json_encode($options));
                }
                $domainMapper->save($storeDomain);
                Header('Location: /admin/page/homepage');
                Exit();
            }

            $field = include('public/tp/'.$dir.'/template.php');
//            print_r($field);die;
            return new ViewModel(array(
                'field' => $field,
                'value' => $value,
            ));
        }



    }

    public function customAction() {
        $this->layout('layout/designlayout');


    }


}






















