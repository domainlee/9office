<?php
/**
 * Home\View\Helper\Home
 *
 * @category    Shop99 library
 * @copyright   http://shop99.vn
 * @license     http://shop99.vn/license
 */

namespace Home\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class Home
 * @package Media\View\Helper
 */
class Home extends AbstractHelper
{

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     */
    public function __construct($serviceLocator)
    {
        $this->setServiceLocator($serviceLocator);
    }

    public function getImages($option = null)
    {
        if(!isset($option)){
            return null;
        }
        /* @var $CategoryMapper \Home\Model\MediaItemMapper */

        $mediaItemMapper = $this->getServiceLocator()->get('Home\Model\MediaItemMapper');
        $mediaItem = new \Home\Model\MediaItem();
        $mediaItem->setItemId($option['id']);
        $mediaItem->setType($option['type']);
        if($mediaItemMapper->get($mediaItem)){
            return $mediaItemMapper->get($mediaItem);
        }
        return null;
    }

    public function getLike($option = null)
    {
        if(!isset($option)){
            return null;
        }
        /* @var $CategoryMapper \Home\Model\MediaItemMapper */
        $likeMapper = $this->getServiceLocator()->get('Home\Model\LikeMapper');
        $like = new \Home\Model\Like();
        $like->setItemId($option['id']);
        $like->setType($option['type']);
        return $likeMapper->get($like);
    }

    public function getBanner($option = null)
    {
        if(!isset($option['positionId'])){
            return null;
        }
        $bannerMapper = $this->getServiceLocator()->get('Home\Model\BannerMapper');
        $storeId = $this->getServiceLocator()->get('Store\Service\Store')->getStoreId();
        $banner = new \Home\Model\Banner();
        $banner->setPositionId($option['positionId']);
        $banner->setStoreId($storeId);
        return $bannerMapper->fetchAll($banner);
    }

    public function getAttr($option = null)
    {
        if(!isset($option['id']) && !isset($option['type']) && !isset($option['group'])){
            return null;
        }
        $sl = $this->getServiceLocator();
        $storeService = $sl->get('Store\Service\Store');
        $sto = $storeService->getStoreId();

        $AttrListMapper = $this->getServiceLocator()->get('Home\Model\ProductAttrListMapper');
        $attr = new \Home\Model\ProductAttrList();
        $attr->setStoreId($sto);

        if(isset($option['id'])){
            $attr->setProductId($option['id']);
        }
        if(isset($option['type'])){
            $attr->setType($option['type']);
        }
        if(isset($option['group'])){
            $attr->addOption('group', true);
        }

        return $AttrListMapper->get($attr);
    }

    public function getMenu()
    {
        $menuMapper = $this->getServiceLocator()->get('Home\Model\MenuMapper');
        $storeId = $this->getServiceLocator()->get('Store\Service\Store')->getStoreId();
        $menu = new \Home\Model\Menu();
        $menu->setStoreId($storeId);
        $r = $menuMapper->fetchAll($menu);
        if(!empty($r)) {
            $m = [];
            foreach($r as $mm) {
                $m[$mm->getNameKey()] = json_decode($mm->getMenu(), true);
            }
            return $m;
        }
    }

    public function optionPage($store = null)
    {
        $sl = $this->getServiceLocator();
        $storeService = $sl->get('Store\Service\Store');
        $uiTemplate = $storeService->getUitemplate();
        $sto = $store ? $store : $storeService->getStoreId();
        $idTemplate = $uiTemplate->getId();

        $domainMapper = $sl->get('Store\Model\DomainMapper');

        $storeDomain = new \Store\Model\Domain();
        if(empty($store)){
            $storeDomain->setUitemplate($idTemplate);
        }
        $storeDomain->setStoreId($sto);
//        print_r($storeDomain);die;
        $domainMapper->get($storeDomain);
        $value = json_decode($storeDomain->getOptionPage(), true);
//        print_r($value);die;
        return $value;
    }

