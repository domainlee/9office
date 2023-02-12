<?php
namespace Admin\Dg;

class DgMaterial extends \Base\Dg\Table {

    protected function init(){
        if(!empty($this->dataSet)):
        $headerArr = array(
            array(
                'label' => 'Tên vật liệu',
                'style' => 'vertical-align: middle;'
            ),
            array(
                'label' => 'Kiểu',
                'style' => 'vertical-align: middle;'
            ),
            array(
                'label' => 'Đơn giá'
            ),
            array(
                'label' => 'Tồn kho - số lượng'
            ),
            array(
                'label' => 'Tồn kho - thành tiền'
            ),
            array(
                'label' => 'Nhà cung cấp'
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
                    'value' => '<a href="/admin/material/edit/'.$item->getId().($this->urlQuery ? '?'.$this->urlQuery:null).'">'. $item->getName().'</a></a>',
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => $item->type_form[$item->getType()],
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => number_format($item->getPrice()),
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => number_format($item->getTotalQuantiy()),
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => number_format($item->getTotalPrice()),
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => $item->getOptions()['ncc'],
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
