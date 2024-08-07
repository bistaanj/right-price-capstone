<?php
require_once "connection.php";

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['blog_content']);
        $user = $_SESSION['user_id'];
        $current_date = date("Y/m/d");

        // imagen directory
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // verify the image is real
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // verify if the file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // size of the file
        if ($_FILES["image"]["size"] > 5000000) { // 5MB max
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // allow formats files
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // verify if upload ok
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // upload the file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $picture = htmlspecialchars($target_file); // sanitize the file path
                $query = "INSERT INTO tbl_blog (blog_author, blog_published_date, blog_title, blog_picture, blog_contents) VALUES (?, ?, ?, ?, ?)";
                $bind_statement = $connect->prepare($query);
                $bind_statement->bind_param("issss", $user, $current_date, $title, $picture, $content);
                $result = $bind_statement->execute();
                if ($result) {
                    header("Location: ../pages/dashboard.php");
                    exit();
                } else {
                    echo "Error: " . $connect->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
} catch (Exception $e) {
    echo "Exception: " . htmlspecialchars($e->getMessage());
}
?>
