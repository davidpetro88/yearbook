<?php

class Ws_IndexController extends Zend_Controller_Action {

    private $options;

    /**
     * Init
     * 
     * @see Zend_Controller_Action::init()
     */
    public function init() {
        $this->_options = $this->getInvokeArg('bootstrap')->getOptions();
    }

    /**
     * Index
     */
    public function indexAction() {
        
        $userMapper =  new Home_Model_Mapper_UsersMapper();
        $auth = Zend_Auth::getInstance();
        $this->view->user = $auth->getStorage()->read();
        

        //print_r($us->fetchByUsername($_SESSION['Zend_Auth']['storage']['username'] ));
        
    }

    /**
     * Menu
     */
    public function menuAction() {
        // @todo Add the menu page action
    }

    /**
     * Menu
     */
    public function perfilAction() {
        // @todo Add the menu page action
        
        $auth = Zend_Auth::getInstance();
        $this->view->user = $auth->getStorage()->read();
        
    }
    
    
}
