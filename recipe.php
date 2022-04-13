<?php
include 'admin/config.php';

//everything with the page//
$pageTitle = "Recipe";
$pageContent = NULL;
// everything w/ recipe//
$recipeTitle = Null;
$recipeContent = Null;

$pageContent .= <<<HERE
<p>2 different views</p>
<p>image</p>
<p>recipe: all can see but only the creator can edit</p>
<p>comments: All can see, but only users can comment</p>
HERE;
include 'admin/template.php';
?>