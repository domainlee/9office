<?php
namespace Admin\Dg;

class DgStore extends \Base\Dg\Table{
	public function init(){
		$headerArr = array(
			array(
				'label' => 'ID',
                'style' => 'text-align: center;width: 5%;'
            ),
            array(
                'label' => 'Tên Store'
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
							'class' => 'name',
							'value' => '<a href="/admin/store/edit/'.$item->getId().'">'.$item->getName().'</a>'
					),
                    array(
                        'type' => 'action',
                        'value' => '<a class="cursor deleteStore fa fa-trash-o" data-id="'.$item->getId().'"></a>',
                        'htmlOptions'=> array('style'=>'text-align: center'),
                    ),
			);
		}
		$this->rows = $rows;
	}
}











