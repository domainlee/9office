<?php
namespace Admin\Dg;

class DgBanner extends \Base\Dg\Table{
	protected function init(){
		$headerArr = array(
			array(
				'label' => '',
                'style' => 'text-align: center;width: 5%;'
            ),
			array(
				'label' => 'Tên banner',
                'style' => 'vertical-align: middle;'
            ),
            array(
                'label' => 'Trạng thái',
                'style' => 'text-align: center;width: 10%'
            ),
			array(
				'label' => 'Xóa',
                'style' => 'text-align: center;width: 5%'
			)
		);
		$this->headers = $headerArr;
		$rows = array ();
		foreach ( $this->dataSet as $item ) {
            $imageFirst = '';
            $i = json_decode($item->getImage(), true);
            if(is_array($i) && !empty($i)) {
                $imageFirst = array_shift($i);
            }

			$rows [] = array (
                array (
                    'type' => 'text',
                    'class' => 'id',
                    'value' => !empty($imageFirst) ? '<img data-src="'.$imageFirst.'" class="lazy img-circle thumb-sm" />':null,
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array (
                    'type' => 'text',
                    'value' => '<a href="/admin/media/editbanner/'.$item->getId().'">'.$item->getName().'</a>',
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array (
                    'type' => 'link',
                    'value' => '<input class="changeBannerStatus" '.($item->getStatus() == 1 ? 'checked':null).' data-id="'.$item->getId().'" type="checkbox" data-plugin="switchery" data-color="#5fbeaa" data-size="small"/>',
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array (
                    'type' => 'action',
                    'htmlOptions'=>array('style'=>'text-align:center;vertical-align: middle'),
                    'value' => '<a class="cursor deleteBanner fa fa-trash-o" data-id="'.$item->getId().'"></a>',
                ),
			);
		}
		$this->rows = $rows;
	}
}














