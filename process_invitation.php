<?php
/*
 * FUNCTIONS
 * -------------------------------------------------
 */

/*
 * num
 */

$coy_names = ["ManyHire Pte Ltd", "YourMom Inc.", "Fucking Industries"];
$coy_emails = ["ManyHireHR@yolo.com", "YourMom@isgay.com", "fkingIndustries@fkYou.com"];
$coy_msgs = ["We are interested!", "We are interested!", "We are interested!"];

function listInvitations($num, $coy_names, $coy_emails, $coy_msgs)
{
    for ($i = 0; $i < $num; $i++)
    {
        echo $format = "<div class='card flex-row flex-wrap bg-light mb-3'>
                            <div class='card-header'>
                                <img src='images/logo_graphic.png' alt=''>
                            </div>
                            <div class='card-block px-2 w-50'>
                                <h4 class='card-title'>$coy_names[$i]</h4>
                                <p class='card-text'>$coy_msgs[$i]</p>
                                <a href='#' class='btn btn-primary '>Profile</a>
                                <a href='#' class='card-link '>$coy_emails[$i]</a>
                            </div>
                        </div>";
    }
}
?>

