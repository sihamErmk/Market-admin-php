<?php include('includes/header.php') 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events Management</title>
    <link rel="stylesheet" href="../styling.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">    
</head>
<body>
  <div style="margin-top:40px;"> 
    </div>
   <form method="post">
      <input type="text" name="search" placeholder="Search Anything...">
      <button type="submit" name="validate" class="btn btn-info ">Search</button>
    </form>
<div class="container">
      <button class="btn btn-info my-5" id="addbtn" >Add Event</button>
<div class="card-content ">
  <?php
  $conn=mysqli_connect('localhost','root','','assoc');
  #code search
  if(isset($_POST['validate'])){
    $input=$_POST['search'];
    $sql="select * from events where event_id= '$input' or event_title='$input' or event_desc= '$input' or  loc = '$input'  or organizer = '$input' or speakers= '$input' or sponsors= '$input' or face_url='$input' or twit_url='$input' or link_url='$input' or event_type ='$input' or  formulaLink='$input'      ";
    $qry=mysqli_query($conn,$sql);
    if($qry){
      while($row=mysqli_fetch_assoc($qry)){
        ?>
        <div class="card1">
            <div class="card-image">
             <img src="../images/<?php echo $row['img'] ?>" alt="">   
            </div>
            <div class="card-info">
                <h3><?php echo $row['event_title'] ?></h3>
                <p><?php echo $row['event_desc'] ?></p>
            </div>
            <div class="buttons">
                <button class="btn btn-info"><a href="updateEvent.php?updateid=<?php echo $row['event_id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a></button>
                <button class="btn btn-info"><a href="deleteEvent.php?deletedid=<?php echo $row['event_id'];?>"><i class="fa-solid fa-trash"></i></a></button>
            </div>
        </div>
            <?php
      }
    }
  }
  else{
  $sql = "select * from events";
  $result = mysqli_query($conn, $sql);
   if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
  ?>
        <div class="card1">
            <div class="card-image">
             <img src="../images/<?php echo $row['img'] ?>" alt="">   
            </div>
            <div class="card-info">
                <h3><?php echo $row['event_title'] ?></h3>
                <p><?php echo $row['event_desc'] ?></p>
            </div>
           <div class="buttons">
                <button class="btn btn-info"><a href="updateEvent.php?updateid=<?php echo $row['event_id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a></button>
            <button class="btn btn-info"><a href="deleteEvent.php?deletedid=<?php echo $row['event_id']; ?>"><i class="fa-solid fa-trash"></i></a></button>
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
?>  
</div>
</div> 
<script>
    document.getElementById('learnmore').addEventListener('click', function() {
        var content = document.getElementById('content');
        if (content.style.display === 'none') {
            content.style.display = 'block';
        } else {
            content.style.display = 'none';
        }
    });
</script>
</body>
</html>

<div class="container mt-5" id="add_user">
  <h2 >Add Event</h2> 
  <?php 
  $conn=mysqli_connect('localhost','root','','assoc');
  if (isset($_POST['submit'])){
    $event_id=$_POST['event_id'];
    $event_title = mysqli_real_escape_string($conn, $_POST['event_title']);
    $event_desc = mysqli_real_escape_string($conn, $_POST['event_desc']);
    $location = mysqli_real_escape_string($conn, $_POST['loc']);
    $organizer = mysqli_real_escape_string($conn, $_POST['organizer']);
    $speakers = mysqli_real_escape_string($conn, $_POST['speakers']);
    $sponsors = mysqli_real_escape_string($conn, $_POST['sponsors']);
    $face_url = mysqli_real_escape_string($conn, $_POST['face_url']);
    $twit_url = mysqli_real_escape_string($conn, $_POST['twit_url']);
    $link_url = mysqli_real_escape_string($conn, $_POST['link_url']);
    $insta_url = mysqli_real_escape_string($conn, $_POST['insta_url']);
    $startdate=$_POST['startdate'];
    $starttime=$_POST['starttime'];
    $endstime=$_POST['endstime'];
    $enddate=$_POST['enddate'];
    $deadline=$_POST['deadline'];
    $formulaLink=$_POST['formulaLink'];
    $para=$_POST['para'];
    /*image part*/
    $file_name=$_FILES['image']['name'];
    $folder='../images/'.$file_name;
    /*image part*/
    $event_type=$_POST['event_type'];
    $select="select *from events where event_id= '$event_id'";
    $res = mysqli_query($conn, $select);
    if(mysqli_num_rows($res) > 0){
    echo "the event is already exist try to update it ";
    }else{
    $sql = "INSERT INTO events (event_id,event_title, event_desc, loc, organizer, speakers, sponsors, face_url, twit_url, link_url, insta_url,startdate,starttime,enddate,endstime,deadline,event_type,img,formulaLink,para) VALUES ('$event_id','$event_title', '$event_desc','$location', '$organizer', '$speakers', '$sponsors', '$face_url', '$twit_url', '$link_url', '$insta_url','$startdate','$starttime','$enddate','$endstime','$deadline','$event_type','$file_name','$formulaLink','$para') ";
    $result=mysqli_query($conn,$sql);
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
      <label for="event_id">Event Serie Number:</label>
      <input name="event_id" style="width: 900px;" type="number" class="form-control" id="event_id" required placeholder="Enter the event number">
    </div>
    <div class="form-group">
      <label for="event_title">Event Title:</label>
      <input name="event_title" style="width: 900px;" type="text"  class="form-control" id="event_title" required placeholder="Enter event title">
    </div>
    <div class="form-group">
      <label for="event_description">Event Description:</label>
      <textarea  name="event_desc" class="form-control" id="event_description" rows="3" placeholder="Enter event description"></textarea>
    </div>
    <div class="form-group">
      <label for="event_img">Event Image:</label>
      <input type="file" name="image"  class="form-control" id="image" />
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="start_date">Start Date:</label>
        <input type="date" name="startdate"  class="form-control" id="start_date">
      </div>
      <div class="form-group col-md-6">
        <label for="start_time">Start Time:</label>
        <input type="time" name="starttime" class="form-control" id="start_time">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="end_date">End Date:</label>
        <input type="date" name="enddate" class="form-control" id="end_date">
      </div>
      <div class="form-group col-md-6">
        <label for="end_time">End Time:</label>
        <input type="time" name="endstime" class="form-control" id="end_time">
      </div>
    </div>
    <div class="form-group">
      <label for="location">Location:</label>
      <input type="text" name="loc" class="form-control" id="location" placeholder="Enter event location">
    </div>
    <div class="form-group">
      <label for="organizer">Organizer:</label>
      <input type="text" name="organizer" class="form-control" id="organizer" placeholder="Enter event organizer">
    </div>
    <div class="form-group">
      <label for="speakers">Speakers:</label>
      <input type="text" name="speakers" class="form-control" id="speakers" placeholder="Enter event speakers">
    </div>
    <div class="form-group">
      <label for="deadline">Registration Deadline:</label>
      <input type="datetime-local" name="deadline" class="form-control" id="deadline">
    </div>
    <div class="form-group">
      <label for="sponsors">Sponsors:</label>
      <input type="text" name="sponsors" class="form-control" id="sponsors" placeholder="Enter event sponsors">
    </div>
    <div class="form-group">
      <label for="facebook_url">Facebook URL:</label>
      <input type="text" name="face_url" class="form-control" id="facebook_url" placeholder="Enter Facebook URL">
    </div>
    <div class="form-group">
      <label for="twitter_url">Twitter URL:</label>
      <input type="text" name="twit_url" class="form-control" id="twitter_url" placeholder="Enter Twitter URL">
    </div>
    <div class="form-group">
      <label for="linkedin_url">LinkedIn URL:</label>
      <input type="text" name="link_url" class="form-control" id="linkedin_url" placeholder="Enter LinkedIn URL">
    </div>
    <div class="form-group">
      <label for="instagram_url">Instagram URL:</label>
      <input type="text" name="insta_url" class="form-control" id="instagram_url" placeholder="Enter Instagram URL">
    </div>
    <div class="form-group">
      <label for="event_type">Event Type:</label>
      <select class="form-control" name="event_type" id="event_type">
        <option value="tournoi">Tournoi</option>
        <option value="normalevent">Normal Event</option>
      </select>
    </div>
    <div class="form-group">
      <label for="formulaLink">Tournoi Form:</label>
      <input type="text" name="formulaLink" class="form-control" id="formulaLink" placeholder="Enter the event form link">
    </div>
    <div class="form-group">
      <label for="para">Add more description to the Tournoi:</label>
      <textarea  name="para" class="form-control" id="para" rows="3" placeholder="Give more description to the tournoi"></textarea>
    </div>
   <!--
    
   -->
    <button type="submit" name="submit" class="btn btn-info">Add Event</button>
  </form>
</div>
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

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<?php include('includes/footer.php') ?>