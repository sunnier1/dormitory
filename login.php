<?php
session_start();
include("config.php");

function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$error = ''; // Initialize error variable

if(isset($_POST['submit'])) {
    $email = input($_POST['email']);
    $password = input($_POST['password']);
    $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
    if(mysqli_num_rows($result) == 1) {
        $_SESSION['email'] = $email;
        header("Location: dashboard.php");
        } else {   
        $error = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
body {
    background: linear-gradient(to right, #ff7e5f, #feb47b);
    font-family: 'Arial', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.login-form {
    display: flex;
    flex-direction: column;
}

.login-form h2 {
    margin-bottom: 20px;
    color: #333;
    text-align: center;
}

.input-group {
    position: relative;
    margin-bottom: 15px;
}

.input-group input {
    width: 90%;
    padding: 10px;
    border: 2px solid #ddd;
    border-radius: 5px;
    outline: none;
    transition: border-color 0.3s;
    margin-top:10px;
}

.input-group label {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    background: white;
    padding: 0 5px;
    color: #999;
    transition: top 0.3s, font-size 0.3s;
}

.input-group input:focus {
    border-color: #ff7e5f;
}

.input-group input:focus + label,
.input-group input:not(:placeholder-shown) + label {
    top: 10px;
    font-size: 12px;
    color: #ff7e5f;
}

button {
    background: #ff7e5f;
    border:#4461F2;
    width:  250px;
    border-radius: 10px;
    color:#FFFFFF;
    font-size: large;
    font-weight: bold;
    padding: 10px;
    font-family:Kanit;
    margin-top: 30px;
    margin: 0 25px;
    box-shadow: 3px 6px 7px rgba(0, 0, 0, 0.5);
    transition: background-color 0.3s;
}

button:hover {
    background: #feb47b;
}

    </style>
</head>
<body>
    <div class="container">
        <form action="login.php" method="post" class="login-form">
            <h2>Login</h2>
            <div class="input-group">
                <input type="text" id="email" name="email" required>
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <input type="password" id="password" name="password" required>
                <label for="password">Password</label>
            </div>
            <?php if ($error): ?>
                <div style="color: red; text-align: center; margin-bottom: 10px; font-size:12px;">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <button type="submit" name="submit">Login</button>
        </form>
    </div>
</body>
</html>
