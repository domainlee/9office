<?php
namespace Admin\Controller;
use Admin\Model\Media;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Home\Form\FormBase;
use Home\Model\DateBase;
use Home\Model\Base;

class ArticleController extends AbstractActionController{

	public function indexAction()
    {
        $this->layout('layout/admin');
		$model = new \Admin\Model\Article();
        $sl = $this->getServiceLocator();
		$mapper = $sl->get('Admin\Model\ArticleMapper');
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();
//        $slug = $this->params()->fromQuery();
//        print_r($this->getRequest()->getUri()->getQuery());die;

		$model->exchangeArray((array)$this->getRequest()->getQuery());
        $options['isAdmin'] = $this->user()->isSuperAdmin();
        $fFilter = new \Admin\Form\ArticleSearch($options);
        $model->setStoreId($storeId);

        $optionMapper = $sl->get('Admin\Model\OptionMapper');
        $option = new \Admin\Model\Option();
        $option->setStoreId($storeId);
        $dataOption = $optionMapper->get($option);
        $dataOld = json_decode($dataOption->getData(), true);
//        print_r($model);die;
        $fFilter->bind($model);
		$page = (int)$this->getRequest()->getQuery()->page ? : 1;
		$results = $mapper->search($model, array($page,10));

		return new ViewModel(array(
			'fFilter' => $fFilter,
			'results' => $results,
            'url' => $this->getRequest()->getUri()->getQuery(),
            'uri' => $this->getRequest()->getUri()->getQuery(),
            'option' => $dataOld,
        ));
	}

