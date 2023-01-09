<?php
namespace Admin\Dg;
use Home\Model\DateBase;


class DgWebsite extends \Base\Dg\Table{
	public function init(){
		$headerArr = array(
			array(
				'label' => 'ID',
                'style' => 'text-align: center;width: 5%;'
            ),
			array(
				'label' => 'Quản lý'
			),
            array(
                'label' => 'Tên đăng nhập'
            ),
            array(
                'label' => 'Mã giao diện'
            ),
            array(
                'label' => 'Ngày tạo'
            ),
            array(
                'label' => 'Xoá',
                'style' => 'text-align: center;width: 5%;'
            ),
				
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
                        'class' => 'parentId',
                        'value' => '<a href="http://'.$item->getName().'/admin" target="_blank">'.$item->getName().'</a>',
					),
                    array (
                        'type' => 'text',
                        'class' => 'name',
                        'value' => $item->getStoreName()
                    ),
                    array (
                        'type' => 'text',
                        'class' => 'name',
                        'value' => $item->getUiName()
                    ),
                    array (
                        'type' => 'text',
                        'class' => 'name',
                        'value' => DateBase::toDisplayDateTime($item->getCreatedDateTime())
                    ),
                    array(
                        'type' => 'action',
                        'value' => '<a class="cursor deleteWebsite fa fa-trash-o" data-id="'.$item->getId().'"></a>',
                        'htmlOptions'=> array('style'=>'text-align: center'),
                    ),
			);
		}
		$this->rows = $rows;
	}
}











