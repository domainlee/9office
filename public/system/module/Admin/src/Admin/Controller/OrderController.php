<?php
namespace Admin\Controller;

use Base\XLSX\XLSXWriter;
use Base\XLSXImage\XLSWriterPlus;

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

    public function exportAction() {

        $selected_products = $this->getRequest()->getQuery()['ids'];
        $product_items = explode(',',$selected_products);

        if(empty($product_items)) {
            return false;
        }

        $data = json_encode(array('id' => $product_items ));
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
        $product_items = $response['data']['orders'];

        $file_name = 'Danh sách đơn hàng_'.date('ymd').'.xlsx';
        $sheet_product = 'Đơn hàng xuất ngày '.date('ymd');
        $header_one = array( 'Mã đơn hàng', 'Ngày', 'Tên', 'Sản phẩm');
        $styles_white = array('font'=>'Arial', 'font-style'=>'bold', 'fill'=>'#FFF', 'halign'=>'left', 'border'=>'left,right,top,bottom');
        $writer = new XLSWriterPlus();
        $writer->writeSheetRow($sheet_product, $header_one, $styles_white);

        foreach ($product_items as $pi) {
            $data = array($pi['id'], $pi['createdDateTime'], $pi['customerName'], );
            $writer->writeSheetRow($sheet_product, $data);
            $writer->addImage('https://global.discourse-cdn.com/envato/original/3X/2/e/2e64f5fae4319ad099d3d279915e90bbdb4da4d9.jpg', $pi['id'], [
                'startColNum' => 0,
                'startRowNum' => 0,
            ]);
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

	public function update_order() {
        $mapper = $this->getServiceLocator()->get('Admin\Model\OrderMapper');
        $model = $mapper->getId(166);
        $model->setStatus('change');
        $mapper->save($model);

        echo "hello";
        echo "\r\n";
    }
}



















