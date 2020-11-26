<div class="row">
    <div class="col-md mb-3">
        <div class="card">
            
            <!-- Display Profile Picture if Exists -->
            <?php if (file_exists("uploads/company-". $id. "/profile.jpg")): ?>
                <div class="text-center bg-light">
                    <img class="card-img-top rounded-circle w-auto profile-pic" 
                         src="<?php echo "uploads/company-". $id. "/profile.jpg" ?>"
                         alt="Profile Picture" width="350" height="350">
                </div>
            <?php endif; ?>
            
            <div class="card-body">
                <div class="icon-right">
                    <h1 class="card-title"><?php echo $name ?></h1>
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
                                <?php include "profile_form_company.php" ?>

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
</div>