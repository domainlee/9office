<?php
namespace Admin\Dg;

class DgPage extends \Base\Dg\Table{
    protected function init(){
        $headerArr = array(
            array(
                'label' => 'ID',
                'style' => 'width: 3%'
            ),
            array(
                'label' => 'Tiêu đề'
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
        foreach ($this->dataSet as $item){
            $rows[] = array(
                array (
                    'type' => 'text',
                    'class' => 'id',
                    'value' => $item->getId()
                ),
                array (
                    'type' => 'text',
                    'value' => '<a href="/admin/page/edit/'.$item->getId().'">'. $item->getName().'</a><a target="_blank" href="http://'.$_SERVER['HTTP_HOST'].$item->getViewLink().'" class="hide_ fa fa-eye"></a>',
                ),
                array(
                    'type' => 'link',
                    'value' => '<input class="changePageStatus" '.($item->getStatus() == 1 ? 'checked':null).' data-id="'.$item->getId().'" type="checkbox" data-plugin="switchery" data-color="#5fbeaa" data-size="small"/>',
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array(
                    'type' => 'action',
                    'value' => '<a class="cursor deletePage fa fa-trash-o" data-id="'.$item->getId().'"></a>',
                    'htmlOptions'=> array('style'=>'text-align: center'),
                ),
            );
        }
        $this->rows = $rows;
    }
}
