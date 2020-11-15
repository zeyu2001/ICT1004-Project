<?php
    // ONLY FOR DEVELOPMENT. MOVE TO A SECURE .INI FILE IN PRODUCTION:
    // $config = parse_ini_file('../../private/db-config.ini'); 
    $config = array(
        "servername" => '184.72.246.32:3306',
        "username" => 'sqldev',
        "password" => 'ICT1004BestGroup!',
        "dbname" => 'manyhires',
    );
    
    /*
     * Executes a query on the database, and returns the result.
     * 
     * $query can contain parameters to be bound, e.g.
     *      "INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)"
     * 
     * In that case, $params should be an array, e.g.
     *      array("James", "Bond", "jamesbond@gmail.com")
     * 
     * Otherwise, $params should be NULL.
     * 
     * Params:
     *      $query      - the SQL query to prepare.
     *      $params     - an array of parameters, or NULL.
     * 
     * Returns:
     *      (<return code>, <result>, <error message>)
     *      <return code>: 0, if successful
     *                     1, if connection error
     *                     2, if execution error
     *                     3, if parameters are invalid
     */
    function query_db($query, $params)
    {
        global $config;
        $errorMsg = "";
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

        // Check connection
        if ($conn->connect_error)
        {
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $conn->close(); 
            return array(1, null, $errorMsg);
        }

        // Prepare the statement:
        $stmt = $conn->prepare($query);
        
        if ($params != null)
        {
            // Construct the types string argument for bind_param()
            $types_str = "";
            foreach ($params as $item)
            {
                if (is_integer($item)) 
                {
                    $type = "i"; 
                }
                else if (is_double($item))
                { 
                    $type = "d"; 
                }
                else if (is_string($item)) 
                {
                    $type = "s"; 
                }
                else 
                {
                    $errorMsg = "Binding failed: Invalid parameter type.";
                    return array(3, null, $errorMsg);
                }
                $types_str .= $type;
            }
            // Unpack $params array and bind individual parameters
            $stmt->bind_param($types_str, ...$params);
        }

        // Execute the query statement: 
        if (!$stmt->execute())
        {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $stmt->close();
            return array(2, null, $errorMsg);
        }
        else
        {
            $result = $stmt->get_result();

            $stmt->close();
            $conn->close(); 

            return array(0, $result, null);
        }
    }
?>