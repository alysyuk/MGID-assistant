<?php

namespace AdminTest\Model;

use Admin\Model\User;
use AdminTest\CommonTest;
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
//
//    /**
//     * @depends testObjectUserCanBeConstructed
//     */
//    public function testUserInitialState(User $user)
//    {
//        // WHEN
//        $userProperties = array_keys(get_object_vars($user));
//
//        // THEN
//        foreach ($userProperties as $userProperty) {
//            $this->assertNull($user->{$userProperty});
//        }
//    }
//
//    /**
//     * @covers  \Admin\Model\User::exchangeArray
//     *
//     * @depends testObjectUserCanBeConstructed
//     */
//    public function testExchangeArraySetsPropertiesCorrectly(User $user)
//    {
//        // GIVEN
//        $dataProperties = array_keys(CommonTest::$testUserData);
//
//        // WHEN
//        $user->exchangeArray(CommonTest::$testUserData);
//
//        // THEN
//        foreach ($dataProperties as $dataProperty) {
//            $this->assertSame(CommonTest::$testUserData[$dataProperty], $user->{$dataProperty});
//        }
//    }
//
//    /**
//     * @covers  \Admin\Model\User::exchangeArray
//     *
//     * @depends testObjectUserCanBeConstructed
//     */
//    public function testExchangeArraySetsPropertiesToNullIfKeysAreNotPresent(User $user)
//    {
//        // GIVEN
//        $user->exchangeArray(CommonTest::$testUserData);
//
//        // WHEN
//        $user->exchangeArray(array());
//
//        // THEN
//        $this->testUserInitialState($user);
//    }

}
