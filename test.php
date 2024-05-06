<?php
// Database connection

$serverName = "AADEN-AARIC\MSSQLSERVER22"; // or the name of your SQL Server instance
$connectionOptions = array(
    "Database" => "test"// Add this option to trust the server's certificate without validation
);
// Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

if( $conn ) {
    echo "Connection established.<br />";
}else{
    echo "Connection could not be established.<br />";
    die( print_r( sqlsrv_errors(), true));
}


// Function to handle delete operation
// function deleteRecord($id) {
//     global $conn;
//     $sql = "DELETE FROM registration WHERE id=$id";
//     if ($conn->query($sql) === TRUE) {
//         header("Refresh:0");
//     } else {
//         echo "Error deleting record: " . $conn->error;
//     }
// }

$sql = "SELECT * FROM registration";
$result = sqlsrv_query($conn, $sql);

// Check if any rows are returned
if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_has_rows($result)) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>User Data</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Gender</th>
                    <th>Qualification</th>
                    <th>Ethnicity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Output data of each row
            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $row["ID"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["address"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["contact"]; ?></td>
                    <td><?php echo $row["gender"]; ?></td>
                    <td><?php echo $row["qualification"]; ?></td>
                    <td><?php echo $row["ethnicity"]; ?></td>
                    <td>
                        <a href="updatePage.php?id=<?php echo $row["ID"]; ?>" class="btn btn-primary">Update</a>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row["ID"]; ?>">
                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <div style="position: relative; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
    <a href=index.html>Go Home</a></br>
    <a href="Form.html">Add Customer</a>
    </div>
</body>
</html>
<?php
} else {
    echo '<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">';
    echo '<h1 style="color: #333; font-family: Arial, sans-serif;">No Record is Found</h1>';
    echo "<a href=\"index.html\">Go Home</a><br>?";
    echo "<a href=\"Form.html\">Add Customer</a>";
    echo '</div>';
}

// Handle delete operation
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    deleteRecord($id, $conn);
}

// Close the database connection
sqlsrv_close($conn);

// Function to delete a record
function deleteRecord($id, $conn) {
    $sql = "DELETE FROM registration WHERE ID = $id";
    $params = array($id);
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    // Redirect to the same page after deletion
    header("Location: ".$_SERVER['PHP_SELF']);
}
?>