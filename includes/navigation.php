<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    function confirmLogout(form) {
        swal({
            title: "Logout?",
            text: "Any incomplete form will not be saved.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            } else {
                // swal("Session is still live.");
            }
        });
    }
</script>

<header class="d-flex justify-content-between align-items-center p-3 bg-light">
    <div class="logo">
        <img src="../images/RightPriceLogo.jpeg" alt="Logo">
    </div>
    <nav>
        <ul class="nav">
            <li class="nav-item text-center">
                <a class="nav-link d-flex flex-column align-items-center <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>" href="dashboard.php">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link d-flex flex-column align-items-center <?php echo ($current_page == 'wishlist.php') ? 'active' : ''; ?>" href="wishlist.php">
                    <i class="bi bi-bag-check"></i>
                    <span>Wishlist</span>
                </a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link d-flex flex-column align-items-center <?php echo ($current_page == 'market.php') ? 'active' : ''; ?>" href="../php/marketproducts.php">
                    <i class="bi bi-shop"></i>
                    <span>Market</span>
                </a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link d-flex flex-column align-items-center <?php echo ($current_page == 'blogs.php') ? 'active' : ''; ?>" href="blogs.php">
                    <i class="bi bi-book"></i>
                    <span>Blogs</span>
                </a>
            </li>
            <li class="nav-item text-center">
                <form action='../php/logout.php' method='post' class='mb-2'>
                    <a class="nav-link d-flex flex-column align-items-center" href="#" onclick="confirmLogout(this.closest('form'))">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </nav>
</header>

<!-- Include necessary JS files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
