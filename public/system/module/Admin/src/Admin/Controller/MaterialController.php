<?php
namespace Admin\Controller;
use Admin\Model\Media;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Home\Form\FormBase;
use Home\Model\DateBase;
use Home\Model\Base;
use Base\XLSX\XLSXWriter;
use Base\XLSXImage\XLSWriterPlus;


class MaterialController extends AbstractActionController{

	public function indexAction()
    {
        $this->layout('layout/admin');
//        echo 'index material';
//        die;
		$model = new \Admin\Model\Material();
        $sl = $this->getServiceLocator();
		$mapper = $sl->get('Admin\Model\MaterialMapper');
        $u = $sl->get('User\Service\User');
//        $slug = $this->params()->fromQuery();
//        print_r($this->getRequest()->getUri()->getQuery());die;
//        $manufacture = new \Admin\Model\Manufacture();
//        $manufactureMapper = $this->getServiceLocator()->get('Admin\Model\ManufactureMapper');
//        $facture = $manufactureMapper->fetchAll($manufacture);

		$model->exchangeArray((array)$this->getRequest()->getQuery());
        $options['isAdmin'] = $this->user()->isSuperAdmin();
//        $fFilter = new \Admin\Form\ArticleSearch($options);
        $fFilter = new \Admin\Form\MaterialSearch($options);
        if($this->getRequest()->getQuery()['id']) {
            $model->setId((int)substr(trim($this->getRequest()->getQuery()['id']),2));
        }
//        $optionMapper = $sl->get('Admin\Model\OptionMapper');
//        $option = new \Admin\Model\Option();
//        $option->setStoreId($storeId);
//        $dataOption = $optionMapper->get($option);
//        $dataOld = !empty($dataOption) ?  json_decode($dataOption->getData(), true):'';
		$page = (int)$this->getRequest()->getQuery()->page ? : 1;
		$results = $mapper->search($model, array($page,50));

		return new ViewModel(array(
			'fFilter' => $fFilter,
			'results' => $results,
            'url' => $this->getRequest()->getUri()->getQuery(),
            'uri' => $this->getRequest()->getUri()->getQuery(),
            'query' => (array)$this->getRequest()->getQuery(),
        ));
	}

