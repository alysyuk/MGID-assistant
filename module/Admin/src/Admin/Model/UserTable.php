<?php

namespace Admin\Model;

use Zend\Db\TableGateway\TableGateway;

class UserTable
{

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        
        return $resultSet;
    }

    /**
     * Returns User by User id
     * 
     * @param type $id User id
     * @return \Zend\Db\ResultSet\ResultSetInterface
     * @throws \Exception
     */
    public function getUser($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception('Unable to find user with id - ' . $id);
        }
        
        return $row;
    }

    /**
     * Saves the User
     * 
     * @param \Admin\Model\User $user
     * @throws \Exception
     */
    public function saveUser(User $user)
    {
        $data = get_object_vars($user);

        $id = (int) $user->id;
        if (0 == $id) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getUser($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    /**
     * Deletes the User
     * 
     * @param type $id
     */
    public function deleteUser($id)
    {
        $id = (int) $id;
        $this->tableGateway->delete(array('id' => $id));
    }

}
