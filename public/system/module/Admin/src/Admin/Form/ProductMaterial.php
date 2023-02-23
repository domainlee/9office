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
use Base\Form\FormBase;


class ProductMaterial extends FormBase{

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

        $price = new Text('price');
        $this->add($price);

        $filter->add ( array (
            'name' => 'price',
            "type" => "Zend\\InputFilter\\ArrayInput",
            'required' => false,
            'filters' => array (
                array ('name' => 'Digits'),
                array ('name' => 'StringTrim'),
            ),
        ) );

        $quantity = new Text('quantity');
        $this->add($quantity);

        $filter->add ( array (
            'name' => 'quantity',
            "type" => "Zend\\InputFilter\\ArrayInput",
            'required' => false,
            'filters' => array (
                array ('name' => 'Digits'),
                array ('name' => 'StringTrim'),
            ),
        ) );

        $intoMoney = new Text('intoMoney');
        $this->add($intoMoney);

        $filter->add ( array (
            'name' => 'intoMoney',
            'required' => false,
            "type" => "Zend\\InputFilter\\ArrayInput",
            'filters' => array (
                array ('name' => 'Digits'),
                array ('name' => 'StringTrim'),
            ),
//            'validators' => array(
//                array(
//                    'name' => 'NotEmpty',
//                    'break_chain_on_failure' => true,
//                    'options' => array(
//                        'messages' => array(
//                            'isEmpty' => 'Bạn chưa nhập giá trị'
//                        )
//                    )
//                ),
//                array(
//                    'name'    => 'StringLength',
//                    'break_chain_on_failure' => true,
//                    'options' => array(
//                        'messages' => array(
//                            StringLength::INVALID => 'Giá trị phải là dạng số',
//                        )
//                    )
//                ),
//
//            ),
        ) );

        $name = new Text('name');
        $this->add($name);

        $filter->add(array(
            'name' => 'name',
            'attributes' => array(
                'class' => 'tb ',
            ),
            'required' => false,
            'options' => array(
                'label' => 'Tóm tắt:',
                'decorator' => array('type' => 'li'),
            ),
            'filter' => array(array('name'=>'StringStrim')),
        ));

        $productId = new Text('productId');
        $this->add($productId);

        $filter->add(array(
            'name' => 'productId',
            'attributes' => array(
                'class' => 'tb ',
            ),
            'required' => false,
            'options' => array(
                'label' => 'Tóm tắt:',
                'decorator' => array('type' => 'li'),
            ),
            'filter' => array(array('name'=>'StringStrim')),
        ));


        $materialId = new Select('materialId');
        $this->add($materialId);

        $filter->add ( array (
            'name' => 'materialId',
            'class' => 'tb productRelated',
            'attributes' => array (
                'id' => 'productRelated'
            ),
            'required' => false,
            'options' => array (
                'value_options' => array (
                    '' => '- Vật liệu -'
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
                'value' => 'Thêm sản phẩm vật liệu',
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


    public function setProductRelated($arr){
//        if(!!($element = $this->get('productRelated'))){
//            if(!empty($arr)){
//                $element->setValueOptions($arr);
//            }
//        }
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
                }
            }
        return $isVaild;
    }
}
