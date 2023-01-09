<?php
namespace Admin\Form;
use Base\Form\ProvidesEventsForm;
use Zend\Form\Element\Text;
use Zend\Form\Element\Select;
use Zend\Form\Element\Textarea;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\File;
use Zend\Validator\InArray;
use Zend\Validator\IsInstanceOf;
use Zend\Form\Annotation\Validator;


class Question extends ProvidesEventsForm{

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

        $title = new Text('title');
        $title->setLabel('Tiêu đề:');
        $this->add($title);

        $filter->add(array(
            'name' => 'title',
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

        $content = new Textarea('content');
        $this->add($content);

        $filter->add(array(
            'name' => 'content',
            'attributes' => array(
                'class' => 'tb ckeditor',
                'id' => 'textarea_full',
                "rows" => "10",
                "cols" => "30",
            ),
            'required' => true,
            'options' => array(
                'label' => 'Nội dung:',
                'decorator' => array('type' => 'li'),
            ),
            'filter' => array(array('name'=>'StringStrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Bạn chưa nhập nội dung'
                        )
                    )
                )
            )
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








