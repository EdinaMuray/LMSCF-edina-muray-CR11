<?php

	ob_start();
	session_start();

	require_once '../actions/db_connect.php';

	// if session is not set this will redirect to login page
	if( !isset($_SESSION['admin']) && !isset($_SESSION['user']) && !isset($_SESSION['superadmin'])) {
		header("Location: ../login.php");
		exit;
	}

	if(isset($_SESSION["user"])){
		header("Location: home_user.php");
		exit;
	}

	if(isset($_SESSION["admin"])){
		header("Location: home_admin.php");
		exit;
	}

	// select logged-in users details
	$res = mysqli_query($connect, "SELECT * FROM users WHERE userId=".$_SESSION['superadmin']);
	$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

	// as admin I want see all the cars to update or delete they
	$resCar = mysqli_query($connect, "SELECT * FROM animal"); 

	$resCar2 = mysqli_query($connect, "SELECT * FROM users"); 
?>

<!DOCTYPE html>
<html>

<head>

	<title>Welcome - <?php echo $userRow['userName']; ?></title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style type ="text/css">
        .card-body{
            line-height: 0.5rem;
        }
        .manageMedia {
            width : 70%;
            margin: auto;
        }
        #card-footer {
            background-color: #ffc107!important;
            border-top: 0;
        }
        
        .card-img{
            height: 400px;
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
                        <a class='nav-link' href='../index.php'>Home<span class='sr-only'>(current)</span></a>
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href="../login.php">Login</a>        
                    </li>
                    <li class='nav-item'>
                        <a class='nav-link' href="register.php">Register</a>        
                    </li>
					<li class='nav-item'>
						<a class='nav-link' href="logout.php?logout">Logout</a>        
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


<div class ="manageMedia"><br>

	<h2>Hi <?php echo $userRow['userName']; ?></h2>
	<h4>Please take a look between our pets</h4>
	<hr>

	

	<?php

		if($resCar->num_rows == 0 ){
			echo "No result";
		}elseif($resCar->num_rows == 1){
			while ($row = $resCar->fetch_assoc()) {

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
		
			<div class='card-footer text-center' id='card-footer'>
			<a href='../singlemedia.php?id=".$row['media_id']."'>
				<button type='button' class='btn btn-info'>Show media</button></a>
			
			<a href='../create.php?id=".$row['media_id']."'>
				<button type='button' class='btn btn-info'>Create media</button></a>
			<a href='../update.php?id=".$row['media_id']."'>
				<button type='button' class='btn btn-info'>Update media</button></a>
			<a href='../delete.php?id=".$row['media_id']."'>
				<button type='button' class='btn btn-info'>Delete media</button></a>
		</div>
					</div>
				</div>
			</div>	
			";
			}

		}else {
			$rows = $resCar->fetch_all(MYSQLI_ASSOC);
			foreach ($rows as $row) {

				echo"
					<div class='card mb-3'>
						<div class='row no-gutters bg-warning border-light text-info text-center teaser hovereffect'>
							<div class='col-md-4'><img src=' ".$row['img']." ' class='card-img' alt='..' /></div>
							<div class='col-md-8'>
								<div class='card-body'>
									<h2 class='card-title text-left'>Name: ".$row['name']."</h2>
									<h3 class='card-text text-left'>Description: ".$row['description']."</h3>
										<br><br>
									<h4 class='card-text text-left'>Hobby: ".$row['hobby']."</h4>
									<h4 class='card-text text-left'>Age: ".$row['age']."</h4>
										<br>
									<h5 class='card-text text-left'>Breed: ".$row['breed'].", size: ".$row['type']."</h5>
										<br><br><br>
									<p class='card-text text-left text-muted'><b>Pet register id: ".$row['ani_id']."</b></p>
										<br>
									<p class='card-text text-left text-muted'><b>Location: ".$row['city']." ". $row['address'] ."</b></p>
								</div>
							</div>
							<div class='card-footer text-center' id='card-footer'>
								<a href='../singlemedia.php?id=".$row['media_id']."'>
									<button type='button' class='btn btn-info'>Show media</button></a>
								<a href='../create.php?id=".$row['media_id']."'>
									<button type='button' class='btn btn-info'>Create media</button></a>
								<a href='../update.php?id=".$row['media_id']."'>
									<button type='button' class='btn btn-info'>Update media</button></a>
								<a href='../delete.php?id=".$row['media_id']."'>
									<button type='button' class='btn btn-info'>Delete media</button></a>
							</div>
						</div>
					</div>";
			}
		}
	?>

<!-- /////////// -->
<!-- fetch users -->
<!-- /////////// -->

<?php

		if($resCar2->num_rows == 0 ){
			echo "No result";
		}elseif($resCar2->num_rows == 1){
			while ($row = $resCar2->fetch_assoc()) {

				echo"
					<div class='card mb-3'>
						<div class='row no-gutters bg-warning border-light text-info text-center teaser hovereffect'>
							<div class='col-md-8'>
								<div class='card-body'>
									<h2 class='card-title text-left'>Name: ".$row['userName']."</h2>
									<h3 class='card-text text-left'>Email: ".$row['userEmail']."</h3>
									<br><br>
									<h4 class='card-text text-left'>User ID: ".$row['userId']."</h4>
								</div>
							</div>
						</div>
						<div class='card-footer text-center' id='card-footer'>
							<a href='../superadmin/s_create.php?id=".$row['userId']."'>
								<button type='button' class='btn btn-info'>Create user</button></a>
							<a href='../update.php?id=".$row['userId']."'>
								<button type='button' class='btn btn-info'>Update user</button></a>
							<a href='../delete.php?id=".$row['userId']."'>
								<button type='button' class='btn btn-info'>Delete user</button></a>
						</div>
					</div>";
			}
		}else {
			$rows = $resCar2->fetch_all(MYSQLI_ASSOC);
			foreach ($rows as $row) {

				echo"
				<div class='card mb-3'>
					<div class='row no-gutters bg-warning border-light text-info text-center teaser hovereffect'>
						<div class='col-md-8'>
							<div class='card-body'>
								<h2 class='card-title text-left'>Name: ".$row['userName']."</h2>
								<h3 class='card-text text-left'>Email: ".$row['userEmail']."</h3>
								<br><br>
								<h4 class='card-text text-left'>User ID: ".$row['userId']."</h4>
							</div>
						</div>
					</div>
					<div class='card-footer text-center' id='card-footer'>
						<a href='../superadmin/s_create.php?id=".$row['userId']."'>
							<button type='button' class='btn btn-info'>Create user</button></a>
						<a href='../superadmin/s_update.php?id=".$row['userId']."'>
							<button type='button' class='btn btn-info'>Update user</button></a>
						<a href='../superadmin/s_delete.php?id=".$row['userId']."'>
							<button type='button' class='btn btn-info'>Delete user</button></a>
					</div>
				</div>";
			}
		}
	?>




	</div>

</body>
</html>

<?php 
	
	ob_end_flush();

?>