/**
* @api {post} /users/reset_password/5C6797D2-9EB9-42C6-A342-7997A0E812D9 Reset Password
* @apiVersion 0.0.1
* @apiName reset password
* @apiGroup Authentication
* @apiPermission None
*
* @apiDescription user can reset password by clicking of email link which sent by f2f during forgot password
* 
* @apiParam {String} password         * new password
* @apiParam {String} cpassword        * confirm password

*
* @apiExample Example usage:
* curl -X POST -d '{"password": "mypassword", 'cpassword': "mypassword"}' https://api.f2f.io/v1/users/reset_password/5C6797D2-9EB9-42C6-A342-7997A0E812D9
*
* @apiSuccess {Number}        code                  Status Code.
* @apiSuccess {String}        status                Status Type.
* @apiSuccess {String}        message               Status Message.

*
* 
* @apiSuccessExample {json} Success-Response: 
*        HTTP/1.1 201 Created
*        {
*            	"code": 	200,
*            	"status": 	"Ok",
*		"message": 	"The request is OK"
*        }
*
* @apiSuccess {Number}        code                  Status Code.
* @apiSuccess {String}        status                Status Type.
* @apiSuccess {String}        message               Status Message.
*                       
* @apiErrorExample {json} Error-Response: 
*        HTTP/1.1 400 Bad Request
*        {
*             	"code": "400",
*		"status": "Bad Request",
*		"message": "Requested Parameter is not correct"
*        }
*/


