<?php
    require_once("database.php");
    require_once("checkSession.php");

    if (isset($_POST['submit'])) {
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $filename = $_FILES['file']['name'];
            $filesize = $_FILES['file']['size'];
            $fileext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $upload_max_filesize = 10*1024*1024;
            $allowed_ext = array('jpeg','png');
            $destination = "uploads/".$filename;
            $email = $_POST['email'];

            if(in_array($fileext,$allowed_ext)){
                if($filesize <= $upload_max_filesize){

                    $q1 = "INSERT INTO dumps (email, filename) VALUES (?, ?)";
                    $stmt = $conn->prepare($q1);
                    $stmt->bind_param("ss", $email, $destination);

                    if(move_uploaded_file($_FILES['file']['tmp_name'],$destination)){
                        if ($stmt->execute()) {
                            echo "Upload Success";
                        }
                        else{
                            echo "Upload Failed";
                        }
                    }  
                }
                else{
                    echo "File Size cannot more than 10MB";
                }
            }
            else{
                echo "Only jpeg and png are allowed";
            }
        }
        else{
            echo "Email is not valid";
        }
    }
    ?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload a File</title>
</head>
<body>
    <h2>Upload File</h2>
    <form id="upload" method="POST" enctype="multipart/form-data">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="file">Select file:</label>
        <input id="file" type="file" name="file"><br>
        <input type="submit" name="submit" value="Submit">
    </form> <br>
    <br>
    <?php
        if($_SESSION['role'] === 'admin'){
    ?>
            <a href="gallery.php">Go To Users Uploaded File</a>
    <?php
        }
    ?> <br>
    <a href="logout.php">Logout</a>
</body>
</html>


