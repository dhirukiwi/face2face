<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Token extends AppModel{
    public $belongsTo = array('User');
    
    public function check_token() {
         $messages = '';
	 $is_token = false;
         if(isset($_SERVER['HTTP_TOKEN'])) {
              $auth_token = $_SERVER['HTTP_TOKEN'];	
         }
         //pr($_SERVER['HTTP_TOKEN']);exit;
        if(!empty($auth_token)) {
            $finduser = $this->findByToken(trim($auth_token));
            
            if($finduser){
                $is_token = true;
                $message = array(
                    'code' => Configure::read('Message.code.1'),
                    'status' => Configure::read('Message.status.1'),
                    'message' => Configure::read('Message.message.1'),
                    '_serialize' => array('code', 'status', 'message')
                );
            } else { 
                 $message = array(
                    'code' => Configure::read('Message.code.6'),
                    'status' => Configure::read('Message.status.6'),
                    'message' => 'Token not found in header',
                    '_serialize' => array('code', 'status', 'message')
                );
            }
        } else {
             $message =  $message = array(
                    'code' => Configure::read('Message.code.6'),
                    'status' => Configure::read('Message.status.6'),
                    'message' => 'Invalid Token',
                    '_serialize' => array('code', 'status', 'message')
                );
        }
        $returndata['is_token'] = $is_token;
        $returndata['message'] = $message;
        return $returndata;
    }
    
    function findByToken($tokenId = null) {
        if (!empty($tokenId)) {
            $this->recursive = -1; 
            $tokens = $this->find('first', array(
                'conditions' => array('Token.token' => $tokenId)
            ));
           return $tokens;
        }
    }
    
    function findUserIDByToken($tokenId = null) {
        if (!empty($tokenId)) {
            $this->recursive = -1; 
            $tokens = $this->find('first', array(
                'conditions' => array('Token.token' => $tokenId),
                'fields'=>array('Token.user_id')
            ));
           // pr($tokens);exit;
            if(!empty($tokens['Token']['user_id'])) {
                return $tokens['Token']['user_id'];
            } else {
                return false;
            }
        }
    }
}

