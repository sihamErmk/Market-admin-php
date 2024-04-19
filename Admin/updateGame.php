
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update game</title>
	<link rel="stylesheet" href="../styling.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> 
</head>
<body>
	<div class="container mt-5">
  <h2 >Add Game</h2> 
  <?php 
  $conn=mysqli_connect('localhost','root','','assoc');
  $game_id =$_GET['updatedid'];
  $sql="select *from games where game_id =$game_id";
  $result=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($result);
  $game_name=$row['game_name'];
  $game_title=$row['game_title'];
  $game_website=$row['game_website'];
  
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
    $sql = "UPDATE games SET game_id=$game_id, game_name='$game_name', game_title='$game_title',
    game_website='$game_website', game_img='$file_name' WHERE game_id=$game_id";

       if( mysqli_query($conn,$sql)){
        echo "data was updated";
        
    }
   
    	
  }
  ?> 
  <form  action="" method="post"  enctype="multipart/form-data">
    <div class="form-group">
      <label for="game_id">Game Number:</label>
      <input name="game_id" style="width: 900px;" type="number" class="form-control" id="game_id" required value="<?php echo $game_id ?>">
    </div>
    <div class="form-group">
      <label for="game_name">Game Name:</label>
      <input name="game_name" style="width: 900px;" type="text" class="form-control" id="game_name" required value="<?php echo $game_name ?>">
    </div>
    <div class="form-group">
      <label for="game_title">Add Description:</label>
      <textarea  name="game_title" class="form-control" id="game_title" rows="3" ><?php echo $game_title ?></textarea>
    </div>
    <div class="form-group">
      <label for="game_img">Event Image:</label>
      <input type="file" name="image" class="form-control" id="image"  />
    </div>
    <div class="form-group">
      <label for="game_website">Game Website:</label>
      <input type="text" name="game_website" class="form-control" id="game_website" value="<?php echo $game_website ?>">
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Update Game</button>
  </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>