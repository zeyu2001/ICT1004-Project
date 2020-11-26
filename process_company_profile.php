<?php
    session_start();
    
    include "validate.inc.php";
    include "db_functions.inc.php";

    /* 
     * Process the profile picture file upload.
     * Adapted from W3 Schools PHP File Upload example.
     * https://www.w3schools.com/php/php_file_upload.asp
     * 
     * Returns: 0 if error, 1 otherwise.
     */
    function processFileInput()
    {
        $target_dir = "uploads/company-". $_SESSION['id']. "/";
        $target_file = $target_dir . "profile.jpg";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($_FILES["profile-pic"]["name"], PATHINFO_EXTENSION));
    
        // Check if image file is a actual image or fake image
        if (isset($_FILES['profile-pic']) && !empty($_FILES['profile-pic']['name'])) {
          $check = getimagesize($_FILES["profile-pic"]["tmp_name"]);
          
            if ($check !== false) {
                $uploadOk = 1;
                
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        else
        {
            // No file was uploaded, so no error
            return 1;
        }

        // Check file size
        if ($_FILES["profile-pic"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0755, true);
            }
            
            if (file_exists($target_file))
            {
                chmod($target_file,0755);
                unlink($target_file);        // Remove the file
            }
            
            if (!move_uploaded_file($_FILES["profile-pic"]["tmp_name"], $target_file)) {
              echo "Sorry, there was an error uploading your file.";
              $uploadOk = 0;
            }
        }
        return $uploadOk;
    }

    $QUERY_UPDATE_COMPANY_BY_ID = "UPDATE manyhires_companies SET email=?, name=?, description=?, location=?, headline=? WHERE company_id=?";
    
    $errorMsg = "";
    $success = true;
    
    $email = validate_input("email", "email", 
            FILTER_VALIDATE_REGEXP, array("regexp" => email_filter),
            "Please enter a valid email.", true, true);
    $name = validate_input("name", "name", 
            FILTER_VALIDATE_REGEXP, array("regexp" => namefields_filter),
            "Only alphabets and spaces are allowed.", false, true);
    $headline = validate_input("headline", "headline", 
            FILTER_VALIDATE_REGEXP, array("regexp" => headline_filter),
            "Please remove invalid characters.", true, true);
    $location = validate_input("location", "location", 
            FILTER_VALIDATE_REGEXP, array("regexp" => location_filter),
            "Please remove invalid characters.", true, true);
    $description = validate_input("description", "description", 
            FILTER_VALIDATE_REGEXP, array("regexp" => description_filter),
            "Please remove invalid characters.", true, true);
    
    if ($success)
    {
        list($return_code, $result, $errorMsg) = query_db($QUERY_UPDATE_COMPANY_BY_ID, 
                array(
                    $email,
                    $name,
                    $description,
                    $location,
                    $headline,
                    $_SESSION['id']
                ));
        if ($return_code === 0)
        {
            $_SESSION["display_name"] = $name;
            
            if (processFileInput() === 1)
            {
                // Redirect the user
                header("location:profile.php");
                exit();
            }
            else
            {
                $output = "<h1> Oops! </h1>";
                $output.="<h2> File upload unsuccessful. </h2>";
                $output.="<p> Please try again later. </p>"; 
                $output.="<a class='red-button' href='profile.php'> Return to Profile </a>";
            }
            
        }
        else
        {
            $output = "<h1> Oops! </h1>";
            $output.="<h2>The following input errors were detected:</h2>";
            $output.="<p>" . $errorMsg . "</p>"; 
            $output.="<a class='red-button' href='profile.php'> Return to Profile </a>";
        }
    }
    else
    {
        $output ="<h1> Oops! </h1>";
        $output.="<h2>The following input errors were detected:</h2>";
        $output.="<p>" . $errorMsg . "</p>"; 
        $output.="<a class='red-button' href='profile.php'> Return to Profile </a>";
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        include "head.inc.php";
    ?>
    <body> 
        <?php
            include "nav.inc.php"; 
        ?>
        <main class="container">
            <?php
                echo $output;
            ?>
      </main>
        <?php
            include "footer.inc.php";
        ?>
    </body>
</html>