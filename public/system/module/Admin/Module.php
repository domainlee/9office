<?php
/**
 * @category   	DWEB.VN library
 * @copyright  	http://dweb.vn
 * @license    	http://dweb.vn/license
 */

namespace Admin;



class Module {

	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}



	public function getAutoloaderConfig() {
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}
	public function getServiceConfig()
	{
		return array(
				'invokables' => array(
						'Admin\Model\Article' => 'Admin\Model\Article',
						'Admin\Model\ArticleMapper' => 'Admin\Model\ArticleMapper',
						'Admin\Form\Article' => 'Admin\Form\Article',
						'Admin\Form\ArticleFilter' => 'Admin\Form\ArticleFilter',
						'Admin\Form\ArticleSearch' => 'Admin\Form\ArticleSearch',
						'Admin\Form\Upload' => 'Admin\Form\Upload',
						'Admin\Form\UploadFilter' => 'Admin\Form\UploadFilter',
						
						'Admin\Model\Articlec' => 'Admin\Model\Articlec',
						'Admin\Model\ArticlecMapper' => 'Admin\Model\ArticlecMapper',
						'Admin\Form\Articlec' => 'Admin\Form\Articlec',
						'Admin\Form\ArticlecFilter' => 'Admin\Form\ArticlecFilter',
						'Admin\Form\ArticlecSearch' => 'Admin\Form\ArticlecSearch',
                        'Admin\Form\OrderSearch' => 'Admin\Form\OrderSearch',

                        'Admin\Model\Invoice' => 'Admin\Model\Invoice',
                        'Admin\Model\InvoiceMapper' => 'Admin\Model\InvoiceMapper',
                        'Admin\Model\ProductMaterial' => 'Admin\Model\ProductMaterial',
                        'Admin\Model\ProductMaterialItem' => 'Admin\Model\ProductMaterialItem',
                        'Admin\Model\ProductMaterialMapper' => 'Admin\Model\ProductMaterialMapper',
                        'Admin\Model\ProductMaterialItemMapper' => 'Admin\Model\ProductMaterialItemMapper',

                        'Admin\Model\Manufacture' => 'Admin\Model\Manufacture',
                        'Admin\Model\ManufactureMapper' => 'Admin\Model\ManufactureMapper',
                        'Admin\Model\Material' => 'Admin\Model\Material',
                        'Admin\Model\MaterialMapper' => 'Admin\Model\MaterialMapper',

                        'Admin\Model\OrderManufacture' => 'Admin\Model\OrderManufacture',
                        'Admin\Model\OrderManufactureMapper' => 'Admin\Model\OrderManufactureMapper',

                        'Admin\Model\InvoiceMaterial' => 'Admin\Model\InvoiceMaterial',
                        'Admin\Model\InvoiceMaterialMapper' => 'Admin\Model\InvoiceMaterialMapper',
                        'Admin\Form\Invoice' => 'Admin\Form\Invoice',

                        'Admin\Model\Product' => 'Admin\Model\Product',
						'Admin\Model\ProductMapper' => 'Admin\Model\ProductMapper',
						'Admin\Form\Product' => 'Admin\Form\Product',
						'Admin\Form\ProductFilter' => 'Admin\Form\ProductFilter',
						'Admin\Form\ProductSearch' => 'Admin\Form\ProductSearch',

                        'Admin\Form\Media' => 'Admin\Form\Media',
                        'Admin\Form\MediaFilter' => 'Admin\Form\MediaFilter',
						
						'Admin\Model\Productc' => 'Admin\Model\Productc',
						'Admin\Model\ProductcMapper' => 'Admin\Model\ProductcMapper',
						'Admin\Form\Productc' => 'Admin\Form\Productc',
						'Admin\Form\ProductcFilter' => 'Admin\Form\ProductcFilter',
						'Admin\Form\ProductcSearch' => 'Admin\Form\ProductcSearch',
						'Admin\Form\OrderTwoSearch' => 'Admin\Form\OrderTwoSearch',


						'Admin\Model\Banner' => 'Admin\Model\Banner',
						'Admin\Model\BannerMapper' => 'Admin\Model\BannerMapper',
						'Admin\Form\Banner' => 'Admin\Form\Banner',
						'Admin\Form\BannerFilter' => 'Admin\Form\BannerFilter',
						'Admin\Form\BannerSearch' => 'Admin\Form\BannerSearch',

						'Admin\Model\Position' => 'Admin\Model\Position',
						'Admin\Model\PositionMapper' => 'Admin\Model\PositionMapper',
						'Admin\Form\Position' => 'Admin\Form\Position',
						'Admin\Form\PositionFilter' => 'Admin\Form\PositionFilter',
						'Admin\Form\PositionSearch' => 'Admin\Form\PositionSearch',
						
						'Admin\Model\Store' => 'Admin\Model\Store',
						'Admin\Model\StoreMapper' => 'Admin\Model\StoreMapper',
						'Admin\Form\Store' => 'Admin\Form\Store',
						'Admin\Form\StoreFilter' => 'Admin\Form\StoreFilter',
						'Admin\Form\StoreSearch' => 'Admin\Form\StoreSearch',
						
						'Admin\Model\Color' => 'Admin\Model\Color',
						'Admin\Model\ColorMapper' => 'Admin\Model\ColorMapper',
						'Admin\Form\Color' => 'Admin\Form\Color',
						'Admin\Form\ColorFilter' => 'Admin\Form\ColorFilter',
						
						'Admin\Model\Order' => 'Admin\Model\Order',
						'Admin\Model\OrderMapper' => 'Admin\Model\OrderMapper',
						'Admin\Form\Order' => 'Admin\Form\Order',
						'Admin\Form\OrderFilter' => 'Admin\Form\OrderFilter',

						'Admin\Model\OrderProduct' => 'Admin\Model\OrderProduct',
						'Admin\Model\OrderProductMapper' => 'Admin\Model\OrderProductMapper',
                        'Admin\Model\AttrMapper' => 'Admin\Model\AttrMapper',
                        'Admin\Model\AttrListMapper' => 'Admin\Model\AttrListMapper',

                        'Admin\Model\TagMapper' => 'Admin\Model\TagMapper',
                        'Admin\Model\ItemTagMapper' => 'Admin\Model\ItemTagMapper',

                        'Admin\Model\MediaMapper' => 'Admin\Model\MediaMapper',
                        'Admin\Model\MediaItemMapper' => 'Admin\Model\MediaItemMapper',

                        'Admin\Model\PageMapper' => 'Admin\Model\PageMapper',
                        'Admin\Model\MenuMapper' => 'Admin\Model\MenuMapper',
                        'Admin\Model\BrandMapper' => 'Admin\Model\BrandMapper',
                        'Admin\Model\UserMapper' => 'Admin\Model\UserMapper',
                        'Admin\Form\ForgotPassword' => 'Admin\Form\ForgotPassword',
                        'Admin\Model\Option' => 'Admin\Model\Option',
                        'Admin\Model\OptionMapper' => 'Admin\Model\OptionMapper',
                        'Admin\Model\DomainMapper' => 'Admin\Model\DomainMapper',
                        'Admin\Model\TemplateMapper' => 'Admin\Model\TemplateMapper',
                        'Admin\Form\Website' => 'Admin\Form\Website',
                        'Admin\Model\ContactMapper' => 'Admin\Model\ContactMapper',
                        'Admin\Model\ClientMapper' => 'Admin\Model\ClientMapper',
                        'Admin\Model\QuestionMapper' => 'Admin\Model\QuestionMapper',
                        'Admin\Model\CommentMapper' => 'Admin\Model\CommentMapper',
                ),
					
		);
	}
}