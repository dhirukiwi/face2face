/**
* @api {post} /users/signout signout a consumer
* @apiVersion 0.0.1
* @apiName signout
* @apiGroup Authentication
* @apiPermission None
*
* @apiDescription signout a user with F2F System
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
*            "status_message": "User successfully signout",
*        }
*
* @apiError {Number}          status_code                    Status Code.
* @apiError {String}          status_message                 Status Message.
*                       
* @apiErrorExample {json} Error-Response: 
*        HTTP/1.1 400 Bad Request
*        {
*            "status_code": 400,
*            "status_message": "User is not able to signout",
*        }
*/


