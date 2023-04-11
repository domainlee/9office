<?php
namespace Admin\Form;

use Base\Form\ProvidesEventsForm;

class MaterialProductSearch extends ProvidesEventsForm{
    public function __construct($name = null) {
        parent::__construct ('ProductSearch');
        $this->setAttribute ( 'method', 'get' );
        $this->setAttribute ( 'class', 'fFilter' );
        $this->setOptions ( array (
            'decorator' => array (
                'type' => 'ul'
            )
        ) );

        $this->add ( array (
            'name' => 'productId',
            'attributes' => array (
                'type' => 'text',
                'class' => 'tb m-wrap medium',
                'id' => 'name',
                'placeholder' => 'Tiêu đề'
            ),
            'options' => array (
                'label' => '',
                'decorator' => array (
                    'type' => ''
                )
            )
        ) );

        $this->add ( array (
            'name' => 'name',
            'attributes' => array (
                'type' => 'text',
                'class' => 'tb m-wrap medium',
                'id' => 'name',
                'placeholder' => 'Tiêu đề'
            ),
            'options' => array (
                'label' => '',
                'decorator' => array (
                    'type' => ''
                )
            )
        ) );

        $this->add ( array (
            'name' => 'submit',
            'attributes' => array (
                'type' => 'submit',
                'value' => 'Tìm Kiếm',
                'class' => 'htmlBtn first btn btn-danger'
            ),
            'options' => array (
                'decorator' => array (
                    'type' => '',
                    'attributes' => array (
                        'class' => 'btns'
                    )
                )
            )
        ) );


        $this->getEventManager ()->trigger ( 'init', $this );
    }


    public function setStatus($array, $value){
        if(!!($element = $this->get('status'))){
            $element->setValueOptions(array(
                    ''=>'- Tất cả -'
                )+ $array);
            $element->setAttribute('value', $value);
        }
    }

}