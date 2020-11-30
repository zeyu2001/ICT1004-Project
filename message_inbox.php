<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        include "head.inc.php";
        include "db_functions.inc.php";
    ?>
    <body> 
        <?php
            include "nav.inc.php"; 
        ?>
        
        <main class="container">
            <?php  
                if (isset($_SESSION['account_type']) && $_SESSION['account_type'] === 'Freelancer') {
                    list($return_code, $chats_result, $errorMsg) = query_db("SELECT DISTINCT freelancer_id, company_id FROM manyhires_messages WHERE freelancer_id = ?", array($_SESSION['id']));
                    
                    if (!$return_code === 0)
                        {
                            echo $errorMsg;
                            exit();
                        }     
                    else {
                        $index = 0;
                        while($chats_row = $chats_result->fetch_assoc()) {
                            list($return_code_users, $users_result, $errorMsg) = query_db("SELECT name, company_id FROM manyhires_companies WHERE company_id = ?", array($chats_row['company_id']));
                               
                            if (!$return_code === 0)
                            {
                            echo $errorMsg;
                            exit();
                            }
                            
                            $user_row = $users_result->fetch_assoc();
                            
                            list($return_code_messages, $messages_result, $errorMsg) = query_db("SELECT sender_type, message, date_format(datetime, '%d %b %y, %h:%i%p') as timestamp FROM manyhires_messages WHERE company_id = ? ORDER BY datetime DESC LIMIT 1", array($chats_row['company_id']));
                            $message_row = $messages_result->fetch_assoc();
                            ?>
                            <div class="card flex-row mt-2 mb-5 mx-2 p-2">
                                <div class="col-md-3 my-auto">
                                    <img class="rounded-circle listing-image" src="<?php echo "uploads/company-". $chats_row['company_id']. "/profile.jpg" ?>" alt="">
                                </div>
                                <div class="card-block px-2 w-75">
                                    <h4 class="card-title"><?php echo $user_row['name'] ?></h4>
                                    <p class="card-text border rounded text-wrap">
                                        <?php 
                                        if ($message_row['sender_type'] == "freelancer") {
                                            echo "Me @". $message_row['timestamp']. ": ";
                                        }
                                        else {
                                            echo $user_row['name']. " @". $message_row['timestamp']. ": ";
                                        }
                                        ?>
                                    </p>
                                    <p class="card-text border rounded text-wrap">
                                        <?php
                                        echo $message_row['message'];
                                        ?>
                                    </p>
                                    <a href="messages.php?id=<?php echo $user_row['company_id']?>" class="btn btn-primary">Message</a>
                                </div>
                            </div>
                <?php
                            $index++;
                        }
                        if ($index === 0): ?>
                        <div class="row">
                            <div class="col-md-8 order-md-1 order-2">
                                <div class="col">
                                    <p>You don't have any active chats.</p>
                                </div>
                            </div>
                            <div class="col-md-4 order-md-2 order-1">
                                <img class="side-img mx-auto d-block" src="images/undraw_empty.svg" alt="">
                            </div>
                        </div>
                    <?php endif;
                    }
   
                }
                                 
            else {
                list($return_code, $chats_result, $errorMsg) = query_db("SELECT DISTINCT freelancer_id, company_id FROM manyhires_messages WHERE company_id = ?", array($_SESSION['id']));
                    
                    if (!$return_code === 0)
                        {
                            echo $errorMsg;
                            exit();
                        }     
                    else {
                        $index = 0;
                        while($chats_row = $chats_result->fetch_assoc()) {
                            list($return_code_users, $users_result, $errorMsg) = query_db("SELECT fname, lname, freelancer_id FROM manyhires_freelancers WHERE freelancer_id = ?", array($chats_row['freelancer_id']));
                               
                            if (!$return_code === 0)
                            {
                            echo $errorMsg;
                            exit();
                            }
                            
                            $user_row = $users_result->fetch_assoc();
                            
                            list($return_code_messages, $messages_result, $errorMsg) = query_db("SELECT sender_type, message, date_format(datetime, '%d %b %y, %h:%i%p') as timestamp FROM manyhires_messages WHERE freelancer_id = ? ORDER BY datetime DESC LIMIT 1", array($chats_row['freelancer_id']));
                            $message_row = $messages_result->fetch_assoc();
                            ?>
                            <div class="card flex-row mt-2 mb-5 mx-2 p-2">
                                <div class="col-md-3 my-auto">
                                    <img class="rounded-circle listing-image" src="<?php echo "uploads/freelancer-". $chats_row['freelancer_id']. "/profile.jpg" ?>" alt="">
                                </div>
                                <div class="card-block px-2 w-75">
                                    <h4 class="card-title"><?php echo $user_row['fname']. " ". $user_row['lname'] ?></h4>
                                    <p class="card-text border rounded text-wrap">
                                        <?php 
                                        if ($message_row['sender_type'] == "company") {
                                            echo "Me @". $message_row['timestamp']. ": ";
                                        }
                                        else {
                                            echo $user_row['fname']. " @". $message_row['timestamp']. ":";
                                        }
                                         ?>
                                    </p>
                                    <p class="card-text border rounded text-wrap">
                                        <?php
                                        echo $message_row['message'];
                                        ?>
                                    </p>
                                    <a href="messages.php?id=<?php echo $user_row['freelancer_id']?>" class="btn btn-primary">Message</a>
                                </div>
                            </div>
                <?php
                            $index++;
                        }
                        if ($index === 0): ?>
                        <div class="row">
                            <div class="col-md-8 order-md-1 order-2">
                                <div class="col">
                                    <p>You don't have any active chats.</p>
                                </div>
                            </div>
                            <div class="col-md-4 order-md-2 order-1">
                                <img class="side-img mx-auto d-block" src="images/undraw_empty.svg" alt="">
                            </div>
                        </div>
                    <?php endif;
                    }
                }
            ?>
       
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>