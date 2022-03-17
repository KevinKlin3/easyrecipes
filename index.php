<?php

$pageTitle = "Home";
$pageContent = NULL;

$pageContent .= <<<HERE
<div class="col-md-8">
<h2>Why Easy Recipes?</h2>
<h4> Did you know?</h4>
<div><img src="admin/images/write.jpg" class="img-rounded" alt="Cinque Terre" width="50%" height="auto"> </div>
<h5>This is a Comprehensive Project Class Web Page</h5>
<p>This is a project blog style page that will have three wonderful women working together to create a functional web page. Through perserverance and the same vision, We will be creating a working recipe page that will have the ability to create a profile, log in and out, and to even add actual content like recipes."
</p>
<br>
<h2>Food Sharing!</h2>
<h4>Recipe Tradition</h4>
<div><img src="admin/images/fork.jpg" class="img-rounded" alt="fork with green background" width="50%" height="auto"></div>

<p>What is food sharing? ... So sharing around food includes not just sharing food itself, but also the sharing of spaces and even skills around growing, preparing and eating food. Ultimately, for us, food sharing is doing things together around food.</p>
</div>
HERE;
include 'admin/template.php';
?>