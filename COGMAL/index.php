<?php

include 'config.php';

session_start();

error_reporting(0);

if (isset($_POST['Signup'])){
  $Fullname = mysqli_real_escape_string($conn, $_POST["Signup_Fullname"]);
   $Email = mysqli_real_escape_string($conn, $_POST["Signup_Email"]);
    $Password = mysqli_real_escape_string($conn, md5($_POST["Signup_Password"]));
     $ConfirmPassword = mysqli_real_escape_string($conn, md5($_POST["Signup_ConfirmPassword"]));

     $check_email = mysqli_num_rows(mysqli_query($conn, "SELECT Email FROM users WHERE Email='$Email'"));

     if ($Password !== $ConfirmPassword){
        echo"<script>alert('Password did not Match.');</script>";
     } elseif ($check_email > 0) {
       echo"<script>alert('Email already exists in out database.');</script>";
     } else{
      $sql = "INSERT INTO users(Fullname, Email, Password) VALUES ('$Fullname', '$Email', '$Password')";
      $result = mysqli_query($conn, $sql);
      if ($result){

        $_POST["Signup_Fullname"] = "";
        $_POST["Signup_Email"] = "";
        $_POST["Signup_Password"] = "";
        $_POST["Signup_ConfirmPassword"] = "";

          echo"<script>alert('User registration successfully.');</script>";
      } else {
            echo"<script>alert('User registration failed.');</script>";
      }
     }
}

if (isset($_POST['Signin'])){
   $Email = mysqli_real_escape_string($conn, $_POST["Email"]);
   $Password = mysqli_real_escape_string($conn, md5($_POST["Password"]));
   
     $check_email = mysqli_query($conn, "SELECT id FROM users WHERE Email='$Email' AND Password='$Password'");

      if (mysqli_num_rows($check_email) > 0) {
        $row = mysqli_fetch_assoc($check_email);
        $_SESSION["user_id"] = $row['id'];
        header("Location: index.html");
      } else{
        echo"<script>alert('Login details is incorrect. Please try again.');</script>";
      }
}

?>
<!-- html for login -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="logincss/style.css" />
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" method ="post" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Email Address" name="Email" value="<?php echo $_POST['Email'];?>" required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="Password" value="<?php echo $_POST['Password'];?>" required />
            </div>
            <input type="submit" value="Login" name="Signin" class="btn solid" />
            <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
            </div>
          </form>
          <form action="" class="sign-up-form" method="post">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Fullname" name="Signup_Fullname" value="<?php echo $_POST["Signup_Fullname"];?>" required />
            </div>


            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email Address" name="Signup_Email" value="<?php echo $_POST["Signup_Email"];?>" require />
            </div>


            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="Signup_Password" value="<?php echo $_POST["Signup_Password"];?>" required />
            </div>


            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Confirm Password" name="Signup_ConfirmPassword" value="<?php echo $_POST["Signup_ConfirmPassword"];?>" required />
            </div>


            <input type="submit" class="btn" name="Signup" value="Sign up" />
            <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New visitor here?</h3>
            <p>
              I am so glad that you chose to visit us our website today! this past. I believe that there has never been a better time to serve Jesus and receive the word of Christ.
              For more details and information you can hit and sign up! God bless.
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <!-- <img src="" class="image" alt="" /> -->
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Are you one of us ?</h3>
            <p>
              If you already sign up and have an account, you don't need to sign up. 
              sign in now and check the website for more details. God bless.
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <!-- <img src="" class="image" alt="" /> -->
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>
?>