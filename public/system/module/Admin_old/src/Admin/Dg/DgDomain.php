<?php
namespace Admin\Dg;
use Home\Model\DateBase;


class DgDomain extends \Base\Dg\Table{
	public function init(){
		$headerArr = array(
			array(
				'label' => 'ID',
                'style' => 'text-align: center;width: 5%;'
            ),
			array(
				'label' => 'Tên Miền chính'
			),
			array(
                'label' => 'Tên Miền hệ thống'
            ),
            array(
                'label' => 'Tên Store'
            ),
            array(
                'label' => 'Giao diện'
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
                        'value' => '<a href="/admin/store/editdomain/'.$item->getId().'">'.$item->getAlias().'</a>',
					),
					array (
                        'type' => 'text',
                        'class' => 'name',
                        'value' => '<a href="/admin/store/editdomain/'.$item->getId().'">'.$item->getName().'</a>',
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
//                        'value' => $item->getCreatedDateTime()
                        'value' => DateBase::toDisplayDateTime($item->getCreatedDateTime())
                    ),
                    array(
                        'type' => 'action',
                        'value' => '<a class="cursor deleteDomain fa fa-trash-o" data-id="'.$item->getId().'"></a>',
                        'htmlOptions'=> array('style'=>'text-align: center'),
                    ),
			);
		}
		$this->rows = $rows;
	}
}











