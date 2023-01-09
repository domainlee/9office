<?php
namespace Admin\Controller;

use Admin\Model\AttrList;
use Admin\Model\ItemTag;
use Admin\Model\Product;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\View\View;
use Admin\Model\Attr;
use Home\Model\DateBase;


class ProductController extends AbstractActionController{

	public function indexAction(){
		$this->layout('layout/admin');
        $model = new \Admin\Model\Product();
        $sl = $this->getServiceLocator();

		$mapper = $sl->get('Admin\Model\ProductMapper');
		$model->exchangeArray((array)$this->getRequest()->getQuery());
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $modelCate = new \Admin\Model\Productc();
        $modelCate->setStoreId($storeId);

        $mapperCate = $sl->get('Admin\Model\ProductcMapper');
        $category = $mapperCate->fetchAll($modelCate);
        $options['isAdmin'] = $this->user()->isSuperAdmin();
        $fFilter = new \Admin\Form\ProductSearch($options);
        $fFilter->setCategoryIds($model->toSelectBoxArray($category,\Admin\Model\Product::SELECT_MODE_ALL));

        $model->setStoreId($storeId);

        $optionMapper = $sl->get('Admin\Model\OptionMapper');
        $option = new \Admin\Model\Option();
        $option->setStoreId($storeId);
        $dataOption = $optionMapper->get($option);
        $dataOld = json_decode($dataOption->getData(), true);

		$fFilter->bind($model);
		$page = (int)$this->getRequest()->getQuery()->page ? : 1;
		$results = $mapper->search($model, array($page,20));

		return new ViewModel(array(
            'fFilter' => $fFilter,
            'results' => $results,
            'url' => $this->getRequest()->getUri()->getQuery(),
            'option' => $dataOld,
        ));
	}

    protected function getPagingParams($page = null, $icpp = null)
    {
        /* @var $request \Zend\Http\Request */
        $request = $this->getRequest();

        $page = (int)$request->getQuery('page', $page);
        $icpp = (int)$request->getQuery('icpp', $icpp);
        $options = array(
            'page' => $page > 0 ? $page : 1,
            'icpp' => $icpp > 0 ? ($icpp > 200 ? 200 : $icpp) : 30,
        );
        return $options;
    }

    public function attrAction(){
        $this->layout('layout/admin');
        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();
        $attr = new \Admin\Model\Attr();
        $attr->setStoreId($storeId);
        $mapper = $this->getServiceLocator()->get('Admin\Model\AttrMapper');
        $attr->exchangeArray($this->params()->fromQuery());
        if ($this->getRequest()->isPost()) {
            $name = $this->getRequest()->getPost()['size'];
            $color = $this->getRequest()->getPost()['color'];
            $code = $this->getRequest()->getPost()['code'];
            $material = $this->getRequest()->getPost()['material'];

            if(!empty($name)) {
                $attr->setName($name);
                $attr->setType(\Admin\Model\Attr::SIZE);
                if(!$mapper->get($attr)) {
                    $at = new \Admin\Model\Attr();
                    $at->setStoreId($storeId);
                    $at->setName($name);
                    $at->setType(\Admin\Model\Attr::SIZE);
                    $mapper->save($at);
                    return new JsonModel(array(
                        'status' => 1,
                        'messenger' => 'Đã thêm'
                    ));
                } else {
                    return new JsonModel(array(
                        'status' => 0,
                        'messenger' => 'Đã tồn tại thuộc tính này'
                    ));
                }
            }
            if(!empty($material)) {
                $attr->setName($material);
                $attr->setType(\Admin\Model\Attr::MATERIAL);
                if(!$mapper->get($attr)) {
                    $at = new \Admin\Model\Attr();
                    $at->setStoreId($storeId);
                    $at->setName($material);
                    $at->setType(\Admin\Model\Attr::MATERIAL);
                    $mapper->save($at);
                    return new JsonModel(array(
                        'status' => 1,
                        'messenger' => 'Đã thêm'
                    ));
                } else {
                    return new JsonModel(array(
                        'status' => 0,
                        'messenger' => 'Đã tồn tại thuộc tính này'
                    ));
                }
            }
            if(!empty($color) && !empty($code)){
                $attr->setName($color);
                $attr->setColorCode($code);
                $attr->setType(\Admin\Model\Attr::COLOR);
                if(!$mapper->get($attr)) {
                    $at = new \Admin\Model\Attr();
                    $at->setStoreId($storeId);
                    $at->setName($color);
                    $at->setColorCode($code);
                    $at->setType(\Admin\Model\Attr::COLOR);
                    $mapper->save($at);
                    return new JsonModel(array(
                        'status' => 1,
                        'messenger' => 'Đã thêm'
                    ));
                } else {
                    return new JsonModel(array(
                        'status' => 0,
                        'messenger' => 'Đã tồn tại thuộc tính này'
                    ));
                }
            }
        }
        $results = $mapper->search($attr, array($page, 30));
        return new ViewModel(array(
            'results' => $results
        ));
    }

