<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styling.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">  
</head>
<body>

<div class="container mt-5">
  <h2>Update Event</h2> 
  <?php 
  $conn=mysqli_connect('localhost','root','','assoc');
  #fetsh data 
  $event_id=$_GET['updateid'];
  $sql="select *from events where event_id=$event_id";
  $result=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($result);
  $event_id=$row['event_id'];
  $event_title=$row['event_title'];
  $event_desc =$row['event_desc'];
  $location=$row['loc'];
  $organizer=$row['organizer'];
  $speakers=$row['speakers']; 
  $sponsors =$row['sponsors'];
  $face_url=$row['face_url'];
  $twit_url=$row['twit_url'];
  $link_url=$row['link_url'];
  $insta_url=$row['insta_url'];
  $startdate=$row['startdate'];
  $starttime=$row['starttime'];
  $endstime=$row['endstime'];
  $enddate=$row['enddate'];
  $deadline=$row['deadline'];


  #fetsh data
 
  if (isset($_POST['sub'])){
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
    $tempname=$_FILES['image']['tmp_name'];
    $folder='../images/'.$file_name;
    
    /*image part*/
    $event_type=$_POST['event_type'];
   
    $sql = "UPDATE events SET event_id=$event_id, event_title='$event_title', event_desc='$event_desc',
    loc='$location', organizer='$organizer', speakers='$speakers', sponsors='$sponsors', face_url='$face_url',
    twit_url='$twit_url', link_url='$link_url', insta_url='$insta_url', startdate='$startdate',
    starttime='$starttime', enddate='$enddate', endstime='$endstime', deadline='$deadline',
    event_type='$event_type', img='$file_name' ,formulaLink='$formulaLink', para='$para' WHERE event_id=$event_id";

        if( mysqli_query($conn,$sql)){
            echo "done";
        }
        if(move_uploaded_file($tempname,$folder)){
             echo "";
         }else {
      echo "it was not uploaded try again";
   }
} 
  #}

  ?>
  <form  action="" method="post"  enctype="multipart/form-data">
  <div class="form-group">
      <label for="event_id">Event Serie Number:</label>
      <input name="event_id" style="width: 900px;" type="number" class="form-control" id="event_id" required  value="<?php echo $event_id ?>">
    </div>
    <div class="form-group">
      <label for="event_title">Event Title:</label>
      <input name="event_title" style="width: 900px;" type="text" class="form-control" id="event_title" required value="<?php echo $event_title ?> ">
    </div>
    <div class="form-group">
      <label for="event_description">Event Description:</label>
      <textarea  name="event_desc" class="form-control" id="event_description" rows="3"  ><?php echo $event_desc ?></textarea>
    </div>
    <div class="form-group">
      <label for="event_img">Event Image:</label>
      <input type="file" name="image" class="form-control" id="image" />
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="start_date">Start Date:</label>
        <input type="date" name="startdate"  class="form-control" id="start_date"   value="<?php echo $startdate ?>">
      </div>
      <div class="form-group col-md-6">
        <label for="start_time">Start Time:</label>
        <input type="time" name="starttime" class="form-control" id="start_time" value="<?php echo $starttime ?>">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="end_date">End Date:</label>
        <input type="date" name="enddate" class="form-control" id="end_date" value="<?php echo $enddate ?>">
      </div>
      <div class="form-group col-md-6">
        <label for="end_time">End Time:</label>
        <input type="time" name="endstime" class="form-control" id="end_time" value="<?php echo $endstime?>">
      </div>
    </div>
    <div class="form-group">
      <label for="location">Location:</label>
      <input type="text" name="loc" class="form-control" id="location"  value="<?php echo $location ?>" >
    </div>
    <div class="form-group">
      <label for="organizer">Organizer:</label>
      <input type="text" name="organizer" class="form-control" id="organizer" value="<?php echo $organizer?>">
    </div>
    <div class="form-group">
      <label for="speakers">Speakers:</label>
      <input type="text" name="speakers" class="form-control" id="speakers" value="<?php echo $speakers ?>" >
    </div>
    <div class="form-group">
      <label for="deadline">Registration Deadline:</label>
      <input type="datetime-local" name="deadline" class="form-control" id="deadline" value="<?php echo $deadline ?>">
    </div>
    <div class="form-group">
      <label for="sponsors">Sponsors:</label>
      <input type="text" name="sponsors" class="form-control" id="sponsors" value="<?php echo $sponsors ?>" >
    </div>
    <div class="form-group">
      <label for="facebook_url">Facebook URL:</label>
      <input type="text" name="face_url" class="form-control" id="facebook_url" value="<?php echo $face_url ?>" >
    </div>
    <div class="form-group">
      <label for="twitter_url">Twitter URL:</label>
      <input type="text" name="twit_url" class="form-control" id="twitter_url" value="<?php echo $twit_url ?>">
    </div>
    <div class="form-group">
      <label for="linkedin_url">LinkedIn URL:</label>
      <input type="text" name="link_url" class="form-control" id="linkedin_url" value="<?php echo $link_url ?>">
    </div>
    <div class="form-group">
      <label for="instagram_url">Instagram URL:</label>
      <input type="text" name="insta_url" class="form-control" id="instagram_url" value="<?php echo $insta_url ?>" >
    </div>
    <div class="form-group">
      <label for="event_type">Event Type:</label>
      <select class="form-control" name="event_type" id="event_type">
        <option value="tournoi">Tournoi</option>
        <option value="normalevent">Normal Event</option>
      </select>
    </div>
     <div class="form-group">
      <label for="formulaLink">Event Form:</label>
      <input type="text" name="formulaLink" class="form-control" id="formulaLink" placeholder="Enter the event form link">
    </div>
    <div class="form-group">
      <label for="para">Add more description to the Tournoi:</label>
      <textarea  name="para" class="form-control" id="para" rows="3" placeholder="Give more description to the tournoi"><?php echo $para ?></textarea>
    </div>
    <button type="submit" name="sub" class="btn btn-info">Update Event</button>
  </form>
</div>
    


<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>