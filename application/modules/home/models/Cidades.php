<?php
/**
 * Home_Model_Cidades
 *  
 * @author David Petro
 */
class Home_Model_Cidades {

    public $idCidade = 'idCidade';
    public $idEstado = 'idEstado';
    public $nomeCidade = 'nomeCidade';

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

    public function getIdCidade() {
        return $this->idCidade;
    }

    public function getIdEstado() {
        return $this->idEstado;
    }

    public function getNomeCidade() {
        return $this->nomeCidade;
    }

    public function setIdCidade($idCidade) {
        $this->idCidade = $idCidade;
    }

    public function setIdEstado($idEstado) {
        $this->idEstado = $idEstado;
    }

    public function setNomeCidade($nomeCidade) {
        $this->nomeCidade = $nomeCidade;
    }

}
