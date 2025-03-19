<?php 
$conn = mysqli_connect("localhost", "root", "", "dorm_project");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>