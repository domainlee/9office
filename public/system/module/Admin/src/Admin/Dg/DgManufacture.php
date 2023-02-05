<?php
namespace Admin\Dg;

class DgManufacture extends \Base\Dg\Table {

    protected function init(){
        if(!empty($this->dataSet)):
        $headerArr = array(
            array(
                'label' => '',
                'style' => 'text-align: center;width: 5%;'
            ),
            array(
                'label' => 'Tên',
                'style' => 'vertical-align: middle;'
            ),
            array(
                'label' => 'Số điện thoại'
            ),
            array(
                'label' => 'Xem',
                'style' => 'text-align: center;width: 5%'
            ),
            array(
                'label' => 'Xóa',
                'style' => 'text-align: center;width: 5%'
            )
        );
        $this->headers = $headerArr;
        $rows = array();

        foreach ($this->dataSet as $item) {

            $rows[] = array(
                array (
                    'type' => 'text',
                    'class' => 'id',
                    'value' => '',
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array (
                    'type' => 'text',
                    'value' => '<a href="/admin/article/edit/'.$item->getId().($this->urlQuery ? '?'.$this->urlQuery:null).'">'. $item->getName().'</a></a>',
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => $item->getPhone(),
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => '',
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array(
                    'type' => 'action',
                    'value' => '<a class="cursor deleteArticle fa fa-trash-o" data-id="'.$item->getId().'"></a>',
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
            );
        }
        endif;
        $this->rows = $rows;
    }
}
