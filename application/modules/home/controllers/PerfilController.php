<?php

class Home_PerfilController extends Zend_Controller_Action {

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

        $auth = Zend_Auth::getInstance();
        $this->view->user = $auth->getStorage()->read();
    }

    public function saveAction() {
        
    }

    public function editAction() {
        //http://yearbook/home/perfil/edit   
    }

    public function listagemAction() {
        
    }

    /**
     * Controller Perfil 
     */
    public function perfilAction() {

        $auth = Zend_Auth::getInstance();
        $this->view->user = $auth->getStorage()->read();


        $this->view->username = $this->getRequest()->getParam('username');

        $LastProfileSeeMapper = new Home_Model_Mapper_LastProfileSeeMapper();
        $findLastSee = $LastProfileSeeMapper->saveLastSee($this->view->user['username'], $this->view->username);
    }

    public function removerAction() {
        $userMapper = new Home_Model_Mapper_UsersMapper();
        $auth = Zend_Auth::getInstance();
        $this->view->user = $auth->getStorage()->read();
    }

    public function excluirAction() {

        if (!empty($_POST['remove'])) {
            if ($_POST['remove'] == 'ok') {

                $auth = Zend_Auth::getInstance();
                $userSession = $auth->getStorage()->read();

                $usersMapper = new Home_Model_Mapper_UsersMapper();
                $deleteUser = $usersMapper->deleteUser($userSession['username']);

                if ($deleteUser == true) {
                    $this->_redirect('/login/index/logout');
                }
            }
        }
    }

    public function mapaperfilAction() {
        
    }

}
