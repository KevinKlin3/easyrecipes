<?php
include_once '../../admin/config.php';


$pageContent .= <<<HERE
<content class="container-fluid">
   <h2>$recipeTitle</h2>
   <div class="img-fluid">
      <div> $recipeImage</div>
   </div>
   <h3></h3>
   <p></p>


</content>
HERE;

include_once '../admin/recipeTemplate.php';
?>