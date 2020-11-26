<?php
    $QUERY_GET_INVITATIONS = "SELECT * FROM manyhires_invitations WHERE freelancer_id=? AND listing_id=?";
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
                        
                        <?php while ($invitations_row = $invitations_result->fetch_assoc()): 
                            
                            list($return_code, $company_result, $errorMsg) = query_db($QUERY_GET_COMPANY_BY_ID, 
                                array($invitations_row['company_id']));
                        
                            if ($return_code === 0 && $company_result->num_rows === 1): 
                                $company_row = $company_result->fetch_assoc(); ?>
                                
                                <div class='card flex-row flex-wrap bg-light mb-3'>
                                    <div class='card-header'>
                                    </div>
                                    <div class='card-body'>
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
                                                <a href='#' class='btn btn-primary'> View Company Profile </a>
                                            </div>
                                        </div>
                                        <div class="row align-items-center">
                                            <div class="col-md-12 mb-3">
                                                <a href='#' class='card-link '> <?php echo $company_row['email'] ?> </a>
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

