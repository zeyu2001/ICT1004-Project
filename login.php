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
        <main> 
            <div class="parallax parallax-login-form">
                <div class="caption">
                    <div class="inside-caption"><h1>Login</h1></div>
                </div>
            </div>
            <div class="container">
                <p class="citation">
                    Photo by 
                    <a href="https://unsplash.com/@seanpollock?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">
                        Sean Pollock
                    </a> on 
                    <a href="https://unsplash.com/s/photos/office?utm_source=unsplash&amp;utm_medium=referral&amp;utm_content=creditCopyText">
                        Unsplash
                    </a>
                </p>
                
                <!-- If user is logged in, do not display the form -->
                <?php if (isset($_SESSION["display_name"])): ?>
                    <h2>Welcome back, <?php echo $_SESSION["display_name"] ?>.</h2>
                    <p>You are already logged in.<p>
                    <a class='green-button' href='index.php'> Return to Home </a>
                    <a class='red-button' href='logout.php'> Logout </a>
                
                <!-- Form code here -->
                <?php else: ?>
                    <div class="row">
                        <div class="col-sm-8">
                            <p>Existing members log in here. For new members, please go to the 
                            <a href="register.php">Sign Up page</a>. </p>
                            <?php include 'login_form.php'?>
                        </div>
                        <div class="col-sm-4">
                            <img alt="" class="mx-auto d-block" src="images/manyhires.png">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>