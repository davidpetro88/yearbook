<?php

//Home_Model_DbTable_Users
class Yearbook_Class_Mapper_UsersMapper {

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
            $this->setDbTable('Home_Model_DbTable_Users');
        }
        return $this->_dbTable;
    }

    /**
     * 
     * @param type $id = NUMERO_DO_PEDIDO
     * @param Alopdo_Class_AloFormasPagamentosPedidos $model
     * @return Object
     */
    public function fetchByUsername($username) {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $select = $db->select();
            $select->from('users');
            $select->where('username = ?', $username);
            $db->setFetchMode(Zend_Db::FETCH_OBJ);
            $stmt = $db->query($select);
            $resultSet = $stmt->fetch();

            return $resultSet;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return NULL;
        }
    }

}
