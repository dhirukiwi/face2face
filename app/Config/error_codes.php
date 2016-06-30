<?php

$config['Message']['code'] = array(
    '1' => '200',
    '2' => '201',
    '3' => '202',
    '4' => '204',
    '5' => '400',
    '6' => '401',
    '7' => '404',
    '8' => '405'
);
$config['Message']['status'] = array(
    '1' => 'Ok',
    '2' => 'Saved',
    '3' => 'Accepted',
    '4' => 'Data Not Found',
    '5' => 'Bad Request', // if parameter is not correct
    '6' => 'Unauthorized', //if token is empty and not correct
    '7' => 'Page Not Found',
    '8' => 'Method not Allowed' //used when request method(GET,POST,PUT etc) is not correct. 
);

$config['Message']['message'] = array(
    '1' => 'The request is OK',
    '2' => 'Data saved successfully',
    '3' => 'The request has been accepted for processing, but the processing has not been completed',
    '4' => 'The request has been successfully processed, but is not returning any content',
    '5' => 'Requested Parameter is not correct',
    '6' => 'Invalid Token or Unauthorised user',
    '7' => 'Page Not Found',
    '8' => 'Request method not supported'
);
