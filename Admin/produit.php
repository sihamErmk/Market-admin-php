<?php
session_start();
include('includes/header.php') 
?>
<!--here starts the first container-->
<div class="container my-5">
		<form method="post">
			<input type="text" name="search" placeholder="Search Anything ...">
			<button type="submit" name="validate" class="btn btn-info">llll</button>
		</form>
</div>
<div class="container1" id="userTable">
  <button class="btn btn-info my-5" id="addbtn">Add User</button>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Produit ID</th>
      <th scope="col">Produit Nom</th>
      <th scope="col">Price</th>
      <th scope="col">Categorie</th>
      <th scope="col">Description</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
  <?php
include 'config/dbcon.php'; // Use include instead of @include to see any errors

if(isset($_POST['validate'])){
    $inputValue = $_POST['search'];
    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM produit WHERE id_produit = :inputValue OR pnom = :inputValue OR Pprice = :inputValue";
    $query = $conn->prepare($sql);
    $query->bindParam(':inputValue', $inputValue, PDO::PARAM_STR);
    if($query->execute()){
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $id_produit = $row['id_produit'];
            $pnom = $row['pnom'];
            $Pprice = $row['Pprice'];
            $quantite = $row['quantite'];
            $description = $row['description'];

            echo '<tr>
                    <td>' . $id_produit . '</td>
                    <td>' . $pnom  . '</td>
                    <td>' . $Pprice . '</td>
                    <td>' .  $quantite  . '</td>
                    <td>' .  $image  . '</td>
                    <td>' .  $description . '</td>
                    <td>
                        <button class="btn  btn-info text-white"><a style="text-decoration:none;" href="updatePr.php?updateid='.$id_produit.'">update</a></button>
                        <button class="btn btn-info text-white"><a style="text-decoration:none;" href="deletePr.php?deletedid='.$id_produit.'">delete</a></button>
                    </td>
                  </tr>';
        }
    }
} else {
    // Display all products if the form is not submitted
    $sql = "SELECT * FROM produit";
    $query = $conn->prepare($sql);

    if ($query->execute()) {
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $id_produit = $row['id_produit'];
            $pnom = $row['pnom'];
            $Pprice =  $row['Pprice'];
            $quantite = $row['quantite'];
            $id_category = $row['id_category'];
            $image = $row['image'];
            $description = $row['description'];

            echo '<tr>
                    <td>' . $pnom . '</td>
                    <td>' . $Pprice . '</td>
                    <td>' . $quantite . '</td>
                    <td>' . $id_category  . '</td>
                    <td>' . $image  . '</td>
                    <td>' . $description  . '</td>
                    <td>
                        <button class="btn text-white btn-info"><a href="updatePr.php?updateid='.$id_produit.'">update</a></button>
                        <button class="btn text-white btn-info"><a href="deletePr.php?deletedid='.$id_produit.'">delete</a></button>
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
      // Retrieve form data
      $pnom = $_POST['pnom'];
      $Pprice = $_POST['Pprice'];
      $quantite = $_POST['quantite'];
      $id_category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);
    
      // Handle file upload
      $file_name = $_FILES['image']['name']; // Get the name of the uploaded file
      $folder = '../images/' . $file_name; // Get the temporary location of the uploaded file
  
      // Store the file path in the database
      //$image = $target_file; // Set $image variable to the file path
      
    }
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
        $insert = "INSERT INTO produit(pnom, Pprice, quantite, id_category, image ) VALUES (:pnom, :Pprice, :quantite, :id_category, :image)";
        $query = $conn->prepare($insert);
        $query->bindParam(':pnom', $pnom, PDO::PARAM_STR);
        $query->bindParam(':Pprice', $Pprice, PDO::PARAM_INT);
        $query->bindParam(':quantite', $quantite, PDO::PARAM_INT);
        $query->bindParam(':id_category', $id_category, PDO::PARAM_INT);
        $query->bindParam(':image', $file_name, PDO::PARAM_STR);

        $query->execute();
       
        exit(); // Ensure script stops executing after redirect
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

<form action="" method="post"  enctype="multipart/form-data">
   <h3>Ajouter Produit</h3>
   <input type="text" name="pnom" required placeholder="entrer le nom ">
   <input type="number" name="Pprice" required placeholder="entrer le prix">
   <input type="number" name="quantite" required placeholder="enter la quantite au stock">
   <input type="file" name="image" >
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