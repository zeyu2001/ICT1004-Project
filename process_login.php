<?php
    session_start();
    
    include "db_functions.inc.php";
    
    $QUERY_GET_FREELANCER_BY_ID = "SELECT * FROM manyhires_freelancers WHERE freelancer_id=?";
    
    $_SESSION['id'] = 1; // Dummy Session
    $_SESSION['account_type'] = 'Freelancer';
    
    list($return_code, $result, $errorMsg) = query_db($QUERY_GET_FREELANCER_BY_ID, array($_SESSION['id']));
    
    if (!$return_code === 0)
    {
        echo $errorMsg;
        exit();
    }
    else if ($result->num_rows > 0)
    {
        // There should only be one row in the result set
        $row = $result->fetch_assoc();
        $fname = $row["fname"];
        $lname = $row["lname"];
    }
    
    if ($fname)
    {
        $_SESSION["display_name"] = $fname . " " . $lname;
    }
    else
    {
        $_SESSION["display_name"] = $lname;
    }
            
    header("location:index.php");
    exit();
?>

