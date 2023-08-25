<?php
    require_once("database.php");

    if(isset($_POST['register'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $hashedPass = SHA1($password);
        $role = mysqli_real_escape_string($conn, $_POST['regrole']);
        //check if there is already email registered
        $query0 = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query0);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) > 0) {
            echo '<script>
                alert("Email already exists");
                window.location.href = "register.php";
            </script>';
            exit;
        }
    
        $query = "INSERT INTO users (`email`, `password`, `role`) VALUES (?, ?, ?);";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sss", $email, $hashedPass, $role);
        mysqli_stmt_execute($stmt);
        header('location: login.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <h1>Register Page</h1>
        <label for="email">Email: </label>
        <input type="email" name="email"> <br>
        <label for="password">Password: </label>
        <input type="password" name="password"> <br>
        <label for="role">Role:</label>
        <select name ="regrole">
            <option value="admin">Admin</option>
            <option value="guest">Guest</option>
        </select> <br>
        <input type="submit" name="register"> <br>
        Already have an account? <a href="login.php">Login</a>
    </form>
</body>
</html>