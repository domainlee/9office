<?php
namespace Admin\Dg;

class DgUser extends \Base\Dg\Table{
    protected function init(){
        $headerArr = array(
            array(
                'label' => 'ID',
                'style' => 'text-align: center;width: 5%;'
            ),
            array(
                'label' => 'Tên tài khoản'
            ),
            array(
                'label' => 'Email'
            ),
            array(
                'label' => 'SĐT'
            ),
            array(
                'label' => 'Doanh nghiệp'
            ),
            array(
                'label' => 'Quyền'
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
            $role = '';
            if($item->getRole() == 1) {
                $role = 'Supper Admin';
            } elseif ($item->getRole() == 2) {
                $role = 'Quản lý';
            } elseif ($item->getRole() == 3) {
                $role = 'Thành viên';
            }
            $rows[] = array(
                array (
                    'type' => 'text',
                    'class' => 'id',
                    'value' => $item->getId(),
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array (
                    'type' => 'text',
                    'value' => '<a href="/admin/user/edit/'.$item->getId().'">'. $item->getUsername().'</a>',
                ),
                array (
                    'type' => 'text',
                    'value' => '<a href="/admin/user/edit/'.$item->getId().'">'. $item->getEmail().'</a>',
                ),
                array (
                    'type' => 'text',
                    'value' => $item->getMobile(),
                ),
                array (
                    'type' => 'text',
                    'value' => $item->getStoreName(),
                ),
                array (
                    'type' => 'text',
                    'value' => $role,
                ),
                array (
                    'type' => 'link',
                    'value' => '<input class="changeUserStatus" '.($item->getActive() == 1 ? 'checked':null).' data-id="'.$item->getId().'" type="checkbox" data-plugin="switchery" data-color="#5fbeaa" data-size="small"/>',
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array(
                    'type' => 'action',
                    'value' => '<a class="cursor deleteUser fa fa-trash-o" data-id="'.$item->getId().'"></a>',
                    'htmlOptions'=> array('style'=>'text-align: center'),
                ),
            );
        }
        $this->rows = $rows;
    }
}
