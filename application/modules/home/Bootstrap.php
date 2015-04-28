<?php

//include '/var/www/yearbook/application/modules/home/models/Mapper/UsersMapper.php';


class Home_Bootstrap extends Zend_Application_Module_Bootstrap {

    //Can be left blank

    protected function _initAutoLoad() {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->suppressNotFoundWarnings(false);

        $loader = new Zend_Loader_Autoloader_Resource(
                array(
            'namespace' => 'Yearbook_',
            'basePath' => APPLICATION_PATH . "/../library/nusoap/",
                )
        );
    }

}
