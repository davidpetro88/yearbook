<?php

class Login_IndexController extends Zend_Controller_Action {

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
        $this->_helper->layout->disableLayout();
        $this->_helper->layout()->setLayout('login');


        $flash = $this->_helper->getHelper('flashMessenger');
        if ($flash->hasMessages()) {
            $this->view->message = $flash->getMessages();
        }
        $opt = array(
            'custom' => array(
                'timeout' => $this->_options['auth']['timeout']
            )
        );
        $this->view->form = new Login_Form_Login($opt);
        $this->render('login');
    }

    /**
     * Login
     */
    public function loginAction() {

        $this->_helper->layout->disableLayout();
        $this->_helper->layout()->setLayout('login');

        $opt = array(
            'custom' => array(
                'timeout' => $this->_options['auth']['timeout']
            )
        );
        $form = new Login_Form_Login($opt);
        if (!$form->isValid($this->getRequest()->getPost())) {
            $this->view->form = $form;
            return $this->render('login');
        }
        $options = array();

        $options['username'] = $this->getRequest()->getParam('username');
        $options['password'] = $this->getRequest()->getParam('password');


        $auth = Zend_Auth::getInstance();
        $db = $this->getInvokeArg('bootstrap')->getResource('db');
        $user = new Login_Model_Users($db);
        if ($user->isLdapUser($options['username'])) {
            $options['ldap'] = $this->_options['ldap'];
            $authAdapter = Login_Auth::_getAdapter('ldap', $options);
        } else {
            $options['db'] = $db;
            $options['salt'] = $this->_options['auth']['salt'];
            $authAdapter = Login_Auth::_getAdapter('db', $options);
        }
        $result = $auth->authenticate($authAdapter);

        if ($result->isValid()) {
            $role_id = $user->getRoleId($options['username']);

            $userClass = new Home_Model_Mapper_UsersMapper();
            $userDataObject = $userClass->fetchByUsername($options['username']);

            if ($this->getRequest()->getParam('manter_logado') == 1) {
                //salva cookie
                            
                setcookie('username' , $options['username'], (time() + (3 * 24 * 3600)));
                setcookie('id_role' , $role_id, (time() + (3 * 24 * 3600)));
                
            }

            $data = array(
                'username' => $options['username'],
                'id_role' => $role_id,
                'user' => $userDataObject
            );

            $auth->getStorage()->write($data);
            $this->_redirect('/home');
        } else {
            $this->_helper->flashMessenger->addMessage("Authentication error.");
            $this->_redirect('/login/index');
        }
    }

    /**
     * Logout
     */
    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        
        session_destroy();
        $this->_redirect('/login');
    }

    public function passAction() {
        //$password = sha1($this->_options['auth']['salt'] . 'enrico');
        $password = sha1($this->_options['auth']['salt'] . 'enrico');
        die($password);
    }

    public function cadastrarAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->layout()->setLayout('cadastro');
    }

    public function loadufAction() {
        $this->_helper->layout->disableLayout();

        $EstadosMapper = new Home_Model_Mapper_EstadosMapper();
        $estados = $EstadosMapper->findEstado();

        echo json_encode($estados);
    }

    public function cidadesAction() {
        $this->_helper->layout->disableLayout();

        $cidadesMapper = new Home_Model_Mapper_CidadesMapper();
        $uf = $this->getRequest()->getParam('estado');
        $cidades = $cidadesMapper->findCidades($uf);

        echo json_encode($cidades);
    }

    public function saveAction() {
        $this->_helper->layout->disableLayout();

        if (!empty($_POST)) {
            $userMapper = new Home_Model_Mapper_UsersMapper();
            $save = $userMapper->save($_POST);
            if ($save == true) {
                echo json_encode(array('result' => 1));
            } else {
                echo json_encode(array('result' => 0));
            }
        }
    }

}
