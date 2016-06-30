<?php

/**
 *
 * @ Author kiwitech India
 * @ Created date 01 Sep 2015
 * @ Modified date 01 Sep 2015
 * @ array Used as given below
 * @ 1#massege['code']  
 * @ 2#massege['status']
 * @ 3#massege['message']
 * @ Created by Pramod Kumar
 * @ Modified by Pramod Kumar
 * */

class MessageComponent extends Component {

    public function message() {

        $massege = array();
        $config['Message']['code']=array(
                    '1'=>'200',
                    '2'=>'201',
                    '3'=>'202',
                    '4'=>'204',
                    '5'=>'400',
                    '6'=>'401',
                    '7'=>'404',
                    '8'=>'405'
                   );
        $config['Message']['status']=array(
                            '1'=>'Ok',
                            '2'=>'Saved',
                            '3'=>'Accepted',
                            '4'=>'Data Not Found',
                            '5'=>'Bad Request',// if parameter is not correct
                            '6'=>'Unauthorized',//if token is empty and not correct
                            '7'=>'Page Not Found',
                            '8'=>'Method not Allowed' //used when request method(GET,POST,PUT etc) is not correct. 
                            );

         $config['Message']['message']=array(
                              '1'=>'The request is OK',
                              '2'=>'Data saved successfully',
                              '3'=>'The request has been accepted for processing, but the processing has not been completed',
                              '4'=>'The request has been successfully processed, but is not returning any content',
                              '5'=>'Requested Parameter is not correct',
                              '6'=>'Invalid Token or Unauthorised user',
                              '7'=>'Page Not Found',
                              '8'=>'Request method not supported'

                              );
        /* return all massege array */
        return $massege;
    }




    public function error() {

      $error = array();

      $error['title']=array(
                  '1'=>'success',
                  '2'=>'Time out',
                  '3'=>'Time out',
                  '4'=>'Error',
                  '5'=>'Invalid Card',
                  '6'=>'Invalid Token',
                  '7'=>'Empty Token',
                  '8'=>'Failed',
                  '9'=>'109',
                  '10'=>'110',
                  );

      $error['message']=array(
                  '1'=>'Payment successful!',
                  '2'=>'Your payment time has been expired.',
                  '3'=>'Your session has been expired.',
                  '4'=>'Opps some error occured please try again.',
                  '5'=>'Your card details invalid.',
                  '6'=>'Invalid Payment token.',
                  '7'=>'Empty payment token.',
                  '8'=>'Your payment failed.',
                  '9'=>'109',
                  '10'=>'110',
                  );

      return $error;

    } // end error message





}
