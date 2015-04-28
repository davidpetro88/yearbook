<?php

/**
 * Home_Model_Mapper_EstadosMapper
 *  
 * @author David Petro
 */
class Home_Model_Mapper_EstadosMapper {

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
    public function fetchAll() {
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

    public function findEstado() {

        $select = $this->getDbTable()->fetchAll();
        $listEstados = $select->toArray();
        $arrayEstados = array();
        if (!empty($listEstados)) {

            foreach ($listEstados as $key => $value) {
                $estados = new Home_Model_Estados();
                $estados->setIdEstado($value['idEstado']);
                $estados->setSigaEstado($value['sigaEstado']);
                $estados->setNomeEstado($value['nomeEstado']);

                $arrayEstados[] = $estados;
            }
        }

        return $arrayEstados;
    }

    public function findEstadoMapa() {

        $sql = "select u.nomeCompleto, 
                       e.sigaEstado, 
                       e.latitude, 
                       e.longitude 
                from users u, 
                     estados e, 
                     cidades c 
                where u.cidade = c.idCidade 
                and c.idEstado = e.idEstado";

        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $result = $db->fetchAll($sql);
            return $result;
        } catch (PDOException $exc) {
            throw new Exception("ERRO", $exc->getMessage());
        }
    }

}
