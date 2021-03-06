<?php

ob_start();
session_start();

require_once 'actions/db_connect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) ) {
 header("Location: index.php");
 exit;
}
if(isset($_SESSION["user"])){
  header("Location: home.php");
  exit;
}
?>


<?php 

    if ($_GET['id']) {

        $id = $_GET['id'];

        $sql = "SELECT * FROM media WHERE media_id = $id ";
        $result = $connect->query($sql);

        $data = $result->fetch_assoc();

        $connect->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Media</title>

    <style type= "text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 50% ;
        }
        table tr th  {
            padding-top: 20px;
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Big Library</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"        
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href="create.php">Create Media</a>        
                </li>
            </ul>
        </div>
    </nav>

    <!-- Header -->
    <header>
        <div class="jumbotron main_header" >
            <h1 class="display-4">Big Library for dutie</h1>
            <p class="lead">If you want a good time</p>
        </div>
    </header>


    <!-- Main -->
    <main>
        <div class="main">
            <br>
            <fieldset>
            <legend>Update Media</legend>

            <form action="actions/a_update.php"  method="post">
                <table cellspacing="0" cellpadding= "0">
                    <tr>
                        <th>Media ID</th>
                        <td><input type="number" name="media_id" placeholder="Media ID" value="<?php echo $data['media_id'] ?>" /></td>
                    </tr>    
                    <tr>
                        <th>Cover</th>
                        <td><input  type="text" name= "cover" placeholder="Cover" value="<?php echo $data['cover'] ?>" /></td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td><input type="text" name="author_fname" placeholder="First Name" value="<?php echo $data['author_fname'] ?>" /></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td><input type="text" name="author_lname" placeholder="Last Name" value="<?php echo $data['author_lname'] ?>" /></td>
                    </tr>   
                    <tr>
                        <th>Title</th>
                        <td><input  type="text" name= "title" placeholder="Title" value="<?php echo $data['title'] ?>" /></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td><input  type="text" name= "ISBN" placeholder="ISBN" value="<?php echo $data['ISBN'] ?>" /></td>
                    </tr>
                    <tr>
                        <th>Short description</th>
                        <td><input  type="text" name= "short_description" placeholder="short_description" value="<?php echo $data['short_description'] ?>" /></td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td><input  type="text" name= "type" placeholder="Type" value="<?php echo $data['type'] ?>" /></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><input  type="text" name= "availability" placeholder="Status" value="<?php echo $data['availability'] ?>" /></td>
                    </tr>
                    <tr>
                        <input type="hidden" name="id" value="<?php echo $data['media_id']?>"/>
                        <td>
                            <button type="submit" class="btn btn-info">Save Changes</button>
                            <a href= "index.php"><button type="button" class="btn btn-info">Back</button></a>
                        </td>
                    </tr>
                </table>
            </form>
        </fieldset>
        <br>
    </div>
</main>


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
                                <a href="#" class="icoLinkedin" title="Linkedin"><i class="fa fa-linkedin"></i>Linkedin</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 copy">
                        <p class="text-center">&copy; Copyright 2018 - Company Name. All rights reserved</p>
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
}
?>