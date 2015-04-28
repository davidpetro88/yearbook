<?php
/**
 * Home_Model_LastProfileSee
 *  
 * @author David Petro
 */
class Home_Model_LastProfileSee {

    public $username = 'username';
    public $profile_name = 'profile_name';
    

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
    public function getUsername() {
        return $this->username;
    }

    public function getProfile_name() {
        return $this->profile_name;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setProfile_name($profile_name) {
        $this->profile_name = $profile_name;
    }


    
    
}
