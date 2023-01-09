<?php
namespace Home\Form;
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


class ContactPhone extends FormBase{

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

        $phone = new Text ( 'phone' );
        $this->add($phone);
        $filter->add ( array (
            'name' => 'phone',
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
            )
        ) );

        $name = new Text ( 'name' );
        $this->add($name);
        $filter->add ( array (
            'name' => 'name',
            'required' => false,
        ) );
//
        $content = new Textarea ( 'content' );
        $this->add($content);
        $filter->add ( array (
            'name' => 'content',
            'required' => false,
        ) );

        $email = new Text('email');
        $this->add ($email);
        $filter->add(array(
            'name' => 'email',
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
