define({ "api": [
  {
    "type": "put",
    "url": "/users/changePassword",
    "title": "Change Password",
    "version": "0.0.1",
    "name": "change_password",
    "group": "Authentication",
    "permission": [
      {
        "name": "None"
      }
    ],
    "description": "<p>user can change password</p>",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "HTTP_TOKEN",
            "description": "<ul> <li>a token send by header as TOKEN</li> </ul>"
          }
        ]
      }
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "old_password",
            "description": "<ul> <li>old password</li> </ul>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<ul> <li>new password</li> </ul>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "cpassword",
            "description": "<ul> <li>confirm password</li> </ul>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -X PUT -d '{\"old_password\": \"mypassword\", \"password\": \"mypassword\", 'cpassword': \"mypassword\"}' https://api.f2f.io/v1/users/changePassword",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "code",
            "description": "<p>Status Code.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Status Type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Status Message.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response: ",
          "content": "       HTTP/1.1 201 Created\n       {\n           \t\"code\": \t200,\n           \t\"status\": \t\"Ok\",\n\t\t\"message\": \t\"Your password has been changed\"\n       }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response: ",
          "content": "       HTTP/1.1 400 Bad Request\n       {\n            \t\"code\": \"400\",\n\t\t\"status\": \"Bad Request\",\n\t\t\"message\": \"Requested Parameter is not correct\"\n       }",
          "type": "json"
        }
      ]
    },
    "filename": "input/change_password.js",
    "groupTitle": "Authentication"
  },
  {
    "type": "post",
    "url": "/users/forgotPassword",
    "title": "forgot password",
    "version": "0.0.1",
    "name": "forgot_password",
    "group": "Authentication",
    "permission": [
      {
        "name": "None"
      }
    ],
    "description": "<p>sent resent password link, if f2f user forgot password.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<ul> <li>email</li> </ul>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -X POST -d '{\"email\": \"kannan.k@kiwitech.com\"}' https://api.f2f.io/v1/users/forgotPassword",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "code",
            "description": "<p>Status Code.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Status Type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Status Message.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response: ",
          "content": "       HTTP/1.1 201 Created\n       {\n           \t\"code\": \t200,\n           \t\"status\": \t\"Ok\",\n\t\t\"message\": \t\"The request is OK\"\n       }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response: ",
          "content": "       HTTP/1.1 400 Bad Request\n       {\n            \t\"code\": \"400\",\n\t\t\"status\": \"Bad Request\",\n\t\t\"message\": \"Requested Parameter is not correct\"\n       }",
          "type": "json"
        }
      ]
    },
    "filename": "input/forgot_password.js",
    "groupTitle": "Authentication"
  },
  {
    "type": "post",
    "url": "/users/reset_password/5C6797D2-9EB9-42C6-A342-7997A0E812D9",
    "title": "Reset Password",
    "version": "0.0.1",
    "name": "reset_password",
    "group": "Authentication",
    "permission": [
      {
        "name": "None"
      }
    ],
    "description": "<p>user can reset password by clicking of email link which sent by f2f during forgot password</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<ul> <li>new password</li> </ul>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "cpassword",
            "description": "<ul> <li>confirm password</li> </ul>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -X POST -d '{\"password\": \"mypassword\", 'cpassword': \"mypassword\"}' https://api.f2f.io/v1/users/reset_password/5C6797D2-9EB9-42C6-A342-7997A0E812D9",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "code",
            "description": "<p>Status Code.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Status Type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Status Message.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response: ",
          "content": "       HTTP/1.1 201 Created\n       {\n           \t\"code\": \t200,\n           \t\"status\": \t\"Ok\",\n\t\t\"message\": \t\"The request is OK\"\n       }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response: ",
          "content": "       HTTP/1.1 400 Bad Request\n       {\n            \t\"code\": \"400\",\n\t\t\"status\": \"Bad Request\",\n\t\t\"message\": \"Requested Parameter is not correct\"\n       }",
          "type": "json"
        }
      ]
    },
    "filename": "input/reset_password.js",
    "groupTitle": "Authentication"
  },
  {
    "type": "post",
    "url": "/users/login",
    "title": "Signin a Consumer",
    "version": "0.0.1",
    "name": "signin",
    "group": "Authentication",
    "permission": [
      {
        "name": "None"
      }
    ],
    "description": "<p>Signin a user with F2F System to authenticate.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<ul> <li>username</li> </ul>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<ul> <li>Password.</li> </ul>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -X POST -d '{\"username\": \"kannan_kr\", \"password\" : \"mypassword\"}' https://api.f2f.io/v1/users/login",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "code",
            "description": "<p>Status Code.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Status Type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Status Message.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>User Token if authorized.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response: ",
          "content": "       HTTP/1.1 201 Created\n       {\n           \t\"code\": \t200,\n           \t\"status\": \t\"Ok\",\n\t\t\"message\": \t\"The request is OK\",\n\t\t\"token\": \t\"e7c360f825ef51d9d7eb5ae8c0072023\",\n       }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response: ",
          "content": "       HTTP/1.1 400 Bad Request\n       {\n            \t\"code\": \"400\",\n\t\t\"status\": \"Bad Request\",\n\t\t\"message\": \"Requested Parameter is not correct\"\n       }",
          "type": "json"
        }
      ]
    },
    "filename": "input/signin.js",
    "groupTitle": "Authentication"
  },
  {
    "type": "delete",
    "url": "/users/logout",
    "title": "Signout a Consumer",
    "version": "0.0.1",
    "name": "signout",
    "group": "Authentication",
    "permission": [
      {
        "name": "None"
      }
    ],
    "description": "<p>user can signout</p>",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "HTTP_TOKEN",
            "description": "<ul> <li>a token send by header as TOKEN</li> </ul>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -X Delete -d '{}' https://api.f2f.io/v1/users/logout",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "code",
            "description": "<p>Status Code.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Status Type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Status Message.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response: ",
          "content": "       HTTP/1.1 201 Created\n       {\n           \t\"code\": \t200,\n           \t\"status\": \t\"Ok\",\n\t\t\"message\": \t\"User successfully logout.\"\n       }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response: ",
          "content": "       HTTP/1.1 400 Bad Request\n       {\n            \t\"code\": \"401\",\n\t\t\"status\": \"Unauthorized\",\n\t\t\"message\": \"Invalid Token or Unauthorised user\"\n       }",
          "type": "json"
        }
      ]
    },
    "filename": "input/signout.js",
    "groupTitle": "Authentication"
  },
  {
    "type": "post",
    "url": "/users/signup",
    "title": "Signup a Consumer",
    "version": "0.0.1",
    "name": "signup",
    "group": "Authentication",
    "permission": [
      {
        "name": "None"
      }
    ],
    "description": "<p>Signup a user with F2F System and send an email to user to confirm his password.</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "group_id",
            "description": "<ul> <li>The Group ID (It should be 3 for Consumer, Provider, Admin).</li> </ul>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "first_name",
            "description": "<ul> <li>First Name.</li> </ul>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "middle_name",
            "description": "<ul> <li>Middle Name.</li> </ul>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "last_name",
            "description": "<ul> <li>Last Name.</li> </ul>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<ul> <li>Username of the user (Must be unique).</li> </ul>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<ul> <li>Email Address of the user (Must be unique).</li> </ul>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<ul> <li>Password.</li> </ul>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "confirm_password",
            "description": "<ul> <li>Confirm Password.</li> </ul>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -X POST -d '{\"group_id\" : 3, \"first_name\" :\"Kannan\", \"middle_name\" :\"K\", \"last_name\": \"Ram\", \"username\": \"kannan_kr\", \"email\" : \"kannan.k@kiwitech.com\", \"password\" : \"mypassword\", \"confirm_password\" : \"mypassword\"}' https://api.f2f.io/v1/users/signup",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "code",
            "description": "<p>Status Code.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Status Type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Status Message.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response: ",
          "content": "       HTTP/1.1 201 Created\n       {\n      \t\"code\": \t200,\n           \t\"status\": \t\"Ok\",\n\t\t\"message\": \t\"The request is OK\",\n       }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response: ",
          "content": "       HTTP/1.1 400 Bad Request\n       {\n\t\t\"code\": \"400\",\n\t\t\"status\": \"Bad Request\",\n\t\t\"message\": \"Requested Parameter is not correct\"\n       }",
          "type": "json"
        }
      ]
    },
    "filename": "input/signup.js",
    "groupTitle": "Authentication"
  },
  {
    "type": "POST",
    "url": "/elearnings/coursesCourseId",
    "title": "Course Details By Course ID",
    "version": "0.0.1",
    "name": "Course_Details",
    "group": "LMS",
    "permission": [
      {
        "name": "None"
      }
    ],
    "description": "<p>Display Course Details by course ID using Moodle Web Service on F2F System</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "courseid",
            "description": "<ul> <li>Course ID</li> </ul>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -X POST -d '{\"courseid\" : 278}' https://api.f2f.io/v1/elearnings/coursesCourseId",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "code",
            "description": "<p>Status Code.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Status Type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Status Message.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "data",
            "description": "<p>Course Details JSON Data.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response: ",
          "content": "       HTTP/1.1 201 Created\n       {\n      \t\"code\": \t200,\n           \t\"status\": \t\"Ok\",\n\t\t\"message\": \t\"The request is OK\",\n\t\t\"Data\":         \"[[{\n\t\t\t\t\t\"id\":courseID,\n\t\t\t\t\t\"shortname\":course short name,\n\t\t\t\t\t\"categoryID\":course category ID,\n\t\t\t\t\t\"fullname\":\"course full name\",\n\t\t\t\t\t\"summary\":Course summary\n\t\t\t\t    }]]\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response: ",
          "content": "       HTTP/1.1 400 Bad Request\n       {\n\t\t\"code\": \"400\",\n\t\t\"status\": \"Bad Request\",\n\t\t\"message\": \"Invalid token - token not found\",\n\t\t\"Data\":         \"[[{\n\t\t\t\t\t\"exception\": \"moodle_exception\",\n           \t\t\t\t\"errorcode\": \"invalidtoken\",\n           \t\t\t\t\"message\": \"Invalid token - token not found\"\n\t\t\t\t    }]]\n\t}",
          "type": "json"
        }
      ]
    },
    "filename": "input/courseDetails_courseID.js",
    "groupTitle": "LMS"
  },
  {
    "type": "POST",
    "url": "/elearnings/coursesUserId",
    "title": "Course Listing By User Token of F2F",
    "version": "0.0.1",
    "name": "Course_Listing_by_User_Token_of_F2F",
    "group": "LMS",
    "permission": [
      {
        "name": "None"
      }
    ],
    "description": "<p>Course Listing by User Token using Moodle Web Service on F2F System</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "HTTP_TOKEN",
            "description": "<ul> <li>a token send by header as TOKEN</li> </ul>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -X POST -d '' https://api.f2f.io/v1/elearnings/coursesUserId",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "code",
            "description": "<p>Status Code.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Status Type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Status Message.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "data",
            "description": "<p>Course Details JSON Data.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response: ",
          "content": "       HTTP/1.1 201 Created\n       {\n      \t\"code\": \t200,\n           \t\"status\": \t\"Ok\",\n\t\t\"message\": \t\"The request is OK\",\n\t\t\"Data\":         \"[[{\n\t\t\t\t\t\"id\":courseID,\n\t\t\t\t\t\"shortname\":course short name,\n\t\t\t\t\t\"fullname\":\"course full name\",\n\t\t\t\t\t\"summary\":Course summary\n\t\t\t\t    }]]\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response: ",
          "content": "       HTTP/1.1 400 Bad Request\n       {\n\t\t\"code\": \"400\",\n\t\t\"status\": \"Bad Request\",\n\t\t\"message\": \"Invalid token - token not found\",\n\t\t\"Data\":         \"[[{\n\t\t\t\t\t\"exception\": \"moodle_exception\",\n           \t\t\t\t\"errorcode\": \"invalidtoken\",\n           \t\t\t\t\"message\": \"Invalid token - token not found\"\n\t\t\t\t    }]]\n\t}",
          "type": "json"
        }
      ]
    },
    "filename": "input/listCourses_userID.js",
    "groupTitle": "LMS"
  },
  {
    "type": "POST",
    "url": "/elearnings/searchCourses",
    "title": "Search Courses",
    "version": "0.0.1",
    "name": "Search_Course",
    "group": "LMS",
    "permission": [
      {
        "name": "None"
      }
    ],
    "description": "<p>Search course by  Keyword like course name , tag name etc using Moodle Web Service on F2F System</p>",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "keyword",
            "description": "<ul> <li>keyword to be search</li> </ul>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "page",
            "description": "<ul> <li>current page number (0) as default</li> </ul>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "perpage",
            "description": "<ul> <li>number of records per page</li> </ul>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -X POST -d '{\"keyword\" : \"heart\",\"page\":0,\"perpage\":10}' https://api.f2f.io/v1/elearnings/searchCourses",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "code",
            "description": "<p>Status Code.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Status Type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Status Message.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "data",
            "description": "<p>course listing JSON Data.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response: ",
          "content": "       HTTP/1.1 201 Created\n       {\n      \t\"code\": \t200,\n           \t\"status\": \t\"Ok\",\n\t\t\"message\": \t\"The request is OK\",\n\t\t\"data\":         \"[[{\n\t\t\t\t\t\"total\":455,\n\t\t\t\t\t\"courses\":[{\n\t\t\t\t\t\t\"id\":courseID,\n\t\t\t\t\t\t\"shortname\":course short name,\n\t\t\t\t\t\t\"categoryID\":course category ID,\n\t\t\t\t\t\t\"fullname\":\"course full name\",\n\t\t\t\t\t\t\"summary\":Course summary\n\t\t\t\t\t}]\n\t\t\t\t    }]]\n\t}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response: ",
          "content": "       HTTP/1.1 400 Bad Request\n       {\n\t\t\"code\": \"400\",\n   \t\t\"status\": \"Bad Request\",\n   \t\t\"message\": \"Requested Parameter is not correct\"\n\t}",
          "type": "json"
        }
      ]
    },
    "filename": "input/search_courses.js",
    "groupTitle": "LMS"
  },
  {
    "type": "get",
    "url": "/elearnings/allCourses",
    "title": "List All Learning courses",
    "version": "0.0.1",
    "name": "allcourses",
    "group": "LMS",
    "permission": [
      {
        "name": "None"
      }
    ],
    "description": "<p>List All Courses using Moodle Web Service on F2F System</p>",
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -X GET -d https://api.f2f.io/v1/elearnings/allCourses",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "code",
            "description": "<p>Status Code.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Status Type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Status Message.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response: ",
          "content": "       HTTP/1.1 201 Created\n       {\n      \t\"code\": \t200,\n           \t\"status\": \t\"Ok\",\n\t\t\"message\": \t\"The request is OK\",\n       }",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "Error-Response: ",
          "content": "       HTTP/1.1 400 Bad Request\n       {\n\t\t\"code\": \"400\",\n\t\t\"status\": \"Bad Request\",\n\t\t\"message\": \"Requested Parameter is not correct\"\n       }",
          "type": "json"
        }
      ]
    },
    "filename": "input/allcourses.js",
    "groupTitle": "LMS"
  }
] });
