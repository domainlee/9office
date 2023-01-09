<?php
namespace Admin\Form;
use Base\Form\ProvidesEventsForm;
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


class Option extends FormBase{

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



        $facebook = new Text('facebook');
        $this->add($facebook);
        $filter->add(array(
            'name' => 'facebook',
            'required' => false,
            'filter' => array(array('name'=>'StringStrim')),
        ));

        $google = new Text('google');
        $this->add($google);
        $filter->add(array(
            'name' => 'google',
            'required' => false,
            'filter' => array(array('name'=>'StringStrim')),
        ));

        $youtube = new Text('youtube');
        $this->add($youtube);
        $filter->add(array(
            'name' => 'youtube',
            'required' => false,
            'filter' => array(array('name'=>'StringStrim')),
        ));

        $twitter = new Text('twitter');
        $this->add($twitter);
        $filter->add(array(
            'name' => 'twitter',
            'required' => false,
            'filter' => array(array('name'=>'StringStrim')),
        ));

        $googleAna = new Text('GoogleAnalyticsId');
        $this->add($googleAna);
        $filter->add(array(
            'name' => 'GoogleAnalyticsId',
            'required' => false,
            'filter' => array(array('name'=>'StringStrim')),
        ));

//        $facebookId = new Text('facebookAppId');
//        $this->add($facebookId);
//        $filter->add(array(
//            'name' => 'facebookAppId',
//            'required' => false,
//            'filter' => array(array('name'=>'StringStrim')),
//        ));

//        $domain = new Url('domain');
//        $this->add($domain);
//        $filter->add(array(
//            'name' => 'domain',
//            'required' => false,
//            'filter' => array(array('name'=>'StringStrim')),
//        ));

        $sologan = new Text('sologan');
        $this->add($sologan);
        $filter->add(array(
            'name' => 'sologan',
            'required' => false,
            'filter' => array(array('name'=>'StringStrim')),
        ));

        $metaTitle = new Text('metaTitle');
        $this->add($metaTitle);
        $filter->add(array(
            'name' => 'metaTitle',
            'required' => false,
            'filter' => array(array('name' => 'StringStrim')),
        ));

        $metaKeyword = new Text('metaKeyword');
        $this->add($metaKeyword);
        $filter->add(array(
            'name' => 'metaKeyword',
            'required' => false,
            'filter' => array(array('name'=>'StringStrim')),
        ));

        $metaDescription = new Textarea('metaDescription');
        $this->add($metaDescription);
        $filter->add(array(
            'name' => 'metaDescription',
            'required' => false,
            'filter' => array(array('name' => 'StringStrim')),
        ));

//        $uitemplateId = new Select('uitemplateId');
//        $this->add($uitemplateId);

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
//
//        $styleFooter = new Textarea('styleFooter');
//        $this->add($styleFooter);
//        $filter->add(array(
//            'name' => 'styleFooter',
//            'required' => false,
//            'filter' => array(array('name'=>'StringStrim')),
//        ));

//        $filter->add ( array (
//            'name' => 'uitemplateId',
//            'class' => 'tb uitemplateId',
//            'attributes' => array (
//                'id' => 'uitemplateId'
//            ),
//            'required' => true,
//            'options' => array (
//                'decorator' => array (
//                    'type' => 'li'
//                )
//            ),
//        ) );



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
