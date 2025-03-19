<?php include "config.php";
include 'sidebar.php';
    if (isset($_POST['archive'])) {
    $pk_id = $_POST['pk_id'];
    $status = $_POST['status'];

    $sql_package = "SELECT * FROM package WHERE pk_id = '$pk_id'";
    $result_package = mysqli_query($conn, $sql_package);
    $package_data = mysqli_fetch_array($result_package);

    $date = $package_data['date'];
    $pk_owner = $package_data['pk_owner'];
    $contact = $package_data['contact'];
    $pk_size = $package_data['pk_size'];
    $delivery = $package_data['delivery'];

    $sql_insert_history = "INSERT INTO history (date, pk_owner, contact, pk_size, delivery, status)
                           VALUES ('$date', '$pk_owner', '$contact', '$pk_size', '$delivery', '$status')";
    mysqli_query($conn, $sql_insert_history);

    $sql_delete_package = "DELETE FROM package WHERE pk_id = '$pk_id'";
    mysqli_query($conn, $sql_delete_package);
    header("Location: pk_history.php ");
    exit();
    }   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package History</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<div class="container-fluid" id="searchresult">
    <div class = "row justify-content-center">
        <div class = "col-md-10 bg-light mt-2 rounded">
            <h1 class="text-center">Package History</h1>
            <hr>
            <div class = "form-inline">      
                <label for = "search" class = "font-weight-bold lead text-dark"> Search Record</label> &nbsp;&nbsp;&nbsp;&nbsp;
                <input type = "text" id= "search_text" class = "form-control form-control-lg rounded-0 border-primary" autocomplete="off" placeholder = "Search..." style="border:none; border-radius:20px;background-color:white; width:70%; margin:50px auto">
            </div>
            <table class = "table table-hover table-light table-tripped" id = "table-data">
                <thead>
                    <tr class="rad">
                        <th>No</th>
                        <th>Time Archived</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Size Package</th>
                        <th>Delivery</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $mysql = "SELECT * FROM history ORDER BY time";
                    $result = mysqli_query($conn, $mysql);
                    $i=1;
                    while($data = $result->fetch_assoc()){
                ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $data['time']; ?></td>
                        <td><?= $data['date']; ?></td>
                        <td><?= $data['pk_owner']; ?></td>
                        <td><?= $data['contact']; ?></td>
                        <td><?= $data['pk_size']; ?></td>
                        <td><?= $data['delivery']; ?></td>
                        <td><?= $data['status']; ?></td>
                    </tr>
                     <?php $i++; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type = "text/javascript">
  $(document).ready(function(){
    $("#search_text").keyup(function(){
      var input = $(this).val();

      if (input != ""){
      $.ajax({
        url: 'pk_search_history.php',
        method: 'post',
        data:{input:input},
        
        success:function(data){
            $("#table-data").html(data);
          }
    });
    }else{
    $("#table-data").css();
    }
  });
});
</script>
</body>
</html>