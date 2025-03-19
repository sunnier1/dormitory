<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Example</title>
    <link rel="stylesheet" href="css/sidebar.css">
</head>
<body>
    

<div class="wrapper">
      <input type="checkbox" id="btn" hidden><label for="btn" class="menu-btn"><ion-icon name="menu"></ion-icon></label>
      <nav id="sidebar">
        <div class="title">Menu</div>
        <ul class="list-items">
          <li><a href="dashboard.php">Home</a></li>
          <li><a href="package.php">Package</a></li>
          <li><a href="#">Employee (Security & Staff)</a></li>
          <li><a href="#">Patrol Schedule</a></li>
          <li><a href="#">Service Schedule</a></li>
          <div class="icons" id="iconky">
            <a href="#"><ion-icon name="logo-twitter"></ion-icon></a>
            <a href="#"><ion-icon name="mail-outline"></ion-icon></a>
            <a href="#"><ion-icon name="logo-linkedin"></ion-icon></a>
          </div>
        </ul>
      </nav>
</div>
<div class="logo">L.S.</div>
    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>


</script>