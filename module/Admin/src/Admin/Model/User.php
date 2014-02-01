<?php

namespace Admin\Model;

class User
{

    public $id;
    public $username;
    public $email;
    public $enabled;
    public $salt;
    public $password;
    public $last_login;
    public $roles;
    public $firstname;
    public $lastname;
    public $created_at;
    
    public function exchangeArray(array $data)
    {
        $userProperties = array_keys(get_class_vars(__CLASS__));
        
        foreach ($userProperties as $userProperty) {
            $this->{$userProperty} = isset($data[$userProperty]) 
                ? $data[$userProperty] 
                : null;
        }

    }
    

}
