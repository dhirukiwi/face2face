<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class GroupsController extends AppController{
    
   public function beforeFilter() {
       parent::beforeFilter();
       //$this->Auth->allow();
   }
   public function index(){
       $group = $this->Group->find('all');
       $this->set('groups',$group);
   }
   public function add(){
        
        if ($this->request->is('post')) {
            $this->Group->create();
            if ($this->Group->save($this->request->data)) {
                $this->Flash->success(__('Your Group has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your Group.'));
        }
    
   }
}

