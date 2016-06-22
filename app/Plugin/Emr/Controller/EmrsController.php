<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//App::uses('ConnectionManager', 'Model');
 class EmrsController extends EmrAppController {
     
     public function index(){
            $this->Patient->useDbConfig = 'emr1';
            $this->loadModel('Patient');
            
            $patients = $this->Patient->find('all');
            pr($patients);die;
     }
 }

