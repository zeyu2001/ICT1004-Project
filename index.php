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
        <header class="jumbotron text-center" id='index-jumbotron'>
            <h1 class="display-4">Talent on Demand.</h1> 
            <p class="lead">The future of recruiting is here.</p>
            <a class="red-button" href="register.php">Create a free account</a>
            <a class="red-button" href="about.php">Find out more</a>
            <form id="searchBar" action="#">
                <div class="form-group">
                    <input class="form-control border border-dark" type="search" placeholder="Search for talents" aria-label="Search">
                </div>
                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </header>
        <main class="container">
            
            <section id="welcome">
                <h1>Welcome</h1>
            </section>
            <section id="about">
                <h1>About</h1>
            </section>
        </main>
        <?php
            echo str_repeat("<br>", 20); // placeholder for testing fixed navbar
            include "footer.inc.php";
        ?>
    </body>
</html>
