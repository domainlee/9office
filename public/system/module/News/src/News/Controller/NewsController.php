<?php
/**
 * News\Controller
 *
 * @news        Shop99 library
 * @copyright   http://shop99.vn
 * @license     http://shop99.vn/license
 */

namespace News\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use BlakeGardner\MacAddress;

class NewsController extends AbstractActionController
{

    public function indexAction()
    {
        /* @var $request \Zend\Http\Request */
        $request = $this->getRequest();
        $sl = $this->getServiceLocator();
        $storeId = $sl->get('Store\Service\Store')->getStoreId();

        $viewModel = new ViewModel();
        $options = [
            'page' => $request->getQuery('page'),
            'icpp' => 12,
        ];
        $tag = $request->getQuery('tag');
        $articleMapper = $sl->get('News\Model\ArticleMapper');

        $article = new \News\Model\Article();
        $article->setOptions($options);
        $article->setStoreId($storeId);

        if($tag) {
            $article->setTags($tag);
        }

        $paginator = $articleMapper->search($article);

        $viewModel->setVariable('tag', $tag);
        $viewModel->setVariable('paginator', $paginator);
        return $viewModel;
    }

    public function categoryAction()
    {
        /* @var $request \Zend\Http\Request */
        $request = $this->getRequest();
        $sl = $this->getServiceLocator();
        $storeId = $sl->get('Store\Service\Store')->getStoreId();
        $viewModel = new ViewModel();
        $category = new \News\Model\Category();
        $category->setId((int)trim($this->params('id')));
        $category->setStoreId($storeId);
        $category->setOptions(['childs' => true]);

        $u = $sl->get('User\Service\User');

        /* @var $categoryMapper \News\Model\CategoryMapper */
        $categoryMapper = $sl->get('News\Model\CategoryMapper');

        if (!!$category = $categoryMapper->get($category)) {
            $categoryMapper->fetchParent($category);
            $options = [
                'page' => $request->getQuery('page'),
                'icpp' => 12,
            ];

            /* @var $articleMapper \News\Model\ArticleMapper */
            $articleMapper = $sl->get('News\Model\ArticleMapper');
            /* @var $ps \News\Model\Article */

            $aIds = $category->getChildIds($category->getChilds());
            $aIds[] = $category->getId();
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


            $article = new \News\Model\Article();
            $article->setOptions($options);
            $article->setCategoryIds($aIds);
            $article->setStoreId($sl->get('Store\Service\Store')->getStoreId());
            $article->prepareSearch(null, $request);
            $paginator = $articleMapper->search($article);

            $viewModel->setVariable('breadcrumb', $breadcrumb);
            $viewModel->setVariable('category', $category);
            $viewModel->setVariable('request', $request);
            $viewModel->setVariable('paginator', $paginator);
            $viewModel->setVariable('user', $u->getUser());

        } else {
            $viewModel->setTemplate('error/404');
            return $viewModel;
        }
        if ($request->getPost('template')) {
            $viewModel->setTemplate($request->getPost('template'));
            $viewModel->setTerminal($request->getPost('terminal', false));
        }
        return $viewModel;
    }

    public function searchAction()
    {
        /* @var $request \Zend\Http\Request */
        $request = $this->getRequest();

        $sl = $this->getServiceLocator();

        $viewModel = new ViewModel();
        if (!($q = $request->getQuery('q')) || !$q) {
            $viewModel->setTemplate('error/404');
            return $viewModel;
        }
        /* @var $articleMapper \News\Model\ArticleMapper */
        $articleMapper = $sl->get('News\Model\ArticleMapper');

        $article = new \News\Model\Article();
        $article->setTitle($q);
        $article->setOptions(['page' => $request->getQuery('page'), 'icpp' => $request->getQuery('icpp')]);
        $article->setStoreId($sl->get('Store\Service\Store')->getStoreId());

        $viewModel->setVariable('q', $q);

        if ($request->getPost('template')) {
            $limit = $request->getQuery('limit');
            if ($limit) {
                $article->addOption('limit', $limit > 0 ? $limit : 20);
            }
            $articles = $articleMapper->search($article);
            $viewModel->setTemplate('news/news/' . $request->getPost('template'));
            $viewModel->setTerminal($request->getPost('terminal', false));

            $viewModel->setVariables([
                'articles' => $articles
            ]);
            return $viewModel;
        }

        $paginator = $articleMapper->search($article);
        $viewModel->setVariable('paginator', $paginator);

        return $viewModel;
    }

