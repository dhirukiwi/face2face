<?php

class UsersController extends AppController {
    public $components = array('RequestHandler','Auth','Session');
    public $helpers = array('Html','Form');
    public $uses = array('Token','User');
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->Auth->allow();
    }
    /*public function initDB() {
    $group = $this->User->Group;

    // Allow admins to everything
    $group->id = 1;
    $this->Acl->allow($group, 'controllers');

    // allow providers to posts and widgets
    $group->id = 2;
    $this->Acl->deny($group, 'controllers');
    $this->Acl->allow($group, 'controllers/Posts');
    //$this->Acl->allow($group, 'controllers/Widgets');

    // allow users to only add and edit on posts and widgets
    $group->id = 3;
    $this->Acl->deny($group, 'controllers');
    $this->Acl->allow($group, 'controllers/Posts/add');
    $this->Acl->allow($group, 'controllers/Posts/edit');
    $this->Acl->allow($group, 'controllers/Widgets/add');
    $this->Acl->allow($group, 'controllers/Widgets/edit');

    // allow basic users to log out
    $this->Acl->allow($group, 'controllers/users/logout');

    // we add an exit to avoid an ugly "missing views" error message
    echo "all done";
    exit;
}*/
    public function index() {
        
        //$this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }
    public function signup() {
        
        if ($this->request->is('post')) {
            
            
            $data = $this->request->data;
            $this->User->set($data);
            if($this->User->validates()) {
                $this->User->create();
                if ($this->User->save($data)) {
                    return $this->set(array(
                        'userdata' => 'The user has been saved',
                        '_serialize' => array('userdata')
                    ));

                }
                else{
                return $this->set(array(
                    'userdata' =>$data,
                    '_serialize'=>array('userdata')
                ));
                }
            } else {
                $error = $this->User->validationErrors;
               // pr($error);exit;
                $this->set(array(
                    'userdata' =>$error,
                    '_serialize'=>array('userdata')
                ));
                
            }
            
        }
         
    }
    
    public function logout() {
       
        $this->Token->delete(
                array
            (
            'conditions'=>array(
                
            'user_id'=>$this->Auth->User('id')
                )));
        $this->Auth->logout();
    }
    public function login() {
        
        if($this->Auth->loggedIn()){
        $this->redirect(array('controller' => 'users','action' => 'index'));
        }
       
        if ($this->request->is('post')){
            
            
            
            
        if ($this->Auth->login()) {
            
            $session_token = $this->Session->id();
           
            $user_id = $this->Auth->user('id');
           
            $token_array= array(
                'Token'=>array(
                 'user_id'=>$user_id,'token'=>$session_token));
            $this->Token->create();
            $this->Token->save($token_array);
             //print_r($this->Session->read(Auth.User));
            return $this->redirect($this->Auth->redirectUrl());
          
        }
        $this->Flash->error(__('Invalid username or password, try again'));
       }
        /*if ($this->request->is('post')) {
        $data = $this->request->data;
        $this->User->set($this->request->data);
        if($this->User->validates()) {
        if ($this->Auth->login()) {
       
            return $this->set(array(
                        'userdata' => 'The user login',
                        '_serialize' => array('userdata')
                    ));
        }
            
        
        }
        else {
                $error = "Username/password does not match";
               
               return $this->set(array(
                    'userdata' =>$error,
                    '_serialize'=>array('userdata')
                ));
                
            }
        }*/
        
    
         
    }
    

}

?>
