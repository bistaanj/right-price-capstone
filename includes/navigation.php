<header class="d-flex justify-content-between align-items-center p-3 bg-light">
    <div class="logo">
        <img src="../images/RightPriceLogo.jpeg" alt="Logo">
    </div>
    <nav>
        <ul class="nav">
            <li class="nav-item text-center">
                <a class="nav-link d-flex flex-column align-items-center" href="../php/dashboardsetup.php">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link d-flex flex-column align-items-center" href="wishlist.php">
                    <i class="bi bi-bag-check"></i>
                    <span>Wishlist</span>
                </a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link d-flex flex-column align-items-center" href="../php/marketProducts.php">
                    <i class="bi bi-shop"></i>
                    <span>Market</span>
                </a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link d-flex flex-column align-items-center" href="blogs.php">
                    <i class="bi bi-pencil-square"></i>
                    <span>Blogs</span>
                </a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link d-flex flex-column align-items-center" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>
</header>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Logout <i class="bi bi-lock"></i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <i class="bi bi-question-circle"></i> Are you sure you want to logout?
            </div>
            <div class="modal-footer">
                <form action="../php/logout.php" method="post">
                    <button class="btn btn-danger btn-block" type="submit" name="submit"> Yes, logout</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include necessary JS files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
