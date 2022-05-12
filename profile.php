<?php
include 'config.php';
//Profile
if (!$conn){
	echo "Failed to connect to database: " . mysqli_connect_error ();
}

if(!auth_user()) {
	header ("Location: register.php");
	exit();
}

if(auth_admin(1)) {
	$adminButton = '<div class="mb-3 mt-3">
	<form action="dashboard.php" method="post">
	<input type="submit" name="edit" value="Open Dashboard" class="btn btn-primary">
	</form>
	</div>';
} else {
	$adminButton = NULL;
}
if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
}

$userID = $_SESSION['userID'];
if(isset ($_POST['userID'])){
	$userID = $_POST['userID'];
}elseif(isset ($_GET['userID'])){
	$userID = $_GET['userID'];
}

$pageTitle = "Profile";

$pageContent = $firstname =$lastname = $username = $email = NULL;

$password = $password_verify = $password_error = $password_match_error = NULL;

$firstname_error = $lastname_error = $email_error = $invalid_image = NULL;

$role= $fileinfo = $image_name = NULL;

$valid = TRUE;
$update = FALSE;

if (isset($_GET['message'])){
	$message = "<p class='text-danger'> " . $_GET['message'] . "</p>";
}else{
	$message = NULL;
}

if (isset($_GET['action'])){
	$message = "<p class='text-danger'> Record " . $_GET['action'] . "</p>";
}else{
	$message = NULL;
}

if (isset($_GET['update'])){
	$update= TRUE;
}

if (isset($_POST['update'])) {
	$firstname = mysqli_real_escape_string($conn,ucwords(trim($_POST['firstname'])));
	if (empty($firstname)){ 
		$firstname_error = '<span class="text-danger"> - Field Required!</span>';
		$valid = FALSE;
	}
	
	$lastname = mysqli_real_escape_string($conn,ucwords(trim($_POST['lastname'])));	
	if (empty($lastname)){ 
		$lastname_error = '<span class="text-danger"> - Field Required!</span>';
		$valid = FALSE;
	}
	
	
	$email = (trim($_POST['email']));
	if (empty($email)){ 
		$email_error = '<span class="text-danger"> - Field Required!</span>';
		$valid = FALSE;
	}
	if (!preg_match('/[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}/', $email)) {
		$email_error = '<span class="text-danger"> - Invalid email address! email@web.com </span>';
		$valid = FALSE;
	} 
	
	if ($valid){
		$query = "UPDATE `user_table` SET `firstname` = '$firstname', `lastname` = '$lastname', `email` = '$email' WHERE `userID`= $userID;";
		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
		if (!$result) {
			die(mysqli_error($conn));
		}
	}
	
	$password = trim($_POST['Password']);
	if (!empty ($password)){
		$password_verify = trim($_POST['password_verify']);
		if (strcmp ($password, $password_verify)){
			$password_match_error = '<span class="text-danger"> - Password and Password Verify should match!</span>';
			$valid = FALSE;
		}else{
			///encrypt
			$password = password_hash($password, PASSWORD_DEFAULT);
			$query = "UPDATE `user_table` SET `password` = '$password' WHERE `userID`= $userID;";
			$result = mysqli_query($conn, $query);
			if (!$result) {
				die(mysqli_error($conn));
			}else{
				$row_count = mysqli_affected_rows ($conn);
				if ($row_count ==1){
					echo "<p> Record updated </p>";
				}else{
					echo "<p> Password updated failed! </p>";
				}
			}
		}
	}

	if (!empty ($_FILES['profile_image']['name'] )) {
		unlink ("images/" . $_POST ['avatar']);
		$filetype = pathinfo($_FILES['profile_image']['name'],PATHINFO_EXTENSION);
		if ((($filetype == "gif") or ($filetype == "jpg") or ($filetype == "png")) and 
		$_FILES['profile_image']['size'] < 3000000) {
			if ($_FILES['profile_image']['error'] > 0) {
				$valid = FALSE;
				$file_error = $_FILES["profile_image"]["error"];
				$invalid_image = "<p class ='error'>Return Code: $file_error <br>";
				switch ($file_error){
				case 1: $invalid_image .= "the file exceed the MAX_FILE_SIZE setting in the page </p>";
					break;
				case 2: $invalid_image .= "the file exceed the MAX_FILE_SIZE setting in the page </p>";
					break;
				default: 
					$invalid_image .= "Something is wrong </p>";
					break;
				}
			} else { 
				$image_name = $_FILES["profile_image"]["name"];
				$file = "images/$image_name";
				$fileinfo = "<p> Upload: $image_name <br>"; 
				$fileinfo .= "Type: " . $_FILES['profile_image']['type'] . "<br>";
				$fileinfo .= "Size: " . ($_FILES['profile_image']['size'] / 1024) . " Kb <br>";
				$fileinfo .= "Temp file: " . $_FILES["profile_image"]["tmp_name"] . "</p>";
				if (file_exists("$file")) {
					$invalid_image = "<span class='error' > $image_name already exists. </span> ";
					$valid = FALSE;
				} else {
					if (move_uploaded_file($_FILES['profile_image']['tmp_name'], "$file" )){
						$fileinfo .= "<p> Your file has been uploaded, as: 	$file</p>";
						///change
						$query = "UPDATE `user_table` SET `avatar`= '$image_name' WHERE `userID`=$userID;";
						$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
						if (!$result) {
							die(mysqli_error($conn));
						} else {
							$row_count = mysqli_affected_rows($conn);
							if ($row_count == 1) {
								echo "<p>Record updated</p>";
							} else {
								echo "<p>Upload image update failed</p>";
							}
						}	
					} else {
						$invalid_image .= '<span class ="error"> Your image could not be record.</span> ';
					}
				}
			}
		}else {
			$invalid_image = '<span class = "error"> This is not image. </span> ';
			$valid = FALSE;
		}
	}
}

	$query = "SELECT * FROM `user_table` WHERE `userID`= $userID;";
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die(mysqli_error($conn));
	}
	if ($row = mysqli_fetch_assoc ($result)){
		$firstname = $row ['firstname'];
		$lastname = $row ['lastname'];
		$username = $row ['username'];
		$email = $row ['email'];
		$image_name = $row ['avatar'];
	}else{
		$message = "Sorry, we could not find you record.";
	}
	
