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
    $QUERY_GET_FREELANCER_SKILLS_BY_ID = "SELECT * FROM manyhires_freelancers_skills WHERE freelancer_id=? ORDER BY skill_id" ;
    $QUERY_GET_COMPANY_BY_ID = "SELECT * FROM manyhires_companies WHERE company_id=?";
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
                    exit();
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
            <div class="col-md mb-3">
                <div class="card">
                    <div class="text-center bg-light">
                        <img class="card-img-top rounded-circle w-auto" 
                             src="https://bootdey.com/img/Content/avatar/avatar7.png" 
                             alt="Profile Picture" width="150px">
                    </div>
                    <div class="card-body">
                        <div class="icon-right">
                            <h1 class="card-title"><?php echo $_SESSION['display_name'] ?></h1>
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
                                    <form action="process_profile.php" method="post" id="profile-form"> 
                                        <div class="form-group">
                                            <label for="fname">First Name:</label>
                                            <input class="form-control" type="text" id="fname"
                                                maxlength="45" name="fname" value="<?php echo $fname ?>"
                                                pattern="^[a-zA-Z\s]*$">
                                        </div>

                                        <div class="form-group">
                                            <label for="lname">Last Name:</label> 
                                            <input class="form-control" type="text" id="lname" required
                                                maxlength="45"  name="lname" value="<?php echo $lname ?>"
                                                pattern="^[a-zA-Z\s]+$">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input class="form-control" type="email" id="email" required
                                                 name="email" value="<?php echo $email ?>" 
                                                 pattern="^[a-z0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$">
                                        </div>

                                        <div class="form-group">
                                            <label for="headline">Headline:</label>
                                            <input class="form-control" type="text" id="headline" required
                                                 name="headline" value="<?php echo $headline ?>"
                                                 pattern="^[a-zA-Z\s\.,!?]*$">
                                        </div>

                                        <div class="form-group">
                                            <label for="location">Location:</label>
                                            <input class="form-control" type="text" id="location" required
                                                 name="location" value="<?php echo $location ?>"
                                                 pattern="^[a-zA-Z\s\.,!?]*$">
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Description:</label>
                                            <textarea class="form-control" form="profile-form" name="description"><?php echo $description ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Update</button> 
                                        </div>
                                    </form>
                                    <!-- END Form -->
                                
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
                                            
                                            <form action="process_skills.php">

                                                <div class="form-row align-items-center">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="skill1-name">Skill 1 Name</label> 
                                                        <input class="form-control" type="text" id="skill1-name" required
                                                               maxlength="45" 
                                                               placeholder ="e.g. PHP"
                                                               name="skill1-name" value=""
                                                               pattern="^[a-zA-Z\s\.,!?]*$">
                                                    </div>                                    
                                                </div>

                                                <div class="form-row align-items-center">
                                                    <div class="col-md-3 mb-3">
                                                        <label for="skill1-value">Skill 1 Value</label>
                                                        <input class="form-control skill-value" required 
                                                               name="skill1-value" id="skill1-value" 
                                                               type="number" min="1" max="100" placeholder="e.g. 50">
                                                    </div>
                                                    <div class="col-md-9 mb-3">
                                                        <label for="skill1-slider" class="label-hidden">Skill 1 Slider</label> 
                                                        <input name="skill1-slider" id="skill1-slider" 
                                                               type="range" min="1" max="100" value="50" 
                                                               class=" form-control slider skill-slider">
                                                    </div>
                                                </div>

                                                <div class="form-row align-items-center">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="skill2-name">Skill 2 Name</label> 
                                                        <input class="form-control" type="text" id="skill2-name" required
                                                               maxlength="45" 
                                                               placeholder ="e.g. MySQL"
                                                               name="skill2-name" value=""
                                                               pattern="^[a-zA-Z\s\.,!?]*$">
                                                    </div>
                                                </div>

                                                <div class="form-row align-items-center">
                                                    <div class="col-md-3 mb-3">
                                                        <label for="skill2-value">Skill 2 Value</label>
                                                        <input class="form-control skill-value" required 
                                                               name="skill2-value" id="skill2-value" 
                                                               type="number" min="1" max="100" placeholder="e.g. 50">
                                                    </div>
                                                    <div class="col-md-9 mb-3">
                                                        <label for="skill2-slider" class="label-hidden">Skill 2 Slider</label> 
                                                        <input name="skill2-slider" id="skill2-slider" 
                                                               type="range" min="1" max="100" value="50" 
                                                               class=" form-control slider skill-slider">
                                                    </div>
                                                </div>

                                                <div class="form-row align-items-center">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="skill3-name">Skill 3 Name</label> 
                                                        <input class="form-control" type="text" id="skill3-name" required
                                                               maxlength="45" 
                                                               placeholder ="e.g. JavaScript"
                                                               name="skill3-name" value=""
                                                               pattern="^[a-zA-Z\s\.,!?]*$">
                                                    </div>
                                                </div>

                                                <div class="form-row align-items-center">
                                                    <div class="col-md-3 mb-3">
                                                        <label for="skill3-value">Skill 3 Value</label>
                                                        <input class="form-control skill-value" required 
                                                               name="skill3-value" id="skill3-value" 
                                                               type="number" min="1" max="100" placeholder="e.g. 50">
                                                    </div>
                                                    <div class="col-md-9 mb-3">
                                                        <label for="skill3-slider" class="label-hidden">Skill 3 Slider</label> 
                                                        <input name="skill3-slider" id="skill3-slider" 
                                                               type="range" min="1" max="100" value="50" 
                                                               class=" form-control slider skill-slider">
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <button class="btn btn-primary" type="submit">Update</button> 
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="container">
                            <?php 
                                list($return_code, $result, $errorMsg) = query_db($QUERY_GET_FREELANCER_SKILLS_BY_ID, array($_SESSION['id']));
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
                    echo "No result found";
                }
            ?>
        </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>