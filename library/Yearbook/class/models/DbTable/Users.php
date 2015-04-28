<?php

class Home_Model_DbTable_Users extends Zend_Db_Table_Abstract
{
    protected $_name    = 'users';
    protected $_primary = 'username';
    protected $_dependentTables = array('Cidades');
 
    protected $_referenceMap    = array(
        'Reporter' => array(
            'columns'           => 'idCidade',
            'refTableClass'     => 'Cidades',
            'refColumns'        => 'nomeCidade'
        )
    );

}


/* 
 * 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

