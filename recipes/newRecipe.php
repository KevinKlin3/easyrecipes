<?php
include '../admin/config.phpconfig.php';
if (!$conn) {
   echo "Failed to connect to MySQL: ".mysqli_connect_error($conn);
}//test connection first

$pageTitle = "Add New Recipes";
$recipeTitle = $recipeContent = $recipeImage = $type = $date = NULL;
$invalid_recipeTitle = $invalid_recipeContent = $invalid_type = Null;
$invalid_recipeImage = $fileInfo = $imageName = NULL;
$pageContent = $msg = NULL;
$valid = True;
$loggedIn = FALSE;


//error test
//  ini_set('display_errors', 1);
//  error_reporting(E_ALL);
// foreach ($var as $v) {}
//    $result = 1/0;


if(isset($_POST['submit'])) {
	$recipeTitle = mysqli_real_escape_string($conn, trim($_POST['recipeTitle']));
	$recipeContent = mysqli_real_escape_string($conn, trim($_POST['recipeContent']));
	$type = mysqli_real_escape_string($conn, trim($_POST['username']));


   $recipeTitle = mysqli_real_escape_string($conn, ucwords(trim($_POST['recipeTitle'])));
   if (empty($recipeTitle))  {
      $invalid_recipeTitle = '<span class="error">Required</span>';
      $valid = FALSE;
   }

   $recipeContent = mysqli_real_escape_string($conn, ucwords(trim($_POST['recipeContent'])));
   if (empty($recipeContent))  {
      $invalid_recipeContent = '<span class="error">Required</span>';
      $valid = FALSE;
   }

   
   if ($valid) {
      $filetype = pathinfo($_FILES['recipeImages']['name'], PATHINFO_EXTENSION);
      if((($filetype == "gif") or ($filetype == "jpg") or ($filetype == "png")) and $_FILES['recipeImages']['size'] < 300000) {
         if ($_FILES["recipeImages"]["error"] > 0)  {
            $invalid_recipeImage= '<p class= "error"> Return Code: $fileError<br>';
               switch ($fileError)  {
                  case 1:
                     $invalidPhoto .= 'The file exceeds upload max size in php.ini.</p>';
                     break;
                  case 2:
                     $invalidPhoto .= 'The file exceeds upload max size in HTML form</p>';
                     break;
                  case 3:
                     $invalidPhoto .= 'The file was partially uploaded</p>';
                     break;
                  case 4:
                     $invalidPhoto .= 'File was NOT uploaded</p>';
                     break;
                  case 5:
                     $invalidPhoto .= 'Temporary folder does not exist</p>';
                     break;
                  default:
                     $invalidPhoto .= 'Something Unexpected happened.</p>';
                     break;
               }//EO Switch
            } else {
               $imageName = $_FILES["recipeImages"]["name"];
               $file = "recipeImages/$recipeImage";
               $fileInfo = "<p>Upload: $recipeImage<br>";
               $fileInfo .= "Type: " . $_FILES["recipeImages"]["type"] . ",<br>";
               $fileInfo .= "Size: " . ($_FILES["recipeImages"]["size"] / 1024) . "KB<br>";
               $fileInfo .= "Temp File: " . $_FILES["recipeImages"]["tmp_name"] . "</p>";
               
               if (file_exists("$file"))  {
                  $invalid_recipeImage = "<span class ='error'> $recipeImage already exists.</span>";
                  $valid = FALSE; 
               }else {
                  if (move_uploaded_file($_FILES["recipeImages"]['tmp_name'], "$file")) {
                     $fileInfo .= "<p>Your file has been uploaded. Stored as: $file</p>";

                     $query = "INSERT INTO `easy_recipe` VALUES (DEFAULT, '$recipeTitle', '$recipeImage', '$recipeConent', DEFAULT, '$type', DEFAULT);";
                     $result = mysqli_query($conn, $query);
                     if (!$result)  {
                        die(mysqli_error($conn));
                     }else {
                        $row_count = mysqli_affected_rows($conn);
                        if($row_count == 1)  {
                           $memberID = mysqli_insert_id($conn);
                           header("Location: login.php");
                           exit();
                           //$loggedin = TRUE; don't need this anymore will redirect
                           $msg = "<p>Record Inserted</p>";
                        }else {
                           $msg = '<p>Insert Failed</p>';
                        }//EO row msg else
                     }//EO row else
                  }/*EO move IF*/ else {
                  $invalidPhoto .='<p><span class="error">Your File could not be uploaded.</span></p>';
               }//EO invalid photo else
            }//EO File exist else
         }//EO img if
      }/*EO file ext if*/ else {
            $invalidPhoto = '<span class= "error">Invalid File. This is not an image.</span>';
            $valid = FALSE;
         }//EO invalid file else
   }//EO valid if
}//EO if Submit
if($loggedIn) {
   $query = "SELECT * FROM `membership` WHERE `memberID` = $memberID;";
   $result = mysqli_query($conn, $query);
   if (!$result)  {
      die(mysqli_error($conn));
   }//EO if !result
   if ($row = mysqli_fetch_assoc($result))   {
      $firstname = $row['firstname'];
      $recipeTitle = $row['lastname'];
      $username = $row['username'];
      $email = $row['email'];
      $image = $row['image'];
   }/*EO if results*/ else {
      $msg = "Sorry, We couldn't find your record.";
   }//EO else query
   $pageContent .= <<<HERE
<section class="container-fluid">
$msg
<p>Thank you, $firstname $recipeTitle.</p>
<figure><img src="uploads/$image" alt= "Profile Image" class = profilePic" />
   <figcaption>Member: $firstname $recipeTitle</figcaption>
</figure>
<p>Email: $email</p>
<p>You are now logged into the system. We hope you enjoy the site.</p>
<p>Your information has been saved. Please use the username below for future login.</p>
<p>Username: <strong>$username</strong></p>
</section>\n
HERE;
}/*EO if logged in*/else {
   if(isset($_GET['action'])) {
      $msg = "<p class='error'>Record " . $_GET['action'] ."</p>";
   }
$pageContent .= <<<HERE
<h2>New users Register Here</h2>
<form action="register.php" enctype="multipart/form-data" method = "post">
   <div class="form-group">
      <label for="firstname">First Name</label>
      <input type="text" name="firstname" id="firstname" value="$firstname" placeholder="First Name" class = "form-control">$invalidFirst
   </div>
   <div class="form-group">
      <label for="lastname">Last Name</label>
      <input type="text" name="lastname" id="lastname" value="$recipeTitle" placeholder="Last Name" class = "form-control">$invalidLast
   </div>
   <div class="form-group">
      <label for="email">Email</label>
      <input type="text" name="email" id="email" value="$email" placeholder="email" class = "form-control">$invalidEformat
   </div>
   <div class="form-group">
      <label><span class="error">*</span> Password:</label>
      <input type="password" id="regPassword1" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
      title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
      placeholder="password" onkeyup="strongPW()" required />
      <span class="error">$invalidPass</span>
      
      <label class="registrationLabel"><span class="error">*</span> Re-type Password: </label>
      <input type="password" id="regPassword2" name="password2" placeholder="Confirm Password" onkeyup="checkPW()" required />
      <span id="match"></span>
      
      <p>Password must contain these characters:</p>
      <p id="capital" class="invalid">An <b>uppercase</b> letter</p>
      <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
      <p id="number" class="invalid">A <b>number</b></p>
      <p id="length" class="invalid">Minimum <b>8 characters</b></p>
   </div>
   <h4>Please select an image for you profile.</h4>
   <div class="form-group">
      <input type="hidden" name="MAX_FILE_SIZE" value="300000">
      <label for="profilePic">File to Upload:</label>$invalidPhoto
      <input class="form-control" type="file" name="profilePic" id="profilePic">
   </div>
   <div>
      <input type="submit" name="submit" value="Submit Profile" class= "btn btn-success">
      <input type="submit" name="reset" value="Reset Page" class= "btn btn-outline-danger">
   </div>
</form>
HERE;
}//EO else form
$pageTitle = "Register";
include "template.php";
?>