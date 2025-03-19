<?php
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

if(isset($_POST['input'])) {
        $input = htmlspecialchars($_POST['input']);        
        $sql = "SELECT * FROM package WHERE pk_owner LIKE '{$input}%' OR date LIKE '{$input}%' OR contact LIKE '{$input}%' OR pk_size LIKE '{$input}%' OR delivery LIKE '{$input}%' ORDER BY date";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0) { ?>
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
          while ($data = mysqli_fetch_array($result)) { ?>
            <tr>
                <td><?= $data['date']; ?></td>
                <td><?= $data['pk_owner']; ?></td>
                <td><?= $data['contact']; ?></td>
                <td><?= $data['pk_size']; ?></td>
                <td><?= $data['delivery']; ?></td>
                <td><a href='1package_update.php?pk_id=<?php echo htmlspecialchars($data['pk_id']);?>'><ion-icon name='create'></ion-icon></a></td>
                <td><a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?pk_id='. htmlspecialchars($data['pk_id']);?>" onclick="return confirm(\'Delete the data?')"><ion-icon name='trash-outline'></ion-icon></a></td>
                <td>
                    <form action="pk_history.php" method="post" class="my-status-flex">
                        <input type="hidden" name="pk_id" value="<?= $data['pk_id'] ?>">
                        <select id="pk-status" name="status">
                            <option value="Pending" selected>Pending</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Missing">Missing</option>
                        </select><br>
                        <button type="submit" name="picked_up" class="btn-pk_status"><ion-icon name="file-tray-stacked-outline"></ion-icon><br>Archive</button>              
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
        </table>
<?php
        }else {
        echo "<h6 class = 'text-danger text-center mt-3'>No data Found!</h6>";}
    }
    ?>