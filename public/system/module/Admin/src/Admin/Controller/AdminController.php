<?php 
namespace Admin\Controller; 

use Zend\Mvc\Controller\AbstractActionController; 
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use \Datetime;
use \DateTimeZone;


class AdminController extends AbstractActionController
{ 
    public function indexAction() {
    	$this->layout('layout/admin');
        $serviceUser = $this->getServiceLocator()->get('User\Service\User');
//        print_r($serviceUser->getIdentity());die;

        $model = new \Admin\Model\Article();
        $mapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
        $sl = $this->getServiceLocator();
        $u = $this->getServiceLocator()->get('User\Service\User');
//        $storeId = 23;
        $userName = $u->getUser()->getUserName() ? $u->getUser()->getUserName():$u->getUser()->getEmail();
        $storeId = $u->getStoreId();

        $model->exchangeArray((array)$this->getRequest()->getQuery());
        $options['isAdmin'] = $this->user()->isSuperAdmin();
        $fFilter = new \Admin\Form\ArticleSearch($options);
        $model->setStoreId($storeId);
        $model->setStatus(1);

        $fFilter->bind($model);

        $page = (int)$this->getRequest()->getQuery()->page ? : 1;
        $results = $mapper->search($model, array($page,6));

        $order = new \Admin\Model\Order();
        $orderMapper = $sl->get('Admin\Model\OrderMapper');

        $inProduction = 'InProduction';
        $order->setStatusCode($inProduction);
        $count_doing_product = $orderMapper->report($order);

        $finishedProduction = 'FinishedProduction';
        $order->setStatusCode($finishedProduction);
        $count_finished_product = $orderMapper->report($order);

        $confirmed = 'Confirmed';
        $order->setStatusCode($confirmed);
        $count_confirmed = $orderMapper->report($order);

//        this week
//        $today = new DateTime('now', new DateTimeZone('GMT+7'));
//        $day_of_week = $today->format('w');
//        $today->modify('- ' . (($day_of_week - 0 + 7) % 7) . 'days');
//        $sunday = clone $today;
//        $sunday->modify('+ 6 days');
//        echo $today->format('Y-m-d') . "\n";
//        echo $sunday->format('Y-m-d');

        $now = new DateTime();
        $nowOrder = $now->format('Y-m-d');
        $new = '';
        $order = new \Admin\Model\Order();
        $order->setStatusCode($new);
        $order->setOptions(['not_join' => true, 'start_date' => $nowOrder, 'end_date' => $nowOrder]);
        $count_new = $orderMapper->report($order);

        return new ViewModel(array(
            'UserName' => $userName,
            'fFilter' => $fFilter,
            'results' => $results,
            'doing_product' => $count_doing_product,
            'finished_product' => $count_finished_product,
            'count_confirmed' => $count_confirmed,
            'count_new' => $count_new,
            'url' => $this->getRequest()->getUri()->getQuery()
        ));
    }

    public function huongdanAction()
    {
        $this->layout('layout/guide');
        return new ViewModel(array(
            'url' => $this->getRequest()->getUri()->getQuery()
        ));
    }

    public function optionadminAction() {
        $request = $this->getRequest();
        $menu = $request->getPost()['menuleft'];
        if($menu) {
            if($_COOKIE["menuleft"]) {
                setcookie('menuleft', '', time()-31556926, '/');
            } else {
                setcookie('menuleft', 1, time()+31556926, '/');
            }
        }

        return new JsonModel(array(
            'code'=> 1,
            'messenger' => 'Thành công'
        ));
    }
}