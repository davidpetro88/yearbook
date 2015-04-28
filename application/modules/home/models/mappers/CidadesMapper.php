<?php
/**
 * Home_Model_Mapper_CidadesMapper
 *  
 * @author David Petro
 */
class Home_Model_Mapper_CidadesMapper {

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
            $this->setDbTable('Home_Model_DbTable_Cidades');
        }
        return $this->_dbTable;
    }

    /**
     * @param type $id = CODIGO_DA_ENTIDADE_COMERCIAL
     * @param Alopdo_Class_EntidadesComerciais $model
     * @return Object
     */
    public function findCidades($uf) {
        $where = '';
        if ($uf) {
            $where = " idEstado = " . $uf;
        }
        $select = $this->getDbTable()->fetchAll($where);
        $listCidades = $select->toArray();
        $arrayCidades = array();
        if (!empty($listCidades)) {

            foreach ($listCidades as $key => $value) {
                $cidades = new Home_Model_Cidades();
                $cidades->setIdCidade($value['idCidade']);
                $cidades->setIdEstado($value['idEstado']);
                $cidades->setNomeCidade($value['nomeCidade']);

                $arrayCidades[] = $cidades;
            }
        }

        return $arrayCidades;
    }

    public function retornaDadosFiliais($codigo_da_filial) {

        $sql = "SELECT /*+RULE+*/ EEC.CODIGO_DA_ENTIDADE_COMERCIAL AS FILIAL,
						TL.DESCRICAO_TIPO_DE_LOGRADOURO,
						LOGR.NOME_DO_LOGRADOURO,
						BR.NOME_DO_BAIRRO,
						EEC.NUMERO_DE_ENDERECO_DE_ENT_COM,
						EEC.COMPLEMENTO,
						'(' || COM.DDD || ') ' || COM.NUMERO TELEFONE,
						LOGR.CEP,
						LOC.NOME_DA_LOCALIDADE,
						LOC.SIGLA_DA_UF,
						FIL.NUMERO_CARTAO_POSTAGEM
						FROM ENTIDADES_COMERCIAIS ENCO,
						ENDERECOS_DE_ENTIDADE_COM EEC,
						LOCALIDADES               LOC,
						LOGRADOUROS               LOGR,
						BAIRROS                   BR,
						MEIOS_DE_COMUNICACAO      COM,
						TIPOS_DE_LOGRADOUROS      TL,
						ALO_FILIAIS               FIL
						WHERE ENCO.CODIGO_DA_EMPRESA_DO_GRUPO = 'PAN'
						AND ENCO.DATA_DE_EXCLUSAO IS NULL
						AND ENCO.DATA_ENCERRAMENTO_TEMPORARIO IS NULL
						AND ENCO.CODIGO_DA_ENTIDADE_COMERCIAL < 900
						AND ENCO.CODIGO_DA_ATIVIDADE_ECONOMICA =
						RETORNA_PARAMETRO('PHW', 'ATIVIDADE_VAREJO', '1002')
						AND EEC.CODIGO_DA_ENTIDADE_COMERCIAL = ENCO.CODIGO_DA_ENTIDADE_COMERCIAL
						AND EEC.SEQUENCIA_DO_END_DA_ENT_COM = 1
						AND LOGR.CODIGO_DA_LOCALIDADE = EEC.CODIGO_DA_LOCALIDADE
						AND LOGR.CODIGO_DO_LOGRADOURO = EEC.CODIGO_DO_LOGRADOURO
						AND LOC.CODIGO_DA_LOCALIDADE = LOGR.CODIGO_DA_LOCALIDADE
						AND BR.CODIGO_DA_LOCALIDADE = LOGR.CODIGO_DA_LOCALIDADE_BAIRRO
						AND BR.CODIGO_DO_BAIRRO = LOGR.CODIGO_DO_BAIRRO
						AND TL.TIPO_DE_LOGRADOURO(+) = LOGR.TIPO_DE_LOGRADOURO
						AND EEC.CODIGO_DA_ENTIDADE_COMERCIAL = FIL.CODIGO_DA_FILIAL
						AND EEC.CODIGO_DA_ENTIDADE_COMERCIAL = {$codigo_da_filial}   
						AND COM.CODIGO_DA_ENTIDADE_COMERCIAL(+) =
						ENCO.CODIGO_DA_ENTIDADE_COMERCIAL
						AND COM.CODIGO_DO_TIPO_DE_COMUNIC(+) = 13
						GROUP BY EEC.CODIGO_DA_ENTIDADE_COMERCIAL,          
						TL.DESCRICAO_TIPO_DE_LOGRADOURO,
						LOGR.NOME_DO_LOGRADOURO,
						BR.NOME_DO_BAIRRO,
						EEC.NUMERO_DE_ENDERECO_DE_ENT_COM,
						EEC.COMPLEMENTO,
						'(' || COM.DDD || ') ' || COM.NUMERO,
						LOGR.CEP,
						LOC.NOME_DA_LOCALIDADE,
						LOC.SIGLA_DA_UF,
						FIL.NUMERO_CARTAO_POSTAGEM
						ORDER BY LOGR.NOME_DO_LOGRADOURO";
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $result = $db->fetchAll($sql);
            if (is_array($result)) {
                return $result[0];
            } else {
                return $result;
            }
        } catch (PDOException $exc) {
            throw new Exception("ERRO", $exc->getMessage());
        }
    }

}