    public function viewAction()
    {

        $viewModel = new ViewModel();
        /* @var $mapper \News\Model\ArticleMapper */
        $mapper = $this->getServiceLocator()->get('News\Model\ArticleMapper');
        $id = (int)trim($this->params('id'));
        $storeId = $this->getServiceLocator()->get('Store\Service\Store')->getStoreId();
        $new = new \News\Model\Article();
        $new->setId($id);
        $new->setStoreId($storeId);

        if (!$news = $mapper->get($new)) {
            $viewModel->setTemplate('error/404');
            return $viewModel;
        }
        $category = new \News\Model\Category();
        $category->setId($news->getCategoryId());
        $category->setStoreId($storeId);

        /* @var $categoryMapper \News\Model\CategoryMapper */
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


        $article = new \Admin\Model\Article();
        $article->setId($id);
        $article->setStoreId($storeId);
        $articleMapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
        if($articleMapper->get($article)){
            $view = $article->getView() + 1;
            $article->setView($view);
            $articleMapper->save($article);
        }

//        $news->loadTranslates($news,\Website\Model\TranslateContent::TYPE_ARTILE, $news->getId());
        $viewModel->setVariables([
            'news'     => $news,
            'category' => $category,
            'breadcrumb' => $breadcrumb,
        ]);

        return $viewModel;
    }

    public function profiloAction()
    {
        $viewModel = new ViewModel();
        /* @var $mapper \News\Model\ArticleMapper */
        $mapper = $this->getServiceLocator()->get('News\Model\ArticleMapper');

        $new = new \News\Model\Article();
        $new->setId((int)trim($this->params('id')));

        if (!$news = $mapper->get($new)) {
            $viewModel->setTemplate('error/404');
            return $viewModel;
        }
        $category = new \News\Model\Category();
        $category->setId($news->getCategoryId());
        $category->setStoreId($this->getServiceLocator()->get('Store\Service\Store')->getStoreId());

        /* @var $categoryMapper \News\Model\CategoryMapper */
        $categoryMapper = $this->getServiceLocator()->get('News\Model\CategoryMapper');
        if ($category->getId() && $categoryMapper->get($category)) {
            $categoryMapper->fetchParent($category);
        }
//        $news->loadTranslates($news,\Website\Model\TranslateContent::TYPE_ARTILE, $news->getId());
        $viewModel->setVariables([
            'news'     => $news,
            'category' => $category
        ]);

        return $viewModel;
    }

    public function blogAction()
    {
        /* @var $request \Zend\Http\Request */
        $request = $this->getRequest();
        $sl = $this->getServiceLocator();
        $viewModel = new ViewModel();

        $category = new \News\Model\Category();
        $category->setStoreId($sl->get('Store\Service\Store')->getStoreId());
        $category->setOptions(['childs' => true]);
        /* @var $categoryMapper \News\Model\CategoryMapper */
        $categoryMapper = $sl->get('News\Model\CategoryMapper');
        if (!!$category = $categoryMapper->get($category)) {
            $categoryMapper->fetchParent($category);
            $options = [
                'page' => $request->getQuery('page'),
                'icpp' => 9,
            ];
            /* @var $articleMapper \News\Model\ArticleMapper */
            $articleMapper = $sl->get('News\Model\ArticleMapper');
            /* @var $ps \News\Model\Article */
            $article = new \News\Model\Article();

            $article->setOptions($options);
            $aIds = $category->getChildIds($category->getChilds());
            $aIds[] = $category->getId();
            $article->setCategoryIds($aIds);
            $article->setStoreId($sl->get('Store\Service\Store')->getStoreId());
            $paginator = $articleMapper->search($article);
            $viewModel->setVariable('category', $category);
            $viewModel->setVariable('paginator', $paginator);
        } else {
            $viewModel->setTemplate('error/404');
            return $viewModel;
        }
        return $viewModel;
    }

