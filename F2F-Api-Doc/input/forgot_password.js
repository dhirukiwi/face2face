/**
* @api {post} /users/forgotPassword forgot password
* @apiVersion 0.0.1
* @apiName forgot password
* @apiGroup Authentication
* @apiPermission None
*
* @apiDescription sent resent password link, if f2f user forgot password.
* 
* @apiParam {String} email        * email

*
* @apiExample Example usage:
* curl -X POST -d '{"email": "kannan.k@kiwitech.com"}' https://api.f2f.io/v1/users/forgotPassword
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


