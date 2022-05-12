<?php
include 'config.php';
if (!$conn) {
   echo "Failed to connect to MySQL: ".mysqli_connect_error($conn);
}//test connection first

$pageTitle = "Add New Recipes";
$recipeID = $recipeTitle = $recipeContent = $recipeImage = $type = $date = NULL;
$invalid_recipeTitle = $invalid_recipeContent = $invalid_type = Null;
$invalid_recipeImage = $fileInfo = $imageName = NULL;
$pageContent = $msg = NULL;
$valid = null;
$logged_in = FALSE;


//error test
//  ini_set('display_errors', 1);
//  error_reporting(E_ALL);
// foreach ($var as $v) {}
//    $result = 1/0;


if(isset($_POST['submit'])) {
   $valid = TRUE;
   $recipeTitle = mysqli_real_escape_string($conn, trim($_POST['recipeTitle'])); 
   if (empty($recipeTitle))  {
      $invalid_recipeTitle = '<span class="error">Required</span>';
      $invalid = '<span class="error">Title Required</span>';
      $valid = FALSE;
      }
//content
   $recipeContent = mysqli_real_escape_string($conn, trim($_POST['recipeContent'])); 
   if (empty($recipeContent))  {
         $invalid_recipeContent = '<span class="error">Required</span>';
         $invalid = '<span class="error">Content Required</span>';
         $valid = FALSE;
      }
//type
      $type = mysqli_real_escape_string($conn, trim($_POST['type'])); 
   if (empty($type))  {
         $invalid_type = '<span class="error">Required</span>';
         $invalid = '<span class="error">Type Required</span>';
         $valid = FALSE;
      }

//image
   if (!empty($_FILES['recipeImage']['name'])) {
      $imageName = $_FILES["recipeImage"]["name"];
      // unlink("recipeImages/" . $_POST['imageName']);
      $filetype = pathinfo($_FILES['recipeImage']['name'], PATHINFO_EXTENSION);
      if((($filetype == "gif") or ($filetype == "jpg") or ($filetype == "png")) and $_FILES['recipeImage']['size'] < 3000000) {
         if ($_FILES["recipeImage"]["error"] > 0)  {
            $invalid = '<span class="error">Error Free Image Required</span>';
            $valid = FALSE;
            $fileError = $_FILES['recipeImage']['error'];
            $invalid_recipeImage= '<p class= "error"> Return Code: $fileError<br>';
               switch ($fileError)  {
                  case 1:
                     $invalid_recipeImage .= 'The file exceeds upload max size in php.ini.</p>';
                     break;
                  case 2:
                     $invalid_recipeImage .= 'The file exceeds upload max size in HTML form</p>';
                     break;
                  case 3:
                     $invalid_recipeImage .= 'The file was partially uploaded</p>';
                     break;
                  case 4:
                     $invalid_recipeImage .= 'File was NOT uploaded</p>';
                     break;
                  case 5:
                     $invalid_recipeImage .= 'Temporary folder does not exist</p>';
                     break;
                  default:
                     $invalid_recipeImage .= 'Something Unexpected happened.</p>';
                     break;
               }//EO Switch
         } else {
               $file = "recipeImages/$imageName";
               $fileInfo = "<p>Upload: $imageName<br>";
               $fileInfo .= "Type: " . $_FILES["recipeImage"]["type"] . "<br>";
               $fileInfo .= "Size: " . ($_FILES["recipeImage"]["size"] / 1024) . " KB<br>";
               $fileInfo .= "Temp File: " . $_FILES["recipeImage"]["tmp_name"] . "</p>";
               if (move_uploaded_file($_FILES["recipeImage"]['tmp_name'], "$file")) {
                  $fileInfo .= "<p class='text-success'>Your file has been uploaded. Stored as: $file</p>";
                  $stmt = $conn->stmt_init();
                  if ($stmt->prepare("UPDATE `recipe_table` SET `recipeImage` = ? WHERE `recipeID` = ?")) {
                     $stmt->bind_param("si", $imageName, $recipeID);
                     $stmt->execute();
                     $stmt->close();
                  }
               } else {
                  $invalid_recipeImage .='<p><span class="error">Your File could not be uploaded. ';
               }//EO invalid photo else
            }//EO img if
      }/*EO file ext if*/ else {
            $invalid_recipeImage = '<span class= "error">Invalid File. This is not an image.</span>';
            $invalid = '<span class="error">Invalid File</span>';
            $valid = FALSE;
         }//EO invalid file else
   }//EO empty files
}
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
       $date = $row['date'];
       $type = $row['type'];
    }/*EO if results*/ else {
       $msg = "Sorry, We couldn't find your recipe.";
    }//EO else query
    $pageContent .= <<<HERE
    <content class="container-fluid">
   <h2 id="myRecipe">$recipeTitle</h2>
    <div class="img-fluid">
       <div> $recipeImage</div>
    </div>
    <p>$recipeContent</p>
 </content>
 HERE;
 }/*EO if logged in*/else {
    if(isset($_GET['action'])) {
       $msg = "<p class='error'>Record " . $_GET['action'] ."</p>";
    }
   }
if('submit')
$pageContent .= <<<HERE
<main class="container bg-light ml-3 mt-1">
   <h2 id="myRecipe" class="d-flex justify-content-center">Add a New Recipe Here</h2>
   <form action="newRecipe.php" enctype="multipart/form-data" method = "post">
      <div class="form-group">
         <label for="recipeTitle">Recipe Title</label>
         <input type="text" name="recipeTitle" id="title" value="$recipeTitle" placeholder="Recipe Title" class ="form-control" required>$invalid_recipeTitle
      </div>
      <h5>Please select an image for your recipe.</h5>
      <div class="form-group">
         <input type="hidden" name="MAX_FILE_SIZE" value="300000">
         <label for="recipeImage">File to Upload:</label>$invalid_recipeImage
         <input class="form-control" type="file" name="recipeImage" id="recipeImage" required>
      </div>
      <div class="form-group">
         <label for="recipeContent">Recipe :</label>
         <input type="hidden" name="recipeContent" id="recipeContent" value="$recipeContent">
         <textarea class="form-control" rows="5" id="recipeContent" name="recipeContent" required></textarea>$invalid_recipeContent
      </div>
      <div class="form-group">
         <label for="type">Type :</label>
         <input type="text" name="type" id="type" value="$type" placeholder="Breakfast, Lunch, Dinner, Dessert" class = "form-control" required>$invalid_type
      </div>
   </form>
      <div class="btn-group">
         <div class="form-group">
            <form action="newRecipe.php" method="post">
               <input type="submit" name="submit" value="Submit" class= "btn btn-outline-success m-2">
            </form>
         </div>  
         <div class="form-group">
            <form action="newRecipe.php" method="post">
               <input type="submit" name="reset" value="Reset" class= "btn btn-outline-warning  m-2">
            </form>
         </div>
         <div class="form-group">
            <form action="recipe.php" method="post">
               <input type="submit" name="cancel" value="Back" class= "btn btn-outline-danger  m-2">
            </form>
         </div>
      </div>
</main>
HERE;
include 'template.php';
?>