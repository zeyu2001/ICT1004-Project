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
    $QUERY_ACCEPT_INVITATION = "UPDATE manyhires_invitations SET accepted=1 WHERE invitation_id=?";
    $QUERY_REJECT_INVITATION = "UPDATE manyhires_invitations SET rejected=1 WHERE invitation_id=?";
    $QUERY_INSERT_INVITATION_MESSAGE = "INSERT INTO manyhires_messages (datetime, freelancer_id, company_id, message, sender_type) "
            . "VALUES (?, ?, ?, ?, ?)";
    
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
    
    $listing_id = filter_input(INPUT_POST, 'listing_id', FILTER_VALIDATE_INT);
    
    // First, verify if the listing is owned by the submitting user
    if (isListingOwner($listing_id))
    {
        $invitation_id = filter_input(INPUT_POST, 'invitation_id', FILTER_VALIDATE_INT);
        
        switch ($_POST['type'])
        {
            case "accept":
                
                $freelancer_id = $_SESSION['id'];
                $company_id = filter_input(INPUT_POST, 'company_id', FILTER_VALIDATE_INT);
                $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);
                
                list($return_code, $result, $errorMsg) = query_db($QUERY_ACCEPT_INVITATION, 
                        array($invitation_id));
                
                if (!$message || !$company_id || !$invitation_id)
                {
                    $output = "<h1> Oops! </h1>";
                    $output.= "<h2> Something went wrong: </h2>";
                    $output.= "<p> Sorry, we were not able to process your request. </p>"; 
                    $output.= "<a class='red-button' href='my_listings.php'> Return to Listings </a>";
                    break;
                }
                
                if ($return_code === 0)
                {
                    list($return_code, $result, $errorMsg) = query_db($QUERY_INSERT_INVITATION_MESSAGE, 
                        array(
                            date("Y-m-d H:i:s"),
                            $freelancer_id,
                            $company_id,
                            $message,
                            "company"
                        ));
                    
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
                
                break;
            
            case "reject":
                
                list($return_code, $result, $errorMsg) = query_db($QUERY_REJECT_INVITATION, 
                    array($invitation_id));
                
                if ($return_code === 0)
                {
                    // Redirect the user
                    header("location:my_listings.php");
                    exit();
                }
                
                // If user is not redirected, an error has occurred
                $output = "<h1> Oops! </h1>";
                $output.= "<h2> Something went wrong: </h2>";
                $output.= "<p>" . $errorMsg . "</p>"; 
                $output.= "<a class='red-button' href='my_listings.php'> Return to Listings </a>";
                
                break;
        }
        
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
