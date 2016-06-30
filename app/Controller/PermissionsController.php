<?php

/**
 *
 * @controller: CronjobsController
 * @used: this controller used for the automatically hit functioncronjob etc
 * @Action :  Used as given below
 * @ 1#upgardeSubscriptionEmail
 * @ 2#firmSubscription

 * @Component
 * @ 1#RequestHandler
 * @ 1#Auth
 * @ 1#Upload
 * @ 1#Image
 * @ 1#Message
 * @ 1#Logic
 * @barintree
 * @created date 24 May 2016
 * @modified date 24 May 2016
 * 
 * */
App::uses('Security', 'Utility');
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class PermissionsController extends AppController {

    public $helpers = array('Form', 'Html', 'Js', 'Session');
    public $components = array('RequestHandler', 'Auth');
    public $paginate = array('limit' => 25);
    public $uses = array('User', 'Group', 'ClientProfile', 'FirmProfile');

    /**
     * @method: beforeFilter
     * @used: this action used for allow action before login
     * @param: No argument receiving yet
     * @created date 24 May 2016
     * @modified date 24 May 2016
     * @return null
     * */
    public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow('login', 'forgotPassword', 'forgotChangePassword', 'clientSighup', 'firmSighup', 'upgardeSubscriptionEmail');
    }

    public function aro_rebuild() {
        $this->autoRender = false;
        //$this->Acl->check("Admin", "Admins");
        echo "Working";

        // Build the groups.
        $groups = $this->Group->find('all');
        $aro = new Aro();
        foreach ($groups as $group) {
            $aro->create();
            $aro->save(array(
                //	'alias'=>$group['Group']['name'],
                'foreign_key' => $group['Group']['id'],
                'model' => 'Group',
                'parent_id' => null
            ));
        }

        // Build the users.
        $users = $this->User->find('all');
        $i = 0;
        foreach ($users as $user) {
            $aroList[$i++] = array(
                //	'alias' => $user['User']['email'],
                'foreign_key' => $user['User']['id'],
                'model' => 'User',
                'parent_id' => $user['User']['group_id']
            );
        }
        foreach ($aroList as $data) {
            $aro->create();
            $aro->save($data);
        }

        echo "AROs rebuilt!";
        exit;
    }

    public function aro_aco_assign() {
        //App::uses('UsersController', 'Admin.Controller');
        $group = $this->User->Group;

        // Allow admins to everything
        $group->id = 3;
        $this->Acl->allow($group, 'controllers');
        $this->Acl->allow($group, 'controllers/Users/aro_aco_assign');

        // ACL for client
        $group->id = 1;

        /* $this->Acl->deny($group, 'controllers/Firms');
          $this->Acl->deny($group, 'controllers/users/clientSighup');
          $this->Acl->allow($group, 'controllers/Clients/subscription'); */
        $this->Acl->allow($group, 'controllers');

        //ACL for firms
        $group->id = 2;

        /* $this->Acl->deny($group, 'controllers/Clients');
          $this->Acl->deny($group, 'controllers/Users/clientSighup'); */
        $this->Acl->allow($group, 'controllers');


        /* $user = $this->User;
          $user->id = 42;
          $this->Acl->deny($user, 'controllers');
          $this->Acl->deny($user, 'controllers/Firms');
          $this->Acl->allow($user,'controllers/Firms/subscription'); */



        //$this->Acl->deny($group, 'controllers/users/clientSighup');
        //$result = $this->Acl->check(array('User' => array('id' => 1)), 'controllers');
        //print_r($result);
        echo "all done";
        exit;
    }

    function test() {
        $Role->id = 1;
        $this->Acl->allow($aro, 'controller/');
    }

    /**
     * total methos 1:
     * tab-width: 1
     * c-hanging-comment-ender-p: nil
     * End:
     * */
}
