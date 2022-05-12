<?php
include 'config.php';

if(filter_has_var(INPUT_POST, 'logout')) {
	$msg = 'You are Logged out.';
	foreach ($_SESSION as $field => $value){
		unset($_SESSION[$field]);
	}
	session_destroy();
	header("Location: index.php?msg=$msg");
	exit;
}
if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
	$msg = "<div class='alert alert-danger'>
	$msg
</div>";
} else {
	$msg = NULL;
}
$pageTitle = "Home";
$pageContent = NULL;

$pageContent .= <<<HERE
<main class= "container-fluid">
$msg
   <div class="row">
      <div class="col-sm-4 float-start">
         <h2 class="mt-2" id="name">Why Sharing Recipes?</h2>
               <img src="images/food_bowl.jpg" class="rounded-3 w-50" alt="deconstructed salad bowl">
               <p>Sharing a recipe can be like sharing an intimate memory, one that transcends the table. ... So while recipe sharing speaks to the great human warmth that can be realized at a dinner table, recipe guarding speaks to a fundamental lack of trust. Fortunately, trust is something that can be forged over a shared plate of food.</p>
      </div>
      <div class="col-sm-8">
         <h2 class="mt-2" id="name">Why Easy Recipes?</h2>
               <div>
                  <img src="images/write.jpg" class="rounded-3 w-25" alt="garlic and tomatoes surrounding writing pad">
               </div>
               <h4>Did you know?</h4>
         <h4>This is a Comprehensive Project Class Web Page</h5>
            <p>This is a project blog style page that will have three wonderful women working together to create a functional web page. Through perserverance and the same vision, We will be creating a working recipe page that will have the ability to create a profile, log in and out, and to even add actual content like recipes."
            </p>
         <br>
         <h2>Food Sharing!</h2>
               <div>
                  <img src="images/fork.jpg" class="rounded-3 w-25" alt="fork with green background">
               </div>
               <h4>Recipe Tradition</h4>
                  <p>What is food sharing? ... So sharing around food includes not just sharing food itself, but also the sharing of spaces and even skills around growing, preparing and eating food. Ultimately, for us, food sharing is doing things together around food.</p> 
      </div>
   </div>
</main>
HERE;
include 'template.php';
?>