<?php
    session_start();
    
    include "validate.inc.php";
    include "db_functions.inc.php";
    
    $FNAME_QUERY = "SELECT * FROM manyhires_listings WHERE fname=?";
    $LNAME_QUERY = "SELECT * FROM manyhires_listings WHERE lname=?";
    $LOCATION_QUERY = "SELECT * FROM manyhires_listings WHERE location=?";
    $EMAIL_QUERY = "SELECT * FROM manyhires_listings WHERE email=?";
    
    $errorMsg = "";
    $success = true;
    
    $name_input = validate_input("input", "input", 
            FILTER_VALIDATE_REGEXP, array("regexp" => namefields_filter),
            "Please remove invalid characters.", true, true);
    $location_input = validate_input("input", "input", 
            FILTER_VALIDATE_REGEXP, array("regexp" => location_filter),
            "Please remove invalid characters.", true, true);
    $email_input = validate_input("input", "input", 
            FILTER_VALIDATE_REGEXP, array("regexp" => email_filter),
            "Please remove invalid characters.", true, true);
    
    if ($success)
    {
        list($return_code1, $result1, $errorMsg) = query_db($FNAME_QUERY, 
                array(
                    $name_input
                ));
        list($return_code2, $result2, $errorMsg) = query_db($LNAME_QUERY, 
                array(
                    $name_input
                ));
        list($return_code3, $result3, $errorMsg) = query_db($LOCATION_QUERY, 
                array(
                    $location_input
                ));
        list($return_code4, $result4, $errorMsg) = query_db($EMAIL_QUERY, 
                array(
                    $email_input
                ));
        if ($return_code1 === 0 || $return_code2 === 0 || $return_code3 === 0 || $return_code4 === 0)
        {
            // Redirect the user
            header("location:my_listings.php");
            exit();
        }
        else 
        {
            $output = "<h1> Oops! </h1>";
            $output.= "<h2>The following input errors were detected:</h2>";
            $output.= "<p>" . $errorMsg . "</p>"; 
            $output.= "<a class='red-button' href='my_listings.php'> Return to Listings </a>";
        }
    }
    else
    {
        $output = "<h1> Oops! </h1>";
        $output.= "<h2>The following input errors were detected:</h2>";
        $output.= "<p>" . $errorMsg . "</p>"; 
        $output.= "<a class='red-button' href='my_listings.php'> Return to Listings </a>";
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
                echo $output;
            ?>
      </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>
