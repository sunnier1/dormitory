<?php
include 'config.php';
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Create attendance table if it doesn't exist
$query = "CREATE TABLE IF NOT EXISTS attendance (
  attendance_id INT PRIMARY KEY AUTO_INCREMENT,
  staff_id INT NOT NULL,
  date DATE NOT NULL,
  attendance_status VARCHAR(10) NOT NULL,
  FOREIGN KEY (staff_id) REFERENCES staff(staff_id)
)";
mysqli_query($conn, $query);

// Form to record attendance
echo "<form action='' method='post'>";
echo "<label for='staff_id'>Staff ID:</label>";
echo "<input type='number' id='staff_id' name='staff_id'>";
echo "<br>";
echo "<label for='date'>Date:</label>";
echo "<input type='date' id='date' name='date'>";
echo "<br>";
echo "<label for='attendance_status'>Attendance Status:</label>";
echo "<select id='attendance_status' name='attendance_status'>";
echo "<option value='present'>Present</option>";
echo "<option value='absent'>Absent</option>";
echo "</select>";
echo "<br>";
echo "<input type='submit' value='Record Attendance'>";
echo "</form>";

// Record attendance
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $staff_id = $_POST["staff_id"];
  $date = $_POST["date"];
  $attendance_status = $_POST["attendance_status"];
  
  $query = "INSERT INTO attendance (staff_id, date, attendance_status)
            VALUES ('$staff_id', '$date', '$attendance_status')";
  mysqli_query($conn, $query);
  
  echo "Attendance recorded successfully!";
}

// Close connection
mysqli_close($conn);
?>