<?php
    //session_start();
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
            <h1>Member Login</h1>
            
            <!-- If user is logged in, do not display the form -->
            <?php if (isset($_SESSION["display_name"])): ?>
                <h2>Welcome back, <?php echo $_SESSION["display_name"] ?>.</h2>
                <p>You are already logged in.<p>
                <a class='green-button' href='index.php'> Return to Home </a>
                <a class='red-button' href='logout.php'> Logout </a>
                
            <!-- Form code here -->
            <?php else: ?>
                <p>Existing members log in here. For new members, please go to the 
                <a href="register.php">Sign Up page</a>. </p>
                <?php include 'login_form.php'?>
            <?php endif; ?>
                
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>