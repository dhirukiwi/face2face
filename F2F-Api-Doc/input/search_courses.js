/**
* @api {POST} /elearnings/searchCourses Search Courses
* @apiVersion 0.0.1
* @apiName Search Courses
* @apiGroup LMS
* @apiPermission None
*
* @apiDescription Display Course Details by course ID using Moodle Web Service on F2F System
* 
* @apiParam {string} keywork          	* keyword to be search
* @apiParam {Number} page          	* current page number (0) as default
* @apiParam {Number} perpage          	* number of record per page
*
* @apiExample Example usage:
* curl -X POST -d '{"courseid" : 278}' https://api.f2f.io/v1/elearnings/searchCourses
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
*		"data":         "[[{
*					"total":455,
*					"courses":[{
*						"id":courseID,
*						"shortname":course short name,
*						"categoryID":course category ID,
*						"fullname":"course full name",
*						"summary":Course summary
*					}]
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
*    		"status": "Bad Request",
*    		"message": "Requested Parameter is not correct"
*	}
*/


