<?php
    session_start();
    
    /* If not logged in, redirect to index.php */
    if (!isset($_SESSION['display_name']))
    {
        header("location:index.php");
        exit();
    }
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
            <h1><?php echo $_SESSION['display_name'] ?>'s Profile</h1>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>