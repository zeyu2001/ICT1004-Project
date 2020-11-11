<?php
    session_start();
    
    /* If not logged in, redirect to index.php */
    if (!isset($_SESSION['display_name']))
    {
        header("location:index.php");
        exit();
    }
    
    // SQL Queries
    $QUERY_GET_FREELANCER_BY_ID = "SELECT * FROM manyhires_freelancers WHERE freelancer_id=?";
    $QUERY_GET_COMPANY_BY_ID = "SELECT * FROM manyhires_companies WHERE company_id=?";
?>

<!DOCTYPE html>
<html>
    <?php
        include "head.inc.php";
        include "db_functions.inc.php"
    ?>
    <body> 
        <?php
            include "nav.inc.php"; 
        ?>
        <main class="container"> 
            <?php
                switch ($_SESSION['account_type'])
                {
                    case 'Freelancer':
                        list($return_code, $result, $errorMsg) = query_db($QUERY_GET_FREELANCER_BY_ID, array($_SESSION['id']));
                        break;
                    
                    case 'Company':
                        list($return_code, $result, $errorMsg) = query_db($QUERY_GET_COMPANY_BY_ID, array($_SESSION['id']));
                        break;
                    
                    default:
                        echo "Invalid account type.</br>";
                }
                
                if (!$return_code === 0)
                {
                    echo $errorMsg;
                }
                else if ($result->num_rows > 0)
                {
                    // There should only be one row in the result set
                    $row = $result->fetch_assoc();
                    $email = $row["email"];
                    $description = $row["description"];
                    $location = $row["location"];
                    
                    switch ($_SESSION['account_type'])
                    {
                        case 'Freelancer':
                            $fname = $row["fname"];
                            $lname = $row["lname"];
                            $headline = $row['headline']
                            ?>
                            
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <div class="text-center bg-light">
                        <img class="card-img-top rounded-circle w-auto" 
                             src="https://bootdey.com/img/Content/avatar/avatar7.png" 
                             alt="Profile Picture" width="150px">
                    </div>
                    <div class="card-body">
                        <div class="icon-right">
                            <h1 class="card-title"><?php echo $_SESSION['display_name'] ?></h1>
                            <i class="material-icons">edit</i>
                        </div>
                        <h2 class="card-subtitle mb-2 text-muted"><?php echo $headline ?></h2>
                        <p class="text-secondary mb-2"> <?php echo $location ?> </p>
                        <p class="card-text"><?php echo $description ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">My Information</h2>
                        <!-- Form to Display / Edit Personal Information -->
                        <form action="#" method="post"> 
                            <div class="form-group">
                                <label for="fname">First Name:</label>
                                <input class="form-control" type="text" id="fname"
                                    maxlength="45" name="fname" value=<?php echo $fname ?>
                                    pattern="^[a-zA-Z\s]*$">
                            </div>

                            <div class="form-group">
                                <label for="lname">Last Name:</label> 
                                <input class="form-control" type="text" id="lname" required
                                    maxlength="45"  name="lname" value=<?php echo $lname ?>
                                    pattern="^[a-zA-Z\s]+$">
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input class="form-control" type="email" id="email" required
                                     name="email" value=<?php echo $email ?>
                                     pattern="^[a-z0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$">
                            </div>
                            
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Update</button> 
                            </div>
                        </form>
                        <!-- END Form -->
                    </div>
                </div>
            </div>
        </div>
                                
                            <?php break;
                            
                        case 'Company':
                            $name = $row["name"];
                            break;
                        
                        default:
                            echo "Invalid account type.</br>";
                    }
                }
                else
                {
                    echo "No result found";
                }
            ?>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>