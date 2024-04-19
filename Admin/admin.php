<?php
session_start();
include('includes/header.php') 
?>
<!--here starts the first container-->
<div class="container my-5">
		<form method="post">
			<input type="text" name="search" placeholder="Search Anything ...">
			<button type="submit" name="validate" class="btn btn-info">Chercher...</button>
		</form>
</div>
<div class="container1" id="userTable">
  <button class="btn btn-info my-5" id="addbtn">Ajouter Admin</button>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">Email</th>
      <th scope="col">Status</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
  <?php
include 'config/dbcon.php'; // Use include instead of @include to see any errors

if(isset($_POST['validate'])){
    $inputValue = $_POST['search'];
    if($inputValue=='Activé'){
      $inputValue=1;
    }else if ($inputValue=='désctivé'){
      $inputValue=0;
    }
    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM admin WHERE id_admin = :inputValue OR nom = :inputValue OR prenom = :inputValue OR email = :inputValue OR status=:inputValue ";
    $query = $conn->prepare($sql);
    $query->bindParam(':inputValue', $inputValue, PDO::PARAM_STR);
    if($query->execute()){
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $id_admin = $row['id_admin'];
            $nom = $row['nom'];
            $prenom = $row['prenom'];
            $email = $row['email'];
            $status =$row['status'];
            if($status=1){
              $state ='Activé';
            }else if($status=0){
              $state ='désactivé';
            }
            ?>
              <tr>
                  <td> <?php echo $nom ?> </td>
                  <td><?php echo $prenom ?> </td>
                  <td><?php echo $email ?> </td>
                  <td>
                    <button class="btn  btn-info text-white"><a style="text-decoration:none;" href="updatePr.php?updateid='<?php echo $id_admin;?>"><?php echo $state ?></a></button>  
                  </td>
                  <td>
                    <button class="btn  btn-info text-white"><a style="text-decoration:none;" href="updateAdmin.php?updateid=<?php echo $id_admin;?>">update</a></button>
                    <button class="btn btn-info text-white"><a style="text-decoration:none;" href="delete.php?deletedid=<?php echo $id_admin;?>">delete</a></button>
                  </td>
              </tr>
            <?php
        }
    }
} else {
    // Display all products if the form is not submitted
    $sql = "SELECT * FROM admin";
    $query = $conn->prepare($sql);

    if ($query->execute()) {
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $id_admin = $row['id_admin'];
          $nom = $row['nom'];
          $prenom = $row['prenom'];
          $email = $row['email'];
          $status =$row['status'];
          if($status=1){
            $state ='Activé';
          }else{
            $state ='désactivé';
          }
          ?>
          <tr>
              <td> <?php echo $nom ?> </td>
              <td><?php echo $prenom ?> </td>
              <td><?php echo $email ?> </td>
              <td>
                <button class="btn  btn-info text-white"><a style="text-decoration:none;" href="updatePr.php?updateid='<?php echo $id_admin;?>"><?php echo $state ?></a></button>  
              </td>
              <td>
                <button class="btn  btn-info text-white"><a style="text-decoration:none;" href="updateAdmin.php?updateid=<?php echo $id_admin;?>">update</a></button>
                <button class="btn btn-info text-white"><a style="text-decoration:none;" href="delete.php?deletedid=<?php echo $id_admin;?>">delete</a></button>
              </td>
            </tr>
        <?php
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
    // Retrieve form data
    echo "submitet";
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    //img part
    $file_name = $_FILES['image']['name'];
    $folder = '../images/' . $file_name;
    
    // Check if the product already exists
    $select = "SELECT * FROM admin WHERE email = :email";
    $query = $conn->prepare($select);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
     
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);

    if (count($rows) > 0) {
        $error[] = 'Admin deja exist!';
    } else {
      if($pass != $cpass){
        $error[] = 'password not matched!';
     }else{
       // Insert new product into the database
       $insert = "INSERT INTO admin(nom, prenom, email, password,image) VALUES (:nom, :prenom, :email, :password, :file_name)";
       $query = $conn->prepare($insert);
       $query->bindParam(':nom', $nom, PDO::PARAM_STR);
       $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
       $query->bindParam(':email', $email, PDO::PARAM_STR);
       $query->bindParam(':password', $pass, PDO::PARAM_STR);
       $query->bindParam(':file_name', $file_name, PDO::PARAM_STR);
       $query->execute();
       exit(); // Ensure script stops executing after redirect
     }
    }
}
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
      <form action="" method="post" enctype="multipart/form-data">
        <h3>Ajouter Admin</h3>
        <input type="text" name="nom" required placeholder="entrer le nom d'Admin">
        <input type="text" name="prenom" required placeholder="entrer le prenom de l'Admin">
        <input type="email" name="email" required placeholder="enter l'email de l'utilisateur">
        <input type="file" name="image" class="form-control" id="image" />
        <input type="password" name="password" required placeholder="enter un mot de pass">
        <input type="password" name="cpassword" required placeholder="confirm le  mot de pass">
        <input type="submit" class="bg-info"  name="submit"  value="submit" class="form-btn">
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


