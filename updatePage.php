<?php
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

// Fetch data from the database based on the provided ID
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM registration WHERE ID=?";
    $params = array($id);
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        echo "Error executing query: " . print_r(sqlsrv_errors(), true);
        die();
    }

    if (sqlsrv_has_rows($stmt)) {
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $ID = $row['ID'];
        $Name = $row['name'];
        $address = $row['address'];
        $email = $row['email'];
        $contact = $row['contact'];
        $gender = $row['gender'];
        $qualification = $row['qualification'];
        $ethnicity = $row['ethnicity'];
    } else {
        echo '<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">';
        echo "No record found with ID: $id";
        echo '<h1 style="color: #333; font-family: Arial, sans-serif;">No Record is Found</h1>';
        echo "<a href=\"index.html\">Go Home</a><br>";
        echo "<a href=\"index.html\">Add Customer</a>";
        echo '</div>';

        exit;
    }
} else {
    echo "ID parameter is missing";
    exit;
}

// Handle form submission for updating record


// Close the database connection
sqlsrv_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Update Record</h2>
        <form action="updateSql.php" method="post">

        <div class="form-group">
            <label for="ID">ID:</label>
            <input type="text" class="form-control" id="ID" name="ID" value="<?php echo $ID; ?>">
        </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $Name; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
            </div>

            <div class="form-group">
                <label for="contact">Contact:</label>
                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $contact; ?>" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label><br>
                <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $gender; ?>" required>
            </div>

            <div class="form-group">
                <label for="qualification">Qualification:</label>
                <select class="form-control" id="qualification" name="qualification" required>
                    <option value="<?php echo $qualification; ?>"><?php echo $qualification; ?></option>
                    <option value="High School">High School</option>
                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                    <option value="Master's Degree">Master's Degree</option>
                    <option value="PhD">PhD</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ethnicity">Ethnicity:</label>
                <select class="form-control" id="ethnicity" name="ethnicity" required>
                    <option value="<?php echo $ethnicity; ?>"><?php echo $ethnicity; ?></option>
                    <option value="Asian">Asian</option>
                    <option value="Black">Black</option>
                    <option value="Hispanic">Hispanic</option>
                    <option value="White">White</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <!-- Include other input fields for email, contact, gender, qualification, ethnicity -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
