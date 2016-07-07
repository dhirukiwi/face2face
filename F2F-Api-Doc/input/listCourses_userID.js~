/**
* @api {POST} /elearnings/coursesUserId Course Listing By User Token of F2F  
* @apiVersion 0.0.1
* @apiName Course Listing by User Token of F2F
* @apiGroup LMS
* @apiPermission None
*
* @apiDescription Course Listing by User Token using Moodle Web Service on F2F System
* 
* @apiParam {string} HTTP_TOKEN      * a token send by header as TOKEN
*
* @apiExample Example usage:
* curl -X POST -d '' https://api.f2f.io/v1/elearnings/coursesUserId
*
* @apiSuccess {Number}        code                  Status Code.
* @apiSuccess {String}        status                Status Type.
* @apiSuccess {String}        message               Status Message.
* @apiSuccess {String}        data                  Course Details JSON Data.
*
* 
* @apiSuccessExample {json} Success-Response: 
*        HTTP/1.1 201 Created
*        {
*       	"code": 	200,
*            	"status": 	"Ok",
*		"message": 	"The request is OK",
*		"Data":         "[[{
*					"id":courseID,
*					"shortname":course short name,
*					"fullname":"course full name",
*					"summary":Course summary
*				    }]]
*	}
*       				
*
* @apiSuccess {Number}        code                  Status Code.
* @apiSuccess {String}        status                Status Type.
* @apiSuccess {String}        message               Status Message.
* @apiSuccess {String}        data                  Erron Exception JSON data.
*                       
* @apiErrorExample {json} Error-Response: 
*        HTTP/1.1 400 Bad Request
*        {
*		"code": "400",
*		"status": "Bad Request",
*		"message": "Invalid token - token not found",
*		"Data":         "[[{
*					"exception": "moodle_exception",
*            				"errorcode": "invalidtoken",
*            				"message": "Invalid token - token not found"
*				    }]]
*	}
*/


