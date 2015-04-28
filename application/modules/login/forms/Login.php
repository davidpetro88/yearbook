<?php

/**
 * Login_Form_Login
 * 
 * @author David Petró
 */
class Login_Form_Login extends Zend_Form {

    private $_timeout;

    public function __construct($options = null) {
        if (is_array($options)) {
            if (!empty($options['custom'])) {
                if (!empty($options['custom']['timeout'])) {
                    $this->_timeout = $options['custom']['timeout'];
                }
                unset($options['custom']);
            }
        }
        parent::__construct($options);
    }

    public function init() {
        $this->addElement('hash', 'token', array(
            'timeout' => $this->_timeout
        ));

        $this->addElement('text', 'username', array(
            'label' => 'Username',
            'required' => true,
            'class' => 'form-control product',
            'validators' => array('Alnum')
                //$name->setOptions(array('class'=>'css class name'));
        ));
        $this->addElement('password', 'password', array(
            'label' => 'Password',
            'required' => true,
            'class' => 'form-control product',
            'validators' => array('Alnum'),
        ));


        $this->addElement('checkbox', 'manter_logado', array(
            'class' => 'checkbox',
            'value' => '1',
            'style' => array('color:red'),
            'label' => 'Manter Logado',
        ));

        $this->addElement('submit', 'submit', array(
            'label' => 'Login',
            'class' => 'btn btn-primary pull-right'
        ));
    }

}
