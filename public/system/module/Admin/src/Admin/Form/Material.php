<?php
namespace Admin\Form;
use Base\Form\ProvidesEventsForm;
use Zend\Form\Element;
use Zend\Form\Element\Text;
use Zend\Form\Element\Select;
use Zend\Form\Element\Textarea;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\File;
use Zend\Validator\InArray;
use Zend\Validator\IsInstanceOf;
use Zend\Form\Annotation\Validator;
use Zend\Validator\StringLength;


class Material extends ProvidesEventsForm{

	public function __construct($name=null){

		parent::__construct($name);

        $filter = $this->getInputFilter();

        $this->setAttribute('method', 'post');
		$this->setAttribute('class', 'f');
		$this->setAttribute ( 'enctype', 'multipart/form-data' );
		$this->setOptions(array(
			'decorator' => array(
				'type' => 'ul'
			)
		));

        $title = new Text('name');
        $this->add($title);

        $filter->add(array(
            'name' => 'name',
            'attributes' => array(
                'class' => 'tb',
                'id' => 'name',
            ),
            'required' => true,
            'options' => array(
                'label' => 'Tiêu đề:',
                'decorator' => array('type' => 'li'),
            ),
            'filter' => array(array('name'=>'StringStrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Bạn chưa nhập tiêu đề'
                        )
                    )
                )
            )
        ));


        $type = new Select('type');
        $this->add($type);
        $filter->add ( array (
            'name' => 'type',
            'class' => 'tb',
            'attributes' => array (
                'id' => 'type'
            ),
            'options' => array (
                'label' => 'Thể loại:',
                'value_options' => array (
                    '' => '- Thể loại -'
                ),
                'decorator' => array (
                    'type' => 'li'
                )
            ),
            'filter' => array(array('name'=>'StringStrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Bạn chưa chọn type'
                        )
                    )
                )
            )
        ) );

        $price = new Text('price');
        $this->add($price);

        $filter->add ( array (
            'name' => 'price',
            'required' => false,
            'filters' => array (
                array ('name' => 'Digits'),
                array ('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Giá trị phải là dạng số'
                        )
                    )
                ),
                array(
                    'name'    => 'StringLength',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            StringLength::INVALID => 'Giá trị phải là dạng số',
                        )
                    )
                ),

            ),
        ) );


        $totalPrice = new Text('totalPrice');
        $this->add($totalPrice);

        $filter->add ( array (
            'name' => 'totalPrice',
            'required' => false,
            'filters' => array (
                array ('name' => 'Digits'),
                array ('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Giá trị phải là dạng số'
                        )
                    )
                ),
                array(
                    'name'    => 'StringLength',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            StringLength::INVALID => 'Giá trị phải là dạng số',
                        )
                    )
                ),

            ),
        ) );

        $image = new Text('image');
        $this->add($image);

        $filter->add ( array (
            'name' => 'image',
            'required' => false,
            'filters' => array (
                array ('name' => 'StringTrim'),
            ),
        ) );

        $type = new Select('manufactureId');
        $this->add($type);
        $filter->add ( array (
            'name' => 'manufactureId',
            'class' => 'tb',
            'required' => false,
            'attributes' => array (
                'id' => 'type'
            ),
            'options' => array (
                'label' => 'Nhà cung cấp:',
                'value_options' => array (
                    '' => '- Nhà cung cấp -'
                ),
                'decorator' => array (
                    'type' => 'li'
                )
            ),
            'filter' => array(array('name'=>'StringStrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Bạn chưa chọn nhà cung cấp'
                        )
                    )
                )
            )
        ) );


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
						'value' => 'Hủy',
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

	public function setCategoryIds($array){
		if(!!($element = $this->get('type'))){
			$element->setValueOptions(array(
					''=>'- Đơn vị -'
			)+ $array);
		}
	}

    public function setNCC($array){
        if(!!($element = $this->get('manufactureId'))){
            $element->setValueOptions(array(
                    ''=>'- Nhà cung cấp -'
                )+ $array);
        }
    }

    public function getErrorMessagesList(){
        $errors = $this->getMessages();
        if(count($errors)){
            $result = [];
            foreach ($errors as $elementName => $elementErrors){
                foreach ($elementErrors as $errorMsg){
                    $result[] = $errorMsg;
                }
            }
            return $result;
        }
        return null;
    }
}








