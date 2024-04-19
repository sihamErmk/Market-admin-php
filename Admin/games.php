<?php include('includes/header.php') 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Games Management</title>
    <link rel="stylesheet" href="../styling.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>      
    
<form method="post" >
            <input style="border-radius: 6px;" type="text" name="search" placeholder="Search Anything ...">
            <button type="submit" name="validate" class="btn btn-info btn-sm">search</button>
</form>  
<div class="container">
  <button class="btn btn-info my-5" id="addbtn">Add Game</button>
  <div class="card-content ">
        <?php
        $connect = mysqli_connect('localhost', 'root', '', 'assoc');
        $sql = "SELECT * FROM games";
        $result = mysqli_query($connect, $sql);
        if(isset($_POST['validate'])){
          $input=$_POST['search'];
          $sql="select * from games where game_id='$input' or game_name='$input' or game_title='$input' or game_website='$input'";
          $result =mysqli_query($connect,$sql);
          if($result){
             while ($row = mysqli_fetch_assoc($result)) {
                $game_id = $row['game_id'];
                $game_name = $row['game_name'];
                $game_title = $row['game_title'];
                $game_website = $row['game_website'];
                $game_img = $row['game_img'];
                ?>
                <div class="card1">
            <div class="card-image">
             <img src="../images/<?php echo $row['game_img'] ?>" alt="">   
            </div>
            <div class="card-info">
                <h3><?php echo $game_name ?></h3>
                <p><?php echo $game_title ?></p>
            </div>
           <div class="buttons">
                <button class="btn btn-info"><a href="<?php echo $game_website ?>" ><i class="fa-solid fa-laptop"></i></a></button>
                            <button class="btn btn-info"><a href="updateGame.php?updatedid=<?php echo $row['game_id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a></button>
            <button class="btn btn-info"><a href="deleteGame.php?deletedid=<?php echo $row['game_id']; ?>"><i class="fa-solid fa-trash"></i></a></button>
            </div>
            <div id="content"  style="display: none;">
            <p><?php echo $row['speakers'] ?> 
            </p>  
            </div>
        </div>
                <?php
            }
          }
        }
        if ($result && mysqli_num_rows($result) > 0) {
            #search code starts here 
            while ($row = mysqli_fetch_assoc($result)) {
                $game_id = $row['game_id'];
                $game_name = $row['game_name'];
                $game_title = $row['game_title'];
                $game_website = $row['game_website'];
                $game_img = $row['game_img'];
                ?>
                <div class="card1">
            <div class="card-image">
             <img src="../images/<?php echo $row['game_img'] ?>" alt="">   
            </div>
            <div class="card-info">
                <h3><?php echo $game_name ?></h3>
                <p><?php echo $game_title ?></p>
            </div>
           <div class="buttons">
                <button class="btn btn-info"><a href="<?php echo $game_website ?>" ><i class="fa-solid fa-laptop"></i></a></button>
                            <button class="btn btn-info"><a href="updateGame.php?updatedid=<?php echo $row['game_id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a></button>
            <button class="btn btn-info"><a href="deleteGame.php?deletedid=<?php echo $row['game_id']; ?>"><i class="fa-solid fa-trash"></i></a></button>
            </div>
            <div id="content"  style="display: none;">
            <p><?php echo $row['speakers'] ?> 
            </p>  
            </div>
        </div>
                <?php
            }
        } else {
            // Handle case where there are no games
            echo "<p>No games found.</p>";
        }
        ?>
    </div>
</div>
<div class="container mt-5" id="add_game">
  <h2 >Add Game</h2> 
   <?php 
  $conn=mysqli_connect('localhost','root','','assoc');
  if (isset($_POST['submit'])){
  	$game_id=$_POST['game_id'];
  	$game_name=$_POST['game_name'];
  	$game_title=$_POST['game_title'];
  	$game_website=$_POST['game_website'];
  	/*image part*/
    $file_name=$_FILES['image']['name'];
    $tempname=$_FILES['image']['tmp_name'];
    $folder='../images/'.$file_name;
    /*image part*/
  	$select="select *from games where game_id= '$game_id'";
    $res = mysqli_query($conn, $select);
    if(mysqli_num_rows($res)>0){
    	echo "the game already exists";
    }else{
    	/*INSERT INTO `games`(`game_id`, `game_name`, `game_title`, `game_website`, `game_img`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]')*/
    	$query="insert into games(game_id,game_name,game_title,game_website,game_img) VALUES ('$game_id','$game_name','$game_title','$game_website','$file_name') ";
    	 $result=mysqli_query($conn,$query);
    	  if(move_uploaded_file($tempname,$folder)){
             echo "";
         }else {
      echo "it was not uploaded try again";
    }
    if($result){
      echo "data was inserted";
    }
    }
  }
  ?>
  <form  action="" method="post"  enctype="multipart/form-data">
    <div class="form-group">
      <label for="game_id">Game Number:</label>
      <input name="game_id" style="width: 900px;" type="number" class="form-control" id="game_id" required placeholder="Enter the game number">
    </div>
    <div class="form-group">
      <label for="game_name">Game Name:</label>
      <input name="game_name" style="width: 900px;" type="text" class="form-control" id="game_name" required placeholder="Enter the game title">
    </div>
    <div class="form-group">
      <label for="game_title">Add Description:</label>
      <textarea  name="game_title" class="form-control" id="game_title" rows="3" placeholder="Enter a game description"></textarea>
    </div>
    <div class="form-group">
      <label for="game_img">Event Image:</label>
      <input type="file" name="image" class="form-control" id="image"/>
    </div>
    <div class="form-group">
      <label for="game_website">Game Website:</label>
      <input type="text" name="game_website" class="form-control" id="game_website" placeholder="Enter game website">
    </div>
    <button type="submit" name="submit" class="btn btn-info">Add Game</button>
  </form>
</div>
<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
// JavaScript code to handle the click event and scroll to the addUserSection
document.addEventListener("DOMContentLoaded", function() {
  // Find the "Add User" button or link (replace 'addUserButton' with the actual id or class of your button/link)
  var addUserButton = document.getElementById("addbtn");

  // Add click event listener
  addUserButton.addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default action of the button/link

    // Scroll to the addUserSection
    document.getElementById("add_game").scrollIntoView({
      behavior: "smooth" // You can change this to "auto" for instant scrolling
    });
  });
});
</script>
</body>
</html>
<?php include('includes/footer.php') ?>