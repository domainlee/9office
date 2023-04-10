<?php
namespace Admin\Dg;

class DgProductMaterial extends \Base\Dg\Table {

    protected function init(){
        if(!empty($this->dataSet)):
        $headerArr = array(
            array(
                'label' => '',
                'style' => 'text-align: center;width: 5%'
            ),
            array(
                'label' => 'Mã sản phẩm',
                'style' => 'vertical-align: middle;'
            ),
            array(
                'label' => 'Tên sản phẩm vật liệu',
                'style' => 'vertical-align: middle;'
            ),
            array(
                'label' => 'Vật liệu',
                'style' => 'vertical-align: middle;'
            ),
            array(
                'label' => 'Ngày tạo',
                'style' => 'text-align: center;width: 15%'
            ),
            array(
                'label' => 'Xóa',
                'style' => 'text-align: center;width: 5%'
            )
        );
        $this->headers = $headerArr;
        $rows = array();

        function TrimTrailingZeroes($nbr) {
            return strpos($nbr,'.')!==false ? rtrim(rtrim($nbr,'0'),'.') : $nbr;
        }

        foreach ($this->dataSet as $item) {

            $productText = '';
            if(!empty($item->getOptions()['products'])) {
                $totalMoney = 0;
                foreach ($item->getOptions()['products'] as $v) {
                    $productText .= '<tr>
                                        <td>'.$v['material'].'</td>
                                        <td>'.TrimTrailingZeroes(number_format($v['price'], 2)).'</td>
                                        <td>'.$v['quantity'].'</td>
                                        <td>'.TrimTrailingZeroes(number_format($v['intoMoney'], 2)).'</td>
                                      </tr>';
                    $totalMoney += $v['intoMoney'];
                }
                $productText .= '<tr>
                                <td colspan="3"><strong>Tổng tiền:</strong> </td>
                                <td><strong class="text-pink">'.TrimTrailingZeroes(number_format($totalMoney, 2)).'</strong></td>
                            </tr>';
            }

            $rows[] = array(
                array (
                    'type' => 'text',
                    'value' => '<a title="'.$item->getName().'" href="'.$item->getImage().'" class="button-image"><img class="lazy thumb-md" data-src="'.$item->getImage().'" ></a>',
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => $item->getProductId(),
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array (
                    'type' => 'text',
                    'value' => '<a href="/admin/material/editproduct/'.$item->getId().($this->urlQuery ? '?'.$this->urlQuery:null).'">'. $item->getName().'</a></a>',
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array (
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
