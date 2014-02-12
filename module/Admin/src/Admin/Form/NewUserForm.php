<?php

namespace Admin\Form;
 
use Zend\Form\Form;
 
class NewUserForm extends Form
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ENABLED_SUSPENDED = 0;    
    const ENABLED_ACTIVE = 1;

    public static $allowedRoles = array(
        self::ROLE_USER => self::ROLE_USER,
        self::ROLE_ADMIN => self::ROLE_ADMIN,
    );
    
    public static $allowedEnabledStates = array(
        self::ENABLED_ACTIVE => 'active',
        self::ENABLED_SUSPENDED => 'suspended',
    );    

    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('user');
        
        $this->setAttribute('method', 'post');
        
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'email',
            ),
            'options' => array(
                'label' => 'Email',
            ),
        ));
        
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type'  => 'password',
            ),
            'options' => array(
                'label' => 'Password',
            ),
        ));
        
        $this->add(array(
            'name' => 'role',
            'type'  => 'select',
            'options' => array(
                'label' => 'Select user role',
                'value_options' => self::$allowedRoles
            )
        ));    
        
        $this->add(array(
            'name' => 'enabled',
            'type'  => 'select',
            'options' => array(
                'label' => 'Select user status',
                'value_options' => self::$allowedEnabledStates
            )
        ));         
        
        $this->add(array(
            'name' => 'firstname',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'First Name',
            ),
        ));
        
        $this->add(array(
            'name' => 'lastname',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Last Name',
            ),
        ));        
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add',
                'id' => 'submitbutton',
            ),
        ));
    }
}