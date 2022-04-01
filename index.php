<?php

$pageTitle = "Home";
$pageContent = NULL;

$pageContent .= <<<HERE
<main>
   <div class="row">
      <div class="column side">
         <h2>Why Sharing Recipes?</h2>
               <img src="admin/images/food_bowl.jpg" class="fakeimg" alt="deconstructed salad bowl">
               <p>Sharing a recipe can be like sharing an intimate memory, one that transcends the table. ... So while recipe sharing speaks to the great human warmth that can be realized at a dinner table, recipe guarding speaks to a fundamental lack of trust. Fortunately, trust is something that can be forged over a shared plate of food.</p>
      </div>
      <div class="column middle">
         <h2>Why Easy Recipes?</h2>
            <h4> Did you know?</h4>
               <div>
                  <img src="admin/images/write.jpg" class="fakeimg" alt="garlic and tomatoes surrounding writing pad">
               </div>
         <h5>This is a Comprehensive Project Class Web Page</h5>
            <p>This is a project blog style page that will have three wonderful women working together to create a functional web page. Through perserverance and the same vision, We will be creating a working recipe page that will have the ability to create a profile, log in and out, and to even add actual content like recipes."
            </p>
         <br>
         <h2>Food Sharing!</h2>
            <h4>Recipe Tradition</h4>
               <div>
                  <img src="admin/images/fork.jpg" class="fakeimg" alt="fork with green background">
               </div>
                  <p>What is food sharing? ... So sharing around food includes not just sharing food itself, but also the sharing of spaces and even skills around growing, preparing and eating food. Ultimately, for us, food sharing is doing things together around food.</p> 
      </div>
   </div>
</main>
HERE;
include 'admin/template.php';
?>