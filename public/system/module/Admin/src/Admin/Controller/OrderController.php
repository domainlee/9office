<?php
namespace Admin\Controller;

use Base\XLSX\XLSXWriter;
use Base\XLSXImage\XLSWriterPlus;
use \Datetime;
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
        $now = new DateTime();
        $nowOrder = $now->format('Y-m-d');

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

//        print_r($finishedProduction);die;

        $data = json_encode(array('depotId' => 110912, 'id' => $inProduction || $finishedProduction ? array_merge($inProduction,$finishedProduction) : $id, 'customerMobile' => $phone, 'page' => $page, 'statuses' => array($status_filter), 'fromDate' => $startDate,'toDate' => $endDate));


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

        // inProduction
        $orderManufacture = new \Admin\Model\OrderManufacture();
        $orderManufacture->setStatus(\Admin\Model\OrderManufacture::IN_PRODUCTION);
        $orderManufactureMapper = $this->getServiceLocator()->get('Admin\Model\OrderManufactureMapper');
        $inProductionD = $orderManufactureMapper->fetchStatus($orderManufacture);
        $production_data = json_encode(array('depotId' => 110912, 'id' => $inProductionD ));
        $production_curl = curl_init();
        $api = \Base\Model\Resource::data_api();
        $productiondata = array(
            'version' => $api['version'],
            'appId' => $api['appId'],
            'businessId' => $api['businessId'],
            'accessToken' => $api['accessToken'],
            'data' => $production_data
        );
        curl_setopt_array($production_curl, array(
            CURLOPT_URL => 'https://open.nhanh.vn/api/order/index',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $productiondata,
        ));
        $production_response = curl_exec($production_curl);
        $production_response = json_decode($production_response, true);
        curl_close($production_curl);

        // Finished
        $orderManufacture = new \Admin\Model\OrderManufacture();
        $orderManufacture->setStatus(\Admin\Model\OrderManufacture::FINISHED_PRODUCTION);
        $orderManufactureMapper = $this->getServiceLocator()->get('Admin\Model\OrderManufactureMapper');
        $finishedProductionD = $orderManufactureMapper->fetchStatus($orderManufacture);
        $finished_data = json_encode(array('depotId' => 110912, 'id' => $finishedProductionD ));
        $finished_curl = curl_init();
        $api = \Base\Model\Resource::data_api();
        $finisheddata = array(
            'version' => $api['version'],
            'appId' => $api['appId'],
            'businessId' => $api['businessId'],
            'accessToken' => $api['accessToken'],
            'data' => $finished_data
        );
        curl_setopt_array($finished_curl, array(
            CURLOPT_URL => 'https://open.nhanh.vn/api/order/index',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $finisheddata,
        ));
        $finished_response = curl_exec($finished_curl);
        $finished_response = json_decode($finished_response, true);
        curl_close($finished_curl);

        // Order today

        $order_now_data = json_encode(array('depotId' => 110912, 'fromDate' => $nowOrder,'toDate' => $nowOrder ));
        $order_now_curl = curl_init();
        $api = \Base\Model\Resource::data_api();
        $ordernow_data = array(
            'version' => $api['version'],
            'appId' => $api['appId'],
            'businessId' => $api['businessId'],
            'accessToken' => $api['accessToken'],
            'data' => $order_now_data
        );
        curl_setopt_array($order_now_curl, array(
            CURLOPT_URL => 'https://open.nhanh.vn/api/order/index',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $ordernow_data,
        ));
        $order_now_response = curl_exec($order_now_curl);
        $order_now_response = json_decode($order_now_response, true);
        curl_close($order_now_curl);


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

        $is_print = $this->getRequest()->getPost()['print'];
        $export = $this->getRequest()->getQuery()['export'];
        if($is_print || $export) {
            $this->layout('layout/null');
            $view = new ViewModel();
            $totalPage = $response['data']['totalPages'];
            $order_items = array();
            $order_export = array();
            for($c = 1; $c <= $totalPage; $c++) {
                $data = json_encode(array('id' => $inProduction || $finishedProduction ? array_merge($inProduction,$finishedProduction) : $id, 'customerMobile' => $phone, 'page' => $c, 'statuses' => array($status_filter), 'fromDate' => $startDate,'toDate' => $endDate));
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
//                $order_items[] = $response['data']['orders'];
                if(!empty($response['data']['orders'])) {
                    foreach ($response['data']['orders'] as $v) {
                        $order_items[$v['id']] = $v;
                        $product = '';
                        $cc = 0;
                        foreach ($v['products'] as $vv) {
                            $order_export[] = array($v['id'], $v['customerName'], $vv['productImage'],$vv['productCode'], $vv['productName'], $vv['quantity'], $v['createdDateTime'], $v['statusName']);
                        }
                    }
                }
            }
            if($export) {
                $this->template_excel($order_export);
            } else {
                //Đổi template
                $view->setTemplate('admin/order/export');
                $view->setVariables(array(
                    'product_order' => $order_items,
                ));
                return $view;
            }
        }
        return new ViewModel(array(
			'query'=> $query,
			'query_request'=> $query_request,
			'results'=> $response['data'],
			'production' => $production_response['data']['totalRecords'],
			'finished' => $finished_response['data']['totalRecords'],
			'order_now' => $order_now_response['data']['totalRecords'],
			'fFilter'=> $fFilter,
            'id' => $id,
            'phone' => $phone,
            'product_material' => $productMaterial,
            'order_production' => $orderProduction
		));
	}

    public function exportAction() {
        $this->layout('layout/null');
//        $selected_products = $this->getRequest()->getPost()['print'];
//        $product_items = explode(',',$selected_products);
//
//        if(empty($product_items)) {
//            return false;
//        }

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
        print_r($this->getRequest()->getQuery());die;

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

        print_r($response);die;

        $product_items = $response['data']['orders'];

        return new ViewModel(array(
            'product_order' => $product_items,
        ));

//        $file_name = 'Danh sách đơn hàng_'.date('ymd').'.xlsx';
//        $sheet_product = 'Đơn hàng xuất ngày '.date('ymd');
//        $header_one = array( 'Mã đơn hàng', 'Ngày', 'Tên', 'Sản phẩm');
//        $styles_white = array('font'=>'Arial', 'font-style'=>'bold', 'fill'=>'#FFF', 'halign'=>'left', 'border'=>'left,right,top,bottom');
//        $writer = new XLSWriterPlus();
//        $writer->writeSheetRow($sheet_product, $header_one, $styles_white);
//
//        foreach ($product_items as $pi) {
//            $data = array($pi['id'], $pi['createdDateTime'], $pi['customerName'], );
//            $writer->writeSheetRow($sheet_product, $data);
//            $writer->addImage('https://global.discourse-cdn.com/envato/original/3X/2/e/2e64f5fae4319ad099d3d279915e90bbdb4da4d9.jpg', $pi['id'], [
//                'startColNum' => 0,
//                'startRowNum' => 0,
//            ]);
//        }
//        $writer->writeToFile($file_name);
//        header('Content-Description: File Transfer');
//        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
//        header("Content-Disposition: attachment; filename=" . basename($file_name));
//        header("Content-Transfer-Encoding: binary");
//        header("Expires: 0");
//        header("Pragma: public");
//        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//        header('Content-Length: ' . filesize($file_name));
//        ob_clean();
//        flush();
//        readfile($file_name);
//        unlink($file_name);
//        exit;
    }

	public function update_order() {
        $mapper = $this->getServiceLocator()->get('Admin\Model\OrderMapper');
        $model = $mapper->getId(166);
        $model->setStatus('change');
        $mapper->save($model);

        echo "hello";
        echo "\r\n";
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
        $file_name = 'Danh sách đơn hàng_'.date('ymd').'.xlsx';
        $sheet_product = 'Order '.date('ymd');
        $header_one = array( 'Mã đơn hàng', 'Khách hàng', 'Hình ảnh','Mã sản phẩm','Tên sản phẩm','Số lượng', 'Ngày', 'Trạng thái');
        $styles_white = array('font'=>'Arial', 'font-style'=>'bold', 'fill'=>'#FFF', 'halign'=>'left', 'border'=>'left,right,top,bottom');
        $writer = new XLSXWriter();
        $writer->writeSheetRow($sheet_product, $header_one, $styles_white);
        $printedSeasons = [];

        foreach ($product_items as $pi) {
            $sku = $pi[0];
            if(!in_array($sku, $printedSeasons)) {
                $printedSeasons[] = $sku;
            } else {
                $pi[0] = ' ';
                $pi[1] = ' ';
            }
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


}



















