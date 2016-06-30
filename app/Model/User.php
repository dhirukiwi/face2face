<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('AuthComponent', 'Controller/Component');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('AclComponent', 'Controller/Component');

class User extends AppModel {

    public $belongsTo = array('Group');
    public $actsAs = array('Acl' => array('type' => 'requester'));

    //public $foreignKey = 'group_id';

    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        }
        return array('Group' => array('id' => $groupId));
    }

    public function beforeSave($options = array()) {

        if (isset($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        return true;
    }

    public $validate = array(
        'first_name' => array(
            
                'rule' => 'notBlank',
                 'required'=>true,
		'message' => 'first name is required',
        ),
        'username' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A username is required',
                'required'=>true
            ),
            'uniqueUserRule' => array(
                'rule' => 'isUnique',
                'message' => 'User already registered'
            )
        ),
        'email' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Email is required',
                'required'=>true
            ),
            'email' => array(
                'rule' => 'email',
                'message' => 'Enter Valid Email'
            ),
            'uniqueUserRule' => array(
                'rule' => 'isUnique',
                'message' => 'Email already registered'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Password is required',
                'required'=>true
                
            ),
            array(
                'rule' => array('minLength', 6),
                'message' => 'Passwords must be at least 8 characters long.',
            ),
            array(
                'rule' => 'password_strength',
                'message' => 'Password must have (A-Z), (a-z), (0-9) and a Special Character.'
            )
        ),
        'cpassword' => array(
             'required' => array(
           
                'rule' => 'notBlank',
                'message' => 'Please Enter Confirm password',
                'required'=>true
            ),
            array(
                'rule' => 'confirm_passwords',
                'message' => 'Password & Confirm Password must be match.'
            )
        ),
        'group_id' => array(
        'required' => array(
           
                'rule' => 'notBlank',
                'message' => 'Please Enter valid Group id',
                'required'=>true
            )
      )
    );
    
    function confirm_passwords() {  
        if(!empty($this->data['User']['password']) && !empty($this->data['User']['cpassword'])){
        if (strcmp($this->data['User']['password'], $this->data['User']['cpassword']) == 0) {
            return true;
        }
        }
        return false;
    }

    function password_strength() {
        // to check pasword and confirm password
        if(!empty($this->data['User']['password']))
            {
        
        $uppercase = preg_match('@[A-Z]@', $this->data['User']['password']);
        $lowercase = preg_match('@[a-z]@', $this->data['User']['password']);
        $number    = preg_match('@[0-9]@', $this->data['User']['password']);
        $special   = preg_match('@[\W]{1,}@', $this->data['User']['password']);

        if(!$uppercase || !$lowercase || !$number || !$special) {
          return false;
        }
            }
        return true;
    }
}
    