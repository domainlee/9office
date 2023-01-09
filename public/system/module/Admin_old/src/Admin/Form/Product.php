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


class Product extends FormBase{

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

        $title = new Text('title');
        $title->setLabel('Tiêu đề:');
        $this->add($title);

        $filter->add(array(
            'name' => 'title',
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

        $code = new Text('code');
        $code->setLabel('Link:');
        $this->add($code);

        $filter->add(array(
            'name' => 'code',
            'attributes' => array(
                'class' => 'tb code',
                'id' => 'code',
            ),
            'required' => false,
            'options' => array(
                'label' => 'Code:',
                'decorator' => array('type' => 'li'),
            ),
            'filter' => array(array('name'=>'StringStrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Bạn chưa nhập mã code'
                        )
                    )
                )
            )
        ));

        $price = new Text('price');
        $price->setLabel('Link:');
        $this->add($price);

        $filter->add ( array (
            'name' => 'price',
            'required' => false,
            'filters' => array (
                array ('name' => 'Digits'),
                array ('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Giá trị phải là dạng số'
                        )
                    )
                ),
                array(
                    'name'    => 'StringLength',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            StringLength::INVALID => 'Giá trị phải là dạng số',
                        )
                    )
                ),

            ),
        ) );

//        $filter->add(array(
//            'name' => 'price',
//            'attributes' => array(
//                'class' => 'tb price',
//                'id' => 'price',
//            ),
//            'required' => false,
//            'options' => array(
//                'label' => 'Giá:',
//                'decorator' => array('type' => 'li'),
//            ),
//            'filter' => array(array('name'=>'StringStrim')),
//            'validators' => array(
//                array(
//                    'name' => 'NotEmpty',
//                    'break_chain_on_failure' => true,
//                    'options' => array(
//                        'messages' => array(
//                            'isEmpty' => 'B?n ch?a nh?p giá'
//                        )
//                    )
//                )
//            )
//        ));

        $priceOld = new Text('priceOld');
        $priceOld->setLabel('Giá khuyến mãi:');
        $this->add($priceOld);

        $filter->add ( array (
            'name' => 'priceOld',
            'required' => false,
            'filters' => array (
                array ('name' => 'Digits'),
                array ('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Bạn chưa nhập giá trị'
                        )
                    )
                ),
                array(
                    'name'    => 'StringLength',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            StringLength::INVALID => 'Giá trị phải là dạng số',
                        )
                    )
                ),

            ),
        ) );
//
//        $filter->add(array(
//            'name' => 'priceOld',
//            'attributes' => array(
//                'class' => 'tb priceOld',
//                'id' => 'priceOld',
//            ),
//            'required' => false,
//            'options' => array(
//                'label' => 'Giá km:',
//                'decorator' => array('type' => 'li'),
//            ),
//            'filter' => array(array('name'=>'StringStrim')),
//            'validators' => array(
//                array(
//                    'name' => 'NotEmpty',
//                    'break_chain_on_failure' => true,
//                    'options' => array(
//                        'messages' => array(
//                            'isEmpty' => 'B?n ch?a nh?p giá km'
//                        )
//                    )
//                )
//            )
//        ));

        $quantity = new Text('quantity');
        $quantity->setLabel('Số lượng:');
        $this->add($quantity);

        $filter->add ( array (
            'name' => 'quantity',
            'required' => false,
            'filters' => array (
                array ('name' => 'Digits'),
                array ('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Giá trị phải là dạng số'
                        )
                    )
                ),
                array(
                    'name'    => 'StringLength',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            StringLength::INVALID => 'Giá trị phải là dạng số',
                        )
                    )
                ),

            ),
        ) );
//
//        $filter->add(array(
//            'name' => 'quantity',
//            'attributes' => array(
//                'class' => 'tb quantity',
//                'id' => 'quantity',
//            ),
//            'required' => true,
//            'options' => array(
//                'label' => 'S? l??ng:',
//                'decorator' => array('type' => 'li'),
//            ),
//            'filter' => array(array('name'=>'StringStrim')),
//            'validators' => array(
//                array(
//                    'name' => 'NotEmpty',
//                    'break_chain_on_failure' => true,
//                    'options' => array(
//                        'messages' => array(
//                            'isEmpty' => 'B?n ch?a nh?p s? l??ng'
//                        )
//                    )
//                )
//            )
//        ));

        $description = new Textarea('intro');
        $description->setLabel('Tóm tắt:');
        $this->add($description);

        $filter->add(array(
            'name' => 'intro',
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

        $content = new Textarea('content');
        $content->setLabel('Nội dung:');
        $this->add($content);

        $filter->add(array(
            'name' => 'content',
            'attributes' => array(
                'class' => 'tb description',
                'id' => 'description',
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
                            'isEmpty' => 'Bạn chưa nhập mô tả'
                        )
                    )
                )
            )
        ));

        $color = new Select('color');
        $this->add($color);

        $filter->add ( array (
            'name' => 'color',
            'class' => 'tb color',
            'attributes' => array (
                'id' => 'color'
            ),
            'required' => false,
            'options' => array (
                'label' => 'color:',
                'value_options' => array (
                    '' => '- color -'
                ),
                'decorator' => array (
                    'type' => 'li'
                )
            ),
        ) );

        $size = new Select('size');
        $this->add($size);

        $filter->add ( array (
            'name' => 'size',
            'class' => 'tb size',
            'attributes' => array (
                'id' => 'size'
            ),
            'required' => false,
            'options' => array (
                'label' => 'size:',
                'value_options' => array (
                    '' => '- size -'
                ),
                'decorator' => array (
                    'type' => 'li'
                )
            ),
        ) );

        $material = new Select('material');
        $this->add($material);

        $filter->add ( array (
            'name' => 'material',
            'class' => 'tb material',
            'attributes' => array (
                'id' => 'material'
            ),
            'required' => false,
            'options' => array (
                'label' => 'material:',
                'value_options' => array (
                    '' => '- Chất liệu -'
                ),
                'decorator' => array (
                    'type' => 'li'
                )
            ),
        ) );

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


