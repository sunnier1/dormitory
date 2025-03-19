<?php
include 'config.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $owner = $_POST['pk_owner'];
    $contact = $_POST['contact'];
    $size = $_POST['pk_size'];
    $delivery = $_POST['delivery'];

    if (!empty($date) && !empty($owner) && !empty($contact) && !empty($size) && !empty($delivery)) {
        $sql = "INSERT INTO package (date, pk_owner, contact, pk_size, delivery) VALUES ('$date', '$owner', '$contact', '$size', '$delivery')";

        if (mysqli_query($conn, $sql)) {
            header("location:package.php");
            $message = "Data successfully inserted!";
        } else {
            $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        $message = "All fields must be filled!";
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Package</title>
    <style>
    /* Keyframe animation for page transition */
    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }

    @keyframes slideOut {
        from {
            transform: translateX(0);
        }
        to {
            transform: translateX(100%);
        }
    }

    .page-slide {
        animation: fadeOut 0.5s ease-out forwards, slideOut 0.5s ease-out forwards;
    }
        .input-container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }
        .input-container h2 {
            text-align: center;
            color: #002379;
            margin-bottom: 20px;
        }
        .input-container label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }
        .input-container input[type="text"], .input-container input[type="date"], .input-container input[type="tel"], .input-container select {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }
        .input-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #ffaa55;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .input-container input[type="submit"]:hover {
            background-color: #ee2a5e;
        }
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .notification ion-icon {
            margin-right: 10px;
        }
        .back-btn{
            border: none;
            border-radius: 12px;
            height: 60px;
            width: 70px;
            cursor: pointer;
            color: #fafafa;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .back-btn:hover {
            box-shadow: 0px -4px 30px rgba(186, 73, 12, 0.2);
            transform: scale(1.1);
        }
        .back-btn ion-icon{
        color:black;
        font-size: 35px;        
        }
    </style>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div class="input-container">
        <button class="back-btn" onclick="navigateSlide('package.php')"><ion-icon name="arrow-back-circle-outline"></ion-icon></button>
        <h2>Input Package Data</h2>
        <form action="pk_input.php" method="POST">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="owner">Owner's Name:</label>
            <input type="text" id="owner" name="pk_owner" required>

            <label for="contact">Contact:</label>
            <input type="tel" id="contact" name="contact" required>

            <label for="size">Size Package:</label>
            <select id="size" name="pk_size">
                <option value="Small">Small</option>
                <option value="Mediun">Medium</option>
                <option value="Large">Large</option>
            </select>

            <label for="delivery">Delivery:</label>
            <select id="delivery" name="delivery" required>
                <option selected>Select</option>
                <option value="J&T">J&T</option>
                <option value="JNE">JNE</option>
                <option value="Cargo">Cargo</option>
                <option value="SiCepat">SiCepat</option>
                <option value="Shopee Express">Shopee Express</option>
                <option value="Pos Indonesia">Pos Indonesia</option>
            </select>

            <input type="submit" value="Submit">
        </form>
    </div>

    <?php if ($message != ''): ?>
        <div class="notification">
            <ion-icon name="checkmark-circle-outline"></ion-icon>
            <span><?php echo $message; ?></span>
        </div>
        <script>
            setTimeout(function() {
                document.querySelector('.notification').style.display = 'none';
            }, 4000);
        </script>
    <?php endif; ?>
    <script>
    function navigateSlide(url) {
                document.body.classList.add('page-slide');
                setTimeout(function() {
                    window.location.href = url;
                }, 500);
            }
    </script>
</body>
</html>
