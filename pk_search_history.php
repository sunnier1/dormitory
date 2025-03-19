<?php
include "config.php";

if (isset($_POST['input'])) {
    $search = $_POST['input'];

    // Query untuk mencari data berdasarkan input pencarian
    $sql = "SELECT * FROM history 
            WHERE date LIKE '%$search%' 
            OR pk_owner LIKE '%$search%' 
            OR contact LIKE '%$search%' 
            OR pk_size LIKE '%$search%' 
            OR delivery LIKE '%$search%' 
            OR status LIKE '%$search%' 
            ORDER BY date DESC";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $i = 1;
        while ($data = mysqli_fetch_array($result)) {
            // Tampilkan data sesuai format tabel
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $data['time'] . "</td>";
            echo "<td>" . $data['date'] . "</td>";
            echo "<td>" . $data['pk_owner'] . "</td>";
            echo "<td>" . $data['contact'] . "</td>";
            echo "<td>" . $data['pk_size'] . "</td>";
            echo "<td>" . $data['delivery'] . "</td>";
            echo "<td>" . $data['status'] . "</td>";
            echo "</tr>";
            $i++;
        }
    } else {
        echo "<tr><td colspan='8'>No Data Found</td></tr>";
    }
}
?>
