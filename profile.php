<?php
    session_start();
    
    // SQL Queries
    $QUERY_GET_FREELANCER_BY_ID = "SELECT * FROM manyhires_freelancers WHERE freelancer_id=?";
    $QUERY_GET_FREELANCER_SKILLS_BY_ID = "SELECT * FROM manyhires_freelancers_skills WHERE freelancer_id=? ORDER BY skill_id" ;
    $QUERY_GET_COMPANY_BY_ID = "SELECT * FROM manyhires_companies WHERE company_id=?";
    
    // View other users' public profiles            
    if(isset($_GET['user-id']) && is_numeric($_GET['user-id']) && 
            isset($_GET['profile-type']) && ($_GET['profile-type'] === 'Freelancer' || $_GET['profile-type'] === 'Company'))
    {
        $id = $_GET['user-id'];
        $account_type = $_GET['profile-type'];
        $can_edit = false;
    }
    else if (isset($_SESSION['id']) && isset($_SESSION['account_type']))
    {
        $id = $_SESSION['id'];
        $account_type = $_SESSION['account_type'];
        $can_edit = true;
    }
    else
    {
        // User shouldn't be here.
        header("location:index.php");
        exit();
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
            <?php
                switch ($account_type)
                {
                    case 'Freelancer':
                        list($return_code, $result, $errorMsg) = query_db($QUERY_GET_FREELANCER_BY_ID, array($id));
                        break;
                    
                    case 'Company':
                        list($return_code, $result, $errorMsg) = query_db($QUERY_GET_COMPANY_BY_ID, array($id));
                        break;
                    
                    default:
                        echo "Invalid account type.</br>";
                }
                
                if (!$return_code === 0)
                {
                    echo $errorMsg;
                    exit();
                }
                else if ($result->num_rows > 0)
                {
                    // There should only be one row in the result set
                    $row = $result->fetch_assoc();
                    $email = $row["email"];
                    $description = $row["description"];
                    $location = $row["location"];
                    
                    switch ($account_type)
                    {
                        case 'Freelancer':
                            $fname = $row["fname"];
                            $lname = $row["lname"];
                            $headline = $row['headline'];
                                    
                            if ($fname)
                            {
                                $display_name = $fname . " " . $lname;
                            }
                            else
                            {
                                $display_name = $lname;
                            }
                            include "profile_freelancer.inc.php";
                            break;
                            
                        case 'Company':
                            $name = $row["name"];
                            $headline = $row["headline"];
                            include "profile_company.inc.php";
                            break;
                        
                        default:
                            echo "Invalid account type.</br>";
                    }
                }
                else
                {
                    echo "<h1> Oops! </h1>";
                    echo"<h2> Something went wrong. </h2>";
                    echo "<p>The profile you requested does not exist.</p>";
                    echo "<a class='red-button' href='index.php'> Return to Home </a>";
                }
            ?>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>