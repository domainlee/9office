<?php
namespace Product\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class ProductController extends AbstractActionController{

	public function indexAction(){

//        $cache = $this->getServiceLocator()->get('cache');
//        // set unique Cache key
//        $key    = 'unique-cache-key';
//        // get the Cache data
//        $success = 'domainlee';
//
//        $result = $cache->getItem($key, $success);
//        if (!$success) {
//            // if not set the data for next request
//            $result = 'data 1';
//            $cache->setItem($key, $result);
//        }
//        // result
//        echo $result;
//        die;
//
//        return new ViewModel();
        $request = $this->getRequest();
        $sl = $this->getServiceLocator();
        $storeId = $this->getServiceLocator()->get('Store\Service\Store')->getStoreId();
        $productMapper = $sl->get('Product\Model\ProductMapper');

        $viewModel = new ViewModel();
        $options = [
            'page' => $request->getQuery('page'),
            'icpp' => 18,
        ];
        $product = new \Product\Model\Product();
        $product->setOptions($options);
        $product->setStoreId($storeId);
        $tag = $request->getQuery('tag');
        if($tag) {
            $product->setTags($tag);
        }
        if($request->getQuery('color')){
            if(is_numeric($request->getQuery('color'))){
                $product->addOption('color', $request->getQuery('color'));
                $viewModel->setVariable('requestColor', $request->getQuery('color'));
            }
        }
        if($request->getQuery('size')){
            if(is_numeric($request->getQuery('size'))){
                $product->addOption('size', $request->getQuery('size'));
                $viewModel->setVariable('requestSize', $request->getQuery('size'));
            }
        }
        if($request->getQuery('show')){
            if(in_array($request->getQuery('show'), ['priceAsc','priceDesc','SaleOff'])){
                $product->addOption('show', $request->getQuery('show'));
            }
        }
        $variables = $product->prepareSearch(null, $request);
        $paginator = $productMapper->search($product);

        $viewModel->setVariable('request', $request);
        $viewModel->setVariable('tag', $tag);
        $viewModel->setVariables($variables);
        $viewModel->setVariable('paginator', $paginator);

        return $viewModel;
	}

    public function categoryAction()
    {
        $request = $this->getRequest();
        $sl = $this->getServiceLocator();
        $storeId = $this->getServiceLocator()->get('Store\Service\Store')->getStoreId();
        $categoryMapper = $sl->get('Product\Model\CategoryMapper');
        $productMapper = $sl->get('Product\Model\ProductMapper');

        $viewModel = new ViewModel();

        $category = new \Product\Model\Category();
        $category->setId(trim($this->params('id')));
        $category->setStoreId($storeId);
        $category->setOptions(['childs' => true]);

        $categoryMapper->get($category);
        $ids = $category->getChildIds($category->getChilds());
        $ids[] = $category->getId();
        $options = [
            'page' => $request->getQuery('page'),
            'icpp' => 12,
        ];


        $product = new \Product\Model\Product();
        $product->setCategoryId($ids);
        $product->setOptions($options);
        $product->setStoreId($storeId);

        if($request->getQuery('color')){
            if(is_numeric($request->getQuery('color'))){
                $product->addOption('color', $request->getQuery('color'));
                $viewModel->setVariable('requestColor', $request->getQuery('color'));
            }
        }
        if($request->getQuery('size')){
            if(is_numeric($request->getQuery('size'))){
                $product->addOption('size', $request->getQuery('size'));
                $viewModel->setVariable('requestSize', $request->getQuery('size'));
            }
        }
        if($request->getQuery('show')){
            if(in_array($request->getQuery('show'), ['priceAsc','priceDesc','SaleOff'])){
                $product->addOption('show', $request->getQuery('show'));
            }
        }


        $variables = $product->prepareSearch(null, $request);
        $paginator = $productMapper->search($product);
        $viewModel->setVariable('request', $request);
        $viewModel->setVariables($variables);
        $viewModel->setVariable('category', $category);
        $viewModel->setVariable('paginator', $paginator);

        return $viewModel;
    }

	public function viewAction()
    {
        $viewModel = new ViewModel();

        $model = new \Product\Model\Product();
        $id = trim($this->params('id'));
        $name = trim($this->params('name'));
        if($id) {
            $model->setId($id);
        } else {
            $model->setUrl($name);
        }
		$mapper = $this->getServiceLocator()->get('Product\Model\ProductMapper');
		$request = $this->getRequest();
        $storeId = $this->getServiceLocator()->get('Store\Service\Store')->getStoreId();
		$model->setStoreId($storeId);
        $results = $mapper->getId($model);

        $category = new \Product\Model\Category();
        $category->setId($results->getCategoryId());
        $category->setStoreId($storeId);
        $mapper = $this->getServiceLocator()->get('Product\Model\CategoryMapper');
        $c = $mapper->get($category);
        $mediaItemMapper = $this->getServiceLocator()->get('Home\Model\MediaItemMapper');
        $mediaItem = new \Home\Model\MediaItem();
        $mediaItem->setItemId($model->getId());
        $mediaItem->setType(\Home\Model\MediaItem::FILE_PRODUCT);
        $images = $mediaItemMapper->get($mediaItem);

        $viewModel->setVariables(array(
            'results' => $results,
            'category' => $c,
            'images' => $images,
        ));

        $product = new \Admin\Model\Product();
        $product->setId($id);
        $product->setStoreId($storeId);
        $productMapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');
        if($productMapper->get($product)){
            $view = $product->getView()+1;
            $product->setView($view);
            $productMapper->save($product);
        }

        return $viewModel;
	}

