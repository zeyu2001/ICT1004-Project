<div class="row">
    <div class="col-md mb-3">
        <div class="card">
            
            <!-- Display Profile Picture if Exists -->
            <?php if (file_exists("uploads/freelancer-". $id. "/profile.jpg")): ?>
                <div class="text-center bg-light">
                    <img class="card-img-top rounded-circle w-auto profile-pic" 
                         src="<?php echo "uploads/freelancer-". $id. "/profile.jpg" ?>"
                         alt="Profile Picture" width="350" height="350">
                </div>
            <?php endif; ?>
            
            <div class="card-body">
                <div class="icon-right">
                    <h1 class="card-title"><?php echo $display_name ?></h1>
                    <?php if ($can_edit): ?>    
                        <i class="material-icons edit-icon" data-toggle="modal" data-target="#edit-profile">edit</i>
                    <?php endif; ?>
                </div>
                
                <?php if ($can_edit): ?>
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
                <?php endif; ?>

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
                        <?php if ($can_edit): ?>
                            <i class="material-icons edit-icon" data-toggle="modal" data-target="#edit-skills">edit</i>
                        <?php endif; ?>
                    </div>
                    <?php if ($can_edit): ?>
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
                    <?php endif; ?>

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