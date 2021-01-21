<?php
    session_start();
    session_unset();
    session_destroy();
    echo "<h1>Logout Successful<h1>";
    echo "<h2>You are being redirected</h2>";
    echo "<p>If your browser does not automatically redirect, click the button below.</p>";
    echo "<a class='green-button' href='index.php'> Return to Home </a>";

    header("location:index.php");
    exit();
?>