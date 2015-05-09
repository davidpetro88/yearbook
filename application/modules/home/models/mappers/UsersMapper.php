<?php

/**
 * Home_Model_Mapper_UsersMapper
 *  
 * @author David Petro
 */
class Home_Model_Mapper_UsersMapper
{

    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (! $dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Home_Model_DbTable_Users');
        }
        return $this->_dbTable;
    }

    public function fetchAll()
    {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $select = $db->select();
            $select->from('endereco_cliente');
            $db->setFetchMode(Zend_Db::FETCH_OBJ);
            $stmt = $db->query($select);
            $resultSet = $stmt->fetchAll();
            
            return $resultSet;
        } catch (Exception $exc) {
            
            return NULL;
        }
    }

    /**
     *
     * @param type $id
     *            = NUMERO_DO_PEDIDO
     * @param Alopdo_Class_AloFormasPagamentosPedidos $model            
     * @return Object
     */
    public function fetchByUsername($username)
    {
        try {
            if (! empty($username)) {
                $db = Zend_Db_Table::getDefaultAdapter();
                $select = $db->select();
                $select->from('endereco_cliente');
                $select->where('username = ?', (string) $username);
                $db->setFetchMode(Zend_Db::FETCH_OBJ);
                $stmt = $db->query($select);
                $resultSet = $stmt->fetch();
            } else {
                
                $resultSet = NULL;
            }
            
            return $resultSet;
        } catch (Exception $exc) {
            return NULL;
        }
    }

    public function findUser($name)
    {
        try {
            $db = Zend_Db_Table::getDefaultAdapter();
            $select = $db->select();
            $select->from('endereco_cliente');
            $select->where('nomeCompleto LIKE ?', '%' . "{$name}" . '%');
            $db->setFetchMode(Zend_Db::FETCH_OBJ);
            $stmt = $db->query($select);
            $resultSet = $stmt->fetchAll();
            
            return $resultSet;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return NULL;
        }
    }

    public function updateUser($username, $nome, $idCidade, $email, $diretory, $file)
    {
        /*
         * password
         * id_role
         * ldap
         * nomeCompleto
         * arquivoFoto
         * cidade
         * email
         * descricao
         */
        try {
            if ((! empty($username)) && (! empty($nome)) && (! empty($idCidade))) {
                
                $this->saveimage($diretory, $file);
                
                $data = array(
                    'nomeCompleto' => $nome,
                    'cidade' => $idCidade,
                    'email' => $email,
                    'arquivoFoto' => $this->diretoryImg($diretory)
                );
                
                $this->getDbTable()->update($data, "username =  '{$username}'");
                $this->reWriteSessionUser();
                return true;
            } else {
                
                return false;
            }
        } catch (Exception $ex) {
            
            return $ex->getMessage();
        }
    }

    public function deleteUser($username)
    {
        try {
            $sql = "DELETE FROM `users` WHERE username = '{$username}'";
            
            $db = Zend_Db_Table::getDefaultAdapter();
            $x = $db->delete('users', "username = '{$username}'");
            
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function saveimage($diretory, $file)
    {
        file_put_contents($diretory, base64_decode($file));
    }

    public function reWriteSessionUser()
    {
        try {
            
            $auth = Zend_Auth::getInstance();
            $user = $auth->getStorage()->read();
            
            $data = array(
                'username' => $user['username'],
                'id_role' => $user['id_role'],
                'user' => $this->fetchByUsername($user['username'])
            );
            
            $auth->getStorage()->write($data);
        } catch (Exception $ex) {
            
            die('falha');
        }
    }

    public function diretoryImg($diretory)
    {
        $diretoryImg = explode('public/img', $diretory);
        return "/img" . $diretoryImg[1];
    }

    public function save($dados)
    {
        try {
            
            if (! empty($dados['username'])) {
                
                $fetchByUsername = $this->fetchByUsername((string) $dados['username']);
                
                if (! empty($fetchByUsername)) {
                    return false;
                    // cliente ja cadastrado
                } else {
                    
                    if (! empty($dados['cidade'])) {
                        $cidade = $dados['cidade'];
                    } else {
                        $cidade = '';
                    }
                    
                    if (! empty($dados['image'])) {
                        
                        $image = explode('base64,', $dados['image']);
                        $diretory = APPLICATION_PROFILE . '/' . $dados['username'] . '.jpg';
                        
                        if (! empty($image)) {
                            $this->saveimage($diretory, $image[1]);
                            
                            $arrayInsert = array(
                                'username' => $dados['username'],
                                'nomeCompleto' => $dados['nome'],
                                'cidade' => $cidade,
                                'password' => sha1('xcNsdaAd73328aDs73oQw223hd' . $dados['password']),
                                'email' => $dados['email'],
                                'arquivoFoto' => $this->diretoryImg($diretory),
                                'id_role' => 3
                            );
                            
                            $this->getDbTable()->insert($arrayInsert);
                            
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        
                        $arrayInsert = array(
                            'username' => $dados['username'],
                            'nomeCompleto' => $dados['nome'],
                            'cidade' => $cidade,
                            'password' => sha1('xcNsdaAd73328aDs73oQw223hd' . $dados['password']),
                            'email' => $dados['email'],
                            'id_role' => 3
                        );
                        
                        $this->getDbTable()->insert($arrayInsert);
                        return true;
                    }
                }
            } else {

                return false;
            }
        } catch (Exception $ex) {

            return false;
        }
    }
}
