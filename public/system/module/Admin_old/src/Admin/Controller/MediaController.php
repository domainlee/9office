<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Home\Form\FormBase;
use Home\Model\DateBase;
use Base\InputFilter\ImageResize;

class MediaController extends AbstractActionController {

	public function indexAction()
    {
        $viewModel = new ViewModel();
        $request = $this->getRequest();
        $this->layout('layout/admin');
        $model = new \Admin\Model\Media();

        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();
        $model->setStoreId($storeId);

        $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaMapper');
        $model->exchangeArray((array)$this->getRequest()->getQuery());

        $page = (int)$this->getRequest()->getQuery()->page ? : 1;

        if($request->getPost('page')){
            $page = (int)$request->getPost('page');
        }

        if($request->getPost('itemId')){
            $model->addOption('itemId', $request->getPost('itemId'));
//            $model->setId((int)$request->getPost('itemId'));
        }else{
            if($request->getPost('data') && $request->getPost('data') != ''){
                $model->setId($request->getPost('data'));
            }
        }
        if($request->getPost('type')){
            $model->addOption('type', $request->getPost('type'));
        }

        if($request->getPost('loadAll')){
            $model->addOption('loadAll', $request->getPost('loadAll'));
        }
        if($request->getPost('order') == 'ASC'){
            $model->addOption('order' , 'ASC');
        }elseif($request->getPost('order') == 'DESC'){
            $model->addOption('order' , 'DESC');
        }

        $results = $mediaMapper->search($model, array($page, 10));

        if ($request->getPost('template')) {
            $viewModel->setTemplate($request->getPost('template'));
            $viewModel->setTerminal($request->getPost('terminal', false));
        }

        $viewModel->setVariable('results', $results);
        if( $results->getRowCount() && $results->getRowInPage() ){
            $paging = $results->getPaging();
            $currentPage = $paging[0];
            $numPerPage = $paging[1];
            $rowCount = $results->getRowCount();
            $lastPage = ceil($rowCount/$numPerPage);
            $viewModel->setVariable('totalPage', $lastPage);
        }

        return $viewModel;
	}

