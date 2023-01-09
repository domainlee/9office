<?php
namespace Admin\Form;
use Base\Form\ProvidesEventsForm;
use Zend\Form\Element\Checkbox;
use Zend\Form\Element\Text;
use Zend\Form\Element\Url;
use Zend\Form\Element\Select;
use Zend\Form\Element\Textarea;
use Zend\Form\Element\Password;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\File;
use Zend\Validator\InArray;
use Zend\Validator\IsInstanceOf;
use Zend\Form\Annotation\Validator;
use Zend\Validator\StringLength;
use Base\Form\FormBase;


class OptionPopup extends FormBase{

    public function __construct($sl, $name = null){

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

//        $scriptHead = new Textarea('scriptHead');
//        $this->add($scriptHead);
//        $filter->add(array(
//            'name' => 'scriptHead',
//            'required' => false,
//            'filter' => array(array('name'=>'StringStrim')),
//        ));
//
//        $scriptBody = new Textarea('scriptBody');
//        $this->add($scriptBody);
//        $filter->add(array(
//            'name' => 'scriptBody',
//            'required' => false,
//            'filter' => array(array('name'=>'StringStrim')),
//        ));
//
//        $scriptFooter = new Textarea('scriptFooter');
//        $this->add($scriptFooter);
//        $filter->add(array(
//            'name' => 'scriptFooter',
//            'required' => false,
//            'filter' => array(array('name'=>'StringStrim')),
//        ));
        $popupSize = new Checkbox('popup_size');
        $this->add($popupSize);
        $filter->add(array(
            'name' => 'popup_size',
            'required' => false,
            'filter' => array(array('name'=>'StringStrim')),
        ));

        $popupDisplay = new Checkbox('popup_display');
        $this->add($popupDisplay);
        $filter->add(array(
            'name' => 'popup_display',
            'required' => false,
            'filter' => array(array('name'=>'StringStrim')),
        ));

        $popupSetup = new Checkbox('popup_setup');
        $this->add($popupSetup);
        $filter->add(array(
            'name' => 'popup_setup',
            'required' => false,
            'filter' => array(array('name'=>'StringStrim')),
        ));

        $popupVideo = new Text('popup_url');
        $this->add($popupVideo);
        $filter->add(array(
            'name' => 'popup_url',
            'required' => false,
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

    }

//    public function setTemplate($arr){
//        if(!!($element = $this->get('uitemplateId'))){
//            if(!empty($arr)){
//                $element->setValueOptions($arr);
//            }
//        }
//    }

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
        return $isVaild;
    }

}
