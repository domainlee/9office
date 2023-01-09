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

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $sl = $this->getServiceLocator();
        $storeService = $sl->get('Store\Service\Store');
        $domainMapper = $sl->get('Store\Model\DomainMapper');

        $domain = $storeService->getDomain();
        $domain1 = new \Store\Model\Domain();
        $domain1->setName($domain->getName());
        $r = $domainMapper->get2($domain1);
        if(empty($r)) {
            $this->redirect()->toUrl('http://dweb.vn');
        }

    }

    public function addAction()
    {

    }

    public function editAction()
    {

    }

    public function deleteAction()
    {

    }

    public function introAction()
    {

    }

    public function cookieAction()
    {
//        $request = $this->getRequest();
//        $nameCookie = $request->getPost('name');
//        $valueCookie = $request->getPost('value');
//        $deleteCookie = $request->getPost('delete');
//        setcookie($nameCookie, $valueCookie, time() + (86400 * 30), "/");
//        if($deleteCookie) {
//            echo '1';
//            if(isset($_COOKIE[$nameCookie])) {
//                setcookie($nameCookie, '', time() - 3600);
//            }
//        }
//        else {
//            echo '2';
//        }
//        return true;
    }

    public function registerAction()
    {
        $this->layout('layout/null');
        $sl = $this->getServiceLocator();

        $name = $this->params('name');
        $a = end(explode('-', $name));
        $uiTemplateMapper = $sl->get('Uitemplate\Model\UitemplateMapper');

        $uiTemplate = new \Uitemplate\Model\Uitemplate();
        $uiTemplate->setDirectory($a);
        if(!$uiTemplateMapper->getId($uiTemplate)){
            $this->redirect()->toUrl('/');
        }
        $userMapper = $sl->get('User\Model\UserMapper');
        $registerMapper = $sl->get('Home\Model\RegisterMapper');

        $error = false;

        $form = new \Home\Form\Register($sl, null);
        if($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
//            || !$error
            if($form->isValid($edit = 2)){
                $data = $form->getData();
                $d = md5($data['store'] . $data['phone'] . time());
                $register = new \Home\Model\Register();
                $data['storeClone'] = $a;
                $register->setData(json_encode($data));
                $register->setKeyActive($d);
                $linkActive = 'http://'.$_SERVER['HTTP_HOST'].'/active/'.$d;
                $register->setCreatedDateTime(DateBase::getCurrentDateTime());
                if(!$error){
                    $registerMapper->save($register);
                }
                $error = true;
                $to = $data['email'];

                $body = '<div class="wrapper" style="padding: 0 30px 30px;color: #333;border: 2px solid #07aabe;">';
                $body .= '<p style="text-align: center;border-bottom: 1px solid #ececec;margin: 0 0 20px;padding: 15px 0 10px;"><img src="http://dweb.vn/logogmail.png" width="100px" /></p>';
                $body .= '<strong style="color: #333;">Xin chào '.$to.' !</strong>';
                $body .= '<p style="color: #333;">Để hoàn thành quá trình đăng kí, xin nhấp vào đường dẫn bên dưới để kích hoạt tài khoản của bạn</p>';
                $body .= '<a href='.$linkActive.'>'.$linkActive.'</a>';
                $body .= '<p>Xin cảm ơn!</p>';
                $body .= '</div>';

                $title = 'Email kích hoạt tài khoản';
                $subject = 'DWEB.VN - Email kích hoạt tài khoản';

                $options   = new SmtpOptions(array(
                    'host'              => 'smtp.gmail.com',
                    'connection_class'  => 'login',
                    'connection_config' => array(
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
        }

        return new ViewModel(array(
            'form' => $form,
            'error' => $error,
            'title' => $name,
        ));
    }

    public function activeAction()
    {
        $this->layout('layout/null');
        $active = $this->getRequest()->getPost('active');

        $sl = $this->getServiceLocator();
        $name = $this->params('name');

        $register = new \Home\Model\Register();
        $register->setKeyActive($name);
        $registerMapper = $sl->get('Home\Model\RegisterMapper');
        $r = $registerMapper->get($register);
        $viewModel = new ViewModel();
        if(empty($r)) {
            $viewModel->setVariable('code', true);
            return $viewModel;
        }

        if($active) {
            $data = json_decode($register->getData(), true);

            /**** New storeId ****/
            $newStoreId = '';
            $store = new \Admin\Model\Store();
            $store->setName($data['store']);
            $storeMapper = $sl->get('Admin\Model\StoreMapper');
            $r = $storeMapper->get($store);
            if(!empty($r)) {
                $newStoreId = $store->getId();
            } else {
                $store = new \Admin\Model\Store();
                $store->setName($data['store']);
                $store->setStatus(1);
                $storeMapper->save($store);
                $newStoreId = $store->getId();
            }

            /**** Clone storeId ****/
            $store = new \Admin\Model\Store();
            $store->setName($data['storeClone']);
            $r = $storeMapper->get($store);
            if(!$r) {
                return new JsonModel(array(
                    'code' => 0,
                    'messenger' => 'Không tìm thấy doanh nghiệp cần sao chép',
                ));
            }
            $cloneStoreId = $store->getId();

            /**** Category Article ****/
            $articleCategoryMapper = $sl->get('Admin\Model\ArticlecMapper');
            $articleCategory = new \Admin\Model\Articlec();
            $articleCategory->setStoreId($cloneStoreId);
            $ac = $articleCategoryMapper->fetchAll($articleCategory);
            if(!empty($ac)) {
                foreach($ac as $k => $c) {
                    $c->setId(null);
                    $c->setStoreId($newStoreId);
                    $articleCategoryMapper->save($c);
                }
            }

            /**** Update ParentId Category Article ***/
            $articleCategory = new \Admin\Model\Articlec();
            $articleCategory->setStoreId($newStoreId);
            $ac = $articleCategoryMapper->fetchAll($articleCategory);
            if(!empty($ac)) {
                foreach($ac as $k => $c) {
                    if($c->getParentId()){
                        $articleCategory = new \Admin\Model\Articlec();
                        $articleCategory->setId($c->getParentId());
                        $r = $articleCategoryMapper->get($articleCategory);
                        if(!empty($r)) {
                            $articleCategory1 = new \Admin\Model\Articlec();
                            $articleCategory1->setStoreId($newStoreId);
                            $articleCategory1->setName($articleCategory->getName());
                            $r = $articleCategoryMapper->get($articleCategory1);
                            if(!empty($r)) {
                                $c->setParentId($articleCategory1->getId());
                            }
                        }
                    }
                    $articleCategoryMapper->save($c);
                }
            }

            /**** Article ****/
            $articleMapper = $sl->get('Admin\Model\ArticleMapper');
            $article = new \Admin\Model\Article();
            $article->setStoreId($cloneStoreId);
            $a = $articleMapper->fetchAll($article);
            if(!empty($a)) {
                foreach($a as $k => $c) {
                    $articleCategory = new \Admin\Model\Articlec();
                    $articleCategory->setId($c->getCategoryId());
                    $r = $articleCategoryMapper->get($articleCategory);
                    if(!empty($r)) {
                        $articleCategory1 = new \Admin\Model\Articlec();
                        $articleCategory1->setName($articleCategory->getName());
                        $articleCategory1->setStoreId($newStoreId);
                        $r = $articleCategoryMapper->get($articleCategory1);
                        if(!empty($r)) {
                            $c->setCategoryId($articleCategory1->getId());
                        }
                    }
                    $c->setId(null);
                    $c->setStoreId($newStoreId);
                    $articleMapper->save($c);
                }
            }

            /**** Banner ****/
            $bannerMapper = $sl->get('Admin\Model\BannerMapper');
            $banner = new \Admin\Model\Banner();
            $banner->setStoreId($cloneStoreId);
            $b = $bannerMapper->fetchAll($banner);
            if(!empty($b)) {
                foreach($b as $k => $o) {
                    $o->setId(null);
                    $o->setStoreId($newStoreId);
                    $o->setLink(null);
                    if($o->getImage()){
                        $i = json_decode($o->getImage(), true);
                        if(!empty($i)) {
                            $rj = [];
                            foreach($i as $k => $image) {
                                $r = explode('/', $image);
                                $r[3] = $newStoreId;
                                $rj[$k] = implode('/', $r);
                            }
                            $o->setImage(json_encode($rj));
                        }
                    }
                    $bannerMapper->save($o);
                }
            }

            /**** Brand ****/
            $brandMapper = $sl->get('Admin\Model\BrandMapper');
            $brand = new \Admin\Model\Brand();
            $brand->setStoreId($cloneStoreId);
            $b = $brandMapper->fetchAll($brand);
            if(!empty($b)) {
                foreach($b as $k => $o) {
                    $o->setId(null);
                    $o->setStoreId($newStoreId);
                    $brandMapper->save($o);
                }
            }
            /**** Media ****/
            $mediaMapper = $sl->get('Admin\Model\MediaMapper');
            $media = new \Admin\Model\Media();
            $media->setStoreId($cloneStoreId);
            $m = $mediaMapper->fetchAll($media);
            if(!empty($m)) {
                foreach($m as $k => $b) {
                    $b->setId(null);
                    $b->setStoreId($newStoreId);
                    $mediaMapper->save($b);
                }
            }

            /**** Option ****/
            $optionMapper = $sl->get('Admin\Model\OptionMapper');
            $option = new \Admin\Model\Menu();
            $option->setStoreId($cloneStoreId);
            $o = $optionMapper->fetchAll($option);
            if(!empty($o)) {
                foreach($o as $k => $b) {
                    $b->setId(null);
                    $b->setStoreId($newStoreId);
                    if(!empty($b->getData())) {
                        $a = json_decode($b->getData(), true);
                        $a['domain'] = null;
                        $a['google'] = null;
                        $a['facebook'] = null;
                        $a['youtube'] = null;
                        $a['twitter'] = null;
                        $a['GoogleAnalyticsId'] = null;
                        $l = explode('/', $a['logo']);
                        $l[3] = $newStoreId;
                        $a['logo'] = implode('/', $l);
                        $f = explode('/', $a['favicon']);
                        $f[3] = $newStoreId;
                        $a['favicon'] = implode('/', $f);
                        $b->setData(json_encode($a));
                    }
                    $optionMapper->save($b);
                }
            }

            /**** Page ****/
            $pageMapper = $sl->get('Admin\Model\PageMapper');
            $page = new \Admin\Model\Page();
            $page->setStoreId($cloneStoreId);
            $p = $pageMapper->fetchAll($page);
            if(!empty($p)) {
                foreach($p as $k => $v) {
                    $v->setId(null);
                    $v->setStoreId($newStoreId);
                    $pageMapper->save($v);
                }
            }

            /**** Category Product ****/
            $productCategoryMapper = $sl->get('Admin\Model\ProductcMapper');
            $productCategory = new \Admin\Model\Productc();
            $productCategory->setStoreId($cloneStoreId);
            $ac = $productCategoryMapper->fetchAll($productCategory);
            if(!empty($ac)) {
                foreach($ac as $k => $c) {
                    $c->setId(null);
                    $c->setStoreId($newStoreId);

                    if($c->getImage()){
                        $i = json_decode($c->getImage(), true);
                        if(!empty($i)) {
                            $rj = [];
                            foreach($i as $k => $image) {
                                $r = explode('/', $image);
                                $r[3] = $newStoreId;
                                $rj[$k] = implode('/', $r);
                            }
                            $c->setImage(json_encode($rj));
                        }
                    }
                    $productCategoryMapper->save($c);
                }
            }

            /**** Update ParentId Category Product ***/
            $productCategory = new \Admin\Model\Productc();
            $productCategory->setStoreId($newStoreId);
            $pc = $productCategoryMapper->fetchAll($productCategory);
            if(!empty($pc)) {
                foreach($pc as $k => $c) {
                    if($c->getParentId()){
                        $productCategory2 = new \Admin\Model\Productc();
                        $productCategory2->setId($c->getParentId());
                        $r = $productCategoryMapper->get($productCategory2);
                        if(!empty($r)) {
                            $productCategory1 = new \Admin\Model\Productc();
                            $productCategory1->setStoreId($newStoreId);
                            $productCategory1->setName($productCategory2->getName());
                            $r = $productCategoryMapper->get($productCategory1);
                            if(!empty($r)) {
                                $c->setParentId($productCategory1->getId());
                            }
                        }
                    }
                    $productCategoryMapper->save($c);
                }
            }

            /**** Product ****/
            $productMapper = $sl->get('Admin\Model\ProductMapper');
            $product = new \Admin\Model\Product();
            $product->setStoreId($cloneStoreId);
            $a = $productMapper->fetchAll($product);
            if(!empty($a)) {
                foreach($a as $k => $c) {
                    if($c->getCategoryId()) {
                        $productCategory = new \Admin\Model\Productc();
                        $productCategory->setId($c->getCategoryId());
                        $r = $productCategoryMapper->get($productCategory);
                        if(!empty($r)) {
                            $productCategory1 = new \Admin\Model\Productc();
                            $productCategory1->setName($productCategory->getName());
                            $productCategory1->setStoreId($newStoreId);
                            $r = $productCategoryMapper->get($productCategory1);
                            if(!empty($r)) {
                                $c->setCategoryId($productCategory1->getId());
                            }
                        }
                    }
                    if($c->getBrandId()) {
                        $brand = new \Admin\Model\Brand();
                        $brand->setId($c->getBrandId());
                        $r = $brandMapper->get($brand);
                        if(!empty($r)) {
                            $brand1 = new \Admin\Model\Brand();
                            $brand1->setName($brand->getName());
                            $brand1->setStoreId($newStoreId);
                            $r = $brandMapper->get($brand1);
                            if(!empty($r)) {
                                $c->setBrandId($brand1->getId());
                            }
                        }
                    }
                    if($c->getImage()){
                        $i = json_decode($c->getImage(), true);
                        if(!empty($i)) {
                            $rj = [];
                            foreach($i as $k => $image) {
                                $r = explode('/', $image);
                                $r[3] = $newStoreId;
                                $rj[$k] = implode('/', $r);
                            }
                            $c->setImage(json_encode($rj));
                        }
                    }
                    $c->setId(null);
                    $c->setStoreId($newStoreId);
                    $c->setProductRelated(null);
                    $c->setArticleRelated(null);
                    $productMapper->save($c);
                }
            }
            /**** Media Item ****/
            $mediaItemMapper = $sl->get('Admin\Model\MediaItemMapper');
            $mediaItem = new \Admin\Model\MediaItem();
            $mediaItem->setStoreId($cloneStoreId);
            $mi = $mediaItemMapper->fetchAll($mediaItem);
            if(!empty($mi)) {
                foreach($mi as $k => $b) {

                    if($b->getFileItem()) {
                        $media = new \Admin\Model\Media();
                        $media->setId($b->getFileItem());
                        $rm = $mediaMapper->get($media);
                        if(!empty($rm)) {
                            $media1 = new \Admin\Model\Media();
                            $media1->setFileName($media->getFileName());
                            $media1->setStoreId($newStoreId);
                            $rm1 = $mediaMapper->get($media1);
                            if(!empty($rm1)) {
                                $b->setFileItem($media1->getId());
                            }
                        }
                    }
                    if(!empty($b->getItemId())) {
                        if($b->getType() == 3) {
                            $productc = new \Admin\Model\Productc();
                            $productc->setId($b->getItemId());
                            $pcr = $productCategoryMapper->get($productc);
                            if(!empty($pcr)) {
                                $productc1 = new \Admin\Model\Productc();
                                $productc1->setName($productc->getName());
                                $productc1->setStoreId($newStoreId);
                                $pcr1 = $productCategoryMapper->get($productc1);
                                if(!empty($pcr1)) {
                                    $b->setItemId($productc1->getId());
                                }
                            }
                        }
                        if($b->getType() == 2) {
                                $product = new \Admin\Model\Product();
                                $product->setId($b->getItemId());
                                $pr = $productMapper->get($product);
                                if(!empty($pr)) {
                                    $product1 = new \Admin\Model\Product();
                                    $product1->setTitle($product->getTitle());
                                    $product1->setStoreId($newStoreId);
                                    $pr1 = $productMapper->get($product1);
                                    if(!empty($pr1)) {
                                        $b->setItemId($product1->getId());
                                    }
                                }
                        }
                        if($b->getType() == 1) {
                            $article = new \Admin\Model\Article();
                            $article->setId($b->getItemId());
                            $ar = $articleMapper->get($article);
                            if(!empty($ar)) {
                                $article1 = new \Admin\Model\Article();
                                $article1->setTitle($article->getTitle());
                                $article1->setStoreId($newStoreId);
                                $ar1 = $articleMapper->get($article1);
                                if(!empty($ar1)) {
                                    $b->setItemId($article1->getId());
                                }
                            }
                        }
                        if($b->getType() == 4) {
                            $banner = new \Admin\Model\Banner();
                            $banner->setId($b->getItemId());
                            $br = $bannerMapper->get($banner);
                            if(!empty($br)) {
                                $banner1 = new \Admin\Model\Banner();
                                $banner1->setName($banner->getName());
                                $banner1->setStoreId($newStoreId);
                                $br1 = $bannerMapper->get($banner1);
                                if(!empty($br1)) {
                                    $b->setItemId($banner1->getId());
                                }
                            }
                        }
                        if($b->getType() == 5) {
                            $brand = new \Admin\Model\Brand();
                            $brand->setId($b->getItemId());
                            $bar = $brandMapper->get($brand);
                            if(!empty($bar)) {
                                $brand1 = new \Admin\Model\Brand();
                                $brand1->setName($brand->getName());
                                $brand1->setStoreId($newStoreId);
                                $bar1 = $brandMapper->get($brand1);
                                if(!empty($bar1)) {
                                    $b->setItemId($brand1->getId());
                                }
                            }
                        }
                    }
                    $b->setStoreId($newStoreId);
                    $mediaItemMapper->save($b);
                }
            }

            function categoryProduct($url, $storeId, $sl) {

                $productCategoryMapper = $sl->get('Admin\Model\ProductcMapper');
                preg_match_all('/\-pc(\d+)/', $url, $pc_preg);
                if(!empty($pc_preg[1][0])) {
                    $productCategory = new \Admin\Model\Productc();
                    $productCategory->setId($pc_preg[1][0]);
                    $r = $productCategoryMapper->get($productCategory);
                    if(!empty($r)) {
                        $productCategory1 = new \Admin\Model\Productc();
                        $productCategory1->setName($productCategory->getName());
                        $productCategory1->setStoreId($storeId);
                        $r = $productCategoryMapper->get($productCategory1);
                        if(!empty($r)) {
                            return $productCategory1->getViewLink();
                        }
                    }
                }

                $pageMapper = $sl->get('Admin\Model\PageMapper');
                preg_match_all('/\-pa(\d+)/', $url, $pa_preg);
                if(!empty($pa_preg[1][0])) {
                    $page = new \Admin\Model\Page();
                    $page->setId($pa_preg[1][0]);
                    $pa = $pageMapper->get($page);
                    if(!empty($pa)) {
                        $page1 = new \Admin\Model\Page();
                        $page1->setName($page->getName());
                        $page1->setStoreId($storeId);
                        $pa1 = $pageMapper->get($page1);
                        if(!empty($pa1)) {
                            return $page1->getViewLink();
                        }
                    }
                }

                $articleCategoryMapper = $sl->get('Admin\Model\ArticlecMapper');
                preg_match_all('/\-nc(\d+)/', $url, $nc_preg);
                if(!empty($nc_preg[1][0])){
                    $articleCategory = new \Admin\Model\Articlec();
                    $articleCategory->setId($nc_preg[1][0]);
                    $r = $articleCategoryMapper->get($articleCategory);
                    if(!empty($r)) {
                        $articleCategory1 = new \Admin\Model\Articlec();
                        $articleCategory1->setName($articleCategory->getName());
                        $articleCategory1->setStoreId($storeId);
                        $r = $articleCategoryMapper->get($articleCategory1);
                        if(!empty($r)) {
                            return $articleCategory1->getViewLink();
                        }
                    }
                }

                return false;
            }

            /**** Menu ****/
            $menuMapper = $sl->get('Admin\Model\MenuMapper');
            $menu = new \Admin\Model\Menu();
            $menu->setStoreId($cloneStoreId);
            $m = $menuMapper->fetchAll($menu);
            if(!empty($m)) {
                foreach($m as $k => $b) {
                    if(!empty($b->getMenu())) {
                        $dataMenu = json_decode($b->getMenu(), true);
                        if(!empty($dataMenu)){
                            $mr = [];
                            foreach($dataMenu as $m) {
                                if(categoryProduct($m['url'], $newStoreId, $sl)) {
                                    $m['url'] = categoryProduct($m['url'], $newStoreId, $sl);
                                }
                                /**************************/
                                if(!empty($m['children'])){
                                    $mr1 = [];
                                    foreach($m['children'] as $mm) {
                                        if(categoryProduct($mm['url'], $newStoreId, $sl)) {
                                            $mm['url'] = categoryProduct($mm['url'], $newStoreId, $sl);
                                        }
                                        /**************************/
                                        if(!empty($mm['children'])){
                                            $mr2 = [];
                                            foreach($mm['children'] as $mmm) {
                                                if(categoryProduct($mmm['url'], $newStoreId, $sl)) {
                                                    $mmm['url'] = categoryProduct($mmm['url'], $newStoreId, $sl);
                                                }
                                                /**************************/
                                                if(!empty($mmm['children'])){
                                                    $mr3 = [];
                                                    foreach($mmm['children'] as $mmmm) {
                                                        if(categoryProduct($mmmm['url'], $newStoreId, $sl)) {
                                                            $mmmm['url'] = categoryProduct($mmmm['url'], $newStoreId, $sl);
                                                        }
                                                        /**************************/
                                                        if(!empty($mmmm['children'])){
                                                            $mr4 = [];
                                                            foreach($mmmm['children'] as $mmmmm) {
                                                                if(categoryProduct($mmmmm['url'], $newStoreId, $sl)) {
                                                                    $mmmmm['url'] = categoryProduct($mmmmm['url'], $newStoreId, $sl);
                                                                }
                                                                $mr4[] = $mmmmm;
                                                            }
                                                            $mmmm['children'] = $mr4;
                                                        }
                                                        /**************************/
                                                        $mr3[] = $mmmm;
                                                    }
                                                    $mmm['children'] = $mr3;
                                                }
                                                /**************************/
                                                $mr2[] = $mmm;
                                            }
                                            $mm['children'] = $mr2;
                                        }
                                        /**************************/
                                        $mr1[] = $mm;
                                    }
                                    $m['children'] = $mr1;
                                }
                                /**************************/
                                $mr[] = $m;
                            }
                            $b->setMenu(json_encode($mr));
                        }
                    }
                    $b->setId(null);
                    $b->setStoreId($newStoreId);
                    $menuMapper->save($b);
                }
            }

            /**** Attr ****/
            $attrMapper = $sl->get('Admin\Model\AttrMapper');
            $attr = new \Admin\Model\Attr();
            $attr->setStoreId($cloneStoreId);
            $a = $attrMapper->fetchAll($attr);
            if(!empty($a)) {
                foreach ($a as $k => $c) {
                    $c->setId(null);
                    $c->setStoreId($newStoreId);
                    $attrMapper->save($c);
                }
            }

            /**** Attr ****/
            $attrListMapper = $sl->get('Admin\Model\AttrListMapper');
            $attrList = new \Admin\Model\AttrList();
            $attrList->setStoreId($cloneStoreId);
            $a = $attrListMapper->fetchAll($attrList);
            if(!empty($a)) {
                foreach ($a as $k => $c) {
                    if($c->getProductAttrId()) {
                        $attr = new \Admin\Model\Attr();
                        $attr->setId($c->getProductAttrId());
                        $r = $attrMapper->get($attr);
                        if(!empty($r)) {
                            $attr1 = new \Admin\Model\Attr();
                            $attr1->setName($attr->getName());
                            $attr1->setStoreId($newStoreId);
                            $at = $attrMapper->get($attr1);
                            if(!empty($at)) {
                                $c->setProductAttrId($attr1->getId());
                            }
                        }
                    }
                    if($c->getProductId()) {
                        $product = new \Admin\Model\Product();
                        $product->setId($c->getProductId());
                        $rp = $productMapper->get($product);
                        if(!empty($rp)) {
                            $product1 = new \Admin\Model\Product();
                            $product1->setStoreId($newStoreId);
                            $product1->setTitle($product->getTitle());
                            $p = $productMapper->get($product1);
                            if(!empty($p)) {
                                $c->setProductId($product1->getId());
                            }
                        }
                    }
                    $c->setStoreId($newStoreId);
                    $attrListMapper->save($c);
                }
            }
            $uitemplateMapper = $sl->get('Uitemplate\Model\UitemplateMapper');
            $domainMapper = $sl->get('Store\Model\DomainMapper');
            $uitemplate = new \Uitemplate\Model\Uitemplate();
            $uitemplate->setDirectory($data['storeClone']);
            $r = $uitemplateMapper->getId($uitemplate);

            if(!empty($r)) {
                $domain = new \Store\Model\Domain();
                $domain->setUitemplate($uitemplate->getId());
                $d = $domainMapper->get($domain);
                if(!empty($d)) {
                    $domain->setId(null);
                    $domain->setStoreId($newStoreId);
                    $domain->setAlias(null);
                    $domain->setName($data['store'].'.'.$_SERVER['HTTP_HOST']);
                    $domain->setCreatedDateTime(DateBase::getCurrentDateTime());

                    $userMapper = $this->getServiceLocator()->get('Admin\Model\UserMapper');
                    $userGet = new \Admin\Model\User();
                    $userGet->setEmail($data['email']);

                    $rUG = $userMapper->get($userGet);
                    if(!empty($rUG)) {
                        $domain->setParentStoreId($rUG->getStoreId());
                    }

                    $optionPage = json_decode($domain->getOptionPage(), true);
                    if(!empty($optionPage)) {
                        $rop = [];
                        foreach($optionPage as $k => $o) {
                            if(is_array($o)){
                                if(!empty($o)) {
                                    $c = [];
                                    foreach($o as $i => $b) {
                                        /*** Image ***/
                                        if(!empty($b['image'])){
                                            $im = json_decode($b['image'], true);
                                            if(!empty($im)) {
                                                $rj = [];
                                                foreach($im as $ki => $image) {
                                                    $r = explode('/', $image);
                                                    $r[3] = $newStoreId;
                                                    $rj[$ki] = implode('/', $r);
                                                }
                                                $b['image'] = json_encode($rj);
                                            }
                                        }
                                        /*** Category Product ***/
                                        preg_match_all('/\-pc(\d+)/', $b['url'], $pc_preg);
                                        if(!empty($pc_preg[1][0])) {
                                            $productCategory = new \Admin\Model\Productc();
                                            $productCategory->setId($pc_preg[1][0]);
                                            $r = $productCategoryMapper->get($productCategory);
                                            if(!empty($r)) {
                                                $productCategory1 = new \Admin\Model\Productc();
                                                $productCategory1->setName($productCategory->getName());
                                                $productCategory1->setStoreId($newStoreId);
                                                $r = $productCategoryMapper->get($productCategory1);
                                                if(!empty($r)) {
                                                    $b['id'] = $productCategory1->getId();
                                                    $b['url'] = $productCategory1->getViewLink();
                                                }
                                            }
                                        }
                                        /*** Product ***/
                                        preg_match_all('/\-p(\d+)/', $b['url'], $p_preg);
                                        if(!empty($p_preg[1][0])) {
                                            $product = new \Admin\Model\Product();
                                            $product->setId($p_preg[1][0]);
                                            $r = $productMapper->get($product);
                                            if(!empty($r)) {
                                                $product1 = new \Admin\Model\Product();
                                                $product1->setTitle($product->getTitle());
                                                $product1->setStoreId($newStoreId);
                                                $r = $productMapper->get($product1);
                                                if(!empty($r)) {
                                                    $b['id'] = $product1->getId();
                                                    $b['url'] = $product1->getViewLink();
                                                }
                                            }
                                        }
                                        /*** Article ***/
                                        preg_match_all('/\-n(\d+)/', $b['url'], $a_preg);
                                        if(!empty($a_preg[1][0])) {
                                            $article = new \Admin\Model\Article();
                                            $article->setId($a_preg[1][0]);
                                            $ra = $articleMapper->get($article);
                                            if(!empty($ra)) {
                                                $article3 = new \Admin\Model\Article();
                                                $article3->setTitle($article->getTitle());
                                                $article3->setStoreId($newStoreId);
                                                $ra1 = $articleMapper->get($article3);
                                                if(!empty($ra1)) {
                                                    $b['id'] = $article3->getId();
                                                    $b['url'] = $article3->getViewLink();
                                                }
                                            }
                                        }
                                        /*** Page ***/
                                        $pageMapper = $sl->get('Admin\Model\PageMapper');
                                        preg_match_all('/\-pa(\d+)/', $b['url'], $pa_preg);
                                        if(!empty($pa_preg[1][0])) {
                                            $page = new \Admin\Model\Page();
                                            $page->setId($pa_preg[1][0]);
                                            $pa = $pageMapper->get($page);
                                            if(!empty($pa)) {
                                                $page1 = new \Admin\Model\Page();
                                                $page1->setName($page->getName());
                                                $page1->setStoreId($newStoreId);
                                                $pa1 = $pageMapper->get($page1);
                                                if(!empty($pa1)) {
                                                    $b['id'] = $page1->getId();
                                                    $b['url'] = $page1->getViewLink();
                                                }
                                            }
                                        }

                                        $c[$i] = $b;
                                    }
                                    $rop[$k] = $c;
                                }
                            } else {
                                $rop[$k] = $o;
                            }
                        }
                        $domain->setOptionPage(json_encode($rop));
                    }
                    $domainMapper->save($domain);
                }
            }

            /**** Created User ****/
            $userMapper = $this->getServiceLocator()->get('Admin\Model\UserMapper');
            $user = new \Admin\Model\User();
            $user->setStoreId($newStoreId);
            $user->setUsername($data['store']);

            $userGet = new \Admin\Model\User();
            $userGet->setEmail($data['email']);

            $rUG = $userMapper->get($userGet);

            if($data['email'] == 'contact.dweb.vn@gmail.com' || !empty($rUG)){
                $user->setEmail(null);
            } else {
                $user->setEmail($data['email']);
            }
            $user->setParentStore($rUG->getStoreId());
            $user->setMobile($data['phone']);
            $user->setRole(\Admin\Model\User::ROLE_ADMIN);
            $user->setCreatedDateTime(DateBase::getCurrentDateTime());
            $user->setActive(\Admin\Model\User::STATUS_ACTIVE);
            $user->setSalt(substr(md5(rand(2000, 5000) . time() . rand(2000, 5000)), 0, 20));
            $user->setPassword(md5($user->getSalt() . $data['password']));

            $authorize = $this->getServiceLocator()->get('Authorize\Service\Authorize');
            $listDependencies = $authorize->getAcl()->getDependencies();

            if(!empty($listDependencies)) {
                $d = [];
                foreach($listDependencies as $k => $v) {
                    if($k == 'Tài khoản') {
                        if(!empty($v)) {
                            $b = [];
                            foreach($v as $c) {
                                $b[$c] = $c;
                            }
                            $d['user'] = $b;
                        }
                    }
                    if($k == 'Trang') {
                        if(!empty($v)) {
                            $b = [];
                            foreach($v as $c) {
                                $b[$c] = $c;
                            }
                            $d['page'] = $b;
                        }
                    }
                    if($k == 'Cài đặt') {
                        if(!empty($v)) {
                            $b = [];
                            foreach($v as $c) {
                                $b[$c] = $c;
                            }
                            $d['setup'] = $b;
                        }
                    }
                    if($k == 'Hình Ảnh') {
                        if(!empty($v)) {
                            $b = [];
                            foreach($v as $c) {
                                $b[$c] = $c;
                            }
                            $d['media'] = $b;
                        }
                    }
                    if($k == 'Bài viết') {
                        if(!empty($v)) {
                            $b = [];
                            foreach($v as $c) {
                                $b[$c] = $c;
                            }
                            $d['article'] = $b;
                        }
                    }
                    if($k == 'Sản phẩm') {
                        if(!empty($v)) {
                            $b = [];
                            foreach($v as $c) {
                                $b[$c] = $c;
                            }
                            $d['product'] = $b;
                        }
                    }
                }

                $user->setDependencies(json_encode($d));
            }
            $userMapper->save($user);
$_SERVER['HTTP_HOST'] = $data['store'].'.dweb.vn/admin';
$serviceUser = $this->getServiceLocator()->get('User\Service\User');
            $serviceUser->authenticate($data['store'], $data['password']);

            function recurse_copy($src,$dst) {
                $dir = opendir($src);
                $oldmask = umask(0);
                mkdir($dst, 0777, true);
                umask($oldmask);

                while(false !== ( $file = readdir($dir)) ) {
                    if (( $file != '.' ) && ( $file != '..' )) {
                        if ( is_dir($src . '/' . $file) ) {
                            recurse_copy($src . '/' . $file,$dst . '/' . $file);
                        }
                        else {
                            copy($src . '/' . $file,$dst . '/' . $file);
                            chmod($dst . '/' . $file, fileperms($src . '/' . $file));
                        }
                    }
                }
                closedir($dir);
            }
            recurse_copy(UPLOAD_PATH . '/media/'.$cloneStoreId, UPLOAD_PATH . '/media/'.$newStoreId);

            $register = new \Home\Model\Register();
            $register->setKeyActive($name);
            $registerMapper = $sl->get('Home\Model\RegisterMapper');
            $r = $registerMapper->get($register);
            if(!empty($r)) {
                $register1 = new \Home\Model\Register();
                $register1->setId($register->getId());
                $registerMapper->delete($register1);
            }

            $to = 'no.reply.dweb@gmail.com';
            $body = '<div class="wrapper" style="padding: 0 30px 30px;color: #333;border: 2px solid #07aabe;">';
            $body .= '<p style="text-align: center;border-bottom: 1px solid #ececec;margin: 0 0 20px;padding: 15px 0 10px;"><img src="http://dweb.vn/logogmail.png" width="100px" /></p>';
            $body .= '<strong style="color: #333;">Đăng ký mới</strong>';
            $body .= '<p style="color: #333;"><strong>Tên miền: </strong>'.$data['store'].'.'.$_SERVER['HTTP_HOST'].'</p>';
            $body .= '<p style="color: #333;"><strong>Số điện thoại: </strong>'.$data['phone'].'</p>';
            $body .= '<p style="color: #333;"><strong>Ngày tạo: </strong>'.DateBase::getCurrentDateTime().'</p>';
            $body .= '</div>';

            $title = 'Email đăng ký mới - '.$data['store'].'.'.$_SERVER['HTTP_HOST'];
            $subject = 'Email đăng ký mới - '.$data['store'].'.'.$_SERVER['HTTP_HOST'];

            $options   = new SmtpOptions(array(
                'host'              => 'smtp.gmail.com',
                'connection_class'  => 'login',
                'connection_config' => array(
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
                ->setFrom($to, $title)
                ->setSubject($subject)
                ->setBody($body)
                ->setEncoding("UTF-8");
            $transport = new Mail\Transport\Smtp();
            $transport->setOptions($options);
            $transport->send($message);

            return new JsonModel(array(
                'code' => 1,
                'messenger' => 'Đã hoàn thành',
                'domain' => $data['store'].'.'.$_SERVER['HTTP_HOST'].'/admin'
            ));
        }

        $viewModel->setVariable('key', $name);
        return $viewModel;

    }

}