<?php
include 'config.php';
if(!$conn)  {
   echo "Failed to connect to MySQL: ". mysqli_connect_error();
}

$pageTitle = "Contact Us";
$pageContent =<<<HERE
<main class="container-fluid bg-light m-1">
  <h2 class="text-center mt-2" id="recipeTitle">Contact Form</h2>
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
      <input type="submit" class="btn" value="Submit">
      <input type="reset" class="btn btn-outline-danger" value="Cancel">
    </form>
  </div>
</main>
HERE;
include 'template.php'
?>

