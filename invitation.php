<?php
    session_start();
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
                    include 'process_invitation.php';
                    listInvitations(3, $coy_names, $coy_emails, $coy_msgs);
            ?>
<!--            <div class="card flex-row flex-wrap">
                <div class="card-header">
                    <img src="images/logo_graphic.png" alt="">
                </div>
                <div class="card-block px-2 w-50">
                    <h4 class="card-title">ManyHire Pte Ltd</h4>
                    <p class="card-text">Hi we would like to hire your services</p>
                    <a href="#" class="btn btn-primary ">Profile</a>
                </div>
            </div>-->
            
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>
