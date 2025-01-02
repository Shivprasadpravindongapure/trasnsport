<?php
// Step 1: Database connection
$servername = "localhost"; // Usually "localhost"
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "elderly_transport"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Handle status update if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id']) && isset($_POST['action'])) {
    $user_id = $_POST['user_id'];
    $action = $_POST['action']; // This will be either 'allow' or 'deny'

    // Update user status in the database
    $stmt = $conn->prepare("UPDATE users SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $action, $user_id);

    if ($stmt->execute()) {
        echo "User status updated successfully.";
    } else {
        echo "Error updating user status: " . $stmt->error;
    }

    $stmt->close();
}

// Step 3: Fetch all users from the database
$sql = "SELECT id, username, email, status FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Admin Dashboard - Manage Users</h2>
        
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any users in the database
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . ucfirst($row["status"]) . "</td>";
                        echo "<td>";
                        
                        // Show "Allow" button if the user is pending or denied
                        if ($row["status"] != 'allowed') {
                            echo '<form action="admin_dashboard.php" method="POST" style="display:inline-block;">
                                    <input type="hidden" name="user_id" value="' . $row["id"] . '">
                                    <input type="hidden" name="action" value="allowed">
                                    <button type="submit" class="btn btn-success">Allow</button>
                                  </form>';
                        }

                        // Show "Deny" button if the user is pending or allowed
                        if ($row["status"] != 'denied') {
                            echo '<form action="admin_dashboard.php" method="POST" style="display:inline-block; margin-left: 5px;">
                                    <input type="hidden" name="user_id" value="' . $row["id"] . '">
                                    <input type="hidden" name="action" value="denied">
                                    <button type="submit" class="btn btn-danger">Deny</button>
                                  </form>';
                        }
                        
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Step 4: Close the database connection
$conn->close();
?>
