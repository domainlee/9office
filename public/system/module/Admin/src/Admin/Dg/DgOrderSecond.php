<?php
namespace Admin\Dg;
use Home\Model\DateBase;

class DgOrderSecond extends \Base\Dg\Table {

    protected function init(){
        if(!empty($this->dataSet)):
        $headerArr = array(
            array(
                'label' => '',
                'style' => 'vertical-align: middle;width: 2%'
            ),
            array(
                'label' => 'Mã đơn hàng',
                'style' => 'vertical-align: middle;width: 8%'
            ),
            array(
                'label' => 'Ngày',
                'style' => 'vertical-align: middle;width: 10%'
            ),
            array(
                'label' => 'Tên',
                'style' => 'width: 10%'
            ),
            array(
                'label' => 'Sản phẩm',
                'style' => 'width: 40%'
            ),
            array(
                'label' => 'Trạng thái',
                'style' => 'text-align: center;width: 12%'
            ),
            array(
                'label' => 'Hành động',
                'style' => 'text-align: center;width: 10%'
            )
        );
        $this->headers = $headerArr;
        $rows = array();
        $product_material = $this->material;
        $order_production = $this->order_production;
//        print_r($order_production);die;
        $btn  = '';
        foreach ($this->dataSet as $item) {
            $product = $item->getOptions()['products'];
            $productHtml = '';
            $quantity = 0;
            $is_facture = true;
            $btn_bool = false;
            $btn_dsx = false;
            $btn_sxx = false;
            if(!empty($product)) {
                foreach ($product as $k) {
                    if(isset($order_production[$item->getOrderId().'_'.$k->getProductCode()])) {
                        $btn_bool = true;
                        if($order_production[$item->getOrderId().'_'.$k->getProductCode()]['status'] == \Admin\Model\OrderManufacture::IN_PRODUCTION) {
                            $btn_dsx = true;
                        }
                        if($order_production[$item->getOrderId().'_'.$k->getProductCode()]['status'] == \Admin\Model\OrderManufacture::FINISHED_PRODUCTION) {
                            $btn_dsx = false;
                            $btn_sxx = true;
                        }
                    }
                    $quantity = $k->getQuantity();
                    $url_created_product = '';
                    $stock = ($k->getStock() ? $k->getStock():0);
                    if(isset($product_material[$k->getProductCode()])) {
                        $btn_bool = false;
                        $named = '';
                        $c = 0;
                        $products = array();
                        foreach ($product_material[$k->getProductCode()] as $kpi => $pi) {
                            $c++;
                            $named .= $c.'. '.$pi['materialName'].' - SL: '.$pi['quantity'] .'<br/>';
                            $products[] = array(
                                'materialId' => $pi['materialId'],
                                'quantity' => $pi['quantity']*$k->getQuantity()
                            );
                        }

                        if($approved === 'false') {
                            $approved = false;
                        } else {
                            $approved = true;
                        }
                        if($stock < 1) {
//                            $is_facture = false;
                            $materials[$k->getOrderId()][$k->getProductCode()] = $products;
                            $approved = true;
                        }
                        $is_facture = true;
                        if($stock > 0) {
//                            $is_facture = false;
                        }
                        $url_created_product = '<span class="label label-success" data-toggle="tooltip" data-html="true" data-placement="top" title="" data-original-title="'.$named.'">Vật liệu sử dụng</span>';
                    } else {
                        $is_facture = false;
                        $approved = 'false';
                        $approved_is = false;
                        $url_created_product = '<a class="label label-danger" href="'.'/admin/material/addproduct?id='.$k->getProductCode().'&img='.$k->getProductImage().'&name='.$k->getProductName().'" target="_blank">Tạo vật liệu</a>';
                    }
                    $productHtml .= '
                    <div class="" style="display: flex">
                        <div>
                            <a title="'.'Đơn hàng ID-'. $k->getOrderId().' - '.$k->getProductCode().'" href="'.$k->getProductImage().'" class="button-image"><img style="margin: 0 10px 0 0" class="thumb-md rounded-circle lazy" data-src="'.$k->getProductImage().'" /></a>
                        </div>
                        <div>
                            <strong>'.$k->getProductCode().' x '.$k->getQuantity().'</strong> - '.$url_created_product.' - Tồn kho: <strong>'.($k->getStock() ? $k->getStock():0).'</strong>
                            <p>'.$k->getProductName().'</p>
                        </div>
                    </div>';
                }
            }
            if($btn_bool) {
                if($btn_dsx) {
                    $btn = '<span class="label label-warning m-b-5 d-block">Đang sản xuất</span>
                            <p class="text-muted m-t-5 m-b-5 font-13">Ngày bắt đầu: '.DateBase::toDisplayDateTime($order_production[$item->getOrderId().'_'.$item->getProductCode()]['startDateTime']).'</p>
                            <a data-order="'.$item->getOrderId().'" data-code="'.$item->getProductCode().'" class="btn-in-finished btn label btn-sm btn-default btn-rounded waves-effect waves-light">Hoàn thành</a>';
                }
                if($btn_sxx) {
                    $btn = '<p class="text-muted m-t-5 m-b-5 font-13">Ngày bắt đầu: '.DateBase::toDisplayDateTime($order_production[$item->getOrderId().'_'.$item->getProductCode()]['startDateTime']).'</p>
                            <span class="label label-success m-b-5 d-block">Đã xong</span>
                            <p class="text-muted m-t-5 m-b-5 font-13">Ngày kết thúc: '.DateBase::toDisplayDateTime($order_production[$item->getOrderId().'_'.$item->getProductCode()]['endDateTime']).'</p>';
                }
            } else {
                $btn = ($is_facture ? '<a data-order="'.$item->getOrderId().'_" data-code="'.$item->getProductCode().'" data-quantity="'.$quantity.'" href="" class="btn-in-process btn label btn-sm btn-default btn-rounded waves-effect waves-light">Sản xuất</a>':'');
            }

            $rows[] = array(
                array(
                    'type' => 'text',
                    'value' => '<div class="checkbox"><input type="checkbox" '.($is_facture ? '':'disabled').' name="productId" data-label="Đơn hàng, '.$item->getOrderId().'Mã Sản phẩm '.$item->getProductCode().',Số lượng '.$quantity.'" value="'.$item->getOrderId().'_'.$item->getProductCode().'_'.$quantity.'"><label></label></div>',
                    'htmlOptions'=> array('style' => 'vertical-align: middle;'),
                ),
                array(
                    'type' => 'text',
                    'value' => $item->getOrderId(),
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array (
                    'type' => 'text',
                    'value' => $item->getCreatedDateTime(),
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => $item->getCustomerName(),
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => $productHtml,
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => $item->getStatusName(),
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => $btn,
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
            );
        }
        endif;
        $this->rows = $rows;
    }
}
