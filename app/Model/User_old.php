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
        'username' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A username is required'
            ),
            'required' => true,
            'uniqueUserRule' => array(
            'rule' => 'isUnique',
            'message' => 'User already registered'
        )
        ),
         
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A password is required'
            )
        ),
        'group_id' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'provider','consumer','patient')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );

}

