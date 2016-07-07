<?php

App::uses('CakeEmail', 'Network/Email');
App::uses('curl', 'Lib');
App::uses('HttpSocket', 'Network/Http');
class UsersController extends AppController {

    public $components = array('RequestHandler', 'Auth', 'Session', 'Message', 'Validate');
    public $helpers = array('Html', 'Form');
    public $uses = array('Token', 'User');
    //Moodle Registration variables
    /*private $token;          //'0b5a1e98061c5f7fb70fc3b42af6bfc4';
    private $domainName;     // 'http://local.moodle.dev';
    
    public $error;
    public $response;*/
    
    private $token = 'd114af5389ec78638b9b47fa9cba97a9';
    private $serverUrl;
    private $moodlewsrestformat = 'json';
    private $webservice_url= 'http://localhost/moodle/webservice/rest/server.php';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    /* public function initDB() {
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
      } */

    public function index() {

        //$this->User->recursive = 0;
        //$this->set('users', $this->paginate());
        $result = $this->set(
                array(
                    'code' => Configure::read('Message.code.1'),
                    'status' => Configure::read('Message.status.1'),
                    'message' => "Already login",
                    '_serialize' => array('code', 'status', 'message')
                )
        );
        return $result;
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
                //pr($moodleRes);exit;

                if (is_array($moodleRes)) {

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
                } else if (!empty($moodleRes->message)) {
                    // $response['code'] = '402';
                    $response['error'] = $moodleRes->exception;
                    if (isset($moodleRes->debuginfo)) {
                        $response['message'] = $moodleRes->message . '\n' . $moodleRes->debuginfo;
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
        } else {
            $result = $this->set(
                array(
                    'code' => Configure::read('Message.code.8'),
                    'status' => Configure::read('Message.status.8'),
                    'message' => Configure::read('Message.message.8'), //success
                    '_serialize' => array('code', 'status', 'message')
                )
            );
        }

        return $result;
    }

    protected function moodleSignup($data) {

       // $this->token = 'd114af5389ec78638b9b47fa9cba97a9';
       // $this->domainName = 'http://localhost/moodle';

        $this->serverUrl = $this->webservice_url . '?wstoken=' . $this->token;

        if (!empty($data)) {
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
            header('Content-Type: text/plain');
            $serverurl = $this->serverUrl . '&wsfunction=' . $functionName . '&moodlewsrestformat=' . $restformat;
            $curl = new curl();
            $resp = $curl->post($serverurl, $params);
            // pr($resp);
            //exit;
            return json_decode($resp);
        }
    }

    public function login() {
        //$this->autoRender = false;
        if ($this->Auth->loggedIn()) {
            $this->redirect(array('controller' => 'users', 'action' => 'index'));
        }

        /* if ($this->request->is('post')) {




          if ($this->Auth->login()) {

          $session_token = $this->Session->id();
          $user_id = $this->Auth->user('id');

          $token_array = array(
          'Token' => array(
          'user_id' => $user_id, 'token' => $session_token));
          $this->Token->create();
          $this->Token->save($token_array);
          //print_r($this->Session->read(Auth.User));
          return $this->redirect($this->Auth->redirectUrl());
          }
          $this->Flash->error(__('Invalid username or password, try again'));
          } */
        $result = array();
        if ($this->request->is('post')) {
            //pr($_POST);exit;
            $this->request->data['User'] = $data = $this->request->input('json_decode', true);
            //$$this->request->data['User'] = $this->request->data;
            // pr($this->data);exit;
            // $this->request->data['User'] = $this->request->data;
            // pr($this->request->data);exit;
            $this->User->set($data);
            $this->User->setLogin();
            if ($this->User->validates()) {
                if ($this->Auth->login()) {

                    //$session_token = $this->Session->id();

                    $user_id = $this->Auth->user('id');
                    $session_token = md5($user_id . $data['username'] . rand(6, 8));

                    $token_array = array(
                        'Token' => array(
                            'user_id' => $user_id, 'token' => $session_token));
                    $this->Token->create();
                    $this->Token->save($token_array);
                    //print_r($this->Session->read(Auth.User));
                    $result = $this->set(
                            array(
                                'code' => Configure::read('Message.code.1'),
                                'status' => Configure::read('Message.status.1'),
                                'message' => Configure::read('Message.message.1'), //success
                                'token' => $session_token,
                                '_serialize' => array('code', 'status', 'token', 'message')
                            )
                    );
                } else {
                    $result = $this->set(
                            array(
                                'code' => Configure::read('Message.code.6'),
                                'status' => Configure::read('Message.status.6'),
                                'message' => Configure::read('Message.message.6'), //success
                                '_serialize' => array('code', 'status', 'message')
                            )
                    );
                }
            } else {
                //$error = "Username/password does not match";
                $error = count($this->User->validationErrors) ? $this->User->validationErrors : Configure::read('Message.message.5');

                $result = $this->set(
                        array(
                            'code' => Configure::read('Message.code.6'),
                            'status' => Configure::read('Message.status.6'),
                            'message' => $error, //success
                            '_serialize' => array('code', 'status', 'message')
                        )
                );
            }
        } else {
            $result = $this->set(
                array(
                    'code' => Configure::read('Message.code.8'),
                    'status' => Configure::read('Message.status.8'),
                    'message' => Configure::read('Message.message.8'), //success
                    '_serialize' => array('code', 'status', 'message')
                )
            );
        }
        return $result;
    }

    public function verify_account() {
        $path = func_get_args();
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

    /* public function logout() {

      $this->Token->deleteAll([
      'Token.user_id' => $this->Auth->User('id')
      ]);
      //echo $this->Auth->User('id');exit;
      $this->Auth->logout();
      $result = $this->set(
      array(
      'code' => Configure::read('Message.code.1'),
      'status' => Configure::read('Message.status.1'),
      'message' => Configure::read('Message.message.1'),
      '_serialize' => array('code', 'status', 'message')
      )
      );
      return $result;
      } */

    public function logout() {
        $result = array();
        $checkToken = $this->Token->check_token();
        if (!$checkToken['is_token']) {
            $result = $this->set(
                    array(
                        'code' => Configure::read('Message.code.6'),
                        'status' => Configure::read('Message.status.6'),
                        'message' => Configure::read('Message.message.6'), //success
                        '_serialize' => array('code', 'status', 'message')
                    )
            );
        } else if ($this->request->is('delete')) {
            $auth_token = $_SERVER['HTTP_TOKEN'];
            $checkToken = $this->Token->findByToken(trim($auth_token));
            if (isset($checkToken['Token']['id'])) {
                $token_id = $checkToken['Token']['id'];
                //echo $token_id;exit;
                // $userid = $this->User->get_user_id();
                //$this->Token->delete($token_id);
                $this->Token->deleteAll([
                    'Token.user_id' => $checkToken['Token']['user_id']
                ]);
                /* Disable Push Notification Start */
                // $this->User->id = $userid;
                // $this->User->saveField("push_notification", "no");
                /* Disable Push Notification End */
                $this->Auth->logout();
                $result = $this->set(
                        array(
                            'code' => Configure::read('Message.code.1'),
                            'status' => Configure::read('Message.status.1'),
                            'message' => "User successfully logout.", //success
                            '_serialize' => array('code', 'status', 'message')
                        )
                );
            } else {
                $result = $this->set(
                        array(
                            'code' => Configure::read('Message.code.6'),
                            'status' => Configure::read('Message.status.6'),
                            'message' => Configure::read('Message.message.6'), //success
                            '_serialize' => array('code', 'status', 'message')
                        )
                );
            }
        } else {
            $result = $this->set(
                array(
                    'code' => Configure::read('Message.code.8'),
                    'status' => Configure::read('Message.status.8'),
                    'message' => Configure::read('Message.message.8'), //success
                    '_serialize' => array('code', 'status', 'message')
                )
            );
        }


        return $result;
    }

    public function forgotPassword() {
        $result = array();
        if ($this->request->is('post')) {
            $data = $this->request->input('json_decode', true);
            if ($this->Validate->valid_body($data) and ! empty($data['email'])) {
                $get_details = $this->User->find('first', array('conditions' => array('User.email' => $data['email'])));
                if (count($get_details)) {
                    $guid = $this->Validate->guid();
                    // $this->User->updateAll(array('User.guid' => $guid, 'User.guid_created' => date('Y-m-d H:i:s')), array('User.email' => $data['email']));
                    $this->User->id = $get_details['User']['id'];
                    if ($this->User->id) {
                        $this->User->saveField('guid', $guid);
                        $this->User->saveField('guid_created', date('Y-m-d H:i:s'));
                    }
                    $isSent = $this->Validate->forgotPasswordMail($data['email'], $guid);
                    if ($isSent) {
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
                                    'code' => Configure::read('Message.code.6'),
                                    'status' => Configure::read('Message.status.6'),
                                    'message' => Configure::read('Message.message.6'), //success
                                    '_serialize' => array('code', 'status', 'message')
                                )
                        );
                    }
                } else {
                    $result = $this->set(
                            array(
                                'code' => Configure::read('Message.code.6'),
                                'status' => Configure::read('Message.status.6'),
                                'message' => Configure::read('Message.message.6'), //success
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
                    'code' => Configure::read('Message.code.8'),
                    'status' => Configure::read('Message.status.8'),
                    'message' => Configure::read('Message.message.8'), //success
                    '_serialize' => array('code', 'status', 'message')
                )
            );
        }
        return $result;
    }

    public function reset_password() {
        $result = array();
        $path = func_get_args();
        if ($this->request->is('post')) {
            $this->request->data['User'] = $this->request->input('json_decode', true);
            $this->User->set($this->request->data['User']);
            $this->User->setPassword();
            if ($this->User->validates() and count($path) > 0) {
                $get_details = $this->User->find('first', array('conditions' => array('User.guid' => $path[0])));
                if (count($get_details)) {

                    $this->User->id = $get_details['User']['id'];
                    $guidCreated = strtotime($get_details['User']['guid_created']) + 86400;
                    //echo $guidCreated.'-'.time();exit;
                    if ($this->User->id and $guidCreated >= time()) {
                        $this->User->saveField('password', $this->request->data['User']['password']);
                        $this->User->saveField('guid', null);
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
                                    'code' => Configure::read('Message.code.6'),
                                    'status' => Configure::read('Message.status.6'),
                                    'message' => "Your link is expired please try again", //success
                                    '_serialize' => array('code', 'status', 'message')
                                )
                        );
                    }
                    // echo $this->User->id;exit;
                } else {
                    $result = $this->set(
                            array(
                                'code' => Configure::read('Message.code.6'),
                                'status' => Configure::read('Message.status.6'),
                                'message' => Configure::read('Message.message.6'), //success
                                '_serialize' => array('code', 'status', 'message')
                            )
                    );
                }
            } else {
                $error = count($this->User->validationErrors) ? $this->User->validationErrors : Configure::read('Message.message.5');

                $result = $this->set(
                        array(
                            'code' => Configure::read('Message.code.6'),
                            'status' => Configure::read('Message.status.6'),
                            'message' => $error, //success
                            '_serialize' => array('code', 'status', 'message')
                        )
                );
            }
        } else {
            $result = $this->set(
                array(
                    'code' => Configure::read('Message.code.8'),
                    'status' => Configure::read('Message.status.8'),
                    'message' => Configure::read('Message.message.8'), //success
                    '_serialize' => array('code', 'status', 'message')
                )
            );
        }
        return $result;
    }
    
