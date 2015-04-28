<?php
/**
 * Home_Model_Users
 *  
 * @author David Petro
 */
class Home_Model_Users {

    protected $_username = 'username';
    protected $_password = 'password';
    protected $_id_role = 'id_role';
    protected $_ldap = 'ldap';
    protected $_nomeCompleto = 'nomeCompleto';
    protected $_arquivoFoto = 'arquivoFoto';
    protected $_cidade = 'cidade';
    protected $_email = 'email';
    protected $_descricao = 'descricao';

    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value) {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Alo Servicos Dos Roteiros property');
        }
        $this->$method($value);
    }

    public function __get($name) {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Alo Servicos Dos Roteiros property');
        }
        return $this->$method();
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    
    public function get_username() {
        return $this->_username;
    }

    public function get_password() {
        return $this->_password;
    }

    public function get_id_role() {
        return $this->_id_role;
    }

    public function get_ldap() {
        return $this->_ldap;
    }

    public function get_nomeCompleto() {
        return $this->_nomeCompleto;
    }

    public function get_arquivoFoto() {
        return $this->_arquivoFoto;
    }

    public function get_cidade() {
        return $this->_cidade;
    }

    public function get_email() {
        return $this->_email;
    }

    public function get_descricao() {
        return $this->_descricao;
    }

    public function set_username($_username) {
        $this->_username = $_username;
    }

    public function set_password($_password) {
        $this->_password = $_password;
    }

    public function set_id_role($_id_role) {
        $this->_id_role = $_id_role;
    }

    public function set_ldap($_ldap) {
        $this->_ldap = $_ldap;
    }

    public function set_nomeCompleto($_nomeCompleto) {
        $this->_nomeCompleto = $_nomeCompleto;
    }

    public function set_arquivoFoto($_arquivoFoto) {
        $this->_arquivoFoto = $_arquivoFoto;
    }

    public function set_cidade($_cidade) {
        $this->_cidade = $_cidade;
    }

    public function set_email($_email) {
        $this->_email = $_email;
    }

    public function set_descricao($_descricao) {
        $this->_descricao = $_descricao;
    }


    
}
