<?php
namespace Admin\Dg;

class DgTemplate extends \Base\Dg\Table{
	public function init(){
		$headerArr = array(
			array(
				'label' => 'ID',
                'style' => 'text-align: center;width: 5%;'
            ),
			array(
				'label' => 'Tên giao diện'
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
							'value' => '<a href="/admin/store/edittemplate/'.$item->getId().'">'.$item->getDirectory().'</a>',
					),
					array (
                        'htmlOptions'=> array('style'=>'width: 5%;text-align: center;vertical-align: middle;'),
                        'type' => 'text',
                        'class' => 'name',
                        'value' => '<a id="deleteTemplate" data-id="'.$item->getId().'" class="deleteTemplate fa fa-trash-o"></a>',
					),
			);
		}
		$this->rows = $rows;
	}
}











