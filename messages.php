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
        
        <main class="container border mb-2">
            <div class="chat-container-receive">
                <img class="" 
                     src="images/logo_graphic.png"
                     alt="Profile Picture">
                <p class="">hey there</p>
            </div>
            
            <div class="chat-container-send">
                <img class="" 
                     src="images/logo_graphic.png"
                     alt="Profile Picture">
                <p class="">waddup boi</p>
            </div>
            
            <form method="post" action="#">
                        <div class="form-group form-row">
                            <div class="col">
                                <input class="form-control" id="reply" name="reply" type="text" placeholder="Your message">
                            </div>
                            <button class="btn btn-primary" type="submit">Send</button>
                        </div>
            </form>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>