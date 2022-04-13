<?php
// configuration
include_once 'config.php';

// sticky's
$pageTitle = "Gallery";
$pageContent = NULL;
$recipeTitle  = Null;
$recipeImage = Null;
// QUERY
$sql = "SELECT recipeTitle, recipeImage FROM recipe_table";
$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));			
while( $record = mysqli_fetch_assoc($resultset) ) {
}		
$pageContent . =<<<HERE
<div class="card bg-dark text-white">
<img src="$recipeImage" class= "card-img">
<div class="card-img-overlay">
  <h5 class="card-title">$recipeTitle</h5>
</div>
</div>
HERE;

include 'admin/template.html';
?>