    public function deleteattrAction(){
        $id = $this->getRequest()->getPost()['id'];
        if(!is_numeric($id)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Không tìm thấy thuộc tính này'
            ));
        }
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $attrMapper = $this->getServiceLocator()->get('Admin\Model\AttrMapper');
        $attr = new \Admin\Model\Attr();
        $attr->setId($id);
        $attr->setStoreId($storeId);

        if(!$attrMapper->get($attr)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Không tìm thấy thuộc tính này'
            ));
        }
        $attrMapper->delete($attr);
        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Đã xóa'
        ));
    }

	public function changeactiveAction(){
		$this->layout('layout\admin');
		$id = $this->getEvent()->getRouteMatch()->getParam('id');
		$mapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');
		$model = $mapper->getId($id);
		if($model->getStatus() == \Admin\Model\Product::STATUS_ACTIVE){
			$model->setStatus(\Admin\Model\Product::STATUS_INACTIVE);
		}
		else{
			$model->setStatus(\Admin\Model\Product::STATUS_ACTIVE);
		}
		$mapper->save($model);
		$this->redirect()->toUrl('/admin/product');
	}
	
	public function addAction(){
		$this->layout('layout/admin');
		$model = new \Admin\Model\Product();
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();
        $model->setCreatedById($u->getId());
        $model->setCreatedDateTime(DateBase::getCurrentDateTime());
        $model->setStoreId($storeId);
        $model->setStatus(Product::STATUS_ACTIVE);

        $modelCate = new \Admin\Model\Productc();
        $modelCate->setStoreId($storeId);

		$mapperCate = $this->getServiceLocator()->get('Admin\Model\ProductcMapper');
        $mapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');

        $category = $mapperCate->fetchAll($modelCate);

		$modelSt = new \Admin\Model\Store();
        $modelSt->setId($storeId);

		$mapperSt = $this->getServiceLocator()->get('Admin\Model\StoreMapper');

		$attr = new \Admin\Model\Attr();
        $attr->setType(\Admin\Model\Attr::COLOR);
        $attr->setStoreId($storeId);
        $attrMapper = $this->getServiceLocator()->get('Admin\Model\AttrMapper');
        $attrlistMapper = $this->getServiceLocator()->get('Admin\Model\AttrListMapper');
        $attrs = $attrMapper->fetchAll($attr);

        $a = [];
        foreach($attrs as $b){
            $a[$b->getId()] = ['label' => $b->getName(), 'value' => $b->getId()];
        }

        $s = [];
        $attr = new \Admin\Model\Attr();
        $attr->setType(\Admin\Model\Attr::SIZE);
        $attr->setStoreId($storeId);
        $attrs = $attrMapper->fetchAll($attr);
        foreach($attrs as $b){
            $s[$b->getId()] = ['label' => $b->getName(), 'value' => $b->getId()];
        }

        $m = [];
        $attr = new \Admin\Model\Attr();
        $attr->setType(\Admin\Model\Attr::MATERIAL);
        $attr->setStoreId($storeId);
        $attrs = $attrMapper->fetchAll($attr);
        foreach($attrs as $b){
            $m[$b->getId()] = ['label' => $b->getName(), 'value' => $b->getId()];
        }

        $brand = new \Admin\Model\Brand();
        $brand->setStoreId($storeId);
        $brandMapper = $this->getServiceLocator()->get('Admin\Model\BrandMapper');
        $rBrand = $brandMapper->fetchAll($brand);

        $form = new \Admin\Form\Product($this->getServiceLocator(), null);
		$form->setCategoryIds($model->toSelectBoxArray($category,\Admin\Model\Product::SELECT_MODE_ALL));

		$productParent = new \Admin\Model\Product();
		$productParent->setStoreId($storeId);
        $productParents = $mapper->fetchArray($productParent);
		$form->setParent($productParents);

        if(count($rBrand)){
            $form->setBrandId($brand->fetchAllBrand($rBrand));
        }
        $form->setColor($a);
        $form->setSize($s);
        $form->setMaterial($m);
        $form->bind($model);

        /****** Option Field ********/
        $optionMapper = $this->getServiceLocator()->get('Admin\Model\OptionMapper');
        $option = new \Admin\Model\Option();
        $option->setStoreId($storeId);
        $optionMapper->get($option);
        if(!empty($option->getProductField())) {
            $productField = json_decode($option->getProductField(), true);
        }

        if($this->getRequest()->isPost()){
                $form->setData(array_merge_recursive($this->getRequest()->getPost()->toArray(),$this->getRequest()->getFiles()->toArray()));
                if($form->isValid($edit = 2)){
                    $data = $form->getData();
                    $productRelated = $data->getProductRelated();
                    $articleRelated = $data->getArticleRelated();
                    if($productRelated) {
                        $productRelateds = [];
                        foreach($productRelated as $p) {
                            $productR = new \Admin\Model\Product();
                            $productR->setId((int)$p);
                            $r = $mapper->get($productR);
                            if(!empty($r)) {
                                $productRelateds[] = ['id' => $r->getId(), 'url' => $r->getViewLink(), 'title' => $r->getTitle(), 'image' => $r->getImage(),'price' => $r->getPrice(), 'priceOld' => $r->getPriceOld()];
                            }
                        }
                    }

                    if($articleRelated) {
                        $articleRelateds = [];
                        foreach($articleRelated as $p) {
                            $articleMapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
                            $articleR = new \Admin\Model\Article();
                            $articleR->setId((int)$p);
                            $r = $articleMapper->get($articleR);
                            if(!empty($r)) {
                                $articleRelateds[] = ['id' => $r->getId(), 'url' => $r->getViewLink(), 'title' => $r->getTitle(), 'image' => $r->getImage()];
                            }
                        }
                    }

                    $mediaItemMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
                    $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaMapper');
                    $postImages = $this->getRequest()->getPost()['images'];
                    $model->setId(null);
                    if(!empty($productRelateds)) {
                        $model->setProductRelated(json_encode($productRelateds));
                    }
                    if(!empty($articleRelateds)) {
                        $model->setArticleRelated(json_encode($articleRelateds));
                    }
                    if(isset($postImages) && $postImages != ''){
                        $imgJson = [];
                        $imagesArray = explode(',', $postImages);
                        foreach($imagesArray as $i){
                            $media = new \Admin\Model\Media();
                            $media->setId($i);
                            $rm = $mediaMapper->get($media);
                            if($rm) {
                                $imgJson[$i] = $rm->getPictureUri();
                            }
                        }
                        $model->setImage(json_encode($imgJson));
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
                            $model->setExtraContent(json_encode($extraContent));
                        }
                    }

                    if(!empty($data->getUrl())) {
                        $url = \Base\Model\Resource::slugify($data->getUrl());

                        $pageMapper = $this->getServiceLocator()->get('Admin\Model\PageMapper');
                        $pageUrl = new \Admin\Model\Page();
                        $pageUrl->setUrl($url);
                        $pageUrl->setStoreId($storeId);
                        $pagerModelUrl = $pageMapper->get($pageUrl);

                        $modelUrl = new \Admin\Model\Product();
                        $modelUrl->setStoreId($storeId);
                        $modelUrl->setUrl($url);
                        $rModelUrl = $mapper->get($modelUrl);

                        $articleMapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
                        $modelArticle = new \Admin\Model\Article();
                        $modelArticle->setStoreId($storeId);
                        $modelArticle->setUrl($url);
                        $rArticle = $articleMapper->get($modelArticle);

                        if($rModelUrl || $rArticle || $pagerModelUrl) {
                            $url1 = substr($url, 0, -2);
                            $url2 = substr($url, -2);
                            if(is_numeric($url2)) {
                                $url = $url1 . sprintf("%02d", $url2 + 1);
                            } else {
                                $url = $url.'-01';
                            }
                            $model->setUrl($url);
                        } else {
                            $model->setUrl($url);
                        }
                    }

                    $mapper->save($model);
                    $attrlistMapper->update($model->getId(), \Admin\Model\AttrList::COLOR, $this->getRequest()->getPost()['color'], $storeId);
                    $attrlistMapper->update($model->getId(), \Admin\Model\AttrList::SIZE, $this->getRequest()->getPost()['size'], $storeId);
                    $attrlistMapper->update($model->getId(), \Admin\Model\AttrList::MATERIAL, $this->getRequest()->getPost()['material'], $storeId);
                    //Check exits cần một vòng for query select sẽ dài hơn where in id delete. Nên chỗ này xóa đi rồi saves
                    $mediaItemMapper->deleteFileProduct($model->getId());

                    if(isset($postImages) && $postImages != ''){
                        $imgJson = [];
                        $imagesArray = explode(',', $postImages);
                        $c = 1;
                        foreach($imagesArray as $i){
                            if($i){
                                $mediaItem = new \Admin\Model\MediaItem();
                                $mediaItem->setType(\Admin\Model\MediaItem::FILE_PRODUCT);
                                $mediaItem->setItemId((int)$model->getId());
                                $mediaItem->setFileItem((int)$i);
                                $mediaItem->setSort($c++);
                                $mediaItem->setStoreId($storeId);
                                $mediaItemMapper->save($mediaItem);
                            }
                            $media = new \Admin\Model\Media();
                            $media->setId($i);
                            $rm = $mediaMapper->get($media);
                            if($rm) {
                                $imgJson[$i] = $rm->getPictureUri();
                            }
                        }
                    }

                    $this->redirect()->toUrl('/admin/product');
                }else {
                    $form->getErrorMessagesList();
                }
			}
			return new ViewModel(array(
                'form' => $form,
                'field' => !empty($productField) ? $productField:null,
			));
	}

	public function editAction(){
		$this->layout('layout/admin');
		if(!($id = $this->getEvent()->getRouteMatch()->getParam('id'))){
			$this->redirect()->toUrl('/admin/product');
		}
        $slug = $this->getRequest()->getUri()->getQuery();
        if(!is_numeric($id)){
            $this->redirect()->toUrl('/admin/product');
        }
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $product = new \Admin\Model\Product();
        $product->setId($id);
        $product->setStoreId($storeId);
        $mapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');
		if(!$mapper->get($product)){
            $this->redirect()->toUrl('/admin/product');
        }

        /******* category ********/
		$modelCate = new \Admin\Model\Productc();
        $mappercate = $this->getServiceLocator()->get('Admin\Model\ProductcMapper');
//        $u = $this->getServiceLocator()->get('User\Service\User');
        if(!$this->user()->isSuperAdmin()){
            $modelCate->setStoreId($storeId);
        }
		$category = $mappercate->fetchAll($modelCate);

        /******* store ********/
//        echo $u->getUser()->getStoreId();die;
		$modelSt = new \Admin\Model\Store();
        if(!$this->user()->isSuperAdmin()){
            $modelSt->setId($storeId);
        }
		$mapperSt = $this->getServiceLocator()->get('Admin\Model\StoreMapper');

        /********* Attr **********/
        $attrl =  new AttrList();
        $attrl->setProductId($id);
        $attrlistMapper = $this->getServiceLocator()->get('Admin\Model\AttrListMapper');
        $al = $attrlistMapper->fetchAll($attrl);
        $ala = [];
        foreach($al as $c){
            $ala[] = $c->getProductattrId();
        }
        $attr = new \Admin\Model\Attr();
        $attr->setType(\Admin\Model\Attr::COLOR);
        $attr->setStoreId($storeId);
        $attrMapper = $this->getServiceLocator()->get('Admin\Model\AttrMapper');
        $attrs = $attrMapper->fetchAll($attr);
        $a = [];
        foreach($attrs as $b){
            if(in_array($b->getId(), $ala)){
                $a[$b->getId()] = ['label' => $b->getName(), 'value' => $b->getId(), 'selected' => true];
            }else{
                $a[$b->getId()] = ['label' => $b->getName(), 'value' => $b->getId()];
            }
        }
        /**** productRelated ****/
        if($product->getProductRelated()) {
            $productR = json_decode($product->getProductRelated());
            if(!empty($productR)) {
                $pr = [];
                foreach($productR as $p) {
                    $pr[$p->id] = ['label' => $p->title, 'value' => $p->id, 'selected' => true];
                }
            }
        }
        $ar = [];
        if($product->getArticleRelated()) {
            $articleR = json_decode($product->getArticleRelated());
            if(!empty($articleR)) {
                foreach($articleR as $p) {
                    $ar[$p->id] = ['label' => $p->title, 'value' => $p->id, 'selected' => true];
                }
            }
        }

        $attr = new \Admin\Model\Attr();
        $attr->setType(\Admin\Model\Attr::SIZE);
        $attr->setStoreId($storeId);
        $attrs = $attrMapper->fetchAll($attr);
        $s = [];
        foreach($attrs as $b){
            if(in_array($b->getId(), $ala)){
                $s[$b->getId()] = ['label' => $b->getName(), 'value' => $b->getId(), 'selected' => true];
            }else{
                $s[$b->getId()] = ['label' => $b->getName(), 'value' => $b->getId()];
            }
        }

        $attr = new \Admin\Model\Attr();
        $attr->setType(\Admin\Model\Attr::MATERIAL);
        $attr->setStoreId($storeId);
        $attrs = $attrMapper->fetchAll($attr);
        $m = [];
        foreach($attrs as $b){
            if(in_array($b->getId(), $ala)){
                $m[$b->getId()] = ['label' => $b->getName(), 'value' => $b->getId(), 'selected' => true];
            }else{
                $m[$b->getId()] = ['label' => $b->getName(), 'value' => $b->getId()];
            }
        }

        /******** Brand **********/
        $brand = new \Admin\Model\Brand();
        $brand->setStoreId($storeId);
        $brandMapper = $this->getServiceLocator()->get('Admin\Model\BrandMapper');
        $rBrand = $brandMapper->fetchAll($brand);

        /******** Form **********/
//        $form = new \Admin\Form\Product();
        $form = new \Admin\Form\Product($this->getServiceLocator(), null);
        $form->setCategoryIds($product->toSelectBoxArray($category,\Admin\Model\Product::SELECT_MODE_ALL));
//		$form->setStoreIds($modelSt->toSelectBoxArray($mapperSt->fetchAll($modelSt)));
        $productParentId = new \Admin\Model\Product();
        $productParentId->setParentId($product->getId());
        $productParentId->setStoreId($storeId);
        $productParentIdr = $mapper->fetchAll($productParentId);

        $productParent = new \Admin\Model\Product();
        $productParent->setStoreId($storeId);
        $productParents = $mapper->fetchArray($productParent);

        $form->setParent($productParents);
        $form->setColor($a);
        $form->setSize($s);
        $form->setMaterial($m);

        $form->setProductRelated($pr);
        $form->setArticleRelated($ar);
        $form->setBrandId($brand->fetchAllBrand($rBrand));

        $data = $product->toFormValues();
        $status  = $data['status'];
        $createdById  = $data['createdById'];
        $type  = $data['type'];
        $view  = $data['view'];
//        $url  = $data['url'];
        $extraContent1 = json_decode($data['extraContent'], true);

        $mediaItem = new \Admin\Model\MediaItem();
        $mediaItem->setItemId($id);
        $mediaItem->setType(\Admin\Model\MediaItem::FILE_PRODUCT);

        $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
        $m = $mediaMapper->fetchAll($mediaItem);
        $fI = [];
        if(isset($m)){
            foreach($m as $i){
                $fI[] = $i->getFileItem();
            }
        }
        $data['images'] = implode(',', $fI);
        $form->setData($data);

        /****** Option Field ********/
        $optionMapper = $this->getServiceLocator()->get('Admin\Model\OptionMapper');
        $option = new \Admin\Model\Option();
        $option->setStoreId($storeId);
        $optionMapper->get($option);
        if(!empty($option->getProductField())) {
            $productField = json_decode($option->getProductField(), true);
        }

		if($this->getRequest()->isPost()){
            $form->setData(array_merge_recursive($this->getRequest()->getPost()->toArray(),$this->getRequest()->getFiles()->toArray()));
            if($form->isValid($edit = 1)){
                $data = $form->getData();
                $attrlistMapper = $this->getServiceLocator()->get('Admin\Model\AttrListMapper');
                $mediaItemMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
                $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaMapper');

                if($this->getRequest()->getPost()){
                    $attrlistMapper->update($id, \Admin\Model\AttrList::COLOR, $this->getRequest()->getPost()['color'], $storeId);
                    $attrlistMapper->update($id, \Admin\Model\AttrList::SIZE, $this->getRequest()->getPost()['size'], $storeId);
                    $attrlistMapper->update($id, \Admin\Model\AttrList::MATERIAL, $this->getRequest()->getPost()['material'], $storeId);
                }

                $productRelated = $data['productRelated'];
                $articleRelated = $data['articleRelated'];

                if($productRelated) {
                    $productRelateds = [];
                    foreach($productRelated as $p) {
                        $productR = new \Admin\Model\Product();
                        $productR->setId((int)$p);
                        $r = $mapper->get($productR);
                        if(!empty($r)) {
                            $productRelateds[] = ['id' => $r->getId(), 'url' => $r->getViewLink(), 'title' => $r->getTitle(), 'image' => $r->getImage(), 'price' => $r->getPrice(), 'priceOld' => $r->getPriceOld()];
                        }
                    }
                }

                if($articleRelated) {
                    $articleRelateds = [];
                    foreach($articleRelated as $p) {
                        $articleMapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
                        $articleR = new \Admin\Model\Article();
                        $articleR->setId((int)$p);
                        $r = $articleMapper->get($articleR);
                        if(!empty($r)) {
                            $articleRelateds[] = ['id' => $r->getId(), 'url' => $r->getViewLink(), 'title' => $r->getTitle(), 'image' => $r->getImage()];
                        }
                    }
                }

                $mapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');

                $model = new \Admin\Model\Product();
                $model->exchangeArray($data);
                $model->setId($id);
                $model->setCreatedDateTime(DateBase::getCurrentDateTime());
                $model->setStoreId($storeId);
                $model->setStatus($status);
                $model->setCreatedById($createdById);
                $model->setType($type);
                $model->setView($view);

                $url = \Base\Model\Resource::slugify($data['url']);
                if(!empty($url)) {
                    $pageMapper = $this->getServiceLocator()->get('Admin\Model\PageMapper');
                    $pageUrl = new \Admin\Model\Page();
                    $pageUrl->setUrl($url);
                    $pageUrl->setStoreId($storeId);
                    $pagerModelUrl = $pageMapper->get($pageUrl);

                    $modelUrl = new \Admin\Model\Product();
                    $modelUrl->setStoreId($storeId);
                    $modelUrl->setUrl($url);
                    $rModelUrl = $mapper->get($modelUrl);

                    $articleMapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
                    $amodelUrl = new \Admin\Model\Article();
                    $amodelUrl->setStoreId($storeId);
                    $amodelUrl->setUrl($url);
                    $arModelUrl = $articleMapper->get($amodelUrl);

                    if($rModelUrl && $modelUrl->getId() != $id || $arModelUrl || $pagerModelUrl) {
                        $url1 = substr($url, 0, -2);
                        $url2 = substr($url, -2);
                        if(is_numeric($url2)) {
                            $url = $url1 . sprintf("%02d", $url2 + 1);
                        } else {
                            $url = $url.'-01';
                        }
                        $model->setUrl($url);
                    } else {
                        $model->setUrl($url);
                    }
                }

                if(!empty($productRelateds)) {
                    $model->setProductRelated(json_encode($productRelateds));
                }

                if(!empty($articleRelateds)) {
                    $model->setArticleRelated(json_encode($articleRelateds));
                }

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
                    $model->setImage(json_encode($imgJson));
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
                        $model->setExtraContent(json_encode($extraContent));
                    }
                }

                $mapper->save($model);
                //Check exits cần một vòng for query select sẽ dài hơn where in id delete. Nên chỗ này xóa đi rồi saves
                $mediaItemMapper->deleteFileProduct($id);
                if(isset($data['images']) && $data['images'] != ''){
                    $imagesArray = explode(',', $data['images']);
                    $c = 1;
                    foreach($imagesArray as $i){
                        if($i){
                            $mediaItem = new \Admin\Model\MediaItem();
                            $mediaItem->setType(\Admin\Model\MediaItem::FILE_PRODUCT);
                            $mediaItem->setItemId($model->getId());
                            $mediaItem->setFileItem($i);
                            $mediaItem->setSort($c++);
                            $mediaItem->setStoreId($storeId);
                            $mediaItemMapper->save($mediaItem);
                        }
                    }
                }
                $this->redirect()->toUrl('/admin/product?'.$slug);
			}
		}
		return new ViewModel(array(
			'form' => $form,
            'itemId' => $id,
            'field' => !empty($productField) ? $productField:null,
            'extraContent' => $extraContent1,
            'parentProduct' => $productParentIdr
		));
	}

	public function deleteAction(){
        $id = $this->getRequest()->getPost()['id'];
        if(!is_numeric($id)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy sản phẩm này'
            ));
        }

        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

		$mapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');
        $product = new \Admin\Model\Product();
        $product->setId($id);
        $product->setStoreId($storeId);

		if(!$mapper->get($product)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy sản phẩm này'
            ));
        }

