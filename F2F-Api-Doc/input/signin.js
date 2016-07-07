/**
* @api {post} /users/login Signin a Consumer
* @apiVersion 0.0.1
* @apiName signin
* @apiGroup Authentication
* @apiPermission None
*
* @apiDescription Signin a user with F2F System to authenticate.
* 
* @apiParam {String} username        * username
* @apiParam {String} password        * Password.

*
* @apiExample Example usage:
* curl -X POST -d '{"username": "kannan_kr", "password" : "mypassword"}' https://api.f2f.io/v1/users/login
*
* @apiSuccess {Number}        code                  Status Code.
* @apiSuccess {String}        status                Status Type.
* @apiSuccess {String}        message               Status Message.
* @apiSuccess {String}        token                 User Token if authorized.

*
* 
* @apiSuccessExample {json} Success-Response: 
*        HTTP/1.1 201 Created
*        {
*            	"code": 	200,
*            	"status": 	"Ok",
*		"message": 	"The request is OK",
*		"token": 	"e7c360f825ef51d9d7eb5ae8c0072023",
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


