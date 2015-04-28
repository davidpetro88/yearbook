<?php

class Yearbook_Class_Mapper_CidadesMapper
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
            $this->setDbTable('Home_Model_DbTable_Cidades');
        }
        return $this->_dbTable;
    }

    /**
     * @param type $id = CODIGO_DA_ENTIDADE_COMERCIAL
     * @param Alopdo_Class_EntidadesComerciais $model
     * @return Object
     */
    public function fetchAll($id)
    {
/*
        $where = '';
        if ($id)
        {
            $where = " CODIGO_DA_ENTIDADE_COMERCIAL = " . $id;
        }
        $resultSet = $this->getDbTable()->fetchAll($where);
        $entries = array();
        foreach ($resultSet as $row)
        {
            $entry = new Alopdo_Class_EntidadesComerciais();
            $entry->setCodigo_da_entidade_comercial($row->CODIGO_DA_ENTIDADE_COMERCIAL)
                    ->setNome_da_entidade_comercial($row->NOME_DA_ENTIDADE_COMERCIAL)
                    ->setNome_comercial($row->NOME_COMERCIAL)
                    ->setSigla($row->SIGLA)
                    ->setTipo_da_entidade_comercial($row->TIPO_DA_ENTIDADE_COMERCIAL)
                    ->setCgc($row->CGC)
                    ->setInscricao_estadual($row->INSCRICAO_ESTADUAL)
                    ->setCpf($row->CPF)
                    ->setRegistro_geral($row->REGISTRO_GERAL)
                    ->setData_de_nascimento($row->DATA_DE_NASCIMENTO)
                    ->setInscricao_estadual_dpf($row->INSCRICAO_ESTADUAL_DPF)
                    ->setRegistro_ean($row->REGISTRO_EAN)
                    ->setOrgao_publico($row->ORGAO_PUBLICO)
                    ->setAutomatizada($row->AUTOMATIZADA)
                    ->setFabricante($row->FABRICANTE)
                    ->setMeio_para_transmissao_dados($row->MEIO_PARA_TRANSMISSAO_DADOS)
                    ->setSucessores_de($row->SUCESSORES_DE)
                    ->setData_da_ultima_alt_social($row->DATA_DA_ULTIMA_ALT_SOCIAL)
                    ->setData_de_fundacao($row->DATA_DE_FUNDACAO)
                    ->setData_de_exclusao($row->DATA_DE_EXCLUSAO)
                    ->setData_de_lancamento($row->DATA_DE_LANCAMENTO)
                    ->setSituacao_da_entidade_comercial($row->SITUACAO_DA_ENTIDADE_COMERCIAL)
                    ->setCodigo_da_ent_comerc_matriz($row->CODIGO_DA_ENT_COMERC_MATRIZ)
                    ->setCodigo_do_grupo_economico($row->CODIGO_DO_GRUPO_ECONOMICO)
                    ->setCodigo_do_ramo_de_atividade($row->CODIGO_DO_RAMO_DE_ATIVIDADE)
                    ->setCodigo_da_empresa_do_grupo($row->CODIGO_DA_EMPRESA_DO_GRUPO)
                    ->setClassificacao_da_filial($row->CLASSIFICACAO_DA_FILIAL)
                    ->setIndicador_de_franquia($row->INDICADOR_DE_FRANQUIA)
                    ->setCodigo_da_atividade_economica($row->CODIGO_DA_ATIVIDADE_ECONOMICA)
                    ->setValidade_cgc($row->VALIDADE_CGC)
                    ->setSexo_da_entidade_comercial($row->SEXO_DA_ENTIDADE_COMERCIAL)
                    ->setIsento_de_icms_st($row->ISENTO_DE_ICMS_ST)
                    ->setLiminar_substit_tributaria($row->LIMINAR_SUBSTIT_TRIBUTARIA)
                    ->setPerc_calc_pis($row->PERC_CALC_PIS)
                    ->setPerc_calc_confins($row->PERC_CALC_CONFINS)
                    ->setData_de_transmissao($row->DATA_DE_TRANSMISSAO)
                    ->setBloqueio($row->BLOQUEIO)
                    ->setEntidade_bloqueio($row->ENTIDADE_BLOQUEIO)
                    ->setImpr_nf_em_varios_formularios($row->IMPR_NF_EM_VARIOS_FORMULARIOS)
                    ->setNumero_max_de_itens_da_nfs($row->NUMERO_MAX_DE_ITENS_DA_NFS)
                    ->setEmite_bloqueto_com_nfs($row->EMITE_BLOQUETO_COM_NFS)
                    ->setImpr_preco_cons_na_descricao($row->IMPR_PRECO_CONS_NA_DESCRICAO)
                    ->setSepara_icms_st($row->SEPARA_ICMS_ST)
                    ->setSepara_medicamento_perfumaria($row->SEPARA_MEDICAMENTO_PERFUMARIA)
                    ->setSepara_por_prazos($row->SEPARA_POR_PRAZOS)
                    ->setSepara_psicotropicos($row->SEPARA_PSICOTROPICOS)
                    ->setSepara_liberados_monitorados($row->SEPARA_LIBERADOS_MONITORADOS)
                    ->setSepara_bloqueio_de_desconto($row->SEPARA_BLOQUEIO_DE_DESCONTO)
                    ->setSepara_bloqueio_de_prazo($row->SEPARA_BLOQUEIO_DE_PRAZO)
                    ->setCalcula_prazo_ponderado($row->CALCULA_PRAZO_PONDERADO)
                    ->setFuncion_aos_fins_de_semana($row->FUNCION_AOS_FINS_DE_SEMANA)
                    ->setTipo_filial($row->TIPO_FILIAL)
                    ->setTipo_etiqueta_trilho($row->TIPO_ETIQUETA_TRILHO)
                    ->setEmite_bloqueto_deposito($row->EMITE_BLOQUETO_DEPOSITO)
                    ->setFilial_pharmawin($row->FILIAL_PHARMAWIN)
                    ->setReplica_item($row->REPLICA_ITEM)
                    ->setReplica_fornecedor($row->REPLICA_FORNECEDOR)
                    ->setNum_ultimo_alvara_sanitario($row->NUM_ULTIMO_ALVARA_SANITARIO)
                    ->setLicen_funciona_minist_saude($row->LICEN_FUNCIONA_MINIST_SAUDE)
                    ->setData_ultima_alteracao($row->DATA_ULTIMA_ALTERACAO)
                    ->setCodigo_do_niri($row->CODIGO_DO_NIRI)
                    ->setData_de_arquivamento($row->DATA_DE_ARQUIVAMENTO)
                    ->setCodigo_do_distribuidor_dimed($row->CODIGO_DO_DISTRIBUIDOR_DIMED)
                    ->setCodigo_do_distribuidor_panvel($row->CODIGO_DO_DISTRIBUIDOR_PANVEL)
                    ->setNacionalidade($row->NACIONALIDADE)
                    ->setNumero_autorizacao_especial($row->NUMERO_AUTORIZACAO_ESPECIAL)
                    ->setNome_do_arquivo_do_logotipo($row->NOME_DO_ARQUIVO_DO_LOGOTIPO)
                    ->setGera_caged($row->GERA_CAGED)
                    ->setImprime_prazo_no_item_da_nota($row->IMPRIME_PRAZO_NO_ITEM_DA_NOTA)
                    ->setUltima_ficha_registro($row->ULTIMA_FICHA_REGISTRO)
                    ->setLocalizacao_da_filial($row->LOCALIZACAO_DA_FILIAL)
                    ->setControlar_limite_de_credito($row->CONTROLAR_LIMITE_DE_CREDITO)
                    ->setFilial_sazonal($row->FILIAL_SAZONAL)
                    ->setData_encerramento_temporario($row->DATA_ENCERRAMENTO_TEMPORARIO)
                    ->setCompra_de_laboratorio($row->COMPRA_DE_LABORATORIO)
                    ->setFilial_centralizada($row->FILIAL_CENTRALIZADA)
                    ->setData_da_centralizacao($row->DATA_DA_CENTRALIZACAO)
                    ->setSigla_do_pais($row->SIGLA_DO_PAIS)
                    ->setSigla_da_uf($row->SIGLA_DA_UF)
                    ->setUsuario_de_cadastramento($row->USUARIO_DE_CADASTRAMENTO)
                    ->setFilial_de_cadastramento($row->FILIAL_DE_CADASTRAMENTO)
                    ->setDias_de_prazo_troca_mercadoria($row->DIAS_DE_PRAZO_TROCA_MERCADORIA)
                    ->setCodigo_da_filial_matriz($row->CODIGO_DA_FILIAL_MATRIZ)
                    ->setNumero_de_pdvs($row->NUMERO_DE_PDVS)
                    ->setArea_do_estabelecimento($row->AREA_DO_ESTABELECIMENTO)
                    ->setTipo_de_estabelecimento($row->TIPO_DE_ESTABELECIMENTO)
                    ->setFilial_com_manipulacao($row->FILIAL_COM_MANIPULACAO)
                    ->setFilial_pharmaweb($row->FILIAL_PHARMAWEB)
                    ->setInscricao_municipal($row->INSCRICAO_MUNICIPAL)
                    ->setData_envio_cadastro($row->DATA_ENVIO_CADASTRO)
                    ->setMetragem_area_venda($row->METRAGEM_AREA_VENDA)
                    ->setMetragem_area_prateleira($row->METRAGEM_AREA_PRATELEIRA)
                    ->setEstado_civil($row->ESTADO_CIVIL)
                    ->setQuantidade_filhos($row->QUANTIDADE_FILHOS)
                    ->setNumero_do_pis($row->NUMERO_DO_PIS)
                    ->setCodigo_da_cbo($row->CODIGO_DA_CBO)
                    ->setCodigo_antt($row->CODIGO_ANTT)
                    ->setData_validade_afe($row->DATA_VALIDADE_AFE)
                    ->setSituacao_afe($row->SITUACAO_AFE)
                    ->setValidade_alvara_sanitario($row->VALIDADE_ALVARA_SANITARIO)
                    ->setCertif_regularidade_crf($row->CERTIF_REGULARIDADE_CRF)
                    ->setData_certif_regularidade_crf($row->DATA_CERTIF_REGULARIDADE_CRF)
                    ->setData_autorizacao_especial($row->DATA_AUTORIZACAO_ESPECIAL)
                    ->setSigla_do_pais_emissor($row->SIGLA_DO_PAIS_EMISSOR)
                    ->setSigla_da_uf_emissor($row->SIGLA_DA_UF_EMISSOR)
                    ->setOrgao_emissor_rg($row->ORGAO_EMISSOR_RG)
                    ->setRegistro_profissional($row->REGISTRO_PROFISSIONAL);


            $entries[] = $entry;
        }
        return $entries;
*/
    }

    public function retornaDadosFiliais($codigo_da_filial)
    {

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
        try
        {
            $db = Zend_Db_Table::getDefaultAdapter();
            $result = $db->fetchAll($sql);
            if(is_array($result)){
                return $result[0];
            }else {
                return $result;    
            }
            
        }
        catch (PDOException $exc)
        {
            throw new Exception("ERRO", $exc->getMessage());
        }
    }

}
