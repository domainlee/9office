<?php
namespace Admin\Dg;
use Home\Model\DateBase;

class DgOrderSecond extends \Base\Dg\Table {

    protected function init(){
        if(!empty($this->dataSet)):
        $headerArr = array(
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
                'style' => 'text-align: center;width: 5%'
            )
        );
        $this->headers = $headerArr;
        $rows = array();
        foreach ($this->dataSet as $item) {
            $product = $item->getOptions()['products'];
            $productHtml = '';
            if(!empty($product)) {
                foreach ($product as $k) {
                    $url_created_product = '';
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

            $rows[] = array(
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
                    'type' => 'action',
                    'value' => '<a class="cursor deleteInvoice fa fa-trash-o" data-id=""></a>',
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
            );
        }
        endif;
        $this->rows = $rows;
    }
}
