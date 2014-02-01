<?php

namespace AdminTest\Model;

use Admin\Model\User;
use PHPUnit_Framework_TestCase;

class UserTest extends PHPUnit_Framework_TestCase
{
    /**
     * Returns User instance
     * 
     * @return \Admin\Model\User
     */
    public function testObjectUserCanBeConstructed()
    {
        $user = new User();

        $this->assertInstanceOf('Admin\\Model\\User', $user);

        return $user;
    }    

    /**
     * @depends testObjectUserCanBeConstructed
     */
    public function testUserInitialState(User $user)
    {
        // WHEN
        $userProperties = array_keys(get_object_vars($user));
        
        // THEN
        foreach ($userProperties as $publicProp) {
            $this->assertNull($user->{$publicProp});
        }
    }
    
    /**
     * @covers  \Admin\Model\User::exchangeArray
     * 
     * @depends testObjectUserCanBeConstructed
     */        
    public function testExchangeArraySetsPropertiesCorrectly(User $user)
    {
        // GIVEN
        $data = $this->getDataArray();
        
        // WHEN
        $user->exchangeArray($data);
        
        // THEN
        foreach ($data as $key => $value) {
            $this->assertSame($data[$key], $user->{$key});
        }
    }
 
    /**
     * @covers  \Admin\Model\User::exchangeArray
     * 
     * @depends testObjectUserCanBeConstructed 
     */
    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent(User $user)
    {
        // GIVEN
        $user->exchangeArray($this->getDataArray());
        
        // WHEN
        $user->exchangeArray(array());
        
        // THEN
        $this->testUserInitialState($user);
    }  
    
    /**
     * Array data for testing purposes
     * 
     * @return array
     */
    private function getDataArray()
    {
        return array(
            'id' => 122,
            'username' => 'test',
            'email' => 'test@test.com',
            'enabled' => true,
            'salt' => 'test_salt',
            'password' => 'test_pass',
            'last_login' => 1390354156,
            'roles' => 'admin',
            'firstname' => 'Bob',            
            'lastname' => 'Robinson',
            'created_at' => 1390354156
        );
    }    

}
