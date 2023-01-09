<?php
namespace Admin\Dg;

class DgArticle extends \Base\Dg\Table {

    protected function init(){
        if(!empty($this->dataSet)):
        $headerArr = array(
            array(
                'label' => '',
                'style' => 'text-align: center;width: 5%;'
            ),
            array(
                'label' => 'Tiêu đề',
                'style' => 'vertical-align: middle;'
            ),
            array(
                'label' => 'Danh mục'
            ),
            array(
                'label' => 'Xem',
                'style' => 'text-align: center;width: 5%'
            ),
            array(
                'label' => 'Trạng thái',
                'style' => 'text-align: center;width: 8%'
            ),
            array(
                'label' => 'Xóa',
                'style' => 'text-align: center;width: 5%'
            )
        );
        $this->headers = $headerArr;
        $rows = array();

        foreach ($this->dataSet as $item) {
            $imageFirst = '';
            $i = json_decode($item->getImage(), true);
            if(is_array($i) && !empty($i)) {
                $imageFirst = array_shift($i);
            }


            $rows[] = array(
                array (
                    'type' => 'text',
                    'class' => 'id',
                    'value' => !empty($imageFirst) ? '<img data-src="'.$imageFirst.'" class="lazy img-circle thumb-sm" />':null,
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array (
                    'type' => 'text',
                    'value' => '<a href="/admin/article/edit/'.$item->getId().($this->urlQuery ? '?'.$this->urlQuery:null).'">'. $item->getTitle().'</a><a target="_blank" href="http://'.$_SERVER['HTTP_HOST'].$item->getViewLink().'" class="hide_ fa fa-eye"></a>',
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => $item->getCateName()? $item->getCateName() : '',
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => $item->getView()? $item->getView() : '',
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array (
                    'type' => 'link',
                    'value' => '<input class="changeArticleStatus" '.($item->getStatus() == 1 ? 'checked':null).' data-id="'.$item->getId().'" type="checkbox" data-plugin="switchery" data-color="#5fbeaa" data-size="small"/>',
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array(
                    'type' => 'action',
                    'value' => '<a class="cursor deleteArticle fa fa-trash-o" data-id="'.$item->getId().'"></a>',
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
            );
        }
        endif;
        $this->rows = $rows;
    }
}
