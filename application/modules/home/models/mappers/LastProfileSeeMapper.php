<?php
/**
 * Home_Model_Mapper_LastProfileSeeMapper
 *  
 * @author David Petro
 */
class Home_Model_Mapper_LastProfileSeeMapper {

    protected $_dbTable;

    public function setDbTable($dbTable) {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Home_Model_DbTable_LastProfileSee');
        }
        return $this->_dbTable;
    }

    /**
     * 
     * @param type $user
     * @return boolean
     */
    public function findLastSee($user) {

        try {
            $where = " username = '{$user}'";
            $select = $this->getDbTable()->fetchAll($where);
            $lastProfileSee = $select->toArray();

            if (!empty($lastProfileSee)) {
                return $lastProfileSee;
            } else {
                return FALSE;
            }
        } catch (Exception $ex) {
            return FALSE;
        }
    }

    /**
     * 
     * @param type $username
     * @param type $lastProfileSee
     * @return boolean
     */
    public function saveLastSee($username, $lastProfileSee) {
        try {

            $usersMapper = new Home_Model_Mapper_UsersMapper();
            $profile = $usersMapper->fetchByUsername($lastProfileSee);

            if (!empty($profile->username)) {
                $data = array(
                    'username' => $username,
                    'profile_name' => $profile->username,
                );
                if ($this->deleLastSee($username) == true) {
                    $this->getDbTable()->insert($data);
                }
            }
        } catch (Exception $ex) {
            return false;
        }
    }

    /**
     * 
     * @param type $username
     * @return boolean
     */
    public function deleLastSee($username) {
        if (!empty($username)) {
            $where = "username = '{$username}'";
            $this->getDbTable()->delete($where);

            return true;
        } else {
            return FALSE;
        }
    }

}
