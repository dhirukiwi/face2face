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
        //$this->RequestHandler->ext='json';
        $this->Auth->allow();
    }

    public function allCourses() {
        //$this->autoRender = false;
        //$this->RequestHandler->renderAs($this, 'json');
        $HttpSocket = new HttpSocket();


        $allcourses = $HttpSocket->post('http://localhost/moodle/webservice/rest/server.php', array(
            'wstoken' => 'd114af5389ec78638b9b47fa9cba97a9',
            //'service'=>'f2f',
            'wsfunction' => 'core_course_get_courses',
            //'userid'=>'1004',
            //'courseid' => '278',
            'moodlewsrestformat' => 'json',
                //'options[ids][0]'=>'278'
        ));
        echo $allcourses;
        exit;
//        print_r(json_decode($result));
        return $this->set(array(
                    'allcourses' => $allcourses,
                    '_serialize' => array('allcourses')
        ));
    }

    public function coursesUserId() {
        $HttpSocket = new HttpSocket();
        $courses_by_user_id = $HttpSocket->post('http://localhost/moodle/webservice/rest/server.php', array(
            'wstoken' => 'd114af5389ec78638b9b47fa9cba97a9',
            //'service'=>'f2f',
            'wsfunction' => 'core_enrol_get_users_courses',
            'userid' => '1004',
            //'courseid'=>'278',
            'moodlewsrestformat' => 'json',
                //'options[ids][0]'=>'278'
        ));
        echo $courses_by_user_id;
        exit;
//        print_r(json_decode($result));
        return $this->set(array(
                    'courses_by_user_id' => $courses_by_user_id,
                    '_serialize' => array('courses_by_user_id')
        ));
    }

    public function coursesCourseId() {
        $HttpSocket = new HttpSocket();
        $courses_courseID = $HttpSocket->post('http://localhost/moodle/webservice/rest/server.php', array(
            'wstoken' => 'd114af5389ec78638b9b47fa9cba97a9',
            //'service'=>'f2f',
            'wsfunction' => 'core_course_get_courses',
            //'cmid'=>'2',
            'moodlewsrestformat' => 'json',
            'courseid' => '278'
        ));
        echo $courses_courseID;
        exit;
//        print_r(json_decode($result));
        return $this->set(array(
                    'courses_courseID' => $courses_courseID,
                    '_serialize' => array('courses_courseID')
        ));
    }

}
