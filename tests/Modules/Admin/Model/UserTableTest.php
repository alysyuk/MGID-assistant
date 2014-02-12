<?php

namespace AdminTest\Model;

use Admin\Model\UserTable;
use Admin\Model\User;
use AdminTest\CommonTest;
use Zend\Db\ResultSet\ResultSet;
use PHPUnit_Framework_TestCase;

class UserTableTest extends PHPUnit_Framework_TestCase
{

    public function testFetchAllReturnsAllUsers()
    {
        // GIVEN
        $resultSet = new ResultSet();
        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
        $mockTableGateway->expects($this->once())
                ->method('select')
                ->with()
                ->will($this->returnValue($resultSet));

        // WHEN
        $userTable = new UserTable($mockTableGateway);

        // THEN
        $this->assertSame($resultSet, $userTable->fetchAll());
    }
//
//    public function testCanRetrieveUserByItsId()
//    {
//        // GIVEN
//        $user = new User();
//        $user->exchangeArray(CommonTest::$testUserData);
//
//        $resultSet = new ResultSet();
//        $resultSet->setArrayObjectPrototype(new User());
//        $resultSet->initialize(array($user));
//
//        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
//        $mockTableGateway->expects($this->once())
//                ->method('select')
//                ->with(array('id' => CommonTest::TEST_USER_ID))
//                ->will($this->returnValue($resultSet));
//
//        // WHEN
//        $userTable = new UserTable($mockTableGateway);
//
//        // THEN
//        $this->assertSame($user, $userTable->getUser(122));
//    }
//
//    public function testCanDeleteUserByItsId()
//    {
//        // GIVEN
//        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('delete'), array(), '', false);
//        $mockTableGateway->expects($this->once())
//                ->method('delete')
//                ->with(array('id' => CommonTest::TEST_USER_ID));
//
//        // WHEN
//        $userTable = new UserTable($mockTableGateway);
//        
//        // THEN
//        $userTable->deleteUser(CommonTest::TEST_USER_ID);
//    }
//
//    public function testSaveUserWillInsertNewUsersIfTheyDontAlreadyHaveAnId()
//    {
//        $userData = array('email' => 'test@test.com', 'password' => 'test_pass');
//        $user = new User();
//        $user->exchangeArray($userData);
//
//        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('insert'), array(), '', false);
//        $mockTableGateway->expects($this->once())
//                ->method('insert')
//                ->with($userData);
//
//        $userTable = new UserTable($mockTableGateway);
//        $userTable->saveUser($user);
//    }
//
//    public function testSaveUserWillUpdateExistingUsersIfTheyAlreadyHaveAnId()
//    {
//        $userData = array('id' => 123, 'email' => 'test@test.com', 'password' => 'test_pass');
//        $user = new User();
//        $user->exchangeArray($userData);
//
//        $resultSet = new ResultSet();
//        $resultSet->setArrayObjectPrototype(new User());
//        $resultSet->initialize(array($user));
//
//        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select', 'update'), array(), '', false);
//        $mockTableGateway->expects($this->once())
//                ->method('select')
//                ->with(array('id' => 123))
//                ->will($this->returnValue($resultSet));
//        $mockTableGateway->expects($this->once())
//                ->method('update')
//                ->with(array('email' => 'test@test.com', 'password' => 'test_pass'), array('id' => 123));
//
//        $userTable = new UserTable($mockTableGateway);
//        $userTable->saveUser($user);
//    }
//
//    public function testExceptionIsThrownWhenGettingNonexistentUser()
//    {
//        $resultSet = new ResultSet();
//        $resultSet->setArrayObjectPrototype(new User());
//        $resultSet->initialize(array());
//
//        $mockTableGateway = $this->getMock('Zend\Db\TableGateway\TableGateway', array('select'), array(), '', false);
//        $mockTableGateway->expects($this->once())
//                ->method('select')
//                ->with(array('id' => 123))
//                ->will($this->returnValue($resultSet));
//
//        $userTable = new UserTable($mockTableGateway);
//
//        try {
//            $userTable->getUser(123);
//        } catch (\Exception $e) {
//            $this->assertSame('Unable to find user with id - 123', $e->getMessage());
//            return;
//        }
//
//        $this->fail('Expected exception was not thrown');
//    }

}
