<?php
include 'sidebar.php';
include 'config.php';

if (isset($_GET['pk_id'])) {
    $id = htmlspecialchars($_GET['pk_id']);
    $sql = "DELETE FROM package WHERE pk_id = '$id'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        header("location: package.php");
    } else {
        echo "Data failed to be deleted";
    }
}

// Fetch data for editing
$editData = null;
if (isset($_GET['edit_id'])) {
    $edit_id = htmlspecialchars($_GET['edit_id']);
    $sql = "SELECT * FROM package WHERE pk_id = '$edit_id'";
    $editResult = mysqli_query($conn, $sql);
    if ($editResult) {
        $editData = mysqli_fetch_assoc($editResult);
    }
}

// Update data
if (isset($_POST['submit'])) {
    $pk_id = htmlspecialchars($_POST['pk_id']);
    $date = htmlspecialchars($_POST['date']);
    $pk_owner = htmlspecialchars($_POST['pk_owner']);
    $contact = htmlspecialchars($_POST['contact']);
    $pk_size = htmlspecialchars($_POST['pk_size']);
    $delivery = htmlspecialchars($_POST['delivery']);

    $sql = "UPDATE package SET date='$date', pk_owner='$pk_owner', contact='$contact', pk_size='$pk_size', delivery='$delivery' WHERE pk_id='$pk_id'";
    if (mysqli_query($conn, $sql)) {
        header("location: package.php");
    } else {
        echo "Failed to update data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Read Package</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            padding-top: 100px; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width:60%;
            border-radius: 15px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-content input, select{
        width:100%;
        height:40px;
        margin:10px auto;
        border-radius:8px;
        border-style: solid;
        border-color:#FFBB8E
        }
        .modal-content button{
        background-color: #FFBB8E;
        color:#fff;
        font-weight: 600;
        font-size: 25px;
        border-radius:20px;
        border:none;
        width:50%;
        cursor:pointer;
        margin:10px auto;
        height: 40px;
        box-shadow: 0px 5px 4px rgb(0,0,0.5);
        transition: box-shadow 0.3s ease;
        }
        .modal-content button:hover{
        background-color: #FFBB8E;
        transition: all 0.3s ease-in-out;
        font-weight: 700;
        box-shadow: 0 0 2px rgb(0, 0.2, 0.2);
        }
        .modal button{
        justify-content: center;
        align-items: center;
        }
    </style>
</head>
<body>
<div>
    <div class="search-bar"> 
        <form action="package.php" method="post"> 
            <input type="text" id="search_text" autocomplete="off" name="search" class="form_sea" placeholder="Search...">
            <script>
                $(document).ready(function(){
                    $("#search_text").keyup(function(){
                        var input = $(this).val();
                        if (input != ""){
                            $.ajax({
                                url: 'pk_search.php',
                                method: 'post',
                                data:{input:input},
                                success:function(data){
                                    $("#table-data").html(data);
                                }
                            });
                        }
                    });
                });
            </script>
            <a href="#" class="search-button" id="search"> <ion-icon name="search"></ion-icon></a> 
        </form>
    </div> 
    <div class="button-pk-web">
        <button class="myhistory-btn" onclick="navigateWithTransition('pk_history.php')"alt="History Record"> <ion-icon name="archive-outline"></ion-icon></button>
        <button class="myhistory-btn" onclick="navigateWithTransition('pk_input.php')"> <ion-icon name="add-outline"></ion-icon></button>
    </div>
    <div class="pk-table-container">
        <table id="table-data" class="pk-table">
            <thead>
                <tr class="rad">
                    <th>Arriving Date</th>
                    <th>Owner's Name</th>
                    <th>Contact</th>
                    <th>Size Package</th>
                    <th>Delivery</th>
                    <th colspan='2' style='text-align: center;'>Action</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $mysql = "SELECT * FROM package ORDER BY date";
                $result = mysqli_query($conn, $mysql);

                if (mysqli_num_rows($result) > 0) {
                    while ($data = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?= $data['date']; ?></td>
                    <td><?= $data['pk_owner']; ?></td>
                    <td><?= $data['contact']; ?></td>
                    <td><?= $data['pk_size']; ?></td>
                    <td><?= $data['delivery']; ?></td>
                    <td><a href="#" onclick="openEditModal(<?= htmlspecialchars($data['pk_id']); ?>)"><ion-icon name='create'></ion-icon></a></td>
                    <td><a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?pk_id=' . htmlspecialchars($data['pk_id']);?>" onclick="return confirm('Delete the data?')"><ion-icon name='trash-outline'></ion-icon></a></td>
                    <td>
                        <form action="pk_history.php" method="post" class="my-status-flex">
                            <input type="hidden" name="pk_id" value="<?= $data['pk_id'] ?>">
                            <select id="pk-status" name="status">
                                <option value="Pending" selected>Pending</option>
                                <option value="Delivered">Delivered</option>
                                <option value="Missing">Missing</option>
                            </select><br>
                            <button type="submit" name="archive" class="btn-pk_status"><ion-icon name="file-tray-stacked-outline"></ion-icon><br>Archive</button>              
                        </form>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='7'>No Data Found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- The Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1 style="text-align: center;">Update Package Information</h1>
            <form action="package.php" method="post">
                <input type="hidden" name="pk_id" id="edit_pk_id">
                <label for="date">Arriving Date:</label>
                <input type="date" name="date" id="edit_date" required>
                <label for="pk_owner">Owner's Name:</label>
                <input type="text" name="pk_owner" id="edit_pk_owner" required>
                <label for="contact">Contact:</label>
                <input type="text" name="contact" id="edit_contact" required>
                <label for="pk_size">Size Package:</label>
                    <select id="size" name="pk_size" id="edit_pk_size">
                        <option value="Small">Small</option>
                        <option value="Mediun">Medium</option>
                        <option value="Large">Large</option>
                    </select>
                <label for="delivery">Delivery:</label>
                    <select id="edit_delivery" name="delivery" required>
                        <option value="J&T">J&T</option>
                        <option value="JNE">JNE</option>
                        <option value="Cargo">Cargo</option>
                        <option value="SiCepat">SiCepat</option>
                        <option value="Shopee Express">Shopee Express</option>
                        <option value="Pos Indonesia">Pos Indonesia</option>
                    </select>
                <div style="justify-content:center; align-items:center; display:flex;">
                <button type="submit" name="submit">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function navigateWithTransition(url) {
        document.body.classList.add('page-transition');
        setTimeout(function() {
            window.location.href = url;
        }, 500);
    }

    function openEditModal(id) {
        // Fetch data using AJAX
        $.ajax({
            url: 'fetch_package.php', // Create this file to fetch data based on pk_id
            method: 'GET',
            data: {pk_id: id},
            success: function(data) {
                var package = JSON.parse(data);
                $("#edit_pk_id").val(package.pk_id);
                $("#edit_date").val(package.date);
                $("#edit_pk_owner").val(package.pk_owner);
                $("#edit_contact").val(package.contact);
                $("#edit_pk_size").val(package.pk_size);
                $("#edit_delivery").val(package.delivery);
                $("#editModal").show();
            }
        });
    }

    $(document).ready(function(){
        $(".close").click(function(){
            $("#editModal").hide();
        });
    });
    </script>
</body>
</html>