    public function changePassword() {
        $result = array();
        if($this->request->is('put')) {
            if(!empty($_SERVER['HTTP_TOKEN'])) {
                $tokenId = $this->Token->findUserIDByToken($_SERVER['HTTP_TOKEN']);
                if(empty($tokenId)) {
                    return $result = $this->set(
                        array(
                            'code' => Configure::read('Message.code.6'),
                            'status' => Configure::read('Message.status.6'),
                            'message' => Configure::read('Message.message.6'), //success
                            '_serialize' => array('code', 'status', 'message')
                        )
                    );
                }
            }
            $this->request->data['User'] = $this->request->input('json_decode', true);
            $this->User->set($this->request->data['User']);
            $this->User->changePasswordValidation();
            
            if ($this->User->validates() and !empty($tokenId)) { 
                $isExists = $this->User->checkOldPassword($this->request->data['User']['old_password']);                 if($isExists) {
                   $this->User->changePassword($this->request->data['User']['password'], $tokenId);                         $result = $this->set(
                        array(
                            'code' => Configure::read('Message.code.1'),
                            'status' => Configure::read('Message.status.1'),
                            'message' => "Your password has been changed", //success
                            '_serialize' => array('code', 'status', 'message')
                        )
                    );
                } else {
                    $result = $this->set(
                        array(
                            'code' => Configure::read('Message.code.6'),
                            'status' => Configure::read('Message.status.6'),
                            'message' => "Old password not matched please try again", //success
                            '_serialize' => array('code', 'status', 'message')
                        )
                    );
                }
            } else { 
                $error = count($this->User->validationErrors) ? $this->User->validationErrors : Configure::read('Message.message.5');
                $result = $this->set(
                    array(
                        'code' => Configure::read('Message.code.6'),
                        'status' => Configure::read('Message.status.6'),
                        'message' => $error, //success
                        '_serialize' => array('code', 'status', 'message')
                    )
                );
            }   
        } else {
            $result = $this->set(
                array(
                    'code' => Configure::read('Message.code.8'),
                    'status' => Configure::read('Message.status.8'),
                    'message' => Configure::read('Message.message.8'), //success
                    '_serialize' => array('code', 'status', 'message')
                )
            );
        }
        return $result;
    }
}

?>
