<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace SearchSites\Controller;

use SearchSites\Form\SearchSitesForm;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SearchController extends AbstractActionController
{
    public function indexAction()
    {
        $form = new SearchSitesForm();
        $form->get('submit')->setValue('Search');

        /* @var $request \Zend\Http\Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
//            $user = new User();
//            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                if (empty($request->getPost()['fieldset'])) {
                    throw new \LogicException('An error occurred in the set of parameters');
                }
                $className = '\SearchSites\SearchProcessor\SearchType\\' 
                    . $request->getPost()['fieldset']['search_option'];
                $searchType = new $className($request->getPost()['fieldset']);
                var_dump($searchType->performSearching()); die;
                $user->exchangeArray($form->getData());

                $this->getUserTable()->saveUser($user);

                // Redirect to list of users
                return $this->redirect()->toRoute('admin');
            }
        }
        
        return array('form' => $form);
    }
}
