<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    
    protected $userTable;

    public function indexAction()
    {
        phpinfo(); die;
        return new ViewModel(array(
            'users' => $this->getUserTable()->fetchAll()
        ));        
    }
    
    public function addAction()
    {
        
    }
    
    public function aditAction()
    {
        
    }
    
    public function deleteAction()
    {
        
    }
    
    public function getUserTable()
    {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Admin\Model\UserTable');
        }
        
        return $this->userTable;
    }
}
