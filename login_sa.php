<?php

ob_start();
session_start();

require_once 'actions/db_connect.php';

// it will never let you open index(login) page if session is set
if ( isset($_SESSION['user'])!="") {
  header("Location: login/home_user.php");
  exit;
}

$error = false;

if( isset($_POST['btn-login']) ) {

 $email = trim($_POST['email']);
 $email = strip_tags($email);
 $email = htmlspecialchars($email);

 $pass = trim($_POST['pass']);
 $pass = strip_tags($pass);
 $pass = htmlspecialchars($pass);


  if(empty($email)){
    $error = true;
    $emailError = "Please enter your email address.";
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
    $error = true;
    $emailError = "Please enter valid email address.";
  }

  if (empty($pass)){
    $error = true;
    $passError = "Please enter your password.";
  }


  // if there's no error, continue to login
  if (!$error) {
 
    $password = hash( 'sha256', $pass);

    $res = mysqli_query($connect, "SELECT * FROM users WHERE userEmail='$email'");
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row


    //superadmin
    if( $count == 1 && $row['userPass']==$password ) {
        if($row["status"] == 'superadmin'){
        $_SESSION['superadmin'] = $row['userId'];
        header( "Location: login/home_superadmin.php");
        } else{
            echo "Incorrect Credentials, Try again..." ;
        }
    } else {
        echo "Incorrect Credentials, Try again..." ;
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>

  <title>Login</title>

  <style type ="text/css">
        .card-body{
            line-height: 0.5rem;
        }
        .manageMedia {
            width : 40%;
            margin: auto;
        }
        #card-footer {
            background-color: #ffc107!important;
            border-top: 0;
        }
        
        .card-img{
            height: 500px;
        }
        footer{
            color: white;
        }
        .footer-pad{
            padding: 1rem;
        }
    </style>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">


</head>

<body>

     <!-- Navbar -->
     <nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
            <a class='navbar-brand' href='index.php'>Big Library</a>
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav'        
                aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span></button>
            <div class='collapse navbar-collapse' id='navbarNav'>
                <ul class='navbar-nav'>
                    <li class='nav-item active'>
                        <a class='nav-link' href='index.php'>Home<span class='sr-only'>(current)</span></a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href="login/register.php">Register</a>        
                    </li>
                </ul>
            </div>
        </nav>


    <!-- Header -->
    <header>
        <div class="jumbotron main_header" >
            <h1 class="display-4">Big Library for dutie</h1><br>
            <p class="lead">If you want to have a good time in perfect society</p>
        </div>
    </header>

    <div class ="manageMedia">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete= "off">
 
            <h2>Login</h2>
            <hr/>

            <?php
            if ( isset($errMSG) ) {
                echo $errMSG; 
            ?>


            <?php
            }
            ?>
                
        <input  type="email" name="email"  class="form-control" placeholder="Your Email" 
        value="<?php echo $email; ?>" maxlength="40" />
        <span class="text-danger"><?php  echo $emailError; ?></span >

        <input  type="password" name="pass" class="form-control" placeholder ="Your Password" maxlength="15"  />
        <span  class="text-danger"><?php echo $passError; ?></span>
        <hr/>

        <button type="submit" class='btn btn-info' name= "btn-login">Sign In</button>
        <hr/>
        <br>
        <a href='login/register.php'>
            <button type='button' class='btn btn-info'>Register Here...</button></a>
        
        
        </form>
        <br>
    </div>


     <!-- Footer -->
     <footer class="mainfooter footer footer-expand-lg footer-dark bg-dark" role="contentinfo">
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-pad">
                            <h4>About Us</h4>
                            <ul class="list-unstyled">
                                <li><a href="#">Team</a></li>
                                <li><a href="#">News and Updates</a></li>
                                <li><a href="#">FAQs</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 footer-pad">
                        <h4>Follow Us</h4>
                        <ul class="social-network social-circle list-unstyled">
                            <li>
                                <a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i>Facebook</a>
                            </li>
                            <li>
                                <a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i>LinkedIn</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 copy">
                        <p class="text-center">&copy; Copyright 2020 - Edina Muray. All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JQuery - Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" 
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" 
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" 
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" 
        crossorigin="anonymous"></script>


</body>
</html>

<?php 

  ob_end_flush(); 

?>