<?php
namespace Admin\Dg;

class DgProductc extends \Base\Dg\Table{

	protected function init(){
		$headerArr = array(
            array(
                'label' => 'ID',
                'style' => 'text-align: center;width: 5%;'
            ),
			array(
				'label' => 'Danh mục'
			),
            array(
                'label' => 'Danh mục cha',
                'style' => 'text-align:center;width: 15%'
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
						'type'=>'text',
						'class'=>'name',
						'value'=> '<a href="/admin/product/editcategory/'.$item->getId().'">'.$item->getName().'</a><a target="_blank" href="http://'.$_SERVER['HTTP_HOST'].$item->getViewLink().'" class="hide_ fa fa-eye"></a>',
					),
                    array(
                        'type' => 'text',
                        'value' => $item->getParent()? $item->getParent()->getName() : '',
                    ),
					array(
						'type' => 'link',
                        'value' => '<input class="changecStatus" '.($item->getStatus() == 1 ? 'checked':null).' data-id="'.$item->getId().'" type="checkbox" data-plugin="switchery" data-color="#5fbeaa" data-size="small"/>',
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































