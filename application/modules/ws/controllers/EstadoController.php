<?php

class Ws_EstadoController extends Zend_Controller_Action {

    private $options;

    /**
     * Init
     * 
     * @see Zend_Controller_Action::init()
     */
    public function init() {
        $this->_helper->layout->disableLayout();
        $this->_options = $this->getInvokeArg('bootstrap')->getOptions();
    }

    /**
     * Index
     */
    public function indexAction() {
        
    }

    //http://yearbook/ws/estado/getuserestado
    public function getuserestadoAction() {

        $this->_helper->layout->disableLayout();

        $EstadosMapper = new Home_Model_Mapper_EstadosMapper();
        $estados = $EstadosMapper->findEstado();

        echo json_encode($estados);
    }

    public function estadomapaAction() {
        $this->_helper->layout->disableLayout();

        $EstadosMapper = new Home_Model_Mapper_EstadosMapper();
        $estados = $EstadosMapper->findEstadoMapa();

        echo json_encode($estados);
    }

}
