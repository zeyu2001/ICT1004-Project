<?php
    session_start();
    $_SESSION['display_name'] = 'James Bond'; // Dummy Session
    $_SESSION['account_type'] = 'Freelancer';
    $_SESSION['id'] = 1
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
        <header class="jumbotron text-center" id='index-jumbotron'>
            <h1 class="display-4">Talent on Demand.</h1> 
            <p class="lead">The future of recruiting is here.</p>
            <a class="red-button" href="register.php">Create a free account</a>
            <a class="red-button" href="about.php">Find out more</a>
        </header>
        <main class="container"> 
            <h1>Welcome</h1>
        </main>
        <?php
            echo str_repeat("<br>", 20); // placeholder for testing fixed navbar
            include "footer.inc.php";
        ?>
    </body>
</html>
