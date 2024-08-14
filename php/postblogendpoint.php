<?php
require_once "connection.php";

session_start();
try {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['clear-button'])) {
            if (isset($_SESSION['blog_title'])) {
                unset($_SESSION['blog_title']);
                unset($_SESSION['blog_content']);
            }
            header("Location: ../pages/postblog.php");
        }
        
        }
        if (isset($_POST['post-button'])) {

            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['blog_content']);
            $user = $_SESSION['user_id'];
            $current_date = date("Y/m/d");
            if (!isset($_SESSION['blog_title'])) {
                $_SESSION['blog_title'] = $title;
                $_SESSION['blog_content'] = $content;
            }



            // imagen directory
            $target_dir = "../images/";

            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $uploadOk = 1;

            if ($_FILES['image']["name"] == "") {
                $uploadOk = 0;
                header('location:../pages/postblog.php?imagePath=1');
                exit;
            }

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
                $uploadOk = 0;
                header('location:../pages/postblog.php?imageSize=1');
                exit;
            }

            // allow formats files
            

            // verify if upload ok
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // upload the file
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $picture = htmlspecialchars($target_file); // sanitizes the file path
                    $query = "INSERT INTO tbl_blog (blog_author, blog_published_date, blog_title, blog_picture, blog_contents) VALUES (?, ?, ?, ?, ?)";
                    $bind_statement = $connect->prepare($query);
                    $bind_statement->bind_param("issss", $user, $current_date, $title, $picture, $content);
                    $result = $bind_statement->execute();
                    if ($result) {
                        unset($_SESSION['blog_title']);
                        unset($_SESSION['blog_content']);
                        header("Location: ../pages/blogs.php");
                        exit();
                    } else {
                        header('Location:../pages/error.php');

                    }
                } else {
                    header('Location:../pages/error.php');
                }
            }
        }
    }
 catch (Exception $e) {
    header('Location:../pages/error.php');
}
?>
