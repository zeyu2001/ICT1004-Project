<?php
    $QUERY_GET_INVITATIONS = "SELECT * FROM manyhires_invitations WHERE freelancer_id=? AND listing_id=? AND accepted=0 AND rejected=0";
    $QUERY_GET_COMPANY_BY_ID = "SELECT * FROM manyhires_companies WHERE company_id=?";
    
    list($return_code, $invitations_result, $errorMsg) = query_db($QUERY_GET_INVITATIONS, 
            array($listings_row['freelancer_id'], $listings_row['listing_id']));
    
    // Otherwise, don't display any invitations
    if ($return_code === 0 && $invitations_result->num_rows > 0)
    { ?>
        <div class="row listing-row align-items-center">
            <a href="#" class="green-button" data-toggle="modal" data-target="#invitations-<?php echo $listings_row['listing_id'] ?>">
                View <?php echo $invitations_result->num_rows ?> Invitations
                <i class="material-icons">mark_chat_unread</i>
            </a>
        </div>
        
        <div id="invitations-<?php echo $listings_row['listing_id'] ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">My Invitations</h2>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                        <h3> <?php echo $listings_row['title'] ?> </h3>
                        <p> The following companies have invited you to join them. </p>
                        <p> Accept invitations to start a conversation. </p>
                        
                        <?php while ($invitations_row = $invitations_result->fetch_assoc()): 
                            
                            list($return_code, $company_result, $errorMsg) = query_db($QUERY_GET_COMPANY_BY_ID, 
                                array($invitations_row['company_id']));
                        
                            if ($return_code === 0 && $company_result->num_rows === 1): 
                                $company_row = $company_result->fetch_assoc(); ?>
                                
                                <div class='card flex-row flex-wrap bg-light mb-3'>
                                    <div class='card-body'>
                                        
                                        <div class="row">
                                            <!-- Display Profile Picture if Exists -->
                                            <?php if (file_exists("uploads/company-". $invitations_row['company_id']. "/profile.jpg")): ?>
                                                <div class='col-md-4 my-auto'>
                                                    <img class="rounded-circle listing-image" width="100%" 
                                                         src="<?php echo "uploads/company-". $invitations_row['company_id'] . "/profile.jpg" ?>"
                                                         alt="Profile Picture" width="350" height="350">
                                                </div>
                                            <?php endif; ?>

                                            <div class='col-md-8'>
                                                <div class="row align-items-center">
                                                    <div class="col-md-12 mb-3">
                                                        <h4 class='card-title'> <?php echo $company_row['name'] ?></h4>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center">
                                                    <div class="col-md-12 mb-3">
                                                        <p class='card-text'> <?php echo $invitations_row['description'] ?> </p>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center">
                                                    <div class="col-md-12 mb-3">
                                                        <a href='profile.php?user-id=<?php echo $company_row['company_id'] ?>&&profile-type=Company' class='btn btn-primary'> View Company Profile </a>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center">
                                                    <div class="col-md-12 mb-3">
                                                        <a href='#' class='card-link '> <?php echo $company_row['email'] ?> </a>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center">
                                                    <div class="col-md-6 mb-3">
                                                        <form method="post" action="process_accept_invite.php">
                                                            <input type="hidden" name="message" value="<?php echo $invitations_row['description'] ?>">
                                                            <input type="hidden" name="invitation_id" value="<?php echo $invitations_row['invitation_id'] ?>">
                                                            <input type="hidden" name="listing_id" value="<?php echo $listings_row['listing_id'] ?>">
                                                            <input type="hidden" name="company_id" value="<?php echo $company_row['company_id'] ?>">
                                                            <input type="hidden" name="type" value="accept">
                                                            <button class='btn btn-success' type="submit"> Accept </button>
                                                        </form>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <form method="post" action="process_accept_invite.php">
                                                            <input type="hidden" name="invitation_id" value="<?php echo $invitations_row['invitation_id'] ?>">
                                                            <input type="hidden" name="listing_id" value="<?php echo $listings_row['listing_id'] ?>">
                                                            <input type="hidden" name="type" value="reject">
                                                            <button class='btn btn-danger' type="submit"> Reject </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endwhile; ?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php }
?>

