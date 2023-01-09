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


class ForgotPassword extends FormBase{

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

        $passwordOld = new Password('passwordOld');
        $this->add($passwordOld);

        $filter->add(array(
            'name' => 'passwordOld',
            'attributes' => array(
                'class' => 'tb',
            ),
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
                            'isEmpty' => 'Mật khẩu cũ không chính xác'
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

        $passwordNew = new Password('passwordNew');
        $this->add($passwordNew);

        $filter->add(array(
            'name' => 'passwordNew',
            'attributes' => array(
                'class' => 'tb',
            ),
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
                            'isEmpty' => 'Bạn chưa nhập password'
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
                'value' => 'Cập nhật',
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


    public function isValid($id = null)
    {
        $isVaild = parent::isValid();
            if(!empty($id)){
                if ($isVaild) {
                    if(!empty($this->get('passwordOld')->getValue())){
                        $user = new \Admin\Model\User();
                        $user->setId($id);
                        $user->setPassword($this->get('passwordOld')->getValue());
    //                    $userMapper = $this->getServiceLocator()->get('Admin\Model\UserMapper');
                        $userService = $this->getServiceLocator()->get('User\Service\User');
                        if (!$userService->validateChangeInfo($user)){
                            $this->get('passwordOld')->setMessages(['Mật khẩu cũ không chính xác']);
                            $isVaild = false;
                        }
                    }
                    return $isVaild;
                }
            }
        return $isVaild;
    }
}