    public function blogviewAction()
    {
        $viewModel = new ViewModel();
        /* @var $mapper \News\Model\ArticleMapper */
        $new = new \News\Model\Article();
        $new->setId((int)trim($this->params('id')));

        $mapper = $this->getServiceLocator()->get('News\Model\ArticleMapper');
        if (!$news = $mapper->get($new)) {
            $viewModel->setTemplate('error/404');
            return $viewModel;
        }

        $category = new \News\Model\Category();
        $category->setId($news->getCategoryId());
        $category->setStoreId($this->getServiceLocator()->get('Store\Service\Store')->getStoreId());

        /* @var $categoryMapper \News\Model\CategoryMapper */
        $categoryMapper = $this->getServiceLocator()->get('News\Model\CategoryMapper');
        if ($category->getId() && $categoryMapper->get($category)) {
            $categoryMapper->fetchParent($category);
        }

//        $news->loadTranslates($news,\Website\Model\TranslateContent::TYPE_ARTILE, $news->getId());

        $viewModel->setVariables([
            'news'     => $news,
            'category' => $category
        ]);

        return $viewModel;
    }

    public function priceAction()
    {

    }

    public function themeAction()
    {
        /* @var $request \Zend\Http\Request */
        $request = $this->getRequest();
        $sl = $this->getServiceLocator();
        $u = $sl->get('User\Service\User');

        $viewModel = new ViewModel();
        $options = [
            'page' => $request->getQuery('page'),
            'icpp' => 12,
        ];
        /* @var $articleMapper \News\Model\ArticleMapper */
        $articleMapper = $sl->get('News\Model\ArticleMapper');
        /* @var $ps \News\Model\Article */
        $article = new \News\Model\Article();
        $article->setOptions($options);
        $article->setStoreId($sl->get('Store\Service\Store')->getStoreId());
        $article->prepareSearch(null, $request);
        $paginator = $articleMapper->search($article);

        $viewModel->setVariable('request', $request);
        $viewModel->setVariable('paginator', $paginator);
        $viewModel->setVariable('user', $u->getUser());

        return $viewModel;
    }

    public function demoAction()
    {
        $this->layout('layout/demo');

        $viewModel = new ViewModel();
        /* @var $mapper \News\Model\ArticleMapper */
        $mapper = $this->getServiceLocator()->get('News\Model\ArticleMapper');
        $id = (int)trim($this->params('id'));
        $storeId = $this->getServiceLocator()->get('Store\Service\Store')->getStoreId();
        $new = new \News\Model\Article();
        $new->setId($id);
        $new->setStoreId($storeId);

        if (!$news = $mapper->get($new)) {
            $viewModel->setTemplate('error/404');
            return $viewModel;
        }
        $category = new \News\Model\Category();
        $category->setId($news->getCategoryId());
        $category->setStoreId($storeId);

        /* @var $categoryMapper \News\Model\CategoryMapper */
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


        $article = new \Admin\Model\Article();
        $article->setId($id);
        $article->setStoreId($storeId);
        $articleMapper = $this->getServiceLocator()->get('Admin\Model\ArticleMapper');
        if($articleMapper->get($article)){
            $view = $article->getView() + 1;
            $article->setView($view);
            $articleMapper->save($article);
        }

//        $news->loadTranslates($news,\Website\Model\TranslateContent::TYPE_ARTILE, $news->getId());

        $viewModel->setVariables([
            'news'     => $news,
            'category' => $category,
            'breadcrumb' => $breadcrumb,
        ]);

        return $viewModel;
    }


}