    public function uploadAction()
    {
        $jsonModel = new JsonModel();
        $form = new \Admin\Form\Media($this->getServiceLocator());
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        if($this->getRequest()->isPost()){
            $form->setData(array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()));
            if($form->isValid()){
                $formData = $form->getData();

                $a = $formData['imagemulti'];
                foreach($a as $ff){
                    preg_match('/(.+).(jpe?g|png|gif)$/i', $ff['name'], $nameImage);
                    $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaMapper');

                    $getMedia = new \Admin\Model\Media();
                    $getMedia->setFileName(\Base\Model\Resource::slugify($ff['name']));
                    $getMedia->setStoreId($storeId);
                    $r = $mediaMapper->get($getMedia);
                    if($r) {
                        $ff['name'] = $nameImage[1].strtotime(DateBase::getCurrentDateTime()).'.'.$nameImage[2];
                    }

                    $media = new \Admin\Model\Media();
                    $media->setType($media::FILE_IMAGES);
                    $media->setFileName(\Base\Model\Resource::slugify($ff['name']));
                    $media->setCreatedById($u->getId());
                    $media->setStoreId($storeId);
                    $media->setCreatedDateTime(DateBase::getCurrentDateTime());
                    $targetFolder = \Base\Model\Uri::getSavePath($media);
                    if (! file_exists($targetFolder)) {
                        $oldmask = umask(0);
                        mkdir($targetFolder, 0777, true);
                        umask($oldmask);
                    }

                    rename($ff['tmp_name'], $targetFolder . '/' . \Base\Model\Resource::slugify($ff['name']));
                    chmod($targetFolder . '/' . \Base\Model\Resource::slugify($ff['name']), 0777);

                    if(!$mediaMapper->get($media)) {
                        $mediaMapper->save($media);
                    }
                }

                $jsonModel->setVariables([
                    'code' => 1,
                    'message' => 'Upload thành công',
                    'url' => $media->getPictureUri(),
                ]);
                return $jsonModel;
            }else{
                $jsonModel->setVariables([
                    'code' => 0,
                    'message' => $form->getErrorMessagesList()
                ]);
                return $jsonModel;
            }
        }
    }

    public function bannerAction(){
        $this->layout('layout/admin');
        $banner = new \Admin\Model\Banner();
        $mapper = $this->getServiceLocator()->get('Admin\Model\BannerMapper');

        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $banner->exchangeArray((array)$this->getRequest()->getQuery());
        $options['isAdmin'] = $this->user()->isSuperAdmin();
        $fFilter = new \Admin\Form\ArticleSearch($options);
        $banner->setStoreId($storeId);

        $fFilter->bind($banner);
        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $results = $mapper->search($banner, array($page,10));

        return new ViewModel(array(
            'fFilter' => $fFilter,
            'results' => $results
        ));
    }

    public function addAction(){
        $this->layout('layout/admin');
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $banner = new \Admin\Model\Banner();
        $banner->setCreatedById(1);
        $banner->setCreatedDateTime(DateBase::getCurrentDateTime());
        $banner->setStoreId($storeId);
        $banner->setStatus(\Admin\Model\Banner::STATUS_ACTIVE);
        $bannerMapper = $this->getServiceLocator()->get('Admin\Model\BannerMapper');

        $form = new \Admin\Form\Banner($this->getServiceLocator(), null);
        $form->bind($banner);


        if($this->getRequest()->isPost()) {
            $form->setData(array_merge_recursive($this->getRequest()->getPost()->toArray(),$this->getRequest()->getFiles()->toArray()));
            if($form->isValid()){
                $data = $form->getData();
                $postImages = $this->getRequest()->getPost()['images'];
                $productRelated = $data->getProductRelated();
                $articleRelated = $data->getArticleRelated();

                if(isset($postImages) && $postImages != ''){
                    $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaMapper');
                    $imgJson = [];
                    $imagesArray = explode(',', $postImages);
                    foreach($imagesArray as $i){
                        $media = new \Admin\Model\Media();
                        $media->setId($i);
                        $rm = $mediaMapper->get($media);
//                        print_r($rm->getPictureUri());die;
                        if($rm) {
                            $imgJson[$i] = $rm->getPictureUri();
                        }
//                        print_r($imgJson);die;
                    }
//                    echo $imgJson;die;
                    $banner->setImage(json_encode($imgJson));
                }

                if(!empty($productRelated)) {
                    $productMapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');
                    $productRelateds = '';
                    foreach($productRelated as $p) {
                        $productR = new \Admin\Model\Product();
                        $productR->setId((int)$p);
                        $r = $productMapper->get($productR);
                        if(!empty($r)) {
                            $productRelateds = $r->getViewLink();
                        }
                    }
                }

                if(!empty($articleRelated)) {
                    $articleMapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
                    $articleRelateds = '';
                    foreach($articleRelated as $p) {
                        $articleR = new \Admin\Model\Article();
                        $articleR->setId((int)$p);
                        $r = $articleMapper->get($articleR);
                        if(!empty($r)) {
                            $articleRelateds = $r->getViewLink();
                        }
                    }
                }

                if(!empty($data->getLink())) {
                    $banner->setLink($data->getLink());
                } elseif (!empty($productRelateds)) {
                    $banner->setLink($productRelateds);
                } elseif (!empty($articleRelateds)) {
                    $banner->setLink($articleRelateds);
                }
                $bannerMapper->save($banner);
                $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
                //Check exits cần một vòng for query select sẽ dài hơn where in id delete. Nên chỗ này xóa đi rồi saves
                $mediaMapper->deleteFileProduct($banner->getId());
                $postImages = $this->getRequest()->getPost()['images'];
                if(isset($postImages) && $postImages != ''){
                    $imagesArray = explode(',', $postImages);
                    $c = 1;
                    foreach($imagesArray as $i){
                        if($i){
                            $mediaItem = new \Admin\Model\MediaItem();
                            $mediaItem->setType(\Admin\Model\MediaItem::FILE_BANNER);
                            $mediaItem->setItemId($banner->getId());
                            $mediaItem->setFileItem($i);
                            $mediaItem->setSort($c++);
                            $mediaItem->setStoreId($storeId);
                            $mediaMapper->save($mediaItem);
                        }
                    }
                }
                $this->redirect()->toUrl('/admin/media/banner');
            }
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function editbannerAction()
    {
        $this->layout('layout/admin');
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        $sl = $this->getServiceLocator();
        $u = $sl->get('User\Service\User');
        $storeId = $u->getStoreId();

        $mapper = $this->getServiceLocator()->get('Admin\Model\BannerMapper');
        $model = new \Admin\Model\Banner();
        $model->setId($id);
        $model->setStoreId($storeId);

        if(!$mapper->get($model)){
            $this->redirect()->toUrl('/admin/media/banner');
        }

        $form = new \Admin\Form\Banner($this->getServiceLocator(), null);

        $data = $model->toFormValues();
        $mediaItem = new \Admin\Model\MediaItem();
        $mediaItem->setItemId($id);
        $mediaItem->setType(\Admin\Model\MediaItem::FILE_BANNER);

        $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
        $m = $mediaMapper->fetchAll($mediaItem);
        $fI = [];
        if(isset($m)){
            foreach($m as $i){
                $fI[] = $i->getFileItem();
            }
        }

        /**** productRelated ****/

        if($model->getLink()) {
            preg_match_all('/\-p(\d+)/', $model->getLink(), $product);
            preg_match_all('/\-n(\d+)/', $model->getLink(), $news);

            if(!empty($product[1][0])) {
                $productId = $product[1][0];
                $productR = new \Admin\Model\Product();
                $productR->setId((int)$productId);
                $productMapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');
                $r = $productMapper->get($productR);
                if(!empty($r)) {
                    $pr[$productR->getId()] = ['label' => $productR->getTitle(), 'value' => $productR->getId(), 'selected' => true];
                    $data['link'] = '';
                }
            } elseif(!empty($news[1][0])) {
                $articleId = $news[1][0];
                $articleMapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
                $articleR = new \Admin\Model\Article();
                $articleR->setId((int)$articleId);
                $r = $articleMapper->get($articleR);
                if(!empty($r)) {
                    $ar[$articleR->getId()] = ['label' => $articleR->getTitle(), 'value' => $articleR->getId(), 'selected' => true];
                    $data['link'] = '';
                }
            }
        }

        $form->setProductRelated($pr);
        $form->setArticleRelated($ar);

        $data['images'] = implode(',', $fI);
        $form->setData($data);

        if($this->getRequest()->isPost()){
            $form->setData(array_merge_recursive($this->getRequest()->getPost()->toArray(),$this->getRequest()->getFiles()->toArray()));
            if($form->isValid()){
                $data = $form->getData();
                $model->exchangeArray($data);
                $postImages = $this->getRequest()->getPost()['images'];

                if(isset($postImages) && $postImages != ''){
                    $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaMapper');
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

                $productRelated = $data['productRelated'];
                $articleRelated = $data['articleRelated'];

                if(!empty($productRelated)) {
                    $productMapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');
                    $productRelateds = '';
                    foreach($productRelated as $p) {
                        $productR = new \Admin\Model\Product();
                        $productR->setId((int)$p);
                        $r = $productMapper->get($productR);
                        if(!empty($r)) {
                            $productRelateds = $r->getViewLink();
                        }
                    }
                }

                if(!empty($articleRelated)) {
                    $articleMapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
                    $articleRelateds = '';
                    foreach($articleRelated as $p) {
                        $articleR = new \Admin\Model\Article();
                        $articleR->setId((int)$p);
                        $r = $articleMapper->get($articleR);
                        if(!empty($r)) {
                            $articleRelateds = $r->getViewLink();
                        }
                    }
                }

                if(!empty($data['link'])) {
                    $model->setLink($data['link']);
                } elseif (!empty($productRelateds)) {
                    $model->setLink($productRelateds);
                } elseif (!empty($articleRelateds)) {
                    $model->setLink($articleRelateds);
                }

                $model->setCreatedDateTime(DateBase::getCurrentDateTime());

                $mapper->save($model);
                $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
                //Check exits cần một vòng for query select sẽ dài hơn where in id delete. Nên chỗ này xóa đi rồi saves
                $mediaMapper->deleteBanner($id);
                if(isset($data['images']) && $data['images'] != ''){
                    $imagesArray = explode(',', $data['images']);
                    $c = 1;
                    foreach($imagesArray as $i){
                        if($i){
                            $mediaItem = new \Admin\Model\MediaItem();
                            $mediaItem->setType(\Admin\Model\MediaItem::FILE_BANNER);
                            $mediaItem->setItemId($id);
                            $mediaItem->setFileItem($i);
                            $mediaItem->setSort($c++);
                            $mediaItem->setStoreId($storeId);
                            $mediaMapper->save($mediaItem);
                        }
                    }
                }
                $this->redirect()->toUrl('/admin/media/banner');
            }
        }
        return new ViewModel(array(
            'form' => $form,
            'itemId' => $id
        ));
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getPost()['id'];
        if(!is_numeric($id)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy Banner này'
            ));
        }

        $mapper = $this->getServiceLocator()->get('Admin\Model\BannerMapper');
        $banner = new \Admin\Model\Banner();
        $banner->setId($id);

        if(!$mapper->get($banner)){
            return new JsonModel(array(
                'code' => 0,
                'messenger' => 'Chúng tôi không tìm thấy Banner này'
            ));
        }

        $mapper->delete($banner);

        if($banner->getId()){
            $mediaItem = new \Admin\Model\MediaItem();
            $mediaItem->setItemId($banner->getId());
            $mediaItem->setType(\Admin\Model\MediaItem::FILE_BANNER);
            $mediaMapper = $this->getServiceLocator()->get('Admin\Model\MediaItemMapper');
            $mediaMapper->deleteType($mediaItem);
        }

        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Đã xóa'
        ));
    }

    public function changeAction()
    {
        $id = $this->getRequest()->getPost('id');
        if(!is_numeric($id)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy Banner này'
            ));
        }
        $mapper = $this->getServiceLocator()->get('Admin\Model\BannerMapper');
        $banner = new \Admin\Model\Banner();
        $banner->setId($id);

        if(!$mapper->get($banner)){
            return new JsonModel(array(
                'code'=> 0,
                'messenger' => 'Chúng tôi không tìm thấy sản phẩm này'
            ));
        }
        if($banner->getStatus() == \Admin\Model\Banner::STATUS_ACTIVE){
            $banner->setStatus(\Admin\Model\Banner::STATUS_INACTIVE);
        }else{
            $banner->setStatus(\Admin\Model\Banner::STATUS_ACTIVE);
        }
        $mapper->save($banner);

        return new JsonModel(array(
            'code'=> 1,
            'messenger' => 'Đã thay đổi',
            'status' => $banner->getStatus()
        ));
    }

}





















