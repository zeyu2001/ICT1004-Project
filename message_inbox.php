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
            
          <div class="card flex-row m-2 p-2">
                <div class="card-header">
                    <img src="images/logo_graphic.png" alt="">
                </div>
                <div class="card-block px-2 w-75">
                    <h4 class="card-title">ManyHire Pte Ltd</h4>
                    <p class="card-text border rounded text-wrap">preview message asddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd</p>
                    <a href="#" class="btn btn-primary">reply</a>
                </div>
            </div>
            
            <div class="card flex-row m-2 p-2">
                <div class="card-header">
                    <img src="images/logo_graphic.png" alt="">
                </div>
                <div class="card-block px-2 w-75">
                    <h4 class="card-title">ManyHire Pte Ltd</h4>
                    <p class="card-text border rounded">How is the progress of the project?</p>
                    <a href="#" class="btn btn-primary float">reply</a>
                </div>
            </div>
            
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>