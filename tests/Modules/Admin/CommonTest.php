<?php

namespace AdminTest;

class CommonTest
{

    /**
     * Test user id
     */
    const TEST_USER_ID = 122;

    /**
     * Test user data
     *
     * @var array 
     */
    public static $testUserData = array(
        'id' => self::TEST_USER_ID,
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
