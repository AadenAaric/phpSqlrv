<?php
// Check if the ID is received via POST
if(isset($_POST['ID'])) {
    // Retrieve data from the form
    $id = $_POST['ID'];
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
    }

    // Update record in the database using prepared statement
    $sql = "UPDATE registration SET name=?, address=?, email=?, contact=?, gender=?, qualification=?, ethnicity=? WHERE ID=?";
    $params = array($Name, $address, $email, $contact, $gender, $qualification, $ethnicity, $id);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        echo "Error updating record: " . print_r(sqlsrv_errors(), true);
    } else {
        echo "Record updated successfully";
        // Redirect to the main page after successful update
        header("Location: test.php");
        exit;
    }

    // Close the database connection
    sqlsrv_close($conn);
} else {
    echo "ID parameter is missing";
}
?>
