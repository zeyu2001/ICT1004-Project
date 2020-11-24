<?php
    session_start();
    
    // User shouldn't be here.
    if (!isset($_SESSION['id']) || $_SESSION['account_type'] === 'Company')
    {
        header("location:index.php");
        exit();
    }
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
            
            <div class="icon-right">
                <h1><?php echo $_SESSION['display_name'] ?>'s Listings</h1>
                <i class="material-icons edit-icon" data-toggle="modal" data-target="#add-listing">add</i>
            </div>

            <!-- Modal -->
            <div id="add-listing" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 class="modal-title">Add Listing</h2>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">

                            <!-- Form to Add Listing -->
                            <?php include "add_listing.php" ?>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                list($return_code, $listings_result, $errorMsg) = query_db("SELECT * FROM manyhires_listings WHERE freelancer_id=?", array($_SESSION['id']));
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
                               <a href="#">Visit <?php echo $freelancers_row["fname"] . " " . $freelancers_row["lname"]. "'s page" ?> </a>
                            </div>

                            <div class="row listing-row align-items-center">
                                <a href="#" class="red-button" data-toggle="modal" data-target="#delete-listing-<?php echo $listings_row['listing_id'] ?>">
                                    Delete Listing
                                    <i class="material-icons">delete_forever</i>
                                </a>
                            </div>

                            <!-- Modal to Confirm Delete Listing-->
                            <div id="delete-listing-<?php echo $listings_row['listing_id'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title">Delete Listing</h2>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">

                                            <h3>Are you sure?</h3>
                                            <p> You are about to delete a listing. <b>This action is irreversible.</b> </p>

                                            <!-- Form to Delete a Listing -->
                                            <form action="process_listing_delete.php" method="post">
                                                <div class="form-group">
                                                    <label for="listing_title_confirm"> Enter the full title of your listing to proceed: </label>

                                                    <!-- Require user to confirm his action by confirming the name of his listing -->
                                                    <input type="hidden" name="listing_title" 
                                                           value="<?php echo $listings_row['title'];?>">

                                                    <input class="form-control" type="text" name="listing_title_confirm" 
                                                           required pattern="<?php echo preg_quote($listings_row['title']);?>">
                                                </div>

                                                <!-- Press button to delete listing -->
                                                <div class="form-group">
                                                    <button class="btn btn-danger" type="submit" name="listing_id" 
                                                            value="<?php echo $listings_row['listing_id'] ?>">
                                                        Yes, Delete Listing
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $i++;
                }
                
                // Display message if no results found
                if ($i === 0): ?>
                    <p>You have no listings at the moment. Create a listing to get noticed!</p>
                <?php endif; ?>
            </form>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>