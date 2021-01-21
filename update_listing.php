<form action="process_update_listing.php" method="post" id="edit-listing-form<?php echo $i ?>"> 
    
    <input hidden type="number" id="listing_id" name="listing_id" value="<?php echo $listings_row['listing_id'] ?>">
   
    <div class="form-group">
        <label for="listing_type">Type:</label>
        <select class="form-control form-control-md" name="listing_type" id="account_type">
            <option value="full-stack">Full-Stack Development</option>
            <option value="front-end">Front-End Development</option>
            <option value="back-end">Back-End Development</option>
        </select>
    </div>
    
    <div class="form-group">
        <label for="title">Title:</label>
        <input class="form-control" type="text" id="title" value="<?php echo $listings_row['title'] ?>" 
            maxlength="45" name="title" placeholder="e.g. LAMP Stack Development"
            pattern="^[a-zA-Z\s\.,!?]*$">
    </div>

    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" form="edit-listing-form<?php echo $i ?>" name="description"><?php echo $listings_row['description'] ?></textarea>
    </div>

    <div class="form-group">
        <button class="btn btn-primary" type="submit">Update</button> 
    </div>
</form>