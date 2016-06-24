define({ "api": [
  {
    "type": "post",
    "url": "/users/signup",
    "title": "signup a consumer",
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
            "field": "role_id",
            "description": "<ul> <li>The Role ID (It should be 3 for Consumer).</li> </ul>"
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
            "field": "last_name",
            "description": "<ul> <li>Last Name.</li> </ul>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "user_name",
            "description": "<ul> <li>User Name of the user.</li> </ul>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<ul> <li>Email Address of the user.</li> </ul>"
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
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "captcha",
            "description": "<ul> <li>Captcha.</li> </ul>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "curl -X POST -d '{\"role_id\" : 3, \"first_name\" :\"Kannan\", \"last_name\": \"Ram\", \"user_name\": \"kannan_kr\", \"email\" : \"kannan.k@kiwitech.com\", \"password\" : \"mypassword\", \"confirm_password\" : \"mypassword\", \"captcha\" : \"XYZADF\"}' https://api.f2f.io/v1/users/signup",
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
            "field": "status_code",
            "description": "<p>Status Code.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "status_message",
            "description": "<p>Status Message.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response: ",
          "content": "HTTP/1.1 201 Created\n{\n    \"status_code\": 201,\n    \"status_message\": \"User registered successfully, An email has sent to the registered email address. Please confirm the email\",\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "type": "Number",
            "optional": false,
            "field": "status_code",
            "description": "<p>Status Code.</p>"
          },
          {
            "group": "Error 4xx",
            "type": "String",
            "optional": false,
            "field": "status_message",
            "description": "<p>Status Message.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response: ",
          "content": "HTTP/1.1 400 Bad Request\n{\n    \"status_code\": 400,\n    \"status_message\": \"This email/username is not available or already taken by other users\",\n}",
          "type": "json"
        }
      ]
    },
    "filename": "input/signup.js",
    "groupTitle": "Authentication"
  }
] });
