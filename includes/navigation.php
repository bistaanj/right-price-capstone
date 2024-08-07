    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
        function confirmDelete(form) {
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

            <form action='../php/logout.php' method='post' class='mb-2'>
                <button type='button' class='btn btn-primary d-flex align-items-center justify-content-center' onclick='confirmDelete(this.form)'>
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
                
            </li>
        </ul>
    </nav>
</header>


<!-- Include necessary JS files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
