<?php
    session_start();
    
    include "validate.inc.php";
    include "db_functions.inc.php";
    
    $QUERY_UPDATE_FREELANCER_BY_ID = "UPDATE manyhires_freelancers SET email=?, fname=?, lname=?, description=?, location=?, headline=? WHERE freelancer_id=?";
    
    $errorMsg = "";
    $success = true;
    
    $email = validate_input("email", "email", 
            FILTER_VALIDATE_REGEXP, array("regexp" => email_filter),
            "Please enter a valid email.", true, true);
    $lname = validate_input("lname", "last name", 
            FILTER_VALIDATE_REGEXP, array("regexp" => namefields_filter),
            "Only alphabets and spaces are allowed.", true, true);
    $fname = validate_input("fname", "first name", 
            FILTER_VALIDATE_REGEXP, array("regexp" => namefields_filter),
            "Only alphabets and spaces are allowed.", false, true);
    $headline = validate_input("headline", "headline", 
            FILTER_VALIDATE_REGEXP, array("regexp" => headline_filter),
            "Please remove invalid characters.", true, true);
    $location = validate_input("location", "location", 
            FILTER_VALIDATE_REGEXP, array("regexp" => location_filter),
            "Please remove invalid characters.", true, true);
    $description = validate_input("description", "description", 
            FILTER_VALIDATE_REGEXP, array("regexp" => description_filter),
            "Please remove invalid characters.", true, true);
    
    if (!$fname)
    {
        $fname = "";
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
                    list($return_code, $result, $errorMsg) = query_db($QUERY_UPDATE_FREELANCER_BY_ID, 
                            array(
                                $email,
                                $fname,
                                $lname,
                                $description,
                                $location,
                                $headline,
                                $_SESSION['id']
                            ));
                    if ($return_code === 0)
                    {
                        if ($fname)
                        {
                            $_SESSION["display_name"] = $fname . " " . $lname;
                        }
                        else
                        {
                            $_SESSION["display_name"] = $lname;
                        }

                        // Redirect the user
                        header("location:profile.php");
                        exit();
                    }
                    else
                    {
                        echo "<h1> Oops! </h1>";
                        echo "<h2>The following input errors were detected:</h2>";
                        echo "<p>" . $errorMsg . "</p>"; 
                        echo "<a class='red-button' href='profile.php'> Return to Profile </a>";
                    }
                }
                else
                {
                    echo "<h1> Oops! </h1>";
                    echo "<h2>The following input errors were detected:</h2>";
                    echo "<p>" . $errorMsg . "</p>"; 
                    echo "<a class='red-button' href='profile.php'> Return to Profile </a>";
                }
            ?>
      </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>