<?php
session_start();
include('includes/header.php');

// Include database connection
include 'config/dbcon.php';

// Check if the updateid parameter is set
if(isset($_GET['updateid'])) {
    $id_produit = $_GET['updateid'];

    // Fetch the admin details from the database
    $sql = "SELECT * FROM produit WHERE id_produit = :id_produit";
    $query = $conn->prepare($sql);
    $query->bindParam(':id_produit', $id_produit, PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);

    // Check if form is submitted
    if(isset($_POST['submit'])){
        // Retrieve form data
        $pnom = $_POST['pnom'];
        $Pprice = $_POST['Pprice'];
        $quantite = $_POST['quantite'];
        $description = $_POST['description'];

        // Update the admin record in the database
        $update = "UPDATE produit SET pnom = :pnom, Pprice = :Pprice, quantite = :quantite, description = :description WHERE id_produit = :id_produit";
        $query = $conn->prepare($update);
        $query->bindParam(':pnom', $pnom, PDO::PARAM_STR);
        $query->bindParam(':Pprice', $Pprice, PDO::PARAM_INT);
        $query->bindParam(':quantite', $quantite, PDO::PARAM_INT);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':id_produit', $id_produit, PDO::PARAM_INT);
        $query->execute();

        // Redirect to a success page or do further processing
        exit(); // Ensure script stops executing after redirect
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
   <!-- Bootstrap CSS -->
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <!-- Custom CSS -->
   <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container" id="add_user">
    <div class="row">
      <div class="col-md-12">
        <div class="bc">
          <div class="form-container">
            <form action="" method="post">
              <h3>Update Admin</h3>
              <input type="text" name="pnom" required value="<?php echo $row['pnom'] ?>" >
              <input type="text" name="Pprice" required value="<?php echo $row['Pprice'] ?>">
              <input type="number" name="quantite" required value="<?php echo $row['quantite'] ?>">
              <input type="text" name="description" required value="<?php echo $row['description'] ?>" >
              <input type="submit" class="bg-info"  name="submit"  value="Submit" class="form-btn">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

<?php include('includes/footer.php') ?>
