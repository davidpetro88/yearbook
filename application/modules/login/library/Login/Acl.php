<?php

/**
 * Login_Acl
 *
 * @author David Petró
 */

class Login_Acl extends Zend_Acl {

    /**
     * __construct
     *
     * @param Zend_Db_Adapter $db
     * @param integer $role
     */
    public function __construct($db, $role) {

        $this->loadRoles($db);
        $roles = new Login_Model_Roles($db);
        $inhRole = $role;

        if (!empty($inhRole)) {
            $this->loadResources($db, (string) $inhRole);
            $this->loadPermissions($db, (string) $inhRole);
            $inhRole = $roles->getParentRole($inhRole);
        }

    }

    /**
     * Load all the roles from the DB
     *
     * @param Zend_Db_Adapter $db
     * @return boolean
     */
    public function loadRoles($db) {
        if (empty($db)) {
            return false;
        }
        $roles = new Login_Model_Roles($db);
        $allRoles = $roles->getRoles();
        foreach ($allRoles as $role) {
            if (!empty($role->id_parent)) {
                $this->addRole(new Zend_Acl_Role($role->id), $role->id_parent);
            } else {
                $this->addRole(new Zend_Acl_Role($role->id));
            }
        }
        return true;
    }

    /**
     * Load all the resources for the specified role
     *
     * @param Zend_Db_Adapter $db
     * @param integer $role
     * @return boolean
     */
    public function loadResources($db, $role) {

        if (empty($db)) {
            return false;
        }
        $resources = new Login_Model_Resources($db);
        $allResources = $resources->getResources($role);


        foreach ($allResources as $res) {
            if (is_object($res)) {
                if (!$this->has((string) $res->resource)) {
                    $this->addResource(new Zend_Acl_Resource((string) $res->resource));
                }
            } else {
                if (!$this->has((string) $res['resource'])) {


                    $this->addResource(new Zend_Acl_Resource((string) $res['resource']));
                }
            }
        }
        return true;
    }

    /**
     * Load all the permission for the specified role
     *
     * @param Zend_Db_Adapter $db
     * @param integer $role
     * @return boolean
     */
    public function loadPermissions($db, $role) {
        if (empty($db)) {
            return false;
        }
        $permissions = new Login_Model_Permissions($db);
        $allPermissions = $permissions->getPermissions($role);
        if (is_array($allPermissions)) {
            foreach ($allPermissions as $res) {

                if (is_object($res)) {
                    if ($res->permission == 'allow') {

                        $this->allow($res->id_role, $res->resource);
                    } else {
                        $this->deny($res->id_role, $res->resource);
                    }
                } else {
                    if ($res['permission'] == 'allow') {

                        $this->allow($res['id_role'], $res['resource']);
                    } else {
                        $this->deny($res['id_role'], $res['resource']);
                    }
                }
            }
        }
        return true;
    }

}
