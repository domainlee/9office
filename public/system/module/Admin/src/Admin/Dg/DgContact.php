<?php
namespace Admin\Dg;
use Home\Model\DateBase;

class DgContact extends \Base\Dg\Table{
    protected function init(){
        $headerArr = array(
            array(
                'label' => 'ID',
                'style' => 'text-align: center;width: 5%;'
            ),
            array(
                'label' => 'Tên'
            ),
            array(
                'label' => 'SĐT'
            ),
            array(
                'label' => 'Email'
            ),
            array(
                'label' => 'Ngày'
            ),
//            array(
//                'label' => 'Nội dung'
//            ),
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
                    'value' => $item->getId(),
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array (
                    'type' => 'text',
                    'value' => '<a href="/admin/user/contact/'.$item->getId().'">'. $item->getName().'</a>',
                ),
                array (
                    'type' => 'text',
                    'value' => '<a href="/admin/user/contact/'.$item->getId().'">'. $item->getPhone().'</a>',
                ),
                array (
                    'type' => 'text',
                    'value' => '<a href="/admin/user/contact/'.$item->getId().'">'. $item->getEmail().'</a>',
                ),
                array (
                    'type' => 'text',
                    'value' => DateBase::toDisplayDateTime($item->getCreatedDateTime()),
                ),
//                array (
//                    'type' => 'text',
//                    'value' => $item->getContent(),
//                ),
                array(
                    'type' => 'action',
                    'value' => '<a class="cursor fa fa-trash-o" data-id="'.$item->getId().'"></a>',
                    'htmlOptions'=> array('style'=>'text-align: center'),
                ),
            );
        }
        $this->rows = $rows;
    }
}
