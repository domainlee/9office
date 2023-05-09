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
                'label' => 'Danh sách vật liệu',
                'style' => 'vertical-align: middle;'
            ),
            array(
                'label' => 'Số lượng',
                'style' => 'vertical-align: middle;'
            ),
            array(
                'label' => 'Thành tiền',
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
                $totalRowMoney = 0;
                $totalProduct = 0;
                $totalQuantity = 0;
                $named = '';
                $stt = 1;
                foreach ($item->getOptions()['products'] as $v) {
                    $totalProduct++;
                    $productText .= '<tr>
                                        <td>'.$v['material'].'</td>
                                        <td>'.TrimTrailingZeroes(number_format($v['price'], 2)).'</td>
                                        <td>'.$v['quantity'].'</td>
                                        <td>'.TrimTrailingZeroes(number_format($v['intoMoney'], 2)).'</td>
                                      </tr>';
                    $totalMoney += $v['intoMoney'];
                    $totalQuantity += $v['quantity'];
                    $named .= $stt++.'. '.$v['material'].' - SL: '.$v['quantity']. ' - Tiền '. TrimTrailingZeroes(number_format($v['price'], 2)) .'<br/>';

                }
                $totalRowMoney = TrimTrailingZeroes(number_format($totalMoney, 2));
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
                    'value' => '<span data-toggle="tooltip" data-html="true" data-placement="bottom" title="" data-original-title="'.$named.'">'.$totalProduct.'</span>',
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array (
                    'type' => 'text',
                    'value' => $totalQuantity,
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array (
                    'type' => 'text',
                    'value' => '<strong class="text-pink">'.$totalRowMoney.'</strong>',
                    'htmlOptions'=> array('style'=>'vertical-align: middle'),
                ),
                array(
                    'type' => 'text',
                    'value' => $item->getCreatedDateTime(),
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
                array(
                    'type' => 'action',
                    'value' => '<a class="cursor deleteProductMaterial fa fa-trash-o" data-id="'.$item->getId().'"></a>',
                    'htmlOptions'=> array('style'=>'text-align: center;vertical-align: middle'),
                ),
            );
        }
        endif;
        $this->rows = $rows;
    }
}
