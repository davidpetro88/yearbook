<?php

class Yearbook_Class_Estados {

    protected $_idEstado = 'idEstado';
    protected $_sigaEstado = 'sigaEstado';
    protected $_nomeEstado = 'nomeEstado';

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

    public function get_idEstado() {
        return $this->_idEstado;
    }

    public function get_sigaEstado() {
        return $this->_sigaEstado;
    }

    public function get_nomeEstado() {
        return $this->_nomeEstado;
    }

    public function set_idEstado($_idEstado) {
        $this->_idEstado = $_idEstado;
    }

    public function set_sigaEstado($_sigaEstado) {
        $this->_sigaEstado = $_sigaEstado;
    }

    public function set_nomeEstado($_nomeEstado) {
        $this->_nomeEstado = $_nomeEstado;
    }

}
