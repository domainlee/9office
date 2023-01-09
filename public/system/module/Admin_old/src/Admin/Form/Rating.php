<?php
namespace Admin\Form;
use Base\Form\ProvidesEventsForm;
use Zend\Form\Element\Text;
use Zend\Form\Element\Password;
use Zend\Form\Element\Select;
use Zend\Form\Element\Textarea;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\File;
use Zend\Validator\InArray;
use Zend\Validator\IsInstanceOf;
use Zend\Form\Annotation\Validator;
use Zend\Validator\StringLength;
use Base\Form\FormBase;


class Rating extends FormBase{

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

        $description = new Textarea('content');
        $this->add($description);

        $filter->add(array(
            'name' => 'content',
            'attributes' => array(
                "rows" => "5",
                "cols" => "30",
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

        $username = new Text('name');
        $this->add($username);

        $filter->add(array(
            'name' => 'name',
            'attributes' => array(
                'class' => 'tb',
            ),
            'required' => true,
            'options' => array(
                'decorator' => array('type' => 'li'),
            ),
            'filter' => array(array('name'=>'StringStrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Bạn chưa nhập username'
                        )
                    )
                ),
            )
        ));

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

        $mobile1 = new Text ( 'phone' );
        $this->add($mobile1);
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

        $vote = new Text ( 'vote' );
        $this->add($vote);
        $filter->add ( array (
            'name' => 'vote',
            'required' => true,
            'filters' => array (
                array ('name' => 'Digits')
            ),
            'validators' => array (
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'min' => 1,
                        'max' => 1
                    )
                ),
                array(
                    'name' => 'Digits',
                )
            )
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

//    public function isValid($b = null)
//    {
//        $isVaild = parent::isValid();
//            if($b == 2){
//                if ($isVaild) {
//                    $user = new \Admin\Model\User();
//                    $user->setUsername($this->get('username')->getValue());
//                    $userMapper = $this->getServiceLocator()->get('Admin\Model\UserMapper');
//                    if(!empty($userMapper->get($user))){
//                        $this->get('username')->setMessages(['Tài khoản này đã tồn tại']);
//                        $isVaild = false;
//                    }
//                    $user = new \Admin\Model\User();
//                    $user->setEmail($this->get('email')->getValue());
//                    $userMapper = $this->getServiceLocator()->get('Admin\Model\UserMapper');
//                    if(!empty($userMapper->get($user))){
//                        $this->get('email')->setMessages(['Email này đã tồn tại']);
//                        $isVaild = false;
//                    }
//                    $user = new \Admin\Model\User();
//                    $user->setMobile($this->get('mobile')->getValue());
//                    $userMapper = $this->getServiceLocator()->get('Admin\Model\UserMapper');
//                    if(!empty($userMapper->get($user))){
//                        $this->get('mobile')->setMessages(['Số điện thoại này đã tồn tại']);
//                        $isVaild = false;
//                    }
//                    return $isVaild;
//                }
//            }
//        return $isVaild;
//    }

}
