<?php
session_start();
include 'Admin/config/dbcon.php';

if(isset($_POST['submit'])) {
    $useremail = $_POST['user_email'];
    $password = $_POST['user_password'];
    $select = "SELECT * FROM users WHERE email = :useremail AND password = :password";
    $qry = $conn->prepare($select);
    $qry->bindParam(':useremail', $useremail);
    $qry->bindParam(':password', $password);
    $qry->execute();
    $row = $qry->fetch(PDO::FETCH_ASSOC);
    $state=$row['status'];
    if($state==1){
        if($row) {
            $user_role = $row['user_role'];
            $user_name = $row['nom'];
            $_SESSION['user_role']= $row['user_role'];
            $_SESSION['email']= $row['email'];
            $_SESSION['nom']= $row['nom'];
    
            if($user_role == 'super admin') {
                $_SESSION['admin_name'] = $user_name;
                header('location: Admin/autre.php');
                exit();
            }
            else if($user_role == 'ResponsableStock') {
                $_SESSION['admin_name'] = $user_name;
                header('location: Admin/stock.php');
                exit();
            }
            else if($user_role == 'admin'){
                header('location: Admin/admin.php');
                exit();
            }
            else if($user_role == 'respo employee'){
                header('location: employee.php');
                exit();
            }
            else if($user_role == 'fournisseur'){
                header('location: Admin/four.php');
                exit();
            }
        } else {
            $error[] = 'Incorrect email or password!';
        }
    }
    else {
        header('location: Admin/accessdenied.php');
        exit();
    }  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>
   <link rel="stylesheet" href="style.css">
</head>
<body>
   <div class="form-container">
      <form action="" method="POST">
         <h3>login now</h3>
         <input type="email" name="user_email" required placeholder="enter your email">
         <input type="password" name="user_password" required placeholder="enter your password">
         <input type="submit" name="submit" value="login now" class="form-btn">
      </form>
   </div>
</body>
</html>