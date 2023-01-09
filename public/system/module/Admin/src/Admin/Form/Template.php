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
use Zend\Validator\StringLength;
use Base\Form\FormBase;

class Template extends FormBase{

	public function __construct($sl, $name=null){

		parent::__construct($name);

        $this->setServiceLocator($sl);


        $filter = $this->getInputFilter();

        $this->setAttribute('method', 'post');
		$this->setAttribute('class', 'f');
		$this->setAttribute ( 'enctype', 'multipart/form-data' );
		$this->setOptions(array(
			'decorator' => array(
				'type' => 'ul'
			)
		));

        $directory = new Text('directory');
        $this->add($directory);

        $filter->add(array(
            'name' => 'directory',
            'attributes' => array(
                'class' => 'tb',
                'id' => 'directory',
            ),
            'required' => true,
            'options' => array(
                'decorator' => array('type' => 'li'),
            ),
            'filter' => array(array('name'=>'StringStrim')),

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

//        $this->getEventManager()->trigger('init', $this);
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

    public function isValid($b = null)
    {
        $isVaild = parent::isValid();
        if($b == 2){
            if ($isVaild) {
                $template = new \Admin\Model\Template();
                $template->setDirectory($this->get('directory')->getValue());
                $mapper = $this->getServiceLocator()->get('Admin\Model\TemplateMapper');
                $r = $mapper->get($template);
                if(!empty($r)){
                    $this->get('directory')->setMessages(['Giao diện này đã tồn tại.']);
                    $isVaild = false;
                }
                return $isVaild;
            }
        }
        return $isVaild;
    }
}








