<?php
    session_start();
    $_SESSION['display_name'] = 'James Bond'; // Dummy Session
    $_SESSION['account_type'] = 'Freelancer';
    $_SESSION['id'] = 1;
            
    header("location:index.php");
    exit();
?>