//        $storeId = new Select('storeId');
//        $storeId->setLabel('Store:');
//        $this->add($storeId);
//        $filter->add ( array (
//            'name' => 'storeId',
//            'class' => 'tb',
//            'required' => true,
//            'attributes' => array (
//                'id' => 'storeId'
//            ),
//            'options' => array (
//                'label' => 'Store:',
//                'value_options' => array (
//                    '' => '- Store -'
//                ),
//                'decorator' => array (
//                    'type' => 'li'
//                )
//            ),
//            'filter' => array(array('name'=>'StringStrim')),
//            'validators' => array(
//                array(
//                    'name' => 'NotEmpty',
//                    'break_chain_on_failure' => true,
//                    'options' => array(
//                        'messages' => array(
//                            'isEmpty' => 'Bạn chưa chọn Store'
//                        )
//                    )
//                )
//            )
//        ) );

        $brand = new Select('brandId');
        $this->add($brand);
        $filter->add ( array (
            'name' => 'brandId',
            'required' => false,
            'attributes' => array (
                'id' => 'brandId'
            ),
            'options' => array (
                'label' => 'Thương hiệu:',
                'value_options' => array (
                    '' => '- Thương hiệu -'
                ),
                'decorator' => array (
                    'type' => 'li'
                )
            ),
            'filter' => array(array('name'=>'StringStrim')),
        ) );


        $categoryId = new Select('categoryId');
        $categoryId->setLabel('Danh mục:');
        $this->add($categoryId);
        $filter->add ( array (
            'name' => 'categoryId',
            'required' => true,
            'attributes' => array (
                'id' => 'categoryId'
            ),
            'options' => array (
                'label' => 'Danh mục:',
                'value_options' => array (
                    '' => '- Danh mục -'
                ),
                'decorator' => array (
                    'type' => 'li'
                )
            ),
            'filter' => array(array('name'=>'StringStrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Bạn chưa chọn danh mục'
                        )
                    )
                )
            )
        ) );

//        $parentId = new Select('parentId');
//        $this->add($parentId);
//        $filter->add ( array (
//            'name' => 'parentId',
//            'required' => false,
//            'attributes' => array (
//                'id' => 'parentId'
//            ),
//        ) );

        $parentId = new Select('parentId');
        $this->add($parentId);
        $filter->add ( array (
            'name' => 'parentId',
            'required' => false,
            'attributes' => array (
                'id' => 'parentId'
            ),
            'options' => array (
                'label' => 'Thương hiệu:',
                'value_options' => array (
                    '' => '- Thương hiệu -'
                ),
                'decorator' => array (
                    'type' => 'li'
                )
            ),
            'filter' => array(array('name'=>'StringStrim')),
        ) );

        $model = new \Admin\Model\Product();

        $status = new Select('status');
        $status->setLabel('Trạng thái:');
        $this->add($status);
        $status->setValueOptions([
                '' => '- Lựa chọn -',
            ]+ $model->getStatuses());

        $filter->add ( array (
            'name' => 'status',
            'class' => 'tb',
            'required' => false,
            'attributes' => array (
                'id' => 'parentId'
            ),
            'options' => array (
                'label' => 'Trạng thái:',
                'decorator' => array (
                    'type' => 'li'
                ),
            )
        ) );

        $type1 = new Hidden('images');
        $this->add($type1);
        $filter->add(array(
            'name' => 'images',
            'required' => false
        ));

        $tags = new Text('tags');
        $this->add($tags);

        $filter->add(array(
            'name' => 'tags',
            'attributes' => array(),
            'required' => false,
            'options' => array(
                'decorator' => array('type' => 'li'),
            ),
            'filter' => array(array('name'=>'StringStrim')),
        ));

        $metaTitle = new Text('metaTitle');
        $this->add($metaTitle);

        $filter->add(array(
            'name' => 'metaTitle',
            'attributes' => array(),
            'required' => false,
            'options' => array(
                'decorator' => array('type' => 'li'),
            ),
            'filter' => array(array('name'=>'StringStrim')),
        ));

        $url = new Text('url');
        $this->add($url);

        $filter->add(array(
            'name' => 'url',
            'attributes' => array(),
            'required' => false,
            'options' => array(
                'decorator' => array('type' => 'li'),
            ),
            'filter' => array(array('name'=>'StringStrim')),
        ));


        $metaKeyword = new Text('metaKeyword');
        $this->add($metaKeyword);

        $filter->add(array(
            'name' => 'metaKeyword',
            'attributes' => array(),
            'required' => false,
            'options' => array(
                'decorator' => array('type' => 'li'),
            ),
            'filter' => array(array('name'=>'StringStrim')),
        ));

        $metaDescription = new Textarea('metaDescription');
        $this->add($metaDescription);

        $filter->add(array(
            'name' => 'metaDescription',
            'attributes' => array(),
            'required' => false,
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

    public function setSize($arr){
        if(!!($element = $this->get('size'))){
            $element->setValueOptions($arr);
        }
    }

    public function setMaterial($arr){
        if(!!($element = $this->get('material'))){
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
