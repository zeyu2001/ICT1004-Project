<?php
    session_start();
    include "validate.inc.php";

    //---------------------------------------------------------------------------
    //------------------------   GLOBAL VARIABLES -------------------------------
    //---------------------------------------------------------------------------

    // array to contain the input fields
    $form = ["fname" => "",
            "lname" => "",
            "email" => "",
            "email_conf" => "",
            "pwd" => "",
            "pwd_confirm" => "",
            "address" => "",
            "postalcode" => "",
            "country" => "",
            "account_type" => ""
           ];

    // validation filters
    $filters = ["fname" => ["filter" => FILTER_VALIDATE_REGEXP, 
                            "options" => ["regexp" => namefields_filter]
                            ],
                "lname" => ["options" => FILTER_VALIDATE_REGEXP, 
                            "options" => ["regexp" => namefields_filter]
                            ],
                "email" => ["filter" => FILTER_VALIDATE_REGEXP,
                            "options" => ["regexp" => email_filter]
                            ],
                "email_conf" => ["filter" => FILTER_VALIDATE_REGEXP,
                            "options" => ["regexp" => email_filter]
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
                        ],
                "postalcode" => ["filter" => FILTER_VALIDATE_REGEXP, 
                            "options" => ["regexp" => numbers_only_filter]
                            ]
        ];
    
    //---------------------------------------------------------------------------
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

    //---------------------------------------------------------------------------
    //-----------------------------------MAIN -----------------------------------
    //---------------------------------------------------------------------------

    $error_msg = "";
    $success = true;

    // check for input errors
    foreach($form as $key => $value)
    {
        // skip non required field
        if(empty($_POST[$key]))
        {
            // empty input in required field
            if($key != "fname" && $key != "address" && $key != "postalcode")
            {
                $error_msg .= "$key field cannot be empty.<br>";
                $success = false;
            }
        }
        else
        {
            // assign POST values to relevant form inputs
            $form[$key] = $_POST[$key];
        }
        

        // sanitize all form inputs except password
        if($key != "password")
        {
            $form[$key] = sanitize_input($form[$key]);
        }
    }

    // validate all form inputs
    $data = filter_var_array($form, $filters);

    // check for sanitization and validation errors
    // make sure field is not empty
    foreach ($data as $key => $value)
    {
        // first name can be left empty
        if($key != "fname")
        {
            // if value is false or empty string
            if($value === false)
            {
                // password false = not strong enough
                if($key == "pwd" || $key == "pwd_confirm")
                {
                    $error_msg .= "Password must contain at least 1 UPPERCASE letter, "
                            . "1 lowercase letter and 1 special character.<br>";
                    $success = false;
                }
                else 
                {
                    $error_msg .= "Invalid $key field format.<br>";
                    $success = false;
                }
            }
        }
    }

    // make sure passwords entered meet length requirement and are the same
    if(check_pwd($data["pwd"], $data["pwd_confirm"]))
    {
        // hash them password to protect our babies
        $data["pwd"] = password_hash($data["pwd"], PASSWORD_DEFAULT);
        $data["pwd_confirm"] = password_hash($data["pwd_confirm"], PASSWORD_DEFAULT);
    }
    else
    {
        // passwords do not match requirements
        $error_msg .= "Passwords must match and must contain at least 8 characters.<br>";
        $success = false;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        include "head.inc.php";
    ?>
    <body> 
        <?php
            include "nav.inc.php"; 
        ?>
        <main class="container">
            <?php
                if ($success)
                {
                    // TODO: Add to DB
                    echo "Success.";
                }
                else
                {
                    echo "<h1> Oops! </h1>";
                    echo "<h2>The following input errors were detected:</h2>";
                    echo "<p>" . $error_msg . "</p>"; 
                    echo "<a class='red-button' href='register.php'> Return to Sign Up </a>";
                }
            ?>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>