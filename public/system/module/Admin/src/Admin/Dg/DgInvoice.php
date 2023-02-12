<?php
namespace Admin\Dg;

class DgInvoice extends \Base\Dg\Table {

    protected function init(){
        if(!empty($this->dataSet)):
        $headerArr = array(
            array(
                'label' => 'Mã hoá đơn',
                'style' => 'vertical-align: middle;width: 8%'
            ),
            array(
                'label' => 'Tên hoá đơn',
                'style' => 'vertical-align: middle;'
            ),
            array(
                'label' => 'Sản phẩm nhập',
                'style' => 'width: 40%'
            ),
            array(
                'label' => 'Trạng thái',
                'style' => 'text-align: center;width: 15%'
            ),
            array(
                'label' => 'Ngày tạo',
                'style' => 'text-align: center;width: 12%'
            ),
            array(
                'label' => 'Xóa',
                'style' => 'text-align: center;width: 5%'
            )
        );
        $this->headers = $headerArr;
        $rows = array();

        foreach ($this->dataSet as $item) {
            $product = $item->getOptions()['products'];
            $productText = '';
            if(!empty($item->getOptions()['products'])) {
                foreach ($item->getOptions()['products'] as $v) {
                    $productText .= '<tr>
                                        <td>'.$v['material'].'</td>
                                        <td>'.number_format($v['price']).'</td>
                                        <td>'.$v['quantity'].'</td>
                                        <td>'.number_format($v['intoMoney']).'</td>
                                      </tr>';
                }
            }
            $rows[] = array(
                array(
                    'type' => 'text',
                    'value' => 'INV-'.$item->getId(),
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array (
                    'type' => 'text',
                    'value' => '<a href="/admin/invoice/edit/'.$item->getId().($this->urlQuery ? '?'.$this->urlQuery:null).'">'. $item->getDescription().'</a></a>',
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => '<table style="margin: 0 !important;" class="mr-0 dg table table-hover table-condensed">
                                  <tr>
                                    <th>Vật liệu</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                  </tr>'.$productText.'</table>',
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => 'Chờ duyệt',
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => $item->getCreatedDateTime(),
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
