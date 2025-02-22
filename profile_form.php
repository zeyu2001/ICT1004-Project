<form action="process_freelancer_profile.php" method="post" id="profile-form" enctype="multipart/form-data"> 
    
    <div class="form-group">
        <label for="profile-pic">Profile Picture:</label>
        <input class="form-control-file" type="file" name="profile-pic" id="profile-pic" aria-describedby="profilePicHelpBlock">
    </div>
    <small id="profilePicHelpBlock" class="form-text text-muted">
        Please note that only JPG, JPEG, PNG & GIF files are allowed. If your profile picture is not updated, try refreshing the browser cache.
    </small>
    
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
             pattern="^[a-zA-Z0-9\s\.\-,!?]*$">
    </div>

    <div class="form-group">
        <label for="location">Location:</label>
        <input class="form-control" type="text" id="location" required
             name="location" value="<?php echo $location ?>"
             pattern="^[a-zA-Z0-9\s\.\-,!?]*$">
    </div>

    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" form="profile-form" name="description"><?php echo $description ?></textarea>
    </div>

    <div class="form-group">
        <button class="btn btn-primary" type="submit">Update</button> 
    </div>
</form>