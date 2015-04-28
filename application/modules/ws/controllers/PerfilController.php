<?php

class Ws_PerfilController extends Zend_Controller_Action {

    private $options;

    /**
     * Init
     * 
     * @see Zend_Controller_Action::init()
     */
    public function init() {
        $this->_options = $this->getInvokeArg('bootstrap')->getOptions();
        $this->_helper->layout->disableLayout();
    }

    /**
     * Index
     */
    public function indexAction() {

        $auth = Zend_Auth::getInstance();
        $this->view->user = $auth->getStorage()->read();
    }

    /**
     * Save
     */
    public function saveAction() {
        
    }

    /**
     * Controler Edit URL http://yearbook/ws/perfil/edit
     */
    public function editAction() {

        $auth = Zend_Auth::getInstance();
        $read = $auth->getStorage()->read();

        if ((!empty($read['user']->username))) {
            $usersMapper = new Home_Model_Mapper_UsersMapper();
            $userName = $read['user']->username;
            $nome = $this->getRequest()->getParam('nomeCompleto');
            $estado = $this->getRequest()->getParam('estado');
            $cidade = $this->getRequest()->getParam('cidade');
            $email = $this->getRequest()->getParam('email');

            $imagePost = $this->getRequest()->getParam('image');

            if (!empty($imagePost)) {

                $image = explode('base64,', $imagePost);
                $diretory = APPLICATION_PROFILE . '/' . $read['user']->username . '.jpg';

                $text = explode('yearbook/public', $diretory);
                $updateUser = $usersMapper->updateUser($userName, $nome, $cidade, $email, $diretory, $image[1]);

                echo json_encode(array('result' => $updateUser));
            } else {
                echo json_encode(array('result' => NULL));
            }
        } else {
            echo json_encode(array('result' => NULL));
        }
    }

    /**
     * Controller user image http://yearbook/ws/perfil/userimage
     */
    public function userimageAction() {
        $auth = Zend_Auth::getInstance();
        $read = $auth->getStorage()->read();


        if ((!empty($read['user']->username))) {
            $diretorio = $_SERVER['DOCUMENT_ROOT'] . $read['user']->arquivoFoto;

            echo json_encode(array('image' => $this->base64_encode_image($diretorio, 'jpg')));
        }
    }

    /**
     * Controler list users http://yearbook/ws/perfil/listusers
     */
    public function listusersAction() {
        $usersMapper = new Home_Model_Mapper_UsersMapper();
        $fetchAllUser = $usersMapper->fetchAll();

        if (!empty($fetchAllUser)) {
            echo json_encode($fetchAllUser);
        } else {
            echo json_encode(array('result' => 'error'));
        }
    }

    /**
     * Controler find http://yearbook/ws/perfil/find/nome/david%20ab
     */
    public function findAction() {

        $nome = $this->getRequest()->getParam('nome');
        $usersMapper = new Home_Model_Mapper_UsersMapper();

        $findUser = $usersMapper->findUser($nome);
        if (!empty($findUser)) {
            echo json_encode($findUser);
        } else {
            echo json_encode(array('result' => 'error'));
        }
    }

    public function finduserAction() {

        $username = $this->getRequest()->getParam('username');

        $usersMapper = new Home_Model_Mapper_UsersMapper();
        $userFetch = $usersMapper->fetchByUsername($username);

        if (!empty($userFetch)) {
            echo json_encode($userFetch);
        } else {
            echo json_encode(array('result' => 'error'));
        }

        // $auth = Zend_Auth::getInstance();
        //$this->view->user = $auth->getStorage()->read();
    }

    /**
     * Metodo para converter image
     * 
     * @param type $filename
     * @param type $filetype
     * @return type
     */
    public function base64_encode_image($filename = string, $filetype = string) {
        if ($filename) {
            $imgbinary = fread(fopen($filename, "r"), filesize($filename));

            return 'data:image/png;base64,' . base64_encode($imgbinary);
        }
    }

}
