<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
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
                
                    if(isset($_GET['type']))
                    {
                        // There should only be three valid 'type' parameters. Guard against XSS.
                        switch ($_GET['type'])
                        {
                            case "front-end":
                                list($return_code, $listings_result, $errorMsg) = query_db("SELECT * FROM manyhires_listings WHERE type='front-end'", null);
                                break;
                            case "back-end":
                                list($return_code, $listings_result, $errorMsg) = query_db("SELECT * FROM manyhires_listings WHERE type='back-end'", null);
                                break;
                            case 'full-stack':
                                list($return_code, $listings_result, $errorMsg) = query_db("SELECT * FROM manyhires_listings WHERE type='full-stack'", null);
                                break;
                            default:
                                list($return_code, $listings_result, $errorMsg) = query_db("SELECT * FROM manyhires_listings", null);
                                break;
                        }
                    }
                    else
                    {
                        list($return_code, $listings_result, $errorMsg) = query_db("SELECT * FROM manyhires_listings", null);
                    }
                    if (!$return_code === 0)
                    {
                        echo $errorMsg;
                        exit();
                    }
                    
                    $i = 0;
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
                        <div class="row listing">
                            <div class="col-md-3 my-auto">
                                <img class="rounded-circle listing-image"
                                    width="100%"
                                    src="<?php echo "uploads/freelancer-". $listings_row['freelancer_id']. "/profile.jpg" ?>"
                                    alt="Failed to load profile picture">
                            </div>
                            <div class="col-md-9">
                                <div class="row listing-row">
                                    <h2><?php echo $listings_row['title'] ?></h2>
                                </div>
                                <div class="row listing-row">
                                    Name: <?php 
                                    $fname = $freelancers_row['fname'];
                                    $lname = $freelancers_row['lname'];

                                    if ($fname)
                                    {
                                        $name = $fname . " " . $lname;
                                    }
                                    else
                                    {
                                        $name = $lname;
                                    }
                                    echo $name
                                        ?>
                                </div>
                                <div class="row listing-row">
                                    Type: <?php 
                                        switch ($listings_row['type'])
                                        {
                                            case 'full-stack':
                                                echo "Full Stack Development";
                                                break;
                                            case 'front-end':
                                                echo "Front End Development";
                                                break;
                                            case 'back-end':
                                                echo "Back End Development";
                                                break;
                                        }
                                    ?>
                                </div>
                                <div class="row listing-row">
                                    Description: <?php echo $listings_row['description'] ?>
                                </div>
                                <div class="row listing-row">
                                   <a href="profile.php?user-id=<?php echo $listings_row['freelancer_id'] ?>&profile-type=Freelancer">
                                       Visit <?php echo $freelancers_row["fname"] . " " . $freelancers_row["lname"]. "'s page" ?> 
                                   </a>
                                </div>
                            </div>
                        </div>
                    <?php  $i++;
                    }
                    
                    // Display message if no results found
                    if ($i === 0): ?>
                        <p>Sorry, no freelancers are available at the moment. Please check back later!</p>
                    <?php endif; ?>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>