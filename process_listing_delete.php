<?php
    session_start();
    include "db_functions.inc.php";
    include "validate.inc.php";
    
    // User shouldn't be here.
    if (!isset($_SESSION['id']) || $_SESSION['account_type'] === 'Company')
    {
        header("location:index.php");
        exit();
    }
    
    $QUERY_GET_FREELANCER_ID_BY_LISTING_ID = "SELECT freelancer_id FROM manyhires_listings WHERE listing_id=?";
    $QUERY_DELETE_LISTING_BY_ID = "DELETE FROM manyhires_listings WHERE listing_id=?";
    
    /*
     * Returns true if $listing_id belongs to the current submitting user, false otherwise.
     */
    function isListingOwner($listing_id)
    {
        
        global $QUERY_GET_FREELANCER_ID_BY_LISTING_ID;
        
        list($return_code, $result, $errorMsg) = query_db($QUERY_GET_FREELANCER_ID_BY_LISTING_ID, 
                array($listing_id));
        
        if ($return_code === 0)
        {
            // There would only be one row, since a listing can only belong to one freelancer
            $freelancers_row = $result->fetch_assoc();
            return ($freelancers_row['freelancer_id'] === $_SESSION['id'] && $_SESSION['account_type'] === 'Freelancer');
        }
        else
        {
            // Unable to query DB, cannot perform delete operation for now
            return false;
        }
    }
    
    // First, verify if the listing is owned by the submitting user
    if (isListingOwner($_POST['listing_id']))
    {
        if ($_POST['listing_title'] === $_POST['listing_title_confirm'])
        {
            $success = true;
            $errorMsg = "";
            
            $listing_id = validate_input("listing_id", "listing ID", 
                FILTER_VALIDATE_INT, array("min_range" => 0), 
                "Listing ID is invalid.", true, true);

            if ($success)
            {
                list($return_code, $result, $errorMsg) = query_db($QUERY_DELETE_LISTING_BY_ID, 
                    array(intval($listing_id)));

                if ($return_code === 0)
                {
                    // Redirect the user
                    header("location:my_listings.php");
                    exit();
                }
            }
            
            // If user is not redirected, an error has occurred
            $output = "<h1> Oops! </h1>";
            $output.= "<h2> Something went wrong: </h2>";
            $output.= "<p>" . $errorMsg . "</p>"; 
            $output.= "<a class='red-button' href='my_listings.php'> Return to Listings </a>";
        }
        else
        {
            $output = "<h1> Oops! </h1>";
            $output.= "<h2> Something went wrong: </h2>";
            $output.= "<p> Please check your title confirmation and try again. </p>"; 
            $output.= "<a class='red-button' href='my_listings.php'> Return to Listings </a>";
        }
    }
    else
    {
        // Potentially a malicious actor
        $output = "<h1> Oops! </h1>";
        $output.= "<h2> Something went wrong. </h2>";
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