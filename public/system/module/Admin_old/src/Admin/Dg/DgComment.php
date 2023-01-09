<?php
namespace Admin\Dg;
use Home\Model\DateBase;

class DgComment extends \Base\Dg\Table {

    protected function init(){
        if(!empty($this->dataSet)):
        $headerArr = array(
            array(
                'label' => 'Tài khoản',
                'style' => 'text-align: center;vertical-align: middle;width: 5%;'
            ),
            array(
                'label' => 'Nội dung bình luận',
                'style' => 'vertical-align: middle;width: 20%;'
            ),
            array(
                'label' => 'Bài viết',
                'style' => 'width: 20%'
            ),
            array(
                'label' => 'Thể loại',
                'style' => 'width: 5%;text-align: center;'
            ),
            array(
                'label' => 'Thời gian',
                'style' => 'text-align: center;width: 10%'
            ),
            array(
                'label' => 'Trạng thái',
                'style' => 'text-align: center;width: 5%'
            ),
            array(
                'label' => 'Xóa',
                'style' => 'text-align: center;width: 3%'
            )
        );
        $this->headers = $headerArr;
        $rows = array();


        foreach ($this->dataSet as $item) {
            $title = '';
            $s = substr($item->getContent(),0,50);
            $rs = substr($s,0,strrpos($s, ' '));
            if(strlen($item->getContent()) > 50):
                $title = $rs.' ...';
            else:
                $title = $item->getContent();
            endif;

            $content = json_decode($item->getExtraContent(), true);

            $rows[] = array(
                array (
                    'type' => 'text',
                    'value' => '<span class="comment__user img-circle thumb-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$content['name'].'">'.(isset($content['name']) ? $content['name'][0]:'').'</span>',
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle;'),
                ),
                array (
                    'type' => 'text',
                    'value' => '<span tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="" data-content="'.$item->getContent().'" data-original-title="Bình luận">'.$title.'</span>',
                    'htmlOptions' => array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => '<a target="_blank" href="'.$content['postUrl'].'">'.(isset($content['postName']) ? $content['postName']:'').'</a>',
                    'htmlOptions'=> array('style' => 'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => $item->getType() == 1 ? 'Sản phẩm':'Tin tức',
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => DateBase::time_elapsed_string($item->getCreatedDateTime()),
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array (
                    'type' => 'link',
                    'value' => '<input class="changeCommentStatus" '.($item->getStatus() == 1 ? 'checked':null).' data-id="'.$item->getId().'" type="checkbox" data-plugin="switchery" data-color="#5fbeaa" data-size="small"/>',
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array(
                    'type' => 'action',
                    'value' => '<a class="cursor deleteComment fa fa-trash-o" data-id="'.$item->getId().'"></a>',
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
            );
        }
        endif;
        $this->rows = $rows;
    }
}
