<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once('/var/www/html/moodle/'.'config.php');
App::uses('HttpSocket', 'Network/Http');

class MoodletestsController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('allCourses');
    }

    public function allCourses() {

        $this->autoRender = false;
        $HttpSocket = new HttpSocket();
        //$HttpSocket->configAuth('Basic', 'user', 'password');
        //$token = $HttpSocket->post('http://localhost/moodle/login/token.php?username=gaurav&password=Gaurav$123&service=f2f');
        //echo $token;die;
        $enrolledusers = $HttpSocket->post('http://localhost/moodle/webservice/rest/server.php', array(
            'wstoken' => 'ab5321780313b2615e3fcc60a351d85d',
            //'service'=>'f2f',
            'wsfunction' => 'core_enrol_get_enrolled_users',
            //'userid'=>'1004',
            'courseid' => '278',
            'moodlewsrestformat' => 'json',
                //'options[ids][0]'=>'278'
        ));
        //echo $enrolledusers;exit;
        $courses_by_user_id = $HttpSocket->post('http://localhost/moodle/webservice/rest/server.php', array(
            'wstoken' => 'ab5321780313b2615e3fcc60a351d85d',
            //'service'=>'f2f',
            'wsfunction' => 'core_enrol_get_users_courses',
            'userid' => '1004',
            //'courseid'=>'278',
            'moodlewsrestformat' => 'json',
                //'options[ids][0]'=>'278'
        ));
        echo $courses_by_user_id;
        exit;
        $result = $HttpSocket->post('http://localhost/moodle/webservice/rest/server.php', array(
            'wstoken' => 'ab5321780313b2615e3fcc60a351d85d',
            //'service'=>'f2f',
            'wsfunction' => 'core_course_get_courses',
            //'cmid'=>'2',
            'moodlewsrestformat' => 'json',
            'options[ids][0]' => '278'
        ));
// create a new cURL resource
        /* $ch = curl_init();

          $data = array(
          'wstoken' => '1635e3a9a0b72be68dbca5514476503f',
          'wsfunction'=>'core_course_get_courses',
          'moodlewsrestformat'=>'json',
          'options[ids][0]'=>'277'
          );

          // set URL and other appropriate options
          curl_setopt($ch, CURLOPT_URL, "http://localhost/moodle/webservice/rest/server.php");
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

          // grab URL and pass it to the browser
          $result = curl_exec($ch);

          // close cURL resource, and free up system resources
          curl_close($ch); */
        echo $result;
        exit;
        print_r(json_decode($result));
//$this->set(array(
//                    'userdata' =>$result,
//                    '_serialize'=>array('userdata')
//                )); 
    }

}
