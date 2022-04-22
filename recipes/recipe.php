<?php

include '..\admin\config.php';
 if(!$conn)  {
    echo "Failed to connect to MySQL: ". mysqli_connect_error();
}

$pageTitle = "My recipes";
$recipeTitle = $recipeContent = $recipeImage = $type = $date = NULL;
$invalid_recipeTitle = $invalid_recipeContent = $invalid_type = Null;
$invalid_recipeImage = $fileInfo = $imageName = NULL;
$pageContent = $msg = NULL;
$logged_in = FALSE;
$valid = TRUE;


// if(isset($_SESSION['userID'])) {
//    $userID = $_SESSION['userID'];
//    $logged_in = TRUE;
// }else {
//    $logged_in= FALSE; 
// }
if(isset($_POST['submit'])) {
	$firstname = mysqli_real_escape_string($conn, trim($_POST['firstname']));
	$lastname = mysqli_real_escape_string($conn, trim($_POST['lastname']));
	$username = mysqli_real_escape_string($conn, trim($_POST['username']));
	$email = mysqli_real_escape_string($conn, trim($_POST['email']));
	$password = mysqli_real_escape_string($conn, trim($_POST['password']));

if(filter_has_var(INPUT_POST, 'edit'))  {
   $edit = TRUE;
}  else  {
   $edit = FALSE;
}


if(filter_has_var(INPUT_POST, 'recipeID'))  {
   $recipeID = filter_input(INPUT_POST, 'recipeID');
}elseif(filter_has_var(INPUT_GET, 'recipeID'))  {
   $recipeID = filter_input(INPUT_GET, 'recipeID');
}else {
   $recipeID = NULL;
}

if ($recipeID) {
	$stmt = $conn->stmt_init();
   if ($stmt->prepare("SELECT `recipeTitle`, `recipeContent`, `username`, `recipeImage`, `date`, `type` FROM `recipe_table` WHERE `recipeID` = ?")) {
      $stmt->bind_param("isssis", $recipeID);
      $stmt->execute();
      $stmt->bind_result($recipeTitle, $recipeContent, $username, $recipeImage, $date, $type);
      $stmt->fetch();
      $stmt->close();
   }

$buttons = <<<HERE
      <div class="form-group">
         <input type="hidden" name"recipeID" value="$recipeID">
         <input type="hidden" name="process">
         <input type="submit" name="update" value="Update Recipe" class="mb-2 btn btn-info">
      </div>
HERE;
} else {
   $buttons = <<<HERE
      <div class="form-group">
         <input type="hidden" name="insert">
         <input type="submit" name="update" value="Save Recipe" class="mb-2 btn btn-success">
      </div>
HERE;
}

//check delete Recipe posted
if(filter_has_var(INPUT_POST, 'delete'))  {
   $stmt = $conn->stmt_init();
   if ($stmt->prepare("DELETE FROM `recipe_table` WHERE = ?")){ 
      $stmt->bind_param("i", $recipeID);
      $stmt->execute();
      $stmt->close();
   }
   header ("recipe.php");//route back to home after deletion
   exit();
}
//Recipe Title
if(filter_has_var(INPUT_POST, 'process'))  {
   $valid = TRUE;
   $title = mysqli_real_escape_string($conn, trim($_POST['recipeTitle'])); 
   if (empty($RecipeTitle))  {
         $invalid_title = '<span class="error">Required</span>';
         $valid = FALSE;
      }
//content
   $content = mysqli_real_escape_string($conn, trim($_POST['recipeContent'])); 
   if (empty($recipeContent))  {
         $invalid_recipeContent = '<span class="error">Required</span>';
         $valid = FALSE;
      }
//type
      $content = mysqli_real_escape_string($conn, trim($_POST['type'])); 
   if (empty($type))  {
         $invalid_type = '<span class="error">Required</span>';
         $valid = FALSE;
      }

//image
if (!empty($_FILES['recipeImages']['name'])) {
   unlink("recipeImages/" . $_POST['imageName']);
   $filetype = pathinfo($_FILES['recipeImages']['name'], PATHINFO_EXTENSION);
   if((($filetype == "gif") or ($filetype == "jpg") or ($filetype == "png")) and $_FILES['recipeImages']['size'] < 300000) {
      if ($_FILES["recipeImages"]["error"] > 0)  {
         $valid = FALSE;
         $fileError = $_FILES['recipeImages']['error'];
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
            $file = "recipeImages/$imageName";
            $fileInfo = "<p>Upload: $imageName<br>";
            $fileInfo .= "Type: " . $_FILES["recipeImages"]["type"] . "<br>";
            $fileInfo .= "Size: " . ($_FILES["recipeImages"]["size"] / 1024) . " KB<br>";
            $fileInfo .= "Temp File: " . $_FILES["recipeImages"]["tmp_name"] . "</p>";
            
            if (file_exists("$file"))  {
               $invalid_recipeImage = "<span class ='error'>$imageName already exists.</span>";
               $valid = FALSE; 
            }else {
               if (move_uploaded_file($_FILES["recipeImages"]['tmp_name'], "$file")) {
                  $fileInfo .= "<p class='text-success'>Your file has been uploaded. Stored as: $file</p>";

                  $query = "UPDATE `recipe_table` SET `recipeImage` = '$imageName' WHERE `recipeID` = $recipeID;";
                  $result = mysqli_query($conn, $query);
                  if (!$result)  {
                     die(mysqli_error($conn));
                  }else {
                     $row_count = mysqli_affected_rows($conn);
                     if($row_count == 1)  {
                        $msg = "<p class='text-success'>Record Updated</p>";
                     }else {$msg = '<p class="error">Image Update Failed</p>';}//EO row msg else
                  }//EO row else
               }/*EO move IF*/ else {
               $invalid_recipeImage .='<p><span class="error">Your File could not be uploaded. ';
            }//EO invalid photo else
            }//EO File exist else
         }//EO img if
   }/*EO file ext if*/ else {
         $invalid_recipeImage = '<span class= "error">Invalid File. This is not an image.</span>';
         $valid = FALSE;
      }//EO invalid file else

   if($valid)  {
      if(filter_has_var(INPUT_POST, 'insert'))  {
         $stmt = $conn->stmt_init();
         if ($stmt->prepare("INSERT INTO `recipe_table`(`recipeTitle`, `recipeContent`, `username`, `recipeImage`, `date`, `type` ) VALUES (?, ?, ?, ?, ?, ?)")) {
            $stmt->bind_param("ssssis", $recipeTitle, $recipeContent, $username, $recipeImage, $date, $type);
            $stmt->execute();
            $stmt->close();
         }
         $postID = mysqli_insert_id($conn);
         header ("Location: user/recipes/recipe.php?recipeID=$recipeID");
         exit();
      }
      if(filter_has_var(INPUT_POST, 'update'))  {
         $stmt = $conn->stmt_init();
         if ($stmt->prepare("UPDATE `recipe_table` SET `recipeTitle`= ?, `recipeImage`= ?, `recipeContent`= ?, `type`= ? WHERE `recipeID` = ?")) {
            $stmt->bind_param("ssss", $recipeTitle, $recipeImage, $recipeContent, $type);
            $stmt->execute();
            $stmt->close();
         }
         header ("Location: recipe.php?recipeID=$recipeID");
         exit();
      }
   } 
}
}//EO process
if ($edit) {
   $pageContent .= <<<HERE
   <section class="container-fluid m-2">
      $msg
      <form action="recipe.php" method="post">
         <div class="form-group">
            <label for="recipeTitle">Recipe Title</label>
            <input type="text" name="recipeTitle" id="recipeTitle" value="$recipeTitle" placeholder="Recipe Title" class ="form-control">$invalid_recipeTitle
         </div>
         <div class="form-group">
         <label for="type">Category</label>
         <input type="text" name="type" id="type" value="$type" placeholder="Breakfast, Lunch, Dinner" class ="form-control">$invalid_type
      </div>
         <div class="form-group">
            <label for="recipeContent">Recipe Content</label>
            <textarea name="recipeContent" id="recipeContent" class="form-control">$recipeContent</textarea>$invalid_recipeContent
         </div>
      <p> Please select an image for your recipe.</p>
      <div class="form-group">
         <input type="hidden" name="MAX_FILE_SIZE" value="300000">
         <label for="profilePic">File to Uploads</label> $invalid_recipeImage
         <input type="file" name="recipeImage" id="recipeImage" class="mb-3 form">
      </div>
   $buttons
      </form>
      <form action="recipe.php" method="post">
         <div class="form-group">
            <input type="submit" name="cancel" value="back" class="mb-2 btn btn-danger">
         </div>
      </form>
   </section>\n
HERE;
} elseif ($recipeID) {
	$pageContent .= <<<HERE
   <section class="container-fluid">
   <div class="bg-light m-3">
      <h2>$recipeTitle</h2>
      <p>$recipeImage</p>
      <p>$recipeContent</p>
      <div class="btn-group">
      <form action="recipe.php" method="post">
         <div class="form-group">
            <input type="hidden" name="recipeID" value="$recipeID">
            <input type="submit" name="edit" value="Edit Post" class="m-2 btn btn-info">
         </div>
      </form>
      <form action="Recipe.php" method="post">
         <div class="form-group">
            <input type="submit" name="cancel" value="Recipe List" class="m-2 btn btn-warning">
         </div>
      </form>
      <form action="deleteverify.php" method="post">
         <div class="form-group">
            <input type="hidden" name="recipeID" value="$recipeID">
            <input type="submit" name="delete" value="Delete" class="m-2 btn btn-danger">
         </div>
      </form>
      </div>
   </div>
   </section>
HERE;
} else {
// 	select data from db
// 	load default list
   $where = 1;
   $stmt = $conn->stmt_init();
   if ($stmt->prepare("SELECT `recipeID`, `recipeTitle` FROM `recipe_table` WHERE ?")) {
      $stmt->bind_param("i", $where);
      $stmt->execute();
      $stmt->bind_result($recipeID, $recipeTitle);
      $stmt->store_result();
      $classList_row_cnt = $stmt->num_rows();

      if($classList_row_cnt > 0){ // make sure we have at least 1 record
         $selectPost = <<<HERE
         <ul>\n
HERE;
         while($stmt->fetch()){ // loop through the result set to build our list
         $selectPost .= <<<HERE
            <li><a href="recipe.php?recipeID=$recipeID">$recipeTitle</a></li>\n
HERE;
         }
         $selectPost .= <<<HERE
         </ul>\n
HERE;
      } else {
         $selectPost = "<p>There are no recipes to see.</p>";
      }
      $stmt->free_result();
      $stmt->close();
   } else {
      $selectPost = "<p>Recipe system is down now. Please try again later.</p>";
   }

   $pageContent .= <<<HERE
   <h2>My Recipes</h2>
   $selectPost
   <form action="recipe.php" method="post">
   <div class="form-group">
      <input type="submit" name="edit" value="Create New Recipe" class="m-2 btn btn-success">
   </div>
   </form>
HERE;
}

include '../admin/recipeTemplate.php';

?>