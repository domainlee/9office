<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
class OrderController extends AbstractActionController{

    const version = 2;
    const appId = 73193;
    const businessId = 109797;
    const accessToken = 'pV0IWWhXrpiM9SWgeGT8kClOaAF7caGiBCyZ4c2iIc2M9dvJLDv9NUTVI2RB4QP29zoQncLxQ4IZdTbYglchdOeBlKF0ovVR5P5TyJ52RHL55IGVPRgMMc6Ll0WHzRjE0kmQILxj2x3dLAuLY6AU13';
    const data = '{"page": "68"}';

    public function indexAction(){
		$this->layout('layout/admin');

//        $request = new Request();
//        $request->getHeaders()->addHeaders(array(
//            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8'
//        ));
//        $someurl = '';
//        $request->setUri($someurl);
//        $request->setMethod('POST');
//        $request->setPost(new Parameters(array('someparam' => $somevalue)));
//
//        $client = new Client();
//        $response = $client->dispatch($request);
//        $data = json_decode($response->getBody(), true);

        $curl = curl_init();
        $data = array(
            'version' => self::version,
            'appId' => self::appId,
            'businessId' => self::businessId,
            'accessToken' => self::accessToken
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

        print_r(json_decode($response, true));die;

        echo $response;



//		$model = new \Admin\Model\Order();
//        $mapper = $this->getServiceLocator()->get('Admin\Model\OrderMapper');
//        $model = $mapper->getId(166);
//        $model->setStatus(date("s"));
//        $mapper->save($model);
//        die;
//		$mapper = $this->getServiceLocator()->get('Admin\Model\OrderMapper');
//		$model->exchangeArray((array)$this->getRequest()->getQuery());
//		$page = (int)$this->getRequest()->getQuery()->page ?: 1;
//		$results = $mapper->search($model, array($page, 30));
		return new ViewModel(array(
			'pages'=>$page,
			'results'=>$results,
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



















