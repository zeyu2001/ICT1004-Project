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
        
        <main class="container border mb-2">
            <?php
            
            if (isset($_SESSION['account_type']) && $_SESSION['account_type'] === 'Freelancer') {
                
                list($return_code, $chats_result, $errorMsg) = query_db("SELECT freelancer_id, company_id, sender_type, message, date_format(datetime, '%d %b %y, %h:%i%p') as timestamp FROM manyhires_messages WHERE freelancer_id = ? and company_id = ?", array($_SESSION['id'], $_GET['id']));
                    
                if (!$return_code === 0)
                    {
                        echo $errorMsg;
                        exit();
                    }
                
                else {
                    while ($chats_row = $chats_result->fetch_assoc()) {
                        if ($chats_row['sender_type'] == 'freelancer') {
                            ?>
                            <div class="chat-container-send ">
                                <img class="rounded-circle listing-image" src="<?php echo "uploads/freelancer-". $chats_row['freelancer_id']. "/profile.jpg" ?>" alt="Profile Picture">
                                <p class="mr-4"><?php echo $chats_row['message']; ?></p>
                            </div>
            <?php
                        }
                        
                        else {
                            ?>
                            <div class="chat-container-receive">
                                <img class="rounded-circle listing-image" src="<?php echo "uploads/company-". $chats_row['company_id']. "/profile.jpg" ?>" alt="Profile Picture">
                                <p class="mr-4"><?php echo $chats_row['message']; ?></p>
                            </div>
            <?php
                        }
                    }
                }
            }
            
            else {
                list($return_code, $chats_result, $errorMsg) = query_db("SELECT freelancer_id, company_id, sender_type, message, date_format(datetime, '%d %b %y, %h:%i%p') as timestamp FROM manyhires_messages WHERE freelancer_id = ? and company_id = ?", array($_GET['id'], $_SESSION['id']));
                    
                if (!$return_code === 0)
                    {
                        echo $errorMsg;
                        exit();
                    }
                
                else {
                    while ($chats_row = $chats_result->fetch_assoc()) {
                        if ($chats_row['sender_type'] == 'company') {
                            ?>
                            <div class="chat-container-send ">
                                <img class="rounded-circle listing-image" src="<?php echo "uploads/company-". $chats_row['company_id']. "/profile.jpg" ?>" alt="Profile Picture">
                                <p class="mr-4"><?php echo $chats_row['message']; ?></p>
                            </div>
            <?php
                        }
                        
                        else {
                            ?>
                            <div class="chat-container-receive">
                                <img class="rounded-circle listing-image" src="<?php echo "uploads/freelancer-". $chats_row['freelancer_id']. "/profile.jpg" ?>" alt="Profile Picture">
                                <p class="mr-4"><?php echo $chats_row['message']; ?></p>
                            </div>
            <?php
                        }
                    }
                }
            }
            ?>
           
            <form method="post" action="process_chat.php">
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