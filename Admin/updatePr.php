<?php
session_start();
include('includes/header.php') 
?>

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
    $pnom = $_POST['pnom'];
    $Pprice = $_POST['Pprice'];
    $quantite = $_POST['quantite'];
    // Sanitize user inputs to prevent SQL injection
    $id_category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);

    // Check if the product already exists
    $select = "SELECT * FROM produit WHERE pnom = :pnom";
    $query = $conn->prepare($select);
    $query->bindParam(':pnom', $pnom, PDO::PARAM_STR);
    $query->execute();
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);

    if (count($rows) > 0) {
        $error[] = 'Product already exists!';
    } else {
        // Insert new product into the database
        $insert = "INSERT INTO produit(pnom, Pprice, quantite, id_category) VALUES (:pnom, :Pprice, :quantite, :id_category)";
        $query = $conn->prepare($insert);
        $query->bindParam(':pnom', $pnom, PDO::PARAM_STR);
        $query->bindParam(':Pprice', $Pprice, PDO::PARAM_STR);
        $query->bindParam(':quantite', $quantite, PDO::PARAM_INT);
        $query->bindParam(':id_category', $id_category, PDO::PARAM_INT);
        $query->execute();
       
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
   <h3>Ajouter Produit</h3>
   <?php
   if(isset($error)){
      foreach($error as $error){
         echo '<span class="error-msg">'.$error.'</span>';
      };
   };
   ?>
   <input type="text" name="pnom" required >
   <input type="number" name="Pprice" required >
   <input type="number" name="quantite" required >
   <!--<input type="text" name="description" required placeholder="ajouter une description">-->
   <select name="category">
   <?php  
   $sql="SELECT * FROM category";
   $query = $conn->prepare($sql);
   $query->execute(); // Execute the prepared statement
   while($row = $query->fetch(PDO::FETCH_ASSOC)){
    $id_category = $row['id_category'];
    $Cnom = $row['Cnom'];
    ?>
          <option value="<?php echo $id_category; ?>" ><?php echo $Cnom; ?></option>
    <?php
   }
   ?>
    </select>  
   <input type="submit" class="bg-info"  name="submit"  value="submit" class="form-btn">
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


