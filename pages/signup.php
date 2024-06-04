<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Page</title>
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
    <img src="../images/RightPriceLogo.jpeg" alt="Page Icon" class="mt-3">
  </div>

  <div class="container login-container">
    <div class="text-center mb-4">
      <a href="signup.php" class="nav-link d-inline active">Sign Up</a>
      <a href="logIn.php" class="nav-link d-inline">Log In</a>
    </div>
    <div class="tab-divider">
      <div class="active-divider"></div>
    </div>
    <h4 class="text-center mb-4">Sign Up</h4>
    <form action="../php/register.php" method="post"> 
      <div class="form-group">
        <label for="first-name" class="sr-only">First Name</label>
        <input name="fname" type="text" id="first-name" class="form-control" placeholder="First Name*" required
        value="<?php echo isset($_GET['fname']) ? htmlspecialchars($_GET['fname']) : ''; ?>">
      </div>
      <div class="form-group">
        <label for="last-name" class="sr-only">Last Name</label>
        <input name="lname" type="text" id="last-name" class="form-control" placeholder="Last Name*" required
        value="<?php echo isset($_GET['lname']) ? htmlspecialchars($_GET['lname']) : ''; ?>">
      </div>
      <div class="form-group">
        <label for="email" class="sr-only">Email address</label>
        <input name="email" type="email" id="email" class="form-control" placeholder="Email address*" required
        value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">Password</label>
        <input name="password" type="password" id="password" class="form-control" placeholder="Password*" required>
      </div>
      <div class="form-group">
        <?php
        if (isset($_GET['register_error'])):
          echo ($_GET['register_error']);
        endif;
        ?>
      </div>
      <div class="text-center small-text mb-3">
        At least 8 characters, 1 uppercase letter, 1 number & 1 symbol.
      </div>
      <button type="submit" class="btn btn-dark btn-block mt-3">Sign Up</button>
    </form>
    <p class="small text-center mt-3">By signing up, you agree you've read and accepted our
      Terms and Conditions. Please see our Privacy Policy for 
      information on how we process your data.</p>
    
    <div class="or-divider">OR</div>
    
    <div class="social-btn-container mt-3">
      <button class="btn btn-light btn-google mr-2">
        <img src="../images/google.png" alt="Google Icon"> Google
      </button>
      <button class="btn btn-light btn-facebook ml-2">
        <img src="../images/fb.png" alt="Facebook Icon"> Facebook
      </button>
    </div>
    <p class="text-center mt-3">Already have an account? <a href="login.php">Log In</a></p>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
