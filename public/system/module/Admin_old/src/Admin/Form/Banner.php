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


class Banner extends FormBase{

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

        $title = new Text('name');
        $title->setLabel('Tiêu đề:');
        $this->add($title);

        $filter->add(array(
            'name' => 'name',
            'attributes' => array(
                'class' => 'tb',
                'id' => 'name',
            ),
            'required' => true,
            'options' => array(
                'label' => 'Tiêu:',
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

        $description = new Textarea('description');
        $description->setLabel('Tóm tắt:');
        $this->add($description);

        $filter->add(array(
            'name' => 'description',
            'attributes' => array(
                'class' => 'tb ckeditor',
                'id' => 'textarea_full1',
            ),
            'required' => false,
            'options' => array(
                'label' => 'Tóm tắt:',
                'decorator' => array('type' => 'li'),
            ),
            'filter' => array(array('name'=>'StringStrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Bạn chưa nhập tóm tắt'
                        )
                    )
                )
            )
        ));

        $link = new Text('link');
        $link->setLabel('Link:');
        $this->add($link);

        $filter->add(array(
            'name' => 'link',
            'attributes' => array(
                'class' => 'tb',
                'id' => 'link',
            ),
            'required' => false,
            'options' => array(
                'label' => 'Link:',
                'decorator' => array('type' => 'li'),
            ),
        ));

        $type1 = new Hidden('images');
        $this->add($type1);
        $filter->add(array(
            'name' => 'images',
            'required' => false
        ));


        $productRelated = new Select('productRelated');
        $this->add($productRelated);

        $filter->add ( array (
            'name' => 'productRelated',
            'class' => 'tb productRelated',
            'attributes' => array (
                'id' => 'productRelated'
            ),
            'required' => false,
            'options' => array (
                'value_options' => array (
                    '' => '- Sản phẩm liên quan -'
                ),
                'decorator' => array (
                    'type' => 'li'
                )
            ),
        ) );

        $articleRelated = new Select('articleRelated');
        $this->add($articleRelated);

        $filter->add ( array (
            'name' => 'articleRelated',
            'class' => 'tb articleRelated',
            'attributes' => array (
                'id' => 'articleRelated'
            ),
            'required' => false,
            'options' => array (
                'value_options' => array (
                    '' => '- Bài viết liên quan -'
                ),
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

    }


    public function setProductRelated($arr){
        if(!!($element = $this->get('productRelated'))){
            if(!empty($arr)){
                $element->setValueOptions($arr);
            }
        }
    }

    public function setArticleRelated($arr){
        if(!!($element = $this->get('articleRelated'))){
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
