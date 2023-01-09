<?php
namespace Admin\Dg;

class DgReportSale extends \Base\Dg\Table{

	protected function init(){
		$headerArr = array(
            array(
                'label' => 'ID',
                'style' => 'text-align: center;width: 5%;'
            ),
			array(
                'label' => 'Tên sản phẩm'
            ),
            array(
                'label' => 'Giá'
            ),
            array(
                'label' => 'Đặt hàng'
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
                        'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                    ),
                    array(
                        'type' => 'text',
                        'value' => $item->getProductName(),
                    ),
                    array(
                        'type' => 'text',
                        'value' => number_format($item->getProductPrice()).' đ',
                    ),
                    array(
                        'type' => 'text',
                        'value' => $item->getQuantityTotal(),
                    ),
				);
			}
			$this->rows = $rows;
	}
}































