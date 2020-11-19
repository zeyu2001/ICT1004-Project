<?php
//----------------------------------------------------------------------------
//------------------------------------MAIN ----------------------------------
//---------------------------------------------------------------------------

//array to contain the input fields
$form = ["fname" => "",
        "lname" => "",
        "email" => "",
        "email_conf" => "",
        "password" => "",
        "password_conf" => "",
        "address" => "",
        "postalcode" => "",
        "country" => ""
       ];

//sanitization and validation filters
$filters = ["fname" => FILTER_SANITIZE_STRING,
            "lname" => FILTER_SANITIZE_STRING,
            "email" => ["filter" => FILTER_VALIDATE_REGEXP,
                        "options" => ["regexp" => '/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/']
                        ],
            "pwd" => ["filter" => FILTER_VALIDATE_REGEXP,
                      "options" => ["regexp" => '@[A-Z]@', // 1 CAPITAL LETTER
                                    "regexp" => '@[a-z]@', // 1 small letter
                                    "regexp" => '@[0-9]@', // 1 number
                                    "regexp" => '@[^\w]@'] // 1 special character
                    ],
    "pwd_confirm" => ["filter" => FILTER_VALIDATE_REGEXP,
                      "options" => ["regexp" => '@[A-Z]@', // 1 CAPITAL LETTER
                                    "regexp" => '@[a-z]@', // 1 small letter
                                    "regexp" => '@[0-9]@', // 1 number
                                    "regexp" => '@[^\w]@'] // 1 special character
                    ]
    ];
    
    $error_msg = "";
    $success = true;
    
    // check for input errors
    foreach($form as $key => $value)
    {
        // assign POST values to relevant form inputs
        $form[$key] = $_POST[$key];
        
        // skip non required field
        if($key != "fname" && $key != "address" && $key != "postalcode")
        {
            // empty input in required field
            if(empty($_POST[$key]))
            {
                $error_msg .= "$key field cannot be empty.<br>";
                $success = false;
            }
        }
    }
    
    // validate and sanitize form inputs
    $data = filter_var_array($form, $filters);
    
    //uncomment code below to see data inputs from POST for DEBUGGING ONLY
    //var_dump($data);
    
    // check for sanitization AND validation errors
    // make sure field is not empty
    foreach ($data as $key => $value)
    {
        // first name can be left empty
        if($key != "fname")
        {
            // if value is false or empty string
            if(!$value)
            {
                // password false = not strong enough
                if($key == "password" || $key == "password_conf")
                {
                    $errorMsg .= "Password must contain at least 1 UPPERCASE letter, "
                            . "1 lowercase letter and 1 special character.<br>";
                    $success = false;
                }
                else 
                {
                    $error_msg .= "$key field cannot be empty.<br>";
                    $success = false;
                }
            }
        }
    }
    
    // make sure passwords entered meet length requirement and are the same
    if(check_pwd($data["password"], $data["password_conf"]))
    {
        // hash them password to protect our babies
        $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
        $data["password_conf"] = password_hash($data["password_conf"], PASSWORD_DEFAULT);
    }
    else
    {
        // passwords do not match requirements
        $errorMsg .= "Passwords must match and must contain at least 8 Characters<br>";
        $success = false;
    }
    
//----------------------------------------------------------------------------
//----------------------------   FUNCTIONS ----------------------------------
//---------------------------------------------------------------------------

/*
 * check for password length and passwords entered are the same
 */
    function check_pwd($pwd, $pwd_confirm)
    {
        // password and password confirmation must be the same
        if($pwd !== $pwd_confirm)
        {
            return false;
        }
        // password length requirements
        else if (strlen($pwd) < 8 || strlen($pwd_confirm) < 8)
        {
            return false;
        }
        
        return true;
    }
?>

