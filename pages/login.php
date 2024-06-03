<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
        <?php
        echo file_get_contents('../css/style.css');
        ?>
    </style>
</head>
<body>

  <div class="container text-center">
    <img src="../images/RightPriceLogo.jpeg" alt="Page Icon">
    <div class="divider"></div>
  </div>

  <div class="container login-container">
    <div class="text-center mb-4">
      <a href="signup.php" class="nav-link d-inline">Sign Up</a>
      <a href="#" class="nav-link d-inline active">Log In</a>
    </div>
    <div class="tab-divider">
      <div class="active-divider"></div>
    </div>
    <h4 class="text-center mb-4">Log In</h4>
    <form action="../php/login_function.php" method="post">
      <div class="form-group">
        <label for="email" class="sr-only">Email address</label>
        <input name="email" type="email" id="email" class="form-control" placeholder="Email address*" required>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">Password</label>
        <input name="password" type="password" id="password" class="form-control" placeholder="Password*" required>
      </div>
      <div class="form-group">
        <?php
        if (isset($_GET['login_error'])):
          echo ($_GET['login_error']);
        endif;
        ?>

      </div>
      <div class="text-right">
        <a href="#" class="small">Forgot password?</a>
      </div>
      <button type="submit" class="btn btn-dark btn-block mt-3">Log In</button>
    </form>
    <p class="small text-center mt-3">By logging in, you agree to the terms of service and privacy policy.</p>
    
    <div class="or-divider">OR</div>
    
    <div class="social-btn-container mt-3">
      <button class="btn btn-light btn-google mr-2">
        <img src="../images/google.png" alt="Google Icon"> Google
      </button>
      <button class="btn btn-light btn-facebook ml-2">
        <img src="../images/fb.png" alt="Facebook Icon"> Facebook
      </button>
    </div>
    <p class="text-center mt-3">Need an account? <a href="signup.php">Sign Up</a></p>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
