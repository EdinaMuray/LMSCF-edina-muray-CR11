<?php require_once 'actions/db_connect.php'; ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoptation</title>

    <style type ="text/css">
        .card-body{
            line-height: 0.5rem;
        }
        .manageMedia {
            width : 90%;
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

            <a class='navbar-brand' href='index.php'>Pet Adoption</a>
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav'        
                aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span></button>

            <div class='collapse navbar-collapse' id='navbarNav'>
                <ul class='navbar-nav'>
                    <li class='nav-item active'>
                        <a class='nav-link' href='index.php'>Home<span class='sr-only'>(current)</span></a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href="login.php">Login</a>        
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href="login/register.php">Register</a>        
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href="login_sa.php">Superadmin</a>        
                    </li>
                    <form class="form-inline mt-2 mt-md-0 p-2">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    <li class='nav-item'>
                            <a class='nav-link' href="login/logout.php">Logout</a>        
                    </li>
                </ul>
              </div>
            </nav>

    <!-- Header -->
    <header>
        <div class="jumbotron main_header" >
            <h1 class="display-4">If you need a friend</h1><br>
            <p class="lead">We are always there for You!</p>
        </div>
    </header>


    <!-- Main -->
    <main>
        <div class ="manageMedia"><br>

    <div class="container row row-cols-sm-1 row-cols-md-1 row-cols-lg-1 row-cols-1 mx-4 d-flex justify-content-around">
        <div class="welcome">
            <h1>Welcome on our Animal Adoption Website!</h1><br>
            <h3>Please look around between our cutie pets</h3>
        </div>

        <!-- PHP Script -->
        <?php

        $sql = "SELECT * FROM animal";
        $result_all = $connect->query($sql);

        if ($result_all->num_rows > 0) {

            while($row = $result_all->fetch_assoc()) {
                
            echo"
                <div class='card mb-3'>
                    <div class='row no-gutters bg-warning border-light text-info text-center teaser hovereffect'>
                        <div class='col-md-4'>
                            <img src=' ".$row['img']." ' class='card-img' alt='..' />
                        </div>
                        <div class='col-md-8'>
                            <div class='card-body'>
                                <h2 class='card-title text-left'>Name: ".$row['name']."</h2>
                                <h3 class='card-text text-left'>Description: ".$row['description']."</h3>
                                <br><br>
                                <h4 class='card-text text-left'>Hobby: ".$row['hobby']."</h4>
                                <h4 class='card-text text-left'>Age: ".$row['age']."</h4>
                                <br>
                                <h5 class='card-text text-left'>Breed: ".$row['breed'].", size: ".$row['type']."</h5>
                                <br>
                                <br><br>
                                <p class='card-text text-left text-muted'><b>Pet register id: ".$row['ani_id']."</b></p><br>
                                <p class='card-text text-left text-muted'><b>Location: ".$row['city']." ". $row['address'] ."</b></p>
                            </div>
                        </div>
                    </div>
                </div>";
                }
            } 
        else { 
            echo "<h3><center>No Data avaliable</center></h3>"; 
        }?>
            <br>
            </div>
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