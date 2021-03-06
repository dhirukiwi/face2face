/**
* @api {post} /users/signup Signup a Consumer
* @apiVersion 0.0.1
* @apiName signup
* @apiGroup Authentication
* @apiPermission None
*
* @apiDescription Signup a user with F2F System and send an email to user to confirm his password.
* 
* @apiParam {Number} group_id          * The Group ID (It should be 3 for Consumer, Provider, Admin).
* @apiParam {String} first_name        * First Name.
* @apiParam {String} middle_name       * Middle Name.
* @apiParam {String} last_name         * Last Name.
* @apiParam {String} username          * Username of the user (Must be unique).
* @apiParam {String} email             * Email Address of the user (Must be unique).
* @apiParam {String} password          * Password.
* @apiParam {String} confirm_password  * Confirm Password.

*
* @apiExample Example usage:
* curl -X POST -d '{"group_id" : 3, "first_name" :"Kannan", "middle_name" :"K", "last_name": "Ram", "username": "kannan_kr", "email" : "kannan.k@kiwitech.com", "password" : "mypassword", "confirm_password" : "mypassword"}' https://api.f2f.io/v1/users/signup
*
* @apiSuccess {Number}        code                  Status Code.
* @apiSuccess {String}        status                Status Type.
* @apiSuccess {String}        message               Status Message.
*
* 
* @apiSuccessExample {json} Success-Response: 
*        HTTP/1.1 201 Created
*        {
*       	"code": 	200,
*            	"status": 	"Ok",
*		"message": 	"The request is OK",
*        }
*
* @apiSuccess {Number}        code                  Status Code.
* @apiSuccess {String}        status                Status Type.
* @apiSuccess {String}        message               Status Message.
*                       
* @apiErrorExample {json} Error-Response: 
*        HTTP/1.1 400 Bad Request
*        {
*		"code": "400",
*		"status": "Bad Request",
*		"message": "Requested Parameter is not correct"
*        }
*/


