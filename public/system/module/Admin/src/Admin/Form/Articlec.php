<?php
namespace Admin\Form;
use Base\Form\ProvidesEventsForm;

class Articlec extends ProvidesEventsForm{

	const ERROR_INVALID = "Tên bài viết không hợp lệ";

	public function showInvalidMessage($error = self::ERROR_INVALID) {
		$this->get ( 'name' )->setMessages ( array (
				$error
		) );
	}
	public function __construct($name=null){

		parent::__construct($name);

		$this->setAttribute('method', 'post');
		$this->setAttribute('class', 'f');
		$this->setAttribute ( 'enctype', 'multipart/form-data' );
		$this->setOptions(array(
			'decorator'=>array(
				'type'=>'ul'
			)
		));
		$this->add(array(
			'name' => 'id',
			'attributes' => array(
				'type' => 'hidden',
				'id' => 'id'
			)
		));
		$this->add(array(
			'name' => 'parentId',
			'type' => '\Base\Form\OptionalSelect',
			'attributes' => array(
				'id' => 'parentId',
			),
            'options' => array(
                'label' => 'Thể loại cha:',
            	'empty_option' => '- Thể loại cha -',
            	'decorator' => array(
            		'type' => 'li'
            	),
            ),
		));
		$this->add(array(
				'name' => 'name',
				'attributes' => array(
						'type'  => 'text',
						'class' => 'tb',
						'id' => 'name',
				),
				'options' => array(
						'label' => 'Tên thể loại:',
						'decorator' => array('type' => 'li'),
						'required' => true,
				),
		));
		$this->add(array(
				'name' => 'description',
				'attributes' => array(
						'type'  => 'textarea',
						'class' => 'tb ckeditor',
						'id' => 'textarea_full',
						"rows" => "5",
						"cols" => "30",
				),
				'options' => array(
						'label' => 'Mô tả:',
						'decorator' => array('type' => 'li'),
						'required' => true,
				),
		));

        $this->add(array(
            'name' => 'images',
            'attributes' => array(
                'type'  => 'hidden',
            ),
            'options' => array(
                'required' => false,
            ),
        ));

        $this->add(array(
            'name' => 'metaTitle',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'required' => false,
            ),
        ));

        $this->add(array(
            'name' => 'metaKeyword',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'required' => false,
            ),
        ));

        $this->add(array(
            'name' => 'metaDescription',
            'attributes' => array(
                'type'  => 'textarea',
            ),
            'options' => array(
                'required' => false,
            ),
        ));

        $this->add(array(
            'name' => 'url',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'required' => false,
            ),
        ));



		$this->add(array(
				'name' => 'submit',
				'attributes' => array(
						'type'  => 'submit',
						'value' => 'Lưu',
						'id' => 'btnSubmit',
						'class' => 'htmlBtn first btn btn-danger'
				),
				'options' => array(
						'label' => ' ',
						'decorator' => array(
								'type' => 'li',
								'attributes' => array(
										'class' => 'btns'
								)
						)
				),
		));

		$this->add(array(
				'name' => 'reset',
				'attributes' => array(
						'type'  => 'reset',
						'value' => 'Huỷ',
						'id' => 'btnReset',
						'class' => 'btn btn-danger'
				),
				'options' => array(
						'label' => ' ',
						'decorator' => array(
								'type' => 'li',
								'attributes' => array(
										'class' => 'btns'
								)
						)
				),
		));
		
		$this->getEventManager()->trigger('init', $this);
		}

		public function setParentIds($array)
		{
			if(!!($element = $this->get('parentId'))) {
				$element->setValueOptions(array('' => '- Thể loại cha -') + $array);
			}
		}
}