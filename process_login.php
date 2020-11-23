<?php
    session_start();
?>

<?php
    include "validate.inc.php";
    include "db_functions.inc.php";
    
    $QUERY_GET_FREELANCER_BY_EMAIL = "SELECT * FROM manyhires_freelancers WHERE email=?";
    $QUERY_GET_COMPANY_BY_EMAIL = "SELECT * FROM manyhires_companies WHERE email=?";
    
    $success = true;
    $errorMsg = "";
    
    $email = validate_input("email", "email", 
            FILTER_VALIDATE_REGEXP, array("regexp" => email_filter),
            "Please enter a valid email.", true, true);
    $pwd = validate_input("password", "password", 
            FILTER_VALIDATE_REGEXP, array("regexp" => passwords_filter),
            "8 or more characters required.", true, false);
    
    if ($success){
        switch ($_POST['account_type'])
        {
            case "freelancer":
                list($return_code, $result, $errorMsg) = query_db($QUERY_GET_FREELANCER_BY_EMAIL, array($email));
                if ($result->num_rows > 0)
                {
                    // Note that email field is unique, so should only have 
                    // one row in the result set.
                    $row = $result->fetch_assoc();

                    $fname = $row["fname"];
                    $lname = $row["lname"];
                    $hashed_pwd = $row["password"];
                    if ($fname)
                    {
                        $full_name = $fname . " " . $lname;
                    }
                    else
                    {
                        $full_name = $lname;
                    }

                    // Check if the password matches:
                    if (!password_verify($_POST["password"], $hashed_pwd))
                    {
                        $errorMsg = "Email not found or password doesn't match..."; 
                        $success = false;
                    } 
                    else
                    {
                        $_SESSION['id'] = $row['freelancer_id'];
                        $_SESSION['account_type'] = 'Freelancer';
                        $_SESSION['display_name'] = $full_name;
                                
                        // Login successful
                        header("location:index.php");
                        exit();
                    }
                }
                else 
                {
                    $errorMsg = "Email not found or password doesn't match...";
                    $success = false;
                }
                break;
                
            case "corporate":
                list($return_code, $result, $errorMsg) = query_db($QUERY_GET_COMPANY_BY_EMAIL, array($email));
                                if ($result->num_rows > 0)
                {
                    // Note that email field is unique, so should only have 
                    // one row in the result set.
                    $row = $result->fetch_assoc();
                    $hashed_pwd = $row["password"];

                    // Check if the password matches:
                    if (!password_verify($_POST["password"], $hashed_pwd))
                    {
                        $errorMsg = "Email not found or password doesn't match..."; 
                        $success = false;
                    } 
                    else
                    {
                        $_SESSION['id'] = $row['company_id'];
                        $_SESSION['account_type'] = 'Company';
                        $_SESSION['display_name'] = $row[$name];
                                
                        // Login successful
                        header("location:index.php");
                        exit();
                    }
                }
                else 
                {
                    $errorMsg = "Email not found or password doesn't match...";
                    $success = false;
                }
                break;
            
            default:
                $errorMsg = "Please try again later.";
                
                $success = false;
                break;
        }
    }
?> 

<!DOCTYPE html>
<html lang="en">
    <?php
        include "head.inc.php";
        include "db_functions.inc.php"
    ?>
    <body> 
        <?php
            include "nav.inc.php"; 
        ?>
        <main class="container"> 
            <h1> Oops! </h1>
            <h2> Something went wrong. </h2>
            <p><?php echo $errorMsg ?></p>
            <a class='red-button' href='index.php'> Return to Home </a>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>
                