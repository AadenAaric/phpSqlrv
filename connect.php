<?php
    // Retrieve data from the submitted form
    $Name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $qualification = $_POST['qualification'];
    $ethnicity = $_POST['ethnicity'];

    // Database connection options
    $serverName = "AADEN-AARIC\MSSQLSERVER22"; // or the name of your SQL Server instance
    $connectionOptions = array(
    "Database" => "test"// Add this option to trust the server's certificate without validation
);
// Establishes the connection
     $conn = sqlsrv_connect($serverName, $connectionOptions);


    // Check if the connection is successful
    if ($conn === false) {
        echo "Connection failed: " . print_r(sqlsrv_errors(), true);
        die();
    } else {
        // Prepare a SQL statement to insert data into the 'registration' table
        $sql = "INSERT INTO registration (name, address, email, contact, gender, qualification, ethnicity) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = array($Name, $address, $email, $contact, $gender, $qualification, $ethnicity);
        $stmt = sqlsrv_prepare($conn, $sql, $params);

        // Execute the prepared statement
        $execval = sqlsrv_execute($stmt);

        // Check if execution was successful
        if ($execval === false) {
            echo "Error executing query: " . print_r(sqlsrv_errors(), true);
            die();
        }

        // Output a success message
        echo '<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">';
        echo '<h1 style="color: #333; font-family: Arial, sans-serif;">Customer Added Successfully!</h1>';

        // Output a link to go back to the home page
        echo "<a href=\"index.html\">Go Home</a><br>";
        echo "<a href=\"test.php\">Go to Customers</a>";
        echo '</div>';

        // Close the prepared statement
        sqlsrv_free_stmt($stmt);

        // Close the database connection
        sqlsrv_close($conn);
    }
?>