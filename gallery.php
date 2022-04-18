<?php
// configuration
include 'admin\config.php';

// sticky's
$pageTitle = "Gallery";
$pageContent = NULL;
$recipeTitle  = $recipeImage = $recipeID = Null;

// QUERY
$sql = "SELECT recipeTitle, recipeImage FROM recipe_table";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));			
while( $record = mysqli_fetch_assoc($resultset) ) {
}

//get information from db load default list
   $where = 1;
   $stmt = $conn->stmt_init();
   if ($stmt->prepare("SELECT `recipeID`, `recipeTitle`, `recipeImage` FROM `recipe_table` WHERE ?")) {
      $stmt->bind_param("i", $where);
      $stmt->execute();
      $stmt->bind_result($recipeID, $recipeTitle, $recipeImage);
      $stmt->store_result();
      $classList_row_cnt = $stmt->num_rows();

      if($classList_row_cnt > 0){ // make sure we have at least 1 record
         $selectPost = <<<HERE
         <div class="container-fluid">
         <div class="card bg-dark text-white m-2">
HERE;
         while($stmt->fetch()){ // loop through the result set to build our list
         $selectPost .= <<<HERE
         <img src="$recipeImage" class= "card-img">
         <a href="recipe.php?recipeID=$recipeID" class="card-title">$recipeTitle</a>
HERE;
         }
         $selectPost .= <<<HERE
         </div>
         </div>
         </div>
HERE;
      } else {
         $selectPost = "<p>There are no recipes to see.</p>";
      }
      $stmt->free_result();
      $stmt->close();
   } else {
      $selectPost = "<p>Recipe system is down now. Please try again later.</p>";
   }

$pageContent .= $selectPost;

include 'admin/template.html';
?>

<!-- <main class="container-fluid>
<div class="card bg-dark text-white">
   <img src="$recipeImage" class= "card-img">
   <div class="card-img-overlay">
      <h5 class="card-title">$recipeTitle</h5>
   </div>
</div>
</main> -->

