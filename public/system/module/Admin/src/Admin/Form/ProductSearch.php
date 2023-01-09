<?php
namespace Admin\Form;

use Base\Form\ProvidesEventsForm;

class ProductSearch extends ProvidesEventsForm{

	public function __construct($name = null) {
		parent::__construct ('ProductSearch');
		$this->setAttribute ( 'method', 'get' );
		$this->setAttribute ( 'class', 'form-inline' );
		$this->setOptions ( array (
				'decorator' => array (
						'type' => ''
				)
		) );
		$this->add ( array (
				'name' => 'id',
				'attributes' => array (
						'type' => 'text',
						'class' => 'tb m-wrap medium',
						'id' => 'id',
						'placeholder' => 'Id'
				),
				'options' => array (
						'label' => '',
						'decorator' => array (
								'type' => ''
						)
				)
		) );

        $this->add ( array (
            'name' => 'categoryId',
            'type' => 'select',
            'attributes' => array (
                'id' => 'categoryId',
                'style' => 'margin: 0 5px 0 0',
                'class' => 'tb m-wrap medium',
            ),
            'options' => array (
                'value_options' => array (
                    '' => '- Danh mục -'
                ),
                'decorator' => array (
                    'type' => ''
                )
            )
        ) );

		$this->add ( array (
				'name' => 'title',
				'attributes' => array (
						'type' => 'text',
						'class' => 'tb m-wrap medium',
						'id' => 'name',
						'placeholder' => 'Tên sản phẩm'
				),
				'options' => array (
						'label' => '',
						'decorator' => array (
								'type' => ''
						)
				)
		) );
        if (isset($name['isAdmin']) && $name['isAdmin']){
            $this->add ( array (
				'name' => 'storeId',
				'type' => 'select',
				'attributes' => array (
                    'id' => 'storeId',
                    'style' => 'margin: 0 5px 0 0',
                    'class' => 'tb m-wrap medium',
                ),
				'options' => array (
						'value_options' => array (
								'' => '- Doanh nghiệp -'
						),
						'decorator' => array (
								'type' => ''
						)
				)
		    ) );
        }
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

	public function setStoreIds($arr){
		if(!!$element = $this->get('storeId')){
			$element->setValueOptions(array(
					''=>'- Doanh nghiệp -'
			)+$arr);
		}
	}

    public function setCategoryIds($array){
        if(!!($element = $this->get('categoryId'))){
            $element->setValueOptions(array(
                    ''=>'- Danh mục -'
                )+ $array);
        }
    }

}