    public function viewallAction()
    {
        $viewModel = new ViewModel();
        $id = trim($this->params('id'));
        $name = trim($this->params('name'));
        $request = $this->getRequest();

        /******* Product ********/
        $product = new \Product\Model\Product();
        $product->setUrl($name);
        $productMapper = $this->getServiceLocator()->get('Product\Model\ProductMapper');
        $storeId = $this->getServiceLocator()->get('Store\Service\Store')->getStoreId();
        $product->setStoreId($storeId);
        $results = $productMapper->getId($product);

        /******* Page ********/
        $articleMapper = $this->getServiceLocator()->get('News\Model\ArticleMapper');
        $article = new \News\Model\Article();
        $article->setUrl($name);
        $article->setStoreId($storeId);
        $rArticle  = $articleMapper->get($article);

        /******* Page ********/
        $pageMapper = $this->getServiceLocator()->get('Home\Model\PageMapper');
        $page = new \Home\Model\Page();
        $page->setUrl($name);
        $page->setStoreId($storeId);
        $rPage  = $pageMapper->get($page);

        if($results) {
            $productCategory = new \Product\Model\Category();
            $productCategory->setId($results->getCategoryId());
            $productCategory->setStoreId($storeId);
            $categoryProductMapper = $this->getServiceLocator()->get('Product\Model\CategoryMapper');
            $c = $categoryProductMapper->get($productCategory);
            $mediaItemMapper = $this->getServiceLocator()->get('Home\Model\MediaItemMapper');
            $mediaItem = new \Home\Model\MediaItem();
            $mediaItem->setItemId($product->getId());
            $mediaItem->setType(\Home\Model\MediaItem::FILE_PRODUCT);
            $images = $mediaItemMapper->get($mediaItem);

            $viewModel->setTemplate('product/product/view');
            $viewModel->setVariables(array(
                'results' => $results,
                'category' => $c,
                'images' => $images,
            ));

            $productView = new \Admin\Model\Product();
            $productView->setUrl($name);
            $productView->setStoreId($storeId);
            $productMapper = $this->getServiceLocator()->get('Admin\Model\ProductMapper');
            if($productMapper->get($productView)){
                $view = $product->getView()+1;
                $productView->setView($view);
                $productMapper->save($productView);
            }
            return $viewModel;
        } elseif ($rArticle) {
            $category = new \News\Model\Category();
            $category->setId($rArticle->getCategoryId());
            $category->setStoreId($storeId);
            $categoryMapper = $this->getServiceLocator()->get('News\Model\CategoryMapper');
            if ($category->getId() && $categoryMapper->get($category)) {
                $categoryMapper->fetchParent($category);
            }

            $breadcrumb = [];
            $breadcrumb[] = ['id' => $category->getId(), 'url' => $category->getViewLink(), 'name' => $category->getName()];

            if(!empty($category->getParentId())) {
                $category1 = new \News\Model\Category();
                $category1->setStoreId($storeId);
                $category1->setId((int)$category->getParentId());
                $categoryMapper->get($category1);
                $breadcrumb[] = ['id' => $category1->getId(), 'url' => $category1->getViewLink(), 'name' => $category1->getName()];

                if(!empty($category1->getParentId())) {
                    $category2 = new \News\Model\Category();
                    $category2->setStoreId($storeId);
                    $category2->setId((int)$category1->getParentId());
                    $categoryMapper->get($category2);
                    $breadcrumb[] = ['id' => $category2->getId(), 'url' => $category2->getViewLink(), 'name' => $category2->getName()];
                }
                if(isset($category2)) {
                    if(!empty($category2->getParentId())){
                        $category3 = new \News\Model\Category();
                        $category3->setStoreId($storeId);
                        $category3->setId((int)$category2->getParentId());
                        $categoryMapper->get($category3);
                        $breadcrumb[] = ['id' => $category3->getId(), 'url' => $category3->getViewLink(), 'name' => $category3->getName()];
                    }
                }
            }
            $articleView = new \Admin\Model\Article();
            $articleView->setUrl($name);
            $articleView->setStoreId($storeId);
            $articleMapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
            if($articleMapper->get($articleView)){
                $view = $articleView->getView() + 1;
                $articleView->setView($view);
                $articleMapper->save($articleView);
            }
            $viewModel->setTemplate('news/news/view');
            $viewModel->setVariables([
                'news'     => $rArticle,
                'category' => $category,
                'breadcrumb' => $breadcrumb,
            ]);
            return $viewModel;
        } elseif ($rPage) {
            $pageMapper = $this->getServiceLocator()->get('Home\Model\PageMapper');
            $page = new \Home\Model\Page();
            $page->setUrl($name);
            $page->setStoreId($storeId);
            $pages = $pageMapper->get($page);
            if($pages->getPageTemplate()) {
                $viewModel->setTemplate('home/page/'.$pages->getPageTemplate());
            } else {
                $viewModel->setTemplate('home/page/index');
            }
            $viewModel->setVariables([
                'page' => $pages,
            ]);
            return $viewModel;
        } else {
            $viewModel->setTemplate('error/404');
        }


    }



}