//        $product = clone($product);
		$mapper->delete($product);

        $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
        $mediaMapper->deleteFileProduct($product->getId());

        $attrlistMapper = $this->getServiceLocator()->get('Admin\Model\AttrListMapper');

        $attrlistMapper->update($product->getId(), \Admin\Model\AttrList::COLOR, null, $storeId);
        $attrlistMapper->update($product->getId(), \Admin\Model\AttrList::SIZE, null, $storeId);


		return new JsonModel(array(
			'code' => 1,
            'messenger' => 'Đã xóa'
		));
	}

    public function categoryAction(){

        $this->layout('layout/admin');
//        $storeId = $this->getServiceLocator()->get('Store\Service\Store')->getStoreId();

        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $model = new \Admin\Model\Productc();
        $mapper = $this->getServiceLocator()->get('Admin\Model\ProductcMapper');
        $modelCate = new \Admin\Model\Productc();
        $mapperCate = $this->getServiceLocator()->get('Admin\Model\ProductcMapper');
        $category = $mapperCate->fetchAll($modelCate);
        $abc = $model->toSelectBoxArray($category,\Admin\Model\Product::SELECT_MODE_ALL);
        $model->exchangeArray((array)$this->getRequest()->getQuery());

//        print_r((array)$this->getRequest()->getQuery());die;

        $u = $this->getServiceLocator()->get('User\Service\User');
        $options['isAdmin'] = $this->user()->isSuperAdmin();
        $fFilter = new \Admin\Form\ProductcSearch($options);
//        $fFilter = new \Admin\Form\ProductSearch($options);
        $model->setStoreId($storeId);

        $fFilter->bind($model);
        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $results = $mapper->search($model, array($page,15));

        return new ViewModel(array(
                'results'=>$results,
                'fFilter'=>$fFilter,
                'abc'=>$abc,
                'url' => $this->getRequest()->getUri()->getQuery()
        ));
    }

    public function addcategoryAction()
    {
        $this->layout('layout/admin');
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();
        $model = new \Admin\Model\Productc();
        $mapper = $this->getServiceLocator()->get('Admin\Model\ProductcMapper');
        $model->setStoreId($storeId);
        $model->setStatus(\Admin\Model\Productc::STATUS_ACTIVE);
        $model->setUpdateTime(DateBase::getCurrentDateTime());

        $parents = $mapper->fetchAll($model);
        $fFilter = $this->getServiceLocator()->get('Admin\Form\ProductcFilter');
        $form = new \Admin\Form\Productc($this->getServiceLocator());
        $form->setInputFilter($fFilter);

        $form->setParentIds($model->toSelectboxArray($parents,\Admin\Model\Productc::SELECT_MODE_ALL));

		$form->bind($model);
		if($this->getRequest()->isPost()){
		    $data = $this->getRequest()->getPost()->toArray();
			$form->setData($data);
			if($form->isValid()){

                $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaMapper');
                $postImages = $this->getRequest()->getPost()['images'];
                if(isset($postImages) && $postImages != ''){
                    $imgJson = [];
                    $imagesArray = explode(',', $postImages);
                    foreach($imagesArray as $i){
                        $media = new \Admin\Model\Media();
                        $media->setId($i);
                        $rm = $mediaMapper->get($media);
                        if($rm) {
                            $imgJson[$i] = $rm->getPictureUri();
                        }
                    }
                    $model->setImage(json_encode($imgJson));
                }

                if(!empty($data['url'])) {
                    $model->setUrl(\Base\Model\Resource::slugify($data['url']));
                }
                $mapper->save($model);
                $mediaItemMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
                $mediaItemMapper->deleteImageCategory($model->getId());
                if(isset($postImages) && $postImages != ''){
                    $imagesArray = explode(',', $postImages);
                    $c = 1;
                    foreach($imagesArray as $i){
                        if($i){
                            $mediaItem = new \Admin\Model\MediaItem();
                            $mediaItem->setType(\Admin\Model\MediaItem::FILE_CATEGORY_PRODUCT);
                            $mediaItem->setItemId($model->getId());
                            $mediaItem->setFileItem($i);
                            $mediaItem->setSort($c++);
                            $mediaItem->setStoreId($storeId);
                            $mediaItemMapper->save($mediaItem);
                        }
                    }
                }

                $this->redirect()->toUrl('/admin/product/category');
			}
		}
        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function editcategoryAction()
    {
        $this->layout('layout/admin');
        if(!($id = $this->getEvent()->getRouteMatch()->getParam('id'))){
            $this->redirect()->toUrl('/admin/product/category');
        }
        if(!is_numeric($id)){
            $this->redirect()->toUrl('/admin/product/category');
        }
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $productCategory = new \Admin\Model\Productc();
        $productCategory->setId($id);
        $productCategory->setStoreId($storeId);

        $mapper = $this->getServiceLocator()->get('Admin\Model\ProductcMapper');

        if(!$mapper->get($productCategory)){
            $this->redirect()->toUrl('/admin/product/category');
        }

        $productCategory1 = new \Admin\Model\Productc();
        $productCategory1->setStoreId($storeId);

        $parents = $mapper->fetchAll($productCategory1);

        $modelSt = new \Admin\Model\Store();
        $mapperSt = $this->getServiceLocator()->get('Admin\Model\StoreMapper');
        $fFilter = $this->getServiceLocator()->get('Admin\Form\ProductcFilter');

        $form = new \Admin\Form\Productc($this->getServiceLocator());
        $form->setInputFilter($fFilter);

        if(!$this->user()->isSuperAdmin()){
            $modelSt->setId($storeId);
        }

        $mediaItem = new \Admin\Model\MediaItem();
        $mediaItem->setItemId($id);
        $mediaItem->setType(\Admin\Model\MediaItem::FILE_CATEGORY_PRODUCT);

        $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
        $m = $mediaMapper->fetchAll($mediaItem);
        $fI = [];
        if(isset($m)){
            foreach($m as $i){
                $fI[] = $i->getFileItem();
            }
        }
        $data = $productCategory->toFormValues();
        $data['images'] = implode(',', $fI);
        $status = $data['status'];

        $form->setParentIds($productCategory->toSelectboxArray($parents,\Admin\Model\Productc::SELECT_MODE_ALL));

        $form->setData($data);

        if($this->getRequest()->isPost()){
            $form->setData($this->getRequest()->getPost());
            if($form->isValid()){
                $data = $form->getData();
                $category1 = new \Admin\Model\Productc();

                $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaMapper');
                $postImages = $this->getRequest()->getPost()['images'];
                if(isset($postImages) && $postImages != ''){
                    $imgJson = [];
                    $imagesArray = explode(',', $postImages);
                    foreach($imagesArray as $i){
                        $media = new \Admin\Model\Media();
                        $media->setId((int)$i);
                        $rm = $mediaMapper->get($media);
                        if($rm) {
                            $imgJson[$i] = $rm->getPictureUri();
                        }
                    }
                    $category1->setImage(json_encode($imgJson));
                }
                $category1->exchangeArray((array)$data);
                $category1->setId($id);
                $category1->setParentId($form->getData()['parentId']);
                $category1->setStoreId($storeId);
                $category1->setStatus($status);
                $category1->setUpdateTime(DateBase::getCurrentDateTime());

                if(!empty($data['url'])) {
                    $category1->setUrl(\Base\Model\Resource::slugify($data['url']));
                }

                $mapper->save($category1);
                $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
                //Check exits cần một vòng for query select sẽ dài hơn where in id delete. Nên chỗ này xóa đi rồi saves
                $mediaMapper->deleteImageCategory($productCategory->getId());
                $postImages = $this->getRequest()->getPost()['images'];

                if(isset($postImages) && $postImages != ''){
                    $imagesArray = explode(',', $postImages);
                    $c = 1;
                    foreach($imagesArray as $i){
                        if($i){
                            $mediaItem = new \Admin\Model\MediaItem();
                            $mediaItem->setType(\Admin\Model\MediaItem::FILE_CATEGORY_PRODUCT);
                            $mediaItem->setItemId($productCategory->getId());
                            $mediaItem->setFileItem($i);
                            $mediaItem->setSort($c++);
                            $mediaItem->setStoreId($storeId);
                            $mediaMapper->save($mediaItem);
                        }
                    }
                }

                $this->redirect()->toUrl('/admin/product/category');
            }
        }
        return new ViewModel(array(
            'form' => $form,
            'itemId' => $id
        ));
    }

    public function deletecategoryAction(){
        $id = $this->getRequest()->getPost()['id'];
        if(!is_numeric($id)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy sản phẩm này'
            ));
        }
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $categoryMapper = $this->getServiceLocator()->get('Admin\Model\ProductcMapper');
        $category = new \Admin\Model\Productc();
        $category->setId($id);
        $category->setStoreId($storeId);

        if(!$categoryMapper->get($category)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy sản phẩm này'
            ));
        }
        $mediaItemMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
        $mediaItemMapper->deleteImageCategory($category->getId());
        $categoryMapper->delete($category);

        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Đã xóa'
        ));
    }

    public function changeAction()
    {
        $id = $this->getRequest()->getPost('id');
        $mapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');
        $product = new \Admin\Model\Product();
        $product->setId($id);

        if(!$mapper->get($product)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy sản phẩm này'
            ));
        }
        if($product->getStatus() == \Admin\Model\Product::STATUS_ACTIVE){
            $product->setStatus(\Admin\Model\Product::STATUS_INACTIVE);
        }else{
            $product->setStatus(\Admin\Model\Product::STATUS_ACTIVE);
        }
        $mapper->save($product);

        return new JsonModel(array(
            'code'=> 1,
            'messenger' => 'Đã thay đổi',
            'status' => $product->getStatus()
        ));
    }

    public function changecAction()
    {
        $viewModel = new JsonModel();

        $id = $this->getRequest()->getPost('id');
        $mapper = $this->getServiceLocator()->get('Admin\Model\ProductcMapper');
        $category = new \Admin\Model\Productc();
        $category->setId($id);

        if(!$mapper->get($category)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy sản phẩm này'
            ));
        }
        if(!$this->getRequest()->getPost('order')){
            if($category->getStatus() == \Admin\Model\Productc::STATUS_ACTIVE){
                $category->setStatus(\Admin\Model\Productc::STATUS_INACTIVE);
            }else{
                $category->setStatus(\Admin\Model\Productc::STATUS_ACTIVE);
            }
            $mapper->save($category);
            $viewModel->setVariable('code', 1);
            $viewModel->setVariable('messenger', 'Đã thay đổi');
            $viewModel->setVariable('status', $category->getStatus());
        }elseif($this->getRequest()->getPost('order')){
            $category->setUpdateTime(DateBase::getCurrentDateTime());
            $mapper->save($category);
            $viewModel->setVariable('code', 1);
            $viewModel->setVariable('messenger', 'Đã thay đổi');
        }
        return $viewModel;

    }

    public function orderAction()
    {
        $this->layout('layout/admin');
//        $this->layout('layout/adminOrder');

        $order = new \Admin\Model\Order();
        $orderMapper = $this->getServiceLocator()->get('Admin\Model\OrderMapper');
        $order->exchangeArray((array)$this->getRequest()->getQuery());
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();
        $options['isAdmin'] = $this->user()->isSuperAdmin();
        $fFilter = new \Admin\Form\ProductSearch($options);
        $order->setStoreId($storeId);
        $fFilter->bind($order);
        $page = (int)$this->getRequest()->getQuery()->page ? : 1;

        $countOrder = new \Admin\Model\Order();
        $countOrder->setStoreId($storeId);
        $countOrder->setShippingType(\Admin\Model\Order::STATUS_NEW);
        $rCount = $orderMapper->getStatus($countOrder);

        $results = $orderMapper->search($order, array($page,15));
        return new ViewModel(array(
            'fFilter' => $fFilter,
            'results' => $results,
            'url' => $this->getRequest()->getUri()->getQuery(),
            'count' => $rCount
        ));
    }

    public function orderaddAction()
    {
        $this->layout('layout/adminOrder');
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();


        $order = new \Admin\Model\Order();
        $order->setCreatedById($u->getId());
        $order->setCreatedDateTime(DateBase::getCurrentDateTime());
        $order->setStoreId($storeId);
        $order->setShippingType(1);
        $order->setCustomerEmail('agiay@gmail.com');

        $orderMapper = $this->getServiceLocator()->get('Admin\Model\OrderMapper');
        $productMapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');

        $form = new \Admin\Form\OrderProduct($this->getServiceLocator(), null);

        if($this->getRequest()->isPost()){
            $form->setData(array_merge_recursive($this->getRequest()->getPost()->toArray(),$this->getRequest()->getFiles()->toArray()));
//            print_r(array_merge_recursive($this->getRequest()->getPost()->toArray(),$this->getRequest()->getFiles()->toArray()));die;
            if($form->isValid()){
                $data = $form->getData();
                $quantity = explode(',', $data['quantity']);

                if(!empty($data['product'])) {

                    $priceTotal = 0;
                    $quantityTotal = 0;

                    foreach($data['product'] as $k => $p) {
                        $product = new \Admin\Model\Product();
                        $product->setStoreId($storeId);
                        $product->setId($p);
                        $productR = $productMapper->get($product);

                        $priceTotal += $productR->getPriceOld() ? $productR->getPriceOld() : $productR->getPrice();
                        $quantityTotal += $quantity[$k];
                        $ps[] = array(
                            'id' => $productR->getId(),
                            'storeId' => $storeId,
                            'name' => $productR->getTitle(),
                            'link' => $productR->getViewLink(),
                            'image' => $productR->getImage(),
                            'price' => $productR->getPrice(),
                            'priceOld' => $productR->getPriceOld(),
                            'quantity' => $quantity[$k],
                            'colorId' => isset($productR->getOptions()['dataColor']) ? $productR->getOptions()['dataColor']->getId():null,
                            'colorName' => isset($productR->getOptions()['dataColor']) ? $productR->getOptions()['dataColor']->getName():null,
                            'sizeId' => isset($productR->getOptions()['dataSize']) ? $productR->getOptions()['dataSize']->getId():null,
                            'sizeName' => isset($productR->getOptions()['dataSize']) ? $productR->getOptions()['dataSize']->getName():null,
                        );
                        if($productR->getQuantity() == 0 || $productR->getQuantity() < $quantity[$k]) {
                            return new ViewModel(array(
                                'form' => $form,
                                'error' => 'Kiểm tra tồn kho, một số sản phẩm đang không còn hàng.'
                            ));
                        }

                        $product->setQuantity($productR->getQuantity() - $quantity[$k]);
                        $productMapper->save($product);
                    }
                    $ps['priceTotal'] = $priceTotal;
                    $ps['quantityTotal'] = $quantityTotal;
                }

                $order->exchangeArray($data);
                $order->setProduct(json_encode($ps));
                $orderMapper->save($order);
                $this->redirect()->toUrl('/admin/product/order');
            }else {
                $form->getErrorMessagesList();
            }
        }
        return new ViewModel(array(
            'form' => $form,
        ));
    }

    public function saleAction()
    {
        $this->layout('layout/adminSale');
        $request = $this->getRequest();

        $model = new \Admin\Model\Product();
        $mapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');

        $model->exchangeArray((array)$this->getRequest()->getQuery());
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();
	
        $modelCate = new \Admin\Model\Productc();
        $modelCate->setStoreId($storeId);

        $mapperCate = $this->getServiceLocator()->get('Admin\Model\ProductcMapper');
        $category = $mapperCate->fetchAll($modelCate);
        $options['isAdmin'] = $this->user()->isSuperAdmin();
        $fFilter = new \Admin\Form\ProductSearch($options);
        $fFilter->setCategoryIds($model->toSelectBoxArray($category,\Admin\Model\Product::SELECT_MODE_ALL));

        $model->setStoreId($storeId);

        $fFilter->bind($model);
        $page = (int)$this->getRequest()->getQuery()->page ? : 1;

        if($request->getPost('page')){
            $page = (int)$request->getPost('page');
        }
        if($request->getPost('key')) {
            $model->setOptions('keySearch', true);
            $model->setTitle($request->getPost('key'));
        }
	
        $results = $mapper->search($model, array($page, 10));

        if( $results->getRowCount() && $results->getRowInPage() ){
            $paging = $results->getPaging();
            $currentPage = $paging[0];
            $numPerPage = $paging[1];
            $rowCount = $results->getRowCount();
            $lastPage = ceil($rowCount/$numPerPage);
        }

        $viewModel = new ViewModel();
        if ($request->getPost('template')) {
            $viewModel->setTemplate($request->getPost('template'));
            $viewModel->setTerminal($request->getPost('terminal', false));
        }
        $cartService = $this->getServiceLocator()->get('Order\Service\Cart');
        $products = $cartService->getProducts();
        $viewModel->setVariable('products', $products);
        $viewModel->setVariable('totalPage', isset($lastPage) ? $lastPage:null);
        $viewModel->setVariable('currentPage', isset($currentPage) ? $currentPage:null);
        $viewModel->setVariable('fFilter', $fFilter);
        $viewModel->setVariable('results', $results);
        $viewModel->setVariable('url', $this->getRequest()->getUri()->getQuery());

        return $viewModel;
    }

    public function createorderAction()
    {
        $this->layout('layout/adminOrder');
        $request = $this->getRequest();
        $viewModel = new ViewModel();
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $cartService = $this->getServiceLocator()->get('Order\Service\Cart');
        $products = $cartService->getProducts();
        $productCart = json_decode($request->getPost('product'), true);
//        print
        if(empty($productCart)) {
            return new JsonModel(array(
                'code' => 0,
                'messenger' => 'Không tồn tại sản phẩm nào'
            ));
        }

        if ($request->getPost('template')) {
            $viewModel->setTemplate($request->getPost('template'));
            $viewModel->setTerminal($request->getPost('terminal', false));
            return $viewModel;
        }

        $order = new \Admin\Model\Order();
        $order->setStoreId($storeId);
        $order->setShippingType(\Admin\Model\Order::STATUS_NEW);
        $order->setCreatedById($u->getId());

        if($request->getPost('payment')) {
            if($request->getPost('payment') == 1) {
                $order->setMethodPay(\Admin\Model\Order::PAYMENT_DIRECT);
            } elseif($request->getPost('payment') == 2) {
                $order->setMethodPay(\Admin\Model\Order::PAYMENT_COD);
            }
        }

        $client = new \Admin\Model\Client();

        if($request->getPost('clientId')) {
            $clientMapper = $this->getServiceLocator()->get('Admin\Model\ClientMapper');
            $client->setStoreId($storeId);
            $client->setId((int)$request->getPost('clientId'));
            $clientMapper->get($client);
        }

        $order->setClientId( !empty($client->getId()) ? $client->getId():null);
        $order->setCustomerName(!empty($client->getName()) ? $client->getName():'---');
        $order->setCustomerMobile(!empty($client->getPhone()) ? $client->getPhone():'---');
        $order->setCustomerAddress(!empty($client->getAddress()) ? $client->getAddress():'---');
        $order->setCustomerEmail(!empty($client->getEmail()) ? $client->getEmail():'---');
        $order->setCreatedDateTime(DateBase::getCurrentDateTime());
        $orderMapper = $this->getServiceLocator()->get('Admin\Model\OrderMapper');

        $productMapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');

        if($productCart) {
            $ps = [];
            $priceTotal = 0;
            $quantityTotal = 0;
            foreach($productCart as $pC) {
                $product = new \Admin\Model\Product();
                $product->setStoreId($storeId);
                $product->setId($pC['id']);
                $productMapper->get($product);

                $priceTotal += $pC['priceOff'] ? $pC['priceOff'] : $pC['price'];
                $quantityTotal += $pC['count'];
                $ps[] = array (
                    'id' => $product->getId(),
                    'storeId' => $storeId,
                    'name' => $product->getTitle(),
                    'link' => $product->getViewLink(),
                    'image' => $product->getImage(),
                    'price' => $pC['price'],
                    'priceOld' => $pC['priceOff'],
                    'quantity' => $pC['count'],
                );
            }

            $ps['priceTotal'] = $priceTotal;
            $ps['quantityTotal'] = $quantityTotal;
            $order->setProduct(json_encode($ps));
        }

        $resultOrder = $orderMapper->save($order);

        $orderId = $order->getId();
        if($productCart) {
            $orderProductMapper = $this->getServiceLocator()->get('Admin\Model\OrderProductMapper');
            foreach ($productCart as $op) {
                $product = new \Admin\Model\Product();
                $product->setStoreId($storeId);
                $product->setId($op['id']);
                $productMapper->get($product);
                $orderProduct = new \Admin\Model\OrderProduct();
                $orderProduct->setOrderId($orderId);
                $orderProduct->setProductName($product->getTitle());
                $orderProduct->setProductId($product->getId());
                $orderProduct->setStoreId($storeId);
                $orderProduct->setPriceOff($op['priceOff']);
                $orderProduct->setProductPrice($op['price']);
                $orderProduct->setQuantity($op['count']);
                $orderProductMapper->save($orderProduct);
            }
//            die;
        }
        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Tạo đơn thành công'
        ));

    }

    public function reportsaleAction()
    {
        $this->layout('layout/adminOrder');
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();
        $orderProductMapper = $this->getServiceLocator()->get('Admin\Model\OrderProductMapper');

        $orderProduct = new \Admin\Model\OrderProduct();
        $orderProduct->setStoreId($storeId);
        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $r = $orderProductMapper->report($orderProduct, array($page, 20));

        return new ViewModel(array(
            'results' => $r,
            'url' => $this->getRequest()->getUri()->getQuery()
        ));
    }

    public function clientAction()
    {
        $this->layout('layout/adminOrder');
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();
        $client = new \Admin\Model\Client();
        $clientMapper = $this->getServiceLocator()->get('Admin\Model\ClientMapper');
        $options['isAdmin'] = $this->user()->isSuperAdmin();
        $client->setStoreId($storeId);
        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $results = $clientMapper->search($client, array($page,10));
        return new ViewModel(array(
            'results' => $results,
            'url' => $this->getRequest()->getUri()->getQuery()
        ));

    }

    public function orderviewAction()
    {
        $this->layout('layout/admin');
//        $this->layout('layout/adminOrder');
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $order = new \Admin\Model\Order();
        $order->setId($id);
        $order->setStoreId($storeId);
        $orderMapper = $this->getServiceLocator()->get('Admin\Model\OrderMapper');
        $r = $orderMapper->get($order);
        if(!$orderMapper->get($order)) {
            $this->redirect()->toUrl('/admin/product/order');
        }
        return new ViewModel(array(
            'result' => $r
        ));
    }

    public function changeorderAction()
    {
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();
        $id = $this->getRequest()->getPost()['id'];
        $order = new \Admin\Model\Order();
        $order->setId($id);
        $order->setStoreId($storeId);
        $orderMapper = $this->getServiceLocator()->get('Admin\Model\OrderMapper');
        $orderMapper->get($order);
        if(!$orderMapper->get($order)) {
            return new JsonModel(array(
                'status' => 0,
                'messenger' => 'Không tìm thấy'
            ));
        }

        $order->setShippingType(\Admin\Model\Order::STATUS_DONE);
        $orderMapper->save($order);

        return new JsonModel(array(
            'status' => 1,
            'messenger' => 'Không tìm thấy'
        ));
    }

    public function deleteorderAction()
    {
        $id = $this->getRequest()->getPost()['id'];
        $id = isset($id) ? (string)(int)$id : false;
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        if(!is_numeric($id)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy bài viết này'
            ));
        }

        $orderMapper = $this->getServiceLocator()->get('Admin\Model\OrderMapper');
        $orderProductMapper = $this->getServiceLocator()->get('Admin\Model\OrderProductMapper');
        $order = new \Admin\Model\Order();
        $order->setId($id);
        $order->setStoreId($storeId);

        if(!$orderMapper->get($order)){
            return new JsonModel(array(
                'code' => 0,
                'messenger' => 'Chúng tôi không tìm thấy nội dung này'
            ));
        }


        $orderMapper->delete($order);
        $orderProduct = new \Admin\Model\OrderProduct();
        $orderProduct->setStoreId($storeId);
        $orderProduct->setOrderId((int)$order->getId());
        $orderProductMapper->deleteType($orderProduct);

        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Đã xóa'
        ));
    }

    public function brandAction()
    {
        $this->layout('layout/admin');
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $brand = new \Admin\Model\Brand();
        $brandMapper = $this->getServiceLocator()->get('Admin\Model\BrandMapper');

        $brand->exchangeArray((array)$this->getRequest()->getQuery());

        $options['isAdmin'] = $this->user()->isSuperAdmin();
        $fFilter = new \Admin\Form\BrandSearch($options);
        $brand->setStoreId($storeId);

        $fFilter->bind($brand);

        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $results = $brandMapper->search($brand, array($page,20));

        return new ViewModel(array(
            'fFilter' => $fFilter,
            'results' => $results,
            'url' => $this->getRequest()->getUri()->getQuery()
        ));
    }

    public function addbrandAction()
    {
        $this->layout('layout/admin');
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();
        $brand = new \Admin\Model\Brand();
        $brandMapper = $this->getServiceLocator()->get('Admin\Model\BrandMapper');
        $store = new \Admin\Model\Store();
        $storeMapper = $this->getServiceLocator()->get('Admin\Model\StoreMapper');
        $options['isAdmin'] = $this->user()->isSuperAdmin();
        $form = new \Admin\Form\Brand($options);

        if(!$this->user()->isSuperAdmin()){
            $brand->setStoreId($storeId);
        }else{
            $form->setStoreIds($store->toSelectBoxArray($storeMapper->fetchAll($store)));
        }
        if($this->getRequest()->isPost()){
            $form->setData(array_merge_recursive($this->getRequest()->getPost()->toArray(),$this->getRequest()->getFiles()->toArray()));
            if($form->isValid()){
                $data = $form->getData();
                $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaMapper');
                $postImages = $this->getRequest()->getPost()['images'];
                if(isset($postImages) && $postImages != ''){
                    $imgJson = [];
                    $imagesArray = explode(',', $postImages);
                    foreach($imagesArray as $i){
                        $media = new \Admin\Model\Media();
                        $media->setId($i);
                        $rm = $mediaMapper->get($media);
                        if($rm) {
                            $imgJson[$i] = $rm->getPictureUri();
                        }
                    }
                    $brand->setImage(json_encode($imgJson));
                }
                $brand->exchangeArray($data);
                $brand->setUpdateDateTime(DateBase::getCurrentDateTime());
                $brand->setStatus(1);

                $brandMapper->save($brand);
                $mediaItemMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
                //Check exits cần một vòng for query select sẽ dài hơn where in id delete. Nên chỗ này xóa đi rồi saves
                $mediaItem = new \Admin\Model\MediaItem();
                $mediaItem->setItemId($brand->getId());
                $mediaItem->setType(\Admin\Model\MediaItem::FILE_BRAND);
                $mediaItemMapper->deleteType($mediaItem);

                if(isset($postImages) && $postImages != ''){
                    $imagesArray = explode(',', $postImages);
                    $c = 1;
                    foreach($imagesArray as $i){
                        if($i){
                            $mediaItem = new \Admin\Model\MediaItem();
                            $mediaItem->setType(\Admin\Model\MediaItem::FILE_BRAND);
                            $mediaItem->setItemId($brand->getId());
                            $mediaItem->setFileItem($i);
                            $mediaItem->setSort($c++);
                            $mediaItem->setStoreId($storeId);
                            $mediaItemMapper->save($mediaItem);
                        }
                    }
                }

                $this->redirect()->toUrl('/admin/product/brand');
            }
        }
        return new ViewModel(array(
            'form' => $form,
            'admin' => $options,
        ));
    }

    public function editbrandAction()
    {
        $this->layout('layout/admin');
        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $brand = new \Admin\Model\Brand();
        $brand->setId((int)$id);
        $brand->setStoreId($storeId);
        $brandMapper = $this->getServiceLocator()->get('Admin\Model\BrandMapper');

        if(!$brandMapper->get($brand)){
            $this->redirect()->toUrl('/admin/product/brand');
        }

        $options['isAdmin'] = $this->user()->isSuperAdmin();
        $form = new \Admin\Form\Brand($options);

        $mediaItem = new \Admin\Model\MediaItem();
        $mediaItem->setItemId($id);
        $mediaItem->setType(\Admin\Model\MediaItem::FILE_BRAND);

        $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
        $m = $mediaMapper->fetchAll($mediaItem);
        $fI = [];
        if(isset($m)){
            foreach($m as $i){
                $fI[] = $i->getFileItem();
            }
        }
        $data = $brand->toFormValues();
        $status = $data['status'];
        $data['images'] = implode(',', $fI);
        $form->setData($data);

        if($this->getRequest()->isPost()){
            $form->setData(array_merge_recursive($this->getRequest()->getPost()->toArray(),$this->getRequest()->getFiles()->toArray()));
            if($form->isValid()){
                $data = $form->getData();
                $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaMapper');

                $postImages = $this->getRequest()->getPost()['images'];
                if(isset($postImages) && $postImages != ''){
                    $imgJson = [];
                    $imagesArray = explode(',', $postImages);
                    foreach($imagesArray as $i){
                        $media = new \Admin\Model\Media();
                        $media->setId($i);
                        $rm = $mediaMapper->get($media);
                        if($rm) {
                            $imgJson[$i] = $rm->getPictureUri();
                        }
                    }
                    $brand->setImage(json_encode($imgJson));
                }
                $brand->exchangeArray($data);
                $brand->setUpdateDateTime(DateBase::getCurrentDateTime());
                $brand->setStatus($status);

                $brandMapper->save($brand);
                $mediaItemMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
                //Check exits cần một vòng for query select sẽ dài hơn where in id delete. Nên chỗ này xóa đi rồi saves
                $mediaItem = new \Admin\Model\MediaItem();
                $mediaItem->setItemId($brand->getId());
                $mediaItem->setType(\Admin\Model\MediaItem::FILE_BRAND);
                $mediaItemMapper->deleteType($mediaItem);


                if(isset($postImages) && $postImages != ''){
                    $imagesArray = explode(',', $postImages);
                    $c = 1;
                    foreach($imagesArray as $i){
                        if($i){
                            $mediaItem = new \Admin\Model\MediaItem();
                            $mediaItem->setType(\Admin\Model\MediaItem::FILE_BRAND);
                            $mediaItem->setItemId($brand->getId());
                            $mediaItem->setFileItem($i);
                            $mediaItem->setSort($c++);
                            $mediaItem->setStoreId($storeId);
                            $mediaItemMapper->save($mediaItem);
                        }
                    }
                }

                $this->redirect()->toUrl('/admin/product/brand');
            }
        }
        return new ViewModel(array(
            'form' => $form,
            'admin' => $options,
            'itemId' => $id

        ));
    }

    public function changeBrandAction()
    {
        $id = $this->getRequest()->getPost()['id'];
        $id = isset($id) ? (string)(int)$id : false;
        if(!is_numeric($id)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy bài viết này'
            ));
        }
        $mapper = $this->getServiceLocator()->get('Admin\Model\BrandMapper');
        $brand = new \Admin\Model\Brand();
        $brand->setId($id);
        if(!$mapper->get($brand)){
            return new JsonModel(array(
                'code' => 0,
                'messenger' => 'Chúng tôi không tìm thấy nội dung này'
            ));
        }
        if($brand->getStatus() == \Admin\Model\Product::STATUS_ACTIVE){
            $brand->setStatus(\Admin\Model\Product::STATUS_INACTIVE);
        }else{
            $brand->setStatus(\Admin\Model\Product::STATUS_ACTIVE);
        }
        $mapper->save($brand);

        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Đã thay đổi',
            'status' => $brand->getStatus(),
        ));

    }

    public function deletebrandAction()
    {
        $id = $this->getRequest()->getPost()['id'];
        $id = isset($id) ? (string)(int)$id : false;
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        if(!is_numeric($id)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy bài viết này'
            ));
        }

        $mapper = $this->getServiceLocator()->get('Admin\Model\BrandMapper');
        $brand = new \Admin\Model\Brand();
        $brand->setId($id);
        $brand->setStoreId($storeId);

        if(!$mapper->get($brand)){
            return new JsonModel(array(
                'code' => 0,
                'messenger' => 'Chúng tôi không tìm thấy nội dung này'
            ));
        }

        $mapper->delete($brand);
        $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
        //Check exits cần một vòng for query select sẽ dài hơn where in id delete. Nên chỗ này xóa đi rồi saves
        $mediaItem = new \Admin\Model\MediaItem();
        $mediaItem->setItemId($brand->getId());
        $mediaItem->setType(\Admin\Model\MediaItem::FILE_BRAND);
        $mediaMapper->deleteType($mediaItem);

        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Đã xóa'
        ));
    }

    public function importexcelAction()
    {
        $form = new \Admin\Form\Product($this->getServiceLocator(), null);

        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $data = $this->getRequest()->getPost()['data'];
        $listArrs = json_decode($data);
        if ($listArrs){
            $listReference = [];
            foreach ($listArrs as $arr){
                $listReference = $arr;
            }
        }
        $productMapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');
        $categoryMapper = $this->getServiceLocator()->get('Admin\Model\ProductcMapper');
        $brandMapper = $this->getServiceLocator()->get('Admin\Model\BrandMapper');
        $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaMapper');
        $mediaItemMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
        $error = '';
        $cError = [];
        foreach ($listReference as $key => $val){

            $arrReference = $productMapper->convertToKey($val);
            /******** GetCategoryId ********/
            if(!empty($arrReference['categoryId'])) {
                $categoryProduct = new \Admin\Model\Productc();
                $categoryProduct->setName($arrReference['categoryId']);
                if($categoryMapper->get($categoryProduct)){
                    $arrReference['categoryId'] = $categoryProduct->getId();
                }else{
                    $categoryProduct = new \Admin\Model\Productc();
                    $categoryProduct->setName($arrReference['categoryId']);
                    $categoryProduct->setStoreId($storeId);
                    $categoryProduct->setDescription('Mô tả '.$arrReference['categoryId']);
                    $categoryProduct->setStatus(1);
                    $categoryMapper->save($categoryProduct);
                    $arrReference['categoryId'] = $categoryProduct->getId();
                }
            }
//
            /******** GetBrandId ********/
            if(!empty($arrReference['brandId'])) {
                $brand = new \Admin\Model\Brand();
                $brand->setName($arrReference['brandId']);
                if($brandMapper->get($brand)){
                    $arrReference['brandId'] = $brand->getId();
                }else{
                    $brand = new \Admin\Model\Brand();
                    $brand->setName($arrReference['brandId']);
                    $brand->setDescription('Mô tả '.$arrReference['brandId']);
                    $brand->setStoreId($storeId);
                    $brand->setStatus(1);
                    $brand->setUpdateDateTime(DateBase::getCurrentDateTime());
                    $brandMapper->save($brand);
                    $arrReference['brandId'] = $brand->getId();
                }
            }


            if(!empty($arrReference['file'])) {
                $files = [];
                $file = explode(',', $arrReference['file']);
                foreach($file as $f) {
                    $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaMapper');
                    $media = new \Admin\Model\Media();
                    $media->setFileName(\Base\Model\Resource::slugify($f));
                    $media->setStoreId($storeId);
                    $r = $mediaMapper->get($media);
                    if($r) {
                        $files[$media->getId()] = $media->getPictureUri();
                    }
                }

            }
            $form->setData($arrReference);
            if($form->isValid()){
                $data = $form->getData();
                $product = new \Admin\Model\Product();
                $product->exchangeArray((array)$data);
                $product->setStoreId($storeId);
                $product->setCreatedById($u->getId());
                $product->setCreatedDateTime(DateBase::getCurrentDateTime());
                $product->setStatus(Product::STATUS_ACTIVE);
                $product->setImage(json_encode($files));
                if(!$productMapper->get($product)) {
                    $productMapper->save($product);
                    if(!empty($arrReference['file'])) {
                        $file = explode(',', $arrReference['file']);
                        $i = 1;
                        foreach ($file as $k => $f) {
                            $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaMapper');
                            $media = new \Admin\Model\Media();
                            $media->setFileName(\Base\Model\Resource::slugify($f));
                            $media->setStoreId($storeId);
                            $r = $mediaMapper->get($media);
                            if($r) {
                                $mediaItem = new \Admin\Model\MediaItem();
                                $mediaItem->setType(\Admin\Model\MediaItem::FILE_PRODUCT);
                                $mediaItem->setItemId((int)$product->getId());
                                $mediaItem->setFileItem($media->getId());
                                $mediaItem->setSort($i++);
                                $mediaItem->setStoreId($storeId);
                                $mediaItemMapper->save($mediaItem);
                            }
                        }
                    }
                }
            } else {
                $error .= $key+1 .', ';
                $cError[] = $key;
            }
        }

        return new JsonModel(array(
            'code' => count($cError) > 1 ? 0:1,
            'messenger' => 'Import thành công',
            'error' => 'Số thứ tự xảy ra lỗi '.$error,
        ));

    }

    public function relatedAction() {

        $keyword = $this->params()->fromQuery('keyword');
        $article = $this->params()->fromQuery('article');
        $page = $this->params()->fromQuery('page');
        $banner = $this->params()->fromQuery('banner');
        $template = $this->params()->fromQuery('template');
        $store = $this->params()->fromQuery('store');
        $categoryProduct = $this->params()->fromQuery('categoryproduct');
        $categoryArticle = $this->params()->fromQuery('categoryarticle');

        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();
//        print_r();die;

        if($page) {
            $page = new \Admin\Model\Page();
            $page->setStoreId($storeId);
            $page->setName($keyword);
            $pageMapper = $this->getServiceLocator()->get('Admin\Model\PageMapper');
            $r = $pageMapper->related($page);
        } elseif($article) {
            $article = new \Admin\Model\Article();
            $article->setStoreId($storeId);
            $article->setTitle($keyword);
            $articleMapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
            $r = $articleMapper->related($article);
        }elseif($banner) {
            $banner = new \Admin\Model\Banner();
            $banner->setStoreId($storeId);
            $banner->setName($keyword);
            $bannerMapper = $this->getServiceLocator()->get('Admin\Model\BannerMapper');
            $r = $bannerMapper->related($banner);
        } elseif($categoryProduct) {
            $categoryProduct = new \Admin\Model\Productc();
            $categoryProduct->setStoreId($storeId);
            $categoryProduct->setName($keyword);
            $productCategoryMapper = $this->getServiceLocator()->get('Admin\Model\ProductcMapper');
            $r = $productCategoryMapper->related($categoryProduct);
        } elseif($categoryArticle) {
            $categoryArticle1 = new \Admin\Model\Productc();
            $categoryArticle1->setStoreId($storeId);
            $categoryArticle1->setName($keyword);
            $articleCategoryMapper = $this->getServiceLocator()->get('Admin\Model\ArticlecMapper');
            $r = $articleCategoryMapper->related($categoryArticle1);
        } elseif($template) {
            $template = new \Admin\Model\Template();
            $template->setDirectory($keyword);
            if($this->user()->isSuperAdmin()) {
                $template->setOptions('loadAll', true);
            }
            $templateMapper = $this->getServiceLocator()->get('Admin\Model\TemplateMapper');
            $r = $templateMapper->related($template);
        }elseif($store) {
            $store1 = new \Admin\Model\Store();
            $store1->setName($keyword);
            $storeMapper = $this->getServiceLocator()->get('Admin\Model\StoreMapper');
            $r = $storeMapper->related($store1);
        } else {
            $product = new \Admin\Model\Product();
            $product->setStoreId($storeId);
            $product->setTitle($keyword);
            $mapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');
            $r = $mapper->related($product);
        }


        if(!$r){
            return new JsonModel(array(
                'messenger' => 'Không tìm thấy'
            ));
        }

        return new JsonModel($r);
    }

    public function urlAction()
    {
        $post = $this->getRequest()->getPost();
        $title = $post['title'];
        $url = $post['url'];
        $description = $post['description'];

        $data = [];
        $urlSlug = \Base\Model\Resource::slugify($title);
        $data = ['title' => $title, 'url' => 'http://'.$_SERVER['HTTP_HOST'].'/'. ($url ? $url : $urlSlug), 'description' => $description];

        $request = $this->getRequest();
        $viewModel = new ViewModel();
        $viewModel->setTemplate('admin/product/review');
        $viewModel->setTerminal(true);
        if($post['json']) {
            return new JsonModel(array(
                'url' => $url ? $url : $urlSlug
            ));
        }
        $viewModel->setVariable('data', $data);
        return $viewModel;

    }


}
















