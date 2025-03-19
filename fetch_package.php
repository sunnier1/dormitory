<?php
include 'config.php';

if (isset($_GET['pk_id'])) {
    $pk_id = htmlspecialchars($_GET['pk_id']);
    $sql = "SELECT * FROM package WHERE pk_id = '$pk_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode($data);
    } else {
        echo json_encode(['error' => 'Data not found']);
    }
}
?>
