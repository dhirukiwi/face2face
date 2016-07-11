/**
* @api {delete} /users/logout Signout a Consumer
* @apiVersion 0.0.1
* @apiName signout
* @apiGroup Authentication
* @apiPermission None
*
* @apiDescription user can signout
* 
* @apiHeader {String} HTTP_TOKEN      * a token send by header as TOKEN

*
* @apiExample Example usage:
* curl -X Delete -d '{}' https://api.f2f.io/v1/users/logout
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
*		"message": 	"User successfully logout."
*        }
*
* @apiSuccess {Number}        code                  Status Code.
* @apiSuccess {String}        status                Status Type.
* @apiSuccess {String}        message               Status Message.
*                       
* @apiErrorExample {json} Error-Response: 
*        HTTP/1.1 400 Bad Request
*        {
*             	"code": "401",
*		"status": "Unauthorized",
*		"message": "Invalid Token or Unauthorised user"
*        }
*/


