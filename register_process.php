<?php
    $form = ["fname" => "",
        "lname" => "",
        "email" => "",
        "email_confirm",
        "pwd" => "",
        "pwd_confirm" => ""
       ];
    
    $filters = ["fname" => FILTER_SANITIZE_STRING,
            "lname" => FILTER_SANITIZE_STRING,
            "email" => ["filter" => FILTER_VALIDATE_REGEXP,
                        "options" => ["regexp" => '/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/']
                        ],
            "pwd" => ["filter" => FILTER_VALIDATE_REGEXP,
                      "options" => ["regexp" => '@[A-Z]@',
                                    "regexp" => '@[a-z]@',
                                    "regexp" => '@[0-9]@',
                                    "regexp" => '@[^\w]@']
                    ],
    "pwd_confirm" => ["filter" => FILTER_VALIDATE_REGEXP,
                      "options" => ["regexp" => '@[A-Z]@',
                                    "regexp" => '@[a-z]@',
                                    "regexp" => '@[0-9]@',
                                    "regexp" => '@[^\w]@']
                    ]
    ];
    
    foreach($form as $key => $value)
    {
        // assign POST values to relevant form inputs
        $form[$key] = $_POST[$key];
        
        // skip non required field
        if($key != "fname")
        {
            // empty input in required field
            if(empty($_POST[$key]))
            {
                
            }
        }
    }
?>

