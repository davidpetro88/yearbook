<?php

class Yearbook_Class_Mapper_EstadosMapper
{

    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable))
        {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract)
        {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable)
        {
            $this->setDbTable('Home_Model_DbTable_Estados');
        }
        return $this->_dbTable;
    }

    /**
     * 
     * 
     * @param type $id = NUMERO_DO_PEDIDO
     * @param Alopdo_Class_AloNotasFiscaisDosPedidos $model
     * @return Object
     */
    public function fetchAll($id)
    {
/*
        $where = '';
        if ($id)
        {
            $where = " NUMERO_DO_PEDIDO = " . $id;
        }
        $resultSet = $this->getDbTable()->fetchAll($where);
        $entries = array();
        foreach ($resultSet as $row)
        {
            $entry = new Alopdo_Class_AloNotasFiscaisDosPedidos();
            $entry->setNumero_do_pedido($row->NUMERO_DO_PEDIDO)
                    ->setCodigo_da_filial($row->CODIGO_DA_FILIAL)
                    ->setCodigo_do_documento_de_saida($row->CODIGO_DO_DOCUMENTO_DE_SAIDA);

            $entries[] = $entry;
        }
        return $entries;
*/
    }

}
