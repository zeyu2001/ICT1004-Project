<?php
    session_start();
    include "db_functions.inc.php";
    include "validate.inc.php";
    
    // User shouldn't be here.
    if (!isset($_SESSION['id']) || $_SESSION['account_type'] !== 'Company')
    {
        header("location:index.php");
        exit();
    }
    
    $QUERY_GET_FREELANCER_ID_BY_LISTING_ID = "SELECT freelancer_id FROM manyhires_listings WHERE listing_id=?";
    $QUERY_INSERT_INVITATION = "INSERT INTO manyhires_invitations (datetime, freelancer_id, company_id, listing_id, description, accepted, rejected) "
            . "VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    if (!isset($_POST['listing_id']) || !is_numeric($_POST['listing_id']))
    {
        header("location:index.php");
        exit();
    }
    else
    {
        $listing_id = $_POST['listing_id'];
    }
    
    list($return_code, $result, $errorMsg) = query_db($QUERY_GET_FREELANCER_ID_BY_LISTING_ID, 
            array($listing_id));

    if ($return_code === 0)
    {
        // There would only be one row, since a listing can only belong to one freelancer
        $freelancers_row = $result->fetch_assoc();
        $freelancer_id = $freelancers_row['freelancer_id'];
    }
    else
    {
        $output = "<h1> Oops! </h1>";
        $output.= "<h2> Something went wrong: </h2>";
        $output.= "<p>" . $errorMsg . "</p>"; 
        $output.= "<a class='red-button' href='my_listings.php'> Return to Listings </a>";
    }
    
    $description = validate_input("message", "message", 
            FILTER_VALIDATE_REGEXP, array("regexp" => description_filter),
            "Please remove invalid characters.", true, true);
    
    list($return_code, $result, $errorMsg) = query_db($QUERY_INSERT_INVITATION, 
            array(
                date("Y-m-d H:i:s"),
                $freelancer_id, 
                $_SESSION['id'],
                $listing_id,
                $description,
                0,
                0,
            ));

    if ($return_code === 0)
    {
        // Redirect the user
        header("location:listings.php");
        exit();
    }
    else
    {
        $output = "<h1> Oops! </h1>";
        $output.= "<h2> Something went wrong: </h2>";
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