	public function addAction()
    {
		$this->layout('layout/admin');
//        $storeId = $this->getServiceLocator()->get('Store\Service\Store')->getStoreId();

        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $model = new \Admin\Model\Material();
		$manufacture = new \Admin\Model\Manufacture();
        $manufactureMapper = $this->getServiceLocator()->get('Admin\Model\ManufactureMapper');
        $facture = $manufactureMapper->fetchAll($manufacture);

        $mapper = $this->getServiceLocator()->get('Admin\Model\MaterialMapper');
		$form = new \Admin\Form\Material($this->getServiceLocator(), null);
		$types = $model->type_form;
		$form->setCategoryIds($types);
		$form->setNCC($facture);

		/****** Option Field ********/


		if($this->getRequest()->isPost()){
			$form->setData(array_merge_recursive($this->getRequest()->getPost()->toArray(),$this->getRequest()->getFiles()->toArray()));
			if($form->isValid(false)){
                $data = $form->getData();
                $model->exchangeArray($data);
                $parent = new \Admin\Model\Material();
                $parent->setName(trim($data['name']));

                $parentId = $mapper->get_parent($parent);
                if($parentId) {
                    if($parentId->getId()) {
                        $model->setParentId($parentId->getId());
                    }
                }

                $price = (float)str_replace(",", "", $data['price']);
                $model->setPrice($price);
                $model->setCreatedDateTime(DateBase::getCurrentDateTime());
                $model->setCreatedById($u->getId());
                $mapper->save($model);

                $this->redirect()->toUrl('/admin/material');
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
		$slug = $this->getRequest()->getUri()->getQuery();
        $u = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $u->getStoreId();

        $mapper = $this->getServiceLocator()->get('Admin\Model\MaterialMapper');

        $model = new \Admin\Model\Material();
        $model->setId($id);
        $resultMaterial = $mapper->get($model);

        if(!$resultMaterial){
            $this->redirect()->toUrl('/admin/material');
        }

        $manufacture = new \Admin\Model\Manufacture();
        $manufactureMapper = $this->getServiceLocator()->get('Admin\Model\ManufactureMapper');
        $facture = $manufactureMapper->fetchAll($manufacture);

        $form = new \Admin\Form\Material($this->getServiceLocator(), null);
        $types = $model->type_form;
        $form->setCategoryIds($types);
        $form->setNCC($facture);


        $materialParent = new \Admin\Model\Material();
        $materialParent->setParentId($id);
        $resultMaterialParent= $mapper->getParent($materialParent);

		$invoiceMaterial = new \Admin\Model\InvoiceMaterial();
        if(!empty($resultMaterialParent)) {
            $invoiceMaterial->setOptions(array_merge($resultMaterialParent, (array)$id));
        } else {
            $invoiceMaterial->setMaterialId($id);
        }
        $invoiceMaterial->setStatus(\Admin\Model\InvoiceMaterial::STATUS_APPROVED);
        $invoiceMaterialMapper = $this->getServiceLocator()->get('Admin\Model\InvoiceMaterialMapper');
        $resultInvoiceMaterial = $invoiceMaterialMapper->fetchAll($invoiceMaterial);

        $data = $model->toFormValues();
        $form->setData($data);
//        $form->setCategoryIds();

		if($this->getRequest()->isPost()){
            $form->setData(array_merge_recursive($this->getRequest()->getPost()->toArray(),$this->getRequest()->getFiles()->toArray()));
            if($form->isValid(true)){
                $data = $form->getData();
                $resultMaterial->setImage($data['image']);
                $resultMaterial->setName($data['name']);
                if($data['price']) {
                    $price = (float)str_replace(",", "", $data['price']);
                    $model->setPrice($price);
                }
                if(!$resultMaterial->getManufactureId()) {
                    $resultMaterial->setManufactureId($data['manufactureId']);
                }
                $mapper->save($resultMaterial);
                $this->redirect()->toUrl('/admin/material');
			}else{
                print_r($form->getMessages());die;
            }
		}
		return new ViewModel(array(
			'form' => $form,
            'itemId' => $id,
            'materials' => $resultInvoiceMaterial,
		));
	}

	public function productAction() {
        $this->layout('layout/admin');
        $model = new \Admin\Model\ProductMaterial();
        $model->exchangeArray((array)$this->getRequest()->getQuery());
        $mapper = $this->getServiceLocator()->get('Admin\Model\ProductMaterialMapper');
//        /api/product/search


        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $results = $mapper->search($model, array($page,50));

        $options['isAdmin'] = $this->user()->isSuperAdmin();
        $fFilter = new \Admin\Form\MaterialProductSearch($options);

        return new ViewModel(array(
            'results' => $results,
            'url' => $this->getRequest()->getUri()->getQuery(),
            'uri' => $this->getRequest()->getUri()->getQuery(),
            'fFilter' => $fFilter,
            'query' => (array)$this->getRequest()->getQuery(),
        ));
    }

    public function productlistAction() {
        $this->layout('layout/admin');
        $query = $this->getRequest()->getUri()->getQuery();
        $page = (int)$this->getRequest()->getQuery()->page ? : 1;

        $array_id = array('9MPOLLAC225015L','9MPOLLAC231701L','9MPOLLAC226701L');
//        $array_data = array();
//        foreach ($array_id as $v):
            $api = \Base\Model\Resource::data_api();
            $data = json_encode(array('page' => $page, 'icpp' => 50, 'name' => ''));

            $data = array(
                'version' => $api['version'],
                'appId' => $api['appId'],
                'businessId' => $api['businessId'],
                'accessToken' => $api['accessToken'],
                'data' => $data
            );

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://open.nhanh.vn/api/product/search',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response, true);

//            $totalPage = $response['data']['totalPages'];
            $product_items = array();
//            for($c = 1; $c <= $totalPage; $c++) {
//                $api = \Base\Model\Resource::data_api();
//                $data = json_encode(array('page' => $c, 'icpp' => 50, 'name' => ''));
//                $data = array(
//                    'version' => $api['version'],
//                    'appId' => $api['appId'],
//                    'businessId' => $api['businessId'],
//                    'accessToken' => $api['accessToken'],
//                    'data' => $data
//                );
//
//                $curl = curl_init();
//
//                curl_setopt_array($curl, array(
//                    CURLOPT_URL => 'https://open.nhanh.vn/api/product/search',
//                    CURLOPT_RETURNTRANSFER => true,
//                    CURLOPT_ENCODING => '',
//                    CURLOPT_MAXREDIRS => 10,
//                    CURLOPT_TIMEOUT => 0,
//                    CURLOPT_FOLLOWLOCATION => true,
//                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                    CURLOPT_CUSTOMREQUEST => 'POST',
//                    CURLOPT_POSTFIELDS => $data,
//                ));
//
//                $response = curl_exec($curl);
//                curl_close($curl);
//                $response = json_decode($response, true);
//                if(!empty($response['data']['products'])) {
//                    foreach ($response['data']['products'] as $v) {
//                        $product_items[$v['code']] = array(
//                            'name' => $v['name'],
//                            'image' => $v['image'],
//                        );
//                    }
//                }
//                $array_data[] = $response['data'];
//            }
        return new ViewModel(array(
            'query'=> $query,
            'results'=> $response['data'],
//            'fFilter'=> $fFilter,
//            'id' => $id,
//            'phone' => $phone
        ));
    }

    public function importmaterialAction() {
        $import_material = $this->getRequest()->getPost()['import_material'];
        $product_material = $this->getRequest()->getPost()['product_material'];
        $import_material = json_decode(html_entity_decode(stripslashes($import_material)), true);
        $product_material = json_decode(html_entity_decode(stripslashes($product_material)), true);
        $u = $this->getServiceLocator()->get('User\Service\User');

        if(!empty($import_material)) {
            $errors = 0;
            $success = 0;
            $error_text = '';
            foreach ($import_material as $v) {
                $v = array_values($v);
                $material = new \Admin\Model\Material();
                $material->setName(trim($v[0]));

                $materialMapper = $this->getServiceLocator()->get('Admin\Model\MaterialMapper');
                $rMaterial = $materialMapper->searchName($material);
                if(!$rMaterial){
                    $cong = trim((int)$v[1]);
                    $price = trim((int)$v[3]);
                    $manufacture = new \Admin\Model\Manufacture();
                    $manufacture->setName($v[2]);
                    $manufactureMapper = $this->getServiceLocator()->get('Admin\Model\ManufactureMapper');
                    $rManufacture = $manufactureMapper->searchName($manufacture);
                    if($rManufacture) {
                        $material->setManufactureId($rManufacture->getId());
                    }
                    if($cong == 3 && !empty($price)) {
                        $material->setPrice($price);
                    }
                    $material->setType($cong);
                    $material->setCreatedDateTime(DateBase::getCurrentDateTime());
                    $material->setCreatedById($u->getId());
                    $materialMapper->save($material);
                    $success += 1;
                } else {
                    $errors += 1;
                    $error_text .= trim($v[0]).', ';
                }
            }

            return new JsonModel(array(
                'code' => 1,
                'errors' => $errors,
                'error_text' => $error_text,
                'success' => $success,
            ));
        }

        if(!empty($product_material)) {
            $printedSeasons = [];
            $mapperProductMaterialItem = $this->getServiceLocator()->get('Admin\Model\ProductMaterialItemMapper');
            $mapperProductMaterial = $this->getServiceLocator()->get('Admin\Model\ProductMaterialMapper');
            $mapperMaterial = $this->getServiceLocator()->get('Admin\Model\MaterialMapper');
            $errors = 0;
            $success = 0;
            $error_text = '';
            foreach ($product_material as $v) {
                $v = array_values($v);
                $sku = trim($v[0]);
                $name = trim($v[1]);
                $image = trim($v[2]);
                $quantity = trim($v[4]);
                $quantity = (float)str_replace(",", ".", $quantity);;

                $materialId = (int)substr(trim($v[3]),2);
                $material = new \Admin\Model\Material();
                $material->setId($materialId);
                $materialR = $mapperMaterial->get($material);
                if($materialR) {
                    $modelProductMaterialItem = new \Admin\Model\ProductMaterialItem();
                    $modelProductMaterialItem->setProductId($sku);
                    $modelProductMaterialItem->setMaterialId($materialR->getId());
                    $rProductMaterialItem = $mapperProductMaterialItem->getProductMaterial($modelProductMaterialItem);
                    if(!$rProductMaterialItem) {
                        if($materialR->getPrice()) {
                            $modelProductMaterialItem->setPrice($materialR->getPrice());
                            $modelProductMaterialItem->setIntoMoney($quantity*$materialR->getPrice());
                        }
                        $modelProductMaterialItem->setQuantity($quantity);
                        $modelProductMaterialItem->setUpdatedDateTime(DateBase::getCurrentDateTime());
                        $modelProductMaterialItem->setCreatedDateTime(DateBase::getCurrentDateTime());
                        $modelProductMaterialItem->setCreatedById($u->getId());
                        $mapperProductMaterialItem->save($modelProductMaterialItem);
                        $success += 1;
                    } else {
                        $errors += 1;
                        $error_text .= trim($v[0]).', ';
                    }
                    if(!in_array($sku, $printedSeasons)) {
                        $printedSeasons[] = $sku;
                        $modelProductMaterial = new \Admin\Model\ProductMaterial();
                        $modelProductMaterial->setProductId($sku);
                        $rPM = $mapperProductMaterial->get($modelProductMaterial);
                        if(!$rPM) {
                            $modelProductMaterial->setCreatedDateTime(DateBase::getCurrentDateTime());
                            $modelProductMaterial->setCreatedById($u->getId());
                            $modelProductMaterial->setName($name);
                            $modelProductMaterial->setImage($image);
                            $mapperProductMaterial->save($modelProductMaterial);
                        }
                    }
                }
            }
            return new JsonModel(array(
                'code' => 1,
                'errors' => $errors,
                'error_text' => $error_text,
                'success' => $success,
            ));
        }
        return new JsonModel(array(
            'code' => 0,
            'messenger' => 'Dữ liệu không phù hợp'
        ));
    }

    public function exportproductAction() {
        $selected_products = $this->getRequest()->getQuery()['ids'];
        $selected = explode(',',$selected_products);
        if(!empty($selected) && is_array($selected) && $selected_products !== null) {
            $this->export_selected($selected);
        } else {
            $this->export_all();
        }
    }

    private function export_selected($products) {
	    if(empty($products)) {
	        return false;
        }
        $product_items = array();
	    foreach ($products as $i) {
            $api = \Base\Model\Resource::data_api();
            $data = json_encode(array('name' => $i));
            $data = array(
                'version' => $api['version'],
                'appId' => $api['appId'],
                'businessId' => $api['businessId'],
                'accessToken' => $api['accessToken'],
                'data' => $data
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://open.nhanh.vn/api/product/search',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response, true);
            if(!empty($response['data']['products'])) {
                foreach ($response['data']['products'] as $v) {
                    $product_items[$v['code']] = array($v['code'],$v['name'], $v['image']);
                }
            }
        }
        if(!empty($product_items)) {
            $this->template_excel($product_items);
        }
    }

    private function export_all() {
        $product_items = array();
        $api = \Base\Model\Resource::data_api();
        $data = json_encode(array('icpp' => 50));
        $data = array(
            'version' => $api['version'],
            'appId' => $api['appId'],
            'businessId' => $api['businessId'],
            'accessToken' => $api['accessToken'],
            'data' => $data
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://open.nhanh.vn/api/product/search',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response, true);
        $totalPage = $response['data']['totalPages'];

        $product_items = array();

        for($c = 1; $c <= $totalPage; $c++) {
            $api = \Base\Model\Resource::data_api();
            $data = json_encode(array('page' => $c, 'icpp' => 50, 'name' => ''));
            $data = array(
                'version' => $api['version'],
                'appId' => $api['appId'],
                'businessId' => $api['businessId'],
                'accessToken' => $api['accessToken'],
                'data' => $data
            );

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://open.nhanh.vn/api/product/search',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($response, true);
            if(!empty($response['data']['products'])) {
                foreach ($response['data']['products'] as $v) {
                    $product_items[$v['code']] = array($v['code'],$v['name'], $v['image']);
                }
            }
            $array_data[] = $response['data'];
        }

        if(!empty($product_items)) {
            $this->template_excel($product_items);
        }

    }

    private function template_excel($product_items) {
	    if(empty($product_items)) {
	        return false;
        }
	    print_r($product_items);die;
        $file_name = 'Danh sách sản phẩm_'.date('ymd').'.xlsx';
        $sheet_product = 'Product Material';
        $header_one = array( 'Mã sản phẩm', 'Tên sản phẩm', 'Hình ảnh sản phẩm', 'Mã vật liệu', 'Số lượng');
        $styles_white = array('font'=>'Arial', 'font-style'=>'bold', 'fill'=>'#FFF', 'halign'=>'left', 'border'=>'left,right,top,bottom');
        $writer = new XLSXWriter();
        $writer->writeSheetRow($sheet_product, $header_one, $styles_white);
        foreach ($product_items as $pi) {
            $writer->writeSheetRow($sheet_product, $pi);
        }
        $writer->writeToFile($file_name);
        header('Content-Description: File Transfer');
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=" . basename($file_name));
        header("Content-Transfer-Encoding: binary");
        header("Expires: 0");
        header("Pragma: public");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Length: ' . filesize($file_name));
        ob_clean();
        flush();
        readfile($file_name);
        unlink($file_name);
        exit;
    }

    public function addproductAction() {
        $this->layout('layout/admin');
        $id = $this->getRequest()->getQuery()->id;
        $img = $this->getRequest()->getQuery()->img;
        $name = $this->getRequest()->getQuery()->name;
        $query = $this->getRequest()->getQuery();
        unset($_SESSION['count']);

        $u = $this->getServiceLocator()->get('User\Service\User');
        $model = new \Admin\Model\ProductMaterial();
        $model->setImage($img);
        $mapper = $this->getServiceLocator()->get('Admin\Model\ProductMaterialMapper');
        $form = new \Admin\Form\ProductMaterial($this->getServiceLocator(), null);
        if($this->getRequest()->isPost()){
            $form->setData(array_merge_recursive($this->getRequest()->getPost()->toArray(),$this->getRequest()->getFiles()->toArray()));
            if($form->isValid(false)){
                $data = $form->getData();
                $model->exchangeArray($data);
                $model->setCreatedDateTime(DateBase::getCurrentDateTime());
                $model->setCreatedById($u->getId());
                $mapper->save($model);
                if($model->getId()) {
                    if(!empty($data['materialId'])) {
                        foreach ($data['materialId'] as $k => $v) {
                            $price = (float)str_replace(",", "", $data['price'][$k]);
                            $quantity = (float)str_replace(",", ".", $data['quantity'][$k]);
                            $intoMoney = (float)str_replace(",", "", $data['intoMoney'][$k]);
                            $mapperProductMaterialItem = $this->getServiceLocator()->get('Admin\Model\ProductMaterialItemMapper');
                            $modelProductMaterialItem = new \Admin\Model\ProductMaterialItem();
                            $modelProductMaterialItem->exchangeArray($data);
                            $modelProductMaterialItem->setMaterialId($v);
                            $modelProductMaterialItem->setPrice($price);
                            $modelProductMaterialItem->setQuantity($quantity);
                            $modelProductMaterialItem->setIntoMoney($intoMoney);
                            $modelProductMaterialItem->setCreatedDateTime(DateBase::getCurrentDateTime());
                            $modelProductMaterialItem->setUpdatedDateTime(DateBase::getCurrentDateTime());
                            $modelProductMaterialItem->setCreatedById($u->getId());
                            $mapperProductMaterialItem->save($modelProductMaterialItem);
                        }
                    }
                }
                $this->redirect()->toUrl('/admin/material/product');
            } else {
                print_r($form->getMessages());
            }
        }
        return new ViewModel(array(
            'form' => $form,
            'query' => $query,
        ));
    }

    public function editproductAction() {
        $this->layout('layout/admin');
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        unset($_SESSION['count']);

//        $id = $this->getRequest()->getQuery()->id;
//        $img = $this->getRequest()->getQuery()->img;
//        $name = $this->getRequest()->getQuery()->name;
//        $query = $this->getRequest()->getQuery();
//        unset($_SESSION['count']);

        $u = $this->getServiceLocator()->get('User\Service\User');
        $model = new \Admin\Model\ProductMaterial();
//        $model->setImage($img);
        $mapper = $this->getServiceLocator()->get('Admin\Model\ProductMaterialMapper');
        $model->setId($id);
        $result = $mapper->get($model);

        $form = new \Admin\Form\ProductMaterial($this->getServiceLocator(), null);
        $data = $model->toFormValues();
        $form->setData($data);

        $mapperProductMaterialItem = $this->getServiceLocator()->get('Admin\Model\ProductMaterialItemMapper');
        $modelProductMaterialItem = new \Admin\Model\ProductMaterialItem();
        $modelProductMaterialItem->setProductId($data['productId']);

        $materials = $mapperProductMaterialItem->fetchAll($modelProductMaterialItem);

        if($this->getRequest()->isPost()){
            $form->setData(array_merge_recursive($this->getRequest()->getPost()->toArray(),$this->getRequest()->getFiles()->toArray()));
            if($form->isValid(true)){
                $data = $form->getData();
                $model->exchangeArray($data);
//                $model->setCreatedDateTime(DateBase::getCurrentDateTime());
                $model->setCreatedById($u->getId());
                $mapper->save($model);
                if($model->getId()) {
                    if(!empty($data['materialId'])) {
                        foreach ($data['materialId'] as $k => $v) {
                            $price = (float)str_replace(",", "", $data['price'][$k]);
                            $quantity = (float)str_replace(",", ".", $data['quantity'][$k]);
                            $intoMoney = (float)str_replace(",", "", $data['intoMoney'][$k]);
                            $id = $data['pmId'][$k];
                            $mapperProductMaterialItem = $this->getServiceLocator()->get('Admin\Model\ProductMaterialItemMapper');
                            $modelProductMaterialItem = new \Admin\Model\ProductMaterialItem();
                            $modelProductMaterialItem->setId($id);
                            $resultProductMaterialItem = $mapperProductMaterialItem->get($modelProductMaterialItem);
                            $dataMaterialItem = $modelProductMaterialItem->toFormValues();

                            $modelProductMaterialItem->exchangeArray($dataMaterialItem);
                            $modelProductMaterialItem->setId($id);
                            $modelProductMaterialItem->setMaterialId($v);
                            $modelProductMaterialItem->setProductId($model->getProductId());
                            $modelProductMaterialItem->setPrice($price);
                            $modelProductMaterialItem->setQuantity($quantity);
                            $modelProductMaterialItem->setIntoMoney($intoMoney);
                            if(!$id) {
                                $modelProductMaterialItem->setCreatedDateTime(DateBase::getCurrentDateTime());
                            }
                            $modelProductMaterialItem->setUpdatedDateTime(DateBase::getCurrentDateTime());
                            $modelProductMaterialItem->setCreatedById($u->getId());
                            $mapperProductMaterialItem->save($modelProductMaterialItem);
                        }
                    }
                }

                $this->redirect()->toUrl('/admin/material/product');
            } else {
                print_r($form->getMessages());
            }
        }
        return new ViewModel(array(
            'form' => $form,
            'materials' => $materials,
//            'query' => $query,
        ));
    }

    public function additemproductAction() {
        $this->layout('layout/null');
        $type = $this->getRequest()->getPost()['type'];
        $productId = $this->getRequest()->getPost()['product_id'];
        $productItemId = $this->getRequest()->getPost()['product_item_id'];
        $materialId = $this->getRequest()->getPost()['material_id'];
        $model = new \Admin\Model\ProductMaterial();
        $mapper = $this->getServiceLocator()->get('Admin\Model\ProductMaterialMapper');
        $form = new \Admin\Form\ProductMaterial($this->getServiceLocator(), null);
        $resultMaterialItem = array();

        if($type === 'add') {
            if(!isset($_SESSION['count'])) {
                $_SESSION['count'] = 2;
            } else {
                $_SESSION['count'] = $_SESSION['count'] + 1;
            }
        }
        if($type === 'remove') {
            if(!session_id()) {
                session_start();
            }
            $mapperProductMaterialItem = $this->getServiceLocator()->get('Admin\Model\ProductMaterialItemMapper');

            if($materialId && $productItemId) {
                $modelMaterialItemDelete = new \Admin\Model\ProductMaterialItem();
                $modelMaterialItemDelete->setProductId($productItemId);
                $modelMaterialItemDelete->setMaterialId($materialId);
                $mapperProductMaterialItem->delete($modelMaterialItemDelete);
            } else {
                if(isset($_SESSION['count'])) {
                    $_SESSION['count'] =  $_SESSION['count'] > 0 ? $_SESSION['count'] - 1:0;
                } else {
                    $_SESSION['count'] = 0;
                }
            }
            if($productItemId) {
                $modelProductMaterialItem = new \Admin\Model\ProductMaterialItem();
                $modelProductMaterialItem->setProductId($productItemId);
                $resultMaterialItem = $mapperProductMaterialItem->fetchAll($modelProductMaterialItem);
            }
        }
        if($type === 'edit') {
            if(!isset($_SESSION['count'])) {
                $_SESSION['count'] = 1;
            } else {
                $_SESSION['count'] = $_SESSION['count'] + 1;
            }
            if($productId) {
                $mapperProductMaterialItem = $this->getServiceLocator()->get('Admin\Model\ProductMaterialItemMapper');
                $modelProductMaterialItem = new \Admin\Model\ProductMaterialItem();
                $modelProductMaterialItem->setProductId($productId);
                $resultMaterialItem = $mapperProductMaterialItem->fetchAll($modelProductMaterialItem);
            }
        }
        $add_pricing = [];
        for($c = 1; $c <= $_SESSION['count']; $c++) {
            $add_pricing[] = $c;
        }
        $pricing = array();

        $add_pricing = array_merge($resultMaterialItem, $add_pricing);
        return new ViewModel(array(
            'form' => $form,
            'item' => $add_pricing,
            'material_item' => $resultMaterialItem,
            'product_id' => $productId,
        ));
    }

    public function additemproductinvoiceAction() {
        $this->layout('layout/null');
        $type = $this->getRequest()->getPost()['type'];
        $productId = $this->getRequest()->getPost()['product_id'];
        $productItemId = $this->getRequest()->getPost()['product_item_id'];
        $materialId = $this->getRequest()->getPost()['material_id'];
        $model = new \Admin\Model\ProductMaterial();
        $mapper = $this->getServiceLocator()->get('Admin\Model\ProductMaterialMapper');
        $form = new \Admin\Form\ProductMaterial($this->getServiceLocator(), null);
        $resultMaterialItem = array();

        if($type === 'add') {
            if(!isset($_SESSION['count'])) {
                $_SESSION['count'] = 2;
            } else {
                $_SESSION['count'] = $_SESSION['count'] + 1;
            }
        }
        if($type === 'remove') {
            if(!session_id()) {
                session_start();
            }
            $mapperProductMaterialItem = $this->getServiceLocator()->get('Admin\Model\ProductMaterialItemMapper');

            if($materialId && $productItemId) {
                $modelMaterialItemDelete = new \Admin\Model\ProductMaterialItem();
                $modelMaterialItemDelete->setProductId($productItemId);
                $modelMaterialItemDelete->setMaterialId($materialId);
                $mapperProductMaterialItem->delete($modelMaterialItemDelete);
            } else {
                if(isset($_SESSION['count'])) {
                    $_SESSION['count'] =  $_SESSION['count'] > 0 ? $_SESSION['count'] - 1:0;
                } else {
                    $_SESSION['count'] = 0;
                }
            }
            if($productItemId) {
                $modelProductMaterialItem = new \Admin\Model\ProductMaterialItem();
                $modelProductMaterialItem->setProductId($productItemId);
                $resultMaterialItem = $mapperProductMaterialItem->fetchAll($modelProductMaterialItem);
            }
        }

        $add_pricing = [];
        for($c = 1; $c <= $_SESSION['count']; $c++) {
            $add_pricing[] = $c;
        }
        $pricing = array();

        $add_pricing = array_merge($resultMaterialItem, $add_pricing);
        return new ViewModel(array(
            'form' => $form,
            'item' => $add_pricing,
            'material_item' => $resultMaterialItem,
            'product_id' => $productId,
        ));
    }

    public function ordermanufactureAction() {
        $data = $this->getRequest()->getPost()['data'];
        $order_products = (array)json_decode($data, true);

        if(empty($order_products)) {
            return new JsonModel(array(
                'code' => 0,
                'messenger' => 'Dữ liệu không phù hợp, hoặc đơn hàng không tồn tại'
            ));
        }

        $orderId = (int)$this->array_key_first($order_products);
        $u = $this->getServiceLocator()->get('User\Service\User');


        foreach ($order_products as $op) {
            $material_check = array();
            $material_empty = array();
            foreach ($op as $productId => $product) {
                foreach ($product as $pp) {
                    $materialId = (int)$pp['materialId'];
                    $quantity = (float)$pp['quantity'];
                    $material = new \Admin\Model\Material();
                    $material->setId($materialId);
                    $mapperMaterial = $this->getServiceLocator()->get('Admin\Model\MaterialMapper');
                    $resultMaterial = $mapperMaterial->get($material);
                    $material_check[$materialId] += $quantity;
                    if(!$resultMaterial->getTotalQuantiy() || !$resultMaterial->getPrice() || !$resultMaterial->getTotalPrice()) {
                        if($resultMaterial->getType() != 3) {
                            $material_empty[$materialId] = $resultMaterial->getName();
                        }
                    }
                }
            }
            if(!empty($material_empty)) {
                return new JsonModel(array(
                    'code' => 0,
                    'messenger' => 'Vật liệu không đủ số lượng để sản xuất'
                ));
            }
        }
        $quantities = array();
        foreach ($material_check as $materialId => $qtt) {
            $material = new \Admin\Model\Material();
            $material->setId($materialId);
            $mapperMaterial = $this->getServiceLocator()->get('Admin\Model\MaterialMapper');
            $resultMaterial = $mapperMaterial->get($material);
            if($resultMaterial->getTotalQuantiy() < $qtt) {
                if($resultMaterial->getType() != 3) {
                    $quantities[$materialId] = $resultMaterial->getName();
                }
            }
        }
        if(!empty($quantities)) {
            return new JsonModel(array(
                'code' => 0,
                'messenger' => 'Vật liệu không đủ số lượng để sản xuất'
            ));
        }


        // Tạo đơn hàng
        $invoice = new \Admin\Model\Invoice();
        $invoice->setType(\Admin\Model\Invoice::EXPORT);
        $invoice->setStatus(\Admin\Model\Invoice::STATUS_APPROVED);
        $invoice->setDescription('Sản xuất đơn hàng "'.$orderId.'"');
        $invoice->setCreatedDateTime(DateBase::getCurrentDateTime());
        $invoice->setUpdatedDateTime(DateBase::getCurrentDateTime());
        $invoice->setCreatedById($u->getId());
        $invoice->setApprovedById($u->getId());
        $invoice->setOrderId($orderId);
        $invoiceMapper = $this->getServiceLocator()->get('Admin\Model\InvoiceMapper');
        $rInvoice = $invoiceMapper->save($invoice);
        $invoiceId = $rInvoice->getGeneratedValue();
        if($invoiceId) {
            foreach ($order_products as $op) {
                foreach ($op as $productId => $product) {
                    foreach ($product as $pp) {
                        $materialId = (int)$pp['materialId'];
                        $quantity = (float)$pp['quantity'];
                        $material = new \Admin\Model\Material();
                        $material->setId($materialId);
                        $mapperMaterial = $this->getServiceLocator()->get('Admin\Model\MaterialMapper');
                        $resultMaterial = $mapperMaterial->get($material);
                        if($resultMaterial && $resultMaterial->getType() != 3) {
                            $quantityUpdated = $resultMaterial->getTotalQuantiy() - $quantity;
                            $resultMaterial->setTotalQuantiy($quantityUpdated);
                            $resultMaterial->setTotalPrice($resultMaterial->getPrice() * $quantityUpdated);
                        }
                        $mapperMaterial->save($resultMaterial);
                        $modelInvoiceMaterial = new \Admin\Model\InvoiceMaterial();
                        $mapperInvoiceMaterial = $this->getServiceLocator()->get('Admin\Model\InvoiceMaterialMapper');
                        $modelInvoiceMaterial->setType(\Admin\Model\Invoice::EXPORT);
                        $modelInvoiceMaterial->setMaterialId($materialId);
                        $modelInvoiceMaterial->setInvoiceId($invoiceId);
                        $modelInvoiceMaterial->setQuantity($quantity);
                        $modelInvoiceMaterial->setPrice($resultMaterial->getPrice());
                        $modelInvoiceMaterial->setIntoMoney($resultMaterial->getPrice()*$quantity);
                        if($resultMaterial->getType() == 3) {
                            $modelInvoiceMaterial->setInventoryTotalQuantiy($quantity);
                            $modelInvoiceMaterial->setInventoryPrice($resultMaterial->getPrice());
                            $modelInvoiceMaterial->setInventoryTotalPrice($resultMaterial->getPrice()*$quantity);
                        } else {
                            $modelInvoiceMaterial->setInventoryTotalQuantiy($resultMaterial->getTotalQuantiy());
                            $modelInvoiceMaterial->setInventoryPrice($resultMaterial->getPrice());
                            $modelInvoiceMaterial->setInventoryTotalPrice($resultMaterial->getTotalPrice());
                        }
                        $modelInvoiceMaterial->setCreatedDateTime(DateBase::getCurrentDateTime());
                        $modelInvoiceMaterial->setCreatedById($u->getId());
                        $modelInvoiceMaterial->setOrderId($orderId);
                        $modelInvoiceMaterial->setProductId($productId);
                        $modelInvoiceMaterial->setStatus(\Admin\Model\InvoiceMaterial::STATUS_APPROVED);
                        $mapperInvoiceMaterial->save($modelInvoiceMaterial);
                    }
                }
            }
            $orderManufacture = new \Admin\Model\OrderManufacture();
            $orderManufactureMapper = $this->getServiceLocator()->get('Admin\Model\OrderManufactureMapper');
            $orderManufacturer = $orderManufactureMapper->get($orderManufacture);

            if($orderManufacturer) {
                $orderManufacture->setId($orderManufacturer->getId());
            }
            $orderManufacture->setStatus(\Admin\Model\OrderManufacture::IN_PRODUCTION);
            $orderManufacture->setOrderId($orderId);
            $orderManufacture->setCreatedDateTime(DateBase::getCurrentDateTime());
            $orderManufacture->setCreatedById($u->getId());
            $orderManufacture->setStartDateTime(DateBase::getCurrentDateTime());
            $orderManufactureMapper->save($orderManufacture);
        }

        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Đang sản xuất'
        ));

    }

    public function orderfinishedAction() {
        $orderId = $this->getRequest()->getPost()['orderId'];
        $orderId = (int)trim($orderId);
        $orderManufacture = new \Admin\Model\OrderManufacture();
        $orderManufacture->setOrderId($orderId);
        $orderManufactureMapper = $this->getServiceLocator()->get('Admin\Model\OrderManufactureMapper');
        $orderManufacturer = $orderManufactureMapper->get($orderManufacture);
        if(!$orderManufacturer) {
            return new JsonModel(array(
                'code' => 0,
                'messenger' => 'Không tìm thấy đơn hàng này'
            ));
        }
        if($orderManufacturer->getStatus() == \Admin\Model\OrderManufacture::FINISHED_PRODUCTION) {
            return new JsonModel(array(
                'code' => 0,
                'messenger' => 'Đơn hàng đã hoàn thành'
            ));
        }

        $orderManufacturer->setStatus(\Admin\Model\OrderManufacture::FINISHED_PRODUCTION);
        $orderManufacturer->setEndDateTime(DateBase::getCurrentDateTime());
        $orderManufactureMapper->save($orderManufacturer);

        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Đã sản xuất xong đơn hàng'
        ));
    }

    private function array_key_first(array $arr) {
        foreach($arr as $key => $unused) {
            return $key;
        }
        return NULL;
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






















