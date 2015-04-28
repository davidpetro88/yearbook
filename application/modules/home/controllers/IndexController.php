<?php

class Home_IndexController extends Zend_Controller_Action {

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

        $userMapper = new Home_Model_Mapper_UsersMapper();
        $auth = Zend_Auth::getInstance();
        $this->view->user = $auth->getStorage()->read();

        $LastProfileSeeMapper = new Home_Model_Mapper_LastProfileSeeMapper();
        $findLastSee = $LastProfileSeeMapper->findLastSee($this->view->user['username']);

        if (!empty($findLastSee)) {

            $this->view->lastSee = json_encode($userMapper->fetchByUsername($findLastSee[0]['profile_name']));
        } else {
            $this->view->lastSee = 0;
        }
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
