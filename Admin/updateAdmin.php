<?php
session_start();
include('includes/header.php') 
?>
<!--here starts the second container-->
<div class="container" id="add_user">
    <div class="row">
      <div class="col-md-12">
      <?php
            @include 'config/dbcon.php';
            $id_admin = $_GET['updateid'];
            $sql = "SELECT * FROM admin WHERE id_admin=$id_admin";
            $query = $conn->prepare($sql);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $nom = $row['nom'];
            $prenom = $row['prenom'];
            $email = $row['email'];
            if(isset($_POST['submit'])){
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $pass = md5($_POST['password']);
            // Check if the admin already exists
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
                 $insert = "INSERT INTO admin(nom, prenom, email, password) VALUES (:nom, :prenom, :email, :password)";
                 $query = $conn->prepare($insert);
                 $query->bindParam(':nom', $nom, PDO::PARAM_STR);
                 $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                 $query->bindParam(':email', $email, PDO::PARAM_STR);
                 $query->bindParam(':password', $pass, PDO::PARAM_STR);
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
      <form action="" method="post">
        <h3>Update Admin</h3>
        <input type="text" name="nom" required value="<?php echo $nom ?>" >
        <input type="text" name="prenom" required value="<?php echo $prenom ?>">
        <input type="email" name="email" required value="<?php echo $email ?>">
        <input type="password" name="password" required >
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


