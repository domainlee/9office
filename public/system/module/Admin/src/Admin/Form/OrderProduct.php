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


class OrderProduct extends FormBase{

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

        $name = new Text('customerName');
        $this->add($name);

        $filter->add(array(
            'name' => 'customerName',
            'attributes' => array(
                'class' => 'tb',
                'id' => 'title',
            ),
            'required' => true,
            'filter' => array(array('name'=>'StringStrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Bạn chưa nhập tên'
                        )
                    )
                )
            )
        ));

        $phone = new Text('customerMobile');
        $this->add($phone);

        $filter->add(array(
            'name' => 'customerMobile',
            'attributes' => array(
                'class' => 'tb',
                'id' => 'title',
            ),
            'required' => true,
            'filter' => array(array('name'=>'StringStrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Bạn chưa nhập điện thoại'
                        )
                    )
                )
            )
        ));

        $address = new Textarea('customerAddress');
        $this->add($address);

        $filter->add(array(
            'name' => 'customerAddress',
            'attributes' => array(
                'class' => 'tb',
                'id' => 'title',
            ),
            'required' => true,
            'filter' => array(array('name'=>'StringStrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Bạn chưa nhập địa chỉ'
                        )
                    )
                )
            )
        ));

        $product = new Select('product');
        $this->add($product);

        $filter->add ( array (
            'name' => 'product',
            'class' => 'tb product',
            'attributes' => array (
                'id' => 'product'
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
                            'isEmpty' => 'Bạn chưa nhập sản phẩm'
                        )
                    )
                )
            )
        ) );

        $quality = new Text('quantity');
        $this->add($quality);

        $filter->add ( array (
            'name' => 'quantity',
            'class' => 'tb quantity',
            'attributes' => array (
                'id' => 'quantity'
            ),
            'required' => true,
            'filter' => array(array('name'=>'StringStrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Bạn chưa nhập số lượng'
                        )
                    )
                )
            )
        ) );

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Thêm đơn',
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

    public function setSize($arr){
        if(!!($element = $this->get('size'))){
            $element->setValueOptions($arr);
        }
    }

    public function setColor($arr){
        if(!!($element = $this->get('color'))){
            $element->setValueOptions($arr);
        }
    }

    public function setCategoryIds($array){
        if(!!($element = $this->get('categoryId'))){
            $element->setValueOptions(array(
                    ''=>'- Thể loại -'
                )+ $array);
        }
    }

    public function setParent($array){
        if(!!($element = $this->get('parentId'))){
            $element->setValueOptions(array(
                    ''=>'- Sản phẩm cha -'
                )+ $array);
        }
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

    public function setBrandId($arr){
        if(!!($element = $this->get('brandId'))){
            $element->setValueOptions(array(
                    ''=>'- Thương hiệu -'
                )+$arr);
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


    public function isValid($b = null)
    {
        $isVaild = parent::isValid();
            if($b == 2){
                if ($isVaild) {
                    $product = new \Admin\Model\Product();
                    $product->setTitle($this->get('title')->getValue());
                    $product->setCategoryId($this->get('categoryId')->getValue());
                    $mapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');
                    $r = $mapper->get($product);
                    if(count($r)){
                        $this->get('title')->setMessages(['Sản phẩm này đã tồn tại']);
                        $isVaild = false;
                    }
                    return $isVaild;
                }
            }
        return $isVaild;
    }
}
