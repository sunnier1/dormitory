<?php include 'sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Staff</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="management-section">
    <h2>Staff List</h2>
    <table class="management-table">
        <tr>
            <th>Staff ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
        <?php
        include 'config.php';

        // Query to select staff data
        $sql = "SELECT staff_id, name, email, role FROM staff";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["staff_id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["email"]. "</td><td>" . $row["role"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No staff found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</div>

</body>
</html>
