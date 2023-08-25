<?php
    require_once("database.php");
    if($_SESSION['role']!="admin"){
        header('Location: login.php');
    }
    
    $query = "SELECT * FROM dumps";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
</head>
<body>
    <a href="home.php">Back To Home</a>
    <br>
    <a href="Logout.php">Logout</a>
    <br>
    <h1>Uploaded Image:</h1>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <p>Email:<?php echo $row['email']; ?> <br> </p>
        <img src="<?php echo $row['filename']; ?>" alt="" srcset="">
    <?php endwhile; ?>
</body>
</html>