<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <?php
        include "head.inc.php";
    ?>
    <body> 
        <?php
            include "nav.inc.php"; 
        ?>
        <main class="container"> 
            <h1>Freelancer Listings</h1>
                <?php
                    include "db_functions.inc.php";
                    $result = query_db("SELECT * FROM manyhires_listings",array());
                    $page_details = "";
                    foreach ($result[1] as $row) {
                        $info = query_db("SELECT fname, lname FROM manyhires_freelancers WHERE freelancer_id=".$row['freelancer_id'],array(),True)[1];
                        
                        $data =
                        "<div class=\"col-sm-12\">"
                        ."<div class=\"row jumbotron listing\">"
                        ."<div class=\"col-sm-2\">"
                        ."<img class=\"rounded listing-image\" src=\"ProfilePictures/PFP".$row['freelancer_id'].".jpg\" alt=\"Failed to load profile picture\"/>"
                        ."</div>"
                        ."<div class=\"col-sm-10\">"
                        ."<div class=\"row listingrow\">"
                        ."Listing ID: ".$row['listing_id']
                        ."</div>"
                        ."<div class=\"row listingrow\">"
                        ."Freelancer: " . $info["fname"] . " " . $info["lname"]
                        ."</div>"
                        ."<div class=\"row listingrow\">"
                        ."Description: ".$row['description']
                        ."</div>"
                        ."<div class=\"row listingrow\">"
                        ."Find out more >> ". "<a href=\"#\">Visit ". $info["fname"] . " " . $info["lname"]. "'s page</a>"
                        ."</div>"
                        ."</div>"
                        ."</div>"
                        ."</div>";
                        $page_details .= '<div class="row">'.$data.'</div>';
                        }
                    echo $page_details;
                ?>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>