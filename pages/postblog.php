<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Right Price - Post a Blog</title>
    <link rel="icon" type="image/x-icon" href="../images/RightPriceLogo.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php include '../includes/checkSession.php'; ?>
    <?php include '../includes/navigation.php'; ?>
   
<?php
if (isset($_GET['imageType'])) {
    echo '<script>window.addEventListener("load", function() { swal("Image type not allowed", "Please select JPEG, PNG, JPG, or GIF image types." , "error"); })</script>';
} elseif (isset($_GET['imageSize'])) {
    echo '<script>window.addEventListener("load", function() { swal("Image Size exceeded", "Image must be upto 5MB", "error"); })</script>';
} elseif (isset($_GET['imagePath'])) {
    echo '<script>window.addEventListener("load", function() { swal("Image not selected", "You must select and image", "error"); })</script>';
}
?>


    <!-- post button name - post-button -->
    <main class="container mt-5">
        <h2 class="text-center">Post a Blog</h2>
        <form action="../php/postblogendpoint.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input name="title" type="text" class="form-control rounded-pill" placeholder="Title" 
                    <?php if (isset($_SESSION['blog_title'])) {
                        echo 'value="' . htmlspecialchars($_SESSION['blog_title']) . '"';
                    } ?> >

            </div>
            <div class="form-group">
                <input name="image" type="file" class="form-control rounded-pill" placeholder="Cover Picture" accept=".jpg, .jpeg, .png, .gif">
            </div>
            <div class="form-group text-center">
                Your Blog Content.
            </div>
            <div class="form-group">
                <textarea name="blog_content" class="form-control" rows="10">
                <?php echo isset($_SESSION['blog_content']) ? htmlspecialchars($_SESSION['blog_content']) : ''; ?>
                </textarea>
            </div>
            <div class=" form-group">
                <button name="post-button" type="submit" class="btn btn-primary rounded-pill px-4">
                    <i class="fa-regular fa-square-check"></i> Post
                </button>
                <button name="clear-button" type="submit" class="btn btn-primary bg-danger rounded-pill px-4"> 
                    <i class="fa-solid fa-eraser"></i> Clear
                </button>
            </div>
        </form>
    </main>
    <?php include '../includes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
