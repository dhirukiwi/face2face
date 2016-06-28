/**
* @api {post} /users/signup signup a consumer
* @apiVersion 0.0.1
* @apiName signup
* @apiGroup Authentication
* @apiPermission None
*
* @apiDescription Signup a user with F2F System and send an email to user to confirm his password.
* 
* @apiParam {Number} role_id           * The Role ID (It should be 3 for Consumer).
* @apiParam {String} first_name        * First Name.
* @apiParam {String} last_name         * Last Name.
* @apiParam {String} user_name         * User Name of the user.
* @apiParam {String} email             * Email Address of the user.
* @apiParam {String} password          * Password.
* @apiParam {String} confirm_password  * Confirm Password.
* @apiParam {String} captcha           * Captcha. 
*
* @apiExample Example usage:
* curl -X POST -d '{"role_id" : 3, "first_name" :"Kannan", "last_name": "Ram", "user_name": "kannan_kr", "email" : "kannan.k@kiwitech.com", "password" : "mypassword", "confirm_password" : "mypassword", "captcha" : "XYZADF"}' https://api.f2f.io/v1/users/signup
*
* @apiSuccess {Number}        status_code                    Status Code.
* @apiSuccess {Number}        status_message                 Status Message.
*
* 
* @apiSuccessExample {json} Success-Response: 
*        HTTP/1.1 201 Created
*        {
*            "status_code": 201,
*            "status_message": "User registered successfully, An email has sent to the registered email address. Please confirm the email",
*        }
*
* @apiError {Number}          status_code                    Status Code.
* @apiError {String}          status_message                 Status Message.
*                       
* @apiErrorExample {json} Error-Response: 
*        HTTP/1.1 400 Bad Request
*        {
*            "status_code": 400,
*            "status_message": "This email/username is not available or already taken by other users",
*        }
*/


