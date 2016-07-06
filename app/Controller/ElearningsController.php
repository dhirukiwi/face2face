<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once('/var/www/html/moodle/'.'config.php');
App::uses('HttpSocket', 'Network/Http');

class ElearningsController extends AppController {
    public $components = array('RequestHandler','Message');
    private $token = 'ab5321780313b2615e3fcc60a351d85d';
    private $moodlewsrestformat = 'json';
    private $webservice_url= 'http://localhost/moodle/webservice/rest/server.php';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function allCourses() {
        $HttpSocket = new HttpSocket();
        $allcourses = $HttpSocket->post($this->webservice_url, array(
            'wstoken' => $this->token,
            'wsfunction' => 'core_course_get_courses',
            'moodlewsrestformat' => $this->moodlewsrestformat,
        ));
        
        $allCourses_array = json_decode($allcourses);
        
        if((empty($allCourses_array->exception) && empty($allCourses_array->errorcode) && empty($allCourses_array->message))){
           
          
            return $this->set(array(
                    'code' => Configure::read('Message.code.1'),
                    'status' => Configure::read('Message.status.1'),
                    'message' => Configure::read('Message.message.1'),
                    'allCourses' => array($allCourses_array),
                    '_serialize' => array('code','status','message','allCourses')
        ));
        
        }
        else{
            
            return $this->set(array(
                    'code' => $allCourses_array->errorcode,
                    'status' => Configure::read('Message.status.5'),
                    'message' => $allCourses_array->message,
                    'allCourses' => array($allCourses_array),
                    '_serialize' => array('code','status','message','allCourses')
        ));
        }
    }

    public function coursesUserId() {
        $HttpSocket = new HttpSocket();
        $courses_by_user_id = $HttpSocket->post($this->webservice_url, array(
            'wstoken' => $this->token,
            'wsfunction' => 'core_enrol_get_users_courses',
            'userid' => '1004',
            'moodlewsrestformat' => $this->moodlewsrestformat,
        ));
        $userCourses_array = json_decode($courses_by_user_id);
        if((empty($userCourses_array->exception) && empty($userCourses_array->errorcode) && empty($userCourses_array->message))){
           
          
            return $this->set(array(
                    'code' => Configure::read('Message.code.1'),
                    'status' => Configure::read('Message.status.1'),
                    'message' => Configure::read('Message.message.1'),
                    'userCourses' => array($userCourses_array),
                    '_serialize' => array('code','status','message','userCourses')
        ));
        
        }
        else{
            
            return $this->set(array(
                    'code' => $userCourses_array->errorcode,
                    'status' => Configure::read('Message.status.5'),
                    'message' => $userCourses_array->message,
                    'userCourses' => array($userCourses_array),
                    '_serialize' => array('code','status','message','userCourses')
        ));
        }
    }

    public function coursesCourseId() {
        
        $HttpSocket = new HttpSocket();
        $courses_courseID = $HttpSocket->post($this->webservice_url, array(
            'wstoken' => $this->token,
            'wsfunction' => 'core_course_get_courses',
            'moodlewsrestformat' => $this->moodlewsrestformat,
            'options[ids][0]'=>'278'
            //'courseid'=>'278'
            
        ));
        $courseArray = json_decode($courses_courseID);
        if((empty($courseArray->exception) && empty($courseArray->errorcode) && empty($courseArray->message))){
           
          
            return $this->set(array(
                    'code' => Configure::read('Message.code.1'),
                    'status' => Configure::read('Message.status.1'),
                    'message' => Configure::read('Message.message.1'),
                    'courses_courseID' => array($courseArray),
                    '_serialize' => array('code','status','message','courses_courseID')
        ));
        
        }
        else{
            
            return $this->set(array(
                    'code' => $courseArray->errorcode,
                    'status' => Configure::read('Message.status.5'),
                    'message' => $courseArray->message,
                    'courses_courseID' => array($courseArray),
                    '_serialize' => array('code','status','message','courses_courseID')
        ));
        }
        
    }
    
