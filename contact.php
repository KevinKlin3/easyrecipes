<?php
include 'config.php';

$pageTitle = "Contact Us";
$pageContent =<<<HERE
<main class="container-fluid bg-light m-1">
  <h1 class="text-center mt-2" id="recipeTitle">Contact Form</h1>
  <div class="container">
    <form action="thankyou.php">
      <label for="fname">First Name</label>
        <input type="text" id="fname" name="firstname" placeholder="First Name...">
      <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lastname" placeholder="Last Name...">
      <label for="country">Country</label>
        <select id="country" name="country">
          <option value="australia">Australia</option>
          <option value="canada">Canada</option>
          <option value="usa">USA</option>
        </select>
      <label for="subject">Subject</label>
        <textarea id="subject" name="subject" placeholder="Write something.."></textarea>

        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#myModal" >
        Submit
      </button>
      <input type="reset" class="btn btn-outline-danger" value="Cancel">
    </form>
  </div>
</main>
<!-- The Modal after clicking submit-->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="name">Thank You!</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        You have successfully sent us your comments and questions.
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
HERE;
include 'template.php'
?>

