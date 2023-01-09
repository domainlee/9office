<?php
namespace Admin\Dg;

class DgBrand extends \Base\Dg\Table{

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
                        'htmlOptions'=> array('style' => 'text-align:center;'),
                    ),
					array(
						'type'=>'text',
						'class'=>'name',
						'value'=> '<a href="/admin/product/editbrand/'.$item->getId().'">'.$item->getName().'</a>',
					),
					array(
						'type' => 'link',
                        'value' => '<input class="changeBrandStatus" '.($item->getStatus() == 1 ? 'checked':null).' data-id="'.$item->getId().'" type="checkbox" data-plugin="switchery" data-color="#5fbeaa" data-size="small"/>',
                        'htmlOptions'=> array('style' => 'text-align:center;'),
                    ),
					array(
						'type' => 'action',
						'value' => '<a style="cursor: pointer;" class="deleteBrand fa fa-trash-o" data-id="'.$item->getId().'"></a>',
                        'htmlOptions'=> array('style' => 'text-align:center;'),
                    ),

				);
			}
			$this->rows = $rows;
	}
}