  public function courseContents() {
        
        $HttpSocket = new HttpSocket();
        $courseContents = $HttpSocket->post($this->webservice_url, array(
            'wstoken' => $this->token,
            'wsfunction' => 'core_course_get_contents',
            'moodlewsrestformat' => $this->moodlewsrestformat,
            //'options[ids][0]'=>'278'
            'courseid'=>'278'
            
        ));
        $courseContentsArray = json_decode($courseContents);
        if((empty($courseContentsArray->exception) && empty($courseContentsArray->errorcode) && empty($courseContentsArray->message))){
           
          
            return $this->set(array(
                    'code' => Configure::read('Message.code.1'),
                    'status' => Configure::read('Message.status.1'),
                    'message' => Configure::read('Message.message.1'),
                    'courseContents' => array($courseContentsArray),
                    '_serialize' => array('code','status','message','courseContents')
        ));
        
        }
        else{
            
            return $this->set(array(
                    'code' => $courseContentsArray->errorcode,
                    'status' => Configure::read('Message.status.5'),
                    'message' => $courseContentsArray->message,
                    'courseContents' => array($courseContentsArray),
                    '_serialize' => array('code','status','message','courseContents')
        ));
        }
        
    }
   public function courseContentsModule() {
        
        $HttpSocket = new HttpSocket();
        $courseContents = $HttpSocket->post($this->webservice_url, array(
            'wstoken' => $this->token,
            'wsfunction' => 'core_course_get_course_module',
            'moodlewsrestformat' => $this->moodlewsrestformat,
            //'options[ids][0]'=>'278'
            //'courseid'=>'278',
            'cmid'=>'3535'
            
        ));
        $courseContentsArray = json_decode($courseContents);
        if((empty($courseContentsArray->exception) && empty($courseContentsArray->errorcode) && empty($courseContentsArray->message))){
           
          
            return $this->set(array(
                    'code' => Configure::read('Message.code.1'),
                    'status' => Configure::read('Message.status.1'),
                    'message' => Configure::read('Message.message.1'),
                    'courseContents' => array($courseContentsArray),
                    '_serialize' => array('code','status','message','courseContents')
        ));
        
        }
        else{
            
            return $this->set(array(
                    'code' => $courseContentsArray->errorcode,
                    'status' => Configure::read('Message.status.5'),
                    'message' => $courseContentsArray->message,
                    'courseContents' => array($courseContentsArray),
                    '_serialize' => array('code','status','message','courseContents')
        ));
        }
        
    }
    
    public function courseContentsModulePage() {
        
        $HttpSocket = new HttpSocket();
        $courseContents = $HttpSocket->post($this->webservice_url, array(
            'wstoken' => $this->token,
            'wsfunction' => 'core_course_get_course_module_by_instance',
            'moodlewsrestformat' => $this->moodlewsrestformat,
            //'options[ids][0]'=>'278'
            //'courseid'=>'278',
            'module'=>'1'
            
        ));
        $courseContentsArray = json_decode($courseContents);
        if((empty($courseContentsArray->exception) && empty($courseContentsArray->errorcode) && empty($courseContentsArray->message))){
           
          
            return $this->set(array(
                    'code' => Configure::read('Message.code.1'),
                    'status' => Configure::read('Message.status.1'),
                    'message' => Configure::read('Message.message.1'),
                    'courseContents' => array($courseContentsArray),
                    '_serialize' => array('code','status','message','courseContents')
        ));
        
        }
        else{
            
            return $this->set(array(
                    'code' => $courseContentsArray->errorcode,
                    'status' => Configure::read('Message.status.5'),
                    'message' => $courseContentsArray->message,
                    'courseContents' => array($courseContentsArray),
                    '_serialize' => array('code','status','message','courseContents')
        ));
        }
        
    }

}
