<?php include '../includes/checkSession.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Right Price Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../images/RightPriceLogo.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <?php include "../includes/navigation.php" ?>    
    <main class="container mt-4 flex-grow-1">
        <div class="search-bar d-flex justify-content-center mb-4">
            <?php
                // get search
                $search = isset($_GET['search']) ? $_GET['search'] : '';
            ?>
            <input type="text" id="searchInput" class="form-control rounded-pill" placeholder="Search" style="max-width: 600px;" value="<?php echo htmlspecialchars($search); ?>">
            <img src="../images/Search.png" alt="Search Icon" class="search-icon1 ml-2" onclick="searchFunction()">
        </div>
        <div class="row">
            <?php
                require_once '../php/connection.php';

                //sql
                $sql = "SELECT b.blog_author, b.blog_published_date, b.blog_title, b.blog_contents, b.blog_id,
                               u.fname, u.lname 
                        FROM tbl_blog b
                        JOIN tbl_user u ON b.blog_author = u.user_id
                        WHERE b.blog_contents LIKE '%$search%'";
                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                    //  HTML
                    while($row = $result->fetch_assoc()) {
                        $blog_contents_preview = substr($row["blog_contents"], 0, 160) . '...';
                        echo '<div class="col-md-3 mb-5">';
                        echo '<div class="blog-card p-4 rounded">';
                        echo '<p>' . $blog_contents_preview . '</p>';
                        echo '<a href="blogRead.php?id=' . $row["blog_id"] . '">...Read More</a>';
                        echo '<hr>';
                        echo '<p class="author-date">';
                        echo '<span>' . $row["fname"] . ' ' . $row["lname"] . '</span><br>';
                        echo '<span>' . $row["blog_published_date"] . '</span>';
                        echo '</p>';
                        echo '</div>';
                        echo '<h5 class="text-center mt-2">' . $row["blog_title"] . '</h5>';
                        echo '</div>';
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No results found</td></tr>";
                }
                $connect->close();
            ?>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function searchFunction() {
            var searchInput = document.getElementById('searchInput').value;
            window.location.href = 'blogs.php?search=' + searchInput;
        }
    </script>
</body>

</html>
