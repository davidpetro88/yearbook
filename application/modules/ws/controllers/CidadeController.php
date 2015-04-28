<?php

class Ws_CidadeController extends Zend_Controller_Action {

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

    public function getusercidadeAction() {

        $this->_helper->layout->disableLayout();

        $cidadesMapper = new Home_Model_Mapper_CidadesMapper();
        $uf = $this->getRequest()->getParam('estado');
        $cidades = $cidadesMapper->findCidades($uf);

        echo json_encode($cidades);
    }

}
