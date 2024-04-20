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
            $id_respE = $_GET['updateid'];
            $sql = "SELECT * FROM respe WHERE id_respE=$id_respE";
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
                //img part
                $file_name=$_FILES['image']['name'];
                $tempname=$_FILES['image']['tmp_name'];
                $folder='../images/'.$file_name;
                
                 // Insert new product into the database $id_admin
                 $update = "UPDATE respe SET nom = :nom, prenom = :prenom, email = :email,
                 password = :password, image = :file_name WHERE id_respE = :id";
                  $query = $conn->prepare($update);
                  if (move_uploaded_file($tempname, $folder)) {
                      echo "file succ";
                  } else {
                      echo "was not uploaded";
                  }
                  $query->bindParam(':nom', $nom, PDO::PARAM_STR);
                  $query->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                  $query->bindParam(':email', $email, PDO::PARAM_STR);
                  $query->bindParam(':password', $pass, PDO::PARAM_STR);  
                  $query->bindParam(':file_name', $file_name, PDO::PARAM_STR);
                  $query->bindParam(':id', $id_respE, PDO::PARAM_INT);
                  $query->execute();
                  
                  exit();// Ensure script stops executing after redirect
                        
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
    <div class="form-container"  >
      <form action="" method="post" enctype="multipart/form-data">
        <h3>Update Responsable des employees</h3>
        <input type="text" name="nom" required value="<?php echo $nom ?>" >
        <input type="text" name="prenom" required value="<?php echo $prenom ?>">
        <input type="email" name="email" required value="<?php echo $email ?>">
        <input type="file" name="image" class="form-control" id="image" />
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


