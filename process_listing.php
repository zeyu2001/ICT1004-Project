<?php
    session_start();
    
    include "validate.inc.php";
    include "db_functions.inc.php";
    
    $QUERY_INSERT_LISTINGS = "INSERT INTO manyhires_listings (freelancer_id, description, title, type) VALUES (?, ?, ?, ?)";
    
    $errorMsg = "";
    $success = true;
    
    $description = validate_input("description", "description", 
            FILTER_VALIDATE_REGEXP, array("regexp" => description_filter),
            "Please remove invalid characters.", true, true);
    $title = validate_input("title", "title", 
            FILTER_VALIDATE_REGEXP, array("regexp" => headline_filter),
            "Please remove invalid characters.", true, true);
    $type = validate_input("listing_type", "listing type", 
            FILTER_VALIDATE_REGEXP, array("regexp" => '/(full-stack)|(front-end)|(back-end)/'),
            "Please select a valid value.", true, true);
    
    if ($success)
    {
        list($return_code, $result, $errorMsg) = query_db($QUERY_INSERT_LISTINGS, 
                array(
                    $_SESSION['id'],
                    $description,
                    $title,
                    $type
                ));
        if ($return_code === 0)
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