<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PatientsController extends AppController{
    public $components = array('RequestHandler');
    
    public function beforeFilter() {
        parent::beforeFilter();
    }


    public function index(){
        $this->autoRender = false;
       
        $pt = $this->Patient->find('all');
        $this->set(array(
            'patients' => $pt,
            '_serialize' => array('patients')
        ));
        
    }
    
}
