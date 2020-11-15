<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <?php
        include "head.inc.php";
        include "db_functions.inc.php";
    ?>
    <body> 
        <?php
            include "nav.inc.php"; 
        ?>
        <main class="container"> 
            <h1>Freelancer Listings</h1>
                <?php
                    list($return_code, $listings_result, $errorMsg) = query_db("SELECT * FROM manyhires_listings", NULL);
                    if (!$return_code === 0)
                    {
                        echo $errorMsg;
                        exit();
                    }
                    
                    while($listings_row = $listings_result->fetch_assoc()){
                        list($return_code, $freelancers_result, $errorMsg) = query_db("SELECT fname, lname FROM manyhires_freelancers WHERE freelancer_id=?", array($listings_row['freelancer_id']));
                        
                        if (!$return_code === 0)
                        {
                            echo $errorMsg;
                            exit();
                        }
                        
                        // There would only be one row, since freelancer_id is unique
                        $freelancers_row = $freelancers_result->fetch_assoc();
                        ?>
                        <div class="col-sm-12">
                            <div class="row jumbotron listing">
                                <div class="col-sm-2">"
                                    <img class="rounded listing-image" 
                                         src="<?php echo "ProfilePicturesPFP". $listings_row['freelancer_id']. ".jpg" ?>"
                                         alt="Failed to load profile picture">
                                </div>
                                <div class="col-sm-10">
                                    <div class="row listingrow">
                                        Listing ID: <?php echo $listings_row['listing_id'] ?>
                                    </div>
                                    <div class="row listingrow">
                                        Freelancer: <?php echo $freelancers_row["fname"] . " " . $freelancers_row["lname"] ?>
                                    </div>
                                    <div class="row listingrow">"
                                        Description: <?php echo $listings_row['description'] ?>
                                    </div>
                                    <div class="row listingrow">
                                       Find out more >> <a href="#">Visit <?php echo $freelancers_row["fname"] . " " . $freelancers_row["lname"]. "'s page" ?> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                ?>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>