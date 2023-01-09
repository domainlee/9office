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


class Domain extends ProvidesEventsForm{

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

        $name = new Text('name');
        $this->add($name);

        $filter->add(array(
            'name' => 'name',
            'attributes' => array(
                'class' => 'tb',
                'id' => 'name',
            ),
            'required' => true,
            'options' => array(
                'decorator' => array('type' => 'li'),
            ),
            'filter' => array(array('name'=>'StringStrim')),
        ));

        $alias = new Text('alias');
        $this->add($alias);

        $filter->add(array(
            'name' => 'alias',
            'attributes' => array(
                'class' => 'tb',
                'id' => 'alias',
            ),
            'required' => false,
            'options' => array(
                'decorator' => array('type' => 'li'),
            ),
            'filter' => array(array('name'=>'StringStrim')),

        ));

        $uitemplateId = new Select('uitemplateId');
        $this->add($uitemplateId);

        $filter->add ( array (
            'name' => 'uitemplateId',
            'class' => 'tb uitemplateId',
            'attributes' => array (
                'id' => 'uitemplateId'
            ),
            'required' => true,
            'options' => array (
                'decorator' => array (
                    'type' => 'li'
                )
            ),
        ) );

        $storeId = new Select('storeId');
        $this->add($storeId);

        $filter->add ( array (
            'name' => 'storeId',
            'class' => 'tb storeId',
            'attributes' => array (
                'id' => 'storeId'
            ),
            'required' => true,
            'options' => array (
                'decorator' => array (
                    'type' => 'li'
                )
            ),
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

    public function setTemplate($arr){
        if(!!($element = $this->get('uitemplateId'))){
            if(!empty($arr)){
                $element->setValueOptions($arr);
            }
        }
    }

    public function setStore($arr){
        if(!!($element = $this->get('storeId'))){
            if(!empty($arr)){
                $element->setValueOptions($arr);
            }
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