if (!$update){
	$stmt = $conn->stmt_init();
 if ($stmt->prepare("SELECT `recipeID`, `recipeTitle`, `recipeContent`, `authorID`, `date`, `image`, `type` FROM `recipe_table` WHERE `authorID` = ?")) {
 $stmt->bind_param("i", $userID);
 $stmt->execute();
 $stmt->bind_result($recipeID, $recipeTitle, $recipeContent, $authorID, $date, $image, $type);
 $stmt->store_result();
 $classList_row_cnt = $stmt->num_rows();

 if($classList_row_cnt > 0){ // make sure we have at least 1 record
 $selectPost = <<<HERE
 <ul class="list-group list-group-horizontal">
HERE;
 while($stmt->fetch()){ // loop through the result set to build our list
 $selectPost .= <<<HERE
 <li class="list-group-item align-items-stretch m-2">
 <h3 class="text-center text-capitalize mt-2">
 <a class="text-decoration-none" href="recipe.php?recipeID=$recipeID">$recipeTitle</a>
 </h3>
 <img class="card-img m-2" id="imageThumbnail" src="images/$image">
 </li>
HERE;
 }
 $selectPost .= <<<HERE
 </ul>
HERE;
 } else {
 $selectPost = "<p>There are no recipes to see.</p>";
 }
 $stmt->free_result();
 $stmt->close();
 } else {
 $selectPost = "<p>Recipe system is down now. Please try again later.</p>";
 }

 $recipes = <<<HERE
 <div class="bg-light">
 <h2 class="d-flex justify-content-center mt-3 pb-2" id="myRecipe">My Recipes</h2>
 $selectPost
			<form action="recipe.php" method="post">
				<input type="submit" name="edit" value="Create a New Recipe" class="btn btn-primary">
			</form>
		</div>
HERE;
if(isset($msg)) {
	$msg = "<div class='alert alert-success'>
	$msg
</div>";
} else {
	$msg = NULL;
}
$pageContent .= <<<HERE
<main class="container p-5 my-5 bg-light text-secondary rounded">
$msg
	<div class= "row">
		
		<div class="col-sm-6 col-lg-4 " >
			<div class="card bg gradient-custom text-center text-white" style="border-radius: 15px;";
				$message
				<h3>Welcome</h3>
				<h3>$firstname $lastname</h3>
				<figure><img src = "images/$image_name" alt= "Profile image" class="img-fluid my-5" style="width: 80px;">
				</figure>				
				<p>Email: $email </p>
				<p>Username: <strong> $username</strong></p>
				<p><small>This is your username for future login</small></p>
				<br>
				<h3>You are logged in! </h3>
				<div class="mb-3 mt-3">
				<form action="profile.php?update&userID=$userID" method="post">
				<input type="submit" name="edit" value="Update Profile" class="btn btn-secondary">
				</form>
				</div>
				$adminButton
			</div>
		</div>
		
		<div class="col-sm-6 col-lg-8">
			$recipes
		</div>
	
	</div>
</main>\n
HERE;

}else{	
$pageContent .=<<<HERE
	<main class="container p-5 my-5 bg-light text-secondary rounded-3">
	$message
	<h2 class="fw-bold">Please, update your information. </h2>
	<form method="post" enctype="multipart/form-data" action="profile.php">
		<div class="form-group">
			<label for="firstname">First Name: </label>
			<input type="text" placeholder="First Name" name="firstname" id="firstname" value="$firstname" class="form-control">
			$firstname_error
		</div>
		<div class="form-group">
			<label for="lastname">Last Name: </label>
			<input type="text" placeholder="Last Name" name="lastname" id="lastname" value="$lastname" class="form-control">
			$lastname_error
		</div>
		
		<div class="form-group">
			<label for="email">Email: </label>
			<input type="text" placeholder="example@example.com" name="email" id="email" value="$email" class="form-control">
			$email_error 
		</div>
		<div class="form-group">
			<label for="password">Password: </label>
			<input type="password" placeholder="" name="password" id="password" value="" class="form-control">
			$password_error
		</div>
		<div class="form-group">
			<label for="password_verify">Password Verify: </label>
			<input type="password" placeholder="" name="password_verify" id="password_verify" value="" class="form-control">
			$password_match_error
		</div>
		<figure><img src="images/$image_name" alt= "Profile Avatar" class="profile_image" style="padding:15px;width:220px;height:220px;"/>
		<figcaption class="fw-bold">Member: $firstname $lastname </figcaption>
		</figure>
			<p style "clear: both;">Please upload an image for your profile. </p>
			<div class="mb-3 mt-3">
			<input type="hidden" name="MAX_FILE_SIZE" value="300000" >
			<label for="profile_image">File to Upload: </label> <span class="text-danger" style="font-size:20px;background-color:powderblue;"><br>$invalid_image </span>
			<input type="file" name="profile_image" id="profile_image" class="form-control">
			</div>
			<div class="mb-3 mt-3">
				<input type="hidden" class="btn btn-outline-primary" name="avatar" value="$image_name">
				<input type="hidden" class="btn btn-outline-primary" name="userID" value="$userID">
				<input type="submit" class="btn btn-outline-success" name="update" value="Update Profile">
			</div>
	</form>
	<form method="post" action="update.php">
		<div class="mb-3 mt-3">
			<input type="hidden" name="userID" value="$userID">
			<input type="submit" name="delete" value="Delete Profile">
		</div>
	</form>
	<a href="profile.php" class="btn btn-outline-info" > Back </a>	
	</div>
</main>\n
HERE;
}

include_once 'template.php';
##echo "<pre>";
##print_r ($_POST);
##echo "<pre>";

?>