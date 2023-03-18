<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Home\Model\DateBase;

class OrderController extends AbstractActionController{

    const version = 2;
    const appId = 73193;
    const businessId = 109797;
    const accessToken = 'pV0IWWhXrpiM9SWgeGT8kClOaAF7caGiBCyZ4c2iIc2M9dvJLDv9NUTVI2RB4QP29zoQncLxQ4IZdTbYglchdOeBlKF0ovVR5P5TyJ52RHL55IGVPRgMMc6Ll0WHzRjE0kmQILxj2x3dLAuLY6AU13';

    public function indexAction(){
		$this->layout('layout/admin');

		$query = $this->getRequest()->getUri()->getQuery();
        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $id = $this->getRequest()->getQuery()->id ? : '';
        $phone = $this->getRequest()->getQuery()->phone ? : '';
        $status_filter = $this->getRequest()->getQuery()->status ? : '';
        $startDate = $this->getRequest()->getQuery()->start ? : '';
        $endDate = $this->getRequest()->getQuery()->end ? : '';
        $startDate = DateBase::toCommonDateTwo($startDate);
        $endDate = DateBase::toCommonDateTwo($endDate);
        $query_request = $this->getRequest()->getQuery();

        $inProduction = array();
        if($status_filter == 'InProduction') {
            $status_filter = '';
            $orderManufacture = new \Admin\Model\OrderManufacture();
            $orderManufacture->setStatus(\Admin\Model\OrderManufacture::IN_PRODUCTION);
            $orderManufactureMapper = $this->getServiceLocator()->get('Admin\Model\OrderManufactureMapper');
            $inProduction = $orderManufactureMapper->fetchStatus($orderManufacture);
        }

        $finishedProduction = array();
        if($status_filter == 'FinishedProduction') {
            $status_filter = '';
            $orderManufacture = new \Admin\Model\OrderManufacture();
            $orderManufacture->setStatus(\Admin\Model\OrderManufacture::FINISHED_PRODUCTION);
            $orderManufactureMapper = $this->getServiceLocator()->get('Admin\Model\OrderManufactureMapper');
            $finishedProduction = $orderManufactureMapper->fetchStatus($orderManufacture);
        }

        $data = json_encode(array('id' => $inProduction || $finishedProduction ? array_merge($inProduction,$finishedProduction) : $id, 'customerMobile' => $phone, 'page' => $page, 'statuses' => array($status_filter), 'fromDate' => $startDate,'toDate' => $endDate));
        $curl = curl_init();

        $api = \Base\Model\Resource::data_api();

        $data = array(
            'version' => $api['version'],
            'appId' => $api['appId'],
            'businessId' => $api['businessId'],
            'accessToken' => $api['accessToken'],
            'data' => $data
        );


        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://open.nhanh.vn/api/order/index',
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
        $options['isAdmin'] = $this->user()->isSuperAdmin();
        $fFilter = new \Admin\Form\OrderSearch($options);

        $status = array(
            'New' => 'Đơn mới',
            'Confirming' => 'Đang xác nhận',
            'CustomerConfirming' => 'Chờ khách xác nhận',
            'Confirmed' => 'Đã xác nhận',
            'Packing' => 'Đang đóng gói',
            'InProduction' => 'Đang sản xuất',
            'FinishedProduction' => 'Đã sản xuất xong',
        );
        $status_filter = $this->getRequest()->getQuery()->status ? : '';
        $fFilter->setStatus($status, $status_filter);

        $productMaterialItem = new \Admin\Model\ProductMaterialItem();
        $mapperProductMaterialItem = $this->getServiceLocator()->get('Admin\Model\ProductMaterialItemMapper');
        $productMaterial = $mapperProductMaterialItem->fetchAll3($productMaterialItem);

        $orderManufacture = new \Admin\Model\OrderManufacture();
        $orderManufactureMapper = $this->getServiceLocator()->get('Admin\Model\OrderManufactureMapper');
        $orderProduction = $orderManufactureMapper->fetchAll($orderManufacture);

        return new ViewModel(array(
			'query'=> $query,
			'query_request'=> $query_request,
			'results'=> $response['data'],
			'fFilter'=> $fFilter,
            'id' => $id,
            'phone' => $phone,
            'product_material' => $productMaterial,
            'order_production' => $orderProduction
		));
	}
	public function addAction(){
		
	}
	public function editAction(){
		
	}
	public function deleteAction(){
		
	}
	public function changeStatusAction(){
		$this->layout('layout/admin');
		$request = $this->getRequest();
		$id = $this->getEvent()->getRouteMatch()->getParam('id');
		$value = $request->getPost('value');
		$mapper = $this->getServiceLocator()->get('Admin\Model\OrderMapper');
		$model = $mapper->getId($id);
		$model->setStatus($value);
		$mapper->save($model);
		if($model->getStatus()== \Admin\Model\Order::STATUS_COMPLATE){
// 			$modelOPro = new \Admin\Model\OrderProduct();
//  			$mapperOPro = $this->getServiceLocator()->get('Admin\Model\OrderProductMapper');
 			$modelPro = new \Admin\Model\Product();
// 			//$qtt = ((int)$modelPro->getQuantity() - $modelOPro->getQuantity());
			$model = new \Admin\Model\Order();
// 			$mapper = $this->getServiceLocator()->get('Admin\Model\OrderMapper');
 			$qtt = $model->getTotalMoney();
 			echo $qtt;
 			$modelPro->setQuantity($qtt);
// 			$modelOPro->setQuantity(10);
			$mapper->updateQtt($modelPro);
			
			return new JsonModel(array(
					'code'=>1
			));
		}
		return new JsonModel(array(
			'code'=>1
		));
		
	}

	public function update_order() {
        $mapper = $this->getServiceLocator()->get('Admin\Model\OrderMapper');
        $model = $mapper->getId(166);
        $model->setStatus('change');
        $mapper->save($model);

        echo "hello";
        echo "\r\n";
    }
}



















