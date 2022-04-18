<?php
include_once '../../admin/config.php';
if(!$conn)  {
   echo "Failed to connect to MySQL: ". mysqli_connect_error();
}

$recipeTitle = $recipeImage = $recipeContent = $username = $username = $type = $date = NULL;
$pageTitle = "$recipeTitle";
$pageContent = $msg = NULL;

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
      $stmt->bind_param("i", $recipeID);
      $stmt->execute();
      $stmt->bind_result($recipeTitle, $recipeContent, $username, $recipeImage, $date, $type);
      $stmt->fetch();
      $stmt->close();
   }
}
$pageContent .= <<<HERE
<section class="container-fluid">
<h1>$recipeTitle</h1>
<figure class="image-fluid">
   <img src="recipes/recipeImages/$recipeImage" alt= "Food Image"/>
   <figcaption>By: $username</figcaption>
</figure>
<h3>$type</h3>
<p>$recipeContent</p>
<h4>$date</h4>
<h5></h5>
</section>
HERE;


//include '../comments.php';
include 'recipeTemplate.html';
?>