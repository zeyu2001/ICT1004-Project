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
            include "validate.inc.php";
            
            $QUERY_FRONTEND = "SELECT * FROM manyhires_listings WHERE type='front-end'";
            $QUERY_BACKEND = "SELECT * FROM manyhires_listings WHERE type='back-end'";
            $QUERY_FULLSTACK = "SELECT * FROM manyhires_listings WHERE type='full-stack'";
            $QUERY_ALL = "SELECT * FROM manyhires_listings";
            
            $success = true;
            if (isset($_GET['query']) && !empty($_GET['query']))
            {
                $query = sanitize_input($_GET['query']);
                if (!filter_var($query, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => query_filter))))
                {
                    $success = false; 
                }
                
                else
                {
                    $QUERY_FRONTEND .= " AND (title LIKE '%" . $query . "%' OR description LIKE '%". $query . "%')";
                    $QUERY_BACKEND .= " AND (title LIKE '%" . $query . "%' OR description LIKE '%". $query . "%')";
                    $QUERY_FULLSTACK .= " AND (title LIKE '%" . $query . "%' OR description LIKE '%". $query . "%')";
                    $QUERY_ALL .= " WHERE (title LIKE '%" . $query . "%' OR description LIKE '%". $query . "%')";
                }
                
            }
        ?>
        <main class="container"> 
            <h1>Freelancer Listings</h1>
            
            <form class="containter" action="listings.php?" method="get">
                <div class="form-group form-row">
                    <div class="col-md-8 py-2">
                        <label for="query" hidden>Search Keywords</label>
                        <input class="form-control" name="query" type="search" placeholder="e.g. React.js" aria-label="Search"
                               pattern="^[a-zA-Z0-9\s\.\-,!?]*$">
                    </div>
                    <div class="col-md-3 py-2">
                        <label for="type" hidden="">Type</label>
                        <select class="form-control form-control-md" name="type" id="account_type">
                            <option value="">All</option>
                            <option value="front-end">Front End</option>
                            <option value="back-end">Back End</option>
                            <option value="full-stack">Full Stack</option>
                        </select>
                    </div>
                    <div class="col-md-1 mx-auto py-2 text-center">
                        <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                    </div>
                </div>
                
            </form>
            
                <?php
                    if(!$success): ?>
                    <p> Sorry, we were unable to process your query. Showing all listings. </p>
                <?php endif;
                    if(isset($_GET['type']))
                    {
                        // There should only be three valid 'type' parameters. Guard against XSS.
                        switch ($_GET['type'])
                        {
                            case "front-end":
                                list($return_code, $listings_result, $errorMsg) = query_db($QUERY_FRONTEND, null);
                                break;
                            case "back-end":
                                list($return_code, $listings_result, $errorMsg) = query_db($QUERY_BACKEND, null);
                                break;
                            case 'full-stack':
                                list($return_code, $listings_result, $errorMsg) = query_db($QUERY_FULLSTACK, null);
                                break;
                            default:
                                list($return_code, $listings_result, $errorMsg) = query_db($QUERY_ALL, null);
                                break;
                        }
                    }
                    else
                    {
                        list($return_code, $listings_result, $errorMsg) = query_db($QUERY_ALL, null);
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
                                
                                <!-- Only companies should be able to send invitations --> 
                                <?php if (isset($_SESSION['id']) && $_SESSION['account_type'] === 'Company'): ?>
                                    <div class="row listing-row align-items-center">
                                        <a href="#" class="green-button" data-toggle="modal" data-target="#invite-<?php echo $listings_row['listing_id'] ?>">
                                            Invite Freelancer
                                            <i class="material-icons">send</i>
                                        </a>
                                    </div>

                                    <!-- Modal to Send Invitation -->
                                    <div id="invite-<?php echo $listings_row['listing_id'] ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h2 class="modal-title">Invite Freelancer</h2>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">

                                                    <h3>Write a Message</h3>
                                                    <p> <?php echo $name ?> will see your invitation. </p>

                                                    <!-- Form to Send Invitation -->
                                                    <form action="process_send_invite.php" method="post">
                                                        <div class="form-group">
                                                            <label for="message">Message:</label>
                                                            <input class="form-control" type="text" name="message" 
                                                                   required pattern="^[a-zA-Z0-9\s\.\-,!?]*$">
                                                        </div>

                                                        <!-- Press button to Send Invitation -->
                                                        <div class="form-group">
                                                            <button class="btn btn-success" type="submit" name="listing_id" 
                                                                    value="<?php echo $listings_row['listing_id'] ?>">
                                                                Send Invitation
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
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php  $i++;
                    }
                    
                    // Display message if no results found
                    if ($i === 0): ?>
                        <div class="row">
                            <div class="col-md-8 order-md-1 order-2">
                                <div class="col">
                                    <p>Sorry, we could not find any matches for your query.</p>
                                    <a href="listings.php" class="green-button">Show me all listings</a>
                                </div>
                            </div>
                            <div class="col-md-4 order-md-2 order-1">
                                <img class="side-img mx-auto d-block" src="images/undraw_empty.svg" alt="">
                            </div>
                        </div>
                    <?php endif; ?>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>