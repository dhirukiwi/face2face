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
    public $uses = array('Token','User');
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
           
            //$paginate_result = $this->paginate($allCourses_array);
            //pr($paginate_result);exit;
            return $this->set(array(
                    'code' => Configure::read('Message.code.1'),
                    'status' => Configure::read('Message.status.1'),
                    'message' => Configure::read('Message.message.1'),
                    'data' => array($allCourses_array),
                    '_serialize' => array('code','status','message','data')
        ));
        
        }
        else{
            
            return $this->set(array(
                    'code' => Configure::read('Message.code.5'),
                    'status' => Configure::read('Message.status.5'),
                    'message' => $allCourses_array->message,
                    'data' => array($allCourses_array),
                    '_serialize' => array('code','status','message','data')
        ));
        }
    }

    public function coursesUserId() {
        if($this->request->is('post')){
        $checkToken = $this->Token->check_token();
        if(!empty($checkToken['is_token'])){
            $userMoodleID = $this->Token->find('first',
                    array(
                        'token'=>$checkToken['is_token'],
                        'recursive' => 1,
                        'fields'=>array(
                            'User.moodle_id'
                        )
                    ));
        $userID =  $userMoodleID['User']['moodle_id'];
        if(!empty($userID)){
        $HttpSocket = new HttpSocket();
        $courses_by_user_id = $HttpSocket->post($this->webservice_url, array(
            'wstoken' => $this->token,
            'wsfunction' => 'core_enrol_get_users_courses',
            'userid' => $userID,
            'moodlewsrestformat' => $this->moodlewsrestformat,
        ));
        $userCourses_array = json_decode($courses_by_user_id);
        if((empty($userCourses_array->exception) && empty($userCourses_array->errorcode) && empty($userCourses_array->message))){
            return $this->set(array(
                    'code' => Configure::read('Message.code.1'),
                    'status' => Configure::read('Message.status.1'),
                    'message' => Configure::read('Message.message.1'),
                    'data' => array($userCourses_array),
                    '_serialize' => array('code','status','message','data')
        ));
        }
        else{
            return $this->set(array(
                    'code' => Configure::read('Message.code.5'),
                    'status' => Configure::read('Message.status.5'),
                    'message' => $userCourses_array->message,
                    'data' => array($userCourses_array),
                    '_serialize' => array('code','status','message','data')
        ));
        }
        }
        else{
             return $this->set(array(
                    'code' => Configure::read('Message.code.5'),
                    'status' => Configure::read('Message.status.5'),
                    'message' => 'User not found',
                    //'userCourses' => array($userCourses_array),
                    '_serialize' => array('code','status','message')
        )); 
        }
        }
        else{
            return $this->set(array(
                    'code' => Configure::read('Message.code.5'),
                    'status' => Configure::read('Message.status.5'),
                    'message' => 'Unauthorized User',
                    //'userCourses' => array($userCourses_array),
                    '_serialize' => array('code','status','message')
        )); 
        }
    }
     else {
            $result = $this->set(
                array(
                    'code' => Configure::read('Message.code.8'),
                    'status' => Configure::read('Message.status.8'),
                    'message' => Configure::read('Message.message.8'), //success
                    '_serialize' => array('code', 'status', 'message')
                )
            );
        }
    }

    public function coursesCourseId() {
        if($this->request->is('post')){
            $data = $this->request->input('json_decode', true);
        if(!empty($data['courseid'])){   
        $courseID = $data['courseid'];
        $HttpSocket = new HttpSocket();
        $courses_courseID = $HttpSocket->post($this->webservice_url, array(
            'wstoken' => $this->token,
            'wsfunction' => 'core_course_get_courses',
            'moodlewsrestformat' => $this->moodlewsrestformat,
            'options[ids][0]'=>$courseID
            //'courseid'=>'278'
            
        ));
        $courseArray = json_decode($courses_courseID);
        if((empty($courseArray->exception) && empty($courseArray->errorcode) && empty($courseArray->message))){
           
          
            return $this->set(array(
                    'code' => Configure::read('Message.code.1'),
                    'status' => Configure::read('Message.status.1'),
                    'message' => Configure::read('Message.message.1'),
                    'data' => array($courseArray),
                    '_serialize' => array('code','status','message','data')
        ));
        
        }
        else{
            
            return $this->set(array(
                    'code' => Configure::read('Message.code.5'),
                    'status' => Configure::read('Message.status.5'),
                    'message' => $courseArray->message,
                    'data' => array($courseArray),
                    '_serialize' => array('code','status','message','data')
        ));
        }
        }
        else{
            return $this->set(array(
                    'code' => Configure::read('Message.code.5'),
                    'status' => Configure::read('Message.status.5'),
                    'message' => Configure::read('Message.message.5'),
                    //'data' => 'course ID missing',
                    '_serialize' => array('code','status','message')
        ));
        }
        
        
    } else {
            return $this->set(
                array(
                    'code' => Configure::read('Message.code.8'),
                    'status' => Configure::read('Message.status.8'),
                    'message' => Configure::read('Message.message.8'), //success
                    '_serialize' => array('code', 'status', 'message')
                )
            );
        }
    
    }
    public function searchCourses() {
        $data = $this->request->input('json_decode', true);
        if(!empty($data['keyword']) and isset($data['page']) and !empty($data['perpage'])) {
            $HttpSocket = new HttpSocket(); 
            $courses = $HttpSocket->post($this->webservice_url, array(
                'wstoken' => $this->token,
                'wsfunction' => 'core_course_search_courses',
                'criterianame' => 'search',
                'criteriavalue' => $data['keyword'],
                'page' => $data['page'],
                'perpage' => $data['perpage'],
                'moodlewsrestformat' => $this->moodlewsrestformat,
            ));
            $courses = json_decode($courses);
             if((empty($courses->exception) && empty($courses->errorcode) && empty($courses->message))) {
                return $this->set(array(
                    'code' => Configure::read('Message.code.1'),
                    'status' => Configure::read('Message.status.1'),
                    'message' => Configure::read('Message.message.1'),
                    'data' => array($courses),
                    '_serialize' => array('code','status','message','data')
                ));
            } else {
                return $this->set(array(
                    'code' => Configure::read('Message.code.5'),
                    'status' => Configure::read('Message.status.5'),
                    'message' => $courses->message,
                    'data' => array($courses),
                    '_serialize' => array('code','status','message','data')
                ));
            }
        } else {
            return $this->set(
                array(
                    'code' => Configure::read('Message.code.5'),
                    'status' => Configure::read('Message.status.5'),
                    'message' => Configure::read('Message.message.5'), //success
                    '_serialize' => array('code', 'status', 'message')
                )
            );
        }
    }
  public function courseContentsByCourseId() {
         if($this->request->is('post')){
            $data = $this->request->input('json_decode', true);
        if(!empty($data['courseid'])){   
        $courseID = $data['courseid'];
        $HttpSocket = new HttpSocket();
        $courseContents = $HttpSocket->post($this->webservice_url, array(
            'wstoken' => $this->token,
            'wsfunction' => 'core_course_get_contents',
            'moodlewsrestformat' => $this->moodlewsrestformat,
            //'options[ids][0]'=>'278'
            'courseid'=>$courseID,
            //'cmid'=>'3535',
            // $option['name']=>'cmid'
            
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
        else{
            return $this->set(array(
                    'code' => Configure::read('Message.code.5'),
                    'status' => Configure::read('Message.status.5'),
                    'message' => $courseContentsArray->message,
                    'data' => array($courseContentsArray),
                    '_serialize' => array('code','status','message','data')
        ));
        }
         }
        else{
            return $this->set(
                array(
                    'code' => Configure::read('Message.code.8'),
                    'status' => Configure::read('Message.status.8'),
                    'message' => Configure::read('Message.message.8'), //success
                    '_serialize' => array('code', 'status', 'message')
                )
            );
        }
        
    }
   public function courseContentByModuleId() {
        
        $HttpSocket = new HttpSocket();
        $courseContents = $HttpSocket->post($this->webservice_url, array(
            'wstoken' => $this->token,
            'wsfunction' => 'core_course_get_course_module',
            'moodlewsrestformat' => $this->moodlewsrestformat,
            //'options[ids][0]'=>'278'
            //'courseid'=>'278',
            'cmid'=>'3535',
            //'options'=>array('name'=>'modname')
//            'pageid'=>'1'
            
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
//            'courseid'=>'278',
            //'module'=>'13',
            'module'=>'lesson',
            'instance'=>'2',
            
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

   public function paginateList($array, $page = 0,$limit=10) {
        
  // array_slice() to extract needed portion of data (page)
  // usort() to sort data using comparision function $this->sort()
  return(
    array_slice(
      usort(
        $array,
        array($this, 'sort') // callback to $this->sort()
      ),
      $page*$this->paginateList['limit'],
      $this->paginateList['limit']
    )
  );
}

    public function sort($a, $b) {
  $result = 0;
  foreach($this->paginateList($array)['order'] as $key => $order) {
    list($table, $field) = explode('.', $key);
     if($a[$table][$field] == $b[$table][$field])
      continue;
     $result = ($a[$table][$field] < $b[$table][$field] ? -1 : 1) *
      ($order == 'asc' ? 1 : -1);
  }
  return($result);
}


}
