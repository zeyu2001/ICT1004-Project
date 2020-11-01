<?php
    session_start();
    $_SESSION['display_name'] = 'Test User'; // Dummy Session
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
        <header class="jumbotron text-center">
            <h1 class="display-4">Welcome to ManyHires!</h1> 
            <h2>Placeholder Text</h2>
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
