<?php
    session_start();
    
    // SQL Queries
    $QUERY_GET_FREELANCER_BY_ID = "SELECT * FROM manyhires_freelancers WHERE freelancer_id=?";
    $QUERY_GET_FREELANCER_SKILLS_BY_ID = "SELECT * FROM manyhires_freelancers_skills WHERE freelancer_id=? ORDER BY skill_id" ;
    $QUERY_GET_COMPANY_BY_ID = "SELECT * FROM manyhires_companies WHERE company_id=?";
    
    // View other users' public profiles            
    if(isset($_GET['user-id']) && is_numeric($_GET['user-id']) && 
            isset($_GET['profile-type']) && ($_GET['profile-type'] === 'Freelancer' || $_GET['profile-type'] === 'Company'))
    {
        $id = $_GET['user-id'];
        $account_type = $_GET['profile-type'];
    }
    else if (isset($_SESSION['id']) && isset($_SESSION['account_type']))
    {
        $id = $_SESSION['id'];
        $account_type = $_SESSION['account_type'];
    }
    else
    {
        // User shouldn't be here.
        header("location:index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
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
                switch ($account_type)
                {
                    case 'Freelancer':
                        list($return_code, $result, $errorMsg) = query_db($QUERY_GET_FREELANCER_BY_ID, array($id));
                        break;
                    
                    case 'Company':
                        list($return_code, $result, $errorMsg) = query_db($QUERY_GET_COMPANY_BY_ID, array($id));
                        break;
                    
                    default:
                        echo "Invalid account type.</br>";
                }
                
                if (!$return_code === 0)
                {
                    echo $errorMsg;
                    exit();
                }
                else if ($result->num_rows > 0)
                {
                    // There should only be one row in the result set
                    $row = $result->fetch_assoc();
                    $email = $row["email"];
                    $description = $row["description"];
                    $location = $row["location"];
                    
                    switch ($account_type)
                    {
                        case 'Freelancer':
                            $fname = $row["fname"];
                            $lname = $row["lname"];
                            $headline = $row['headline'];
                                    
                            if ($fname)
                            {
                                $display_name = $fname . " " . $lname;
                            }
                            else
                            {
                                $display_name = $lname;
                            }
                            ?>
                            
        <div class="row">
            <div class="col-md mb-3">
                <div class="card">
                    <div class="text-center bg-light">
                        <img class="card-img-top rounded-circle w-auto profile-pic" 
                             src="https://bootdey.com/img/Content/avatar/avatar7.png" 
                             alt="Profile Picture" width="350" height="350">
                    </div>
                    <div class="card-body">
                        <div class="icon-right">
                            <h1 class="card-title"><?php echo $display_name ?></h1>
                            <i class="material-icons edit-icon" data-toggle="modal" data-target="#edit-profile">edit</i>
                        </div>
                        
                        <!-- Modal -->
                        <div id="edit-profile" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title">Edit Profile</h2>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                
                                    <!-- Form to Update Profile Display Information -->
                                    <?php include "profile_form.php" ?>
                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                          </div>
                        </div>
                        
                        <h2 class="card-subtitle mb-2 text-muted"><?php echo $headline ?></h2>
                        <p class="text-secondary mb-2"> <?php echo $location ?> </p>
                        <p class="card-text"><?php echo $description ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="slidecontainer">
                            <div class="icon-right">
                                <h2 class="card-title">My Skills</h2>
                                <i class="material-icons edit-icon" data-toggle="modal" data-target="#edit-skills">edit</i>
                            </div>
                        
                            <!-- Modal -->
                            <div id="edit-skills" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title">Edit Skills</h2>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <?php include "skills_form.php" ?>
                                        </div>
                                        <div class="modal-footer">
                                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="container">
                            <?php 
                                list($return_code, $result, $errorMsg) = query_db($QUERY_GET_FREELANCER_SKILLS_BY_ID, array($id));
                                if (!$return_code === 0)
                                {
                                    echo $errorMsg;
                                    exit();
                                }
                                else if ($result->num_rows > 0)
                                {
                                    // Results are in ascending order of skill_id
                                    while($row = $result->fetch_assoc()){
                                        $skill_name = $row["name"];
                                        $skill_value = $row["value"];
                                        ?>
                                <div class="row align-items-center">
                                    <div class="col-md-12 mb-3"><?php echo $skill_name ?></div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-md-12 mb-3">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" 
                                             role="progressbar" aria-valuenow="<?php echo $skill_value ?>" 
                                             aria-valuemin="1" aria-valuemax="100" style="width: <?php echo $skill_value ?>%">
                                                 <?php echo $skill_value ?>
                                        </div>
                                    </div>
                                </div>
                                        <?php
                                    }
                                }
                            ?>
                            </div>
                        </div>
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
                    echo "<h1> Oops! </h1>";
                    echo"<h2> Something went wrong. </h2>";
                    echo "<p>The profile you requested does not exist.</p>";
                    echo "<a class='red-button' href='index.php'> Return to Home </a>";
                }
            ?>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>