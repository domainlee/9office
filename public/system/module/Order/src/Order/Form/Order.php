<?php
namespace Order\Form;
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


class Order extends FormBase{

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

        $customerName = new Text('customerName');
        $this->add($customerName);

        $filter->add(array(
            'name' => 'customerName',
            'attributes' => array(
                'class' => 'tb',
                'id' => 'title',
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


        $mobile1 = new Text ( 'customerMobile' );
        $this->add($mobile1);
        $filter->add ( array (
            'name' => 'customerMobile',
            'required' => true,
            'filters' => array (
                array ('name' => 'Digits')
            ),
            'validators' => array (
                array (
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array (
                        'messages' => array (
                            'isEmpty' => 'Số điện thoại phải là số'
                        )
                    )
                ),
                array (
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array (
                        'messages' => array (
                            'isEmpty' => 'Bạn chưa nhập số di động'
                        )
                    )
                ),
            )
        ) );

        $email = new Text('customerEmail');
        $this->add ($email);
        $filter->add(array(
            'name' => 'customerEmail',
            'required' => true,
            'filters' => array(
                array ('name' => 'StringTrim'),
                array('name' => 'Base\Filter\HTMLPurifier'),
            ),
            'validators' => array (
                array (
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array (
                        'messages' => array (
                            'isEmpty' => 'Bạn chưa nhập email'
                        )
                    )
                ),
                array(
                    'name'    => 'EmailAddress',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'emailAddressInvalidFormat' => 'Địa chỉ email không hợp lệ'
                        )
                    )
                ),
            )
        ));



        $customerAddress = new Textarea('customerAddress');
        $this->add($customerAddress);

        $filter->add(array(
            'name' => 'customerAddress',
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



//    public function isValid($b = null)
//    {
//        $isVaild = parent::isValid();
//            if($b == 2){
//                if ($isVaild) {
//                    $product = new \Admin\Model\Product();
//                    $product->setTitle($this->get('title')->getValue());
//                    $product->setCategoryId($this->get('categoryId')->getValue());
//                    $mapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');
//                    $r = $mapper->get($product);
//                    if(count($r)){
//                        $this->get('title')->setMessages(['Sản phẩm này đã tồn tại']);
//                        $isVaild = false;
//                    }
//                    return $isVaild;
//                }
//            }
//        return $isVaild;
//    }
}
