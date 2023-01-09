<?php
namespace Admin\Dg;
use Home\Model\DateBase;


class DgOrder extends \Base\Dg\Table{
    protected function init(){
        $headerArr = array(
            array(
                'label' => 'Mã đơn hàng',
                'style' => 'text-align: center;width: 15%'
            ),
            array(
                'label' => 'Tên khách hàng'
            ),
            array(
                'label' => 'Số điện thoại',
                'style' => 'width: 20%'
            ),
            array(
                'label' => 'Thời gian',
                'style' => 'text-align: center;width: 13%'
            ),
            array(
                'label' => 'Trạng thái',
                'style' => 'text-align: center;width: 10%'
            ),
            array(
                'label' => 'Xóa',
                'style' => 'text-align: center;width: 5%'
            )
        );
        $this->headers = $headerArr;
        $rows = array();
        foreach ($this->dataSet as $item){
            $rows[] = array(
                array (
                    'type' => 'text',
                    'class' => 'id',
                    'value' => '<a href="/admin/product/orderview/'.$item->getId().'">'.$item->getOrderId().'</a>',
                    'htmlOptions'=> array('style'=>'text-align: center'),
                ),
                array (
                    'type' => 'display',
                    'value' => '<a href="/admin/product/orderview/'.$item->getId().'">'.$item->getCustomerName().'</a>',
                ),
                array(
                    'type' => 'text',
                    'value' => '<a href="/admin/product/orderview/'.$item->getId().'">'.$item->getCustomerMobile().'</a>',
                ),
                array(
                    'type' => 'display',
                    'value' => DateBase::toFormat($item->getCreatedDateTime(),'H:i d/m/Y') ,
                    'htmlOptions'=> array('style'=>'text-align: center'),
                ),
                array(
                    'type' => 'display',
                    'value' => $item->getShippingType() == 1 ? '<span class="label label-table label-primary">Mới</span>':'<span class="label label-table label-success">Đã xử lý</span>',
                    'htmlOptions'=> array('style'=>'text-align: center'),
                ),
                array(
                    'htmlOptions'=> array('style'=>'text-align: center'),
                    'type' => 'display',
                    'value' => '<a data-id="'.$item->getId().'" class="deleteOrder fa fa-trash-o"></a>',
                ),
            );
        }
//        die;
        $this->rows = $rows;
    }
}
