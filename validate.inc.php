<?php
    const namefields_filter = '/^[a-zA-Z\s]+$/';
    const passwords_filter = '/^.{8,}$/';
    const email_filter = '/^[a-z0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
    const headline_filter = '/^[a-zA-Z0-9\s\.\-,!?]*$/';
    const location_filter = '/^[a-zA-Z0-9\s\.\-,!?]*$/';
    const description_filter = '/^[a-zA-Z0-9\s\.\-,!?]*$/';
    const skill_name_filter = '/^[a-zA-Z\s\.\-,!?]*$/';
    const numbers_only_filter = '/^[0-9]*$/';
    const query_filter = '/^[a-zA-Z0-9\s\.\-,!?]*$/';
    
    /*
     * Validates the input and returns the sanitized input. When sanitization
     * is not required, e.g. in the case of passwords, $sanitize should be false.
     * 
     * Params:
     *      $name           - the name (key) of the POST data
     *      $verbose_name   - the verbose name of the POST data
     *      $filter         - the filter, e.g. FILTER_VALIDATE_REGEXP
     *      $options        - the options, as an associative array, e.g. array("regexp" => email_filter)
     *      $error_info     - the error information to show the user
     *      $required       - true if required field, false otherwise
     *      $sanitize       - true if sanitization is required, false otherwise
     * 
     * Returns:
     *      the (sanitized) input.
     */
    function validate_input(
            $name, $verbose_name, 
            $filter, $options, 
            $error_info, 
            $required, $sanitize
    )
    {
        global $errorMsg, $success;
        $upper_verbose_name = ucfirst($verbose_name);

        if (empty($_POST[$name]))
        {
            if ($required)
            {
                $errorMsg .= $upper_verbose_name . " is required. <br>";
                $success = false;
            }
        }
        else 
        {   
            if ($sanitize)
            {
                $input = sanitize_input($_POST[$name]);
            }
            else
            {
                $input = $_POST[$name];
            }

            if (!filter_var($input, $filter, array("options" => $options)))
            {
                $errorMsg .= "Invalid " . $verbose_name . " format. " . $error_info . "<br>";
                $success = false; 
            }
            return $input;
        }
    }

    //Helper function that checks input for malicious or unwanted content. 
    function sanitize_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data); 
        $data = htmlspecialchars($data); 
        return $data;
    } 
?>