<?php
include '../admin/config.php';
if (!$conn) {
   echo "Failed to connect to MySQL: ".mysqli_connect_error($conn);
}//test connection first

$pageTitle = "Add New Recipes";
$recipeID = $recipeTitle = $recipeContent = $recipeImage = $type = $date = NULL;
$invalid_recipeTitle = $invalid_recipeContent = $invalid_type = Null;
$invalid_recipeImage = $fileInfo = $imageName = NULL;
$pageContent = $msg = NULL;
$valid = True;
$logged_in = FALSE;


//error test
//  ini_set('display_errors', 1);
//  error_reporting(E_ALL);
// foreach ($var as $v) {}
//    $result = 1/0;


if(isset($_POST['submit'])) {
	$recipeTitle = mysqli_real_escape_string($conn, trim($_POST['recipeTitle']));
	$recipeContent = mysqli_real_escape_string($conn, trim($_POST['recipeContent']));
	$type = mysqli_real_escape_string($conn, trim($_POST['type']));


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
      $filetype = pathinfo($_FILES['recipeImage']['name'], PATHINFO_EXTENSION);
      if((($filetype == "gif") or ($filetype == "jpg") or ($filetype == "png")) and $_FILES['recipeImage']['size'] < 300000) {
         if ($_FILES["recipeImage"]["error"] > 0)  {
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
               $imageName = $_FILES["recipeImage"]["name"];
               $file = "recipeImages/$recipeImage";
               $fileInfo = "<p>Upload: $recipeImage<br>";
               $fileInfo .= "Type: " . $_FILES["recipeImage"]["type"] . ",<br>";
               $fileInfo .= "Size: " . ($_FILES["recipeImage"]["size"] / 1024) . "KB<br>";
               $fileInfo .= "Temp File: " . $_FILES["recipeImage"]["tmp_name"] . "</p>";
               
               if (file_exists("$file"))  {
                  $invalid_recipeImage = "<span class ='error'> $recipeImage already exists.</span>";
                  $valid = FALSE; 
               }else {
                  if (move_uploaded_file($_FILES["recipeImage"]['tmp_name'], "$file")) {
                     $fileInfo .= "<p>Your file has been uploaded. Stored as: $file</p>";

                     $query = "INSERT INTO `easy_recipe` VALUES (DEFAULT, `$recipeTitle`, `$recipeImage`, `$recipeConent`, DEFAULT, `$type`, DEFAULT);";
                     $result = mysqli_query($conn, $query);
                     if (!$result)  {
                        die(mysqli_error($conn));
                     }else {
                        $row_count = mysqli_affected_rows($conn);
                        if($row_count == 1)  {
                           $recipeID = mysqli_insert_id($conn);
                           header("Location: recipe-handle.php");
                           exit();
                           //$loggedin = TRUE; don't need this anymore will redirect
                           $msg = "<p>Record Inserted</p>";
                        }else {
                           $msg = '<p>Insert Failed</p>';
                        }//EO row msg else
                     }//EO row else
                  }/*EO move IF*/ else {
                  $invalid_recipeImage .='<p><span class="error">Your File could not be uploaded.</span></p>';
               }//EO invalid photo else
            }//EO File exist else
         }//EO img if
      }/*EO file ext if*/ else {
            $invalid_recipeImage = '<span class= "error">Invalid File. This is not an image.</span>';
            $valid = FALSE;
         }//EO invalid file else
   }//EO valid if
}//EO if Submit
if($logged_in) {
   $query = "SELECT * FROM `recipe_table` WHERE `recipeID` = $recipeID;";
   $result = mysqli_query($conn, $query);
   if (!$result)  {
      die(mysqli_error($conn));
   }//EO if !result
   if ($row = mysqli_fetch_assoc($result))   {
      $recipeTitle = $row['recipeTitle'];
      $recipeImage = $row['recipeImage'];
      $recipeConent = $row['recipeConent'];
      $username = $row['username'];
      $date = $row['date'];
      $type = $row['type'];
   }/*EO if results*/ else {
      $msg = "Sorry, We couldn't find your recipe.";
   }//EO else query
   $pageContent .= <<<HERE
   <content class="container-fluid">
   <h2 class='recipe-title'>$recipeTitle</h2>
   <div class="img-fluid">
      <div> $recipeImage</div>
   </div>
   <h3>$username</h3>
   <p>$recipeContent</p>
</content>
HERE;
}/*EO if logged in*/else {
   if(isset($_GET['action'])) {
      $msg = "<p class='error'>Record " . $_GET['action'] ."</p>";
   }
$pageContent .= <<<HERE
<main class="container ml-3">
<h2 id="myRecipe">Add a New Recipe Here</h2>
<form action="newRecipe.php" enctype="multipart/form-data" method = "post">
   <div class="form-group">
      <label for="recipeTitle">Recipe Title</label>
      <input type="text" name="recipeTitle" id="recipeTitle" value="$recipeTitle" placeholder="Recipe Title" class ="form-control">$invalid_recipeTitle
   </div>
   <h4>Please select an image for your recipe.</h4>
   <div class="form-group">
      <input type="hidden" name="MAX_FILE_SIZE" value="300000">
      <label for="recipeImage">File to Upload:</label>$invalid_recipeImage
      <input class="form-control" type="file" name="recipeImage" id="recipeImage">
   </div>
   <div class="form-group">
      <label for="recipeContent">Recipe :</label>
      <input type="hidden" name="recipeContent" id="recipeContent" value="$recipeContent">
      <textarea class="form-control" rows="5" id="recipeContent" name="recipeContent"></textarea>$invalid_recipeContent
   </div>
   <div class="form-group">
      <label for="type">Type :</label>
      <input type="text" name="type" id="type" value="$type" placeholder="Breakfast, Lunch, Dinner, Dessert" class = "form-control">$invalid_type
   </div>

   <div>
      <input type="submit" name="submit" value="Submit Recipe" class= "btn btn-outline-success mt-3">
      <input type="submit" name="reset" value="Reset Page" class= "btn btn-outline-warning mt-3">
      <input type="submit" name="cancel" value="Back" class= "btn btn-outline-danger mt-3">
   </div>
</form>
</main>
HERE;
}//EO else form
$pageTitle = "New Recipe";
include '../admin/recipeTemplate.php';
?>