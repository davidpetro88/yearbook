<?php

/**
 * App_Plugin_SecurityCheck
 * 
 * @author David Petro
 */
class Login_Plugin_SecurityCheck extends Zend_Controller_Plugin_Abstract
{

    const MODULE_NO_AUTH = 'login';

    private $_controller;

    private $_module;

    private $_action;

    private $_role;

    /**
     * preDispatch
     *
     * @param Zend_Controller_Request_Abstract $request            
     */
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $this->_controller = $this->getRequest()->getControllerName();
        $this->_module = $this->getRequest()->getModuleName();
        $this->_action = $this->getRequest()->getActionName();
        
        $auth = Zend_Auth::getInstance();
        
        $redirect = true;
        if ($this->_module != self::MODULE_NO_AUTH) {
            
            if ($this->_isAuth($auth)) {
                $user = $auth->getStorage()->read();
                if (! empty($user['id_role'])) {
                    $this->_role = $user['id_role'];
                }
                $bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
                $db = $bootstrap->getResource('db');
                
                $manager = $bootstrap->getResource('cachemanager');
                
                $acl = new Login_Acl($db, (string) $this->_role);
                
                if ($this->_isAllowed($auth, $acl)) {
                    
                    $redirect = false;
                }
            }
        } else {
            
            if ((! empty($_COOKIE['username'])) && (! empty($_COOKIE['id_role']))) {
                
                $userClass = new Home_Model_Mapper_UsersMapper();
                $userDataObject = $userClass->fetchByUsername($_COOKIE['username']);
                
                $data = array(
                    'username' => $_COOKIE['username'],
                    'id_role' => $_COOKIE['id_role'],
                    'user' => $userDataObject
                );
                
                $auth->getStorage()->write($data);
                
                $user = $auth->getStorage()->read();
                
                $bootstrap = Zend_Controller_Front::getInstance()->getParam('bootstrap');
                $db = $bootstrap->getResource('db');
                
                $manager = $bootstrap->getResource('cachemanager');
                
                if (! empty($user)) {
                    $object = new stdClass();
                    $object->role = $user['id_role'];
                    $object->username = $user['username'];
                    
                    $acl = new Login_Acl($db, (string) $object->role);
                } else {
                    
                    $acl = new Login_Acl($db, (string) $this->_role);
                }
                
                if ($this->_isAllowed($auth, $acl)) {
                    
                    $redirect = false;
                }
            } else {
                
                $redirect = false;
            }
        }
        
        if ($redirect) {
            
            $request->setModuleName('login');
            $request->setControllerName('index');
            $request->setActionName('index');
        }
    }
    
    // setcookie('auth', $user['id_role'], time() + 3600);
    
    /**
     * Check user identity using Zend_Auth
     *
     * @param Zend_Auth $auth            
     * @return boolean
     */
    private function _isAuth(Zend_Auth $auth)
    {
        if (! empty($auth) && ($auth instanceof Zend_Auth)) {
            return $auth->hasIdentity();
        }
        return false;
    }

    /**
     * Check permission using Zend_Auth and Zend_Acl
     *
     * @param Zend_Auth $auth            
     * @param Zend_Acl $acl            
     * @return boolean
     */
    private function _isAllowed(Zend_Auth $auth, Zend_Acl $acl)
    {
        if (empty($auth) || empty($acl) || ! ($auth instanceof Zend_Auth) || ! ($acl instanceof Zend_Acl)) {
            return false;
        }
        $resources = array(
            '*/*/*',
            $this->_module . '/*/*',
            $this->_module . '/' . $this->_controller . '/*',
            $this->_module . '/' . $this->_controller . '/' . $this->_action
        );
        $result = false;
        
        if (is_array($resources)) {
            
            foreach ($resources as $res) {
                
                if ($acl->has($res)) {
                    if (! empty($_COOKIE['id_role'])) {
                        $result = $acl->isAllowed($_COOKIE['id_role'], $res);
                    } else {
                        $result = $acl->isAllowed($this->_role, $res);
                    }
                }
            }
        }
        return $result;
    }
}
