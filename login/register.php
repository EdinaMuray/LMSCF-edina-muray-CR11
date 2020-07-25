<?php

   ob_start();
   session_start();
   
   include_once '../actions/db_connect.php';

   if( isset($_SESSION['user'])!="" ){
   header("Location: home_user.php" ); 
   }

   $error = false;

   if ( isset($_POST['btn-signup']) ) {

      $name = trim($_POST['name']);  
      $name = strip_tags($name);
      $name = htmlspecialchars($name);

      $email = trim($_POST[ 'email']);
      $email = strip_tags($email);
      $email = htmlspecialchars($email);

      $pass = trim($_POST['pass']);
      $pass = strip_tags($pass);
      $pass = htmlspecialchars($pass);


      // basic name validation
      if (empty($name)) {
         $error = true ;
         $nameError = "Please enter your full name.";
      } else if (strlen($name) < 3) {
         $error = true;
         $nameError = "Name must have at least 3 characters.";
      } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
         $error = true ;
         $nameError = "Name must contain alphabets and space.";
      }


      //basic email validation
      if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
         $error = true;
         $emailError = "Please enter valid email address." ;
      } else {
         // checks whether the email exists or not
         $query = "SELECT userEmail FROM users WHERE userEmail='$email'";
         $result = mysqli_query($connect, $query);
         $count = mysqli_num_rows($result);
         if($count!=0){
            $error = true;
            $emailError = "Provided Email is already in use.";
         }
      }

      // password validation
      if (empty($pass)){
         $error = true;
         $passError = "Please enter password.";
      } else if(strlen($pass) < 6) {
         $error = true;
         $passError = "Password must have at least 6 characters." ;
      }

      // password hashing for security
      $password = hash('sha256', $pass);

      // if there's no error, continue to signup
      if( !$error ) {

         $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
         
         if( $res = mysqli_query($connect, $query)){
           // echo "success";
         } else {
           //  echo "error";
         }


         if ($res) {
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now";
            unset($name);
            unset($email);
            unset($pass);
         } else  {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later..." ;
         }
      }
   }

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Big Library _ Advanced</title>

    <style type ="text/css">
         .main_header{
            height: 200px;
            background-color: lightgrey;
            padding: 1rem;
         }

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
            <a class='navbar-brand' href='../index.php'>Big Library</a>
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav'        
                aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span></button>
            <div class='collapse navbar-collapse' id='navbarNav'>
                <ul class='navbar-nav'>
                    <li class='nav-item active'>
                        <a class='nav-link' href='../index.php'>Home</a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href="../login.php">Login</a>        
                    </li>
                </ul>
            </div>
        </nav>


    <!-- Header -->
    <header>
        <div class="main_header">
            <br>
            <h1 class="display-6">Big Library for dutie</h1><br>
            <p class="lead">If you want to have a good time in perfect society</p>
        </div>
    </header>



   <!-- FORM start -->
   <div class ="manageMedia"><br>
   <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off">
     
      <h2>Register</h2>
      <hr/>
   
         <?php
            if ( isset($errMSG) ) {
         ?>

      <div class="alert alert-<?php echo $errTyp ?>" >
         <?php echo $errMSG; ?>
      </div>
      
         <?php
         }
         ?>

      <input type ="text" name="name" class ="form-control" placeholder ="Enter Name"
             maxlength ="50" value = "<?php echo $name ?>" />
      <span class ="text-danger"><?php echo $nameError; ?> </span>
   
      <input type ="email" name="email" class="form-control" placeholder="Enter Your Email"
             maxlength="40" value= "<?php echo $email ?>" />
      <span class="text-danger"><?php echo $emailError; ?></span>
 
      <input type="password" name="pass" class="form-control" placeholder="Enter Password"
             maxlength="15"/>
      <span class="text-danger"><?php echo $passError; ?></span>
      <hr/>

      <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Register</button>
      <hr/>
      <a href="../login.php">Login here...</a>
   
   </form >
 </div>
<br>




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


 </body >
</html >

<?php 

   ob_end_flush();
   
?>