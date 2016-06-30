<?php

/**
 * @ Author  kiwitech India
 * @ Created date 27 June 2016
 * @ Modified date 27 June 2016
 * @ Action Used as given below
 * @ 1#empty_body
 * @ 2#validkeyFieldOne
 * @ 3#validkeyFieldTwo
 * @ 4#validkeyFieldThree
 * @ 5#validkeyFieldFour
 * @ 6#validkeyFieldFive
 * @ 7#validkeyFieldSix
 * @ 8#validkeyFieldSeven
 * @ 9#validkeyFieldEight
 * @ 10#allreadylogin
 * @ 11#formatedUser
 * @ 12#email_validation
 * @ 13#sendForgotPassEmail
 * @ 14#verify_facebook_account
 * @ 15#verify_linkedin_account
 * @ 16#verify_twitter_account
 * @ 17#createTempPassword
 * @ 18#sendEmailVerification
 * @ Created by Ravi Kumar
 * @ Modified by Ravi Kumar
 * */

class ValidateComponent extends Component {

    /**
     * @ Author kiwitech India
     * @ empty_body function
     * @ Created date 01 Sep 2015
     * @ Modified date 01 Sep 2015
     * @ Function Used check and to return
     * @ 1#valid_body  
     * @ 2#unvalid_body
     * @ Created by Ravi Kumar
     * @ Modified by Ravi Kumar
     * */
    function valid_body($body_value) {
        $result = false;
        if (!empty($body_value)) {
            $result = true;
        }
        return $result;
    }

    /**
     * @ Author kiwitech India
     * @ sendEmailVerification function
     * @ Created date 01 Sep 2015
     * @ Modified date 01 Sep 2015
     * @ Function Used check and to return
     * @ 1#valid_body  
     * @ 2#unvalid_body
     * @ Created by Ravi Kumar
     * @ Modified by Ravi Kumar
     * */
    function sendEmailVerification($useremail) {
        $encrptMail = base64_encode($useremail);
        $Email = new CakeEmail('smtp');
        $Email->from(array('admin@f2fhealth.com' => 'Send from Face2Face Healthcare'));
        $Email->template('emailverify');
        $Email->emailFormat('html');
        $Email->viewVars(array('usermail' => $encrptMail));
        $Email->to($useremail);
        $Email->subject('Face2Face Healthcare Email Verification');

        if ($Email->send()) {
            return 'success';
        } else {
            return 'failure';
        }
    }
    
    /**
     * @ Author kiwitech India
     * @ empty_body function
     * @ Created date 01 Sep 2015
     * @ Modified date 01 Sep 2015
     * @ Function Used check and to return
     * @ 1#valid_body  
     * @ 2#unvalid_body
     * @ Created by Ravi Kumar
     * @ Modified by Ravi Kumar
     * */
    function sendForgotPassEmail($useremail, $username, $token) {
        //$useremail = 'pramod.kumar@kiwitech.com';
        $Email = new CakeEmail('Smtp');
        $Email->from(array('admin@f2fhealth.com' => 'Send from Face2Face Healthcare'));
        $Email->template('forgot');
        $Email->emailFormat('html');
        $Email->viewVars(array('username' => $username, 'token' => $token));
        $Email->to($useremail);
        $Email->subject('Face2Face Healthcare Forgot Password Request');
        if ($Email->send()) {
            return 'success';
        } else {
            return 'failure';
        }
    }
    
    

   /**
     * @ Author kiwitech India
     * @ validate_user_token function
     * @ Created date 01 Sep 2015
     * @ Modified date 01 Sep 2015
     * @ Function Used check and to return
     * @ 1#valid_body  
     * @ 2#unvalid_body
     * @ Created by Ravi Kumar
     * @ Modified by Ravi Kumar
     * */

    function validate_user_token($token) {
        $model = ClassRegistry::init('UserSession');
        $user_data = $model->find('first', array('conditions' => array('token' => $token)));
        if (is_array($user_data) && count($user_data) > 0) {
            return $user_data['UserSession']['user_id'];
        }
        return false;
    }

    /**
     * @ Author kiwitech India
     * @ encrypt function
     * @ Created date 01 Sep 2015
     * @ Modified date 01 Sep 2015
     * @ Function Used check and to return
     * @ 1#valid_body  
     * @ 2#unvalid_body
     * @ Created by Ravi Kumar
     * @ Modified by Ravi Kumar
     * */
    
    function encrypt($plan_text, $key)
    {
            $str_encrypt = trim(
                base64_encode(
                    mcrypt_encrypt(
                        MCRYPT_RIJNDAEL_256,
                        $key, $plan_text, 
                        MCRYPT_MODE_ECB, 
                        mcrypt_create_iv(
                            mcrypt_get_iv_size(
                                MCRYPT_RIJNDAEL_256, 
                                MCRYPT_MODE_ECB
                            ), 
                            MCRYPT_RAND)
                        )
                    ), "\0"
                );
            return bin2hex($str_encrypt);
    }

    /**
     * @ Author kiwitech India
     * @ decrypt function
     * @ Created date 01 Sep 2015
     * @ Modified date 01 Sep 2015
     * @ Function Used check and to return
     * @ 1#valid_body  
     * @ 2#unvalid_body
     * @ Created by Ravi Kumar
     * @ Modified by Ravi Kumar
     * */
    
    function decrypt($encrypt_text, $key)
    {
            $decrypt_text  = trim(
                mcrypt_decrypt(
                    MCRYPT_RIJNDAEL_256, 
                    $key, 
                    base64_decode(hex2bin($encrypt_text)), 
                    MCRYPT_MODE_ECB,
                    mcrypt_create_iv(
                        mcrypt_get_iv_size(
                            MCRYPT_RIJNDAEL_256,
                            MCRYPT_MODE_ECB
                        ), 
                        MCRYPT_RAND
                    )
                ), "\0"
            );

            return $decrypt_text;
    }
    
    function guid() {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }
        echo sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535)); die;
    }
}

/*end of logic component*/
