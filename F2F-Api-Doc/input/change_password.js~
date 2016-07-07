/**
* @api {put} /users/changePassword Change Password
* @apiVersion 0.0.1
* @apiName change password
* @apiGroup Authentication
* @apiPermission None
*
* @apiDescription user can change password
* 
* @apiHeader {String} HTTP_TOKEN      * a token send by header as TOKEN

* @apiParam {String} old_password     * old password
* @apiParam {String} password         * new password
* @apiParam {String} cpassword        * confirm password

*
* @apiExample Example usage:
* curl -X PUT -d '{"old_password": "mypassword", "password": "mypassword", 'cpassword': "mypassword"}' https://api.f2f.io/v1/users/changePassword
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
*		"message": 	"Your password has been changed"
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


