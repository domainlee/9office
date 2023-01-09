<?php
/**
 * Home\Controller
 *
 * @category       Shop99 library
 * @copyright      http://shop99.vn
 * @license        http://shop99.vn/license
 */

namespace Home\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Home\Model\Contact;
use Zend\View\Model\JsonModel;
use Home\Model\DateBase;

use Zend\Mail;
use Zend\Mime;
use Zend\Permissions\Acl\Acl;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Mail\Transport\SmtpOptions;

class ContactController extends AbstractActionController
{

    public function indexAction()
    {

    }

    public function contactAction()
    {
        $sl = $this->getServiceLocator();
        $storeId = $sl->get('Store\Service\Store')->getStoreId();
        $contactMapper = $sl->get('Home\Model\ContactMapper');
        $error = false;
        $form = new \Home\Form\Contact($this->getServiceLocator(), null);
        if($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            if($form->isValid($edit = 2)){
                $data = $form->getData();
                $contact = new \Home\Model\Contact();
                $contact->exchangeArray($data);
                $contact->setStoreId($storeId);
                $contact->setCreatedDateTime(DateBase::getCurrentDateTime());
                $contactMapper->save($contact);
                $error = true;
            }
        }

        return new ViewModel(array(
            'form' => $form,
            'error' => $error,
        ));
    }

    public function contactajaxAction()
    {
        $sl = $this->getServiceLocator();
        $storeId = $sl->get('Store\Service\Store')->getStoreId();
        $contactMapper = $sl->get('Home\Model\ContactMapper');
        $form = new \Home\Form\ContactPhone($this->getServiceLocator(), null);
        $email = ['email' => 'contact.dweb.vn@gmail.com'];

        $optionMapper = $this->getServiceLocator()->get('Home\Model\OptionMapper');

        $user = new \Admin\Model\User();
        $user->setStoreId($storeId);
        $userMapper = $this->getServiceLocator()->get('Admin\Model\UserMapper');
        $r = $userMapper->get($user);
        $serviceUser = $this->getServiceLocator()->get('User\Service\User');

        $option = new \Home\Model\Option();
        $option->setStoreId($storeId);
        $optionMapper->get($option);
        $setup = json_decode($option->getData(), true);

        $to = $r->getEmail() ? $r->getEmail():$setup['email'];

        if($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray() + ($this->getRequest()->getPost()->toArray()['email'] ? $this->getRequest()->getPost()->toArray():$email) );
            if($form->isValid($edit = 2)){
                if(!empty($to)) {
                    $body = '<div class="wrapper" style="padding: 0 30px 30px;color: #333;border: 2px solid #07aabe;">';
                    $body .= '<p style="text-align: center;border-bottom: 1px solid #ececec;margin: 0 0 20px;padding: 15px 0 10px;"><img src="http://dweb.vn/logogmail.png" width="100px" /></p>';
                    $body .= '<strong style="color: #333;">Thông tin liên hệ</strong>';
                    $body .= '<p style="color: #333;"><strong>Email: </strong>'.$this->getRequest()->getPost()->toArray()['email'].'</p>';
                    $body .= '<p style="color: #333;"><strong>Số điện thoại: </strong>'.$this->getRequest()->getPost()->toArray()['phone'].'</p>';
                    $body .= '<p>Xin cảm ơn!</p>';
                    $body .= '</div>';

                    $title = 'Thông tin liên hệ';
                    $subject = 'Thông tin liên hệ';

                    $options   = new SmtpOptions(array(
                        'host'              => 'smtp.gmail.com',
                        'connection_class'  => 'login',
                        'connection_config' => array (
                            'ssl'       => 'tls',
                            'username' => 'no.reply.dweb@gmail.com',
                            'password' => '!@#Qwerty123$'
                        ),
                        'port' => 587,
                    ));

                    $html = new Mime\Part($body);
                    $html->type = Mime\Mime::TYPE_HTML;
                    $html->charset = "UTF-8";

                    $body = new Mime\Message();
                    $body->setParts([$html]);

                    $message = new Mail\Message();
                    $message->setTo($to)
                        ->setFrom('no.reply.dweb@gmail.com', $title)
                        ->setSubject($subject)
                        ->setBody($body)
                        ->setEncoding("UTF-8");
                    $transport = new Mail\Transport\Smtp();
                    $transport->setOptions($options);
                    $transport->send($message);
                }

                $data = $form->getData();
                $name = $this->getRequest()->getPost()->toArray()['name'];
                $contact = new \Home\Model\Contact();
                $contact->exchangeArray($data);
                $contact->setName($name ? $name:'Khách cần tư vấn');
                $contact->setStoreId($storeId);
                $contact->setCreatedDateTime(DateBase::getCurrentDateTime());
                $contactMapper->save($contact);
            } else {
                return new JsonModel(array(
                    'code' => 0,
                    'messenger' => 'Dữ liệu không phù hợp',
                ));
            }
        }

        return new JsonModel(array(
            'code' => 1,
            'messenger' => 'Cảm ơn bạn đã gửi phản hồi.',
        ));
    }

}