	public function addAction()
    {
		$this->layout('layout/admin');
//        $storeId = $this->getServiceLocator()->get('Store\Service\Store')->getStoreId();

        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $model = new \Admin\Model\Article();
		$modelCate = new \Admin\Model\Articlec();
        if(!$this->user()->isSuperAdmin()){
            $modelCate->setStoreId($storeId);
        }
		$mapperCate = $this->getServiceLocator()->get('Admin\Model\ArticlecMapper');
        $mapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
        $category = $mapperCate->fetchAll($modelCate);
		$form = new \Admin\Form\Article();
		$form->setCategoryIds($model->toSelectBoxArray($category,\Admin\Model\Article::SELECT_MODE_ALL));

		/****** Option Field ********/
        $optionMapper = $this->getServiceLocator()->get('Admin\Model\OptionMapper');
        $option = new \Admin\Model\Option();
        $option->setStoreId($storeId);
        $optionMapper->get($option);
        if(!empty($option->getArticleField())) {
            $articleField = json_decode($option->getArticleField(), true);
        }

		if($this->getRequest()->isPost()){
			$form->setData(array_merge_recursive($this->getRequest()->getPost()->toArray(),$this->getRequest()->getFiles()->toArray()));
			if($form->isValid()){

                $data = $form->getData();
                $type = $this->getRequest()->getPost()['typeArticle'];

                $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaMapper');
                $mediaItemMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
                $articleRelated = $data['articleRelated'];
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

                $model->exchangeArray($data);
                $model->setCreatedDateTime(DateBase::getCurrentDateTime());
                $model->setStoreId($storeId);
                $model->setCreatedById($u->getId());
                $model->setStatus(\Admin\Model\Article::STATUS_ACTIVE);
                $model->setType($type);
                if(!empty($articleRelateds)) {
                    $model->setArticleRelated(json_encode($articleRelateds));
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

                if(!empty($data['url'])) {

                    $url = \Base\Model\Resource::slugify($data['url']);

                    $pageMapper = $this->getServiceLocator()->get('Admin\Model\PageMapper');
                    $pageUrl = new \Admin\Model\Page();
                    $pageUrl->setUrl($url);
                    $pageUrl->setStoreId($storeId);
                    $pagerModelUrl = $pageMapper->get($pageUrl);

                    $productMapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');
                    $pmodelUrl = new \Admin\Model\Product();
                    $pmodelUrl->setStoreId($storeId);
                    $pmodelUrl->setUrl($url);
                    $prModelUrl = $productMapper->get($pmodelUrl);

                    $modelUrl = new \Admin\Model\Article();
                    $modelUrl->setStoreId($storeId);
                    $modelUrl->setUrl($url);
                    $rModelUrl = $mapper->get($modelUrl);

                    if($rModelUrl || $prModelUrl || $pagerModelUrl) {
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

                $mediaItemMapper->deleteTaskTag($model->getId());
                if(isset($data['images']) && $data['images'] != ''){
                    $imagesArray = explode(',', $data['images']);
                    $c = 1;
                    foreach($imagesArray as $i){
                        if($i){
                            $mediaItem = new \Admin\Model\MediaItem();
                            $mediaItem->setType(\Admin\Model\MediaItem::FILE_ARTICLE);
                            $mediaItem->setItemId($model->getId());
                            $mediaItem->setFileItem($i);
                            $mediaItem->setSort($c++);
                            $mediaItem->setStoreId($storeId);
                            $mediaItemMapper->save($mediaItem);
                        }
                    }
                }

                $this->redirect()->toUrl('/admin/article');
			}
		}
		return new ViewModel(array(
            'form' => $form,
            'field' => $articleField,
		));
	}

	public function editAction()
    {
		$this->layout('layout/admin');
		$id = $this->getEvent()->getRouteMatch()->getParam('id');
		$slug = $this->getRequest()->getUri()->getQuery();
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $mapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
        $model = new \Admin\Model\Article();
        $model->setId($id);
        $model->setStoreId($storeId);

        if(!$mapper->get($model)){
            $this->redirect()->toUrl('/admin/article');
        }

		$modelCate = new \Admin\Model\Articlec();
        $modelCate->setStoreId($storeId);
		$mapperCate = $this->getServiceLocator()->get('Admin\Model\ArticlecMapper');
		$category = $mapperCate->fetchAll($modelCate);

		$form = new \Admin\Form\Article();

        $form->setCategoryIds($modelCate->toSelectBoxArray($category,\Admin\Model\Articlec::SELECT_MODE_ALL));

        $data = $model->toFormValues();
        $mediaItem = new \Admin\Model\MediaItem();
        $mediaItem->setItemId($model->getId());
        $mediaItem->setType(\Admin\Model\MediaItem::FILE_ARTICLE);

        $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
        $m = $mediaMapper->fetchAll($mediaItem);
        $fI = [];
        if(isset($m)){
            foreach($m as $i){
                $fI[] = $i->getFileItem();
            }
        }

        if($model->getArticleRelated()) {
            $articleR = json_decode($model->getArticleRelated());
            if(!empty($articleR)) {
                $ar = [];
                foreach($articleR as $p) {
                    $ar[$p->id] = ['label' => $p->title, 'value' => $p->id, 'selected' => true];
                }
            }
        }

        $data['images'] = implode(',', $fI);
        $storeId = $data['storeId'];
        $status = $data['status'];
        $createdById = $data['createdById'];
        $typeCurrent = $data['type'];
        $view = $data['view'];
        $extraContent = json_decode($data['extraContent'], true);

        $form->setData($data);
        $form->setCategoryIds($model->toSelectBoxArray($category,\Admin\Model\Article::SELECT_MODE_ALL));
        $form->setArticleRelated($ar);

        /****** Option Field ********/
        $optionMapper = $this->getServiceLocator()->get('Admin\Model\OptionMapper');
        $option = new \Admin\Model\Option();
        $option->setStoreId($storeId);
        $optionMapper->get($option);
        if(!empty($option->getArticleField())) {
            $articleField = json_decode($option->getArticleField(), true);
        }

		if($this->getRequest()->isPost()){
            $form->setData(array_merge_recursive($this->getRequest()->getPost()->toArray(),$this->getRequest()->getFiles()->toArray()));
            if($form->isValid()){
                $data = $form->getData();

                $type = $this->getRequest()->getPost()['typeArticle'];
                $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaMapper');
                $mediaItemMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
                $mediaItemMapper->deleteTaskTag($id);
                $articleRelated = $data['articleRelated'];

                $model = new \Admin\Model\Article();
                $model->setId($id);
                $model->exchangeArray($data);
                $model->setCreatedDateTime(DateBase::getCurrentDateTime());
                $model->setStoreId($storeId);
                $model->setStatus($status);
                $model->setCreatedById($u->getId());
                $model->setType($type);
                $model->setView($view);

                if(!empty($data['url'])) {
                    $productMapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');

                    $url = \Base\Model\Resource::slugify($data['url']);

                    $pageMapper = $this->getServiceLocator()->get('Admin\Model\PageMapper');
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
                    $rModelUrl = $mapper->get($modelUrl);

                    if($rModelUrl && $modelUrl->getId() != $id || $prModelUrl || $pagerModelUrl) {
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

                if(isset($data['images']) && $data['images'] != ''){
                    $imgJson = [];
                    $imagesArray = explode(',', $data['images']);
                    $c = 1;
                    foreach($imagesArray as $i){
                        $media = new \Admin\Model\Media();
                        $media->setId($i);
                        $rm = $mediaMapper->get($media);
                        if($rm) {
                            $imgJson[$i] = $rm->getPictureUri();
                            $mediaItem = new \Admin\Model\MediaItem();
                            $mediaItem->setType(\Admin\Model\MediaItem::FILE_ARTICLE);
                            $mediaItem->setItemId($id);
                            $mediaItem->setFileItem($rm->getId());
                            $mediaItem->setSort($c++);
                            $mediaItem->setStoreId($storeId);
                            $mediaItemMapper->save($mediaItem);
                        }
                    }
                    $model->setImage(json_encode($imgJson));
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

                if(!empty($articleRelateds)) {
                    $model->setArticleRelated(json_encode($articleRelateds));
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
                $this->redirect()->toUrl('/admin/article?'.$slug);
			}else{
                print_r($form->getMessages());die;
            }
		}
		return new ViewModel(array(
			'form' => $form,
            'itemId' => $id,
            'type' => $typeCurrent,
            'field' => $articleField,
            'extraContent' => $extraContent,
		));
	}


	public function changeactiveAction(){
		$this->layout('layout/admin');
		$id = $this->getEvent()->getRouteMatch()->getParam('id');
		$mapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
		$model = $mapper->getId($id);
		
		if(($model->getStatus()) == \Admin\Model\Article::STATUS_ACTIVE){
			$model->setStatus(\Admin\Model\Article::STATUS_INACTIVE);
		}
		else{
			$model->setStatus(\Admin\Model\Article::STATUS_ACTIVE);
		}
		$mapper->save($model);
		$this->redirect()->toUrl('/admin/article');
	}

	public function deleteAction(){

        $id = $this->getRequest()->getPost()['id'];
        if(!is_numeric($id)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy bài viết này'
            ));
        }
        $mapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
        $article = new \Admin\Model\Article();
        $article->setId($id);
        if(!$mapper->get($article)){
            return new JsonModel(array(
                'code' => 0,
                'messenger' => 'Chúng tôi không tìm thấy bài viết này'
            ));
        }
        $mapper->delete($article);
        if($article->getId()){
            $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
            $mediaMapper->deleteTaskTag($article->getId());
        }
        return new JsonModel(array(
			'code' => 1,
            'messenger' => 'Đã xóa'
		));
	}

    public function categoryAction()
    {
        $this->layout('layout/admin');
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $model = new \Admin\Model\Articlec();

        $mapper = $this->getServiceLocator()->get('Admin\Model\ArticlecMapper');
        $model->exchangeArray((array)$this->getRequest()->getQuery());
        $fFilter = new \Admin\Form\ArticlecSearch();
        $pages = $this->getRequest()->getQuery()->page ?: 1;
        $fFilter->bind($model);

        $model->setStoreId($storeId);

        $results = $mapper->search($model, array($pages,10));
        return new ViewModel(array(
            'fFilter'=> $fFilter,
            'results'=> $results
        ));
    }

    public function addcategoryAction()
    {
        $this->layout('layout/admin');
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $model = new \Admin\Model\Articlec();
        $model->setStoreId($storeId);
        $model->setStatus(\Admin\Model\Articlec::STATUS_ACTIVE);
        $model->setCreatedById($u->getId());
        $model->setCreatedDateTime(DateBase::getCurrentDateTime());

        $mapper = $this->getServiceLocator()->get('Admin\Model\ArticlecMapper');
        $parents = $mapper->fetchAll($model);
        $form = new \Admin\Form\Articlec();
        $form->setParentIds($model->toSelectBoxArray($parents,\Admin\Model\Articlec::SELECT_MODE_ALL));
        $form->bind($model);
        if($this->getRequest()->isPost()){
            $form->setData($this->getRequest()->getPost()->toArray());
            if($form->isValid()) {
                $data = $this->getRequest()->getPost()->toArray();
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
                    $model->setImage(json_encode($imgJson));
                }

                $type = $this->getRequest()->getPost()['type'];
                $model->setType($type);
                if(!empty($data['url'])) {
                    $model->setUrl(\Base\Model\Resource::slugify($data['url']));
                }
                $r = $mapper->save($model);

                $mediaItem1 = new \Admin\Model\MediaItem();
                $mediaItem1->setItemId($model->getId());
                $mediaItem1->setType(\Admin\Model\MediaItem::FILE_CATEGORY_ARTICLE);
                $mediaItemMapper->deleteType($mediaItem1);

                if(isset($data['images']) && $data['images'] != ''){
                    $imagesArray = explode(',', $data['images']);
                    $c = 1;
                    foreach($imagesArray as $i){
                        if($i){
                            $mediaItem = new \Admin\Model\MediaItem();
                            $mediaItem->setType(\Admin\Model\MediaItem::FILE_CATEGORY_ARTICLE);
                            $mediaItem->setItemId($model->getId());
                            $mediaItem->setFileItem($i);
                            $mediaItem->setSort($c++);
                            $mediaItem->setStoreId($storeId);
                            $mediaItemMapper->save($mediaItem);
                        }
                    }
                }

                $this->redirect()->toUrl('/admin/article/category');
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
            $this->redirect()->toUrl('/admin/article/category');
        }
        if(!is_numeric($id)){
            $this->redirect()->toUrl('/admin/article/category');
        }
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $mapper = $this->getServiceLocator()->get('Admin\Model\ArticlecMapper');

        $category = new \Admin\Model\Articlec();
        $category->setId($id);
        $category->setStoreId($storeId);

        if(!$mapper->get($category)){
            $this->redirect()->toUrl('/admin/article/category');
        }
        if(!$this->user()->isAdmin()){
            $category->setStoreId($storeId);
        }
        $parents = $mapper->fetchAll($category);

        $form = new \Admin\Form\Articlec();
        $form->setParentIds($category->toSelectBoxArray($parents,\Admin\Model\Articlec::SELECT_MODE_ALL));
        $typeView  = $category->getType();

        $data = $category->toFormValues();
        $status = $category->getStatus();

        $mediaItem = new \Admin\Model\MediaItem();
        $mediaItem->setItemId($id);
        $mediaItem->setType(\Admin\Model\MediaItem::FILE_CATEGORY_ARTICLE);
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
//        $form->bind($category);
        if($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if($form->isValid()) {
                $category = new \Admin\Model\Articlec();


                $data = $this->getRequest()->getPost()->toArray();
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
                    $category->setImage(json_encode($imgJson));
                }

                $category->exchangeArray((array)$data);
                $category->setId($id);
                $category->setStatus($status);
                $category->setStoreId($storeId);
                if(!empty($data['url'])) {
                    $category->setUrl(\Base\Model\Resource::slugify($data['url']));
                }
                $type = $this->getRequest()->getPost()['type'];
                $category->setType($type);

                $mapper->save($category);

                $mediaItem1 = new \Admin\Model\MediaItem();
                $mediaItem1->setItemId($category->getId());
                $mediaItem1->setType(\Admin\Model\MediaItem::FILE_CATEGORY_ARTICLE);
                $mediaItemMapper->deleteType($mediaItem1);

                if(isset($data['images']) && $data['images'] != ''){
                    $imagesArray = explode(',', $data['images']);
                    $c = 1;
                    foreach($imagesArray as $i){
                        if($i){
                            $mediaItem = new \Admin\Model\MediaItem();
                            $mediaItem->setType(\Admin\Model\MediaItem::FILE_CATEGORY_ARTICLE);
                            $mediaItem->setItemId($category->getId());
                            $mediaItem->setFileItem($i);
                            $mediaItem->setSort($c++);
                            $mediaItem->setStoreId($storeId);
                            $mediaItemMapper->save($mediaItem);
                        }
                    }
                }

                $this->redirect()->toUrl('/admin/article/category');
            }
        }
        return new ViewModel(array(
            'form' => $form,
            'type' => $typeView,
            'itemId' => $id,
        ));
    }


    public function scanAction()
    {
        $this->layout('layout/admin');
        $content = file_get_contents('http://vnexpress.net/tin-tuc/the-gioi');
        $pattern = '#class="block_image_news width_common">.*class="title_news">.*href="(.*)".*class="thumb">.*src="(.*)".*alt="(.*)".*class="news_lead".*data-mobile-href=".*">(.*)</div>#imsU';
        preg_match_all($pattern, $content, $matches);
        print_r($matches);
        die;
    }

    public function changeAction()
    {
        $id = $this->getRequest()->getPost('id');
        $mapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');

        $article = new \Admin\Model\Article();
        $article->setId($id);

        if(!$mapper->get($article)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy sản phẩm này'
            ));
        }

        if($article->getStatus() == \Admin\Model\Article::STATUS_ACTIVE){
            $article->setStatus(\Admin\Model\Article::STATUS_INACTIVE);
        }else{
            $article->setStatus(\Admin\Model\Article::STATUS_ACTIVE);
        }
        $mapper->save($article);

        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Đã thay đổi',
            'status' => $article->getStatus()
        ));
    }

