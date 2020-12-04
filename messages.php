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
        <script defer src="js/messages.js"></script>
        
        <main class="container border mb-2">
            <?php
            
            if (isset($_SESSION['account_type']) && $_SESSION['account_type'] === 'Freelancer') {
                
                if(isset($_POST['reply']) && $_POST['reply'] != "") {
                    date_default_timezone_set("Asia/Singapore");
                    $time = date("Y-m-d H:i:s");
                    $message = $_POST['reply'];
                    $message = trim($message);
                    $message = stripslashes($message);
                    $message = htmlspecialchars($message);
                    $message = filter_var($message, FILTER_SANITIZE_STRING);
                    $INSERT_MESSAGE = "INSERT INTO manyhires_messages VALUES(0, '". $time. "', ". $_SESSION['id']. ", ". $_GET['id']. ", '". $message. "', 'freelancer')";
                    list($return_code, $result, $errorMsg) = query_db($INSERT_MESSAGE, NULL);
                }
                
                list($return_code, $unique_result, $errorMsg) = query_db("SELECT DISTINCT date_format(datetime, '%d %M %Y') as date, freelancer_id, company_id from manyhires_messages where freelancer_id= ? and company_id = ?", array($_SESSION['id'], $_GET['id']));
               
                if (!$return_code === 0)
                    {
                        echo $errorMsg;
                        exit();
                    }
                
                else {
                    $count = 0;
                    while ($unique_row = $unique_result->fetch_assoc()) {
                        
                        if ($count == 0) {
            ?>          
                            <div class="datestamp mt-2">    
                                <?php echo $unique_row['date']; ?>
                            </div>
                        
            <?php
                        }
                        
                        else {
                            ?>
                            <div class="datestamp mt-5">    
                            <?php echo $unique_row['date']; ?>
                        </div>
            <?php
                        }
                        list($return_code, $chats_result, $errorMsg) = query_db("SELECT message_id, freelancer_id, company_id, sender_type, message, date_format(datetime, '%d %M %Y') as date, date_format(datetime, '%h:%i %p') as timestamp FROM manyhires_messages WHERE freelancer_id = ? and company_id = ?", array($_SESSION['id'], $_GET['id']));
                        
                        $message_count = 1;
                        while ($chats_row = $chats_result->fetch_assoc()) {
                            
                            list($return_code, $username_result, $errorMsg) = query_db("SELECT name FROM manyhires_companies WHERE company_id = ?", array($_GET['id']));
                            $username_row = $username_result->fetch_assoc();
                            
                            if ($unique_row['date'] == $chats_row['date']) {
                                if ($chats_row['sender_type'] == 'freelancer') {
                         
                                    if (isset($_POST['edit']) && $_POST['edit'] != "" && $_GET['mid'] == $chats_row['message_id']) {
                                        $message = $_POST['edit'];
                
                                        $UPDATE_MESSAGE = "UPDATE manyhires_messages SET message = '". $message. "' WHERE message_id = ?";
                                        list($return_code, $result, $errorMsg) = query_db($UPDATE_MESSAGE, array($chats_row['message_id']));
                                        $chats_row['message'] = $message;
                                    }
                                    
                                    else if (isset($_POST['delete']) && $_GET['mid'] == $chats_row['message_id']) {
                                        
                                        $DELETE_MESSAGE = "DELETE FROM manyhires_messages WHERE message_id = ?";
                                        list($return_code, $result, $errorMsg) = query_db($DELETE_MESSAGE, array($chats_row['message_id']));
                                        
                                        continue;
                                    }
                                     
            ?>
                                    <div class="chat-container-send ">
                                        <img class="rounded-circle listing-image" src="<?php echo "uploads/freelancer-". $chats_row['freelancer_id']. "/profile.jpg" ?>" alt="Profile Picture">
                                        <div class="bottomleft-aligned ml-3">
                                            <p>
                                            <?php 
                                                echo "Me @". $chats_row['timestamp'];
                                            ?>
                                            </p>
                                            <a type="button" class="dropdown ml-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons">menu</i>
                                            </a>
                                            <div class="dropdown-menu dropdown-primary">
                                                <button class="dropdown-item" onclick="editMessage(<?php echo $message_count. ", '". htmlspecialchars($_SERVER["PHP_SELF"]). "?id=". $chats_row['company_id']. "&mid=". $chats_row['message_id']. "'"; ?>)">Edit</button>
                                                <button class="dropdown-item" onclick="deleteMessage(<?php echo $message_count. ", '". htmlspecialchars($_SERVER["PHP_SELF"]). "?id=". $chats_row['company_id']. "&mid=". $chats_row['message_id']. "'"; ?>)">Delete</button>                                 
                                            </div>
                                        </div>
                                        
                                        <p class="mr-3 mt-3" id="message-<?php echo $message_count; ?>"><?php echo $chats_row['message']; ?></p>
                                    </div>
            <?php
                                }
                        
                            else {
            ?>
                                    <div class="chat-container-receive">
                                        <img class="rounded-circle listing-image" src="<?php echo "uploads/company-". $chats_row['company_id']. "/profile.jpg" ?>" alt="Profile Picture">
                                        <div class="bottomright-aligned mr-3">
                                            <p>
                                            <?php 
                                                echo $username_row['name']. " @". $chats_row['timestamp'];
                                            ?>
                                            </p>
                                        </div>
                                        <p class="ml-3 mt-3"><?php echo $chats_row['message']; ?></p>
                                    </div>
            <?php
                            }
                        }
                        $message_count++;
                    }
                    $count++;
                }
                list($return_code, $result, $errorMsg) = query_db("SELECT DISTINCT freelancer_id, company_id FROM manyhires_messages WHERE company_id = ?", array($_GET['id']));
                    if ($result->fetch_assoc() == NULL) {
                        ?>
                        <div class="row">
                            <div class="col-md-8 order-md-1 order-2">
                                <div class="col">
                                    <p>Oops! There is nothing to see here.</p>
                                </div>
                            </div>
                            <div class="col-md-4 order-md-2 order-1">
                                <img class="side-img mx-auto d-block" src="images/undraw_empty.svg" alt="">
                            </div>
                        </div>
                        <?php
                    }
            
                    else {
                    ?>
                    
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]). "?id=". $_GET['id']; ?>">
                        <div class="form-group form-row">
                            <div class="col">
                                <input class="form-control" id="reply" name="reply" type="text" placeholder="Your message">
                            </div>
                            <button class="btn btn-primary" type="submit">Send</button>
                        </div>
                    </form>
                <?php
                    }
            }
        }
   
            
            
            
            else {
                if(isset($_POST['reply']) && $_POST['reply'] != "") {
                    date_default_timezone_set("Asia/Singapore");
                    $time = date("Y-m-d H:i:s");
                    $message = $_POST['reply'];
                    $message = trim($message);
                    $message = stripslashes($message);
                    $message = htmlspecialchars($message);
                    $message = filter_var($message, FILTER_SANITIZE_STRING);
                    $INSERT_MESSAGE = "INSERT INTO manyhires_messages VALUES(0, '". $time. "', ". $_GET['id']. ", ". $_SESSION['id']. ", '". $message. "', 'company')";
                    list($return_code, $result, $errorMsg) = query_db($INSERT_MESSAGE, NULL);
                }
                
                list($return_code, $unique_result, $errorMsg) = query_db("SELECT DISTINCT date_format(date(datetime), '%d %b %y') as date, freelancer_id, company_id from manyhires_messages where freelancer_id= ? and company_id = ?", array($_GET['id'], $_SESSION['id']));
          
                if (!$return_code === 0)
                    {
                        echo $errorMsg;
                        exit();
                    }
                
                else {
                    $count = 0;
                    while ($unique_row = $unique_result->fetch_assoc()) {
                         
                        if ($count == 0) {
            ?>          
                            <div class="datestamp mt-2">    
                                <?php echo $unique_row['date']; ?>
                            </div>
                        
            <?php
                        }
                        
                        else {
                            ?>
                            <div class="datestamp mt-5">    
                            <?php echo $unique_row['date']; ?>
                        </div>
            <?php
                        }
                        
                        list($return_code, $chats_result, $errorMsg) = query_db("SELECT message_id, freelancer_id, company_id, sender_type, message, date_format(datetime, '%d %b %y') as date, date_format(datetime, '%h:%i %p') as timestamp FROM manyhires_messages WHERE freelancer_id = ? and company_id = ?", array($_GET['id'], $_SESSION['id']));
                        
                        $message_count = 1;
                        
                        while ($chats_row = $chats_result->fetch_assoc()) {
                            list($return_code, $username_result, $errorMsg) = query_db("SELECT fname FROM manyhires_freelancers WHERE freelancer_id = ?", array($_GET['id']));
                            $username_row = $username_result->fetch_assoc();
                            if ($unique_row['date'] == $chats_row['date']) {
                                if ($chats_row['sender_type'] == 'company') {
                                    if (isset($_POST['edit']) && $_POST['edit'] != "" && $_GET['mid'] == $chats_row['message_id']) {
                                        $message = $_POST['edit'];
                
                                        $UPDATE_MESSAGE = "UPDATE manyhires_messages SET message = '". $message. "' WHERE message_id = ?";
                                        list($return_code, $result, $errorMsg) = query_db($UPDATE_MESSAGE, array($chats_row['message_id']));
                                        $chats_row['message'] = $message;
                                    }
                                    
                                    else if (isset($_POST['delete']) && $_GET['mid'] == $chats_row['message_id']) {
                                        
                                        $DELETE_MESSAGE = "DELETE FROM manyhires_messages WHERE message_id = ?";
                                        list($return_code, $result, $errorMsg) = query_db($DELETE_MESSAGE, array($chats_row['message_id']));
                                        
                                        continue;
                                    }
            ?>
                                    <div class="chat-container-send ">
                                        <img class="rounded-circle listing-image" src="<?php echo "uploads/company-". $chats_row['company_id']. "/profile.jpg" ?>" alt="Profile Picture">
                                        <div class="bottomleft-aligned ml-3">
                                            <p>
                                            <?php 
                                                echo "Me @". $chats_row['timestamp'];
                                            ?>
                                            </p>
                                            <a type="button" class="dropdown ml-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons">menu</i>
                                            </a>
                                            <div class="dropdown-menu dropdown-primary">
                                                <button class="dropdown-item" onclick="editMessage(<?php echo $message_count. ", '". htmlspecialchars($_SERVER["PHP_SELF"]). "?id=". $chats_row['freelancer_id']. "&mid=". $chats_row['message_id']. "'"; ?>)">Edit</button>
                                                <button class="dropdown-item" onclick="deleteMessage(<?php echo $message_count. ", '". htmlspecialchars($_SERVER["PHP_SELF"]). "?id=". $chats_row['freelancer_id']. "&mid=". $chats_row['message_id']. "'"; ?>)">Delete</button>                                 
                                            </div>
                                        </div>
                                        <p class="mr-3 mt-3" id="message-<?php echo $message_count; ?>"><?php echo $chats_row['message']; ?></p>
                                    </div>
            <?php
                                }
                            
                                else {
            ?>
                                    <div class="chat-container-receive">
                                        <img class="rounded-circle listing-image" src="<?php echo "uploads/freelancer-". $chats_row['freelancer_id']. "/profile.jpg" ?>" alt="Profile Picture">            
                                        <div class="bottomright-aligned mr-3">
                                            <p>
                                            <?php 
                                                echo $username_row['fname']. " @". $chats_row['timestamp'];
                                            ?>
                                            </p>
                                        </div>
                                        <p class="ml-3 mt-3"><?php echo $chats_row['message']; ?></p>
                                    </div>
            <?php
                                }
                            }
                            $message_count++;
                        }
                        $count++;
                    }
                    list($return_code, $result, $errorMsg) = query_db("SELECT DISTINCT freelancer_id, company_id FROM manyhires_messages WHERE freelancer_id = ?", array($_GET['id']));
                    if ($result->fetch_assoc() == NULL) {
                        ?>
                        <div class="row">
                            <div class="col-md-8 order-md-1 order-2">
                                <div class="col">
                                    <p>Oops! There is nothing to see here.</p>
                                </div>
                            </div>
                            <div class="col-md-4 order-md-2 order-1">
                                <img class="side-img mx-auto d-block" src="images/undraw_empty.svg" alt="">
                            </div>
                        </div>
                        <?php
                    }
            
                    else {
                    ?>
           
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]). "?id=". $_GET['id']; ?>">
                        <div class="form-group form-row">
                            <div class="col">
                                <label for="reply" hidden>Your Message</label>
                                <input class="form-control" id="reply" name="reply" type="text" placeholder="Your message">
                            </div>
                            <button class="btn btn-primary" type="submit">Send</button>
                        </div>
                    </form>
                <?php
                    }
                }
            }
            ?>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>