    public function homePage()
    {
        $sl = $this->getServiceLocator();
        $storeService = $sl->get('Store\Service\Store');
        $uiTemplate = $storeService->getUitemplate();
        $sto = $storeService->getStoreId();
        $idTemplate = $uiTemplate->getId();

        $domainMapper = $this->getServiceLocator()->get('Store\Model\DomainMapper');

        $storeDomain = new \Store\Model\Domain();
        $storeDomain->setUitemplate($idTemplate);
        $storeDomain->setStoreId($sto);
        $domainMapper->get($storeDomain);
        $value = json_decode($storeDomain->getHomePage(), true);
        return $value;
    }

    public function rating($itemId, $type)
    {
        $sl = $this->getServiceLocator();
        $storeService = $sl->get('Store\Service\Store');
        $storeId = $storeService->getStoreId();

        $ratingMapper = $sl->get('Home\Model\RatingMapper');

        $rating = new \Home\Model\Rating();
        $rating->setStoreId($storeId);
        $rating->setType($type);
        $rating->setItemId($itemId);
        $r = $ratingMapper->report($rating, 5);
        return $r;
    }

    public function countRating($itemId, $type)
    {
        $sl = $this->getServiceLocator();
        $storeService = $sl->get('Store\Service\Store');
        $storeId = $storeService->getStoreId();

        $ratingMapper = $sl->get('Home\Model\RatingMapper');

        $rating = new \Home\Model\Rating();
        $rating->setStoreId($storeId);
        $rating->setType($type);
        $rating->setItemId($itemId);

        $r = $ratingMapper->count($rating);
        return $r;
    }

    public function optionBasic()
    {
        $sl = $this->getServiceLocator();
        $storeService = $sl->get('Store\Service\Store');
        $sto = $storeService->getStoreId();
        $optionMapper = $this->getServiceLocator()->get('Home\Model\OptionMapper');
        $option = new \Home\Model\Option();
        $option->setStoreId($sto);
        $optionMapper->get($option);
        $value = json_decode($option->getData(), true);
        return $value;
    }

    public function listcomment($itemId, $type)
    {
        $sl = $this->getServiceLocator();
        $storeService = $sl->get('Store\Service\Store');
        $storeId = $storeService->getStoreId();
        $comment = new \Admin\Model\Comment();
        $comment->setStoreId($storeId);
        $comment->setItemId($itemId);
        $comment->setType($type);

        $commentMapper = $sl->get('Admin\Model\CommentMapper');
        $r = $commentMapper->fetchAll($comment);
        return $r;
    }


    public function getMcaName($name = 'module')
    {
        $routeMatch = $this->getServiceLocator()->get('Application')->getMvcEvent()->getRouteMatch();
        if ($routeMatch) {
            if($name == 'module' || $name == 'controller') {
                $mc = explode("\\", $routeMatch->getParam('controller'));
                if($name == 'module') {
                    return strtolower($mc[0]);
                }
                return strtolower($mc[2]);
            }
            return strtolower($routeMatch->getParam('action', 'index'));
        }
    }

    public function storeId()
    {
        $storeId = $this->getServiceLocator()->get('Store\Service\Store')->getStoreId();
        return $storeId;
    }

    public function getUser()
    {
        $serviceUser = $this->getServiceLocator()->get('User\Service\User');
        return $serviceUser->getUser();
    }

    public function getDomain() {
        $serviceUser = $this->getServiceLocator()->get('User\Service\User');
        $storeId = $serviceUser->getUser()->getStoreId();
        $domainMapper = $this->getServiceLocator()->get('Admin\Model\DomainMapper');
        $domain = new \Admin\Model\Domain();
        $domain->setStoreId($storeId);
        $rd = $domainMapper->get($domain);
        return $rd->getName() ? $rd->getName():$rd->getAlias();
    }

}