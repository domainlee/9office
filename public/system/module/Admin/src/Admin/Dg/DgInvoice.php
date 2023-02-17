<?php
namespace Admin\Dg;
use Home\Model\DateBase;

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
            $status = '';
            if($item->getStatus() == 2) {
                $status = '<span class="label label-danger" style="margin-bottom: 5px;display: inline-block">'.$item->statuses[$item->getStatus()] . '</span><br/><a data-id="'.$item->getId().'" class="btn-approved-invoice btn label btn-sm btn-default btn-rounded waves-effect waves-light">Duyệt</a>';
            } elseif ($item->getStatus() == 1) {
                $status = '<span class="label label-success" style="margin-bottom: 5px;display: inline-block">Đã duyệt</span><br/>'.DateBase::toDisplayDateTime($item->getUpdatedDateTime());
            }

            $rows[] = array(
                array(
                    'type' => 'text',
                    'value' => 'INV-'.$item->getId().' / '.$item->type_invoice[$item->getType()],
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array (
                    'type' => 'text',
                    'value' => '<a>'. $item->getDescription().'</a></a>',
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
                    'value' => $status,
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => DateBase::toDisplayDateTime($item->getCreatedDateTime()),
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
