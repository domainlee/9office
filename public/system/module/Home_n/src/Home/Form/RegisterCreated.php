<?php
namespace Home\Form;
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


class RegisterCreated extends FormBase{

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

        $store = new Text('store');
        $this->add($store);

        $filter->add(array(
            'name' => 'store',
            'attributes' => array(
                'class' => 'tb',
                'id' => 'title',
            ),
            'required' => false,
            'filter' => array(array('name'=>'StringStrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Bạn chưa nhập tên doanh nghiệp'
                        )
                    )
                ),
                array(
                    'name'    => 'Regex',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'pattern' => "/^[a-z0-9_-]{4,32}$/",
                        'messages' => array(
                            'regexNotMatch' => 'Chỉ chấp nhận các kí tự là chữ, chữ số, dấu - và dấu _'
                        )
                    ),
                ),
            )
        ));

        $username = new Text('username');
        $this->add($username);

        $filter->add(array(
            'name' => 'username',
            'attributes' => array(
                'class' => 'tb',
                'id' => 'title',
            ),
            'required' => false,
            'filter' => array(array('name'=>'StringStrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => 'Tài khoản không phù hợp'
                        )
                    )
                ),
                array(
                    'name'    => 'Regex',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'pattern' => "/^[a-z0-9_-]{4,32}$/",
                        'messages' => array(
                            'regexNotMatch' => 'Chỉ chấp nhận các kí tự là chữ, chữ số, dấu - và dấu _'
                        )
                    ),
                ),
            )
        ));

        $phone = new Text ( 'phone' );
        $this->add($phone);
        $filter->add ( array (
            'name' => 'phone',
            'required' => false,
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

        $email = new Text('email');
        $this->add ($email);
        $filter->add(array(
            'name' => 'email',
            'required' => false,
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

        $password = new Password('password');
        $this->add($password);

        $filter->add(array(
            'name' => 'password',
            'required' => false,
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
                            'isEmpty' => 'Mật khẩu không được để trống'
                        )
                    )
                ),
                array(
                    'name'    => 'StringLength',
                    'break_chain_on_failure' => true,
                    'options' => array(
                        'min' => 6,
                        'messages' => array(
                            'stringLengthTooShort' => 'Mật khẩu phải có từ 6 kí tự trở lên'
                        )
                    ),
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



    public function isValid($b = null)
    {
        $isVaild = parent::isValid();
        if($b == 2){
            if ($isVaild) {
                if($this->get('store')->getValue()) {
                    $store = new \Admin\Model\Store();
                    $store->setName($this->get('store')->getValue());
                    $storeMapper = $this->getServiceLocator()->get('Admin\Model\StoreMapper');
                    $r = $storeMapper->get2($store);
                    if(!empty($r)){
                        $this->get('store')->setMessages(['Doanh nghiệp này đã tồn tại']);
                        $isVaild = false;
                    }

                    $domain1 = new \Store\Model\Domain();
                    $domain1->setName($this->get('store')->getValue().'.'.$_SERVER['HTTP_HOST']);
                    $domainMapper = $this->getServiceLocator()->get('Store\Model\DomainMapper');
                    $r = $domainMapper->get2($domain1);
                    if(!empty($r)){
                        $this->get('store')->setMessages(['Doanh nghiệp này đã tồn tại']);
                        $isVaild = false;
                    }
                }
//
                if($this->get('username')->getValue()){
                    $user = new \Admin\Model\User();
                    $user->setUsername($this->get('username')->getValue());
                    $userMapper = $this->getServiceLocator()->get('Admin\Model\UserMapper');
                    if(!empty($userMapper->get($user))){
                        $this->get('username')->setMessages(['Tài khoản này đã tồn tại']);
                        $isVaild = false;
                    }
                }


//                    if($this->get('email')->getValue() != 'contact.dweb.vn@gmail.com') {
//                        $user = new \Admin\Model\User();
//                        $user->setEmail($this->get('email')->getValue());
//                        $userMapper = $this->getServiceLocator()->get('Admin\Model\UserMapper');
//                        $r = $userMapper->get($user);
//                        if(!empty($r)){
//                            $this->get('email')->setMessages(['Email này đã tồn tại']);
//                            $isVaild = false;
//                        }
//                    }
                return $isVaild;
            }
        }
        return $isVaild;
    }
}
