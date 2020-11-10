<?php
    // Connect To Database
    $hostname='184.72.246.32:3306';
    $username='sqldev';
    $password='ICT1004BestGroup!';
    $dbname='manyhires';
    $table='manyhires_freelancers';
    
    $conn = new mysqli($hostname, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error)
    {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false; 
        $conn->close(); 
    }
    
    echo "Success: A proper connection to MySQL was made!</br>";
    echo "Host information: " . mysqli_get_host_info($conn) . "</br>";
    
    // Prepare the statement:
    $stmt = $conn->prepare("SELECT * FROM manyhires_freelancers");
    
    // Execute the query statement: 
    $stmt->execute();
    $result = $stmt->get_result();

    $stmt->close();
    $conn->close(); 
    
    if($result) {
        
        // Loop through results
        while ($row = $result->fetch_assoc())
            $fname = $row["fname"];
            $lname = $row["lname"];
            echo 'Name: ' . $fname . ' ' . $lname . "</br>";
    }
    else {
        echo "No data found </br>";
    }
?>
