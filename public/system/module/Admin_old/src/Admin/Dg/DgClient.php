<?php
namespace Admin\Dg;

class DgClient extends \Base\Dg\Table{

	protected function init(){
		$headerArr = array(
            array(
                'label' => 'ID',
                'style' => 'text-align: center;width: 5%;'
            ),
			array(
				'label' => 'Tên khách hàng'
			),
            array(
                'label' => 'Số điện thoại'
            ),
			array(
                'label' => 'Trạng thái',
                'style' => 'text-align:center;width: 8%'
            ),
			array(
                'label' => 'Xóa',
                'style' => 'text-align:center;width: 5%'
			)
		);
		$this->headers = $headerArr;
		    $rows = array();
			foreach ($this->dataSet as $item){
				$rows[] = array(
					array(
						'type'=>'text',
						'class'=>'id',
						'value'=> $item->getId(),
                        'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                    ),
                    array(
                        'type' => 'text',
                        'value' => $item->getName(),
                    ),
                    array(
                        'type' => 'text',
                        'value' => $item->getPhone(),
                    ),
					array(
						'type' => 'link',
                        'value' => '<input class="changecStatus" type="checkbox" data-plugin="switchery" data-color="#5fbeaa" data-size="small"/>',
                        'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                    ),
					array(
						'type' => 'action',
						'value' => '<a style="cursor: pointer;" class="deleteCategory fa fa-trash-o" data-id="'.$item->getId().'"></a>',
                        'htmlOptions'=> array('style' => 'text-align:center;'),
                    ),

				);
			}
			$this->rows = $rows;
	}
}































