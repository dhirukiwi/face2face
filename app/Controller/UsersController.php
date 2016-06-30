<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('curl', 'Lib');
class UsersController extends AppController {
    public $components = array('RequestHandler','Auth','Session','Message', 'Validate');
    public $helpers = array('Html','Form');
    public $uses = array('Token','User');
    //Moodle Registration variables
    private $token;          //'0b5a1e98061c5f7fb70fc3b42af6bfc4';
    private $domainName;     // 'http://local.moodle.dev';
    private $serverUrl;
    public  $error;
    public  $response;
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
         //$this->autoRender=false;
        //echo $_SERVER['HTTP_HOST'];exit;
         $result = array();
        if ($this->request->is('post')) {
            $data = $this->request->input('json_decode', true);
            $this->User->set($data);

            if ($this->User->validates() && $this->Validate->valid_body($data)) {
                //Start - Moodle Sign Up User
                $moodleRes = $this->moodleSignup($data);
            pr($moodleRes);exit;
            
            if(is_array($moodleRes)) {
                
                $data['User']['moodle_id'] = $moodleRes[0]->id;
                
                 if ($this->User->save($data)) {
                    
                    //Send Email with registratio link
                    $this->Validate->sendEmailVerification($data['email']);

                    $result = $this->set(
                            array(
                                'code' => Configure::read('Message.code.1'),
                                'status' => Configure::read('Message.status.1'),
                                'message' => Configure::read('Message.message.1'), //success
                                '_serialize' => array('code', 'status', 'message')
                            )
                    );
                }
                
                else {
                    $result = $this->set(
                            array(
                                'code' => Configure::read('Message.code.5'),
                                'status' => Configure::read('Message.status.5'),
                                'message' => Configure::read('Message.message.5'), //success
                                '_serialize' => array('code', 'status', 'message')
                            )
                    );
                }
                
                
            } else if(!empty($moodleRes->message)) { 
               // $response['code'] = '402';
                $response['error'] = $moodleRes->exception;
                if(isset($moodleRes->debuginfo)) {
                    $response['message'] = $moodleRes->message.'\n'.$moodleRes->debuginfo;
                } else {
                    $response['message'] = $moodleRes->message;
                }
                
                  $result = $this->set(
                            array(
                                'code' => Configure::read('Message.code.5'),
                                'status' => $response['error'],
                                'message' => $response['message'], //success
                                '_serialize' => array('code', 'status', 'message')
                            )
                    );
            }
            else{
                $result = $this->set(
                            array(
                                'code' => Configure::read('Message.code.5'),
                                'status' => Configure::read('Message.status.5'),
                                'message' => Configure::read('Message.message.5'), //success
                                '_serialize' => array('code', 'status', 'message')
                            )
                    ); 
            }
                //End - Moodle sign up
                
               
            } else {
                $error = count($this->User->validationErrors) ? $this->User->validationErrors : Configure::read('Message.message.5');
                $result = $this->set(
                        array(
                            'code' => Configure::read('Message.code.5'),
                            'status' => Configure::read('Message.status.5'),
                            'message' => $error, //success
                            '_serialize' => array('code', 'status', 'message')
                        )
                );
            }
        }

        return $result;
    }
    protected function moodleSignup($data) {
        
        $this->token = '1635e3a9a0b72be68dbca5514476503f';
        $this->domainName = 'http://localhost/moodle';

        $this->serverUrl = $this->domainName . '/webservice/rest/server.php' . '?wstoken=' . $this->token;
       
        if(!empty($data)) {
            $functionName = 'core_user_create_users';
            $user1 = new stdClass();
            $user1->username = $data['username'];
            $user1->password = $data['password'];
            $user1->firstname = $data['first_name'];
            $user1->lastname = $data['last_name'];
            $user1->email = $data['email'];
            $user1->auth = 'manual';
            $user1->idnumber = '';
            $user1->lang = 'en';
            $user1->timezone = '0';
            $user1->mailformat = 0;
            $user1->description = '';
            $user1->city = 'Noida';
            $user1->country = 'IN';     //list of abrevations is in yourmoodle/lang/en/countries
            $preferencename1 = 'auth_forcepasswordchange';
            $user1->preferences = array(
                array('type' => $preferencename1, 'value' => 'true')
                );

            $users = array($user1); 
            $params = array('users' => $users);
            //pr($params);exit;
            /// REST CALL
            $restformat = "json";
           // header('Content-Type: text/plain');
            $serverurl = $this->serverUrl . '&wsfunction=' . $functionName. '&moodlewsrestformat=' . $restformat;
          //  require_once (DOCUMENT_ROOT . '/tcm/api/moodle/curl.php');
          //  echo $serverurl;exit;
            $curl = new curl();


            $resp = $curl->post($serverurl, $params);
            pr($resp);exit;
            return json_decode($resp);
          /*  echo '</br>************************** Server Response    createUser()**************************</br></br>';
            echo $serverurl . '</br></br>';

            var_dump($resp);*/
        }
            
    }
    public function verify_account() {
        $path = func_get_args();
        $this->loadModel('User');

        if (count($path)) {
            $user_mail = base64_decode($path[0]);
            $user_details = $this->User->find('first', array('conditions' => array('User.email' => $user_mail), 'fields' => array('id', 'status')));
            if (count($user_details)) {
                if ($user_details['User']['status'] === 'Inactive') {
                    $this->User->updateAll(array('User.status' => "'Active'"), array('User.id' => $user_details['User']['id']));

                    $result = $this->set(
                            array(
                                'code' => Configure::read('Message.code.1'),
                                'status' => Configure::read('Message.status.1'),
                                'message' => Configure::read('Message.message.1'), //success
                                '_serialize' => array('code', 'status', 'message')
                            )
                    );
		
                } else {
                    $result = $this->set(
                            array(
                                'code' => Configure::read('Message.code.5'),
                                'status' => Configure::read('Message.status.5'),
                                'message' => Configure::read('Message.message.5'), //success
                                '_serialize' => array('code', 'status', 'message')
                            )
                    );
                }
            } else {
                $result = $this->set(
                        array(
                            'code' => Configure::read('Message.code.5'),
                            'status' => Configure::read('Message.status.5'),
                            'message' => Configure::read('Message.message.5'), //success
                            '_serialize' => array('code', 'status', 'message')
                        )
                );
            }
        } else {
            $result = $this->set(
                    array(
                        'code' => Configure::read('Message.code.5'),
                        'status' => Configure::read('Message.status.5'),
                        'message' => Configure::read('Message.message.5'), //success
                        '_serialize' => array('code', 'status', 'message')
                    )
            );
        }

        return $result;
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
    public function forgotPassword() {
        $this->loadModel('User');
        if ($this->request->is('post')) {
            $data = $this->request->input('json_decode', true);

            if ($this->Validate->valid_body($data)) {
                $get_details = $this->User->find('first', array('conditions' => array('User.email' => $data['email'])));
                if (count($get_details)) {
                    $guid = $this->Validate->guid();
                    $this->User->updateAll(array('User.guid' => $guid, 'User.guid_created' => date('Y-m-d H:i:s')), array('User.email' => $data['email']));
                    $this->Validate->forgotPasswordMail($data['email'], $guid);
                } else {
                    
                }
            } else {
                
            }
        }
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
