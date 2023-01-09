<?php

namespace Admin\Dg;

//use ZendX\DataGrid\DataGrid;
//use ZendX\DataGrid\Row;
//use ZendX\DataGrid\DataGrid;
//use ZendX\DataGrid\Row;
use Home\Form;

//class DgAttr extends DataGrid{
//    public function init()
//    {
//        $this->addHeader([
//            'attributes' => array(),
//            'options' => array(),
//            'columns' => array(
//                array(
//                    'name' => 'id',
//                    'content' => 'ID',
//                ),
//                array(
//                    'name' => 'name',
//                    'content' => 'Tên',
//                ),
//                array(
//                    'name' => 'colorCode',
//                    'content' => 'Mã màu',
//                ),
//                array(
//                    'name' => 'type',
//                    'content' => 'Kiểu',
//                ),
//            )
//        ]);
//        if(!$this->getDataSource() instanceof \Zend\Paginator\Paginator || !$this->getDataSource()->getCurrentModels()) {
//            return;
//        }
//        foreach($this->getDataSource()->getCurrentModels() as $item) {
//            $row = new Row();
//            $this->addRow($row);
//            $row->addColumn(array(
//                'name' 			=> 'id',
//                'content' 		=> $item->getId(),
//            ));
//            $row->addColumn(array(
//                'name' 			=> 'name',
//                'content' 		=> $item->getName(),
//            ));
//            $row->addColumn(array(
//                'name' 			=> 'colorCode',
//                'content' 		=> $item->getColorCode().'<span style="display: inline-block;width: 10px;height: 10px;float: right;background:'.$item->getColorCode().'"></span>',
//            ));
//            $row->addColumn(array(
//                'name' 			=> 'type',
//                'content' 		=> '',
//            ));
//        }
//
//    }
//}


class DgAttr extends \Base\Dg\Table{

    protected function init(){
        $headerArr = array(
            array(
                'label' => 'ID',
                'style' => 'text-align: center;width: 5%;'
            ),
            array(
                'label' => 'Nhóm'
            ),
            array(
                'label' => 'Tên'
            ),
            array(
                'label' => 'Màu sắc',
            ),
            array(
                'label' => 'Xoá',
                'style' => 'text-align: center;width: 8%'
            ),
        );
        $this->headers = $headerArr;
        $rows = array();
        foreach ($this->dataSet as $item){
            $rows[] = array(
                array(
                    'type'=>'text',
                    'class'=>'id',
                    'value'=> $item->getId(),
                    'htmlOptions'=> array('style' => 'text-align:center;'),
                ),
                array(
                    'type'=>'text',
                    'class'=>'id',
                    'value'=> $item->getMaterial()[$item->getType()],
                ),
                array(
                    'type'=>'text',
                    'class'=>'name',
                    'value'=> '<a>'.$item->getName().'</a>',
                ),
                array(
                    'type' 	=> 'text',
                    'value' 		=> $item->getColorCode().'<span style="display: inline-block;width: 10px;height: 10px;float: right;background:'.$item->getColorCode().'"></span>',
                    'htmlOptions'=> array('style'=>'color: #F7f7f7;text-shadow: 1px 1px #999;background: '.$item->getColorCode()),
                ),
                array(
                    'type' 			=> 'text',
                    'value' => '<a id="deleteAttr" data-id="'.$item->getId().'" class="deleteAttr fa fa-trash-o"></a>',
                    'htmlOptions'=> array('style'=>'text-align: center;'),
                )
            );
        }
        $this->rows = $rows;
    }
}