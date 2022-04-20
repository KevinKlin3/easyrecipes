<?php
include "../../admin/config.php";
if(!$conn)  {
   echo "Failed to connect to MySQL: ".mysqli_connect_error();
}
// if(isset($_SESSION['userID'])) {
//     $userID = $_SESSION['userID'];
// } else {
//     header("Location: newRecipe.php");
//    exit();
//  }

$pageTitle = "Delete Verify";
$recipeID = $recipeTitle = $recipeImage = $recipeContent = $username = $username = $type = NULL;
$pageContent = $msg = NULL;

if (isset($_POST['delete-recipe']))   {
   $query = "DELETE FROM `recipe_table` WHERE `recipeID` = $recipeID LIMIT 1;";
   $result = mysqli_query($conn,$query);
   if (!$result) {
	   die(mysqli_error($conn));$msg = "<p>Delete Failed</p>";}else {
      $row_count = mysqli_affected_rows($conn);
      if($row_count == 1)  {
         unlink("recipeImages/".$_POST['recipeImage']);
         header("Location: deleteverify.php?action=delete");
         exit();
      }else {$msg = "<p>Insert Failed</p>";}
   }

   $query = "SELECT * FROM `recipe_table` WHERE `recipeID` = $recipeID";
   $result = mysqli_query($conn,$query);
   if (!$result) {
	   die(mysqli_error($conn));
   }
   if ($row = mysqli_fetch_assoc($result))   {
      $recipeTitle = $row['recipeTitle'];
      $username = $row['username'];
      $recipeImage = $row['recipeImage'];
      $recipeContent = $row['recipeContent'];
      $date = $row['date'];
      $type = $row['type'];
   }else {$msg = "Sorry, we couldn't find your recipe.";}
}
$pageContent .= <<<HERE
<section class="container-fluid">
   <div class="col-md m-3">
   $msg
   <figure><img src="recipeImages/$recipeImage" alt= "recipe image" class="img-thumbnail" />
      <figcaption>$recipeTitle</figcaption>
   </figure>
   <h1>Delete this recipe?</h1>
      <p class='bg-warning'>Are you sure you want to delete this recipe? This cannot be undone.</p>
      <p>$username</p>
      <form action ="Recipe.php" method="post">
         <div class="form-group">
            <input type="submit" name="cancel" value="cancel" class="btn btn-success">
         </div>
      </form>
      <form action="deleteverify.php" method="post">
         <div class="form-group">
            <input type="submit" name="delete-recipe" value="Verify Delete" class="btn btn-danger">
         </div>
      </form>
   </div>
</section>
HERE;

include '../../admin/recipeTemplate.php';
?>