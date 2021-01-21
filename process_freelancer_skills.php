<?php
    session_start();
    
    include "validate.inc.php";
    include "db_functions.inc.php";
    
    $NUM_SKILLS = 3;
    $QUERY_UPDATE_SKILLS_BY_FREELANCER_ID = "UPDATE manyhires_freelancers_skills SET name=?, value=? WHERE freelancer_id=? AND skill_id=?";
    
    // Initialize skills if they don't exist
    $QUERY_INITIALISE_SKILLS_BY_FREELANCER_ID = "INSERT INTO manyhires_freelancers_skills "
            . "(freelancer_id, skill_id, name, value) "
            . "VALUES (?, ?, ?, ?)";
    
    $QUERY_GET_FREELANCER_SKILLS_BY_ID = "SELECT * FROM manyhires_freelancers_skills WHERE freelancer_id=? ORDER BY skill_id" ;
    list($return_code, $result, $errorMsg) = query_db($QUERY_GET_FREELANCER_SKILLS_BY_ID, array($_SESSION['id']));
    
    if (!$return_code === 0)
    {
        echo $errorMsg;
        exit();
    }
    else if ($result->num_rows == 0)
    {
        for ($i = 1; $i <= $NUM_SKILLS; $i++)
        {
            list($return_code, $result, $errorMsg) = query_db($QUERY_INITIALISE_SKILLS_BY_FREELANCER_ID, 
                    array(
                        $_SESSION['id'], $i, "Add a skill...", 50
                    ));
            if (!$return_code === 0)
            {
                echo $errorMsg;
                exit();
            }
        }
    }
    
    $success = true;
    $errorMsg = "";
    
    $skills = array();

    for ($i = 1; $i <= $NUM_SKILLS; $i++)
    {
        $skill_name = validate_input("skill" . $i . "-name", "Skill " . $i . " Name", 
                FILTER_VALIDATE_REGEXP, array("regexp" => skill_name_filter), 
                "Only alphabets and spaces are allowed.", true, true);

        $skill_value = validate_input("skill" . $i . "-value", "Skill " . $i . " Value", 
                FILTER_VALIDATE_INT, array("min_range" => 0, "max_range" => 100), 
                "Only numbers between 0 to 100 are allowed.", true, true);

        // Add new name-value pair to associative array
        $skills += [$skill_name => $skill_value];
    }

    if ($success)
    {
        $update_success = true;
        $i = 1;

        foreach ($skills as $skill_name => $skill_value)
        {
            list($return_code, $result, $errorMsg) = query_db($QUERY_UPDATE_SKILLS_BY_FREELANCER_ID, 
                    array($skill_name, intval($skill_value), $_SESSION['id'], $i));

            if ($return_code !== 0)
            {
                $output ="<h1> Oops! </h1>";
                $output.= "<h2>The following input errors were detected:</h2>";
                $output.= "<p>" . $errorMsg . "</p>"; 
                $output.= "<a class='red-button' href='profile.php'> Return to Profile </a>";

                $update_success = false;
                break;
            }

            $i++;
        }
        if ($update_success)
        {
            // Redirect the user
            header("location:profile.php");
            exit();
        }
    }
    else
    {
        $output.= "<h1> Oops! </h1>";
        $output.= "<h2>The following input errors were detected:</h2>";
        $output.= "<p>" . $errorMsg . "</p>"; 
        $output.= "<a class='red-button' href='profile.php'> Return to Profile </a>";
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