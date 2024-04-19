<?php include('includes/header.php') 
?>
<!--here starts the first container-->
<div class="container my-5">
		<form method="post">
			<input type="text" name="search" placeholder="Search Anything ...">
			<button type="submit" name="validate" class="btn btn-info">Search</button>
		</form>
</div>
<div class="container1" id="userTable">
  <button class="btn btn-info my-5" id="addbtn">Add User</button>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">User ID</th>
      <th scope="col">User Name</th>
      <th scope="col">User Email</th>
      <th scope="col">User Type</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    <?php
    include 'config/db.php'; // Use include instead of @include to see any errors
    if(isset($_POST['validate'])){
     $inputValue=$_POST['search'];
     $sql="select * from users where user_id = '$inputValue' or user_name = '$inputValue' or user_email= '$inputValue' or user_type= '$inputValue'";
     $query=mysqli_query($conn,$sql);
     if($query){
      while ($row=mysqli_fetch_assoc($query)) {
         $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_email = $row['user_email'];
        $user_type = $row['user_type'];

        echo '<tr>
          <td>' . $user_id . '</td>
          <td>' . $user_name . '</td>
          <td>' . $user_email . '</td>
          <td>' . $user_type . '</td>
          <td>
          <button class="btn  btn-info text-white"><a style="text-decoration:none;" 
        href="update.php?updateid='.$user_id.'">update</a></button>
          <button  class="btn btn-info text-white"><a 
           style="text-decoration:none; href="delete.php?deletedid='.$user_id.'">delete</a></button>
           </td>
        </tr>';
        // code...
      }
      
     }
    }else{
       $sql = "select * from users";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      while ($row = mysqli_fetch_assoc($result)) {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_email = $row['user_email'];
        $user_type = $row['user_type'];

        echo '<tr>
          <td>' . $user_id . '</td>
          <td>' . $user_name . '</td>
          <td>' . $user_email . '</td>
          <td>' . $user_type . '</td>
          <td>
          <button class="btn text-white btn-info"><a href="update.php?updateid='.$user_id.'">update</a></button>
          <button class="btn text-white btn-info"><a href="delete.php?deletedid='.$user_id.'">delete</a></button>
           </td>
        </tr>';
      }
    }
    }
    ?>
  </tbody>
</table>
</div>
<!--the script-->
<script>
// JavaScript code to handle navigation between sections
document.addEventListener("DOMContentLoaded", function() {
  // Find the "Add User" button or link (replace 'addUserButton' with the actual id or class of your button/link)
  var addUserButton = document.getElementById("adduserButton");

  // Add click event listener
  addUserButton.addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default action of the button/link

    // Scroll to the addUserSection
    document.getElementById("userTable").scrollIntoView({
      behavior: "smooth" // You can change this to "auto" for instant scrolling
    });
  });

  // Handle form submission
  var addUserForm = document.getElementById("addUserForm");
  addUserForm.addEventListener("submit", function(event) {
    // After the form is submitted, scroll back to the table
    document.getElementById("userTable").scrollIntoView({
      behavior: "smooth" // You can change this to "auto" for instant scrolling
    });
  });
});
</script>
<script>
// JavaScript code to handle the click event and scroll to the addUserSection
document.addEventListener("DOMContentLoaded", function() {
  // Find the "Add User" button or link (replace 'addUserButton' with the actual id or class of your button/link)
  var addUserButton = document.getElementById("addbtn");

  // Add click event listener
  addUserButton.addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default action of the button/link

    // Scroll to the addUserSection
    document.getElementById("add_user").scrollIntoView({
      behavior: "smooth" // You can change this to "auto" for instant scrolling
    });
  });
});
</script>


<!--the script-->

<!--here ends the first container-->
<!--here starts the second container-->
<div class="container" id="add_user">
    <div class="row">
      <div class="col-md-12">
      <?php
@include 'config/dbcon.php';
if(isset($_POST['submit'])){

   $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
   $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM users WHERE user_email = '$user_email' && user_password= '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO users(user_name, user_email, user_password, user_type) VALUES('$user_name','$user_email','$pass','$user_type')";
         mysqli_query($conn, $insert);
        # header('location:login_form.php');
      }
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Management</title>
   <!-- custom css file link  -->
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="assets/css/style.css">
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="bc">
<div class="form-container">
<form action="" method="post">
   <h3>Add user</h3>
   <?php
   if(isset($error)){
      foreach($error as $error){
         echo '<span class="error-msg">'.$error.'</span>';
      };
   };
   ?>
   <input type="text" name="user_name" required placeholder="enter the user name">
   <input type="email" name="user_email" required placeholder="enter the email">
   <input type="password" name="password" required placeholder="enter your password">
   <input type="password" name="cpassword" required placeholder="confirm your password">
   <select name="user_type">
      <option value="user">user</option>
      <option value="admin">admin</option>
   </select>
   <input type="submit" class="bg-info"  name="submit"  value="register now" class="form-btn">
   <!--<p>already have an account? <a href="login_form.php">login now</a></p>-->
</form>
</div>
</div>
</body>
</html>
      
      </div>
    </div>
</div>
<!--here ends the second container-->

<!--update division ends here -->

   
<?php include('includes/footer.php') ?>