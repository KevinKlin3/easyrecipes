<?php
include_once '../admin/config.php';
if (!$conn){
	echo "Failed to connect to database: " . mysqli_connect_error ();
}

// Stickies
$pageTitle = $pageContent = NULL;
$recipeTitle = $recipeImage = $recipeContent = $username =Null;

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
$pageTitle = "$recipeTitle";
include_once '../admin/recipeTemplate.php';
?>