<?php
/**
 * @category    Shop99 library
 * @copyright    http://shop99.vn
 * @license        http://shop99.vn/license
 */

namespace Home;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $serviceManager = $e->getApplication()->getServiceManager();
        // Tập hợp toàn bộ các ngôn ngữ trên site
        $langArr = array(
            'vi' => 'vi_VN', // tiếng việt
            'en' => 'en_US' // tiếng anh
        );

        // 1. Trường hợp lấy từ $_GET với tham số lang. Example : http://example.com/?lang=vi
        $codeLang = isset($_GET['lang']) ? $_GET['lang'] : 'vi';
//        echo $codeLang;die;
        // Đối tượng ngôn ngữ mặc định trong hệ thống zend 2
        $translateObj = $serviceManager->get('MvcTranslator');
        $translateObj->setLocale($langArr[$codeLang]);
    }

    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'Home\Form\Upload' => 'Home\Form\Upload',
                'Home\Form\UploadFilter' => 'Home\Form\UploadFilter',
                'Home\Model\Contact' => 'Home\Model\Contact',
                'Home\Model\ContactMapper' => 'Home\Model\ContactMapper',
                'Home\Model\Base' => 'Home\Model\Base',
                'Home\Model\BaseMapper' => 'Home\Model\BaseMapper',
                'Home\Model\MediaMapper' => 'Home\Model\MediaMapper',
                'Home\Model\MediaItemMapper' => 'Home\Model\MediaItemMapper',
                'Home\Model\LikeMapper' => 'Home\Model\LikeMapper',
                'Home\Model\BannerMapper' => 'Home\Model\BannerMapper',
                'Home\Model\ProductAttrListMapper' => 'Home\Model\ProductAttrListMapper',
                'Home\Model\ProductAttrMapper' => 'Home\Model\ProductAttrMapper',
                'Home\Model\PageMapper' => 'Home\Model\PageMapper',
                'Home\Model\MenuMapper' => 'Home\Model\MenuMapper',
                'Home\Form\Contact' => 'Home\Form\Contact',
                'Home\Form\ContactPhone' => 'Home\Form\ContactPhone',
                'Home\Model\RegisterMapper' => 'Home\Model\RegisterMapper',
                'Home\Model\OptionMapper' => 'Home\Model\OptionMapper',
                'Home\Model\RatingMapper' => 'Home\Model\RatingMapper',
            ),
        );
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            )
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'Home\View\Helper\HomeFactory' => 'Home\View\Helper\HomeFactory',
            ),
            'factories' => array(
                'home' => 'Home\View\Helper\HomeFactory',
            )
        );
    }
}