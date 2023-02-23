<?php
namespace Admin\Dg;

class DgProductMaterial extends \Base\Dg\Table {

    protected function init(){
        if(!empty($this->dataSet)):
        $headerArr = array(
            array(
                'label' => '',
                'style' => 'text-align: center;width: 5%'
            ),
            array(
                'label' => 'Product ID',
                'style' => 'vertical-align: middle;'
            ),
            array(
                'label' => 'Tên sản phẩm vật liệu',
                'style' => 'vertical-align: middle;'
            ),
            array(
                'label' => 'Ngày tạo',
                'style' => 'text-align: center;width: 15%'
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
                    'value' => '<img class="lazy thumb-md" data-src="'.$item->getImage().'" >',
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => $item->getProductId(),
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array (
                    'type' => 'text',
                    'value' => '<a href="/admin/material/edit/'.$item->getId().($this->urlQuery ? '?'.$this->urlQuery:null).'">'. $item->getName().'</a></a>',
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => $item->getCreatedDateTime(),
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
