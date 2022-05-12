<?php
include 'config.php';

if (!$conn){
	echo "Failed to connect to database: " . mysqli_connect_error ();
}           
$pageTitle = "Admin Dashboard";
$pageContent=NULL;
$userID = NULL;
$firstname = NULL;
$lastname = NULL;
$nickname =NULL; 
$username = NULL;
$role=NULL;
$email = NULL;
$avatar = NULL;

// read all row from database table
$sql = "SELECT * FROM user_table";
$result = $conn->query($sql);

if (!$result) {
die("Invalid query: " . $conn->error);
}
    while($row = $result->fetch_assoc()) {
    $userID = $row ['userID'];
    $firstname = $row ['firstname'];
    $lastname = $row ['lastname'];
    $username = $row ['username'];
    $email = $row ['email'];
    $image_name = $row ['avatar'];
    }

$conn->close();


$pageContent .= <<<HERE
<main class="container">
    <legend>Amin Dashboard</legend>
    <div class="table-responsive-sm">
        <table class="table">
            <thead class="table-success">
                <tr>
                    <th>userID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Avatar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> $userID</td>
                    <td>$firstname</td>
                    <td>$lastname</td>
                    <td>$username</td>
                    <td>$email</td>
                    <td><img class="img-fluid img-thumbnail" style="max-height:80px;"src ="images/$image_name" alt= "Profile image">
                    </figure></td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='admin_profile.php?update&userID=$userID'>Update</a>
                        <a class='btn btn-danger btn-sm' href='delete.php?userID=$userID'>Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
HERE;

include 'template.php';
?>