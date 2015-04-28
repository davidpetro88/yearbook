<?php

class Yearbook_Class_Cidades {

    protected $_idCidade = 'idCidade';
    protected $_idEstado = 'idEstado';
    protected $_nomeCidade = 'nomeCidade';

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

    public function get_idCidade() {
        return $this->_idCidade;
    }

    public function get_idEstado() {
        return $this->_idEstado;
    }

    public function get_nomeCidade() {
        return $this->_nomeCidade;
    }

    public function set_idCidade($_idCidade) {
        $this->_idCidade = $_idCidade;
    }

    public function set_idEstado($_idEstado) {
        $this->_idEstado = $_idEstado;
    }

    public function set_nomeCidade($_nomeCidade) {
        $this->_nomeCidade = $_nomeCidade;
    }

}