    public function changecAction()
    {
        $id = $this->getRequest()->getPost('id');
        $mapper = $this->getServiceLocator()->get('Admin\Model\ArticlecMapper');
        $category = new \Admin\Model\Articlec();
        $category->setId($id);

        if(!$mapper->get($category)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy sản phẩm này'
            ));
        }
        if($category->getStatus() == \Admin\Model\Articlec::STATUS_ACTIVE){
            $category->setStatus(\Admin\Model\Articlec::STATUS_INACTIVE);
        }else{
            $category->setStatus(\Admin\Model\Articlec::STATUS_ACTIVE);
        }
        $mapper->save($category);

        return new JsonModel(array(
            'code'=> 1,
            'messenger' => 'Đã thay đổi',
            'status' => $category->getStatus()
        ));
    }


    public function deletecAction(){

        $id = $this->getRequest()->getPost()['id'];
        if(!is_numeric($id)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy danh mụcc này'
            ));
        }
        $mapper = $this->getServiceLocator()->get('Admin\Model\ArticlecMapper');
        $articlec = new \Admin\Model\Articlec();
        $articlec->setId($id);
        if(!$mapper->get($articlec)){
            return new JsonModel(array(
                'code' => 0,
                'messenger' => 'Chúng tôi không tìm thấy bài viết này'
            ));
        }

        $mapper->delete($articlec);

        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Đã xóa'
        ));
    }

    public function fieldAction()
    {
        $field = $this->getRequest()->getPost()['field'];
        $product = $this->getRequest()->getPost()['product'];

        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $optionMapper = $this->getServiceLocator()->get('Admin\Model\OptionMapper');
        $option = new \Admin\Model\Option();
        $option->setStoreId($storeId);

        $r = $optionMapper->get($option);
        if(!empty($r)) {
            $ad = [vnString($field) => $field];
            if($product) {
                if(!empty($option->getProductField())) {
                    $fieldOld = json_decode($option->getProductField(), true);
                    if(!empty($fieldOld)) {
                        $nameKey = [];
                        foreach($fieldOld as $k => $v){
                            $nameKey[$k] = $k;
                        }
                    }
                    if(in_array(vnString($field), $nameKey)) {
                        return new JsonModel(array(
                            'code' => 0,
                            'messenger' => 'Đã tồn tại trường này'
                        ));
                    }
                    $ad = $ad + $fieldOld;
                }
                $option->setProductField(json_encode($ad));
            } else {
                if(!empty($option->getArticleField())) {
                    $fieldOld = json_decode($option->getArticleField(), true);
                    if(!empty($fieldOld)) {
                        $nameKey = [];
                        foreach($fieldOld as $k => $v){
                            $nameKey[$k] = $k;
                        }
                    }
                    if(in_array(vnString($field), $nameKey)) {
                        return new JsonModel(array(
                            'code' => 0,
                            'messenger' => 'Đã tồn tại trường này'
                        ));
                    }
                    $ad = $ad + $fieldOld;
                }
                $option->setArticleField(json_encode($ad));
            }
            $optionMapper->save($option);
            return new JsonModel(array(
                'code' => 1,
                'messenger' => 'Đã thêm'
            ));
        }

        return new JsonModel(array(
            'code' => 0,
            'messenger' => 'Không tìm thấy'
        ));
    }

    public function deletefieldAction()
    {
        $field = $this->getRequest()->getPost()['field'];
        $product = $this->getRequest()->getPost()['product'];

        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $optionMapper = $this->getServiceLocator()->get('Admin\Model\OptionMapper');
        $option = new \Admin\Model\Option();
        $option->setStoreId($storeId);

        if(!empty($optionMapper->get($option))) {
            if($product) {
                if(!empty($option->getProductField())) {
                    $fieldOld = json_decode($option->getProductField(), true);
                    $fieldUpdate = [];
                    foreach($fieldOld as $k => $v) {
                        if($field != $k) {
                            $fieldUpdate[$k] = $v;
                        }
                    }
                    $option->setProductField(!empty($fieldUpdate) ? json_encode($fieldUpdate):null);
                    $optionMapper->save($option);
                    return new JsonModel(array(
                        'code' => 1,
                        'messenger' => 'Đã xoá'
                    ));
                }
            } else {
                if(!empty($option->getArticleField())) {
                    $fieldOld = json_decode($option->getArticleField(), true);
                    $fieldUpdate = [];
                    foreach($fieldOld as $k => $v) {
                        if($field != $k) {
                            $fieldUpdate[$k] = $v;
                        }
                    }
                    $option->setArticleField(!empty($fieldUpdate) ? json_encode($fieldUpdate):null);
                    $optionMapper->save($option);
                    return new JsonModel(array(
                        'code' => 1,
                        'messenger' => 'Đã xoá'
                    ));
                }
            }
        }

        return new JsonModel(array(
            'code' => 0,
            'messenger' => 'Không tìm thấy'
        ));
    }


}






















